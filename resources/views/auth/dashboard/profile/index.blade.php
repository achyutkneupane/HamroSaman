@extends('auth.dashboard.layout')
@section('pageTitle', 'Profile')

@section('dashboardContent')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
            @if($user->id == auth()->id())
                <a href="{{ route('profile.edit') }}" class='btn btn-warning'>Edit Profile</a>
            @endif
        </div>

        <div class="card-body container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <div class='overflow-hidden mx-auto ratio ratio-1x1 col-md-7 w-75'>
                        <img src="{{ $user->profile_picture ? asset(Storage::url($user->profile_picture)) : 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_640.png' }}" class="img-thumbnail rounded-circle"
                            style="object-fit:cover;" />
                    </div>
                    <h4 class='font-bold mt-2'>{{ $user->full_name }}</h4>
                    <span class='text-muted'>{{ $user->email }}</span>
                </div>
                <div class="col-md-8">
                    <dl class="row">
                        <dt class="col-sm-3">Address</dt>
                        <dd class="col-sm-9">{!! $user->address ?? "<span class='text-muted'>N/A</span>" !!}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Phone Number</dt>
                        <dd class="col-sm-9">{!! $user->phone ?? "<span class='text-muted'>N/A</span>" !!}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Father Name</dt>
                        <dd class="col-sm-9">{!! $user->father_name ?? "<span class='text-muted'>N/A</span>" !!}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Mother Name</dt>
                        <dd class="col-sm-9">{!! $user->mother_name ?? "<span class='text-muted'>N/A</span>" !!}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-3">Date of Birth</dt>
                        <dd class="col-sm-9">{!! $user->dob ?? "<span class='text-muted'>N/A</span>" !!}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection