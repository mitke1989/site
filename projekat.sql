-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 01:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnika` int(11) NOT NULL,
  `ime` text NOT NULL,
  `prezime` text NOT NULL,
  `username` text NOT NULL,
  `sifra` text NOT NULL,
  `email` text NOT NULL,
  `adresa` text NOT NULL,
  `telefon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnika`, `ime`, `prezime`, `username`, `sifra`, `email`, `adresa`, `telefon`) VALUES
(11, 'Marko', 'Mitkovic', 'markom', '123456', 'markom@gmail.com', 'Vojvode Stepe', '065 65 65 666'),
(14, 'julija', 'milanovic', 'julija', 'julija', 'aidasidhasidha@jads', 'Avalska', '065 65 65 666'),
(15, 'asdasda', 'asasdas', 'marko', 'marko', 'marko@gmail.com', 'sadasda', '231312312'),
(16, 'dejan', 'mitkovic', 'mitke1', '1205980', 'mitke1@beotel.rs', 'dubljanska 15', '0641103991');

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id_korpe` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `ukupna_cena` float NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id_korpe`, `id_korisnika`, `ukupna_cena`, `datum`) VALUES
(43, 14, 4870, '2023-06-16 20:05:40'),
(44, 16, 217663, '2023-07-19 17:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `korpa_proizvodi`
--

CREATE TABLE `korpa_proizvodi` (
  `id_korpe` int(11) NOT NULL,
  `id_proizvoda` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korpa_proizvodi`
--

INSERT INTO `korpa_proizvodi` (`id_korpe`, `id_proizvoda`, `kolicina`) VALUES
(43, 11, 1),
(43, 13, 3),
(44, 8, 1),
(44, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id_proizvoda` int(11) NOT NULL,
  `naziv` text NOT NULL,
  `cena` float NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id_proizvoda`, `naziv`, `cena`, `kolicina`) VALUES
(2, 'Power Whey Protein', 2990, 300),
(3, 'Protein Concentrate', 3990, 400),
(4, 'Proteinissimo Prime', 280, 750),
(8, 'Vitamin B12', 213213, 390),
(11, 'Diet Whey Protein', 4450, 300),
(12, 'Protein Cream', 790, 432),
(13, 'Fitness Bar', 140, 890),
(15, 'TEST', 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id_korpe`),
  ADD KEY `id_korisnika` (`id_korisnika`);

--
-- Indexes for table `korpa_proizvodi`
--
ALTER TABLE `korpa_proizvodi`
  ADD PRIMARY KEY (`id_korpe`,`id_proizvoda`),
  ADD KEY `id_proizvoda` (`id_proizvoda`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id_proizvoda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id_korpe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id_proizvoda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`);

--
-- Constraints for table `korpa_proizvodi`
--
ALTER TABLE `korpa_proizvodi`
  ADD CONSTRAINT `korpa_proizvodi_ibfk_1` FOREIGN KEY (`id_korpe`) REFERENCES `korpa` (`id_korpe`),
  ADD CONSTRAINT `korpa_proizvodi_ibfk_2` FOREIGN KEY (`id_proizvoda`) REFERENCES `proizvodi` (`id_proizvoda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
