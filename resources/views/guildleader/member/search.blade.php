@extends('guildleader.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian Member Accismus</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('guildleader.member.search') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;" value="{{ old('query', $search) }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('guildleader.member.list') }}">
                    <button type="button" class="btn btn-danger">Kembali</button>
                </a>
            </div>
        </div>
    </form>

    @if(isset($users))
    @if($users->isEmpty())
    <div class="alert alert-danger mt-3 text-center">Member tidak ditemukan.</div>
    @elseif(isset($administratorExists) && $administratorExists)
    <div class="alert alert-danger mt-3 text-center">Member tidak ditemukan.</div>
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
                <td>{{ $user->nama }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->wa }}</td>
                <td>{{ $user->discord }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <img src="{{ Storage::url($user->foto) }}" alt="Foto Pengguna" class="img-thumbnail" style="width: 100px; height: 100px;">
                </td>
                <td>
                    @if($user->role !== 'Administrator' && $user->uuid !== Auth::user()->uuid)
                    <form action="{{ route('guildleader.member.changeStatus', $user->uuid) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm mr-1">
                            <i class="bi bi-x-lg"></i>
                        </button>
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