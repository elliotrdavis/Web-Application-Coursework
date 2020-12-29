@extends('layouts.app')

@section('title')
    Edit Comment
@endsection

@section('content')
<div class="mx-4">
    <h3>Edit your comment:</h3>
    <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}">
        @csrf
        <textarea class="text-muted container-fluid mr-10" name="body">{{ $comment->body }}</textarea>
        <input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit">
    </form>

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