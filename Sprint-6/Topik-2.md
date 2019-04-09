# Topik 2: Pengenalan Autoloader

## Prasyarat
- Peserta didik telah mamahami konsep sebuah class

## Kompetensi
- Dapat memahami konsep autoloader
- Dapat memahami fungsi-fungsi autoloader yang ada pada php

## Materi

### Autoloader

Bagi yang mengimplementasikan OOP ketika koding PHP, pasti tidak asing dengan implementasi pemanggilan class di file yang berbeda. Biasanya file yang berisi class tersebut dipanggil menggunakan require atau include. Contohnya :

```php
<?php

include('Foo.php');
include('Bar.php');

$foo = new Foo();
$foo->someFunction();

$bar = new Bar();
$bar->anotherFunction();

```
Namun dengan semakin berkembangnya aplikasi yang kita buat, kita memerlukan sebuah cara agar file-file class yang kita punya bisa terorganisir dengan baik. Selain itu, semakin modular fungsi-fungsi yang kita punya, maka kebutuhan untuk memanggil class di file yang berbeda akan semakin besar. Ada kalanya kita perlu memanggil lebih dari 10 class yang berbeda ketika kita ingin mengerjakan sebuah fitur. Adakah cara agar kita tidak perlu menulis include atau require berulang kali ? Ternyata, kita bisa memanfaatkan salah satu magic method yang ada di PHP yaitu `__autoload`. Berikut adalah contoh pemakaian `__autoload` untuk memuat file-file yang berisi class secara otomatis. Kali ini kita akan mencoba untuk memanggil 2 class yaitu Foo dan Bar via `__autoload`.

---

```php
<?php

class Foo
{
    public function someFunction()
    {
        echo "Calling ". __FUNCTION__ ."() in class ". __CLASS__ ."\n";
    }
}
```
---

```php
<?php

class Bar
{
    public function anotherFunction()
    {
        echo "Calling ". __FUNCTION__ ."() in class ". __CLASS__ ."\n";
    }
}
```
---

```php

<?php

function __autoload($class)
{
    $file = $class . ".php";
    if (is_readable($file)) {
        require $file;
    }
}
$foo = new Foo();
$foo->someFunction();
$bar = new Bar();
$bar->anotherFunction();
```
---

Silahkan eksekusi kode diatas dan perhatikan hasilnya.

Dengan memakai `__autoload`, kita tidak perlu lagi meng-include-kan file berisi class satu persatu, namun cukup dengan menginstansikan class dan PHP secara otomatis akan mengenali nama class dan mencari file yang memiliki nama yang sama dengan class tersebut. `is_readable()` diperlukan untuk memastikan file tersebut ada dan memiliki hak akses untuk dapat dibaca oleh script yang memanggilnya.

Walaupun begitu, fungsi `__autoload` memiliki kelemahan yaitu hanya ada satu autoloader yang bisa dipakai. Ini akan menjadi masalah jika kita memiliki banyak class yang tersebar di directory yang berbeda dan semuanya ingin kita autoload. Contohnya kita memiliki aplikasi yang memiliki struktur sebagai berikut :

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

Jalankan kode berikut dan perhatikan hasilnya. Seperti yang kalian lihat class-class tersebut tetap dapat di autoload walaupun berada dalam directory yang berbeda.

## Meta

Kata kunci:
- `__autoload`
- `spl_autoload_register`

Tautan:
- [PHP](http://php.net)
- [medium](https://medium.com/koding-kala-weekend/autoloading-di-php-dan-implementasinya-menggunakan-psr-4-3005dd7a09e6)
