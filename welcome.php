<?php
// Koneksi ke database MySQL
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'perpusdigital';

$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel 'buku'
$sql = "SELECT * FROM buku";
$result = mysqli_query($conn, $sql);

// Tambahkan pengecekan apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
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

    <!-- Background Image -->
    <div class="container mt-3">
        <div class="bg-image" style="background-image: url('balazs.jpg'); background-size: cover; height: 300px;"></div>
    </div>

    <!-- Search & Categories -->
    <div class="container mt-5">
        <input type="search" class="form-control" placeholder="Cari Buku">
        <h5 class="mt-3">Kategori Buku:</h5>
        <select>
            <option value="">Pilih Kategori</option>
            <option value="Bahasa">Bahasa</option>
            <option value="Mapel Sekolah">Mapel Sekolah</option>
            <option value="Alam">Alam</option>
            <option value="Fiksi">Fiksi</option>
            <option value="Sejarah">Sejarah</option>
            <option value="Teknologi">Teknologi</option>
            <option value="Keuangan">Keuangan</option>
        </select>
    </div>

    <!-- Books Display -->
    <div class="container mt-5" style="text-align: justify; justify-content: space-evenly;">
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                    <!-- Card Buku -->
                    <div class="col mt-4">
                        <a href="/vitonbook-native/buku/detail_buku_welcome.php?id=<?php echo $row['id_buku']; ?>">
                            <img src="buku/img/<?php echo $row['gambar']; ?>" alt="">
                        </a>
                    </div>
            <?php
                endwhile;
            else:
                echo "<p>Tidak ada buku ditemukan.</p>";
            endif;
            ?>
        </div>
    </div><br><br><br>

    <?php
    // Tutup koneksi
    mysqli_close($conn);
    ?>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>