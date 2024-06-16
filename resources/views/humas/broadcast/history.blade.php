@extends('humas.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>Histroy Broadcast Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('humas.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Broadcast Email</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar History Broadcast Accismus</h2>
</div>

<div class="box-header d-flex justify-content-end mb-3">
    <div class="btn-group">
        <a href="{{ route('humas.broadcast.create') }}" class="btn btn-primary">
            &nbsp;Send Broadcast
        </a>
    </div>
</div>

<div class="container">
    <div class="mb-2">
        <!-- Search -->
        <form action="{{ route('humas.broadcast.search') }}" method="GET" class="form-inline mt-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if($broadcasts->isEmpty())
    <div class="alert alert-info mt-3 text-center">History broadcast tidak ditemukan.</div>
    @else
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Email Pengirim</th>
                <th scope="col">Subject</th>
                <th scope="col">Pesan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($broadcasts as $index => $broadcast)
            <tr class="text-center">
                <td>{{ $index + 1 + ($broadcasts->currentPage() - 1) * $broadcasts->perPage() }}</td>
                <td>{{ $broadcast->broadcast_sentby }}</td>
                <td>{{ $broadcast->broadcast_pengirim_email }}</td>
                <td>{{ $broadcast->broadcast_subject }}</td>
                <td>{{ $broadcast->broadcast_pesan }}</td>
                <td>{{ $broadcast->broadcast_tanggal }}</td>
                <td>
                    @if ($broadcast->broadcast_status == 'Sent')
                    <span class="text-success">{{ $broadcast->broadcast_status }}</span>
                    @elseif ($broadcast->broadcast_status == 'Failed')
                    <span class="text-danger">{{ $broadcast->broadcast_status }}</span>
                    @else
                    {{ $broadcast->broadcast_status }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Custom Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($broadcasts->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $broadcasts->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($broadcasts->getUrlRange(1, $broadcasts->lastPage()) as $page => $url)
            @if ($page == $broadcasts->currentPage())
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
            @if ($broadcasts->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $broadcasts->nextPageUrl() }}">Next</a>
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