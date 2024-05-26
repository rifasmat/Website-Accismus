@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
    <h1>Pengguna Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="text-center mb2">
    <h2>Daftar Pengguna Accismus</h2>
</div>

<div class="box-header d-flex justify-content-end mb-3">
    <div class="btn-group">
        <a href="{{ route('humas.pengguna.create') }}" class="btn btn-secondary">
            &nbsp; Tambah Data Pengguna
        </a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Whatsapp</th>
            <th scope="col">Discord</th>
            <th scope="col">Role</th>
            <th scope="col">Foto</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>1</th>
            <td>Rifa Aulia Asmat</td>
            <td>Mezawarina</td>
            <td>rifasmat@gmail.com</td>
            <td>123123123</td>
            <td>mezawarina</td>
            <td>Humas</td>
            <td>a</td>
            <td>a</td>
        </tr>
    </tbody>
</table>

@endsection