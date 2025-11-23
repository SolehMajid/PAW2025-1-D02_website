<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/auth_middleware/before_login_middleware.php";

$isEdit = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/profil.css" ?>">
</head>

<body>
    <?php if ($_SESSION["role"] == "user") ?>
    <?php include_once __DIR__ . "/components/layouts/navbar.php" ?>

    <div class="container">
        <form id="profile-section" method="post" action="profil.php">
            <h1>
                Profil Pengguna
            </h1>

            <div class="buttons-container">
                <button type="submit" class="btn btn-info" name="profile-edit" value="profile-edit">
                    Sunting Profil
                </button>

                <button type="submit" class="btn btn-error" name="profile-edit" value="profile-logout">
                    Logout
                </button>
            </div>

            <hr class="divider">

            <!--  -->
        </form>
    </div>

    <?php include_once __DIR__ . "/components/layouts/footer.php" ?>
</body>

</html>