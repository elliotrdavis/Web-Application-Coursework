<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') | Kayak Forum</title>
    </head>

    <body>
        <h1>@yield('title') | Kayak Forum</h1>

        @if($errors ->any())
            <div>
                Errors: 
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('message'))
            <p><b>{{ session('message') }}</b></p>
        @endif

        <div>
            @yield('content')
        </div>
    </body>
</html>
