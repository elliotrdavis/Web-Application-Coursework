<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // User has many posts (one-many).
    public function posts()
    {
        return $this->hasMany('\App\Models\Post'); 
    }

    public function comments()
    {
        return $this->hasMany('\App\Models\Comment'); 
    }

    // Each User can follow many people (self-referencing many-many relationship).
    public function friends()
	{
		return $this->belongsToMany('\App\Models\User', 'users_friends', 'user_id', 'friend_id');
    }
}
