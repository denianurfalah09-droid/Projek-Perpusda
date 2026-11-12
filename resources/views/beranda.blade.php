@extends('layouts.frontend')

@section('title', 'Beranda - Perpustakaan Daerah Kabupaten Purwakarta')

@section('content')

<!-- ================= 1. HERO SECTION ================= -->
<section class="hero-section">
    <div class="hero-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="site-container hero-container">
        <div class="hero-text-col scroll-reveal">
            <div class="hero-badge">
                <span class="pulse-dot"></span>
                <span>Pusat Literasi & Informasi Terpadu Purwakarta</span>
            </div>

            <h1 class="hero-title">
                Jelajahi Cakrawala Ilmu di <span class="text-highlight">Perpusda Purwakarta</span>
            </h1>

            <p class="hero-description">
                Temukan ribuan koleksi buku fisik dan literatur digital, nikmati ruang baca modern ber-AC, serta manfaatkan berbagai layanan edukatif untuk mewujudkan masyarakat Purwakarta yang cerdas dan berbudaya literasi.
            </p>

            <!-- FORM PENCARIAN BUKU CEPAT -->
            <form action="{{ route('katalog') }}" method="GET" class="hero-search-bar">
                <div class="search-input-wrapper">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" name="search" placeholder="Cari judul buku, penulis, atau penerbit..." aria-label="Cari buku">
                </div>
                <button type="submit" class="btn-search-hero">
                    <span>Cari Buku</span>
                </button>
            </form>

            <div class="hero-cta-buttons">
                <a href="{{ route('katalog') }}" class="btn-primary-hero">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    <span>Jelajahi Katalog</span>
                </a>
                <a href="{{ route('kartu.anggota') }}" class="btn-secondary-hero">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                        <line x1="2" y1="10" x2="22" y2="10"></line>
                    </svg>
                    <span>Daftar Anggota</span>
                </a>
                <a href="{{ route('layanan') }}" class="btn-link-hero">
                    <span>Lihat Layanan &rarr;</span>
                </a>
            </div>
        </div>

        <div class="hero-image-col scroll-reveal">
            <div class="hero-image-wrapper">
                <img src="{{ asset('images/nobg.png') }}" alt="Logo Perpusda Purwakarta" class="hero-main-img">
                
                <!-- Floating Card 1 -->
                <div class="floating-badge badge-koleksi">
                    <div class="badge-icon">📚</div>
                    <div>
                        <strong>{{ $totalBuku }}+ Judul Buku</strong>
                        <span>Tersedia di Katalog</span>
                    </div>
                </div>

                <!-- Floating Card 2 -->
                <div class="floating-badge badge-akses">
                    <div class="badge-icon">🏛️</div>
                    <div>
                        <strong>Buka Setiap Hari</strong>
                        <span>Senin s/d minggu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================= 2. STATISTIK COUNTER ================= -->
<section class="stats-section">
    <div class="site-container">
        <div class="stats-grid">
            <div class="stat-card scroll-reveal">
                <div class="stat-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">{{ $totalBuku }}</h3>
                    <p class="stat-label">Total Judul Buku</p>
                </div>
            </div>

            <div class="stat-card scroll-reveal">
                <div class="stat-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">{{ $totalKategori }}</h3>
                    <p class="stat-label">Kategori Literasi</p>
                </div>
            </div>

            <div class="stat-card scroll-reveal">
                <div class="stat-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">15.000+</h3>
                    <p class="stat-label">Pembaca & Pengunjung</p>
                </div>
            </div>

            <div class="stat-card scroll-reveal">
                <div class="stat-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">6 Hari</h3>
                    <p class="stat-label">Layanan Per Minggu</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================= 3. TENTANG PERPUSDA ================= -->
<section class="about-section">
    <div class="site-container">
        <div class="about-grid">
            <div class="about-image-col scroll-reveal">
                <div class="about-image-frame">
                    <img src="{{ asset('images/profil.jpg') }}" alt="Gedung Perpusda Purwakarta" class="about-img">
                    <div class="about-badge-exp">
                        <span class="exp-number">Purwakarta</span>
                        <span class="exp-text">Istimewa & Berbudaya</span>
                    </div>
                </div>
            </div>

            <div class="about-content-col scroll-reveal">
                <div class="section-tag">SELAYANG PANDANG</div>
                <h2 class="section-title">Membangun Masa Depan Gemilang Melalui Semangat Literasi</h2>
                <p class="section-desc">
                    Perpustakaan Daerah Kabupaten Purwakarta hadir sebagai rumah bagi setiap insan yang haus akan pengetahuan. Kami mengintegrasikan sarana fisik yang representatif dengan katalog literasi modern guna mendorong minat baca generasi muda dan masyarakat umum di bumi Purwakarta.
                </p>

                <div class="about-features">
                    <div class="about-feature-item">
                        <div class="check-icon">✓</div>
                        <div>
                            <strong>Koleksi Buku Lengkap & Variatif</strong>
                            <span>Tersedia buku sains, novel, sejarah lokal, agama, hingga buku ramah anak.</span>
                        </div>
                    </div>
                    <div class="about-feature-item">
                        <div class="check-icon">✓</div>
                        <div>
                            <strong>Fasilitas Ruang Baca Nyaman</strong>
                            <span>Ruang ber-AC dengan meja belajar perorangan maupun kelompok dan akses internet WiFi.</span>
                        </div>
                    </div>
                    <div class="about-feature-item">
                        <div class="check-icon">✓</div>
                        <div>
                            <strong>Pelayanan Ramah & Berorientasi Komunitas</strong>
                            <span>Didukung pustakawan profesional yang siap membantu penelusuran pustaka Anda.</span>
                        </div>
                    </div>
                </div>

                <div class="about-actions">
                    <a href="{{ route('profil') }}" class="btn-primary">
                        <span>Baca Profil Lengkap</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================= 4. KATEGORI PILIHAN ================= -->
<section class="categories-section">
    <div class="site-container">
        <div class="section-header-center scroll-reveal">
            <div class="section-tag">KATEGORI LITERASI</div>
            <h2 class="section-title">Temukan Buku Sesuai Minat Anda</h2>
            <p class="section-subtitle">Jelajahi berbagai klasifikasi buku yang telah kami susun untuk mempermudah pencarian Anda</p>
        </div>

        <div class="category-cards-grid">
            @foreach ($categories as $cat)
                <a href="{{ route('katalog', ['kategori' => $cat->nama_kategori]) }}" class="cat-card scroll-reveal">
                    <div class="cat-icon-box">{{ $cat->icon ?? '📖' }}</div>
                    <div class="cat-details">
                        <h3 class="cat-name">{{ $cat->nama_kategori }}</h3>
                        <span class="cat-count">{{ $cat->buku_count ?? 0 }} Koleksi Buku</span>
                    </div>
                    <div class="cat-arrow">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="section-footer-action scroll-reveal">
            <a href="{{ route('kategori.buku') }}" class="btn-outline-blue">
                <span>Lihat Seluruh Kategori Buku &rarr;</span>
            </a>
        </div>
    </div>
</section>


<!-- ================= 5. BUKU TERBARU & UNGGULAN ================= -->
<section class="books-section">
    <div class="site-container">
        <div class="section-header-between scroll-reveal">
            <div>
                <div class="section-tag">KOLEKSI TERBARU</div>
                <h2 class="section-title">Buku Terpopuler di Perpustakaan</h2>
                <p class="section-subtitle">Daftar koleksi pilihan terbaru yang siap Anda baca dan pinjam</p>
            </div>
            <a href="{{ route('katalog') }}" class="btn-secondary-link">
                <span>Lihat Semua Katalog &rarr;</span>
            </a>
        </div>

        <div class="books-grid">
            @forelse ($featuredBooks as $buku)
                <div class="home-book-card scroll-reveal">
                    <div class="book-cover-area">
                        @if ($buku->gambar && file_exists(public_path('uploads/katalog/' . $buku->gambar)))
                            <img src="{{ asset('uploads/katalog/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="book-img" loading="lazy">
                        @else
                            <div class="book-cover-fallback">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                                <span class="fallback-title">{{ \Illuminate\Support\Str::limit($buku->judul, 22) }}</span>
                            </div>
                        @endif
                        <span class="book-badge-cat">{{ $buku->kategori }}</span>
                    </div>

                    <div class="book-meta-area">
                        <h3 class="book-title-heading" title="{{ $buku->judul }}">{{ $buku->judul }}</h3>
                        <div class="book-meta-row">
                            <span class="meta-label">Penulis:</span>
                            <span class="meta-val">{{ $buku->penulis }}</span>
                        </div>
                        <div class="book-meta-row">
                            <span class="meta-label">Penerbit:</span>
                            <span class="meta-val">{{ $buku->penerbit }} ({{ $buku->tahun }})</span>
                        </div>
                        <div class="book-card-bottom">
                            <span class="book-avail-status">✓ Tersedia</span>
                            <a href="{{ route('katalog', ['search' => $buku->judul]) }}" class="btn-detail-book" title="Cari di Katalog">Lihat</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-books-state">
                    <p>Koleksi buku sedang diperbarui. Silakan kunjungi halaman katalog untuk pencarian lengkap.</p>
                </div>
            @endforelse
        </div>

        <div class="books-bottom-cta scroll-reveal">
            <a href="{{ route('katalog') }}" class="btn-primary-large">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <span>Buka Katalog Lengkap ({{ $totalBuku }} Buku)</span>
            </a>
        </div>
    </div>
