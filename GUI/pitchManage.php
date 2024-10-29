<?php
require_once __DIR__ . '/../BLL/pitchManageService.php';
$result = getDataPitchforTable();
$result3 = getDataPitchforTable();
$showForm = isset($_POST['ButThem']);
$showForm2= isset($_POST['ButSua']);
$showForm3= isset($_POST['Anh']);
$showForm4 = isset($_POST['ThemHinhAnh']);
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soccer field management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./css/pitchManage.css?v = <?php echo time(); ?>">
</head>

<body>
    <header class="header_pitchManage">
        <div class="header_content">
            <img class="logo" src="./img/logocauthu.png" alt="">
            <h2>Quản lý sân bóng</h2>
        </div>
        <nav class="menu2">
            <ul>
                <li>
                    <form method="post" action="">
                        <button name="ButThem" class="butthem">Thêm sân bóng</button>
                    </form>
                </li>
                <li>
                    <form method="post" action=""><button name="ButSua" class="butsua">Cập nhật sân bóng</button>
                    </form>
                </li>
                <li>
                    <form method="post" action=""><button name="ThemHinhAnh" class="butthem">Thêm hình ảnh</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <body class="body_pitchManage">
        <?php if ($showForm): ?>
        <div class="modal">
            <div class="modal-content">
                <form id="pitchForm" action="pitchManage.php" method="post">

                    <label for="pitchName">Tên sân bóng:</label>
                    <input type="text" name="pitchName"><br><br>
                    <label for="pitchTimeStart">thời gian bắt đầu:</label>
                    <input type="time" name="pitchTimeStart"><br><br>
                    <label for="pitchTimeEnd">Thời gian kết thúc:</label>
                    <input type="time" name="pitchTimeEnd"><br><br>
                    <label for="Description">Mô tả:</label>
                    <input type="text" name="Description"><br><br>
                    <label for="price_per_hour">Giá sân trong 1 giờ:</label>
                    <input type="text" name="price_per_hour"><br><br>
                    <label for="price_per_peak_hour">Giá sân lúc cao điểm:</label>
                    <input type="text" name="price_per_peak_hour"><br><br>
                    <label for="is_maintenance">Bảo trì:</label>
                    <input type="text" name="is_maintenance"><br><br>
                    <label for="pitch_type_id">Mã loại sân:</label>
                    <input type="text" name="pitch_type_id"><br><br>


                    <input name="ThemSanBong" type="submit" value="Thêm sân bóng">
                    <input name="Thoat" type="submit" value="Thoát">

                </form>
            </div>
        </div>

        <?php endif;   ?>

        <?php
        if($_SERVER["REQUEST_METHOD"]=='POST')
         if ($showForm3): ?>

        <div class="modal4">
            <div class="modal-content4">
                <?php
        if (isset($_POST['hidenId'])) {
            $result2 = checkPic($_POST['hidenId']);
            if ($result2) {
            echo '<div class="img-gallery">';
            foreach ($result2 as $key => $mt) {                    
                echo '<div class="img-gallery__item">';
                echo "<img src=\"$mt\" alt=\"Mô Tả 1\">";
                echo '</div>';
            } 
            echo '</div>';  
        } else {
            echo "Chưa có ảnh sân này trong dữ liệu";
        }
}
?>

            </div>
        </div>

        <?php endif; ?>

        <?php if ($showForm2): ?>
        <div class="modal2">
            <div class="modal-content2">
                <form id="pitchForm2" action="pitchManage.php" method="post">
                    <label for="pitchId2">Mã sân bóng:</label>
                    <select name="pitchId2">
                        <?php while($row = $result3->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br><br>
                    <label for="pitchName2">Tên sân bóng:</label>
                    <input type="text" name="pitchName2"><br><br>
                    <label for="pitchTimeStart2">Thời gian bắt đầu:</label>
                    <input type="time" name="pitchTimeStart2" style="width: 284px;"><br><br>
                    <label for="pitchTimeEnd2">Thời gian kết thúc:</label>
                    <input type="time" name="pitchTimeEnd2" style="width: 284px;"><br><br>
                    <label for="Description2">Mô tả:</label>
                    <input type="text" name="Description2"><br><br>
                    <label for="price_per_hour2">Giá sân trong 1 giờ:</label>
                    <input type="text" name="price_per_hour2"><br><br>
                    <label for="price_per_peak_hour2">Giá sân giờ cao điểm:</label>
                    <input type="text" name="price_per_peak_hour2"><br><br>
                    <label for="is_maintenance2">Bảo chì:</label>
                    <input type="text" name="is_maintenance2"><br><br>
                    <label for="pitch_type_id2">Mã loại sân:</label>
                    <input type="text" name="pitch_type_id2"><br><br>

                    <input name="SuaSanBong" type="submit" value="Cập nhật">
                    <input name="Thoat" type="submit" value="Thoát">
                </form>
            </div>
        </div>

        <?php endif;   ?>

        <?php if ($showForm4): ?>
        <div class="modal2">
            <div class="modal-content3">
                <form id="pitchForm4" action="pitchManage.php" method="post">
                    <label for="tenSanBong">Tên sân bóng:</label><br>
                    <select name="tenSanBong" style="font-size: 15px; width: 450px; height: 35px">
                        <?php while($row = $result3->fetch_assoc()): ?>
                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br><br>
                    <label for="image">Liên kết hình ảnh</label><br>
                    <input type="text" name="image" id="image" style="width: 450px;">
                    <br><br>
                    <input name="add" type="submit" value="Thêm hình ảnh">
                    <input name="Thoat" type="submit" value="Thoát">
                </form>
            </div>
        </div>

        <?php endif;   ?>


        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Tên sân bóng</th>
                <th>Thời gian mở cửa</th>
                <th>Thời gian đóng cửa</th>
                <th>Mô tả</th>
                <th>Giá sân trong 1 giờ</th>
                <th>Giá sân giờ cao điểm</th>
                <th>Bảo trì</th>
                <th>Mã loại sân</th>
                <th>Thời gian tạo</th>
                <th>Thời gian cập nhật</th>
                <th>Hình ảnh</th>
                <th>Xóa</th>
            </tr>
            <?php
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["time_start"] . "</td>";
                    echo "<td>" . $row["time_end"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["price_per_hour"] . "</td>";
                    echo "<td>" . $row["price_per_peak_hour"] . "</td>";
                    echo "<td>" . $row["is_maintenance"] . "</td>";
                    echo "<td>" . $row["pitch_type_id"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>" . $row["updated_at"] . "</td>";
                    echo "<td><form action='dashboard_admin.php?pg=pitchManage' method='post'><button type='submit' name ='Anh' ><i class='fa-solid fa-eye'></i></button>
                    <input type='hidden' name='hidenId' value='". $row['id']."'></form></td>";
                    echo "<td> <form action='dashboard_admin.php?pg=pitchManage' method='post'><button type='submit' name= 'Xoa' onclick='return confirmDelete();')'><i class='fa-solid fa-trash'></i></button>
                    <input type='hidden' name='hidenId' value='". $row['id']."'></form></td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <?php
        if($_SERVER["REQUEST_METHOD"]==='POST') {
            if (isset($_POST['ThemSanBong'])) {
            
            $created_at= date('Y-m-d H:i:s'); 
            $updated_at= null;
            checkAddingPitch($_POST['pitchName'], $_POST['pitchTimeStart'], $_POST['pitchTimeEnd'], $_POST['Description'], $_POST['price_per_hour'], 
            $_POST['price_per_peak_hour'], $_POST['is_maintenance'], $_POST['pitch_type_id'], $created_at, $updated_at);
            header("Location: dashboard_admin.php?pg=pitchManage");
              exit();
        }
        if(isset($_POST["Thoat"])) {
            header("Location: dashboard_admin.php?pg=pitchManage");
            exit();

        }
         if(isset($_POST['SuaSanBong'])){
            
            $updated_at= date('Y-m-d H:i:s'); 
            checkUpdatePitch($_POST['pitchId2'] ,$_POST['pitchName2'], $_POST['pitchTimeStart2'], $_POST['pitchTimeEnd2'], $_POST['Description2'], $_POST['price_per_hour2'], 
            $_POST['price_per_peak_hour2'], $_POST['is_maintenance2'], $_POST['pitch_type_id2'], $updated_at);
            header("Location: dashboard_admin.php?pg=pitchManage");
            exit();
        }
        if(isset($_POST['Xoa'])){
            $delid = $_POST['hidenId'];
            checkDelete($delid);
            header("Location: dashboard_admin.php?pg=pitchManage");
            exit();
        }

    if (isset($_POST['add'])) {
        $tenSanBong = $_POST['tenSanBong'];
        $hinhAnh = trim($_POST['image']);
        $idResult = getID($tenSanBong);

    if ($idResult !== false && $idResult->num_rows > 0) {
        $idRow = $idResult->fetch_assoc();
        $id = $idRow['id']; 

        if (ThemAnh($hinhAnh, $id)) {
            echo "<script type='text/javascript'>alert('Đã thêm hình ảnh thành công.');location.replace('dashboard_admin.php?pg=pitchManage');</script>";
            exit();
        }
    } else {
        echo "<script type='text/javascript'>alert('Không tìm thấy sân bóng.');</script>";
    }
}

       }
    ?>

        <script type="text/javascript">
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa sân bóng này?');
        }
        </script>

    </body>

</html>