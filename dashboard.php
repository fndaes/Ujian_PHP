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
                    echo "<td>" . ($siswa->lulus() ? "Lulus" : "Remedial") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data siswa.</td></tr>";
            }

            $data = $_SESSION['data_siswa'] ?? [];
            $totalSiswa = count($data);
            $nilaikolom = array_column($data, 'nilai');

            if ($totalSiswa > 0) {
                $rataRata = array_sum($nilaikolom) / count($nilaikolom);
                $inMax = array_search(max($nilaikolom), $nilaikolom);
                $inMin = array_search(min($nilaikolom), $nilaikolom);
                
                $namaTertinggi = $data[$inMax]['nama'];
                $namaTerendah = $data[$inMin]['nama'];
                $nilaiTertinggi = max($nilaikolom);
                $nilaiTerendah = min($nilaikolom);

            } else {
                $rata_rata = $nilaiTertinggi = $nilaiTerendah = 0;
                $namaTertinggi = $namaTerendah = "-";
            }

            $remedial = array_filter($data, function ($s) {
                return $s['nilai'] < 75;
            });
            ?>

        </tbody>
    </table>
    <h3>Statistik:</h3>
    <ul>
        <li>Total Siswa: <?php echo $totalSiswa; ?></li>
        <li>Rata-rata Nilai: <?php echo number_format($rataRata, 2); ?></li>
        <li>Nilai Tertinggi: <?php echo $nilaiTertinggi; ?> (<?php echo htmlspecialchars($namaTertinggi); ?>)</li>
        <li>Nilai Terendah: <?php echo $nilaiTerendah; ?> (<?php echo htmlspecialchars($namaTerendah); ?>)</li>
    </ul>
    <h3>Siswa Remedial:</h3>
    <ul>
        <?php if (!empty($remedial)): ?>
            <?php {
            foreach ($remedial as $r): ?>{
                <li><?php echo htmlspecialchars($r['nama']); ?> - Nilai: <?php echo $r['nilai']; ?></li>
                <?php endforeach; ?>
            <?php } else: ?>
                <li>Tidak ada siswa yang perlu remedial.</li>
            <?php endif; ?>
    </ul>
</body>

</html>