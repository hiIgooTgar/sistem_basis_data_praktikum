-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 05:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `24sa11a159`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbdetailbeli`
--

CREATE TABLE `tbdetailbeli` (
  `notabeli` varchar(16) NOT NULL,
  `idproduk` varchar(16) DEFAULT NULL,
  `jumlah` smallint(6) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbdetailjual`
--

CREATE TABLE `tbdetailjual` (
  `notajual` varchar(16) DEFAULT NULL,
  `idproduk` varchar(16) DEFAULT NULL,
  `jumlah` smallint(6) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbkaryawan`
--

CREATE TABLE `tbkaryawan` (
  `idkaryawan` varchar(11) NOT NULL,
  `namakaryawan` varchar(62) NOT NULL,
  `teleponkaryawan` varchar(16) NOT NULL,
  `jabatan` varchar(32) DEFAULT NULL,
  `sandi` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkaryawan`
--

INSERT INTO `tbkaryawan` (`idkaryawan`, `namakaryawan`, `teleponkaryawan`, `jabatan`, `sandi`) VALUES
('KRY-1', 'Arsila', '089625113', 'Owner', 'sila'),
('KRY-2', 'Perwira', '08247364', 'Supervisor', 'wira'),
('KRY-3', 'Misha', '081734764', 'Admin', 'misha'),
('KRY-4', 'Ica', '089473436', 'Kasir 1', 'kasir1'),
('KRY-5', 'Agus', '08387383', 'Kasir 2', 'kasir1');

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `idkategori` varchar(11) NOT NULL,
  `namakategori` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkategori`
--

INSERT INTO `tbkategori` (`idkategori`, `namakategori`) VALUES
('KEY-1', 'Komputer'),
('KEY-2', 'Printer'),
('KEY-3', 'Alat Input'),
('KEY-4', 'Aksesoris Komputer'),
('KEY-5', 'Web Camera'),
('KEY-6', 'Monitor'),
('KEY-7', 'Media penyimpanan data');

-- --------------------------------------------------------

--
-- Table structure for table `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `idpelanggan` varchar(11) NOT NULL,
  `namapelanggan` varchar(64) NOT NULL,
  `alamatpelanggan` varchar(32) NOT NULL,
  `teleponpelanggan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpelanggan`
--

INSERT INTO `tbpelanggan` (`idpelanggan`, `namapelanggan`, `alamatpelanggan`, `teleponpelanggan`) VALUES
('C-1', 'Adi Gunawan', 'Purwokerto', '083434343'),
('C-2', 'Bia Ramadhan', 'Purwokerto', '08244637'),
('C-3', 'Cici Kirana', 'Banyumas', '082217362'),
('C-4', 'Dona Ariana', 'Purbalingga', '086476423'),
('C-5', 'Emilia', 'Banyumas', '085754545'),
('C-6', 'Fino Barlian', 'Banyumas', '085354454'),
('C-7', 'Gita Gustian', 'Purwokerto', '0856767676'),
('C-8', 'Hanum Permata', 'Purbalingga', '08243434');

-- --------------------------------------------------------

--
-- Table structure for table `tbpemasok`
--

CREATE TABLE `tbpemasok` (
  `idpemasok` varchar(11) NOT NULL,
  `namapemasok` varchar(64) NOT NULL,
  `kontak` varchar(16) NOT NULL,
  `pic` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpemasok`
--

INSERT INTO `tbpemasok` (`idpemasok`, `namapemasok`, `kontak`, `pic`) VALUES
('Spl-1', 'PT Inovasi Sukses Bersama', '0874637463', 'Ilham Sentosa'),
('Spl-2', 'CV. Zara Tech Achievement', '0849389834', 'Zara Zulaikha'),
('Spl-3', 'PT Integra Autona Solusi', '0894834737', 'Sultan'),
('Spl-4', 'PT Jete Tenaga Indonesia', '087437434', 'Arya Seloka'),
('Spl-5', 'PT Inovasi Kreasi Sarana Prima', '085874584', 'Wiryaman'),
('Spl-6', 'PT Jaya Utama', '0834348734', 'Wijaya'),
('Spl-7', 'PT Daveeno Group Indonesia', '0827242424', 'Davino Suharjo');

-- --------------------------------------------------------

--
-- Table structure for table `tbpembelian`
--

CREATE TABLE `tbpembelian` (
  `notabeli` varchar(16) NOT NULL,
  `tglbeli` date NOT NULL,
  `idkaryawan` varchar(4) DEFAULT NULL,
  `idpemasok` varchar(4) DEFAULT NULL,
  `totalbeli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbpenjualan`
--

CREATE TABLE `tbpenjualan` (
  `notajual` varchar(16) NOT NULL,
  `tgljual` date NOT NULL,
  `idkaryawan` varchar(4) DEFAULT NULL,
  `idpelanggan` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbproduk`
--

CREATE TABLE `tbproduk` (
  `idproduk` varchar(11) NOT NULL,
  `namaproduk` varchar(64) NOT NULL,
  `idkategori` varchar(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbproduk`
--

INSERT INTO `tbproduk` (`idproduk`, `namaproduk`, `idkategori`, `stok`, `harga`) VALUES
('Prd-1', 'Acer', 'KEY-1', 10, 7000000),
('Prd-2', 'Asus', 'KEY-1', 20, 7000000),
('Prd-3', 'Epson', 'KEY-2', 5, 2500000),
('Prd-4', 'SPC', 'KEY-6', 5, 1500000),
('Prd-5', 'SeaGate', 'KEY-7', 5, 1500000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbdetailbeli`
--
ALTER TABLE `tbdetailbeli`
  ADD KEY `notabeli` (`notabeli`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `tbdetailjual`
--
ALTER TABLE `tbdetailjual`
  ADD KEY `idproduk` (`idproduk`),
  ADD KEY `notajual` (`notajual`);

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
  ADD CONSTRAINT `tbdetailbeli_ibfk_1` FOREIGN KEY (`notabeli`) REFERENCES `tbpembelian` (`notabeli`),
  ADD CONSTRAINT `tbdetailbeli_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `tbproduk` (`idproduk`);

--
-- Constraints for table `tbdetailjual`
--
ALTER TABLE `tbdetailjual`
  ADD CONSTRAINT `tbdetailjual_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `tbproduk` (`idproduk`),
  ADD CONSTRAINT `tbdetailjual_ibfk_2` FOREIGN KEY (`notajual`) REFERENCES `tbpenjualan` (`notajual`);

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
