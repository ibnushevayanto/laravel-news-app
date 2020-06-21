<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>BlogPost - @yield('title')</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="{{ route('landing') }}">MyBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link {{(Illuminate\Support\Facades\Route::currentRouteName() == 'landing') ? 'active' : ''}}"
                    href="{{route('landing')}}">Home </a>
                <a class="nav-item nav-link {{(Illuminate\Support\Facades\Route::currentRouteName() == 'contact') ? 'active' : ''}}"
                    href="{{ route('contact') }}">Contact</a>
                <a class="nav-item nav-link {{ (in_array('blogpost', explode('.', Illuminate\Support\Facades\Route::currentRouteName()))) ? 'active' : '' }}"
                    href="{{ route('blogpost.index') }}">Blog</a>
            </div>
        </div>
    </nav>

    @if (session()->has('status'))
    <div class="alert alert-success mx-5 mt-3" role="alert">
        {{session()->get('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>