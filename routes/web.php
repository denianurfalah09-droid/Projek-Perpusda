<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganigramController;
use App\Http\Controllers\AuthController;
use App\Models\Katalog;
use App\Models\Kategori;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Perpustakaan Daerah Purwakarta
|--------------------------------------------------------------------------
*/

// ================= FRONTEND ROUTES =================

Route::get('/', function () {
    $featuredBooks = collect([]);
    $totalBuku = 0;
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('katalogs')) {
            $featuredBooks = Katalog::latest()->take(8)->get();
            $totalBuku = Katalog::count();
        }
    } catch (\Throwable $e) {}

    $totalKategori = 10;
    $categories = collect([]);

    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
            $totalKategori = max(Kategori::count(), 10);
            $categories = Kategori::withCount('buku')->take(8)->get();
        }
    } catch (\Throwable $e) {}

    // Fallback jika belum ada kategori di database
    if ($categories->isEmpty()) {
        $defaultCategories = [
            ['nama_kategori' => 'Pendidikan', 'icon' => '📚', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Pendidikan')->count() : 0],
            ['nama_kategori' => 'Novel', 'icon' => '📖', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Novel')->count() : 0],
            ['nama_kategori' => 'Fiksi', 'icon' => '✨', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Fiksi')->count() : 0],
            ['nama_kategori' => 'Sains', 'icon' => '🔬', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Sains')->count() : 0],
            ['nama_kategori' => 'Sejarah', 'icon' => '🏛️', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Sejarah')->count() : 0],
            ['nama_kategori' => 'Teknologi', 'icon' => '💻', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Teknologi')->count() : 0],
            ['nama_kategori' => 'Biografi', 'icon' => '👤', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Biografi')->count() : 0],
            ['nama_kategori' => 'Agama', 'icon' => '🕌', 'buku_count' => \Illuminate\Support\Facades\Schema::hasTable('katalogs') ? Katalog::where('kategori', 'Agama')->count() : 0],
        ];
        $categories = collect($defaultCategories)->map(function ($item) {
            return (object) $item;
        });
    }

    return view('beranda', compact('featuredBooks', 'totalBuku', 'totalKategori', 'categories'));
})->name('beranda');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/kategori-buku', function () {
    $categories = collect([]);
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
            $categories = Kategori::withCount('buku')->get();
        }
    } catch (\Throwable $e) {}

    if ($categories->isEmpty()) {
        $hasKatalog = \Illuminate\Support\Facades\Schema::hasTable('katalogs');
        $defaultCategories = [
            ['nama_kategori' => 'Pendidikan', 'icon' => '📚', 'deskripsi' => 'Buku pendidikan, kurikulum sekolah, dan referensi akademik.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Pendidikan')->count() : 0],
            ['nama_kategori' => 'Novel', 'icon' => '📖', 'deskripsi' => 'Novel populer, karya fiksi Indonesia dan terjemahan sastra dunia.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Novel')->count() : 0],
            ['nama_kategori' => 'Fiksi', 'icon' => '✨', 'deskripsi' => 'Cerita fiksi remaja, kumpulan dongeng, dan karya sastra kreatif.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Fiksi')->count() : 0],
            ['nama_kategori' => 'Agama', 'icon' => '🕌', 'deskripsi' => 'Buku tuntunan keagamaan, akhlak mulia, dan wawasan keislaman.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Agama')->count() : 0],
            ['nama_kategori' => 'Sejarah', 'icon' => '🏛️', 'deskripsi' => 'Sejarah peradaban, arsip lokal Purwakarta, dan kemerdekaan.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Sejarah')->count() : 0],
            ['nama_kategori' => 'Sains', 'icon' => '🔬', 'deskripsi' => 'Ilmu pengetahuan alam, fisika, biologi, dan eksperimen seru.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Sains')->count() : 0],
            ['nama_kategori' => 'Teknologi', 'icon' => '💻', 'deskripsi' => 'Informatika, coding, rekayasa teknologi modern, dan AI.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Teknologi')->count() : 0],
            ['nama_kategori' => 'Biografi', 'icon' => '👤', 'deskripsi' => 'Kisah inspiratif para tokoh bangsa dan pahlawan nasional.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Biografi')->count() : 0],
            ['nama_kategori' => 'Sastra', 'icon' => '✍️', 'deskripsi' => 'Antologi puisi, seni drama panggung, dan ulasan sastra daerah.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Sastra')->count() : 0],
            ['nama_kategori' => 'Umum', 'icon' => '🌏', 'deskripsi' => 'Ensiklopedia umum, kamus, panduan hobi, dan motivasi hidup.', 'buku_count' => $hasKatalog ? Katalog::where('kategori', 'Umum')->count() : 0],
        ];
        $categories = collect($defaultCategories)->map(function ($item) {
            return (object) $item;
        });
    }

    return view('kategori', compact('categories'));
})->name('kategori.buku');

Route::get('/katalog', function (Request $request) {
    $query = Katalog::latest();

    // Filter kategori jika ada query param ?kategori=...
    if ($request->filled('kategori')) {
        $selectedKategori = $request->input('kategori');
        $query->where('kategori', 'like', "%{$selectedKategori}%");
    }

    // Filter pencarian jika ada query param ?search=...
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('penulis', 'like', "%{$search}%")
              ->orWhere('penerbit', 'like', "%{$search}%")
              ->orWhere('kategori', 'like', "%{$search}%");
        });
    }

    $buku = $query->paginate(12)->withQueryString();

    // Daftar semua kategori untuk pill navigasi
    $kategoriList = [];
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('kategoris')) {
            $kategoriList = Kategori::orderBy('nama_kategori')->pluck('nama_kategori')->toArray();
        }
    } catch (\Throwable $e) {}

    if (empty($kategoriList)) {
        $kategoriList = ['Semua', 'Novel', 'Pendidikan', 'Agama', 'Sejarah', 'Biografi', 'Sains', 'Teknologi', 'Sastra', 'Umum'];
    }

    return view('katalog', compact('buku', 'kategoriList'));
})->name('katalog');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/kartu-anggota', function () {
    return view('kartu-anggota');
})->name('kartu.anggota');

Route::get('/program-unggulan', function () {
    return view('program-unggulan');
})->name('program.unggulan');

Route::get('/fasilitas', function () { 
    return view('fasilitas');
})->name('fasilitas');

Route::get('/organigram', function () { 
    return view('struktur-organigram');
})->name('organigram');


// ================= AUTHENTICATION ROUTES =================

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout.get');


// ================= ADMIN ROUTES (PROTECTED BY AUTH) =================

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Profil Perpustakaan (CRUD data profil dari tabel profil)
    // 2. Profil Perpustakaan (CRUD data profil dari tabel profil)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
Route::post('/profil', [ProfilController::class, 'update'])->name('profil.update.post');
Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    // 3. Berita CRUD
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    // 4. Katalog Buku CRUD
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/create', [KatalogController::class, 'create'])->name('katalog.create');
    Route::post('/katalog', [KatalogController::class, 'store'])->name('katalog.store');
    Route::get('/katalog/{id}/edit', [KatalogController::class, 'edit'])->name('katalog.edit');
    Route::put('/katalog/{id}', [KatalogController::class, 'update'])->name('katalog.update');
    Route::delete('/katalog/{id}', [KatalogController::class, 'destroy'])->name('katalog.destroy');

    // 5. Kategori Buku CRUD
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // 6. Layanan CRUD
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
    Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    // 7. Fasilitas CRUD
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::get('/fasilitas/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/fasilitas/{id}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/fasilitas/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

    // 8. User CRUD
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // 9. Organigram CRUD
    Route::get('/organigram', [OrganigramController::class, 'index'])->name('organigram');
    Route::get('/organigram/create', [OrganigramController::class, 'create'])->name('organigram.create');
    Route::post('/organigram', [OrganigramController::class, 'store'])->name('organigram.store');
    Route::get('/organigram/{id}/edit', [OrganigramController::class, 'edit'])->name('organigram.edit');
    Route::put('/organigram/{id}', [OrganigramController::class, 'update'])->name('organigram.update');
    Route::delete('/organigram/{id}', [OrganigramController::class, 'destroy'])->name('organigram.destroy');

});