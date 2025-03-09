-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 05:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suratjalan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(20) NOT NULL,
  `SKU` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `SKU`, `name`, `price`, `stock`) VALUES
('Map7c0Sg8hLF2jZULxjp', 'SKU-1734787709-972', 'hilda', 9000, 50),
('B3nE3zEt6y7dlwIpICVK', 'SKU-1737462967-113', 'BUKU', 12000, 60);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `password`) VALUES
('Ecbw4JV6mOamsj7L1T0A', 'afifah', 'afifah@gmail.com', '123'),
('VQYS6415eo3Gk3SkFJD4', 'bila', 'bila@gmail.com', '123'),
('lAWx34rnDa6RzZLN2jwo', 'lila', 'lila@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `no_referensi` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `kurir` varchar(255) NOT NULL,
  `no_resi` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`id`, `customer`, `no_referensi`, `alamat`, `no_tlp`, `tanggal`, `pengirim`, `berat`, `kurir`, `no_resi`, `keterangan`, `created_at`) VALUES
(5, 'coba', 'HNDYEKAJ', 'DIMANA SAJA AKU BERADA', '837629639', '2024-12-22', 'BILA', 1.00, 'JNE', '36GNHEKA78', 'done', '2024-12-21 21:29:45'),
(6, 'bila', 'NGSJEKAU', 'SERUJO GG MACAN', '08213647928', '2024-12-23', 'BILA', 1.00, 'JNE', 'UEBDH738JEN', 'DONE', '2024-12-22 06:34:11'),
(7, 'afifah', 'FBNYSKND', 'SIDOARJO', '08765497', '2025-01-06', 'SHOPEE', 1.00, 'JNE', '674GNFR34', 'DONE', '2025-01-06 13:28:31'),
(8, 'AFIFAH', '5739DHSNAK', 'SIDOARJO', '0812345678', '2025-01-21', 'BILA', 1.00, 'JNE', '638DNYSLEK', 'SUDAH DIBAYAR', '2025-01-21 12:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan_produk`
--

CREATE TABLE `surat_jalan_produk` (
  `id` int(11) NOT NULL,
  `surat_jalan_id` int(11) NOT NULL,
  `sku_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) GENERATED ALWAYS AS (`qty` * `harga`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_jalan_produk`
--

INSERT INTO `surat_jalan_produk` (`id`, `surat_jalan_id`, `sku_produk`, `nama_produk`, `qty`, `harga`) VALUES
(1, 5, '10', 'bunga', 2, 6000.00),
(2, 5, '2', 'susu', 3, 7000.00),
(3, 6, '23', 'gigi', 1, 100000.00),
(4, 7, '20', 'BUKU', 2, 7000.00),
(5, 8, '12', 'BUKU', 2, 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `SKU` int(11) NOT NULL,
  `afifah` varchar(100) NOT NULL,
  `salsa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `SKU`, `afifah`, `salsa`) VALUES
(0, 0, '0', 3000),
(0, 0, '0', 4000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_jalan_produk`
--
ALTER TABLE `surat_jalan_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_jalan_id` (`surat_jalan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surat_jalan_produk`
--
ALTER TABLE `surat_jalan_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_jalan_produk`
--
ALTER TABLE `surat_jalan_produk`
  ADD CONSTRAINT `surat_jalan_produk_ibfk_1` FOREIGN KEY (`surat_jalan_id`) REFERENCES `surat_jalan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
