@extends('humas.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian Daftar Email Accismus</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('humas.broadcast.searchmail') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('humas.broadcast.email') }}">
                    <button type="button" class="btn btn-danger">Kembali</button>
                </a>
            </div>
        </div>
    </form>

    @if(isset($users))
    @if($users->isEmpty())
    <div class="alert alert-danger mt-3 text-center">Email tidak ditemukan.</div>
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
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->wa }}</td>
                <td>{{ $user->discord }}</td>
                <td>
                    <img src="{{ Storage::url($user->foto) }}" alt="Foto Pengguna" class="img-thumbnail" style="width: 100px; height: 100px;">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @endif
</div>

@endsection