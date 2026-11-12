<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganigramController;

Route::get('/admin/login',[AdminAuthController::class,'showLogin'])->name('admin.login');
Route::post('/admin/login',[AdminAuthController::class,'login'])->name('admin.login.submit');
Route::post('/admin/logout',[AdminAuthController::class,'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('admin.auth')->group(function(){
 Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
 Route::get('/profil',[ProfilController::class,'edit'])->name('admin.profil');
 Route::put('/profil',[ProfilController::class,'update'])->name('admin.profil.update');
 Route::resource('/berita',BeritaController::class)->names('admin.berita')->except(['show']);
 Route::resource('/kategori',KategoriController::class)->names('admin.kategori')->except(['show']);
 Route::resource('/katalog',KatalogController::class)->names('admin.katalog')->except(['show']);
 Route::resource('/layanan',LayananController::class)->names('admin.layanan')->except(['show']);
 Route::resource('/fasilitas',FasilitasController::class)->names('admin.fasilitas')->except(['show']);
 Route::resource('/user',UserController::class)->names('admin.user')->except(['show']);
 Route::resource('/organigram',OrganigramController::class)->names('admin.organigram')->except(['show']);
});
