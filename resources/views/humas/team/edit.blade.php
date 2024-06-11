@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Team Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Team</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Edit Team Accismus</h2>
</div>
<div class="container">
    <form action="{{ route('humas.team.update', $user->id) }}" method="post" enctype="multipart/form-data">
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
            <input type="text" class="form-control" name="email" id="email" autocomplete="off" value="{{ old('email', $user->user_email) }}">
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="wa"><b>Nomer Whatsapp</b></label>
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
            <label for="role"><b>Role</b></label>
            <select class="form-control" name="role" id="role">
                @php
                $roles = ['GuildLeader', 'Humas', 'Senate', 'Moderator', 'Member', 'Guest'];
                $userRole = $user->user_role;
                @endphp
                <option value="{{ $userRole }}">{{ $userRole }}</option>
                @foreach($roles as $role)
                @if($role != $userRole)
                <option value="{{ $role }}">{{ $role }}</option>
                @endif
                @endforeach
            </select>
            @error('role')
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
            <a href="{{ route('humas.team.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
            <button id="editTeamBtn" class="btn btn-sm btn-primary">Edit Team</button>
        </div>
    </form>
</div>
@endsection