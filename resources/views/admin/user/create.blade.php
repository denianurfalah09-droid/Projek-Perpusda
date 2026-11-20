
@extends('admin.layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="page-title">
    <h1>Tambah User</h1>
    <p>Beranda / User / Tambah User</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form
    action="{{ route('admin.user.store') }}"
    method="POST"
>
    @csrf

    <div class="user-form">

        <div class="user-form-group">

            <label for="name">Username</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Masukkan username"
                required
            >

        </div>

        <div class="user-form-group">

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
            >

        </div>

        <div class="user-form-group">

            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
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
</form>

@endsection
