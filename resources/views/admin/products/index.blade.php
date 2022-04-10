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
                      </tr>
                    @empty
                        
                    @endforelse
                  </tbody>
            </table>
        </div>
    </div>
@endsection
