@extends('guest.layouts.template')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('guest.dashboard.list') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Total Team -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Team Accismus</h5>
          <p class="card-text">{{ $totalTeam }}</p>
          <a href="{{ route('guest.team.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Team -->

    <!-- Total History RF -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">History RF Accismus</h5>
          <p class="card-text">{{ $totalHistory }}</p>
          <a href="{{ route('guest.history-rf.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End History RF -->

    <!-- Total Gallery -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Gallery Accismus</h5>
          <p class="card-text">{{ $totalGallery }}</p>
          <a href="{{ route('guest.gallery.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Gallery -->

    <!-- Total Member -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Member</h5>
          <p class="card-text">{{ $totalMember }}</p>
          <a href="{{ route('guest.member.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Member -->
  </div>
</section>
@endsection