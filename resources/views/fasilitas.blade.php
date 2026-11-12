@extends('layouts.frontend')

@section('title', 'Fasilitas - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fasilitas.css') }}">
<style>
.fasilitas-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.fasilitas-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.fasilitas-breadcrumb a { color: #e0f2fe; }
.fasilitas-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.fasilitas-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.fasilitas-wrap-section {
    padding: 4rem 0 5rem 0;
    background: #f8fafc;
}
</style>
@endpush

@section('content')

<section class="fasilitas-hero-banner">
    <div class="site-container">
        <div class="fasilitas-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Fasilitas Gedung</span>
        </div>
        <h1>Fasilitas Perpustakaan</h1>
        <p>Sarana dan prasarana representatif untuk mendukung kenyamanan membaca dan belajar Anda</p>
    </div>
</section>

<section class="fasilitas-wrap-section">
    <div class="site-container">
        <div class="fasilitas-container">
            <!-- FASILITAS 1 -->
            <div class="fasilitas-card">
                <div class="fasilitas-info">
                    <h2>1. Ruang Lobby & Informasi</h2>
                    <p>Ruang lobby merupakan area awal yang digunakan pengunjung saat memasuki perpustakaan, dilengkapi meja informasi, loker penitipan barang, dan buku tamu.</p>
                </div>
                <div class="fasilitas-image">
                    <img src="{{ asset('images/lobby.jpg') }}" alt="Ruang Lobby" onerror="this.src='{{ asset('images/profil.jpg') }}'">
                </div>
            </div>

            <!-- FASILITAS 2 -->
            <div class="fasilitas-card">
                <div class="fasilitas-info">
                    <h2>2. Ruangan Ramah Anak</h2>
                    <p>Ruangan yang dirancang khusus untuk anak-anak agar dapat membaca, bermain mainan edukatif, dan belajar dengan suasana ceria dan nyaman.</p>
                </div>
                <div class="fasilitas-image">
                    <img src="{{ asset('images/anak-anak.jpg') }}" alt="Ruangan Anak-anak" onerror="this.src='{{ asset('images/profil.jpg') }}'">
                </div>
            </div>

            <!-- FASILITAS 3 -->
            <div class="fasilitas-card">
                <div class="fasilitas-info">
                    <h2>3. Ruangan Remaja & Dewasa</h2>
                    <p>Ruangan ber-AC yang tenang dan kondusif bagi remaja, mahasiswa, serta masyarakat umum untuk membaca, riset tugas akhir, dan mencari referensi.</p>
                </div>
                <div class="fasilitas-image">
                    <img src="{{ asset('images/remaja.jpg') }}" alt="Ruangan Remaja" onerror="this.src='{{ asset('images/profil.jpg') }}'">
                </div>
            </div>

            <!-- FASILITAS 4 -->
            <div class="fasilitas-card">
                <div class="fasilitas-info">
                    <h2>4. Ruangan Aula & Diskusi</h2>
                    <p>Aula serbaguna yang digunakan untuk berbagai kegiatan literasi, bedah buku, workshop, seminar, dan pertemuan komunitas literasi di Purwakarta.</p>
                </div>
                <div class="fasilitas-image">
                    <img src="{{ asset('images/aula.jpg') }}" alt="Ruangan Aula" onerror="this.src='{{ asset('images/profil.jpg') }}'">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection