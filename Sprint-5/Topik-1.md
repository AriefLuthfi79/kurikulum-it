# Topik 1: Pengenalan namespace pada PHP

## Prasyarat
- Santri menggunakan Linux sebagai lingkungan kerja
- Santri telah memahami konsep OOP dengan baik

## Kompetensi
- Dapat menggunakan namespace dengan baik
- Dapat memahami kegunaan namespace

## Materi

### Penggunaan `namespace`
Pertanyaan yang paling mendasar adalah : Apakah namespace itu ?

> Mari kita bayangkan namespace sebagai sebuah kabinet.
> Masing-masing laci kabinet tersebut sudah ada
> pemiliknya. Kita dapat menaruh apapun ke dalam laci
> kabinet tersebut; pensil, penghapus, apapun.
> Namun orang lain juga dapat menaruh barang yang identik di lacinya sendiri.
> Lalu bagaimana cara kita dapat membedakan kalau barang ini milik kita atau milik orang lain ?
> Caranya adalah kita memberi label untuk masing-masing laci yang ada di kabinet tersebut
> untuk menandai bahwa barang yang ada di laci tersebut milik siapa.

### Sejarah penggunaan `namespace`

Kurang lebih begitulah cara kerja namespace.
Sejarahnya bermula saat orang-orang ingin membagikan kodenya agar dapat dipakai oleh orang banyak.
Namun yang terjadi selanjutnya adalah munculnya konflik karena penamaan class yang sama, sedang di PHP, nama class harus unik.
Jadi ketika kita memakai third party library yang memiliki class User , kita tidak bisa membuat class dengan nama User juga.
Awalnya orang-orang mengakalinya dengan menambahkan underscore sehingga penamaan class menjadi sangat panjang.
Namun untunglah sejak versi 5.3, PHP telah mendukung penggunaan namespace.
Namespace sendiri dapat kita kategorikan menjadi 2 yaitu global namespace dan relative namespace.

### Jenis-jenis `namespace`

#### Global namespace

Global namespace sendiri sebenarnya hanya sebuah istilah untuk “class tanpa
deklarasi namespace” atau normal class. Dan global namespace ini tanpa sadar
telah kita gunakan sehari-hari.

```php
<?php
class Rain
{

}
```
---
```php
<?php

include('Rain.php');
$rain = new Rain();
```

---

Jalankan kode berikut dan perhatikan hasilnya.

#### Relative namespace

Sekarang kita akan mencoba beralih ke relative namespace. Kita tambahkan file baru bernama **Sunny.php**

```php
<?php
namespace NiceWeather;

class Sunny
{
}
```
---

Perhatikan bahwa ada tambahan namespace NiceWeather;sebelum deklarasi class. Lalu kita ubah file forecast.php dan menjalankannya lagi

---
```php
<?php

include('Rain.php');
include('Sunny.php');
$rain = new Rain();
$sunny = new Sunny();
```

Sekarang php akan mengembalikan error karena class Sunny tidak ada. Bukankah kita sudah memanggilnya dengan include('Sunny.php') ?

Kembali kita harus mengingat perumpamaan namespace dengan lemari kabinet tadi.
Ketika kita akan mengambil barang dari luar kabinet, maka kita perlu tahu di laci mana barang itu disimpan.
Namun jika kita sudah tahu dan membuka laci tersebut, maka kita bebas mengambil barang apapun yang ada di dalamnya, asal masih di laci kabinet yang sama dengan yang kita buka tadi.
Hal ini juga berlaku pada namespace.
Dengan adanya deklarasi namespace, maka kita dapat memanggil sebuah class dengan syarat :

- Class tersebut berada di namespace yang sama.
- Kita memanggil class tersebut lengkap dengan namespacenya.

Kita akan coba langkah ke-2 terlebih dahulu. Kita ganti pemanggilan class Sunny
sehingga menjadi:
```php
<?php

include('Rain.php');
include('Sunny.php');
$rain = new Rain();
$sunny = new NiceWeather\Sunny();
```

Lalu jalankan forecast.php

Sekarang kita akan menambah 2 file lagi : `Storm.php` dan `Fair.php`. Dua file tersebut berada di `namespace` yang berbeda.
`class` *Storm* berada di namespace BadWeather sedangkan `class` *Fair* berada di namespace yang sama dengan `class` *Sunny* yaitu *NiceWeather* .
Yang akan kita lakukan disini adalah kita akan mencoba memanggil `class` *Sunny* dan `class` *Storm* dari dalam `class` *Fair*.

```php
<?php
// Storm.php

namespace BadWeather;

class Storm
{
}
```

---

```php
<?php
// Fair.php

namespace NiceWeather;

include('Storm.php');
include('Sunny.php');

class Fair
{
    public function __construct()
    {
        $storm = new Storm;
        $sunny = new Sunny;
    }
}
```

---

Kita ubah forecast.php menjadi

```php
<?php

include('Fair.php');
$fair = new NiceWeather\Fair();
```

Dan kita jalankan kembali forecast.php. Hasilnya

![](assets/images/php/psr-4.png)

Perhatikan error yang diberi garis merah diatas.
Penyebabnya adalah ketika class Fair yang ada di dalam `namespace NiceWeather` memanggil `class Storm`,
PHP secara otomatis menganggap `class Storm` berada pada `namespace` yang sama.
Oleh karena itu, warning diatas berbunyi `Class NiceWeather\Storm not found`.
Sedangkan `class Sunny` tidak melemparkan error karena `class Sunny` berada dalam `namespace` yang sama dengan `class Fair`.
Inilah alasan mengapa `class` dengan deklarasi `namespace` disebut dengan relative `namespace` karena jika kita memanggil `class` lain tanpa mengawalinya dengan `namespace` tertentu,
maka PHP akan menganggap `class` yang dipanggil berada dalam `namespace` yang sama dengan `class` yang memanggil.

Lalu apa yang terjadi jika `class` yang ada di relative `namespace` memanggil `class` yang di global `namespace` ?
Kita akan contohkan dengan memanggil `class Rain` di dalam `class Sunny`.

```php
<?php
// Fair.php

namespace NiceWeather;

include('Rain.php');

class Fair
{
    public function __construct()
    {
        $rain = new \Rain;
    }
}
```

Yup, kita hanya perlu menambahkan awalan \ pada nama class yang dituju.
Begitu pula ketika kita ingin memanggil class yang ada di namespace lain,
maka kita wajib menambahkan \ sebelum mendeklarasikan namespace.
Contohnya, kita ingin memperbaiki error Class NiceWeather\Storm not found diatas,
maka alih-alih menulis

```php
$storm = new BadWeather\Storm();
```

yang akan dikenali PHP sebagai NiceWeather\BadWeather\Storm, maka kita tulis sebagai

```php
$storm = new \BadWeather\Storm();
```

agar PHP mengartikannya sebagai “naik ke global namespace,
lalu masuk ke namespace lainnya”.
Penambahan `\` hanya berlaku jika kita ada di relative namespace.
Jika kita telah berada di global namespace,
maka kita tidak perlu menambahkan `\`.

### Use untuk importing dan aliasing

Berikut adalah sebuah namespace yang sangat panjang :

```
A\Namespace\So\Long\That\You\Have\Forgotten\About\It
```

---

Kalau kita mengikuti kaidah Fully Qualified Name, maka nama yang ada di
paling ujung sebelah kanan merupakan nama class yaitu `It`.
Bayangkan alangkah capeknya jika tiap kali kita memanggil `class It` kita harus
mendeklarasikan namespace yang begitu panjang.
Disini use hadir untuk menolong. Kita dapat menggunakan use untuk import sebuah namespace ke namespace lain.
Mari kita lihat contoh berikut :

```php
<?php

namespace Foo;

use A\Namespace\So\Long\That\You\Have\Forgotten\About\It;

class Bar
{
    private $it;

    public function __construct()
    {
        $this->it = new It();
    }
}
```

Alih-alih kita menuliskan

```php
$this->it = \A\Namespace\So\Long\That\You\Have\Forgotten\About\It();
```

untuk memanggil class It, kita hanya perlu menuliskan

```php
$this->it = new It();
```

Selain itu, use juga dapat digunakan untuk aliasing. Aliasing dapat
digunakan untuk menyingkat atau memberi nama lain kepada namespace.
Misal kita memiliki banyak class dibawah 1 vendor

```
Koding\Blog\Post\Create;
Koding\Blog\Post\Update;
Koding\Blog\Post\Delete;
```

Kita dapat memberi alias pada namespace tersebut. Contohnya

```php
<?php

namespace Foo;

use Koding\Blog\Post as Post;

class Content
{
    private $create;
    private $update;
    private $delete;

    public function __construct()
    {
        $this->create = new Post\Create();
        $this->update = new Post\Update();
        $this->delete = new Post\Delete();
    }
}
```

Selain itu alias juga berguna saat kita memanggil 2 class dengan nama yang sama (tapi berbeda vendor) disaat bersamaan. Contoh :

```php
<?php

use MySql\Connection as MySql;
use Postgres\Connection as Postgres;

$mysql_connection = new MySql();
$postgres_connection = new Postgres();
```

### Pertanyaan-pertanyaan terkait `namespace`

P : Apakah Namespace memiliki batasan kedalaman ?

J : Tidak. Kita bisa membuat sub-namespace sepanjang / sedalam yang kita mau
seperti Ini\Adalah\Namespace\Yang\Sangat\Panjang.

P : Apakah namespace harus sesuai dengan directory file yang sesungguhnya ?

J : Tidak. Namespace tidak harus mengikuti susunan directory file.
Bahkan bisa saja dalam 1 file terdapat beberapa namespace yang berbeda.

## Meta

Kata kunci:
- `namespace`
- *alias*
- `use`

Tautan terkait:

- [PHP](http://php.net)
- [Medium](https://medium.com/koding-kala-weekend/penjelasan-lengkap-tentang-namespace-di-php-ab356b44c34)

## Latihan
...
