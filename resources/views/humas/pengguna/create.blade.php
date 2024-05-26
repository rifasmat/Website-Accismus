@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Pengguna Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Tambah Pengguna Accismus</h2>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('humas.pengguna.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-3">
        <label for="nama"><b>Nama</b></label>
        <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" placeholder="Masukan Nama .." value="{{ old('nama') }}">
        @error('nama')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="username"><b>Username</b></label>
        <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Masukan Username .." value="{{ old('username') }}">
        @error('username')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="email"><b>Email</b></label>
        <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="Masukan Email .." value="{{ old('email') }}">
        @error('email')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="wa"><b>Nomer Whatsapp</b></label>
        <input type="number" class="form-control" name="wa" id="wa" autocomplete="off" placeholder="Masukan nomer whatsapp .." value="{{ old('wa') }}">
    </div>
    <div class="form-group mt-3">
        <label for="discord"><b>Nama / ID Discord</b></label>
        <input type="text" class="form-control" name="discord" id="discord" autocomplete="off" placeholder="Masukan Id Discord .." value="{{ old('discord') }}">
        @error('discord')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="password"><b>Password</b></label>
        <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Masukan Password ..">
        @error('password')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="role"><b>Pengguna Role</b></label>
        <select id="role" name="role" class="form-control">
            <option value="">- Pilih Role -</option>
            <option value="GuildLeader" {{ old('role') == 'GuildLeader' ? 'selected' : '' }}>GuildLeader</option>
            <option value="Humas" {{ old('role') == 'Humas' ? 'selected' : '' }}>Humas</option>
            <option value="Senate" {{ old('role') == 'Senate' ? 'selected' : '' }}>Senate</option>
            <option value="Moderator" {{ old('role') == 'Moderator' ? 'selected' : '' }}>Moderator</option>
            <option value="Member" {{ old('role') == 'Member' ? 'selected' : '' }}>Member</option>
            <option value="Guest" {{ old('role') == 'Guest' ? 'selected' : '' }}>Guest</option>
        </select>
        @error('role')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label><b>Foto</b></label>
        <input type="file" name="foto" id="uploadFoto" onchange="previewImage()">
        <img src="#" alt="Preview Foto" id="previewFoto" style="max-width: 150px; display: none;">
        @error('foto')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <a href="{{ route('humas.pengguna.list') }}" class="btn btn-danger btn-sm">&nbsp Kembali</a>
        <input type="submit" class="btn btn-sm btn-primary" value="Tambah Pengguna">
    </div>
</form>
@endsection