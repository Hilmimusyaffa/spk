<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard SPK SMART</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: url('logo_holland_2.png') no-repeat center center fixed;
        background-size: 1500px 750px;
        background-color: #f8f9fa;
    }

    .overlay {
        background: rgba(255,255,255,0.85);
        min-height: 100vh;
    }

    /* Navbar lebih halus */
    .navbar{
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    /* Box judul */
    .judul-box {
        background: rgba(255, 255, 255, 0.35);
        padding: 20px 30px;
        border-radius: 25px;
        display: inline-block;
        backdrop-filter: blur(8px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    /* Card menu */
    .card{
        border: none !important;
        border-radius: 25px !important;
        overflow: hidden;
        transition: 0.3s;
    }

    .card:hover{
        transform: translateY(-5px);
    }

    .card-body{
        padding: 30px 20px;
    }

    /* Tombol */
    .btn{
        border-radius: 50px !important;
        padding: 8px 25px;
        font-weight: 600;
    }

    /* Card transparan */
    .transparan-card {
        background: rgba(255, 255, 255, 0.35) !important;
        border-radius: 25px;
        backdrop-filter: blur(8px);
    }

    h5{
        margin-bottom: 15px;
        font-weight: bold;
    }
    .creator {
    position: fixed;
    bottom: 10px;
    right: 15px;
    font-size: 12px;
    color: #555;
    background: rgba(255,255,255,0.5);
    padding: 4px 10px;
    border-radius: 15px;
    backdrop-filter: blur(5px);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="logo_holland_1.png" width="100" class="me-2">
            SPK SMART - Holland Bakery
        </a>

        <div>
            <span class="text-white me-3">
                Halo, <?= $_SESSION['username']; ?>
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">

    <div class="row justify-content-center">

        <!-- DATA KRITERIA -->
        <div class="col-md-4">
            <div class="card shadow bg-primary text-white">
                <div class="card-body text-center">
                    <h5>Data Kriteria</h5>
                    <a href="kriteria.php" class="btn btn-dark btn-sm">Kelola</a>
                </div>
            </div>
        </div>

        <!-- INPUT KUESIONER -->
        <div class="col-md-4">
            <div class="card shadow bg-success text-white">
                <div class="card-body text-center">
                    <h5>Input Kuesioner</h5>
                    <a href="responden.php" class="btn btn-dark btn-sm">Isi Data</a>
                </div>
            </div>
        </div>

        <!-- HASIL -->
        <div class="col-md-4">
            <div class="card shadow bg-warning text-dark">
                <div class="card-body text-center">
                    <h5>Hasil Evaluasi</h5>
                    <a href="hasil.php" class="btn btn-dark btn-sm">Lihat Hasil</a>
                </div>
            </div>
        </div>

    </div>

    <!-- INFO -->
    <div class="mt-5">
    
            <div class="card-body text-center">

                <div class="judul-box">
                    <h4>Sistem Pendukung Keputusan</h4>
                    <p>Evaluasi Kepuasan Pelanggan Menggunakan Metode SMART</p>
                    <p>Studi Kasus: Holland Bakery Kelapa 2 Depok</p>
                </div>

            </div>
        </div>
    </div>

</div>
    </div>

</div>

<div class="creator">
    Created by Muhammad Hilmi Musyaffa
    
</div>

</body>
</html>
</body>
</html>
