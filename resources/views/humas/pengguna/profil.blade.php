@extends('humas.layouts.template')

@section('content')
<div class="container">
    <h1>Profil Pengguna</h1>
    <form action="{{ route('humas.profil.updateprofil') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_nama">Nama</label>
            <input type="text" class="form-control" id="user_nama" name="user_nama" value="{{ $user->user_nama }}">
        </div>

        <div class="form-group">
            <label for="user_username">Username</label>
            <input type="text" class="form-control" id="user_username" name="user_username" value="{{ $user->user_username }}">
        </div>

        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $user->user_email }}">
        </div>

        <div class="form-group">
            <label for="user_wa">Whatsapp</label>
            <input type="text" class="form-control" id="user_wa" name="user_wa" value="{{ $user->user_wa }}">
        </div>

        <div class="form-group">
            <label for="user_discord">Discord</label>
            <input type="text" class="form-control" id="user_discord" name="user_discord" value="{{ $user->user_discord }}">
        </div>

        <div class="form-group">
            <label for="user_foto">Foto</label>
            <input type="file" class="form-control-file" id="user_foto" name="user_foto">
            @if($user->user_foto)
            <img src="{{ Storage::url($user->user_foto) }}" alt="Foto Pengguna" class="img-thumbnail mt-2" style="width: 100px; height: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Profil</button>
    </form>
</div>
@endsection