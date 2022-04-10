@extends('layouts.app')
@section('pageTitle', __('Dashboard'))

@section('content')
    <div class="card">
        <div class="card-header">@yield('pageTitle')</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
    </div>
@endsection
