@extends('layouts.frontend')

@section('title', 'Berita & Informasi - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/berita.css') }}">
<style>
.berita-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.berita-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.berita-breadcrumb a { color: #e0f2fe; }
.berita-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.berita-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.berita-main-wrap {
    padding: 4rem 0 5rem 0;
    background: #f8fafc;
}
.berita-cards-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}
@media (max-width: 992px) {
    .berita-cards-container { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .berita-cards-container { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<section class="berita-hero-banner">
    <div class="site-container">
        <div class="berita-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Berita & Informasi</span>
        </div>
        <h1>Berita & Informasi Terkini</h1>
        <p>Warta seputar kegiatan literasi, agenda perpustakaan, dan perkembangan layanan di Purwakarta</p>
    </div>
</section>

<section class="berita-main-wrap">
    <div class="site-container">
        <div class="berita-cards-container">
            <!-- BERITA 1 -->
            <a href="https://disipusda.purwakartakab.go.id/perpustakaan-daerah-kabupaten-purwakarta/" target="_blank" rel="noopener" class="berita-card">
                <div class="berita-image">
                    <img src="{{ asset('images/berita1.jpg') }}" alt="Kegiatan Perpustakaan Daerah Purwakarta">
                </div>
                <div class="berita-content">
                    <h2>Kegiatan Perpustakaan Daerah Purwakarta</h2>
                    <p>Informasi terbaru mengenai ragam kegiatan literasi edukatif dan layanan pembinaan minat baca di Perpustakaan Daerah Kabupaten Purwakarta.</p>
                    <small>📅 10 Agustus 2026</small>
                </div>
            </a>

            <!-- BERITA 2 -->
            <a href="https://lppl.purwakartakab.go.id/berita-purwakarta/perkuat-budaya-literasi-masyarakat-perpustakaan-purwakarta-siapkan-ribuan-koleksi-buku/" target="_blank" rel="noopener" class="berita-card">
                <div class="berita-image">
                    <img src="{{ asset('images/berita2.webp') }}" alt="Program Literasi Perpustakaan">
                </div>
                <div class="berita-content">
                    <h2>Perkuat Budaya Literasi, Siapkan Ribuan Koleksi Buku</h2>
                    <p>Perpustakaan Daerah Purwakarta terus menambah koleksi buku berkualitas guna mendorong antusiasme membaca generasi muda.</p>
                    <small>📅 5 Agustus 2026</small>
                </div>
            </a>

            <!-- BERITA 3 -->
            <a href="https://disipusda.purwakartakab.go.id/" target="_blank" rel="noopener" class="berita-card">
                <div class="berita-image">
                    <img src="{{ asset('images/berita3.jpeg') }}" alt="Informasi Layanan Perpustakaan">
                </div>
                <div class="berita-content">
                    <h2>Peningkatan Kualitas Fasilitas Ruang Baca & Digital</h2>
                    <p>Simak pembaruan fasilitas komputer penelusuran OPAC, ruang ramah anak, dan internet WiFi gratis bagi seluruh pemustaka.</p>
                    <small>📅 1 Agustus 2026</small>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection