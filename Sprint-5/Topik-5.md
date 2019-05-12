# Topik 5: Menggunakan Autoloader standar dengan *Composer*

## Prasyarat
- Peserta didik mampu memanfaatkan autoloader tanpa composer
- Peserta telah mengimplementasikan autoloader pada pertemuan sebelumnya
- Peserta didik menggunakan composer sebagai lingkungan kerja

## Kompetensi
- Dapat menggunakan autoload standar dengan **composer**
- Dapat memahami autoload standar dengan **composer**

## Materi

### Autoloading dengan Composer

Sekarang kita sudah tahu tentang cara membuat `autoloader` sederhana dan
standar PSR-4. Lalu apakah kita perlu membuat `autoloader` sendiri ? Bisa saja,
namun `autoloader` yang kita buat belum tentu memenuhi standar yang
dipakai komunitas internasional baik dari sisi penulisan kode, kestabilan, dan
kompatibilitasnya. Akan lebih baik jika kita memakai `autoloader` yang telah
dipakai secara luas seperti autoloader yang disediakan oleh **Composer**.

Kini dengan standar autoload milik composer, koding terasa lebih clean

### Membuat autoload composer

1. Buat project dengan directory sebagai berikut
![](assets/images/php/autoloader.png)


2. Jalankan composer init
![](assets/images/php/autoloader2.png)

3. Composer akan meng-generate file `composer.json`. Tambahkan baris yang berisi konfigurasi autoload di composer.json :
```json
{
    "name": "kodingkalaweekend/calculator",
    "description": "A simple PHP calculator",
    "type": "library",
    "authors": [
        {
            "name": "kodingkalaweekend",
            "email": "kodingkalaweekend@gmail.com"
        }
    ],
    "require": {},
    "autoload": {
        "psr-4": {
            "KodingKalaWeekend\\": "src/"
        }
    }
}
```

Mudahnya, kita ingin memberitahu composer bahwa kita me-mapping namespace KodingKalaWeekend dengan **src/** .

4. Jalankan perintah ```$ composer dump-autoload ```.

5. Calculator.php

```php
<?php

namespace KodingKalaWeekend\Calculator;

class Calculator
{
    public function add($a, $b)
    {
        $result = $a + $b;
        echo "Sum of {$a} and {$b} is {$result}\n";
    }
    public function substract($a, $b)
    {
        $result = $a - $b;
        echo "Substract of {$a} and {$b} is {$result}\n";
    }
    public function multiply($a, $b)
    {
        $result = $a * $b;
        echo "Multiply of {$a} and {$b} is {$result}\n";
    }
    public function divide($a, $b)
    {
        $result = $a / $b;
        echo "Divide of {$a} and {$b} is {$result}\n";
    }
}
```

6. Main.php . Jangan lupa untuk memanggil autoload yang sudah dibuat oleh composer
```php
<?php

require_once __DIR__ .'/vendor/autoload.php';

use KodingKalaWeekend\Calculator\Calculator;

$calculator = new Calculator();

$calculator->add(5, 3);
$calculator->substract(12, 21);
$calculator->multiply(9, 19);
$calculator->divide(15, 3);
```

7. Jalankan file **Main.php**.

## Wrapping up

Sebelum adanya autoloader yang standar, para php developer membuat class
autoloader masing-masing, namun
Dengan adanya autoloader pada composer yang sudah memiliki standar yang baik,
hal ini mendapat feedback positive bagi pegiat php.

## Meta

Kata kunci:
1. json (JavaScript Object Notation)
2. PSR-4

Tautan terkait:
- [PHP](http://php.net)
- [Medium](https://medium.com/koding-kala-weekend/autoloading-di-php-dan-implementasinya-menggunakan-psr-4-3005dd7a09e6)
- [PSR](https://www.php-fig.org/)

## Latihan
1. Buatlah suatu program sederhana yaitu tentang class Bangun Datar yang memanfaatkan autoloader PSR-4