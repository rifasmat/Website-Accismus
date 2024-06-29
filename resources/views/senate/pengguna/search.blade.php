@extends('senate.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian Pengguna Accismus</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('senate.pengguna.search') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;" value="{{ old('query', $search) }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('senate.pengguna.list') }}">
                    <button type="button" class="btn btn-danger">Kembali</button>
                </a>
            </div>
        </div>
    </form>

    @if(isset($users))
    @if($users->isEmpty())
    <div class="alert alert-danger mt-3 text-center">Pengguna tidak ditemukan.</div>
    @elseif(isset($administratorExists) && $administratorExists)
    <div class="alert alert-danger mt-3 text-center">Pengguna tidak ditemukan.</div>
    @else
    <table class="table mt-3">
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
            @foreach($users as $index => $user)
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
                    @if($user->uuid !== Auth::user()->uuid && !in_array($user->user_role, ['Administrator', 'Guild Leader', 'Humas']))
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('senate.pengguna.edit', $user->uuid) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                    </div>
                    <form method="GET" action="{{ route('senate.pengguna.konfirmasi', $user->uuid) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @endif
</div>

@endsection