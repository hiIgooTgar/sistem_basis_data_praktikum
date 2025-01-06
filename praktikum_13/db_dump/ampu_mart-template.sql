-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 02:24 PM
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
-- Database: `ampu_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbdetailbeli`
--

CREATE TABLE `tbdetailbeli` (
  `notabeli` varchar(15) NOT NULL,
  `idproduk` varchar(15) DEFAULT NULL,
  `jumlah` smallint(6) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbdetailjual`
--

CREATE TABLE `tbdetailjual` (
  `notajual` varchar(15) NOT NULL,
  `idproduk` varchar(15) DEFAULT NULL,
  `jumlah` smallint(6) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbkaryawan`
--

CREATE TABLE `tbkaryawan` (
  `idkaryawan` varchar(5) NOT NULL,
  `namakaryawan` varchar(50) DEFAULT NULL,
  `teleponkaryawan` varchar(15) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `sandi` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `idkategori` varchar(3) NOT NULL,
  `namakategori` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `idpelanggan` varchar(10) NOT NULL,
  `namapelanggan` varchar(50) DEFAULT NULL,
  `alamatpelanggan` varchar(20) DEFAULT NULL,
  `teleponpelanggan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbpemasok`
--

CREATE TABLE `tbpemasok` (
  `idpemasok` varchar(5) NOT NULL,
  `namapemasok` varchar(50) DEFAULT NULL,
  `kontak` varchar(25) DEFAULT NULL,
  `pic` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbpembelian`
--

CREATE TABLE `tbpembelian` (
  `notabeli` varchar(15) NOT NULL,
  `tglbeli` date DEFAULT NULL,
  `idkaryawan` varchar(5) DEFAULT NULL,
  `idpemasok` varchar(5) DEFAULT NULL,
  `totalbeli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbpenjualan`
--

CREATE TABLE `tbpenjualan` (
  `notajual` varchar(15) NOT NULL,
  `tgljual` date DEFAULT NULL,
  `idkaryawan` varchar(5) DEFAULT NULL,
  `idpelanggan` varchar(10) DEFAULT NULL,
  `totaljual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbproduk`
--

CREATE TABLE `tbproduk` (
  `idproduk` varchar(15) NOT NULL,
  `namaproduk` varchar(70) DEFAULT NULL,
  `idkategori` varchar(3) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbdetailbeli`
--
ALTER TABLE `tbdetailbeli`
  ADD PRIMARY KEY (`notabeli`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `tbdetailjual`
--
ALTER TABLE `tbdetailjual`
  ADD PRIMARY KEY (`notajual`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `tbkaryawan`
--
ALTER TABLE `tbkaryawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `tbpelanggan`
--
ALTER TABLE `tbpelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `tbpemasok`
--
ALTER TABLE `tbpemasok`
  ADD PRIMARY KEY (`idpemasok`);

--
-- Indexes for table `tbpembelian`
--
ALTER TABLE `tbpembelian`
  ADD PRIMARY KEY (`notabeli`),
  ADD KEY `idkaryawan` (`idkaryawan`),
  ADD KEY `idpemasok` (`idpemasok`);

--
-- Indexes for table `tbpenjualan`
--
ALTER TABLE `tbpenjualan`
  ADD PRIMARY KEY (`notajual`),
  ADD KEY `idkaryawan` (`idkaryawan`),
  ADD KEY `idpelanggan` (`idpelanggan`);

--
-- Indexes for table `tbproduk`
--
ALTER TABLE `tbproduk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbdetailbeli`
--
ALTER TABLE `tbdetailbeli`
  ADD CONSTRAINT `tbdetailbeli_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `tbproduk` (`idproduk`);

--
-- Constraints for table `tbdetailjual`
--
ALTER TABLE `tbdetailjual`
  ADD CONSTRAINT `tbdetailjual_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `tbproduk` (`idproduk`);

--
-- Constraints for table `tbpembelian`
--
ALTER TABLE `tbpembelian`
  ADD CONSTRAINT `tbpembelian_ibfk_1` FOREIGN KEY (`idkaryawan`) REFERENCES `tbkaryawan` (`idkaryawan`),
  ADD CONSTRAINT `tbpembelian_ibfk_2` FOREIGN KEY (`idpemasok`) REFERENCES `tbpemasok` (`idpemasok`);

--
-- Constraints for table `tbpenjualan`
--
ALTER TABLE `tbpenjualan`
  ADD CONSTRAINT `tbpenjualan_ibfk_1` FOREIGN KEY (`idkaryawan`) REFERENCES `tbkaryawan` (`idkaryawan`),
  ADD CONSTRAINT `tbpenjualan_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `tbpelanggan` (`idpelanggan`);

--
-- Constraints for table `tbproduk`
--
ALTER TABLE `tbproduk`
  ADD CONSTRAINT `tbproduk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `tbkategori` (`idkategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
