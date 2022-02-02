
## Tentang Project Laravel
Project ini merupakan hasil pengerjaan dari PHP developer test di JWALBLI sebagai backend developer junior.
berisi api crud Posts yang dapat berkomunikasi dengan API dari [https://jsonplaceholder.typicode.com/guide/](https://jsonplaceholder.typicode.com/guide/) menggunakan packet yang dibuat sendiri.
- [Paket Post Helper](https://github.com/Aghniyan/jwalbli-post-helper).

## Spesifikasi Project
- PHP ^7.x
- laravel ^7.30.x

## Langkah instalasi Project Laravel
- Git clone [Repository](https://github.com/Aghniyan/jwalbli-post.git) ke folder lokal
- masuk kedalam direktori **laravel-post**, ketik perintah **composer install**
- setelah proses install composer selesai, ketikan perintah **php artisan serve**
- gunakan POSTMAN untuk menjalankan API nya.

## Penjelasan POSTMAN 
LINK Postman Collection : [Postman Collection](https://www.getpostman.com/collections/fd52efe4903f9ff40321) 
List Endpoint : 
- semua data posts => [GET] http://127.0.0.1:8000/api/post
- semua data posts berdasarkan user id => [GET] http://127.0.0.1:8000/api/post?userId={userId}
- data posts berdasarkan id => [GET] http://127.0.0.1:8000/api/post/{id}
- tambah data posts => [POST] http://127.0.0.1:8000/api/post
- ubah data posts => [PATCH] http://127.0.0.1:8000/api/post/{id}
- hapus data posts => [DELETE] http://127.0.0.1:8000/api/post/{id}
