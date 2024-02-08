<?php
include("../connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Memanggil stored procedure untuk menghapus pegawai
    $query = "CALL hapusPegawai('$id')";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("location: ../home.php");
    } else {
        echo "Gagal menghapus pegawai!";
    }
}
?>
