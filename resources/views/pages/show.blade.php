<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Kayak Forum - {{ $page->id }}</title>
    </head>

    <body>
        <h1>Kayak Forum: Page - {{ $page->id }}</h1>

        <div>
            Title: {{ $page->title }}
        </div>
        <div>
            Description: {{ $page->description }}
        </div>
    </body>

    <p>Posts:</p>
    Total posts for this page: {{ $page->posts->count() }}
    @foreach($page->posts as $post)
        <li>{{ $post->title }}</li>
    @endforeach

</html>
