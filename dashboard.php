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

            require_once "classes/Siswa.php";
            $data = $_SESSION["data_siswa"] ?? [];
            $daftar = [];
            foreach ($data as $d) {
                $daftar[] = new Siswa($d["nama"], $d["kelas"], $d["nilai"]);
            }

            $nilaiTertinggi = array_column($daftar, 'nilai');
            $nilaiTerendah = array_column($daftar, 'nilai');
            $rata_rata = array_sum($nilaiTertinggi) / count($nilaiTertinggi);
            $inMax = array_search($nilaiTertinggi, array_column($daftar, 'nilai'));
            $inMin = array_search($nilaiTerendah, array_column($daftar, 'nilai'));

            $data = [
                "nilaiTertinggi" => $daftar[$inMax]->getNilai(),
                "nilaiTerendah" => $daftar[$inMin]->getNilai(),
                "rata_rata" => $rata_rata
            ];
            ?>

        </tbody>
</body>

</html>