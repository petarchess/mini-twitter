<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ... existing code

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followers()
    {
        // people who follow *this* user
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function following()
    {
        // people that *this* user follows
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function follows(User $user)
    {
        return $this->following()->where('follower_id', $user->id)->exists();
    }
}
