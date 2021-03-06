@extends('Layout.default')

@section('title', "Daftar Blog Post {$tag->name}")

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <x-data-tags :tags="$all_tags" menu :namatag="$tag->name"></x-data-tags>
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

            {{-- Container Most Active User --}}
            <x-data-card title="Most Active User" subtitle="Penulis paling aktif membagikan cerita."
                :items="collect($most_user_written_blogpost)->pluck('name')" addMarginTop></x-data-card>
            {{-- End Container Most Active User --}}

            {{-- Container Most Active User Last Month --}}
            <x-data-card title="Most Active User Last Month"
                subtitle="Penulis paling aktif membagikan cerita bulan ini."
                :items="collect($most_active_user_last_month)->pluck('name')" addMarginTop></x-data-card>
            {{-- End Container Most Active User Last Month --}}
        </div>
    </div>
</div>
@endsection