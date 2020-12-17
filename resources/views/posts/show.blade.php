@extends('layouts.app')

@section('title')
    Post {{ $post->id }}
@endsection

@section('content')
    <div>
        Title: {{ $post->title }}
    </div>

    <div>
        Body: {{ $post->body }}
    </div>

    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    
    <p><a href="{{ route('posts.index') }}">Back</a></p>

@endsection
