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

$sql = "SELECT * FROM candles WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_REQUEST['category_id']);
$stmt->execute();
$result = $stmt->get_result();
$candles = [];
while ($row = $result->fetch_assoc()) {
    $candles[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/product_list.css" rel="stylesheet">
    <title>Scented Matters</title>
</head>
<body>
    <header>
        <div class="img-container mx-auto">
            <img src="images/icons/logo.jpeg" />
        </div>
    </header>
    <div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="index.php">分類</a>
        <span class="breadcrumb-item active"><?php echo '造型蠟燭'; ?></span>
    </nav>
    <div id="product-list" class="row">
    <?php foreach ($candles as $candle): ?>
    <div class="col-6 col-lg-4 mb-3">
        <button class="product-button">
            <div class="img-container">
                <img src="images/creative_candles/<?php echo $candle['image']; ?>">
            </div>
            <div class="info-container">
                <p><?php echo $candle['name']; ?></p><p class="price"><?php echo $candle['price']; ?></p>
            </div>
            <div class="info-window">
                <img src="images/creative_candles/oreo.jpg">
            </div>
        </button>
    </div>
    <?php endforeach; ?>
    </div>
        <div class="my-5 text-end">
            <button onclick="history.back();">回上一頁</button>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $(".product-button").on("click", function() {
            $(this).find(".info-window").toggle();
        });
        $(".info-window").on("click", function() {
            $(this).find(".info-window").hide();
        });
    });
</script>
</html>