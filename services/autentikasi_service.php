<?php
require_once "./db_conn.php";
require_once "./config.php";

session_start();

function loginService(string $username, string $password, &$errors)
{
    $stmt = DBH->prepare("
        SELECT username
        FROM users
        WHERE username=:username
    ");

    $stmt->execute([":username" => $username]);
    $user = $stmt->fetchColumn();

    if (!$user) {
        $errors["username"][] = "Username tidak ditemukan";
        return;
    }

    $userPassword = $user["password"];

    if (!password_verify($password, $userPassword)) {
        $errors["password"][] = "Password anda salah!";
        return;
    }

    $_SESSION["username"] = $user["username"];
    $_SESSION["role"] = $user["role"];

    if ($user["role"] == "admin") {
        header("location: " . BASE_URL . "/admin/index.php");
    } else {
        header("location: " . BASE_URL . "/index.php");
    }
}
