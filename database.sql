CREATE DATABASE IF NOT EXISTS api_wa_fonnte
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE api_wa_fonnte;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    no_hp VARCHAR(20) NOT NULL UNIQUE,
    alamat TEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS log_whatsapp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    no_tujuan VARCHAR(20) NOT NULL,
    pesan TEXT NOT NULL,
    status ENUM('Terkirim', 'Gagal', 'Pending') NOT NULL DEFAULT 'Pending',
    response LONGTEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_log_user
        FOREIGN KEY (id_user) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
