# Topik 6: Implementasi MVC pattern (Controller)

## Prasyarat
- Peserta didik telah melewati topik sebelumnya

## Kompetensi
- Dapat memahami kegunaan controller dengan baik
- Dapat memahami dependency injection

## Materi

### Controller

It is finally time for the director of the orchestra. Controllers represent the layer in our application that, given a request, talks to the models and builds the views. They act like the manager of a team: they decide what resources to use depending on the situation. As we stated when explaining models, it is sometimes difficult to decide if some piece of logic should go into the controller or the model. At the end of the day, MVC is a pattern, like a recipe that guides you, rather than an exact algorithm that you need to follow step by step. There will be scenarios where the answer is not straightforward, so it will be up to you; in these cases, just try to be consistent. The following are some common scenarios that might be difficult to localize:
• The request points to a path that we do not support. This scenario is already covered in our application, and it is the router that should take care of it, not the controller.

• The request tries to access an element that does not exist, for example, a book ID that is not in the database. In this case, the controller should ask the model if the book exists, and depending on the response, render a template with the book's contents, or another with a "Not found" message.

• The user tries to perform an action, such as buying a book, but the parameters coming from the request are not valid. This is a tricky one. One option is to get all the parameters from the request without checking them, sending them straight to the model, and leaving the task of sanitizing the information to the model. Another option is that the controller checks that the parameters provided make sense, and then gives them to the model. There are other solutions, like building a class that checks if the parameters are valid, which can be reused in different controllers. In this case, it will depend on the amount of parameters and logic involved in the sanitization. For requests receiving a lot of data, the third option looks like the best of them, as we will be able to reuse the code in different endpoints, and we are not writing controllers that are too long. But in requests where the user sends one or two parameters, sanitizing them in the controller might be good enough.

Now that we've set the ground, let's prepare our application to use controllers. The first thing to do is to update our index.php , which has been forcing the application to always render the same template. Instead, we should be giving this task to the router, which will return the response as a string that we can just print with echo. Update your index.php file with the following content:

```php
<?php

use Bookstore\Core\Router;
use Bookstore\Core\Request;

require_once __DIR__ . '/vendor/autoload.php';

$router = new Router();
$response = $router->route(new Request());
echo $response;
```

As you might remember, the router instantiates a controller class, sending the request object to the constructor. But controllers have other dependencies as well, such as the template engine, the database connection, or the configuration reader. Even though this is not the best solution (you will improve it once we cover dependency injection in the next section), we could create an AbstractController that would be the parent of all controllers, and will set those dependencies. Copy the
following as ``src/Controllers/AbstractController.php`` :

```php
<?php
namespace Bookstore\Controllers;

use Bookstore\Core\Config;
use Bookstore\Core\Db;
use Bookstore\Core\Request;
use Monolog\Logger;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Monolog\Handler\StreamHandler;

abstract class AbstractController
{
	
	protected $request;
	
	protected $db;
	
	protected $config;
	
	protected $view;
	
	protected $log;

	public function __construct(Request $request) {
		$this->request = $request;
		$this->db = Db::getInstance();
		$this->config = Config::getInstance();
		$loader = new Twig_Loader_Filesystem(
			__DIR__ . '/../../views'
		);
		$this->view = new Twig_Environment($loader);
		$this->log = new Logger('bookstore');
		$logFile = $this->config->get('log');
		$this->log->pushHandler(
			new StreamHandler($logFile, Logger::DEBUG)
		);
	}

	public function setCustomerId(int $customerId) {
		$this->customerId = $customerId;
	
	}
}
```

When instantiating a controller, we will set some properties that will be useful whenhandling requests. We already know how to instantiate the database connection, the configuration reader, and the template engine. The fourth property, $log , will allow the developer to write logs to a given file when necessary. We will use the Monolog library for that, but there are many other options. Notice that in order to instantiate the logger, we get the value of log from the configuration, which should be the path to the log file. The convention is to use the /var/log/ directory, so create the /var/
log/bookstore.log file, and add "log": "/var/log/bookstore.log" to your configuration file. Another thing that is useful to some controllers—but not all of them—is the information about the user performing the action. As this is only going to be available for certain routes, we should not set it when constructing the controller. Instead, we have a setter for the router to set the customer ID when available; in fact, the router does that already. Finally, a handy helper method that we could use is one that renders a given template with parameters, as all the controllers will end up rendering one template or the other. Let's add the following protected method to the ``AbstractController class``:

```php
protected function render(string $template, array $params): string {
	return $this->view->loadTemplate($template)->render($params);
}
```
### Error controller
Let's start by creating the easiest of the controllers: the ErrorController . This controller does not do much; it just renders the error.twig template sending the "Page not found!" message. As you might remember, the router uses this controller when it cannot match the request to any of the other defined routes. Save the following class in **src/Controllers/ErrorController.php** :

```php
<?php

namespace Bookstore\Controllers;

class ErrorController extends AbstractController 
{
	public function notFound(): string {
		$properties = ['errorMessage' => 'Page not found!'];
		return $this->render('error.twig', $properties);
	}
}

```

### The login controller

The second controller that we have to add is the one that manages the login of the customers. If we think about the flow when a user wants to authenticate, we have the following scenarios:

• The user wants to get the login form in order to submit the necessary information and log in.

• The user tries to submit the form, but we could not get the e-mail address. We should render the form again, letting them know about the problem.

• The user submits the form with an e-mail, but it is not a valid one. In this case, we should show the login form again with an error message explaining the situation.

• The user submits a valid e-mail, we set the cookie, and we show the list of books so the user can start searching. This is absolutely arbitrary; you could choose to send them to their borrowed books page, their sales, and so on. The important thing here is to notice that we will be redirecting the request to another controller. There are up to four possible paths. We will use the request object to decide which of them to use in each case, returning the corresponding response. Let's create, then, the CustomerController class in **src/Controllers/CustomerController.php**
with the login method, as follows:

```php
<?php

namespace Bookstore\Controllers;

use Bookstore\Exceptions\NotFoundException;
use Bookstore\Models\CustomerModel;

class CustomerController extends AbstractController
{
	public function login(string $email): string {
		if (!$this->request->isPost()) {
			return $this->render('login.twig', []);
		}
	
		$params = $this->request->getParams();
		
		if (!$params->has('email')) {
			$params = ['errorMessage' => 'No info provided.'];
			return $this->render('login.twig', $params);
		}

		$email = $params->getString('email');
		$customerModel = new CustomerModel($this->db);

		try {
			$customer = $customerModel->getByEmail($email);
		} catch (NotFoundException $e) {
			$this->log->warn('Customer email not found: ' . $email);
			$params = ['errorMessage' => 'Email not found.'];
			return $this->render('login.twig', $params);
		}
		
		setcookie('user', $customer->getId());
		
		$newController = new BookController($this->request);
		return $newController->getAll();
	}
}
```

As you can see, there are four different returns for the four different cases. The controller itself does not do anything, but orchestrates the rest of the components, and makes decisions. First, we check if the request is a POST, and if it is not, we will assume that the user wants to get the form. If it is, we will check for the e-mail in the parameters, returning an error if the e-mail is not there. If it is, we will try to find the
customer with that e-mail, using our model. If we get an exception saying that there is no such customer, we will render the form with a "Not found" error message. If the login is successful, we will set the cookie with the ID of the customer, and will execute the getAll method of BookController (still to be written), returning the list of books. At this point, you should be able to test the login feature of your application end to
end with the browser. Try to access http://localhost:8000/login to see the form, adding random e-mails to get the error message, and adding a valid e-mail (check your customer table in MySQL) to log in successfully. After this, you should see the
cookie with the customer ID.

### The book controller

The `BookController class` will be the largest of our controllers, as most of the
application relies on it. Let's start by adding the easiest methods, the ones that
just retrieve information from the database. Save this as `src/Controllers/BookController.php`:

