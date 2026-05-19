<?php
session_start();
include "koneksi.php";

// SIMPAN
if(isset($_POST['simpan'])){
    $kode  = $_POST['kode'];
    $nama  = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $tipe  = $_POST['tipe'];

    mysqli_query($conn,"INSERT INTO kriteria 
        (kode_kriteria, nama_kriteria, bobot, tipe) 
        VALUES ('$kode','$nama','$bobot','$tipe')");

    header("Location: kriteria.php");
    exit;

}

// EDIT
$edit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $query = mysqli_query($conn,"SELECT * FROM kriteria WHERE id_kriteria='$id'");
    $edit = mysqli_fetch_assoc($query);
}

// UPDATE
if(isset($_POST['update'])){
    $id    = $_POST['id'];
    $kode  = $_POST['kode'];
    $nama  = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $tipe  = $_POST['tipe'];

    mysqli_query($conn,"UPDATE kriteria SET
        kode_kriteria='$kode',
        nama_kriteria='$nama',
        bobot='$bobot',
        tipe='$tipe'
        WHERE id_kriteria='$id'");

    header("Location: kriteria.php");
    exit;
}


// HAPUS
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn,"DELETE FROM kriteria WHERE id_kriteria='$id'");
    header("Location: kriteria.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Kriteria</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
<h3>Data Kriteria</h3>

<div class="card mb-4">
<div class="card-body">


<form method="POST" class="row g-3">

<?php if($edit){ ?>
<input type="hidden" name="id" value="<?= $edit['id_kriteria']; ?>">
<?php } ?>

<div class="col-md-2">
<input type="text" name="kode" class="form-control"
value="<?= $edit ? $edit['kode_kriteria'] : '' ?>"
placeholder="Kode (C1)" required>
</div>

<div class="col-md-4">
<input type="text" name="nama" class="form-control"
value="<?= $edit ? $edit['nama_kriteria'] : '' ?>"
placeholder="Nama Kriteria" required>
</div>

<div class="col-md-3">
<input type="number" step="0.01" name="bobot" class="form-control"
value="<?= $edit ? $edit['bobot'] : '' ?>"
placeholder="Bobot" required>
</div>

<!-- ⬇⬇ TAMBAHKAN DI SINI ⬇⬇ -->
<div class="col-md-3">
<select name="tipe" class="form-control" required>
<option value="benefit"
<?= ($edit && $edit['tipe']=='benefit')?'selected':'' ?>>
Benefit
</option>

<option value="cost"
<?= ($edit && $edit['tipe']=='cost')?'selected':'' ?>>
Cost
</option>
</select>
</div>
<!-- ⬆⬆ SAMPAI SINI ⬆⬆ -->

<div class="col-md-3">
<?php if($edit){ ?>
<button type="submit" name="update" class="btn btn-warning w-100">Update</button>
<?php } else { ?>
<button type="submit" name="simpan" class="btn btn-success w-100">Simpan</button>
<?php } ?>
</div>

</form>



</form>
</div>
</div>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>No</th>
<th>Kode</th>
<th>Nama Kriteria</th>
<th>Bobot</th>
<th>Tipe</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php
$no=1;
$data = mysqli_query($conn,"SELECT * FROM kriteria");
while($d=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $no++; ?></td>
<td><?= $d['kode_kriteria']; ?></td>
<td><?= $d['nama_kriteria']; ?></td>
<td><?= $d['bobot']; ?></td>
<td><?= $d['tipe']; ?></td>
<td>
<a href="?edit=<?= $d['id_kriteria']; ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?hapus=<?= $d['id_kriteria']; ?>" 
onclick="return confirm('Yakin hapus?')" 
class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php } ?>

</tbody>
</table>

<div class="mt-3">
    <button onclick="history.back()" class="btn btn-secondary">
        ← Kembali
    </button>
</div>

</div>
</body>
</html>
