-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 05:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir_ukk`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_produk` ()   SELECT tbl_produk.id_produk,tbl_produk.kode_produk,tbl_produk.nama_produk,tbl_kategori.nama_kategori,tbl_satuan.nama_satuan,
tbl_produk.harga_beli,tbl_produk.harga_jual,
tbl_produk.stok
FROM tbl_produk
JOIN tbl_satuan on tbl_satuan.id_satuan=tbl_produk.id_satuan
join tbl_kategori on tbl_kategori.id_kategori=tbl_produk.id_kategori
WHERE stok > 0$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_penjualan`
--

CREATE TABLE `tbl_detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_detail_penjualan`
--

INSERT INTO `tbl_detail_penjualan` (`id_detail`, `id_penjualan`, `id_produk`, `qty`, `total_harga`) VALUES
(84, 83, 20, 10, 80000),
(85, 83, 20, 5, 40000),
(86, 83, 21, 5, 35000),
(87, 84, 22, 10, 80000),
(88, 85, 21, 45, 315000),
(89, 86, 22, 5, 40000),
(90, 87, 20, 5, 40000),
(91, 88, 22, 5, 40000),
(92, 89, 21, 2, 14000);

--
-- Triggers `tbl_detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangiStok` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_produk SET tbl_produk.stok = tbl_produk.stok - NEW.qty
WHERE tbl_produk.id_produk = NEW.id_produk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nambahtotalharga` AFTER INSERT ON `tbl_detail_penjualan` FOR EACH ROW UPDATE tbl_penjualan SET tbl_penjualan.total = tbl_penjualan.total + NEW.total_harga
WHERE tbl_penjualan.id_penjualan= NEW.id_penjualan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(8, 'MINUMAN'),
(17, 'ALAT MANDI'),
(19, 'MAKANAN'),
(20, 'SNACK'),
(21, 'ALAT DAPUR'),
(22, 'ALAT TULIS'),
(23, 'MAKANAN KUCING');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `no_faktur` varchar(250) NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `username` varchar(150) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `no_faktur`, `tgl_penjualan`, `username`, `total`) VALUES
(83, '202402260001', '2024-02-26 19:36:52', 'mici', 155000),
(84, '202402260002', '2024-02-26 22:51:45', 'destaerlangga', 80000),
(85, '202402260003', '2024-02-26 23:22:02', 'destaerlangga', 315000),
(86, '202402270001', '2024-02-27 07:48:03', 'destaerlangga', 40000),
(87, '202402270002', '2024-02-27 10:44:33', 'arifhidayat', 40000),
(88, '202402270003', '2024-02-27 11:21:37', 'arifhidayat', 40000),
(89, '202402270004', '2024-02-27 14:49:45', 'arifhidayat', 14000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(250) NOT NULL,
  `nama_produk` varchar(250) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `id_satuan`, `id_kategori`, `stok`) VALUES
(19, 'BRG001', 'COCA COLA 50 ML', 10000, 10000, 4, 8, 100),
(20, 'BRG002', 'SARI ROTI', 5000, 8000, 4, 19, 130),
(21, 'BRG003', 'SARI GANDUM', 5000, 7000, 2, 19, 0),
(22, 'BRG004', 'SHAMPO CLEAR', 5000, 8000, 2, 17, 180),
(25, 'BRG007', 'SABUN ZF', 15000, 20000, 4, 17, 500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES
(2, 'SACHET'),
(3, 'BOX'),
(4, 'UNIT'),
(5, 'BALL'),
(6, 'LITER'),
(14, 'MINUMAN'),
(17, 'KG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(150) NOT NULL,
  `nama_user` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` enum('Admin','Kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `nama_user`, `password`, `level`) VALUES
('aamsetiana', 'Aam Setiana', '202cb962ac59075b964b07152d234b70', 'Admin'),
('arifhidayat', 'Arif Hidayat', '202cb962ac59075b964b07152d234b70', 'Kasir'),
('destaerlangga', 'Desta Erlangga', '202cb962ac59075b964b07152d234b70', 'Kasir'),
('micie', 'Michie', '202cb962ac59075b964b07152d234b70', 'Kasir'),
('zakiamali', 'Zaki Amali', '202cb962ac59075b964b07152d234b70', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `tbl_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
