@extends('auth.dashboard.layout')
@section('pageTitle', 'Edit Profile')

@section('dashboardContent')
    <form class="card" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
            <button class="btn btn-success">Edit</button>
        </div>

        <div class="card-body container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <div class='overflow-hidden mx-auto ratio ratio-1x1 col-md-7 w-75'>
                        <img src="{{ $user->profile_picture ? asset(Storage::url($user->profile_picture)) : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png' }}" class="img-thumbnail rounded-circle" id="profilePicture"
                                style="object-fit:cover;" />
                    </div>
                    <div class="mt-4">
                        <input type="file" hidden id="profile_picture" name="profile_picture" value="{{ old('profile_picture',$user->profile_picture) }}"
                                class="form-control @error('profile_picture') is-invalid @enderror" 
                                onchange="document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0])" />
                        <input type="button" class='btn btn-primary' id="profile_picture_file" name="profile_picture_file" value="Change" onclick="document.getElementById('profile_picture').click()">
                        @error('profile_picture')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    {{ csrf_field() }}
                    <dl class="row align-items-center">
                        <dt class="col-sm-3">Full Name</dt>
                        <dd class="col-sm-9 row">
                            <div class='col-md-12'>
                                <input type="text" name="full_name" value="{{ old('full_name',$user->full_name) }}"
                                    class="form-control @error('full_name') is-invalid @enderror"
                                    placeholder="Full Name" />
                                @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </dl>
                    <dl class="row align-items-center">
                        <dt class="col-sm-3">Address</dt>
                        <dd class="col-sm-9 row">
                            <div class='col-md-12'>
                                <input type="text" name="address" value="{{ old('address',$user->address) }}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Full Address" />
                                @error('address')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </dl>
                    <dl class="row align-items-center">
                        <dt class="col-sm-3">Phone Number</dt>
                        <dd class="col-sm-9 row">
                            <div class='col-md-12'>
                                <input type="text" name="phone" value="{{ old('phone',$user->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Phone Number" />
                                @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </dl>
                    <dl class="row align-items-center">
                        <dt class="col-sm-3">Father's Name</dt>
                        <dd class="col-sm-9 row">
                            <div class='col-md-12'>
                                <input type="text" name="father_name" value="{{ old('father_name',$user->father_name) }}"
                                    class="form-control @error('father_name') is-invalid @enderror"
                                    placeholder="Father's Name" />
                                @error('father_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </dl>
                    <dl class="row align-items-center">
                        <dt class="col-sm-3">Mother's Name</dt>
                        <dd class="col-sm-9 row">
                            <div class='col-md-12'>
                                <input type="text" name="mother_name" value="{{ old('mother_name',$user->mother_name) }}"
                                    class="form-control @error('mother_name') is-invalid @enderror"
                                    placeholder="Mother's Name" />
                                @error('mother_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </dl>
                    <dl class="row align-items-center dob-form">
                        <dt class="col-sm-3">Date of Birth</dt>
                        <dd class="col-sm-9 row">
                            <div class='col-md-12'>
                                <input name='dob' id="datepicker" name="dob" value="{{ \Carbon\Carbon::parse(old('dob',$user->dob))->format('Y-m-d') }}"
                                    placeholder="d/m/Y" type="date"
                                    class="form-control @error('dob') is-invalid @enderror" />
                                @error('dob')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </form>
@endsection