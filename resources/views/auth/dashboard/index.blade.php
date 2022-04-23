@extends('auth.dashboard.layout')
@section('pageTitle', __('Dashboard'))

@section('dashboardContent')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-primary d-flex align-items-center gap-4" role="alert">
                            <i class="fas fa-chair fa-4x"></i>
                            <div class="text-center w-100">
                                <div class="h4 fw-bolder">Products</div>
                                <div class="display-4 text-center">{{ auth()->user()->products()->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-warning d-flex align-items-center gap-4" role="alert">
                            <i class="fas fa-calculator fa-4x"></i>
                            <div class="text-center w-100">
                                <div class="h4 fw-bolder">Auctions Won</div>
                                <div class="display-4 text-center">{{ auth()->user()->auctionsWon()->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-danger d-flex align-items-center gap-4" role="alert">
                            <i class="fas fa-sort-numeric-up fa-4x"></i>
                            <div class="text-center w-100">
                                <div class="h4 fw-bolder">Bids</div>
                                <div class="display-4 text-center">{{ auth()->user()->bids()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
