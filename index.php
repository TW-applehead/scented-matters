<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/category.css" rel="stylesheet">
    <title>Scented Matters</title>
</head>
<body>
    <header>
        <div class="img-container mx-auto">
            <img src="images/icons/logo.jpeg" />
        </div>
    </header>
    <div class="container">
        <?php include('candle_categories.php'); ?>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.category-button').on('click', function() {
            $.ajax({
                url: "candles.php",
                type: 'GET',
                data: {
                    category: $(this).data('category'),
                    category_zh: $(this).data('category-zh'),
                },
                success: function(response) {
                    $('.container').html(response);
                },
                error: function(errors) {
                    console.error(errors);
                }
            });
        });
    });
</script>
</html>
