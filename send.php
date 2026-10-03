<?php

header('Content-Type: application/json');

$token = 'QJYw6xoopEQqkJP434vL';

$target = $_POST['target'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($target) || empty($message)) {
    echo json_encode([
        'status' => false,
        'message' => 'Nomor WhatsApp dan pesan wajib diisi.'
    ]);
    exit;
}

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'target' => $target,
        'message' => $message,
        'countryCode' => '62'
    ],
    CURLOPT_HTTPHEADER => [
        'Authorization: ' . $token
    ],
]);

$response = curl_exec($curl);

if ($response === false) {
    echo json_encode([
        'status' => false,
        'message' => curl_error($curl)
    ]);

    curl_close($curl);
    exit;
}

curl_close($curl);

echo $response;