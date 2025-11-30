<?php
require_once __DIR__ . "/../db_conn.php";

/**
 * Fungsi untuk menambah data ke tabel program
 * 
 * @param array $data - Data yang telah tervalidasi
 */
function tambahProgramService(array $data)
{
    $stmt = DBH->prepare(
        "INSERT INTO
            program (nama_program, deskripsi_program)
        VALUES
            (:nama_program, :deskripsi_program)"
    );

    $stmt->execute([
        ":nama_program" => htmlspecialchars($data["nama-program"]),
        ":deskripsi_program" => htmlspecialchars($data["deskripsi-program"])
    ]);
}

/**
 * Fungsi untuk menampilkan semua data di dalam tabel program
 * 
 * Fungsi ini dilengkapi dengan filter untuk melakukan pencarian
 * bedasarkan nama program
 * 
 * @param string $namaProgram - Nama program yang akan dicari
 */
function daftarProgramService(string $namaProgram = "")
{
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            program
        WHERE
            nama_program LIKE :nama_program"
    );

    $stmt->execute([":nama_program" => "%$namaProgram%"]);

    return $stmt->fetchAll();
}

/**
 * Fungsi untuk menampilkan data spesifik di dalam tabel program
 * bedasarkan ID-nya
 * 
 * @param int $id - ID dari data di tabel program
 */
function detailProgramService(int $id)
{
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            program
        WHERE
            id_program = :id_program"
    );

    $stmt->execute([":id_program" => $id]);

    return $stmt->fetch();
}

/**
 * Fungsi untuk menyunting data spesifik di dalam tabel program
 * berdasarkan ID-nya
 * 
 * @param int $id - ID dari data di tabel program
 * @param array $data - Data yang telah tervalidasi
 */
function suntingProgramService(int $id, array $data)
{
    $stmt = DBH->prepare(
        "UPDATE
            program
        SET
            nama_program = :nama_program,
            deskripsi_program = :deskripsi_program
        WHERE
            id_program = :id_program"
    );

    $stmt->execute([
        ":nama_program" => htmlspecialchars($data["nama-program"]),
        ":deskripsi_program" => htmlspecialchars($data["deskripsi-program"]),
        ":id_program" => $id
    ]);
}

/**
 * Fungsi untuk menyunting data spesifik di dalam tabel program
 * berdasarkan ID-nya
 * 
 * @param int $id - ID dari data di tabel program
 */
function hapusProgramService(int $id)
{
    $stmt = DBH->prepare(
        "DELETE FROM program WHERE id_program = :id_program"
    );

    $stmt->execute([":id_program" => $id]);
}

/**
 * Fungsi untuk mendapatkan jumlah data yang terdapat pada tabel program
 */
function jumlahProgramService()
{
    $stmt = DBH->prepare(
        "SELECT * FROM program"
    );

    $stmt->execute();

    return $stmt->rowCount();
}
