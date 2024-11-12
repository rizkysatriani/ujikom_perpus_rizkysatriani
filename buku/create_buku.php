<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Tambah Data Buku</title>
</head>

<body>
    <div class="container">
        <h2>Tambah Data Buku</h2>
        <form action="create_buku.php" method="POST" enctype="multipart/form-data">

            <label for="gambar">Gambar Buku:</label><br>
            <input type="file" name="gambar" class="form-control" id="gambar" required><br><br>

            <label for="nama_buku">Nama Buku:</label><br>
            <input type="text" name="nama_buku" id="nama_buku" required><br><br>

            <label for="publisher">Publisher:</label><br>
            <input type="text" name="publisher" id="publisher" required><br><br>

            <label for="kategori">Kategori:</label><br>
            <select name="kategori" id="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="Bahasa">Bahasa</option>
                <option value="Mata Pelajaran">Mata Pelajaran</option>
                <option value="Alam">Alam</option>
                <option value="Fiksi">Fiksi</option>
                <option value="Sejarah">Sejarah</option>
                <option value="Teknologi">Teknologi</option>
                <option value="Keuangan">Keuangan</option>
            </select><br><br>

            <label for="deskripsi">Deskripsi:</label><br>
            <textarea name="deskripsi" id="deskripsi" cols="10" rows="30" required></textarea><br><br>

            <label for="jumlah_tersedia">Jumlah Tersedia:</label><br>
            <input type="number" name="jumlah_tersedia" id="jumlah_tersedia" required><br><br>

            <input type="submit" value="Tambah Buku" class="btn btn-dark"><br>
            <a href="read_buku.php" class="btn btn-dark mt-3">Kembali</a>
        </form>
    </div>
</body>
</html>


<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpusdigital";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menangani form saat disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $nama_buku = $_POST['nama_buku'];
    $publisher = $_POST['publisher'];
    
    // Validasi apakah kategori sudah terdefinisi
    if (isset($_POST['kategori']) && $_POST['kategori'] !== '') {
        $kategori = $_POST['kategori'];
    } else {
        die("Kategori belum dipilih.");
    }
    
    $deskripsi = $_POST['deskripsi'];
    $jumlah_tersedia = $_POST['jumlah_tersedia'];

    // Mengunggah file gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/vitonbook-native/buku/img/';
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    // Memindahkan file gambar yang diupload ke folder uploads
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO buku (gambar, nama_buku, publisher, kategori, deskripsi, jumlah_tersedia) 
                VALUES ('$gambar', '$nama_buku', '$publisher', '$kategori', '$deskripsi', '$jumlah_tersedia')";

        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Data buku berhasil ditambahkan.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file gambar.";
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
}
?>
