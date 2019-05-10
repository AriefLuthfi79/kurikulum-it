## Topik 5: Implementasi MVC pattern (View)

## Prasyarat
- Peserta didik telah mampu memahami OOP dengan baik
- Peserta didik telah mengerjakan Latihan di topik sebelumnya
- Peserta didik telah memahami autoloader dengan baik

## Kompetensi

- Dapat memahami kegunaan library
- Dapat mengetahui library apa yang diperlukan untuk menyelesaikan problem tertentu

## Materi

### Apa itu view?

The view is the layer that takes care of the... view. In this layer, you find all the templates that render the HTML that the user gets. Although the separation between views and the rest of the application is easy to see, that does not make views an easy part. In fact, you will have to learn a new technology in order to write views properly. Let's get into the details.

#### Introduction To Twig

In our first attempt at writing views, we mixed up PHP and HTML code. We already know that the logic should not be mixed in the same place as HTML, but that is not the end of the story. When rendering HTML, we need some logic there too. For example, if we want to print a list of books, we need to repeat a certain block of HTML for each book. And since a priori we do not know the number of books to print, the best option
would be a foreach loop. One option that a lot of people take is minimizing the amount of logic that you can include in a view. You could set some rules, such as we should only include conditionals and loops, which is a reasonable amount of logic needed to render basic views. The problem is that there is not a way of enforcing this kind of rule, and other developers can easily start adding heavy logic in there. While some people are OK with that, assuming that no one will do it, others prefer to implement more restrictive systems. That was the beginning of template engines.
You could think of a template engine as another language that you need to learn. Why would you do that? Because this new "language" is more limited than PHP. These languages usually allow you to perform conditionals and simple loops, and that is it. The developer is not able to add PHP to that file, since the template engine will not treat it as PHP code. Instead, it will just print the code to the output—the response' body—as if it was plain text. Also, as it is specially oriented to write templates, the syntax is usually easier to read when mixed with HTML. Almost everything is an advantage.

The inconvenience of using a template engine is that it takes some time to translate the new language to PHP, and then to HTML. This can be quite time consuming, so it is very important that you choose a good template engine. Most of them also allow you to cache templates, improving the performance. Our choice is a quite light and widely used one: Twig. As we've already added the dependency in our Composer file, we can use it straight away.
Setting up Twig is quite easy. On the PHP side, you just need to specify the location of the templates. A common convention is to use the views directory for that. Create the directory, and add the following two lines into your index.php :

```php
<?php

$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$twig = new Twig_Environment($loader);
```

### Book View

Create code for **layout.twig** first into **views/layout.twig**:

```
<!DOCTYPE html>
<html>
<head>
	<title>{% block title %}{% endblock %}</title>
</head>
<body>
	<div style="border: solid 1px">
		<a href="/books">Books</a>
		<a href="/sales">My sales</a>
		<a href="/my-books">My Books</a>
		<hr>
		<form action="/books/search" method="get">
			<label>Title</label>
			<input type="text" name="title">
			<label>Author</label>
			<input type="text" name="author">
			<input type="submit" value="Search">
		</form>
	</div>
	{% block content %}{% endblock %}
</body>
</html>

```

Let's now create our first template. Write the following code into **views/book.twig** .
By convention, all Twig templates should have the .twig extension:

```
{% extends 'layout.twig' %}

{% block title %}
	{{ book.title }}
{% endblock %}

{% block content %}
	<h2>{{ book.title }}</h2>
	<h3>{{ book.author }}</h3>
	<hr>
	<p>
		<strong>ISBN</strong> {{ book.isbn }}
	</p>
	<p>
		<strong>Stock</strong> {{ book.stock }}
	</p>
	<p>
		<strong>Price</strong> {{ book.price|number_format(2) }} €
	</p>
	<hr>
	<h3>Action</h3>
	<form method="post" action="/book/{{ book.id }}/borrow">
		<input type="submit" value="Borrow">
	</form>

	<form method="post" action="/book/{{ book.id }}/buy">
		<input type="submit" value="Buy">
	</form>
{% endblock %}
```

