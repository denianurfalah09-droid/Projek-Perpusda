@extends('layouts.frontend')

@section('title', 'Kategori Buku - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
@endpush

@section('content')

<!-- ================= BANNER HEADER KATEGORI ================= -->
<section class="kategori-hero-banner">
    <div class="site-container">
        <div class="kategori-banner-content">
            <div class="kategori-breadcrumb">
                <a href="{{ route('beranda') }}">Beranda</a>
                <span>/</span>
                <span>Kategori Buku</span>
            </div>
            <h1>Klasifikasi Kategori Buku</h1>
            <p>Pilih kategori literatur yang Anda inginkan untuk menemukan buku-buku terbaik di Perpustakaan Daerah Purwakarta.</p>
        </div>
    </div>
</section>

<!-- ================= DAFTAR KATEGORI ================= -->
<section class="kategori-list-section">
    <div class="site-container">

        <div class="kategori-section-header">
            <div>
                <h2>Semua Kategori Koleksi</h2>
                <p>Temukan ratusan buku menarik berdasarkan klasifikasi bidang keilmuan</p>
            </div>
            <a href="{{ route('katalog') }}" class="btn-view-all-katalog">
                <span>Buka Seluruh Katalog &rarr;</span>
            </a>
        </div>

        <div class="kategori-cards-grid">
            @foreach ($categories as $cat)
                <a href="{{ route('katalog', ['kategori' => $cat->nama_kategori]) }}" class="kategori-box-card">
                    <div class="kategori-box-top">
                        <div class="kategori-box-icon">
                            {{ $cat->icon ?? '📖' }}
                        </div>
                        <span class="kategori-count-badge">
                            {{ $cat->buku_count ?? 0 }} Buku
                        </span>
                    </div>

                    <div class="kategori-box-body">
                        <h3>{{ $cat->nama_kategori }}</h3>
                        <p>{{ $cat->deskripsi ?? 'Kumpulan koleksi buku pilihan dalam kategori ' . $cat->nama_kategori . '.' }}</p>
                    </div>

                    <div class="kategori-box-footer">
                        <span class="view-books-text">Jelajahi Koleksi</span>
                        <div class="arrow-circle">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>

@endsection