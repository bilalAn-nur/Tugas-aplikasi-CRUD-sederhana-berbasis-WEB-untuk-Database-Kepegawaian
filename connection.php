<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "datapegawai";

// Membuat koneksi
$conn = mysqli_connect($hostname, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
