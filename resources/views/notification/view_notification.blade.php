@extends('layouts.client_layout')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="mb-4">Notifications</h3>
                <ul class="list-group" id="notification-list">
                    @if (!empty($notifications) && count($notifications) > 0)
                        @for ($i = 0; $i < min(10, count($notifications)); $i++)
            <a href="{{ route('notifications.detail', $notifications[$i]['notification_id']) }}">

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1 text-primary">
                                        <i class="fas fa-bell"></i> 
                                        {{ $notifications[$i]['title_notification'] }}
                                    </h5>
                                    <p class="mb-1">
                                        {!! Str::limit($notifications[$i]['content_notification'], 170) !!}
                                    </p>
                                    @php
                                        $createdAt = new DateTime($notifications[$i]['created_at']);
                                    @endphp
                                    <span class="text-muted">
                                        <i class="fas fa-clock"></i> 
                                        {{ $createdAt->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                                <div>
                                    <button 
                                        class="btn btn-sm delete-notification"
                                        title="Delete Notification"
                                        onclick="handleDeleteNotification({{ $notifications[$i]['id'] ?? 'null' }})">
                                        <i class="fas fa-trash-alt  "></i>
                                    </button>
                                </div>
                            </li>
            </a>

                        @endfor
                    @else
                        <li class="list-group-item text-center bg-light text-muted">
                            <i class="fas fa-info-circle"></i> No notifications available.
                        </li>
                    @endif
                </ul>
        </div>
    </div>
</div>

<script>
    function handleDeleteNotification(notificationId) {
        if (confirm('Are you sure you want to delete this notification?')) {
            // Add delete notification handling here
            console.log('Delete notification ID:', notificationId);
        }
    }
</script>
@endsection