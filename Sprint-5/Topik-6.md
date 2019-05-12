# Topik 6: Menggunakan Library

## Prasyarat
- Peserta didik mampu menggunakan library pihak ketiga menggunaka composer
- Peserta didik mampu membaca dokumentasi cara pemakaian library tersebut

## Kompetensi
- Dapat menggunakan library yang diinstall menggunakan dependency manager (Composer)
- Dapat mengetahui cara pemakaian library tersebut
- Dapat memahami kegunaan library tersebut

## Materi

### Perintah instalasi library pada composer
Untuk mengetahui apa saja perintah yang dapat dilakukan dengan composer
```bash
$ composer --help
# Lihat perintah apa saja yang ada dicomposer
```

Contoh penggunaan library menggunakan composer

Jalankan perintah berikut di terminal untuk instalasi package Carbon

Oh iya, library yang saya gunakan ini bernama carbon.
Library ini sangat berguna untuk DateTime lebih **readable**

```bash
$ composer require nesbot/carbon
```

Setelah proses selesai, silahkan cek masing-masing file `composer.json`

```json
{
    "require": {
        "nesbot/carbon": "^2.11"
    }
}
```
Seperti yang kalian lihat file composer.json terdapat object bernama require dan
value object adalah nama dari package carbon itu sendiri. Dan ketika kita telah
menginstall package tersebut composer secara otomatis membuat directory
`vendor/` yang dimana folder tersebut berisi package library yang kita install
tadi.

### Menggunakan Library composer

Buat file index.php di folder root, isi kode berikut:
```php

<?php

require_once __DIR__ . '/vendor/autoload.php'; // load semua class yg ada pada folder
vendor

use Carbon\Carbon;

print_r("Now : " . Carbon::now());
```

eksekusi script tersebut `$ php index.php`

### Wrapping up

Carbon merupakan library datetime yang sering digunakan saat ini, karena
**code**nya yang `readable` dan mudah digunakan.

## Meta

Kata kunci:
- Carbon datetime
- composer
- json

Tautan:
- [PHP](http://php.net)
- [Github](https://github.com/briannesbitt/Carbon)

## Latihan
1. Buatlah suatu program sederhana yang menggunakan package manager
