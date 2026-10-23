<?php
session_start();

if (isset($_SESSION['username'])) {
    $_SESSION["data_siswa"] = [ 
    ["nama" => "Andi",  "kelas" => "11 RPL 1", "nilai" => 88], 
    ["nama" => "Budi",  "kelas" => "11 RPL 1", "nilai" => 72],  
    ["nama" => "Citra", "kelas" => "11 RPL 2", "nilai" => 95],
    ["nama" => "Dewi",  "kelas" => "11 RPL 2", "nilai" => 60],  
    ["nama" => "Eko",   "kelas" => "11 RPL 3", "nilai" => 78],  
    ["nama" => "Fajar", "kelas" => "11 RPL 3", "nilai" => 82],  
    ["nama" => "Gita",  "kelas" => "11 RPL 4", "nilai" => 90],  
    ["nama" => "Hadi",  "kelas" => "11 RPL 4", "nilai" => 55],  
    ["nama" => "Intan", "kelas" => "11 RPL 5", "nilai" => 68],  
    ["nama" => "Joko",  "kelas" => "11 RPL 5", "nilai" => 80]
    ]; 
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['username'] = $username;
        $_SESSION['Login_time'] = date('Y-m-d H:i:s');
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Portal Siswa</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 350px;
            padding: 25px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px #ccc;
        }

        h1, p {
            text-align: center;
        }

        .error-message {
            color: red;
        }

        label {
            display: block;
            margin: 12px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            margin-top: 18px;
            padding: 10px;
            color: white;
            background-color: #ad8f3d;
            border: 0;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #8d722e;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <header>
            <h1>Selamat datang</h1>
            <p>Masuk ke Portal Siswa untuk melanjutkan.</p>
        </header>

        <?php if ($error): ?>
            <p class="error-message" role="alert"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Nama pengguna</label>
            <input type="text" id="username" name="username"
                value="<?php echo htmlspecialchars($username ?? ''); ?>" required>

            <label for="password">Kata sandi</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>
    </main>
</body>

</html>