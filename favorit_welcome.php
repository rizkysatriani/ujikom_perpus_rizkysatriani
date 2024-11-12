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

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>