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
$success_message = '';

// Proses registrasi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitasi input untuk keamanan
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Cek apakah username sudah ada di database
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Username sudah ada
        $error_message = 'Username sudah digunakan, pilih username lain!';
    } else {
        // Hash password dan simpan data pengguna ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($insert_query) === TRUE) {
            $success_message = "<script>alert('Registrasi berhasil! Anda dapat login sekarang.');</script>";
        } else {
            $error_message = "<script>alert('Terjadi kesalahan saat registrasi:');</script>" . $conn->error;
        }
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
</style>

<body>
    <div class="mt-2" style="text-align: end;">
        <a href="" class="btn btn-dark" style="width: 150px;">Petugas</a>
        <a href="" class="btn btn-dark" style="width: 150px;">Admin</a>
    </div>
    <div class="container mt-5" style="width: 450px;"><br>
        <h3 style="font-weight: bold;">Register</h3>

        <!-- Menampilkan pesan error atau sukses -->
        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success" role="alert">
                <?= $success_message; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mt-5">
                <div>
                    <label for="" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div><br>

                <div>
                    <label for="" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div><br>

                <input type="submit" value="Register" class="btn btn-dark" style="width: 200px;" onclick="alert('Register Berhasil');">
                <a href="/vitonbook-native/form/login.php" class="btn btn-dark" style="width: 200px;">Login</a>
                <br><br><br>
            </div>
        </form>
    </div>
</body>
</html>