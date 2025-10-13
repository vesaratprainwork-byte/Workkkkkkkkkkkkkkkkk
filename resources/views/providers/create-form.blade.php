@extends('layouts.main')

@section('title', 'Add New Provider')

@section('content')
    <h1><i class="fas fa-plus-circle"></i> Add New Provider</h1>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <form action="{{ route('providers.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Provider Name</label>
                    <input type="text" class="form-control bg-secondary text-white border-dark @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save Provider</button>
                <a href="{{ route('providers.list') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection