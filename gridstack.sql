-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2016 at 03:36 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gridstack`
--

-- --------------------------------------------------------

--
-- Table structure for table `homegrid`
--

CREATE TABLE IF NOT EXISTS `homegrid` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `circle` varchar(255) NOT NULL,
  `text` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `pseudo_price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `link` varchar(200) NOT NULL,
  `color` varchar(10) NOT NULL,
  `columns` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `status` enum('online','offline') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homegrid`
--

INSERT INTO `homegrid` (`id`, `title`, `subtitle`, `circle`, `text`, `price`, `pseudo_price`, `img`, `link`, `color`, `columns`, `position`, `status`) VALUES
(1, '', '', '', '', 0, 0, '', '', '', 0, '{"x":1,"y":0,"width":2,"height":5}', 'offline'),
(2, '', '', '', '', 0, 0, '', '', '', 0, '{"x":3,"y":0,"width":2,"height":5}', 'offline'),
(3, '', '', '', '', 0, 0, '', '', '', 0, '{"x":5,"y":0,"width":2,"height":6}', 'offline'),
(5, '', '', '', '', 0, 0, '', '', '', 0, '{"x":9,"y":0,"width":2,"height":6}', 'offline'),
(6, '', '', '', '', 0, 0, '', '', '', 0, '{"x":5,"y":6,"width":2,"height":5}', 'offline'),
(7, '', '', '', '', 0, 0, '', '', '', 0, '{"x":7,"y":4,"width":2,"height":5}', 'offline'),
(9, '', '', '', '', 0, 0, '', '', '', 0, '{"x":9,"y":6,"width":2,"height":5}', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homegrid`
--
ALTER TABLE `homegrid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homegrid`
--
ALTER TABLE `homegrid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
