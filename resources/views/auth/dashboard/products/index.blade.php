@extends('auth.dashboard.layout')
@section('pageTitle', __('Products'))

@section('dashboardContent')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
            <span>
                <a class="btn btn-success" href="{{ route('user.products.create') }}">Add</a>
            </span>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>Rs. {{ $product->min_price }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <a href="{{ route('user.products.show',$product->slug) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('user.products.delete',$product->slug) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-white text-center bg-danger" colspan="5">
                                No Products
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class='w-100 d-flex justify-content-end'>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
