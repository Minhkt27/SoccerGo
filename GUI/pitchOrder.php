<?php
session_start();
require_once __DIR__ . '/../BLL/pitchService.php';
require_once __DIR__ . '/../BLL/orderService.php';
require_once __DIR__ . '/../BLL/utils.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $namee = trim(htmlspecialchars($_POST['name']));
        $namee = formatStandard($namee);
        $sdt = htmlspecialchars(trim($_POST['phone']));
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
        $code = isset($_POST['code']) ? htmlspecialchars(trim($_POST['code'])) : null;
        $pitch_details_id = trim($_POST['pitch_details_id']);
        $price_perhour = trim($_POST['price_perhour']);
        $price_perpeak = trim($_POST['price_perpeak']);
        $time_open = new DateTime(formatDateTime($date, $_POST['time_open']), $timezone);
        $time_close = new DateTime(formatDateTime($date, $_POST['time_close']), $timezone);
        
        $start = new DateTime(formatDateTime($date, $start_time), $timezone);
        $end = new DateTime(formatDateTime($date, $end_time), $timezone);
        $current_time = new DateTime('now', $timezone);
        $current_time->setTimezone($timezone);
        
        $current_time->modify('+2 hours');
        
        if ($start <= $current_time) {
            echo "<script type='text/javascript'>alert('Thời gian cần đặt trước ít nhất 2 tiếng" ." ". $current_time->format('Y-m-d H:i:s') ." " . $start->format('Y-m-d H:i:s') . "'); window.location.replace('pitchDetail.php');</script>";
            exit();
        }
        if ($start < $time_open || $end > $time_close) {
            echo "<script type='text/javascript'>alert('Thời gian cần nằm trong thời gian mở cửa'); window.location.replace('pitchDetail.php');</script>";
            exit();
        }
        if (!$namee) {
            echo "<script type='text/javascript'>alert('Tên không được chứa ký tự đặc biệt');window.location.replace('pitchDetail.php');</script>";
            exit;
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            echo "<script type='text/javascript'>alert('Không có thông tin người đặt');window.location.replace('pitchDetail.php');</script>";
        }
        
        try {
            $re = createNewOrder($pitch_details_id, $user_id, $date, $start_time, $end_time, $namee, $sdt, $email, $price_perhour, $price_perpeak, $code);
            if ($re) {
                $_SESSION["order_id"] = $re;
                $_SESSION["pitch_id"] = $pitch_details_id;
                $_SESSION["name_pitch"] = $_POST['name_pitch'];
                $_SESSION["quantity_pitch"] = $_POST['volume'];
                $_SESSION["name_user"] = $namee;
                $_SESSION["phone"] = $sdt;
                $_SESSION["email"] = $email;
                $_SESSION["start_time"] = $start->format('Y-m-d H:i:s');
                $_SESSION["end_time"] = $end->format('Y-m-d H:i:s');
                header("Location: order.php");
                unset($_SESSION['selectedPitch']);
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Đặt không thành công'); window.location.replace('pitchDetail.php');</script>";
            }
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Message: " . $e->getMessage() . "'); window.location.replace('pitchDetail.php');</script>";
        }
    } else {
        
    }
}