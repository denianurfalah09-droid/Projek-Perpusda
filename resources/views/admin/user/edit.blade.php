@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-title">
    <h1>Edit User</h1>
    <p>Beranda / User / Edit User</p>
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
            value="admin"
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
            value="admin@perpusda.id"
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
            placeholder="Masukan password baru"
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
            Simpan perubahan
        </button>

    </div>

</div>

@endsection