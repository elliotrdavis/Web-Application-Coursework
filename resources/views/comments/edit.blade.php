@extends('layouts.app')

@section('title')
    Edit Comment
@endsection

@section('content')
<div>
    <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}">
        @csrf
        <textarea class="text-muted container-fluid" name="body" placeholder="Hi {{ Auth::user()->name }}, what's on your mind today?"></textarea>
        <input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit">
    </form>

    {{ $comment->post->id }}

    @if($errors->any())
    <div>
        Errors
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</div>

@endsection