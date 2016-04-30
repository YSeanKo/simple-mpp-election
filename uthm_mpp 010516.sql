-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2016 at 01:32 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uthm_mpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `jcalon`
--

CREATE TABLE IF NOT EXISTS `jcalon` (
  `id` int(5) NOT NULL,
  `id_pelajar` int(5) NOT NULL,
  `jumlah_undi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jcalon`
--

INSERT INTO `jcalon` (`id`, `id_pelajar`, `jumlah_undi`) VALUES
(46, 1, 0),
(47, 10, 0),
(48, 3, 0),
(49, 5, 0),
(50, 8, 0),
(51, 15, 0),
(52, 17, 0),
(53, 20, 0),
(54, 13, 0),
(55, 14, 0),
(56, 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jflag`
--

CREATE TABLE IF NOT EXISTS `jflag` (
  `id` int(2) NOT NULL,
  `status_pengundian` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jflag`
--

INSERT INTO `jflag` (`id`, `status_pengundian`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jpentadbir`
--

CREATE TABLE IF NOT EXISTS `jpentadbir` (
  `id` int(5) NOT NULL,
  `no_staf` varchar(8) NOT NULL,
  `nama_penuh` varchar(255) NOT NULL,
  `no_kp` varchar(12) NOT NULL,
  `kata_laluan` varchar(60) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jpentadbir`
--

INSERT INTO `jpentadbir` (`id`, `no_staf`, `nama_penuh`, `no_kp`, `kata_laluan`) VALUES
(3, 'admin', 'Administrator', '930201045266', '$2y$10$6Ny1rB5T1rIblBsMn7328O/QDKc2d6qxSdA8wqb7FweRhdw3etx46'),
(4, 'lecturer', 'Admin2', '940807015124', '$2y$10$6Ny1rB5T1rIblBsMn7328O/QDKc2d6qxSdA8wqb7FweRhdw3etx46');

-- --------------------------------------------------------

--
-- Table structure for table `jsesi`
--

CREATE TABLE IF NOT EXISTS `jsesi` (
  `id` int(11) NOT NULL,
  `nama` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jsesi`
--

INSERT INTO `jsesi` (`id`, `nama`) VALUES
(1, '2013/2014'),
(2, '2014/2015'),
(3, '2015/2016'),
(4, '2016/2017');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jcalon`
--
ALTER TABLE `jcalon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jflag`
--
ALTER TABLE `jflag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_pengundian` (`status_pengundian`);

--
-- Indexes for table `jpentadbir`
--
ALTER TABLE `jpentadbir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `no_staf` (`no_staf`),
  ADD UNIQUE KEY `no_kp` (`no_kp`);

--
-- Indexes for table `jsesi`
--
ALTER TABLE `jsesi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jcalon`
--
ALTER TABLE `jcalon`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `jpentadbir`
--
ALTER TABLE `jpentadbir`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `jsesi`
--
ALTER TABLE `jsesi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
