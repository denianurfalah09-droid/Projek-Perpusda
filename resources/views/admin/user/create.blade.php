@extends('admin.layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="page-title">
    <h1>Tambah User</h1>
    <p>Beranda / User / Tambah User</p>
</div>

<div class="user-form">

    <div class="user-form-group">

        <label for="username">
            Username
        </label>

        <input
            type="text"
            id="username"
            name="username"
            placeholder="Masukan username"
        >

    </div>


    <div class="user-form-group">

        <label for="email">
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            placeholder="Masukan email"
        >

    </div>


    <div class="user-form-group">

        <label for="password">
            Password
        </label>

        <input
            type="password"
            id="password"
            name="password"
            placeholder="Masukan password"
        >

    </div>


    <div class="user-form-actions">

        <a
            href="{{ route('admin.user') }}"
            class="user-btn-cancel"
        >
            Batal
        </a>

        <button
            type="submit"
            class="user-btn-save"
        >
            Simpan
        </button>

    </div>

</div>

@endsection