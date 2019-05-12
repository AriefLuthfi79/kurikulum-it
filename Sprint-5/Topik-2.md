# Topik 2: Menggunakan *`autoloader`*

## Prasyarat
- Santri telah memahami kegunaan `namespace` dengan baik
- Santri telah memahami konsep OOP pada materi sebelumnya
- Santri telah mampu mengimplementasikan `namespace`

## Kompetensi
- Dapat menggunakan `function` loader pada php
- Dapat memahami kegunaan autoloader itu sendiri
- Mengimplementasikan autoloader pada setiap tugas

## Materi

### Apa itu autoloader?

Dalam mengembangkan aplikasi PHP dengan pendekatan Object Oriented Programming atau OOP kita akan memuat class-class.
Tentu saja saat kita memanggil class tersebut, class tersebut sudah harus masuk memory untuk digunakan.
Pada contoh kali kita akan membuat class Kucing dan class Bebek.

`class Bebek` pada file **Bebek.php**

```php
<?php

class Bebek
{
    public $jml_kaki=2;

    public function getJmlKaki()
    {
        return $this->jml_kaki;
    }
}
```

`class Kucing` pada file **Kucing.php**

```php
<?php

class Kucing
{
    public $jml_kaki=4;

    public function getJmlKaki()
    {
        return $this->jml_kaki;
    }
}
```
---

Misal kita membuat program yang isinya:
```php
<?php

$bebekku = new Bebek;
$kucingku = new Kucing;

echo "Mencoba autoload";
```

Jika jalankan maka akan muncul tampilan error yang menunjukkan `class Bebek` tidak ditemukan.
Selanjutnya kita dapat mencoba membuat program yang lain misalnya

```php
<?php

include "Bebek.php";
include "Kucing.php";

$bebekku = new Bebek;
$kucingku = new Kucing;

echo "Mencoba autoload";
```

Bisa dipastikan bahwa source di atas dapat berjalan dengan baik karena menginclude kedua class di atas.

Tetapi ternyata masalah tidak sampai di sana.
Jika kita meengembangkan aplikasi, kemungkinan kita akan membuat class sebanyak ratusan hingga ribuan class dan kita harus membuat include hingga ribuan baris.
Nah di sini tentu akan banyak memakan tenaga dan sumber daya server.

### Menggunakan *`function __autoload`*

`__autoload` — Attempt to load undefined class

isi kode berikut di index.php:

```php
<?php

function __autoload($class){
  require_once($class.".php");
}
$bebek = new Bebek;
$kucing = new Kucing;

```

Dengan begini kita tidak perlu repot-repot `require_once` setiap nama `class`

### Menggunakan *`spl_autoload_register`*

fungsi `__autoload` memiliki kelemahan yaitu hanya ada satu autoloader yang bisa dipakai.
Ini akan menjadi masalah jika kita memiliki banyak class yang tersebar di directory yang berbeda dan semuanya ingin kita autoload.
Contohnya kita memiliki aplikasi yang memiliki struktur sebagai berikut :

```
-- Controller
   - ControllerA.php
   - ControllerB.php
-- Model
   - ModelA.php
   - ModelB.php
- Main.php
```


Bagaimana jika kita ingin memasang `__autoload` baik untuk class-class yang ada di controller dan class-class yang ada di model ? PHP mengakomodir kasus di atas dengan sebuah fungsi bernama `spl_autoload_register` dimana kita dapat mendaftarkan satu atau lebih fungsi autoloader.

Lihat contoh berikut (Main.php):

```php
<?php

function autoloadFoo($class)
{
    $file = "Foo/{$class}.php";
    if (is_readable($file)) {
        require $file;
    }
}

function autoloadBar($class)
{
    $file = "Bar/{$class}.php";
    if (is_readable($file)) {
        require $file;
    }
}
spl_autoload_register("autoloadFoo");
spl_autoload_register("autoloadBar");
$foo = new Foo();
$foo->someFunction();
$bar = new Bar();
$bar->anotherFunction();
```

Jalankan kode berikut dan perhatikan hasilnya.
Seperti yang kalian lihat class-class tersebut tetap dapat di autoload walaupun berada dalam directory yang berbeda.

### Wrapping up
`function __autoload` sangat berguna ketika kita ingin me*require* setiap
`class` tanpa menggunakan function tambahan seperti `function require` atau
`function include`, dengan begini kita dapat mengurangi effort kita dalam
meng`include`kan setiap `class`

## Meta

Kata kunci:
- `__autoload`
- autoloadding classes

Tautan:
- [PHP](http://php.net)
- [PHP autoload Best  Practices](http://ditio.net/2008/11/13/php-autoload-best-practices/)

## Latihan
1. Buatlah suatu class Bangun datar yang memanfaatkan autoloader manual