# Topik 2-2: Fungsi

## Prasyarat
- Santri telah menyelesaikan topik Larik (Array)
## Kompetensi

## Materi
PHP memiliki banyak (1000 lebih) fungsi bawaan, contohnya `array_push`, `strlen`, `pow`, dll. Selain fungsi bawaan PHP, kita juga dapat membuat fungsi sendiri. Adapun karakteristik fungsi adalah:
- kumpulan pernyataan yang dipanggil berulang dalam sebuah program,
- fungsi tidak dipanggil seketika program dimuat,
- fungsi dijalankan ketika ada pemanggilan fungsi.

Mendefiniskan fungsi diawali dengan kata kunci `function`:
```php
function contohFungsi($parameter) {
    var_dump($parameter);
}

// memanggil fungsi
contohFungsi('ini argument');
```
Pada contoh di atas kita membuat fungsi bernama `contohFungsi` dengan parameter `$parameter`. Kemudian melakukan pemanggilan fungsi dengan menyertakan argumen berupa string `ini argumen`.

> Parameter adalah variabel dalam deklarasi fungsi:
> ```
> functionName(parameter) {
>    // lakukan sesuatu
> }
> ```
> Argumen adalah nilai dari variabel yang dikirim ke fungsi
> ```
> functionName(argumen);
> ```

### Argumen Fungsi
Fungsi merupakan blok tertutup, untuk melewatkan informasi ke dalama fungsi kita menggunakan definisikan argumen fungsi.
```php
$santriName = 'Abdulghani';

function printBadGreeting()
{
    echo 'Halo ' . $santriName; // PHP Notice: Undefined variable
}

function printGreeting($name)
{
    echo 'Halo ' . $name;
}

function printGoodGreeting(string $name): void
{
    echo 'Halo ' . $name;
}
```
Deklarasi fungsi seperti pada contoh fungsi `printGoodGreeting` lebih direkomendasikan. Untuk mencegah kesalahan program, argumen dapat ditentukan tipe datanya yang disebut _type hint_. Mungkin perlu pembiasaan pada awalnya, namun kedepannya akan sangat membantu menulis kode yang bersih dan konsisten.

#### Melewatkan argumen dengan rujukan
Wajarnya, argumen melewatkan nilai ke dalam fungsi (sehingga jika di dalam fungsi nilai argumen mengalami perubahan, tidak mengubah yang di luar fungsi). Untuk dapat mengubah argumen tersebut, argumen tersebut harus dilewatkan dengan rujukan. Untuk melewatkan argumen dengen rujukan, tambahkan karakter `&` di awal nama argumen.

```php
function arrangePoliteGreeting(string &$greeting): void
{
    $greeting .= ', senang bertemu Anda';
}

$casualGreeting = 'Halo Ghani';

arrangePoliteGreeting($casualGreeting);

echo $casualGreeting; // 'Halo Ghani, senang bertemu Anda
```

#### Nilai default argumen
Kode berikut adalah contoh fungsi dengan nilai default argumen, jika tidak ada argumen yang diberikan pada pemanggilan fungsi maka nilai default akan digunakan.
```php
function printGoodGreeting(string $name = 'santri'): void
{
    echo 'Halo ' . $name;
}

printGoodGreeting();        // Halo santri
printGoodGreeting('Ghani'); // Halo Ghani
```

#### Banyak argumen
Fungsi dapat menerima banyak argumen, sebagai contoh:
```php
function printFriendGreeting(string $name, string $friendName): void
{
    echo 'Halo ' . $name . ' dan ' . $friendName;
}
```

atau dalam beberapa kasus jumlah argumen fungsi berjumlah tak tentu (_variable arguments_) dapat digunakan `...`.
```php
function printGroupGreeting(string $leadName, string ...$others): void
{
    echo 'Halo ' . join(', ', $others) . ', dan ' . $leadName;
}

printGroupGreeting('Amin', 'Rouf', 'Miun', 'Rofik');
```

### Kembalian Fungsi
Untuk menjadikan fungsi mengembalikan nilai digunakan kata kunci `return`. Nilai dikembalikan oleh fungsi segera setelah kata kunci `return`, pernyataan setelah `return` diabaikan.

Deklarasi fungsi disarankan menyertakan petunjuk _return type_ setelah tanda kurung (_parenthesis_). Pada contoh, fungsi tersebut meneruskan tipe data `string`. Tipe data `void` dapat digunakan khusus pada _return type_, yang artinya fungsi tersebut tidak meneruskan nilai apapun.

```php
makeGreeting(string $name): string
{
    return 'Halo ' . $name; // mengembalikan string

    echo 'Apa kabar?'; // tidak akan dijalankan
}

printManyGreeting(string $greeting, int $nTimes = 1): void
{
    for ($i = 0; $i < $nTimes; $i++) {
        echo $greeting . PHP_EOL;
    }
}

$greeting = makeGreeting('Ghani');
printManyGreeting($greeting, 9);
```

#### Deklarasi _nullable return type_
Fungsi dapat dideklarasikan meneruskan suatu tipe data sekaligus `null` pada kasus tertentu, untuk itu awali _return type_ dengan `?`.

```php
makeGreeting(string $name): ?string
{
    // jika $name kosong, teruskan null
    if ($name === '') {
        return null;
    }

    return 'Halo ' . $name;
}
```

Contoh tersebut, fungsi meneruskan tipe data `string` atau `null` bergantung pada kondisi.

## Meta
- Kata kunci:
  1. abc

- Tautan:
  1. [Example Site](http://site.example)

## Latihan
1. Buatlah fungsi `calcRectangleArea` dengan 2 argumen `width` dan `length`, fungsi tersebut meneruskan `integer` sebagai hasil perhitungan.
2. Buatkah fungsi untuk bangun lainnya, antara lain segitiga, lingkaran, dan trapesium.
3. Dengan menggunakan argumen dengan rujukan, buatlah fungsi yang mengubah variabel berisi larik `[2, 3, 4, 5, 6, 7, 8, 9]` menjadi `[6, 9, 12, 15, 18, 21, 24, 27]`.
