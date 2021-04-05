-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 08:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(3) NOT NULL,
  `event_name` varchar(30) NOT NULL,
  `event_desc` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `permission` enum('YES','No','','') NOT NULL,
  `Comm_id` int(3) DEFAULT NULL,
  `Dept_id` int(3) DEFAULT NULL,
  `comm_name` varchar(30) NOT NULL,
  `comm_type` enum('institute','department','student body') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_desc`, `start_date`, `end_date`, `permission`, `Comm_id`, `Dept_id`, `comm_name`, `comm_type`) VALUES
(1, 'VESIT_HACK', 'hackathon', '2021-04-02', '2021-04-04', 'YES', 7, 1, 'E-cell', 'institute'),
(2, 'e_praxis', '', '2021-04-07', '2021-04-21', 'YES', 5, NULL, 'VRC', 'student body'),
(3, 'MadeInVesit -HardwareEdition', 'hardware Competition', '2021-04-06', '2021-04-06', 'YES', 7, NULL, 'VRC', 'institute'),
(4, 'startup_talks', 'how to plan for startups and legal ethical steps.Speaker Prateek Gupta', '2021-04-06', '2021-04-06', 'YES', 7, NULL, 'E-cell', 'student body'),
(5, 'cricomania', 'E-cricket', '2021-04-07', '2021-04-09', 'YES', 1, 1, 'CSI', 'department'),
(6, 'placement week', 'placement procedures and aptitude class', '2021-04-18', '2021-04-24', 'YES', 2, 2, 'IEEE', 'department'),
(7, 'flutter Workshop', 'flutter training', '2021-04-11', '2021-04-11', 'YES', 3, NULL, 'ISTE', 'department'),
(8, 'Bootstrap Workshop', 'Bootstrap Framework', '2021-02-03', '2021-03-03', 'YES', 12, 2, 'CSI', 'department'),
(9, 'Code Knights', 'Problem Solving Event', '2021-03-03', '2021-03-03', 'YES', 11, 4, 'ISTE', 'institute'),
(10, 'Android Studio Workshop', 'Basics of java and android studio', '2021-03-16', '2021-03-16', 'YES', 14, 3, 'CSI', 'department'),
(13, 'ML Workshop', 'Machine Learning Algorithms', '2021-03-16', '2021-03-16', '', 13, 2, 'IEEE', 'institute'),
(14, 'PHP Workshop', 'Basics of php', '2021-04-02', '2021-03-03', 'YES', 12, 3, 'CSI', 'institute');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `Dept_id` (`Dept_id`),
  ADD KEY `Comm_id` (`Comm_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
