@extends('layouts.app')
@section('pageTitle', $product->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ $product->image ? '' : 'https://www.aaronfaber.com/wp-content/uploads/2017/03/product-placeholder-wp.jpg' }}" class="w-100 img-thumbnail">
            </div>
            <div class="col-md-7">
                <div class="card p-3 bg-white  d-flex flex-column gap-2">
                    <div class="display-6 fw-bolder">
                        {{ $product->name }}
                    </div>
                    <div class="d-flex flex-row gap-3">
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div>
                            |
                        </div>
                        <div class="addFavourite">
                            <i class="fa fa-heart"></i>
                        </div>
                    </div>
                    <div class="h4 text-danger">
                        Rs. {{ $product->min_price }}
                    </div>
                    <div class='text-muted'>
                        {{ $product->description }}
                    </div>
                    <dl class="row">
                        <dt class="col-sm-3">Uploaded By</dt>
                        <dd class="col-sm-9">{{ $product->user->full_name }}</dd>
                        <dt class="col-sm-3">Category</dt>
                        <dd class="col-sm-9">{{ $product->category->name }}</dd>
                    </dl>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection