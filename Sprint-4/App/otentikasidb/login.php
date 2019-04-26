<?php

session_start();
$error = 'User name atau Password Salah';
if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['pass'])) {
        echo $error;
    }else{
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        // mysqli_connect() function opens a new connection to the MySQL server. 
        $con = mysqli_connect('localhost', 'root', 'root', 'Kurikulum_otentikasi');
        // SQL query to fetch information of registerd users and finds user match.
        $login = mysqli_query($con,"SELECT name, password from login where name='$name' AND password='$pass' ");
        $cek = mysqli_num_rows($login);

        if ($cek > 0) {
            $_SESSION['name'] = $name; // Initializing Session
            $_SESSION['status'] = "login";
            header("Location: profile.php"); // Redirecting To Profile Page
        }else{
            echo $error;
        }


    }
}