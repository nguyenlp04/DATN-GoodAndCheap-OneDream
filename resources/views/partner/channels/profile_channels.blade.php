@extends('layouts.client_layout')

@section('content')
<main class="container pt-5">
    <h3 class="mb-4">Product Channels</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($channels as $channel)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm border-light">
                    <!-- Thumbnail with hover effect -->
                    <img src="{{ asset('storage/' . $channel->image_channel) }}" class="card-img-top" alt="{{ $channel->name_channel }}" style="max-height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $channel->name_channel }}</h5>
                        <p class="card-text">
                            <strong>Phone:</strong> {{ $channel->phone_number }}
                        </p>
                        <p class="card-text">
                            <strong>Address:</strong> {{ $channel->address }}
                        </p>
                        <!-- Action Button -->
                        <a href="{{ route('channels.show', $channel->channel_id) }}" class="btn btn-primary w-100">View Channel</a>
                    </div>
                    <!-- Hover effect for card -->
                    <style>
                        .card:hover .card-img-top {
                            transform: scale(1.05);
                        }
                    </style>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection
