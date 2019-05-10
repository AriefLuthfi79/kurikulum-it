# Topik 3: Routing Domain

## Prasyarat
- Peserta didik telah mampu memahami OOP dengan baik
- Peserta didik memahami route dasar
- Peserta didik telah memahami sprint 5 dengan baik

## Kompetensi

- Dapat memahami read suatu file
- Dapat mengetahui kegunaan regular expression

## Materi

### Router class

Router class berfungsi menentukan controller mana yang harus di load, berdasarkan request yang dilakukan client, serta route mana akan di tentukan nantinya.

Pertama-tama kita defenisikan dulu route apa saja yang akan di request, buatlah file json pada folder `src/config/routes.json`.

```json
{
	"books/:page": {
		"controller": "Book",
		"method": "getAllWithPage",
		"params": {
			"page": "number"
		}
	},
	"books": {
		"controller": "Book",
		"method": "getAll"
	},
	"book/:id": {
		"controller": "Book",
		"method": "get",
		"params": {
			"id": "number"
		}
	},
	"books/search": {
		"controller": "Book",
		"method": "search"
	},
	"login": {
		"controller": "Customer",
		"method": "login"
	},
	"sales": {
		"controller": "Sales",
		"method": "getByUser",
		"login": true
	},
	"sales/:id": {
		"controller": "Sales",
		"method": "get",
		"login": true,
		"params": {
			"id": "number"
		}
	},
	"my-books": {
		"controller": "Book",
		"method": "getByUser",
		"login": true
	},
	"book/:id/buy": {
		"controller": "Sales",
		"method": "add",
		"login": true,
		"params": {
			"id": "number"
		}
	},
	"book/:id/borrow": {
		"controller": "Book",
		"method": "borrow",
		"login": true,
		"params": {
			"id": "number"
		}
	},
	"book/:id/return": {
		"controller": "Book",
		"method": "returnBook",
		"login": true,
		"params": {
			"id": "number"
		}
	}
}
```

Tentunya data diatas adalah route yang didefinisikan agar nantinya setiap path dihandle oleh `class Router` kita agar dapat mengeksekusi masing-masing controller. Sekarang buat `class Router` pada didalam folder `src/Core/`.

```php
<?php

namespace Bookstore\Core;

class Router
{
	private $routerMap;
	private static $regexPatterns = [
		'number' => '\d+',
		'string' => '\w'
	]

	public function __construct()
	{
		$json = file_get_contents(__DIR__ . '/../config/routes.json');
		$this->routerMap = json_decode($json, true);
	}

	public function route(Request $request): string
	{
		$path = $request->getPath();

		foreach ($this->routerMap as $route => $info) {
			$regexRoute = $this->getRegexRoute($route, $info);
			if (preg_match("@^/$regexRoute$@", $path)) {
				return $this->executeController(
					$route, $path, $info, $request
				);
			}
		}

		$errorController = new ErrorController($request);
		return $errorController->notFound();
	}

	private function getRegexRoute(string $route, array $info): string
	{
		if (isset($info['params'])) {
			foreach ($info['params'] as $name => $type) {
				$route = str_replace(
					':' . $name, self::$regexPatterns[$type], $route
				);
			}
		}

		return $route;
	}

	private function extractParams(string $route, string $path): array
	{
		$params = [];

		$pathParts = explode('/', $path);
		$routeParts = explode('/', $route);

		foreach ($routeParts as $key => $routePart) {
			if (strpos($routePart, ':') === 0) {
				$name = substr($routePart, 1);
				$params[$name] = $pathParts[$key+1];
			}
		}

		return $params;
	}

	private function executeController(string $route, string $path, array $info, Request $request): string
	{
		$controllerName = '\Bookstore\Controllers\\' . info['controller'] . 'Controller';
		$controller = new $controllerName($request);

		if (isset(info['login']) && info['login']) {
			if ($request->getCookies()->has('user')) {
				$costumerId = $request->getCookies()->get('user');
				$controller->setCostumerId($costumerId);
			} else {
				$errorController = new CostumerController($request);
				return $errorController->login();
			}
		}

		$params = $this->extractParams($route, $path);
		return call_user_func_array(
			[$controller, $info['method']], $params
		);
	}
}
```

### Breakdown code

Perhatikan `class` diatas merupakan bagian dari core aplikasi kita dimana nantinya `class` ini bekerja sebagai controller mana yang akan diekseksi sesuai dengan path yang di request. Constructor pada `class` diatas akan meread route dari file json yang kita buat, serta jika kita method `extractParams()` akan mengextract parameter dari path, lihat contoh berikut ini:

```
Jika client mengakses path /books/12/borrow dan tentunya route nya adalah /books/:id/borrow maka path tadi akan diseleksi dalam mendapatkan id nya, dan yang terjadi adalah method tsb akan me-return array ['id' => 12]
```

Dan method `executeController()` sendiri nantinya akan mengeksekusi controller mana yang akan dipanggil.

## Meta

Kata kunci:

- json
- regular expression

## Latihan

1. Buatlah suatu kasus dimana tentang materi yang berkaitan, dan buatlah route sesuai dengan kasus tsb *(contoh: perpustakaan)*