-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2024 at 10:08 AM
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
-- Database: `u431054670_hrms`
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
-- Table structure for table `allotted_leave`
--

CREATE TABLE `allotted_leave` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `First_name` varchar(255) DEFAULT NULL,
  `starting_balance` decimal(10,2) DEFAULT NULL,
  `allowed_day` enum('full','half') DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `employeeID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allotted_leave`
--

INSERT INTO `allotted_leave` (`id`, `employee_id`, `First_name`, `starting_balance`, `allowed_day`, `leave_type_id`, `created_date`, `employeeID`) VALUES
(13, 22, 'Souvik', 3.00, 'full', 1, '2024-03-04 05:18:14', 'BWU/MCA/22/101'),
(14, 22, 'Souvik', 2.00, 'full', 2, '2024-03-04 05:18:14', 'BWU/MCA/22/101'),
(23, 24, 'Diptangshu', 0.00, 'full', 1, '2024-03-08 12:15:49', 'DIP/ADMIN/976'),
(24, 24, 'Diptangshu', 0.00, 'full', 2, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(25, 24, 'Diptangshu', 0.00, 'full', 3, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(26, 24, 'Diptangshu', 3.00, 'full', 4, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(27, 24, 'Diptangshu', 52.00, 'full', 5, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(28, 24, 'Diptangshu', 0.00, 'full', 6, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(29, 24, 'Diptangshu', 4.00, 'full', 7, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(30, 24, 'Diptangshu', 0.00, 'full', 8, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(31, 24, 'Diptangshu', 9.00, 'full', 9, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(32, 24, 'Diptangshu', 3.00, 'full', 10, '2024-03-08 12:15:50', 'DIP/ADMIN/976'),
(33, 31, 'Jayanta', 3.00, 'full', 1, '2024-03-08 12:17:30', 'SPLC1003'),
(34, 31, 'Jayanta', 0.00, 'full', 2, '2024-03-08 12:17:30', 'SPLC1003'),
(35, 31, 'Jayanta', 0.00, 'full', 3, '2024-03-08 12:17:30', 'SPLC1003'),
(36, 31, 'Jayanta', 3.00, 'full', 4, '2024-03-08 12:17:30', 'SPLC1003'),
(37, 31, 'Jayanta', 55.00, 'full', 5, '2024-03-08 12:17:30', 'SPLC1003'),
(38, 31, 'Jayanta', 0.00, 'full', 6, '2024-03-08 12:17:30', 'SPLC1003'),
(39, 31, 'Jayanta', 5.00, 'full', 7, '2024-03-08 12:17:30', 'SPLC1003'),
(40, 31, 'Jayanta', 0.00, 'full', 8, '2024-03-08 12:17:30', 'SPLC1003'),
(41, 31, 'Jayanta', 9.00, 'full', 9, '2024-03-08 12:17:30', 'SPLC1003'),
(42, 31, 'Jayanta', 0.00, 'full', 10, '2024-03-08 12:17:30', 'SPLC1003'),
(43, 29, 'Arijit', 3.00, 'full', 1, '2024-03-08 12:20:18', 'SPLF1006'),
(44, 29, 'Arijit', 0.00, 'full', 2, '2024-03-08 12:20:18', 'SPLF1006'),
(45, 29, 'Arijit', 0.00, 'full', 3, '2024-03-08 12:20:18', 'SPLF1006'),
(46, 29, 'Arijit', 3.00, 'full', 4, '2024-03-08 12:20:18', 'SPLF1006'),
(47, 29, 'Arijit', 25.50, 'full', 5, '2024-03-08 12:20:18', 'SPLF1006'),
(48, 29, 'Arijit', 0.00, 'full', 6, '2024-03-08 12:20:18', 'SPLF1006'),
(49, 29, 'Arijit', 5.00, 'full', 7, '2024-03-08 12:20:18', 'SPLF1006'),
(50, 29, 'Arijit', 0.00, 'full', 8, '2024-03-08 12:20:18', 'SPLF1006'),
(51, 29, 'Arijit', 9.00, 'full', 9, '2024-03-08 12:20:18', 'SPLF1006'),
(52, 29, 'Arijit', 3.00, 'full', 10, '2024-03-08 12:20:18', 'SPLF1006'),
(53, 32, 'Raju', 3.00, 'full', 1, '2024-03-08 12:21:47', 'SPLF1010'),
(54, 32, 'Raju', 0.00, 'full', 2, '2024-03-08 12:21:47', 'SPLF1010'),
(55, 32, 'Raju', 0.00, 'full', 3, '2024-03-08 12:21:47', 'SPLF1010'),
(56, 32, 'Raju', 3.00, 'full', 4, '2024-03-08 12:21:47', 'SPLF1010'),
(57, 32, 'Raju', 21.00, 'full', 5, '2024-03-08 12:21:47', 'SPLF1010'),
(58, 32, 'Raju', 0.00, 'full', 6, '2024-03-08 12:21:47', 'SPLF1010'),
(59, 32, 'Raju', 5.00, 'full', 7, '2024-03-08 12:21:47', 'SPLF1010'),
(60, 32, 'Raju', 0.00, 'full', 8, '2024-03-08 12:21:47', 'SPLF1010'),
(61, 32, 'Raju', 9.00, 'full', 9, '2024-03-08 12:21:47', 'SPLF1010'),
(62, 32, 'Raju', 0.00, 'full', 10, '2024-03-08 12:21:47', 'SPLF1010');

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
(59, 'SPCI2971', '2024-02-13 12:14:02', '2024-02-20 18:20:35', '174:06:33'),
(60, 'BWU/MCA/22/101', '2024-02-07 17:53:28', '2024-02-07 17:53:30', '00:00:02'),
(61, '', '2024-02-19 13:03:01', '2024-02-19 13:03:05', '00:00:04'),
(62, 'BWU/MCA/22/101', '2024-02-20 05:09:08', '2024-02-20 06:17:21', '01:08:13'),
(63, '', '2024-02-20 05:50:32', '2024-03-07 15:43:45', '393:53:13'),
(64, 'BWU/MCA/22/101', '2024-02-20 09:27:38', '2024-02-20 09:27:40', '00:00:02'),
(65, 'BWU/MCA/22/101', '2024-02-20 09:34:24', '2024-02-20 09:35:18', '00:00:54'),
(66, 'BWU/MCA/22/101', '2024-02-20 09:43:21', '2024-02-20 09:44:33', '00:01:12'),
(67, 'BWU/MCA/22/101', '2024-02-20 15:21:12', '2024-02-20 15:21:16', '00:00:04'),
(68, 'BWU/MCA/22/101', '2024-02-20 15:39:46', '2024-02-20 15:39:58', '00:00:12'),
(69, 'BWU/MCA/22/101', '2024-02-20 15:40:55', '2024-02-20 16:23:10', '00:42:15'),
(70, 'BWU/MCA/22/101', '2024-02-20 16:23:12', '2024-02-20 16:23:22', '00:00:10'),
(71, 'BWU/MCA/22/101', '2024-02-20 16:28:31', '2024-02-20 16:28:35', '00:00:04'),
(72, 'BWU/MCA/22/101', '2024-02-20 16:30:19', '2024-02-20 16:30:21', '00:00:02'),
(73, 'BWU/MCA/22/101', '2024-02-20 16:33:47', '2024-02-20 16:33:52', '00:00:05'),
(74, 'BWU/MCA/22/101', '2024-02-20 16:35:04', '2024-02-20 16:35:05', '00:00:01'),
(75, 'BWU/MCA/22/101', '2024-02-20 16:37:18', '2024-02-20 16:37:24', '00:00:06'),
(76, 'BWU/MCA/22/101', '2024-02-20 16:41:52', '2024-02-20 16:41:59', '00:00:07'),
(77, 'BWU/MCA/22/101', '2024-02-20 16:42:27', '2024-02-20 16:45:04', '00:02:37'),
(78, 'BWU/MCA/22/101', '2024-02-20 16:45:12', '2024-02-20 16:52:34', '00:07:22'),
(79, 'BWU/MCA/22/101', '2024-02-20 16:53:28', '2024-02-20 16:53:41', '00:00:13'),
(80, 'BWU/MCA/22/101', '2024-02-20 16:55:35', '2024-02-20 16:55:40', '00:00:05'),
(81, 'BWU/MCA/22/101', '2024-02-20 16:57:00', '2024-02-20 16:57:25', '00:00:25'),
(82, 'BWU/MCA/22/101', '2024-02-20 17:02:08', '2024-02-20 17:02:21', '00:00:13'),
(83, 'BWU/MCA/22/101', '2024-02-20 17:03:54', '2024-02-20 17:03:58', '00:00:04'),
(84, 'BWU/MCA/22/101', '2024-02-20 17:04:03', '2024-02-20 17:04:30', '00:00:27'),
(85, 'BWU/MCA/22/101', '2024-02-20 17:04:33', '2024-02-20 17:07:18', '00:02:45'),
(86, 'BWU/MCA/22/101', '2024-02-20 17:07:21', '2024-02-20 17:07:49', '00:00:28'),
(87, 'BWU/MCA/22/101', '2024-02-20 17:07:51', '2024-02-20 17:14:42', '00:06:51'),
(88, 'BWU/MCA/22/101', '2024-02-20 17:17:13', '2024-02-20 17:17:20', '00:00:07'),
(89, 'BWU/MCA/22/101', '2024-02-20 17:17:35', '2024-02-20 17:19:20', '00:01:45'),
(90, 'BWU/MCA/22/101', '2024-02-20 17:19:24', '2024-02-20 17:19:57', '00:00:33'),
(91, 'SPCI2971', '2024-02-20 18:21:23', '2024-02-20 18:21:36', '00:00:13'),
(92, 'SPCI2971', '2024-02-21 13:28:00', '2024-02-21 19:52:02', '06:24:02'),
(93, 'SPCI2971', '2024-02-22 15:20:21', '2024-02-22 15:25:07', '00:04:46'),
(94, 'SPCI2971', '2024-02-22 17:11:07', '2024-02-22 17:58:05', '00:46:58'),
(95, 'SPCI2971', '2024-02-23 10:40:43', '2024-02-25 13:15:04', '50:34:21'),
(96, 'BWU/MCA/22/101', '2024-02-25 13:10:20', '2024-02-25 13:12:45', '00:02:25'),
(97, 'SPCI2971', '2024-02-27 11:33:53', '2024-02-27 11:35:11', '00:01:18'),
(98, 'BWU/MCA/22/101', '2024-02-27 17:49:04', '2024-02-27 17:49:16', '00:00:12'),
(99, 'BWU/MCA/22/101', '2024-02-27 13:39:51', '2024-02-27 13:45:17', '00:05:26'),
(100, 'SPCI2971', '2024-02-27 19:22:16', '2024-02-27 19:22:28', '00:00:12'),
(101, 'SPCI2971', '2024-02-28 00:52:51', '2024-02-28 00:55:42', '00:02:51'),
(102, 'BWU/MCA/22/101', '2024-02-28 11:15:14', '2024-03-05 19:55:53', '152:40:39'),
(103, 'SPCI2971', '2024-03-06 11:12:43', '2024-03-06 11:13:12', '00:00:29'),
(104, 'SPCI2971', '2024-03-06 14:33:18', '2024-03-06 14:33:33', '00:00:15'),
(105, 'SPCI2971', '2024-03-06 14:33:37', '2024-03-06 14:33:40', '00:00:03'),
(106, 'BWU/MCA/22/101', '2024-03-06 10:37:41', '2024-03-06 10:37:44', '00:00:03'),
(107, 'BWU/MCA/22/101', '2024-03-07 10:44:38', '2024-03-07 11:46:46', '01:02:08'),
(108, 'BWU/MCA/22/101', '2024-03-07 06:45:18', '2024-03-07 06:47:50', '00:02:32'),
(109, 'BWU/MCA/22/101', '2024-03-07 07:01:47', '2024-03-07 07:03:20', '00:01:33'),
(110, 'BWU/MCA/22/101', '2024-03-07 07:19:55', '2024-03-07 07:19:59', '00:00:04'),
(111, 'SPCI2971', '2024-03-07 13:07:59', '2024-03-07 13:08:01', '00:00:02'),
(112, 'SPCI2971', '2024-03-07 13:09:01', '2024-03-07 13:09:03', '00:00:02'),
(113, 'SPCI2971', '2024-03-07 13:09:17', '2024-03-07 13:09:19', '00:00:02'),
(114, 'SPCI2971', '2024-03-07 13:10:35', '2024-03-07 13:11:10', '00:00:35'),
(115, 'SPCI2971', '2024-03-07 13:11:15', '2024-03-07 13:11:37', '00:00:22'),
(116, 'SPCI2971', '2024-03-07 13:12:03', '2024-03-07 13:12:17', '00:00:14'),
(117, 'SPCI2971', '2024-03-07 13:52:29', '2024-03-07 13:52:35', '00:00:06'),
(118, 'SPCI2971', '2024-03-07 13:52:44', '2024-03-07 13:52:46', '00:00:02'),
(119, 'SPCI2971', '2024-03-07 14:04:35', '2024-03-07 14:04:37', '00:00:02'),
(120, 'SPCI2971', '2024-03-07 08:43:50', '2024-03-07 08:43:54', '00:00:04'),
(121, 'SPCI2971', '2024-03-07 08:43:55', '2024-03-07 08:44:16', '00:00:21'),
(122, 'SPCI2971', '2024-03-07 09:41:17', '2024-03-07 09:41:52', '00:00:35'),
(123, 'SPCI2971', '2024-03-07 09:50:52', '2024-03-07 09:53:29', '00:02:37'),
(124, 'SPCI2971', '2024-03-07 15:40:45', '2024-03-07 15:40:59', '00:00:14'),
(125, 'BWU/MCA/22/101', '2024-03-07 15:44:12', '2024-03-07 15:44:25', '00:00:13'),
(126, '', '2024-03-07 15:44:17', '2024-03-07 15:44:18', '00:00:01'),
(127, '', '2024-03-07 10:21:16', '2024-03-07 10:21:17', '00:00:01'),
(128, 'SPCI2971', '2024-03-07 10:21:33', '2024-03-07 10:21:35', '00:00:02'),
(129, 'SPCI2971', '2024-03-07 15:54:09', '2024-03-07 15:54:13', '00:00:04'),
(130, 'BWU/MCA/22/101', '2024-03-07 15:56:02', '2024-03-07 15:56:04', '00:00:02'),
(131, 'DIP/ADMIN/976', '2024-03-07 10:58:25', '2024-03-07 16:28:40', '05:30:15'),
(132, 'DIP/ADMIN/976', '2024-03-07 16:29:39', '2024-03-07 16:29:43', '00:00:04'),
(133, 'BWU/MCA/22/101', '2024-03-07 16:31:44', '2024-03-07 16:31:58', '00:00:14'),
(134, 'BWU/MCA/22/101', '2024-03-07 16:40:04', '2024-03-07 16:40:12', '00:00:08'),
(135, 'BWU/MCA/22/101', '2024-03-07 17:03:05', '2024-03-07 17:03:12', '00:00:07'),
(136, 'SPCI2971', '2024-03-07 17:05:56', '2024-03-07 17:05:59', '00:00:03'),
(137, 'SPCI2971', '2024-03-07 17:06:25', '2024-03-07 17:06:28', '00:00:03'),
(138, 'BWU/MCA/22/101', '2024-03-07 17:07:33', '2024-03-07 17:07:34', '00:00:01'),
(139, 'BWU/MCA/22/101', '2024-03-07 17:07:44', '2024-03-07 17:08:20', '00:00:36'),
(140, 'SPCI2971', '2024-03-07 17:08:41', '2024-03-07 17:08:44', '00:00:03'),
(141, 'SPCI2971', '2024-03-07 17:09:46', '2024-03-07 17:09:49', '00:00:03'),
(142, 'SPCI2971', '2024-03-07 11:44:32', '2024-03-07 11:44:37', '00:00:05'),
(143, 'SPCI2971', '2024-03-07 11:44:59', '2024-03-07 17:20:18', '05:35:19'),
(144, 'BWU/MCA/22/101', '2024-03-07 11:45:27', '2024-03-07 17:15:33', '05:30:06'),
(145, 'BWU/MCA/22/101', '2024-03-07 11:45:58', '2024-03-07 17:16:14', '05:30:16'),
(146, 'BWU/MCA/22/101', '2024-03-07 11:46:43', '2024-03-07 17:17:09', '05:30:26'),
(147, 'BWU/MCA/22/101', '2024-03-07 17:18:51', '2024-03-07 17:19:08', '00:00:17'),
(148, 'BWU/MCA/22/101', '2024-03-07 18:18:59', '2024-03-07 18:19:05', '00:00:06'),
(149, 'SPCI2971', '2024-03-08 12:05:18', '2024-03-08 12:05:20', '00:00:02'),
(150, 'SPLF1006', '2024-03-08 12:09:39', '2024-03-11 10:49:07', '70:39:28'),
(151, 'SPLC1003', '2024-03-08 13:56:07', '2024-03-08 21:30:58', '07:34:51'),
(152, 'SPCI2971', '2024-03-08 16:42:35', '2024-03-08 16:42:41', '00:00:06'),
(153, 'BWU/MCA/22/101', '2024-03-08 16:44:37', '2024-03-09 10:39:49', '17:55:12'),
(154, 'DIP/ADMIN/976', '2024-03-11 11:09:05', '2024-03-13 10:40:23', '47:31:18'),
(155, 'SPCI2971', '2024-03-11 11:09:15', '2024-03-11 21:37:08', '10:27:53'),
(156, 'SPLC1003', '2024-03-11 13:00:28', '2024-03-12 15:03:22', '26:02:54'),
(157, 'SPCI2971', '2024-03-12 11:55:57', '2024-03-12 11:55:59', '00:00:02'),
(158, 'BWU/MCA/22/101', '2024-03-12 12:45:17', '2024-03-12 12:54:24', '00:09:07'),
(159, 'SPLC1003', '2024-03-12 15:03:26', '2024-03-22 10:05:41', '235:02:15'),
(160, 'SPLF1006', '2024-03-12 16:50:18', '2024-03-14 14:20:49', '45:30:31'),
(161, 'SPCI2971', '2024-03-26 10:30:45', '2024-03-26 10:30:48', '00:00:03'),
(162, 'SPCI2971', '2024-03-26 10:40:30', '2024-03-26 10:40:43', '00:00:13'),
(163, 'SPCI2971', '2024-03-26 10:41:57', '2024-03-26 10:42:09', '00:00:12'),
(164, 'SPCI2971', '2024-03-26 10:44:07', '2024-03-26 10:44:10', '00:00:03'),
(165, 'SPCI2971', '2024-03-26 10:44:28', '2024-03-26 10:44:35', '00:00:07'),
(166, 'SPCI2971', '2024-03-26 10:47:37', '2024-03-26 10:47:41', '00:00:04'),
(167, 'SPCI2971', '2024-03-26 10:48:24', '2024-03-26 10:48:34', '00:00:10'),
(168, 'SPCI2971', '2024-03-26 10:49:59', '2024-03-26 10:50:03', '00:00:04'),
(169, 'SPCI2971', '2024-03-26 10:53:16', '2024-03-26 10:53:42', '00:00:26'),
(170, 'SPCI2971', '2024-03-26 10:55:15', '2024-03-26 10:55:32', '00:00:17'),
(171, 'SPCI2971', '2024-03-26 10:57:08', '2024-03-26 10:57:12', '00:00:04'),
(172, 'SPCI2971', '2024-03-26 11:06:43', '2024-03-26 11:06:45', '00:00:02'),
(173, 'SPCI2971', '2024-03-26 11:08:44', '2024-03-26 11:08:55', '00:00:11'),
(174, 'SPCI2971', '2024-03-26 11:09:36', '2024-03-26 11:09:38', '00:00:02'),
(175, 'SPCI2971', '2024-03-26 11:11:13', '2024-03-26 11:11:17', '00:00:04'),
(176, 'SPCI2971', '2024-03-26 11:18:52', '2024-03-26 11:19:07', '00:00:15'),
(177, 'SPCI2971', '2024-03-26 11:21:06', '2024-03-26 11:21:09', '00:00:03'),
(178, 'SPCI2971', '2024-03-26 11:22:22', '2024-03-26 11:22:26', '00:00:04'),
(179, 'SPCI2971', '2024-03-26 11:23:07', '2024-03-26 11:23:12', '00:00:05'),
(180, 'SPCI2971', '2024-03-26 11:27:55', '2024-03-26 11:27:59', '00:00:04'),
(181, 'SPCI2971', '2024-03-26 11:28:10', '2024-03-26 11:28:12', '00:00:02'),
(182, 'SPCI2971', '2024-03-26 11:28:54', '2024-03-26 11:28:56', '00:00:02'),
(183, 'SPCI2971', '2024-03-26 11:29:04', '2024-03-26 11:31:33', '00:02:29'),
(184, 'SPCI2971', '2024-03-26 11:31:36', '2024-03-26 11:31:40', '00:00:04'),
(185, 'SPCI2971', '2024-03-26 11:33:15', '2024-03-26 11:33:19', '00:00:04'),
(186, 'SPCI2971', '2024-03-26 11:35:34', '2024-03-26 11:35:37', '00:00:03'),
(187, 'SPCI2971', '2024-03-26 11:39:03', '2024-03-26 11:39:11', '00:00:08'),
(188, 'SPCI2971', '2024-03-26 11:39:19', '2024-03-26 11:39:25', '00:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `dummy_table`
--

CREATE TABLE `dummy_table` (
  `id` int(11) NOT NULL,
  `array_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dummy_table`
--

INSERT INTO `dummy_table` (`id`, `array_data`) VALUES
(1, '[1, 2, 3, 4, 5]'),
(2, '[\"apple\", \"banana\", \"orange\"]'),
(3, '{\"name\": \"John\", \"age\": 30, \"city\": \"New York\"}');

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
  `department` varchar(122) DEFAULT NULL,
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
  `profile_pic` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `first_name`, `last_name`, `email`, `password`, `department`, `user_type`, `country_of_employment`, `start_date`, `job_title`, `employment_type`, `currency`, `salary_frequency`, `salary_start_date`, `phone_number`, `reporting_to`, `source_of_hire`, `seating_location`, `title`, `employee_status`, `other_email`, `birth_date`, `marital_status`, `address`, `tags`, `job_description`, `date_of_exit`, `gender`, `gross_salary`, `profile_pic`, `manager_id`) VALUES
(2, '1', 'Pradipta', 'Paul', 'ppaul@gmail.com', 'Ppaul@12345', 'N/A', 'director', '', '0000-00-00', '', '', '', '', '0000-00-00', '897225589', 'N/A', NULL, NULL, 'Director', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/WhatsApp-Image-2023-12-07-at-4.01.02-PM-e1702031796336.jpeg', NULL),
(20, 'SPCI2971', 'Subhajit', 'Chowdhury ', 'admin@gmail.com', 'admin12345', 'Development', 'admin', 'Kolkata', '2024-02-29', 'kkkjhg', 'Freelancer', '$', 'Annualy', '2024-02-14', '6295323936', 'Mr. Jayanta', 'LinkedIn', 'Dunlop', 'Tester (Admin)', 'sdss', 'subha@gmail.com', '2024-02-29', 'married', '92a sn banerjee', 'sales', 'Designer', '2024-02-23', 'female', 124588.00, 'uploads/View this Snap from Saetenation on Snapchat!.jpeg', NULL),
(22, 'BWU/MCA/22/101', 'Souvik', 'Chandra', 'user@gmail.com', 'user12345', 'Recruiter and Management', 'user', 'Kolkata', '2024-02-27', 'HR executive', 'Permanent', 'â‚¹', 'Monthly', '2024-02-08', '54645647755', 'Mr. jayanta', 'LinkedIn', 'Dunlop2', 'Tester (user)', 'currents', 'subha@gmail.com', '2000-02-15', 'married', '92a sn banerjee', 'sales', 'achiving goals makeing marketing', '2023-02-08', 'male', 12458.00, 'uploads/pic.jpg', 20),
(24, 'DIP/ADMIN/976', 'Diptangshu', 'Goswami', 'dgoswami@seduloustechnologies.com', 'dip12345', 'Accounts &amp; Admin\n', 'admin', 'Kolkata', '2019-01-08', '', 'Permanent', '₹', 'Monthly', '2020-01-09', '9038643250', 'Arijit Das Dey', 'Recomendation', 'D2', 'Back Office Executive - Admin &amp; Accounts', 'Active', 'dgoswami2017@gmail.com', '1995-09-06', 'Unmarried', 'C11/3,GOSWAMIPARA,SHAKTIPUR,AGARPARA,NORTH 24 PARGANAS', 'N/A', 'N/A', '0000-00-00', 'male', 99999999.99, 'uploads/WhatsApp Image 2024-01-28 at 23.44.21 (2).jpeg', 29),
(29, 'SPLF1006', 'Arijit', 'Das De', 'arijit.das@seduloustechnologies.com', 'Arijit@12345', 'Accounts &amp; Admin', 'manager', 'Kolkata', '2022-06-06', 'Manager - HR , Admin &amp; Accounts', 'Permanent', 'Currency', 'Frequency', '0000-00-00', '9830347439', 'Pradipta Sankar Paul', 'Recomendation', 'D2', 'Manager - HR , Admin &amp; Accounts', 'Active', 'add092021@gmail.com', '1987-09-18', 'Unmarried', 'DASNAGAR KALITALA,BALTIKURI,HOWRAH', 'N/A', 'N/A', '0000-00-00', 'male', 0.00, NULL, 24),
(31, 'SPLC1003', 'Jayanta', 'Chakraborty', 'jchakraborty@seduloustechnologies.com', 'Jayanta@12345', 'Recruiter and Management', 'manager', 'Kolkata', '0000-00-00', 'Manager - Recruitment &amp; Digital Platforms', 'Permanent', 'Currency', 'Frequency', '0000-00-00', '7003675811', 'Pradipta Sankar Paul', 'Recomendation', 'D2', 'Manager - Recruitment &amp; Digital Platforms', 'Active', 'chakrabortyjayanto@gmail.com', '1991-08-20', 'Married', 'BC 79, Krishnapur, Anurag Apartment, Anurag Apartment Anurag Apartment,KOLKATA -700101', 'N/A', 'N/A', '0000-00-00', 'male', 0.00, 'uploads/WhatsApp Image 2024-03-12 at 15.04.54_069f47d1.jpg', 24),
(32, 'SPLF1010', 'Raju', 'Das', 'raju.das@seduloustechnologies.com', 'Raju@das12345', 'Accounts &amp; Admin', 'user', 'Kolkata', '0000-00-00', 'Back Office Executive - Admin &amp; Accounts', 'Permanent', 'Currency', 'Frequency', '0000-00-00', '7439012206', 'Arijit Das Dey', 'Recomendation', 'D2', 'Back Office Executive - Admin &amp; Accounts', 'Active', 'rajudas36360@gmail.com', '1975-07-24', 'Married', 'S/O Santos Das,R.K.P Deb Road,Panihati(M),N24Pgs,WB', 'N/A', 'N/A', '0000-00-00', 'male', 0.00, NULL, 24);

-- --------------------------------------------------------

--
-- Table structure for table `employee_meta`
--

CREATE TABLE `employee_meta` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `meta_field` varchar(100) NOT NULL,
  `meta_value` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_meta`
--

INSERT INTO `employee_meta` (`id`, `employee_id`, `meta_field`, `meta_value`, `date_created`) VALUES
(5, 22, 'allocated_leave_1', '9', '2024-02-27 10:12:40'),
(6, 22, 'allocated_leave_2', '12', '2024-02-27 10:12:40'),
(7, 22, 'allocated_leave_1', '8', '2024-02-28 05:12:45'),
(8, 22, 'allocated_leave_2', '1', '2024-02-28 05:12:45'),
(9, 24, 'allocated_leave_1', '6', '2024-02-28 05:15:26'),
(10, 24, 'allocated_leave_2', '7', '2024-02-28 05:15:26');

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
(24, 20, 'uploads/Screenshot 2023-12-14 171118.png', 'uploads/Screenshot 2024-02-05 113657.png', 'uploads/Screenshot 2024-02-05 115048.png', 'uploads/Screenshot 2023-10-21 190250.png', 'uploads/Screenshot 2023-10-06 133134.png'),
(25, 22, 'uploads/IMG-20230326-WA0043.jpg', 'uploads/IMG-20230326-WA0042.jpg', 'uploads/IMG-20230326-WA0009.jpg', 'uploads/IMG_20240215_002438.jpg', 'uploads/recep-tiryaki-1vC4ZwkJNdA-unsplash.jpg');

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
  `leave_id` int(11) DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `admin_remark` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `manager_id` int(11) DEFAULT NULL,
  `allowed_day` enum('half','full') NOT NULL,
  `available_balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `emp_id`, `leave_type`, `leave_id`, `from_date`, `to_date`, `description`, `admin_remark`, `status`, `manager_id`, `allowed_day`, `available_balance`) VALUES
(60, 'BWU/MCA/22/101', 'sick Leave', 2, '2024-03-28', '2024-03-28', 'hcngfhjg', '', 'Rejected', NULL, 'full', 4.00),
(61, 'DIP/ADMIN/976', 'Reserved Holiday(Dunlop)', 7, '2024-03-25', '2024-03-25', 'Happy Holi', '', 'Approved', 29, 'full', 4.00),
(62, 'BWU/MCA/22/101', 'Absent', 2, '2024-03-14', '2024-03-15', 'testing', '', 'Approved', 20, 'full', 2.00),
(63, 'SPLF1006', 'EL', 5, '2024-03-14', '2024-03-14', 'Request for Half Day Leave on 14th March\'24', 'Approved', 'Approved', 24, 'half', 25.50),
(64, 'SPLF1006', 'Reserved Holiday(Dunlop)', 7, '2024-03-25', '2024-03-25', 'Requesting to approve Reserve holiday on 25.03.24', NULL, 'Pending', 24, 'full', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `max_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `department`, `client_name`, `added_by`, `created_at`) VALUES
(1, 'Non-bilable project ', 'Recruiter and Management', 'EFS', 20, '2024-03-19 08:10:28');

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
-- Table structure for table `setleave`
--

CREATE TABLE `setleave` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `allowed_day` enum('full','half') NOT NULL,
  `type` enum('paid','unpaid') NOT NULL,
  `leave_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `setleave`
--

INSERT INTO `setleave` (`id`, `leave_type`, `allowed_day`, `type`, `leave_description`) VALUES
(1, 'Paternity', 'full', 'paid', ''),
(2, 'Absent', 'full', 'unpaid', ''),
(3, 'Compensatory off', 'full', 'paid', ''),
(4, 'Demise of Relative \n(Father , Mother , Spouse , So', 'full', 'paid', ''),
(5, 'EL', 'full', 'paid', ''),
(6, 'Maternity Leave', 'full', 'paid', ''),
(7, 'Reserved Holiday(Dunlop)', 'full', 'paid', ''),
(8, 'Serving Notice', 'full', 'unpaid', ''),
(9, 'Sick Leave', 'full', 'paid', ''),
(10, 'Wedding Leave', 'full', 'paid', '');

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_description` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_assigned` date NOT NULL,
  `assigned_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `employee_id`, `task_description`, `status`, `date_assigned`, `assigned_by`) VALUES
(1, 24, 'If you found task section working ok condition make sure to mark as a complete', 'Pending', '2024-03-08', 0),
(3, 22, 'Trying to test add task section', 'Completed', '2024-03-11', 0),
(4, 22, 'Submit the details ', 'Pending', '2024-03-20', 0);

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
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL,
  `hours_worked` decimal(5,2) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`id`, `user_id`, `project_id`, `task`, `hours_worked`, `start_time`, `end_time`) VALUES
(1, 22, 1, 'Fix some css and chnages', 0.04, '2024-03-25 12:40:52', '2024-03-25 12:43:11'),
(2, 22, 1, 'test 1', 0.00, '2024-03-26 10:16:02', '2024-03-26 10:16:07'),
(3, 22, NULL, NULL, 0.16, '2024-03-26 11:14:17', '2024-03-26 11:24:10'),
(4, 22, 1, 'not ', 0.00, '2024-03-26 11:24:45', '2024-03-26 11:24:57');

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
(19, 'Adding Leave History for employer', '2024-02-02 11:54:01', 1),
(32, 'make Leave Hierarchy', '2024-02-23 05:14:44', 0),
(33, 'Need to do some small changes', '2024-02-25 07:42:06', 0),
(35, 'Add one leave report page', '2024-03-08 11:25:48', 1),
(36, 'Add department section ', '2024-03-08 11:27:27', 0),
(37, 'Make heading for add employees page', '2024-03-08 11:27:53', 1);

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
-- Indexes for table `allotted_leave`
--
ALTER TABLE `allotted_leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_type_id` (`leave_type_id`),
  ADD KEY `allotted_leave_ibfk_1` (`employee_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employee_attendance` (`employee_id`);

--
-- Indexes for table `dummy_table`
--
ALTER TABLE `dummy_table`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `setleave`
--
ALTER TABLE `setleave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tableleaves`
--
ALTER TABLE `tableleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

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
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

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
-- AUTO_INCREMENT for table `allotted_leave`
--
ALTER TABLE `allotted_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `employeedocs`
--
ALTER TABLE `employeedocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `emp_docs`
--
ALTER TABLE `emp_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `leave_history`
--
ALTER TABLE `leave_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setleave`
--
ALTER TABLE `setleave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tableleaves`
--
ALTER TABLE `tableleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `employees` (`id`);

--
-- Constraints for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `timesheet_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
