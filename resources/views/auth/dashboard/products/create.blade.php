@extends('auth.dashboard.layout')
@section('pageTitle', __('Add Product'))

@section('dashboardContent')
    <form action="{{ route('user.products.create.submit') }}" method="POST" class="card" enctype="multipart/form-data">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
            <span>
                <button class="btn btn-success">Save</button>
            </span>
        </div>

        <div class="card-body">
            {{ csrf_field() }}
            <dl class="row align-items-center">
                <dt class="col-sm-3">Product Name</dt>
                <dd class="col-sm-9 row">
                    <div class='col-md-12'>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" />
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
            <dl class="row align-items-center">
                <dt class="col-sm-3">Product Image</dt>
                <dd class="col-sm-9 row">
                    <div class='col-md-12'>
                        <input type="file" name="image" value=""
                            class="form-control @error('image') is-invalid @enderror" />
                        @error('image')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
            <dl class="row align-items-center">
                <dt class="col-sm-3">Category</dt>
                <dd class="col-sm-9 row">
                    <div class="col-md-12">
                        <select class="form-select @error('category') is-invalid @enderror" name="category" aria-label="Select Category">
                            <option selected disabled>Select category</option>
                            @foreach ($categories as $category)
                                <option @if($category->id == request()->input('category'))selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
            <dl class="row align-items-center">
                <dt class="col-sm-3">Auction Start</dt>
                <dd class="col-sm-9 row">
                    <div class='col-md-6'>
                        <input type="date" name="start_date" pattern="\d{2}-\d{2}-\d{2}" value="{{ old('start_date') }}"
                            class="form-control @error('start_date') is-invalid @enderror" placeholder="Auction Start Date" />
                        <div id="startDateHelp" class="form-text">Format: DD/MM/YYYY</div>
                        @error('start_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='col-md-6'>
                        <input type="time" name="start_time" value="{{ old('start_time') }}"
                            class="form-control @error('start_time') is-invalid @enderror" placeholder="Auction Start Time" />
                        <div id="startDateHelp" class="form-text">Format: HH:MM AM/PM</div>
                        @error('start_time')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
            <dl class="row align-items-center">
                <dt class="col-sm-3">Auction End</dt>
                <dd class="col-sm-9 row">
                    <div class='col-md-6'>
                        <input type="date" name="end_date" pattern="\d{4}-\d{2}-\d{2}" value="{{ old('end_date') }}"
                            class="form-control @error('end_date') is-invalid @enderror" placeholder="Auction End Date" />
                        <div id="startDateHelp" class="form-text">Format: DD/MM/YYYY</div>
                        @error('end_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='col-md-6'>
                        <input type="time" name="end_time" value="{{ old('end_time') }}"
                            class="form-control @error('end_time') is-invalid @enderror" placeholder="Auction End Time" />
                        <div id="startDateHelp" class="form-text">Format: HH:MM AM/PM</div>
                        @error('end_time')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
            <dl class="row align-items-center">
                <dt class="col-sm-3">Minimum Price</dt>
                <dd class="col-sm-9 row">
                    <div class='col-md-12'>
                        <input type="number" name="min_price" value="{{ old('min_price') }}" min="0" step="0.01" class="form-control @error('min_price') is-invalid @enderror" placeholder="Minimum Price" />
                        @error('min_price')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
            <dl class="row align-items-center">
                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9 row">
                    <div class='col-md-12'>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </dd>
            </dl>
        </div>
    </form>
@endsection
