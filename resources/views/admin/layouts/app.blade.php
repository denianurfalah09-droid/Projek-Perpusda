<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Perpusda Purwakarta')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    <!-- OVERLAY UNTUK MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="adminSidebar">

        <!-- LOGO -->
        <div class="sidebar-logo">
            <div class="logo-circle">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
            </div>

            <div class="logo-text">
                <h2>Perpusda</h2>
                <span>Purwakarta</span>
            </div>

            <button class="sidebar-close-btn" id="sidebarCloseBtn" type="button" aria-label="Close Sidebar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- MENU -->
        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1"></rect><rect x="14" y="3" width="7" height="5" rx="1"></rect><rect x="14" y="12" width="7" height="9" rx="1"></rect><rect x="3" y="16" width="7" height="5" rx="1"></rect></svg>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>

            <a href="{{ route('admin.profil') }}"
               class="menu-item {{ request()->routeIs('admin.profil') ? 'active' : '' }}" title="Profile">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </span>
                <span class="menu-title">Profile</span>
            </a>

            <a href="{{ route('admin.berita') }}"
                class="menu-item {{ request()->routeIs('admin.berita*') ? 'active' : '' }}" title="Berita">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6Z"></path></svg>
                </span>
                <span class="menu-title">Berita</span>
            </a>

            <a href="{{ route('admin.katalog') }}"
                class="menu-item {{ request()->routeIs('admin.katalog*') ? 'active' : '' }}" title="Katalog Buku">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                </span>
                <span class="menu-title">Katalog Buku</span>
            </a>
            
            <a href="{{ route('admin.kategori') }}" class="menu-item {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}" title="Kategori Buku">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                </span>
                <span class="menu-title">Kategori Buku</span>
            </a>

            <a href="{{ route('admin.layanan') }}" class="menu-item {{ request()->routeIs('admin.layanan*') ? 'active' : '' }}" title="Layanan">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                </span>
                <span class="menu-title">Layanan</span>
            </a>

            <a href="{{ route('admin.fasilitas') }}" class="menu-item {{ request()->routeIs('admin.fasilitas*') ? 'active' : '' }}" title="Fasilitas">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                </span>
                <span class="menu-title">Fasilitas</span>
            </a>

            <a href="{{ route('admin.user') }}" class="menu-item {{ request()->routeIs('admin.user*') ? 'active' : '' }}" title="User">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </span>
                <span class="menu-title">User</span>
            </a>

            <a href="{{ route('admin.organigram') }}" class="menu-item {{ request()->routeIs('admin.organigram*') ? 'active' : '' }}" title="Organigram">
                <span class="menu-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="3"></circle><path d="M12 8v6"></path><path d="M5 14h14"></path><path d="M5 14v4"></path><path d="M19 14v4"></path><circle cx="5" cy="20" r="2"></circle><circle cx="19" cy="20" r="2"></circle></svg>
                </span>
                <span class="menu-title">Organigram</span>
            </a>

        </nav>


        <!-- LOGOUT & QUICK LINK -->
        <div class="sidebar-bottom">
            <a href="{{ route('beranda') }}" target="_blank" class="view-website" title="Lihat Website">
                <span class="menu-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                </span>
                <span class="menu-title">Lihat Website</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST" id="adminLogoutForm" style="display: none;">
                @csrf
            </form>
            <a href="javascript:void(0)" onclick="if(confirm('Apakah Anda yakin ingin keluar dari sistem admin?')) document.getElementById('adminLogoutForm').submit();" class="logout" title="Logout">
                <span class="logout-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                </span>
                <span class="menu-title">Logout</span>
            </a>
        </div>
 
    </aside>


    <!-- BAGIAN KANAN -->
    <div class="main-wrapper" id="mainWrapper">

        <!-- HEADER -->
        <header class="admin-header">

            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle Sidebar" title="Buka / Tutup Sidebar">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>  

                <div class="header-breadcrumb">
                    <span class="breadcrumb-app">Perpusda Admin</span>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current">@yield('title', 'Dashboard')</span>
                </div>
            </div>


            <!-- ADMIN PROFILE -->
            <a href="{{ route('admin.profil') }}" class="admin-profile" style="text-decoration: none; color: inherit;" title="Lihat Profil Admin">
                <div class="profile-info">
                    <strong>{{ Auth::user()->name ?? 'Administrator' }}</strong>
                    <span>{{ Auth::user()->email ?? 'admin@perpusda.purwakarta.go.id' }}</span>
                </div>

                <div class="profile-avatar">
                    <span>{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</span>
                    <span class="status-indicator" title="Online"></span>
                </div>
            </a>

        </header>

        <!-- FLASH NOTIFICATION -->
        @if (session('success'))
            <div class="flash-alert flash-success">
                <div class="flash-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div class="flash-message">
                    <strong>Berhasil!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="flash-close" onclick="this.parentElement.remove();">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="flash-alert flash-danger">
                <div class="flash-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                </div>
                <div class="flash-message">
                    <strong>Error!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="flash-close" onclick="this.parentElement.remove();">&times;</button>
            </div>
        @endif


        <!-- CONTENT -->
        <main class="admin-content">
            @yield('content')
        </main>

    </div>

    <!-- JAVASCRIPT UNTUK SIDEBAR TOGGLE (DESKTOP COLLAPSE & MOBILE DRAWER) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('sidebarCloseBtn');
            const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            // Muat status collapse desktop dari localStorage
            const savedState = localStorage.getItem('sidebar_collapsed');
            if (window.innerWidth > 768 && savedState === 'true') {
                body.classList.add('sidebar-collapsed');
            }

            function toggleSidebar() {
                if (window.innerWidth <= 768) {
                    // Mobile mode: toggle drawer
                    body.classList.toggle('sidebar-mobile-open');
                } else {
                    // Desktop mode: toggle collapsed
                    body.classList.toggle('sidebar-collapsed');
                    localStorage.setItem('sidebar_collapsed', body.classList.contains('sidebar-collapsed'));
                }
            }

            function closeMobileSidebar() {
                body.classList.remove('sidebar-mobile-open');
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeMobileSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeMobileSidebar);
            }

            // Keyboard shortcut Esc untuk menutup sidebar mobile
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && body.classList.contains('sidebar-mobile-open')) {
                    closeMobileSidebar();
                }
            });

            // Auto close flash message after 5 seconds
            const flashAlerts = document.querySelectorAll('.flash-alert');
            if (flashAlerts.length > 0) {
                setTimeout(function () {
                    flashAlerts.forEach(function (alert) {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateY(-10px)';
                        alert.style.transition = 'all 0.4s ease';
                        setTimeout(() => alert.remove(), 400);
                    });
                }, 4500);
            }
        });
    </script>

    @stack('scripts')

</body>

</html>