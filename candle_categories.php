<?php
$config = include_once('config.php');
require 'modules/functions.php';

if (!checkUserIP($config)) {
    die($config['NOT_ALLOWED_TEXT']);
}

// 創建連接
$conn = connectDB($config);
if ($conn === false) {
    die("資料庫連接失敗");
}

// 檢查是否已有該時間的餘額紀錄
$check_sql = "SELECT * FROM candle_categories";
$stmt = $conn->prepare($check_sql);
$stmt->execute();
$result = $stmt->get_result();
$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

$stmt->close();
$conn->close();
?>

<nav class="breadcrumb">
    <span class="breadcrumb-item active">分類</span>
</nav>
<div id="category" class="row">
    <?php foreach ($categories as $category): ?>
        <div class="col-6 col-lg-4 mb-3">
            <a href="category.php?category_id=<?php echo $category['id']; ?>">
                <div class="img-container">
                    <img src="images/<?php echo $category['name_en'] . '_candles/' . $category['image']; ?>">
                </div>
                <div class="info-container">
                    <p><?php echo $category['name']; ?></p>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

