<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function show($user)
    {
        return view('users.show', [
            'user' => User::findOrFail($user),     
            ]);
    }

    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

}