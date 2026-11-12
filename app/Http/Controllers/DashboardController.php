<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Katalog;
use App\Models\Kategori;
use App\Models\Aktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = 0;
        $distinctKatCount = 0;
        try {
            if (Schema::hasTable('katalogs')) {
                $totalBuku = Katalog::count();
                $distinctKatCount = Katalog::distinct('kategori')->count('kategori');
            }
        } catch (\Throwable $e) {}

        $totalBerita = 10;
        $totalLayanan = 6;
        $totalFasilitas = 8;
        
        $kategoriCount = 0;
        try {
            if (Schema::hasTable('kategoris')) {
                $kategoriCount = Kategori::count();
            }
        } catch (\Throwable $e) {}

        $totalKategori = max($kategoriCount, $distinctKatCount, 9);

        $aktivitasTerbaru = collect([]);
        try {
            if (Schema::hasTable('aktivitas')) {
                $aktivitasTerbaru = Aktivitas::latest()->take(8)->get();
            }
        } catch (\Throwable $e) {}

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalBerita',
            'totalLayanan',
            'totalFasilitas',
            'totalKategori',
            'aktivitasTerbaru'
        ));
    }
}
