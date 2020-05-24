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
                <div class="col-md-6">
                    <div style="background-color: white" class="px-3 py-3 mr-3 mb-3">
                        <a href="{{route('blogpost.show', ['blogpost' => 1])}}">
                            <h2 class="font-weight-bold">Hello</h2>
                        </a>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam saepe libero quo soluta
                            ipsa! Itaque, odit tempora. Voluptates possimus ipsa doloremque illo repellendus
                            perspiciatis enim a, amet, et ea repudiandae!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
