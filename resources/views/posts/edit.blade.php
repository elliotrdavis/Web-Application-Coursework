@extends('layouts.app')

@section('title')
    Edit Post {{ $post }}
@endsection

@section('content')
    <div class="container mb-5 bg-white border rounded shadow p-3">
        <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h1>Edit your post</h1> <!-- title -->
                <h3>Title:</h3>
                <h3>
                    <!-- Title box -->
                    <input class="container-fluid my-1" type="text" name="title" placeholder="Enter Title here {{ Auth::user()->name }}." value="{{ $post->title }}">
                </h3>
                <div class="mt-3"><h3>Page ID:</h3> <!-- Page id -->
                    <select class="mb-2" name="page_id">
                        <option @if($post->page_id === 1) selected="selected" @endif value="1">White Water</option>
                        <option @if($post->page_id === 2) selected="selected" @endif value="2">Canoe Slalom</option>
                        <option @if($post->page_id === 3) selected="selected" @endif value="3">Canoe Polo</option>
                        <option @if($post->page_id === 4) selected="selected" @endif value="4">Off Topic</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-auto">
                    @if($post->image)
					    <img width="100" src="{{asset('/img/' .$post->image)}}"/> <!-- Display images -->
                    @endif
                </div>
                <div class="col">
                    <h3>Image</h3>
                    <input type="file" class="form-control-file" name="image" id="imageFile" aria-describedby="fileHelp">
                </div>
            </div>
            <div class="body mt-3">
                <h3>Body:</h3>
                <textarea class="text container-fluid" name="body"> {{ $post->body }} </textarea>
            </div>
            <div class="row my-2 container-fluid">
                <input class="btn btn-primary active" aria-pressed="true" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection
