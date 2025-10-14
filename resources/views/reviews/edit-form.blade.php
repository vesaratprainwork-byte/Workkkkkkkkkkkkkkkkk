@extends('layouts.main')

@section('title', 'Edit Your Review')

@section('content')
    <h1><i class="fas fa-pen-fancy"></i> Edit Your Review for: {{ $review->movie->title }}</h1>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <form action="{{ route('reviews.update', ['review' => $review->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Your Rating (1-5)</label>
                    <select class="form-select bg-secondary text-white" name="rating" id="rating" required>
                        <option value="">Select a rating</option>
                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Good</option>
                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment</label>
                    <textarea class="form-control bg-secondary text-white" name="comment" id="comment" rows="4">{{ old('comment', $review->comment) }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Update Review</button>
                <a href="{{ route('movies.view', ['movie' => $review->movie->id]) }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection