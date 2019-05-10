# Mengenal RESTful Web Services

## Materi

### Apa itu RESTful

REST (REpresentational State Transfer) merupakan standar arsitektur komunikasi berbasis web yang sering diterapkan dalam pengembangan layanan berbasis web. Umumnya menggunakan HTTP (Hypertext Transfer Protocol) sebagai protocol untuk komunikasi data. REST pertama kali diperkenalkan oleh Roy Fielding pada tahun 2000.

Pada arsitektur REST, REST server menyediakan resources(sumber daya/data) dan REST client mengakses dan menampilkan resource tersebut untuk penggunaan selanjutnya. Setiap resource diidentifikasi oleh URIs (Universal Resource Identifiers) atau global ID. Resource tersebut direpresentasikan dalam bentuk format teks, JSON atau XML. Pada umumnya formatnya menggunakan JSON dan XML.

Keuntungan REST

bahasa dan platform agnostic
lebih sederhana/simpel untuk dikembangkan ketimbang SOAP
mudah dipelajari, tidak bergantung pada tools
ringkas, tidak membutuhkan layer pertukaran pesan (messaging) tambahan
secara desain dan filosofi lebih dekat dengan web
Kelemahan REST

Mengasumsi model point-to-point komunikasi - tidak dapat digunakan untuk lingkungan komputasi terdistribusi di mana pesan akan melalui satu atau lebih perantara
Kurangnya dukungan standar untuk keamanan, kebijakan, keandalan pesan, dll, sehingga layanan yang mempunyai persyaratan lebih canggih lebih sulit untuk dikembangkan ("dipecahkan sendiri")
Berkaitan dengan model transport HTTP
Berikut metode HTTP yang umum digunakan dalam arsitektur berbasis REST.
``
GET, menyediakan hanya akses baca pada resource
PUT, digunakan untuk menciptakan resource baru
DELETE,digunakan untuk menghapus resource
POST,digunakan untuk memperbarui resource yang ada atau membuat resource baru
OPTIONS,digunakan untuk mendapatkan operasi yang disupport pada resource
Web service adalah standar yang digunakan untuk melakukan pertukaran data antar aplikasi atau sistem, karena aplikasi yang melakukan pertukaran data bisa ditulis dengan bahasa pemrograman yang berbeda atau berjalan pada platform yang berbeda. Contoh implementasi dari web service antara lain adalah SOAP dan REST.
``

Web service yang berbasis arsitektur REST kemudian dikenal sebagai RESTful web services. Layanan web ini menggunakan metode HTTP untuk menerapkan konsep arsitektur REST.

### Cara Kerja RESTful web services

![](assets/images/php/rest.png)

Sebuah client mengirimkan sebuah data atau request melalui HTTP Request dan kemudian server merespon melaluiHTTP Response. Komponen dari http request :

Verb, HTTP method yang digunakan misalnya GET, POST, DELETE, PUT dll.
Uniform Resource Identifier  (URI) untuk mengidentifikasikan lokasi resource pada server.
HTTP Version, menunjukkan versi dari HTTP yang digunakan, contoh HTTP v1.1.
Request Header, berisi metadata untuk HTTP Request. Contoh, type client/browser, format yang didukung oleh client, format dari body pesan, seting cache dll.
Request Body, konten dari data.
Sedangkan komponen dari http response :

Status/Response Code, mengindikasikan status server terhadap resource yang direquest. misal : 404, artinya resource tidak ditemukan dan 200 response OK.
HTTP Version, menunjukkan versi dari HTTP yang digunakan, contoh HTTP v1.1.
Response Header, berisi metadata untuk HTTP Response. Contoh, type server, panjang content, tipe content, waktu response, dll
Response Body, konten dari data yang diberikan.
