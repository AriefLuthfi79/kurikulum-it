# Topik 4: Dependency Manager

## Prasyarat
- Santri mampu memanfaatkan Dependency Manager sebagai lingkungan kerja
- Composer telah terpasang pada masing-masing komputer santri


## Kompetensi
- Dapat menggunakan composer untuk menginstall third party library

## Materi

### Dependency Management (Composer)

Sebuah Dependency manager (atau Dependency management system atau sistem manajemen paket) adalah kumpulan perangkat untuk mengotomatisasi proses instalasi, upgrade (perbaikan), konfigurasi, atau menghapus paket perangkat lunak dari sebuah komputer menggunakan cara tertentu. Dependency manager biasanya menangani basis data dari ketergantungan perangkat lunak dan informasi versi untuk mencegah ketidakcocokan perangkat lunak dan kekurangan prasyarat perangkat lunak.


## Kegunaan

Intinya adalah :

Oke, katakanlah kamu ingin membuat code yang berfungsi untuk feature A, dan setelah minta petunjuk mbah google kamu menemukan code selanjutnya akan disebut library untuk feature A tersebut. lalu apa yang dilakukan?

Download library tersebut secara manual? dan masukkan dalam project yang sedang dibuat?

Bisa sih, tapi itu bukan hal bagus.
Kenapa bukan hal bagus?
Bayangkan dalam library tersebut ada `bug` dan bug tersebut sudah diperbaiki di kode asalnya, terus bagaimana jika dari code tersebut ada `feature` baru?
Download lagi?
Hapus library lama dan Copy & paste code baru?

Terus bagaimana jika code tersebut membutuhkan library lain untuk bisa bekerja (tergantung pada library lain)? hmmm…
Pekerjaan sepertinya sangat mudah tapi tentu akan memakan waktu.
Disinilah salah satu fungsi dari `composer`, yaitu sebagai `Dependency manager`. Kita hanya perlu mendefinisikan dependency (code yang dibutuhkan) dalam satu file dan biarkan composer mendownload file-file yang dibutuhkan.

### Instalasi Composer

* Download composer melalui official website nya [composer][1]
[1]: https://getcomposer.org/download/
* Ikuti step by step instalasi nya di website tersebut

## Meta

Kata kunci:
- dependency manager
- composer
- library third party

## Latihan
...

