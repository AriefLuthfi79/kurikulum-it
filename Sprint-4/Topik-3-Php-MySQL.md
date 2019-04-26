# PHP dan MySQL

## Prasyrat
Sudah memahami Database MySQL di Sprint 3

## Kompetensi
- Dapat menghubungkan basisdata MySQL dengan PHP
- Dapat membuat otentikasi pengguna dengan menggunakan data dalam basisdata
- Dapat membuat program blog sederhana

## Materi

## PHP Terhubung ke MySQL
Dalam PHP ada 2 cara menghubungkan PHP ke Database 

1. MySQLi Prosedural dan MySQLi Object-Oriented
3. PDO


**MySQLI** hanya di gunakan untuk MySQL Database saja, sedangkan **PDO** bisa di guanakan pada 12 sistem database yang berbeda. Jadi ketika kita menggunakan **PDO** kita hanya akan menganti Nama Koneksi dan beberapa query saja, beda halanya dengan **MySQLi** kita harus menulis ulang database kita.

```php
//Example (MySQLi Object-Oriented)
<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
```
```php
//Example (MySQLi Procedural)
<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
```

```php
//Example (PDO)
<?php
$servername = "localhost";
$username = "username";
$password = "password";

try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
```
