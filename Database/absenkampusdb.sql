-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2016 at 02:06 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `absenkampusdb`
--
CREATE DATABASE IF NOT EXISTS `absenkampusdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `absenkampusdb`;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `limit_absen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`limit_absen`) VALUES
('120');

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_dosen`
--

CREATE TABLE IF NOT EXISTS `data_absen_dosen` (
  `id_data` int(10) NOT NULL AUTO_INCREMENT,
  `id_jadwal` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_mhs`
--

CREATE TABLE IF NOT EXISTS `data_absen_mhs` (
  `id_data` int(10) NOT NULL AUTO_INCREMENT,
  `id_jadwal` varchar(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `data_absen_mhs`
--

INSERT INTO `data_absen_mhs` (`id_data`, `id_jadwal`, `nim`, `tgl`, `jam`, `semester`, `kode_mata_kuliah`, `status`) VALUES
(1, '9', '151605005', '2016-06-25', '15:14:23', '6', '3', 'Sudah Absen'),
(2, '9', '151605007', '2016-06-25', '15:15:05', '6', '3', 'Sudah Absen'),
(3, '8', '151605007', '2016-06-25', '19:04:55', '6', '4', 'Sudah Absen');

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_mhs_tmp`
--

CREATE TABLE IF NOT EXISTS `data_absen_mhs_tmp` (
  `id_data` int(10) NOT NULL AUTO_INCREMENT,
  `id_jadwal` varchar(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nid` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `photo` varchar(80) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nid`, `nama`, `umur`, `photo`) VALUES
('16052301', 'Jiraya Sensei', '19790403', '16052301.jpeg'),
('16061402', 'Kakashi Sensei', '19790705', '16061402.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kuliah`
--

CREATE TABLE IF NOT EXISTS `jadwal_kuliah` (
  `id_jadwal` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwal`, `tanggal`, `jam_mulai`, `kode_jurusan`, `kode_kelas`, `nid`, `semester`, `kode_mata_kuliah`) VALUES
(8, '2016-06-25', '19:00:00', '2', '4', '16052301', '6', '4'),
(9, '2016-06-25', '15:00:00', '2', '4', '16052301', '6', '3'),
(10, '2016-06-18', '19:00:00', '2', '5', '16052301', '6', '2'),
(11, '2016-06-18', '17:00:00', '2', '5', '16052301', '6', '1'),
(12, '2016-06-15', '18:30:00', '3', '6', '16061402', '6', '2'),
(13, '2016-06-14', '19:00:00', '3', '6', '16061402', '6', '1'),
(14, '2016-06-14', '10:00:00', '3', '7', '16061402', '6', '3'),
(15, '2016-06-14', '17:00:00', '3', '7', '16061402', '6', '4'),
(16, '2016-06-20', '19:00:00', '2', '4', '16061402', '6', '1'),
(17, '2016-06-20', '19:00:00', '2', '4', '16061402', '6', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `kode_jurusan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(40) NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
(2, 'Teknik Informatika'),
(3, 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kode_kelas` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
(4, '1516A'),
(5, '1516B'),
(6, '1516C'),
(7, '1516D'),
(8, '1516E');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(20) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `photo` varchar(80) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `umur`, `kode_jurusan`, `kode_kelas`, `photo`) VALUES
('151605005', 'Uchiha Sasuke', '19920303', '2', '4', '151605005.jpg'),
('151605007', 'Akhirudin Muhamad', '19930701', '2', '4', '151605007.JPG'),
('151605009', 'Uzumaki Naruto', '19700101', '2', '4', '151605009.jpeg'),
('151605010', 'Karin', '19930105', '2', '4', '151605010.jpg'),
('151605011', 'Hinata Hyuga', '19940417', '2', '4', '151605011.jpg'),
('151606012', 'CALVEN OPRAFIUS OEMATAN	L', '19880103', '2', '5', '151606012.jpg'),
('151606013', 'GUSAR TWO EL-ROI RAHIM ELIM	L', '19730303', '2', '5', '151606013.jpg'),
('151606014', 'ASMIATI	P', '19730603', '2', '5', '151606014.jpg'),
('151606015', '	RIFA ATUL MAHMUDAH	P', '19760803', '2', '5', '151606015.jpg'),
('151606016', 'DENA ARISANDI	P', '19771210', '2', '5', '151606016.jpg'),
('151606017', 'DYAH AYU KRISNANINGTYAS	P', '19850606', '3', '6', '151606017.jpg'),
('151606018', 'SUDARSIH	P', '19760403', '3', '6', '151606018.jpg'),
('151606019', 'KHORYATUL MUâ€™AMAROH	P', '19760504', '3', '6', '151606019.jpg'),
('151606020', 'FEBRONIA MAKUNTUAN	P', '19760604', '3', '6', '151606020.jpg'),
('151606021', '	SUSI DWI ANASARI	P', '19800606', '3', '6', '151606021.jpg'),
('151606022', 'YENI SUTANTI	P', '19770603', '3', '7', '151606022.jpg'),
('151606023', 'SONY ANDIKA SAPUTRA	L', '19790808', '3', '7', '151606023.jpg'),
('151606024', 'YEREMIAS FALLO	L', '19750706', '3', '7', '151606024.jpg'),
('151606025', 'ARFAN JAROQIM	L', '19810909', '3', '7', '151606025.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `kode_mata_kuliah` int(10) NOT NULL AUTO_INCREMENT,
  `nama_mata_kuliah` varchar(60) NOT NULL,
  PRIMARY KEY (`kode_mata_kuliah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mata_kuliah`, `nama_mata_kuliah`) VALUES
(1, 'Teknik Perograman'),
(2, 'Perancangan Basis Data'),
(3, 'Pemrograman Visual'),
(4, 'Internet Mobile Security');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `login_hash` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`username`, `password`, `login_hash`) VALUES
('admin', 'admin', 'administrator'),
('ak', 'ak', 'akademik');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
