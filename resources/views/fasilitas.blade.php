
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
.fasilitas-breadcrumb a {
    color: #e0f2fe;
}
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
.fasilitas-card {
    width: 100%;
    display: block;
    padding: 28px 32px;
    background: #ffffff;
    border-radius: 12px;
    margin-bottom: 20px;
}
.fasilitas-info {
    width: 100%;
}
.fasilitas-info h2 {
    margin-bottom: 12px;
}
.fasilitas-info p {
    width: 100%;
    line-height: 1.8;
    margin: 0;
    text-align: justify;
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

        <p>
            Sarana dan prasarana representatif untuk mendukung kenyamanan membaca dan belajar Anda
        </p>
    </div>
</section>

<section class="fasilitas-wrap-section">
    <div class="site-container">
       <div class="fasilitas-container">

            @forelse($fasilitas as $item)

                <div class="fasilitas-card">
                    <div class="fasilitas-info">
                        <h2>{{ $loop->iteration }}. {{ $item->nama_fasilitas }}</h2>

                        <p>{{ $item->deskripsi }}</p>
                    </div>
                </div>

            @empty

                <p style="text-align:center;">
                    Belum ada data fasilitas yang tersedia.
                </p>

            @endforelse

        </div>
    </div>
</section>

@endsection
