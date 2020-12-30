@extends('layouts.app')

@section('title', 'Admin page')

@section('content')

    <!-- Error/success messages -->
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

    <div>List of admins:
    @foreach($users as $user)
        @if($user->role->name === "admin")
            <li><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></li>
        @endif
    @endforeach
    </div>

    <div>List of moderators:
    @foreach($users as $user)
        @if($user->role->name === "moderator")
            <form method="POST" action="{{ route('admin.update', ['user' => $user]) }}">
                @csrf
                <div class="row border">
                    <div class="col-md-auto mt-2">
                        <li><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></li>
                    </div>
                    <div class="col-md-auto mt-2"> <!-- Role form -->
                        <select class="mb-2" name="role_id">
                            <option value="1">Reader</option>
                            <option selected="selected" value="2">Moderator</option>
                        </select>
                    </div>
                    <!-- Submit button -->
                    <div class="col-md-auto">
                        <input class="btn btn-link" type="submit" value="Submit"> <!-- Submit button -->
                    </div>
                </div>
            </form>
        @endif
    @endforeach
    </div>

    <div>List of users:
    @foreach($users as $user)
    @if($user->role->name === "reader")
        <form method="POST" action="{{ route('admin.update', ['user' => $user]) }}">
            @csrf
            <div class="row border">
                <div class="col-md-auto mt-2">
                    <li><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></li>
                </div>
                <div class="col-md-auto mt-2"> <!-- Role form -->
                    <select class="mb-2" name="role_id">
                        <option selected="selected" value="1">Reader</option>
                        <option value="2">Moderator</option>
                    </select>
                </div>
                <!-- Submit button -->
                <div class="col-md-auto">
                    <input class="btn btn-link" type="submit" value="Submit"> <!-- Submit button -->
                </div>
            </div>
        </form>
    @endif
    @endforeach
    </div>

    <div>List of posts:
    @foreach($posts as $post)
        <li><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
    @endforeach
    </div>

@endsection