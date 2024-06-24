@extends('senate.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>History RF Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('senate.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">History RF</li>
        </ol>
    </nav>
</div>

<div class="text-center mb2">
    <h2>Tambah History RF Accismus</h2>
</div>

<form action="{{ route('senate.history-rf.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-3">
        <label for="rf"><b>Nama RF</b></label>
        <input type="text" class="form-control" name="rf" id="rf" autocomplete="off" placeholder="Masukan Nama RF .." value="{{ old('rf') }}">
        @error('rf')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="tahun"><b>Tahun</b></label>
        <input type="number" class="form-control" name="tahun" id="tahun" autocomplete="off" placeholder="Masukan Tahun .." value="{{ old('tahun') }}" min="1000" max="9999" maxlength="4">
        @error('tahun')
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
        <a href="{{ route('senate.history-rf.list') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
        <button id="tambahHistoryRFBtn" class="btn btn-sm btn-primary">Tambah Data</button>
    </div>
</form>
@endsection