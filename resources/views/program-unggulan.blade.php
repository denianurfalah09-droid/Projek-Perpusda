@extends('layouts.frontend')

@section('title', 'Program Unggulan - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/program-unggulan.css') }}">
<style>
.program-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.program-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.program-breadcrumb a { color: #e0f2fe; }
.program-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.program-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.program-wrap-section {
    padding: 4rem 0 5rem 0;
    background: #f8fafc;
}
</style>
@endpush

@section('content')

<section class="program-hero-banner">
    <div class="site-container">
        <div class="program-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Program Inovasi</span>
        </div>
        <h1>Program Unggulan Literasi</h1>
        <p>Inovasi dan Gerakan Literasi Terpadu untuk Kesejahteraan Masyarakat Purwakarta</p>
    </div>
</section>

<section class="program-wrap-section">
    <div class="site-container">
        <main class="program-container">
            <div class="program-image">
                <img src="{{ asset('images/program-unggulan.jpg') }}" alt="Program Unggulan Perpusda Purwakarta" onerror="this.src='{{ asset('images/profil.jpg') }}'">
            </div>

            <div class="program-content">
                <h2>Transformasi Perpustakaan Berbasis Inklusi Sosial</h2>
                <p>
                    Transformasi Perpustakaan Berbasis Inklusi Sosial (TPBIS) merupakan program nasional yang diimplementasikan di Kabupaten Purwakarta untuk menjadikan perpustakaan tidak sekadar tempat meminjam buku, melainkan wahana belajar sepanjang hayat, pusat kreativitas, dan pengembangan potensi masyarakat.
                </p>
                <p>
                    Melalui program ini, Perpustakaan Daerah Kabupaten Purwakarta mendorong masyarakat untuk memperoleh pengetahuan terapan dan keterampilan aplikatif yang berdampak nyata pada peningkatan kualitas hidup dan ekonomi keluarga.
                </p>

                <h3>Kegiatan & Pelatihan Program:</h3>
                <ul>
                    <li>Pelatihan literasi digital, desain grafis, dan pemanfaatan teknologi informasi</li>
                    <li>Workshop kewirausahaan berbasis potensi lokal Purwakarta</li>
                    <li>Bimbingan belajar anak, dongeng literasi, dan kelas bahasa asing</li>
                    <li>Kolaborasi bersama komunitas penggerak literasi dan pegiat budaya Purwakarta</li>
                    <li>Layanan jemput bola buku ke pelosok desa melalui armada perpustakaan keliling</li>
                </ul>
            </div>
        </main>
    </div>
</section>

@endsection