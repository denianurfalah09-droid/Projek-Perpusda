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
            @forelse($layanan as $item)
                @php
                    $icons = ['📖', '📚', '⭐', '🕐', '👤', '🔖', '🏛️', '💻'];
                    $icon = '📖';
                    $lower = strtolower($item->nama_layanan);
                    if (str_contains($lower, 'jam') || str_contains($lower, 'waktu') || str_contains($lower, 'operasional')) {
                        $icon = '🕐';
                    } elseif (str_contains($lower, 'anggota') || str_contains($lower, 'kartu') || str_contains($lower, 'member')) {
                        $icon = '👤';
                    } elseif (str_contains($lower, 'program') || str_contains($lower, 'unggulan') || str_contains($lower, 'keliling')) {
                        $icon = '⭐';
                    } elseif (str_contains($lower, 'komputer') || str_contains($lower, 'internet') || str_contains($lower, 'digital')) {
                        $icon = '💻';
                    } elseif (str_contains($lower, 'buku') || str_contains($lower, 'koleksi') || str_contains($lower, 'baca')) {
                        $icon = '📚';
                    } else {
                        $icon = $icons[$loop->index % count($icons)];
                    }
                @endphp
                <div class="layanan-card">
                    <div class="layanan-icon">{{ $icon }}</div>
                    <div class="layanan-content">
                        <h2>{{ $item->nama_layanan }}</h2>
                        <div class="garis"></div>
                        <p>{!! nl2br(e($item->deskripsi)) !!}</p>
                        @if(str_contains($lower, 'kartu') || str_contains($lower, 'anggota'))
                            <a href="{{ route('kartu.anggota') }}" style="display:inline-block; margin-top:10px; color:#0048a8; font-weight:700;">Lihat Persyaratan &rarr;</a>
                        @elseif(str_contains($lower, 'program'))
                            <a href="{{ route('program.unggulan') }}" style="display:inline-block; margin-top:10px; color:#0048a8; font-weight:700;">Lihat Program &rarr;</a>
                        @endif
                    </div>
                </div>
            @empty
                <p style="text-align:center; grid-column: 1 / -1; color:#64748b; padding: 3rem 0;">
                    Belum ada data layanan yang tersedia.
                </p>
            @endforelse
        </div>
    </div>
</section>

@endsection