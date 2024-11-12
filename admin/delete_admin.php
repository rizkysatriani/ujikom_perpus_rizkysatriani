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
if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];

    // Query untuk menghapus data user berdasarkan ID
    $sql = "DELETE FROM admin WHERE id_admin = '$id_admin'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil dihapus'); window.location='read_admin.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
