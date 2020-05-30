@extends('Layout.default')

@section('title', 'Detail BlogPost')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <h1>{{ $blogpost->title }}</h1>
                <div class="content mt-4">
                    <h5 class="text-muted font-weight-bold" style="line-height: 30px">
                    {{ $blogpost->content }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection