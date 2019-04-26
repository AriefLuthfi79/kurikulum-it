# Topik 2-3: Penanganan Galat

## Prasyarat
- Santri Telah menyelesaikan Topik Constructor dan Static Member
## Kompetensi
- Mengenal exception
- Mengetahui cara menangani galat dengan blok try catch
- Mendefinisikan exception ubah suai
- Menerapkan penanganan exception dengan pemilahan
- Mengunakan statement finaly

## Materi

Pernyataan `try` terdiri dari blok `try` yang berisi satu atau lebih pernyataan dan ditambah sekurangnya harus ada salah satu ketentuan `catch` atau `finally`. Sehingga terdapat 3 bentuk pernyataan `try`:

1. `try...catch`
2. `try...finally`
3. `try...catch...finally`

Blok `catch` berisi pernyataan yang menentukan apa yang akan dilakukan jika penolakan (_exception_) dilempar dalam blok `try`. Kita berharap perintah dalam blok `try` berjalan lancar maka pernyataan `catch` akan dibaikan, sebaliknya, jika terjadi galat maka segera kendali berpindah ke pernyataan `catch`.

```php
function numberDivision(int $dividend, int $divisor): float {
    if ($divisor === 0) {
        echo 'Pembagi tidak boleh 0';
        return;
    }

    $quotient = $dividend / $divisor;
    return $quotient;
}

numberDivision(5, 3);
numberDivision(5, 0);
```

```php
function numberDivision(int $dividend, int $divisor): float {
    if ($divisor === 0) {
        throw new Exception('Pembagi tidak boleh 0');
    }

    $quotient = $dividend / $divisor;
    return $quotient;
}

$result = null;
try {
    $result = numberDivision(5, 0);
} catch (Exception $e) {
    echo $e->getMessage();
}

echo $result;
```

## Meta
- Kata kunci:
  1. exception handling
  2. 

- Tautan:
  1. [Example Site](http://site.example)

## Latihan
1. Dari soal latihan topik sebelumnya, kembangkanlah fungsi-fungsi yang telah dibuat pada Topik 2 dengan tambahan penerbitan exception untuk menangani kesalahan melewatkan parameter bernilai minus (kurang dari nol).
