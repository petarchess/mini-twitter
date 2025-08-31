<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $followingIds = auth()->user()->following()->pluck('users.id');
        $posts = Post::whereIn('user_id', $followingIds)->orWhere('user_id', auth()->id())->latest()->get();

        return view('dashboard', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $request->validate(['body' => 'required']);
        auth()->user()->posts()->create($request->only('body'));

        return back();
    }
}