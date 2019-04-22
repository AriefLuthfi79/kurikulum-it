# Topik 1: Konsep MVC (Models Views Controllers) Pattern

## Prasyarat
- Peserta didik telah memahami class
- Peserta telah mampu membuat website menggunakan php native prosedural

## Kompetensi
- Dapat memahami konsep MVC
- Mampu mengelompokkan setiap sifat dari class kedalam Model atau Controller
- Memahami kegunaan view

## Materi

### MVC Pattern

Model-View-Controller atau MVC adalah sebuah metode untuk membuat sebuah aplikasi dengan memisahkan data (Model) dari tampilan (View) dan cara bagaimana memprosesnya (Controller). Dalam implementasinya kebanyakan framework dalam aplikasi website adalah berbasis arsitektur MVC. MVC memisahkan pengembangan aplikasi berdasarkan komponen utama yang membangun sebuah aplikasi seperti manipulasi data, antarmuka pengguna, dan bagian yang menjadi kontrol dalam sebuah aplikasi web.

Singkat nya silahkan pahami gambar ini:

![](assets/images/php/mvc-pattern.jpg)

Pengertian singkat kepanjangan MVC:
- Model, yaitu bagian kode aplikasi yang berhubungan dengan basis data.
- View, yaitu bagian kode yang berhubungan dengan tampilan ke pengguna.
- Controller, yaitu bagian kode yang menghubungkan antara Model dan View.

### Alur kerja metode MVC

Alur kerja aplikasi web kita ketika user mengunjungi salah satu halaman yaitu:

- Browser berhubungan dengan server untuk akses halaman.
- Request (permintaan) browser ditangani oleh bagian Controller dari kode kita.
- Controller akan melakukan pemanggilan ke Model untuk mendapatkan data yang relevan, dan kemudian mempersiapkan data tersebut untuk ditampilkan.
- Controller memberikan data yang diperlukan kepada view.
- View menampilkan data dan berbagai elemen antarmuka tambahan yang diperlukan.

## Meta

Kata kunci:
- MVC paradigm
- diagram UML (Unified modeling language)

Tautan terkait:
- [MVC](https://medium.freecodecamp.org/model-view-controller-mvc-explained-through-ordering-drinks-at-the-bar-efcba6255053)

## Latihan

