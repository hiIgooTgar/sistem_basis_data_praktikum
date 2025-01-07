-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 05:28 AM
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
-- Database: `universitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `NIM` varchar(16) NOT NULL,
  `NAMA` varchar(64) NOT NULL,
  `ALAMAT` varchar(64) NOT NULL,
  `NO_HP` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`NIM`, `NAMA`, `ALAMAT`, `NO_HP`) VALUES
('111111', 'Akbar', 'Banyumas', 82465346),
('222222', 'Yusuf', 'Banyumas', 82465346),
('24SA11A159', 'Igo Tegar Prambudhy', 'Purbalingga', 8175456),
('333333', 'Malik', 'Purbalingga', 82465346),
('444444', 'Jamal', 'Tegal', 82465346);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(16) NOT NULL,
  `nama` varchar(32) DEFAULT NULL,
  `alamat` varchar(64) DEFAULT NULL,
  `prodi` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `prodi`) VALUES
(1, 'Igo Tegar', 'Purbalingga', 'Informatika'),
(2, 'Fleng', 'Banyumas', 'Sistem Informasi'),
(3, 'Bagus', 'Tegal', 'Informatika'),
(4, 'Deka', 'Magetan', 'Bisnis Digital'),
(5, 'Lenka', 'Ciamis', 'Ilmu Komunikasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