</section>


<!-- ================= 6. LAYANAN UNGGULAN ================= -->
<section class="services-section">
    <div class="site-container">
        <div class="section-header-center scroll-reveal">
            <div class="section-tag">PELAYANAN PUBLIK</div>
            <h2 class="section-title">Layanan Perpustakaan Untuk Anda</h2>
            <p class="section-subtitle">Kami menyediakan berbagai layanan prima untuk menunjang kegiatan literasi dan riset</p>
        </div>

        <div class="services-grid">
            <div class="service-card scroll-reveal">
                <div class="service-icon">📖</div>
                <h3>Sirkulasi Peminjaman Buku</h3>
                <p>Layanan peminjaman dan pengembalian buku fisik dengan proses cepat dan mudah bagi seluruh pemegang kartu anggota.</p>
                <a href="{{ route('layanan') }}" class="service-link">Selengkapnya &rarr;</a>
            </div>

            <div class="service-card scroll-reveal">
                <div class="service-icon">💳</div>
                <h3>Pembuatan Kartu Anggota</h3>
                <p>Pendaftaran keanggotaan resmi Perpusda Purwakarta secara mudah bagi pelajar, mahasiswa, dan masyarakat umum.</p>
                <a href="{{ route('kartu.anggota') }}" class="service-link">Selengkapnya &rarr;</a>
            </div>

            <div class="service-card scroll-reveal">
                <div class="service-icon">🚐</div>
                <h3>Perpustakaan Keliling</h3>
                <p>Armada mobil perpustakaan keliling yang menjangkau sekolah, desa, dan fasilitas umum di pelosok Purwakarta.</p>
                <a href="{{ route('program.unggulan') }}" class="service-link">Selengkapnya &rarr;</a>
            </div>

            <div class="service-card scroll-reveal">
                <div class="service-icon">❄️</div>
                <h3>Ruang Baca Ber-AC</h3>
                <p>Area membaca yang hening, bersih, sejuk, dan dilengkapi meja belajar kondusif untuk membaca maupun mengerjakan tugas.</p>
                <a href="{{ route('fasilitas') }}" class="service-link">Selengkapnya &rarr;</a>
            </div>

            <div class="service-card scroll-reveal">
                <div class="service-icon">🧸</div>
                <h3>Ruang Ramah Anak</h3>
                <p>Pojok baca khusus anak dengan koleksi buku cerita bergambar, mainan edukatif, dan tempat lesehan aman.</p>
                <a href="{{ route('fasilitas') }}" class="service-link">Selengkapnya &rarr;</a>
            </div>

            <div class="service-card scroll-reveal">
                <div class="service-icon">🌐</div>
                <h3>Internet & Komputer Riset</h3>
                <p>Fasilitas komputer penelusuran OPAC dan akses internet nirkabel (WiFi) berkecepatan tinggi gratis bagi pengunjung.</p>
                <a href="{{ route('fasilitas') }}" class="service-link">Selengkapnya &rarr;</a>
            </div>
        </div>
    </div>
</section>


