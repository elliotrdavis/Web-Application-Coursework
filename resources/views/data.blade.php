
@foreach($posts as $post)

<div class="container mb-5">
    <div class="d-flex justify-content-center row">
        <div class="d-flex flex-column col-md-8 bg-white border rounded shadow p-3">
            <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                <div class="profile-image">
					<img class="rounded-circle" src="{{URL::asset('/img/user.png')}}" alt="profile avatar" width="70">
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

			<div class="body-middle bg-white p-2 px-4">
				{{ \Illuminate\Support\Str::limit($post->body, 100) }}...
				<img class="rounded-circle" src="{{asset('/img/' .$post->image)}}" width="200"/> <!-- Display images -->
				{{ $post->image }}
			</div>

			<div class="read-more ml-auto mr-5 bg-white">
				@if(Auth::id() === $post->user->id)
					<a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Edit</a>
				@endif
				<a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-primary active" role="button" aria-pressed="true">Read More</a>
			</div>				
        </div>
    </div>
</div>
@endforeach

