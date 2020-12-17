@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
        <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
        <p>User ID: <input type="text" name="user_id" value="{{ old('user_id') }}"></p>
        <p>Page ID:
            <select name="page_id">
                @foreach ($pages as $page)
                    <option value="{{ $page->id }}"
                        @if ($page->id == old('page_id'))
                            selected="selected"
                        @endif
                        >{{ $page->title }}
                    </option>
                @endforeach
            </select>
        </p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection