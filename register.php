<?php
// Memulai session
session_start();

// Jika pengguna sudah login, arahkan ke halaman utama
if (isset($_SESSION['username'])) {
    header("location: home.php");
}

// Memuat koneksi database
include("connection.php");
$boolalert = false;

// Jika form register disubmit
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        $message =  "Kata sandi tidak cocok!";
        $alert = true;
    } else {
        $passwordhash = md5($password);

        // Memanggil stored procedure untuk menambahkan pengguna baru
        $query = "CALL addUser('$username', '$passwordhash')";
        $result = mysqli_query($conn, $query);

        // Jika proses register berhasil
        if ($result) {
            header("location: login.php?success=1");
        } else {
            $message =  "Gagal mendaftar!";
            $alert = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            top: 30%;
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
            <div class="avatar">
                <img src="img/icon.png" alt="Avatar">
            </div>
            <h2 class="text-center">Register</h2>
            <?php
            if (isset($alert) && $alert) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                    " . $message . "
                    </div>";
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Repeat Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>
            </div>
            <div class="bottom-action clearfix">
                <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            </div>
        </form>
        <p class="text-center small">Sudah punya akun? <a href="login.php">Sign in here!</a></p>
    </div>

</body>

</html>