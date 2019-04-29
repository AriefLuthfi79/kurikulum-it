# PHP dan MySQL

## Prasyrat
- Sudah memahami Database MySQL di Sprint 3 dan Topik Otentikasi Pengguna

## Kompetensi
- Dapat menghubungkan basisdata MySQL dengan PHP
- Dapat membuat otentikasi pengguna dengan menggunakan data dalam basisdata
- Dapat membuat program blog sederhana

## Materi

### Membuat Database Login
Sebelum membuat Aplikasi Login dengan Basis Data mari kita buat databasenya terlebih dahulu

```sql
-- Create Database
CREATE DATABASE `app_pondok`;

-- Create Table and Fields
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `password`) VALUES
(1, 'ridwan', '12345'),
(2, 'daud', '12345'),
(3, 'lukman', '12345');
```

Buatlah folder bernama `otentikasidb` lalu buat file bernama `index.php` dan tambahkan kode ini di file `index.php`

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Session Login</title>
</head>
<body>
    <h1>User Session Login DB</h1>
    <form action="login.php" method="post">
        <label for="">Nama</label>
        <input type="text" name="name">
        <label for="">Password</label>
        <input type="password" name="pass">
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
```
File kode di atas di gunakan untuk user login dan memproses logicnya di file `login.php`. Karena kita belum membuat file `login.php` mari kita buat file tersebut dalam folder yang sama dan isi file tersebut dengan kode berikut ini

```php
<?php

session_start(); //untuk menggunakan Session 
$error = 'User name atau Password Salah'; //inisialisasi variable error
if (isset($_POST['submit'])) { //Jika submit maka lanjut
    if (empty($_POST['name']) || empty($_POST['pass'])) { //jika nilai name kosong atau nilai pass kosong maka 
        echo $error; //tampilkan variable error
    }else{ //jika tidak
        $name = $_POST['name']; //tampung nilai name pada variable name
        $pass = $_POST['pass']; //tampung nilai pass pada variable pass
        // mysqli_connect() function opens a new connection to the MySQL server. 
        $con = mysqli_connect('localhost', 'root', 'root', 'Kurikulum_otentikasi');//buat konek ke database
        // SQL query to fetch information of registerd users and finds user match.
        $login = mysqli_query($con,"SELECT name, password from login where name='$name' AND password='$pass' "); ///mencari user yang cocok di database
        $cek = mysqli_num_rows($login); //menghitung data yang cocok di database

        if ($cek > 0) { //jika data yang cocok lebih dari nol
            $_SESSION['name'] = $name; // Initializing Session
            $_SESSION['status'] = "login"; //inisialisasi Session Login
            header("Location: profile.php"); // Redirecting To Profile Page
        }else{ //jika kosong 
            echo $error; //tampilkan error
        }


    }
}
```

Pada kode di atas kita sudah membuat logic login, jika tidak ada data yang cocok di database maka tampilkan error jika ada yang cocok maka kita inisialisasi SESSION dan redirect login ke file `profile.php`. Sekarang mari kita buat file baru bernama `profile.php` masih di dalam folder yang sama.

```php
<?php
session_start(); //untuk menggunakan SESSTION
if( isset($_SESSION['status']) ){ //chek apakah status sudah login 
    echo '<h1>Profile</h1>'; 

    echo 'Selamat datang ' . $_SESSION['name'];

    echo '<br>';
    echo '<a href="logout.php">Logout<a>'; //tombol lgout
}else{ //jika blom login maka
    echo 'Silahkan Login Terlebih dahulu <br>';
    echo '<a href="index.php">Login</a>';
}

```

Kode di atas adalah kode profle ketika sudah login dan terdapat juga tombol logout yang mengarahkan ke file `logout.php`. Mari kita buat file terakhir `logout.php` di dalam folder yang sama, fungsi dari file ini adalah untuk menghapus SESSION jadi jika suda terhapus maka user tidak lagi bisa melihat halaman profile.

```php
<?php
session_start();
session_destroy();
header('Location: index.php');
```
selesai.

### Latihan
1. Buatlah validasi jika sudah login tidak dapat melihat halaman login melaikan di arahkan ke halaman profile.

