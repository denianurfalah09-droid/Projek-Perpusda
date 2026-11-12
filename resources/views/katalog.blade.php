@extends('layouts.frontend')

@section('title', 'Katalog Buku - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
@endpush

@section('content')

<!-- ================= BANNER HEADER KATALOG ================= -->
<section class="katalog-hero-banner">
    <div class="site-container">
        <div class="katalog-banner-content">
            <div class="katalog-breadcrumb">
                <a href="{{ route('beranda') }}">Beranda</a>
                <span>/</span>
                <span>Katalog Koleksi Buku</span>
            </div>
            <h1>Koleksi Buku Perpustakaan</h1>
            <p>Telusuri dan temukan berbagai judul buku bacaan, literatur ilmiah, buku pelajaran, dan karya sejarah di Perpusda Purwakarta.</p>

            <!-- SEARCH & FILTER FORM -->
            <form action="{{ route('katalog') }}" method="GET" class="katalog-search-form">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="katalog-search-input-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku, pengarang, penerbit, atau kata kunci..." aria-label="Cari koleksi buku">
                    @if(request('search'))
                        <a href="{{ route('katalog', request()->except('search')) }}" class="btn-clear-search" title="Hapus pencarian">&times;</a>
                    @endif
                </div>
                <button type="submit" class="btn-submit-search">
                    <span>Cari Buku</span>
                </button>
            </form>
        </div>
    </div>
</section>


<!-- ================= KONTEN UTAMA KATALOG ================= -->
<section class="katalog-main-section">
    <div class="site-container">

        <!-- FILTER KATEGORI PILLS -->
        <div class="category-filter-nav">
            <span class="filter-label">Filter Kategori:</span>
            <div class="filter-pills-list">
                <a href="{{ route('katalog', request()->only('search')) }}" 
                   class="filter-pill {{ !request('kategori') ? 'active' : '' }}">
                    Semua Koleksi
                </a>
                @foreach ($kategoriList as $kat)
                    @php
                        $katName = is_object($kat) ? $kat->nama_kategori : $kat;
                    @endphp
                    @if ($katName !== 'Semua')
                        <a href="{{ route('katalog', array_merge(request()->only('search'), ['kategori' => $katName])) }}" 
                           class="filter-pill {{ request('kategori') == $katName ? 'active' : '' }}">
                            {{ $katName }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- INFO BAR HASIL & RESET -->
        <div class="katalog-info-bar">
            <div class="results-count">
                Menampilkan <strong>{{ $buku->firstItem() ?? 0 }} - {{ $buku->lastItem() ?? 0 }}</strong> dari <strong>{{ $buku->total() }}</strong> buku
                @if(request('kategori'))
                    dalam kategori <span class="tag-active-filter">"{{ request('kategori') }}"</span>
                @endif
                @if(request('search'))
                    dengan kata kunci <span class="tag-active-filter">"{{ request('search') }}"</span>
                @endif
            </div>

            @if(request('kategori') || request('search'))
                <a href="{{ route('katalog') }}" class="btn-reset-all-filters">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    <span>Reset Semua Filter</span>
                </a>
            @endif
        </div>

        <!-- GRID DAFTAR BUKU -->
        <div class="katalog-books-grid">
            @forelse ($buku as $item)
                <div class="catalog-book-card">
                    <div class="book-card-cover-wrapper">
                        @if ($item->gambar && file_exists(public_path('uploads/katalog/' . $item->gambar)))
                            <img src="{{ asset('uploads/katalog/' . $item->gambar) }}" alt="{{ $item->judul }}" class="catalog-cover-img" loading="lazy">
                        @else
                            <div class="catalog-cover-fallback">
                                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                                <span class="fallback-book-text">{{ \Illuminate\Support\Str::limit($item->judul, 25) }}</span>
                            </div>
                        @endif
                        <span class="category-pill-badge">{{ $item->kategori }}</span>
                    </div>

                    <div class="book-card-body">
                        <h2 class="book-title-heading" title="{{ $item->judul }}">
                            {{ $item->judul }}
                        </h2>

                        <div class="book-detail-list">
                            <div class="detail-row">
                                <span class="detail-label">Penulis</span>
                                <span class="detail-val" title="{{ $item->penulis }}">{{ $item->penulis }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Penerbit</span>
                                <span class="detail-val" title="{{ $item->penerbit }}">{{ $item->penerbit }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Tahun</span>
                                <span class="detail-val">{{ $item->tahun }}</span>
                            </div>
                        </div>

                        <div class="book-card-action">
                            <span class="badge-status-ready">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                Tersedia di Rak
                            </span>
                            <span class="pinjam-info-hint">Pinjam di Perpusda</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="katalog-empty-state">
                    <div class="empty-icon-box">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <h3>Buku Tidak Ditemukan</h3>
                    <p>Maaf, tidak ada koleksi buku yang cocok dengan kriteria filter atau pencarian Anda.</p>
                    <a href="{{ route('katalog') }}" class="btn-primary" style="margin-top: 1rem;">
                        <span>Kembali ke Semua Koleksi</span>
                    </a>
                </div>
            @endforelse
        </div>

        <!-- ================= PAGINATION ================= -->
        @if ($buku->hasPages())
            <div class="katalog-pagination-wrapper">
                <nav class="custom-pagination" role="navigation" aria-label="Navigasi Halaman Buku">
                    {{-- Tombol Sebelumnya --}}
                    @if ($buku->onFirstPage())
                        <span class="page-link disabled" aria-disabled="true">&laquo; Sebelumnya</span>
                    @else
                        <a href="{{ $buku->previousPageUrl() }}" class="page-link" rel="prev">&laquo; Sebelumnya</a>
                    @endif

                    {{-- Elemen Nomor Halaman --}}
                    @foreach ($buku->getUrlRange(1, $buku->lastPage()) as $page => $url)
                        @if ($page == $buku->currentPage())
                            <span class="page-link active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Tombol Berikutnya --}}
                    @if ($buku->hasMorePages())
                        <a href="{{ $buku->nextPageUrl() }}" class="page-link" rel="next">Berikutnya &raquo;</a>
                    @else
                        <span class="page-link disabled" aria-disabled="true">Berikutnya &raquo;</span>
                    @endif
                </nav>
            </div>
        @endif

    </div>
</section>

@endsection