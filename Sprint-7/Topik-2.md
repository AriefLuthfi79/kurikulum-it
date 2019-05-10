# Membuat operasi CRUD (Create Read Update Delete) menggunakan framework Laravel

## Materi

### Membuat project baru.

ketik command berikut untuk menbuat proyek bookstore:
```
composer create-project — prefer-dist laravel/laravel bookstore
```

Jika di run dengan command berikut maka hasilnya:

``php artisan serve``

![](assets/images/php/url5.png)

Sampai saat ini laravel 5.7 sudah terinstal dengan benar

### Setting Database.

Sekarang edit file dengan mengedit file .env

``
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=bookstoredb
DB_USERNAME=root
DB_PASSWORD=root
``

Sekarang kita coba koneksi database dengan migrasi 2 table yang tersedia secara default dalam laravel 5.7:

``
php artisan migrate
``

---

*Note: kalau kita langsung menjalankan perintah diatas akan muncul error : PDOException::(“SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes”) untuk mengatasi ubah dulu app/Providers/AppServiceProvider.php tambahkan Schema::defaultStringLength(191); pada function boot*

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
```

Sekarang kita cek di phpmyadmin

![](assets/images/php/phpmyadmin.png)

### Buat Model untuk table books

Sekarang kita lanjut bikin model untuk books table :

``php artisan make:model Book -m``

Perintah diatas akan membuat 2 file baru :

1. Book.php
2. database/migrations/xxxx_create_books_table.php

Kita edit dulu file database/migrations/xxxx_create_books_table.php :

```php
public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->text('description');
        $table->string('publisher');
        $table->integer('qty');
        $table->timestamps();
     });
}
```

jalankan lagi :

``php artisan migrate``

![](assets/images/php/migrate.png)

### Buat file View untuk insert table books.

buat file baru di resources/views/create.blade.php

```php
<!-- create.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel 5.7 CRUD Tutorial With Example  </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Tambah Buku Baru</h2><br/>
      <form method="post" action="{{url('books')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Title">Judul buku:</label>
            <input type="text" class="form-control" name="title">
          </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Description">Keterangan:</label>
              <input type="text" class="form-control" name="description">
            </div>
        </div>
          
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Qty">Stock:</label>
            <input type="text" class="form-control" name="qty">
          </div>
        </div>
         <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label>Penerbit:</label>
                <select name="publisher">
                  <option value="Pustaka Imam Syafi`i">Pustaka Imam Syafi`i</option>
                  <option value="Pustaka Ibnu Katsir">Pustaka Ibnu Katsir</option>
                  <option value="Darul Haq">Darul Haq</option>  
                  <option value="At-tibyan">At-tibyan</option>  
                </select>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
```

### Buat Controller dan Route

Jalankan perintah:

``php artisan make:controller BookController --resource``

Perintah diatas akan membuat file baru app/Http/Controllers/BookController.php

tambahkan routing untuk controller diatas dengan menambahkan di file routes/web.php

```php
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books','BookController');
```

Cek route apakah sudah terdaftar :

``php artisan route:list``

![](assets/images/php/routelist.png)

Tambahkan kode pada app/Http/Controllers/BookController.php
```php
  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }
```

Sekarang coba http://localhost:8000/books/create

![](assets/images/php/webresult.png)

### Simpan Data dalam Table Books.

Untuk menyimpan data dalam database, kita butuh mengubah function store di app/Http/Controllers/BookController.php

```php

   public function store(Request $request)
    {
        //
        $book = new \App\Book;
        $book->title = $request->get('title');
        $book->description = $request->get('description');
        $book->qty = $request->get('qty');
        $book->publisher = $request->get('publisher');
        $book->save();
        
        return redirect('books')->with('success', 'Data buku telah ditambahkan');       

    }
```

### Buat index page untuk table books.

Edit lagi file BookController.php pada function index:

```php

	public function index()
    {
        //
        $books=\App\Book::all();
        return view('index',compact('books'));        
    }
```

Tambahkan file resources/views/index.blade.php:

```php

<!-- index.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Judul Buku</th>
        <th>Keterangan</th>
        <th>Penerbit</th>
        <th>Stock</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($books as $book)
      <tr>
        <td>{{$book['id']}}</td>
        <td>{{$book['title']}}</td>
        <td>{{$book['description']}}</td>
        <td>{{$book['publisher']}}</td>
        <td>{{$book['qty']}}</td>
        
        <td><a href="{{action('BookController@edit', $book['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('BookController@destroy', $book['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>
```

Coba akses http://localhost:8000/books

![](assets/images/php/resultwebcrud.png)

## Buat fungsi untuk update books

Ubah function edit pada BookController.php

```php

    public function edit($id)
    {
        //
        $book = \App\Book::find($id);
        return view('edit',compact('book','id'));       
    }
```

Buat file edit.blade.php

```php


<!-- create.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel 5.7 CRUD Tutorial With Example  </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Edit Data Buku</h2><br/>
      <form method="post" action="{{action('BookController@update', $id)}}">
      @csrf
      <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Title">Judul buku:</label>
            <input type="text" class="form-control" name="title" value="{{$book->title}}">
          </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Description">Keterangan:</label>
              <input type="text" class="form-control" name="description" value="{{$book->description}}">
            </div>
        </div>
          
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Qty">Stock:</label>
            <input type="text" class="form-control" name="qty" value="{{$book->qty}}">
          </div>
        </div>
         <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label>Penerbit:</label>
                <select name="publisher">
                  <option value="Pustaka Imam Syafi`i" @if($book->publisher=="Pustaka Imam Syafi`i") selected @endif>Pustaka Imam Syafi`i</option>
                  <option value="Pustaka Ibnu Katsir" @if($book->publisher=="Pustaka Ibnu Katsir") selected @endif>Pustaka Ibnu Katsir</option>
                  <option value="Darul Haq" @if($book->publisher=="Darul Haq") selected @endif>Darul Haq</option>  
                  <option value="At-tibyan" @if($book->publisher=="At-tibyan") selected @endif>At-tibyan</option>  
                </select>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
```

coba akses http://localhost:8000/books kemudian klik tombol edit pada salah satu data buku

![](assets/images/php/editbooks.png)

Untuk proses simpan tambahkan kode berikut pada function update di BookController.php

```php

    public function update(Request $request, $id)
    {
        //
        $book= \App\Book::find($id);
        $book->title = $request->get('title');
        $book->description = $request->get('description');
        $book->qty = $request->get('qty');
        $book->publisher = $request->get('publisher');
        $book->save();
        return redirect('books')->with('success', 'Data buku telah diubah');       
   

    }
```

### Hapus data table books

Tambahkan kode untuk function destroy di BookController.php
```php
  	public function destroy($id)
    {
        //
        $book = \App\Book::find($id);
        $book->delete();
        return redirect('books')->with('success','Data buku telah di hapus');

    }
```

