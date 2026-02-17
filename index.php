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

/* TAMBAHKAN DI SINI */
.judul-box {
    background: rgba(255, 255, 255, 0.4);
    padding: 15px;
    border-radius: 10px;
    display: inline-block;
}

</style>

</head>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand d-flex align-items-center" href="#">
    <img src="logo_holland_1.png" width="100"
class="me-2"
style="background: none; border: none;">


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

<div class="container mt-4">

<div class="row">

<div class="col-md-4">
<div class="card shadow bg-primary text-white">
<div class="card-body text-center">
<h5>Data Kriteria</h5>
<a href="kriteria.php" class="btn btn-light btn-sm">Kelola</a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow bg-success text-white">
<div class="card-body text-center">
<h5>Input Kuesioner</h5>
<a href="responden.php" class="btn btn-light btn-sm">Isi Data</a>

</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow bg-warning text-dark">
<div class="card-body text-center">
<h5>Hasil Evaluasi</h5>
<a href="hasil.php" class="btn btn-dark btn-sm">Lihat Hasil</a>
</div>
</div>
</div>

</div>

<div class="mt-5">
<div class="card shadow card-transparan">
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
</body>
</html>
