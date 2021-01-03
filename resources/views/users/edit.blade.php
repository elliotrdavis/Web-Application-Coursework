@extends('layouts.app')

@section('title')
    Edit User {{ $user }}
@endsection

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
                Phone Number
                <input class="container-fluid my-1" type="number" name="number" value="{{ $user->phone->number }}">
            </div>

            <div class="row container-fluid my-2">
                <!--<input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">-->
                <div class="row">
                    <div class="col-md-auto">
                        @if($user->avatar)
                            <img class="rounded-circle" width="50" src="{{asset('/img/' .$user->avatar)}}"/> <!-- Display images -->
                        @endif
                    </div>
                    <div class="col">
                        Avatar
                        <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp" value="{{ $user->avatar }}">
                    </div>
                </div>
            </div>

            <div>
                <input class="btn btn-primary active my-1" aria-pressed="true" type="submit" value="Submit">
            </div>
    
        
        </form>
    </div>
@endsection