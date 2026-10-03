# Project API WhatsApp - Fonnte

Project ini merupakan pengembangan API registrasi dengan fitur notifikasi WhatsApp otomatis.

## Teknologi
- HTML
- CSS
- PHP
- MySQL
- REST API
- Fonnte
- cURL

## Fitur
- Form registrasi
- Validasi data
- Cek email
- Cek nomor WhatsApp
- Password hashing
- Penyimpanan database
- Normalisasi nomor WhatsApp
- Notifikasi WhatsApp otomatis
- Log pengiriman WhatsApp
- Penanganan error API

## Struktur
```text
api-wa/
├── config/
│   ├── database.php
│   └── fonnte.php
├── functions/
│   └── fonnte.php
├── api/
│   ├── register.php
│   └── whatsapp.php
├── index.php
├── database.sql
└── README.md
```

## Cara menjalankan
1. Jalankan Apache dan MySQL melalui XAMPP.
2. Buat/import database menggunakan `database.sql`.
3. Pastikan database bernama `api_wa_fonnte`.
4. Buka `config/fonnte.php`.
5. Ganti `ISI_TOKEN_FONNTE_DI_SINI` dengan token Fonnte milik sendiri.
6. Buka:
   `http://localhost/api-wa/`
7. Isi form registrasi.
8. Pastikan nomor WhatsApp tujuan dapat menerima pesan dari perangkat Fonnte.

## Alur
User → Register → Validasi → Database → Fonnte API → WhatsApp

## Keamanan
API Token hanya disimpan di sisi server dan tidak ditampilkan pada frontend.
Password disimpan menggunakan `password_hash()`.

Jangan memasukkan token asli ke repository publik atau screenshot.
