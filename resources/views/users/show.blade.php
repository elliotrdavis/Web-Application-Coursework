@extends('layouts.app')

@section('title')
User {{ $user->id }}
@endsection

@section('content')

<div class="container mb-5 bg-white border rounded shadow p-3">
	<div class="row mx-1 border-bottom">
		<div class="profile-image col-md-auto">
			<img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="200">
		</div>
		<div class="col">
			<div class="name">
				<h1> {{ $user->name }} </h1>
			</div>
			<div class="bio grey">
				<h5> About me: {{ $user->bio }} </h5>
            </div>
            <!-- images? -->

            <nav>
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
                                        <div class="col-md-auto profile-image ">
                                            <img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="20">
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
    
	<div class="posts">
		<h2> Posts </h2>
		@foreach($user->posts as $post)
		    <div class="d-flex flex-column col-md-8 bg-white border rounded p-3">
			    <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
				    <div class="profile-image">
					    <img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="70">
				    </div>
				    <div class="d-flex flex-column ml-3">
					    <div class="d-flex flex-row post-title">
						    <a href="{{ route('posts.show', ['post' => $post]) }}">
							    <h5>{{ $post->title }}</h5>
						    </a>
						    <span class="mx-1"> in </span>
						    <a href="{{ route('pages.show', ['page' => $post->page]) }}">{{ $post->page->title }}</a>
					    </div>
					<div class="d-flex flex-row align-items-center align-content-center post-title">
						<span>{{ $post->created_at->diffForHumans()}}</span>
					</div>
				</div>
			</div>
			<div class="body-middle bg-white p-2 px-4">
				{{ \Illuminate\Support\Str::limit($post->body, 100) }}...
			</div>
			<div class="read-more ml-auto mr-5 bg-white">
				<a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Read More</a>
			</div>
        </div>
        @endforeach
	</div>
</div>

@endsection