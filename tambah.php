<?php

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$nama = [];
$kelas = [];
$nilai = [];
$error = [];    

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $kelas = trim($_POST["kelas"] ?? "");
    $nilai = trim($_POST["nilai"] ?? "");
}

if ($nama === "") {
    $error[] = "Nama tidak boleh kosong.";
}
if ($kelas === "") {
    $error[] = "Kelas tidak boleh kosong.";
}
if ($nilai === "") {
    $error[] = "Nilai tidak boleh kosong.";
} elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
    $error[] = "Nilai harus berupa angka antara 0 hingga 100.";
}

if (count($error) === 0) {
    $_SESSION["data_siswa"][] = [
        "nama" => $nama,
        "kelas" => $kelas,
        "nilai" => (float)$nilai
    ];

    header("Location: dashboard.php");
    exit();
}

$judul = "Tambah Data Siswa";
require_once "includes/header.php";
?>

<?php foreach ($error as $e) { echo "<p style='color: red;'>$e</p>"; } ?>

<form method="POST">
    <label>Nama: </label>
    <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($nama); ?>" required><br>

    <label>Kelas: </label>
    <input type="text" name="kelas" id="kelas" value="<?php echo htmlspecialchars($kelas); ?>" required><br>

    <label>Nilai: </label>
    <input type="number" name="nilai" id="nilai" value="<?php echo htmlspecialchars($nilai); ?>" min="0" max="100" required><br>

    <button type="submit">Tambah</button>
</form>

<?php require_once "includes/footer.php"; ?>