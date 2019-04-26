# Topik 2-3: Fungsi tanpa nama (_closure_)

## Prasyarat

## Kompetensi

## Materi
Fungsi-fungsi tanpa nama (Inggris _anonymous functions_) disebut juga _lamba function_ atau disebut juga dengan _closure_, memungkinkan mendeklarasikan fungsi tanpa menentukan namanya. Fungsi jenis ini biasanya ditugaskan ke dalam sebuah variabel dan jamak digunakan sebagai paramater _callback_ pada pemanggilan fungsi lainnya.

```php
$isEqual = function(string $a, string $b): bool {
    return $a === $b;
}

var_dump($isEqual);
var_dump(is_callable($isEqual)); // true
echo get_class($isEqual); // Closure

$result = $isEqual('z', 'Z');

var_dump($result);
```

Contoh lainnya:
```php
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$oddNumbers = array_filter(
    $numbers,
    function (int $n): int {
        // ganjil jika dibagi 2 memberikan sisa
        return $n % 2;
    }
);

var_dump($oddNumbers);
```

#### Mewariskan variabel ke dalam closure
Closure memiliki tingkah laku seperti fungsi pada umumnya, variabel di luar cakupan fungsi harus dilewatkan ke dalam fungsi sebagai argumen. Namun ada kekhusuan, variabel pada cakupan induk dapat diwariskan ke dalam closure.

```php
$time = 'pagi';
// mewariskan var $time mengunakan katakunci `use`
$greet = function(string $name) use ($time): void {
    echo "Selamat {$time} {$name}";
}

$greet('Rasyid');
```


## Meta
- Kata kunci:
  1. closure

- Tautan:
  1. [Example Site](http://site.example)

## Latihan
1. Buatlah fungsi `calcRectangleArea` dengan 2 argumen `width` dan `length`, fungsi tersebut meneruskan `integer` sebagai hasil perhitungan.
2. Buatkah fungsi untuk bangun lainnya, antara lain segitiga, lingkaran, dan trapesium.
