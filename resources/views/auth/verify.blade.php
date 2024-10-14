<!-- resources/views/auth/verify.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Xác Nhận Mã</title>
</head>
<body>
    <h1>Xác Nhận Mã</h1>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('verification.verify') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <label for="code">Nhập mã xác nhận:</label>
        <input type="text" name="code" required>
        <button type="submit">Xác Nhận</button>
    </form>
</body>
</html>
