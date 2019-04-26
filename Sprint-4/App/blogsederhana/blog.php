<?php
require_once('config.php'); //configurasi database
$data = "SELECT * FROM blog"; //select data
$blogs = $con->query($data); //select data
?>
<h1><i>Artikel Kita</i></h1> 
<?php

if ($blogs->num_rows > 0){ //check aapakah data kosong
    while($blog = $blogs->fetch_assoc()){ //mengambil data dan di ubah menjadi array
        ?>
        <div style="border: 1px solid #000; padding: 5%; margin-top: 3%">
            <h3><?php echo $blog['title'] ?></h3>
            <hr>
            <p><?php echo $blog['content'] ?></p>
            <br>
            <small>penulis : <i><?php echo $blog['author'] ?></i> || <i><?php echo $blog['date'] ?></i></small>
            
        </div>
        <?php
    }
}else{
    echo '<h2>Tidak ada Artikel</h2>';
}

?>

