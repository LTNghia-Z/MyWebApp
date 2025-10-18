<!DOCTYPE html>
<html>
<head>
    <title>Tài khoản của bạn đã được tạo!</title>
</head>
<body>
    <h2>Chào {{ $username }},</h2>
    <p>Tài khoản của bạn đã được tạo thành công trên hệ thống của chúng tôi.</p>
    <p>Dưới đây là thông tin đăng nhập của bạn:</p>
    <ul>
        <li><strong>Email:</strong> {{ $username }}</li>
        <li><strong>Mật khẩu:</strong> {{ $password }}</li>
    </ul>
    <p>Vui lòng đăng nhập và đổi mật khẩu ngay để bảo mật tài khoản của bạn.</p>
    <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
</body>
</html>
