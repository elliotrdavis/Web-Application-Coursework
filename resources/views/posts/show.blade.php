@extends('layouts.app')

@section('title')
    Post {{ $post->id }}
@endsection

@section('content')
    <div class="container mb-5 bg-white border rounded shadow p-3">
    <div class="title">
        <h1>{{ $post->title }}</h1>
    </div>
    <div class="posted-by border-bottom">
        <h4>by <a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->name}}</a></h4>
    </div>

    <div class="date_posted border-bottom my-2">
        <h5> Posted on {{ $post->created_at->format('jS F Y h:i:s A')}}</h5>
    </div>


    <!-- image here -->

    <div class="body">
        {{ $post->body }}
    </div>

    <!-- comments -->

    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    </div>

@endsection
