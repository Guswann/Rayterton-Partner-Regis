-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2025 at 03:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tespartner`
--

-- --------------------------------------------------------

--
-- Table structure for table `rtn_ac_institusi_partner`
--

CREATE TABLE `rtn_ac_institusi_partner` (
  `kode_institusi_partner` varchar(50) DEFAULT NULL,
  `nama_institusi` varchar(255) DEFAULT NULL,
  `nama_partner` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `referral_awal` text,
  `profil_jaringan` text,
  `segment_industri_fokus` text,
  `promo_suggestion` varchar(4) DEFAULT NULL,
  `ACTIVE_STATUS` varchar(1) DEFAULT NULL,
  `discount_pct` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rtn_ac_institusi_partner`
--

INSERT INTO `rtn_ac_institusi_partner` (`kode_institusi_partner`, `nama_institusi`, `nama_partner`, `email`, `password`, `referral_awal`, `profil_jaringan`, `segment_industri_fokus`, `promo_suggestion`, `ACTIVE_STATUS`, `discount_pct`) VALUES
(NULL, 'institusitus', '', 'omkegams@gmail.com', '', '', '123123asdasd', 'Keuangin', 'OMKE', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rtn_ac_promocodes`
--

CREATE TABLE `rtn_ac_promocodes` (
  `PROMO_CODE` varchar(50) DEFAULT NULL,
  `DISCOUNT_PCT` int DEFAULT NULL,
  `ACTIVE_YN` varchar(1) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `referral_awal` text,
  `profil_jaringan` text,
  `segment_industri_fokus` text,
  `promo_suggestion` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rtn_ac_institusi_partner`
--
ALTER TABLE `rtn_ac_institusi_partner`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rtn_ac_promocodes`
--
ALTER TABLE `rtn_ac_promocodes`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
