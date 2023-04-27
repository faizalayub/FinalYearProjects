-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2023 at 06:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muslimah_fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Painterly'),
(2, 'New Blooms'),
(3, 'Workwear'),
(4, 'Headscarves');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES
(2, 'Main Admin', 'superadmin@gmail.com', 'admin1234', 1, NULL, NULL),
(3, 'Zacky Abraham Lincolm', 'faizalayub29@gmail.com', 'admin1234', 2, '0164207224', NULL),
(11, 'Nor Syazana Binti Ali', 'norsyazanaali96@gmail.com', 'admin1234', 2, '01126091812', 'No 19 Jalan Kencana Dua 14/KN18\r\nTaman Cove');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `in_stock` int(11) NOT NULL DEFAULT 1,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `category`, `image`, `price`, `in_stock`, `is_active`) VALUES
(9, 'Mahira Blouse & Skirt - Mint Floral Sketch', 2, 'mahira-blouse-skirt-mint-floral-sketch.jpg', '141', 5, 1),
(11, 'Naura Blouse & Skirt - Cream Abstract', 2, 'naura-blouse-skirt-cream-abstract.jpg', '109', 50, 1),
(12, 'Betawi Blouse & Skirt - Eclipse Print', 1, 'betawi-blouse-skirt-eclipse-print.jpg', '112', 10, 1),
(13, 'Sadira Blouse & Skirt - Eclipse', 3, 'sadira-blouse-skirt-eclipse.jpg', '216', 7, 1),
(14, 'Iffah Flared Blouse - Mint Moroccan', 3, 'iffah-flared-blouse-mint-moroccan.jpg', '441', 2, 1),
(15, 'Naleigh Henley Button Blouse - Midnight Blue', 1, 'naleigh-henley-button-blouse-midnight-blue.jpg', '212', 3, 1),
(16, 'Marshanna Embroidered Headscarf - Dusty Lilac', 4, 'marshanna-embroidered-headscarf-dusty-lilac.jpg', '45', 54, 1),
(17, 'Ruvel Embroidered Scallop Headscarf - Black', 4, 'ruvel-embroidered-scallop-headscarf-black.jpg', '22', 34, 1),
(18, 'Aida Chiffon Tudung Headscarf - Gull Gray', 4, 'aida-chiffon-tudung-headscarf-gull-gray.jpg', '56', 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_account`
--

CREATE TABLE `payment_account` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `holder_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` text NOT NULL,
  `status` int(11) NOT NULL,
  `unique_number` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `delivery_method` int(11) NOT NULL,
  `payment_receipt` varchar(100) DEFAULT NULL,
  `payer_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `menu_id`, `status`, `unique_number`, `created_date`, `address`, `payment_method`, `delivery_method`, `payment_receipt`, `payer_name`) VALUES
(59, 11, '[11,11,11]', 2, '3865', '2023-04-25 02:55:05', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, NULL),
(60, 11, '[11]', 1, '4904', '2023-04-25 03:01:25', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, NULL),
(61, 11, '[9]', 1, '5031', '2023-04-25 03:04:10', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, NULL),
(62, 11, '[9]', 1, '5462', '2023-04-27 03:11:47', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, NULL),
(63, 11, '[9]', 2, '3050', '2023-04-27 03:13:16', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, NULL),
(64, 11, '[18,15]', 1, '2327', '2023-04-27 03:30:21', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_account`
--
ALTER TABLE `payment_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payment_account`
--
ALTER TABLE `payment_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
