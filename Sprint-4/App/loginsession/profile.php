<?php
session_start();
if( isset($_SESSION['name']) ){
    echo '<h1>Profile</h1>';

    echo 'Selamat datang ' . $_SESSION['name'];

    echo '<br>';
    echo '<a href="logout.php">Logout<a>';
}else{
    echo 'Silahkan Login Terlebih dahulu <br>';
    echo '<a href="index.php">Login</a>';
}
