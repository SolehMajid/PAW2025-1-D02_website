<?php
require_once __DIR__ . '/../db_conn.php';

// fungsi untuk menambahkan pengguna
function addUserService(array $data, $role = "calon_siswa")
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "INSERT INTO $table (username, email, password)
        VALUES (:username, :email, :password)"
    );

    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":password" => htmlspecialchars($data["password"]),
    ]);
}

// fungsi untuk mendapatkan semua data pengguna (dilengkapi dengan filter nama & role)
function getUsersService($username = "", $role = "")
{
    $stmt = DBH->prepare(
        "SELECT user.* FROM (
            SELECT *, 'admin' role FROM admin
            UNION ALL
            SELECT *, 'calon_siswa' role FROM calon_siswa
        ) user WHERE role LIKE :role AND user.username LIKE :username"
    );

    $stmt->execute([
        ":role" => $role ?? "%%",
        ":username" => "%$username%"
    ]);

    return $stmt->fetchAll();
}

// fungsi untuk mendapatkan detail data pengguna berdasarkan ID-nya
function getUserByID(int $idUser, $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "SELECT * FROM $table WHERE id_user = :id_user"
    );

    $stmt->execute([":id_user" => $idUser]);
    return $stmt->fetch();
}

// fungsi untuk memperbarui data pengguna berdasarkan ID-nya
function updateUserService(array $data, $role, int $idUser)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "UPDATE $table
        SET username = :username, email = :email, role = :role
        WHERE id_user = :id_user"
    );

    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":role" => htmlspecialchars($data["role"]),
        ":id_user" => $idUser
    ]);
}

// fungsi untuk menghapus data pengguna berdasarkan ID-nya
function deleteUserService(int $idUser, $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "DELETE FROM $table WHERE id_user = :id_user"
    );

    $stmt->execute([
        ":id_user" => $idUser
    ]);
}
