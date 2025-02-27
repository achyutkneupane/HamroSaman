@extends('layouts.app')
@section('pageTitle', 'Welcome')

@section('content')
    <div class="container-fluid mt-0 py-5" style="background-image: url('https://wallpaperaccess.com/full/334519.jpg'); background-size: cover">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 text-center d-flex align-items-center" style="height: 720px;">
                    <img src="https://www.downloadclipart.net/large/home-appliance-png-image.png"
                        alt="{{ config('app.name') }}" class='w-100'>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center gap-0 text-white">
                    <h1 class='display-2'>
                        {{ config('app.name') }}
                    </h1>
                    <div class="h3">
                        Buy and sell used home appliances.
                    </div>
                    @auth
                        <a class="btn btn-primary w-75" href="{{ route('products.index') }}">View All Products</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @auth
    <div class="container mt-0 py-5">
        <div class="row d-flex flex-column gap-4 justify-content-center">
            <div class="col-md-12 text-center display-5 text-uppercase">
                Products
            </div>
            <div class="container">
                <div class="row">
                    @forelse ($products as $product)
                    <div class="col-md-12 my-3 bg-white">
                        <div class="d-flex justify-content-center p-2">
                            <div class="w-100 p-3">
                                <div class="about-product text-center row align-items-center justify-content-between mt-2">
                                    <div class="col-md-4">
                                        <img
                                        src="{{ $product->image ? asset(Storage::url($product->image)) : 'https://www.aaronfaber.com/wp-content/uploads/2017/03/product-placeholder-wp.jpg' }}"
                                        class=""
                                        width="300">
                                    </div>
                                    <div class='col-md-8'>
                                        <div class="mt-3 d-flex flex-column gap-1">
                                            <h5 class="mt-2 d-flex justify-content-between">
                                                <span class="h2">{{ $product->name }}</span>
                                                <div>
                                                    <h3 class='text-danger'>Rs. {{ $product->auction->highest_bid ? $product->auction->highest_bid->amount : $product->min_price }}</h3>
                                                </div>
                                            </h5>
                                            <h5 class="mt-2 d-flex justify-content-between">
                                                <span class='text-black-50'>
                                                    Category:
                                                </span>
                                                <div>
                                                    {{ $product->category->name }}
                                                </div>
                                            </h5>
                                            <h5 class="mt-2 d-flex justify-content-between">
                                                <span class='text-black-50'>
                                                    Uploaded by:
                                                </span>
                                                <div>
                                                    {{ $product->user->full_name }}
                                                </div>
                                            </h5>
                                            <a href="{{ route('products.show',$product->slug) }}">
                                                <h4 class="w-100 btn btn-primary">Goto Product</h4>
                                            </a>
                                            @if($product->user == auth()->user())
                                            <span class='text-danger'>[Your Product]</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="d-flex flex-column justify-content-end">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
    @endauth
@endsection
