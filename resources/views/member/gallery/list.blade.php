@extends('member.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>Gallery Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('member.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Gallery</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar Gallery Accismus</h2>
</div>

<div class="container">
    <div class="mb-2">
        <!-- Search -->
        <form action="{{ route('member.gallery.search') }}" method="GET" class="form-inline mt-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if($gallery->isEmpty())
    <div class="alert alert-info mt-3 text-center">Data Gallery Belum Ada.</div>
    @else
    <div class="row mt-5">
        @foreach($gallery as $galleries)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ Storage::url($galleries->gallery_foto) }}" alt="Foto gallery" style="width: 100%; height: 250px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $galleries->gallery_judul }}</h5>
                    <p class="card-text">{{ $galleries->gallery_rf }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Custom Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($gallery->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $gallery->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($gallery->getUrlRange(1, $gallery->lastPage()) as $page => $url)
            @if ($page == $gallery->currentPage())
            <li class="page-item active">
                <a class="page-link" href="#">{{ $page }}</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($gallery->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $gallery->nextPageUrl() }}">Next</a>
            </li>
            @else
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
    @endif
</div>

@endsection