@extends('Layout.default')

@section('title', 'Daftar BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <x-data-tags :tags="$all_tags" large color="success"></x-data-tags>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="display-5">{{$tag->name}}</h1>
        </div>
        <div class="col-md-6 text-right">
            {{-- <a class="btn btn-primary text-white" href="{{route('blogpost.create')}}">Tambah Blog</a> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">

                {{-- Container Blogpost --}}
                <x-blogposts-list :blogpost="$tag->blogposts"></x-blogposts-list>
                {{-- End Daftar Blogpost --}}

            </div>
        </div>
        <div class="col-md-4">

            <x-data-card title="Most Commented" subtitle="Blog {{ $tag->name }} paling banyak dibicarakan."
                :items="$most_commented->blogposts" flag="blogposts"></x-data-card>
        </div>
    </div>
</div>
@endsection