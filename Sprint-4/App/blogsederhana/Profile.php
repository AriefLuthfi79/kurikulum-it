<?php
session_start();
class Profile{

    public function profile(){
        if( isset($_SESSION['status']) ){ //validasi sudah login atau blom
            ?>
            <h3><a href="index.php">Home</a> | <a href="blog_addpost.php">Buat Artikel</a> | <a href="Logout.php">Keluar</a></h3>
            <hr>
            <h1>Profile</h1>
            <p>
                Selamat Datang <b><i><?php echo $_SESSION['name']; ?></i></b>
            </p>
            <?php
        }else{
            echo 'Silahkan Login Terlebih dahulu <br>';
            echo '<a href="index.php">Login</a>';
        }
    }

}

$profile = new Profile();

