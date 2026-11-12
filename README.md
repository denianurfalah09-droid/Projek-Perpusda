<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


<!-- ================= READMI ================= -->

# README - Website Perpusda Purwakarta

## 1. Dokumentasi

Website Perpusda Purwakarta merupakan website informasi perpustakaan yang dibuat untuk menampilkan informasi mengenai Perpustakaan Daerah Kabupaten Purwakarta.

Dokumentasi ini berisi informasi mengenai website, fitur, teknologi yang digunakan, struktur project, database, cara menjalankan project, perintah Laravel, serta bagian backend.

---

## 2. Deskripsi

Website Perpusda Purwakarta dibuat sebagai media informasi yang memudahkan masyarakat untuk mendapatkan informasi mengenai perpustakaan tanpa harus datang langsung ke lokasi.

Website menampilkan informasi seperti profil perpustakaan, berita, kategori dan katalog buku, layanan, fasilitas, serta struktur organisasi.

Website juga memiliki bagian backend yang digunakan untuk mengelola data yang ditampilkan pada website.

---

## 3. Fitur

### Frontend

- Beranda
- Profil
- Berita
- Kategori Buku
- Katalog Buku
- Layanan
- Kartu Anggota
- Program Unggulan
- Fasilitas
- Organigram
- Login
- Register

### Backend

- Dashboard Admin
- Kelola Profil
- Kelola Berita
- Kelola Katalog Buku
- Kelola Kategori Buku
- Kelola Layanan
- Kelola Fasilitas
- Kelola User
- Kelola Organigram
- Tambah data
- Edit data
- Hapus data
- Logout

---

## 4. Teknologi / Stack

Teknologi yang digunakan dalam pembuatan website:

- **Laravel** - Framework PHP
- **PHP** - Bahasa pemrograman backend
- **MySQL** - Database
- **HTML** - Struktur halaman website
- **CSS** - Tampilan dan responsive website
- **Blade** - Template engine Laravel
- **Visual Studio Code** - Code editor
- **Figma** - Perancangan desain dan mockup
- **Laragon** - Local development environment
- **HeidiSQL / phpMyAdmin** - Pengelolaan database

Website dibuat tanpa menggunakan JavaScript.

---

## 5. Database

Database yang digunakan adalah MySQL.

### Tabel profil

- id
- judul
- isi
- gambar

### Tabel berita

- id
- judul
- isi
- tanggal
- gambar

### Tabel katalog_buku

- id_buku
- judul_buku
- penulis
- penerbit
- tahun_terbit
- id_kategori

### Tabel kategori_buku

- id_kategori
- nama_kategori

### Tabel layanan

- id_layanan
- nama_layanan
- deskripsi

### Tabel fasilitas

- id_fasilitas
- nama_fasilitas
- deskripsi
- gambar

### Tabel user

- id_user
- username
- password
- email

### Tabel organigram

- id
- nama
- jabatan

### Relasi

Tabel katalog_buku memiliki relasi dengan tabel kategori_buku
melalui field id_kategori.

---

## 6. Struktur Project

Struktur utama project Laravel:

```text
perpusda-purwakarta/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── css/
│   ├── images/
│   └── index.php
│
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── layouts/
│       │   │   └── app.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── berita/
│       │   ├── katalog/
│       │   ├── kategori/
│       │   ├── layanan/
│       │   ├── fasilitas/
│       │   ├── user/
│       │   └── organigram/
│       │
│       ├── beranda.blade.php
│       ├── profil.blade.php
│       ├── berita.blade.php
│       ├── kategori.blade.php
│       ├── katalog.blade.php
│       ├── layanan.blade.php
│       ├── kartu-anggota.blade.php
│       ├── program-unggulan.blade.php
│       ├── fasilitas.blade.php
│       ├── struktur-organigram.blade.php
│       ├── login.blade.php
│       └── register.blade.php
│
├── routes/
│   └── web.php
│
├── .env
├── artisan
├── composer.json
└── README.md