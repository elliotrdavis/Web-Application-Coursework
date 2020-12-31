<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password',];

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

    public function role()
    {
        return $this->belongsTo('\App\Models\Role');
    }

    public function phone()
    {
        return $this->hasOne('\App\Models\Phone');
    }
}
