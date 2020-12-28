<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $user_id = Auth::user()->id;
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $c = new Comment;
        $c->body = $validatedData['body'];
        $c->user_id = $user_id;
        $c->post_id = $post->id;
        $c->save();

        session()->flash('message', 'Comment was created.');
        return redirect()->route('posts.show', ['post' => $post]);
    }

}