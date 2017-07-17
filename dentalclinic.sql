-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2017 at 10:43 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentalclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminreg`
--

CREATE TABLE IF NOT EXISTS `adminreg` (
  `ser` int(3) NOT NULL,
  `regdate` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminreg`
--

INSERT INTO `adminreg` (`ser`, `regdate`) VALUES
(1, '30 November,2015'),
(2, '1 December,2015'),
(34, '2 December,2015'),
(35, '3 December,2015'),
(36, '4 December,2015'),
(37, '5 December,2015'),
(38, '6 December,2015'),
(39, '7 December,2015'),
(40, '8 December,2015'),
(41, '9 December,2015'),
(42, '10 December,2015'),
(43, '11 December,2015'),
(44, '12 December,2015'),
(45, '13 December,2015'),
(46, '14 December,2015'),
(48, '15 December,2015'),
(49, '16 December,2015'),
(51, '17 December,2015'),
(52, '18 December,2015'),
(53, '19 December,2015'),
(54, '20 December,2015'),
(55, '21 December,2015'),
(56, '22 December,2015'),
(57, '23 December,2015'),
(58, '24 December,2015'),
(59, '25 December,2015'),
(60, '26 December,2015'),
(61, '27 December,2015'),
(62, '28 December,2015'),
(63, '29 December,2015'),
(65, '30 December,2015');

-- --------------------------------------------------------

--
-- Table structure for table `appointement`
--

CREATE TABLE IF NOT EXISTS `appointement` (
  `ser` tinyint(4) NOT NULL,
  `userid` tinyint(3) NOT NULL,
  `code` varchar(25) NOT NULL,
  `dentist` varchar(25) NOT NULL,
  `regdate` varchar(20) NOT NULL,
  `regtime` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `d` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointement`
--

INSERT INTO `appointement` (`ser`, `userid`, `code`, `dentist`, `regdate`, `regtime`, `status`, `d`) VALUES
(5, 30, '100-Root Canal', '2-Dileep Shivani', '30 November,2015', '2 PM', 'Confirmed', 2),
(6, 0, '103-braces', '2-Dileep Shivani', '19 December,2015', '12 PM', 'Cancelled', 2),
(8, 0, '103-braces', '2-Dileep Shivani', '21 December,2015', '1 PM', 'Not Confirmed', 2),
(9, 0, '103-braces', '2-Dileep Shivani', '1 December,2015', '3 PM', 'Not Confirmed', 2),
(16, 7, '107-Partial Denture', '5-shweta narang', '24 December,2015', '9 AM', 'Not Confirmed', 5),
(20, 7, '106-gum clean', '2-Dileep Shivani', '30 November,2015', '11 AM', 'Not Confirmed', 2),
(21, 7, '100-Root Canal', '1-Sumit Narang', '30 November,2015', '4 pm', 'Not Confirmed', 1),
(22, 7, '103-braces', '7-dentist2', '13 December,2015', '3 PM', 'Not Confirmed', 7),
(23, 7, '108-Tooth Replacement', '4-suyash', '14 December,2015', '3 PM', 'Confirmed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE IF NOT EXISTS `clinic` (
  `cid` tinyint(1) NOT NULL,
  `cname` varchar(25) NOT NULL,
  `location` varchar(60) NOT NULL,
  `openhr` varchar(6) NOT NULL,
  `closehr` varchar(6) NOT NULL,
  `rooms` tinyint(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`cid`, `cname`, `location`, `openhr`, `closehr`, `rooms`) VALUES
(1, 'Dental Clinic', 'Mysore Road, Bangalore', '9 AM', '7 PM', 30);

-- --------------------------------------------------------

--
-- Table structure for table `dentalcode`
--

CREATE TABLE IF NOT EXISTS `dentalcode` (
  `id` int(3) NOT NULL,
  `code` smallint(4) NOT NULL,
  `unitcost` varchar(7) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dentalcode`
--

INSERT INTO `dentalcode` (`id`, `code`, `unitcost`, `description`) VALUES
(1, 100, 'Rs 100', 'Root Canal'),
(2, 102, 'Rs 112', 'teeth clean'),
(3, 103, 'Rs 250', 'braces'),
(6, 106, 'Rs 222', 'gum clean'),
(7, 107, 'Rs 420', 'Partial Denture'),
(8, 108, 'Rs 500', 'Tooth Replacement'),
(9, 109, 'Rs 150', 'Laser Treatment');

-- --------------------------------------------------------

--
-- Table structure for table `dentist`
--

CREATE TABLE IF NOT EXISTS `dentist` (
  `did` smallint(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` tinyint(3) NOT NULL,
  `sex` char(1) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `dtype` varchar(20) NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dentist`
--

INSERT INTO `dentist` (`did`, `name`, `age`, `sex`, `phone`, `email`, `address`, `dtype`, `registration_date`) VALUES
(1, 'Sumit Narang', 45, 'm', 9035396702, 'sumitnarangwp@gmail.com', 'magestic,bangalore', 'Permanent', '2015-11-10 13:56:20'),
(2, 'Dileep Shivani', 33, 'f', 8971215561, 'dileep@gmail.com', 'Kanpur', 'Permanent', '2015-11-10 13:58:35'),
(4, 'suyash', 35, 'm', 9035396702, 'suyash', 'nehru place,delhi', 'Permanent', '2015-11-14 10:16:05'),
(5, 'shweta narang', 37, 'f', 8971215561, 'shweta@gmail.com', 'patna', 'Permanent', '2015-11-14 10:16:45'),
(6, 'dentist1', 30, 'm', 9082137331, 'dentist1@gmail.com', 'jaynagar', 'Permanent', '2015-11-14 12:05:54'),
(7, 'dentist2', 34, 'm', 8983433434, 'dentist2@gmail.com', 'malleswaram,bangalore', 'Trainee', '2015-11-14 12:06:55'),
(8, 'dentist3', 34, 'f', 8767697863, 'dentist3@gmail.com', 'basavangudi,bangalore', 'Permanent', '2015-11-14 12:07:39'),
(9, 'dentist4', 43, 'f', 8959565865, 'dentist4@gmail.com', 'kengeri,bangalore', 'Visiting', '2015-11-14 12:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `userid` smallint(5) NOT NULL,
  `user_level` tinyint(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` bigint(10) unsigned NOT NULL,
  `age` tinyint(3) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`userid`, `user_level`, `name`, `phone`, `age`, `address`, `email`, `password`, `registration_date`) VALUES
(1, 1, 'summy', 7777777777, 21, 'mysore road,bangalore-56059', 'sumitnarang76@gmail.com', 'sumit', '2015-11-10 09:10:48'),
(2, 0, 'dileep', 8983792929, 22, 'bangalore', 'dileep@gmail.com', 'dileep', '2015-11-10 09:28:48'),
(6, 0, 'sumit narang', 9035396702, 21, 'mysore road,bangalore-56059', 'sumitnarang100@gmail.com', 'sum', '2015-11-13 13:00:24'),
(7, 0, 'shreyans N', 8983792929, 23, 'bangalore', 'shreyans@gmail.com', 'shreyans', '2015-11-14 09:03:02'),
(8, 0, 'saurav', 8875431907, 27, 'New delhi', 'saurav@gmail.com', 'saurav', '2015-11-14 11:58:33'),
(9, 0, 'ganesh', 7689543210, 52, 'nehru place,kota', 'ganesh@gmail.com', 'ganesh', '2015-11-14 11:59:57'),
(10, 0, 'manju', 8675431907, 44, 'patna', 'manju@gmail.com', 'manju', '2015-11-14 12:00:53'),
(11, 0, 'supreeth', 8965320054, 34, 'rr nagar,bangalore', 'supreet@gmail.com', 'supreeth', '2015-11-14 12:02:03'),
(12, 0, 'amith', 7654565890, 44, 'magestic,bangalore', 'amith@gmail.com', 'amith', '2015-11-14 12:03:24'),
(13, 0, 'suraj', 9812311212, 20, 'hebbal,bangalore', 'suraj@gmail.com', 'suraj', '2015-11-14 12:04:28'),
(19, 0, 'asas', 9999999999, 45, 'gandhinagar', 'a@gmail.com', '12', '2015-11-30 13:05:01'),
(29, 0, 'ss', 9035396702, 76, 'ff', 'sumitnarang76@gmail.com', 'k', '2016-11-09 12:44:55'),
(30, 0, 'ss', 9035396702, 23, 'ss', 'sumitnarang100@gmail.com', 'd', '2016-11-09 12:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `sid` smallint(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` tinyint(3) NOT NULL,
  `sex` char(1) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`sid`, `name`, `age`, `sex`, `phone`, `email`, `address`, `registration_date`) VALUES
(1, 'suresh', 35, 'm', 8971215561, 'suresh@gmail.com', 'manipal', '2015-11-14 00:22:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminreg`
--
ALTER TABLE `adminreg`
  ADD PRIMARY KEY (`ser`);

--
-- Indexes for table `appointement`
--
ALTER TABLE `appointement`
  ADD PRIMARY KEY (`ser`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `dentalcode`
--
ALTER TABLE `dentalcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dentist`
--
ALTER TABLE `dentist`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminreg`
--
ALTER TABLE `adminreg`
  MODIFY `ser` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `appointement`
--
ALTER TABLE `appointement`
  MODIFY `ser` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `cid` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dentalcode`
--
ALTER TABLE `dentalcode`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `dentist`
--
ALTER TABLE `dentist`
  MODIFY `did` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `userid` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `sid` smallint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
