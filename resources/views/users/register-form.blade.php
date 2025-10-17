@extends('layouts.main')

@section('title', 'Register - MovieHub')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card bg-black border-secondary">
            <div class="card-body">
                <h1 class="text-center text-warning mb-4">
                    <i class="fas fa-user-plus"></i> Create an Account
                </h1>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text"
                            class="form-control bg-secondary text-white border-dark @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                            class="form-control bg-secondary text-white border-dark @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                            class="form-control bg-secondary text-white border-dark @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control bg-secondary text-white border-dark"
                            id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-check-circle"></i>
                            Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection