-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2017 at 07:29 AM
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
-- Table structure for table `members_contributions`
--

CREATE TABLE `members_contributions` (
  `MembershipID` varchar(50) NOT NULL,
  `Contributions` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_contributions`
--

INSERT INTO `members_contributions` (`MembershipID`, `Contributions`) VALUES
('oba1', 'You done great. Wow.'),
('oba2', ' Sponserd for school birthday function.'),
('oba3', ' rs.50000 Donation.');

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
('oba1', 'oba1'),
('reg000', '0000'),
('sec000', '1111'),
('admin000', '0000'),
('oba2', '200'),
('oba3', '111');

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
  `Admission` varchar(50) DEFAULT NULL,
  `Begin` date DEFAULT NULL,
  `End` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`MembershipID`, `Firstname`, `Lastname`, `Address1`, `Address2`, `Mobile`, `Fixed`, `Email`, `Birthday`, `NIC`, `Occupation`, `Civil_status`, `Admission`, `Begin`, `End`) VALUES
('oba1', 'Erantha Yasith', 'Welikala', 'No.125,Meegahawatta,Diddeniya,Padukka', 'Peradeniya,Kandy', '071-0402962', '011-2859930', 'eranthawelikala@gmail.com', '1995-03-08', '950680245V', 'University Student', 'Single', '19501', '2007-02-06', '2014-08-03'),
('oba2', 'Amila', 'Indika', 'Kegalle', 'Peradeniya,Kandy', '', '', '', NULL, '', 'University Student', 'Married', '19502', NULL, NULL),
('oba3', 'Nethmal', 'Warusamana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `signup_requests`
--

CREATE TABLE `signup_requests` (
  `Admission` varchar(50) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Accepted` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup_requests`
--

INSERT INTO `signup_requests` (`Admission`, `Firstname`, `Lastname`, `Password`, `Accepted`) VALUES
('19504', 'Shehan', 'Dinuka', '400', 0),
('19505', 'Roshan', 'Ragel', '500', 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp_login_details`
--

CREATE TABLE `temp_login_details` (
  `Admission` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `MembershipID` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_login_details`
--

INSERT INTO `temp_login_details` (`Admission`, `Password`, `MembershipID`) VALUES
('111', '111', 'oba3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members_contributions`
--
ALTER TABLE `members_contributions`
  ADD PRIMARY KEY (`MembershipID`);

--
-- Indexes for table `members_login_details`
--
ALTER TABLE `members_login_details`
  ADD PRIMARY KEY (`MembershipID`),
  ADD UNIQUE KEY `MembershipID` (`MembershipID`),
  ADD UNIQUE KEY `MembershipID_2` (`MembershipID`);

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
  ADD PRIMARY KEY (`Admission`);

--
-- Indexes for table `temp_login_details`
--
ALTER TABLE `temp_login_details`
  ADD PRIMARY KEY (`Admission`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
