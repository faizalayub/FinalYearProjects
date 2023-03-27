-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2023 at 05:32 AM
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
-- Database: `wattpad`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` int(11) DEFAULT NULL,
  `is_restricted` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `genres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `headline`, `content`, `category`, `is_restricted`, `image`, `posted_by`, `genres`) VALUES
(7, 'THE BEAST (SHORT STORY)', 'There was once a woman who was very, very cheerful, though she had little to make her so; for she was old, and poor, and lonely. She lived in a little bit of a cottage and earned a scant living by running errands for her neighbours, getting a bite here, a sup there, as reward for her services. So she made shift to get on, and always looked as spry and cheery as if she had not a want in the world.\r\nNow one summer evening, as she was trotting, full of smiles as ever, along the high road to her hovel, what should she see but a big black pot lying in the ditch!\r\n&quot;Goodness me!&quot; she cried, &quot;that would be just the very thing for me if I only had something to put in it! But I haven&#039;t! Now who could have left it in the ditch?&quot;\r\nAnd she looked about her expecting the owner would not be far off; but she could see nobody.\r\n&quot;Maybe there is a hole in it,&quot; she went on, &quot;and that&#039;s why it has been cast away. But it would do fine to put a flower in for my window; so I&#039;ll just take it home with me.&quot;\r\nAnd with that she lifted the lid and looked inside. &quot;Mercy me!&quot; she cried, fair amazed. &quot;If it isn&#039;t full of gold pieces. Here&#039;s luck!&quot;\r\nAnd so it was, brimful of great gold coins. Well, at first she simply stood stock-still, wondering if she was standing on her head or her heels. Then she began saying:\r\n&quot;Lawks! But I do feel rich. I feel awful rich!&quot;\r\nAfter she had said this many times, she began to wonder how she was to get her treasure home. It was too heavy for her to carry, and she could see no better way than to tie the end of her shawl to it and drag it behind her like a go-cart.\r\n&quot;It will soon be dark,&quot; she said to herself as she trotted along. &quot;So much the better! The neighbours will not see what I&#039;m bringing home, and I shall have all the night to myself, and be able to think what I&#039;ll do! Mayhap I&#039;ll buy a grand house and just sit by the fire with a cup o&#039; tea and do no work at all like a queen. Or maybe I&#039;ll bury it at the garden foot and just keep a bit in the old china teapot on the chimney-piece. Or maybe&mdash;Goody! Goody! I feel that grand I don&#039;t know myself.&quot;\r\nBy this time she was a bit tired of dragging such a heavy weight, and, stopping to rest a while, turned to look at her treasure.\r\nAnd lo! it wasn&#039;t a pot of gold at all! It was nothing but a lump of silver.\r\nShe stared at it, and rubbed her eyes, and stared at it again.\r\n&quot;Well! I never!&quot; she said at last. &quot;And me thinking it was a pot of gold! I must have been dreaming. But this is luck! Silver is far less trouble&mdash;easier to mind, and not so easy stolen. Them gold pieces would have been the death o&#039; me, and with this great lump of silver&mdash;&quot;\r\nSo she went off again planning what she would do, and feeling as rich as rich, until becoming a bit tired again she stopped to rest and gave a look round to see if her treasure was safe; and she saw nothing but a great lump of iron!\r\n&quot;Well! I never!&quot; says she again. &quot;And I mistaking it for silver! I must have been dreaming. But this is luck! It&#039;s real convenient. I can get penny pieces for old iron, and penny pieces are a deal handier for me than your gold and silver. Why! I should never have slept a wink for fear of being robbed. But a penny piece comes in useful, and I shall sell that iron for a lot and be real rich&mdash;rolling rich.&quot;\r\nSo on she trotted full of plans as to how she would spend her penny pieces, till once more she stopped to rest and looked round to see her treasure was safe. And this time she saw nothing but a big stone.\r\n&quot;Well! I never!&quot; she cried, full of smiles. &quot;And to think I mistook it for iron. I must have been dreaming. But here&#039;s luck indeed, and me wanting a stone terrible bad to stick open the gate. Eh my! but it&#039;s a change for the better! It&#039;s a fine thing to have good luck.&quot;\r\nSo, all in a hurry to see how the stone would keep the gate open, she trotted off down the hill till she came to her own cottage. She unlatched the gate and then turned to unfasten her shawl from the stone which lay on the path behind her. Aye! It was a stone sure enough. There was plenty light to see it lying there, douce and peaceable as a stone should.\r\nSo she bent over it to unfasten the shawl end, when&mdash;&quot;Oh my!&quot; All of a sudden it gave a jump, a squeal, and in one moment was as big as a haystack. Then it let down four great lanky legs and threw out two long ears, nourished a great long tail and romped off, kicking and squealing and whinnying and laughing like a naughty, mischievous boy!\r\nThe old woman stared after it till it was fairly out of sight, then she burst out laughing too.\r\n&quot;Well!&quot; she chuckled, &quot;I am in luck! Quite the luckiest body hereabouts. Fancy my seeing the Bogey-Beast all to myself; and making myself so free with it too! My goodness! I do feel that uplifted&mdash;that GRAND!&quot;&mdash;\r\nSo she went into her cottage and spent the evening chuckling over her good luck.', 2, 0, 'Screenshot 2022-12-30 at 1.16.41 AM.png', 4, 1),
(9, 'THE ROAD NOT TAKEN', 'Two roads diverged in a yellow wood,\r\nAnd sorry I could not travel both\r\nAnd be one traveler, long I stood\r\nAnd looked down one as far as I could\r\nTo where it bent in the undergrowth;\r\n\r\n\r\nThen took the other, as just as fair,\r\nAnd having perhaps the better claim,\r\nBecause it was grassy and wanted wear;\r\nThough as for that the passing there\r\nHad worn them really about the same,\r\n\r\n\r\nAnd both that morning equally lay\r\nIn leaves no step had trodden black.\r\nOh, I kept the first for another day!\r\nYet knowing how way leads on to way,\r\nI doubted if I should ever come back.\r\n\r\n\r\nI shall be telling this with a sigh\r\nSomewhere ages and ages hence:\r\nTwo roads diverged in a wood, and I&mdash;\r\nI took the one less traveled by,\r\nAnd that has made all the difference.', 3, 1, 'Screenshot 2022-12-30 at 1.39.52 AM.png', 5, 3);

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
(4, 'Abdul Samad Manaf Hanafi', 'manapanakikan65@gmail.com', 'admin1234', '960802105225'),
(5, 'Muhammad Faizal Bin Ayub', 'faizalayub29@gmail.com', 'admin1234', '18'),
(6, 'superadmin', 'superadmin@gmail.com', 'admin1234', '30');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
