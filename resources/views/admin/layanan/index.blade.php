@extends('admin.layouts.app')

@section('title', 'Layanan')

@section('content')

<div class="page-title">
    <h1>Layanan</h1>
    <p>Beranda / Layanan</p>
</div>

<div class="layanan-header">

    <a href="{{ route('admin.layanan.create') }}" class="btn-primary">
        + &nbsp; Tambah Layanan
    </a>

</div>

<div class="table-container">

    <table class="admin-table layanan-table">

        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Layanan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>Pembuatan kartu anggota</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.layanan.edit', 1) }}"
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
                <td>Perpustakaan Keliling</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.layanan.edit', 2) }}"
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
                <td>Layanan Baca di Tempat</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.layanan.edit', 3) }}"
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
                <td>Layanan Literasi</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.layanan.edit', 4) }}"
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