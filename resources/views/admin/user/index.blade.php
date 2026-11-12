@extends('admin.layouts.app')

@section('title', 'User')

@section('content')

<div class="page-title">
    <h1>User</h1>
    <p>Beranda / User</p>
</div>

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

            <tr>
                <td>1</td>
                <td>admin</td>
                <td>admin@perpusda.id</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.user.edit', 1) }}"
                            class="btn-edit"
                        >
                            ✎
                        </a>

                        <button
                            type="button"
                            class="btn-delete"
                        >
                            ●
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>2</td>
                <td>operator</td>
                <td>operator@gmail.com</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.user.edit', 2) }}"
                            class="btn-edit"
                        >
                            ✎
                        </a>

                        <button
                            type="button"
                            class="btn-delete"
                        >
                            ●
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>3</td>
                <td>staff</td>
                <td>staff@perpusda.go.id</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.user.edit', 3) }}"
                            class="btn-edit"
                        >
                            ✎
                        </a>

                        <button
                            type="button"
                            class="btn-delete"
                        >
                            ●
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>4</td>
                <td>petugas</td>
                <td>petugas@perpusda.com</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.user.edit', 4) }}"
                            class="btn-edit"
                        >
                            ✎
                        </a>

                        <button
                            type="button"
                            class="btn-delete"
                        >
                            ●
                        </button>

                    </div>
                </td>
            </tr>

        </tbody>

    </table>

</div>

@endsection