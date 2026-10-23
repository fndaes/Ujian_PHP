$nama = []
$kelas = []
$nilai = []
$error = []

$_SERVER["REQUEST_METHOD"] === "POST" 
$POST["nama"] ?? "" trim($_POST["nama"])
$POST["kelas"] ?? "" trim($_POST["kelas"])
$POST["nilai"] ?? "" trim($_POST["nilai"])

$error[] = "Nama tidak boleh kosong." if (empty($nama))
$error[] = "Kelas tidak boleh kosong." if (empty($kelas))
if (empty($nilai)) {
    $error[] = "Nilai tidak boleh kosong.";
} elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
    $error[] = "Nilai harus berupa angka antara 0 hingga 100.";
}