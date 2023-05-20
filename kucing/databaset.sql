-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2023 at 10:36 AM
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
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adopt`
--

INSERT INTO `adopt` (`id`, `cat_id`, `user_id`, `status`) VALUES
(9, 4, 5, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `textarea` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `textarea`) VALUES
(2, 'Keep in mind that tables in relational databases are just sets of rows. And sets in mathematics are unordered collections. There is no first or last row; no previous row or next row.\r\n\r\nYoull have to sort your set of unordered rows by some field first, and then you are free the iterate through the resultset in the order you defined.\r\n\r\nSince you have an auto incrementing field, I assume you want that to be the sorting field. In that case, you may want to do the following:'),
(3, 'Keep in mind that tables in relational databases are just sets of rows. And sets in mathematics are unordered collections. There is no first or last row; no previous row or next row.\r\n\r\nYou\'ll have to sort your set of unordered rows by some field first, and then you are free the iterate through the resultset in the order you defined.\r\n\r\nSince you have an auto incrementing field, I assume you want that to be the sorting field. In that case, you may want to do the following:'),
(4, 'Keep in mind that tables in relational databases are just sets of rows. And sets in mathematics are unordered collections. There is no first or last row; no previous row or next row.\r\n\r\nYou\'ll have to sort your set of unordered rows by some field first, and then you are free the iterate through the resultset in the order you defined.\r\n\r\nSince you have an auto incrementing field, I assume you want that to be the sorting field. In that case, you may want to do the following: 1\r\n'),
(5, 'Keep in mind that tables in relational databases are just sets of rows. And sets in mathematics are unordered collections. There is no first or last row; no previous row or next row.\r\n\r\nYou\'ll have to sort your set of unordered rows by some field first, and then you are free the iterate through the resultset in the order you defined.\r\n\r\nSince you have an auto incrementing field, I assume you want that to be the sorting field. In that case, you may want to do the following: 2\r\n'),
(6, 'Keep in mind that tables in relational databases are just sets of rows. And sets in mathematics are unordered collections. There is no first or last row; no previous row or next row.\r\n\r\nYou\'ll have to sort your set of unordered rows by some field first, and then you are free the iterate through the resultset in the order you defined.\r\n\r\nSince you have an auto incrementing field, I assume you want that to be the sorting field. In that case, you may want to do the following:\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `vet`
--

CREATE TABLE `vet` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vet`
--

INSERT INTO `vet` (`id`, `description`, `address`, `phone`) VALUES
(1, 'Catropolitian Vertenarity Clinic', 'No 33G, Jalan Meda Bukit Indah 2, Taman Bukit Indah, 6800 Ampang Selangor', '+601992912'),
(2, 'Klinik Bonda Kuat', 'No 4 Jalan Jambu Madu 14/KU 10 Taman Meru Ria 41050 Klang Selangor ', '+887182222'),
(3, 'Kubur Cina', 'No 4 Jalan Jambu Madu 14/KU 10 Taman Meru Ria 41050 Klang Selangor ', '+00918882'),
(4, 'Melaka Cat Centre', 'No 4 Jalan Jambu Madu 14/KU 10 Taman Meru Ria 41050 Klang Selangor ', '098817721'),
(5, '1Catropolitian Vertenarity Clinic', 'No 33G, Jalan Meda Bukit Indah 2, Taman Bukit Indah, 6800 Ampang Selangor', '+1601992912');

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
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vet`
--
ALTER TABLE `vet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopt`
--
ALTER TABLE `adopt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vet`
--
ALTER TABLE `vet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
