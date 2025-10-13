@extends('layouts.main')

@section('title', 'Edit Genre')

@section('content')
    <h1><i class="fas fa-edit"></i> Edit Genre</h1>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <form action="{{ route('genres.update', ['genre' => $genre->code]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label">Genre Code</label>
                    <input type="text" class="form-control bg-secondary text-white border-dark" id="code" name="code" value="{{ $genre->code }}" disabled>
                    <div class="form-text">The code cannot be changed.</div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Genre Name</label>
                    <input type="text" class="form-control bg-secondary text-white border-dark @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $genre->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update Genre
                </button>
                <a href="{{ route('genres.list') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection