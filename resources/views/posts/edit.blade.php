@extends('layouts.app')

@section('title')
    Edit Post {{ $post }}
@endsection

@section('content')
    <div class="container mb-5 bg-white border rounded shadow p-3">
        <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}">
            @csrf
            <div class="title">
                <h1>
                    <input class="container-fluid my-1" type="text" name="title" placeholder="Enter Title here {{ Auth::user()->name }}." value="{{ old('title') }}">
                </h1>
                <div>Page ID:
                    <select class="mb-2" name="page_id">
                        <option @if(Request::is('pages/1') == 1) selected="selected" @endif value="1">White Water</option>
                        <option @if(Request::is('pages/2') == 1) selected="selected" @endif value="2">Canoe Slalom</option>
                        <option @if(Request::is('pages/3') == 1) selected="selected" @endif value="3">Canoe Polo</option>
                        <option @if(Request::is('pages/4') == 1) selected="selected" @endif value="4">Off Topic</option>
                    </select>
                </div>
            </div>
            <div class="posted-by grey border-bottom">
                <h4>by <a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->name}}</a></h4>
            </div>
        
            <div class="date_posted grey border-bottom my-2">
                <h5> Posted on {{ $post->created_at->format('jS F Y h:i:s A')}}</h5>
            </div>
        
            <div class="body">
                <textarea class="text-muted container-fluid" name="body" placeholder="Hi {{ Auth::user()->name }}, what's on your mind today?"></textarea>
            </div>
            <div class="row my-2 ml-1 container-fluid">
                <input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit">
            </div>
        </form>
    </div>

    

@endsection
