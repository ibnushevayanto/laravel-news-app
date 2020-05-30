@extends('Layout.default')

@section('title', 'Tambah BlogPost')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="display-5">Tambah Blog</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <form action="#">
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" class="form-control" id="titleInput" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="contentInput">Content</label>
                            <textarea class="form-control" id="contentInput" rows="3"></textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
