@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Gallery Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Gallery</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Edit Gallery Accismus</h2>
</div>
<div class="container">
    <form action="{{ route('humas.gallery.update', $gallery->gallery_uuid) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="judul"><b>Judul Foto</b></label>
            <input type="text" class="form-control" name="judul" id="judul" autocomplete="off" value="{{ old('judul', $gallery->gallery_judul) }}">
            @error('judul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="rf"><b>Nama RF</b></label>
            <input type="text" class="form-control" name="rf" id="rf" autocomplete="off" value="{{ old('rf', $gallery->gallery_rf) }}">
            @error('rf')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <div class="input-group" style="display: flex; align-items: center;">
                <input type="file" class="form-control" id="foto" name="foto" style="flex: 1;" onchange="previewImage()">
                <input type="hidden" name="foto_old" value="{{ $gallery->gallery_foto }}">
                <img id="fotoPreview" src="{{ Storage::url($gallery->gallery_foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 150px; margin-left: 10px;">
            </div>
            @error('foto')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <a href="{{ route('humas.gallery.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
            <button id="editGalleryBtn" class="btn btn-sm btn-primary">Edit Foto</button>
        </div>
    </form>
</div>
@endsection