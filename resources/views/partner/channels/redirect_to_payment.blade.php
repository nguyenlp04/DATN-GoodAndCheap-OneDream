<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đang chuyển hướng...</title>
</head>
<body>
    <p>Đang chuyển hướng tới trang thanh toán, vui lòng đợi...</p>
    <form id="autoSubmitForm" action="{{ route('vnpay.initiatePayment') }}" method="POST">
        @csrf
        {{ dd(123) }}
        <input type="hidden" name="channel_id" value="{{ $channel_id }}">
        <input type="hidden" name="vip_package_id" value="{{ $vip_package_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
    </form>
    <script>
        document.getElementById('autoSubmitForm').submit();
    </script>
</body>
</html>