```php

<?php

namespace Bookstore\Controllers;

use Bookstore\Exceptions\DbException;
use Bookstore\Exceptions\NotFoundException;
use Bookstore\Models\BookModel;

class BookController extends AbstractController {
    const PAGE_LENGTH = 10;

    public function getAllWithPage($page): string {
        $page = (int)$page;
        $bookModel = new BookModel($this->db);

        $books = $bookModel->getAll($page, self::PAGE_LENGTH);

        $properties = [
            'books' => $books,
            'currentPage' => $page,
            'lastPage' => count($books) < self::PAGE_LENGTH
        ];
        return $this->render('books.twig', $properties);
    }

    public function getAll(): string {
        return $this->getAllWithPage(1);
    }

    public function get(int $bookId): string {
        $bookModel = new BookModel($this->db);

        try {
            $book = $bookModel->get($bookId);
        } catch (\Exception $e) {
            $this->log->error('Error getting book: ' . $e->getMessage());
            $properties = ['errorMessage' => 'Book not found!'];
            return $this->render('error.twig', $properties);
        }

        $properties = ['book' => $book];
        return $this->render('book.twig', $properties);
    }

    public function search(): string {
        $title = $this->request->getParams()->getString('title');
        $author = $this->request->getParams()->getString('author');

        $bookModel = new BookModel($this->db);
        $books = $bookModel->search($title, $author);

        $properties = [
            'books' => $books,
            'currentPage' => 1,
            'lastPage' => true
        ];
        return $this->render('books.twig', $properties);
    }

    public function getByUser(): string {
        $bookModel = $this->di->get('BookModel');

        $books = $bookModel->getByUser($this->customerId);

        $properties = [
            'books' => $books,
            'currentPage' => 1,
            'lastPage' => true
        ];
        return $this->render('books.twig', $properties);
    }

    public function borrow(int $bookId): string {
        $bookModel = $this->di->get('BookModel');

        try {
            $book = $bookModel->get($bookId);
        } catch (NotFoundException $e) {
            $this->log->warn('Book not found: ' . $bookId);
            $params = ['errorMessage' => 'Book not found.'];
            return $this->render('error.twig', $params);
        }

        if (!$book->getCopy()) {
            $params = ['errorMessage' => 'There are no copies left.'];
            return $this->render('error.twig', $params);
        }

        try {
            $bookModel->borrow($book, $this->customerId);
        } catch (DbException $e) {
            $this->log->warn('Error borrowing book: ' . $e->getMessage());
            $params = ['errorMessage' => 'Error borrowing book.'];
            return $this->render('error.twig', $params);
        }

        return $this->getByUser();
    }

    public function returnBook(int $bookId): string {
        $bookModel = new BookModel($this->db);

        try {
            $book = $bookModel->get($bookId);
        } catch (NotFoundException $e) {
            $this->log->warn('Book not found: ' . $bookId);
            $params = ['errorMessage' => 'Book not found.'];
            return $this->render('error.twig', $params);
        }

        $book->addCopy();

        try {
            $bookModel->returnBook($book, $this->customerId);
        } catch (DbException $e) {
            $this->log->warn('Error borrowing book: ' . $e->getMessage());
            $params = ['errorMessage' => 'Error borrowing book.'];
            return $this->render('error.twig', $params);
        }

        return $this->getByUser();
    }
}

```

As we mentioned earlier, one of the new things here is that we are logging user actions, like when trying to borrow or return a book that is not valid. Monolog allows you to write logs with different priority levels: error, warning, and notices. You can invoke methods such as error , warn , or notice to refer to each of them. We use warnings when something unexpected, yet not critical, happens, for example, trying to borrow a book that is not there. Errors are used when there is an unknown problem from which we cannot recover, like an error from the database. The modus operandi of these two methods is as follows: we get the book object from the 3database with the given book ID. As usual, if there is no such book, we return an error page. Once we have the book domain object, we make use of the helpers addCopy and getCopy in order to update the stock of the book, and send it to the
model, together with the customer ID, to store the information in the database. There is also a sanity check when borrowing a book, just in case there are no more books available. In both cases, we return the list of books that the user has borrowed as the
response of the controller.

### Sales Controller

