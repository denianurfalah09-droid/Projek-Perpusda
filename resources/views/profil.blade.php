@extends('layouts.frontend')

@section('title', 'Profil - Perpustakaan Daerah Kabupaten Purwakarta')

@push('styles')
<style>
.profil-hero-banner {
    background: linear-gradient(135deg, #002d6b 0%, #0048a8 50%, #006bd6 100%);
    color: white;
    padding: 3.5rem 0 4rem 0;
    text-align: center;
}
.profil-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #bae6fd;
    margin-bottom: 0.75rem;
}
.profil-breadcrumb a { color: #e0f2fe; }
.profil-hero-banner h1 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 800;
    margin-bottom: 0.5rem;
}
.profil-hero-banner p {
    font-size: 1.05rem;
    color: #e0f2fe;
}
.profil-main-section {
    padding: 4rem 0 5rem 0;
    background: #f8fafc;
}
.profil-container-grid {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 3.5rem;
    align-items: flex-start;
}
.profil-img-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 12px;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
}
.profil-img-card img {
    width: 100%;
    height: auto;
    border-radius: 14px;
    object-fit: cover;
}
.profil-details-wrap {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}
.profil-card-block {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}
.profil-card-block h2 {
    font-size: 1.35rem;
    font-weight: 800;
    color: #0048a8;
    margin-bottom: 0.85rem;
    display: flex;
    align-items: center;
    gap: 10px;
}
.profil-card-block p {
    color: #475569;
    font-size: 0.98rem;
    line-height: 1.7;
}
@media (max-width: 900px) {
    .profil-container-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')

<section class="profil-hero-banner">
    <div class="site-container">
        <div class="profil-breadcrumb">
            <a href="{{ route('beranda') }}">Beranda</a>
            <span>/</span>
            <span>Profil Lembaga</span>
        </div>
        <h1>Profil Perpustakaan</h1>
        <p>Mengenal Sejarah, Visi, dan Misi Dinas Kearsipan dan Perpustakaan Daerah Kabupaten Purwakarta</p>
    </div>
</section>

<section class="profil-main-section">
    <div class="site-container">
        <div class="profil-container-grid">
            <div class="profil-img-card">
                <img src="{{ asset('images/profil.jpg') }}" alt="Gedung Perpustakaan Daerah Purwakarta">
            </div>

            <div class="profil-details-wrap">
                <div class="profil-card-block">
                    <h2>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        Tentang Perpustakaan Daerah
                    </h2>
                    <p>
                        Perpustakaan Daerah Kabupaten Purwakarta dikelola oleh Dinas Arsip dan Perpustakaan Daerah Kabupaten Purwakarta untuk melayani kebutuhan literasi, riset, dan informasi masyarakat secara menyeluruh dan inklusif.
                    </p>
                </div>

                <div class="profil-card-block">
                    <h2>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Sejarah Singkat
                    </h2>
                    <p>
                        Keberadaan perpustakaan daerah di Kabupaten Purwakarta telah dimulai sejak tahun 1953 dengan keputusan Kepala JAPERNAS Kementerian Pendidikan, Pengajaran dan Kebudayaan tanggal 26 November 1953 tentang Peraturan Penyelenggaraan Perpustakaan Rakyat Jabatan Pendidikan Masyarakat. Pada tahun 1978 didirikan Taman Pustaka Masyarakat dengan status TPM/C yang beralamat di komplek SD Singawinata Jl. K. K. Singawinata di bawah naungan Cabang Dinas Pendidikan Kabupaten Purwakarta.
                    </p>
                </div>

                <div class="profil-card-block">
                    <h2>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="12 8 8 12 12 16 12 8"></polygon></svg>
                        Visi & Misi
                    </h2>
                    <p style="margin-bottom: 0.75rem;">
                        <strong>Visi:</strong><br>
                        Membangun budaya baca dan masyarakat cerdas literasi di seluruh lapisan masyarakat Kabupaten Purwakarta.
                    </p>
                    <p>
                        <strong>Misi:</strong><br>
                        Menyelenggarakan layanan perpustakaan yang modern, meningkatkan minat dan kegemaran membaca, menyediakan koleksi bahan pustaka yang relevan, serta melestarikan kearifan lokal dan naskah kuno daerah Purwakarta.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection