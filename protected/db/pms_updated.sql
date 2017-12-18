-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2017 at 07:52 AM
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
(1, 2, '2 Wheeler', 2, 2, 2, 2, '2017-12-14 17:42:13', '2017-12-15 09:53:27'),
(2, 2, '2 Wheeler', 1, 2, 2, 0, '2017-12-14 17:47:59', '0000-00-00 00:00:00'),
(3, 3, '3 Wheeler', 1, 2, 2, 0, '2017-12-14 17:48:08', '0000-00-00 00:00:00'),
(4, 5, '4 Wheeler', 1, 2, 2, 3, '2017-12-14 17:48:20', '2017-12-15 09:38:49');

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
  `entry_time` datetime NOT NULL,
  `exit_time` datetime NOT NULL,
  `master_prices_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `total_minutes` int(11) NOT NULL,
  `barcode` text NOT NULL,
  `master_price_details` text NOT NULL,
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

INSERT INTO `k_parking` (`id`, `vehicle_type_id`, `vehicle_number`, `vehicle_company_id`, `vehicle_company`, `driver_name`, `rc`, `driving_license_number`, `image_driving_license_number`, `image_vehicle_number_plate`, `entry_time`, `exit_time`, `master_prices_id`, `total_amount`, `total_minutes`, `barcode`, `master_price_details`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(100073, 1, 'DAS', 0, 'Dasdas', 'Dsadas', 'DSADSADS', 'DSADSA', '174W2014124751.jpg', '448V20140696.jpg', '2017-12-17 17:01:46', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:01:00', '2017-12-17 17:01:46'),
(100074, 1, 'DSAD', 0, 'Dsadsa', 'Asdsa', 'DSADSA', 'SADSAD', '504A1431545408.jpg', '220R1530834235.jpg', '2017-12-17 17:02:19', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:01:51', '2017-12-17 17:02:19'),
(100075, 1, 'DASDSA', 0, '', '', '', '', '914A824854206.jpg', '733B137578579.jpg', '2017-12-17 17:36:34', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:02:26', '2017-12-17 17:36:34'),
(100076, 1, 'DSAD', 0, 'Dsad', 'Dada', 'DSADSA', 'SADA', '585C1157528869.jpg', '422K627407359.jpg', '2017-12-17 17:41:39', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:37:03', '2017-12-17 17:41:39'),
(100077, 1, 'DASDAS', 0, 'Dsadsa', 'Asdsad', 'DSADAS', 'DASD', '669F234791977.jpg', '332J1151902061.jpg', '2017-12-17 17:43:57', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:41:55', '2017-12-17 17:43:57'),
(100078, 1, 'DSA', 0, 'Dsadas', 'Asdsad', 'DSADAS', 'DSAD', '327C441285668.jpg', '487L1433847061.jpg', '2017-12-17 18:06:52', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:44:13', '2017-12-17 18:06:52'),
(100079, 1, 'DSAD', 0, 'Das', 'Dsadasd', 'DSADASD', 'DSAD', '760I1781814161.jpg', '828D2073961041.jpg', '2017-12-17 18:12:08', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 18:09:27', '2017-12-17 18:12:08'),
(100080, 1, 'DSAD', 0, 'Dasdas', 'Sadad', 'DSADASDA', 'DSAD', '301K577621227.jpg', '130E1237873074.jpg', '2017-12-17 18:23:56', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 18:12:16', '2017-12-17 18:23:56'),
(100081, 1, 'DASDAS', 0, 'Dsadas', 'Sadsad', 'DASDAS', 'DASD', '965U91978543.jpg', '910Q402368244.jpg', '2017-12-17 18:26:47', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 18:26:24', '2017-12-17 18:26:47'),
(100082, 1, 'SFDSFDS', 0, 'Df', 'Fdsfsdf', 'FDSFSDFS', 'FDSFDS', '954R615590057.jpg', '172O1840047463.jpg', '2017-12-17 18:32:43', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 18:26:51', '2017-12-17 18:32:43'),
(100083, 1, 'FDSF', 0, 'Fsdfsdf', 'Dn', 'RC', 'DL', '644C842897430.jpg', '885I1801818641.jpg', '2017-12-18 03:17:03', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 18:32:58', '2017-12-18 03:17:03'),
(100084, 1, 'DASD', 0, 'Dsad', 'Asdas', 'DASDA', 'DSADA', '420T2062261965.jpg', '859A402293153.jpg', '2017-12-18 05:00:11', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 03:19:46', '2017-12-18 05:00:11'),
(100085, 1, 'DSAD', 0, 'Dsad', 'Dada', 'DSADA', 'ASDAS', '310Q395449657.jpg', '413S1162643207.jpg', '2017-12-18 05:10:14', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 05:03:16', '2017-12-18 05:10:14'),
(100086, 1, '123', 0, '', '', '', '', '456D1622950772.jpg', '590O2077597095.jpg', '2017-12-18 05:21:33', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 05:12:56', '2017-12-18 05:21:33'),
(100087, 1, 'DSA', 0, 'Dsada', 'Dsad', 'DASDSAD', 'DSADSA', '319J1591953288.jpg', '370Y1332426635.jpg', '2017-12-18 05:33:00', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 05:21:45', '2017-12-18 05:33:00'),
(100088, 1, 'DASD', 0, 'Dsada', 'Dsadsa', 'DSADAS', 'ADASD', '372F1602694572.jpg', '123C584703007.jpg', '2017-12-18 05:55:23', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 05:55:10', '2017-12-18 05:55:23'),
(100089, 0, '', 0, '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 0, '2017-12-18 05:57:51', '0000-00-00 00:00:00');

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
-- AUTO_INCREMENT for table `k_master_government_proof_type`
--
ALTER TABLE `k_master_government_proof_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `k_master_price`
--
ALTER TABLE `k_master_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `k_master_vehicle_type`
--
ALTER TABLE `k_master_vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `k_parking`
--
ALTER TABLE `k_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100090;

--
-- AUTO_INCREMENT for table `k_printer`
--
ALTER TABLE `k_printer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