We arrive at the last of our controllers: the SalesController . With a different model, it will end up doing pretty much the same as the methods related to borrowed books. But we need to create the sale domain object in the controller instead of getting it from the model. Let's add the following code, which contains a method for buying a book, add , and two getters: one that gets all the sales of a given user and one that gets the info of a specific sale, that is, getByUser and get respectively. Following the convention, the file will be `src/Controllers/SalesController.php` :

```php
<?php

namespace Bookstore\Controllers;

use Bookstore\Domain\Sale;
use Bookstore\Models\SaleModel;

class SalesController extends AbstractController {
    public function add($id): string {
        $bookId = (int)$id;
        $salesModel = new SaleModel($this->db);

        $sale = new Sale();
        $sale->setCustomerId($this->customerId);
        $sale->addBook($bookId);

        try {
            $salesModel->create($sale);
        } catch (\Exception $e) {
            $properties = ['errorMessage' => 'Error buying the book.'];
            $this->log->error('Error buying book: ' . $e->getMessage());
            return $this->render('error.twig', $properties);
        }

        return $this->getByUser();
    }

    public function getByUser(): string {
        $salesModel = new SaleModel($this->db);

        $sales = $salesModel->getByUser($this->customerId);

        $properties = ['sales' => $sales];
        return $this->render('sales.twig', $properties);
    }

    public function get($saleId): string {
        $salesModel = new SaleModel($this->db);

        $sale = $salesModel->get($saleId);

        $properties = ['sale' => $sale];
        return $this->render('sale.twig', $properties);
    }
}
```

### Dependency Injection

At the end of the chapter, we will cover one of the most interesting and controversial of the topics that come with, not only the MVC pattern, but OOP in general: dependency injection. We will show you why it is so important, and how to implement a solution that suits our specific application, even though there are quite a few different implementations that can cover different necessities.

#### Why is dependency injection necessary?

We still need to cover the way to unit test your code, hence you have not experienced it by yourself yet. But one of the signs of a potential source of problems is when you use the new statement in your code to create an instance of a class that does not belong to your code base—also known as a dependency. Using new to create a domain object like Book or Sale is fine. Using it to instantiate models is also acceptable. But manually instantiating, which something else, such as the template engine, the database connection, or the logger, is something that you should avoid. There are different reasons that support this idea:

• If you want to use a controller from two different places, and each of these
places needs a different database connection or log file, instantiating those
dependencies inside the controller will not allow us to do that. The same
controller will always use the same dependency.

• Instantiating the dependencies inside the controller means that the controller
is fully aware of the concrete implementation of each of its dependencies,
that is, the controller knows that we are using PDO with the MySQL driver
and the location of the credentials for the connection. This means a high level
of coupling in your application—so, bad news.

• Replacing one dependency with another that implements the same interface
is not easy if you are instantiating the dependency explicitly everywhere,
as you will have to search all these places, and change the instantiation
manually.


###Implementing our own dependency injector

Open source solutions for dependency injectors are already available, but we think that it would be a good experience to implement a simple one by yourself. The idea of our dependency injector is a class that contains instances of the dependencies that your code needs. This class, which is basically a map of dependency names to dependency instances, will have two methods: a getter and a setter of dependencies. We do not want to use a static property for the dependencies array, as one of the goals is to be able to have more than one dependency injector with a different set of
dependencies. Add the following class to **src/Utils/DependencyInjector.php** :

```php
<?php

namespace Bookstore\Utils;

use Bookstore\Exceptions\NotFoundException;

class DependencyInjector {
    private $dependencies = [];

    public function set(string $name, $object) {
        $this->dependencies[$name] = $object;
    }

    public function get(string $name) {
        if (isset($this->dependencies[$name])) {
            return $this->dependencies[$name];
        }
        throw new NotFoundException($name . ' dependency not found.');
    }
}
```

Having a dependency injector means that we will always use the same instance of a given class every time we ask for it, instead of creating one each time. That means that singleton implementations are not needed anymore; Creating Clean Code with OOP, it is preferable to avoid them. Let's get rid of them, then. One of the places where we were using it was in our configuration reader. Replace the
existing code with the following in the **src/Core/Config.php** file:


