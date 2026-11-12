@extends('admin.layouts.app')

@section('title', 'Edit Organigram')

@section('content')

<div class="page-title">
    <h1>Edit Organigram</h1>
    <p>Beranda / Organigram / Edit Organigram</p>
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
            value="Falah"
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
            value="Kepala Perpustakaan"
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
            Simpan perubahan
        </button>

    </div>

</div>

@endsection