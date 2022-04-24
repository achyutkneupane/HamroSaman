@extends('layouts.app')
@section('pageTitle', 'Login')

@section('content')
    <div class="container-fluid mt-0 py-5 vh-100" style="background-image: url('https://wallpaperaccess.com/full/334519.jpg'); background-size: cover">
        <div class="container h-75 d-md-block justify-content-center d-flex mt-4">
            <div class="row justify-content-center align-items-center text-white d-flex flex-column-reverse flex-md-row-reverse">
                <div class="col-md-6">
                    <h4 class='display-5 offset-md-4'>
                        Login
                    </h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                    
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="mb-2">
                                    @if (Route::has('password.request'))
                                    <a class="text-white" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-center d-md-flex d-none align-items-center" style="height: 720px;">
                    <img src="https://www.pngall.com/wp-content/uploads/8/Home-Kitchen-Appliances-PNG-Free-Download.png"
                        alt="{{ config('app.name') }}" class='w-100'>
                </div>
            </div>
        </div>
    </div>
@endsection