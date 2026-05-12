@extends('layouts.auth-master')
@section('title','Login')
@section('content')
<style>
    /*
    .authincation {
        background: #fff;
    }

    .authincation-content {
        box-shadow: 0 0 2.1875rem 0 rgb(0 0 133 / 27%);
    }

    .btn-primary {
        border-color: #000085;
        background-color: #000085;
    }

    .btn-primary:active,
    .btn-primary:focus,
    .btn-primary:hover {
        border-color: #000035;
        background-color: #000035;
    }
        */
</style>
<div class="card mb-0 h-auto">
    <div class="card-body">
        <div class="text-center mb-3">
            <a href="{{ url('/') }}"><img class="logo-auth" src="{{ asset('assets/images/logos/dw.png') }}" alt="Digiworks"></a>
        </div>
        <h4 class="text-center mb-4">Sign in your account</h4>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form  method="POST" action="{{ route('login_check') }}" autocomplete="off">
            @csrf
            <div class="form-group mb-4">
                <label class="form-label" for="username">{{ __('Username') }}</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username" placeholder="Enter username" id="username">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-sm-4 mb-3 position-relative">
                <label class="form-label" for="dlab-password">Password</label>
                <input type="password" id="dlab-password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
                <span class="show-pass eye">
                    <i class="fa fa-eye-slash"></i>
                    <i class="fa fa-eye"></i>
                </span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-row d-flex flex-wrap justify-content-between mb-2">
                <div class="form-group mb-sm-4 mb-1">
                    <div class="form-check custom-checkbox ms-1">
                        <input type="checkbox" class="form-check-input" name="remember" id="basic_checkbox_1" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                    </div>
                </div>
                <!-- <div class="form-group ms-2">
                    <a class="text-hover" href="page-forgot-password.html">Forgot Password?</a>
                </div> -->
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
        </form>
        <!-- div class="new-account mt-3">
            <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>
        </div> -->
    </div>
</div>



@endsection