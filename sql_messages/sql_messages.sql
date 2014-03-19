-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2013 at 09:52 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sql_messages`
--
CREATE DATABASE IF NOT EXISTS `sql_messages` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sql_messages`;

-- --------------------------------------------------------

--
-- Table structure for table `loggeduser`
--

CREATE TABLE IF NOT EXISTS `loggeduser` (
  `active` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loggeduser`
--

INSERT INTO `loggeduser` (`active`) VALUES
('test1');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msgbody` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `published` datetime NOT NULL,
  `author` varchar(50) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`msg_id`, `msgbody`, `title`, `published`, `author`) VALUES
(86, 'test', 'test', '2013-10-09 21:36:56', 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('test1', 'test1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
