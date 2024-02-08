<?php
include("../connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data pegawai berdasarkan ID
    $query = "SELECT * FROM pegawai WHERE id_karyawan=$id";
    $result = mysqli_query($conn, $query);
    $pegawai = mysqli_fetch_assoc($result);

    $jabatan = "SELECT * FROM jabatan";
    $resultjabatan = mysqli_query($conn, $jabatan);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $alamat = $_POST['alamat'];
    $posisi = $_POST['posisi'];
    echo $id, $nama, $jeniskelamin, $alamat, $posisi;


    // Memanggil stored procedure untuk memperbarui pegawai
    $query = "CALL updatePegawai('$id', '$nama', '$jeniskelamin', '$alamat', $posisi)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: ../home.php");
    } else {
        echo "Gagal memperbarui pegawai!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .form-control {
            min-height: 41px;
            background: #fff;
            box-shadow: none !important;
            border-color: #e3e3e3;
        }

        .form-control:focus {
            border-color: #70c5c0;
        }

        .form-control,
        .btn {
            border-radius: 2px;
        }

        .login-form {
            width: 350px;
            margin: 0 auto;
            position: absolute;
            top: 20%;
            left: 40%;
        }

        .login-form form {
            color: #7a7a7a;
            border-radius: 2px;
            margin-bottom: 15px;
            font-size: 13px;
            background: #ececec;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
            position: relative;
        }

        .login-form h2 {
            font-size: 22px;
            margin: 35px 0 25px;
        }

        .login-form .avatar {
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: -50px;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            z-index: 9;
            background: #70c5c0;
            padding: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .login-form .avatar img {
            width: 100%;
        }

        .login-form input[type="checkbox"] {
            position: relative;
            top: 1px;
        }

        .login-form .btn,
        .login-form .btn:active {
            font-size: 16px;
            font-weight: bold;
            background: #70c5c0 !important;
            border: none;
            margin-bottom: 20px;
        }

        .login-form .btn:hover,
        .login-form .btn:focus {
            background: #50b8b3 !important;
        }

        .login-form a {
            text-decoration: underline;
        }

        .login-form a:hover {
            text-decoration: none;
        }

        .login-form form a {
            text-decoration: none;
        }

        .login-form form a:hover {
            text-decoration: underline;
        }

        .login-form .bottom-action {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <form method="post" action="">
            <h2 class="text-center">Edit Pegawai <?php echo $pegawai['id_karyawan']; ?></h2>
            <input hidden name="id" value="<?php echo $pegawai['id_karyawan']; ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="nama" value="<?php echo $pegawai['nama']; ?>" placeholder="Nama Lengkap" required="required">
            </div>
            <div class="form-group">
                <select class="form-control" name="jeniskelamin" aria-label="Default select example">
                    <option disabled>Jenis Kelamin</option>
                    <option <?= ($pegawai['jenis_kelamin'] == "Laki Laki") ? 'selected' : '' ?> value="Laki Laki">Laki Laki</option>
                    <option <?= ($pegawai['jenis_kelamin'] == "Perempuan") ? 'selected' : '' ?> value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-floating">
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" style="height: 100px"><?php echo $pegawai['alamat']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <select class="form-control" name="posisi" aria-label="Default select example">
                    <option disabled>Posisi</option>
                    <?php while ($rowposisi = mysqli_fetch_assoc($resultjabatan)) {
                        echo "<option " . ($pegawai['id_jabatan'] == $rowposisi['id_jabatan'] ? 'selected' : '') . " value=" . $rowposisi['id_jabatan'] . ">" . $rowposisi['nama_jabatan'] . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
            </div>
        </form>
        <p class="text-center small"><a href="../home.php">Kembali ke halaman utama</a></p>
    </div>
</body>

</html>