@extends('layouts.app')
@section('pageTitle', 'Welcome')

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
                @auth
                    <a class="btn btn-primary" href="{{ route('products.index') }}">View All Products</a>
                @else
                    <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
                @endauth
            </div>
            <div class="col-md-6 text-center">
                <img src="https://static.vecteezy.com/system/resources/previews/001/834/050/large_2x/business-online-ecommerce-with-man-using-laptop-and-shopping-bag-free-vector.jpg"
                    alt="{{ config('app.name') }}" class='w-100'>
            </div>
        </div>
        <div class="row d-flex flex-column gap-4 justify-content-center">
            <div class="col-md-12 text-center display-5 text-uppercase">
                Products
            </div>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="d-flex justify-content-center container mt-5">
                            <div class="card p-3 bg-white">
                                <h6 class="mt-0 text-danger text-center">
                                    Category: <span class="fw-bolder">{{ $product->category->name }}</span>
                                </h6>
                                <div class="about-product text-center mt-2"><img
                                        src="{{ $product->image ? '' : 'https://www.aaronfaber.com/wp-content/uploads/2017/03/product-placeholder-wp.jpg' }}"
                                        width="300">
                                    <div class='mt-3'>
                                        <h5 class='text-danger'>Rs. {{ $product->min_price }}</h5>
                                        <a href="{{ route('products.show',$product->slug) }}">
                                            <h4 class="text-primary">{{ $product->name }}</h4>
                                        </a>
                                        <h6 class="mt-0 d-flex justify-content-between">
                                            <span class='text-black-50'>
                                                Uploaded by:
                                            </span>
                                            <span>
                                                {{ $product->user->full_name }}
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="ratings">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="addFavourite">
                                            <i class="fa fa-heart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="d-flex justify-content-center">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