## Paginated book list

In the preceding snippet, we force the application to render the books.twig
template, sending an array of books from page number 1, and showing 3 books per
page. This array, though, might not always return 3 books, maybe because there are
only 2 books in the database. We should then use a loop to iterate the list instead
of assuming the size of the array. In Twig, you can emulate a foreach loop using
```{% for <element> in <array> %}``` in order to iterate an array. Let's use it for your
**views/books.twig** :

```
{% extends 'layout.twig' %}

{% block title %}
	Books
{% endblock %}

{% block content %}
	<table>
		<thead>
			<th>Title</th>
			<th>Author</th>
			<th></th>
		</thead>

		{% for book in books %}
			<tr>
				<td>{{ book.title }}</td>
				<td>{{ book.author }}</td>
				<td><a href="/book/{{ book.id }}">View</a></td>
			</tr>
		{% endfor %}
	</table>

	{% if currentPage != 1 %}
		<a href="books/{{ currentPage - 1 }}">Previous</a>
	{% endif %}
	{% if not lastPage %}
		<a href="books/{{ currentPage + 1 }}">Next</a>
	{% endif %}
{% endblock %}
```

### Sales View

The template for this view will be very similar to the one listing the books: a table populated with the content of an array. The following is the content of **views/sales.twig** :

```
{% extends 'layout.twig' %}

{% block title %}
	My Sales
{% endblock %}

{% block content %}
	<table>
		<thead>
			<th>ID</th>
			<th>Date</th>
		</thead>

	{% for sale in sales %}
		<tr>
			<td>{{ sale.id }}</td>
			<td>{{ sale.date }}</td>
			<td><a href="/sales/{{ sale.id }}">View</a></td>
		</tr>
	{% endfor %}
	
	</table>
{% endblock %}
```

And the Twig template should be placed in **views/sale.twig** :

```
{% extends 'layout.twig' %}

{% block title %}
	Sale {{ sale.id }}
{% endblock %}

{% block content %}
	<table>
		<thead>
			<th>Title</th>
			<th>Author</th>
			<th>Amount</th>
			<th>Price</th>
			<th></th>
		</thead>
		{% for book in sale.books %}
			<tr>
				<td>{{ book.title }}</td>
				<td>{{ book.author }}</td>
				<td>{{ book.stock }}</td>
				<td>{{ (book.price * book.stock)|number_format(2) }} €</td>
			</tr>
		{% endfor %}
	</table>
{% endblock %}
```

## Error Template

We should add a very simple template that will be shown to the user when there is
an error in our application, rather than showing a PHP error message. This template
will just expect the ``errorMessage variable``, and it could look like the following. Save
it as **views/error.twig** :

```
{% extends 'layout.twig' %}

{% block title %}
	Error
{% endblock %}

{% block content %}
	<h2>Error: {{ errorMessage }}</h2>
{% endblock %}
```

## Login template

Our last template will be the one that allows the user to log in. This template is abit different from the others, as it will be used in two different scenarios. In the first one, the user accesses the login view for the first time, so we need to show the form. In the second one, the user has already tried to log in, and there was an error when doing so, that is, the e-mail address was not found. In this case, we will add an extra
variable to the template, ``errorMessage`` , and we will add a conditional to show its contents only when this variable is defined. You can use the operator is defined to check that. Add the following template as **views/login.twig** :

```
{% block title %}
	Login
{% endblock %}

{% block content %}
	{% if errorMessage is defined %}
		<strong>{{ errorMessage }}</strong>
	{% endif %}

	<form action="/login" method="post">
		<label>Email</label>
		<input type="text" name="email">
		<input type="submit" value="Login">
	</form>
{% endblock %}
```

## Meta

Kata kunci:
- Twig template engine

## Latihan

1. Buatlah template sesuai dengan kasus mu di topik sebelumnya