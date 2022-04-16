@extends('layouts.app')
@section('pageTitle', $product->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mt-3">
                <img src="{{ $product->image ? asset(Storage::url($product->image)) : 'https://www.aaronfaber.com/wp-content/uploads/2017/03/product-placeholder-wp.jpg' }}"
                    class="w-100 img-thumbnail sticky-top border" style="top: 100px;">
            </div>
            <div class="col-md-7 mt-3">
                <div class="card p-3 bg-white  d-flex flex-column gap-2">
                    <div class="display-6 fw-bolder">
                        {{ $product->name }}
                    </div>
                    <div class="h4 text-danger">
                        Rs. {{ $product->min_price }}
                    </div>
                    <div class='text-muted'>
                        {{ $product->description }}
                    </div>
                    <dl class="row">
                        <dt class="col-sm-3">Uploaded By</dt>
                        <dd class="col-sm-9">
                            <div>{{ $product->user->full_name }}</div>
                            <div>
                                <a href="mailto:{{ $product->user->email }}">
                                    {{ $product->user->email }}
                                </a>
                            </div>
                            <div>
                                <a href="tel:{{ $product->user->phone }}">
                                    {{ $product->user->phone }}
                                </a>
                            </div>
                            <div>{{ $product->user->address }}</div>
                        </dd>
                        <dt class="col-sm-3">Category</dt>
                        <dd class="col-sm-9">{{ $product->category->name }}</dd>
                    </dl>

                    {{-- comments --}}
                    <div class="mt-3">
                        <h5 class="h2 text-uppercase">Comments</h5>
                        {{-- add comment --}}
                        <div class="mt-3">
                            <form action="{{ route('user.products.comment.add') }}" method="POST"
                                class="d-flex flex-column gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="content" id="comment" rows="4"
                                        class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        </div>
                        <div class="row mt-4 d-flex flex-column gap-2">
                            @forelse ($product->comments as $comment)
                                <div class="col-md-12">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                    <img src="{{ $comment->user->profile_picture ?
                                                                asset(Storage::url($comment->user->profile_picture)) :
                                                                'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_640.png' }}"
                                                        class="rounded-circle"
                                                        style="width: 150%; height: auto;" />
                                            </div>
                                            <div class="col-11">
                                                <div class="d-flex flex-column gap-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="h5">
                                                            {{ $comment->user->full_name }}
                                                            @if ($product->user->id == $comment->user->id)
                                                                <span class='text-danger fw-bolder'>[Owner]</span>
                                                            @endif
                                                            @if ($comment->user->id == auth()->id())
                                                                <span class='text-danger'>(You)</span>
                                                            @endif
                                                        </div>
                                                        <div class="text-muted">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        {{ $comment->content }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="card p-3 bg-white">
                                        <div class="d-flex justify-content-center">
                                            <div class="text-muted">
                                                No comments yet.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
