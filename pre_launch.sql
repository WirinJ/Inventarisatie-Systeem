-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 okt 2021 om 21:56
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pre_launch`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bloemen`
--

CREATE TABLE `bloemen` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `soort_id` int(11) NOT NULL,
  `magazijn_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '123');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `magazijnen`
--

CREATE TABLE `magazijnen` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soorten`
--

CREATE TABLE `soorten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bloemen`
--
ALTER TABLE `bloemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `magazijnen`
--
ALTER TABLE `magazijnen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `soorten`
--
ALTER TABLE `soorten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bloemen`
--
ALTER TABLE `bloemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `magazijnen`
--
ALTER TABLE `magazijnen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT voor een tabel `soorten`
--
ALTER TABLE `soorten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
