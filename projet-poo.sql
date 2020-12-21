-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2020 at 06:48 PM
-- Server version: 10.2.3-MariaDB-log
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet-poo`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` date DEFAULT NULL,
  `sondage_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `pseudo`, `message`, `date_envoi`, `sondage_id`) VALUES
(3, 'aze', 'haha, facile!', '2020-12-02', 11),
(4, 'aze', 'test message plus tard', '2020-12-02', 11),
(5, 'aze', 'ce message vient de ce sondage, il ne doit pas se retrouver ailleurs.', '2020-12-02', 5);

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL COMMENT 'l''ami du user_id',
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`user_id`, `friend_user_id`, `creation_date`) VALUES
(5, 1, '2020-12-02 19:19:36'),
(5, 2, '2020-12-02 19:19:41'),
(5, 3, '2020-12-02 19:19:33'),
(5, 7, '2020-12-01 00:00:00'),
(5, 10, '2020-12-01 20:43:34'),
(7, 3, '2020-12-01 00:00:00'),
(7, 5, '2020-12-01 00:00:00'),
(7, 8, '2020-12-01 20:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `parti_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sondage_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`parti_id`, `user_id`, `sondage_id`) VALUES
(1, 1, 1),
(2, 5, 6),
(3, 5, 6),
(4, 6, 7),
(5, 5, 10),
(6, 10, 11),
(7, 5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `sondage_id` int(11) NOT NULL,
  `result_1` int(11) NOT NULL,
  `result_2` int(11) NOT NULL,
  `result_3` int(11) NOT NULL,
  `result_4` int(11) NOT NULL,
  `total_entries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `sondage_id`, `result_1`, `result_2`, `result_3`, `result_4`, `total_entries`) VALUES
(1, 5, 0, 0, 0, 0, 0),
(2, 6, 1, 1, 0, 1, 3),
(3, 7, 1, 0, 0, 0, 1),
(4, 8, 0, 0, 0, 0, 0),
(5, 9, 0, 0, 0, 0, 0),
(6, 10, 1, 0, 0, 0, 1),
(7, 11, 0, 0, 0, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sondages`
--

CREATE TABLE `sondages` (
  `sondage_id` int(11) NOT NULL,
  `sondage_title` varchar(255) NOT NULL,
  `sondage_question1` varchar(255) NOT NULL,
  `sondage_question2` varchar(255) NOT NULL,
  `sondage_question3` varchar(255) NOT NULL,
  `sondage_question4` varchar(255) NOT NULL,
  `creation_date` date NOT NULL,
  `status_sondage` varchar(5) NOT NULL,
  `sondage_creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sondages`
--

INSERT INTO `sondages` (`sondage_id`, `sondage_title`, `sondage_question1`, `sondage_question2`, `sondage_question3`, `sondage_question4`, `creation_date`, `status_sondage`, `sondage_creator`) VALUES
(5, 'Test Results', 'Q1', 'Q2', 'Q3', 'Q4', '2020-11-29', 'Off', 5),
(6, 'Ou est mon gouter', 'dans mon panier', 'dans mon sac', 'oublié chez moi', 'je l\'ai mangé', '2020-11-29', 'Off', 5),
(7, 'Titre demo', 'demo1', 'demo2', 'demo3', 'demo4', '2020-11-30', 'Off', 6),
(8, 'Titre demo', 'demo1', 'demo2', 'demo3', 'demo4', '2020-11-30', 'Off', 6),
(9, 'titre demo', 'demo1', 'demo2', 'demo3', 'demo4', '2020-11-30', 'Off', 6),
(10, 'testredirect', 'test', 'test', 'test', 'test', '2020-11-30', 'Off', 5),
(11, 'qui est l\'intrus', 'eric', 'michelle', 'michel', 'échelle', '2020-12-01', 'On', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pseudo`, `email`, `password`) VALUES
(1, 'user1', 'user1@gmail.com', 'azerty'),
(2, 'user2', 'user2@gmail.com', 'supermotdepasse'),
(3, 'test', 'test@test.fr', 'test'),
(5, 'aze', 'aze', 'aze'),
(6, 'compte2', 'compte2', 'compte2'),
(7, 'retest', 'restest', 'retest'),
(10, 'qwe', 'qwe', 'qwe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sondage_id` (`sondage_id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`user_id`,`friend_user_id`),
  ADD KEY `USER_ID_2_FK` (`friend_user_id`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`parti_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sondage_id` (`sondage_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `sondage_id` (`sondage_id`);

--
-- Indexes for table `sondages`
--
ALTER TABLE `sondages`
  ADD PRIMARY KEY (`sondage_id`),
  ADD KEY `sondage_creator` (`sondage_creator`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `parti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sondages`
--
ALTER TABLE `sondages`
  MODIFY `sondage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`sondage_id`) REFERENCES `sondages` (`sondage_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
