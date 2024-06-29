@extends('guest.layouts.template')

@section('content')

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<div class="pagetitle">
    <h1>Team Accismus</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.dashboard.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Team</li>
        </ol>
    </nav>
</div>

<div class="text-center mb-2">
    <h2>Daftar Team Accismus</h2>
</div>

<div class="container">
    <div class="mb-2">
        <!-- Search -->
        <form action="{{ route('guest.team.search') }}" method="GET" class="form-inline mt-3">
            <div class="input-group">
                <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Search..." style="max-width: 300px;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    @if($users->isEmpty())
    <div class="alert alert-info mt-3 text-center">Data Team Belum Ada</div>
    @else
    <table class="table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Whatsapp</th>
                <th scope="col">Discord</th>
                <th scope="col">Role</th>
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr class="text-center">
                <td>{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                <td>{{ $user->user_nama }}</td>
                <td>{{ $user->user_username }}</td>
                <td>{{ $user->user_email }}</td>
                <td>{{ $user->user_wa }}</td>
                <td>{{ $user->user_discord }}</td>
                <td>{{ $user->user_role }}</td>
                <td>
                    <img src="{{ Storage::url($user->user_foto) }}" alt="Foto Team" class="img-thumbnail" style="width: 100px; height: 100px;">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Custom Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($users->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            @if ($page == $users->currentPage())
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
            @if ($users->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
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