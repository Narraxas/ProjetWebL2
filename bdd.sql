-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2021 at 02:49 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hard_discounter`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`email`, `motDePasse`, `nom`, `prenom`, `ville`, `adresse`, `telephone`) VALUES
('jean-louis.deurveilher@etu.umontpellier.fr', 'azerty', 'DEURVEILHER', 'Jean Louis', 'Montpellier', '17 rue de la poupée qui tousse', '0612345678'),
('test2@mail.fr', 'azerty', 'test2nom', 'test2prenom', 'test2ville', 'test2adresse', '0612345678');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `idCommande` int(11) NOT NULL,
  `date_c` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `date_c`, `email`, `etat`) VALUES
(2, '2021', 'jean-louis.deurveilher@etu.umontpellier.fr', 1),
(5, '2021', 'jean-louis.deurveilher@etu.umontpellier.fr', 1),
(8, '2021', 'jean-louis.deurveilher@etu.umontpellier.fr', 1),
(9, '2021', 'jean-louis.deurveilher@etu.umontpellier.fr', 1),
(11, '2021', 'jean-louis.deurveilher@etu.umontpellier.fr', 1),
(12, '2021', 'jean-louis.deurveilher@etu.umontpellier.fr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lignescommandes`
--

CREATE TABLE `lignescommandes` (
  `idLigneCommande` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idProduit` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL,
  `montant` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lignescommandes`
--

INSERT INTO `lignescommandes` (`idLigneCommande`, `idCommande`, `idProduit`, `quantite`, `montant`) VALUES
(149, 2, 'archos', 1, 99.99),
(150, 2, 'xiaomi', 1, 252.99),
(151, 2, 'asus', 1, 579.99),
(152, 2, 'samsung', 1, 215.19),
(153, 2, 'lenovo', 1, 499.99),
(154, 2, 'lenovo', 1, 499.99),
(155, 2, 'xiaomi', 1, 252.99),
(156, 2, 'archos', 1, 99.99),
(157, 2, 'archos', 1, 99.99),
(158, 2, 'archos', 1, 99.99),
(159, 2, 'archos', 1, 99.99),
(160, 2, 'archos', 1, 99.99),
(161, 2, 'archos', 1, 99.99),
(162, 2, 'archos', 1, 99.99),
(163, 2, 'archos', 1, 99.99),
(164, 2, 'archos', 1, 99.99),
(165, 2, 'archos', 1, 99.99),
(166, 2, 'archos', 1, 99.99),
(167, 2, 'xiaomi', 1, 252.99),
(168, 2, 'xiaomi', 1, 252.99),
(169, 2, 'xiaomi', 1, 252.99),
(170, 2, 'xiaomi', 1, 252.99),
(171, 2, 'xiaomi', 1, 252.99),
(172, 2, 'xiaomi', 1, 252.99),
(173, 2, 'xiaomi', 1, 252.99),
(174, 2, 'xiaomi', 1, 252.99),
(175, 2, 'xiaomi', 1, 252.99),
(176, 2, 'archos', 1, 99.99),
(177, 2, 'archos', 1, 99.99),
(178, 2, 'archos', 1, 99.99),
(179, 2, 'lenovo', 1, 499.99),
(180, 2, 'lenovo', 1, 499.99),
(181, 2, 'samsung', 1, 215.19),
(182, 2, 'samsung', 1, 215.19),
(183, 2, 'lenovo', 1, 499.99),
(184, 2, 'lenovo', 1, 499.99),
(185, 5, 'lenovo', 1, 499.99),
(186, 5, 'archos', 1, 99.99),
(187, 8, 'xiaomi', 1, 252.99),
(188, 9, 'archos', 1, 99.99),
(189, 9, 'lenovo', 1, 499.99),
(190, 9, 'asus', 1, 579.99),
(191, 9, 'asus', 1, 579.99),
(192, 11, 'asus', 1, 579.99),
(193, 11, 'xiaomi', 1, 252.99),
(194, 12, 'samsung', 1, 215.19),
(195, 12, 'xiaomi', 1, 252.99);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `idProduit` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `descriptif` varchar(400) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `prix` float NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`idProduit`, `nom`, `marque`, `categorie`, `descriptif`, `photo`, `prix`, `stock`) VALUES
('archos', 'Tablette Archos', 'archos', 'tablette', '10.1p IPS TFT - 1280 x 800 3G Système d\'exploitation :    Android 8.1 (Oreo) Go Edition RAM : 1 Go - LPDDR3 SDRAM  Stockage : 32 Go', 'assets/archos.jpg', 99.99, 11),
('asus', 'PC portable ASUS', 'asus', 'portable', 'Processeur : AMD Ryzen 3 3200U / 2.6 GHz   RAM : 8 Go (1 x 4 Go + 4 Go (soudé)) Résolution : 1600 x 900 (HD+)', 'assets/asus.jpg', 579.99, 6),
('lenovo', 'PC portable Lenovo', 'Lenovo', 'portable', 'Processeur : AMD Athlon Silver 3050U / 2.3 GHz   RAM : 8 Go (1 x 4 Go + 4 Go (soudé)) Résolution : 1600 x 900 (HD+)', 'assets/lenovo.jpg', 499.99, 5),
('samsung', 'Tablette Samsung', 'Samsung', 'tablette', '10.1p TFT - rétroéclairage par LED - 1920 x 1200   (224 ppi) Système d\'exploitation : Android 9.0 (Pie) RAM : 2 Go - LPDDR4 SDRAM Stockage : 32 Go', 'assets/samsung.jpg', 215.19, 4),
('xiaomi', 'XIAOMI Redmi Note 8T 128 Go Bleu', 'xiaomi', 'mobile', 'Taille de la diagonale : 6.3, Résolution du capteur : 48 mégapixels, Capacité : 4000 mAh, Capacité de la mémoire interne : 128 Go, 8 coeurs, RAM : 4 Go, Génération à haut débit mobile : 4G', 'assets/xiaomi.jpg', 252.99, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `lignescommandes`
--
ALTER TABLE `lignescommandes`
  ADD PRIMARY KEY (`idLigneCommande`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idProduit` (`idProduit`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lignescommandes`
--
ALTER TABLE `lignescommandes`
  MODIFY `idLigneCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`email`) REFERENCES `clients` (`email`);

--
-- Constraints for table `lignescommandes`
--
ALTER TABLE `lignescommandes`
  ADD CONSTRAINT `lignescommandes_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `lignescommandes_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
