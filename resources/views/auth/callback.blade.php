<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đang xử lý đăng nhập...</title>
</head>
<body>
    <script>
        @if(isset($error))
            if (window.opener) {
                window.opener.Toast.show("{{ $error }}", 'error');
                window.close();
            } else {
                window.location.href = '/?error=' + encodeURIComponent("{{ $error }}");
            }
        @else
            if (window.opener) {
                // Gửi thông báo thành công cho trang cha nếu cần, hoặc chỉ reload
                window.opener.location.reload();
                window.close();
            } else {
                window.location.href = '/';
            }
        @endif
    </script>
</body>
</html>
