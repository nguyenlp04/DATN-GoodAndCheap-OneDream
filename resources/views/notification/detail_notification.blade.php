@extends('layouts.client_layout')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="display-4 text-primary">{{ $notification->title_notification }}</h1>
        <p class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Notification Content Section -->
    <div class="bg-white p-4 rounded-lg shadow-sm border">
        <p class="mb-3">{!! $notification->content_notification !!}</p>
    </div>

    <!-- Back to Notifications List Button -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('notifications.show') }}" class="btn btn-outline-primary">
            <i class="fa fa-arrow-left"></i> Back to notifications list
        </a>
    </div>

    <!-- Additional Details Section -->
    <div class="mt-5">
        <div class="alert alert-info">
            <strong>Note:</strong> This notification may contain important information from the system or our promotional programs. Please check frequently.
        </div>
    </div>
</div>

<!-- Optional: Add some custom CSS for better styling -->
<style>
    .bg-white {
        background-color: #ffffff; /* Change background color if needed */
    }
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
    }
</style>
@endsection
