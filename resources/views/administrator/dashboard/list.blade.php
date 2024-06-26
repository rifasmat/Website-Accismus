@extends('administrator.layouts.template')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('administrator.dashboard.list') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Total Informasi -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Informasi Accismus</h5>
          <p class="card-text">{{ $totalInformasi }}</p>
          <a href="{{ route('administrator.informasi.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Informasi -->

    <!-- Total About -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">About Accismus</h5>
          <p class="card-text">{{ $totalAbout }}</p>
          <a href="{{ route('administrator.about.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End About -->

    <!-- Total Benefit -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Benefit Accismus</h5>
          <p class="card-text">{{ $totalBenefit }}</p>
          <a href="{{ route('administrator.benefit.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Benefit -->

    <!-- Total Team -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Team Accismus</h5>
          <p class="card-text">{{ $totalTeam }}</p>
          <a href="{{ route('administrator.team.list') }}" class="btn btn-primary">Lihat</a>
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
          <a href="{{ route('guildleader.history-rf.list') }}" class="btn btn-primary">Lihat</a>
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
          <a href="{{ route('administrator.gallery.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Gallery -->

    <!-- Total Broadcast Email -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Broadcast Email Accismus</h5>
          <p class="card-text">{{ $totalBroadcast }}</p>
          <a href="{{ route('administrator.broadcast.history') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Broadcast Email -->

    <!-- Total Pengguna -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Pengguna</h5>
          <p class="card-text">{{ $totalPengguna }}</p>
          <a href="{{ route('administrator.pengguna.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Pengguna -->

    <!-- Total Member -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Member</h5>
          <p class="card-text">{{ $totalMember }}</p>
          <a href="{{ route('administrator.member.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Member -->

    <!-- Total Guest -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Guest</h5>
          <p class="card-text">{{ $totalGuest }}</p>
          <a href="{{ route('administrator.request-member.list') }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <!-- End Guest -->
  </div>
</section>
@endsection