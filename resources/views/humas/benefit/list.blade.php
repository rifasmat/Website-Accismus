@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Benefit Website Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Benefit</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Benefit Website Accismus</h2>
</div>
<div class="container">
    <form action="{{ route('humas.benefit.update', $benefit->benefit_uuid) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="judul"><b>Judul</b></label>
            <input type="text" class="form-control" name="judul" id="judul" autocomplete="off" value="{{ old('judul', $benefit->benefit_judul) }}">
            @error('judul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="text" class="font-weight-bold">Text</label>
            <textarea id="text" class="form-control" name="text" rows="10">{{ old('text', $benefit->benefit_text) }}</textarea>
            @error('text')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="input-group" style="display: flex; align-items: center;">
                <input type="file" class="form-control" id="foto" name="foto" style="flex: 1;" onchange="previewImage()">
                <input type="hidden" name="foto_old" value="{{ $benefit->benefit_foto }}">
                <img id="fotoPreview" src="{{ Storage::url($benefit->benefit_foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 150px; margin-left: 10px;">
            </div>
            @error('foto')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <a href="{{ route('humas.benefit.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
            <button id="editBenefitBtn" class="btn btn-sm btn-primary">Update</button>
        </div>
    </form>
</div>

@endsection