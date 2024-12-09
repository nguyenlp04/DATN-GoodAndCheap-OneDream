@extends('layouts.client_layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4 text-center text-black fw-bold">
                <i class="fas fa-bell me-2"></i> Notifications
            </h2>

            <!-- Hiển thị danh sách thông báo -->
<ul id="all-list" class="list-unstyled">
    @foreach ($notifications as $notification)
        <li class="mb-4">
            <a href="{{ route('notifications.detail', $notification['notification_id']) }}" class="text-decoration-none">
                <div class="card p-3 border-0 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title text-black">{{ Str::limit($notification['title_notification'], 100) }}</h5>
                        @php
                            $createdAt = new DateTime($notification['created_at']);
                        @endphp
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-2 text-muted text-black"></i>
                            <span class="text-muted small">{{ $createdAt->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <p class="card-text text-truncate" style="max-width: 100%;">{!! $notification['content_notification'] !!}</p>
                </div>
            </a>
        </li>
    @endforeach
</ul>
        </div>
    </div>
</div>

@endsection
