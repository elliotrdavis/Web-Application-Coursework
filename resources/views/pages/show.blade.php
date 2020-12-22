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
        <li><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
    @endforeach

    <a href="{{ route('posts.create') }}">Create Post</a>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <div id="root">
        <li v-for="post in posts">@{{ post }}</li>
    </div>
    
    <script>
        var app = new Vue({
            el: "#root",
            data: {
                posts: ['test', '2'],
            },
        });
    </script>


@endsection



