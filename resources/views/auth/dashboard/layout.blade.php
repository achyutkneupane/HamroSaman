@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.landing-sidebar')
        </div>
        <div class="col-md-9">
            @yield('dashboardContent')
        </div>
    </div>
</div>
@endsection