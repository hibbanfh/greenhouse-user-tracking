-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2019 at 11:04 AM
-- Server version: 10.1.38-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenhouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(200) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `waktu_dibuat`) VALUES
(1, 'admin', 'ec7e8cb03bbd6c684f30f62e139d347d', '2019-09-03 10:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `log_akses`
--

CREATE TABLE `log_akses` (
  `rekord` int(10) NOT NULL,
  `id_verifikasi` int(11) NOT NULL,
  `waktu_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_keluar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_akses`
--

INSERT INTO `log_akses` (`rekord`, `id_verifikasi`, `waktu_masuk`, `waktu_keluar`) VALUES
(1, 1, '2019-08-01 02:13:21', '2019-08-01 04:19:20'),
(2, 2, '2019-08-01 03:17:24', '2019-08-01 08:21:29'),
(3, 1, '2019-08-01 23:10:16', '2019-08-02 01:18:28'),
(4, 3, '2019-08-02 04:22:24', '2019-08-02 05:37:05'),
(5, 1, '2019-08-05 05:20:18', '2019-08-05 08:00:00'),
(6, 2, '2019-08-06 02:17:10', '2019-08-06 06:43:15'),
(7, 4, '2019-08-06 03:15:19', '2019-08-06 07:00:00'),
(8, 1, '2019-08-07 01:15:27', '2019-08-07 03:12:00'),
(9, 3, '2019-08-07 03:10:21', '2019-08-07 05:13:30'),
(10, 1, '2019-08-08 04:25:32', '2019-08-08 05:00:00'),
(11, 5, '2019-08-09 00:15:23', '2019-08-09 03:22:24'),
(12, 1, '2019-08-11 21:23:22', '2019-08-12 04:35:00'),
(13, 6, '2019-08-12 01:12:19', '2019-08-12 04:17:12'),
(14, 4, '2019-08-12 20:11:14', '2019-08-13 00:18:17'),
(15, 2, '2019-08-13 02:17:16', '2019-08-13 03:00:00'),
(16, 1, '2019-08-14 03:13:17', '2019-08-14 06:00:00'),
(17, 2, '2019-09-03 08:00:00', '2019-08-14 08:30:00'),
(18, 1, '2019-08-18 23:21:19', '2019-08-19 06:00:00'),
(19, 3, '2019-08-19 01:00:00', '2019-08-19 03:00:19'),
(20, 2, '2019-08-19 23:19:19', '2019-08-20 01:00:00'),
(21, 3, '2019-08-21 03:13:12', '2019-08-21 07:18:24'),
(22, 1, '2019-08-22 03:07:22', '2019-08-22 05:10:10'),
(23, 3, '2019-08-22 09:00:00', '2019-08-22 10:02:00'),
(24, 1, '2019-08-25 23:08:17', '2019-08-26 02:09:00'),
(25, 5, '2019-08-26 01:16:00', '2019-08-26 04:26:31'),
(26, 2, '2019-08-27 01:19:00', '2019-08-27 03:11:28'),
(27, 6, '2019-08-27 03:29:26', '2019-08-27 05:31:00'),
(28, 1, '2019-08-27 22:15:19', '2019-08-28 02:00:00'),
(29, 2, '2019-08-28 00:28:31', '2019-08-28 02:28:28'),
(32, 5, '2019-08-28 22:15:16', '2019-08-29 02:13:00'),
(33, 3, '2019-08-29 01:23:23', '2019-08-29 03:00:00'),
(34, 1, '2019-08-29 23:00:00', '2019-08-30 02:00:00'),
(35, 4, '2019-08-30 05:00:00', '2019-08-30 05:27:00'),
(36, 1, '2019-09-02 02:17:15', '2019-09-02 07:09:25'),
(37, 2, '2019-09-02 07:09:00', '2019-09-02 08:09:36'),
(38, 1, '2019-09-03 09:47:38', '2019-09-03 10:00:00'),
(39, 4, '2019-09-04 07:23:56', '2019-09-04 09:19:13'),
(40, 1, '2019-09-05 00:12:11', '2019-09-05 03:13:11'),
(41, 2, '2019-09-06 08:59:26', '2019-09-06 11:09:10'),
(42, 6, '2019-09-06 11:44:51', '2019-09-06 11:45:08'),
(43, 1, '2019-09-06 11:46:17', '2019-09-06 11:46:27'),
(44, 1, '2019-09-06 11:48:44', '2019-09-06 11:48:54'),
(45, 4, '2019-09-06 11:50:28', '2019-09-06 11:50:44'),
(46, 5, '2019-09-06 11:50:38', '2019-09-06 11:50:48'),
(47, 1, '2019-09-08 22:12:25', '2019-09-09 01:13:00'),
(48, 4, '2019-09-09 06:59:36', '2019-09-09 07:00:00'),
(49, 1, '2019-09-09 11:29:55', '2019-09-09 11:30:02'),
(50, 6, '2019-09-09 11:30:20', '2019-09-09 11:30:27'),
(51, 5, '2019-09-09 11:30:44', '2019-09-09 11:30:57'),
(52, 3, '2019-09-09 11:31:21', '2019-09-09 11:31:28'),
(53, 4, '2019-09-09 11:31:40', '2019-09-09 11:31:46'),
(54, 4, '2019-09-09 11:31:42', '2019-09-09 11:31:46'),
(55, 4, '2019-09-10 06:32:14', '2019-09-10 06:35:29'),
(56, 4, '2019-09-10 06:32:16', '2019-09-10 06:35:29'),
(57, 4, '2019-09-10 06:32:17', '2019-09-10 06:35:29'),
(58, 1, '2019-09-11 04:00:00', '2019-09-11 06:00:00'),
(59, 2, '2019-09-11 04:00:00', '2019-09-11 06:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `manajerial`
--

CREATE TABLE `manajerial` (
  `id_verifikasi` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `kode_rfid` varchar(12) NOT NULL,
  `waktu_pemberian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `waktu_penghentian` timestamp NULL DEFAULT NULL,
  `status_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manajerial`
--

INSERT INTO `manajerial` (`id_verifikasi`, `id_user`, `kode_rfid`, `waktu_pemberian`, `waktu_penghentian`, `status_user`) VALUES
(1, 1, '3460136060', '2019-09-02 20:31:17', NULL, 1),
(2, 2, '3453775436', '2019-09-04 07:21:53', NULL, 2),
(3, 3, '2820332992', '2019-09-04 07:21:43', NULL, 2),
(4, 4, '3453775276', '2019-08-25 20:23:44', NULL, 1),
(5, 5, '3453775356', '2019-09-06 09:14:09', '2019-09-06 09:14:09', 0),
(6, 6, '3453790780', '2019-09-04 07:21:49', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id_rfid` int(100) NOT NULL,
  `kode_rfid` varchar(12) NOT NULL,
  `status_kartu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`id_rfid`, `kode_rfid`, `status_kartu`) VALUES
(8, '2820332992', 1),
(9, '3453775276', 1),
(5, '3453775356', 1),
(2, '3453775436', 1),
(3, '3453790780', 1),
(4, '3458785228', 0),
(1, '3460136060', 1),
(6, '3460698108', 0),
(7, '3648048086', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nomor_hp` varchar(12) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `nomor_hp`, `waktu_dibuat`) VALUES
(1, 'Hibban F H', 'hibban_farhan@hotmail.com', '081312868364', '2019-05-05 22:31:36'),
(2, 'Putri R', 'putriranati@gmail.com', '081221904234', '2019-05-05 22:31:36'),
(3, 'Agus Juliana', 'gusjuli@gmail.com', '08132211241', '2019-07-10 00:24:51'),
(4, 'Ramdan Septiawan', 'ramdandenz@yahoo.com', '08131288877', '2019-07-10 00:24:51'),
(5, 'Anggita Minar F', 'anggita_ea@gmail.com', '08170226522', '2019-07-10 00:27:32'),
(6, 'Ulvie', 'ulvv@gmail.com', '08122188221', '2019-07-10 00:27:32'),
(7, 'Muhammad Masud', 'masudm@gmail.com', '08170216901', '2019-07-10 00:27:32'),
(8, 'Dwi Ari', 'ariamsa@gmail.com', '08180221189', '2019-07-10 00:27:32'),
(9, 'Haris Setiawan', 'harisassa@gmail.com', '087881043499', '2019-07-10 00:27:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `log_akses`
--
ALTER TABLE `log_akses`
  ADD PRIMARY KEY (`rekord`),
  ADD KEY `id_verifikasi` (`id_verifikasi`);

--
-- Indexes for table `manajerial`
--
ALTER TABLE `manajerial`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_rfid` (`kode_rfid`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`kode_rfid`),
  ADD KEY `id_rfid` (`id_rfid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log_akses`
--
ALTER TABLE `log_akses`
  MODIFY `rekord` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `manajerial`
--
ALTER TABLE `manajerial`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id_rfid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_akses`
--
ALTER TABLE `log_akses`
  ADD CONSTRAINT `log_akses_ibfk_1` FOREIGN KEY (`id_verifikasi`) REFERENCES `manajerial` (`id_verifikasi`);

--
-- Constraints for table `manajerial`
--
ALTER TABLE `manajerial`
  ADD CONSTRAINT `manajerial_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `manajerial_ibfk_2` FOREIGN KEY (`kode_rfid`) REFERENCES `rfid` (`kode_rfid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
