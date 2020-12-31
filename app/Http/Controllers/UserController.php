<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function show($user)
    {
        return view('users.show', ['user' => User::findOrFail($user)]);
    }

    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    public function edit(User $user)
    {
        if(Auth::user()->id === $user->id) {
            return view('users.edit', ['user' => $user]);
        } elseif(Auth::user()->role->name === "moderator" || Auth::user()->role->name === "admin") {
            return view('users.edit', ['user' => $user]);
        } else {
            return abort(403);
        }
        
        return false;
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'email' => 'unique:users,email,'.$user->id,
            'bio' => 'max:500',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'number' => 'size:11',
        ]);

        $avatarName = $user->avatar;
        if($request->avatar) {
            $avatarName = time().'.'.$request->avatar->extension();  
            $request->avatar->move(public_path('img'), $avatarName);
        }

        $u = User::find($user->id);
        $u->name = $validatedData['name'];
        $u->email = $validatedData['email'];
        $u->bio = $validatedData['bio'];
        $u->avatar = $avatarName;
        $u->save();

        
        $p = new Phone;
        $p->user_id = $user->id;
        $p->number = $validatedData['number'];
        $p->save();

        return redirect()->route('users.show', ['user' => Auth::user()])
            ->with('success','You have successfully updated your profile')
            ->with('image',$avatarName); 
    
    }

}