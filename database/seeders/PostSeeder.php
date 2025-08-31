<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            $user->posts()->saveMany(Post::factory(5)->make());
        });
    }
}