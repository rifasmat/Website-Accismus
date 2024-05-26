@extends('humas.layouts.template')

@section('content')
<div class="pagetitle">
  <h1>About</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section about">
  <div class="row">
    Ini halaman Dashboard
  </div>
</section>
@endsection