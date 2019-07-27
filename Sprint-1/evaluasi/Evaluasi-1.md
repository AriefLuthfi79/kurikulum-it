**1. Diberikan sebuah variabel yang berisikan bilangan integer dengan
ketentuan angka 0(nol) dalam variabel tersebut merupakan pemisah
antara satu bilangan dengan bilangan lainnya. Bilangan-bilangan tersebut
akan dipisah dan diurutkan berdasarkan angka di bilangan-bilangan itu
sendiri. Setelah itu, bilangan hasil sort akan digabung kembali dengan
tanpa pemisah dengan output berupa bilangan integer.
(clue: gunakan array_helper dan string helper yang bisa membuat string jadi array).**

`Ketentuan :`
* Buatlah function nya dalam menyeleksi angka dibawah ini

***contoh***

```php
<?php

function selectionValue(string $collectionValue): int {
  // Code kalian
}
```

**`Contoh Input`**
```
5956560159466056
```
**`Contoh Output`**
```
55566914566956
```
---

**2. Ditentukan data larik santri seperti di bawah ini. Dari data satri tersebut buatlah**

**`Contoh Larik(Array) pada variabel`**
```php
<?php

$students = [
  [
    'name' => (Harus Dinamis)
    'nik'  => (Harus Dinamis)
    'jurusan' => (Harus Dinamis)
    'divisi' => (Harus Dinamis)
  ]
];
```

* daftar santri dengan minat 'Backend'
* jumlah satri berusia kurang dari 25
* santri paling muda.

**`Input`**
```bash
Selamat Datang Di Program Input Data

Data yang ingin diinputkan : 2

Masukkan data 1
Nama : Udin
NIK : TOO1
Jurusan : Programmer
Divisi : Backend
Usia : 74

Masukkan data 2
Nama : Umair
NIK : TOO3
Jurusan : Multimedia
Divisi : Graphic Design
Usia : 19
```

**`Output`**

```bash
Yang minat sebagai Backend adalah Udin
Usia yang kurang dari 25 adalah Umair
Usia Paling muda adalah Umair
```
