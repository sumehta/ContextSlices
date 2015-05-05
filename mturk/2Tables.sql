-- This file is used to create the 2 tables in the MySQL database. 
-- Table 1 is the first page's submissions
-- Table 2 is the second page's submissions





-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2015 at 07:42 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `turk`
--

-- --------------------------------------------------------

--
-- Table structure for table `appreview_db`
--

CREATE TABLE IF NOT EXISTS `appreview_db` (
`id` int(10) unsigned NOT NULL,
  `worker_id` varchar(200) DEFAULT NULL,
  `beReviewer_id` varchar(200) DEFAULT NULL,
  `assignment_id` varchar(200) DEFAULT NULL,
  `buttonValue` int(1) unsigned DEFAULT NULL,
  `img_id` varchar(200) DEFAULT NULL,
  `endpoint` varchar(50) NOT NULL,
  `when_completed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_db`
--

CREATE TABLE IF NOT EXISTS `app_db` (
`id` int(10) unsigned NOT NULL,
  `worker_id` varchar(200) DEFAULT NULL,
  `assignment_id` varchar(200) DEFAULT NULL,
  `description` text,
  `location` text,
  `confidence` int(3) DEFAULT NULL,
  `why` text,
  `img_id` varchar(200) DEFAULT NULL,
  `endpoint` varchar(50) NOT NULL,
  `when_completed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appreview_db`
--
ALTER TABLE `appreview_db`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_db`
--
ALTER TABLE `app_db`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appreview_db`
--
ALTER TABLE `appreview_db`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `app_db`
--
ALTER TABLE `app_db`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
