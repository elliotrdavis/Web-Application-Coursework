@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @foreach($pages as $page)
        <li><a href="{{ route('pages.show', ['page' => $page]) }}">{{ $page->title }}</a></li>
    @endforeach
@endsection
