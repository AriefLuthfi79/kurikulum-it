# Topik 6: Implementasi MVC pattern (Controller)

## Prasyarat
- Peserta didik telah melewati topik sebelumnya

## Kompetensi
- Dapat memahami kegunaan controller dengan baik

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

