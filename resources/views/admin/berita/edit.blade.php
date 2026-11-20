@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('breadcrumb', 'Berita / Edit Berita')

@section('content')

<div class="page-title">
    <h1>Edit Berita</h1>
    <p>Beranda / Berita / Edit Berita</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('admin.berita.update', $berita->id) }}"
    method="POST"
    enctype="multipart/form-data"
    class="form-container berita-form"
>
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="judul">Judul Berita</label>

        <input
            type="text"
            id="judul"
            name="judul"
            value="{{ old('judul', $berita->judul) }}"
            placeholder="Masukkan judul berita"
            required
        >
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi Berita</label>

        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="4"
            placeholder="Masukkan deskripsi atau ringkasan berita"
        >{{ old('deskripsi', $berita->deskripsi) }}</textarea>
    </div>

    <div class="form-group">
        <label for="link">Link Berita</label>

        <input
            type="url"
            id="link"
            name="link"
            value="{{ old('link', $berita->link) }}"
            placeholder="https://..."
            required
        >
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal</label>

        <input
            type="date"
            id="tanggal"
            name="tanggal"
            value="{{ old('tanggal', \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d')) }}"
            required
        >
    </div>

    <div class="form-group">
        <label for="gambar">Gambar Berita</label>

        @if ($berita->gambar)
            <div style="margin-bottom: 10px;">
                @if (Str::startsWith($berita->gambar, ['http://', 'https://']))
                    <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" style="max-width: 200px; border-radius: 6px; display: block;">
                @elseif (file_exists(public_path('storage/' . $berita->gambar)))
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="max-width: 200px; border-radius: 6px; display: block;">
                @elseif (file_exists(public_path('images/' . $berita->gambar)))
                    <img src="{{ asset('images/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="max-width: 200px; border-radius: 6px; display: block;">
                @else
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="max-width: 200px; border-radius: 6px; display: block;">
                @endif
                <small style="color: #64748b;">Gambar saat ini. Pilih file baru di bawah jika ingin mengganti.</small>
            </div>
        @endif

        <input
            type="file"
            id="gambar"
            name="gambar"
            accept="image/*"
        >
    </div>

    <div class="form-actions">

        <a href="{{ route('admin.berita') }}" class="btn-cancel">
            Batal
        </a>

        <button type="submit" class="btn-save">
            Simpan Perubahan
        </button>

    </div>

</form>

<style>
    .berita-form .btn-save {
        background-color: #064b9b !important;
        color: #ffffff !important;
        border: none !important;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
    }

    .berita-form .btn-save:hover {
        background-color: #043875 !important;
    }
</style>

@endsection