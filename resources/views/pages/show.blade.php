@extends('layouts.app')

@section('title')
    Page {{ $page->id }}
@endsection

@section('content')
    <div>
        Title: {{ $page->title }}
    </div>

    <div>
        Description: {{ $page->description }}
    </div>

    Total posts for this page: {{ $page->posts->count() }}
    @foreach($page->posts as $post)
        <li>{{ $post->title }}</li>
    @endforeach
@endsection
