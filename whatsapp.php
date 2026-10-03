<?php
require_once "../config/fonnte.php";
require_once "../functions/fonnte.php";

header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Method harus POST."
    ]);
    exit;
}

$nomor = trim($_POST["nomor"] ?? "");
$pesan = trim($_POST["pesan"] ?? "");

if ($nomor === "" || $pesan === "") {
    http_response_code(422);
    echo json_encode([
        "success" => false,
        "message" => "Nomor dan pesan wajib diisi."
    ]);
    exit;
}

$result = kirimWhatsApp($nomor, $pesan);

echo json_encode($result, JSON_PRETTY_PRINT);
