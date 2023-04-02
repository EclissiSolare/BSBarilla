-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Apr 02, 2023 alle 18:47
-- Versione del server: 8.0.30
-- Versione PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_bsbarilla`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `archivio`
--

CREATE TABLE `archivio` (
  `ID` int NOT NULL,
  `TransazioneID` int NOT NULL,
  `VenditoreID` int NOT NULL,
  `Costo` float NOT NULL,
  `Riuscita` tinyint(1) NOT NULL,
  `SommaTotale` float NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `archivio`
--

INSERT INTO `archivio` (`ID`, `TransazioneID`, `VenditoreID`, `Costo`, `Riuscita`, `SommaTotale`, `TIMESTAMP`) VALUES
(41, 39, 1, 10, 1, 10, '2023-04-02 16:36:10'),
(42, 7, 2, 400000000000, 1, 400000000000, '2023-04-02 16:45:01');

-- --------------------------------------------------------

--
-- Struttura della tabella `fatture`
--

CREATE TABLE `fatture` (
  `numero` int NOT NULL,
  `data` date NOT NULL,
  `Importo` double NOT NULL,
  `codcli` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struttura della tabella `Spesa`
--

CREATE TABLE `Spesa` (
  `Email` varchar(50) NOT NULL,
  `ID` int NOT NULL,
  `DataConsegna` date DEFAULT NULL,
  `Costo` float NOT NULL,
  `Consegnata` tinyint(1) NOT NULL,
  `TipoConsegna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore1_carrello`
--

CREATE TABLE `venditore1_carrello` (
  `ID` int NOT NULL,
  `Utente` varchar(20) NOT NULL,
  `Prodotto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore1_carrello`
--

INSERT INTO `venditore1_carrello` (`ID`, `Utente`, `Prodotto`) VALUES
(54, 'scarpyx', 1),
(55, 'scarpyx', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore1_prenotazione`
--

CREATE TABLE `venditore1_prenotazione` (
  `ID` int NOT NULL,
  `Utente` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Data` timestamp NOT NULL,
  `PrezzoTotale` float NOT NULL,
  `Eseguita` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore1_prenotazione`
--

INSERT INTO `venditore1_prenotazione` (`ID`, `Utente`, `Data`, `PrezzoTotale`, `Eseguita`) VALUES
(35, 'admin', '2023-03-28 20:26:04', 3003.48, 1),
(36, 'EclissiSolare', '2023-04-02 07:02:32', 1003.48, 1),
(37, 'Fadda', '2023-04-02 15:04:21', 2000, 1),
(38, 'Fadda', '2023-04-02 15:28:00', 4.9, 1),
(39, 'EclissiSolare', '2023-04-02 16:35:55', 10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore1_prodottiPrenotati`
--

CREATE TABLE `venditore1_prodottiPrenotati` (
  `ID` int NOT NULL,
  `Prodotto` int NOT NULL,
  `Prenotazione` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore1_prodottiPrenotati`
--

INSERT INTO `venditore1_prodottiPrenotati` (`ID`, `Prodotto`, `Prenotazione`) VALUES
(24, 1, 33),
(25, 2, 34),
(26, 2, 35),
(27, 2, 36),
(28, 1, 37),
(29, 3, 38),
(30, 2, 39);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore1_prodotto`
--

CREATE TABLE `venditore1_prodotto` (
  `ID` int NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore1_prodotto`
--

INSERT INTO `venditore1_prodotto` (`ID`, `Nome`, `Prezzo`) VALUES
(1, 'Charizard ', 1000),
(2, 'Panino', 2.5),
(3, 'Air Force 1 x Kanye', 0.98);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore1_utente`
--

CREATE TABLE `venditore1_utente` (
  `ID` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Soldi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore1_utente`
--

INSERT INTO `venditore1_utente` (`ID`, `Email`, `Password`, `Soldi`) VALUES
('admin', 'jacopo.scarpato26@gmail.com', 'scarpyx', 99997000),
('EclissiSolare', 'ciao@gmail.com', 'manuscarpy', -913.48),
('Fadda', 'fadda@gmail.com', 'fadda', -1904.9);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore2_carrello`
--

CREATE TABLE `venditore2_carrello` (
  `ID` int NOT NULL,
  `Utente` varchar(20) NOT NULL,
  `Prodotto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore2_prenotazione`
--

CREATE TABLE `venditore2_prenotazione` (
  `ID` int NOT NULL,
  `Utente` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Data` timestamp NOT NULL,
  `PrezzoTotale` float NOT NULL,
  `Eseguita` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore2_prenotazione`
--

INSERT INTO `venditore2_prenotazione` (`ID`, `Utente`, `Data`, `PrezzoTotale`, `Eseguita`) VALUES
(5, 'favij', '2023-04-02 16:06:49', 100000000000, 1),
(6, 'favij', '2023-04-02 16:33:21', 4.99, 1),
(7, 'favij', '2023-04-02 16:44:43', 400000000000, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore2_prodottiPrenotati`
--

CREATE TABLE `venditore2_prodottiPrenotati` (
  `ID` int NOT NULL,
  `Prodotto` int NOT NULL,
  `Prenotazione` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore2_prodottiPrenotati`
--

INSERT INTO `venditore2_prodottiPrenotati` (`ID`, `Prodotto`, `Prenotazione`) VALUES
(4, 2, 4),
(5, 1, 5),
(6, 2, 6),
(7, 1, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore2_prodotto`
--

CREATE TABLE `venditore2_prodotto` (
  `ID` int NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore2_prodotto`
--

INSERT INTO `venditore2_prodotto` (`ID`, `Nome`, `Prezzo`) VALUES
(1, 'Collana BHMG', 100000000000),
(2, 'Pizza', 4.99);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore2_utente`
--

CREATE TABLE `venditore2_utente` (
  `ID` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Soldi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore2_utente`
--

INSERT INTO `venditore2_utente` (`ID`, `Email`, `Password`, `Soldi`) VALUES
('admin', 'email@gmail.com', 'cisco', 5),
('favij', 'ciao@gmail.com', 'ciao', -500000000000);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore3_carrello`
--

CREATE TABLE `venditore3_carrello` (
  `ID` int NOT NULL,
  `Utente` varchar(20) NOT NULL,
  `Prodotto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore3_carrello`
--

INSERT INTO `venditore3_carrello` (`ID`, `Utente`, `Prodotto`) VALUES
(1, 'EclissiSolare', 2),
(2, 'EclissiSolare', 2),
(3, 'EclissiSolare', 2),
(4, 'EclissiSolare', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore3_prenotazione`
--

CREATE TABLE `venditore3_prenotazione` (
  `ID` int NOT NULL,
  `Utente` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Data` timestamp NOT NULL,
  `PrezzoTotale` float NOT NULL,
  `Eseguita` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore3_prodottiPrenotati`
--

CREATE TABLE `venditore3_prodottiPrenotati` (
  `ID` int NOT NULL,
  `Prodotto` int NOT NULL,
  `Prenotazione` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore3_prodotto`
--

CREATE TABLE `venditore3_prodotto` (
  `ID` int NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore3_prodotto`
--

INSERT INTO `venditore3_prodotto` (`ID`, `Nome`, `Prezzo`) VALUES
(1, 'Cacciavite', 78.95),
(2, 'Bot Discord', 999.99);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore3_utente`
--

CREATE TABLE `venditore3_utente` (
  `ID` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Soldi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditore3_utente`
--

INSERT INTO `venditore3_utente` (`ID`, `Email`, `Password`, `Soldi`) VALUES
('admin', 'email@gmail.com', 'cisco', 100),
('EclissiSolare', 'ciao@gmail.com', 'Manuscarpy', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditori`
--

CREATE TABLE `venditori` (
  `ID` int NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `PassAdmin` varchar(20) NOT NULL,
  `Soldi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `venditori`
--

INSERT INTO `venditori` (`ID`, `Nome`, `PassAdmin`, `Soldi`) VALUES
(1, 'Roma', 'cisco', 6502.86),
(2, 'Milano', 'cisco', 500000000000),
(3, 'Napoli', 'cisco', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `archivio`
--
ALTER TABLE `archivio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TransazioneID` (`TransazioneID`),
  ADD KEY `VenditoreID` (`VenditoreID`);

--
-- Indici per le tabelle `fatture`
--
ALTER TABLE `fatture`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `Spesa`
--
ALTER TABLE `Spesa`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditore1_carrello`
--
ALTER TABLE `venditore1_carrello`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prodotto` (`Prodotto`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `venditore1_prenotazione`
--
ALTER TABLE `venditore1_prenotazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `venditore1_prodottiPrenotati`
--
ALTER TABLE `venditore1_prodottiPrenotati`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prodotto` (`Prodotto`),
  ADD KEY `Prenotazione` (`Prenotazione`);

--
-- Indici per le tabelle `venditore1_prodotto`
--
ALTER TABLE `venditore1_prodotto`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditore1_utente`
--
ALTER TABLE `venditore1_utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditore2_carrello`
--
ALTER TABLE `venditore2_carrello`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prodotto` (`Prodotto`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `venditore2_prenotazione`
--
ALTER TABLE `venditore2_prenotazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `venditore2_prodottiPrenotati`
--
ALTER TABLE `venditore2_prodottiPrenotati`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prodotto` (`Prodotto`),
  ADD KEY `Prenotazione` (`Prenotazione`);

--
-- Indici per le tabelle `venditore2_prodotto`
--
ALTER TABLE `venditore2_prodotto`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditore2_utente`
--
ALTER TABLE `venditore2_utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditore3_carrello`
--
ALTER TABLE `venditore3_carrello`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prodotto` (`Prodotto`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `venditore3_prenotazione`
--
ALTER TABLE `venditore3_prenotazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `venditore3_prodottiPrenotati`
--
ALTER TABLE `venditore3_prodottiPrenotati`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prodotto` (`Prodotto`),
  ADD KEY `Prenotazione` (`Prenotazione`);

--
-- Indici per le tabelle `venditore3_prodotto`
--
ALTER TABLE `venditore3_prodotto`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditore3_utente`
--
ALTER TABLE `venditore3_utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `venditori`
--
ALTER TABLE `venditori`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `archivio`
--
ALTER TABLE `archivio`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT per la tabella `Spesa`
--
ALTER TABLE `Spesa`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `venditore1_carrello`
--
ALTER TABLE `venditore1_carrello`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT per la tabella `venditore1_prenotazione`
--
ALTER TABLE `venditore1_prenotazione`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT per la tabella `venditore1_prodottiPrenotati`
--
ALTER TABLE `venditore1_prodottiPrenotati`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT per la tabella `venditore1_prodotto`
--
ALTER TABLE `venditore1_prodotto`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `venditore2_carrello`
--
ALTER TABLE `venditore2_carrello`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `venditore2_prenotazione`
--
ALTER TABLE `venditore2_prenotazione`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `venditore2_prodottiPrenotati`
--
ALTER TABLE `venditore2_prodottiPrenotati`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `venditore2_prodotto`
--
ALTER TABLE `venditore2_prodotto`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `venditore3_carrello`
--
ALTER TABLE `venditore3_carrello`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `venditore3_prenotazione`
--
ALTER TABLE `venditore3_prenotazione`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `venditore3_prodottiPrenotati`
--
ALTER TABLE `venditore3_prodottiPrenotati`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `venditore3_prodotto`
--
ALTER TABLE `venditore3_prodotto`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `archivio`
--
ALTER TABLE `archivio`
  ADD CONSTRAINT `archivio_ibfk_1` FOREIGN KEY (`VenditoreID`) REFERENCES `venditori` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
