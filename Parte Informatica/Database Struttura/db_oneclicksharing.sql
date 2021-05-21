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

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`idC`, `Nome`, `Cognome`, `DataNascita`, `Indirizzo`, `Stelle`, `Email`, `PSW`) VALUES
(0, 'DB', 'DB', 'DB', 'DB', 0, 'DB', 'DB'),
(2, 'Nome1', 'Cognome1', '02/09/2001', 'Via1', 11, 'utente1@utente1.it', 'b88d6b04a9dc38860301f6bdd81e5ccd'),
(3, 'Nome2', 'Cognome2', '10/01/2011', 'Via2', 9, 'utente2@utente2.it', 'f7a88d7c3168218b580aa68ab3030491');

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

--
-- Dump dei dati per la tabella `log`
--

INSERT INTO `log` (`idL`, `Descrizione`, `DataOra`, `idC1`) VALUES
(1, 'Un utente si è registrato', '21/05/2021 22:41:09', 2),
(2, 'Un utente si è registrato', '21/05/2021 22:42:09', 3),
(3, 'Un utente si è disconnesso', '21/05/2021 22:42:12', 3),
(4, 'Un utente ha effettuato il login', '21/05/2021 22:42:22', 2),
(5, 'Un utente ha donato un vestito con id: 1', '21/05/2021 22:43:06', 2),
(6, 'Un utente ha effettuato il login', '21/05/2021 22:43:44', 3),
(7, 'Un utente ha donato un vestito con id: 2', '21/05/2021 22:44:50', 3),
(8, 'Un utente ha comprato un vestito con id:  1', '21/05/2021 22:45:04', 3),
(9, 'Un utente ha effettuato il login', '21/05/2021 22:45:24', 2),
(10, 'Un utente ha comprato un vestito con id:  2', '21/05/2021 22:45:33', 2),
(11, 'Un utente ha donato un vestito con id: 3', '21/05/2021 22:46:27', 2),
(12, 'Un utente si è disconnesso', '21/05/2021 22:46:38', 2),
(13, 'Un utente ha effettuato il login', '21/05/2021 22:46:48', 3),
(14, 'Un utente ha donato un vestito con id: 4', '21/05/2021 22:47:24', 3),
(15, 'Un utente si è disconnesso', '21/05/2021 22:47:39', 3),
(16, 'Un utente ha effettuato il login', '21/05/2021 22:48:11', 2),
(17, 'Un utente si è disconnesso', '21/05/2021 22:48:13', 2);

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
-- Dump dei dati per la tabella `vestito`
--

INSERT INTO `vestito` (`idV`, `Tipo`, `Marca`, `Taglia`, `Colore`, `Descrizione`, `Valutazione`, `Disponibile`, `PathImmagine`, `DataDonazione`, `DataAcquisto`, `idC1`, `idC2`) VALUES
(1, 'Felpa', 'Adidas', 'L', 'Bianca', 'Felpa tenuta bene', 3, 0, 'Foto1.jpg', '21/05/2021', '21/05/2021', 2, 3),
(2, 'Cappello', 'Tommy Hilfiger', 'M', 'Blu', 'Cappello Tommy Hilfiger tenuto bene', 2, 0, 'Foto2.jpg', '21/05/2021', '21/05/2021', 3, 2),
(3, 'Jeans', 'Levis', 'L', 'Color Jeans', 'In buono stato', 3, 1, 'Foto3.jpg', '21/05/2021', 'null', 2, 0),
(4, 'Scarpe', 'Jordan', '41', 'Bianche, rosse e nere', 'Scarpe che sembrano nuove', 5, 1, 'Foto4.jpg', '21/05/2021', 'null', 3, 0);

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
