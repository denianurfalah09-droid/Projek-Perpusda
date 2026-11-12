@extends('admin.layouts.app')

@section('title', 'Tambah Organigram')

@section('content')

<div class="page-title">
    <h1>Tambah Organigram</h1>
    <p>Beranda / Organigram / Tambah Organigram</p>
</div>

<div class="organigram-form">

    <div class="organigram-form-group">

        <label for="nama">
            Nama
        </label>

        <input
            type="text"
            id="nama"
            name="nama"
            placeholder="Masukan nama"
        >

    </div>


    <div class="organigram-form-group">

        <label for="jabatan">
            Jabatan
        </label>

        <input
            type="text"
            id="jabatan"
            name="jabatan"
            placeholder="Masukan jabatan"
        >

    </div>


    <div class="organigram-form-actions">

        <a
            href="{{ route('admin.organigram') }}"
            class="organigram-btn-cancel"
        >
            Batal
        </a>

        <button
            type="submit"
            class="organigram-btn-save"
        >
            Simpan
        </button>

    </div>

</div>

@endsection