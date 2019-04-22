# Topik 2: Request handling

## Prasyarat
- Peserta didik telah memahami ```http request``` dengan baik
- Peserta didik telah mampu bekerja dengan routing
- Peserta didik memahami `class` dengan baik


## Kompetensi
- Dapat memahami penggunaan routing
- Memahami kegunaan `class Request` dengan baik
- Dapat Handling route setiap request yang dilakukan

## Materi

### Request Handling

Pada materi ini kita sedikit mundur kebelakang. Kita mulai memanfaatkan variable global pada php namun lebih fokus pada variable `$_SERVER`.
Request handling 

#### Apa itu variable `$_SERVER`

Di Website php manual, tertulis `$_SERVER` adalah:

```
$_SERVER is an array containing information such as headers, paths, and script locations.
The entries in this array are created by the web server.
```

Intinya variable `$_SERVER` ini membantu kita mendapatkan informasi server yang di request.
