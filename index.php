<?php
$status = $_GET["status"] ?? "";
$msg = $_GET["msg"] ?? "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - API WhatsApp Fonnte</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f5e9, #f5f7fb);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            color: #263238;
        }
        .container {
            width: 100%;
            max-width: 950px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,.10);
        }
        .info {
            padding: 45px;
            background: #198754;
            color: white;
        }
        .info h1 { font-size: 34px; margin: 0 0 15px; }
        .info p { line-height: 1.7; }
        .steps { margin-top: 30px; }
        .step {
            display: flex;
            gap: 12px;
            margin: 18px 0;
            align-items: center;
        }
        .number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,.2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .form-area { padding: 40px; }
        .form-area h2 { margin-top: 0; }
        label {
            display: block;
            font-weight: bold;
            margin: 14px 0 7px;
        }
        input, textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d8dee4;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
        }
        input:focus, textarea:focus { border-color: #198754; }
        textarea { resize: vertical; min-height: 80px; }
        button {
            width: 100%;
            border: 0;
            margin-top: 20px;
            padding: 14px;
            border-radius: 10px;
            background: #198754;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #146c43; }
        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .success { background: #d1e7dd; color: #0f5132; }
        .warning { background: #fff3cd; color: #664d03; }
        .error { background: #f8d7da; color: #842029; }
        small { color: #6c757d; }
        @media(max-width: 760px) {
            .container { grid-template-columns: 1fr; }
            .info { padding: 30px; }
            .form-area { padding: 30px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="info">
        <h1>API WhatsApp</h1>
        <p>Registrasi pengguna dengan notifikasi WhatsApp otomatis menggunakan Fonnte.</p>

        <div class="steps">
            <div class="step"><span class="number">1</span> Isi form registrasi</div>
            <div class="step"><span class="number">2</span> Data disimpan ke database</div>
            <div class="step"><span class="number">3</span> Sistem memanggil API Fonnte</div>
            <div class="step"><span class="number">4</span> WhatsApp dikirim ke user</div>
        </div>
    </div>

    <div class="form-area">
        <h2>Form Registrasi</h2>

        <?php if ($msg): ?>
            <div class="alert <?= htmlspecialchars($status) ?>">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <form action="api/register.php" method="POST">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Contoh: Budi Santoso" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="contoh@gmail.com" required>

            <label>Nomor WhatsApp</label>
            <input type="text" name="no_hp" placeholder="081234567890" required>
            <small>Gunakan format 08xxxxxxxxxx</small>

            <label>Alamat</label>
            <textarea name="alamat" placeholder="Contoh: Ponorogo" required></textarea>

            <label>Password</label>
            <input type="password" name="password" placeholder="Minimal 6 karakter" required>

            <button type="submit">Daftar & Kirim WhatsApp</button>
        </form>
    </div>
</div>

</body>
</html>
