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
        $post = Post::with(['comments' => function ($q) {
            $q->orderBy('created_at', 'desc');
          }])->find($post->id);
          
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = null;
        if($request->image) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('img'), $imageName);
        }

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = Auth::user()->id;
        $p->page_id = $validatedData['page_id'];
        $p->image = $imageName;
        $p->save();

        return redirect()->route('pages.home')
            ->with('success','Post created successfully')
            ->with('image',$imageName);
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

    public function imageUpload()
    {
        return view('imageUpload');
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'page_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = $post->image;
        if($request->image) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('img'), $imageName);
        }

        $p = Post::find($post->id);
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = Auth::user()->id;
        $p->page_id = $validatedData['page_id'];
        $p->image = $imageName;
        $p->save();
    
        return redirect()->route('pages.home')
            ->with('success','Post updated successfully')
            ->with('image',$imageName);
    }

    public function destroy(Post $post)
    {

        if(Auth::user()->id === $post->user->id) {
            $post->delete();
            return redirect()->route('pages.home')->with('success', 'Post was deleted.');
        } else {
            return abort(403);
        }
        return false;
    }

}