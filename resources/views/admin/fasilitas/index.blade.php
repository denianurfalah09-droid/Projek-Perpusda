@extends('admin.layouts.app')

@section('title', 'Fasilitas')

@section('content')

<div class="page-title">
    <h1>Fasilitas</h1>
    <p>Beranda / Fasilitas</p>
</div>

<div class="fasilitas-header">

    <a href="{{ route('admin.fasilitas.create') }}" class="btn-primary">
        + &nbsp; Tambah Fasilitas
    </a>

</div>

<div class="table-container">

    <table class="admin-table fasilitas-table">

        <thead>
            <tr>
                <th>NO</th>
                <th>Gambar</th>
                <th>Nama Fasilitas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>1</td>

                <td>
                    <div class="fasilitas-image">
                        <img
                            src="{{ asset('images/lobby.jpg') }}"
                            alt="Ruang Lobby"
                        >
                    </div>
                </td>

                <td>Ruang lobby</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.fasilitas.edit', 1) }}"
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

                <td>
                    <div class="fasilitas-image">
                        <img
                            src="{{ asset('images/anak-anak.jpg') }}"
                            alt="Ruang Anak"
                        >
                    </div>
                </td>

                <td>Ruang anak</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.fasilitas.edit', 2) }}"
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

                <td>
                    <div class="fasilitas-image">
                        <img
                            src="{{ asset('images/remaja.jpg') }}"
                            alt="Ruang Remaja"
                        >
                    </div>
                </td>

                <td>Ruang remaja</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.fasilitas.edit', 3) }}"
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

                <td>
                    <div class="fasilitas-image">
                        <img
                            src="{{ asset('images/dewasa.jpg') }}"
                            alt="Ruang Dewasa"
                        >
                    </div>
                </td>

                <td>Ruang dewasa</td>

                <td>
                    <div class="action-buttons">

                        <a
                            href="{{ route('admin.fasilitas.edit', 4) }}"
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