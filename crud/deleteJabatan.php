<?php
include("../connection.php");

if(isset($_GET['id_jabatan'])) {
    $idjabatan = $_GET['id_jabatan'];

    // Memanggil stored procedure untuk menghapus pegawai
    $query = "CALL hapusJabatan('$idjabatan')";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("location: ../jabatan.php");
    } else {
        echo "Gagal menghapus pegawai!";
    }
}
?>
