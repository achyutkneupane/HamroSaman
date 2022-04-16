@extends('layouts.app')
@section('pageTitle', 'Products')

@section('content')
    <div class="container my-5">
        <div class="row d-flex flex-column gap-4 justify-content-center">
            <div class="col-md-12 text-center display-5 text-uppercase">
                Products
            </div>
            <div class="d-flex justify-content-center">
                {!! $products->links() !!}
            </div>
            <div class="row">
                <div class="col-md-3">
                    <form method="POST" action="{{ route('products.search') }}" class="card p-3 bg-white d-flex flex-column gap-2 sticky-top mt-3" style="top: 100px;">
                        @csrf
                        <div class="h3">
                            Search
                        </div>
                        <div class="form-group">
                            <label for="search_term">Search Term</label>
                            <input type="name" class="form-control" id="search_term" name="search_term" placeholder="Enter search term" value="{{ request()->input('search_term') }}">
                            @error('search_term')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="search_category">Category</label>
                            <select class="form-select" name="search_category" aria-label="Select Category">
                                <option selected disabled>Select category</option>
                                @foreach ($categories as $category)
                                    <option @if($category->id == request()->input('search_category'))selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('search_category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="min_price">Min. Price</label>
                            <input type="name" class="form-control" id="min_price" name="min_price" placeholder="Enter Minimum Price" value="{{ request()->input('min_price') }}">
                            @error('min_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_price">Max Price</label>
                            <input type="name" class="form-control" id="max_price" name="max_price" placeholder="Enter Maximum Price" value="{{ request()->input('max_price') }}">
                            @error('max_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-4 my-3">
                                <div class="d-flex justify-content-center">
                                    <div class="card p-3 bg-white">
                                        <h6 class="mt-0 text-danger text-center">
                                            Category: <span class="fw-bolder">{{ $product->category->name }}</span>
                                        </h6>
                                        <div class="about-product text-center mt-2">
                                            <img src="{{ $product->image ? asset(Storage::url($product->image)) : 'https://www.aaronfaber.com/wp-content/uploads/2017/03/product-placeholder-wp.jpg' }}" class="w-100">
                                            <div class='mt-3'>
                                                <h5 class='text-danger'>Rs. {{ $product->min_price }}</h5>
                                                <a href="{{ route('products.show',$product->slug) }}">
                                                    <h4 class="text-primary">{{ $product->name }}</h4>
                                                </a>
                                                @if($product->user == auth()->user())
                                                <span class='text-danger'>[Your Product]</span>
                                                @endif
                                                <h6 class="mt-0 d-flex justify-content-between">
                                                    <span class='text-black-50'>
                                                        Uploaded by:
                                                    </span>
                                                    <span>
                                                        {{ $product->user->full_name }}
                                                    </span>
                                                </h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-md-12 my-3">
                            <div class="d-flex justify-content-center alert alert-danger">
                                No Products with given criteria
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
