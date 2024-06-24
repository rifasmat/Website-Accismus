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
<div class="text-center mb-3">
    <h2>Konfirmasi Delete Gallery Accismus</h2>
</div>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ Storage::url($gallery->gallery_foto) }}" alt="Foto gallery" style="width: 100%; height: 250px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $gallery->gallery_judul }}</h5>
                    <p class="card-text">{{ $gallery->gallery_rf }}</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('humas.gallery.list') }}" class="btn btn-secondary btn-sm">Batal</a>
        <form method="POST" action="{{ route('humas.gallery.destroy', $gallery->gallery_uuid) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </form>
    </div>
</div>

@endsection