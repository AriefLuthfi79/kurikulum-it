# Topik 1: Database

## Prasyarat
- Santri Telah menyelesaikan Sprit 2

## Kompetensi
- Mengetahui struktur basisdata, mesin penyimpan, table, dan tipe data
- Mengetahui tipe data, indexing key, dan auto-increment
- Dapat mengelola (create, update, drop) database dan table

## Materi

### Apa itu SQL ?
SQL adalah bahasa standar untuk mengakses dan memanipulasi basis data.
- SQL adalah singkatan dari Structured Query Language
- SQL memungkinkan Kita mengakses dan memanipulasi basis data
- SQL menjadi standar American National Standards Institute (ANSI) pada 1986, dan Organisasi Internasional untuk Standardisasi (ISO) pada 1987

### Apa yang bisa dilakukan SQL ?
- SQL dapat menjalankan query terhadap basis data 
- SQL dapat mengambil data dari database 
- SQL dapat menyisipkan data dalam database 
- SQL dapat memperbarui data dalam database 
- SQL dapat menghapus data dari database
- SQL dapat membuat database baru 
- SQL dapat membuat tabel baru dalam database 
- SQL dapat membuat prosedur tersimpan dalam database 
- SQL dapat membuat tampilan dalam database 
- SQL dapat mengatur izin pada tabel, prosedur, dan tampilan


### Menggunakan SQL pada Website
Untuk membangun situs web yang menampilkan data dari database, Kita memerlukan :
- Program basis data RDBMS (mis. MS Access, SQL Server, MySQL) 
- Untuk menggunakan bahasa skrip sisi server, seperti PHP atau ASP 
- Untuk menggunakan SQL untuk mendapatkan data yang Anda inginkan Untuk menggunakan HTML / CSS untuk menata halaman

### RDBMS
RDBMS adalah singkatan dari Sistem Manajemen Database Relasiona

RDBMS adalah dasar untuk SQL, dan untuk semua sistem basis data modern seperti MS SQL Server, IBM DB2, Oracle, MySQL, dan Microsoft Access.

Setiap tabel dipecah menjadi entitas yang lebih kecil yang disebut field.
Field dalam tabel Pelanggan terdiri dari PelangganID, Nama Pelanggan, Nama Kontak, Alamat, Kota, Kode Pos dan Negara. Field adalah kolom dalam tabel yang dirancang untuk menyimpan informasi spesifik tentang setiap entitas dalam tabel.

Entitas, juga disebut baris, adalah setiap entri individu yang ada dalam tabel. Misalnya, ada 91 entitas di tabel pelanggan di atas.

### Database
```bash
$ mysql -u root -p
```

Perintah manipulasi database
```sql
-- Membuat database app_pondok
CREATE DATABASE `app_pondok`;

-- Menghapus basisdata app_pondok
DROP DATABASE `app_pondok`;
```

Perintah membuat tabel baru bernama `santri` di dalam basisdata `app_pondok` dengan kolom `id`, `name`, dan `birth_date`.
```sql
-- 
USE app_pondok;
CREATE TABLE `santri` (
  `id` INT AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `birth_date` DATE,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;
```
## Meta
- Kata kunci:
  1. 
  2. 

- Tautan:
  1. [Example Site](http://site.example)

## Latihan
1. 
