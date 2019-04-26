<?php
require_once('config.php');  //configurasi database

session_start();
if( isset($_SESSION['name']) ){ //validasi apakah sudah login atau blom
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

    if (isset($_POST['submit'])) {
        $title = $_POST['title']; //mengambil nilai dari form dan di masukan ke dalam variabel
        $content = $_POST['content'];
        $author = $_SESSION['name'];
        $date = date('Y-m-d');

        $insert = "INSERT INTO blog (title, content, author, date) VALUES ('$title', '$content', '$author', '$date') "; //membuat query untuk di input
        if($con->query($insert) === TRUE ){ //chek apakah ada error di query $insert
            echo 'Berhasil Menambah Artikel';
        }else{ //jika ada error maka tampilkan error
            echo "Error: " , $insert . "<br>" . $con->error;
        }
        $con->close(); //menghentikan koneksi database
    }
}else{ //klo blom login ke sini suruh login dulu
    echo 'Silahkan Login Terlebih dahulu <br>';
    echo '<a href="index.php">Login</a>';
}
?>