```php
<?php

namespace Bookstore\Core;

use Bookstore\Exceptions\NotFoundException;

class Config {
    private $data;

    public function __construct() {
        $json = file_get_contents(__DIR__ . '/../../config/app.json');
        $this->data = json_decode($json, true);
    }

    public function get($key) {
        if (!isset($this->data[$key])) {
            throw new NotFoundException("Key $key not in config.");
        }
        return $this->data[$key];
    }
}

```

The other place where we were making use of the singleton pattern was in the DB class. In fact, the purpose of the class was only to have a singleton for our database connection, but if we are not making use of it, we can remove the entire class. So, delete your **src/Core/DB.php** file.
Now we need to define all these dependencies and add them to our dependency injector. The index.php file is a good place to have the dependency injector before we route the request. Add the following code just before instantiating the Router class:

```php

<?php

use Bookstore\Core\Config;
use Bookstore\Core\Router;
use Bookstore\Core\Request;
use Bookstore\Models\BookModel;
use Bookstore\Utils\DependencyInjector;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/vendor/autoload.php';

$config = new Config();

$dbConfig = $config->get('db');
$db = new PDO(
    'mysql:host=127.0.0.1;dbname=bookstore',
    $dbConfig['user'],
    $dbConfig['password']
);

$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$view = new Twig_Environment($loader);
var_dump($view->loadTemplate());

$log = new Logger('bookstore');
$logFile = $config->get('log');
$log->pushHandler(new StreamHandler($logFile, Logger::DEBUG));

$di = new DependencyInjector();
$di->set('PDO', $db);
$di->set('Utils\Config', $config);
$di->set('Twig_Environment', $view);
$di->set('Logger', $log);

$di->set('BookModel', new BookModel($di->get('PDO')));

$router = new Router($di);
$response = $router->route(new Request());
echo $response;

```

There are a few changes that we need to make now. The most important of them refers to the AbstractController , the class that will make heavy use of the dependency injector. Add a property named $di to that class, and replace the constructor with the following:


```php
public function __construct(DependencyInjector $di, Request $request )
{
	$this->request = $request;
	$this->di = $di;
	$this->db = $di->get('PDO');
	$this->log = $di->get('Logger');
	$this->view = $di->get('Twig_Environment');
	$this->config = $di->get('Utils\Config');
	$this->customerId = $_COOKIE['id'];
}

```

The other changes refer to the Router class, as we are sending it now as part of the constructor, and we need to inject it to the controllers that we create. Add a $di property to that class as well, and change the constructor to the following one:

```php
public function __construct(DependencyInjector $di) {
	$this->di = $di;
	$json = file_get_contents(__DIR__ . '/../../config/routes.json');
	$this->routeMap = json_decode($json, true);
}
```

Also change the content of the executeController and route methods:

```php
public function route(Request $request): string {
    $path = $request->getPath();

    foreach ($this->routeMap as $route => $info) {
        $regexRoute = $this->getRegexRoute($route, $info);
        if (preg_match("@^/$regexRoute$@", $path)) {
            return $this->executeController($route, $path, $info, $request);
        }
    }

    $errorController = new ErrorController($this->di, $request);
    return $errorController->notFound();
}

private function executeController(string $route, string $path, array $info, Request $request): string {
    $controllerName = '\Bookstore\Controllers\\' . $info['controller'] . 'Controller';
    $controller = new $controllerName($this->di, $request);

    if (isset($info['login']) && $info['login']) {
        if ($request->getCookies()->has('user')) {
            $customerId = $request->getCookies()->get('user');
            $controller->setCustomerId($customerId);
        } else {
            $errorController = new CustomerController($this->di, $request);
            return $errorController->login();
        }
    }

    $params = $this->extractParams($route, $path);
    return call_user_func_array([$controller, $info['method']], $params);
}
```

There is one last place that you need to change. The login method of CustomerController was instantiating a controller too, so we need to inject
the dependency injector there as well:

```$newController = new BookController($this->di, $this->request);```