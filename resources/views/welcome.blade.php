@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1 class='display-2'>
                    {{ config('app.name') }}
                </h1>
                <div class="h3">
                    Buy and sell used home appliances.
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://static.vecteezy.com/system/resources/previews/001/834/050/large_2x/business-online-ecommerce-with-man-using-laptop-and-shopping-bag-free-vector.jpg" alt="{{ config('app.name') }}" class='w-100'>
            </div>
        </div>
    </div>
@endsection
