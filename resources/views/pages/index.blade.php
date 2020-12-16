<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Kayak Forum</title>
    </head>

    <body>
        <h1>Kayak Forum</h1>
    </body>


@foreach($pages as $page)
<li><a href="{{ route('pages.show', ['page' => $page]) }}">{{ $page->title }}</a></li>
@endforeach


</html>