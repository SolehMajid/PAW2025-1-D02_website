<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../services/jurusan_service.php";
require_once __DIR__ . "/../services/user_service.php";
require_once __DIR__ . "/../services/form_pendaftaran_service.php";

/**
 * - Mendapatkan jumlah jurusan
 * - Mendapatkan jumlah pengguna (termasuk jumlah admin & calon siswa)
 * - Mendapatkan jumlah form pendaftaran
 */
$jumlahJurusan = jumlahJurusanService();
$jumlahUser = getUserCountService();
$jumlahFormPendaftaran = jumlahPendaftarService();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Menampilkan konfigurasi head -->
    <?php include_once __DIR__ . "/../components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include __DIR__ . "/../components/layouts/navbar.php" ?>

    <div class="container" id="dashboard">
        <div class="title">
            Dashboard
        </div>

        <hr class="divider">

        <!-- Menampilkan statistik sederhana -->
        <div class="stats-container">
            <!-- Menampilkan jumlah pengguna -->
            <div class="stat" id="total-user">
                <div class="title">
                    Jumlah Pengguna
                </div>

                <hr class="divider">

                <p>
                    <?= $jumlahUser["total_user"] ?>
                </p>
            </div>

            <!-- Menampilkan jumlah pengguna dengan role admin -->
            <div class="stat" id="total-admin">
                <div class="title">
                    Jumlah Admin
                </div>

                <hr class="divider">

                <p>
                    <?= $jumlahUser["total_admin"] ?>
                </p>
            </div>

            <!-- Menampilkan jumlah pengguna dengan role calon siswa -->
            <div class="stat" id="total-calon-siswa">
                <div class="title">
                    Jumlah Calon Siswa
                </div>

                <hr class="divider">

                <p>
                    <?= $jumlahUser["total_calon_siswa"] ?>
                </p>
            </div>

            <!-- Menampilkan jumlah form pendaftaran -->
            <div class="stat" id="total-form-pendaftaran">
                <div class="title">
                    Jumlah Form Pendaftaran
                </div>

                <hr class="divider">

                <p>
                    <?= $jumlahFormPendaftaran ?>
                </p>
            </div>

            <!-- Menampilkan jumlah jurusan -->
            <div class="stat" id="total-jurusan">
                <div class="title">
                    Jumlah Jurusan
                </div>

                <hr class="divider">

                <p>
                    <?= $jumlahJurusan ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../components/layouts/footer.php" ?>
</body>

</html>