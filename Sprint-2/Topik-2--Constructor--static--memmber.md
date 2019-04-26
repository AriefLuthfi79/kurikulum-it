# Topik 2-2: Constructor dan Static Member

## Prasyarat
- Santri telah meneyelesaikan Topik Pengenalan OOP dan Class

## Kompetensi
- Mendeklarasikan constructor method pada class
- Mengenal static class member
- Menerapkan static class member untuk menyelesaikan masalah pemrograman

## Materi

### Constructor
Constructor adalah sebuah fungsi umum seperti fungsi lainnya. Yang membedakan dari Constructor adalah fungsi ini akan di jalankan pertama kali ketika class object di buat. Adapun cara membuat Constractor kita harus menambahhkan underscore ( `__` ) sebanyak dua kali lalu di ikuti nama fungsi `construct`. 

```php
class hewan{

    public function __construct(){
        echo 'Singa Mengaung';
    }

}

$binatang = new hewan;

```

Contructor juga dapat di isi parameter sama halnya dengan fungsi biasa

```php
class hewan{

    public function __construct($suara){
        echo $suara;
    }

}

$binatang = new hewan('Singa Mengaung ');
$ternak = new hewan(' Kambing memamkan Rumput hijau');

```

### Static
Static adalah cara memanggil fungsi atau properti tanpa membuat objek sebelumnya. Jika sebelumnya ketika memanggil fungsi harus mendeklarasikan `new` untuk membuat objek, itu tidak di perlukan lagi jika menggunakan static.

```php
class hewan{
    static $kambing = 'Kambing memakan rumput'; //membuat vaiable static

    public static function singa(){ //membuat function static
        echo 'Singan Mengaung';
    }

}

hewan::singa(); //menggunakan function static
echo hewan::$kambing(); //menggunakan varibale static
```

## Latihan
1. Buatlah construct function yang mengembalikan nilai string `Selamat Datang ` dan mempunyai parameter nama, ketika object di buat akan menampilkan `Selamat Datang (Nama Kalian)`

2. Buatlah Class yang mempunyai sebuah function static rumus persegi panjang dengan 2 parameter $panjang dan $tinggi. Lalu panggiil function static di luar class dengan 2 parameternya.