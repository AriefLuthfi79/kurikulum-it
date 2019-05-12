# Membuat REST API Crud pada laravel

# Kompetensi:
- Dapat Membuat CRUD REST API menggunakan laravel
- Memahami package helper dalam membuat REST API
- Memahami kegunaan REST API

## Materi

### Langkah 1 :

Instalasi Laravel versi 5.6. Buat yang sudah terbiasa install pake perintah laravel new, atau cara lainnya skip ini, untuk nama project bisa kalian sesuaikan sendiri ya guys, nama project ada di parameter terakhir yang tercetak miring dibawah ini, atau bisa dilihat di sini [Laravel Instalation](https://laravel.com/docs/5.7/installation)

``
$ composer create-project --prefer-dist laravel/laravel notation-learn-api -vvv
``

Selanjutnya jangan, lupa untuk memastikan bahwa file yang berkaitan dengan konfigurasi db sudah diset ya, kamu bisa mengatur koneksi db di dalam config/database.php atau di file .env kamu.

### Langkah 2 :

Masuk ke direktori project, dan buat model beserta migration file nya, dengan menambahkan option -m di akhir command

``
$ cd notation-learn-api
$ php artisan make:model Colleague -m
``


Edit file migration yang sudah dibuat menjadi seperti berikut:
!! Updated: Ada typo pada value enum

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColleaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50)->nullable(false);
            $table->string('last_name', 50)->nullable(true);
            $table->enum('gender', ['male','female']);
            $table->string('email', 50)->unique();
            $table->text('speciality')->nullable(true);
            $table->string('phone_number', 50)->nullable(false);
            $table->string('address', 255);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colleagues');
    }
}
```

Selanjutnya jalankan migrasinya,

``$ php artisan migrate``

![](assets/images/php/table.png)

### Langkah 3 :

Di langkah ini kita akan membuat seeder table colleagues, yang telah kita buat tadi menggunakan Model Factory, disini data untuk table colleagues akan diisi dengan data dummy, digenerate menggunakan package bernama [Faker](https://github.com/fzaninotto/Faker).

``$ php artisan make:factory ColleagueFactory``

Edit file factories/ColleagueFactory.php yang sudah dibuat menjadi seperti berikut:

```php
<?php

use Faker\Generator as Faker;

$factory->define(\App\Colleague::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array ('male', 'female'));
    return [
        'first_name' => $faker->firstName($gender),
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'gender' => $gender,
        'speciality' => $faker->randomElement($array = array ('Programming', 'Design', 'Web Development', 'Photography', 'Animation')),
        'address' => $faker->address,
    ];
});
```

Kemudian buat file Seeder,

``$ php artisan make:seeder ColleaguesTableSeeder``

Selanjutnya edit file seeds/ColleaguesTableSeeder.php menjadi seperti berikut:

```php
<?php

use Illuminate\Database\Seeder;

class ColleaguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Colleague::class, 20)->create();
    }
}
```

“Darimana muncul angka 20?” 20 adalah jumlah data dummy yang akan kita masukkan kedalam table colleagues, “masing masing data itu isinya apa?” masing masing yang akan diinsert sudah digenerate secara random dan otomatis oleh Faker, yang merupakan fungsi Model Factory tadi.

Jangan lupa untuk memanggil Class ColleagueTableSeeder di seeds/DatabaseSeeder.php tepatnya pada method ``run()``.

```php
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ColleaguesTableSeeder::class);
    }
}
```

Selanjutnya jalankan database seedernya dengan perintah:

``$ php artisan db:seed``

![](assets/images/php/seeder.png)

---

![](assets/images/php/seeder2.png)

### Langkah 4 :

Buat Controller

``$ php artisan make:controller Api/ColleagueController --resource --model=Colleague``

Route —Model Binding
Tambahkan route colleagues di dalam file routes/api.php

```php
Route::group(['namespace' => 'Api'], function () {
   Route::resource('colleagues', 'ColleagueController');
});
```

Tambahkan juga code dibawah ini, ke dalam app/Providers/RouteServiceProvider.php, fungsinya adalah untuk Route Model Binding

```php
Route::model('colleague', Colleague::class);
```
Cek routes

``$ php artisan route:list``

![](assets/images/php/routelist2.png)

###Langkah 5 :

Ganti code model Colleague, yang sekarang dengan code dibawah ini:

```php
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Colleague extends Model
{
    protected $guarded = ['id'];
    /*
     * Validations
     */
    public static function rules($update = false, $id = null)
    {
        $rules = [
            'first_name'    => 'required',
            'email'         => ['required', Rule::unique('colleagues')->ignore($id, 'id')],
            'email'         => 'email',
            'gender'        => ['required', Rule::in(['male', 'female'])],
            'address'       => 'required',
            'phone_number'  => 'required'
        ];
        if ($update) {
            return $rules;
        }
        return array_merge($rules, [
            'email'         => 'required|unique:colleagues,email',
        ]);
    }
}
```

Pada code diatas, kita menambahkan rules yang berfungsi untuk validasi ketika kita melakukan aktifitas create dan update, dan property $guarded dengan value [‘id’] yang berfungsi supaya field selain ‘id’ menjadi assignable (dapat kita tambahkan kedalam db).

Baca: ![Mass Assignment](https://laravel.com/docs/5.6/eloquent#mass-assignment)

Selanjutnya kita akan membuat API Resources,

Jadi guys, ada dua jenis Resources, yaitu resources dengan data tunggal, dan collection resource. Untuk selanjutnya Aku akan menyebutnya dengan sebutan Item dan Collection.

Untuk class yang menghandle resource data tunggal akan memakai/meng-extend:

**Illuminate\Http\Resources\Json\JsonResource**

Sedangkan untuk yang bertipe Collection akan meng-extend:

**Iluminate\Http\Resources\Json\ResourceCollection**

Pertama kita akan membuat Resource Item milik model Colleague:

``$ php artisan make:resource ColleagueItem``

Kemudian ubah code nya menjadi seperti berikut:

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColleagueItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'speciality' => $this->speciality,
            'phone_number' => $this->phone_number,
            'address' => $this->address
        ];
    }
}
```

Kedua kita akan membuat Resource Collection-nya juga:

``$ php artisan make:resource ColleagueCollection --collection``

Kemudian ubah code nya menjadi seperti berikut:

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ColleagueCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ColleagueItem::collection($this->collection)
        ];
    }
}
```

### Langkah 6:

Kita akan menyentuh **ColleagueController**

```php
<?php

namespace App\Http\Controllers\Api;

use App\Colleague;
use App\Http\Controllers\Controller;
use App\Http\Resources\ColleagueCollection;
use App\Http\Resources\ColleagueItem;
use Illuminate\Http\Request;

class ColleagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ColleagueCollection(Colleague::get());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Colleague::rules(false));
        if (!Colleague::create($request->all())) {
            return [
                'message' => 'Bad Request',
                'code' => 400,
            ];
        } else {
            return [
                'message' => 'OK',
                'code' => 200,
            ];
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Colleague  $colleague
     * @return \Illuminate\Http\Response
     */
    public function show(Colleague $colleague)
    {
        return new ColleagueItem($colleague);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Colleague  $colleague
     * @return \Illuminate\Http\Response
     */
    public function edit(Colleague $colleague)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colleague  $colleague
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colleague $colleague)
    {
        $this->validate($request, Colleague::rules(true, $colleague->id));
        if (!$colleague->update($request->all())) {
            return [
                'message' => 'Bad Request',
                'code' => 400,
            ];
        } else {
            return [
                'message' => 'OK',
                'code' => 201,
            ];
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colleague  $colleague
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colleague $colleague)
    {
        if ($colleague->delete()) {
            return [
                'message' => 'OK',
                'code' => 204,
            ];
        } else {
            return [
                'message' => 'Bad Request',
                'code' => 400,
            ];
        }
    }
}
```

Method index() yang menghandle url route api/colleagues, berfungsi untuk menampilkan semua data dari table colleagues,

``
public function index()
{
    return new ColleagueCollection(Colleague::get());
}
``

Pada method ini kita menggunakan class ColleagueCollection yang sudah kita buat tadi dan mengisi Hasil query dari Colleague::get() sebagai parameter pertamanya.

![](assets/images/php/postman.png)

Method show() berfungsi untuk mengambil satu data berdasarkan field id

```php
public function show(Colleague $colleague)
{
    return new ColleagueItem($colleague);
}
```

Kita langsung memasukkan variable $colleague ke dalam Constructor dari class ColleagueItem yang barusan kita buat tadi. Kemudahan seperti ini berkat Model Binding, Laravel akan langsung otomatis mencari data yang memiliki id yang sama seperti yang kita masukkan di url, dan langsung mengembalikannya berupa satu record lengkap.

![](assets/images/php/postman2.png)

Method store() digunakan untuk Create data baru

```php

public function store(Request $request)
{
    $this->validate($request, Colleague::rules(false));

    if (!Colleague::create($request->all())) {
        return [
            'message' => 'Bad Request',
            'code' => 400,
        ];
    } else {
        return [
            'message' => 'OK',
            'code' => 200,
        ];
    }
}
```

![](assets/images/php/postman3.png)


Method update() digunakan untuk mengupdate data

---

```php
public function update(Request $request, Colleague $colleague)
{
    $this->validate($request, Colleague::rules(true, $colleague->id));

    if (!$colleague->update($request->all())) {
        return [
            'message' => 'Bad Request',
            'code' => 400,
        ];
    } else {
        return [
            'message' => 'OK',
            'code' => 201,
        ];
    }
}
```

![](assets/images/php/postman4.png)


Method destroy() berfungsi untuk mendelete data,

```php
public function destroy(Colleague $colleague)
{
    if ($colleague->delete()) {
        return [
            'message' => 'OK',
            'code' => 204,
        ];
    } else {
        return [
            'message' => 'Bad Request',
            'code' => 400,
        ];
    }
}
```

![](assets/images/php/destroy.png)

