-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 11:46 AM
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
-- Database: `restoran_sbd`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cur_alamatusers` ()   BEGIN
DECLARE nama_users VARCHAR(64);
DECLARE exit_loop BOOLEAN;
DECLARE cursor1 CURSOR FOR
SELECT nama FROM users WHERE alamat = 'Banyumas';

DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;

OPEN cursor1;
ulang: LOOP
FETCH cursor1 INTO nama_users;
SELECT nama AS 'Daftar data users yang berdomusili di Banyumas'
FROM users
WHERE alamat = 'Banyumas';
IF exit_loop THEN
CLOSE cursor1;
LEAVE ulang;
END IF;
END LOOP ulang;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cur_cariusers` (`id` INT(11))   BEGIN
DECLARE nama_users VARCHAR(64);
DECLARE cursor1 CURSOR FOR
SELECT nama FROM users WHERE id_users = id;

DECLARE EXIT HANDLER FOR 1329
	BEGIN 
	SELECT CONCAT('Data users ' , id, ' tidak ditemukan!') AS message;
	END;

OPEN cursor1;
FETCH cursor1 INTO nama_users;
SELECT nama_users;
CLOSE cursor1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jumlahMakanan` (OUT `hasil` INT)   BEGIN 
	SELECT COUNT(*) INTO hasil FROM makanan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahMinuman` (IN `id_minuman` INT(11), IN `nama_minuman` VARCHAR(64), IN `harga` INT(11))   BEGIN 
	INSERT INTO minuman(id_minuman, nama_minuman, harga)
	VALUES(id_minuman, nama_minuman, harga);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `jumlahBayarFunction` (`id` INT(11)) RETURNS INT(11)  BEGIN
	DECLARE jumlah INT;
	SELECT total_pesanan INTO jumlah FROM detail_pesanan
	WHERE id_pesanan = id;
	RETURN jumlah;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jumlahBayarFunctionSecond` (`p_harga` INT(11)) RETURNS INT(11)  BEGIN
	DECLARE jumlah INT;
	SELECT COUNT(total_pesanan) INTO jumlah FROM detail_pesanan
	WHERE total_pesanan < p_harga;
	RETURN jumlah;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_makanan` int(11) DEFAULT NULL,
  `jumlah_makanan` int(11) DEFAULT NULL,
  `id_minuman` int(11) DEFAULT NULL,
  `jumlah_minuman` int(11) DEFAULT NULL,
  `total_pesanan` int(11) DEFAULT NULL,
  `id_pesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_makanan`, `jumlah_makanan`, `id_minuman`, `jumlah_minuman`, `total_pesanan`, `id_pesanan`) VALUES
(1, 1, 1, 3, 1, 23000, 1),
(2, 4, 1, 4, 1, 27000, 2),
(4, 5, 1, 6, 1, 21000, 3),
(5, 6, 1, 5, 1, 21000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `id_makanan` int(11) NOT NULL,
  `nama_makanan` varchar(64) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id_makanan`, `nama_makanan`, `harga`) VALUES
(1, 'Nasi Uduk Ikan Teri Balado', 18000),
(3, 'Ayam Bakar', 13000),
(4, 'Sate Kambing', 20000),
(5, 'Bakmi Jawa', 15000),
(6, 'Ayam Goreng Kremes', 15000),
(7, 'Mie Rebus', 12000);

--
-- Triggers `makanan`
--
DELIMITER $$
CREATE TRIGGER `tr_cekharga` BEFORE INSERT ON `makanan` FOR EACH ROW BEGIN
IF NEW.harga <= 8000 THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'cek kembali harga makanan!';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `minuman`
--

CREATE TABLE `minuman` (
  `id_minuman` int(11) NOT NULL,
  `nama_minuman` varchar(64) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minuman`
--

INSERT INTO `minuman` (`id_minuman`, `nama_minuman`, `harga`) VALUES
(1, 'Es Teh Manis', 4000),
(3, 'Es Kopi', 5000),
(4, 'Jus Buah', 7000),
(5, 'Wedang Ronde', 6000),
(6, 'Teh Susu', 6000),
(7, 'Energen', 2500),
(8, 'Teh Tarik', 7000);

--
-- Triggers `minuman`
--
DELIMITER $$
CREATE TRIGGER `tr_hapusminuman` BEFORE DELETE ON `minuman` FOR EACH ROW BEGIN 
	IF OLD.id_minuman = OLD.id_minuman THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Data minuman tidak dapat dihapus';
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `metode_pembayaran` enum('cash','debit','qris') DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `id_pesanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `jumlah_bayar`, `metode_pembayaran`, `tgl_pembayaran`, `id_pesanan`) VALUES
(1, 23000, 'cash', '2025-01-07 12:28:05', 1),
(2, 27000, 'qris', '2025-01-06 12:39:01', 2),
(3, 21000, 'cash', '2025-01-05 12:39:26', 3),
(4, 21000, 'debit', '2025-01-07 12:39:47', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `tgl_pesanan` datetime DEFAULT NULL,
  `status_pesanan` enum('proses','diterima','gagal') DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `tgl_pesanan`, `status_pesanan`, `id_users`) VALUES
(1, '2025-01-07 12:26:33', 'diterima', 2),
(2, '2025-01-06 12:28:36', 'diterima', 3),
(3, '2025-01-05 12:28:55', 'diterima', 5),
(4, '2025-01-07 12:29:12', 'proses', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `no_telp` char(16) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `nama`, `gender`, `no_telp`, `alamat`, `role`) VALUES
(1, 'admin', '$2y$10$evhNpw8VoAjfapcD3f0Uq.9mhTNV35.QAKzpROq4.a8lTrMKwLkge', 'Admin Restoran', 'L', '0892342352411', 'Purbalingga Kidul', 0),
(2, 'igo', '$2y$10$mVmnQYu5/etdRZ4xwOP7LeNxWQ6F9/x9YpGqipLMkCx0mgOZFGgHy', 'Igo Tegar', 'L', '089235263521', 'Purbalingga Kidul', 1),
(3, 'sasa', '$2y$10$aDbUmJc43vBQEkMOEyRYe.m4yS1biXKSsMbC7ZpBJ53W.PODGrB/G', 'Sasa Saputri', 'P', '08128923621', 'Purwokerto', 1),
(5, 'elsa', '$2y$10$hDa9mHrkt1Sn448nr9nVpudUluYo/mO66URHyObS3cLhQwNdyWJNi', 'Elsa Indah Permatasari', 'P', '081623762121', 'Purbalingga Kidul', 1),
(6, 'hasan', '$2y$10$4vtbpxPWbglGIVzrPGKZ4O3zOD8QkAz75Ftq5mIW6oN/mdtzdPeLa', 'Hasan Lucky Sanjaya', 'L', '0853524325431', 'Banyumas', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `detail_pesanan_ibfk_2` (`id_makanan`),
  ADD KEY `detail_pesanan_ibfk_3` (`id_minuman`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id_makanan`);

--
-- Indexes for table `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`id_minuman`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `pesanan_ibfk_3` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id_makanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `minuman`
--
ALTER TABLE `minuman`
  MODIFY `id_minuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_makanan`) REFERENCES `makanan` (`id_makanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`id_minuman`) REFERENCES `minuman` (`id_minuman`),
  ADD CONSTRAINT `detail_pesanan_ibfk_4` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
