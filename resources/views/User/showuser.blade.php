@extends('Layout.default')

@section('title', $user->name)

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12 text-right bg-white pt-3">
            @can('update', $user)
            <div class="d-flex justify-content-between">
                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-primary"><i
                        class="fa fa-edit"></i>
                    Edit</a>
                <a href="#" class="btn btn-danger" onclick="logout('{{route('login')}}')"><i
                        class="fa fa-power-off"></i>
                    Logout</a>
            </div>

            <form action="{{ route('logout') }}" method="POST" id="logout-proccess" style="display: none;">
                @csrf
            </form>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col md-12 text-center bg-white pb-3">
            @if ($user->image)
            <img src="{{ $user->image->url() }}" width="150" class="mb-3" height="150" style="border-radius: 50%">
            @else
            <img src="{{ Storage::disk('local')->url('icons/no-image.png') }}" width="150" class="mb-3" height="150"
                style="border-radius: 50%">
            @endif
            <h1>{{ $user->name}}</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-8">
            <h2>Blog</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8">
            <div class="row">
                <x-blogposts-list :blogpost="$blogpost"></x-blogposts-list>
            </div>
        </div>
    </div>
</div>
@endsection