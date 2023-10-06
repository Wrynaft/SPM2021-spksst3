-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2021 at 01:43 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perekodan`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpeng` varchar(4) NOT NULL,
  `katalaluan` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `peranan` varchar(10) NOT NULL,
  `notel` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpeng`, `katalaluan`, `nama`, `peranan`, `notel`) VALUES
('A011', 'beng376', 'Lim Ah Beng', 'Pelajar', '0128364898'),
('A012', '1234', 'Richard Tan', 'Pelajar', '0193882525'),
('C001', 'Clhs1096', 'Low Wei Zi', 'Guru', '0123328519');

-- --------------------------------------------------------

--
-- Table structure for table `perekodan`
--

CREATE TABLE `perekodan` (
  `idrekod` varchar(5) NOT NULL,
  `idpeng` varchar(4) NOT NULL,
  `idtopik` varchar(4) NOT NULL,
  `tarikh` varchar(10) NOT NULL,
  `markah` varchar(3) NOT NULL,
  `gred` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perekodan`
--

INSERT INTO `perekodan` (`idrekod`, `idpeng`, `idtopik`, `tarikh`, `markah`, `gred`) VALUES
('R0001', 'A011', 'T01', '18/09/2021', '100', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `idpilihan` varchar(4) NOT NULL,
  `jwp` varchar(2) NOT NULL,
  `pilihan` varchar(20) NOT NULL,
  `idsoalan` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`idpilihan`, `jwp`, `pilihan`, `idsoalan`) VALUES
('P10', '0', 'Jantung', 'S3'),
('P11', '0', 'Otak', 'S3'),
('P12', '0', 'Jantung', 'S3'),
('P13', '0', '1000', 'S4'),
('P14', '0', '21', 'S4'),
('P15', '0', '3', 'S4'),
('P16', '1', '2', 'S4'),
('P17', '1', 'V=IR', 'S5'),
('P18', '0', 'VIR=0 ', 'S5'),
('P19', '0', 'I = VR', 'S5'),
('P20', '0', 'R = I/V', 'S5'),
('P21', '1', 'A', 'S6'),
('P22', '0', 'cm', 'S6'),
('P23', '0', 'kg', 'S6'),
('P24', '0', 'ml', 'S6'),
('P5', '0', 'Diesel', 'S2'),
('P6', '0', 'Gas Asli', 'S2'),
('P7', '0', 'Arang', 'S2'),
('P8', '1', 'Solar', 'S2'),
('P9', '1', 'Peparu', 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `idsoalan` varchar(4) NOT NULL,
  `nosoal` varchar(3) NOT NULL,
  `soalan` varchar(30) NOT NULL,
  `idtopik` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`idsoalan`, `nosoal`, `soalan`, `idtopik`) VALUES
('S2', '2', 'Tenaga boleh baharu?', 'T02'),
('S3', '3', 'Organ respirasi?', 'T01'),
('S4', '4', 'Test', 'T01'),
('S5', '5', 'Apakah Hukum Ohm?', 'T02'),
('S6', '6', 'Yang manakah unit yang betul u', 'T02');

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE `topik` (
  `idtopik` varchar(4) NOT NULL,
  `topik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`idtopik`, `topik`) VALUES
('T01', 'Respirasi'),
('T02', 'Elektrik ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpeng`);

--
-- Indexes for table `perekodan`
--
ALTER TABLE `perekodan`
  ADD PRIMARY KEY (`idrekod`),
  ADD KEY `idpeng` (`idpeng`),
  ADD KEY `idtopik` (`idtopik`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`idpilihan`),
  ADD KEY `idsoalan` (`idsoalan`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`idsoalan`),
  ADD KEY `idtopik` (`idtopik`);

--
-- Indexes for table `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`idtopik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perekodan`
--
ALTER TABLE `perekodan`
  ADD CONSTRAINT `perekodan_ibfk_1` FOREIGN KEY (`idpeng`) REFERENCES `pengguna` (`idpeng`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `perekodan_ibfk_2` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `pilihan_ibfk_1` FOREIGN KEY (`idsoalan`) REFERENCES `soalan` (`idsoalan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `soalan_ibfk_1` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
