@extends('Layout.default')

@section('title', 'Detail BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="mb-5">
                <a href="{{ route('blogpost.index') }}" style="color: #acacac;">
                    <i class="fa fa-arrow-left"></i> <span class="font-weight-bold">Back</span>
                </a>
            </div>
            <div>
                <h1>{{ $blogpost->title }}</h1>
                <div class="content mt-4">
                    <h5 class="text-muted font-weight-bold" style="line-height: 30px">
                        {{ $blogpost->content }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection