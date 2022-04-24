@extends('layouts.app')
@section('pageTitle', 'Products')

@section('content')
    <div class="container my-5">
        <form method="POST" action="{{ route('products.search') }}" class="row d-flex flex-column gap-4 justify-content-center">
            @csrf
            <div class="col-md-12 text-center display-5 text-uppercase">
                Products
            </div>
            <div class="d-flex flex-column justify-content-center">
                {!! $products->appends($searchData)->links() !!}
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card p-3 bg-white d-flex flex-column gap-2 sticky-top mt-3" style="top: 100px;">
                        <div class="h3">
                            Search
                        </div>
                        <div class="form-group">
                            <label for="sort_by">Sort By</label>
                            <select class="form-select" name="sort_by" aria-label="Sort By">
                                <option selected disabled>Select sorting option</option>
                                <option value="price_desc" @if("price_desc" == $sortTerm)selected @endif>Price High To Low</option>
                                <option value="price_asc" @if("price_asc" == $sortTerm)selected @endif>Price Low To High</option>
                                <option value="alpha_asc" @if("alpha_asc" == $sortTerm)selected @endif>Alphabetically A-Z</option>
                                <option value="alpha_desc" @if("alpha_desc" == $sortTerm)selected @endif>Alphabetically Z-A</option>
                            </select>
                            @error('sort_by')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="search_term">Search Term</label>
                            <input type="name" class="form-control" id="search_term" name="search_term" placeholder="Enter search term" value="{{ $searchTerm }}">
                            @error('search_term')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="search_category">Category</label>
                            <select class="form-select" name="search_category" aria-label="Select Category">
                                <option selected disabled>Select category</option>
                                @foreach ($categories as $category)
                                    <option @if($category->id == $searchCategory)selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('search_category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="min_price">Min. Price</label>
                            <input type="name" class="form-control" id="min_price" name="min_price" placeholder="Enter Minimum Price" value="{{ $minPrice }}">
                            @error('min_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_price">Max Price</label>
                            <input type="name" class="form-control" id="max_price" name="max_price" placeholder="Enter Maximum Price" value="{{ $maxPrice }}">
                            @error('max_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-4 my-3 bg-white">
                                <div class="d-flex justify-content-center py-2">
                                    <div>
                                        <div class="about-product text-center mt-2">
                                            <img
                                                src="{{ $product->image ? asset(Storage::url($product->image)) : 'https://www.aaronfaber.com/wp-content/uploads/2017/03/product-placeholder-wp.jpg' }}"
                                                class=""
                                                width="300">
                                            <div class='mt-3 d-flex flex-column gap-1'>
                                                <h5 class="mt-0 text-primary text-center">
                                                    <span class="fw-bolder">{{ $product->category->name }}</span>
                                                </h5>
                                                <h5 class='text-danger'>Rs. {{ $product->min_price }}</h5>
                                                <a href="{{ route('products.show',$product->slug) }}">
                                                    <h4 class="w-100 btn btn-primary">{{ $product->name }}</h4>
                                                </a>
                                                @if($product->user == auth()->user())
                                                <span class='text-danger'>[Your Product]</span>
                                                @endif
                                                <h6 class="mt-2 d-flex justify-content-between">
                                                    <span class='text-black-50'>
                                                        Uploaded by:
                                                    </span>
                                                    <div>
                                                        {{ $product->user->full_name }}
                                                    </div>
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
            <div class="d-flex flex-column justify-content-center">
                {!! $products->appends($searchData)->links() !!}
            </div>
        </form>
    </div>
@endsection
