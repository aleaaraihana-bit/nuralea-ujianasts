<?php
require_once "../config/database.php";
require_once "../config/fonnte.php";
require_once "../functions/fonnte.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}

$nama     = trim($_POST["nama"] ?? "");
$email    = trim($_POST["email"] ?? "");
$no_hp    = trim($_POST["no_hp"] ?? "");
$alamat   = trim($_POST["alamat"] ?? "");
$password = $_POST["password"] ?? "";

$errors = [];

if ($nama === "" || strlen($nama) < 3) {
    $errors[] = "Nama minimal 3 karakter.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email tidak valid.";
}

$no_hp_bersih = preg_replace('/[^0-9]/', '', $no_hp);

if (!preg_match('/^08[0-9]{8,13}$/', $no_hp_bersih)) {
    $errors[] = "Nomor WhatsApp harus diawali 08 dan berisi 10-15 digit.";
}

if ($alamat === "") {
    $errors[] = "Alamat wajib diisi.";
}

if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}

if (!empty($errors)) {
    header("Location: ../index.php?status=error&msg=" . urlencode(implode(" ", $errors)));
    exit;
}

// Cek email dan nomor WhatsApp.
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR no_hp = ? LIMIT 1");
$stmt->bind_param("ss", $email, $no_hp_bersih);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $existing = $result->fetch_assoc();

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();

    if ($checkEmail->get_result()->num_rows > 0) {
        header("Location: ../index.php?status=error&msg=" . urlencode("Email sudah terdaftar."));
        exit;
    }

    header("Location: ../index.php?status=error&msg=" . urlencode("Nomor WhatsApp sudah terdaftar."));
    exit;
}

$stmt->close();

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$insert = $conn->prepare(
    "INSERT INTO users (nama, email, no_hp, alamat, password) VALUES (?, ?, ?, ?, ?)"
);
$insert->bind_param(
    "sssss",
    $nama,
    $email,
    $no_hp_bersih,
    $alamat,
    $passwordHash
);

if (!$insert->execute()) {
    header("Location: ../index.php?status=error&msg=" . urlencode("Data gagal disimpan ke database."));
    exit;
}

$idUser = $conn->insert_id;

// Database berhasil, baru kirim WhatsApp.
$target = formatNomor($no_hp_bersih);

$pesan = "🎉 REGISTRASI BERHASIL\n\n";
$pesan .= "Selamat, Kak " . $nama . "!\n";
$pesan .= "Akun Anda telah berhasil dibuat.\n\n";
$pesan .= "📧 Email: " . $email . "\n";
$pesan .= "📱 WhatsApp: " . $no_hp_bersih . "\n";
$pesan .= "🏠 Alamat: " . $alamat . "\n\n";
$pesan .= "Terima kasih telah melakukan registrasi.";

$wa = kirimWhatsApp($target, $pesan);

$statusWA = $wa["success"] ? "Terkirim" : "Gagal";
$responseWA = $wa["response"] ?? $wa["message"];

$log = $conn->prepare(
    "INSERT INTO log_whatsapp (id_user, no_tujuan, pesan, status, response)
     VALUES (?, ?, ?, ?, ?)"
);
$log->bind_param("issss", $idUser, $target, $pesan, $statusWA, $responseWA);
$log->execute();

if ($wa["success"]) {
    header("Location: ../index.php?status=success&msg=" . urlencode("Registrasi berhasil. Notifikasi WhatsApp berhasil dikirim."));
} else {
    header("Location: ../index.php?status=warning&msg=" . urlencode("Registrasi berhasil, tetapi WhatsApp gagal dikirim. Cek token/koneksi Fonnte."));
}
exit;
