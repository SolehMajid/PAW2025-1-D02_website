<?php
require_once __DIR__ . "/auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/config.php";

unset($_SESSION["username"]);
unset($_SESSION["user_id"]);
unset($_SESSION["role"]);

header(BASE_URL . "index.php");
