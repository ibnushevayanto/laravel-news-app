@extends('Layout.default')

@section('title', $blogpost->title)

@section('content')
<div class="container mt-4">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="mb-5">
                <a href="{{ route('blogpost.index') }}" style="color: #acacac;">
                    <i class="fa fa-arrow-left"></i> <span class="font-weight-bold">Back</span>
                </a>
            </div>
            {{-- Container Info Blogpost --}}
            <x-blogpost :blogpost="$blogpost" :watched="$watched"></x-blogpost>
            {{-- End Container Info Blogpost --}}
        </div>
    </div>
    <div class="row justify-content-md-center mt-5 mb-3">
        <div class="col-md-8">
            {{-- Container Komentar BlogPost --}}
            <x-komentar-blogpost :blogpost="$blogpost"></x-komentar-blogpost>
            {{-- End Container Komentar BlogPost --}}
        </div>
    </div>
</div>
@endsection