<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // User belongs to one role. roles have many users.
    public function users()
    {
        return $this->hasMany('\App\Models\User');
    }
}