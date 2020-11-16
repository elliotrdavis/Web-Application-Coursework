<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Post has one user (one-many).
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    // Post has one page (one-many).
    public function page()
    {
        return $this->belongsTo('\App\Models\Page');
    }

    // Post has many comments (one-many).
    public function comments()
    {
        return $this->hasMany('\App\Models\Comment'); 
    }
}
