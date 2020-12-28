<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function index()
    {
        return view('posts.index', ['posts' => Post::all()]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'page_id' => 'required|integer',
        ]);

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = $user_id;
        $p->page_id = $validatedData['page_id'];
        $p->save();

        session()->flash('message', 'Post was created.');
        return redirect()->route('pages.home');
    }

    public function edit(Post $post)
    {
        if(Auth::user()->id === $post->user->id) {
            return view('posts.edit', ['post' => $post]);
        } else {
            return abort(403);
        }
        
        return false;
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'page_id' => 'required|integer',
        ]);

        $p = Post::find($post->id);
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = Auth::user()->id;
        $p->page_id = $validatedData['page_id'];
        $p->save();
    
        return redirect()->route('pages.home')->with('success','Product updated successfully');
    }

    public function destroy(Post $post)
    {

        if(Auth::user()->id === $post->user->id) {
            $post->delete();
            return redirect()->route('pages.home')->with('message', 'Post was deleted.');
        } else {
            return abort(403);
        }
        return false;
    }

}