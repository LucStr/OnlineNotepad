-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Dez 2016 um 07:18
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `m133_gibz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person`
--

CREATE TABLE `person` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `person`
--

INSERT INTO `person` (`ID`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(1, 'Luca', 'Strebel', 'luca.strebel@gmail.com', ''),
(2, 'Sean', 'Lienhard', 'sean.lienhard@gmail.com', ''),
(3, 'Tim', 'Odermatt', 'tim.odermatt@gmail.com', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `document`
--

CREATE TABLE `document` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `document`
--

INSERT INTO `document` (`ID`, `Name`, `Content`) VALUES
(1, 'Testdokument', 'Das ist ein einfaches test-dokument'),
(2, 'Übungen1', 'Die erste Übung:');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person_document`
--

CREATE TABLE `person_document` (
  `ID` int(11) NOT NULL,
  `PersonId` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `person_document`
--

INSERT INTO `person_document` (`ID`, `PersonId`, `DocumentID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Indizes für die Tabelle `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `person_document`
--
ALTER TABLE `person_document`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für Tabelle `person`
--
ALTER TABLE `person`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `document`
--
ALTER TABLE `document`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `person_document`
--
ALTER TABLE `person_document`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;
