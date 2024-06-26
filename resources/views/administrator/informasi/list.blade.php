@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Informasi Website Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Informasi</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Informasi Website Accismus</h2>
</div>
<div class="container">
    <form action="{{ route('administrator.informasi.update', $informasi->informasi_uuid) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="judul"><b>Judul Website</b></label>
            <input type="text" class="form-control" name="judul" id="judul" autocomplete="off" value="{{ old('judul', $informasi->informasi_judul) }}">
            @error('judul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="subjudul"><b>Sub Judul Website</b></label>
            <input type="text" class="form-control" name="subjudul" id="subjudul" autocomplete="off" value="{{ old('subjudul', $informasi->informasi_subjudul) }}">
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
            <input type="text" class="form-control" name="instagram" id="instagram" autocomplete="off" value="{{ old('instagram', str_replace('https://www.instagram.com/', '', $informasi->informasi_instagram)) }}">
            @error('instagram')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="discord"><b>Discord</b></label>
            <input type="text" class="form-control" name="discord" id="discord" autocomplete="off" value="{{ old('discord', str_replace('https://discord.gg/', '', $informasi->informasi_discord)) }}">
            @error('discord')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="wa"><b>Nomer Whatsapp</b></label>
            <input type="text" class="form-control" name="wa" id="wa" autocomplete="off" value="{{ old('wa', str_replace('https://wa.me/', '', $informasi->informasi_wa)) }}">
            @error('wa')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mt-3">
            <a href="{{ route('administrator.informasi.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
            <button id="editInformasiBtn" class="btn btn-sm btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection