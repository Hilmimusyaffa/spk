<?php
session_start();
include "koneksi.php";

// SIMPAN
if(isset($_POST['simpan'])){

    $kode  = $_POST['kode'];
    $nama  = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $tipe  = $_POST['tipe'];

    // VALIDASI BOBOT
    if($bobot < 1 || $bobot > 100){

        echo "<script>
                alert('Bobot harus 1 - 100 %');
              </script>";

    } else {

        mysqli_query($conn,"INSERT INTO kriteria
            (kode_kriteria, nama_kriteria, bobot, tipe)
            VALUES
            ('$kode','$nama','$bobot','$tipe')");

        header("Location: kriteria.php");
        exit;
    }
}

// EDIT
$edit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $query = mysqli_query($conn,
        "SELECT * FROM kriteria
        WHERE id_kriteria='$id'");

    $edit = mysqli_fetch_assoc($query);
}

// UPDATE
if(isset($_POST['update'])){

    $id    = $_POST['id'];
    $kode  = $_POST['kode'];
    $nama  = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $tipe  = $_POST['tipe'];

    // VALIDASI BOBOT
    if($bobot < 1 || $bobot > 100){

        echo "<script>
                alert('Bobot harus 1 - 100 %');
              </script>";

    } else {

        mysqli_query($conn,"UPDATE kriteria SET
            kode_kriteria='$kode',
            nama_kriteria='$nama',
            bobot='$bobot',
            tipe='$tipe'
            WHERE id_kriteria='$id'");

        header("Location: kriteria.php");
        exit;
    }
}

// HAPUS
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,
        "DELETE FROM kriteria
        WHERE id_kriteria='$id'");

    header("Location: kriteria.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Data Kriteria</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: #f4f6f9;
}

.card{
    border-radius: 15px;
}

.table{
    background: white;
}

.btn{
    border-radius: 10px;
}

.form-control,
.form-select{
    border-radius: 10px;
}

</style>

</head>
<body>

<div class="container mt-4">

<h3 class="mb-4 fw-bold">
Data Kriteria
</h3>

<!-- FORM -->
<div class="card shadow mb-4">

<div class="card-body">

<form method="POST" class="row g-3">

<?php if($edit){ ?>

<input type="hidden"
name="id"
value="<?= $edit['id_kriteria']; ?>">

<?php } ?>

<!-- KODE -->
<div class="col-md-2">

<input type="text"
name="kode"
class="form-control"

value="<?= $edit ? $edit['kode_kriteria'] : ''; ?>"

placeholder="Kode (C1)"
required>

</div>

<!-- NAMA -->
<div class="col-md-4">

<input type="text"
name="nama"
class="form-control"

value="<?= $edit ? $edit['nama_kriteria'] : ''; ?>"

placeholder="Nama Kriteria"
required>

</div>

<!-- BOBOT -->
<div class="col-md-3">

<div class="input-group">

<input type="number"
name="bobot"
class="form-control"

value="<?= $edit ? $edit['bobot'] : ''; ?>"

placeholder="Bobot"
min="1"
max="100"
required>

<span class="input-group-text">%</span>

</div>

<small class="text-muted">

</small>

</div>

<!-- TIPE -->
<div class="col-md-3">

<select name="tipe"
class="form-select"
required>

<option value="">-- Pilih Tipe --</option>

<option value="benefit"
<?= ($edit && $edit['tipe']=='benefit') ? 'selected' : ''; ?>>

Benefit

</option>

<option value="cost"
<?= ($edit && $edit['tipe']=='cost') ? 'selected' : ''; ?>>

Cost

</option>

</select>

<small class="text-muted">

</small>

</div>

<!-- BUTTON -->
<div class="col-12 text-end">

<?php if($edit){ ?>

<button type="submit"
name="update"
class="btn btn-warning px-4">

Update

</button>

<?php } else { ?>

<button type="submit"
name="simpan"
class="btn btn-success px-4">

Simpan

</button>

<?php } ?>

</div>

</form>

</div>
</div>

<!-- TABEL -->
<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-striped align-middle">

<thead class="table-dark">

<tr>

<th>No</th>
<th>Kode</th>
<th>Nama Kriteria</th>
<th>Bobot</th>
<th>Tipe</th>
<th width="170">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

$data = mysqli_query($conn,
    "SELECT * FROM kriteria");

while($d = mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['kode_kriteria']; ?></td>

<td><?= $d['nama_kriteria']; ?></td>

<td><?= $d['bobot']; ?> %</td>

<td>

<?php
if($d['tipe'] == 'benefit'){
?>

<span class="badge bg-success">
Benefit
</span>

<?php
}else{
?>

<span class="badge bg-danger">
Cost
</span>

<?php } ?>

</td>

<td>

<a href="?edit=<?= $d['id_kriteria']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="?hapus=<?= $d['id_kriteria']; ?>"

onclick="return confirm('Yakin hapus data?')"

class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
</div>

<!-- BUTTON DASHBOARD -->
<div class="mt-3">

<a href="index.php"
class="btn btn-primary">

← Ke Dashboard

</a>

</div>

</div>

</body>
</html>