<!-- ================= 7. BERITA & WARTA TERKINI ================= -->
<section class="news-section">
    <div class="site-container">
        <div class="section-header-between scroll-reveal">
            <div>
                <div class="section-tag">WARTA PERPUSDA</div>
                <h2 class="section-title">Berita & Kegiatan Terbaru</h2>
                <p class="section-subtitle">Ikuti update kegiatan literasi dan informasi terkini dari kami</p>
            </div>
            <a href="{{ route('berita') }}" class="btn-secondary-link">
                <span>Lihat Semua Berita &rarr;</span>
            </a>
        </div>

        <div class="news-grid">
            <article class="news-card scroll-reveal">
                <div class="news-img-wrapper">
                    <img src="{{ asset('images/berita1.jpg') }}" alt="Kegiatan Literasi Anak" loading="lazy">
                    <span class="news-category-badge">Edukasi</span>
                </div>
                <div class="news-content">
                    <span class="news-date">📅 10 September 2024</span>
                    <h3 class="news-title">Peningkatan Minat Baca Generasi Muda Purwakarta Melalui Festival Literasi Daerah</h3>
                    <p class="news-excerpt">Disarpusda Purwakarta menggelar festival literasi daerah yang disambut antusias ratusan pelajar dari berbagai sekolah...</p>
                    <a href="{{ route('berita') }}" class="news-read-more">Baca Selengkapnya &rarr;</a>
                </div>
            </article>

            <article class="news-card scroll-reveal">
                <div class="news-img-wrapper">
                    <img src="{{ asset('images/berita2.webp') }}" alt="Perpustakaan Keliling" loading="lazy">
                    <span class="news-category-badge">Layanan</span>
                </div>
                <div class="news-content">
                    <span class="news-date">📅 05 September 2024</span>
                    <h3 class="news-title">Mobil Perpustakaan Keliling Sambangi Sekolah di Wilayah Pedesaan Purwakarta</h3>
                    <p class="news-excerpt">Program jemput bola perpustakaan keliling terus digalakkan guna menjamin pemerataan akses bacaan bermutu bagi anak-anak...</p>
                    <a href="{{ route('berita') }}" class="news-read-more">Baca Selengkapnya &rarr;</a>
                </div>
            </article>

            <article class="news-card scroll-reveal">
                <div class="news-img-wrapper">
                    <img src="{{ asset('images/berita3.jpeg') }}" alt="Bedah Buku Purwakarta" loading="lazy">
                    <span class="news-category-badge">Kegiatan</span>
                </div>
                <div class="news-content">
                    <span class="news-date">📅 28 Agustus 2024</span>
                    <h3 class="news-title">Bedah Buku Sejarah Purwakarta: Merawat Ingatan Kolektif dan Warisan Budaya</h3>
                    <p class="news-excerpt">Diskusi hangat bedah buku sejarah menghadirkan sejarawan lokal dan budayawan Purwakarta untuk mengupas tuntas asal-usul kota...</p>
                    <a href="{{ route('berita') }}" class="news-read-more">Baca Selengkapnya &rarr;</a>
                </div>
            </article>
        </div>
    </div>
</section>


<!-- ================= 8. JAM OPERASIONAL & LOKASI ================= -->
<section class="location-section">
    <div class="site-container">
        <div class="location-box scroll-reveal">
            <div class="location-info-col">
                <div class="section-tag" style="color: #60a5fa;">JAM LAYANAN & LOKASI</div>
                <h2 class="location-title">Kunjungi Perpustakaan Kami</h2>
                <p class="location-desc">Kami siap menyambut Anda dengan suasana membaca yang nyaman dan tenang di pusat kota Purwakarta.</p>

                <div class="hours-cards">
                    <div class="hour-item">
                        <div class="hour-day">Senin - Kamis</div>
                        <div class="hour-time">08.00 - 15.30 WIB</div>
                    </div>
                    <div class="hour-item">
                        <div class="hour-day">Jum'at</div>
                        <div class="hour-time">09.00 - 16.00 WIB</div>
                    </div>
                    <div class="hour-item">
                        <div class="hour-day">Sabtu & Minggu</div>
                        <div class="hour-time">09.00 - 13.00 WIB</div>
                    </div>
                    <div class="hour-item closed">
                        <div class="hour-day">Hari Libur Nasional & Cuti Bersama</div>
                        <div class="hour-time">Tutup</div>
                    </div>
                </div>

                <div class="location-address">
                    <div class="addr-icon">📍</div>
                    <div>
                        <strong>Alamat Kantor:</strong>
                        <span>Jl. KK Singawinata No. 47, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114</span>
                    </div>
                </div>
            </div>

            <div class="location-action-col">
                <div class="action-card-inner">
                    <h3>Ada Pertanyaan atau Ingin Kunjungan Rombongan?</h3>
                    <p>Kami menerima kunjungan rombongan sekolah, instansi, maupun komunitas. Hubungi petugas layanan kami untuk konfirmasi jadwal.</p>
                    <div class="action-btn-group">
                        <a href="https://maps.google.com/?q=Perpustakaan+Daerah+Kabupaten+Purwakarta" target="_blank" rel="noopener" class="btn-white-action">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                            <span>Petunjuk Arah Google Maps</span>
                        </a>
                        <a href="https://www.instagram.com/perpusdapwk?stkn=MXJpenM0emhpdXAwNw==" target="_blank" rel="noopener" class="btn-instagram-action">
                            <span>💬 Hubungi via Instagram</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection