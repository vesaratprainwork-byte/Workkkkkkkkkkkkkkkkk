@extends('layouts.main')

@section('title', 'Edit User')

@section('content')
<h1><i class="fas fa-user-edit"></i> Edit User: {{ $user->name }}</h1>

<div class="card bg-dark border-secondary">
    <div class="card-body">
        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control bg-secondary text-white border-dark" id="name"
                    name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control bg-secondary text-white border-dark" id="email"
                    name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select bg-secondary text-white border-dark" name="role" id="role" required>
                    <option value="USER" {{ $user->role === 'USER' ? 'selected' : '' }}>USER</option>
                    <option value="ADMIN" {{ $user->role === 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                </select>
            </div>

            <hr class="border-secondary my-4">


            <h5 class="text-warning">Change Password</h5>
            <p class="text-muted">Leave these fields blank if you do not want to change the password.</p>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password"
                    class="form-control bg-secondary text-white border-dark @error('password') is-invalid @enderror"
                    id="password" name="password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control bg-secondary text-white border-dark"
                    id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-warning mt-3"><i class="fas fa-save"></i> Save Changes</button>
            <a href="{{ route('admin.users.list') }}" class="btn btn-outline-secondary mt-3">Cancel</a>
        </form>
    </div>
</div>
@endsection