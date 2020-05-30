@extends('Layout.default')

@section('title', 'Daftar BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="display-5">Daftar Blog</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary text-white" href="{{route('blogpost.create')}}">Tambah Blog</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @forelse ($blogpost as $item)
                    <div class="col-md-6">
                    <div style="background-color: white; position: relative;" class="px-3 py-3 mr-3 mb-3">
                        <a href="{{route('blogpost.show', ['blogpost' => 1])}}">
                            <h2 class="font-weight-bold d-inline-block">{{$item->title}}</h2>
                        </a> <a href="#">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <p class="text-muted">
                            {{ $item->content }}
                        </p>
                        <button class="avatar btn btn-danger btn-sm" style="position: absolute; top: -10px; right: -10px;">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center bg-white py-3 text-muted">Data Kosong</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
