# Berkenalan dengan Framework Laravel

## Materi

### Apa itu Laravel

Laravel adalah sebuah framework PHP dibangun dengan konsep MVC (model view controller). Laravel adalah pengembangan website berbasis MVC yang ditulis dalam PHP yang dirancang untuk meningkatkan kualitas pemeliharaan, dan untuk meningkatkan pengalaman bekerja dengan sintaks yang jelas, dan dapat menghemat waktu dalam membangun atau mengembangkan aplikasi berbasis web.

MVC adalah perangkat lunak yang memisahkan aplikasi logika dari presentasi. MVC memisahkan aplikasi berdasrkan komponen-komponen aplikasi seperti manipulasi data, controller, dan user interface.

Model, Model mewakili struktur data. Biasanya model berisi fungsi-fungsi yang membantu seseorang dalam pengelolaan basis data seperti memasukkan data ke basis data, pembaruan data dan lain-lain.
View, View adalah bagian yang mengatur tampilan ke pengguna. Bisa dikatakan berupa halaman web.
Controller, Controller merupakan bagian yang menjebatani model dan view.
Beberapa fitur yang tepat di Laravel:

``
Bundles, yaitu sebuah fitur dengan sistem pengemasan modular dan tersedia beragam di aplikasi.
Eloquent ORM, merupakan penerapan PHP lanjutan menyediakan metode internal dari pola “active record” yang menagatasi masalah pada hubungan objek database.
Application Logic, merupakan bagian dari aplikasi, menggunakan controller atau bagian Route.
Reverse Routing, mendefinisikan relasi atau hubungan antara Link dan Route.
Restful controllers, memisahkan logika dalam melayani HTTP GET and POST.
Class Auto Loading, menyediakan loading otomatis untuk class PHP.
View Composer, adalah kode unit logikal yang dapat dieksekusi ketika view sedang loading.
IoC Container, memungkin obyek baru dihasilkan dengan pembalikan controller.
Migration, menyediakan sistem kontrol untuk skema database.
Unit Testing, banyak tes untuk mendeteksi dan mencegah regresi.
Automatic Pagination, menyederhanakan tugas dari penerapan halaman.
Nah, itu adalah beberapa penjelasan tentang Framework Laravel dan beberapa keunggulan dari Framework Laravel.
``

### Berkenalan dengan routing laravel

Laravel memiliki sebuah fitur yang digunakan untuk mendaftarkan semua URI yang bisa diakses oleh pengguna aplikasi berdasarkan respon dari HTTP verb. Nah fitur inilah yang dinamakan route.

Gimana sih? Masih gak paham nih. Okay, okay.. Akan aku jelaskan dengan contoh. Biasanya kamu kalau ingin membuat website dengan menggunakan bahasa pemrograman PHP kamu akan membuat sebuah file dengan ekstensi **.php** di dalam /var/www/public atau di htdocs.

![](assets/images/php/tes.png)

Contohnya, saya mempunyai sebuah file dengan nama index.php di dalam sebuah folder dengan nama folder belajar-php di dalam sebuah htdocs. File tersebut berisi:

```php

<?php
 echo "Hello world";
```

Gimana cara kamu melihat hasilnya di browser?

![](assets/images/php/hello.png)

Tada, kamu tinggal akses saja URL dengan cara memanggil nama folder dan file index.php-nya.

Okay, lalu kalau di Laravel seperti apa? Aku memiliki sebuah project dengan nama belajar-routing-web-di-laravel pada Desktop.


![](assets/images/php/tes2.png)

Di dalam project Laravel dengan nama belajar-routing-web-di-laravel ini kita cari folder dengan nama route. Di dalam folder route ini ada file dengan nama web.php.

![](assets/images/php/route1.png)

Untuk menampilkan sebuah tulisan “Hello Word” kamu tinggal mengubah isi file web.php menjadi seperti gambar di bawah ini.

![](assets/images/php/tes3.png)

Okay selanjutnya, kamu jalankan service website dengan menggunakan perintah artisan seperti pada gambar di bawah ini.

![](assets/images/php/command.png)

Sekarang kamu buka browser dan akses halaman http://localhost:8000/ hasilnya akan seperti gambar di bawah ini.

![](assets/images/php/result.png)

Kalian sudah mempraktikan cara membuat routing web di Laravel. Jadi, sekarang kalian sudah tahu perbedaan membuat tampilan “Hello Word” dengan menggunakan PHP Native dan Framework Laravel. Bagaimana? Lebih mudah di Laravel bukan? Kamu tidak perlu membuat file baru. Hanya tinggal menambahkan URI pada route Laravel.

Oh, iya. Ketika kamu melihat isi folder route pada project Laravel. Kamu akan menemukan 4 buah file, yaitu: console.php, api.php,web.php, dan channels.php. Apa sih perbedaan dari keempat file tersebut?


