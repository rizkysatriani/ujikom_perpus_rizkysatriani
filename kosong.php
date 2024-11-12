<?php
// Koneksi ke database MySQL
$host = 'localhost'; // Nama host MySQL
$user = 'root'; // Username MySQL
$password = ''; // Password MySQL
$database = 'perpusdigital'; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel 'bukus'
$sql = "SELECT * FROM buku";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Daftar Buku</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Cek apakah ada data di hasil query
            if (mysqli_num_rows($result) > 0):
                // Loop melalui data dengan while
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                <tr>
                    <td><?php echo $row['id_buku']; ?></td>
                    <td><img src="buku/img/<?php echo $row['gambar']; ?>" alt=""></td>
                    <td><?php echo $row['judul_buku']; ?></td>
                    <td><?php echo $row['penulis']; ?></td>
                </tr>
            <?php
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
            <?php
            endif;

            // Tutup koneksi
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
