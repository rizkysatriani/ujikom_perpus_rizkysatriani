<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'perpusdigital';

$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil id_buku dan username dari URL
$id_buku = isset($_GET['id_buku']) ? (int)$_GET['id_buku'] : 0;
$username = isset($_GET['username']) ? $_GET['username'] : '';

if ($id_buku <= 0 || empty($username)) {
    echo "Data peminjaman tidak valid.";
    exit;
}

// Cari id_user berdasarkan username
$sql_user = "SELECT id_user FROM user WHERE username = '$username'";
$result_user = mysqli_query($conn, $sql_user);
if ($result_user && mysqli_num_rows($result_user) > 0) {
    $user_data = mysqli_fetch_assoc($result_user);
    $id_user = $user_data['id_user'];
} else {
    echo "User tidak ditemukan.";
    exit;
}

// Cari nama_buku berdasarkan id_buku
$sql_buku = "SELECT nama_buku FROM buku WHERE id_buku = $id_buku";
$result_buku = mysqli_query($conn, $sql_buku);
if ($result_buku && mysqli_num_rows($result_buku) > 0) {
    $buku_data = mysqli_fetch_assoc($result_buku);
    $nama_buku = $buku_data['nama_buku'];
} else {
    echo "Buku tidak ditemukan.";
    exit;
}

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah_dipinjam = isset($_POST['jumlah_dipinjam']) ? (int)$_POST['jumlah_dipinjam'] : 1;
    $tanggal_kembali = isset($_POST['tanggal_kembali']) ? $_POST['tanggal_kembali'] : '';

    if (empty($tanggal_kembali)) {
        echo "<div class='alert alert-danger'>Tanggal kembali harus diisi.</div>";
    } else {
        // Masukkan data peminjaman ke dalam tabel peminjaman_buku
        $sql = "INSERT INTO peminjaman_buku (id_user, id_buku, nama_buku, username, jumlah_dipinjam, tanggal_pinjam, tanggal_kembali) 
                VALUES ($id_user, $id_buku, '$nama_buku', '$username', $jumlah_dipinjam, NOW(), '$tanggal_kembali')";

        if (mysqli_query($conn, $sql)) {
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
        }
    }
}

// Tutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <style>
        nav {
            background-color: purple;
        }

        .navbar-collapse {
            justify-content: end;
        }

        .nav-link,
        .btn {
            font-weight: bold;
        }

    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-purple">
        <div class="container-fluid">
            <h1 class="navbar-brand" style="font-weight: bold;">Viton Library</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/vitonbook-native/index.php">Home</a>
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

    <!-- Form Peminjaman Buku -->
    <div class="container mt-5" style="width: 450px; text-align: center;">
        <form method="POST" action="proses_peminjaman.php?id_buku=<?php echo $id_buku; ?>&username=<?php echo $username; ?>">
            <div>
                <h1><strong><label for="jumlah_dipinjam" class="form-label">Jumlah Dipinjam:</label></strong></h1>
                <input type="number" class="form-control" name="jumlah_dipinjam" id="jumlah_dipinjam" required>
            </div><br>
            <div>
                <h1><strong><label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label></strong></h1>
                <input type="date" class="form-control" name="tanggal_kembali" id="tanggal_kembali" required>
            </div><br>

            <input type="submit" value="Pinjam Buku" class="btn btn-primary" onclick="alert('Buku Berhasil Dipinjam'); window.location.href='/vitonbook-native/buku/detail_buku.php?id=<?php echo $id_buku; ?>';">
            <a href="/vitonbook-native/buku/detail_buku.php?id=<?php echo $id_buku; ?>" class="btn btn-secondary">Kembali</a>

        </form>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
