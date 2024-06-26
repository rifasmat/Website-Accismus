@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Gallery Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Gallery</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Tambah Gallery Accismus</h2>
</div>

<form action="{{ route('administrator.gallery.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-3">
        <label for="judul"><b>Judul Foto</b></label>
        <input type="text" class="form-control" name="judul" id="judul" autocomplete="off" placeholder="Masukan Judul .." value="{{ old('judul') }}">
        @error('judul')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="rf"><b>Nama RF</b></label>
        <input type="text" class="form-control" name="rf" id="rf" autocomplete="off" placeholder="Masukan Nama RF .." value="{{ old('rf') }}">
        @error('rf')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label><b>Foto</b></label>
        <input type="file" class="form-control" name="foto" id="uploadFoto" onchange="previewImage()">
        <img src="#" alt="Preview Foto" id="previewFoto" style="max-width: 150px; display: none;">
        @error('foto')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <a href="{{ route('administrator.gallery.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
        <button id="tambahGalleryBtn" class="btn btn-sm btn-primary">Tambah Foto</button>
    </div>
</form>
@endsection