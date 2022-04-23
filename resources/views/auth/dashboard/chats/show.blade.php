@extends('auth.dashboard.layout')
@section('pageTitle', 'Message with ' . $active->user->full_name)

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
                    @foreach ($chatBoxes as $chatBox)
                        <div class="border p-2 d-flex flex-column @if ($chatBox->id == $active->id) bg-secondary @endif">
                            <a href="{{ route('user.messages.show', $chatBox->id) }}"
                                class="@if ($chatBox->id == $active->id) text-white @endif">
                                {{ $chatBox->user->full_name }}
                            </a>
                            <div class="@if ($chatBox->id == $active->id) text-white @endif">
                                For product: {{ $chatBox->product->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-8 border p-2">
                    <div class="text-center container p-2">
                        <form action="{{ route('user.messages.create') }}" method="POST" class="d-flex flex-column justify-content-start pb-4 gap-2">
                            @csrf
                            <input type="hidden" name="chat_box_id" value="{{ $active->id }}">
                            <div class="form-group">
                                <label for="message" class="text-left">Message</label>
                                <textarea name="message" id="message" rows="2"
                                    class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                        <div class="border p-2"  style="height: 500px; overflow-y: scroll;">
                            @forelse($chats as $chat)
                                <div class="row px-4 py-2">
                                    @if ($chat->direction == 'right')
                                        <div class="col-md-2"></div>
                                    @endif
                                    <div
                                        class="col-md-10 py-1 rounded d-flex justify-content-start gap-4 align-items-center @if ($chat->direction == 'right') bg-light text-dark @elseif($chat->direction == 'left') bg-dark text-white @endif">
                                        <img src="{{ $chat->user->profile_picture
                                            ? asset(Storage::url($chat->user->profile_picture))
                                            : 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_640.png' }}"
                                            class="rounded-circle" style="width: 10%; height: auto;" />
                                        <div class="d-flex text-start flex-column gap-1 w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="h5">
                                                    {{ $chat->user->full_name }}
                                                    @if ($chat->chatBox->product->user->id == $chat->user->id)
                                                        <span class='text-danger fw-bolder'>[Owner]</span>
                                                    @endif
                                                </div>
                                                <div
                                                    class="@if ($chat->direction == 'right') text-muted @elseif($chat->direction == 'left') text-white @endif">
                                                    {{ $chat->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div>
                                                {{ $chat->message }}
                                            </div>
                                        </div>
                                    </div>
                                    @if ($chat->direction == 'left')
                                        <div class="col-md-2"></div>
                                    @endif
                                </div>
                            @empty
                                <div class="h-100 d-flex justify-content-center align-items-center">
                                    No messages yet
                                </div>
                            @endforelse
                            <div class="d-flex justify-content-center align-items-center">
                                {{ $chats->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
