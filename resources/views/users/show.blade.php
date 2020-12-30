@extends('layouts.app')

@section('title')
User {{ $user->id }}
@endsection

@section('content')

<div class="container mb-5 bg-white border rounded shadow p-3">
	<div class="row mx-1 border-bottom">
		<div class="profile-image col-md-auto">
            <img class="rounded-circle" src="{{asset('/img/' .$user->avatar)}}" width="200"/> <!-- show profile image -->
            <div class="row ml-2 mt-2">
            </div>
            <!-- Error message -->
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
        </div>
        
        <!-- User info -->
		<div class="col">
            <div class="row"> <!-- User name and Edit profile button -->
                <div class="col-md-auto">
                    <h1> {{ $user->name }} </h1> 
                </div>
                <div class="col-md-auto mt-2">
                    @if(Auth::id() === $user->id)
                        <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Edit Profile</a>
                    @endif
                </div>
            </div>

			<div class="bio grey"> <!-- Bio -->
				<h5> About me: {{ $user->bio }} </h5>
            </div>
            <!-- images? -->

            <nav> <!-- Details and friends list -->
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Friends ({{ $user->friends->count() }})</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-1">
                        <div class="detail-names col-md-auto">
                            <b>
                                <p>Email</p>
                                <p>User Id</p>
                                <p>Profile Created at</p>
                                <p>Number of Posts</p>
                                <p>Number of Comments</p>
                            </b>
                        </div>
                        <div class="details col-md-auto">
                            <p> {{ $user->email }} </p>
                            <p> {{ $user->id }} </p>
                            <p> {{ $user->created_at }} </p>
                            <p> {{ $user->posts->count() }} </p>
                            <p> {{ $user->comments->count() }} </p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <?php
                        $numOfCols = 3;
                        $rowCount = 0;
                        $bootstrapColWidth = 12 / $numOfCols;
                        foreach ($user->friends as $friend){
                        if($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php } 
                            $rowCount++; ?>  
                            <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                                <div class="thumbnail">
                                    <div class="row mx-1">
                                        <div class="col-md-auto profile-image">
                                            <img class="rounded-circle" src="{{asset('/img/' .$friend->avatar)}}" width="20"/>
                                        </div>
                                        <div class="col-md-auto">
                                            <a href="{{ route('users.show', ['user' => $friend]) }}">{{ $friend->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        if($rowCount % $numOfCols == 0) { ?> </div> <?php } } ?>
                    @foreach($user->friends as $friend)

                    @endforeach
                </div>
              </div>
		</div>
    </div>

	<div class="col-md-12"> <!-- list of posts -->
		<h2> Posts </h2>
		@foreach($user->posts as $post)
        <div class="d-flex flex-column col-md-8 bg-white border rounded shadow p-3 mt-2">
            <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                <div class="profile-image">
					<img class="rounded-circle" src="{{asset('/img/' .$post->user->avatar)}}" width="70"/>
				</div>
                <div class="d-flex flex-column ml-3">
                    <div class="d-flex flex-row post-title">
						<a href="{{ route('posts.show', ['post' => $post]) }}"><h5>{{ $post->title }}</h5></a>
						<span class="ml-2">
							<a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->name}}</a>
							<span><b>></b></span>
							<a href="{{ route('pages.show', ['page' => $post->page]) }}">{{ $post->page->title }}</a>
						</span>
                    </div>
                    <div class="d-flex flex-row align-items-center align-content-center post-title">
						<span>{{ $post->created_at->diffForHumans()}}</span>
					</div>
                </div>
			</div>

			<div class="image-post d-flex justify-content-center bg-white p-2 px-4">
				@if($post->image)
					<img class="img-fluid" src="{{asset('/img/' .$post->image)}}"/> <!-- Display images -->
				@endif
			</div>

			<div class="body-middle bg-white p-2 px-4">
				{{ \Illuminate\Support\Str::limit($post->body, 100) }}...
			</div>

			<div class="read-more ml-auto mr-5 bg-white">
				@if(Auth::id() === $post->user->id)
					<a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Edit</a>
				@endif
				<a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Read More</a>
			</div>				
        </div>
        @endforeach
	</div>
</div>

@endsection