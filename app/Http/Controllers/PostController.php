<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
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

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post was deleted.');
    }

}