<?php
// Koneksi ke database
$servername = "localhost"; // Ubah dengan server database Anda
$username = "root"; // Ubah dengan username database Anda
$password = ""; // Ubah dengan password database Anda
$dbname = "perpusdigital_admin"; // Nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menyimpan pesan error atau sukses
$error_message = '';
$success_message = '';

// Memproses form saat submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $admin_name = mysqli_real_escape_string($conn, $_POST['username']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validasi input
    if (empty($admin_name) || empty($admin_password)) {
        $error_message = "Admin name and password cannot be empty.";
    } else {
        // Hash password untuk keamanan
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data admin ke database
        $sql = "INSERT INTO admin (admin_name, password) VALUES ('$admin_name', '$hashed_password')";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            $success_message = "Admin successfully registered!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Tutup koneksi
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
        <a href="/vitonbook-native/form/login.php" class="btn btn-dark" style="width: 150px;">User</a>
    </div>
    <div class="container mt-5" style="width: 450px;"><br>
        <h3 style="font-weight: bold;">Register Admin</h3>

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

        <form action="/vitonbook-native/admin/admin_register.php" method="POST">
            <div class="mt-5">
                <div>
                    <label for="" class="form-label">Admin Name:</label>
                    <input type="text" class="form-control" name="username" required>
                </div><br>

                <div>
                    <label for="" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div><br>

                <input type="submit" value="Register" class="btn btn-dark" style="width: 200px;" onclick="alert('Register Admin Berhasil');">
                <a href="/vitonbook-native/admin/admin_login.php" class="btn btn-dark" style="width: 200px;">Login</a>
                <br><br><br>
            </div>
        </form>
    </div>
</body>

</html>