<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        Post::all()->each(function ($post) use ($users) {
            $post->comments()->saveMany(
                Comment::factory(3)->make([
                    'user_id' => $users->random()->id,
                ])
            );
        });
    }
}
