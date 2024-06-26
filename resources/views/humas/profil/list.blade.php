@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Profil Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </nav>
</div>

<div class="container">
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif
    <div class="text-center mb-2">
        <h2>Profil</h2>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <img id="fotoPreview" src="{{ Storage::url($user->user_foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 300px;">
    </div>

    <form action="{{ route('humas.profil.update', $user->uuid) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="nama"><b>Nama</b></label>
            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="{{ old('nama', $user->user_nama) }}">
            @error('nama')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="username"><b>Username</b></label>
            <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="{{ old('username', $user->user_username) }}">
            @error('username')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="{{ old('email', $user->user_email) }}">
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="wa"><b>Nomor WhatsApp</b></label>
            <input type="text" class="form-control" name="wa" id="wa" autocomplete="off" value="{{ old('wa', $user->user_wa) }}">
            @error('wa')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="discord"><b>Discord</b></label>
            <input type="text" class="form-control" name="discord" id="discord" autocomplete="off" value="{{ old('discord', $user->user_discord) }}">
            @error('discord')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="password"><b>password</b></label>
            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
            <p class="text-muted">Kosongkan password apabila tidak ingin diganti.</p>
            @error('password')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <div class="input-group" style="display: flex; align-items: center;">
                <input type="file" class="form-control" id="foto" name="foto" style="flex: 1;" onchange="previewImage()">
                <input type="hidden" name="foto_old" value="{{ $user->user_foto }}">
                <img id="fotoPreview" src="{{ Storage::url($user->user_foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 150px; margin-left: 10px;">
            </div>
            @error('foto')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <button id="editProfilBtn" class="btn btn-sm btn-primary">Update Profil</button>
        </div>
    </form>
</div>
@endsection