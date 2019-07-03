# Topik 3-3 : Normalisasi dan Relasi Data

## Prasyarat
- Santri Telah menyelesaikan Topik Manipulasi Rekam Data
## Kompentensi
- Mengetahui bentuk relasi 1:1, 1:n, dan n:m
- Mengetahui normalisasi 1st, 2nd, dan 3rd normal form
- Mengetahui tentang foreign-key
- Dapat merancang struktur table dengan 3rd normal form
- Dapat mengelola butir data dengan perintah join dan sub-select

## Materi

### Realis 1:1
Relasi one to one adalah relasi dimana setiap satu baris data pada tabel satu hanya berhubungan dengan satu baris data di tabel dua. Artinya masing - masing hanya memiliki satu hubungan saja. Biasanya relasi seperti ini digunakan pada relasi pengguna dan userlogin. Dimana satu pengguna hanya memiliki satu akun untuk login. dan satu akun login hanya dimiliki oleh pengguna.

### Realis 1:n
Relasi one to many adalah relasi yang mana setiap baris dari tabel pertama dapat dihubungkan dengan satu baris ataupun lebih dari tabel kedua. Artinya satu baris dari tabel pertama dapat mencangkup banyak data pada tabel kedua. Disini saya contohkan seperti dosen dan mata kuliah. Kita tahu bahwa dosen bisa memiliki banyak mata kuliah yang dia ampu. Namun satu mata kuliah hanya bisa diampu oleh satu dosen saja.

### Relasi n:m

Relasi many to many adalah keadaan dimana satu baris dari tabel satu dapat berhubungan dengan tabel kedua. Dan satu baris dari tabel kedua dapat berhubungan dengan banyak baris dari tabel pertama. Artinya kedua tabel masing - masing dapat mengakses banyak data dari tiap tabel yang lain. Dalam hal ini, kita membutuhkan tabel ketiga sebagai perantara tabel satu dan tabel dua sebagai tempat untuk menyimpan foreign key dari masing - masing tabel. Disini saya memberikan contoh barang dan penjualan. Tentu saja setiap satu jenis barang bisa dijual berkali - kali. Dan satu penjualan bisa mencangkup banyak barang.

### Normaslisasi
Tahapan Normalisasi Database:

1. Unnormalized Form (UNF)
Merupakan bentuk tidak normal berdarsarkan data yang diperoleh dan mengandung kerangkapan data.

2. First Normal Form (1NF)
Entitas yang atributnya memiliki tidak lebih dari satu nilai untuk contoh tunggal entitas tersebut.

3. Second Normal Form (2NF)Entitas yang atribut non-primary key-nya hanya tergantung pada full primary key.

4. Third Normal Form (3NF)Entitas yang atribut non-primary key-nya tidak tergantung pada atribut nonprimary key yang lain.

### Foreign Key
Foreign Key adalah kunci yang digunakan untuk menghubungkan dua tabel bersama. Foreign Key adalah field (atau kumpulan field) dalam satu tabel yang mengacu pada Primary Key dalam tabel lain.

### JOIN
JOIN digunakan untuk menggabungkan baris dari dua atau lebih tabel, berdasarkan kolom terkait di antara mereka.

```sql
SELECT table_name1.id, table_name2.name, table_name3.Date
FROM table_name3
INNER JOIN table_name2 ON table_name3.tablename3ID = table_name2.tablename2ID;

//Contoh
SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
FROM Orders
INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;
```

## Latihan
1. Buatlah Database yang mempunyai relasi 1:1, 1:n, n:m.
2. Buatlah Table-tabel 1NF, 2NF, 3NF Dalam 1 database.
3. Tampilkan Table soal no 2 menggunakan JOIN.
