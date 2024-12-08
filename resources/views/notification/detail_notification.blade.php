@extends('layouts.client_layout')

@section('content')
<div class="container mt-5">
    <!-- Notification Header -->
    <div class="notification-header mb-4">
        <h3 class="text-black fw-bold">
            <i class="fas fa-bell me-2 text-warning"></i> 
            {{ $notification->title_notification }}
        </h3>
        <p class="mb-0">
            <i class="far fa-clock me-2 "></i> 
            {{ $notification->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <!-- Notification Content -->
    <div class="notification-content p-4 rounded bg-light shadow-sm">
        <h3 class="text-dark">
            {!! $notification->content_notification !!}
        </h3>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('notifications.show') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Notifications
        </a>
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print me-2"></i>Print Notification
        </button>
    </div>

    <!-- Reminder Section -->
    <div class="reminder mt-5 p-3 rounded mb-5">
       
        <p class="text-secondary ">
            <strong class="text-dark">
                <i class="fas fa-exclamation-circle me-2 text-danger"></i>Reminder :
            </strong>
            This notification is provided to keep you updated on important events, system alerts, or promotional campaigns. Stay tuned!
        </p>
    </div>
</div>

<!-- Optional Styling -->
<style>
    .notification-header h2 {
        margin-bottom: 1rem;
    }

    .notification-content h3 {
        line-height: 2;
    }

    .btn-outline-primary {
        border-width: 2px;
    }

    .reminder {
        font-size: 0.95rem;
        font-style: italic;
        border-left: 5px solid #ffc107;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    @media print {
        .btn, .reminder {
            display: none;
        }

        .container {
            margin: 0;
            padding: 0;
        }
    }
</style>
@endsection
