-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 08:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1d_jananfauzilhak`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` decimal(10,2) NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_ukt` int DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dana_saku_subsidi` decimal(10,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Fauzi', '202601001', 2, 4500000.00, 'Mandiri', 3, 'Budi Santoso', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', '202601002', 4, 5500000.00, 'Mandiri', 4, 'Supriyanto', NULL, NULL, NULL, NULL),
(3, 'Dewi Lestari', '202601003', 2, 3500000.00, 'Mandiri', 2, 'Hadi Wijaya', NULL, NULL, NULL, NULL),
(4, 'Eko Prasetyo', '202601004', 6, 6500000.00, 'Mandiri', 5, 'Rahmat Hidayat', NULL, NULL, NULL, NULL),
(5, 'Fitriani', '202601005', 4, 4500000.00, 'Mandiri', 3, 'Mulyono', NULL, NULL, NULL, NULL),
(6, 'Gilang Permana', '202601006', 2, 5500000.00, 'Mandiri', 4, 'Gunawan', NULL, NULL, NULL, NULL),
(7, 'Hendra Wijaya', '202601007', 6, 3500000.00, 'Mandiri', 2, 'Joko Susilo', NULL, NULL, NULL, NULL),
(8, 'Indah Permatasari', '202602001', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0981', 950000.00, NULL, NULL),
(9, 'Joko Tarub', '202602002', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0982', 950000.00, NULL, NULL),
(10, 'Kartika Putri', '202602003', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0983', 950000.00, NULL, NULL),
(11, 'Lutfi Hakim', '202602004', 6, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0984', 1100000.00, NULL, NULL),
(12, 'Mega Utami', '202602005', 4, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0985', 950000.00, NULL, NULL),
(13, 'Naufal Abdi', '202602006', 2, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0986', 950000.00, NULL, NULL),
(14, 'Putra Pratama', '202602007', 6, 0.00, 'Bidikmisi', NULL, NULL, 'KIP-K-2026-0987', 1100000.00, NULL, NULL),
(15, 'Qori Aina', '202603001', 4, 1500000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.30),
(16, 'Riyan Hidayat', '202603002', 2, 1000000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'PT Telkom Indonesia', 3.50),
(17, 'Sania Rahma', '202603003', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', 3.25),
(18, 'Taufik Hidayat', '202603004', 4, 2000000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', 3.40),
(19, 'Umar Bakri', '202603005', 2, 1500000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Yayasan Supersemar', 3.00),
(20, 'Vina Panduwinata', '202603006', 4, 1200000.00, 'Prestasi', NULL, NULL, NULL, NULL, 'PT Pertamina', 3.50),
(21, 'Wawan Setiawan', '202603007', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', 3.25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `idx_unique_nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
