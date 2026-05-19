<?php
$conn = mysqli_connect("localhost","root","","db_spk_kepuasan");

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
