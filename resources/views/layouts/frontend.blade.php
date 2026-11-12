<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Perpustakaan Daerah Kabupaten Purwakarta - Layanan Literasi, Katalog Buku, dan Edukasi Masyarakat">
    <title>@yield('title', 'Perpustakaan Daerah Kabupaten Purwakarta')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Master & Halaman -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

    <!-- ================= NAVBAR ================= -->
    <header class="navbar-wrapper" id="mainHeader">
        <div class="navbar-container">
            <a href="{{ route('beranda') }}" class="brand-logo" aria-label="Beranda Perpusda Purwakarta">
                <div class="brand-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <div class="brand-text">
                    <span class="brand-title">PERPUSDA</span>
                    <span class="brand-sub">PURWAKARTA</span>
                </div>
            </a>

            <!-- NAV MENU DESKTOP -->
            <nav class="nav-desktop" aria-label="Navigasi Utama">
                <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a>
                <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog') ? 'active' : '' }}">Katalog Buku</a>
                <a href="{{ route('kategori.buku') }}" class="{{ request()->routeIs('kategori.buku') ? 'active' : '' }}">Kategori</a>
                <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a>
                <a href="{{ route('fasilitas') }}" class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">Fasilitas</a>
                <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a>
                <a href="{{ route('organigram') }}" class="{{ request()->routeIs('organigram') ? 'active' : '' }}">Organigram</a>
            </nav>

            <div class="navbar-actions">
                <a href="{{ route('admin.login') }}" class="btn-admin-nav" title="Login Petugas Perpustakaan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Masuk Petugas</span>
                </a>

                <!-- HAMBURGER BUTTON -->
                <button class="hamburger-btn" id="mobileMenuBtn" type="button" aria-label="Buka Menu Navigasi" aria-expanded="false">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- MOBILE MENU DRAWER & OVERLAY -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="mobile-drawer-header">
            <div class="brand-logo">
                <div class="brand-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <div class="brand-text">
                    <span class="brand-title">PERPUSDA</span>
                    <span class="brand-sub">PURWAKARTA</span>
                </div>
            </div>
            <button class="close-drawer-btn" id="closeDrawerBtn" type="button" aria-label="Tutup Menu">&times;</button>
        </div>

        <nav class="mobile-nav-links">
            <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
                <span>🏠 Beranda</span>
            </a>
            <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
                <span>🏢 Profil Perpustakaan</span>
            </a>
            <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog') ? 'active' : '' }}">
                <span>📚 Katalog Buku</span>
            </a>
            <a href="{{ route('kategori.buku') }}" class="{{ request()->routeIs('kategori.buku') ? 'active' : '' }}">
                <span>🏷️ Kategori Buku</span>
            </a>
            <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}">
                <span>⭐ Layanan</span>
            </a>
            <a href="{{ route('fasilitas') }}" class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">
                <span>🏛️ Fasilitas</span>
            </a>
            <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'active' : '' }}">
                <span>📰 Berita & Informasi</span>
            </a>
            <a href="{{ route('organigram') }}" class="{{ request()->routeIs('organigram') ? 'active' : '' }}">
                <span>👥 Struktur Organigram</span>
            </a>
            <a href="{{ route('kartu.anggota') }}" class="{{ request()->routeIs('kartu.anggota') ? 'active' : '' }}">
                <span>💳 Kartu Anggota</span>
            </a>
            <a href="{{ route('program.unggulan') }}" class="{{ request()->routeIs('program.unggulan') ? 'active' : '' }}">
                <span>🚀 Program Unggulan</span>
            </a>
        </nav>

        <div class="mobile-drawer-footer">
            <a href="{{ route('admin.login') }}" class="btn-drawer-admin">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                <span>Login Petugas / Admin</span>
            </a>
        </div>
    </div>


    <!-- ================= KONTEN UTAMA ================= -->
    <main class="page-main-content">
        @yield('content')
    </main>


    <!-- ================= FOOTER ================= -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="footer-container">
                <!-- Kolom 1: Profil Brand -->
                <div class="footer-col footer-col-brand">
                    <div class="footer-brand">
                        <div class="brand-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <div class="brand-text">
                            <h3>PERPUSDA</h3>
                            <span>PURWAKARTA</span>
                        </div>
                    </div>
                    <p class="footer-desc">
                        Dinas Kearsipan dan Perpustakaan Daerah Kabupaten Purwakarta. Pusat literasi terpadu, penyedia akses ilmu pengetahuan, dan ruang edukasi inklusif bagi seluruh lapisan masyarakat.
                    </p>
                    <div class="footer-socials">
                        <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook" class="social-link">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                        </a>
                        <a href="https://www.instagram.com/perpusdapwk?stkn=MXJpenM0emhpdXAwNw==" target="_blank" rel="noopener" aria-label="Instagram" class="social-link">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                        <a href="https://www.youtube.com/@disipusdapwk/videos" target="_blank" rel="noopener" aria-label="YouTube" class="social-link">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Cepat -->
                <div class="footer-col">
                    <h4 class="footer-title">Navigasi Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('beranda') }}">Beranda Utama</a></li>
                        <li><a href="{{ route('profil') }}">Profil Perpustakaan</a></li>
                        <li><a href="{{ route('katalog') }}">Katalog Koleksi Buku</a></li>
                        <li><a href="{{ route('kategori.buku') }}">Kategori Buku</a></li>
                        <li><a href="{{ route('berita') }}">Warta & Berita</a></li>
                        <li><a href="{{ route('organigram') }}">Struktur Organisasi</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Layanan Unggulan -->
                <div class="footer-col">
                    <h4 class="footer-title">Layanan Publik</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('kartu.anggota') }}">Pembuatan Kartu Anggota</a></li>
                        <li><a href="{{ route('layanan') }}">Sirkulasi Peminjaman Buku</a></li>
                        <li><a href="{{ route('fasilitas') }}">Ruang Baca & Referensi</a></li>
                        <li><a href="{{ route('program.unggulan') }}">Perpustakaan Keliling</a></li>
                        <li><a href="{{ route('fasilitas') }}">Akses Internet & WiFi</a></li>
                        <li><a href="{{ route('fasilitas') }}">Ruang Baca Ramah Anak</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Kontak & Jam Buka -->
                <div class="footer-col footer-col-contact">
                    <h4 class="footer-title">Kontak & Lokasi</h4>
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <span>Jl. KK Singawinata No. 47, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <span>(0264) 210375</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">✉️</span>
                        <span>disarpusda@purwakartakab.go.id</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">🕒</span>
                        <span>Senin - Kamis: 08.00 - 15.30 WIB<br>Jum'at: 09.00 - 16.00<br>Sabtu & Minggu: 09.00 - 12.00 WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-container bottom-flex">
                <p>&copy; {{ date('Y') }} Perpustakaan Daerah Kabupaten Purwakarta. Seluruh Hak Cipta Dilindungi.</p>
                <div class="bottom-links">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <span class="sep">•</span>
                    <a href="{{ route('katalog') }}">Katalog</a>
                    <span class="sep">•</span>
                    <a href="{{ route('admin.login') }}">Portal Petugas</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- TOMBOL BACK TO TOP -->
    <button class="back-to-top" id="backToTopBtn" aria-label="Kembali ke atas" type="button">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>

    <!-- SCRIPTS INTERAKTIF & ANIMASI SCROLL -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Mobile Menu Drawer
            const mobileBtn = document.getElementById('mobileMenuBtn');
            const closeBtn = document.getElementById('closeDrawerBtn');
            const drawer = document.getElementById('mobileDrawer');
            const overlay = document.getElementById('mobileOverlay');

            function openDrawer() {
                drawer.classList.add('open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                if (mobileBtn) mobileBtn.setAttribute('aria-expanded', 'true');
            }

            function closeDrawer() {
                drawer.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
                if (mobileBtn) mobileBtn.setAttribute('aria-expanded', 'false');
            }

            if (mobileBtn) mobileBtn.addEventListener('click', openDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
            if (overlay) overlay.addEventListener('click', closeDrawer);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && drawer.classList.contains('open')) {
                    closeDrawer();
                }
            });

            // 2. Header Scroll Effect & Back to Top
            const header = document.getElementById('mainHeader');
            const backToTop = document.getElementById('backToTopBtn');

            window.addEventListener('scroll', function () {
                if (window.scrollY > 40) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }

                if (window.scrollY > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
                }
            }, { passive: true });

            if (backToTop) {
                backToTop.addEventListener('click', function () {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // 3. Scroll Reveal Animations
            const revealElements = document.querySelectorAll('.scroll-reveal');
            if ('IntersectionObserver' in window && revealElements.length > 0) {
                const observer = new IntersectionObserver((entries, obs) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            obs.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.12,
                    rootMargin: '0px 0px -40px 0px'
                });

                revealElements.forEach(el => observer.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('revealed'));
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
