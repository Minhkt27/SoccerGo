<?php
include 'header_admin.php';
session_start();
require_once __DIR__ . '/../BLL/promotionService.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$promotion = new PromotionService();
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $promo = $promotion->getone($id);
} else {
    echo "No promotion ID provided.";
    exit();
}

if (!$promo) {
    echo "Promotion not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Promotion</title>
    <link rel="stylesheet" href="css/userEdit.css?v=<?php echo time(); ?>">
</head>

<body>
    <h2>Edit Promotion</h2>
    <div class="container">
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="makm" value="<?php echo htmlspecialchars($promo->makm); ?>">


                <div class="form-group">
                    <label for="muckm">Mức Khuyến Mại</label><br>
                    <input type="text" class="form-control" id="muckm" name="muckm"
                        value="<?php echo htmlspecialchars($promo->muckm); ?>">
                </div>
                <div class="form-group">
                    <label for="soluong">số lượng</label><br>
                    <input type="text" class="form-control" id="soluong" name="soluong"
                        value="<?php echo htmlspecialchars($promo->soluong); ?>">
                </div>
                <button type="submit" class="btn">Update</button>
            </form>

        </div>
    </div>
</body>

</html>

<?php
include 'footer.php';
?>