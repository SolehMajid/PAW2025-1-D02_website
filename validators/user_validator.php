<?php
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/base_validator.php";

/**
 * Fungsi untuk memvalidasi username dari pengguna.
 * 
 * Fungsi ini juga melihat ke dalam database untuk mengecek apakah username
 * telah digunakan/terdaftar atau belum.
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateUsername(string $field, array &$errors)
{
    $regex = "/^[A-Za-z1-9_]+$/";

    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }

    if (!preg_match($regex, $field)) {
        $errors["username"][] = "Username hanya boleh mengandung huruf, angka (0-9), dan karakter garis bawah (_)";
    }

    if (strlen($field) < 3) {
        $errors["username"][] = "Panjang minimal username adalah 3 (tiga) karakter";
    }

    if (strlen($field) > 20) {
        $errors["username"][] = "Panjang maksimal username adalah 20 (dua puluh) karakter";
    }

    // mengecek apakah terdapat duplikasi username di database
    $stmt = DBH->prepare(
        "SELECT username FROM admin WHERE username=:username"
    );

    $stmt->execute([":username" => $field]);
    $usernameCount = $stmt->rowCount();

    $stmt = DBH->prepare(
        "SELECT username FROM calon_siswa WHERE username=:username"
    );

    $stmt->execute([":username" => $field]);
    $usernameCount += $stmt->rowCount();

    if ($usernameCount) {
        $errors["username"][] = "Username yang anda masukkan telah terdaftar";
    }
}


/**
 * Fungsi untuk memvalidasi email dari pengguna.
 * 
 * Fungsi ini juga melihat ke dalam database untuk mengecek apakah
 * email sudah terdaftar atau belum.
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateEmail(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["email"][] = "Email tidak boleh kosong";
    }

    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        $errors["email"][] = "Email yang dimasukkan tidak valid";
    }

    // mengecek apakah terdapat duplikasi email di database
    $stmt = DBH->prepare(
        "SELECT email FROM admin WHERE email=:email"
    );

    $stmt->execute([":email" => $field]);
    $emailCount = $stmt->rowCount();

    $stmt = DBH->prepare(
        "SELECT email FROM calon_siswa WHERE email=:email"
    );

    $stmt->execute([":email" => $field]);
    $emailCount += $stmt->rowCount();

    if ($emailCount) {
        $errors["email"][] = "Email yang anda masukkan telah terdaftar";
    }
}

/**
 * Fungsi untuk memvalidasi password dari pengguna.
 * 
 * Agar diterima oleh sistem, validasi ini memiliki beberapa kriteria:
 * - Tidak boleh kosong
 * - Panjang minimal adalah 8 karakter
 * - Mengandung huruf besar (setidaknya satu karakter)
 * - Mengandung huruf kecil (setidaknya satu karakter)
 * - Mengandung angka (setidaknya satu karakter)
 * - Mengandung karakter spesial ['_', '\', '-', '@', ' '] (setidaknya satu karakter)
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validatePassword(string $field, array &$errors)
{
    $reUpperLetter = "/[A-Z]+/";
    $reLowerLetter = "/[a-z]+/";
    $reNumberChar = "/[0-9]+/";
    $reSpecialChar = "/[_\-@ ]+/";

    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password tidak boleh kosong";
    }

    if (strlen($field) < 8) {
        $errors["password"][] = "Panjang minimal password adalah 8 karakter";
    }

    if (!preg_match_all($reUpperLetter, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) huruf kapital (A-Z)";
    }

    if (!preg_match_all($reLowerLetter, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) huruf kecil (a-z)";
    }

    if (!preg_match_all($reNumberChar, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) karakter angka (0-9)";
    }

    if (!preg_match_all($reSpecialChar, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya salah satu karakter ini: ('_', '-', '@', ' ')";
    }
}


/**
 * Fungsi untuk memvalidasi field konfirmasi password
 * 
 * @param string $field - Data yang akan divalidasi
 * @param string $password - Nilai dari field password
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateKonfirmasiPassword(string $field, string $password, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["konfirmasi-password"][] = "Konfirmasi password tidak boleh kosong";
    }

    if ($field != $password) {
        $errors["konfirmasi-password"][] = "Password konfirmasi tidak sama dengan password utama";
    }
}


/**
 * Fungsi untuk memvalidasi role pengguna
 * Pengguna disini hanya memiliki 2 tipe role, yaitu 'admin', dan 'calon_siswa'
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateRole(string $field, &$errors)
{
    $roleValue = ["admin", "calon_siswa"];

    if (cekFieldKosong($field)) {
        $errors["role"][] = "Role tidak boleh kosong";
    }

    if (!in_array($field, $roleValue)) {
        $errors["role"][] = "Role yang anda masukkan tidaklah valid!";
    }
}

/**
 * Fungsi untuk memvalidasi username (digunakan di halaman login)
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateLoginUsername(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }
}

/**
 * Fungsi untuk memvalidasi password (digunakan di halaman login)
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateLoginPassword(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password tidak boleh kosong";
    }
}
