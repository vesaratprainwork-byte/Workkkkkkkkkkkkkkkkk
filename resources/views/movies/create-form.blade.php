@extends('layouts.main')

@section('title', 'Add New Movie')

@section('content')
    <h1><i class="fas fa-plus-circle"></i> Add New Movie</h1>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <form action="{{ route('movies.create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control bg-secondary text-white border-dark @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="release_year" class="form-label">Release Year</label>
                        <input type="number" class="form-control bg-secondary text-white border-dark @error('release_year') is-invalid @enderror" id="release_year" name="release_year" value="{{ old('release_year') }}" required>
                        @error('release_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="genre_code" class="form-label">Genre</label>
                    <select class="form-select bg-secondary text-white border-dark @error('genre_code') is-invalid @enderror" id="genre_code" name="genre_code" required>
                        <option value="">Select a genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->code }}" {{ old('genre_code') == $genre->code ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="poster_url" class="form-label">Poster URL</label>
                    <input type="url" class="form-control bg-secondary text-white border-dark @error('poster_url') is-invalid @enderror" id="poster_url" name="poster_url" value="{{ old('poster_url') }}">
                    @error('poster_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Synopsis</label>
                    <textarea class="form-control bg-secondary text-white border-dark" id="synopsis" name="synopsis" rows="4">{{ old('synopsis') }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save Movie</button>
                <a href="{{ route('movies.list') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection