<?php
require_once __DIR__ . '/../db_conn.php';

// fungsi untuk menambahkan pengguna
function addUserService(array $data)
{
    $stmt = DBH->prepare(
        "INSERT INTO users (username, email, password, role)
        VALUES (:username, :email, :password, :role"
    );

    $stmt->execute([
        ":username" => $data["username"],
        ":email" => $data["email"],
        ":password" => $data["password"],
        ":role" => $data["role"]
    ]);
}

// fungsi untuk mendapatkan semua data pengguna
function getUsersService()
{
    $stmt = DBH->prepare(
        "SELECT * FROM users"
    );

    $stmt->execute();

    return $stmt->fetchAll();
}

// fungsi untuk mendapatkan detail data pengguna berdasarkan ID-nya
function getUserByID(int $idUser)
{
    $stmt = DBH->prepare(
        "SELECT *
        FROM users
        WHERE id_user=:id_user"
    );

    $stmt->execute([
        ":id_user" => $idUser
    ]);

    return $stmt->fetch();
}

// fungsi untuk memperbarui data pengguna berdasarkan ID-nya
function updateUserService(array $data, int $idUser)
{
    $stmt = DBH->prepare(
        "UPDATE users
        SET username=:username, email=:email, role=:role
        WHERE id_user=:id_user"
    );

    $stmt->execute([
        ":username" => $data["username"],
        ":email" => $data["email"],
        ":role" => $data["role"],
        ":id_user" => $idUser
    ]);
}

// fungsi untuk menghapus data pengguna berdasarkan ID-nya
function deleteUserService(int $idUser)
{
    $stmt = DBH->prepare(
        "DELETE FROM users WHERE id_user=:id_user"
    );

    $stmt->execute([
        ":id_user" => $idUser
    ]);
}
