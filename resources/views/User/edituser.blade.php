@extends('Layout.default')

@section('title', "Edit Profile {$user->name}")

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Profile</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="d-flex">
                    <div>
                        <img src="{{ Storage::disk('local')->url('icons/no-image.png') }}" width="150" class="mb-3"
                            height="150" style="border-radius: 50%">

                        <div class="form-group">
                            <input type="file" class="form-control-file" name="fotoprofil">
                        </div>
                    </div>
                    <div class="form w-50 ml-4">
                        <div class="form-group">
                            <label for="nameInput">Nama</label>
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Nama"
                                value="{{ old('name', $user->name ?? NULL) }}">
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Email</label>
                            <input type="email" class="form-control" id="emailInput" name="email" placeholder="Email"
                                value="{{ old('name', $user->email ?? NULL) }}">
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

@endsection