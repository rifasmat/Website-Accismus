@extends('moderator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Informasi Website Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('moderator.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Informasi</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Informasi Website Accismus</h2>
</div>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="judul"><b>Judul Website</b></label>
            <input type="text" class="form-control" name="judul" id="judul" autocomplete="off" value="{{ old('judul', $informasi->informasi_judul) }}" readonly>
            @error('judul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="subjudul"><b>Sub Judul Website</b></label>
            <input type="text" class="form-control" name="subjudul" id="subjudul" autocomplete="off" value="{{ old('subjudul', $informasi->informasi_subjudul) }}" readonly>
            @error('subjudul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="rf"><b>Sekarang Berada Di RF</b></label>
            <input type="text" class="form-control" name="rf" id="rf" autocomplete="off" value="{{ old('rf', $informasi->informasi_rf) }}">
            @error('rf')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="instagram"><b>Instagram</b></label>
            <input type="text" class="form-control" name="instagram" id="instagram" autocomplete="off" value="{{ old('instagram', str_replace('https://www.instagram.com/', '', $informasi->informasi_instagram)) }}" readonly>
            @error('instagram')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="discord"><b>Discord</b></label>
            <input type="text" class="form-control" name="discord" id="discord" autocomplete="off" value="{{ old('discord', str_replace('https://discord.gg/', '', $informasi->informasi_discord)) }}" readonly>
            @error('discord')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="wa"><b>Nomer Whatsapp</b></label>
            <input type="text" class="form-control" name="wa" id="wa" autocomplete="off" value="{{ old('wa', str_replace('https://wa.me/', '', $informasi->informasi_wa)) }}" readonly>
            @error('wa')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
    </form>
</div>
@endsection