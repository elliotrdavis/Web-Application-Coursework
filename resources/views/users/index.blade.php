@extends('layouts.app')

@section('title', 'Users')

@section('content')
    @foreach($users as $user)
        <li><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></li>
    @endforeach
@endsection