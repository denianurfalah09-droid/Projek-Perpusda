@extends('admin.layouts.app')

@section('title', 'Organigram')

@section('content')

<div class="page-title">
    <h1>Organigram</h1>
    <p>Beranda / Organigram</p>
</div>

<div class="organigram-header">

    <a href="{{ route('admin.organigram.create') }}" class="btn-primary">
        + &nbsp; Tambah Organigram
    </a>

</div>

<div class="table-container">

    <table class="admin-table organigram-table">

        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>Falah</td>
                <td>Kepala Perpustakaan</td>
                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.organigram.edit', 1) }}"
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
                <td>Bilqis</td>
                <td>Sekretaris</td>
                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.organigram.edit', 2) }}"
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
                <td>Nury</td>
                <td>Staf Administrasi</td>
                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.organigram.edit', 3) }}"
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
                <td>Asadel</td>
                <td>Staf Layanan</td>
                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.organigram.edit', 4) }}"
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