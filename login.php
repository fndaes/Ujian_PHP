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
    $username = trim($_POST['username']);
    $password = $_POST['password'];

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
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>