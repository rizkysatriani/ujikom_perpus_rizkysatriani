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

// Ambil ID buku dari URL
$id_buku = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_buku <= 0) {
    echo "ID Buku tidak valid.";
    exit;
}

// Query untuk mengambil detail buku berdasarkan ID
$sql = "SELECT * FROM buku WHERE id_buku = $id_buku";
$result = mysqli_query($conn, $sql);

// Tambahkan pengecekan apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Cek apakah ada data buku yang ditemukan
if (mysqli_num_rows($result) > 0) {
    $buku = mysqli_fetch_assoc($result);
} else {
    echo "Buku tidak ditemukan.";
    exit;
}

// Tutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITON LIBRARY</title>
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

        a img {
            width: 150px;
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <h1 class="navbar-brand">Viton Library</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse gap-5" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/vitonbook-native/welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vitonbook-native/favorit_welcome.php">Favorit</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light" href="/vitonbook-native/form/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3"><br>
                <!-- Menampilkan gambar buku -->
                <img src="../buku/img/<?php echo $buku['gambar']; ?>" class="img-fluid">
                <div class="mt-4">
                    <!-- Navigasi ke proses_peminjaman dengan menambahkan username dan ID buku -->
                    <button class="btn btn-primary" onclick="alert('Harap Login jika ingin meminjam buku'); window.location.href='/vitonbook-native/form/login.php';">Pinjam Buku</button>

                </div>
            </div>
            <div class="col-md-8"><br>
                <!-- Menampilkan detail buku -->
                <h1 class="mb-3"><?php echo $buku['nama_buku']; ?></h1>
                <h5>Publisher: <?php echo $buku['publisher']; ?></h5>
                <h5 class="mt-3">Kategori: <?php echo $buku['kategori']; ?></h5>
                <h5 class="mt-3">Deskripsi Buku:</h5>
                <p class="mt-3"><?php echo $buku['deskripsi']; ?></p>
            </div>
        </div>

        <div class="mt-4">
            <h5>Komentar:</h5>
            <input type="text" class="form-control" name="" id="" style="width: 400px;"><br>

            <input type="submit" value="Kirim" class="btn btn-primary" style="width: 150px;">
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>