-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 06:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitterclone`
--

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `id` int(11) NOT NULL,
  `following` text NOT NULL,
  `follower` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `connection`
--

INSERT INTO `connection` (`id`, `following`, `follower`) VALUES
(3, 'jayprajapati', 'elon'),
(4, 'jethalal', 'elon'),
(9, 'jayprajapati', 'jeffbezos'),
(10, 'jeffbezos', 'jayprajapati');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `tweetid` int(11) NOT NULL,
  `username` text NOT NULL,
  `userfullname` text NOT NULL,
  `useravatar` varchar(255) NOT NULL DEFAULT 'Images/default_profile.png',
  `tweet` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`tweetid`, `username`, `userfullname`, `useravatar`, `tweet`) VALUES
(1, 'jayprajapati', 'Prajapati Jay', 'Images/default_profile.png', 'First tweet ever in my twitter clone. 😀'),
(2, 'jayprajapati', 'Prajapati Jay', 'Images/default_profile.png', 'Second Tweet !!'),
(3, 'elon', 'Elon Musk', 'Images/default_profile.png', 'Dogecoin'),
(4, 'jethalal', 'Jethalal Gada', 'Images/default_profile.png', 'I like jalebi fafda 😋'),
(5, 'jeffbezos', 'Jeff Bezos', 'Images/default_profile.png', 'I am going to the moon 🚀'),
(6, 'jeffbezos', 'Jeff Bezos', 'Images/default_profile.png', 'Amazon kaa Maalik Hun Saado !! '),
(7, 'test', 'Test Yr', 'Images/default_profile.png', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` text NOT NULL,
  `userfullname` text NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `userbio` text NOT NULL,
  `userlocation` text NOT NULL,
  `userwebsite` text NOT NULL,
  `userdob` text NOT NULL,
  `userjoined` text NOT NULL,
  `followers` int(11) NOT NULL DEFAULT 0,
  `following` int(11) NOT NULL DEFAULT 0,
  `totaltweets` int(11) NOT NULL DEFAULT 0,
  `useravatar` varchar(255) NOT NULL DEFAULT 'Images/default_profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `userfullname`, `useremail`, `userpassword`, `userbio`, `userlocation`, `userwebsite`, `userdob`, `userjoined`, `followers`, `following`, `totaltweets`, `useravatar`) VALUES
(1, 'jayprajapati', 'Prajapati Jay', 'jay@gmail.com', '84b08c43ef4cc127236af406d55954eb', '', '', '', 'December/9/2002', 'Jul 2021', 2, 1, 2, 'Images/default_profile.png'),
(3, 'jethalal', 'Jethalal Gada', 'jetha@gmail.com', 'c312396dd13befe5243b39ef7a230496', '', '', '', 'March/4/2018', 'Jul 2021', 1, 0, 1, 'Images/default_profile.png'),
(4, 'jeffbezos', 'Jeff Bezos', 'jeff@gmail.com', 'a54040451c21eb5a0fe4e96070a60bb7', '', '', '', 'April/4/2019', 'Jul 2021', 1, 1, 2, 'Images/default_profile.png'),
(6, 'test', 'Test Yr', 'test@gmail.com', '9fa1518a40624deafdaafce67b13800d', '', '', '', 'May/15/2007', 'Jul 2021', 0, 0, 0, 'Images/default_profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`tweetid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `tweetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
