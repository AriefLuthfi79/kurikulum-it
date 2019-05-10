# Topik 4: Impelementasi MVC Pattern (Model)

## Prasyarat
- Peserta telah mengerti tentang Database
- Peserta telah paham materi di topik sebelumnya
- Peserta mampu memahami normalisasi tabel

## Kompetensi
- Dapat memahami apa itu model
- Dapat memahami kegunaan model

## Materi

### PDO sebagai driver connection database

Imagine for a moment that our bookstore website is quite successful, so we think of building a mobile app to increase our market. Of course, we would want to use the same database that we use for our website, as we need to sync the books that people borrow or buy from both apps. We do not want to be in a position where two people buy the same last copy of a book!

Not only the database, but the queries used to get books, update them, and so on, have to be the same too, otherwise we would end up with unexpected behavior. Of course, one apparently easy option would be to replicate the queries in both codebases, but that has a huge maintainability problem. What if we change one single field of our database? We need to apply the same change to at least two different codebases. That does not seem to be useful at all. Business logic plays an important role here too. Think of it as decisions you need to take that affect your business. In our case, that a premium customer is able to borrow 10 books and a normal one only 3, is business logic. This logic should be put in a
common place too, because, if we want to change it, we will have the same problems as with our database queries.
We hope that by now we've convinced you that data and business logic should be separated from the rest of the code in order to make it reusable. Do not worry if it is hard for you to define what should go as part of the model or as part of the controller; a lot of people struggle with this distinction. As our application is very simple, and it does not have a lot of business logic, we will just focus on adding all
the code related to MySQL queries. As you can imagine, for an application integrated with MySQL, or any other database system, the database connection is an important element of a model. We chose to use PDO in order to interact with MySQL, and as you might remember, instantiating that
class was a bit of a pain. Let's create a singleton class that returns an instance of PDO to
make things easier. Add this code to **src/Core/Db.php** :


```php
<?php

namespace Bookstore\Core;

use PDO;

class Db {
	
	private static $instance;
	
	private static function connect(): PDO {
		$dbConfig = Config::getInstance()->get('db');
	
		return new PDO(
			'mysql:host=127.0.0.1;dbname=bookstore',
			$dbConfig['user'],
			$dbConfig['password']
		);
	}
	
	public static function getInstance(){
		if (self::$instance == null) {
			self::$instance = self::connect();
		}
		return self::$instance;
	}
}
```

## Models

This class, defined in the preceding code snippet, just implements the singleton pattern and wraps the creation of a PDO instance. From now on, in order to get a database connection, we just need to write Db::getInstance(). Although it might not be true for all models, in our application, they will always have to access the database. We could create an abstract class where all models extend. This class could contain a $db protected property that will be set on the constructor. With this, we avoid duplicating the same constructor and property definition across all our models. Copy the following class into **src/Models/AbstractModel.php** :

```php
<?php

namespace Bookstore\Models;

use PDO;

abstract class AbstractModel {
	protected $db;
	public function __construct(PDO $db) {
		$this->db = $db;
	}
}
```

Finally, to finish the setup of the models, we could create a new exception (as we did with the NotFoundException class) that represents an error from the database. It will not contain any code, but we will be able to differentiate where an exception is coming from. We will save it in
**src/Exceptions/DbException.php** :

```php

<?php

namespace Bookstore\Exceptions;

use Exception;

class DbException extends Exception {
}
```

### Costumer Model

Let's start with the easiest one. As our application is still very primitive, we will not allow the creation of new costumers, and work with the ones we inserted manually into the database instead. That means that the only thing we need to do with customers is to query them. Let's create a CustomerModel class in **src/Models/CustomerModel.php** with the following content:

```php
<?php

namespace Bookstore\Models;

use Bookstore\Domain\Customer;
use Bookstore\Domain\Customer\CustomerFactory;
use Bookstore\Exceptions\NotFoundException;

class CustomerModel extends AbstractModel
{
	public function get(int $userId): Customer {
		$query = 'SELECT * FROM customer WHERE id = :id';
		$table = $this->db->prepare($query);
		$table->execute(['id' => $userId]);
		$row = $table->fetch();
		if (empty($row)) {
			throw new NotFoundException();
		}
		return CustomerFactory::factory(
			$row['type'],
			$row['id'],
			$row['firstname'],
			$row['surname'],
			$row['email']
		);
	}
	public function getByEmail(string $userEmail): Customer {
		$query = 'SELECT * FROM customer WHERE email = :user';
		$table = $this->db->prepare($query);
		$table->execute(['user' => $userEmail]);
		$row = $table->fetch();
		if (empty($row)) {
			throw new NotFoundException();
		}
		return CustomerFactory::factory(
			$row['type'],
			$row['id'],
			$row['firstname'],
			$row['surname'],
			$row['email']
		);
	}
}
```

