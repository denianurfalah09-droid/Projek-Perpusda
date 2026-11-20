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
            @forelse ($berita as $item)
                <a href="{{ $item->link }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="berita-card">

                    <div class="berita-image">
                        @if ($item->gambar && \Illuminate\Support\Str::startsWith($item->gambar, ['http://', 'https://']))
                            <img
                                src="{{ $item->gambar }}"
                                alt="{{ $item->judul }}"
                            >
                        @elseif ($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->judul }}"
                            >
                        @elseif ($item->gambar && file_exists(public_path('images/' . $item->gambar)))
                            <img
                                src="{{ asset('images/' . $item->gambar) }}"
                                alt="{{ $item->judul }}"
                            >
                        @elseif ($item->gambar)
                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->judul }}"
                            >
                        @else
                            <img
                                src="{{ asset('images/berita1.jpg') }}"
                                alt="{{ $item->judul }}"
                            >
                        @endif
                    </div>

                    <div class="berita-content">
                        <h2>{{ $item->judul }}</h2>

                        <p>
                            {{ $item->deskripsi ?? 'Baca informasi selengkapnya melalui tautan berita.' }}
                        </p>

                        <small>
                            📅 {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </small>
                    </div>
                </a>
            @empty
                <p class="berita-empty" style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 3rem 0;">
                    Belum ada berita yang tersedia.
                </p>
            @endforelse
        </div>
    </div>
</section>

@endsection