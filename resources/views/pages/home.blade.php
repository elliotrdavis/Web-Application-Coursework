@extends('layouts.app')

@section('title', 'Home')
@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="container">

	<!-- Title -->

	<h2 class="text-center"> 
		@if(Request::is('pages/1'))
			White Water Posts
		@elseif(Request::is('pages/2'))
			Canoe Slalom Posts
		@elseif(Request::is('pages/3'))
			Canoe Polo Posts
		@elseif(Request::is('pages/4'))
			Off Topic Posts
		@else
			All Posts
		@endif
	</h2>

	<p class="text-center">
		@if(Request::is('pages/1'))
			Welcome to the white water page, feel free to post anything whitewater related!
		@elseif(Request::is('pages/2'))
			Welcome to the canoe slalom page, feel free to post anything slalom related!
		@elseif(Request::is('pages/3'))
			Welcome to the canoe polo page, feel free to post anything polo related!
		@elseif(Request::is('pages/4'))
			Welcome to the off topic page, feel free to post anything on your mind!
		@else
			Welcome to my blog about kayaking.
		@endif
	</p>

	<!-- Not logged in --> 
	@guest
	<div class="container mb-5 col-md-7 bg-white border rounded shadow p-1">
		<div class="row my-2 ml-1 container-fluid border-bottom">
			<h5>Please login to post</h5>
		</div>
	</div>

	<!-- If logged in -->

	@else

	<!-- Create post container -->

	<div class="container mb-5 col-md-7 bg-white border rounded shadow p-1">
		<div class="row my-2 ml-1 container-fluid border-bottom">
			<h3>Create Post</h3> <!-- Create post -->
		</div>
		<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row container-fluid border-bottom">
				<div class="col-md-auto">
					<img class="rounded-circle" src="{{asset('/img/' .Auth::user()->avatar)}}" width="70"/> <!-- Profile picture -->
				</div>
				
				<div class="col my-auto container-fluid">
					<div>
						<input class="container-fluid my-2" type="text" name="title" placeholder="Title" value="{{ old('title') }}"> <!-- Title form -->
					</div>
					<div>Page ID: <!-- Page id form -->
						<select class="mb-2" name="page_id">
							<option @if(Request::is('pages/1')) selected="selected" @endif value="1">White Water</option>
							<option @if(Request::is('pages/2')) selected="selected" @endif value="2">Canoe Slalom</option>
							<option @if(Request::is('pages/3')) selected="selected" @endif value="3">Canoe Polo</option>
							<option @if(Request::is('pages/4')) selected="selected" @endif value="4">Off Topic</option>
						</select>
					</div>
				</div>
			</div>
			<!-- Body -->
			<div class="row my-2 ml-1 container-fluid">
				<textarea class="text container-fluid" name="body" placeholder="Hi {{ Auth::user()->name }}, what's on your mind today?"></textarea> <!-- body -->
			</div>
			<!-- Image upload -->
			<div class="row my-2 ml-1 container-fluid border-bottom">
				<strong>Choose image</strong>
				<input type="file" class="form-control-file" name="image" id="imageFile" aria-describedby="fileHelp">
			</div>
			<!-- Submit button -->
			<div class="row my-2 ml-1 container-fluid">
				<input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit"> <!-- Submit button -->
			</div>
		</form>
		<!-- Error messages -->
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

	@endguest

	<!-- Load posts -->

	<br/>
	<div class="col-md-12" id="post-data">
		@include('data')
	</div>
</div>

	<!-- Infinite scroll -->

<div class="ajax-load text-center" style="display:none">
	<p>Loading More post</p>
</div>


<script type="text/javascript">
	var page = 1;
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()-1) {
	        page++;
	        loadMoreData(page);
	    }
	});

	function loadMoreData(page){
	  $.ajax(
	        {
	            url: '?page=' + page,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
	            if(data.html == " "){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();
	            $("#post-data").append(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
	        });
	}
</script>

@endsection


