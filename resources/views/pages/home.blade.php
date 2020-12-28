@extends('layouts.app')

@section('title', 'Home')
@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="container">
	<h2 class="text-center">All Posts</h2>
	@guest
<div class="container mb-5 col-md-7 bg-white border rounded shadow p-1">
	<div class="row my-2 ml-1 container-fluid border-bottom">
		<h5>Please login to post</h5>
	</div>
</div>
@else

<div class="container mb-5 col-md-7 bg-white border rounded shadow p-1">
	<div class="row my-2 ml-1 container-fluid border-bottom">
		<h3>Create Post</h3>
	</div>
	<form method="POST" action="{{ route('posts.store') }}">
		@csrf
	<div class="row container-fluid border-bottom">
		<div class="col-md-auto">
			<img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="70">
		</div>
		
		<div class="col my-auto container-fluid">
			<div>
				<input class="container-fluid my-1" type="text" name="title" placeholder="Enter Title here {{ Auth::user()->name }}." value="{{ old('title') }}">
			</div>
			<div>Page ID:
				<select class="mb-2" name="page_id">
					<option @if(Request::is('pages/1') == 1) selected="selected" @endif value="1">White Water</option>
					<option @if(Request::is('pages/2') == 1) selected="selected" @endif value="2">Canoe Slalom</option>
					<option @if(Request::is('pages/3') == 1) selected="selected" @endif value="3">Canoe Polo</option>
					<option @if(Request::is('pages/4') == 1) selected="selected" @endif value="4">Off Topic</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row my-2 ml-1 container-fluid">
		<textarea class="text-muted container-fluid" name="body" placeholder="Hi {{ Auth::user()->name }}, what's on your mind today?"></textarea>
	</div>
	<div class="row my-2 ml-1 container-fluid">
		<input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit">
	</div>
</form>
</div>
@endguest
	<br/>
	<div class="col-md-12" id="post-data">
		@include('data')
	</div>
</div>



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


