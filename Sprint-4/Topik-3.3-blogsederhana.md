# Blog Sederhana

## Prasyrat
- Sudah memahami Database MySQL

## Kompetensi
- Dapat menghubungkan basisdata MySQL dengan PHP
- Dapat membuat otentikasi pengguna dengan menggunakan data dalam basisdata
- Dapat membuat program blog sederhana

## Materi

### Menambahkan Table
Sebelum membuat blog sederhana mari kita menambahkan Table terlebih dahulu dari aplikasi yang sebelumnnya sudah di buat

```sql
CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL
);

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `author`, `date`) VALUES
(1, 'bismillah', 'awali dengan bismillah', 'daud', '2019-04-21'),
(2, 'lorem ipsum', 'adsfndasflb;sdajbj\r\nhaksdhfkhsdalf\r\nkhlkdhaklfhkdsf lhalksdhfklhsdf', 'daud', '2019-04-21');
```

### Membuat Konfigurasi
Setelah menambahkan Table baru di database sekarang kita akan membuat Konfigurasi. Buatlah Folder baru bernama blogsederhana lalu buat file bernama Config.php lalu tambahkan kode berikut

```php
<?php

class Config
{
    public function connect()
    {
        // mysqli_connect() function opens a new connection to the MySQL server. 
        $con = mysqli_connect('localhost', 'root', 'root', 'app_pondok'); //Membuat koneksi dengan database

        return $con;
    }
}

```
### Membuat fungsi fungsi blog
File Config.php berupa sebuah `class` yang mempunyai fungsi mengkoneksikan `database` dengan `php`. class `Config` ini nantinya akan di `extends` pada semua class yang membutuhkan koneksi dengan database. Sekarang mari kita buat fungsi - fungsi blogsederhhana yang kita butuhkan. Buatlah file baru bernama `Blog.php` lalu isi dengan kode ini

