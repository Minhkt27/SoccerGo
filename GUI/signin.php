<?php
session_start();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
unset($_SESSION['success']);

if(isset($_GET['pg'])){
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    $form_data = [];
    $error = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/signin.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container p-5 my-5 border">

        <form action="registerHandler.php" method="post">
            <h2 class="form-title">Đăng kí</h2>
            <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="row mt-3">
                <div class="mb-3 col">
                    <label for="firstname" class="form-label">Tên</label><br>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="e.g: A"
                        value="<?php echo htmlspecialchars($form_data['firstname'] ?? ''); ?>" required>
                </div>
                <div class="mb-3 col">
                    <label for="lastname" class="form-label">Họ đệm</label><br>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="e.g: Nguyễn Văn"
                        value="<?php echo htmlspecialchars($form_data['lastname'] ?? ''); ?>" required>
                </div>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Mật khẩu</label><br>
                <input type="password" name="password" id="password" class="form-control pr-5" required>
                <i class="fa-regular fa-eye position-absolute" id="ia" onclick="myFunction()"></i>
            </div>
            <div class="mb-3 position-relative">
                <label for="confirmPass" class="form-label">Xác nhận mật khẩu</label><br>
                <input type="password" name="confirmPass" id="confirmPass" class="form-control pr-5" required>
                <i class="fa-regular fa-eye position-absolute" id="ib" onclick="myFunction1()"></i>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label><br>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="<?php echo htmlspecialchars($form_data['address'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label><br>
                <input type="text" name="address" id="address" class="form-control"
                    placeholder="e.g: Quảng Ninh, Hà Nội,..."
                    value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label><br>
                <input type="email" name="email" id="email" class="form-control" placeholder="e.g: NguyenVanA@gmail.com"
                    value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>" required>
            </div>
            <div>
                <input type="submit" value="Đăng kí" id="gui" name="register" class="btn btn-success btn-block ">
                <a href="signin.php?pg" id="huybo" class="btn btn-dark">Hủy Bỏ</a>
            </div>
        </form>
    </div>
    <script>
    let temp = true;
    let temp1 = true;

    function myFunction() {
        if (temp) {
            document.getElementById('password').type = "text";
            temp = false;
        } else {
            document.getElementById('password').type = "password";
            temp = true;
        }
    }

    function myFunction1() {
        if (temp1) {
            document.getElementById('confirmPass').type = "text";
            temp1 = false;
        } else {
            document.getElementById('confirmPass').type = "password";
            temp1 = true;
        }
    }
    </script>
</body>

</html>