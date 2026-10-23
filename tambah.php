<?php
$nama = [];
$kelas = [];
$nilai = [];
$error = [];    

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"]);
    $kelas = trim($_POST["kelas"]);
    $nilai = trim($_POST["nilai"]);
}

if (empty($nama)) {
    $error[] = "Nama tidak boleh kosong.";
}
if (empty($kelas)) {
    $error[] = "Kelas tidak boleh kosong.";
}
if (empty($nilai)) {
    $error[] = "Nilai tidak boleh kosong.";
} elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
    $error[] = "Nilai harus berupa angka antara 0 hingga 100.";
}
else {
    count ($error) === 0;
}
?>