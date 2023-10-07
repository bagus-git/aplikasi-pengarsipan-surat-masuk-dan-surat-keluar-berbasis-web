-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2018 at 05:33 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `no_disposisi` varchar(16) NOT NULL,
  `no_agenda` varchar(15) NOT NULL,
  `no_surat` varchar(15) NOT NULL,
  `kepada` varchar(30) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `status_surat` varchar(15) NOT NULL,
  `tanggapan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`no_disposisi`, `no_agenda`, `no_surat`, `kepada`, `keterangan`, `status_surat`, `tanggapan`) VALUES
('1', '1', '1', 'saya', 'baik', 'ok', 'sip');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` varchar(15) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama _belakang` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hak` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_depan`, `nama _belakang`, `password`, `hak`) VALUES
('1', 'bagus', 'adi', 'jali', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `no_agenda` varchar(15) NOT NULL,
  `id` varchar(15) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  `tanggal_kirim` varchar(15) NOT NULL,
  `no_surat` varchar(15) NOT NULL,
  `pengirim` varchar(30) NOT NULL,
  `perihal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`no_agenda`, `id`, `jenis_surat`, `tanggal_kirim`, `no_surat`, `pengirim`, `perihal`) VALUES
('1', '1', 'pribadi', '6 january 2018', '1', 'bagus', '1');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `no_agenda` varchar(15) NOT NULL,
  `id` varchar(15) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  `tanggal_kirim` varchar(15) NOT NULL,
  `tanggal_terima` varchar(15) NOT NULL,
  `nomor_surat` varchar(15) NOT NULL,
  `pengirim` varchar(30) NOT NULL,
  `perihal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`no_agenda`, `id`, `jenis_surat`, `tanggal_kirim`, `tanggal_terima`, `nomor_surat`, `pengirim`, `perihal`) VALUES
('1', '1', 'pribadi', '1 january 2018', '2 january 2018', '1', 'bagus', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`no_disposisi`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD KEY `id` (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD KEY `no_agenda` (`no_agenda`),
  ADD KEY `id` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
