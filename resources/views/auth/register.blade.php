@extends('Layout.default')

@section('title', 'Register Account')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-md-center">
        <div class="col-md-7">
            <div class="bg-white p-3">
                <h3 class="text-center">Registering Your Account</h3>
                <form method="POST" action="{{ route('register') }}" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            placeholder="Enter your name">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="Enter your email">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="password" name="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="Enter your password">
                            </div>
                            <div class="col-md-6">
                                {{-- Jika Ingin Membuat Validasi Password Gunakan Kata Kata confirmation diakhir dari nama field yang ingin diberi konfirmasi --}}
                                <input type="password" name="password_confirmation"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="Confirm password">
                            </div>
                        </div>
                        @if ($errors->has('password'))
                        <div>
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        @endif
                    </div>

                    <button class="btn btn-block btn-outline-primary my-3">Register</button>

                    <div class="text-center">Sudah punya akun? Silahkan login <a href="{{ route('login') }}">disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection