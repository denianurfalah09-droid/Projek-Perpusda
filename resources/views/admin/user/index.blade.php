@extends('admin.layouts.app')

@section('title', 'User')

@section('content')

<div class="page-title">
    <h1>User</h1>
    <p>Beranda / User</p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="user-header">
    <a href="{{ route('admin.user.create') }}" class="btn-primary">
        + &nbsp; Tambah User
    </a>
</div>

<div class="table-container">

    <table class="admin-table user-table">

        <thead>
            <tr>
                <th>NO</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>
                        <div class="action-buttons">

                            {{-- Tombol Edit --}}
                            <a
                                href="{{ route('admin.user.edit', $user->id) }}"
                                class="btn-edit"
                                title="Edit User"
                            >
                                ✎
                            </a>

                            {{-- Tombol Hapus --}}
                            @if(auth()->id() != $user->id)

                                <form
                                    action="{{ route('admin.user.destroy', $user->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus akun ini?')"
                                    style="display: inline;"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-action btn-delete"
                                        title="Hapus User"
                                    >
                                        <svg width="15" height="15" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>

                            @else

                                <button
                                    type="button"
                                    class="btn-action btn-delete"
                                    title="Akun yang sedang digunakan tidak dapat dihapus"
                                    disabled
                                    style="opacity: 0.5; cursor: not-allowed;"
                                >
                                    <svg width="15" height="15" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>

                            @endif

                        </div>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" style="text-align: center;">
                        Belum ada data user.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection