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
$id_peminjaman = $_GET['id_peminjaman'];

// Ambil data buku berdasarkan ID
$sql = "SELECT * FROM peminjaman_buku WHERE id_peminjaman = $id_peminjaman";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama_buku = $_POST['nama_buku'];
    $jumlah_dipinjam = $_POST['jumlah_dipinjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Query untuk update data buku
    $sql_update = "UPDATE peminjaman_buku 
                   SET username = '$username', nama_buku = '$nama_buku', jumlah_dipinjam = '$jumlah_dipinjam', tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali'
                   WHERE id_peminjaman = $id_peminjaman";

    if (mysqli_query($conn, $sql_update)) {
        echo "Data buku berhasil diupdate";
        header("Location: /vitonbook-native/peminjaman/read_peminjaman.php"); // Redirect ke halaman daftar buku setelah update
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
                <label for="nama_buku" class="form-label">Username:</label>
                <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?php echo $row['username']; ?>">
            </div>
            <div class="mb-3">
                <label for="publisher" class="form-label">Nama Buku:</label>
                <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $row['nama_buku']; ?>">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Jumlah Dipinjam</label>
                <input type="number" class="form-control" id="kategori" name="kategori" value="<?php echo $row['jumlah_dipinjam']; ?>">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="datetime-local" class="form-control" id="kategori" name="kategori" value="<?php echo $row['tanggal_pinjam']; ?>">
            </div>
            <div class="mb-3">
                <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia</label>
                <input type="datetime-local" class="form-control" id="jumlah_tersedia" name="jumlah_tersedia" value="<?php echo $row['tanggal_kembali']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/vitonbook-native/peminjaman/read_peminjaman.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
</body>

</html>