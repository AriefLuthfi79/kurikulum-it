# Topik 2: Request handling

## Prasyarat
- Peserta didik telah memahami ```http request``` dengan baik
- Peserta didik telah mampu bekerja dengan routing
- Peserta didik memahami `class` dengan baik


## Kompetensi
- Memahami kegunaan `class Request` dengan baik
- Dapat Handling route setiap request yang dilakukan

## Materi

### Request Handling

Pada materi ini kita sedikit mundur kebelakang. Kita mulai memanfaatkan variable global pada php namun lebih fokus pada variable `$_SERVER`.
Request handling terjadi saat client access url pada web maka dengan begitu kita bisa memanfaatkan variable `$_SERVER` untuk mendapatkan suatu informasi yang akan kita kelola menggunakan `class Request`.

#### Apa itu variable `$_SERVER`

Di Website php manual, tertulis `$_SERVER` adalah:

```
$_SERVER is an array containing information such as headers, paths, and script locations.
The entries in this array are created by the web server.
```

Intinya variable `$_SERVER` ini membantu kita mendapatkan informasi server yang di request.


### Bekerja dengan `class Request`

```
Tujuan utama aplikasi web
adalah memproses permintaan HTTP yang berasal dari klien dan mengembalikan respons. Jika itu
tujuan utama aplikasi nya maka mengelola Request dan Response
merupakan bagian penting pada suatu kode aplikasi web
```

Untuk itu kita akan membuat kode untuk `class Request`, pertama-tama buatlah folder seperti contoh dibawah ini


---

```
-- src/
	-- Controlllers/
	-- Core/
	-- Domain/
	-- Exceptions/
	-- Models/
	-- Utils/
-- views/
```

Oke, langsung saja implementasi ```class Request``` pada project kita didalam folder src/Core/.

```php

<?php

namespace Bookstore\Core;

class Request
{
	const GET = 'GET';
	const POST = 'POST';

	private $domain;
	private $path;
	private $method;

	public function __construct()
	{
		$this->domain = $_SERVER['HTTP_HOST'];
		$this->path = $_SERVER['REQUEST_URI'];
		$this->method = $_SERVER['REQUEST_METHOD'];
	}

	public function getUrl(): string
	{
		return $this->domain . $this->path;
	}

	public function getDomain(): string
	{
		return $this->domain;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function isPost(): bool
	{
		return $this->method === self::POST;
	}

	public function isGet(): bool
	{
		return $this->method === self::GET;
	}
}

```

Jika kita lihat kode diatas terdapat variable `$_SERVER`, dimana variable `$_SERVER` sendiri adalah array associative, disini kita gunakan kemampuan dari variable `$_SERVER` sendiri yang nantinya kita dapatkan data tentang method apa yang direquest, domain apa yang dipakai, dan url apa yang dituju.

### Filtering parameters dari request yang dilakukan (Extract Data Setiap Form Request dan Url)

Bagian penting lain dari suatu request adalah mendapatkan data dari client dari parameter variable global
`$_GET` dan `$_POST`, seperti halnya variable global dari `$_SERVER`. Untuk itu kita akan tambahkan `class` baru didalam folder **core/** khusus menghandle informasi dari variable `$_GET` dan `$_POST`.


```php
<?php

namespace Bookstore\Core;

class FilteredMap
{
	private $map;

	public function __construct(array $baseMap)
	{
		$this->map = $baseMap
	}

	public function has(string $name): bool
	{
		return isset($this->map[$name]);
	}

	public function get(string $name)
	{
		return $this->map[$name] ?? null;
	}

	public function getInt(string $name)
	{
		return (int) $this->get($name); 
	}

	public function getNumber(string $name)
	{
		return (float) $this->get($name);
	}

	public function getString(string $name, bool $filter = true)
	{
		$value = (string) $this->get($name);
		return $filter ? addslashes($value) : $value;
	}
}

```

Pemanfaatan kode diatas akan lebih terasa saat kita menghandle parameter dari setiap request variable `$_POST` dan `$_GET`.
Dibawah ini adalah contoh pemanfaatan handle paramater:

```php
$price = $request->getParams()->getNumber('price');
```

Cara diatas terasa lebih safety tanpa memanggil variable global itu sendiri ketimbang cara dibawah:
```php
$price = $_POST['price'];
```

## Meta

Kata Kunci:
- Variable Global

Tautan terkait:
- [PHP](php.net/manual)

## Latihan

1. Buatlah program 