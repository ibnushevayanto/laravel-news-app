@extends('Layout.default')

@section('title', 'Ubah BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
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
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" class="form-control" id="titleInput" value="{{ $blogpost->title }}"
                                name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="contentInput">Content</label>
                            <textarea class="form-control" id="contentInput" rows="3" name="content"
                                placeholder="Content">{{ $blogpost->content }}</textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection