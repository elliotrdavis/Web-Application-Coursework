<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    public function commentRequest(Post $post) {
        return view('posts.show', ['post' => $post]);
    }

    public function commentRequestPost(Request $request, Post $post) {

        $validatedData = $request->validate([
            'body' => 'required',
        ]);
            
            $c = new Comment;
            $c->body = $validatedData['body'];
            $c->user_id = Auth::id();
            $c->post_id = $post->id;
            $c->save(); 

            return response()->json(['success'=>'Added new records.']);

    }

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


        session()->flash('success', 'Comment was created.');
        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function edit(Comment $comment)
    {
        if(Auth::user()->id === $comment->user->id) {
            return view('comments.edit', ['comment' => $comment]);
        } elseif(Auth::user()->role->name === "moderator" || Auth::user()->role->name === "admin") {
            return view('comments.edit', ['comment' => $comment]);
        } else {
            return abort(403);
        }
    }

    public function update(Request $request, Comment $comment)
    {
        $post_id = $comment->post->id;
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $c = Comment::find($comment->id);
        $c->body = $validatedData['body'];
        $c->user_id = Auth::user()->id;
        $c->post_id = $post_id;
        $c->save();
    
        return redirect()->route('posts.show', ['post'=>$comment->post->id])->with('success','Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {

        if(Auth::user()->id === $comment->user->id) {
            $comment->delete();
            return redirect()->route('posts.show', ['post'=>$comment->post->id])->with('success', 'Comment was deleted.');
        } elseif(Auth::user()->role->name === "moderator" || Auth::user()->role->name === "admin") {
            $comment->delete();
            return redirect()->route('posts.show', ['post'=>$comment->post->id])->with('success', 'Comment was deleted.');
        } else {
            return abort(403);
        }
    }

}