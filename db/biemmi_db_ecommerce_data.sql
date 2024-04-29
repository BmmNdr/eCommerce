-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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

--
-- Dumping data for table `ecommerce_aggiunta`
--

INSERT INTO `ecommerce_aggiunta` (`ID`, `IDProdotto`, `IDCarrello`, `quantita`) VALUES
(6, 2, 1, 1),
(7, 6, 1, 1);

--
-- Dumping data for table `ecommerce_appartiene`
--

INSERT INTO `ecommerce_appartiene` (`ID`, `IDProdotto`, `IDCategoria`) VALUES
(4, 1, 3),
(5, 2, 4),
(6, 3, 5),
(7, 4, 6),
(8, 5, 7),
(9, 6, 8),
(10, 7, 9),
(11, 8, 10),
(12, 9, 6),
(13, 10, 11),
(14, 1, 12),
(15, 2, 12),
(16, 3, 12),
(17, 4, 12);

--
-- Dumping data for table `ecommerce_carrelli`
--

INSERT INTO `ecommerce_carrelli` (`ID`, `IDUtente`) VALUES
(1, 1),
(2, 1);

--
-- Dumping data for table `ecommerce_categoria`
--

INSERT INTO `ecommerce_categoria` (`ID`, `Nome`) VALUES
(3, 'Smartphone'),
(4, 'Portatili'),
(5, 'Smart TV'),
(6, 'Console da gioco'),
(7, 'Macchine fotografiche'),
(8, 'Smartwatch'),
(9, 'Cuffie'),
(10, 'Droni'),
(11, 'Stampanti'),
(12, 'Elettronica');

--
-- Dumping data for table `ecommerce_feedback`
--

INSERT INTO `ecommerce_feedback` (`ID`, `Voto`, `Commento`, `Data`, `IDUtente`, `IDProdotto`) VALUES
(3, 2, 'Pessimo Prodotto', '2024-04-02', 1, 1),
(4, 5, 'Ottima qualita\'/prezzo', '2024-04-02', 1, 2),
(5, 8, 'Ottima', '2024-04-02', 1, 3),
(6, 8, 'Miglior console', '2024-04-02', 1, 4),
(7, 7, 'Ottimo laptop', '2024-04-03', 1, 2),
(8, 8, 'Portatile leggero', '2024-04-23', 1, 2);

--
-- Dumping data for table `ecommerce_foto`
--

INSERT INTO `ecommerce_foto` (`ID`, `Path`, `IDProdotto`) VALUES
(1, 'fbd2cb56-5c25-414d-9f46-e6a164cdf5be.png', 4),
(2, 'portatil-hp-14-al002ns-i5-6200u-4gb-1336451_Perfil_ad_l_23.png', 2),
(3, 'pms_1619424555.37572665.png', 3),
(4, 'IPHONE-13-PRO-BLU-SIERRA.png', 1),
(5, 'canon-r5018-45_2.png', 5),
(6, 'versa4-black-device-front.png', 6),
(7, 'pdt_23673.png', 7),
(8, '7727599c23f26f2fa55ab60494cd3569@xlarge.png', 8),
(9, 'PlayStation_5_and_DualSense_with_transparent_background.png', 9),
(10, 'stampante-hp-envy-6230-k7g25b.png', 10),
(11, 'c05578757.png', 2);

--
-- Dumping data for table `ecommerce_ordini`
--

INSERT INTO `ecommerce_ordini` (`ID`, `IDCarrello`) VALUES
(1, 1),
(2, 1);

--
-- Dumping data for table `ecommerce_prodotti`
--

INSERT INTO `ecommerce_prodotti` (`ID`, `nome`, `descrizione`, `dataAggiunta`, `quantita`, `prezzo`) VALUES
(1, 'Smartphone iPhone 13', 'Ultimo modello di smartphone di Apple.', '2024-04-02', 50, 1000),
(2, 'Portatile HP Pavilion', 'Portatile di fascia media con buone prestazioni.', '2024-04-02', 30, 800),
(3, 'Smart TV Samsung 55 pollici', 'TV con schermo grande e risoluzione 4K.', '2024-04-02', 20, 1500),
(4, 'Console Xbox Series X', 'Nuova generazione di console di gioco.', '2024-04-02', 40, 500),
(5, 'Macchina fotografica Canon EOS', 'Fotocamera reflex con sensore di ultima generazione.', '2024-04-02', 15, 1300),
(6, 'Smartwatch Fitbit Versa', 'Smartwatch con monitoraggio avanzato della salute.', '2024-04-02', 25, 200),
(7, 'Cuffie Bluetooth Sony WH-1000XM4', 'Cuffie con cancellazione del rumore di alta qualità.', '2024-04-02', 35, 350),
(8, 'Drone DJI Mavic Air 2', 'Drone con fotocamera 4K e autonomia di volo elevata.', '2024-04-02', 10, 800),
(9, 'Console PlayStation 5', 'Ultima console di gioco di Sony.', '2024-04-02', 45, 500),
(10, 'Stampante HP LaserJet Pro', 'Stampante laser ad alta velocità per uso professionale.', '2024-04-02', 20, 300);

--
-- Dumping data for table `ecommerce_utenti`
--

INSERT INTO `ecommerce_utenti` (`ID`, `numTelefono`, `username`, `password`, `email`, `nome`, `cognome`) VALUES
(1, 123456789, 'BmmNdr', 'b732c65bbf968bb616a26df9e83d0ab7', 'bekod65124@sentrau.com', 'Andrea', 'Biemmi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
