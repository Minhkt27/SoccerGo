<?php
require_once __DIR__ . '/../BLL/pitchSearchService.php';
$service = new PitchSearchService();
$emptyPitches = $service->getAllPitches();

$service = new PitchSearchService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pitchId = $_POST['pitchId'];
    $_SESSION['selectedPitch'] = $pitchId;
    header('Location: pitchDetail.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/home.css?v= <?php echo time(); ?>">
</head>

<body>
    <header class="header_pitchManage">
        <div class="header_content">
            <h2>Soccer Go</h2>
        </div>
    </header>
    <div class="container">
        <?php if (!empty($emptyPitches)) : ?>
        <?php foreach ($emptyPitches as $pitch) : ?>
        <div class="info_pitch">
            <img src="<?php echo $service->getImg($pitch->id); ?>" alt="hình anh">
            <div class="info_show">
                <p class="title_name">Tên sân bóng: </p>
                <p><?php echo $pitch->name; ?></p>
                <p class="title_name">Thời gian mở: </p>
                <p><?php echo $pitch->start_time .' - '.$pitch->end_time; ?></p>
                <p class="title_name">Giá 1 giờ: </p>
                <p><?php echo $pitch->price_per_hour . " VND"; ?></p>
                <p class="title_name">Giá giờ cao điểm:</p>
                <p><?php echo $pitch->price_per_peak_hour . " VND"; ?></p>
                <div class="button-container">
                    <form method="post">
                        <input type="hidden" name="pitchId" value="<?php echo $pitch->id ?>">
                        <button type="submit">Đặt sân</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <h3 align="center">Không có sân bóng.</h3>
        <?php endif; ?>
    </div>
</body>

</html>