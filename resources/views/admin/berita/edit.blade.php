@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('breadcrumb', 'Berita / Edit Berita')

@section('content')

<div class="page-title">
    <h1>Edit Berita</h1>
    <p>Beranda / Berita / Edit Berita</p>
</div>

<div class="form-container berita-form">

    <div class="form-group">
        <label for="judul">Judul Berita</label>

        <input
            type="text"
            id="judul"
            name="judul"
            value="Perpusda Purwakarta Perkuat Layanan Perpustakaan Keliling"
            placeholder="Masukkan judul berita"
        >
    </div>

    <div>
        <label for="link">Link Berita</label>

        <input
            type="url"
            id="link"
            name="link">
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal</label>

        <input
            type="date"
            id="tanggal"
            name="tanggal"
            value="2026-08-03"
        >
    </div>

    <div class="form-group">
        <label for="gambar">Gambar Berita</label>

        <input
            type="file"
            id="gambar"
            name="gambar"
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

</div>

@endsection