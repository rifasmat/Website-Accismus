@extends('senate.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Pengguna Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('senate.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div>
<div class="text-center mb-3">
    <h2>Konfirmasi Delete Pengguna Accismus</h2>
</div>

<div class="container">
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
            </tr>
        </thead>
        <tbody>
            <tr class="text-center">
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->wa }}</td>
                <td>{{ $user->discord }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <img src="{{ Storage::url($user->foto) }}" alt="Foto Pengguna" class="img-thumbnail" style="width: 100px; height: 100px;">
                </td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="{{ route('senate.pengguna.list') }}" class="btn btn-secondary btn-sm">Batal</a>
        <form method="POST" action="{{ route('senate.pengguna.destroy', $user->uuid) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </form>
    </div>
</div>

@endsection