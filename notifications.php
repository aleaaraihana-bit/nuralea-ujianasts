<?php

require_once "../includes/auth.php";

wajibAdmin();

$totalUser = $conn
    ->query("SELECT COUNT(*) AS total FROM users")
    ->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Notifications</title>

    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="container">

    <div class="card">

        <h1>🔔 Notifications</h1>

        <br>

        <div class="alert">

            Sistem memiliki
            <strong><?= $totalUser ?></strong>
            data user.

        </div>

        <a href="dashboard.php" class="btn">
            ← Dashboard
        </a>

    </div>

</div>

</body>
</html>