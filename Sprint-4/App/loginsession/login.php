<?php

session_start();
$name = 'ridwan';
$pass = '123';
if (isset($_POST['submit'])) {
    if ($_POST['name'] == $name && $_POST['pass'] == $pass) {
        
        // session
        $_SESSION['name'] = $_POST['name'];

        header('Location: profile.php');
    }else{
        echo 'Nama atau Password Salah';
    }
}