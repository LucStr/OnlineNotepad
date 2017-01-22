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
-- Tabellenstruktur für Tabelle `detail`
--

CREATE TABLE `detail` (
  `ID` int(11) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `detail`
--

INSERT INTO `detail` (`ID`, `LastName`, `FirstName`, `Address`, `City`) VALUES
(1, 'Brnic', 'Ivica', 'Steinhausen 2', 'Münster'),
(2, 'Muster', 'Max', 'An der Mark 1', 'Zürich'),
(3, 'Goldschmied', 'Elias', 'Zweitstrasse 3', 'Dietikon');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logindata`
--

CREATE TABLE `logindata` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `logindata`
--

INSERT INTO `logindata` (`ID`, `email`, `password`) VALUES
(1, 'max@mustermann.com', 'b1149401e1edb99ebe8ebe9f705ff036'),
(2, 'test@test.com', '8f70500822a5a57d2c3e88e3ad7c98f0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `putin`
--

CREATE TABLE `putin` (
  `ID` int(11) NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `putin`
--

INSERT INTO `putin` (`ID`, `data`, `description`) VALUES
(485, 'TWODATA', 'TWODESC'),
(499, 'TWODATA', 'TWODESC'),
(505, 'TWODATA', 'TWODESC'),
(506, 'threed', 'threedesct'),
(507, 'fourdata', 'desc4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `someinfo`
--

CREATE TABLE `someinfo` (
  `ID_info` int(11) NOT NULL,
  `ID` int(11) DEFAULT NULL,
  `information` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `someinfo`
--

INSERT INTO `someinfo` (`ID_info`, `ID`, `information`) VALUES
(1, 1, 'Ist ein Lehrer'),
(2, 2, 'Ist ein Muster'),
(3, 3, 'Ist eine Person');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `putin`
--
ALTER TABLE `putin`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `someinfo`
--
ALTER TABLE `someinfo`
  ADD PRIMARY KEY (`ID_info`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `detail`
--
ALTER TABLE `detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `logindata`
--
ALTER TABLE `logindata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `putin`
--
ALTER TABLE `putin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;
--
-- AUTO_INCREMENT für Tabelle `someinfo`
--
ALTER TABLE `someinfo`
  MODIFY `ID_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
