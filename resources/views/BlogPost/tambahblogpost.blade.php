@extends('Layout.default')

@section('title', 'Tambah BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4 justify-content-md-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('blogpost.index') }}" style="color: #acacac;">
                    <i class="fa fa-arrow-left"></i> <span class="font-weight-bold">Back</span>
                </a>
            </div>
            <h1 class="display-5">Tambah Blog</h1>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">

                    <form action="{{ route('blogpost.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('Layout._form_blog')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection