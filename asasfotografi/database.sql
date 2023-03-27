-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2023 at 05:18 AM
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
-- Database: `asas_fotografi`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` int(11) DEFAULT 1,
  `is_restricted` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `genres` int(11) DEFAULT 1,
  `reading_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `headline`, `content`, `category`, `is_restricted`, `image`, `posted_by`, `genres`, `reading_path`) VALUES
(7, 'Peraturan Untuk Fotografi', 'Ada banyak ‘peraturan’ untuk fotografi portrait, tapi yang 10 ini adalah yang paling umum\ndigunakan. Tentu saja sebenarnya tidak ada ‘peraturan’ dalam fotografi. Eksperimen adalah\nkunci untuk kreativitas, seperti juga berpikir ‘out-of-the-box’. Tapi kesepuluh peraturan ini\nbanyak digunakan tentu karena alasan yang jelas : membuat portrait tampak lebih bagus.', 2, 0, 'sample_1.png', 4, 1, 'Prinsip Asas Fotografi.pptx'),
(9, 'Prinsip Asas Fotografi', 'Hal ini merupakan faktor penting untuk mencipta kesan kedalaman dan realiti. Kualiti ini tercipta dari pembentukan cahaya dan tone yang kemudian membentuk garis-garis dari sebuah objek. Faktor penting yang menentukan bagaimana form terbentuk adalah arah dan kualiti cahaya yang mengenai objek tersebut', 3, 1, 'sample_2.png', 5, 3, 'Peraturan Untuk Fotografi.pdf');

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
(1, 'short stories'),
(2, 'poem'),
(3, 'short story-restricted contents'),
(4, 'quotes');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Fiction'),
(2, 'Non-fiction'),
(3, 'Comedy'),
(4, 'Fairy tale'),
(5, 'Historical'),
(6, 'Horror'),
(7, 'Crime'),
(8, 'Education'),
(9, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `age`) VALUES
(4, 'Abdul Samad Manaf Hanafi', 'manapanakikan65@gmail.com', 'admin1234', ''),
(5, 'Muhammad Faizal Bin Ayub', 'faizalayub29@gmail.com', 'admin1234', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
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
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
