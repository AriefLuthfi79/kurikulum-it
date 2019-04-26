# Topik 3-2 : Manipulasi Rekam Data

## Prasyarat

## Kompetensin
- Dapat mengelola butir data dengan perintah select,  insert, update, delete
- Dapat mengelola butir data dengan perintah where, order, limit
- Dapat mengelola butir data dengan perintah count, aggreation, group, having


## Materi

### Insert
Pernyataan Insert di gunakan untuk menyisipkan data baru ke dalam table. 

```sql
INSERT INTO table_name(column1, colum2, ...) VALUE ('nilai1','nilai2', ...);

//Contoh
INSERT INTO app_pondok(name,date) VALUE ('Muhammad','31-01-2001');
```
### Select 
Pernyataan SELECT di gunakan untuk memilih data dari database. Data yang di kembalikan disimpan dalam table hasil.

```sql
SELECT column1, column2, ...
FROM table_name;

//Contoh
SELECT name FROM app_pondok;
```

### Update
Pernyataan UPDATE di gunakan untuk mengubah data pada table.

```sql
UPDATE table_name
SET column1 = value1, column2 = value2, ...
WHERE condition;

//Contoh
UPDATE app_pondok
SET name = 'Muhammad Rasyid', date = '01-01-2001'
WHERE id = 3;
```

### Delete
Peryataan DELETE di gunakan untuk menghpus data pada table.

```sql
DELETE FROM table_name WHERE column_name = 'value'

//Contoh menghapus data nama Muhammad Rasyid
DELETE FROM app_pondok WHERE name = 'Muhammad Rasyid'
```

### Order By

Kata kunci ORDER BY digunakan untuk mengurutkan hasil-set dalam urutan naik atau turun. Kata kunci ORDER BY mengurutkan catatan dalam urutan naik secara default. Untuk mengurutkan catatan dalam urutan menurun, gunakan kata kunci DESC.

```sql
SELECT column1, column2, ...
FROM table_name
ORDER BY column1, column2, ... ASC|DESC;

//Contoh urutan naik
SELECT * FROM app_pondok
ORDER BY name;
//Contoh urutan turun
SELECT * FROM app_pondok
ORDER BY name DESC;
```

###  Limit

Limit adalah pernyataan yang di gunakan untuk membatasi data yang di tampilkan
```sql
SELECT * FROM app_pondok
LIMIT 3;
//Hanya menampilkan 3 data dari seluruh data yang ada
```

### Count
Fungsi COUNT () mengembalikan jumlah baris yang cocok dengan kriteria yang ditentukan.

```sql
SELECT COUNT(column_name)
FROM table_name;

//Contoh
SELECT COUNT(id)
FROM app_pondok;
```

### Aggreation
Fungsi AVG () mengembalikan nilai rata-rata kolom angka.

```sql
SELECT AVG(column_name)
FROM table_name;

//Contoh
SELECT AVG(umur)
FROM app_pondok;
```

### Group

Pernyataan GROUP BY sering digunakan dengan fungsi agregat (COUNT, MAX, MIN, SUM, AVG) untuk mengelompokkan hasil-set dengan satu atau beberapa kolom.
```sql
SELECT COUNT(column_name), column_name
FROM table_name
GROUP BY column_name;

//Contoh
SELECT COUNT(id), umur
FROM app_pondok
GROUP BY umur;
```

### Having
HAVING ditambahkan ke SQL karena kata kunci WHERE tidak dapat digunakan dengan fungsi Aggreation atau AVG().
```sql
SELECT COUNT(column_name), column_name
FROM table_name
GROUP BY column_name
HAVING COUNT(column_name) > 5;

//Contoh
SELECT COUNT(id), umur
FROM app_pondok
GROUP BY umur
HAVING COUNT(id) > 5;
```
## Latihan
1. Buatlah database baru dengan nama `pondokit` mempunyai table_name `santri` dengan column_name `id`, `name`, `age`, `divisi`.
2. Insert data pada database yang sudah di buat sebanyak 20 data (age maximal 25 dan minimal 15).
3. Select data dengan id ke 13.
4. Update value data dengan id ke 17 menjadi `Ahsan S`, `23`, `Programmer`.
5. Delete data dengan id ke 19, lalu insert 5 data baru.
6.  Tampilkan data  dengan mengurutkan age menggunakan order by descending dan  escending, lalu batasi data yang tampil hanya 15 data.
7. Hitung seluruh data yang ada, hitung juga rata ratanya.
8. Tampilkan group data berdasarkan umur santri.
