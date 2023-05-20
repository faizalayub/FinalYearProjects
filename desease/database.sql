-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2023 at 11:47 AM
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
-- Database: `disease_recomentor`
--

-- --------------------------------------------------------

--
-- Table structure for table `body`
--

CREATE TABLE `body` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `body`
--

INSERT INTO `body` (`id`, `name`) VALUES
(2, 'Lower Back Right'),
(3, 'Head (Back)'),
(4, 'Head (Front Upper)'),
(5, 'Head (Right)'),
(6, 'Head (Left)'),
(8, 'Body Top'),
(9, 'Albow'),
(11, 'Leg (Right)');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `reply_to` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `message`, `reply_to`, `created_date`) VALUES
(7, 2, 'Assalamualikum, nama saya doktor Amira', 3, '2023-05-20 01:47:56'),
(8, 2, 'Harini kita ada appointement tak silap sy, betul?', 3, '2023-05-20 01:48:12'),
(9, 3, 'hi ', 2, '2023-05-20 02:33:25'),
(10, 3, 'Waalaikumuslm', 2, '2023-05-20 02:34:36'),
(11, 2, 'Betul tak?', 3, '2023-05-20 02:38:42'),
(12, 2, 'Risau ke', 3, '2023-05-20 02:38:51'),
(13, 3, 'Woi reply la', 2, '2023-05-20 03:17:26'),
(14, 2, 'Jap eh', 3, '2023-05-20 03:17:35');

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
(2, 'Doctor', 'superadmin@gmail.com', 'admin1234', 1, NULL, NULL),
(3, 'Faizal Ayub', 'faizalayub29@gmail.com', 'admin1234', 2, '+60164207224', 'No 4 Jalan Jambu Madu 14/KU10'),
(11, 'Nor Syazana Binti Ali', 'norsyazanaali96@gmail.com', 'admin1234', 2, '01126091812', 'No 19 Jalan Kencana Dua 14/KN18\r\nTaman Cove');

-- --------------------------------------------------------

--
-- Table structure for table `possible_disease`
--

CREATE TABLE `possible_disease` (
  `id` int(11) NOT NULL,
  `possible` text DEFAULT NULL,
  `body` text DEFAULT NULL,
  `syntom` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `possible_disease`
--

INSERT INTO `possible_disease` (`id`, `possible`, `body`, `syntom`) VALUES
(2, '[\"Bone Cracker\",\"Sinus\",\"Death Match\"]', '[\"5\",\"6\",\"8\"]', '[\"2\",\"5\",\"8\"]'),
(3, '[\"Head Cancer\",\"GERD\",\"Heart Disease1\"]', '[\"2\",\"5\",\"6\"]', '[\"5\",\"7\",\"9\"]'),
(4, '[\"Leg disease\",\"Smelly foot\",\"Mouth Smelly\"]', '[\"6\",\"11\"]', '[\"5\",\"6\"]');

-- --------------------------------------------------------

--
-- Table structure for table `syntom`
--

CREATE TABLE `syntom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syntom`
--

INSERT INTO `syntom` (`id`, `name`) VALUES
(2, 'Runny nose'),
(3, 'Sinus pain from congestion'),
(4, 'Fatigue'),
(5, 'Thirst'),
(6, 'Chest pain'),
(7, 'Spots and blisters'),
(8, 'Poor wound healing'),
(9, 'Spots and blisters'),
(10, 'Chickenpox'),
(11, 'Coronary heart disease'),
(12, 'Type 2 diabetes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body`
--
ALTER TABLE `body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `possible_disease`
--
ALTER TABLE `possible_disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syntom`
--
ALTER TABLE `syntom`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body`
--
ALTER TABLE `body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `possible_disease`
--
ALTER TABLE `possible_disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `syntom`
--
ALTER TABLE `syntom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
