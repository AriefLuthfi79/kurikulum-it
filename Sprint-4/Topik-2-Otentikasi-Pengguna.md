# Otentikasi Pengguna (1)

## Prasyarat

## Kompetensi
- Mengenal variabel cookie dan session
- Menggunakan cookie dan session untuk menyimpan informasi pengguna
- Membuat otentikasi pengguna sederhana dengan cookie dan session

## Materi

### Cookie
Cookie sering digunakan untuk mengidentifikasi pengguna. Cookie adalah file kecil yang ditanamkan server di komputer pengguna. Setiap kali komputer yang sama meminta halaman dengan browser, itu akan mengirim cookie juga. Dengan PHP, Kita dapat membuat dan mengambil nilai cookie.

Cookie dibuat dengan fungsi `setcookie()`.

```php
setcookie(name, value, expire, path, domain, secure, httponly);
//Hanya parameter name yang diperlukan. Semua parameter lain bersifat opsional.
```

### PHP Membuat / Mengambil Cookie

Contoh berikut membuat cookie bernama "pengguna" dengan nilai "John Doe". Cookie akan kedaluwarsa setelah 30 hari (86400 * 30). "/" Berarti bahwa cookie tersedia di seluruh situs web (jika tidak, pilih direktori yang Kita inginkan).

Kita kemudian mengambil nilai cookie "pengguna" (menggunakan variabel global `$_COOKIE`). Kita juga menggunakan fungsi `isset()` untuk mengetahui apakah cookie sudah di set.

```php
//Contoh
<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html>

//Fungsi setcookie () harus muncul SEBELUM tag <html>.
```
Nilai cookie secara otomatis URLencode ketika mengirim cookie, dan secara otomatis di decode ketika diterima (untuk mencegah URLencoding, gunakan `setrawcookie()` sebagai gantinya).

=========================================

### Ubah Nilai Cookie
Untuk memodifikasi cookie, cukup set (lagi) cookie menggunakan fungsi setcookie ()
```php
<?php
$cookie_name = "user";
$cookie_value = "Alex Porter";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html>
```

=======================================
### Hapus Cookie
Untuk menghapus cookie, gunakan fungsi setcookie () dengan tanggal kedaluwarsa di masa lampau

```php
<?php
// set the expiration date to one hour ago
setcookie("user", "", time() - 3600);
?>
<html>
<body>

<?php
echo "Cookie 'user' is deleted.";
?>

</body>
</html>
```

============================================
### Memeriksa apakah Cookie Sudah Diaktifkan
Contoh berikut membuat skrip kecil yang memeriksa apakah cookie diaktifkan. Pertama, coba buat cookie pengujian dengan fungsi setcookie (), lalu hitung variabel array $ _COOKIE

```php
<?php
setcookie("test_cookie", "test", time() + 3600, '/');
?>
<html>
<body>

<?php
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}
?>

</body>
</html>
```
