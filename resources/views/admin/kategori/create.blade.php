@extends('admin.layouts.app')

@section('title', 'Tambah Kategori Buku')

@section('content')

<div class="page-title">
    <div>
        <h1>Tambah Kategori Buku</h1>
        <p>Tambahkan kategori baru untuk klasifikasi koleksi buku perpustakaan</p>
    </div>

    <div class="page-title-actions">
        <a href="{{ route('admin.kategori') }}" class="btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>Kembali</span>
        </a>
    </div>
</div>

<div class="form-card" style="background: white; border: 1px solid var(--border-color, #e2e8f0); border-radius: 16px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); max-width: 680px;">

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div class="form-group" style="margin-bottom: 1.25rem;">
            <label for="nama_kategori" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Kategori <span style="color: #ef4444;">*</span></label>
            <input
                type="text"
                id="nama_kategori"
                name="nama_kategori"
                value="{{ old('nama_kategori') }}"
                placeholder="Contoh: Arsitektur, Kewirausahaan, Komik..."
                style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
                required
                autofocus
            >
            @error('nama_kategori')
                <span style="color: #ef4444; font-size: 0.8rem; font-weight: 600;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 1.25rem;">
            <label for="icon" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Icon / Emoji Kategori</label>
            <input
                type="text"
                id="icon"
                name="icon"
                value="{{ old('icon', '📚') }}"
                placeholder="Contoh: 📚, 📖, 🔬, 🏛️, 💻"
                style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
            >
            <small style="color: #64748b; font-size: 0.8rem;">Gunakan emoji untuk memperindah kartu kategori di landing page.</small>
        </div>

        <div class="form-group" style="margin-bottom: 1.75rem;">
            <label for="deskripsi" style="display: block; font-size: 0.88rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Deskripsi Singkat</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                rows="3"
                placeholder="Penjelasan ringkas mengenai kategori buku ini..."
                style="width: 100%; padding: 11px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;"
            >{{ old('deskripsi') }}</textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <a href="{{ route('admin.kategori') }}" class="btn-secondary" style="padding: 10px 20px;">Batal</a>
            <button type="submit" class="btn-primary" style="padding: 10px 24px;">Simpan Kategori</button>
        </div>

    </form>

</div>

@endsection