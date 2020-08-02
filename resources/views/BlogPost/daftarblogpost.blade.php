@extends('Layout.default')

@section('title', 'Daftar BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="display-5">Daftar Blog</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary text-white" href="{{route('blogpost.create')}}"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">

                {{-- Container Blogpost --}}
                <x-blogposts-list :blogpost="$blogpost"></x-blogposts-list>
                {{-- End Daftar Blogpost --}}

            </div>
        </div>
        <div class="col-md-4">

            {{-- Container Most Commented --}}
            <x-data-card title="Most Commented" subtitle="Blog paling banyak dibicarakan." :items="$most_commented"
                flag="blogposts"></x-data-card>
            {{-- End Container Most Commented --}}

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