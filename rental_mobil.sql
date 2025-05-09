-- Membuat database
CREATE DATABASE IF NOT EXISTS rental_mobil;
USE rental_mobil;

-- Tabel: jenis_kendaraan
CREATE TABLE IF NOT EXISTS jenis_kendaraan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(20)
);

-- Tabel: armada
CREATE TABLE IF NOT EXISTS armada (
    id INT AUTO_INCREMENT PRIMARY KEY,
    merk VARCHAR(30),
    nopol VARCHAR(20),
    thn_beli INT,
    deskripsi VARCHAR(200),
    jenis_kendaraan_id INT,
    kapasitas_kursi INT,
    rating INT,
    FOREIGN KEY (jenis_kendaraan_id) REFERENCES jenis_kendaraan(id)
);

-- Tabel: peminjaman
CREATE TABLE IF NOT EXISTS peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_peminjam VARCHAR(45),
    ktp_peminjam VARCHAR(20),
    keperluan_pinjaman VARCHAR(100),
    mulai DATE,
    selesai DATE,
    biaya DOUBLE,
    armada_id INT,
    kontnr_peminjam VARCHAR(100),
    status_pinjaman VARCHAR(20),
    FOREIGN KEY (armada_id) REFERENCES armada(id)
);

-- Tabel: pembayaran
CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE,
    jumlah_bayar DOUBLE,
    peminjaman_id INT,
    FOREIGN KEY (peminjaman_id) REFERENCES peminjaman(id)
);

-- Isi data: jenis_kendaraan
INSERT INTO jenis_kendaraan (nama) VALUES 
('Sedan'),
('SUV'),
('MPV'),
('Pickup'),
('Van');

-- Isi data: armada
INSERT INTO armada (merk, nopol, thn_beli, deskripsi, jenis_kendaraan_id, kapasitas_kursi, rating) VALUES 
('Toyota Avanza', 'B1234CD', 2020, 'Mobil keluarga nyaman dan irit', 3, 7, 4),
('Honda HR-V', 'D5678EF', 2021, 'SUV modern dan stylish', 2, 5, 5),
('Suzuki Carry', 'F9012GH', 2019, 'Mobil pickup untuk angkut barang', 4, 2, 3);

-- Isi data: peminjaman
INSERT INTO peminjaman (nama_peminjam, ktp_peminjam, keperluan_pinjaman, mulai, selesai, biaya, armada_id, kontnr_peminjam, status_pinjaman) VALUES 
('Andi Prasetyo', '3276011234560001', 'Liburan keluarga ke Bandung', '2025-06-01', '2025-06-05', 1500000, 1, '081234567890', 'Selesai'),
('Siti Nurhaliza', '3276019876540002', 'Perjalanan bisnis ke Jakarta', '2025-06-10', '2025-06-12', 900000, 2, '082345678901', 'Aktif');

-- Isi data: pembayaran
INSERT INTO pembayaran (tanggal, jumlah_bayar, peminjaman_id) VALUES 
('2025-06-01', 1500000, 1),
('2025-06-10', 900000, 2);
