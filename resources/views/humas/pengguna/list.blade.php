@extends('humas.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>Pengguna Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar Pengguna Accismus</h2>
</div>

<div class="box-header d-flex justify-content-end mb-3">
    <div class="btn-group">
        <a href="{{ route('humas.pengguna.create') }}" class="btn btn-secondary">
            &nbsp; Tambah Data Pengguna
        </a>
    </div>
</div>

<div class="container">
    <!-- Search -->
    <form action="" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="search" id="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Whatsapp</th>
                <th scope="col">Discord</th>
                <th scope="col">Role</th>
                <th scope="col">Foto</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $index => $user)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->user_nama }}</td>
                <td>{{ $user->user_username }}</td>
                <td>{{ $user->user_email }}</td>
                <td>{{ $user->user_wa }}</td>
                <td>{{ $user->user_discord }}</td>
                <td>{{ $user->user_role }}</td>
                <td>
                    <img src="{{ Storage::url($user->user_foto) }}" alt="Foto Pengguna" class="img-thumbnail" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('humas.pengguna.edit', $user->uuid) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                        <form method="GET" action="{{ route('humas.pengguna.konfirmasi', $user->uuid) }}" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection