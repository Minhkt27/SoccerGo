<?php
session_start();
include 'header.php';
require_once __DIR__ . '/../BLL/pitchService.php';
require_once __DIR__ . '/../BLL/orderService.php';
require_once __DIR__ . '/../BLL/UserService.php';

if (isset($_SESSION['selectedPitch'])) {
    $pitch = $_SESSION['selectedPitch'];
    $pitch_details = getPitch($pitch);
} else {
    echo 'No pitch selected.';
    die("");
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $userService = new UserService();
    $detail_user = $userService->getUserById($user_id);
} else {
    $user_id = 1;
}

if(isset($_POST['quaylai'])){
    header("Location: dashboard.php?pg=home");
    exit();
}
$date_now = date('Y-m-d');
$name = $pitch_details['name'];
$time_open = $pitch_details['time_start'];
$time_close = $pitch_details['time_end'];
$avt_pitches = getPichesDetails($pitch_details['id']);
$status = $pitch_details['is_maintenance'] == 0 ? 'Đang hoạt động' : 'Đang bảo trì';
$volume = $pitch_details['quantity'];
$price_perhour = $pitch_details['price_per_hour'];
$price_perpeak = $pitch_details['price_per_peak_hour'];
$times = getTimeOrder($user_id, $pitch_details['id']);
$note = $pitch_details['description'];
$type_note = $pitch_details['type_note'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin - <?php echo $name; ?></title>
    <link rel="stylesheet" href="css/pitchDetail.css?v= <?php echo time() ?>">
</head>

<body>
    <div class="pitch-detail-page">
        <div class="container">
            <div class="image-gallery">
                <div class="main-image">
                    <img id="field-image" src="<?php echo $avt_pitches[0]; ?>" alt="Sân bóng">
                </div>
                <div class="thumbnails-container">
                    <div class="thumbnails" id="thumbnails">
                        <?php foreach ($avt_pitches as $index => $imageSrc) : ?>
                        <img src="<?php echo $imageSrc; ?>" alt="Thumbnail <?php echo $index + 1; ?>"
                            onclick="changeImage('<?php echo $imageSrc; ?>')">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="details-panel">
                <h1 class="pitch-name"><?php echo $name; ?></h1>
                <div class="status" style="color: <?php echo $status == 'Đang hoạt động' ? 'green' : 'red'; ?>">
                    <?php echo $status; ?>
                </div>
                <div class="pitch-details">
                    <div class="detail-item">
                        <span class="label">Số người:</span>
                        <span class="value"><?php echo $volume; ?> people</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Giá sân bóng:</span>
                        <span class="value"><?php echo $price_perhour . 'đ - ' . $price_perpeak . 'đ'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Thời gian mở - đóng:</span>
                        <span class="value"><?php echo $time_open . ' - ' . $time_close; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Số người đã đặt sân</span>
                        <span class="value"><?php echo $times; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Mô tả:</span>
                        <span class="value"><?php echo $note; ?></span>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="button primary" onclick="openPopup()">Đặt sân</button>
                    <form action="pitchDetail.php" method="post">
                        <input type="submit" class="button secondary" name="quaylai" value="Quay lại">
                    </form>
                </div>
            </div>

        </div>

        <div id="popup-overlay" class="overlay">
            <div class="popup">
                <h1>Thông tin đặt sân</h1>
                <form action="pitchOrder.php" method="post">
                    <table>
                        <tr>
                            <td><label for="date">Chọn ngày</label></td>
                            <td><input type="date" name="date" value="<?php echo $date_now; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="start_time">Chọn thời gian bắt đầu</label></td>
                            <td><input type="time" name="start_time" value="07:00" step="3600"></td>
                        </tr>
                        <tr>
                            <td><label for="end_time">Chọn thời gian kết thúc</label></td>
                            <td><input type="time" name="end_time" value="07:00" step="3600"></td>
                        </tr>
                        <tr>
                            <td><label for="name">Họ và tên (*)</label></td>
                            <td><input type="text" name="name" value="<?php echo $detail_user['name'] ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="code">Mã giảm giá</label></td>
                            <td><input type="text" name="code"></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Số điện thoại (*)</label></td>
                            <td><input type="tel" name="phone"
                                    <?php if (isset($detail_user['phone'])) { echo "value='" . $detail_user['phone'] . "' ";} ?>
                                    required></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" name="email"
                                    <?php if (isset($detail_user['email'])) { echo "value='" . $detail_user['email'] . "' ";} ?>>
                            </td>
                        </tr>
                        <input type="hidden" name="pitch_details_id" value="<?php echo $pitch_details['id']; ?>">
                        <input type="hidden" name="price_perhour" value="<?php echo $price_perhour; ?>">
                        <input type="hidden" name="price_perpeak" value="<?php echo $price_perpeak; ?>">
                        <input type="hidden" name="time_open" value="<?php echo $time_open ?>">
                        <input type="hidden" name="time_close" value="<?php echo $time_close ?>">
                        <input type="hidden" name="name_pitch" value="<?php echo $name ?>">
                        <input type="hidden" name="volume" value="<?php echo $volume ?>">
                    </table>
                    <div class="popup-actions">
                        <input type="submit" name='submit' value="Đặt ngay" class="button primary">
                        <button type="button" class="button secondary" onclick="closePopup()">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    let images = <?php echo json_encode($avt_pitches); ?>;
    let currentIndex = 0;
    let status = <?php echo json_encode($status);?>;
    let thumbnailContainer = document.getElementById('thumbnails');
    let scrollButtons = document.getElementById('scroll-buttons');

    function changeImage(imageSrc) {
        let img = document.getElementById('field-image');
        img.classList.add('hidden');
        setTimeout(() => {
            img.src = imageSrc;
            img.classList.remove('hidden');
        }, 1000);
    }

    function autoChangeImage() {
        if (images.length > 1) {
            currentIndex++;
            if (currentIndex >= images.length) {
                currentIndex = 0;
            }
            changeImage(images[currentIndex]);
        }
    }


    if (images.length > 5) {
        scrollButtons.style.display = 'flex';
    }

    setInterval(autoChangeImage, 5000);

    function openPopup() {
        if (status == "Đang hoạt động") {
            document.getElementById('popup-overlay').style.display = 'flex';
        } else {
            alert('Sân đang bảo chì');
        }
    }

    function closePopup() {
        document.getElementById('popup-overlay').style.display = 'none';
    }
    </script>
</body>

</html>
<?php
include 'footer.php';
?>