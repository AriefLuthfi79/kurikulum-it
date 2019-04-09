# Topik 1-3: Percabangan dan Perulangan


## Prasyarat
- Santri telah menyelesaikan topik variabel dan operator

## Kompetensi
- Dapat menggunakan struktur percabangan ganda (benar/salah)
- Dapat menggunakan struktur percabangan banyak kondisi
- Dapat menggunakan operator penaik/penurun
- Dapat menggunakan struktur perulangan

## Materi

### Percabangan ganda
Keyword `if` dan `else`

### Pecabangan banyak kondisi
Keyword `elseif` dan `switch` (`case`, `break`, `default`)

### Operator penaik/penurun
Dalam bahasa inggris dikenal dengan nama increment/decrement. Banyak digunakan pada kasus perulangan.

`++` `--`

### Perulangan dengan `while` dan `for`
Loops in PHP are used to execute the same block of code a specified number of times. PHP supports following four loop types.
- `while`, loops through a block of code if and as long as a specified condition is true.
- `do-while`, loops through a block of code once, and then repeats the loop as long as a special condition is true.
- `for`, loops through a block of code a specified number of times.

Terdapat satu lagi tipe perulangan `foreach` yang akan dibahas pada topik selanjutnya.

#### `while`
Contoh:
```php
$i = 1;
while ($i <= 10) {
    echo $i . ', ';
    $i++;
}
```

#### `do-while`
Contoh:
```php

do {
    echo $i . ', ';
} while ()
```

### Kendali perulangan dengan `continue` dan `break`
Keyword `continue` dan `break` digunakan untuk mengendalikan pelaksanaan perulangan.


## Meta
Kata kunci:
- php conditional
- php ternary
- php loops

Tautan:
- [PHP](http://php.net)


## Latihan
1. Diketahui pola bilangan `n =: 0; r := 0`, `n := 1; r := 3`, `n := 2; r := 4` dan seterusnya atau dituliskan dalam deret bilangan 0, 3, 4, 9, 8, 15, 12, 21, ... . Dengan menggunakan program, tentukan nilai `r` jika `n` bernilai 7, 10, 19, atau 20. Simpan berkas dengan nama latihan-1.php dalam direktori ~/belajar/topik-2.

2. Ditentukan variabel `n := 9`, dengan menggunakan `while` buatlah program dengan keluaran yang tersebut di bawah ini. Simpan dengan nama latihan-2.php.
```
0 2 4 6 8 10 12 14 16
```

3. Ditentukan variabel `n := 9`, dengan menggunakan `for` dan `continue` buatlah program dengan keluaran yang tersebut di bawah ini. Simpan dengan nama latihan-3.php.
```
1 3 5 7
```

4. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-4.php.
```
1 3 5 7 9 11 13 15 17
```

5. Buatlah program dengan keluaran yang tersebut di bawah ini, simpan dengan nama latihan-5.php.
```
1
1 2
1 2 3
1 2 3 4
1 2 3 4 5
```

5. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-5.php.
```
(0,0)(0,1)(0,2)(0,3)(0,4)(0,5)(0,6)(0,7)(0,8)
(1,0)(1,1)(1,2)(1,3)(1,4)(1,5)(1,6)(1,7)(1,8)
(2,0)(2,1)(2,2)(2,3)(2,4)(2,5)(2,6)(2,7)(2,8)
(3,0)(3,1)(3,2)(3,3)(3,4)(3,5)(3,6)(3,7)(3,8)
(4,0)(4,1)(4,2)(4,3)(4,4)(4,5)(4,6)(4,7)(4,8)
(5,0)(5,1)(5,2)(5,3)(5,4)(5,5)(5,6)(5,7)(5,8)
(6,0)(6,1)(6,2)(6,3)(6,4)(6,5)(6,6)(6,7)(6,8)
(7,0)(7,1)(7,2)(7,3)(7,4)(7,5)(7,6)(7,7)(7,8)
(8,0)(8,1)(8,2)(8,3)(8,4)(8,5)(8,6)(8,7)(8,8)
```

6. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-6.php.
```
 -  -  -  -  -  -  -  -  -
 +  +  +  +  +  +  +  +  +
 -  -  -  -  -  -  -  -  -
 +  +  +  +  +  +  +  +  +
 -  -  -  -  -  -  -  -  -
 +  +  +  +  +  +  +  +  +
 -  -  -  -  -  -  -  -  -
 +  +  +  +  +  +  +  +  +
 -  -  -  -  -  -  -  -  -
```

7. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-7.php.
```
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
 +  -  +  -  +  -  +  -  +
```

8. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-8.php.
```
 +  -  -  -  -  -  -  -  -
 -  +  -  -  -  -  -  -  -
 -  -  +  -  -  -  -  -  -
 -  -  -  +  -  -  -  -  -
 -  -  -  -  +  -  -  -  -
 -  -  -  -  -  +  -  -  -
 -  -  -  -  -  -  +  -  -
 -  -  -  -  -  -  -  +  -
 -  -  -  -  -  -  -  -  +
```

9. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-9.php.
```
 -  -  -  -  -  -  -  -  +
 -  -  -  -  -  -  -  +  -
 -  -  -  -  -  -  +  -  -
 -  -  -  -  -  +  -  -  -
 -  -  -  -  +  -  -  -  -
 -  -  -  +  -  -  -  -  -
 -  -  +  -  -  -  -  -  -
 -  +  -  -  -  -  -  -  -
 +  -  -  -  -  -  -  -  -
```

10. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-10.php.
```
 +  -  -  -  -  -  -  -  +
 -  +  -  -  -  -  -  +  -
 -  -  +  -  -  -  +  -  -
 -  -  -  +  -  +  -  -  -
 -  -  -  -  +  -  -  -  -
 -  -  -  +  -  +  -  -  -
 -  -  +  -  -  -  +  -  -
 -  +  -  -  -  -  -  +  -
 +  -  -  -  -  -  -  -  +
```


11. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-11.php.
```
 +  -  -  -  -  -  -  -  -
 +  +  -  -  -  -  -  -  -
 +  +  +  -  -  -  -  -  -
 +  +  +  +  -  -  -  -  -
 +  +  +  +  +  -  -  -  -
 +  +  +  +  +  +  -  -  -
 +  +  +  +  +  +  +  -  -
 +  +  +  +  +  +  +  +  -
 +  +  +  +  +  +  +  +  +
```

12. Buatlah program dengan variabel `n := 9` dengan hasil keluaran yang tersebut di bawah ini, simpan dengan nama latihan-12.php.
```
 -  -  -  -  -  -  -  -  +
 -  -  -  -  -  -  -  +  +
 -  -  -  -  -  -  +  +  +
 -  -  -  -  -  +  +  +  +
 -  -  -  -  +  +  +  +  +
 -  -  -  +  +  +  +  +  +
 -  -  +  +  +  +  +  +  +
 -  +  +  +  +  +  +  +  +
 +  +  +  +  +  +  +  +  +
```
