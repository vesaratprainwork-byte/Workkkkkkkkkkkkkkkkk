@extends('layouts.main')

@section('title', 'Manage Genres')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-tags"></i> Manage Genres</h1>
        @can('create', App\Models\Genre::class)
            <a href="{{ route('genres.create-form') }}" class="btn btn-warning">
                <i class="fas fa-plus"></i> Add New Genre
            </a>
        @endcan
    </div>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 15%;">Code</th>
                        <th>Name</th>
                        @can('create', App\Models\Genre::class) 
                            <th style="width: 25%;">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($genres as $genre)
                        <tr>
                            <td>{{ $genre->code }}</td>
                            <td>{{ $genre->name }}</td>
                            @can('create', App\Models\Genre::class) 
                                <td>
                                    
                                    <a href="{{ route('genres.update-form', ['genre' => $genre->code]) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                    
                                    <form action="{{ route('genres.delete', ['genre' => $genre->code]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No genres found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-dark border-secondary">
            {{ $genres->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
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