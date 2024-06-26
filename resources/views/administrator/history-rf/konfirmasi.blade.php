@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>History RF Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">History RF</li>
        </ol>
    </nav>
</div>
<div class="text-center mb-3">
    <h2>Konfirmasi Delete History RF Accismus</h2>
</div>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ Storage::url($history->history_foto) }}" alt="Foto History" style="width: 100%; height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $history->history_nama }}</h5>
                    <p class="card-text">{{ $history->history_rf }}</p>
                    <p class="card-text"> Tahun : {{ $history->history_tahun }}</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('administrator.history-rf.list') }}" class="btn btn-secondary btn-sm">Batal</a>
        <form method="POST" action="{{ route('administrator.history-rf.destroy', $history->history_uuid) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
        </form>
    </div>
</div>

@endsection