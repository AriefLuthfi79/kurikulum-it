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

### Tipe data di SQL

https://www.w3schools.com/sql/sql_datatypes.asp 

### Auto Increment

Auto Increment memungkinkan angka unik yang akan dihasilkan secara otomatis ketika entitas baru dimasukkan ke dalam tabel.

Contoh Penggunaan

```sql
CREATE TABLE santri (
    id int NOT NULL AUTO_INCREMENT,
    LastName varchar(255) NOT NULL,
    FirstName varchar(255),
    Age int,
    PRIMARY KEY (id)
);
```


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

-- Rename Table
RENAME TABLE tb1 TO tb2;

-- DROP Table 
DROP TABLE table_name;
```

```sql

```


## Latihan
1. Buat database baru Bernama pondokit
2. Buat Table baru bernama santri di Database pondokit
3. Tambahkan field pada table di atas id, name, age, birth_place, birth_date, hobby. id harus auto increment, dan tipe data yang lain harus sesuai dengan kebutuhan.
4. Update Table menjadi siswa.
