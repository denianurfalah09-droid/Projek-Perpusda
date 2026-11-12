@extends('layouts.frontend')

@section('title', 'Layanan - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
<style>
.layanan-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.layanan-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.layanan-breadcrumb a { color: #e0f2fe; }
.layanan-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.layanan-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.layanan-wrap-section {
    padding: 4rem 0 5rem 0;
    background: #f8fafc;
}
</style>
@endpush

@section('content')

<section class="layanan-hero-banner">
    <div class="site-container">
        <div class="layanan-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Layanan Publik</span>
        </div>
        <h1>Layanan Perpustakaan</h1>
        <p>Berbagai fasilitas dan kemudahan pelayanan literasi bagi masyarakat Kabupaten Purwakarta</p>
    </div>
</section>

<section class="layanan-wrap-section">
    <div class="site-container">
        <div class="layanan-grid">
            <!-- JAM OPERASIONAL -->
            <div class="layanan-card">
                <div class="layanan-icon">🕐</div>
                <div class="layanan-content">
                    <h2>Jam Operasional</h2>
                    <div class="garis"></div>
                    <p><strong>Senin - Kamis:</strong><br>08.00 - 15.30 WIB</p>
                    <p><strong>Jum'at:</strong><br>08.00 - 15.00 WIB</p>
                    <p><strong>Sabtu:</strong><br>08.30 - 12.00 WIB</p>
                </div>
            </div>

            <!-- KARTU ANGGOTA -->
            <div class="layanan-card">
                <div class="layanan-icon">👤</div>
                <div class="layanan-content">
                    <h2>Kartu Anggota</h2>
                    <div class="garis"></div>
                    <p>Dapatkan kemudahan akses peminjaman buku fisik dengan mendaftarkan diri menjadi anggota resmi Perpusda Purwakarta.</p>
                    <a href="{{ route('kartu.anggota') }}" style="display:inline-block; margin-top:10px; color:#0048a8; font-weight:700;">Lihat Persyaratan &rarr;</a>
                </div>
            </div>

            <!-- PROGRAM UNGGULAN -->
            <div class="layanan-card">
                <div class="layanan-icon">⭐</div>
                <div class="layanan-content">
                    <h2>Program Unggulan</h2>
                    <div class="garis"></div>
                    <p>Program literasi jemput bola melalui armada mobil perpustakaan keliling yang menjangkau seluruh kecamatan dan desa.</p>
                    <a href="{{ route('program.unggulan') }}" style="display:inline-block; margin-top:10px; color:#0048a8; font-weight:700;">Lihat Program &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection