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
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand">SPK SMART - Holland Bakery</a>
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
<div class="card shadow">
<div class="card-body text-center">
<h4>Sistem Pendukung Keputusan</h4>
<p>Evaluasi Kepuasan Pelanggan Menggunakan Metode SMART</p>
<p>Studi Kasus: Holland Bakery Kelapa 2 Depok</p>
</div>
</div>
</div>

</div>
</body>
</html>
