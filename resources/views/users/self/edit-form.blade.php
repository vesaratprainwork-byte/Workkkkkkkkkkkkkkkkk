@extends('layouts.main')

@section('title', 'Edit My Profile')

@section('content')
    <h1><i class="fas fa-user-edit"></i> Edit My Profile</h1>


    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text"
                        class="form-control bg-secondary text-white border-dark @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email"
                        class="form-control bg-secondary text-white border-dark @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr class="border-secondary my-4">
                <h5 class="text-warning">Change Password</h5>
                <p class="text-muted">Leave these fields blank if you do not want to change your password.</p>
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password"
                        class="form-control bg-secondary text-white border-dark @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save Changes</button>
            </form>
        </div>
    </div>


    <hr class="my-5 border-secondary">
    <h2><i class="fas fa-comments"></i> My Reviews ({{ $user->reviews->count() }})</h2>

    @forelse ($user->reviews->sortByDesc('created_at') as $review)
        <div class="card bg-black border-secondary mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-0">
                            <a href="{{ route('movies.view', ['movie' => $review->movie->id]) }}"
                                class="text-warning text-decoration-none">
                                {{ $review->movie->title }}
                            </a>
                        </h5>
                        <span class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                            @endfor
                        </span>
                    </div>
                    @can('delete', $review)
                        <form action="{{ route('reviews.delete', ['review' => $review->id]) }}" method="POST"
                            onsubmit="return confirmDeleteReview(event)">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    @endcan
                </div>
                <p class="card-text mt-2">{{ $review->comment }}</p>
                <small class="text-muted">Reviewed {{ $review->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            You haven't written any reviews yet.
        </div>
    @endforelse

@endsection

@section('script')
    <script>
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
