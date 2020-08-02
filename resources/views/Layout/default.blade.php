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
    <title>Blogpost - @yield('title')</title>
    <script src="{{ asset('js/app.js') }}" async></script>
    <script src="{{asset('js/script.js')}}" async></script>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        {{-- Nama Aplikasi --}}
        <a class="navbar-brand" href="{{ route('landing') }}">MyBlog</a>
        {{-- End Of Nama Aplikasi --}}

        {{-- Toggle Responsive Navbar --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- End Of Toggle Responsive Navbar --}}

        {{-- Bootstrap Link --}}
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            {{-- Class ml-auto digunakan untuk membuat link berada dikanan --}}
            <div class="navbar-nav ml-auto">
                {{-- Link Home --}}
                <a class="nav-item nav-link {{(Route::currentRouteName() == 'landing') ? 'active' : ''}}"
                    href="{{route('landing')}}">Home </a>

                {{-- Link Contact --}}
                <a class="nav-item nav-link {{(Route::currentRouteName() == 'contact') ? 'active' : ''}}"
                    href="{{ route('contact') }}">Contact</a>

                @php
                /* Mendeteksi jika route name masih menjadi child dari blogpost atau tidak */
                $isLinkMengandungBlogpost = in_array('blogpost', explode('.', Route::currentRouteName()));
                @endphp

                {{-- Link BlogPost --}}
                <a class="nav-item nav-link {{ ($isLinkMengandungBlogpost) ? 'active' : '' }}"
                    href="{{ route('blogpost.index') }}">Blog</a>

                {{-- @guest adalah conditional jika belum login --}}
                @guest
                {{-- Link Login --}}
                <a class="nav-item nav-link {{(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register') ? 'active' : ''}}"
                    href="{{route('login')}}">Login</a>

                @else

                {{-- Logout --}}
                <a href="{{ route('user.show', ['user' => Auth::id()]) }}" class="nav-item nav-link">Profile</a>
                @endguest
            </div>
        </div>
        {{-- End Of Bootstrap Link --}}
    </nav>
    {{-- End Of Navbar --}}

    {{-- Jika Session Memiliki Session status Maka Akan Muncul Alert --}}
    @if (session()->has('status'))
    <div class="alert alert-success mx-5 mt-3" role="alert">

        {{-- Mendapatkan Value Dari Session status --}}
        {{ session()->get('status') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- @yield digunakan untuk mendapatkan section dari setial template --}}
    @yield('content')
</body>

</html>