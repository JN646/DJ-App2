-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2018 at 08:10 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djapp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE IF NOT EXISTS `collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The ID of the Collection',
  `collection_name` varchar(30) NOT NULL COMMENT 'The Collection Name',
  PRIMARY KEY (`collection_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`collection_id`, `collection_name`) VALUES
(1, 'Top 40'),
(2, '90s'),
(3, '80s'),
(4, '70s'),
(5, 'Grime'),
(6, 'Rock'),
(7, '');

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

DROP TABLE IF EXISTS `crud`;
CREATE TABLE IF NOT EXISTS `crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `genre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `name`, `artist`, `genre`) VALUES
(1, 'Song 1', 'Person C', 'Pop'),
(2, '22', 'Taylor Swift', 'Pop'),
(3, 'Shape Of You', 'Ed Sheeran', 'Pop'),
(4, 'Whole Lotta Shakin\' Going On', 'Jerry Lee Lewis', 'Rock'),
(5, 'Tutti Fruiti', 'Little Richard', 'Rock'),
(6, 'Billie Jean', 'Michael Jackson', 'Pop'),
(7, 'Don\'t Stop Me Now', 'Queen', 'Rock');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_s_name` varchar(50) DEFAULT NULL,
  `request_s_artist` varchar(50) NOT NULL,
  `request_s_album` varchar(50) NOT NULL,
  `request_s_genre` varchar(15) NOT NULL,
  `request_active` tinyint(1) NOT NULL DEFAULT '1',
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `request_s_name`, `request_s_artist`, `request_s_album`, `request_s_genre`, `request_active`, `request_time`) VALUES
(1, '22', 'Taylor Swift', 'RED', 'Pop', 1, '2018-05-24 14:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The Song ID',
  `song_name` varchar(30) NOT NULL COMMENT 'The Song Name',
  `song_artist` varchar(30) NOT NULL COMMENT 'The Song Artist',
  `song_album` varchar(30) NOT NULL COMMENT 'Song Album',
  `song_genre` varchar(30) NOT NULL COMMENT 'The Song Genre',
  `song_year` int(11) DEFAULT NULL COMMENT 'Song Year',
  PRIMARY KEY (`song_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `song_name`, `song_artist`, `song_album`, `song_genre`, `song_year`) VALUES
(1, '22', 'Taylor Swift', 'RED', 'Pop', NULL),
(2, 'Don\'t Stop Me Now', 'Queen', '', 'Rock', NULL),
(3, 'Whole Lotta Shakin\' Goin\' On', 'Jerry Lee Lewis', '', 'Rock', 1956),
(4, 'Tutti Fruiti', 'Little Richard', '', 'Rock', 1959),
(5, 'Love The Way You Lie', 'Eminem', '', 'Rap', NULL),
(6, 'Photograph', 'Ed Sheeran', 'X', 'Pop', 2014),
(8, 'I Didn\'t Mean To', 'Casual', 'Fear Itself', '', NULL),
(9, 'Soul Deep', 'The Box Tops', 'Dimensions', '', NULL),
(14, 'Rock Around The Clock', 'Bill Haley & His Comets', 'Greatest Hits', 'Rock', 1958),
(12, 'Blue Suede Shoes', 'Elvis Presley', 'Greatest Hits', 'Rock', 1957),
(15, 'Test Pop Song', 'Some Song Artist', 'This is an Album', 'Pop', NULL),
(16, 'Brand New Rock', 'Rock Man', 'Rock Book', 'Rock', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;