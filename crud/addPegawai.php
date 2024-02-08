<?php
include("../connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $idkaryawan = $_POST['idkaryawan'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $idpegawai = $_POST['posisi'];
    echo $nama.$jeniskelamin.$alamat.$idpegawai;

    // Memanggil stored procedure untuk menambah pegawai
    $query = "CALL tambahPegawai('$idkaryawan','$nama', '$jeniskelamin', '$alamat', '$idpegawai')";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("location: ../home.php");
    } else {
        echo "Gagal menambah pegawai!";
    }
}
?>
