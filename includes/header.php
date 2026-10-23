<?php
$halaman_aktif = basename($_SERVER["PHP_SELF"]);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($judul) ?></title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        header {
            background: #ad8f3d;
            color: white;
            padding: 20px;
        }

        header h1 {
            margin: 0 0 15px;
        }

        nav a {
            display: inline-block;
            padding: 10px 16px;
            margin-right: 5px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        nav a:hover {
            background: #40566f;
        }

        nav a.aktif {
            background: #f0a500;
            color: #222;
            font-weight: bold;
        }

        main {
            max-width: 900px;
            min-height: 300px;
            margin: 25px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        footer {
            text-align: center;
            background: #243447;
            color: white;
            padding: 15px;
        }
    </style>
</head>
<body>

<header>
    <h1>Website Saya</h1>

    <nav>
        <a href="dashboard.php"
           class="<?= $halaman_aktif === 'dashboard.php' ? 'aktif' : '' ?>">
            Dashboard
        </a>

        <a href="tambah.php"
           class="<?= $halaman_aktif === 'tambah.php' ? 'aktif' : '' ?>">
            Tambah Siswa
        </a>

        <a href="logout.php"
           class="<?= $halaman_aktif === 'logout.php' ? 'aktif' : '' ?>">
            Logout
        </a>
    </nav>
</header>

<main>
    <h2><?= htmlspecialchars($judul) ?></h2>
