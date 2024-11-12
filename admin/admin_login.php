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

// Memproses form saat submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validasi input
    if (empty($admin_name) || empty($admin_password)) {
        $error_message = "Admin name and password cannot be empty.";
    } else {
        // Query untuk mencari admin berdasarkan nama
        $sql = "SELECT * FROM admin WHERE admin_name = '$admin_name'";

        // Eksekusi query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data admin
            $admin = $result->fetch_assoc();
            
            // Verifikasi password dengan hash yang ada di database
            if (password_verify($admin_password, $admin['password'])) {
                // Set session untuk login sukses (misalnya, untuk autentikasi admin)
                session_start();
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['username'];

                // Redirect ke halaman admin setelah login sukses
                header("Location: /vitonbook-native/admin/dashboard.php");
                exit();
            } else {
                $error_message = "Incorrect password.";
            }
        } else {
            $error_message = "Admin not found.";
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
    .btn {
        font-weight: bold;
    }
</style>
<body>
    <div class="mt-2" style="text-align: end;">
        <a href="" class="btn btn-dark" style="width: 150px;">Petugas</a>
        <a href="/vitonbook-native/form/login.php" class="btn btn-dark" style="width: 150px;">User</a>
    </div>
    <div class="container mt-5" style="width: 450px;"><br>
        <h3 style="font-weight: bold;">Login Admin</h3>

        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="/vitonbook-native/admin/admin_login.php" method="POST">
            <div class="mt-5">
                <div>
                    <label for="" class="form-label">Admin Name:</label>
                    <input type="text" class="form-control" name="admin_name" required>
                </div><br>

                <div>
                    <label for="" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div><br>

                <input type="submit" value="Login" class="btn btn-dark" style="width: 200px;" onclick="alert('Login Admin Berhasil');">
                <a href="/vitonbook-native/admin/admin_register.php" class="btn btn-dark" style="width: 200px;">Register</a>
                <br><br><br>
            </div>
        </form>
    </div>
</body>
</html>
