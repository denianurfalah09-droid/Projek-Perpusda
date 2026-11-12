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


<section class="judul-halaman">
    <h1>Struktur Organigram</h1>
</section>


<main class="organigram-container">

    {{-- ================= PIMPINAN ================= --}}

    <section class="organigram-section">

        <h2>Pimpinan</h2>

        <div class="organigram-grid pimpinan-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>AAN, S.Pd.I., K.P., M.Si.</h3>
                <p>Kepala Dinas</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dr. Kusnandar, S.Pd, M.T</h3>
                <p>Sekretaris Dinas</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Desi Hendriyani, STP, MP</h3>
                <p>Kepala Bidang Pembinaan, Pelestarian dan Pengembangan Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Iyus Jayusman, S.T., M.M</h3>
                <p>Kepala Bidang Pengembangan dan Pelestarian Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Minar R.S, S.E, M.AP</h3>
                <p>Kepala Bidang Pengelolaan dan Pemeliharaan Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dra. Hj. Uce Martina, AF.MP</h3>
                <p>Kepala Bidang Layanan dan Otomasi Perpustakaan</p>
            </div>

        </div>

    </section>


    {{-- ================= SEKRETARIAT ================= --}}

    <section class="organigram-section">

        <h2>Sekretariat</h2>

        <div class="organigram-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dr. Kusnandar, S.Pd, M.T</h3>
                <p>Sekretaris Dinas</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Lasmi Binawati, S.E</h3>
                <p>Kepala Sub Bagian Keuangan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Hj. Elly Setiadewi, S.T, M.M</h3>
                <p>Analis Sumber Daya Manusia Aparatur</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Abdul Gani, S.E, M.M</h3>
                <p>Perencana Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Rd. Ronnie Kurniawan, S.T</h3>
                <p>Bendahara Pengeluaran</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ika Puspita Sari</h3>
                <p>Pengelola Kepegawaian</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Sri Cahyani</h3>
                <p>Pengadministrasi Keuangan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ratni Nuryati</h3>
                <p>Pengelola Akuntansi</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ahmad Kosidin</h3>
                <p>Pengelola Sarana dan Prasarana</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Abdul Rauf</h3>
                <p>Pengadministrasi Umum</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Evi Sri Nuryanti, A.Md</h3>
                <p>JF Arsiparis Penyelia</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Bibo Satrio, A.Md</h3>
                <p>JF Arsiparis Pelaksana Lanjutan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Diki Waryanto, A.Md</h3>
                <p>JF Arsiparis Pelaksana Lanjutan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Fabianto Wahyu K.J., S.Komp</h3>
                <p>JF Pranata Komputer Ahli Pertama</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Maudina Hanifah, S.M</h3>
                <p>Pengelola Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Muhammad Ghiffari</h3>
                <p>Pengelola Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Zahran Labib Sulaiman</h3>
                <p>Pengelola Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Karyono</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Hendra Irawan, S.T</h3>
                <p>JF Pranata Komputer Pertama</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Setiawan</h3>
                <p>Pengelola Barang dan Jasa</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ade Jakaria</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Markuwat</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Sutrisno</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Muhamad Fahri Mubarok</h3>
                <p>Petugas Keamanan</p>
            </div>

        </div>

    </section>


    {{-- ================= BIDANG PEMBINAAN ================= --}}

    <section class="organigram-section">

        <h2>Bidang Pembinaan, Pelestarian dan Pengembangan Kearsipan</h2>

        <div class="organigram-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Desi Hendrayani, S.TP, M.P</h3>
                <p>Kepala Bidang Pembinaan, Pelestarian dan Pengembangan Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Eko Sulistiawan, S.E</h3>
                <p>Arsiparis Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Diki Waryanto, A.Md</h3>
                <p>JF Arsiparis Pelaksana Lanjut</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Namira Ramadhina Putri, A.md.MRA</h3>
                <p>JF Arsiparis Pelaksana Terampil</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Deni Jatnika Supardi, S.H</h3>
                <p>Pranata Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Soleh Supena</h3>
                <p>Pengadministrasi Keuangan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Yogie Friansyah, S.T</h3>
                <p>Pengelola Kearsipan</p>
            </div>

        </div>

    </section>


    {{-- ================= BIDANG PENGELOLAAN ================= --}}

    <section class="organigram-section">

        <h2>Bidang Pengelolaan dan Pemeliharaan Kearsipan</h2>

        <div class="organigram-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Minar R.S, S.E, M.AP</h3>
                <p>Kepala Bidang Pengelolaan dan Pemeliharaan Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Yeni Ernawati, S.H</h3>
                <p>Arsiparis Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Puri Prameswari, S.H</h3>
                <p>Arsiparis Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Yani Lestari</h3>
                <p>Pranata Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Asep Sodikin</h3>
                <p>Arsiparis Ahli Pertama</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Silvia Dwi Apriliani, A.Md</h3>
                <p>JF Arsiparis Pelaksana Terampil</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Maryadi Sudarmono</h3>
                <p>Pengelola Kearsipan</p>
            </div>

        </div>

    </section>


    {{-- ================= BIDANG LAYANAN ================= --}}

    <section class="organigram-section">

        <h2>Bidang Layanan dan Otomasi Perpustakaan</h2>

        <div class="organigram-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dra. Hj. Uce Martina, AF.MP</h3>
                <p>Kepala Bidang Layanan dan Otomasi Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Emma Hermawati, S.Sos</h3>
                <p>Pustakawan Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ritta Utami Herawati, S.Sos</h3>
                <p>Pustakawan Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Imadudin Somantri, S.H</h3>
                <p>Pustakawan Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Farhan Kamaludin, A.Md</h3>
                <p>JF Pustakawan Terampil</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ajeng Indah Sulastri, A.Md</h3>
                <p>JF Pustakawan Terampil</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Yana Supriatna</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dhany Mudyana, S.Pd</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Muhamad Noval</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Renaldo Eliferd Potu</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Jesica Prisilia H., S.I.Pus</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Misbah Munir, S.Pdi</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Lia Mulyahati</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Hana Sari Nurjihan, S.Pd</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

        </div>

    </section>


    {{-- ================= BIDANG PENGEMBANGAN ================= --}}

    <section class="organigram-section">

        <h2>Bidang Pengembangan dan Pelestarian Perpustakaan</h2>

        <div class="organigram-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Iyus Jayusman, S.T., M.M</h3>
                <p>Kepala Bidang Pengembangan dan Pelestarian Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Irma, S.E</h3>
                <p>Pustakawan Ahli Muda</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Tonny Prasetya Nugraha</h3>
                <p>JF Arsiparis Ahli Pertama</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Rendy Iwan Hardian</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ecin Kuraesin</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dewi Sri Susilawati, S.I.Pus</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Triana Apriani, SHI, ME</h3>
                <p>Pengelola Perpustakaan</p>
            </div>

        </div>

    </section>


    {{-- ================= BALE PANYAWANGAN DIORAMA ================= --}}

    <section class="organigram-section">

        <h2>Bale Panyawangan Diorama</h2>

        <div class="organigram-grid">

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Edi Rasidi, A.Md</h3>
                <p>Kepala UPTD Diorama Kearsipan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Arie Lukmanul Hakim, S.Ip</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Fairuz Hadiani Mardhiyah Putri, S.Pd.M.Pd</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Indri Sukma Wirawati, S.T</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Chandra Januar W., S.Sos</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Yopi Aprianto, S.T</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Dina Meylinda, S.E</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Hadi Kusuma, S.Kom</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Mutia Faramida, A.Md I.Kom</h3>
                <p>Guide</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Rina Sintia</h3>
                <p>Penerima Tamu</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Rani Meydianti</h3>
                <p>Penerima Tamu</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Amirah S. Zahra</h3>
                <p>Penerima Tamu</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Erika Putri Hidayah</h3>
                <p>Penerima Tamu</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Rifan Pratama</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ari Riyanto</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Derry Wijaya Kusumah, S.M</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Ali Muslihat</h3>
                <p>Petugas Kebersihan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Eggy Apriyana Putra</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Hendra Sujana</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Muhamad Jembar</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Enjang Hasanudin</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Rachman Saleh</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Muhamad Mansyur</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Irvan Maulana</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Zulkarnaen</h3>
                <p>Petugas Keamanan</p>
            </div>

            <div class="organigram-card">
                <div class="person-icon">👤</div>
                <h3>Mohamad Saepuloh</h3>
                <p>Petugas Keamanan</p>
            </div>

        </div>

    </section>

</main>
    </div>
</section>

@endsection