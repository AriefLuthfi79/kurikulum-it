# PHP untuk Aplikasi Web

## Prasyarat

## Kompetensi
- Dapat menjalankan program PHP dalam web server
- Mengenal user input dengan verb GET dan POST
- Dapat memanfaatkan user input dalam pemrograman web
- Dapat membuat program web sederhana

## Materi

### Method POST dan GET
Method POST dan GET adalah method yang di gunakan untuk mengambil nilai form yang di input.Perbedaan di keduanya adalah method GET akan menampilkan data yand di kirim ke URL sedangkan method POST tidak.Method POST data yang dikirim tidak terbatas. Sedangkan method GET tidak boleh lebih dari 2047 karakter.

```php
//POST
<form method="POST" action="action.php">
    <input type="text" name="nama">
    <input type="text" name="alamat">
</form>

//Cara mengambil Nilai
$data = $_POST['nama'];
$data = $_POST['alamat'];


//GET
<form method="GET" action="action.php">
    <input type="text" name="nama">
    <input type="text" name="alamat">
</form>

//Cara mengambil Nilai
$data = $_GET['nama'];
$data = $_GET['alamat'];
```