<?php
require_once('Config.php'); //configurasi database
session_start();
class Login extends Config
{
   
    public function login()
    {
        $error = 'User name atau Password Salah';
        if (isset($_POST['submit'])) {
            if (empty($_POST['name']) || empty($_POST['pass'])) { //validasi jika tidak ada nilai yang di kirim
                echo $error;
            } else {
                $name = $_POST['name']; //ambil nilai dari form / inisilisasi 
                $pass = $_POST['pass'];

                // SQL query to fetch information of registerd users and finds user match.
                $login = mysqli_query($this->connect(), "SELECT name, password from login where name='$name' AND password='$pass' ");
                $cek = mysqli_num_rows($login);

                if ($cek > 0) {
                    $_SESSION['name'] = $name; // Initializing Session
                    $_SESSION['status'] = "login";
                    return header("Location: Profile.php"); // Redirecting To Profile Page
                } else {
                    echo $error;
                }
            }
        }
    }


}
