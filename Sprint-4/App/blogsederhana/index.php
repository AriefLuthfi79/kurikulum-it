<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Session Login</title>
</head>
<body>
    <?php 
    require_once('Blog.php');
    if(isset($_SESSION['status'])){
        ?>
        <h3> <a href="Profile.php">Profile</a> </h3> 
        <?php
    }else{
        ?>
        <h3> <a href="user_login.php">Login</a> </h3> 
        <?php
    }
    ?>
    <hr>
    <?php 
    $blog = new Blog();
    $blog->blog_index();
    ?>
                
</body>
</html>