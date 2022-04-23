@extends('auth.dashboard.layout')
@section('pageTitle', 'Messages')

@section('dashboardContent')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>
                @yield('pageTitle')
            </span>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 d-flex flex-column gap-2">
                    @forelse ($chatBoxes as $chatBox)
                        <div class="border p-2 d-flex flex-column">
                            <a href="{{ route('user.messages.show', $chatBox->id) }}">
                                {{ $chatBox->user->full_name }}
                            </a>
                            <div class="">
                                For product: {{ $chatBox->product->name }}
                            </div>
                        </div>
                    @empty
                    <div class="border p-2 d-flex flex-column">
                        No Chats
                    </div>
                    @endforelse
                </div>
                <div class="col-md-8">
                    <div class="border p-2 text-center h-100 d-flex justify-content-center align-items-center">
                        Click on a chatbox to view
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection