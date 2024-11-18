@extends('layouts.client_layout')
@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-primary text-white py-4">
            <h4 class="text-center mb-0">📢 Your Notifications</h4>
        </div>
        <div class="card-body bg-light">
            {{-- Kiểm tra nếu không có thông báo --}}
            @if($notifications->isEmpty())
                <div class="alert alert-warning text-center rounded-pill shadow-sm" role="alert">
                    🚫 No notifications found.
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <li class="list-group-item bg-white rounded-3 shadow-sm my-3 border-0">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="text-primary fw-bold">{{ $notification->title_notification }}</h5>
                                <small class="text-muted fst-italic">{{ $notification->created_at }}</small>
                            </div>
                            <p class="mb-0 text-secondary">{!! $notification->content_notification !!}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
       
    </div>
</div>
@endsection
