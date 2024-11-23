@extends('layouts.client_layout')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <div class="text-center mb-4">
        <h1 class="display-4 text-primary">{{ $notification->title_notification }}</h1>
        <p class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Notification Content Section -->
    <div class="bg-light p-4 rounded-lg shadow-sm">
        <p class="mb-3">{!! $notification->content_notification !!}</p>

        <!-- Button to go back to notifications list -->
    </div>
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('notifications.show') }}" class="btn btn-outline-primary">
            <i class="fa fa-arrow-left"></i> Back to notifications list
        </a>
    </div>
    <!-- Optional Additional Details Section -->
    <div class="mt-5">
        <div class="alert alert-info">
            <strong>Note:</strong> This notification may contain important information from the system or our promotional programs. Please make sure to check frequently.
        </div>
    </div>
</div>
@endsection
