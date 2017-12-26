-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2017 at 07:51 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `gate_id` int(11) NOT NULL,
  `cash_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `amount`, `gate_id`, `cash_type`) VALUES
(1, 'anil', 5, 1, 2),
(2, 'karan', 30, 1, 1),
(3, 'kumar', 40, 1, 2),
(4, 'sqamy', 100, 2, 1),
(5, 'praveen', 80, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `k_master_device_registry`
--

CREATE TABLE `k_master_device_registry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_device_registry`
--

INSERT INTO `k_master_device_registry` (`id`, `name`, `user_id`, `ipaddress`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Dell 1', 3, '192.168.1.18DAS', 2, 1, 2, 2, '2017-12-24 04:27:31', '2017-12-24 05:04:21'),
(2, 'DEll', 2, '192.168.1.12', 1, 2, 2, 0, '2017-12-24 05:05:16', '0000-00-00 00:00:00'),
(3, 'Dell 2', 2, '192.168.1.98', 1, 2, 2, 0, '2017-12-24 05:05:38', '0000-00-00 00:00:00'),
(4, 'Remi Note 4', 3, '12345678452', 1, 2, 2, 2, '2017-12-24 05:06:18', '2017-12-24 05:06:32'),
(5, 'Del2', 1, '123456', 1, 2, 2, 0, '2017-12-24 22:39:16', '0000-00-00 00:00:00'),
(6, 'Del3', 1, '1234', 1, 2, 2, 0, '2017-12-24 22:39:25', '0000-00-00 00:00:00'),
(7, 'Asdsa', 1, 'dasd', 1, 2, 2, 0, '2017-12-24 22:39:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_government_proof_type`
--

CREATE TABLE `k_master_government_proof_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_government_proof_type`
--

