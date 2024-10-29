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
                <p class="heading">Forgot password</p>
                <input type="email" name="email" placeholder="Email" class="form-group" required>
                <input type="password" name="new_password" placeholder="Password" class="form-group" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-group"
                    required>
                <input type="submit" value="Forgot password" class="btn" name="forgotPassword">
                <p class="signup-link">Don't have an account? <a href="signin.php">Sign up</a></p>
                <p class="signup-link">Back to Login <a href="login.php">Login</a></p>

            </div>
        </div>
    </form>
</body>

</html>