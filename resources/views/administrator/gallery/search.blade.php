@extends('administrator.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian Gallery Accismus</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('administrator.gallery.search') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('administrator.gallery.list') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </form>

    @if(isset($gallery))
    @if($gallery->isEmpty())
    <div class="alert alert-danger mt-3 text-center">Foto tidak ditemukan.</div>
    @else
    <div class="row mt-5 justify-content-center">
        @foreach($gallery as $photo)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ Storage::url($photo->gallery_foto) }}" alt="Foto gallery" style="width: 100%; height: 250px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $photo->gallery_judul }}</h5>
                    <p class="card-text">{{ $photo->gallery_rf }}</p>
                    <div class="d-flex justify-content-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('administrator.gallery.edit', $photo->gallery_uuid) }}" class="btn btn-warning btn-sm mr-1">Edit</a>

                            <form method="GET" action="{{ route('administrator.gallery.konfirmasi', $photo->gallery_uuid) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @endif
</div>

@endsection