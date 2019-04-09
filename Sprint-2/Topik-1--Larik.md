# Topik 2-1: Larik

## Prasyarat

## Kompetensi

## Materi

### Tipe data array

Array (dalam bahasa Indonesia disebut larik) adalah 1 dari 8 tipe data primitif dalam PHP. Array merupakan barisan pasangan kunci (_key_) dan nilai (_value_). Array dapat diciptakan dengan susunan bahasa `array()` yang berisi pasangan `key => nilai` dipisahkan dengan koma. Tipe data yang diterima untuk key hanya string dan integer.
```php
$studentInfo = array(
    'Aqlan A. Tirta', // tanpa key
    'division' => 'PHP Backend',
    'sex' => 'M',
    'age' => 7,
    // ...dst
);
// atau untuk PHP 5.4 ke atas dapat digunakan []
$studentInfo = [
    'Aqlan A. Tirta', // tanpa key
    'division' => 'PHP Backend',
    'sex' => 'M',
    'age' => 7,
    // ...dst
];
```

### Mengisi array

Elemen baru yang diisikan ke dalam array akan diletakkan pada akhir larik.
```php
$studentInfo['status'] = 'training';
$studentInfo['hobbies'] = ['membaca', 'mancing']; 
$studentInfo['hobbies'][] = 'main bola';

var_dump($studentInfo);
```

Untuk menghapus elemen dari array gunakan `unset()`.
```php
unset($studentInfo['status']);
```

array_push($animals, 'Dog');
Selanjutnya tentang `array_pop`, `array_shift`, dan `array_unshift`;

## Meta
- Kata kunci:
  1. abc

- Tautan:
  1. [Example Site](http://site.example)

## Latihan
1. Ditentukan data nilai santri sebagai berikut, 5, 9, 6, 7, 9, 8, 10, 7, 8. Carilah mean, median, modus, dan simpangan baku dari data tersebut.

2. Dari latihan 1, buat variable `highest` yang berisi larik 3 nilai tertinggi dan variable `lowest` yang berisi larik 3 nilai terendah.

3. Ditentukan data larik santri dengan nomor induk satri digunakan sebagai _key array_ seperti tersebut di bawah ini. Dari data satri tersebut buatlah a) daftar satri berdasar nomor induk kecil ke besar, b) daftar satri berdasar nama besar ke kecil, dan c) siapakah santri urutan terakhir berdasar nama.
```php
$students = [
    'IT-001' => 'Ridwan',
    'IT-010' => 'Achmad',
    'IT-005' => 'Yusuf',
    'IT-002' => 'Arief',
    'IT-004' => 'Dayat',
    'IT-017' => 'Lutfi',
];
```

4. Ditentukan data larik santri seperti tersebut di bawah ini. Dari data satri tersebut buatlah a) daftar satri berdasar nomor induk kecil ke besar, b) daftar satri berdasar nama kecil ke besar, dan c) daftar santri dengan minat 'PHP Backend', d) jumlah satri berusia kurang dari 25, e) rerata usia santri, dan f) santri paling muda.
```php
$students = [
    [
        'id' => 'IT-001',
        'name' => 'Ridwan',
        'division' => 'PHP Backend',
        'age' => 25,
    ],
    [
        'id' => 'IT-010',
        'name' => 'Achmad',
        'division' => 'Java for Android',
        'age' => 23,
    ],
    [
        'id' => 'IT-005',
        'name' => 'Yusuf',
        'division' => 'ReactJS',
        'age' => 22,
    ],
    [
        'id' => 'IT-002',
        'name' => 'Arief',
        'division' => 'PHP Backend',
        'age' => 21,
    ],
    [
        'id' => 'IT-004',
        'name' => 'Dayat',
        'division' => 'React Native',
        'age' => 21,
    ],
    [
        'id' => 'IT-017',
        'name' => 'Lutfi',
        'division' => 'ReactJS',
        'age' => 18,
    ],
];
```

5. Dari soal nomor 4, buatlah table data santri urut berdasarkan divisi dengan tampilan keluaran seperti tersebut di bawah ini.
```bash
| ID     | Nama       | Divisi      | Usia |
|--------|------------|-------------|------|
| IT-XXX | Ibnu Fulan | Nama Bidang | 99   |
| ...    | ...        | ...         | 99   |
```
