@extends('layouts.main')

@section('title', 'Manage Users')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-users-cog"></i> Manage Users</h1>
        <a href="{{ route('admin.users.create-form') }}" class="btn btn-warning">
            <i class="fas fa-plus"></i> New User
        </a>
    </div>

    <div class="card bg-dark border-secondary">
        <div class="card-body">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span
                                    class="badge {{ $user->role === 'ADMIN' ? 'bg-danger' : 'bg-secondary' }}">{{ $user->role }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.update-form', ['user' => $user->id]) }}"
                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                @if (Auth::id() !== $user->id)
                                    <form action="{{ route('admin.users.delete', ['user' => $user->id]) }}" method="POST"
                                        class="d-inline" onsubmit="return confirmDelete(event, '{{ $user->name }}')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                            Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-dark border-secondary">
            {{ $users->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(event, userName) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the user '${userName}'. This action cannot be undone.`,
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
