-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 21, 2021 alle 22:50
-- Versione del server: 10.4.18-MariaDB
-- Versione PHP: 8.0.3

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
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `idA` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PSW` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`idA`, `Email`, `PSW`) VALUES
(1, 'admin@admin.admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `idC` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `DataNascita` varchar(50) NOT NULL,
  `Indirizzo` varchar(80) NOT NULL,
  `Stelle` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PSW` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE `log` (
  `idL` int(11) NOT NULL,
  `Descrizione` varchar(120) NOT NULL,
  `DataOra` varchar(30) NOT NULL,
  `idC1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `vestito`
--

CREATE TABLE `vestito` (
  `idV` int(11) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Taglia` varchar(20) NOT NULL,
  `Colore` varchar(50) NOT NULL,
  `Descrizione` varchar(120) NOT NULL,
  `Valutazione` int(11) NOT NULL,
  `Disponibile` tinyint(1) NOT NULL,
  `PathImmagine` varchar(50) NOT NULL,
  `DataDonazione` varchar(20) NOT NULL,
  `DataAcquisto` varchar(20) NOT NULL,
  `idC1` int(11) NOT NULL,
  `idC2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idA`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idC`);

--
-- Indici per le tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idL`),
  ADD KEY `idC1` (`idC1`);

--
-- Indici per le tabelle `vestito`
--
ALTER TABLE `vestito`
  ADD PRIMARY KEY (`idV`),
  ADD KEY `idC1` (`idC1`),
  ADD KEY `idC2` (`idC2`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `log`
--
ALTER TABLE `log`
  MODIFY `idL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `vestito`
--
ALTER TABLE `vestito`
  MODIFY `idV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idC1`) REFERENCES `cliente` (`idC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `vestito`
--
ALTER TABLE `vestito`
  ADD CONSTRAINT `vestito_ibfk_1` FOREIGN KEY (`idC1`) REFERENCES `cliente` (`idC`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vestito_ibfk_2` FOREIGN KEY (`idC2`) REFERENCES `cliente` (`idC`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;