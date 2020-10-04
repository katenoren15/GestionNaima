-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 16, 2020 at 08:42 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nayaholding`
--

-- --------------------------------------------------------

--
-- Table structure for table `bon`
--

CREATE TABLE `bon` (
  `bon_id` int(11) NOT NULL,
  `date_de_bon` date NOT NULL,
  `type` enum('Entrée','Sortie') NOT NULL,
  `responsable` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `telephone` int(11) NOT NULL,
  `exigence` text NOT NULL,
  `situation_financiere` text NOT NULL,
  `preferences` text NOT NULL,
  `client_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_account`
--

CREATE TABLE `client_account` (
  `transaction_id` int(11) NOT NULL,
  `client_id` varchar(200) NOT NULL,
  `transaction_date` date NOT NULL,
  `trans_desc` text NOT NULL,
  `total` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `amount_left` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_cat`
--

CREATE TABLE `client_cat` (
  `client_cat_id` int(11) NOT NULL,
  `client_cat_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_observation`
--

CREATE TABLE `client_observation` (
  `obs_id` int(11) NOT NULL,
  `client_id` varchar(200) NOT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `code_barre` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `designation` varchar(200) NOT NULL,
  `prix_de_vente` varchar(100) DEFAULT NULL,
  `prix_achat` varchar(100) DEFAULT NULL,
  `reference_interne` varchar(200) DEFAULT NULL,
  `reference_externe` varchar(200) DEFAULT NULL,
  `colissage` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_bon`
--

CREATE TABLE `product_bon` (
  `bon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_asked` int(11) NOT NULL,
  `quantity_given` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `product_cat_id` int(11) NOT NULL,
  `product_cat_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prospect`
--

CREATE TABLE `prospect` (
  `prospect_id` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenoms` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telephone` varchar(50) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `activite` varchar(200) NOT NULL,
  `exigence` text NOT NULL,
  `connaissance` enum('Oui','Non') NOT NULL,
  `potentiel_achat` enum('Oui','Non') NOT NULL,
  `nature_besoins` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prospect_observation`
--

CREATE TABLE `prospect_observation` (
  `obs_id` int(11) NOT NULL,
  `prospect_id` int(11) NOT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `fullName`, `username`, `pwd`) VALUES
(1, 'Kate Achy', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `visite`
--

CREATE TABLE `visite` (
  `visite_id` int(11) NOT NULL,
  `prospect_id` int(11) NOT NULL,
  `date_de_visite` date NOT NULL,
  `objet_visite` varchar(200) NOT NULL,
  `resultats` text NOT NULL,
  `a_relancer` enum('Oui','Non') NOT NULL,
  `date_de_relance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon`
--
ALTER TABLE `bon`
  ADD PRIMARY KEY (`bon_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `client_cat_id` (`client_cat_id`);

--
-- Indexes for table `client_account`
--
ALTER TABLE `client_account`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_cat`
--
ALTER TABLE `client_cat`
  ADD PRIMARY KEY (`client_cat_id`);

--
-- Indexes for table `client_observation`
--
ALTER TABLE `client_observation`
  ADD PRIMARY KEY (`obs_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `product_cat_id` (`product_cat_id`);

--
-- Indexes for table `product_bon`
--
ALTER TABLE `product_bon`
  ADD PRIMARY KEY (`bon_id`,`product_id`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`product_cat_id`);

--
-- Indexes for table `prospect`
--
ALTER TABLE `prospect`
  ADD PRIMARY KEY (`prospect_id`),
  ADD UNIQUE KEY `telephone` (`telephone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `prospect_observation`
--
ALTER TABLE `prospect_observation`
  ADD PRIMARY KEY (`obs_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`visite_id`,`prospect_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bon`
--
ALTER TABLE `bon`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_cat`
--
ALTER TABLE `client_cat`
  MODIFY `client_cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `product_cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`client_cat_id`) REFERENCES `client_cat` (`client_cat_id`);

--
-- Constraints for table `client_account`
--
ALTER TABLE `client_account`
  ADD CONSTRAINT `client_account_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);

--
-- Constraints for table `client_observation`
--
ALTER TABLE `client_observation`
  ADD CONSTRAINT `client_observation_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`product_cat_id`) REFERENCES `product_cat` (`product_cat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
