@extends('auth.dashboard.layout')
@section('pageTitle', $product->name)

@section('dashboardContent')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
        </div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Price</dt>
                <dd class="col-sm-9">{{ $product->min_price }}</dd>
                <dt class="col-sm-3">Uploaded By</dt>
                <dd class="col-sm-9">
                    <div>{{ $product->user->full_name }}</div>
                    <div>
                        <a href="mailto:{{ $product->user->email }}">
                            {{ $product->user->email }}
                        </a>
                    </div>
                </dd>
                <dt class="col-sm-3">Category</dt>
                <dd class="col-sm-9">{{ $product->category->name }}</dd>
                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $product->description }}</dd>
                <dt class="col-sm-3">Auction Start</dt>
                <dd class="col-sm-9">{{ $product->auction ? $product->auction->start_at : 'N/A' }}</dd>
                <dt class="col-sm-3">Auction End</dt>
                <dd class="col-sm-9">{{ $product->auction ? $product->auction->end_at : 'N/A' }}</dd>
            </dl>
            <h3>Bids</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bidder</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @if($product->auction)
                        @forelse ($product->auction->bids()->orderByDesc('created_at')->get() as $bid)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $bid->user->full_name }}</td>
                                <td>Rs. {{ $bid->amount }}</td>
                                <td>{{ $bid->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-white text-center bg-danger" colspan="4">
                                    No Bids
                                </td>
                            </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection