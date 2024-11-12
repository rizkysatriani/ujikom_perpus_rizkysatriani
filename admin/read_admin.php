<?php
// Koneksi ke database MySQL
$host = 'localhost'; // Nama host MySQL
$user = 'root'; // Username MySQL
$password = ''; // Password MySQL
$database = 'perpusdigital_admin'; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel 'bukus'
$sql = "SELECT * FROM admin";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <title>Data Buku</title>
  <style>
    .nav-link {
      color: black;
    }

    .nav-link:hover {
      color: black;
    }

    table {
      text-align: center;
    }

    tbody tr td {
      font-weight: bold;
    }

    tbody tr td img {
      width: 150px;
    }
  </style>
</head>

<body>

  <header class="navbar navbar-light sticky-top flex-md-nowrap p-0 shadow mt-3">
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <h5 class="navbar-brand col-md-3 col-lg-2 me-0 px-3">Viton Library</h5>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/vitonbook-native/admin/dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                  <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                </svg>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vitonbook-native/user/read_user.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                  <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                  <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z" />
                </svg>
                Data User
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vitonbook-native/admin/read_admin.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z" />
                </svg>
                Data Admin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vitonbook-native/buku/read_buku.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                  <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg>
                Data Buku
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vitonbook-native/peminjaman/read_peminjaman.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                  <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                </svg>
                Data Peminjaman
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="btn btn-dark" style="width: 150px;">Admin Profile</a>
            </li><br>
            <li class="nav-item">
              <a href="/vitonbook-native/admin/admin_login.php" class="btn btn-danger" style="width: 150px;">Logout</a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="chartjs-size-monitor">
          <div class="chartjs-size-monitor-expand">
            <div class=""></div>
          </div>
          <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
          </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Data Buku</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
              This week
            </button>
          </div>
        </div>

        <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="548" height="231" style="display: block; width: 548px; height: 231px;"></canvas>

        <div style="text-align: center;">
          <h2>Data Admin</h2>
          <a href="create_buku.php" class="btn btn-primary mt-2">Tambah Data Buku</a>
        </div><br>

        <div class="container mt-5">
          <table class="table table-bordered table-stripped">
            <thead>
              <tr>
                <th>ID Admin</th>
                <th>Admin Name</th>
                <th>Password</th>
                <th>Aksi</th>
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
                    <td><?php echo $row['id_admin']; ?></td>
                    <td><?php echo $row['admin_name']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td>
                      <a href="" class="btn btn-warning">Ubah</a>
                      <a href="/vitonbook-native/admin/delete_admin.php?id_admin=<?php echo $row['id_admin']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php
                endwhile;
                ?>
              <?php
              endif;

              // Tutup koneksi
              mysqli_close($conn);
              ?>
            </tbody>
          </table>
        </div>


      </main>
    </div>
  </div>

  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>