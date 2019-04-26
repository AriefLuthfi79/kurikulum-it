# Topik 1: Class

## Prasyarat
- Telah Menyelesaikan seluruh Sprint 1 beserta Latihan dan Evaluasi

## Kompetensi
- Mengenal class dan anatomi penyusun class
- Dapat mendeklarikan class
- Mengenal 3 pilar dasar OOP (pembungkusan, pewarisan, dan banyakrupa)
- Menerapkan ragam pembatasan pada class member
- Mendeklarasikan class anak dengan memperluas class induk
- Merancang class untuk menyelesaikan masalah pemrograman

## Materi

### Menulis _class_

_Class_ merupakan kumpulan kode dari suatu rancangan objek, mendefinisikan seperti
apa dan dapat melakukan apa nantinya objek yang akan terbentuk.

Mari kita contohkan, Cak Oni memimpikan membuka gerai mi ayam dan meminta kita
merancang gerai tersebut. Gerai mi ayam tentu saja menyediakan mi ayam. Untuk dapat
menyediakan mi ayam, diperlukan bahan masakan. Dan juga gerai harus terdapat
aktivitas memasak dan menerima pesanan dari pembeli.

```php
class GeraiMiAyam
{
    /**
     * Bahan-bahan masakan penyusun mi ayam
     * @var array
     */
    protected $ingredients = [
        'mi', 'sawi', 'ayam', 'garam', 'rempah',
    ];

    /**
     * Terima pesanan dari pembeli
     * @return MiAyam
     */
    public function order(): MiAyam
    {
        $miAyam = $this->cook();

        return $miAyam;
    }

    /**
     * Memasak mi ayam
     * @return MiAyam
     */
    protected function cook(): MiAyam
    {
        // rebus bahan-bahan
        $miAyam = boil($ingredients);
        
        return $miAyam;
    }
}
```

Dalam pemromgraman berorientasi objek, variabel di dalam _class_ kita sebut sebagai
properti dan fungsi di dalam _class_ disebut sebagai metode (_method_).
Properti dan metode keduanya disebut _class members_.

Kembali ke gerai Cak Oni. Desain gerai yang kita tulis tadi baru berupa rancangan,
belum wujud sebagai objek. Untuk mewujudkan gerai impiannya, Cak Oni perlu
menginisialisasi rancangan tersebut.

```php
$geraiMiAyam = new GeraiMiAyam(); // inisialisasi gerai

// memesan mi ayam dari gerai 1
$miAyam = $geraiMiAyam->order(); // hore, dapat mi ayam
```

Setelah diinisialisasi, rancangan tersebut menjadi sebuah objek. Sewaktu-waktu
Cak Oni ingin membuka gerai mi ayam baru, beliau cukup menginisaliasi ulang dari
rancangan yang telah dipunyai.

```php
$geraiMiAyamCabangParangtritis = new GeraiMiAyam();
$geraiMiAyamCabangGunungkidul = new GeraiMiAyam();
```

### Pembungkusan (_encapsulation_)

Dalam mendesain gerai Cak Oni, sebagai perancang yang baik kita menentukan pula
batasan akses dalam rancangan tersebut. Batasan akses disebut _visibility_, dibagi
dalam _public_, _protected_, dan _private_.

1. _Public_ artinya dapat diakses oleh siapa saja (publik).
2. _Protected_ artinya terlindungi, tidak dapat diakses dari luar objek.
3. _Private_ artinya pribadi, hanya dapat diakses oleh internal _class_.

Sementara ini, kita bahas pembatasan _public_ dan _protected_.

Dalam rancangan kita temui _public_ untuk metode `order()`, tentu saja itu tujuannya,
siapa saja boleh memesan di gerai Cak Oni melalui metode `order()`. Selanjutnya
terdapat properti `$ingredients` dan metode `cook()` dengan batasan akses
_protected_, hanya internal gerai yang dibolehkan melakukan aktivitas memasak dan
mengakses bahan-bahan masakan. Tidak beralasan memberikan akses publik untuk dapat
memasak atau memperbolehkan publik melihat bumbu masakan dalam rancangan tersebut.

Jika publik mencoba mengakses member dengan _visibility_ _protected_, maka galat akan
diterbitkan.

```php
$geraiMiAyam = new GeraiMiAyam();

$miAyam = $geraiMiAyam->cook(); // Error: Call to protected method cook()
```

### Pewarisan (_inheritance_)

Setelah sukses membuka gerai mi ayam, Cak Oni mencoba meluaskan pasar dengan membuka
gerai mi ayam bakso. Pada prinsipnya gerai baru ini sama dengan gerai mi ayam, hanya
berbeda pada menu sajian yang terdapat tambahan bakso. Sedangkan bahan masakan dan
cara menerima pesanan persis pada gerai mi ayam. Dengan kata lain kita dapat
menggunakan ulang rancangan gerai mi ayam yang sebelumnya telah kita buat dengan
penyesuian pada cara memasak sajian.

```php
class GeraiMiAyamBakso extends GeraiMiAyam
{
    /**
     * Topping sajian
     */
    protected $topping = 'bakso';

    public function cook(): MiAyamBakso
    {
        // rebus bahan-bahan
        $miAyam = boil($this->ingredients);

        // beri tambahan bakso pada sajian
        $miAyamBakso = $this->applyTopping($miAyam);

        return $miAyamBakso;
    }

    protected function applyTopping($miAyam)
    {
        return $miAyam + $this->topping;
    }
}
```

Perhatikan cara mendefinikan _class_ `GeraiMiAyamBakso`, _class_ tersebut memperluas
(_extends_) _class_ `GeraiMiAyam` yang di sebut sebagai _class_ induk (_parent_).
Dengan memperluas, _class_ `GeraiMiAyamBakso` sebagai anak akan mewariskan properti
`$ingredients` dan metode `order()` milik _class_ induknya.

Penyesuian metode dalam _class_ induk dengan cara mendefinisikan metode dengan nama
yang sama pada _class_ anak disebut dengan _override_.

```php
$geraiMiAyamBakso = new GeraiMiAyamBakso(); // inisialisasi gerai mi ayam bakso

// memesan mi ayam bakso dari gerai tersebut
$miAyamBakso = $geraiMiAyamBakso->order(); // hore, dapat mi ayam bakso
```

#### Member _private_ pada anak

Di awal kita telah mengenal pembatasan _public_ dan _protected_, yang mana _class_
anak akan mewarisi member dengan pembatasan _public_ dan _protected_ milik induknya.
Member dengan pembatasan _private_ hanya dapat diakses dalam _class_ yang
mendefinikan, _class_ anak tidak mewarisi member dengan pembatasan _private_ dari
induknya. Akan tetapi jika induk memiliki metode _public_ atau _protected_ yang
mengakses member _private_, maka member itu dapat pula digunakan pada _class_ anak.

### Banyakrupa (_polymorphism_)

```php
class MiAyamCeker {}

class MiAyamPangsit {}

class MiAyamSetan {}
```

---

Di dalam _class_ anak, kita dapat:
- properti warisan dapat digunakan langsung, seperti halnya properti lain;
- deklarasi properti pada anak dengan nama yang sama pada induk, ini akan
menyembunyikan yang ada pada induk (tidak disarankan);
- deklarasi properti baru pada anak yang tidak terdapat pada induk;
- metode warisan dapat digunakan langsung;
- menulis metode baru pada anak dengan nama yang sama pada induk, ini akan menimpa
apa yang ada pada induk;
- menulis metode _static_ baru pada anak dengan nama yang sama pada induk, ini akan
menyembunyikan yang ada pada induk;
- deklarasi metode baru pada anak yang tidak terdapat pada induk.

## Meta
- Kata kunci:
  1. 
  2. 

- Tautan:
  1. [Example Site](http://site.example)

## Latihan
1. Rancanglah sistem yang berisi beberapa _class_ yang menangani kasus perpustakaan dengan rincian sebagai berikut:
    - buku memiliki judul buku dan isbn, dapat dipinjam dan dikembalikan oleh pengunjung,
    - objek pengunjung dapat meminjam 
