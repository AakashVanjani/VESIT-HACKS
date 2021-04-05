-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2021 at 03:16 PM
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
-- Database: `vesit_hacks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `council_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `council_name`, `designation`, `username`, `password`) VALUES
(1, 'Gaurav Marwal', 'sort', 'secretary', 'gaurav.marwal.admin.sort', 'vesit'),
(2, 'Sakshi Lalchandani', 'sort', 'coordinator', 'sakshi.lalchandani.sort.admin', 'vesit'),
(3, 'Deepti Khimani', 'sort', 'faculty head', 'deepti.khimani.sort.admin', 'vesit'),
(4, 'Archita Malgaonkar', 'vsc', 'secretary', 'archita.malgaonkar.vsc.admin', 'vesit'),
(5, 'Sahil Salian', 'vmc', 'secretary', 'sahil.salian.vmc.admin', 'vesit'),
(7, 'bhavika', 'sort', 'secretary', 'bhavika.admin.sort', 'vesit'),
(8, 'sakshi', '', 'secretary', 'sakshi.admin.', 'vesit'),
(9, 'sakshi', '', 'secretary', 'sakshi.admin.', 'vesit'),
(10, 'Anjali Yeole', 'vrc', 'faculty head', 'anjali.yeole.vrc.admin', 'vesit'),
(11, 'J.M. Nair', '', 'designation', 'author@principal.vesit', 'vesit'),
(12, 'nupur giri', 'cmpn', 'hod', 'author@hod.cmpn', 'vesit');

-- --------------------------------------------------------

--
-- Table structure for table `approve`
--

CREATE TABLE `approve` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `about` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approve`
--

INSERT INTO `approve` (`id`, `name`, `department`, `designation`, `image`, `about`, `username`, `password`) VALUES
(1, 'J.M. nair', '', 'principal', '', 'Principal at VESIT', 'author@principal.vesit', 'vesit'),
(2, 'nupur giri', 'cmpn', 'hod', '', 'hod at cmpn department', 'author@hod.cmpn', 'vesit');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(50) NOT NULL,
  `abbrv` varchar(10) NOT NULL,
  `com_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`com_id`, `com_name`, `abbrv`, `com_category`) VALUES
(1, 'Institution Innovation Cell', 'iic', 'department'),
(2, 'Vesit Renaissance Cell', 'vrc', 'department'),
(3, 'Vesit CodeCell', 'vcc', 'department'),
(4, 'IEEE', 'ieee', 'institution'),
(5, 'ISA', 'isa', 'institution'),
(6, 'Social Responsibility Team', 'sort', 'student'),
(7, 'Music Council', 'vmc', 'student'),
(9, 'Sports Council', 'vsc', 'student'),
(10, 'E-Cell', 'ecell', 'institution'),
(12, 'vcc', '', 'student'),
(14, 'photo', 'vpc', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `doubt` text NOT NULL,
  `asked_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone_num`, `doubt`, `asked_on`) VALUES
(1, 'sakshi', 'sakshi@gmail.com', '7894561230', 'What is die() function?', '2021-03-23 21:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbrv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `abbrv`) VALUES
(4, 'Electronics Engineering', 'etrx'),
(5, 'Instrumentation Engineering', 'instru'),
(8, 'Master of Computer Applications', 'mca'),
(9, 'Computer Engineering', 'cmpn'),
(14, 'AI & DS', 'aids');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_no` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `comm_type` enum('institute','department','student body') NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_desc`, `start_date`, `end_date`, `permission`, `Comm_id`, `Dept_id`, `comm_name`, `comm_type`, `status`) VALUES
(0, 'mental health', 'Webinar', '2021-04-14', '2021-04-14', '', 6, NULL, 'sort', 'student body', 'pending'),
(1, 'VESIT_HACK', 'hackathon', '2021-04-02', '2021-04-02', 'YES', 7, 1, 'ecell', 'institute', 'accept'),
(2, 'e_praxis', '', '2021-03-20', '2021-03-24', 'YES', 5, NULL, 'vrc', 'department', 'completed'),
(3, 'MadeInVesit -HardwareEdition', 'hardware Competition', '2021-04-06', '2021-04-06', 'YES', 2, NULL, 'vrc', 'department', 'pending'),
(4, 'startup_talks', 'how to plan for startups and legal ethical steps.Speaker Prateek Gupta', '2021-04-06', '2021-04-06', 'YES', 7, NULL, 'ecell', 'institute', 'pending'),
(5, 'cricomania', 'E-cricket', '2021-04-07', '2021-04-09', 'YES', 1, 1, 'csi', 'institute', 'pending'),
(6, 'placement week', 'placement procedures and aptitude class', '2021-04-18', '2021-04-24', 'YES', 2, 2, 'ieee', 'institute', 'pending'),
(7, 'plastic donation', 'plastic collection drive at dadar beach', '2021-04-11', '2021-04-11', 'YES', 6, NULL, 'sort', 'student body', 'pending'),
(8, 'poster making', 'competition for the FEs', '2021-03-23', '2021-03-31', 'YES', 6, 1, 'sort', 'student body', 'completed'),
(9, 'Webdev', 'Internship', '2021-06-01', '2021-06-30', '', 2, NULL, 'vrc', 'department', 'accepted'),
(10, 'Tree plantation', 'For nearby slums', '2021-05-15', '2021-05-16', '', 6, NULL, 'sort', 'student body', 'upcoming'),
(15, 'umeed', 'colab with ngo', '2021-05-12', '2021-05-21', '', 6, NULL, 'sort', 'student body', 'accepted'),
(16, 'abcd', 'sdfghjk', '2021-04-23', '2021-04-24', '', 2, NULL, 'vrc', 'department', 'rejected'),
(17, 'dfghj', 'xdghjm', '2021-04-30', '2021-04-30', '', 4, NULL, 'vrc', 'department', 'upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `prop_id` int(11) NOT NULL,
  `prop_name` varchar(100) NOT NULL,
  `prop_desc` text NOT NULL,
  `committee` varchar(10) NOT NULL,
  `tentative_dates` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`prop_id`, `prop_name`, `prop_desc`, `committee`, `tentative_dates`, `status`, `added_by`) VALUES
(3, 'blood', 'donate', '7', '2021-04-15 00:00:00', 'pending', 'person'),
(4, 'digital', 'printer', '5', '2021-04-15 00:00:00', 'rejected', 'person'),
(5, 'umeed', 'ngo collab', '6', '2021-04-15 00:00:00', 'pending', 'person'),
(6, 'octaves', 'musical collab', '7', '2021-04-15 00:00:00', 'accepted', 'secretary'),
(8, 'mental health', 'seminar', '6', '2021-04-15 00:00:00', 'upcoming', 'person'),
(9, 'webdev', 'internship', '2', '2021-04-15 00:00:00', 'completed', 'anjali yeole'),
(10, 'gbhdhcnd', 'efnefeef', '7', '2021-04-15 00:00:00', 'pending', 'person');

-- --------------------------------------------------------

--
-- Table structure for table `student_bodies`
--

CREATE TABLE `student_bodies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_bodies`
--

INSERT INTO `student_bodies` (`id`, `name`) VALUES
(1, 'Cultural Council'),
(2, 'Music Council'),
(3, 'Social Responsibility Team'),
(4, 'Sports Council'),
(5, 'Vesit Photo Circle'),
(6, 'EBSB Cell');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `password`) VALUES
(1, 'superadmin', 'vesit'),
(2, 'president', 'vesit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `dept_design` varchar(10) NOT NULL,
  `committee` varchar(50) NOT NULL,
  `design` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dept`, `dept_design`, `committee`, `design`, `status`) VALUES
(1, 'richa sharma', 'cmpn', 'faculty', 'iic', 'faculty head', 1),
(2, 'nupur giri', 'extc', 'faculty', 'iic', 'member', 1),
(3, 'gaurav marwal', 'cmpn', 'student', 'sort', 'secretary', 1),
(4, 'deepti khimani', 'instru', 'faculty', 'sort', 'faculty head', 1),
(5, 'kunal bhor', 'etrx', 'student', 'sort', 'member', 1),
(6, 'sahil salian', 'extc', 'student', 'vmc', 'secretary', 1),
(7, 'aakash', 'extc', 'student', 'vcc', 'member', 0),
(8, 'anjali', 'cmpn', 'student', 'vmc', 'member', 0),
(9, 'sakshi', 'cmpn', 'student', 'ieee', 'senior dept secretary', 0),
(11, 'bhavika', 'cmpn', 'student', 'sort', 'secretary', 1),
(12, 'jayesh', 'cmpn', 'student', 'vsc', 'member', 0),
(13, 'praveen', 'cmpn', 'student', 'vsc', 'member', 0),
(18, 'aakash', 'it', 'student', 'vsc', 'member', 0),
(19, 'praveen', 'cmpn', 'student', '', 'senior dept secretary', 0),
(20, 'sakshi', 'cmpn', 'student', '', 'secretary', 1),
(21, 'sakshi', 'cmpn', 'student', '', 'secretary', 1),
(22, 'aakash', 'cmpn', 'student', 'vrc', 'member', 0),
(23, 'dimple', 'cmpn', 'student', 'vrc', 'member', 0),
(24, 'abhay kshirsagar', 'etrx', 'faculty', '', '', 1),
(25, 'Manoj sabnis', 'it', 'faculty', '', '', 0),
(26, 'asha bharambe', 'mca', 'faculty', '', '', 0),
(27, 'shikhar', 'cmpn', 'student', 'ecell', 'member', 1),
(28, 'praveen', 'cmpn', 'student', 'sort', 'member', 0),
(30, 'amit', 'it', 'student', 'vcc', 'member', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approve`
--
ALTER TABLE `approve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_no`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `Dept_id` (`Dept_id`),
  ADD KEY `Comm_id` (`Comm_id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`prop_id`);

--
-- Indexes for table `student_bodies`
--
ALTER TABLE `student_bodies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `approve`
--
ALTER TABLE `approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_bodies`
--
ALTER TABLE `student_bodies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
