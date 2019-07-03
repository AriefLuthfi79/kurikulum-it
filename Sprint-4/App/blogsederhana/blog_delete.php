<?php
require_once('Blog.php');

$blog = new Blog();
$blog->blog_delete($_GET['id']);
?>