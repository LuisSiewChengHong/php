-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2025 at 04:51 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `username` varchar(128) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` int NOT NULL,
  `registration_date` date NOT NULL,
  `stat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `first_name`, `last_name`, `password`, `registration_date`, `stat`) VALUES
('luis', '', '', 1234, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `product_cat` int NOT NULL,
  `price` double NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `product_cat`, `price`, `manufacture_date`, `expired_date`, `created`, `modified`) VALUES
(1, 'RTX 5070', 'Graphic Card', 3, 500, '2025-01-01 00:00:00', '2025-01-19 00:00:00', '2025-01-15 08:41:29', '0000-00-00 00:00:00'),
(7, 'Sofa', 'A comfy seat to be sat on.', 1, 400, '2025-01-02 00:00:00', '2025-01-08 00:00:00', '2025-01-15 09:33:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE IF NOT EXISTS `product_cat` (
  `product_cat_id` int NOT NULL AUTO_INCREMENT,
  `product_cat_name` varchar(50) NOT NULL,
  `product_cat_description` text NOT NULL,
  PRIMARY KEY (`product_cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_cat_id`, `product_cat_name`, `product_cat_description`) VALUES
(1, 'Sport', ''),
(2, 'Animal', ''),
(3, 'Games', ''),
(4, 'Search Engine', ''),
(5, 'Furniture', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
