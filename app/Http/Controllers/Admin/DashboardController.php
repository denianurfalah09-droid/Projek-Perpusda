<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Aktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Katalog::count();
        $totalBerita = Berita::count();
        $totalLayanan = Layanan::count();
        $totalFasilitas = Fasilitas::count();
        $totalKategori = Kategori::count();
        $aktivitasTerbaru = Aktivitas::latest()->take(10)->get();

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

