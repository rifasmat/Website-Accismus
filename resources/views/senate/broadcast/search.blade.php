@extends('senate.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="text-center mb-2">
    <h2>Pencarian History Broadcast Email Accismus</h2>
</div>

<div class="container">
    <!-- Search -->
    <form action="{{ route('senate.broadcast.search') }}" method="GET" class="form-inline mt-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('senate.broadcast.history') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </form>

    @if(isset($broadcasts))
    @if($broadcasts->isEmpty())
    <div class="alert alert-danger mt-3 text-center">History broadcast tidak ditemukan.</div>
    @else
    <table class="table mt-3">
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
                <td>{{ $index + 1 }}</td>
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
    @endif
    @endif
</div>

@endsection