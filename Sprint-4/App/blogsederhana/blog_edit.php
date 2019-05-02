<?php 
require_once('Blog.php'); 
$blog = new Blog();

$id = $_GET['id'];
$show = mysqli_query($blog->connect(),"SELECT * FROM blog WHERE id='$id'");

if(mysqli_num_rows($show) == 0){
    echo 'Data tidak di temukan';
}else{
    $data = mysqli_fetch_assoc($show);
}
?>
<h1>Edit Artikel</h1>
<form action="#" method="post">
    <label for="">Judul</label>
    <input type="text" name="title" value="<?php echo $data['title'];?>">
    <br>
    <label for="">Artikel</label>
    <textarea name="content" id="" cols="30" rows="10"><?php echo $data['content'];?></textarea>
    <br>
    <input type="submit" name="simpan" value="simpan">
</form>
<?php 
$blog->blog_edit($id);
?>