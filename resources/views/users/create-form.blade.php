@extends('layouts.main')

@section('title', 'Create New User')

@section('content')
    <h1><i class="fas fa-user-plus"></i> Create New User</h1>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <form action="{{ route('admin.users.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control bg-secondary text-white border-dark @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control bg-secondary text-white border-dark @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control bg-secondary text-white border-dark @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select bg-secondary text-white border-dark" name="role" id="role" required>
                        <option value="USER" {{ old('role') === 'USER' ? 'selected' : '' }}>USER</option>
                        <option value="ADMIN" {{ old('role') === 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Create User</button>
                <a href="{{ route('admin.users.list') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection