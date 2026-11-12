<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel profil
        if (!Schema::hasTable('profil')) {
            Schema::create('profil', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->longText('isi');
                $table->string('gambar')->nullable();
            });
        }

        // Tabel berita
        if (!Schema::hasTable('berita')) {
            Schema::create('berita', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->text('link');
                $table->date('tanggal');
                $table->string('gambar')->nullable();
            });
        }

        // Tabel layanan
        if (!Schema::hasTable('layanan')) {
            Schema::create('layanan', function (Blueprint $table) {
                $table->id('id_layanan');
                $table->string('nama_layanan');
                $table->longText('deskripsi');
            });
        }

        // Tabel fasilitas
        if (!Schema::hasTable('fasilitas')) {
            Schema::create('fasilitas', function (Blueprint $table) {
                $table->id('id_fasilitas');
                $table->string('nama_fasilitas');
                $table->longText('deskripsi');
                $table->string('gambar')->nullable();
            });
        }

        // Tabel organigram
        if (!Schema::hasTable('organigram')) {
            Schema::create('organigram', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('jabatan');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('organigram');
        Schema::dropIfExists('fasilitas');
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('profil');
    }
};