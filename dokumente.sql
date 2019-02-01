-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Okt 2018 um 13:40
-- Server-Version: 10.1.31-MariaDB
-- PHP-Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dokumente`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `docs`
--

CREATE TABLE `docs` (
  `Nr` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `absender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ablageort` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategorie` int(10) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `docs`
--

INSERT INTO `docs` (`Nr`, `Name`, `absender`, `url`, `ablageort`, `kategorie`, `datum`) VALUES
(2, 'Autoversicherung mahnung', '820-8325 Enim. St.', 'uploads/doc_5bb22357277f6.pdf', 'lacinia vitae, sodales at, velit.', 3, '2018-10-01 13:52:15'),
(3, 'Strom rechung', 'Ap #168-3804 Consequat Av.', 'uploads/doc_5bb2236ba66b2.txt', 'amet orci.', 4, '2018-10-01 13:52:15'),
(4, 'Neue Stromanbieter', '700-406 Ut Rd.', 'uploads/doc_5bb2239a474ab.docx', 'adipiscing fringilla,', 2, '2018-10-01 13:52:15'),
(5, 'VW reparatur', 'P.O. Box 124, 587 Eu Ave', 'uploads/doc_5bb223c32704a.pdf', 'elit elit fermentum risus,', 4, '2018-10-01 13:52:15'),
(6, 'Neue Gasanbieter', 'P.O. Box 675, 1608 Proin Av.', 'uploads/doc_5bb2247e47fa1.pdf', 'in faucibus', 2, '2016-09-30 22:00:00'),
(7, 'Kontoauszug 09 2018', 'P.O. Box 238, 4542 Eget Rd.', 'uploads/doc_5bb224a4c8fbd.txt', 'in, hendrerit consectetuer', 5, '2018-09-30 22:00:00'),
(8, 'Kontoauszug 07 2018', 'Ap #396-5514 Nec St.', 'uploads/doc_5bb224b704038.txt', 'risus. Morbi metus. Vivamus', 5, '2018-09-30 22:00:00'),
(9, 'Kontoauszug 04 2017', '993-4812 Sit Avenue', 'uploads/doc_5bb22504d1a98.pdf', 'molestie', 5, '2018-10-01 13:52:16'),
(10, 'Kontoauszug 02 2016', '2605 Ac, Ave', 'uploads/doc_5bb22521236af.txt', 'Cum sociis', 5, '2018-10-01 13:52:16'),
(12, 'Kontoauszug 01 2018', 'bvc', 'uploads/doc_5bb316312e171.txt', 'bvc', 5, '2018-10-01 22:00:00'),
(17, 'test123', 'qwertzua', 'uploads/doc_5bb31e2edace2.txt', 'asdfghj', 1, '2018-10-02 07:28:48'),
(19, 'Test1234', '', 'uploads/doc_5bb31ee3667e3.txt', '', 3, '2018-10-01 22:00:00'),
(21, 'Test2', '', 'uploads/doc_5bb31f4790306.docx', '', 3, '2018-10-01 22:00:00'),
(22, 'Test4', 'fdgfd', 'uploads/doc_5bb31f5d586f5.pdf', 'gfdgfdgfd', 1, '2018-10-01 22:00:00'),
(27, 'Test456', 'oi', 'uploads/doc_5bb320f3592fd.txt', 'poi', 5, '2018-10-02 07:40:35'),
(28, 'Test456', 'oi', 'uploads/doc_5bb321075c758.txt', 'poi', 5, '2018-10-02 07:40:55'),
(29, 'Test456', 'oi', 'uploads/doc_5bb3220b90509.txt', 'poi', 5, '2018-10-02 07:45:16'),
(30, 'Test456', 'oi', 'uploads/doc_5bb3225b7eb50.txt', 'poi', 5, '2018-10-02 07:46:35'),
(31, 'Test456', 'oi', 'uploads/doc_5bb3225d83dbd.txt', 'poi', 5, '2018-10-02 07:46:38'),
(32, 'Test6', 'tzdfzt', 'uploads/doc_5bb32273aac4d.pdf', 'ztrtzr', 5, '2017-10-01 22:00:00'),
(34, 'PDF über PHP', 'hjkhk', 'uploads/doc_5bb33c2cbd43c.pdf', 'jkhjkh', 3, '2018-10-02 09:36:45'),
(45, 'dtrdt', 'rtd', 'uploads/doc_5bb73cf5e4fa9.pdf', 'trdtrd', 1, '2018-10-05 10:29:10'),
(46, 'fvghfgh', 'gfd', 'uploads/doc_5bb745c0c30a0.pdf', 'gfdgf', 1, '2018-10-05 11:06:41'),
(47, 'trdtr', '', 'uploads/doc_5bb74d02a3bb8.pdf', '', 0, '2018-10-05 11:37:38'),
(48, '5r56r', '', 'uploads/doc_5bb74d15ee54b.pdf', '', 0, '2018-10-05 11:37:57'),
(49, 'hgfghf', 'ghfh', 'uploads/doc_5bb74d24a86c4.pdf', 'gfhgfghf', 1, '2018-10-05 11:38:13');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `katNr` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`katNr`, `Name`) VALUES
(1, 'Krankenversicherung'),
(2, 'Vertrag 1'),
(3, 'Mahnung'),
(4, 'Rechnung'),
(5, 'Banken'),
(7, 'Steuer'),
(8, 'Renteversicherung'),
(9, 'Vertrag 2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `mitarbeiternr` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vorname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwort` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`mitarbeiternr`, `name`, `vorname`, `login`, `passwort`, `email`, `access`) VALUES
(1, 'Hedda', 'Faulkner', 'Carroll', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'convallis.dolor.Quisque@atarcu', 1),
(2, 'Ifeoma', 'Hoffman', 'Fowler', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'eu.eros.Nam@lectuspedeet.org', 1),
(3, 'Margaret', 'Wynn', 'Sanders', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'nulla.Cras@orci.ca', 1),
(4, 'TaShya', 'Sloan', 'Kane', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'sodales.elit.erat@massa.edu', 1),
(5, 'William', 'Holcomb', 'Farmer', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'Nulla.interdum@miDuis.net', 1),
(6, 'Zahir', 'Campos', 'Mack', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'non.lobortis.quis@orci.edu', 1),
(7, 'Casey', 'Park', 'Phillips', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'pellentesque@metuseuerat.com', 1),
(8, 'Urielle', 'Walsh', 'Barber', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'odio.sagittis.semper@nulla.edu', 1),
(9, 'Darius', 'Wynn', 'Johnson', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'Morbi@est.com', 1),
(11, 'Rhonda', 'Higgins', 'Graves', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'Lorem.ipsum@sed.net', 1),
(12, 'Brock', 'Tillman', 'Pope', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'odio.semper@Donecluctusaliquet', 1),
(13, 'Phoebe', 'Miranda', 'Knowles', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'vitae@faucibusorci.ca', 1),
(14, 'Ashton', 'Bush', 'Ryan', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'ac@Morbiquisurna.co.uk', 1),
(15, 'Whilemina', 'Hooper', 'Stafford', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'magna@blanditmattisCras.edu', 1),
(16, 'Tanya', 'Beck', 'Cline', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'magna@sitametultricies.co.uk', 1),
(17, 'Dahlia', 'Pena', 'Martin', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'Donec@Namconsequatdolor.net', 1),
(18, 'Aretha', 'Hart', 'Nicholson', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'est@primis.com', 1),
(19, 'Chiquita', 'Rice', 'Gilliam', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'arcu.Nunc.mauris@orcisem.org', 1),
(20, 'Portia', 'Burke', 'Drake', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'metus.vitae@egetmassa.org', 1),
(21, 'Ascension', 'cho', 'pardo', '1a91d62f7ca67399625a4368a6ab5d4a3baa6073', 'cho@cho.com', 1),
(22, 'gffd', 'gfgf', 'gfgf', 'f54b69d09dd2c70ce04c7f02ef9e06413ef47296', 'gfdf@KLJHJK.com', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recovery`
--

CREATE TABLE `recovery` (
  `recoverid` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `recovery`
--

INSERT INTO `recovery` (`recoverid`, `email`, `datum`) VALUES
('5bb32afd8306c', 'cho@cho.com', '2018-10-02 10:53:25'),
('5bb32b2705f02', 'cho@cho.com', '2018-10-02 10:54:07'),
('5bb32f5fd056f', 'cho@cho.com', '2018-10-02 11:12:07'),
('5bb333ec7c3ed', 'cho@cho.com', '2018-10-02 11:31:32'),
('5bb336c368108', 'cho@cho.com', '2018-10-02 11:43:39'),
('5bb35074ddd66', 'cho@cho.com', '2018-10-02 13:33:16'),
('5bb5fba3f151b', 'cho@cho.com', '2018-10-04 14:08:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schlagworte`
--

CREATE TABLE `schlagworte` (
  `Nr` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `schlagworte`
--

INSERT INTO `schlagworte` (`Nr`, `Name`) VALUES
(7, 'Auto'),
(2, 'Bezahlt'),
(6, 'Gas'),
(3, 'Infos'),
(4, 'Kontoauszug'),
(5, 'Strom');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zwischentabelle`
--

CREATE TABLE `zwischentabelle` (
  `DokNr` int(10) UNSIGNED NOT NULL,
  `SchlagwortNr` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `zwischentabelle`
--

INSERT INTO `zwischentabelle` (`DokNr`, `SchlagwortNr`) VALUES
(2, 7),
(3, 2),
(3, 5),
(4, 3),
(4, 5),
(5, 2),
(5, 7),
(6, 2),
(6, 6),
(7, 3),
(7, 4),
(8, 3),
(8, 4),
(9, 3),
(9, 4),
(10, 3),
(10, 4),
(12, 3),
(12, 4),
(12, 6),
(19, 2),
(19, 3),
(19, 5),
(21, 3),
(21, 4),
(21, 6),
(22, 2),
(22, 3),
(22, 6),
(27, 6),
(27, 7),
(28, 6),
(28, 7),
(29, 6),
(29, 7),
(30, 6),
(30, 7),
(31, 6),
(31, 7),
(32, 4),
(32, 5),
(32, 6),
(34, 2),
(34, 3),
(34, 4),
(35, 4),
(35, 6),
(36, 7),
(45, 3),
(45, 4),
(45, 6),
(46, 2),
(46, 3),
(46, 4),
(46, 6),
(48, 4),
(48, 6),
(49, 3),
(49, 6);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`Nr`),
  ADD KEY `SucheName` (`Name`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`katNr`);

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`mitarbeiternr`);

--
-- Indizes für die Tabelle `schlagworte`
--
ALTER TABLE `schlagworte`
  ADD PRIMARY KEY (`Nr`),
  ADD UNIQUE KEY `eindeutigesSchlagwort` (`Name`);

--
-- Indizes für die Tabelle `zwischentabelle`
--
ALTER TABLE `zwischentabelle`
  ADD UNIQUE KEY `eindeutigeKombination` (`DokNr`,`SchlagwortNr`),
  ADD KEY `SchlagwortNr` (`SchlagwortNr`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `docs`
--
ALTER TABLE `docs`
  MODIFY `Nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `katNr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `mitarbeiternr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `schlagworte`
--
ALTER TABLE `schlagworte`
  MODIFY `Nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
