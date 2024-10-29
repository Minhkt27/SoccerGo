<?php
session_start();
require_once __DIR__ . '/../BLL/UserService.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userService = new UserService();
    $hashedPassword = md5($password);
    $user = $userService->login($email, $hashedPassword);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['type'];

        if ($user['type'] == 2) {
            header("Location: dashboard.php");
        } elseif ($user['type'] == 1) {
            header("Location: dashboard_admin.php");
        }
        exit();
    } else {
        echo '<script type="text/javascript">alert("Invalid email or password."); location.replace("login.php");</script>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgotPassword'])) {
    $email = $_POST['email']; // Lấy email từ form
    $newPassword = $_POST['new_password']; // Lấy mật khẩu mới từ form
    $confirmPassword = $_POST['confirm_password']; // Lấy xác nhận mật khẩu từ form
    $userService = new UserService();
    if($userService->isEmailExist($email)) {
        if ($newPassword == $confirmPassword) {
            $userService->updatePassword($email, $newPassword);
            echo '<script type="text/javascript"> alert("Password updated successfully."); location.replace("login.php");</script>';
        } else {
            echo '<script type="text/javascript"> alert("Passwords do not match."); location.replace("forgotPassword.php");</script>';
        }
    }else{
        echo '<script type="text/javascript"> alert("Email does not exist in the system."); location.replace("forgotPassword.php");</script>';
    }

}