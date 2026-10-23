<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($judul) ? $judul : "Ujian Praktik PHP" ?></title>
</head>
<body>
    <header>
        <h1> Ujian Praktik PHP</h1>
        <nav>
            <p>
                <a href="dashboard.php">Dashboard</a> <?= ($halaman_aktif == 'dashboard.php') ? '(Aktif)' : '' ?> | 
                <a href="tambah.php">Tambah Siswa</a> <?= ($halaman_aktif == 'tambah.php') ? '(Aktif)' : '' ?> | 
                <a href="logout.php">Logout</a> <?= ($halaman_aktif == 'logout.php') ? '(Aktif)' : '' ?>
            </p>
        </nav>
    </header>
    <hr>