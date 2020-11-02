-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 05:00 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SIADMINKU_smk1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tmpt_lahir` varchar(20) NOT NULL,
  `tgl_lahir` datetime NOT NULL,
  `gol_awal` varchar(10) NOT NULL,
  `tmt_cpns` date NOT NULL,
  `tmt_pns` date NOT NULL,
  `gol_akhir` varchar(10) NOT NULL,
  `tmt` date NOT NULL,
  `masa_kerja` varchar(7) NOT NULL,
  `jenis_jabatan` varchar(20) NOT NULL,
  `nama_jabatan` varchar(40) NOT NULL,
  `pendidikan` varchar(40) NOT NULL,
  `ked_hukum` varchar(10) NOT NULL,
  `id_unit_kerja` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `jk`, `tmpt_lahir`, `tgl_lahir`, `gol_awal`, `tmt_cpns`, `tmt_pns`, `gol_akhir`, `tmt`, `masa_kerja`, `jenis_jabatan`, `nama_jabatan`, `pendidikan`, `ked_hukum`, `id_unit_kerja`, `username`, `password`, `id_admin`) VALUES
(2, '198503042014042001', 'senta', 'L', '', '1970-01-01 00:00:00', 'I/a', '1970-01-17', '1970-01-09', 'I/a', '1970-01-30', '50 thn ', 'fungsional', 'aaaa', 'SMA', 'PNS kena h', 1, 'saya', '20c1a26a55039b30866c9d0aa51953ca', 0),
(3, '454', 'dia aja', 'P', 'aa', '0000-00-00 00:00:00', 'III/a', '0000-00-00', '0000-00-00', 'III/b', '0000-00-00', '', 'fungsional', '', 'SMA', 'Aktif', 1, 'dia', '465b1f70b50166b6d05397fca8d600b0', 0),
(4, '1234', 'der', 'L', 'dd', '2018-06-28 20:50:00', 'III/b', '2018-06-29', '2018-07-02', 'III/b', '2018-06-28', '', 'fungsional', 'dd', 'SMA', 'PNS kena h', 1, 'dera', '6bd48b1e57856137037bfee4dec8d57f', 0),
(5, '444', 'deqqq', 'L', 'sas', '2018-07-04 00:00:00', 'IV/a', '0000-00-00', '0000-00-00', 'IV/a', '0000-00-00', '', 'fungsional', '', 'SMA', 'Aktif', 1, 'deqq', '202cb962ac59075b964b07152d234b70', 0),
(6, '9999111', 'coba aja', 'L', '', '0000-00-00 00:00:00', 'II/d', '0000-00-00', '0000-00-00', 'III/c', '0000-00-00', '', 'fungsional', '', 'SMA', 'Aktif', 1, 'coba', 'c3ec0f7b054e729c5a716c8125839829', 0),
(7, '111111111111111111', 'as', 'L', 's', '2018-11-01 00:00:00', 'I/a', '2018-11-08', '2018-11-06', 'I/a', '2018-11-08', '1 thn 1', 'umum', 'aaa', 'S1', 'Aktif', 1, 'a', '0cc175b9c0f1b6a831c399e269772661', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(10) NOT NULL,
  `nama_unit_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`) VALUES
(1, 'PUSKESMAS NENEY'),
(2, 'PUSKESMAS DATARAN ISIM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit_kerja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
