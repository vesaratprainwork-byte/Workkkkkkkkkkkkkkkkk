<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    use AuthorizesRequests;


    public function list()
    {
        $this->authorize('viewAny', User::class);
        $users = User::paginate(10);
        return view('users.list', ['users' => $users]);
    }


    public function showCreateForm()
    {
        $this->authorize('create', User::class);
        return view('users.create-form');
    }


    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()],
            'role' => 'required|in:ADMIN,USER',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.list')->with('status', "User '{$request->name}' was created successfully.");
    }


    public function updateForm(User $user)
    {
        $this->authorize('update', $user);
        return view('users.update-form', ['user' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:ADMIN,USER',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.list')->with('status', "User '{$user->name}' has been updated.");
    }


    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.list')->with('status', "User '{$userName}' has been deleted.");
    }
}
