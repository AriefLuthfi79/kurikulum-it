<?php
$name = 'ridwan';
$pass = '123';

if (isset($_POST['submit'])) {
    if ($_POST['name'] == $name && $_POST['pass'] == $pass) {

        //Menggunakan Cookie
        setcookie('name',$_POST['name'],time()+(60*60*24));
        header('Location: profile.php');
    }else{
        echo 'User atau Password Salah';
    }
}