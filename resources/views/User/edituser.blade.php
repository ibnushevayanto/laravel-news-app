@extends('Layout.default')

@section('title', "Edit Profile {$user->name}")

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="{{ route('user.show', ['user' => $user->id]) }}" style="color: #acacac;">
                    <i class="fa fa-arrow-left"></i> <span class="font-weight-bold">Back</span>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container mt-3 bg-white p-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Profile</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex">
                    <div>
                        @if ($user->image)
                        <img src="{{ $user->image->url() }}" width="150" class="mb-3" height="150"
                            style="border-radius: 50%">
                        @else
                        <img src="{{ Storage::disk('local')->url('icons/no-image.png') }}" width="150" class="mb-3"
                            height="150" style="border-radius: 50%">
                        @endif

                        <div class="form-group">
                            <input type="file"
                                class="form-control-file {{ $errors->has('fotoprofil') ? 'is-invalid' : '' }}"
                                name="fotoprofil">
                            @if ($errors->has('fotoprofil'))
                            <div class="invalid-feedback">{{ $errors->first('fotoprofil') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form w-50 ml-4">
                        <div class="form-group">
                            <label for="nameInput">Nama</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="nameInput" name="name" placeholder="Nama"
                                value="{{ old('name', $user->name ?? NULL) }}">

                            @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Email</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                id="emailInput" name="email" placeholder="Email"
                                value="{{ old('email', $user->email ?? NULL) }}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
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