@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>About Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">About</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="mb-3 mt-2">
            <label for="judul" class="form-label">Judul Website</label>
            <input type="text" name="judul" class="form-control">
        </div>
        <div class="mb-3">
            <label for="subjudul" class="form-label">Sub Judul Website</label>
            <input type="text" name="subjudul" class="form-control">
        </div>
        <div class="mb-3">
            <label for="rf" class="form-label">Informasi RF</label>
            <input type="text" name="rf" class="form-control">
        </div>
        <div class="mb-3">
            <label for="instagram" class="form-label">Informasi Instagram</label>
            <input type="text" name="instagram" class="form-control">
        </div>
        <div class="mb-3">
            <label for="discord" class="form-label">Informasi Discord</label>
            <input type="text" name="discord" class="form-control">
        </div>
        <div class="mb-3">
            <label for="wa" class="form-label">Informasi Whatsapp</label>
            <input type="text" name="wa" class="form-control">
        </div>
        <div>
            <a href="{{ route('humas.dashboard.list') }}"><button type="submit" class="btn btn-danger">Kembali</button></a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</section>

@endsection