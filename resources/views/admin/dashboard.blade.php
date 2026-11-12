@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- HERO / WELCOME BANNER -->
    <div class="dashboard-hero">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="pulse-dot"></span>
                <span>Sistem Informasi Perpusda Online</span>
            </div>
            <h1>Selamat Datang Kembali, Admin! 👋</h1>
            <p>Kelola koleksi katalog buku, berita terbaru, fasilitas, dan pantau seluruh riwayat aktivitas perpustakaan dalam satu tempat terpadu.</p>
            <div class="hero-actions">
                <a href="{{ route('admin.katalog.create') }}" class="btn-hero-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>Tambah Katalog Buku</span>
                </a>
                <a href="{{ route('admin.katalog') }}" class="btn-hero-secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    <span>Lihat Semua Katalog</span>
                </a>
            </div>
        </div>
        <div class="hero-illustration">
            <div class="stat-bubble">
                <span class="bubble-num">{{ $totalBuku }}</span>
                <span class="bubble-label">Koleksi Buku</span>
            </div>
        </div>
    </div>


    <!-- DASHBOARD STATS CARDS -->
    <div class="dashboard-section-header">
        <h2>Ringkasan Statistik</h2>
        <span class="section-subtitle">Data inventaris dan layanan perpustakaan</span>
    </div>

    <div class="dashboard-cards">

        <!-- KARTU BUKU -->
        <a href="{{ route('admin.katalog') }}" class="dashboard-card card-buku">
            <div class="card-icon-wrapper">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
            </div>
            <div class="card-details">
                <span class="card-label">Total Buku</span>
                <h2 class="card-value">{{ $totalBuku }}</h2>
                <div class="card-footer-info">
                    <span class="trend-badge">Koleksi Utama</span>
                </div>
            </div>
        </a>

        <!-- KARTU BERITA -->
        <a href="{{ route('admin.berita') }}" class="dashboard-card card-berita">
            <div class="card-icon-wrapper">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6Z"></path></svg>
            </div>
            <div class="card-details">
                <span class="card-label">Berita & Informasi</span>
                <h2 class="card-value">{{ $totalBerita }}</h2>
                <div class="card-footer-info">
                    <span class="trend-badge">Publikasi</span>
                </div>
            </div>
        </a>

        <!-- KARTU LAYANAN -->
        <a href="{{ route('admin.layanan') }}" class="dashboard-card card-layanan">
            <div class="card-icon-wrapper">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
            </div>
            <div class="card-details">
                <span class="card-label">Layanan</span>
                <h2 class="card-value">{{ $totalLayanan }}</h2>
                <div class="card-footer-info">
                    <span class="trend-badge">Aktif</span>
                </div>
            </div>
        </a>

        <!-- KARTU FASILITAS -->
        <a href="{{ route('admin.fasilitas') }}" class="dashboard-card card-fasilitas">
            <div class="card-icon-wrapper">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
            </div>
            <div class="card-details">
                <span class="card-label">Fasilitas</span>
                <h2 class="card-value">{{ $totalFasilitas }}</h2>
                <div class="card-footer-info">
                    <span class="trend-badge">Tersedia</span>
                </div>
            </div>
        </a>

        <!-- KARTU KATEGORI -->
        <a href="{{ route('admin.kategori') }}" class="dashboard-card card-kategori">
            <div class="card-icon-wrapper">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
            </div>
            <div class="card-details">
                <span class="card-label">Kategori Buku</span>
                <h2 class="card-value">{{ $totalKategori }}</h2>
                <div class="card-footer-info">
                    <span class="trend-badge">Klasifikasi</span>
                </div>
            </div>
        </a>

    </div>


    <!-- AKTIVITAS TERBARU (FEED DINAMIS) -->
    <div class="activity-box">

        <div class="activity-box-header">
            <div class="activity-title-wrapper">
                <div class="activity-icon-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
                <div>
                    <h2>Aktivitas & Riwayat Terbaru</h2>
                    <p>Log perubahan data buku dan aktivitas sistem secara real-time</p>
                </div>
            </div>
            <div class="activity-badge-count">
                {{ count($aktivitasTerbaru) }} Riwayat Terbaru
            </div>
        </div>

        <div class="activity-list">
            @forelse ($aktivitasTerbaru as $act)
                <div class="activity-item">
                    <div class="activity-indicator {{ $act->tipe ?? 'katalog' }} {{ $act->icon ?? '' }}">
                        @if ($act->icon === 'trash')
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        @elseif ($act->icon === 'edit')
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        @else
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        @endif
                    </div>
                    <div class="activity-content-text">
                        <div class="activity-top-row">
                            <p class="activity-headline">{{ $act->judul }}</p>
                            <span class="activity-time-badge">
                                {{ $act->created_at ? $act->created_at->diffForHumans() : 'Baru saja' }}
                            </span>
                        </div>
                        @if ($act->deskripsi)
                            <p class="activity-desc">{{ $act->deskripsi }}</p>
                        @endif
                        <small class="activity-date">
                            {{ $act->created_at ? $act->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i') }} WIB
                        </small>
                    </div>
                </div>
            @empty
                <div class="activity-empty-state">
                    <div class="empty-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    </div>
                    <h3>Belum Ada Aktivitas</h3>
                    <p>Aktivitas penambahan buku katalog atau pembaruan data akan otomatis muncul di sini.</p>
                </div>
            @endforelse
        </div>

    </div>

@endsection