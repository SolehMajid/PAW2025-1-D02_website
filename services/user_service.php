<?php
require_once __DIR__ . '/../db_conn.php';

/**
 * Fungsi untuk menambahkan user baru
 * 
 * Fungsi ini tidak memiliki pengecekan duplikasi username dan email,
 * karena hal tersebut sudah dilakukan di validasi yang terpisah
 * 
 * @param array $data - Data yang telah tervalidasi
 * @param string $role - Data yang telah tervalidasi
 */
function addUserService(array $data, string $role = "calon_siswa")
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "INSERT INTO
            $table (username, email, password)
        VALUES
            (:username, :email, :password)"
    );

    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":password" => htmlspecialchars($data["password"]),
    ]);
}

/**
 * Fungsi untuk mendapatkan semua data pengguna
 * 
 * Fungsi ini dilengkapi dengan fitur filter berdasarkan username
 * dan rolenya.
 * 
 * @param string $role - Role dari pengguna (Admin/Calon Siswa)
 * @param string $username - Username dari pengguna
 */
function getUsersService(string $role = "", string $username = "")
{
    $stmt = DBH->prepare(
        "SELECT user.* FROM
        (
            SELECT
                id_admin id_user,
                username,
                email,
                password,
                'admin' role
            FROM
                admin
            UNION ALL
            SELECT
                id_calon_siswa id_user,
                username,
                email,
                password,
                'calon_siswa' role
            FROM
                calon_siswa
        ) user
        WHERE
            user.role LIKE :role
        AND
            user.username LIKE :username"
    );

    $stmt->execute([
        ":role" => $role ? $role : "%%",
        ":username" => "%$username%"
    ]);

    return $stmt->fetchAll();
}

/**
 * Fungsi untuk mendapatkan data pengguna secara spesifik
 * berdasarkan ID-nya
 * 
 * @param int $userId - ID dari pengguna
 * @param string $role - Role dari pengguna (Admin/Calon Siswa)
 */
function getUserByID(int $userId, string $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "SELECT
            id_$role id_user,
            username,
            email,
            password,
            '$role' role
        FROM
            $table
        WHERE
            id_$table = :id_user"
    );

    $stmt->execute([":id_user" => $userId]);
    return $stmt->fetch();
}

/**
 * Fungsi yang digunakan untuk memperbarui data pengguna
 * 
 * @param array $data - Data yang telah tervalidasi
 * @param string $role - Role dari data yang akan disunting (Admin/Calon Siswa)
 * @param int $userId - ID pengguna yang akan disunting
 */
function updateUserService(array $data, string $role, int $userId)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "UPDATE
            $table
        SET
            username = :username,
            email = :email
        WHERE
            id_$table = :id_user"
    );

    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":id_user" => $userId
    ]);
}

/**
 * Fungsi untuk memperbarui password milik pengguna
 * 
 * @param string $password - Password baru
 * @param int $userId - ID pengguna yang passwordnya akan diperbarui
 * @param string $role - Role dari pengguna yang passwordnya akan diperbarui
 */
function updateUserPasswordService(string $password, int $userId, string $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";
    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $stmt = DBH->prepare(
        "UPDATE
            $table
        SET
            password = :password
        WHERE id_$table = :id_user"
    );

    $stmt->execute([
        ":password" => htmlspecialchars($hashed),
        ":user_id" => $userId
    ]);
}

/**
 * Fungsi untuk menghapus data pengguna
 * 
 * @param int $userId - ID dari data pengguna yang akan dihapus
 * @param string $role - Role dari data pengguna yang akan dihapus
 */
function deleteUserService(int $userId, string $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "DELETE FROM
            $table
        WHERE
            id_$table = :id_user"
    );

    $stmt->execute([
        ":id_user" => $userId
    ]);
}

/**
 * Fungsi untuk mendapatkan jumlah data pengguna
 */
function getUserCountService()
{
    $stmt = DBH->prepare(
        "SELECT
            *,
            a.total_admin + c.total_calon_siswa total_user
        FROM
        (
            SELECT count(id_admin) total_admin FROM admin
        ) a
        JOIN
        (
            SELECT count(id_calon_siswa) total_calon_siswa FROM calon_siswa
        ) c"
    );

    $stmt->execute();
    return $stmt->fetch();
}
