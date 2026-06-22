CREATE DATABASE agnimukti;
USE agnimukti;

-- =====================================
-- TABEL USERS
-- =====================================
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    foto_url TEXT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin','pemohon') NOT NULL DEFAULT 'pemohon',
    no_telepon VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================
-- TABEL KATEGORI PAKET
-- =====================================
CREATE TABLE kategori_paket (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================
-- TABEL PAKET LAYANAN
-- =====================================
CREATE TABLE paket_layanan (
    id_paket INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT NOT NULL,
    nama_paket VARCHAR(100) NOT NULL,
    harga DECIMAL(12,2) NOT NULL,
    fasilitas TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_paket_kategori
    FOREIGN KEY (id_kategori)
    REFERENCES kategori_paket(id_kategori)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

-- =====================================
-- TABEL PENDAFTARAN
-- =====================================
CREATE TABLE pendaftaran (
    id_pendaftaran INT AUTO_INCREMENT PRIMARY KEY,
    kode_pendaftaran VARCHAR(20) NOT NULL UNIQUE,

    id_user INT NOT NULL,
    id_paket INT NOT NULL,

    nama_almarhum VARCHAR(100) NOT NULL,
    tanggal_lahir DATE,
    tanggal_meninggal DATE,

    tanggal_daftar DATE NOT NULL,

    status ENUM(
        'Menunggu',
        'Diproses',
        'Selesai',
        'Dibatalkan'
    ) DEFAULT 'Menunggu',

    catatan TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_pendaftaran_user
    FOREIGN KEY (id_user)
    REFERENCES users(id_user)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

    CONSTRAINT fk_pendaftaran_paket
    FOREIGN KEY (id_paket)
    REFERENCES paket_layanan(id_paket)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

-- =====================================
-- TABEL PEMBAYARAN
-- =====================================
CREATE TABLE pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,

    id_pendaftaran INT NOT NULL,

    tanggal_bayar DATE NOT NULL,

    total_bayar DECIMAL(12,2) NOT NULL,

    metode_pembayaran ENUM(
        'Transfer',
        'QRIS',
        'Tunai'
    ) NOT NULL,

    status_pembayaran ENUM(
        'Belum Bayar',
        'Lunas'
    ) DEFAULT 'Belum Bayar',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_pembayaran_pendaftaran
    FOREIGN KEY (id_pendaftaran)
    REFERENCES pendaftaran(id_pendaftaran)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

-- =====================================
-- INSERT DATA
-- =====================================

-- =====================================
-- DATA DUMMY USERS
-- =====================================

INSERT INTO users
(nama, username, password, role, no_telepon, alamat)
VALUES
(
    'Administrator',
    'admin',
    '$2y$10$nxet7vRO1PmV7AqN5ytvdeZZbKSKfim4t7zU2URMlNYPJYtw.am36',
    'super_admin',
    '081234567890',
    'Denpasar, Bali'
),
(
    'I Made Wijaya',
    'madewijaya',
    '$2y$10$nxet7vRO1PmV7AqN5ytvdeZZbKSKfim4t7zU2URMlNYPJYtw.am36',
    'pemohon',
    '081111111111',
    'Denpasar, Bali'
),
(
    'Ni Luh Sari',
    'niluhsari',
    '$2y$10$nxet7vRO1PmV7AqN5ytvdeZZbKSKfim4t7zU2URMlNYPJYtw.am36',
    'pemohon',
    '082222222222',
    'Badung, Bali'
);

-- =====================================
-- DATA DUMMY KATEGORI PAKET
-- =====================================

INSERT INTO kategori_paket
(nama_kategori, deskripsi)
VALUES
(
    'Standar',
    'Paket layanan kremasi standar'
),
(
    'Premium',
    'Paket layanan kremasi premium'
),
(
    'Tambahan',
    'Layanan tambahan kremasi'
);

-- =====================================
-- DATA DUMMY PAKET LAYANAN
-- =====================================

INSERT INTO paket_layanan
(id_kategori, nama_paket, harga, fasilitas)
VALUES
(
    1,
    'Paket Pitra Pradana',
    3000000,
    'Layanan kremasi standar, tempat abu sederhana, sertifikat kremasi, konsultasi administrasi, penanganan jenazah, koordinasi jadwal kremasi'
),
(
    1,
    'Paket Yadnya Madya',
    4000000,
    'Layanan kremasi standar, tempat abu keluarga, sertifikat kremasi, ruang tunggu keluarga, penanganan jenazah, konsultasi prosesi, dokumentasi foto dasar'
),
(
    2,
    'Paket Pitra Utama',
    6000000,
    'Layanan kremasi premium, tempat abu premium, sertifikat kremasi, ruang tunggu eksklusif, dokumentasi foto profesional, dokumentasi video singkat, konsultasi keluarga, penanganan prioritas'
),
(
    2,
    'Paket Agni Mukti Utama',
    8000000,
    'Layanan kremasi VIP, tempat abu premium, sertifikat kremasi, ruang tunggu VIP, dokumentasi foto profesional, dokumentasi video lengkap, pengantaran abu, pendampingan prosesi, penanganan prioritas, konsumsi keluarga'
),
(
    3,
    'Dokumentasi Prosesi Yadnya',
    500000,
    'Dokumentasi foto profesional, dokumentasi video prosesi, file digital resolusi tinggi, penyimpanan cloud selama 30 hari'
),
(
    3,
    'Layanan Pengantaran Tirta Abu',
    750000,
    'Pengantaran abu ke alamat keluarga, kemasan abu eksklusif, dokumentasi serah terima, layanan area Denpasar dan sekitarnya'
);

-- =====================================
-- DATA DUMMY PENDAFTARAN
-- =====================================

INSERT INTO pendaftaran
(
    kode_pendaftaran,
    id_user,
    id_paket,
    nama_almarhum,
    tanggal_lahir,
    tanggal_meninggal,
    tanggal_daftar,
    status,
    catatan
)
VALUES
(
    'KRM001',
    2,
    1,
    'I Wayan Sudarma',
    '1950-05-10',
    '2026-06-01',
    '2026-06-02',
    'Menunggu',
    'Menunggu konfirmasi jadwal'
),
(
    'KRM002',
    3,
    3,
    'Ni Ketut Arini',
    '1948-09-12',
    '2026-06-05',
    '2026-06-06',
    'Diproses',
    'Pembayaran telah diterima'
);

-- =====================================
-- DATA DUMMY PEMBAYARAN
-- =====================================

INSERT INTO pembayaran
(
    id_pendaftaran,
    tanggal_bayar,
    total_bayar,
    metode_pembayaran,
    status_pembayaran
)
VALUES
(
    1,
    '2026-06-02',
    3000000,
    'Transfer',
    'Belum Bayar'
),
(
    2,
    '2026-06-06',
    6000000,
    'QRIS',
    'Lunas'
);