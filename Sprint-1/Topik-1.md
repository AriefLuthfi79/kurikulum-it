# Topik 1-1: Mukadimah PHP


## Prasyarat
- Santri menggunakan Linux sebagai lingkungan kerja
- PHP parser engine telah terpasang pada komputer santri


## Kompetensi
- Mengetahui tentang pseudo-code
- Mengetahui tentang bahasa PHP
- Membuat program sederhana dengan bahasa PHP


## Materi

### Pseudo-code
Sebelum menginjakkan kaki ke bahasa programan, ada baiknya kita mengetahui tentang kode-palsu atau lebih akrab disebut pseudo-code.

Pseudo-code memungkinkan perancang untuk fokus pada logika dari algoritma tanpa terganggu dengan rincian sintaksis bahasa pemrograman.
Pseudo-code biasanya digunakan ketika merencanakan implementasi suatu algoritma yang bersifat spesifik, utamanya algoritma yang masih belum begitu dikenalinya.

Pseudo-code menggunakan bahasa umum, namun saat ini hampir mendekati struktur bahasa pemrograman kebanyakan. Contoh penulisan pseudo-code sebagai berikut:
```
SET totalPendapatan = 0
SET ongkos = 15000
SET batasMuatan = 12 penumpang

JIKA jumlahPenumpang > batasMuatan MAKA
    Tampilkan pesan kelebihan muatan
LAINNYA
    Tampilkan pesan aman
AKHIR-JIKA

KETIKA jumlahPenumpang < jumlahKursi
    Tambahkan 1 penumpang dari antrian
AKHIR-KETIKA

UNTUK masing-masing penupang
    tambahkahkan ongkos ke dalam totalPendapatan
```

### PHP
PHP (recursive acronym for PHP: Hypertext Preprocessor) merupakan bahasa skrip sumber terbuka yang serbaguna dan digunakan secara luas terlebih cocok untuk pengembangan web dan dapat disisipkan dalam HTML.

### Berkas PHP
Berkas PHP dinamai dengan akhiran ektensi _.php_, di dalam berkas dapat ditulis apapun, misal campur dengan kode HTML. Blok kode PHP diawali dengan `<?php` dan diakhiri dengan `?>`. Jika berkas hanya berisi kode PHP,  `?>` tidak perlu ada diakhir kode.

### Kode Perdana
Kode berikut ini biasanya menjadi kode perdana mempelajari suatu bahasa.
```php
<?php

echo 'Halo dunia!';
```

Kata kunci (_keyword_) `echo` digunakan untuk mengeluarkan tampilan (mencetak), dalam kode ini mencetak teks `Halo dunia!`. Pada kode tersebut tidak ditemukan akhiran `?>` karena kode tersebut seluruhnya PHP. Kode berikut ini contoh kode PHP yang disematkan, kali ini dalam teks polos.
```php
Bismillah.

<?php
echo 'Halo dunia!';
?>

Suatu saat ku kan meninggalkanmu.
```

## Meta
1. Kata kunci:
   - pseudo-code
   - tentang php

2. Tautan:
   - [Pseudocode standard](http://users.csc.calpoly.edu/~jdalbey/SWE/pdl_std.html)
   - [Artikel Wikipedia tentang PHP](https://id.wikipedia.org/wiki/PHP)
   - [What is PHP?](http://id1.php.net/manual/en/intro-whatis.php)
   - [PHP: printf\(\)](http://id1.php.net/manual/en/function.printf.php)

## Latihan
1. Buka aplikasi shell (CLI), periksa versi PHP parser engine terinstal pada komputer masing-masing dengan perintah `php -v`.

2. Periksa lokasi berkas _executable binary_ PHP dengan menjalankan perintah `which php`.

3. Dengan menggunakan shell, buatlah direktori 'belajar/topik-0' di dalam direktori `home`. Kemudian _current directory_ ke direktori tersebut.

4. Buatlah berkas PHP yang berisi baris kode di bawah ini dan simpan dengan nama latihan-3.php. Jalankan berkas tesebut dalam CLI dengan perintah `php latihan-3.php`.
```php
<?php

echo 'Halo dunia!';
```
5. Buatlah berkas PHP yang berisi baris kode di bawah ini, simpan dengan nama latihan-4.php,dan jalankan.
```php
Bismillah.

<?php
echo 'Halo dunia!';
?>

Suatu saat ku kan meninggalkanmu.
```
6. Ekplorasi kata kunci pencetakan `printf`.
