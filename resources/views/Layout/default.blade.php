<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>BlogPost - @yield('title')</title>
</head>

<body>

    <ul>
    <li><a href="{{ route('landing') }}">Home</a></li>
    <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>

    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
