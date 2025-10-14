@extends('layouts.main')

@section('title', 'All Movies')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-ticket-alt"></i> All Movies</h1>
        @can('create', App\Models\Movie::class)
            <a href="{{ route('movies.create-form') }}" class="btn btn-warning">
                <i class="fas fa-plus"></i> Add New Movie
            </a>
        @endcan
    </div>


    <div class="card bg-black border-secondary mb-4">
        <div class="card-body">
            <form action="{{ route('movies.list') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label">Search by Title</label>
                    <input type="text" class="form-control bg-secondary text-white border-dark" id="search"
                        name="search" placeholder="e.g., Inception" value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="genre" class="form-label">Filter by Genre</label>
                    <select class="form-select bg-secondary text-white border-dark" id="genre" name="genre">
                        <option value="">All Genres</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->code }}"
                                {{ ($selectedGenre ?? '') == $genre->code ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        @forelse ($movies as $movie)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 bg-black border-secondary">
                    <img src="{{ $movie->poster_url ?: 'https://via.placeholder.com/300x450.png?text=No+Poster' }}"
                        class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-warning">{{ $movie->title }}</h5>

                        <div class="mb-2">
                            <span class="text-warning">
                                <i class="fas fa-star"></i> {{ number_format($movie->average_rating, 1) }}
                            </span>
                            <small class="text-muted">({{ $movie->reviews_count }} reviews)</small>
                        </div>

                        <p class="card-text text-muted flex-grow-1">{{ $movie->release_year }} • <span
                                class="badge bg-secondary">{{ $movie->genre->name }}</span></p>
                        <a href="{{ route('movies.view', ['movie' => $movie->id]) }}"
                            class="btn btn-outline-warning mt-auto">Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-info">No movies found matching your criteria.</div>
            </div>
        @endforelse
    </div>


    <div class="d-flex justify-content-center">
        {{ $movies->links() }}
    </div>
@endsection
