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

        .collapse {
            justify-content: end;
        }

        .nav-link {
            font-weight: bold;
        }

        .btn {
            font-weight: bold;
        }

        .card {
            width: 222px;
            text-align: center;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <h1 class="navbar-brand" style="font-weight: bold;">Viton Library</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorit.php">Favorit</a>
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

</body>

</html>