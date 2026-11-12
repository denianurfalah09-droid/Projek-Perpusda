@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('breadcrumb', 'Berita / Tambah Berita')

@section('content')

<div class="page-title">
    <h1>Tambah Berita</h1>
    <p>Beranda / Berita / Tambah Berita</p>
</div>

<form
    action="{{ route('admin.berita.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="form-container berita-form"
>
    @csrf

    <div class="form-group">
        <label for="judul">Judul Berita</label>

        <input
            type="text"
            id="judul"
            name="judul"
            placeholder="Masukkan judul berita"
            value="{{ old('judul') }}"
        >
    </div>

    <div class="form-group">
        <label for="link">Link Berita</label>

        <input
            type="url"
            id="link"
            name="link"
            placeholder="Masukkan link berita"
            value="{{ old('link') }}"
        >
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal</label>

        <input
            type="date"
            id="tanggal"
            name="tanggal"
            value="{{ old('tanggal') }}"
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
            Simpan
        </button>

    </div>

</form>

@endsection
