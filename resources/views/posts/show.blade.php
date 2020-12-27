@extends('layouts.app')

@section('title')
    Post {{ $post->id }}
@endsection

@section('content')
    <div class="container mb-5 bg-white border rounded shadow p-3">
    <div class="title">
        <h1>{{ $post->title }}</h1>
    </div>
    <div class="posted-by grey border-bottom">
        <h4>by <a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->name}}</a></h4>
    </div>

    <div class="date_posted grey border-bottom my-2">
        <h5> Posted on {{ $post->created_at->format('jS F Y h:i:s A')}}</h5>
    </div>


    <!-- image here -->

    <div class="body">
        {{ $post->body }}
    </div>

    <form method="POST" action="{{ route('comments.store', ['post' => $post]) }}">
        @csrf
    <div class="row container-fluid my-3">
		<div class="col-md-auto">
			<img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="40">
		</div>
		
		<div class="col my-auto container-fluid">
			<div>
                <input type="text" class="form-control mr-3" name="body" placeholder="Add comment">
                <input class="btn btn-primary active mt-2" aria-pressed="true" type="submit" value="Comment">
            </div>
        </div>
    </div>
    </form>

    <!-- comments -->
    @foreach($post->comments as $comment)
    <div class="comment-bottom d-flex flex-row align-items-center text-left comment-top p-2 px-5 bg-white border-top">
        <div class="profile-image">
            <img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="40">
        </div>
        <div class="d-flex flex-column ml-3">
            <div class="d-flex flex-row post-title">
                <a href="{{ route('users.show', ['user' => $comment->user]) }}"><h6 class="mt-auto">{{ $comment->user->name}}</h6></a>
                    <span class="ml-2">{{ $comment->created_at }}</span>
            </div>
            <div class="comment-text-sm">
                <span>{{ $comment->body }}</span>
            </div>
        </div>
    </div>		
    @endforeach
    
					

    <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    </div>

@endsection
