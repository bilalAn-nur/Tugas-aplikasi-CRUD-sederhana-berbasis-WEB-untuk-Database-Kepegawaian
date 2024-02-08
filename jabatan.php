<?php
session_start();

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

$username = $_SESSION['username'];

include("connection.php"); // Memuat koneksi database

$query = "SELECT * FROM jabatan";
$result = mysqli_query($conn, $query); // Menjalankan query dan menyimpan hasilnya

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        html,
        body,
        .intro {
            height: 100%;
        }

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .card {
            border-radius: .5rem;
        }

        .mask-custom {
            background: rgba(24, 24, 16, .2);
            border-radius: 2em;
            backdrop-filter: blur(25px);
            border: 2px solid rgba(255, 255, 255, 0.05);
            background-clip: padding-box;
            box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
        }
    </style>
</head>


<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" style="margin-left: 50px;" href="#">Aplikasi Web Pegawai</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Pegawai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="jabatan.php">Jabatan</a>
                    </li>
                </ul>
                <a class="nav-link" href="logout.php" style="margin-right: 50px;">Logout</a>
            </div>
        </div>
    </nav>
    <section class="intro">
        <div class="bg-image h-100" style="background-color: #6095F0;">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <h1 class="text-white">Tabel Jabatan</h1>
                        <div class="col-12">
                            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                <div class="card-body">
                                    <button type="button" class="btn btn-success" style="margin-bottom: 1%;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Tambah Jabatan
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">NAMA JABATAN</th>
                                                    <th scope="col">DESKRIPSI</th>
                                                    <th scope="col">GAJI</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $no . "</td>";
                                                    echo "<td>" . $row['nama_jabatan'] . "</td>";
                                                    echo "<td>" . $row['deskripsi'] . "</td>";
                                                    echo "<td>" . $row['gaji'] . "</td>";
                                                    echo "<td><a class='btn btn-warning btn-sm px-3' href='crud/editJabatan.php?id_jabatan=" . $row['id_jabatan'] . "'>Edit</a>  <a class='btn btn-danger btn-sm px-3' href='crud/deleteJabatan.php?id_jabatan=" . $row['id_jabatan'] . "'>Delete</a></td>";
                                                    echo "</tr>";
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Jabatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="crud/addJabatan.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nama_jabatan" required placeholder="Nama Jabatan" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Leave a comment here" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Deskripsi Tentang Jabatan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="gaji" required placeholder="Gaji" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Jabatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>