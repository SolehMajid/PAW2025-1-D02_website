<?php
require_once __DIR__ . "/../../auth_middleware/after_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";

$jurusan = getJurusanService();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
</head>

<body>
    <?php include __DIR__ . "/../../components/layouts/sidebar.php" ?>

    <div class="container">

    </div>

    <?php include __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>