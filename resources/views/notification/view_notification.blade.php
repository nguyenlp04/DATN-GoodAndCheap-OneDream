@extends('layouts.client_layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4 text-center text-primary fw-bold">
                <i class="fas fa-bell me-2"></i> Notifications
            </h2>
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="notificationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="unread-tab" data-bs-toggle="tab" data-bs-target="#unread" type="button" role="tab" aria-controls="unread" aria-selected="true">
                        Unread
                        <span class="badge bg-danger ms-2">{{ count($unreadNotifications ?? []) }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">
                        All notifications
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="notificationTabsContent">
                <!-- Unread Notifications -->
                <div class="tab-pane fade show active" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                    <ul class="list-group" id="unread-list">
                        @if (!empty($unreadNotifications) && count($unreadNotifications) > 0)
                            @foreach ($unreadNotifications as $notification)
                            <li class="list-group-item notification-item p-4">
                                <a href="{{ route('notifications.detail', $notification['notification_id']) }}" class="text-decoration-none d-flex align-items-center">
                                    <div class="icon me-3">
                                        <i class="fas fa-envelope text-success fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-2 text-success fw-bold">
                                            {{ $notification['title_notification'] }}
                                        </h5>
                                        <p class="mb-2 text-secondary">
                                            {!! Str::limit($notification['content_notification'], 200) !!}
                                        </p>
                                        @php
                                            $createdAt = new DateTime($notification['created_at']);
                                        @endphp
                                        <span class="text-muted small">
                                            <i class="fas fa-clock me-1"></i> 
                                            {{ $createdAt->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right text-muted fs-4"></i>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @else
                            <li class="list-group-item text-center bg-light text-muted p-4">
                                <i class="fas fa-info-circle fs-4"></i> No unread notifications.
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- All Notifications -->
                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <ul class="list-group" id="all-list">
                        @if (!empty($notifications) && count($notifications) > 0)
                            @foreach ($notifications as $notification)
                            <li class="list-group-item notification-item p-4">
                                <a href="{{ route('notifications.detail', $notification['notification_id']) }}" class="text-decoration-none d-flex align-items-center">
                                    <div class="icon me-3">
                                        <i class="fas fa-bell text-primary fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-2 text-primary fw-bold">
                                            {{ $notification['title_notification'] }}
                                        </h5>
                                        <p class="mb-2 text-secondary">
                                            {!! Str::limit($notification['content_notification'], 200) !!}
                                        </p>
                                        @php
                                            $createdAt = new DateTime($notification['created_at']);
                                        @endphp
                                        <span class="text-muted small">
                                            <i class="fas fa-clock me-1"></i> 
                                            {{ $createdAt->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-right text-muted fs-4"></i>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @else
                            <li class="list-group-item text-center bg-light text-muted p-4">
                                <i class="fas fa-info-circle fs-4"></i> No notifications available.
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .notification-item {
        border: 1px solid #eaeaea;
        border-radius: 10px;
        margin-bottom: 1rem;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .notification-item h5 {
        font-size: 1.25rem;
    }

    .notification-item p {
        font-size: 1rem;
    }

    .notification-item i {
        font-size: 1.5rem;
    }

   
</style>
@endsection
