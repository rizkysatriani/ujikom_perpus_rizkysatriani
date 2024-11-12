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

// Ambil ID user dari URL
if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];

    // Query untuk menghapus data user berdasarkan ID
    $sql = "DELETE FROM peminjaman_buku WHERE id_peminjaman = '$id_peminjaman'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil dihapus'); window.location='read_peminjaman.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
