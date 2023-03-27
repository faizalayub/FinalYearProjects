-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2023 at 05:28 AM
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
-- Database: `cat_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `adopt`
--

CREATE TABLE `adopt` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adopt`
--

INSERT INTO `adopt` (`id`, `cat_id`, `user_id`) VALUES
(1, 1, 2),
(2, 4, 10),
(3, 7, 10),
(4, 5, 10),
(5, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `race` varchar(255) DEFAULT NULL,
  `food` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `maintenance` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `name`, `race`, `food`, `gender`, `maintenance`, `age`, `description`, `picture`) VALUES
(4, 'Jerry 1', 'Persian', 'Eat fresh meat only', 'Female', 'More than RM 50 monthly', '1', 'Kucing ni ada kurap sikit kt tepi pipi kanan, tapi tak pa, mnde bole settle', '72295960.webp'),
(5, 'Momo', 'Doggo', 'Eat Fiskies', 'Female', 'RM40 Monthly', '4', 'Kucing tua je ni', '203831.jpeg'),
(6, 'Cici', 'Arabian', 'Eat Mouse & Fiskies', 'Female', 'N/A', '4', 'This cat i bought her yesterday, now i want to refund back ya', 'Thinking-of-getting-a-cat.png'),
(7, 'Juvenile Ragdoll', 'Dolphine', 'Vegetarian food only', 'Male', 'RM100 Monthly', '4', 'Very rare cat that have weird personality', 'Juvenile_Ragdoll.jpeg');

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
(1, 'Beverage'),
(2, 'Drink'),
(3, 'Meal'),
(4, 'Dessert');

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
  `address` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`, `picture`) VALUES
(2, 'superadmin', 'superadmin@gmail.com', 'admin1234', 1, NULL, NULL, NULL),
(5, 'haziqcom97', 'haziqcom97@gmail.com', 'admin1234', 2, '0188727781', 'No 4 Jalan Jambu Madu 14/KU 10\r\nTaman Meru Ria\r\n41050 Klang', NULL),
(10, 'faizalayub29', 'faizalayub29@gmail.com', 'admin1234', 2, '60164207224', 'No 4 Jalan Jambu Madu 14/KU 10\r\nTaman Meru Ria\r\n41050 Klang', '600x448_855264005837193217_855264889795690496.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopt`
--
ALTER TABLE `adopt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopt`
--
ALTER TABLE `adopt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
