<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $users->each(function ($user) use ($users) {
            $user->following()->attach(
                $users->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
