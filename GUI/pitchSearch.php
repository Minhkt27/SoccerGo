<?php
require_once __DIR__ . '/../BLL/pitchSearchService.php';
$service = new PitchSearchService();

$value = isset( $_SESSION['something'])? $_SESSION['something']:"";
$mess = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['pitchId'])){
        $pitchId = $_POST['pitchId'];
        $_SESSION['selectedPitch'] = $pitchId;
        header('Location: pitchDetail.php');
        exit();
    }
}
?>
<?php
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    if(isset($_POST['search'])){
        $name = trim($_POST['search-bar']);
        if(!empty($name)){
            $_SESSION['something'] = $name;
            $emptyPitches = $service-> getPitchByName($name);
            $value = $name;
        }else{
            $mess = "Vui lòng nhập tên sân bóng!";
            unset($_SESSION['something']);
            $value = "";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Sân Bóng</title>
    <link rel="stylesheet" href="css/pitchSearch.css?v=<?php echo time(); ?>">
</head>

<body>
    <header class="header_pitchManage">
        <div class="header_content">
            <h2>Tìm kiếm sân bóng</h2>
        </div>
    </header>
    <div class="form-search">
        <form action="" method="post">
            <input type="text" id="search-bar" name="search-bar" placeholder="Tìm kiếm sân bóng..."
                <?php echo 'value="' .$value . '"'; ?>>
            <button type="submit" id="search" name="search">Tìm kiếm</button>
        </form>
    </div>
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
        <h3 align="center"><?php echo $mess; ?></h3>
        <?php endif; ?>
    </div>
</body>

</html>