<?php
include "koneksi.php";
include "header.php";

/* =========================
   HAPUS SATU DATA
========================= */
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    // hapus penilaian responden
    mysqli_query($conn,"DELETE FROM penilaian 
        WHERE id_responden='$id'");

    // hapus responden
    mysqli_query($conn,"DELETE FROM responden 
        WHERE id_responden='$id'");

    echo "<script>
            alert('Data berhasil dihapus');
            window.location='hasil.php';
          </script>";
}

/* =========================
   HAPUS SEMUA DATA
========================= */
if(isset($_POST['hapus_semua'])){

    mysqli_query($conn,"DELETE FROM penilaian");
    mysqli_query($conn,"DELETE FROM responden");

    echo "<script>
            alert('Semua data berhasil dihapus');
            window.location='hasil.php';
          </script>";
}

echo "<div class='card shadow'>";
echo "<div class='card-header bg-warning d-flex justify-content-between align-items-center'>
        <h5>Hasil Evaluasi SMART</h5>

        <form method='POST'
              onsubmit=\"return confirm('Yakin ingin menghapus semua data?')\">

            <button type='submit'
                    name='hapus_semua'
                    class='btn btn-danger btn-sm'>

                Hapus Semua
            </button>

        </form>
      </div>";

echo "<div class='card-body'>";


/* =========================
   AMBIL KRITERIA
========================= */
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria");

$bobot = [];
$tipe  = [];
$nama_kriteria = [];
$total_bobot = 0;

while($k = mysqli_fetch_assoc($kriteria)){

    $id = $k['id_kriteria'];

    $bobot[$id] = $k['bobot'];
    $tipe[$id]  = $k['tipe'];
    $nama_kriteria[$id] = $k['nama_kriteria'];

    $total_bobot += $k['bobot'];
}

/* NORMALISASI BOBOT */
foreach($bobot as $key => $value){
    $bobot[$key] = $value / $total_bobot;
}

/* =========================
   HEADER TABEL
========================= */
echo "<table class='table table-bordered table-striped'>";
echo "<thead class='table-dark'>";
echo "<tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal</th>";

foreach($nama_kriteria as $nama){
    echo "<th>$nama</th>";
}

echo "<th>Nilai Akhir</th>
      <th>Keterangan</th>
      <th>Aksi</th>
      </tr>";
echo "</thead><tbody>";


/* =========================
   AMBIL RESPONDEN
========================= */
$responden = mysqli_query($conn, "SELECT * FROM responden");

$data_hasil = [];

while($r = mysqli_fetch_assoc($responden)){

    $total = 0;
    $nilai_kriteria = [];

    /* AMBIL PENILAIAN */
    $penilaian = mysqli_query($conn,"
        SELECT * FROM penilaian
        WHERE id_responden='".$r['id_responden']."'
    ");

   while($p = mysqli_fetch_assoc($penilaian)){

    $id_kriteria = $p['id_kriteria'];
    $nilai = $p['nilai'];

    $nilai_kriteria[$id_kriteria] = $nilai;

    /* =========================
       NORMALISASI SMART
       SKALA 1 - 5
    ========================= */

    if($tipe[$id_kriteria] == "benefit"){

        $utility = ($nilai - 1) / 4;

    }else{

        $utility = (5 - $nilai) / 4;

    }

    /* HITUNG NILAI SMART */
    $total += $utility * $bobot[$id_kriteria];
}

    $data_hasil[] = [
    'id_responden' => $r['id_responden'],
    'nama' => $r['nama_responden'],
    'tanggal' => $r['tanggal'],
    'nilai_kriteria' => $nilai_kriteria,
    'nilai' => $total
];
}

/* =========================
   SORTING RANKING
========================= */
usort($data_hasil, function($a, $b){
    return $b['nilai'] <=> $a['nilai'];
});


/* =========================
   TAMPILKAN DATA
========================= */
foreach($data_hasil as $i => $h){

    if($h['nilai'] >= 0.80){
        $ket = "Sangat Puas";
    }
    elseif($h['nilai'] >= 0.60){
        $ket = "Puas";
    }
    elseif($h['nilai'] >= 0.40){
        $ket = "Cukup Puas";
    }
    elseif($h['nilai'] >= 0.20){
        $ket = "Kurang Puas";
    }
    else{
        $ket = "Tidak Puas";
    }

    echo "<tr>";

    echo "<td>".($i+1)."</td>";
  echo "<td>".$h['nama']."</td>";
echo "<td>".date('d-m-Y H:i', strtotime($h['tanggal']))."</td>";

    foreach($nama_kriteria as $id => $nama){

        $nilai = isset($h['nilai_kriteria'][$id])
            ? $h['nilai_kriteria'][$id]
            : "-";

        echo "<td>$nilai</td>";
    }

 echo "<td>"
    .number_format($h['nilai'],3).
    " (".
    number_format($h['nilai']*100,1).
    "%)</td>";
    echo "<td>$ket</td>";

    echo "<td>
            <a href='hasil.php?hapus=".$h['id_responden']."'
               class='btn btn-danger btn-sm'
               onclick=\"return confirm('Yakin ingin menghapus data ini?')\">

               Hapus
            </a>
          </td>";

    echo "</tr>";
}

echo "</tbody></table>";

echo "<div class='mt-3 text-end'>
        <a href='index.php' class='btn btn-secondary'>
        ← Kembali ke Dashboard
        </a>
      </div>";

echo "</div></div>";

include "footer.php";
?>