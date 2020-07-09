@extends('Layout.default')

@section('title', 'Register Account')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-md-center">
        <div class="col-md-7">
            <div class="bg-white p-3">
                <h3 class="text-center">Login</h3>
                @if ($errors->has('email'))
                @if ($errors->first('email') == 'These credentials do not match our records.')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username atau password anda salah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @endif
                <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="email"
                            class="form-control {{ $errors->has('email') ? ($errors->first('email') == 'These credentials do not match our records.') ? '' : 'is-invalid' : '' }}"
                            placeholder="Enter your email">
                        @if ($errors->has('email'))
                        @if ($errors->first('email') != 'These credentials do not match our records.')
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Enter your password">
                        @if ($errors->has('password'))
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember"> Remember Me
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-end"> --}}
                    <button class="btn btn-block btn-outline-primary my-3">Login</button>
                    {{-- </div> --}}
                    <div class="text-center">Belum punya akun? Silahkan register <a
                            href="{{ route('register') }}">disini</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection