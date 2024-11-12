<?php
// Mulai sesi
session_start();

// Koneksi ke database MySQL
$host = 'localhost';  // Sesuaikan dengan konfigurasi database Anda
$dbUsername = 'root';  // Username MySQL Anda
$dbPassword = '';      // Password MySQL Anda
$dbname = 'perpusdigital'; // Nama database Anda

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk pesan error
$error_message = '';

// Proses login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitasi input untuk keamanan
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk mencari pengguna berdasarkan username
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna di sesi
            $_SESSION['username'] = $user['username'];
            header("Location: /vitonbook-native/index.php"); // Ganti dengan halaman setelah login berhasil
            exit();
        } else {
            $error_message = "<script>alert('Password salah!');</script>";
        }
    } else {
        $error_message = "<script>alert('Username tidak ditemukan!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>VITON LIBRARY</title>
</head>

<style>
    .container {
        text-align: center;
        font-weight: bold;
        background-color: purple;
        border-radius: 30px;
        color: white;
    }

    .btn {
        font-weight: bold;
    }
</style>

<body>
    <div class="mt-2" style="text-align: end;">
        <a href="" class="btn btn-dark" style="width: 150px;">Petugas</a>
        <a href="/vitonbook-native/admin/admin_login.php" class="btn btn-dark" style="width: 150px;">Admin</a>
    </div>
    <div class="container mt-5" style="width: 450px;"><br>
        <h3 style="font-weight: bold;">Login</h3>

        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="mt-5">
                <div>
                    <label for="" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div><br>

                <div>
                    <label for="" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div><br>

                <input type="submit" value="Login" class="btn btn-dark" style="width: 200px;" onclick="alert('Login Berhasil'); window.location.href='index.php';">
                <a href="/vitonbook-native/form/register.php" class="btn btn-dark" style="width: 200px;">Register</a><br><br>
                <a href="/vitonbook-native/welcome.php" style="text-decoration: none; color: white;">Tetap Keluar</a>
                <br><br>
            </div>
        </form>
    </div>
</body>

</html>