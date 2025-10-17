@extends('layouts.main')

@section('title', 'Manage Providers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-tv"></i> Manage Streaming Providers</h1>
    <a href="{{ route('providers.create-form') }}" class="btn btn-warning">
        <i class="fas fa-plus"></i> Add New Provider
    </a>
</div>

<div class="card bg-dark border-secondary">
    <div class="card-body">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($providers as $provider)
                <tr>
                    <td>{{ $provider->id }}</td>
                    <td>{{ $provider->name }}</td>
                    <td>
                        <a href="{{ route('providers.update-form', ['provider' => $provider->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('providers.delete', ['provider' => $provider->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, '{{ $provider->name }}')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No providers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-dark border-secondary">
        {{ $providers->links() }}
    </div>
</div>
@endsection

@section('script')
<script>
    function confirmDelete(event, providerName) {
        event.preventDefault();
        const form = event.target;
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete '${providerName}'.`,
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