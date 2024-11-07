<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <h2>Welcome to Staff Dashboard</h2>

        @auth('staff')
        <div class="staff-info">
            <p><strong>ID:</strong> {{ Auth::guard('staff')->user()->staff_id }}</p>
            <p><strong>Full Name:</strong> {{ Auth::guard('staff')->user()->full_name }}</p>
            <p><strong>Email:</strong> {{ Auth::guard('staff')->user()->email }}</p>
            @if(Auth::guard('staff')->user()->avata)
            <p><strong>Avatar:</strong></p>
            <img src="{{ asset('uploads/avatars/' . Auth::guard('staff')->user()->avata) }}" alt="Avatar" class="img-thumbnail" style="max-width: 150px;">
            @else
            <p><strong>Avatar:</strong> Not set</p>
            @endif
            <p><strong>Status:</strong> {{ Auth::guard('staff')->user()->status }}</p>
            <p><strong>Role:</strong> {{ Auth::guard('staff')->user()->role }}</p>
            <p><strong>Address:</strong> {{ Auth::guard('staff')->user()->address }}</p>
        </div>
        @endauth

        <form action="{{ route('staff.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
</body>

</html>