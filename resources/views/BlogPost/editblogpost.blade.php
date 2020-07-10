@extends('Layout.default')

@section('title', 'Ubah BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="mb-4">
                <a href="{{ route('blogpost.index') }}" style="color: #acacac;">
                    <i class="fa fa-arrow-left"></i> <span class="font-weight-bold">Back</span>
                </a>
            </div>
            <h1 class="display-5">Ubah Blog</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('blogpost.update', ['blogpost' => $blogpost->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        {{-- Menggunakan Satu Component Yang Sama --}}
                        @include('Layout._form_blog')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection