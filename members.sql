-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2017 at 08:14 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `members`
--

-- --------------------------------------------------------

--
-- Table structure for table `members_login_details`
--

CREATE TABLE `members_login_details` (
  `MembershipID` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_login_details`
--

INSERT INTO `members_login_details` (`MembershipID`, `Password`) VALUES
('100', '100'),
('reg000', '0000'),
('sec000', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE `member_details` (
  `MembershipID` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Address1` varchar(100) DEFAULT NULL,
  `Address2` varchar(100) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `Fixed` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `NIC` varchar(20) DEFAULT NULL,
  `Occupation` varchar(20) DEFAULT NULL,
  `Civil_status` varchar(10) DEFAULT NULL,
  `Admission` varchar(10) DEFAULT NULL,
  `Begin` date DEFAULT NULL,
  `End` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`MembershipID`, `Firstname`, `Lastname`, `Address1`, `Address2`, `Mobile`, `Fixed`, `Email`, `Birthday`, `NIC`, `Occupation`, `Civil_status`, `Admission`, `Begin`, `End`) VALUES
('100', 'Erantha Yasith', 'Welikala', 'No.125,Meegahawatta,Diddeniya,Padukka', 'Akbhar Hostel,Kandy', '071-0402962', '011-2859930', 'eranthawelikala@gmail.com', '1995-03-08', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `signup_requests`
--

CREATE TABLE `signup_requests` (
  `MembershipID` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Accepted` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members_login_details`
--
ALTER TABLE `members_login_details`
  ADD PRIMARY KEY (`MembershipID`);

--
-- Indexes for table `member_details`
--
ALTER TABLE `member_details`
  ADD PRIMARY KEY (`MembershipID`),
  ADD KEY `MembershipID` (`MembershipID`),
  ADD KEY `MembershipID_2` (`MembershipID`);

--
-- Indexes for table `signup_requests`
--
ALTER TABLE `signup_requests`
  ADD PRIMARY KEY (`MembershipID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
