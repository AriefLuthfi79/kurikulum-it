# Topik 1-2: Variabel dan Operator


## Prasyarat
- Santri telah menyelesaikan topik mukadimah PHP.

## Kompetensi
- Dapat mendeklarasikan variabel dan menggunakan ragam tipe data
- Dapat menggunakan operator aritmatika, dan penetapan
- Dapat menggunakan operator pembandingan dan logika
- Dapat memahami urutan pengutamaan operator


## Materi

### Deklarasi variabel
Apa itu variabel? Variabel dalam bahasa inggris _variable_ dari kata _vary_ berarti beragam atau berbeda dan _able_ akhiran yang bermakna dapat..., variabel dalam arti bebas adalah sesuatu dapat berbeda. Apanya yang berbeda? Adalah nilai dari isi variabel tersebut.

Variabel PHP dimulai tanda `$` diikuti nama variabel.
Nama variable yang sahih diawali dengan huruf atau garisbawah diikuti kombinasi huruf, angka, dan atau garisbawah.
Nama variable _case sensitive_.

### Tipe data
PHP memiliki 8 tipe data primitif, 5 diantaranya adalah:
- **Boolean**, merupakan nilai kondisi benar (`true`) atau salah (`false`).
- **Integer**, merupakan nilai bilangan tanpa koma desimal, contoh `1` atau `9`.
- **Float**, merupakan nilai bilangan dengan koma desimal, contoh `3,14`.
- **String**, merupakan rangkaian karakter yang dikurung tanda petik atau petikganda, contoh `'kata'` atau `"lema"`.
- **NULL**, merupakan nilai kosong tanpa isi. Istilah "hampa" mungkin lebih tepat memaknai tipe data ini.

Variable PHP dapat ditetapkan ulang nilainya dengan tipe data yang berlainan dan tipe data satu dapat diubah ke tipe data lainnya, ini disebut **type juggling**.

### Operator Aritmatika
Arithmetic operators are very intuitive, as you already know. Addition, subtraction, multiplication, and division (`+`, `-`, `*`, and `/`) do as their names say. Modulus (`%`) gives the remainder of the division of two operands. Exponentiation (`**`) raises the first operand to the power of the second. Finally, negation (`-`) negates the operand. This last one is the only arithmetic operator that takes just one operand.

### Operator Penetapan
`=`, `+=`, `-=`, `*=`

### Operator Pembandingan
Operasi pembandingan kebanyakan meneruskan hasil nilai boolean, yaitu `true` atau `false`.
 
Enam operator pembanding yang jamak digunakan antaranya:
 - sama dengan (`==`),
 - tidak sama dengan (`!=` atau `<>`),
 - lebih kecil (`<`),
 - lebih kecil sama dengan (`<=`),
 - lebih besar (`>`), dan
 - lebih besar sama dengan (`>=`).
 
Dan terdapat 1 operator khusus _spaceship_ (`<=>`), yang membandingkan kedua operan dan meneruskan nilai integer alih-alih boolean. Ketika membandingkan `a` dengan `b`, hasil akan `-1` jika `a` lebih kecil `b`, `0` jika `a` sama dengan `b`, dan `1` jika `a` lebih besar `b`.

Hati-hati dengan _type juggling_, operator pembanding tersebut di atas akan menyamakan tipe data kedua operan sebelum membandingkannya. Untuk memeriksa tanpa perubahan tipe data, gunakan operator identik (`===`) atau tidak identik (`!==`).

### Operator Logika
Logical operators apply a logic operation —also known as a binary operation— to its operands, returning a Boolean response. The most used ones are `!` (not), `&&` (and), and `||` (or). `&&` will return true only if both operands evaluate to true. `||` will return true if any or both of the operands are true. `!` will return the negated value of the operand, that is, `true` if the operand is `false` or `false` if the operand is `true`. 

### Pengutamaan Operator
| Operator                                 | Type           |
|------------------------------------------|----------------|
| `**`                                     | Aritmatika     |
| `++`, `--`                               | Penaik/Penurun |
| `!`                                      | Logika         |
| `*`, `/`, `%`                            | Aritmatika     |
| `+`, `-`                                 | Aritmatika     |
| `<`, `<=`, `>`, `>=`                     | Pembanding     |
| `==`, `!=`, `===`, `!==`                 | Pembanding     |
| `&&`                                     | Logika         |
| `||`                                     | Logika         |
| `=`, `+=`, `-=`, `*=`, `/=`, `%=`, `**=` | Penetapan      |


## Meta
Kata kunci:
- variable
- data types
- type juggling

Tautan:
- [PHP](http://php.net)


## Latihan
1. Buka CLI, buka sesi PHP interactive shell dengan perintah `php -a`. Jalankan baris per baris kode berikut, amati hasilnya:
```php
$_some_value = 'abc';
$1number = 12.3;
$som$signs% = '&^%';
$go_2_home = "ok";
$go_2_Home = 'no';
$isThisCamelCase = true;
```

2. Jalankan baris per baris kode berikut pada PHP interactive shell, amati hasilnya:
```php
$a = true;
$b = 'false';
$c = 4.5;
$d = 3;
$e = '2';
$f = 2;
$g = null;
var_dump($a);
var_dump($b);
var_dump((bool)$b);
var_dump($c);
var_dump((int)$c);
var_dump($d + $e);
var_dump($d . $e);
var_dump($c * $e);
var_dump($d > $e);
var_dump($e == $f);
var_dump($e === $f);
var_dump($g);
var_dump((bool)$g);
var_dump((int)$g);
```

3. Jalankan baris per baris kode berikut pada PHP interactive shell, amati hasilnya:
```php
var_dump(true && true);
var_dump(true && false);
var_dump(true || false);
var_dump(false || false);
var_dump(!false);
```

4. Sebuah persegi panjang ditentukan `panjang := 5` dan `lebar := 8`. Buatlah program dengan keluaran seperti di bawah ini, simpan dengan nama latihan-4.php dalam direktori ~/belajar/topik-1.
```
Panjang persegi: 5
Lebar persegi: 8

Luas persegi tersebut adalah: <hasil perhitungan>

5. Sebuah lingkaran ditentukan `diameter := 9`. Buatlah program untuk menghitung luas dan keliling lingkaran, simpan dengan nama latihan-5.php.

6. Ditentukan `suhu := 34` dalam satuan celsius. Buatlah program konversi suku ke dalam satuan kelvin, fahrenheit, dan reaumur, kemudian simpan dengan nama latihan-6.php.

7. Diketahui pola bilangan `n =: 0; r := 2`, `n := 1; r := 4`, `n := 2; r := 6` atau dituliskan dalam deret bilangan 2, 4, 6, 8, 10, ... . Dengan menggunakan program, tentukan nilai `r` jika `n` bernilai 5, 9, atau 19. Simpan berkas dengan nama latihan-7.php
