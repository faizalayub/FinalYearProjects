-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2023 at 05:31 AM
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
-- Database: `lizkrispychip_kerepek`
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
(1, 'Ubi'),
(2, 'Pisang'),
(3, 'Kacang'),
(4, 'Tortilla');

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
(3, 'MUHAMMAD FAIZAL BIN AYUB', 'faizalayub29@gmail.com', 'admin1234', 2, '0164207224', 'No 4 Jalan Jambu Madu 14/KU 10\r\nTaman Meru Ria\r\n41050 Klang'),
(4, 'MUHAMMAD FAIZAL BIN AYUB', 'faizalarg123@gmail.com', 'admin1234', 2, '60164207224', 'No 4 Jalan Jambu Madu 14/KU 10\r\nTaman Meru Ria\r\n41050 Klang'),
(10, 'Main Admin 2', 'mainadmin@gmail.com', 'admin1234', 1, NULL, NULL);

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
(6, 'Kerepek Udang', 2, 'kerepek_1.jpeg', '14', 50, 1),
(7, 'Kerepek Pisang', 1, 'kerepek_2.jpeg', '15', 40, 1),
(8, 'Ubi Keledek Wangi', 1, 'kerepek_3.jpeg', '21', 2, 1);

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

--
-- Dumping data for table `payment_account`
--

INSERT INTO `payment_account` (`id`, `type`, `holder_name`, `account_number`) VALUES
(2, 'bankislam', 'Muhammad Faizal Bin Ayub', '0192800992921');

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
(40, 3, '[7,6,8]', 4, '4996', '2023-01-25 04:06:19', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 2, 1, NULL, ''),
(41, 3, '[7]', 2, '7844', '2023-02-25 04:06:56', 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh', 1, 1, NULL, ''),
(42, 3, '[6]', 3, '6304', '2023-04-25 04:07:13', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 2, 2, NULL, ''),
(43, 3, '[7]', 2, '4847', '2023-02-25 04:08:30', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 1, 2, NULL, ''),
(44, 3, '[6,7,6,7,7]', 2, '6982', '2023-02-25 07:11:50', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 2, 2, NULL, ''),
(45, 3, '[7,7,7]', 2, '5510', '2023-02-25 07:13:33', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 2, 2, NULL, ''),
(46, 3, '[8]', 2, '4166', '2023-02-25 07:14:06', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 1, 2, '3971677578940.pdf', 'Faizal Ayub'),
(57, 3, '[6]', 1, '1560', '2023-03-25 23:28:50', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 2, 2, NULL, NULL),
(58, 3, '[6]', 1, '5445', '2023-03-25 23:30:21', 'No 4 Jalan Jambu Madu 14/KU 10Taman Meru Ria41050 Klang', 2, 2, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_account`
--
ALTER TABLE `payment_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
