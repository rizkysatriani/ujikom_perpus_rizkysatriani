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

// Ambil ID buku dari URL
$id_buku = $_GET['id_buku'];

// Ambil data buku berdasarkan ID
$sql = "SELECT * FROM buku WHERE id_buku = $id_buku";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_buku = $_POST['nama_buku'];
    $publisher = $_POST['publisher'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $jumlah_tersedia = $_POST['jumlah_tersedia'];

    // Query untuk update data buku
    $sql_update = "UPDATE buku 
                   SET nama_buku = '$nama_buku', publisher = '$publisher', kategori = '$kategori', deskripsi = '$deskripsi', jumlah_tersedia = '$jumlah_tersedia'
                   WHERE id_buku = $id_buku";

    if (mysqli_query($conn, $sql_update)) {
        echo "Data buku berhasil diupdate";
        header("Location: /vitonbook-native/buku/read_buku.php"); // Redirect ke halaman daftar buku setelah update
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Update Buku</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Update Data Buku</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_buku" class="form-label">Nama Buku</label>
                <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?php echo $row['nama_buku']; ?>">
            </div>
            <div class="mb-3">
                <label for="publisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $row['publisher']; ?>">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori">
                    <option value="Bahasa" <?php if ($row['kategori'] == 'Bahasa') echo 'selected'; ?>>Bahasa</option>
                    <option value="Mapel Sekolah" <?php if ($row['kategori'] == 'Mapel Sekolah') echo 'selected'; ?>>Mapel Sekolah</option>
                    <option value="Alam" <?php if ($row['kategori'] == 'Alam') echo 'selected'; ?>>Edukasi</option>
                    <option value="Fiksi" <?php if ($row['kategori'] == 'Fiksi') echo 'selected'; ?>>Teknologi</option>
                    <option value="Sejarah" <?php if ($row['kategori'] == 'Sejarah') echo 'selected'; ?>>Sejarah</option>
                    <option value="Teknologi" <?php if ($row['kategori'] == 'Teknologi') echo 'selected'; ?>>Teknologi</option>
                    <option value="keuangan" <?php if ($row['kategori'] == 'Keuangan') echo 'selected'; ?>>Keuangan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia</label>
                <input type="number" class="form-control" id="jumlah_tersedia" name="jumlah_tersedia" value="<?php echo $row['jumlah_tersedia']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/vitonbook-native/buku/read_buku.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
</body>

</html>