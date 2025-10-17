@extends('layouts.main')

@section('title', $movie->title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $movie->poster_url ?: 'https://via.placeholder.com/400x600.png?text=No+Poster' }}" class="img-fluid rounded" alt="{{ $movie->title }}">
        </div>
        <div class="col-md-8">
            <h1 class="text-warning">{{ $movie->title }}</h1>
            <div class="d-flex align-items-center mb-2">
                <h3 class="text-warning mb-0 me-2">
                    <i class="fas fa-star"></i> {{ number_format($movie->average_rating, 1) }}
                </h3>
                <span class="text-muted">/ 5.0 (from {{ $movie->reviews_count }} reviews)</span>
            </div>
            <p class="text-muted">{{ $movie->release_year }} • {{ $movie->genre->name }}</p>
            <h4 class="mt-4">Synopsis</h4>
            <p>{{ $movie->synopsis ?: 'No synopsis available.' }}</p>

            <h4 class="mt-4">Available On</h4>
            <div>
                @forelse ($movie->providers as $provider)
                    <a href="{{ $provider->url }}" target="_blank" class="badge bg-light text-dark fs-6 me-1 text-decoration-none">
                        {{ $provider->name }}
                    </a>
                @empty
                    <p class="text-muted">Availability information not available.</p>
                @endforelse
            </div>

            <div class="mt-5">
                <a href="{{ route('movies.list') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
                @can('update', $movie)
                    <a href="{{ route('movies.update-form', ['movie' => $movie->id]) }}" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                @endcan
                @can('delete', $movie)
                    <form action="{{ route('movies.delete', ['movie' => $movie->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDeleteMovie(event)">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
    <hr class="my-5 border-secondary">
    <div class="row">

        <div class="col-md-6">
            <h2><i class="fas fa-comments"></i> Reviews</h2>
            @forelse ($movie->reviews->sortByDesc('created_at') as $review)
                <div class="card bg-black border-secondary mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-0">{{ $review->user->name }}</h5>
                                <span class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </span>
                            </div>
                            @can('update', $review)
                                    <a href="{{ route('reviews.edit-form', ['review' => $review->id]) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-edit"></i></a>
                                @endcan
                                
                            @can('delete', $review)
                                <form action="{{ route('reviews.delete', ['review' => $review->id]) }}" method="POST"
                                    onsubmit="return confirmDeleteReview(event)">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            @endcan
                        </div>
                        <p class="card-text mt-2">{{ $review->comment }}</p>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @empty
                <p>No reviews yet. Be the first to write one!</p>
            @endforelse
        </div>


        <div class="col-md-6">

            @auth
                @can('create', App\Models\Review::class)
                    <h3><i class="fas fa-pen-fancy"></i> Write a Review</h3>
                    <div class="card bg-black border-secondary">
                        <div class="card-body">
                            <form action="{{ route('reviews.create', ['movie' => $movie->id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Your Rating (1-5)</label>
                                    <select class="form-select bg-secondary text-white" name="rating" id="rating" required>
                                        <option value="">Select a rating</option>
                                        <option value="5">5 - Excellent</option>
                                        <option value="4">4 - Very Good</option>
                                        <option value="3">3 - Good</option>
                                        <option value="2">2 - Fair</option>
                                        <option value="1">1 - Poor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Your Comment</label>
                                    <textarea class="form-control bg-secondary text-white" name="comment" id="comment" rows="4"></textarea>
                                </div>
                                <button type="submit" class="btn btn-warning">Submit Review</button>
                            </form>
                        </div>
                    </div>
                @endcan
            @endauth

            @guest
                <div class="alert alert-warning text-center">
                    <p class="mb-0">You must be logged in to write a review.</p>
                    <a href="{{ route('logins.form') }}" class="btn btn-warning mt-2">Login Now</a>
                </div>
            @endguest

        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDeleteMovie(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to delete '{{ $movie->title }}'. This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                background: '#343a40',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }


        function confirmDeleteReview(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: 'Delete this review?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                background: '#343a40',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>
@endsection
