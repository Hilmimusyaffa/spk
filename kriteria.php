<?php
include "koneksi.php";
include "header.php";

if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO kriteria VALUES(
        '',
        '$_POST[kode]',
        '$_POST[nama]',
        '$_POST[bobot]'
    )");
}
?>

<div class="card shadow">
<div class="card-header bg-success text-white">
    <h5>Data Kriteria</h5>
</div>
<div class="card-body">

<form method="POST" class="row g-3">
    <div class="col-md-2">
        <input type="text" name="kode" class="form-control" placeholder="Kode (C1)" required>
    </div>
    <div class="col-md-4">
        <input type="text" name="nama" class="form-control" placeholder="Nama Kriteria" required>
    </div>
    <div class="col-md-3">
        <input type="number" step="0.01" name="bobot" class="form-control" placeholder="Bobot" required>
    </div>
    <div class="col-md-3">
        <button class="btn btn-success w-100" name="simpan">Simpan</button>
    </div>
</form>

<hr>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Kriteria</th>
            <th>Bobot</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no=1;
        $data=mysqli_query($conn,"SELECT * FROM kriteria");
        while($d=mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['kode_kriteria']; ?></td>
            <td><?= $d['nama_kriteria']; ?></td>
            <td><?= $d['bobot']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</div>

<?php include "footer.php"; ?>
