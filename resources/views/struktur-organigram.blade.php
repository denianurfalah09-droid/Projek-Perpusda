@extends('layouts.frontend')

@section('title', 'Struktur Organigram - Perpusda Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/struktur-organigram.css') }}">
<style>
.organigram-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.organigram-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.organigram-breadcrumb a { color: #e0f2fe; }
.organigram-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.organigram-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.organigram-wrap-section {
    padding: 3rem 0 5rem 0;
    background: #f8fafc;
}
</style>
@endpush

@section('content')

<section class="organigram-hero-banner">
    <div class="site-container">
        <div class="organigram-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Struktur Organigram</span>
        </div>
        <h1>Struktur Organigram Lembaga</h1>
        <p>Susunan Pimpinan dan Pegawai Dinas Kearsipan dan Perpustakaan Kabupaten Purwakarta</p>
    </div>
</section>

<section class="organigram-wrap-section">
    <div class="site-container">

        <main class="organigram-container">

            @foreach ($kelompokOptions as $kelompok)
                <section class="organigram-section">

                    <h2>{{ $kelompok }}</h2>

                    <div class="organigram-grid {{ $kelompok === 'Pimpinan' ? 'pimpinan-grid' : '' }}">

                        @forelse ($organigram->where('kelompok', $kelompok) as $item)
                            <div class="organigram-card">
                                <div class="person-icon">👤</div>
                                <h3>{{ $item->nama }}</h3>
                                <p>{{ $item->jabatan }}</p>
                            </div>
                        @empty
                            <p>Belum ada data pada kelompok ini.</p>
                        @endforelse

                    </div>
                </section>
            @endforeach

        </main>

    </div>
</section>

@endsection
