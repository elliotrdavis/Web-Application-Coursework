@extends('layouts.app')

@section('title')
    User {{ $user->id }}
@endsection

@section('content')
    <div>
        Name: {{ $user->name }}
    </div>
    <div>
        Email: {{ $user->email }}
    </div>

    Total posts: {{ $user->posts->count() }}

    @foreach($user->posts as $post)
        <li>{{ $post->title }}</li>
    @endforeach

    <p>Total comments: {{ $user->comments->count() }} </p>

    @foreach($user->comments as $comment)
        <li>{{ $comment->body }}</li>
    @endforeach

@endsection
