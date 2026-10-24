<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

// Inisialisasi variabel kosong
$nama = "";
$kelas = "";
$nilai = "";
$error = [];

// Proses form HANYA berjalan saat tombol Simpan ditekan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $kelas = trim($_POST["kelas"] ?? "");
    $nilai = trim($_POST["nilai"] ?? "");

    // Validasi isian form
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

    // Jika tidak ada error, simpan ke session dan pindah ke dashboard
    if (count($error) === 0) {
        $_SESSION["data_siswa"][] = [
            "nama" => $nama,
            "kelas" => $kelas,
            "nilai" => (float) $nilai
        ];
        header("Location: dashboard.php");
        exit;
    }
}

// Tampilkan header
$judul = "Tambah Siswa";
require_once "includes/header.php";
?>

<div style="background: white; padding: 20px; border-radius: 8px;">
    <h2>Tambah Data Siswa</h2>
    
    <!-- Tempat menampilkan pesan error -->
    <?php 
    foreach ($error as $e) { 
        echo "<p style='color:red;'>$e</p>"; 
    } 
    ?>

    <!-- Form HTML lengkap -->
    <form method="post" action="">
        <p>
            <label>Nama:</label><br>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        </p>
        <p>
            <label>Kelas:</label><br>
            <input type="text" name="kelas" value="<?php echo htmlspecialchars($kelas); ?>">
        </p>
        <p>
            <label>Nilai:</label><br>
            <input type="number" name="nilai" value="<?php echo htmlspecialchars($nilai); ?>">
        </p>
        <button type="submit">Simpan</button>
    </form>
</div>

<?php 
require_once "includes/footer.php"; 
?>