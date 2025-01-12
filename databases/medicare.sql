-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2025 pada 13.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicare`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `kode_dokter` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `spesialisasi` varchar(50) NOT NULL,
  `no_str` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `kode_dokter`, `nama_lengkap`, `spesialisasi`, `no_str`, `jenis_kelamin`, `no_telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'DR001', 'Dr. Budi Santoso, Sp.PD', 'Penyakit Dalam', 'STR/2020/123456', 'L', '081234567890', 'Jl. Kesehatan No. 10, Jakarta', '2025-01-12 09:17:11', '2025-01-12 09:17:11'),
(2, 'DR002', 'Dr. Siti Aminah, Sp.A', 'Anak', 'STR/2020/654321', 'P', '087654321098', 'Jl. Sehat No. 15, Jakarta', '2025-01-12 09:17:11', '2025-01-12 09:17:11'),
(12, 'DR003', 'Dr. Ahmad Hidayat, Sp.B', 'Bedah', 'STR/2020/003', 'L', '083456789012', 'Jl. Medika No. 20, Jakarta', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(13, 'DR004', 'Dr. Maya Putri, Sp.M', 'Mata', 'STR/2020/004', 'P', '084567890123', 'Jl. Dokter No. 25, Jakarta', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(14, 'DR005', 'Dr. Rudi Hartono, Sp.THT', 'THT', 'STR/2020/005', 'L', '085678901234', 'Jl. Rumah Sakit No. 30, Jakarta', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(15, 'DR006', 'Dr. Nina Sari, Sp.S', 'Saraf', 'STR/2020/006', 'P', '086789012345', 'Jl. Medis No. 35, Jakarta', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(16, 'DR007', 'Dr. Eko Prasetyo', 'Umum', 'STR/2020/007', 'L', '087890123456', 'Jl. Sehat No. 40, Jakarta', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(17, 'DR008', 'Dr. Lisa Permata', 'Umum', 'STR/2020/008', 'P', '088901234567', 'Jl. Dokter No. 45, Jakarta', '2025-01-12 12:44:20', '2025-01-12 12:44:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `jenis_obat` enum('Tablet','Kapsul','Sirup','Salep','Injeksi') NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `kode_obat`, `nama_obat`, `jenis_obat`, `stok`, `harga_satuan`, `tanggal_kadaluarsa`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'OBT001', 'Paracetamol 500mg', 'Tablet', 100, 5000.00, '2025-12-31', 'Obat pereda nyeri dan penurun panas', '2025-01-12 09:17:11', '2025-01-12 09:17:11'),
(2, 'OBT002', 'Amoxicillin 500mg', 'Kapsul', 50, 15000.00, '2025-06-30', 'Antibiotik spektrum luas', '2025-01-12 09:17:11', '2025-01-12 09:17:11'),
(4, 'OBT003', 'Omeprazole 20mg', 'Kapsul', 50, 12000.00, '2025-08-31', 'Obat maag dan asam lambung', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(5, 'OBT004', 'Cetirizine 10mg', 'Tablet', 80, 8000.00, '2025-09-30', 'Antihistamin untuk alergi', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(6, 'OBT005', 'Paracetamol Syrup', 'Sirup', 30, 20000.00, '2024-12-31', 'Obat penurun panas untuk anak', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(7, 'OBT006', 'Salbutamol Inhaler', 'Injeksi', 25, 65000.00, '2025-03-31', 'Obat asma', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(8, 'OBT007', 'Betamethasone Cream', 'Salep', 40, 25000.00, '2024-11-30', 'Krim anti radang kulit', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(9, 'OBT008', 'Vitamin C 500mg', 'Tablet', 150, 3000.00, '2025-10-31', 'Suplemen vitamin C', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(10, 'OBT009', 'Antasida Syrup', 'Sirup', 45, 18000.00, '2024-10-31', 'Obat maag cair', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(11, 'OBT010', 'Ibuprofen 400mg', 'Tablet', 90, 6000.00, '2025-05-31', 'Obat anti inflamasi', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(12, 'OBT011', 'Ranitidine 150mg', 'Tablet', 8, 7500.00, '2025-04-30', 'Obat maag dan asam lambung', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(13, 'OBT012', 'Dexamethasone 0.5mg', 'Tablet', 5, 4000.00, '2025-07-31', 'Obat anti radang', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(14, 'OBT013', 'Metformin 500mg', 'Tablet', 60, 9000.00, '2025-02-28', 'Obat diabetes', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(15, 'OBT014', 'Amlodipine 5mg', 'Tablet', 70, 8500.00, '2025-01-31', 'Obat tekanan darah tinggi', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(16, 'OBT015', 'Simvastatin 20mg', 'Tablet', 55, 11000.00, '2025-03-31', 'Obat kolesterol', '2025-01-12 12:44:20', '2025-01-12 12:44:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nomor_rm` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `golongan_darah` enum('A','B','AB','O') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `nomor_rm`, `nama_lengkap`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `nomor_telepon`, `golongan_darah`, `created_at`, `updated_at`) VALUES
(1, 'RM001', 'Budi Santoso', '1990-05-15', 'L', 'Jl. Merdeka No. 123, Jakarta', '081234567890', 'O', '2025-01-12 06:57:29', '2025-01-12 06:57:29'),
(2, 'RM002', 'Siti Rahayu', '1985-08-22', 'P', 'Jl. Harmony No. 45, Bandung', '087654321098', 'B', '2025-01-12 06:57:29', '2025-01-12 06:57:29'),
(5, 'RM00003', 'Ahmad Rizky', '1995-11-30', 'L', 'Jl. Anggrek No. 3, Jakarta', '083456789012', 'O', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(6, 'RM00004', 'Maya Sari', '1988-04-18', 'P', 'Jl. Dahlia No. 4, Jakarta', '084567890123', 'AB', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(7, 'RM00005', 'Doni Kusuma', '1992-09-25', 'L', 'Jl. Tulip No. 5, Jakarta', '085678901234', 'A', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(8, 'RM00006', 'Rina Wati', '1987-01-12', 'P', 'Jl. Kenanga No. 6, Jakarta', '086789012345', 'B', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(9, 'RM00007', 'Eko Santoso', '1993-06-28', 'L', 'Jl. Lotus No. 7, Jakarta', '087890123456', 'O', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(10, 'RM00008', 'Dewi Lestari', '1991-12-05', 'P', 'Jl. Kamboja No. 8, Jakarta', '088901234567', 'AB', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(11, 'RM00009', 'Bambang Tri', '1986-08-20', 'L', 'Jl. Teratai No. 9, Jakarta', '089012345678', 'A', '2025-01-12 12:44:20', '2025-01-12 12:44:20'),
(12, 'RM00010', 'Linda Permata', '1994-02-14', 'P', 'Jl. Jasmine No. 10, Jakarta', '081123456789', 'B', '2025-01-12 12:44:20', '2025-01-12 12:44:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin', '2025-01-12 06:57:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_dokter` (`kode_dokter`),
  ADD UNIQUE KEY `no_str` (`no_str`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_obat` (`kode_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_rm` (`nomor_rm`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
