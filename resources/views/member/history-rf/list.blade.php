@extends('member.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>History RF Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('member.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">History RF</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar History RF Accismus</h2>
</div>

<div class="container">
    <div class="mb-2">
        <!-- Search -->
        <form action="{{ route('member.history-rf.search') }}" method="GET" class="form-inline mt-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if($history->isEmpty())
    <div class="alert alert-info mt-3 text-center">Data History Belum Ada.</div>
    @else
    <div class="row mt-5">
        @foreach($history as $historyrf)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ Storage::url($historyrf->history_foto) }}" alt="Foto History RF" style="width: 100%; height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $historyrf->history_judul }}</h5>
                    <p class="card-text">{{ $historyrf->history_rf }}</p>
                    <p class="card-text">Tahun : {{ $historyrf->history_tahun }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Custom Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($history->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $history->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($history->getUrlRange(1, $history->lastPage()) as $page => $url)
            @if ($page == $history->currentPage())
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
            @if ($history->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $history->nextPageUrl() }}">Next</a>
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