The CustomerModel class, which extends from the AbstractModel class, contains two methods; both of them return a Customer instance, one of them when providing the ID of the customer, and the other one when providing the e-mail. As we already have the database connection as the $db property, we just need to prepare the statement with the given query, execute the statement with the arguments, and fetch the result. As we expect to get a customer, if the user provided an ID or an e-mail that does not belong to any customer, we will need to throw an exception—in this case, a NotFoundException is just fine. If we find a customer, we use our factory to create the object and return it.

### Book Model

Our BookModel class gives us a bit more of work. Customers had a factory, but it is not worth having one for books. What we use for creating them from MySQL rows is not the constructor, but a fetch mode that PDO has, and that allows us to map a row
into an object. To do so, we need to adapt the Book domain object a bit:
• The names of the properties have to be the same as the names of the fields in the database
• There is no need for a constructor or setters, unless we need them for other purposes
• To go with encapsulation, properties should be private, so we will need
getters for all of them
The new Book class should look like the following:

```php
<?php

namespace Bookstore\Domain;

class Book
{
	private $id;
	private $isbn;
	private $title;
	private $author;
	private $stock;
	private $price;
	public function getId(): int {
		return $this->id;
	}
	public function getIsbn(): string {
		return $this->isbn;
	}
	public function getTitle(): string {
		return $this->title;
	}
	public function getAuthor(): string {
		return $this->author;
	}
	public function getStock(): int {
		return $this->stock;
	}
	public function getCopy(): bool {
		if ($this->stock > 1) {
			$this->stock--;
			return true;
		}
		return false;
	}
	public function addCopy() {
		return $this->stock++;
	}
	public function getPrice(): float {
		return $this->price;
	}
}
```

We retained the getCopy and addCopy methods even though they are not getters, as we will need them later. Now, when fetching a group of rows from MySQL with the fetchAll method, we can send two parameters: the constant PDO::FETCH_CLASS that tells PDO to map rows to a class, and the name of the class that we want to map to. Let's create the BookModel class with a simple get method that fetches a book from the database with a given ID. This method will return either a Book object or throw an exception in case the ID does not exist. Save it as **src/Models/BookModel.php** :

```php
<?php

namespace Bookstore\Models;

use Bookstore\Exceptions\NotFoundException;
use Bookstore\Exceptions\DbException;
use Bookstore\Domain\Book;
use PDO;

class BookModel extends AbstractModel
{

	const CLASSNAME = 'Bookstore\Domain\Book';

	public function get(int $bookId): Book {
		$query = 'SELECT * FROM book where id = :book_id';
		$table = $this->db->prepare($query);
		$table->execute(['book_id' => $bookId]);
		$books = $table->fetchAll(
			PDO::FETCH_CLASS, self::CLASSNAME
		);
		if(empty($books)) {
			throw new NotFoundException;
		}
		return $books[0];
	}

	public function getAll(int $page, int $pageLength): array {
		$start = $pageLength * ($page - 1);
		$query = 'SELECT * FROM book LIMIT :page, :length';
		$table = $this->db->prepare($query);
		$table->bindParam('page', $start, PDO::PARAM_INT);
		$table->bindParam('length', $pageLength, PDO::PARAM_INT);
		$table->execute();
		return $table->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
	}

	public function getByUser(int $userId): array {
		$query = 'SELECT b.* FROM borrowed_books bb LEFT JOIN book b ON bb.book_id = b.id WHERE bb.customer_id = :id';
		$table = $this->db->prepare($query);
		$table->execute(['id' => $userId]);
		return $table->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
	}

	public function search(string $title, string $author): array {
		$query = 'SELECT * FROM book WHERE title LIKE :title AND author LIKE :author';
		$table = $this->db->prepare($query);
		$table->bindValue('title', "%$title%");
		$table->bindValue('author', "%$author%");
		$table->execute();
		return $table->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
	}

	public function borrowBooks(Book $book, int $userId) {
		$query = "INSERT INTO borrowed_books (book_id, customer_id, start) VALUES (:book, :user, NOW())";
		$table = $this->db->prepare($query);
		$table->bindValue('book', $book->getId());
		$table->bindValue('user', $userId);
		
		if (!$table->execute()) {
			throw new DbException($table->errorInfo()[2]);
		}
		$this->updateBook($book);
	}

	public function returnBook(Book $book, int $userId) {
		$query = 'UPDATE borrowed_books SET end = NOW()
				  WHERE book_id = :book AND customer_id = :customer
				  AND end IS NULL';
		
		$table = $this->db->prepare($query);
		$table->bindValue('book', $book->getId());
		$table->bindValue('customer', $userId);
		if (!$table->execute()) {
			throw new DbException($table->errorInfo()[2]);
		}
		$this->updateBook($book);
	}

	private function updateBook(Book $book) {
		$query = 'UPDATE book SET stock = :stock WHERE id = :id';
		$table = $this->db->prepare($query);
		
		$table->bindValue('id', $book->getId());
		$table->bindValue('stock', $book->getStock());
		if (!$table->execute()) {
			throw new DbException($table->errorInfo()[2]);
		}
	}
}
```