**routes/console.php**

File ini digunakan untuk membuat routing command yang berjalan di terminal. Jadi selain perintah artisan yang sudah di sediakan oleh Laravel, kita juga bisa membuat perintah artisan ala-ala kita sendiri. Contohnya:

![](assets/images/php/console.png)

Ketika kamu menjalankan perintah di bawah ini pada terminal:

``
php artisan version
``

Hasilnya akan seperti pada gambar di bawah ini.

![](assets/images/php/resultconsole.png)


**routes/api.php**

File ini digunakan untuk membuat routing API. Yap, kita juga bisa membuat core service API dengan menggunakan Laravel.

**routes/web.php**

File ini digunakan untuk membuat routing web biasa.

**route/channels.php**

File ini digunakan untuk membuat routing yang bersifat broadcasting event, seperti notification.

Selama beberapa materi dasar ke depan, kita hanya akan fokus pada satu file, yaitu web.php.

### Route Dasar

Selanjutnya kita akan coba pahami tentang penulisan route dasar pada Laravel. Lihat gambar di bawah ini.

![](assets/images/php/routeslg.png)


Keterangan:
``
- Area berwarna merah pada gambar di atas merupakan method yang diizinkan untuk menjalankan fungsi pada route.
- Area berwarna biru pada gambar di atas merupakan alamat URI yang ingin diakses untuk menjalankan sebuah fungsi pada route.
- Area berwarna oranye pada gambar di atas merupakan callback function yang akan dijalankan ketika suatu URI diakses dengan method yang sesuai dengan method route yang digunakan.
``

### Route Berparameter
Saat kita membuat sebuah URI, terkadang kita perlu mengambil sebuah parameter yang merupakan bagian segmen dari URI yang kita buat.

Contoh kasus:

Aku ingin mengambil nilai angka 1 yang ada pada URI. Karena angka 1 merupakan nilai dari halaman yang ingin aku tampilkan pada halaman website.

Aku akan menambahkan sebuah route berparameter seperti di bawah ini di dalam file web.php.

```php
Route::get('/halaman/{page}', function ($page) {
    return "Halo, kamu sedang mengakses halaman ".$page;
});
```
Setelah ditambahkan. Kita simpan. Sekarang coba kita cek dengan menjalankan web service Laravel.

``php artisan serve``

Selanjutnya coba kamu akses URL seperti pada gambar di bawah ini.

![](assets/images/php/url.png)

Ketika kamu mengganti akses URL seperti pada gambar di bawah ini.

![](assets/images/php/url2.png)

Tampak bahwa nilai angka di belakang tulisan halaman berubah sesuai dengan nilai parameter yang dimasukan pada URI. Apa jadinya kalau nilai parameter itu tidak dimasukan?

![](assets/images/php/url3.png)

Page tidak dapat ditemukan. Mengapa demikian? Route berparameter mewajibkan nilai parameter untuk diisi. Bisa tidak dibuat opsional, boleh diisi atau tidak? Tentu bisa. Ini akan di bahas pada materi selanjutnya.


### Route Berparameter Opsional
Terkadang kita mungkin perlu menentukan parameter route, tetapi parameter ini bersifat opsional, boleh diisi atau boleh kosong. Kita dapat melakukannya dengan menempatkan “?” setelah nama parameter dan menambahkan nilai default pada parameter fungsi.

Aku akan menambahkan sebuah route berparameter opsional seperti di bawah ini di dalam file web.php.

```php
Route::get('/halaman-optional/{page?}', function ($page=1) {
    return "Halo, kamu sedang mengakses halaman ".$page;
});
```

Setelah ditambahkan. Kita simpan. Sekarang coba kita cek dengan menjalankan web service Laravel.

``php artisan serve``

Selanjutnya coba kamu akses URL seperti pada gambar di bawah ini.

![](assets/images/php/url4.png)

Nah, meski nilai parameter tidak kita tambahkan pada URI, halaman tetap bisa diakses dengan menampilkan nilai parameter secara default. Sekarang bagaimana jika nilai parameter kita isi?

![](assets/images/php/url5.png)

Tadaaaaa… Nah, sekarang kamu sudah bisa menggunakan route berparameter opsional untuk kebutuhan aplikasi kamu.

### Method Yang Tersedia Pada Route Laravel

Method apa saja sih yang tersedia pada Route Laravel? Ada 6 jenis method yang bisa digunakan pada route Laravel untuk merespon HTTP verb, antara lain:

```php
Route::get( $uri, $callback );
Route::post( $uri, $callback );
Route::put( $uri, $callback );
Route::patch( $uri, $callback );
Route::delete( $uri, $callback );
Route::options( $uri, $callback );
```
Contoh penggunaan masing-masing route di atas akan kita praktekan pada materi selanjutnya ya.

