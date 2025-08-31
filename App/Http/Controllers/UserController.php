<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show list of users with optional search.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate(15);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show a single user profile.
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Explore all users (no filtering).
     */
    public function explore()
    {
        $users = User::paginate(15);
        return view('users.explore', ['users' => $users]);
    }

    /**
     * Show the users that this user is following.
     */
    public function following(User $user)
    {
        $following = $user->following()->paginate(15);
        return view('users.following', [
            'user'  => $user,
            'users' => $following,
        ]);
    }

    /**
     * Show the followers of this user.
     */
    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(15);
        return view('users.followers', [
            'user'  => $user,
            'users' => $followers,
        ]);
    }
}