### Sales Model

Now we need to add the last model to our application: the SalesModel . Using the same fetch mode that we used with books, we need to adapt the domain class as well. We need to think a bit more in this case, as we will be doing more than just fetching. Our application has to be able to create new sales on demand, containing the ID of the customer and the books. We can already add books with the current implementation, but we need to add a setter for the customer ID. The ID of the sale will be given by the autoincrement ID in MySQL, so there is no need to add a setter
for it. The final implementation would look as follows:

```php
<?php

namespace Bookstore\Domain;

class Sale
{

	private $id;
	private $customer_id;
	private $books;
	private $date;

	public function setCustomerId(int $customerId) {
		$this->customer_id = $customerId;
	}

	public function getCustomerId(): int {
		return $this->customer_id;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getBooks(): array {
		return $this->books;
	}

	public function getDate(): string {
		return $this->date;
	}

	public function addBooks(int $bookId, int $amount = 1) {
		if (!isset($this->books[$bookId])) {
			$this->books[$booksId] = 0;
		}
		$this->books[$bookId] += $amount;
	}

	public function setBooks(array $books) {
		$this->books = $books;
	}
}
```

The SalesModel will be the most difficult one to write. The problem with this model is that it includes manipulating different tables: sale and sale_book . For example, when getting the information of a sale, we need to get the information from the sale table, and then the information of all the books in the sale_book table. You could argue about whether to have one unique method that fetches all the necessary information related to a sale, or to have two different methods, one to fetch the sale and the other to fetch the books, and let the controller to decide which one to use. This actually starts a very interesting discussion. On one hand, we want to make things easier for the controller—having one unique method to fetch the entire Sale object. This makes sense as the controller does not need to know about the internal implementation of the Sale object, which lowers coupling. On the other hand, forcing the model to always fetch the whole object, even if we only need the information in the sale table, is a bad idea. Imagine if the sale contains a lot of books; fetching them from MySQL will decrease performance unnecessarily. You should think how your controllers need to manage sales. If you will always need the entire object, you can have one method without being concerned about performance. If you only need to fetch the entire object sometimes, maybe you could add both methods. For our application, we will have one method to rule them all,
since that is what we will always need.

Add the following as your **src/Models/SaleModel.php** file:

```php
<?php

namespace Bookstore\Models;

use Bookstore\Domain\Sale;
use Bookstore\Exceptions\NotFoundException;
use Bookstore\Exceptions\DbException;
use PDO;

class SaleModel extends AbstractModel
{
	const CLASSNAME = 'Bookstore\Domain\Sale';

	public function getByUser(int $userId): array {
		$query = 'SELECT * FROM sale WHERE customer_id = :id';
		$table = $this->db->prepare($query);
		$table->execute(['id' => $userId]);	
		return $table->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
	}

	public function get(int $saleId): Sale {
		$query = 'SELECT * FROM sale WHERE id = :id';
		$table = $this->db->prepare($query);
		$table->execute(['id' => $saleId]);
		$sales = $table->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
		if (empty($sales)) {
			throw new NotFoundException('Sale not found');
		}
		
		$sale = array_pop($sales);
		$query = 'SELECT b.id, b.title, b.author, b.price, sb.amount AS stock, b.isbn
					 FROM sale s LEFT JOIN sale_book sb ON s.id = sb.sale_id
					 LEFT JOIN book b ON sb.book_id = b.id
					 WHERE s.id = :id';
		$table = $this->db->prepare($query);
		$table->execute(['id' => $saleId]);
		$books = $table->fetchAll(PDO::FETCH_CLASS, BookModel::CLASSNAME);
		$sale->setBooks($books);
		return $sale;
	}

	public function create(Sale $sale) {
		$this->db->beginTransaction();
		$query = 'INSERT INTO sale (customer_id, date) VALUES(:id, NOW())';
		$table = $this->db->prepare($query);
		if	(!$table->execute(['id' => $sale->getCustomerId()])) {
			$this->db->rollBack();
			throw new DbException($table->errorInfo()[2]);
		}
		$saleId = $this->db->lastInsertId();
		$query = 'INSERT INTO sale_book (sale_id, book_id, amount)
					 VALUES (:sale, :book, :amount)';
		$table = $this->db->prepare($query);
		$table->bindValue('sale', $saleId);
		foreach ($sale->getBooks() as $bookId => $amount) {
			$table->bindValue('book', $bookId);
			$table->bindValue('amount', $amount);
			if (!$table->execute()) {
				$this->db->rollback();
				throw new DbException($table->errorInfo()[2]);
			}
		}
		$this->db->commit();
	}
}
```

## Meta

Kata kunci :
- PDO
- Database connetion driver
- Exception

## Latihan

1. Buatlah model beserta class domain untuk kasus tertentu *(contoh: **perpustakaan**)*