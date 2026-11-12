@extends('admin.layouts.app')

@section('title', 'Profil Administrator')

@section('content')

<div class="page-title">
    <div>
        <h1>Profil Administrator</h1>
        <p>Kelola informasi akun administrator dan keamanan sistem Perpustakaan Daerah Purwakarta</p>
    </div>
</div>

<div class="profile-layout-grid" style="display: grid; grid-template-columns: 340px 1fr; gap: 2rem; align-items: flex-start;">

    <!-- KOLOM KIRI: KARTU IDENTITAS ADMIN -->
    <div class="profile-card" style="background: white; border: 1px solid var(--border-color, #e2e8f0); border-radius: 16px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center;">
        <div class="profile-avatar-large" style="width: 88px; height: 88px; background: linear-gradient(135deg, #0048a8, #006bd6); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 34px; font-weight: 800; margin: 0 auto 1.25rem auto; box-shadow: 0 6px 16px rgba(0, 72, 168, 0.25);">
            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
        </div>

        <h2 style="font-size: 1.35rem; font-weight: 800; color: #0f172a; margin-bottom: 4px;">{{ $user->name ?? 'Administrator' }}</h2>
        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem;">{{ $user->email ?? 'admin@perpusda.purwakarta.go.id' }}</p>

        <div style="display: inline-block; background: #ebf4ff; color: #0048a8; font-size: 0.8rem; font-weight: 700; padding: 5px 14px; border-radius: 20px; margin-bottom: 1.75rem;">
            🛡️ Administrator Utama
        </div>

        <div style="border-top: 1px solid #f1f5f9; padding-top: 1.25rem; text-align: left; display: flex; flex-direction: column; gap: 10px; font-size: 0.88rem;">
            <div style="display: flex; justify-content: space-between;">
                <span style="color: #64748b;">Status Akun</span>
                <span style="color: #16a34a; font-weight: 700;">● Aktif</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: #64748b;">Terdaftar Sejak</span>
                <span style="font-weight: 600; color: #334155;">{{ $user->created_at ? $user->created_at->format('d M Y') : '14 Sep 2026' }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: #64748b;">Role Sistem</span>
                <span style="font-weight: 600; color: #334155;">Super Admin</span>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: FORM EDIT PROFIL & GANTI PASSWORD -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">

        <!-- FORM 1: BIODATA AKUN -->
        <div class="form-card" style="background: white; border: 1px solid var(--border-color, #e2e8f0); border-radius: 16px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                <div style="width: 36px; height: 36px; background: #ebf4ff; color: #0048a8; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0;">Informasi Akun Administrator</h3>
                    <span style="font-size: 0.85rem; color: #64748b;">Perbarui nama identitas dan alamat email resmi petugas</span>
                </div>
            </div>

            <form action="{{ route('admin.profil.update') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label for="name" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap Administrator <span style="color: #ef4444;">*</span></label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
                            required
                        >
                        @error('name')
                            <span style="color: #ef4444; font-size: 0.8rem; font-weight: 600;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Alamat Email <span style="color: #ef4444;">*</span></label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
                            required
                        >
                        @error('email')
                            <span style="color: #ef4444; font-size: 0.8rem; font-weight: 600;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-primary" style="background: linear-gradient(135deg, #0048a8, #006bd6); color: white; border: none; padding: 11px 24px; border-radius: 8px; font-weight: 700; cursor: pointer;">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- FORM 2: GANTI PASSWORD -->
        <div class="form-card" style="background: white; border: 1px solid var(--border-color, #e2e8f0); border-radius: 16px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                <div style="width: 36px; height: 36px; background: #fee2e2; color: #dc2626; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0;">Keamanan & Ganti Password</h3>
                    <span style="font-size: 0.85rem; color: #64748b;">Perbarui kata sandi akun admin Anda secara berkala untuk menjaga keamanan data</span>
                </div>
            </div>

            <form action="{{ route('admin.profil.password') }}" method="POST">
                @csrf

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label for="current_password" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Password Saat Ini <span style="color: #ef4444;">*</span></label>
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        placeholder="Masukkan password yang aktif saat ini"
                        style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
                        required
                    >
                    @error('current_password')
                        <span style="color: #ef4444; font-size: 0.8rem; font-weight: 600;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label for="password" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Password Baru <span style="color: #ef4444;">*</span></label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Minimal 6 karakter"
                            style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
                            required
                        >
                        @error('password')
                            <span style="color: #ef4444; font-size: 0.8rem; font-weight: 600;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Konfirmasi Password Baru <span style="color: #ef4444;">*</span></label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
                            required
                        >
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-primary" style="background: #0f172a; color: white; border: none; padding: 11px 24px; border-radius: 8px; font-weight: 700; cursor: pointer;">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection