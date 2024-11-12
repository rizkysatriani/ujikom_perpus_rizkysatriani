<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Koneksi ke database
$host = 'localhost';  // Sesuaikan dengan konfigurasi database Anda
$dbUsername = 'root';  // Username MySQL Anda
$dbPassword = '';      // Password MySQL Anda
$dbname = 'perpusdigital'; // Nama database Anda

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna berdasarkan username dari sesi
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Pengguna tidak ditemukan.";
    exit();
}

// Proses pembaruan data profil
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data form
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Validasi
    if (!empty($new_username) && !empty($new_password)) {
        // Hash password baru
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update data pengguna
        $update_query = "UPDATE users SET username = '$new_username', password = '$hashed_password'";

        if ($conn->query($update_query) === TRUE) {
            // Update session username
            $_SESSION['username'] = $new_username;
            $success_message = 'Profil berhasil diperbarui!';
        } else {
            $error_message = 'Terjadi kesalahan saat memperbarui profil: ' . $conn->error;
        }
    } else {
        $error_message = 'Username dan password tidak boleh kosong!';
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

<body>
    <style>
        nav {
            background-color: purple;
        }

        .collapse {
            justify-content: end;
        }

        .nav-link {
            font-weight: bold;
        }

        .btn {
            font-weight: bold;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <h1 class="navbar-brand" style="font-weight: bold;">Viton Library</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vitonbook-native/favorit.php">Favorit</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1><?php echo $user['username']; ?></h1>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>