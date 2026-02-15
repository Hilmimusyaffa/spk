<?php
include "koneksi.php";
include "header.php";

if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO responden VALUES(
        '',
        '$_POST[nama]',
        NOW()
    )");

    $id_responden = mysqli_insert_id($conn);

    $kriteria = mysqli_query($conn,"SELECT * FROM kriteria");
    while($k = mysqli_fetch_array($kriteria)){
        $nilai = $_POST['nilai'][$k['id_kriteria']];
        mysqli_query($conn,"INSERT INTO penilaian VALUES(
            '',
            '$id_responden',
            '".$k['id_kriteria']."',
            '$nilai'
        )");
    }

    echo "<div class='alert alert-success'>Data Berhasil Disimpan!</div>";
}
?>

<div class="card shadow">
<div class="card-header bg-primary text-white">
    <h5>Form Kuesioner Kepuasan Pelanggan</h5>
</div>
<div class="card-body">

<form method="POST">
<div class="mb-3">
    <label>Nama Pelanggan</label>
    <input type="text" name="nama" class="form-control" required>
</div>

<?php
$kriteria=mysqli_query($conn,"SELECT * FROM kriteria");
while($k=mysqli_fetch_array($kriteria)){
?>
<div class="mb-3">
    <label><?= $k['nama_kriteria']; ?> (1-5)</label>
    <input type="number" name="nilai[<?= $k['id_kriteria']; ?>]" class="form-control" min="1" max="5" required>
</div>
<?php } ?>

<button class="btn btn-primary">Kirim</button>
</form>

</div>
</div>

<?php include "footer.php"; ?>
