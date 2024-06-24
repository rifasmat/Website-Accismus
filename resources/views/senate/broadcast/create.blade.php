@extends('senate.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Broadcast Email Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('senate.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Broadcast Email</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Send Broadcast Accismus</h2>
</div>

<form action="{{ route('senate.broadcast.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-3">
        <label for="subject"><b>Subject</b></label>
        <input type="text" class="form-control" name="subject" id="subject" autocomplete="off" placeholder="Masukan subject .." value="{{ old('subject') }}">
        @error('subject')
        <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mt-4">
        <textarea id="text" class="form-control" name="text" rows="10"></textarea>
        @error('text')
        <div class="alert alert-danger mt-2">
            <p style="color: red;">{{ $message }}</p>
        </div>
        @enderror
    </div>
    <div class="form-group mt-3">
        <a href="{{ route('senate.broadcast.history') }}" class="btn btn-danger btn-sm">&nbsp; Kembali</a>
        <button id="sendBroadcast" class="btn btn-sm btn-primary">Send Broadcast</button>
    </div>
</form>
@endsection