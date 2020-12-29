@extends('layouts.app')

@section('title')
    Edit User {{ $user }}
@endsection

@section('content')
    <div class="container mb-5 bg-white border rounded shadow p-3">
        <form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data">
            @csrf
            <div>
                Name
                <input class="container-fluid my-1" type="text" name="name" value="{{ $user->name }}">
            </div>
            <div>
                Email
                <input class="container-fluid my-1" type="text" name="email" value="{{ $user->email }}">
            </div>
            <div>
                Bio
                <input class="container-fluid my-1" type="text" name="bio" value="{{ $user->bio }}">
            </div>

            <div>
                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
            </div>

            <div>
                <input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit">
            </div>
    
        
        </form>
    </div>
@endsection