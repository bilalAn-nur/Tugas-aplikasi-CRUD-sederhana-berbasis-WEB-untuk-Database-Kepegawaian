<?php
include("../connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $namajabatan = $_POST['nama_jabatan'];
    $deskripsi = $_POST['deskripsi'];
    $gaji = $_POST['gaji'];

    // Memanggil stored procedure untuk menambah pegawai
    $query = "CALL tambahJabatan('$namajabatan', '$deskripsi', '$gaji')";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("location: ../jabatan.php");
    } else {
        echo "Gagal menambah pegawai!";
    }
}
?>
