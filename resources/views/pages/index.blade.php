@extends('layouts.welcome')

@section('title')
    Pages
@endsection

@section('content')
    <p> List of Pages </p>
    <ul>
        @foreach($pages as $page)
            <li> {{ $page->title }} </li>
        @endforeach
    </ul>

@endsection