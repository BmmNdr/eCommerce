-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 26, 2024 alle 10:45
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biemmi_db_ecommerce`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_aggiunta`
--

CREATE TABLE `ecommerce_aggiunta` (
  `ID` int(11) NOT NULL,
  `IDProdotto` int(11) NOT NULL,
  `IDCarrello` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_appartiene`
--

CREATE TABLE `ecommerce_appartiene` (
  `ID` int(11) NOT NULL,
  `IDProdotto` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_carrelli`
--

CREATE TABLE `ecommerce_carrelli` (
  `ID` int(11) NOT NULL,
  `IDUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_categoria`
--

CREATE TABLE `ecommerce_categoria` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(32) NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_feedback`
--

CREATE TABLE `ecommerce_feedback` (
  `ID` int(11) NOT NULL,
  `Voto` int(11) NOT NULL,
  `Commento` int(11) NOT NULL,
  `Data` date NOT NULL,
  `IDUtente` int(11) NOT NULL,
  `IDProdotto` int(11) NOT NULL,
  `IDOrdine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_foto`
--

CREATE TABLE `ecommerce_foto` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(32) NOT NULL,
  `Descrizione` text NOT NULL,
  `Parh` varchar(32) NOT NULL,
  `IDProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_ordini`
--

CREATE TABLE `ecommerce_ordini` (
  `ID` int(11) NOT NULL,
  `IDCarrello` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_prodotti`
--

CREATE TABLE `ecommerce_prodotti` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `descrizione` text NOT NULL,
  `dataAggiunta` date NOT NULL,
  `quantita` int(11) NOT NULL,
  `prezzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce_utenti`
--

CREATE TABLE `ecommerce_utenti` (
  `ID` int(11) NOT NULL,
  `numTelefono` int(11) NOT NULL,
  `username` varchar(36) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(36) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `ecommerce_utenti`
--

INSERT INTO `ecommerce_utenti` (`ID`, `numTelefono`, `username`, `password`, `email`, `nome`, `cognome`) VALUES
(1, 123456789, 'BmmNdr', 'b732c65bbf968bb616a26df9e83d0ab7', 'bekod65124@sentrau.com', 'Andrea', 'Biemmi');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ecommerce_aggiunta`
--
ALTER TABLE `ecommerce_aggiunta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Aggiunta-Carrelli` (`IDCarrello`),
  ADD KEY `Aggiunta-Prodotti` (`IDProdotto`);

--
-- Indici per le tabelle `ecommerce_appartiene`
--
ALTER TABLE `ecommerce_appartiene`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Appartiene-Prodotto` (`IDProdotto`),
  ADD KEY `Appartiene-Categoria` (`IDCategoria`);

--
-- Indici per le tabelle `ecommerce_carrelli`
--
ALTER TABLE `ecommerce_carrelli`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Carrelli-Utenti` (`IDUtente`);

--
-- Indici per le tabelle `ecommerce_categoria`
--
ALTER TABLE `ecommerce_categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `ecommerce_feedback`
--
ALTER TABLE `ecommerce_feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Feedback-Utenti` (`IDUtente`),
  ADD KEY `Feedback-Ordini` (`IDOrdine`),
  ADD KEY `Feedback-Prodotti` (`IDProdotto`);

--
-- Indici per le tabelle `ecommerce_foto`
--
ALTER TABLE `ecommerce_foto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Foto-Prodotti` (`IDProdotto`);

--
-- Indici per le tabelle `ecommerce_ordini`
--
ALTER TABLE `ecommerce_ordini`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Ordini-Carrelli` (`IDCarrello`);

--
-- Indici per le tabelle `ecommerce_prodotti`
--
ALTER TABLE `ecommerce_prodotti`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `ecommerce_utenti`
--
ALTER TABLE `ecommerce_utenti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ecommerce_aggiunta`
--
ALTER TABLE `ecommerce_aggiunta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_appartiene`
--
ALTER TABLE `ecommerce_appartiene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_carrelli`
--
ALTER TABLE `ecommerce_carrelli`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_categoria`
--
ALTER TABLE `ecommerce_categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_feedback`
--
ALTER TABLE `ecommerce_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_foto`
--
ALTER TABLE `ecommerce_foto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_ordini`
--
ALTER TABLE `ecommerce_ordini`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_prodotti`
--
ALTER TABLE `ecommerce_prodotti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ecommerce_utenti`
--
ALTER TABLE `ecommerce_utenti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ecommerce_aggiunta`
--
ALTER TABLE `ecommerce_aggiunta`
  ADD CONSTRAINT `Aggiunta-Carrelli` FOREIGN KEY (`IDCarrello`) REFERENCES `ecommerce_carrelli` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Aggiunta-Prodotti` FOREIGN KEY (`IDProdotto`) REFERENCES `ecommerce_prodotti` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ecommerce_appartiene`
--
ALTER TABLE `ecommerce_appartiene`
  ADD CONSTRAINT `Appartiene-Categoria` FOREIGN KEY (`IDCategoria`) REFERENCES `ecommerce_categoria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Appartiene-Prodotto` FOREIGN KEY (`IDProdotto`) REFERENCES `ecommerce_prodotti` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ecommerce_carrelli`
--
ALTER TABLE `ecommerce_carrelli`
  ADD CONSTRAINT `Carrelli-Utenti` FOREIGN KEY (`IDUtente`) REFERENCES `ecommerce_utenti` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ecommerce_feedback`
--
ALTER TABLE `ecommerce_feedback`
  ADD CONSTRAINT `Feedback-Ordini` FOREIGN KEY (`IDOrdine`) REFERENCES `ecommerce_ordini` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback-Prodotti` FOREIGN KEY (`IDProdotto`) REFERENCES `ecommerce_prodotti` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback-Utenti` FOREIGN KEY (`IDUtente`) REFERENCES `ecommerce_utenti` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ecommerce_foto`
--
ALTER TABLE `ecommerce_foto`
  ADD CONSTRAINT `Foto-Prodotti` FOREIGN KEY (`IDProdotto`) REFERENCES `ecommerce_prodotti` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ecommerce_ordini`
--
ALTER TABLE `ecommerce_ordini`
  ADD CONSTRAINT `Ordini-Carrelli` FOREIGN KEY (`IDCarrello`) REFERENCES `ecommerce_carrelli` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
