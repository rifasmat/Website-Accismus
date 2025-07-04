@extends('moderator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Benefit Website Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('moderator.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Benefit</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Benefit Website Accismus</h2>
</div>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="judul"><b>Judul</b></label>
            <input type="text" class="form-control" name="judul" id="judul" autocomplete="off" value="{{ old('judul', $benefit->benefit_judul) }}" readonly>
            @error('judul')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mt-4">
            <textarea id="text" class="form-control" name="text" rows="10" readonly>{{ old('text', $benefit->benefit_text) }}</textarea>
            @error('text')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="input-group" style="display: flex; align-items: center;">
                <input type="hidden" name="foto_old" value="{{ $benefit->benefit_foto }}" readonly>
                <img id="fotoPreview" src="{{ Storage::url($benefit->benefit_foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 150px; margin-left: 10px;">
            </div>
            @error('foto')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
    </form>
</div>

@endsection