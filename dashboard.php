<?php

require_once __DIR__ . "/../includes/auth.php";

wajibAdmin();

$totalUser = 0;
$totalLaki = 0;
$totalPerempuan = 0;

$query = $conn->query("SELECT COUNT(*) AS total FROM users");
if ($query) {
    $data = $query->fetch_assoc();
    $totalUser = $data['total'];
}

$query = $conn->query("SELECT COUNT(*) AS total FROM users WHERE jenis_kelamin = 'Laki-laki'");
if ($query) {
    $data = $query->fetch_assoc();
    $totalLaki = $data['total'];
}

$query = $conn->query("SELECT COUNT(*) AS total FROM users WHERE jenis_kelamin = 'Perempuan'");
if ($query) {
    $data = $query->fetch_assoc();
    $totalPerempuan = $data['total'];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

<nav class="navbar">
    <div class="brand">
        UJIAN ASTS
    </div>

    <div class="nav-right">
        <span>
            Halo, <?= htmlspecialchars($_SESSION['nama']) ?>
        </span>

        <a href="../logout.php" class="btn-logout">
            Logout
        </a>
    </div>
</nav>

<div class="container">

    <div class="card">

        <h1>Dashboard Admin</h1>

        <p>
            Selamat datang,
            <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong>
        </p>

    </div>

    <div class="stats">

        <div class="stat">
            <h3>Total User</h3>
            <strong><?= $totalUser ?></strong>
        </div>

        <div class="stat">
            <h3>Laki-laki</h3>
            <strong><?= $totalLaki ?></strong>
        </div>

        <div class="stat">
            <h3>Perempuan</h3>
            <strong><?= $totalPerempuan ?></strong>
        </div>

    </div>

    <div class="card">

        <h2>Menu Admin</h2>

        <br>

        <a href="data_users.php" class="btn">
            Data Users
        </a>

        <a href="tambah_user.php" class="btn">
            Tambah User
        </a>

        <a href="notifications.php" class="btn">
            Notifikasi
        </a>

    </div>

</div>

</body>
</html>