@extends('layouts.main')

@section('title', 'Welcome to MovieHub')

@section('content')
<div class="text-center py-5 px-3">
    <h1 class="display-4 fw-bold text-warning">Welcome to MovieHub</h1>
    <p class="lead col-lg-6 mx-auto">
        รีวิวหนัง
    </p>
    <hr class="my-4">

    <a href="{{ route('movies.list') }}" class="btn btn-warning btn-lg">
        <i class="fas fa-ticket-alt"></i> Browse All Movies
    </a>
</div>

<h2 class="mt-5 mb-4 border-bottom border-secondary pb-2">Recently Added</h2>


<div class="row">
    @forelse ($latestMovies as $movie)
    <div class="col-md-4 col-lg-3 mb-4">
        <div class="card h-100 bg-black border-secondary">
            <img src="{{ $movie->poster_url ?: 'https://via.placeholder.com/300x450.png?text=No+Poster' }}" class="card-img-top" alt="{{ $movie->title }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-warning">{{ $movie->title }}</h5>
                <p class="card-text text-muted flex-grow-1">{{ $movie->release_year }} • <span class="badge bg-secondary">{{ $movie->genre->name }}</span></p>
                <a href="{{ route('movies.view', ['movie' => $movie->id]) }}" class="btn btn-outline-warning mt-auto">Details</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <div class="alert alert-info">
            Movie listings will be displayed here soon!
        </div>
    </div>
    @endforelse
</div>
@endsection