```php
<?php
require_once('Config.php');  //configurasi database
session_start(); //untuk menggunakan SESSION 
class Blog extends Config{ //Meng-extends class Config

    public function blog_index(){ //fungsi ini untuk menampilkan seluruh postingan artikel

        $data = "SELECT * FROM blog"; //inisialisasi varibel untuk menampilkan data
        $blogs = $this->connect()->query($data); //query data
        ?>
        //Tampilan Blog
        <h1><i>Artikel Kita</i></h1> 
        <?php
        
        if ($blogs->num_rows > 0){ //check apakah data tidak kosong
            while($blog = $blogs->fetch_assoc()){ //mengambil data dan di ubah menjadi array
                ?>
                <div style="border: 1px solid #000; padding: 5%; margin-top: 3%">
                    <h3><?php echo $blog['title'] ?></h3> //menampilkan title artikel
                    <hr>
                    <p><?php echo $blog['content'] ?></p> //menampilkan isi dari artikel 
                    <br>
                    <small>
                        penulis : <i><?php echo $blog['author'] ?></i> || <i><?php echo $blog['date'] ?></i> //menampilkan penulis
                        <?php 
                        if(isset($_SESSION['status'])){ //jika user sudah login tampil fungsi edit dan delete
                            ?>
                            || <a style="color:red;" href="blog_delete.php?id=<?php echo $blog['id']; ?>">Delete</a> //delete 
                            || <a href="blog_edit.php?id=<?php echo $blog['id'];?>" style="color:green;" href="">Edit</a>//Edit
                            <?php
                        }
                        ?>                      
                    </small>
                    
                </div>
                <?php
            }
        }else{ //Jika Tidak ada data maka 
            echo '<h2>Tidak ada Artikel</h2>';
        }
    }

    public function blog_create() ///fungsi ini untuk membuat artikel di blog
    {
        if( isset($_SESSION['status']) ){ //validasi apakah sudah login atau blom
            ?>
            <h1>Buat Artikel</h1>
            <br>
            <hr>
            <form action="#" method="post">
                <label for="">Judul</label>
                <input type="text" name="title">
                <br>
                <label for="">Artikel</label>
                <textarea name="content" id="" cols="30" rows="10"></textarea>
                <br>
                <input type="submit" name="submit" value="submit">
            </form>
            <?php
        
            if (isset($_POST['submit'])) { //jika klik submit maka
                $title = $_POST['title']; //mengambil nilai dari form dan di masukan ke dalam variabel
                $content = $_POST['content']; //mengambil nilai dari form dan di masukan ke dalam variabel
                $author = $_SESSION['name']; //mengambil nilai session nama lalu di masukan ke dalam variable
                $date = date('Y-m-d'); //mengambil tanggal sekarang
        
                $insert = "INSERT INTO blog (title, content, author, date) VALUES ('$title', '$content', '$author', '$date') "; //membuat query untuk di input
                if($this->connect()->query($insert) === TRUE ){ //chek apakah ada error di query $insert
                    echo 'Berhasil Menambah Artikel';
                }else{ //jika ada error maka tampilkan error
                    echo "Error: " , $insert . "<br>" . $this->connect()->error;
                }
                $this->connect()->close(); //menghentikan koneksi database
            }
        }else{ //klo blom login ke sini suruh login dulu
            echo 'Silahkan Login Terlebih dahulu <br>';
            echo '<a href="index.php">Login</a>';
        }
    }

    public function blog_delete($id){ //fungsi ini untuk mendelete artikel 
        $sql = "DELETE FROM blog WHERE id=$id"; //membuat query untuk medelete artikel

        if (mysqli_query($this->connect(), $sql)) { // jika delete data maka 
            return header('Location: index.php'); //redirect ke tampilan awal
        } else { //jika ada error maka
            echo "Error deleting record: " . mysqli_error($this->connect()); //tampilkan error
        }
        
    }

    public function blog_edit($id){ // Fungsi ini untuk mengEdit artikel
        if(isset($_POST['simpan'])){ //jika di klik simpan maka
            
            $title = $_POST['title']; // inisialisasi title arikel baru
            $content = $_POST['content']; // inisialisasi isi arikel baru
            $sql = "UPDATE blog SET title='$title', content='$content' WHERE id='$id'"; //membuat query untuk mengedit artikel

            if(mysqli_query($this->connect(),$sql)){ // jika update data maka
                header('Location: index.php'); //redireect ke halaman awal blog
            }else{ //jika tidak maka
                echo "Error Edit record: " . mysqli_error($this->connect()); //tampilkan error
            }
        }
    }
}
```
### Membuat Halaman Awal dan Menampilkan seluruh artikel yang telah di buat
Kita sudah membuat fungsi - fungsi untuk membuat blog sederhana, dan sekarang kita akan menggunakannya satu persatu fungsi fungsi yang sudah kita buat tersebut. Kali ini kita akan membuat halaman awal dan menggunakan fungsi index untuk menampilkan seluruh artikel yang telah di buat. Buatlah file bernama `index.php` di dalam folder yang sama lalu ikuti kode berikut

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
    <?php 
    require_once('Blog.php'); // include Blog.php file
    if(isset($_SESSION['status'])){ // validasi status login atau belum
        ?>
        <h3> <a href="Profile.php">Profile</a> </h3> 
        <?php
    }else{ // jika blom login maka
        ?>
        <h3> <a href="user_login.php">Login</a> </h3> 
        <?php
    }
    ?>
    <hr>
    <?php 
    $blog = new Blog(); // membuat objek
    $blog->blog_index(); // memanggil fungsi blog_index
    ?>
                
</body>
</html>
```
### Membuat Artikel baru
Selanjutnya kita akan membuat User bisa menambahkan Artikel baru. Buatlah file baru bernama `blog_addpost.php` lalu isikan dengan kode ini
```php
<?php
require_once('Blog.php'); // include Blog.php file
$blog = new Blog(); // Membuat Objek
$blog->blog_create(); // memanggil fungsi blog_create()
?>
```
### Menghapus Artikel
Buatlah file baru bernama `blog_delete.php` lalu isi dengan kode ini
```php
<?php
require_once('Blog.php'); // include Blog.php file

$blog = new Blog(); //Membuat Objek 
$blog->blog_delete($_GET['id']); // Memanggil fungsi blog_delete() dan mengisi parameter dengan id artikel 
?>
```
### Edit Artikel
Buatlah file baru bernama `blog_edit.php` lalu isi dengan kode ini
```php
<?php 
require_once('Blog.php');  // include Blog.php fil
$blog = new Blog(); //membuat Objek

$id = $_GET['id']; //Mengambil id dan menempatkan id di variable
$show = mysqli_query($blog->connect(),"SELECT * FROM blog WHERE id='$id'"); //Mencari query 

if(mysqli_num_rows($show) == 0){ //jika tidak di temukan maka
    echo 'Data tidak di temukan'; // tampilkan 
}else{ // jika di temukan maka
    $data = mysqli_fetch_assoc($show); //buat variable untuk menampilkan data
}
?>
<h1>Edit Artikel</h1>
<form action="#" method="post">
    <label for="">Judul</label>
    <input type="text" name="title" value="<?php echo $data['title'];?>"> //tampilkan titlle artikel
    <br>
    <label for="">Artikel</label>
    <textarea name="content" id="" cols="30" rows="10"><?php echo $data['content'];?></textarea> //menampilkan isi artikel
    <br>
    <input type="submit" name="simpan" value="simpan">
