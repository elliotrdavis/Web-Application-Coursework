<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Page has many posts (one-many).
    public function posts()
    {
        return $this->hasMany('\App\Models\Post'); 
    }
    
}
