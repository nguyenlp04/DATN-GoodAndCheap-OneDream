
<div class="container">
    <h1>Your Notifications</h1>

    {{-- @if($notifications->isEmpty())
        <p>No notifications found.</p>
    @else --}}
        <ul>
            @foreach($notifications as $notification)
                <li>
                    <h2>{{ $notification->title_notification }}</h2>
                    <p>{!! $notification->content_notification !!}</p>
                    <small>Time: {{ $notification->created_at->format('Y-m-d') }}</small>
                </li>
            @endforeach
        </ul>
    {{-- @endif --}}
</div>