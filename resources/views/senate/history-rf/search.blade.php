@extends('senate.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian History RF Accismus</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('senate.history-rf.search') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('senate.history-rf.list') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </form>

    @if(isset($history))
    @if($history->isEmpty())
    <div class="alert alert-danger mt-3 text-center">Foto tidak ditemukan.</div>
    @else
    <div class="row mt-5 justify-content-center">
        @foreach($history as $historyrf)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ Storage::url($historyrf->history_foto) }}" alt="Foto History" style="width: 100%; height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $historyrf->history_rf }}</h5>
                    <p class="card-text">Tahun : {{ $historyrf->history_tahun }}</p>
                    <div class="d-flex justify-content-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('senate.history-rf.edit', $historyrf->history_uuid) }}" class="btn btn-warning btn-sm mr-1">Edit</a>

                            <form method="GET" action="{{ route('senate.history-rf.konfirmasi', $historyrf->history_uuid) }}" style="display:inline;">
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