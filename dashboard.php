<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <h1>Dashboard</h1>
    <p>Selamat datang,
        <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
    </p>
    <p>Waktu login: <?php echo htmlspecialchars($_SESSION['Login_time']); ?></p>
    <a href="logout.php">Logout</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nilai</th>
                <th>Predikat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'classes/siswa.php';

            if (isset($_SESSION['data_siswa']) && is_array($_SESSION['data_siswa'])) {
                $no = 1;
                foreach ($_SESSION['data_siswa'] as $siswaData) {
                    $siswa = new Siswa($siswaData['nama'], $siswaData['kelas'], $siswaData['nilai']);
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->nama) . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->kelas) . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->getNilai()) . "</td>";
                    echo "<td>" . htmlspecialchars($siswa->predikat()) . "</td>";
                    echo "<td>" . ($siswa->lulus() ? "Lulus" : "Tidak Lulus") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data siswa.</td></tr>";
            }

            $semua_nilai = [];
            if (isset($_SESSIAON['data_siswa']) && is_array($_SESSION['data_siswa'])) {
                foreach ($_SESSION['data_siswa'] as $d) {
                    $semua_nilai[] = $d['nilai'];
                }
            }
            if (!empty($semua_nilai)) {
                $nilaiTertinggi = max($semua_nilai);
                $nilaiTerendah = min($semua_nilai);
                $rata_rata = array_sum($semua_nilai) / count($semua_nilai);
            } else {
                $nilaiTertinggi = 0;
                $nilaiTerendah = 0;
                $rata_rata = 0;
            }
            ?>

        </tbody>
</body>

</html>