<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function index()
    {
        if(Auth::user()->role->name === 'admin') {
            return view('admin.index', ['users' => User::all(), 'posts' => Post::all()]);
        } else {
            return abort(403);
        }
    }

    public function edit(Post $post)
    {
        if(Auth::user()->role->name === 'admin') {
            return view('admin.edit', ['user' => $user]);
        } else {
            return abort(403);
        }
        
        return false;
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role_id' => 'required',
        ]);

        $u = User::find($user->id);
        $u->role_id = $validatedData['role_id'];
        $u->save();

        return redirect()->route('admin.index')
            ->with('success','User role updated');
    }

}