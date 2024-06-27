-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 08:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cman`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `Bank_Name` varchar(200) DEFAULT NULL,
  `Account_Number` varchar(200) DEFAULT NULL,
  `Branch` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `Bank_Name`, `Account_Number`, `Branch`) VALUES
(1, 'LIPA NA MPESA', '11111110', 'Safaricom'),
(2, 'COPARATIVE BANK', '0213289993', 'Meru'),
(3, 'NATIONAL BANK', '099887765666', 'Meru'),
(4, 'COMMERCIAL BANK', '3476374654623', 'Meru'),
(5, 'STARDAND CHARTER', '345646332', 'Meru'),
(6, 'EQUIT BANK', '21242423432', 'Meru');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity_log_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `action` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_log_id`, `username`, `date`, `action`) VALUES
(1, '', '2017-01-10 16:41:42', 'Added member 0723437369'),
(2, 'admin', '2017-01-11 10:19:34', 'Edited Member Kithinji'),
(3, 'admin', '2017-01-11 10:23:28', 'Edited Member Kithinji'),
(4, 'admin', '2017-01-11 10:26:45', 'Edited Member Kithinji'),
(5, 'admin', '2017-01-11 10:28:02', 'Edited Member Kithinji'),
(6, 'admin', '2017-01-11 10:29:31', 'Edited Member Kithinji'),
(7, 'admin', '2017-01-11 10:32:58', 'Edited Member Kithinji'),
(8, 'admin', '2017-01-11 10:33:24', 'Edited Member Kithinji'),
(9, 'admin', '2017-01-11 10:34:24', 'Added member 0725873436'),
(10, 'admin', '2017-01-11 11:13:12', 'Edited Visitor Kithinji'),
(11, 'admin', '2017-01-11 11:16:00', 'Edited Visitor Kithinji'),
(12, 'admin', '2017-01-11 19:19:32', 'Added member 0725873436'),
(13, 'admin', '2017-01-11 19:20:31', 'Added member 725873436'),
(14, '', '2017-01-12 06:05:26', 'Added member 00000000000'),
(15, '', '2017-02-15 05:54:40', 'Added member 0733997722'),
(16, 'admin', '2017-02-20 12:30:16', 'Edited member Kithinji'),
(17, 'admin', '2024-02-13 12:52:54', 'Edit system User Ali'),
(18, 'admin', '2024-02-13 12:53:12', 'Edit system User Ali'),
(19, 'admin', '2024-02-13 17:32:46', 'Added member 0712345678'),
(20, 'admin', '2024-02-26 10:01:26', 'Edited member abraham'),
(21, 'admin', '2024-02-26 10:02:42', 'Edited member Mwaniki'),
(22, 'admin', '2024-02-26 10:03:53', 'Edited member Mwaniki'),
(23, 'admin', '2024-02-26 10:05:06', 'Edited member abraham'),
(24, 'admin', '2024-02-26 10:06:06', 'Edited member Mwaniki'),
(25, 'admin', '2024-02-26 13:08:18', 'Added member 0722223333'),
(26, 'admin', '2024-03-04 11:49:40', 'Added member 0769508621'),
(27, 'admin', '2024-03-04 12:22:40', 'Added member 0700000000'),
(28, 'admin', '2024-03-04 12:27:46', 'Added member 0769508621'),
(29, 'admin', '2024-03-04 12:40:32', 'Added member 0712345678'),
(30, '', '2024-03-05 07:31:07', 'Added member 0792229940'),
(31, '', '2024-03-05 09:53:08', 'Added member 0712121212'),
(32, 'admin', '2024-03-05 15:48:26', 'Added member 0115135677'),
(33, 'admin', '2024-03-07 16:26:30', 'Added member 0793556912'),
(34, 'admin', '2024-03-13 10:32:59', 'Added member 0700000000'),
(35, '', '2024-03-22 15:17:28', 'Add System User Hassan'),
(36, '', '2024-03-27 06:47:06', 'Added member 0796499674');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `adminthumbnails` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `password`, `adminthumbnails`) VALUES
(1, 'Ali', 'Julo', 'admin', 'admin', 'uploads/20220522161154_IMG_8791.JPG'),
(3, 'Hassan', 'Mdune', 'Julo', 'admin', 'uploads/Bro Hassan 20211022_153918.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `times` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `title`, `content`, `times`) VALUES
(1, 'notice', 'ALL FEES SHOULD BE PAID THROUGH THE ACCOUNTS GIVEN. NO CASH WILL BE ACCEPTED', '2016-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `ministry` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `firstname`, `lastname`, `mobile_number`, `gender`, `ministry`, `year`, `email`, `event_title`, `event_date`) VALUES
(31, 'Ali', 'Julo', '0793556912', 'Male', '0', 'Fourth year', 'alichengo16@gmail.com', 'AFRICAN SUNDAY', '2024-03-24'),
(34, 'Ian', 'Wachira', '0718736045', 'Male', '0', 'Fourth year', 'angelmichael@gmail.com', 'AFRICAN SUNDAY', '2024-03-24'),
(35, 'Samuel', 'Afubwa', '0792229940', 'Male', '0', 'Fifth year', 'afubwasamuel@gmail.com', 'WEDNESDAY SERVICE', '2024-03-20'),
(37, 'Dorcas', 'Moraa', '0759601785', 'Female', '0', 'First year', 'maebadorcas47@gmail.com', 'WEDNESDAY SERVICE', '2024-03-20'),
(45, 'Maxwell', 'Mwereri', '0718090284', 'Male', '0', 'Fourth year', 'koomemaxwell38@gmail.com', 'WEDNESDAY SERVICE', '2024-03-20'),
(46, 'Ali', 'Julo', '0793556912', 'Male', '0', 'Fourth year', 'alichengo16@gmail.com', 'BEST P CLASS', '2024-03-21'),
(47, 'Ali', 'Julo', '0793556912', 'Male', '0', 'Fourth year', 'alichengo16@gmail.com', 'MAN ENOUGH', '2024-03-29'),
(48, 'Dorcas', 'Moraa', '0759601785', 'Female', '0', 'First year', 'maebadorcas47@gmail.com', 'BEST P CLASS', '2024-03-21'),
(51, 'Samuel', 'Afubwa', '0792229940', 'Male', '0', 'Fifth year', 'afubwasamuel@gmail.com', 'MAN ENOUGH', '2024-03-29'),
(52, 'Ali', 'Julo', '0793556912', 'Male', '0', 'Fourth year', 'alichengo16@gmail.com', 'WEDNESDAY SERVICE', '2024-03-20'),
(54, 'Ali', 'Julo', '0793556912', 'Male', '0', 'Fourth year', 'alichengo16@gmail.com', 'MOV/DOZ', '2024-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(100) NOT NULL,
  `Title` text NOT NULL,
  `Date` date NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `Title`, `Date`, `content`) VALUES
(48, 'WEDNESDAY SERVICE', '2024-03-20', 'Welcome to our mid-week service. The speaker will be Mr Evans Karanja and the topic will be \"Developing a heart for mission\". '),
(49, 'BEST P CLASS', '2024-03-21', 'Welcome to our BEST P class this Thursday from 7 to 9 pm. The venue will be at EF 02. Welcome.'),
(50, 'KUCU MEGA DEBATE', '2024-03-22', 'Welcome to our KUCU Mega debate this Friday. It will be happening at SZ 39 from 7 to 9 pm. There are two topics that will be shared later with the poster. Welcome.'),
(51, 'AFRICAN SUNDAY', '2024-03-24', 'Join us this Sunday as we praise and worship God in an African way. The service will run from 8 to 12pm and the venue will be the Amphitheatre. Welcome\r\n#African Sunday\r\n# Our culture, our heritage.'),
(52, 'WEDNESDAY SERVICE', '2024-03-27', 'Welcome to our Wednesday Service which will be at SZ 39 from 7 to 9 pm. The topic will be \" Academic Excellence\" and the speaker will be \"Dr. Nzuki\". Welcome'),
(53, 'MAN ENOUGH', '2024-03-29', 'Welcome to our MAN ENOUGH PROGRAM that will be happening this Friday from 7 to 9pm. The venue is EF 02. Welcome.'),
(54, 'BEST P CLASS', '2024-03-28', 'Welcome to our BEST P class this Thursday from 7 to 9pm at EF 02. The topic will be \"Apologetics\". Welcome.'),
(55, 'MOV/DOZ', '2024-03-29', 'Welcome to our MOV/DOZ session this Friday from 7 to 9 pm at SZ 39. Welcome');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `keyu` int(10) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `Residence` varchar(100) DEFAULT NULL,
  `Registration` varchar(100) DEFAULT NULL,
  `ministry` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `year` varchar(20) NOT NULL,
  `thumbnail` varchar(500) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id` varchar(10) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`keyu`, `fname`, `sname`, `lname`, `Gender`, `Residence`, `Registration`, `ministry`, `mobile`, `email`, `year`, `thumbnail`, `password`, `id`, `date`) VALUES
(36, 'Ali', 'Chengo', 'Julo', 'Male', 'Githurai', 'J31/3698/2020', 'Ushering', '0793556912', 'alichengo16@gmail.com', 'Fourth year', 'uploads/none.png', '123456789', '0793556912', '2024-03-18 11:21:59'),
(37, 'Dorcas', 'Maeba', 'Moraa', 'Female', 'Ruiru', 'D241/17561/2023', 'Intercessory', '0759601785', 'maebadorcas47@gmail.com', 'First year', 'uploads/none.png', '123456789', '0759601785', '2024-03-19 12:57:03'),
(38, 'Samuel', 'Taabu', 'Afubwa', 'Male', 'Kiwanja', 'C34/2827/2018', 'High School', '0792229940', 'afubwasamuel@gmail.com', 'Fifth year', 'uploads/none.png', '123456789', '0792229940', '2024-03-19 15:44:49'),
(39, 'Ian', 'Mwangi', 'Wachira', 'Male', 'KM', 'J17/3434/2020', 'CM', '0718736045', 'angelmichael@gmail.com', 'Fourth year', 'uploads/none.png', '123456789', '0718736045', '2024-03-20 06:28:38'),
(40, 'Maxwell', 'Koome', 'Mwereri', 'Male', 'Karen', 'J17/MNU/7010/2019', 'Praise and Worship', '0718090284', 'koomemaxwell38@gmail.com', 'Fourth year', 'uploads/none.png', '123456789', '0718090284', '2024-03-26 08:31:11'),
(41, 'Ali', 'Omar', 'Hassan', 'Male', 'Kilimambogo', 'J31/1234/2020', 'Sunday School', '0111690368', 'earlyjulo@gmail.com', 'Fourth year', 'uploads/none.png', '123456789', '0111690368', '2024-03-26 09:54:04'),
(42, 'Joseph', 'Munene', 'Mutinda', 'Male', 'KM', 'J261/14532/2022', 'Praise and Worship', '0746667518', 'josseblessed517@gmail.com', 'Third year', 'uploads/none.png', '123456789', '0746667518', '2024-03-26 15:56:52'),
(43, 'Rukia', 'Mbeyu', 'Said', 'Female', 'Membley', 'D32/4672/2022', 'Decoration team', '0796499674', 'rukiambeyu@gmail.com', 'Third year', 'uploads/none.png', '123456789', '0796499674', '2024-03-27 03:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `login_date` varchar(30) NOT NULL,
  `logout_date` varchar(128) NOT NULL,
  `admin_id` int(128) NOT NULL,
  `student_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`activity_log_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`keyu`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `activity_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `keyu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
