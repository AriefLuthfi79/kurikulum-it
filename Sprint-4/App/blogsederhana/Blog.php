<?php
require_once('Config.php');  //configurasi database
session_start();
class Blog extends Config{

    public function blog_index(){

        $data = "SELECT * FROM blog"; //select data
        $blogs = $this->connect()->query($data); //select data
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
                    <small>
                        penulis : <i><?php echo $blog['author'] ?></i> || <i><?php echo $blog['date'] ?></i>
                        <?php 
                        if(isset($_SESSION['status'])){
                            ?>
                            || <a style="color:red;" href="blog_delete.php?id=<?php echo $blog['id']; ?>">Delete</a>
                            || <a href="blog_edit.php?id=<?php echo $blog['id'];?>" style="color:green;" href="">Edit</a>  
                            <?php
                        }
                        ?>                      
                    </small>
                    
                </div>
                <?php
            }
        }else{
            echo '<h2>Tidak ada Artikel</h2>';
        }
    }

    public function blog_create()
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
        
            if (isset($_POST['submit'])) {
                $title = $_POST['title']; //mengambil nilai dari form dan di masukan ke dalam variabel
                $content = $_POST['content'];
                $author = $_SESSION['name'];
                $date = date('Y-m-d');
        
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

    public function blog_delete($id){
        $sql = "DELETE FROM blog WHERE id=$id";

        if (mysqli_query($this->connect(), $sql)) {
            return header('Location: index.php');
        } else {
            echo "Error deleting record: " . mysqli_error($this->connect());
        }
        
    }

    public function blog_edit($id){
        if(isset($_POST['simpan'])){
            
            $title = $_POST['title'];
            $content = $_POST['content'];
            $sql = "UPDATE blog SET title='$title', content='$content' WHERE id='$id'";

            if(mysqli_query($this->connect(),$sql)){
                header('Location: index.php');
            }else{
                echo "Error Edit record: " . mysqli_error($this->connect());
            }
        }
    }
}