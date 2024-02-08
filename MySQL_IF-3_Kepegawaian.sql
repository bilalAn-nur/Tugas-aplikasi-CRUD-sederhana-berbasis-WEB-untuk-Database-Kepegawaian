-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 09:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datapegawai`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addUser` (IN `p_username` VARCHAR(50), IN `p_password` VARCHAR(255))   BEGIN
INSERT INTO users (username, password) VALUES (p_username, p_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusJabatan` (IN `p_id_jabatan` INT)   BEGIN
DELETE FROM jabatan WHERE id_jabatan = p_id_jabatan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapusPegawai` (IN `p_id` INT)   BEGIN
DELETE FROM pegawai WHERE id_karyawan = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahJabatan` (IN `p_nama_jabatan` VARCHAR(100), IN `p_deskripsi` VARCHAR(255), IN `p_gaji` DECIMAL(10,2))   BEGIN
INSERT INTO jabatan (nama_jabatan, deskripsi, gaji) VALUES (p_nama_jabatan, p_deskripsi, p_gaji);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambahPegawai` (IN `p_id_karyawan` VARCHAR(50), IN `p_nama` VARCHAR(100), IN `p_jenis_kelamin` VARCHAR(10), IN `p_alamat` VARCHAR(255), IN `p_id_jabatan` INT)  NO SQL BEGIN
INSERT INTO pegawai (id_karyawan,nama, jenis_kelamin, alamat, id_jabatan) VALUES (p_id_karyawan, p_nama, p_jenis_kelamin, p_alamat, p_id_jabatan);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateJabatan` (IN `p_id_jabatan` INT, IN `p_nama_jabatan` VARCHAR(100), IN `p_deskripsi` VARCHAR(255), IN `p_gaji` DECIMAL(10,2))   BEGIN
UPDATE jabatan SET nama_jabatan = p_nama_jabatan, deskripsi = p_deskripsi, gaji = p_gaji WHERE id_jabatan = p_id_jabatan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePegawai` (IN `p_id_karyawan` INT, IN `p_nama` VARCHAR(100), IN `p_jenis_kelamin` VARCHAR(10), IN `p_alamat` VARCHAR(255), IN `p_id_jabatan` INT)   BEGIN
UPDATE pegawai SET nama = p_nama, jenis_kelamin = p_jenis_kelamin, alamat = p_alamat, id_jabatan = p_id_jabatan WHERE id_karyawan = p_id_karyawan;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gaji` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `deskripsi`, `gaji`) VALUES
(2, 'CEO', 'ini adalah CEO', '12000000.00'),
(3, 'Manager', 'ini tugasnya', '5000000.00'),
(4, 'Pimpinan Project', 'Ini tentang pimpinan projek', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_karyawan`, `nama`, `jenis_kelamin`, `alamat`, `id_jabatan`) VALUES
(10001, 'abdul', 'Laki Laki', 'Antapani', 3),
(10002, 'Dika Saputra', 'Laki Laki', 'Jl.antapani Timur', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
