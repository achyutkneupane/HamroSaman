@extends('layouts.app')
@section('pageTitle', __('Categories'))

@section('content')
    <div class="card">
        <div class="card-header">@yield('pageTitle')</div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Products</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products()->count() }}</td>
                      </tr>
                    @empty
                        <tr>
                          <td class="alert alert-danger" colspan="3">
                            No Categories
                          </td>
                        </tr>
                    @endforelse
                  </tbody>
            </table>
            <div class='w-100 d-flex justify-content-end'>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
