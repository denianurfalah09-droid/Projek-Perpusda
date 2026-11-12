@extends('layouts.frontend')

@section('title', 'Kartu Anggota - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kartu-anggota.css') }}">
<style>
.kartu-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.kartu-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.kartu-breadcrumb a { color: #e0f2fe; }
.kartu-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.kartu-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.kartu-wrap-section {
    padding: 4rem 0 5rem 0;
    background: #f8fafc;
}
</style>
@endpush

@section('content')

<section class="kartu-hero-banner">
    <div class="site-container">
        <div class="kartu-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Layanan Anggota</span>
        </div>
        <h1>Pembuatan Kartu Anggota</h1>
        <p>Persyaratan dan Prosedur Pendaftaran Anggota Resmi Perpustakaan Daerah Kabupaten Purwakarta</p>
    </div>
</section>

<section class="kartu-wrap-section">
    <div class="site-container">
        <main class="anggota-container">
            <div class="intro">
                <h2>Persyaratan Menjadi Anggota Perpustakaan</h2>
                <p>Berikut persyaratan yang harus dipenuhi untuk mendaftarkan diri menjadi anggota resmi Perpustakaan Daerah Kabupaten Purwakarta guna menikmati fasilitas sirkulasi peminjaman buku.</p>
            </div>

            <!-- A. WARGA PURWAKARTA -->
            <section class="persyaratan">
                <h3>A. Warga Masyarakat Purwakarta</h3>
                <p class="keterangan">Persyaratan berkas yang harus dibawa saat mendaftar langsung di lokasi:</p>

                <div class="syarat-item">
                    <h4>1. Masyarakat Umum</h4>
                    <p>Fotocopy KTP, Kartu Keluarga, atau SIM (1 lembar).</p>
                </div>

                <div class="syarat-item">
                    <h4>2. Pelajar SD</h4>
                    <p>Fotocopy Kartu Pelajar (NISN) atau Kartu Keluarga (1 lembar).</p>
                </div>

                <div class="syarat-item">
                    <h4>3. Pelajar SMP / SMA / SMK</h4>
                    <p>Fotocopy Kartu Pelajar (NISN) atau Kartu Keluarga (1 lembar).</p>
                </div>

                <div class="syarat-item">
                    <h4>4. Mahasiswa</h4>
                    <p>Fotocopy Kartu Tanda Mahasiswa disertai Surat Keterangan masih aktif kuliah dari bagian Akademik, atau Kartu Keluarga (masing-masing 1 lembar).</p>
                </div>
            </section>

            <!-- B. BUKAN WARGA PURWAKARTA -->
            <section class="persyaratan">
                <h3>B. Bukan Warga Kabupaten Purwakarta</h3>
                <p class="keterangan">Bagi masyarakat luar domisili yang sedang menempuh pendidikan di sekolah atau perguruan tinggi di Kabupaten Purwakarta:</p>

                <div class="syarat-item">
                    <h4>1. Pelajar SMP / SMA</h4>
                    <p>Fotocopy Kartu Pelajar (NISN) atau Kartu Keluarga (1 lembar).</p>
                </div>

                <div class="syarat-item">
                    <h4>2. Mahasiswa</h4>
                    <p>Fotocopy Kartu Tanda Mahasiswa disertai Surat Keterangan masih aktif kuliah dari bagian Akademik (1 lembar).</p>
                </div>
            </section>

            <!-- TEMPAT PENDAFTARAN -->
            <section class="tempat-daftar">
                <h3>📍 Tempat & Lokasi Pendaftaran</h3>
                <p>Pendaftaran anggota dapat langsung diproses pada jam kerja di:</p>
                <strong>Gedung Perpustakaan Daerah Kabupaten Purwakarta</strong>
                <p>Jl. K.K. Singawinata No. 83 (No. 47 lama), Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta</p>
                <p class="catatan">(Samping belakang Gedung Museum Diorama Nusantara Purwakarta)</p>
            </section>

            <!-- GRATIS -->
            <section class="gratis">
                <h3>🆓 Pendaftaran 100% Gratis</h3>
                <p><strong>Pendaftaran dan pencetakan kartu anggota perpustakaan sama sekali TIDAK dipungut biaya (Gratis).</strong></p>
            </section>
        </main>
    </div>
</section>

@endsection