INSERT INTO `k_master_government_proof_type` (`id`, `name`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Pan Card', 1, 2, 2, 2, '0000-00-00 00:00:00', '2017-12-14 13:37:14'),
(2, 'Driving License2', 2, 1, 2, 2, '0000-00-00 00:00:00', '2017-12-14 13:35:46'),
(3, 'Driving License', 1, 2, 2, 0, '2017-12-14 13:36:12', '0000-00-00 00:00:00'),
(4, 'Aadhar Card', 1, 2, 2, 2, '2017-12-14 13:36:29', '2017-12-14 13:42:26'),
(5, 'Ration Card', 1, 2, 2, 0, '2017-12-14 13:57:59', '0000-00-00 00:00:00'),
(6, 'College Id', 1, 2, 2, 0, '2017-12-14 13:58:13', '0000-00-00 00:00:00'),
(7, 'Voter Id', 1, 1, 2, 2, '2017-12-14 13:58:18', '2017-12-14 16:10:54'),
(8, 'Voter Id', 1, 2, 2, 0, '2017-12-14 16:13:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_price`
--

CREATE TABLE `k_master_price` (
  `id` int(11) NOT NULL,
  `from_minutes` int(11) NOT NULL,
  `to_minutes` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_price`
--

INSERT INTO `k_master_price` (`id`, `from_minutes`, `to_minutes`, `amount`, `vehicle_type_id`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 0, 45, '0.00', 1, 1, 1, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 45, 80, '40.00', 1, 1, 1, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 80, 285, '80.00', 1, 1, 1, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 285, 405, '120.00', 1, 1, 1, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 0, 10, '10.00', 20, 1, 1, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00'),
(23, 10, 30, '20.00', 20, 1, 1, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00'),
(24, 30, 60, '30.00', 20, 1, 1, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00'),
(25, 0, 10, '10.00', 20, 1, 1, 2, 0, '2017-12-18 15:49:21', '0000-00-00 00:00:00'),
(26, 10, 30, '20.00', 20, 1, 1, 2, 0, '2017-12-18 15:49:21', '0000-00-00 00:00:00'),
(27, 30, 60, '30.00', 20, 1, 1, 2, 0, '2017-12-18 15:49:21', '0000-00-00 00:00:00'),
(28, 60, 100, '80.00', 20, 1, 1, 2, 0, '2017-12-18 15:49:21', '0000-00-00 00:00:00'),
(29, 10, 30, '20.00', 20, 1, 1, 2, 0, '2017-12-18 15:50:02', '0000-00-00 00:00:00'),
(30, 30, 60, '30.00', 20, 1, 1, 2, 0, '2017-12-18 15:50:02', '0000-00-00 00:00:00'),
(31, 60, 100, '80.00', 20, 1, 1, 2, 0, '2017-12-18 15:50:02', '0000-00-00 00:00:00'),
(32, 0, 10, '10.00', 20, 1, 1, 2, 0, '2017-12-18 15:50:02', '0000-00-00 00:00:00'),
(33, 30, 60, '30.00', 20, 1, 1, 2, 0, '2017-12-18 15:51:51', '0000-00-00 00:00:00'),
(34, 60, 100, '80.00', 20, 1, 1, 2, 0, '2017-12-18 15:51:51', '0000-00-00 00:00:00'),
(35, 0, 10, '10.00', 20, 1, 1, 2, 0, '2017-12-18 15:51:51', '0000-00-00 00:00:00'),
(36, 0, 15, '0.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:55', '0000-00-00 00:00:00'),
(37, 15, 30, '10.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:55', '0000-00-00 00:00:00'),
(38, 30, 60, '20.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:55', '0000-00-00 00:00:00'),
(39, 60, 120, '30.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:55', '0000-00-00 00:00:00'),
(40, 15, 30, '10.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:59', '0000-00-00 00:00:00'),
(41, 30, 60, '20.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:59', '0000-00-00 00:00:00'),
(42, 60, 120, '30.00', 17, 1, 1, 2, 0, '2017-12-18 15:55:59', '0000-00-00 00:00:00'),
(43, 15, 30, '10.00', 17, 1, 2, 2, 0, '2017-12-18 15:56:26', '0000-00-00 00:00:00'),
(44, 30, 60, '20.00', 17, 1, 2, 2, 0, '2017-12-18 15:56:26', '0000-00-00 00:00:00'),
(45, 60, 150, '30.00', 17, 1, 2, 2, 0, '2017-12-18 15:56:26', '0000-00-00 00:00:00'),
(46, 150, 200, '60.00', 17, 1, 2, 2, 0, '2017-12-18 15:56:26', '0000-00-00 00:00:00'),
(47, 0, 15, '15.00', 21, 1, 2, 2, 0, '2017-12-18 15:57:06', '0000-00-00 00:00:00'),
(48, 15, 30, '30.00', 21, 1, 2, 2, 0, '2017-12-18 15:57:06', '0000-00-00 00:00:00'),
(49, 0, 45, '20.00', 1, 1, 1, 2, 0, '2017-12-18 15:58:10', '0000-00-00 00:00:00'),
(50, 45, 80, '40.00', 1, 1, 1, 2, 0, '2017-12-18 15:58:10', '0000-00-00 00:00:00'),
(51, 80, 285, '80.00', 1, 1, 1, 2, 0, '2017-12-18 15:58:10', '0000-00-00 00:00:00'),
(52, 285, 405, '120.00', 1, 1, 1, 2, 0, '2017-12-18 15:58:10', '0000-00-00 00:00:00'),
(53, 0, 45, '20.00', 1, 1, 1, 2, 0, '2017-12-18 15:59:23', '0000-00-00 00:00:00'),
(54, 45, 80, '40.00', 1, 1, 1, 2, 0, '2017-12-18 15:59:23', '0000-00-00 00:00:00'),
(55, 80, 285, '80.00', 1, 1, 1, 2, 0, '2017-12-18 15:59:23', '0000-00-00 00:00:00'),
(56, 285, 405, '120.00', 1, 1, 1, 2, 0, '2017-12-18 15:59:23', '0000-00-00 00:00:00'),
(57, 0, 15, '15.00', 3, 1, 1, 2, 0, '2017-12-18 16:00:01', '0000-00-00 00:00:00'),
(58, 15, 30, '20.00', 3, 1, 1, 2, 0, '2017-12-18 16:00:01', '0000-00-00 00:00:00'),
(59, 30, 60, '30.00', 3, 1, 1, 2, 0, '2017-12-18 16:00:01', '0000-00-00 00:00:00'),
(60, 0, 10, '10.00', 4, 1, 1, 2, 0, '2017-12-18 16:00:26', '0000-00-00 00:00:00'),
(61, 10, 30, '20.00', 4, 1, 1, 2, 0, '2017-12-18 16:00:26', '0000-00-00 00:00:00'),
(62, 30, 60, '30.00', 4, 1, 1, 2, 0, '2017-12-18 16:00:26', '0000-00-00 00:00:00'),
(63, 0, 15, '0.00', 20, 1, 2, 2, 0, '2017-12-18 16:01:14', '0000-00-00 00:00:00'),
(64, 15, 30, '50.00', 20, 1, 2, 2, 0, '2017-12-18 16:01:14', '0000-00-00 00:00:00'),
(65, 30, 60, '100.00', 20, 1, 2, 2, 0, '2017-12-18 16:01:14', '0000-00-00 00:00:00'),
(66, 0, 15, '0.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:11', '0000-00-00 00:00:00'),
(67, 15, 30, '20.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:11', '0000-00-00 00:00:00'),
(68, 30, 60, '30.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:11', '0000-00-00 00:00:00'),
(69, 60, 120, '70.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:11', '0000-00-00 00:00:00'),
(70, 0, 15, '0.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:27', '0000-00-00 00:00:00'),
(71, 15, 30, '20.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:27', '0000-00-00 00:00:00'),
(72, 30, 60, '30.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:27', '0000-00-00 00:00:00'),
(73, 60, 120, '70.00', 1, 1, 1, 2, 0, '2017-12-18 16:02:27', '0000-00-00 00:00:00'),
(74, 0, 15, '15.00', 3, 1, 2, 2, 0, '2017-12-18 16:02:33', '0000-00-00 00:00:00'),
(75, 15, 30, '20.00', 3, 1, 2, 2, 0, '2017-12-18 16:02:33', '0000-00-00 00:00:00'),
(76, 30, 60, '30.00', 3, 1, 2, 2, 0, '2017-12-18 16:02:33', '0000-00-00 00:00:00'),
(77, 0, 10, '10.00', 4, 1, 2, 2, 0, '2017-12-18 16:02:43', '0000-00-00 00:00:00'),
(78, 10, 30, '20.00', 4, 1, 2, 2, 0, '2017-12-18 16:02:43', '0000-00-00 00:00:00'),
(79, 30, 60, '30.00', 4, 1, 2, 2, 0, '2017-12-18 16:02:43', '0000-00-00 00:00:00'),
(80, 0, 15, '0.00', 1, 1, 1, 2, 0, '2017-12-18 16:03:00', '0000-00-00 00:00:00'),
(81, 15, 30, '20.00', 1, 1, 1, 2, 0, '2017-12-18 16:03:00', '0000-00-00 00:00:00'),
(82, 30, 60, '30.00', 1, 1, 1, 2, 0, '2017-12-18 16:03:00', '0000-00-00 00:00:00'),
(83, 60, 120, '70.00', 1, 1, 1, 2, 0, '2017-12-18 16:03:00', '0000-00-00 00:00:00'),
(84, 0, 15, '15.00', 1, 1, 2, 2, 0, '2017-12-25 15:12:31', '0000-00-00 00:00:00'),
(85, 15, 30, '20.00', 1, 1, 2, 2, 0, '2017-12-25 15:12:31', '0000-00-00 00:00:00'),
(86, 30, 60, '30.00', 1, 1, 2, 2, 0, '2017-12-25 15:12:31', '0000-00-00 00:00:00'),
(87, 60, 120, '70.00', 1, 1, 2, 2, 0, '2017-12-25 15:12:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_user_company`
--

CREATE TABLE `k_master_user_company` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_user_company`
--

INSERT INTO `k_master_user_company` (`id`, `name`, `phone`, `email`, `address`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Kastech', '1111', 'fsdfsd1117@dasda.com', 'Gachibowli, Hyderabad', 1, 2, 2, 2, '0000-00-00 00:00:00', '2017-12-14 13:42:21'),
(2, 'Driving License1', '', '', '', 1, 2, 2, 2, '0000-00-00 00:00:00', '2017-12-14 13:35:03'),
(3, 'Google2', '9876543221', '', 'madhapur', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Google4', '', '', '', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Google5', '123456', 'dsadsa@ddsa.com', '', 1, 2, 2, 2, '0000-00-00 00:00:00', '2017-12-15 12:32:56'),
(6, 'google6', '', '', '', 1, 2, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Employee2', '123456', 'dsadsad@dsadas.com', '123dsadasdsadas', 2, 2, 2, 2, '2017-12-13 15:16:04', '2017-12-14 13:14:31'),
(9, 'Dasda@test.com', '', '', '', 1, 2, 2, 2, '2017-12-13 15:32:19', '2017-12-13 17:42:22'),
(10, 'Company5', '123456', 'dada@dadas.com', 'dasdas', 1, 2, 2, 2, '2017-12-13 16:02:09', '2017-12-13 17:42:33'),
(11, 'Company 5', '1234567891', 'anil.rapani@gmail.com', 'test', 1, 2, 2, 0, '2017-12-13 16:07:13', '0000-00-00 00:00:00'),
(12, 'Company9', '1234567891', 'company9@pms.com', 'test', 1, 2, 2, 0, '2017-12-14 12:10:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_user_shift`
--

CREATE TABLE `k_master_user_shift` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_user_shift`
--

INSERT INTO `k_master_user_shift` (`id`, `name`, `start_time`, `end_time`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Regular', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 1, 2, '0000-00-00 00:00:00', '2017-12-14 16:13:31'),
(2, 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 1, 2, '0000-00-00 00:00:00', '2017-12-14 16:11:06'),
(3, 'Employee', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 2, 2, '0000-00-00 00:00:00', '2017-12-14 16:08:01'),
(4, 'Test', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 2, 2, '2017-12-14 15:45:33', '2017-12-14 16:07:21'),
(5, 'Test', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 2, 2, '2017-12-14 15:45:45', '2017-12-14 16:06:19'),
(6, 'Fdsfsd', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 2, 2, '2017-12-14 15:49:39', '2017-12-14 16:07:57'),
(7, 'Us Shift', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 2, 0, '2017-12-14 16:13:38', '0000-00-00 00:00:00'),
(8, 'Uk Shift', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 2, 2, 2, '2017-12-14 16:13:44', '2017-12-14 16:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_company`
--

CREATE TABLE `k_master_vehicle_company` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_vehicle_company`
--

INSERT INTO `k_master_vehicle_company` (`id`, `name`, `email`, `phone`, `address`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Cargo1', 'test@mail.com', '123456789', 'test', 1, 1, 2, 2, '2017-12-14 16:44:30', '2017-12-14 17:47:40'),
(2, 'Company 1', 'company@mail.com', '1234567891', '', 1, 2, 2, 3, '2017-12-14 17:48:50', '2017-12-15 10:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_gate`
--

CREATE TABLE `k_master_vehicle_gate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1- entry 2-exit',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_vehicle_gate`
--

INSERT INTO `k_master_vehicle_gate` (`id`, `name`, `type`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Entry Gate 4', 1, 1, 2, 2, 2, '2017-12-22 17:36:54', '2017-12-24 21:50:19'),
(2, 'Entry Gate 3', 1, 1, 2, 2, 2, '2017-12-22 17:39:28', '2017-12-23 06:42:56'),
(3, 'Entry Gate 2', 1, 1, 2, 2, 2, '2017-12-22 17:40:42', '2017-12-23 06:42:47'),
(4, 'Entry Gate 1', 1, 1, 2, 2, 2, '2017-12-22 17:41:22', '2017-12-24 22:21:52'),
(5, 'Exit Terminal 1', 2, 1, 2, 2, 0, '2017-12-23 06:44:07', '0000-00-00 00:00:00'),
(6, 'Exit Terminal 2', 2, 1, 2, 2, 0, '2017-12-23 06:44:41', '0000-00-00 00:00:00'),
(7, 'Exit Terminal 3', 2, 1, 2, 2, 2, '2017-12-23 06:44:55', '2017-12-24 22:34:15'),
(8, 'Exit Terminal 5', 1, 1, 2, 2, 2, '2017-12-23 06:45:52', '2017-12-24 02:22:34'),
(9, 'Exit Gate', 1, 1, 2, 2, 0, '2017-12-24 12:32:02', '0000-00-00 00:00:00'),
(10, 'Exit Gate', 1, 1, 2, 2, 2, '2017-12-24 12:33:39', '2017-12-24 21:07:31'),
(11, 'Exit Terminal 6', 2, 1, 2, 2, 2, '2017-12-24 12:35:21', '2017-12-24 21:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_gate_employee`
--

CREATE TABLE `k_master_vehicle_gate_employee` (
  `id` int(11) NOT NULL,
  `vehicle_gate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_registry_id` int(11) NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_vehicle_gate_employee`
--

INSERT INTO `k_master_vehicle_gate_employee` (`id`, `vehicle_gate_id`, `user_id`, `device_registry_id`, `from_time`, `to_time`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 10, 2, 2, '00:00:00', '00:00:00', 1, 1, 2, 0, '2017-12-24 12:33:39', '0000-00-00 00:00:00'),
(2, 10, 3, 4, '00:00:00', '00:00:00', 1, 1, 2, 0, '2017-12-24 12:33:39', '0000-00-00 00:00:00'),
(3, 11, 2, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 12:35:21', '0000-00-00 00:00:00'),
(4, 11, 3, 3, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 12:35:21', '0000-00-00 00:00:00'),
(5, 0, 2, 0, '08:00:00', '16:00:00', 1, 2, 2, 0, '2017-12-24 13:14:09', '0000-00-00 00:00:00'),
(6, 0, 3, 4, '08:00:00', '16:00:00', 1, 2, 2, 0, '2017-12-24 13:14:09', '0000-00-00 00:00:00'),
(7, 11, 1, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:16:02', '0000-00-00 00:00:00'),
(8, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:16:05', '0000-00-00 00:00:00'),
(9, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:16:16', '0000-00-00 00:00:00'),
(10, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:17:45', '0000-00-00 00:00:00'),
(11, 11, 2, 2, '16:00:00', '18:00:00', 1, 1, 2, 0, '2017-12-24 13:17:45', '0000-00-00 00:00:00'),
(12, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:17:59', '0000-00-00 00:00:00'),
(13, 11, 2, 3, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:17:59', '0000-00-00 00:00:00'),
(14, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:18:04', '0000-00-00 00:00:00'),
(15, 11, 3, 0, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:18:04', '0000-00-00 00:00:00'),
(16, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:18:13', '0000-00-00 00:00:00'),
(17, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:18:13', '0000-00-00 00:00:00'),
(18, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:18:17', '0000-00-00 00:00:00'),
(19, 11, 2, 0, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:18:17', '0000-00-00 00:00:00'),
(20, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:18:20', '0000-00-00 00:00:00'),
(21, 11, 3, 0, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:18:20', '0000-00-00 00:00:00'),
(22, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:19:28', '0000-00-00 00:00:00'),
(23, 11, 3, 3, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:19:28', '0000-00-00 00:00:00'),
(24, 11, 1, 0, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:19:31', '0000-00-00 00:00:00'),
(25, 11, 1, 3, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:19:31', '0000-00-00 00:00:00'),
(26, 11, 2, 3, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:19:38', '0000-00-00 00:00:00'),
(27, 11, 1, 3, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:19:38', '0000-00-00 00:00:00'),
(28, 11, 2, 3, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:19:43', '0000-00-00 00:00:00'),
(29, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:19:43', '0000-00-00 00:00:00'),
(30, 11, 2, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 13:19:48', '0000-00-00 00:00:00'),
(31, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:19:48', '0000-00-00 00:00:00'),
(32, 11, 2, 2, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 13:19:54', '0000-00-00 00:00:00'),
(33, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 13:19:54', '0000-00-00 00:00:00'),
(34, 11, 2, 2, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 18:19:53', '0000-00-00 00:00:00'),
(35, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 18:19:53', '0000-00-00 00:00:00'),
(36, 11, 3, 2, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 18:20:22', '0000-00-00 00:00:00'),
(37, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 18:20:22', '0000-00-00 00:00:00'),
(38, 11, 3, 2, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 18:20:25', '0000-00-00 00:00:00'),
(39, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 18:20:25', '0000-00-00 00:00:00'),
(40, 11, 3, 0, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 18:22:46', '0000-00-00 00:00:00'),
(41, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 18:22:46', '0000-00-00 00:00:00'),
(42, 11, 2, 0, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 20:55:38', '0000-00-00 00:00:00'),
(43, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 20:55:38', '0000-00-00 00:00:00'),
(44, 11, 0, 0, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 21:04:09', '0000-00-00 00:00:00'),
(45, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 21:04:09', '0000-00-00 00:00:00'),
(46, 11, 2, 0, '08:00:00', '17:00:00', 1, 1, 2, 0, '2017-12-24 21:04:28', '0000-00-00 00:00:00'),
(47, 11, 1, 4, '16:00:00', '24:00:00', 1, 1, 2, 0, '2017-12-24 21:04:28', '0000-00-00 00:00:00'),
(48, 11, 3, 0, '08:00:00', '17:00:00', 1, 2, 2, 0, '2017-12-24 21:04:58', '0000-00-00 00:00:00'),
(49, 11, 1, 4, '16:00:00', '24:00:00', 1, 2, 2, 0, '2017-12-24 21:04:58', '0000-00-00 00:00:00'),
(50, 10, 2, 2, '00:00:00', '00:00:00', 1, 2, 2, 0, '2017-12-24 21:07:31', '0000-00-00 00:00:00'),
(51, 10, 1, 4, '00:00:00', '00:00:00', 1, 2, 2, 0, '2017-12-24 21:07:31', '0000-00-00 00:00:00'),
(52, 4, 1, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 21:08:38', '0000-00-00 00:00:00'),
(53, 1, 0, 0, '08:00:00', '16:00:00', 1, 2, 2, 0, '2017-12-24 21:50:19', '0000-00-00 00:00:00'),
(54, 4, 3, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 22:03:41', '0000-00-00 00:00:00'),
(55, 4, 0, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 22:07:26', '0000-00-00 00:00:00'),
(56, 4, 3, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 22:09:00', '0000-00-00 00:00:00'),
(57, 4, 1, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 22:09:23', '0000-00-00 00:00:00'),
(58, 4, 3, 2, '08:00:00', '16:00:00', 1, 1, 2, 0, '2017-12-24 22:11:38', '0000-00-00 00:00:00'),
(59, 4, 3, 0, '08:00:00', '16:00:00', 1, 2, 2, 0, '2017-12-24 22:21:52', '0000-00-00 00:00:00'),
(60, 7, 1, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:28:12', '0000-00-00 00:00:00'),
(61, 7, 1, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:28:50', '0000-00-00 00:00:00'),
(62, 7, 1, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:30:18', '0000-00-00 00:00:00'),
(63, 7, 2, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:33:14', '0000-00-00 00:00:00'),
(64, 7, 2, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:33:35', '0000-00-00 00:00:00'),
(65, 7, 1, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:33:35', '0000-00-00 00:00:00'),
(66, 7, 2, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:33:44', '0000-00-00 00:00:00'),
(67, 7, 3, 2, '08:00:00', '08:00:00', 1, 1, 2, 0, '2017-12-24 22:33:44', '0000-00-00 00:00:00'),
(68, 7, 2, 2, '08:00:00', '08:00:00', 1, 2, 2, 0, '2017-12-24 22:34:15', '0000-00-00 00:00:00'),
(69, 7, 0, 2, '08:00:00', '08:00:00', 1, 2, 2, 0, '2017-12-24 22:34:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_type`
--

CREATE TABLE `k_master_vehicle_type` (
  `id` int(11) NOT NULL,
  `number_of_wheels` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_vehicle_type`
--

INSERT INTO `k_master_vehicle_type` (`id`, `number_of_wheels`, `name`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 2, '2w', 1, 2, 2, 2, '2017-12-14 17:42:13', '2017-12-25 15:12:31'),
(2, 2, '2 Wheeler', 1, 1, 2, 2, '2017-12-14 17:47:59', '2017-12-18 15:59:17'),
(3, 3, '3w', 1, 2, 2, 2, '2017-12-14 17:48:08', '2017-12-18 16:02:33'),
(4, 4, '4w', 1, 2, 2, 2, '2017-12-14 17:48:20', '2017-12-18 16:02:43'),
(17, 5, '5w', 1, 2, 2, 2, '2017-12-18 14:39:34', '2017-12-18 15:56:26'),
(20, 6, '6w', 1, 2, 2, 2, '2017-12-18 14:41:52', '2017-12-18 16:01:14'),
(21, 7, '7w', 1, 2, 2, 0, '2017-12-18 15:57:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_parking`
--

CREATE TABLE `k_parking` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `vehicle_company_id` int(11) NOT NULL,
  `vehicle_company` varchar(150) NOT NULL,
  `driver_name` varchar(150) NOT NULL,
  `rc` varchar(100) NOT NULL,
  `driving_license_number` varchar(50) NOT NULL,
  `image_driving_license_number` varchar(200) NOT NULL,
  `image_vehicle_number_plate` varchar(200) NOT NULL,
  `image_vehicle_number_plate_exit` varchar(200) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime NOT NULL,
  `master_prices_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `total_minutes` int(11) NOT NULL,
  `barcode` text NOT NULL,
  `master_price_details` text NOT NULL,
  `gate_id_entry` int(11) NOT NULL,
  `gate_id_exit` int(11) NOT NULL,
  `paid_to_admin` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 - paid, 2 - pending',
  `exited_by` int(11) NOT NULL,
  `customer_paid_by_cash_or_card` tinyint(1) NOT NULL COMMENT '1- cash, 2- card',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_parking`
--

INSERT INTO `k_parking` (`id`, `vehicle_type_id`, `vehicle_number`, `vehicle_company_id`, `vehicle_company`, `driver_name`, `rc`, `driving_license_number`, `image_driving_license_number`, `image_vehicle_number_plate`, `image_vehicle_number_plate_exit`, `entry_time`, `exit_time`, `master_prices_id`, `total_amount`, `total_minutes`, `barcode`, `master_price_details`, `gate_id_entry`, `gate_id_exit`, `paid_to_admin`, `exited_by`, `customer_paid_by_cash_or_card`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 1, 'VN1', 0, 'C1', 'Dn1', 'RC1', 'DL1', '544P767600913.jpg', '524R1172875452.jpg', '868F1611584516.jpg', '2017-12-25 15:06:16', '2017-12-25 15:06:38', 0, '60.00', 0, '15141945761222', '', 4, 4, 2, 3, 2, 1, 2, 3, 3, '2017-12-25 15:06:16', '2017-12-25 15:06:38'),
(2, 1, 'VN2', 0, 'Vc2', 'Dn2', 'RC2', 'DL2', '187Q1440214216.jpg', '677B911639228.jpg', '609B2069774200.jpg', '2017-12-25 15:07:30', '2017-12-25 15:07:43', 0, '30.00', 0, '15141946501222', '', 4, 3, 2, 3, 1, 1, 2, 3, 3, '2017-12-25 15:07:30', '2017-12-25 15:07:43'),
(3, 1, 'DSA', 0, 'Da', 'Sadsad', 'DASDAS', 'DSAD', '349P1941376567.jpg', '207E79059288.jpg', '667Y972575865.jpg', '2017-12-25 15:08:05', '2017-12-25 15:08:15', 0, '25.00', 0, '15141946851222', '', 4, 3, 2, 3, 1, 1, 2, 3, 3, '2017-12-25 15:08:05', '2017-12-25 15:08:15'),
(4, 1, 'VC4', 0, 'Vc4', 'Vc4', 'VC4', 'VC4', '884O299916047.jpg', '539F896029937.jpg', '981H2110824227.jpg', '2017-12-25 15:13:02', '2017-12-25 15:13:16', 0, '15.00', 0, '15141949821222', '', 4, 4, 2, 3, 2, 1, 2, 3, 3, '2017-12-25 15:13:02', '2017-12-25 15:13:16'),
(5, 1, 'VC5', 0, 'Vc5', 'Vc5', 'VC5', 'VC5', '144R1987334877.jpg', '298U1396346056.jpg', '650O593358714.jpg', '2017-12-25 15:22:15', '2017-12-25 15:38:28', 0, '20.00', 0, '15141955351222', '', 4, 4, 2, 3, 1, 1, 2, 3, 3, '2017-12-25 15:22:15', '2017-12-25 15:38:28'),
(6, 1, 'DASD', 0, 'Vc6', 'Dasd', 'VCVCX', 'DASD', '901T1264726538.jpg', '905D1654525006.jpg', '1000T192163290.jpg', '2017-12-26 00:01:27', '2017-12-26 00:02:13', 0, '15.00', 0, '15142266861222', '', 1, 1, 2, 3, 1, 1, 2, 3, 3, '2017-12-26 00:01:27', '2017-12-26 00:02:13'),
(7, 1, 'VC7', 0, 'Vc7', 'Vc7', 'VC7', 'VC7', '171E1984246881.jpg', '745K1518465557.jpg', '246C2111729883.jpg', '2017-12-26 11:29:10', '2017-12-26 11:29:35', 0, '15.00', 0, '15142679501222', '', 4, 4, 2, 3, 1, 1, 2, 3, 3, '2017-12-26 11:29:10', '2017-12-26 11:29:35'),
(8, 1, 'VC8', 0, 'Vc8', 'Vc8', 'VC8', 'VC8', '790I1344774073.jpg', '408F1600598026.jpg', '377N1886781655.jpg', '2017-12-26 11:30:19', '2017-12-26 11:30:37', 0, '15.00', 0, '15142680191222', '', 4, 4, 2, 3, 1, 1, 2, 3, 3, '2017-12-26 11:30:19', '2017-12-26 11:30:37'),
(9, 1, 'VC9', 0, 'Vc9', 'Vc9', 'VC9', 'VC9', '981D1338032590.jpg', '746S1381536672.jpg', '958K2046534303.jpg', '2017-12-26 11:31:29', '2017-12-26 11:31:42', 0, '15.00', 0, '15142680891222', '', 4, 4, 2, 3, 1, 1, 2, 3, 3, '2017-12-26 11:31:29', '2017-12-26 11:31:42'),
(10, 1, 'VC10', 0, 'Vc10', 'Vc10', 'VC10', 'VC10', '522D564595110.jpg', '748Q747939859.jpg', '979N655665126.jpg', '2017-12-26 11:53:57', '2017-12-26 11:54:12', 0, '15.00', 0, '15142694371222', '', 8, 8, 2, 2, 1, 1, 2, 2, 2, '2017-12-26 11:53:57', '2017-12-26 11:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `k_printer`
--

CREATE TABLE `k_printer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `k_report`
--

CREATE TABLE `k_report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_amount` decimal(10,2) NOT NULL,
  `card_amount` decimal(10,2) NOT NULL,
  `card_start_transaction_id` int(11) NOT NULL,
  `card_end_transaction_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `gate_id` int(11) NOT NULL,
  `paid_to_admin` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- report generated, 2- updated by employee/admin (soft cash details ), 3- admin collected/ paid to admin',
  `first_parking_id_time_after_login` datetime NOT NULL,
  `last_parking_id_time_after_login` datetime NOT NULL,
  `parking_id_from` int(11) NOT NULL,
  `parking_id_to` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_report`
--

INSERT INTO `k_report` (`id`, `user_id`, `cash_amount`, `card_amount`, `card_start_transaction_id`, `card_end_transaction_id`, `total_amount`, `gate_id`, `paid_to_admin`, `first_parking_id_time_after_login`, `last_parking_id_time_after_login`, `parking_id_from`, `parking_id_to`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(4, 3, '20.00', '75.00', 0, 0, '95.00', 4, 1, '2017-12-25 15:06:38', '2017-12-25 15:38:28', 1, 5, 1, 2, 3, 0, '2017-12-25 23:33:20', '0000-00-00 00:00:00'),
(5, 3, '55.00', '0.00', 0, 0, '55.00', 3, 1, '2017-12-25 15:07:43', '2017-12-25 15:08:15', 2, 3, 1, 2, 3, 0, '2017-12-25 23:33:20', '0000-00-00 00:00:00'),
(6, 3, '15.00', '0.00', 0, 0, '15.00', 1, 1, '2017-12-26 00:02:13', '2017-12-26 00:02:13', 6, 6, 1, 2, 3, 0, '2017-12-26 11:23:49', '0000-00-00 00:00:00'),
(7, 3, '45.00', '0.00', 0, 0, '45.00', 4, 1, '2017-12-26 11:29:35', '2017-12-26 11:31:42', 7, 9, 1, 2, 3, 0, '2017-12-26 11:31:55', '0000-00-00 00:00:00'),
(8, 2, '15.00', '0.00', 0, 0, '15.00', 8, 1, '2017-12-26 11:54:12', '2017-12-26 11:54:12', 10, 10, 1, 2, 2, 0, '2017-12-26 11:54:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_user`
--

CREATE TABLE `k_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `government_proof_type_id` int(11) NOT NULL,
  `government_id_number` varchar(100) NOT NULL,
  `image_profile` varchar(200) NOT NULL,
  `user_company_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_user`
--

INSERT INTO `k_user` (`id`, `name`, `user_name`, `email`, `mobile`, `password`, `role_id`, `government_proof_type_id`, `government_id_number`, `image_profile`, `user_company_id`, `shift_id`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@pms.com', '9014608228', '$2y$10$.vh0nF8hsjiKGms8sRC1fewLlj5JEyFBs.XqN94TvzQmyODcSWpgO', 1, 1, '2', '', 1, 3, 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Admin', 'admin', 'admin@pms.com', '9014608228', '$2y$10$F1dZNBVg21lyfpn55bDP/uU50uR1ZXZzNJos4uBCa0dVP2VDLOt7e', 2, 1, '2', '', 1, 2, 1, 2, 1, 2, '0000-00-00 00:00:00', '2017-12-15 12:35:59'),
(3, 'Employee', '', 'employee@pms.com', '1234567891', '$2y$10$.vh0nF8hsjiKGms8sRC1fewLlj5JEyFBs.XqN94TvzQmyODcSWpgO', 3, 2, '123456789', '', 3, 2, 1, 2, 1, 2, '2017-12-15 00:00:00', '2017-12-15 12:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `k_user_log`
--

CREATE TABLE `k_user_log` (
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `ip_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `k_user_role`
--

CREATE TABLE `k_user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_user_role`
--

INSERT INTO `k_user_role` (`id`, `name`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Super Admin', 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Admin', 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Employee', 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_device_registry`
--
ALTER TABLE `k_master_device_registry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_government_proof_type`
--
ALTER TABLE `k_master_government_proof_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_price`
--
ALTER TABLE `k_master_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_user_company`
--
ALTER TABLE `k_master_user_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_user_shift`
--
ALTER TABLE `k_master_user_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_vehicle_company`
--
ALTER TABLE `k_master_vehicle_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_vehicle_gate`
--
ALTER TABLE `k_master_vehicle_gate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_vehicle_gate_employee`
--
ALTER TABLE `k_master_vehicle_gate_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_vehicle_type`
--
ALTER TABLE `k_master_vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_parking`
--
ALTER TABLE `k_parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_printer`
--
ALTER TABLE `k_printer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_report`
--
ALTER TABLE `k_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_user`
--
ALTER TABLE `k_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_role_id` (`role_id`) USING BTREE,
  ADD KEY `FK_government_proof_type_id` (`government_proof_type_id`),
  ADD KEY `FK_user_company_id` (`user_company_id`),
  ADD KEY `FK_shift_id` (`shift_id`);

--
-- Indexes for table `k_user_log`
--
ALTER TABLE `k_user_log`
  ADD KEY `FK_user_id` (`user_id`);

--
-- Indexes for table `k_user_role`
--
ALTER TABLE `k_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `k_master_device_registry`
--
ALTER TABLE `k_master_device_registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `k_master_government_proof_type`
--
ALTER TABLE `k_master_government_proof_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `k_master_price`
--
ALTER TABLE `k_master_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `k_master_user_company`
--
ALTER TABLE `k_master_user_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `k_master_user_shift`
--
ALTER TABLE `k_master_user_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `k_master_vehicle_company`
--
ALTER TABLE `k_master_vehicle_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `k_master_vehicle_gate`
--
ALTER TABLE `k_master_vehicle_gate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `k_master_vehicle_gate_employee`
--
ALTER TABLE `k_master_vehicle_gate_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `k_master_vehicle_type`
--
ALTER TABLE `k_master_vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `k_parking`
--
ALTER TABLE `k_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `k_printer`
--
ALTER TABLE `k_printer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_report`
--
ALTER TABLE `k_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `k_user`
--
ALTER TABLE `k_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `k_user_role`
--
ALTER TABLE `k_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `k_user`
--
ALTER TABLE `k_user`
  ADD CONSTRAINT `FK_government_proof_type_id` FOREIGN KEY (`government_proof_type_id`) REFERENCES `k_master_government_proof_type` (`id`),
  ADD CONSTRAINT `FK_k_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `k_user_role` (`id`),
  ADD CONSTRAINT `FK_shift_id` FOREIGN KEY (`shift_id`) REFERENCES `k_master_user_shift` (`id`),
  ADD CONSTRAINT `FK_user_company_id` FOREIGN KEY (`user_company_id`) REFERENCES `k_master_user_company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
