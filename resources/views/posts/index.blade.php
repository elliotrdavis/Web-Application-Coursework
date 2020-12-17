@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    @foreach($posts as $post)
        <li><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
    @endforeach

    <a href="{{ route('posts.create') }}">Create Post</a>
@endsection