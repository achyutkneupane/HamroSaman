@extends('layouts.app')
@section('pageTitle', 'Register')

@section('content')
    <div class="container-fluid mt-0 py-5 vh-100"
        style="background-image: url('https://wallpaperaccess.com/full/334519.jpg'); background-size: cover">
        <div class="container h-75 d-md-block justify-content-center d-flex mt-4">
            <div
                class="row justify-content-center align-items-center text-white d-flex flex-column-reverse flex-md-row-reverse">
                <div class="col-md-6 text-center d-md-flex d-none align-items-center" style="height: 720px;">
                    <img src="https://www.pngall.com/wp-content/uploads/11/Wooden-Furniture-Chair-PNG-Photo.png" alt="{{ config('app.name') }}"
                        class='w-100'>
                </div>
                <div class="col-md-6">
                    <h4 class='display-5 offset-md-4'>
                        Register
                    </h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text"
                                    class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                    value="{{ old('full_name') }}" required autocomplete="name" autofocus>

                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
