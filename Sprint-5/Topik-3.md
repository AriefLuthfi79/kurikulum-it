# Topik 3: Pengenalan PSR-4

## Prasyarat
- Composer telah terpasang pada masing-masing komputer santri
- Menggunakan composer sebagai lingkungan kerja
- Peserta didik telah mampu menggunakan `function __autoload` dengan baik
- Memahami konsep autoloadding pada `php`

## Kompetensi
- Dapat memahami aturan PSR-4
- Dapat menggunakan aturan PSR-4 pada lingkungan kerja

## Materi

### Standardisasi dengan PSR-4

Autoloading adalah ide yang bagus.
Tapi dampaknya adalah setiap orang memiliki caranya sendiri untuk melakukan autoload.
Untuk itu perlu dibuat sebuah standar bagi autoloader, dengan mengikuti aturan yang disebut dengan PSR-4 (Improvisasi dari PSR-0 yang telah deprecated,
awalnya standardisasi autoloader menggunakan PSR-0).
Adapun spesifikasi dari PSR-4 adalah [dapat dibaca disini](http://www.php-fig.org/psr/psr-4/).
Sedangkan contoh file autoloader yang telah diterima oleh standar PSR-4 dapat kita lihat [disini](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md).
Sekarang mari kita bedah spesifikasi yang ada pada PSR-4

> PSR-4 mewajibkan penggunaan Fully Qualified Class Name (FQCN) dan 
> memiliki top-level namespace atau vendor namespace

Namespace adalah fitur yang diperkenalkan di PHP 5.3.
Secara mudahnya, namespace adalah virtual directory yang merepresentasikan directory yang sebenarnya.
Sebuah FQCN terdiri dari sekumpulan namespace dan memiliki bentuk seperti ini :

```
\<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>
```

Semisal kita memiliki file-file dengan `namespace Vehicle\Car\Honda\Jazz`, `Vehicle\Car\Honda\HRV` dan `Vehicle\Car\Toyota\Yaris` maka diasumsikan project ini memiliki struktur directory :

```
-- Vehicle
   - Car
     - Honda
       - Jazz.php
       - HRV.php
     - Toyota
       - Yaris.php
```

Selain memenuhi standar FQCN,
PSR-4 juga mensyaratkan adanya top-level namespace atau “vendor” namespace yang biasanya mewakili pembuat package tersebut.

![](assets/images/php/psr-4.png)

Sebagai contoh, vendor KodingKalaWeekend memiliki sebuah package untuk membuat http request, maka pada file class dapat ditambahkan namespace

```php
<?php

// request.php
namespace KodingKalaWeekend\Http;

class Request
{
}
```

struktur directory-nya

```
-- KodingKalaWeekend
   - Http
     - Request.php
```

Lalu bagaimana jika ada vendor lain yang juga membuat class dengan nama
yang sama dan kita perlu memanggilnya di file secara bersamaan ? Solusinya
adalah dengan menggunakan `use` untuk aliasing :

contoh kode:

```php
<?php

namespace Foo;

use SMTP\Mailer as SMTPMailer;
use Mailgun\Mailer as MailgunMailer;

class Bar
{
    public function baz()
    {
      $smtpMailer = new SMTPMailer();
      $mailgunMailer = new MailgunMailer();
     }
}
```

Selain aliasing, use juga dapat digunakan untuk importing.

## Wrapping up
PSR merupakan aturan main pada php, tepatnya adalah sebagai senjata **best
practices** saat koding php. Terdapat banyak jenis-jenis PSR lainnya, namun kita
tidak akan membahas secara detail. Untuk mengetahui lebih banyak tentang psr
silahkan ke [link berikut ini](https://www.php-fig.org/psr/)

## Meta

Kata kunci:
- PSR
- Best Pratices learn programming language

Tautan terkait:
- [Medium](https://medium.com/koding-kala-weekend/autoloading-di-php-dan-implementasinya-menggunakan-psr-4-3005dd7a09e6)
- [PSR](https://www.php-fig.org/psr/)

## Latihan
...
