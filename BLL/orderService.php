<?php
    require_once '../DAL/orderData.php';
    require_once '../BLL/utils.php';
    require_once '../DAL/bankData.php';
    require_once '../DAL/pichesData.php';
    require_once '../DAL/peakHoursData.php';
    require_once '../DAL/codeData.php';
    
    function getTimeOrder($id_user, $id_pitch) {
        $r = getTimeOrderById($id_user, $id_pitch);
        return $r['order_count'];
    }

    function createNewOrder($pitch_id, $user_id, $date, $start_time, $end_time, $name, $phone, $email, 
    $price_perhour, $price_perpeak, $code) {
        $peakhours = getPeakHours();
        $total = calculatePrice($price_perhour, $price_perpeak, $peakhours, $start_time, $end_time);

        // Kiểm tra nếu mã giảm giá tồn tại và hợp lệ
        if ($code) {
            $codes = getDiscountData();
            $codeValid = false;
            if (count($codes) > 0) {
                foreach ($codes as $c) {
                    if ($code == $c['code']) {
                        $codeValid = true;
                        $amount = $total * (100 - $c['amount']) / 100;
                        if ($amount > $c['usage_limit']) {
                            $total = $total - $c['usage_limit'];
                        } else {
                            $total = $total - $amount;
                        }
                        break;
                    }
                }
            }

            // Nếu mã giảm giá không hợp lệ, thông báo lỗi và thoát
            if (!$codeValid) {
                echo "<script type='text/javascript'>alert('Mã giảm giá không hợp lệ');window.location.replace('dashboard.php?pg=home');</script>";
                return false;
            }
        }

        $deposit = floor($total * 0.4);

        // Định dạng lại thời gian
        $start_time = formatDateTime($date, $start_time);
        $end_time = formatDateTime($date, $end_time);
        $note = "Tien coc " . $pitch_id . $user_id . $start_time;
        $status = 1;

        // Kiểm tra thời gian đặt sân
        if (checkTimeOrderById($pitch_id, $start_time, $end_time) == 0) {
            $rr = createNewOrderData($pitch_id, $user_id, $name, $phone, $deposit, $code, $start_time,
             $end_time, $total, $status, $email, $note);
            return $rr;
        } else {
            echo "<script type='text/javascript'>alert('Thời gian đặt sân đã bị trùng lặp');window.location.replace('pitchDetail.php');</script>";
            return false;
        }
    }

    function getOrder($order_id) {
        $arr = getOrderById($order_id);
        return $arr;
    }
    
    function getBill() {
        $infor_bank = getBankData();
        return $infor_bank;
    }

    function updateOrder($updated_order){
        $id = $updated_order['id'];
        $name = $updated_order['name'];
        $phone = $updated_order['phone'];
        $email = $updated_order['email'];
        $start_at = $updated_order['start_at'];
        $end_at = $updated_order['end_at'];
        $deposit = $updated_order['deposit'];
        $code = $updated_order['code'];
        $status = $updated_order['status'];
        $football_pitch_id = $updated_order['football_pitch_id'];
        $footbal_pitch = getPitchById($football_pitch_id);
        $peakhours = getPeakHours();
        $price_perhour = $footbal_pitch['price_per_hour'];
        $price_perpeak = $footbal_pitch['price_per_peak_hour'];
        $codeValid = true;
        $start = getTime($start_at);
        $end = getTime($end_at);
        $total = calculatePrice1($price_perhour, $price_perpeak, $peakhours, $start, $end);
        $temp = updateOrderData($id,$name,$phone,$email,$start_at,$end_at,$deposit,$status, $total);
        return $temp;
    }

    // Đổi tên hàm từ removeOrder() thành removeOrderService()
    function removeOrderService($id) {
        return removeOrderData($id);
    }

    