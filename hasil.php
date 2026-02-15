<?php
include "koneksi.php";
include "header.php";

echo "<div class='card shadow'>";
echo "<div class='card-header bg-warning'><h5>Hasil Evaluasi SMART</h5></div>";
echo "<div class='card-body'>";

echo "<table class='table table-bordered'>";
echo "<thead class='table-dark'>
<tr>
<th>No</th>
<th>Nama</th>
<th>Nilai Akhir</th>
<th>Keterangan</th>
</tr>
</thead><tbody>";

$kriteria = mysqli_query($conn,"SELECT * FROM kriteria");
$bobot=[];
$total_bobot=0;

while($k=mysqli_fetch_assoc($kriteria)){
    $bobot[$k['id_kriteria']]=$k['bobot'];
    $total_bobot += $k['bobot'];
}

foreach($bobot as $key=>$value){
    $bobot[$key]=$value/$total_bobot;
}

$responden=mysqli_query($conn,"SELECT * FROM responden");
$no=1;

while($r=mysqli_fetch_assoc($responden)){
    $nilai_total=0;

    $penilaian=mysqli_query($conn,"
        SELECT * FROM penilaian
        WHERE id_responden='".$r['id_responden']."'
    ");

    while($p=mysqli_fetch_assoc($penilaian)){
        $nilai_total += $p['nilai'] * $bobot[$p['id_kriteria']];
    }

    if($nilai_total >= 4){
        $ket="Sangat Puas";
    }elseif($nilai_total >= 3){
        $ket="Puas";
    }elseif($nilai_total >= 2){
        $ket="Cukup";
    }else{
        $ket="Tidak Puas";
    }

    echo "<tr>
            <td>$no</td>
            <td>".$r['nama_responden']."</td>
            <td>".number_format($nilai_total,2)."</td>
            <td>$ket</td>
          </tr>";
    $no++;
}

echo "</tbody></table>";
echo "</div></div>";

include "footer.php";
?>
