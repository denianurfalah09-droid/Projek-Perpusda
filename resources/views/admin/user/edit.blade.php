
@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-title">
    <h1>Edit User</h1>
    <p>Beranda / User / Edit User</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form
    action="{{ route('admin.user.update', $user->id) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <div class="user-form">

        <div class="user-form-group">

            <label for="name">Username</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
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
                value="{{ old('email', $user->email) }}"
                placeholder="Masukkan email"
                required
            >

        </div>

        <div class="user-form-group">

            <label for="password">Password Baru</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Kosongkan jika tidak ingin mengganti password"
            >

            <small>
                Password hanya perlu diisi jika ingin menggantinya.
            </small>

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
                Simpan Perubahan
            </button>

        </div>

    </div>
</form>

@endsection
