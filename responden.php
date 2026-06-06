<?php
include "koneksi.php";
include "header.php";

/* =========================
   SIMPAN DATA
========================= */
if(isset($_POST['simpan'])){

    mysqli_query($conn,"INSERT INTO responden
    (
        id_responden,
        nama_responden,
        tanggal
    )
    VALUES
    (
        '',
        '$_POST[nama]',
        NOW()
    )");

    $id_responden = mysqli_insert_id($conn);

    $kriteria = mysqli_query($conn,"SELECT * FROM kriteria");

    while($k = mysqli_fetch_assoc($kriteria)){

        $nilai = $_POST['nilai'][$k['id_kriteria']];

        mysqli_query($conn,"INSERT INTO penilaian
        (
            id_penilaian,
            id_responden,
            id_kriteria,
            nilai
        )
        VALUES
        (
            '',
            '$id_responden',
            '".$k['id_kriteria']."',
            '$nilai'
        )");
    }

    echo "
    <div class='alert alert-success alert-dismissible fade show'>
        <strong>Berhasil!</strong> Data kuesioner berhasil disimpan.
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>";
}
?>

<div class="container mt-4">

<div class="card shadow-lg border-0">

    <div class="card-header bg-primary text-white text-center py-3">
        <h3 class="mb-1">📋 Kuesioner Kepuasan Pelanggan</h3>
        <small>Silakan berikan penilaian sesuai pengalaman Anda</small>
    </div>

    <div class="card-body">

        <div class="alert alert-info">
            <strong>Keterangan Penilaian:</strong><br>
            1 = Sangat Tidak Puas |
            2 = Tidak Puas |
            3 = Cukup Puas |
            4 = Puas |
            5 = Sangat Puas
        </div>

        <form method="POST">

            <div class="mb-4">
                <label class="form-label fw-bold">
                    Nama Pelanggan
                </label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="Masukkan nama pelanggan"
                       required>
            </div>

            <?php
            $kriteria = mysqli_query($conn,"SELECT * FROM kriteria");

            while($k = mysqli_fetch_assoc($kriteria)){
            ?>

            <div class="mb-4">

                <label class="form-label fw-bold">
                    <?= $k['nama_kriteria']; ?>
                </label>

                <div class="d-flex gap-4">

                    <?php
                    for($i=1; $i<=5; $i++){
                    ?>

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="radio"
                            name="nilai[<?= $k['id_kriteria']; ?>]"
                            value="<?= $i; ?>"
                            required>

                        <label class="form-check-label">
                            <?= $i; ?>
                        </label>

                    </div>

                    <?php } ?>

                </div>

            </div>

            <?php } ?>

            <div class="text-center">

                <button type="submit"
                        name="simpan"
                        class="btn btn-success btn-lg px-5">

                    💾 Simpan Penilaian

                </button>

            </div>

        </form>

    </div>

</div>

<div class="text-end mt-3">

    <a href="index.php" class="btn btn-secondary">
        ← Kembali ke Dashboard
    </a>

</div>

</div>

<?php include "footer.php"; ?>