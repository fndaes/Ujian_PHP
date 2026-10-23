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
</body>

</html>