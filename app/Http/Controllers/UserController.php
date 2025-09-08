<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Index', [
            'message' => 'User Management',
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create', [
            'message' => 'Create a new user',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'is_admin' => 'boolean',
            'role'     => 'nullable|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

     return redirect()->route('user.index', $user->id)
                 ->with('success', 'User created successfully!');

    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('User/Show', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('User/Edit', [
            'user' => $user,
            'message' => 'Edit User'
        ]);
    }

    public function update(Request $request, $id)
    {
                $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'is_admin' => 'boolean',
            'role'     => 'nullable|string|max:50',
        ]);

      if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }

        $user->update($validated);

      return Inertia::location(route('user.index'));

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
                         ->with('success', 'User deleted
                         successfully!');
    }
}
