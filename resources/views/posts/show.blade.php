@extends('layouts.app')

@section('title')
    Post {{ $post->id }}
@endsection

@section('content')

<!-- Error messages -->
<div class="row justify-content-center">
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<div class="container mb-5 bg-white border rounded shadow p-3">

    <div class="title">
        <h1>{{ $post->title }}</h1>
    </div>
    <div class="posted-by grey border-bottom">
        <h4>by <a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->name}}</a></h4>
    </div>

    <div class="row date_posted grey border-bottom my-2">
        <div class="col-md-auto my-auto">
            <h5> Posted on {{ $post->created_at->format('jS F Y h:i:s A')}}</h5>
        </div>
        @if(Auth::id() === $post->user->id)
        <div class="col-md-auto my-2">
            <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Edit</a>
        </div>
        <div class="col-md-auto my-2">
            <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary active" role="button" aria-pressed="true">Delete</button>
            </form>
        </div>
        @endif
    </div>

    <div class="image-post d-flex justify-content-center bg-white p-2 px-4">
        @if($post->image)
            <img class="img-fluid" src="{{asset('/img/' .$post->image)}}"/> <!-- Display images -->
        @endif
    </div>

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
                <a href="{{ route('users.show', ['user' => $comment->user]) }}"><h6 class="mt-2">{{ $comment->user->name }}</h6></a>
                    <span class="ml-2 mt-1">{{ $comment->created_at->diffForHumans()}}</span>
                @if(Auth::id() === $comment->user->id)
                
                    <a href="{{ route('comments.edit', ['comment' => $comment]) }}" class="btn btn-link btn-sm">Edit</a>
            
                    <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-sm">Delete</button>
                    </form>
                @endif
            </div>
            
            <div class="comment-text-sm">
                <span>{{ $comment->body }}</span>
            </div>
        </div>
    </div>		
    @endforeach
</div>

@endsection
