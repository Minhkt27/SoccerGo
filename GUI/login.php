<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <form action="config.php" method="post">
        <div class="container">
            <img src="https://file.vfo.vn/hinh/2018/03/top-nhung-hinh-anh-hinh-nen-real-madrid-dep-nhat-full-hd6.jpg"
                alt="hình ảnh">
            <div class="ui_login">
                <p class="heading">Đăng nhập</p>
                <input type="email" name="email" placeholder="Email" class="form-group" required>
                <input type="password" name="password" placeholder="Mật khẩu" class="form-group" required>
                <input type="submit" value="Log in" class="btn" name="login">
                <p class="signup-link">Bạn chưa có tài khoản? <a href="signin.php">Đăng kí</a></p>
                <p class="signup-link"><a href="forgotPassword.php">Quên mật khẩu? </a></p>
            </div>
        </div>
    </form>
</body>

</html>