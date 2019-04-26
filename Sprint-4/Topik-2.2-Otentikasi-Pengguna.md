# Otentikasi user (2)

## Prasyarat

## Kompetensi
- Mengenal variabel cookie dan session
- Menggunakan cookie dan session untuk menyimpan informasi user
- Membuat otentikasi user sederhana dengan cookie dan session

## Materi
Session adalah cara untuk menyimpan informasi (dalam variabel) untuk digunakan di beberapa halaman. Tidak seperti cookie, informasi ini tidak disimpan di komputer user.

### Apa itu Session PHP?
Ketika Kita bekerja dengan suatu aplikasi, Kita membukanya, melakukan beberapa perubahan, dan kemudian Kita menutupnya. Ini seperti Session. Komputer tahu siapa Kita. Ia tahu kapan Kita memulai aplikasi dan kapan Kita berakhir. Tetapi di internet ada satu masalah: server web tidak tahu siapa Kita atau apa yang Kita lakukan, karena alamat HTTP tidak mempertahankan status Kita.

Variabel session menyelesaikan masalah ini dengan menyimpan informasi user untuk digunakan di beberapa halaman (misal. Nama user, warna favorit, dll). Secara default, variabel session bertahan hingga user menutup browser.

Jadi Variabel session menyimpan informasi tentang satu user tunggal, dan tersedia untuk semua halaman dalam satu aplikasi. Jika Kita membutuhkan penyimpanan permanen, Kita mungkin akan menyimpan datanya di dalam database.

### Membuat sebuah Session PHP
Session dimulai dengan fungsi `session_start()`. Variabel session ditetapkan dengan variabel global PHP: `$ _SESSION`.
Sekarang, mari kita buat halaman baru yang disebut `"demo_session1.php"`. Di halaman ini, kita memulai session PHP baru dan mengatur beberapa variabel session

```php
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
?>

</body>
</html>

//Fungsi session_start() harus menjadi yang pertama Sebelum ada tag HTML.
```
=======================================================
### Mengambil Nilai Session
Selanjutnya, kita membuat halaman lain yang disebut `"demo_session2.php"`. Dari halaman ini, kita akan mengakses informasi session yang kita atur di halaman pertama (`"demo_session1.php"`)
Perhatikan bahwa variabel session tidak diteruskan secara individual ke setiap halaman baru, melainkan diambil dari session yang kita buka di awal setiap halaman (`session_start()`)

Perhatikan juga bahwa semua nilai variabel session disimpan di dalam variabel `$ _SESSION` global

```php
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
?>

</body>
</html>
```
Cara lain untuk menampilkan semua nilai variabel session untuk session user adalah dengan menjalankan kode berikut

```php
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
print_r($_SESSION);
?>

</body>
</html>
```

 **Bagaimana cara kerjanya? Bagaimana dia tahu ini adalah kita ?**
`Sebagian besar session menetapkan key user di komputer user yang terlihat seperti ini : 765487cf34ert8dede5a562e4f3a7e12. Kemudian, ketika sebuah session dibuka di halaman lain, itu memindai komputer untuk key-user. Jika ada kecocokan, itu mengakses session itu, jika tidak, itu memulai session baru.`

======================================================

### Mengedit Varibel Session

Untuk mengubah variabel session, cukup overwrite saja.

```php
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// to change a session variable, just overwrite it 
$_SESSION["favcolor"] = "yellow";
print_r($_SESSION);
?>

</body>
</html>
```

==================================================================

### Destroy Session

Untuk menghapus semua variabel session global dan menghancurkan session, `gunakan session_unset()` dan `session_destroy()`

```php
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>

</body>
</html>
```

