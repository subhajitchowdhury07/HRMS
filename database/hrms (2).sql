-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration`
--

CREATE TABLE `admin_registration` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_registration`
--

INSERT INTO `admin_registration` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(24, 'subhajit chowdhury', 'subha@gmail.com', '1234', 'admin'),
(26, 'alpha', 'alpha@gmail.com', '1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `clock_in` datetime DEFAULT NULL,
  `clock_out` datetime DEFAULT NULL,
  `total_worked_hr` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `clock_in`, `clock_out`, `total_worked_hr`) VALUES
(1, 'BWU/MCA/22/096', '2024-02-07 17:53:28', '2024-02-07 17:53:30', '00:00:02'),
(2, 'BWU/MCA/22/096', '2024-02-07 17:55:06', '2024-02-07 18:00:52', '00:05:46'),
(3, 'BWU/MCA/22/096', '2024-02-07 18:00:55', '2024-02-08 05:40:29', '11:39:34'),
(4, 'BWU/MCA/22/096', '2024-02-08 05:41:55', '2024-02-08 05:41:57', '00:00:02'),
(5, 'BWU/MCA/22/096', '2024-02-08 07:43:51', '2024-02-08 07:43:53', '00:00:02'),
(6, 'BWU/MCA/22/096', '2024-02-08 07:44:09', '2024-02-08 07:44:14', '00:00:05'),
(7, 'BWU/MCA/22/096', '2024-02-08 08:16:02', '2024-02-08 08:16:13', '00:00:11'),
(8, '19', '2024-02-08 09:03:25', '2024-02-08 14:10:52', '05:07:27'),
(9, '19', '2024-02-09 05:45:10', '2024-02-09 05:45:12', '00:00:02'),
(10, '19', '2024-02-09 06:01:02', '2024-02-09 06:01:04', '00:00:02'),
(14, '19', '2024-02-09 06:24:55', '2024-02-09 06:25:53', '00:00:58'),
(19, '9', '2024-02-09 06:44:01', '2024-02-09 06:44:46', '00:00:45'),
(20, '9', '2024-02-09 06:50:10', '2024-02-09 06:54:11', '00:04:01'),
(21, 'SPCI2971', '2024-02-09 07:16:19', '2024-02-09 07:17:37', '00:01:18'),
(22, 'BWU/MCA/22/096', '2024-02-09 14:29:29', '2024-02-09 14:29:46', '00:00:17'),
(23, 'SPCI2971', '2024-02-09 14:33:40', '2024-02-09 14:34:10', '00:00:30'),
(37, '1', '2024-02-12 12:13:24', '2024-02-12 12:16:18', '00:23:23'),
(38, '1', '2024-02-12 12:13:40', '2024-02-12 12:13:49', '00:00:09'),
(55, '1', '2024-02-12 13:14:37', '2024-02-12 13:14:41', '00:00:04'),
(56, '1', '2024-02-12 13:14:49', '2024-02-12 13:15:08', '00:00:19'),
(57, '1', '2024-02-12 13:55:35', '2024-02-12 13:56:28', '00:00:53'),
(58, 'BWU/MCA/22/096', '2024-02-12 13:56:08', '2024-02-12 13:56:37', '00:00:29'),
(59, 'SPCI2971', '2024-02-13 12:14:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employeedocs`
--

CREATE TABLE `employeedocs` (
  `id` int(11) NOT NULL,
  `EmpName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AdharDoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PANCardDoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `EduDoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `RelievingDoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PaySlip1Doc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PaySlip2Doc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PaySlip3Doc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emp_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employeedocs`
--

INSERT INTO `employeedocs` (`id`, `EmpName`, `AdharDoc`, `PANCardDoc`, `EduDoc`, `RelievingDoc`, `PaySlip1Doc`, `PaySlip2Doc`, `PaySlip3Doc`, `emp_id`) VALUES
(28, '', 'uploads/Screenshot 2023-10-06 133134.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2023-12-14 171713.png', 'uploads/Screenshot 2024-01-09 192759.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', '1'),
(30, '', 'uploads/Screenshot 2023-10-06 133134.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2023-12-14 171713.png', 'uploads/Screenshot 2024-01-09 192759.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'bwe/54/98'),
(32, '', 'uploads/Screenshot 2023-10-06 133134.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2023-12-14 171713.png', 'uploads/Screenshot 2024-01-09 192759.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'SPCI2971'),
(44, '', 'uploads/Screenshot 2023-10-06 133134.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2024-01-09 192759.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'uploads/Screenshot 2023-12-14 171713.png', 'BWU/MCA/22/096'),
(52, '', 'uploads/Screenshot 2023-10-06 133134.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2024-01-09 192759.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'uploads/Screenshot 2023-12-14 171713.png', '18');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(20) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` text NOT NULL,
  `country_of_employment` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `employment_type` varchar(255) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `salary_frequency` varchar(255) DEFAULT NULL,
  `salary_start_date` date DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `reporting_to` varchar(255) DEFAULT NULL,
  `source_of_hire` varchar(255) DEFAULT NULL,
  `seating_location` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `employee_status` varchar(255) DEFAULT NULL,
  `other_email` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `date_of_exit` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `gross_salary` decimal(10,2) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `first_name`, `last_name`, `email`, `password`, `user_type`, `country_of_employment`, `start_date`, `job_title`, `employment_type`, `currency`, `salary_frequency`, `salary_start_date`, `phone_number`, `reporting_to`, `source_of_hire`, `seating_location`, `title`, `employee_status`, `other_email`, `birth_date`, `marital_status`, `address`, `tags`, `job_description`, `date_of_exit`, `gender`, `gross_salary`, `profile_pic`) VALUES
(2, '1', 'subhajit', 'chowdhury', 'subha@gmail.com', 'subha12345', 'user', '', '0000-00-00', '', '', '', '', '0000-00-00', '897225589', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '10', 'alpha', 'chowdhury', 'vzcxz@gmail.com', NULL, '', 'Kolkata', '2024-02-01', 'web designer', 'Freelancer', '$', 'Monthly', '2024-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '11', 'alpha', 'chowdhury', 'vzcxz@gmail.com', NULL, '', 'Kolkata', '2024-02-01', 'web designer', 'Freelancer', '$', 'Monthly', '2024-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '12', '', '', '', NULL, '', '#', '0000-00-00', '', 'Permanent', 'Currency', 'Frequency', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '13', '', '', '', NULL, '', '#', '0000-00-00', '', 'Permanent', 'Currency', 'Frequency', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '14', '', '', '', NULL, '', '#', '0000-00-00', '', 'Permanent', 'Currency', 'Frequency', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '15', 'alpha', 'yt', 'vzcxz@gmail.com', NULL, '', 'Kolkata', '2024-01-16', 'web designer', 'Permanent', '$', 'Annualy', '2024-01-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '16', 'alpha', 'yt', 'vzcxz@gmail.com', NULL, '', 'Kolkata', '2024-01-16', 'web designer', 'Permanent', '$', 'Annualy', '2024-01-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '18', 'subhajit', '', 'swarupc2001@gmail.com', NULL, '', 'Kolkata', '2024-01-31', '', 'Freelancer', 'Currency', 'Frequency', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2', 'alpha', 'yt', 'swarupc2001@gmail.com', NULL, '', '', '2024-01-15', '', '', '', '', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '3', 'alpha', 'yt', 'swarupc2001@gmail.com', NULL, '', '', '2024-01-15', '', '', '', '', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '4', 'alpha', 'yt', 'swarupc2001@gmail.com', NULL, '', '', '2024-01-15', '', '', '', '', '2024-01-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '5', 'pallab', 'chowdhury', 'swarupc2001@gmail.com', NULL, '', 'leave', '2024-01-15', '', '', '', '', '2024-01-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '6', 'subhaj', '', '', NULL, '', '#', '0000-00-00', '', 'Permanent', '', 'Frequency', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '7', '', '', '', NULL, '', '#', '0000-00-00', '', 'Permanent', '', 'Frequency', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '9', 'pallab', 'yt', 'chowdhurysubhajit2016@gmail.com', 'test@12345', 'user', 'Kolkata', '2024-01-16', 'web designer', 'Freelancer', '$', 'Monthly', '2024-02-02', '09837223654', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'bwe/54/98', 'pallab', 'nhajit', 'alpha2001@gmail.com', 'alphaa12345', 'user', 'Kolkata', '2024-02-19', '', 'Freelancer', '₹', 'Daily', '2024-02-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'BWU/MCA/22/096', 'subhajit', 'chowdhury', 'swarupc2001909@gmail.com', 'subha12345', 'admin', 'Kolkata', '2024-01-15', 'web designer', 'Permanent', '₹', 'Monthly', '2024-01-18', '6295323936', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a zone', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'SPCI2971', 'Arijit', 'das', 'alpha@gmail.com', 'alpha12345', 'admin', 'Kolkata', '2024-02-01', 'kkkjhg', 'Freelancer', '$', 'Annualy', '2024-02-14', '6654636545', 'durgapur', 'LinkedIn', 'Dunlop', 'adada', 'sdss', 'subha@gmail.com', '2024-02-29', 'married', '92a sn banerjee', 'sales', 'Designer', '2024-02-23', 'female', 124588.00, '../assets/img/WhatsApp-Image-2023-12-07-at-3.40.07-PM-2.jpeg'),
(22, '', 'Souvik', 'Chandra', 'souvik@gmail.com', 'souvik12345', 'user', 'Kolkata', '2024-02-02', 'HR executive', 'Permanent', 'â‚¹', 'Monthly', '2024-02-08', '54645647755', 'Dunlop2', 'LinkedIn', 'Dunlop2', 'Hr recruter', 'currents', 'subha@gmail.com', '2000-02-15', 'married', '92a sn banerjee', 'sales', 'achiving goals makeing marketing', '2023-02-08', 'male', 12458.00, '../uploads/profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `emp_docs`
--

CREATE TABLE `emp_docs` (
  `id` int(11) NOT NULL,
  `employee_ID` int(20) NOT NULL,
  `AdharDoc` varchar(255) DEFAULT NULL,
  `PANCardDoc` varchar(255) DEFAULT NULL,
  `EduDoc` varchar(255) DEFAULT NULL,
  `RelievingDoc` varchar(255) DEFAULT NULL,
  `PaySlipDoc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emp_docs`
--

INSERT INTO `emp_docs` (`id`, `employee_ID`, `AdharDoc`, `PANCardDoc`, `EduDoc`, `RelievingDoc`, `PaySlipDoc`) VALUES
(23, 19, 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-10-06 133134.png'),
(24, 20, 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-10-06 133134.png');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `event_date`) VALUES
(1, 'Team Building Event', '2024-02-10'),
(2, 'John\'s Birthday', '2024-02-15'),
(3, 'Office Holiday', '2024-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `admin_remark` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `emp_id`, `leave_type`, `from_date`, `to_date`, `description`, `admin_remark`, `status`) VALUES
(7, '10', 'casual', '2024-01-30', '2024-02-01', 'mmmmmkkmkjk', 'approved', 'Approved'),
(12, '15', '', '2024-02-02', '2024-02-05', 'aadada', 'Not applicable', 'Rejected'),
(33, '10', 'casual', '2024-02-14', '2024-02-16', 'adad', 'approved', 'Approved'),
(37, '10', 'Earned leave', '2024-02-02', '2024-02-05', 'dss', 'its oke', 'Approved'),
(38, '10', 'Sick leaves', '2024-02-16', '2024-02-07', 'dsds', 'all right', 'Approved'),
(40, '10', 'casual', '2024-02-27', '2024-02-09', 'aaa', 'thkkajnscasbbsbhabsbbsbabbabs  avdvavdv  d vadvjasvdvva  avdavhdvvad', 'Approved'),
(54, 'BWU/MCA/22/096', 'Emergency Leave', '2024-02-29', '2024-02-21', 'trying to be sick', 'no not aplicable', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `leave_history`
--

CREATE TABLE `leave_history` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_history`
--

INSERT INTO `leave_history` (`id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 'Vacation', '2022-03-01', '2022-03-05', 'Approved'),
(2, 1, 'Sick Leave', '2022-04-10', '2022-04-12', 'Pending'),
(3, 1, 'Personal Leave', '2022-05-20', '2022-05-21', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tableleaves`
--

CREATE TABLE `tableleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Description` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `remaining_leaves` int(11) NOT NULL DEFAULT 0,
  `admin_decided_leaves` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tableleaves`
--

INSERT INTO `tableleaves` (`id`, `LeaveType`, `Description`, `CreationDate`, `remaining_leaves`, `admin_decided_leaves`) VALUES
(1, 'casual', 'it is for normal leaves\r\n', '2024-02-01 05:44:04', 0, 20),
(6, 'Sick leaves', 'It is for sorir kharap', '2024-02-01 10:04:11', 0, 0),
(7, 'Earned leave', 'Earned leaves', '2024-02-01 11:13:17', 0, 0),
(8, 'Emergency Leave', 'Emergency Leave', '2024-02-08 07:37:13', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `emp_id` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `EmailId` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Av_leave` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`emp_id`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `Av_leave`, `Phonenumber`, `Status`, `RegDate`, `role`, `location`) VALUES
(2, 'subha', 'jijt', 'sadad@gmail.com', '123', 'male', '115616516', 'dt2', 'fff', '2', '6545695', 1, '2024-01-30 07:48:32', 'wwww', 'wwwe');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(255) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `Description` text NOT NULL,
  `PostingDate` date NOT NULL,
  `AdminRemark` text DEFAULT NULL,
  `registra_remarks` text NOT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `admin_status` int(11) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `num_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeclock`
--

CREATE TABLE `timeclock` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `timeclock`
--

INSERT INTO `timeclock` (`id`, `user_id`, `time_in`, `time_out`) VALUES
(1, 1, '2024-02-05 22:57:54', '2024-02-05 22:58:00'),
(2, 1, '2024-02-05 22:58:02', '2024-02-05 22:58:07'),
(3, 1, '2024-02-05 23:09:18', '2024-02-05 23:09:21'),
(4, 1, '2024-02-05 23:10:38', '2024-02-05 23:10:42'),
(5, 1, '2024-02-05 23:11:16', '2024-02-05 23:13:34'),
(6, 1, '2024-02-05 23:17:39', '2024-02-05 23:28:37'),
(7, 1, '2024-02-06 10:27:28', '2024-02-06 10:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `checked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `title`, `date_time`, `checked`) VALUES
(16, 'how are you ', '2024-01-25 00:30:25', 0),
(19, 'Adding Leave History for employer', '2024-02-02 11:54:01', 1),
(21, 'make one Standing desk', '2024-02-07 12:30:16', 0),
(30, 'ssds', '2024-02-12 17:03:26', 1),
(31, 'nothing', '2024-02-12 17:45:58', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_type` (`name`(12));

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employee_attendance` (`employee_id`);

--
-- Indexes for table `employeedocs`
--
ALTER TABLE `employeedocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EmployeeDocs_Employees` (`emp_id`) USING BTREE;

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_docs`
--
ALTER TABLE `emp_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_history`
--
ALTER TABLE `leave_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tableleaves`
--
ALTER TABLE `tableleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `timeclock`
--
ALTER TABLE `timeclock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_registration`
--
ALTER TABLE `admin_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `employeedocs`
--
ALTER TABLE `employeedocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `emp_docs`
--
ALTER TABLE `emp_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `leave_history`
--
ALTER TABLE `leave_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tableleaves`
--
ALTER TABLE `tableleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timeclock`
--
ALTER TABLE `timeclock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeedocs`
--
ALTER TABLE `employeedocs`
  ADD CONSTRAINT `fk_employeedocs` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `emp_docs`
--
ALTER TABLE `emp_docs`
  ADD CONSTRAINT `fk_employee_docs` FOREIGN KEY (`employee_ID`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD CONSTRAINT `tblleaves_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `tblemployees` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
