# Topik 1: Database

## Prasyarat

## Kompetensi

## Materi
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
