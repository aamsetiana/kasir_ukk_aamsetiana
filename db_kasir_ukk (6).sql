-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 03:59 PM
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
(105, 102, 30, 10, 300000),
(106, 103, 32, 10, 50000),
(107, 104, 34, 50, 250000),
(108, 105, 28, 10, 50000),
(109, 106, 31, 2, 16000);

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
  `email` varchar(150) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `no_faktur`, `tgl_penjualan`, `email`, `total`) VALUES
(102, '202402290001', '2024-02-29 20:41:55', 'destaerlangga@gmail.com', 300000),
(103, '202402290002', '2024-02-29 20:57:25', 'destaerlangga@gmail.com', 50000),
(104, '202402290003', '2024-02-29 21:22:59', 'destaerlangga@gmail.com', 250000),
(105, '202402290004', '2024-02-29 21:35:36', 'destaerlangga@gmail.com', 50000),
(106, '202402290005', '2024-02-29 21:48:43', 'destaerlangga@gmail.com', 16000);

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
(26, '8999908000101', 'SABUN ZF', 5000, 10000, 4, 17, 200),
(27, '8999908000200', 'TEH GELAS', 5000, 10000, 4, 8, 500),
(28, '8999908000705', 'TEH KOTAK', 3000, 5000, 4, 8, 490),
(29, '8999908000903', 'MINYAK GORENG SANIA 2 LITER', 15000, 20000, 6, 19, 400),
(30, '8999908001108', 'WHISKAS 1 KG', 20000, 30000, 17, 23, 90),
(31, '8999908001207', 'SARI ROTI', 4000, 8000, 4, 19, 398),
(32, '8999908001603', 'LE MINERALE', 3000, 5000, 4, 8, 190),
(33, '8999908001801', 'INDOMIE RENDANG', 2000, 5000, 4, 8, 100),
(34, '8999908002006', 'SHAMPO CLEAR', 2000, 5000, 2, 17, 0),
(35, '8999908005007', 'SABUN DETOL', 5000, 10000, 4, 17, 100),
(36, '8999908005106', 'SABUN CITRA', 5000, 7000, 4, 17, 100);

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
  `email` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `nama_user` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` enum('Admin','Kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`email`, `username`, `nama_user`, `password`, `level`) VALUES
('aamsetiana@gmail.com', 'amse', 'Aam Setiana', '202cb962ac59075b964b07152d234b70', 'Admin'),
('destaerlangga@gmail.com', 'desz', 'Desta Erlangga', '202cb962ac59075b964b07152d234b70', 'Kasir'),
('hansohe@gmail.com', 'sohe', 'Hansohee', '202cb962ac59075b964b07152d234b70', 'Kasir'),
('tes@gmail.com', 'as', 'us', '202cb962ac59075b964b07152d234b70', 'Admin');

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
  ADD KEY `email` (`email`);

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
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_penjualan`
--
ALTER TABLE `tbl_detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
