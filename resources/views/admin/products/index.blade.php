@extends('layouts.app')
@section('pageTitle', __('Products'))

@section('content')
    <div class="card">
        <div class="card-header">@yield('pageTitle')</div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Price</th>
                      <th scope="col">Posted By</th>
                      <th scope="col">Category</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td>Rs. {{ $product->min_price }}</td>
                        <td>{{ $product->user->full_name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ route('products.show',$product->slug) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('products.delete',$product->slug) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @empty
                        <tr>
                          <td class="alert alert-danger" colspan="6">
                            No Products
                          </td>
                        </tr>
                    @endforelse
                  </tbody>
            </table>
            <div class='w-100 d-flex flex-column justify-content-end'>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
