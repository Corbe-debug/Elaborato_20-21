-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 06:10 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_oneclicksharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idA` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PSW` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idC` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `DataNascita` varchar(20) NOT NULL,
  `Indirizzo` varchar(40) NOT NULL,
  `Stelle` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PSW` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `idL` int(11) NOT NULL,
  `Descrizione` varchar(25) NOT NULL,
  `Data` varchar(20) NOT NULL,
  `idC1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vestito`
--

CREATE TABLE `vestito` (
  `idV` int(11) NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Marca` varchar(10) NOT NULL,
  `Taglia` varchar(4) NOT NULL,
  `Colore` varchar(10) NOT NULL,
  `Descrizione` varchar(120) NOT NULL,
  `Valutazione` int(11) NOT NULL,
  `Disponibile` tinyint(1) NOT NULL,
  `PathImmagine` varchar(50) NOT NULL,
  `idC1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idA`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idC`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idL`),
  ADD KEY `idC1` (`idC1`);

--
-- Indexes for table `vestito`
--
ALTER TABLE `vestito`
  ADD PRIMARY KEY (`idV`),
  ADD KEY `idC1` (`idC1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vestito`
--
ALTER TABLE `vestito`
  MODIFY `idV` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idC1`) REFERENCES `cliente` (`idC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vestito`
--
ALTER TABLE `vestito`
  ADD CONSTRAINT `vestito_ibfk_1` FOREIGN KEY (`idC1`) REFERENCES `cliente` (`idC`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
