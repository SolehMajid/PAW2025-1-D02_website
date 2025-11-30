<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

$id = $_GET["id"];
$program = detailProgramService($id);

if (!$program) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

hapusProgramService($id);
header("Location: " . BASE_URL . "admin/program");
exit();