</form>
<?php 
$blog->blog_edit($id);//memanggil fungsi blog_edit()
?>
```
### Membuat Login
Jika sudah sekarang mari kita buat user loginnya. Masih di folder yang sama buatlah file bernama user_login.php lalu isikan kode berikkut ini

```php
<?php
require_once('Login.php'); // include file Login.php
$login = new Login(); // membuat objek dari class Login

if(isset($_SESSION['status'])){ // Validasi jika sudah login maka
    header('Location: Profile.php'); // redirect ke Profile.php
}else{ // jika blom login maka tampilkan form login


?>  
<h3><a href="index.php">Home</a></h3>
<hr>
<h1>User Session Login</h1>
    <form action="#" method="post">
        <label for="">Nama</label>
        <input type="text" name="name">
        <label for="">Password</label>
        <input type="password" name="pass">
        <input type="submit" name="submit" value="Login">
    </form>

<?php 
}
$login->login();  //menggunakan function login dari class Login
?>
```
Kode di atas adalah tampilan untuk login dan kita belum membuat proses login atau logic login nya. Sekarang buatlah file baru bernama Login.php dan masih di folder yang sama, lalu masukan kode berikut

```php
<?php
require_once('Config.php'); //configurasi database
session_start(); // Untuk menggunakan SESSION
class Login extends Config //extends class Config
{
   
    public function login() // fungsi untuk login
    {
        $error = 'User name atau Password Salah'; // variable untuk terjadi error
        if (isset($_POST['submit'])) { // jika di klik submit maka 
            if (empty($_POST['name']) || empty($_POST['pass'])) { //validasi jika tidak ada nilai yang di kirim
                echo $error; // tampilkan error
            } else { // ada nilai yang di kirim maka
                $name = $_POST['name']; //ambil nilai dari form / inisilisasi 
                $pass = $_POST['pass'];

                // SQL query to fetch information of registerd users and finds user match.
                $login = mysqli_query($this->connect(), "SELECT name, password from login where name='$name' AND password='$pass' ");
                $cek = mysqli_num_rows($login); // menghitung aada berapa row 

                if ($cek > 0) { //jika lebih dari nol maka
                    $_SESSION['name'] = $name; // Initializing Session
                    $_SESSION['status'] = "login"; // inisialisasi SESSION status
                    return header("Location: Profile.php"); // Redirecting To Profile Page
                } else { // jika kurang dari nol maka
                    echo $error; //tampilkan error
                }
            }
        }
    }
}

```
### Membuat Tampilan Profile

Setelah login akan meredirect ke tampilan Profile maka kita akan membuat file Profile.php di dalam folder yang sama juga, dan isi file Profile sepeti berikut ini

```php
<?php
session_start(); // Untuk Menggunakan SESSION
class Profile{ //class profile

    public function profile(){ //fungsi profile
        if( isset($_SESSION['status']) ){ //validasi sudah login atau blom
            ?>
            <h3><a href="index.php">Home</a> | <a href="blog_addpost.php">Buat Artikel</a> | <a href="Logout.php">Keluar</a></h3>
            <hr>
            <h1>Profile</h1>
            <p>
                Selamat Datang <b><i><?php echo $_SESSION['name']; ?></i></b> //menampilkan nama 
            </p>
            <?php
        }else{ // jika blom login maka tampilkan
            echo 'Silahkan Login Terlebih dahulu <br>';
            echo '<a href="index.php">Login</a>';
        }
    }

}

$profile = new Profile(); //membuat objek 
```
### Membuat Logout

Kita sudah membuat Login, Ketika User Login maka di alihkan ke halaman Profile, di dalam halaman Profile ada link Logout tapi kita blom membuatnya , ayo kita Logout. Buatlah file bernama Logout.php lalu isikan dengan kode ini 
```php 
<?php
session_start(); ///Untuk Menggunakan SESSION

class Logout{ 

    public function logout(){ // fungsi untuk lgout
        session_destroy(); //menghapus session
        return header('Location: user_login.php'); //redirect ke login
    }
}

$logout = new Logout(); //membuat objek
$logout->logout(); // memanggil fungsi logout

```

### Selesai

### Latihan
1. Buatlah artikel link untuk di lihat per artikel bukan di tampilkan semua
2. Artikel yang di tampilkan halaman awal di batasi hanya 100 karakter