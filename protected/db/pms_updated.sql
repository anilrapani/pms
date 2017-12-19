-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2017 at 04:17 PM
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

--
-- Dumping data for table `k_master_price`
--

INSERT INTO `k_master_price` (`id`, `from_minutes`, `to_minutes`, `amount`, `vehicle_type_id`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 0, 45, '0.00', 1, 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 45, 80, '40.00', 1, 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 80, 285, '80.00', 1, 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 285, 405, '120.00', 1, 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 0, 10, '10.00', 20, 1, 2, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00'),
(23, 10, 30, '20.00', 20, 1, 2, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00'),
(24, 30, 60, '30.00', 20, 1, 2, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00');

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
(1, 2, '2 Wheeler', 1, 2, 2, 2, '2017-12-14 17:42:13', '2017-12-15 09:53:27'),
(2, 2, '2 Wheeler', 1, 2, 2, 0, '2017-12-14 17:47:59', '0000-00-00 00:00:00'),
(3, 3, '3 Wheeler', 1, 2, 2, 0, '2017-12-14 17:48:08', '0000-00-00 00:00:00'),
(4, 4, '4 Wheeler', 1, 2, 2, 3, '2017-12-14 17:48:20', '2017-12-15 09:38:49'),
(17, 5, '5w', 1, 2, 2, 0, '2017-12-18 14:39:34', '0000-00-00 00:00:00'),
(20, 6, '6w', 1, 2, 2, 0, '2017-12-18 14:41:52', '0000-00-00 00:00:00');

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

INSERT INTO `k_parking` (`id`, `vehicle_type_id`, `vehicle_number`, `vehicle_company_id`, `vehicle_company`, `driver_name`, `rc`, `driving_license_number`, `image_driving_license_number`, `image_vehicle_number_plate`, `image_vehicle_number_plate_exit`, `entry_time`, `exit_time`, `master_prices_id`, `total_amount`, `total_minutes`, `barcode`, `master_price_details`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(100077, 1, 'DASDAS', 0, 'Dsadsa', 'Asdsad', 'DSADAS', 'DASD', '669F234791977.jpg', '332J1151902061.jpg', '', '2017-12-18 08:43:57', '2017-12-18 11:45:03', 0, '80.00', 0, '', '', 1, 2, 3, 3, '2017-12-17 17:41:55', '2017-12-18 11:45:03'),
(100090, 1, 'VN1', 0, 'Vc1', 'Dn1', 'RC', 'DL1', '800K1743503336.jpg', '344V1817784949.jpg', '205N1933187483.jpg', '2017-12-18 12:22:00', '2017-12-18 12:23:06', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:21:27', '2017-12-18 12:23:06'),
(100091, 1, 'F', 0, 'Fff', 'Fff', 'DSADSAD', 'FF', '373R333113479.jpg', '849X150487845.jpg', '834A2078710432.jpg', '2017-12-18 12:27:58', '2017-12-18 12:51:37', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:22:10', '2017-12-18 12:51:37'),
(100092, 1, 'SADSADSA', 0, 'Dsad', 'Dsadasd', 'SADAD', 'DASDSA', '451E558750303.jpg', '156Q1432542578.jpg', '961C612197016.jpg', '2017-12-18 12:52:52', '2017-12-18 12:53:50', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:52:43', '2017-12-18 12:53:50'),
(100093, 1, 'SDFSDF', 0, 'Fdsf', 'Sdfsdfs', 'FDSFSDF', 'SDFSDFSDF', '297E1371991875.jpg', '513F1343101882.jpg', '739Y2126813311.jpg', '2017-12-18 12:54:20', '2017-12-18 12:56:48', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:54:06', '2017-12-18 12:56:48'),
(100094, 1, 'FSDF', 0, 'Fdsf', 'Fsdfsd', 'FSDFSDF', 'SDFDSFS', '547C186280297.jpg', '166N251812234.jpg', '480B1050853172.jpg', '2017-12-18 12:57:04', '2017-12-18 12:57:17', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:56:55', '2017-12-18 12:57:17'),
(100095, 1, 'DSADA', 0, 'Dsa', 'Ddsada', 'DSADA', 'DSADSA', '270Y572183978.jpg', '704J411968675.jpg', '381B2099914504.jpg', '2017-12-18 12:57:36', '2017-12-18 12:57:48', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:57:23', '2017-12-18 12:57:48'),
(100096, 1, 'HG', 0, 'Hgfhfgh', 'Hfghfgh', 'HFGHFGH', 'FHFGH', '425U85512795.jpg', '384T867329821.jpg', '608B290201393.jpg', '2017-12-18 13:01:23', '2017-12-18 13:02:28', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 12:58:00', '2017-12-18 13:02:28'),
(100097, 1, 'SDFSDF', 0, 'Fsdf', 'Fsdfsd', 'FSDFDS', 'FSDF', '531E1172231233.jpg', '925M107894766.jpg', '567Q27254424.jpg', '2017-12-18 13:04:33', '2017-12-18 13:04:51', 0, '0.00', 0, '', '', 1, 2, 2, 2, '2017-12-18 13:04:12', '2017-12-18 13:04:51'),
(100098, 1, 'VN1', 0, 'Vc1', 'Dn1', 'RC1', 'DL1', '957M1301380392.jpg', '604D1190689851.jpg', '844B623706716.jpg', '2017-12-18 13:29:31', '2017-12-18 13:31:37', 0, '0.00', 0, '', '', 1, 2, 2, 3, '2017-12-18 13:27:08', '2017-12-18 13:31:37'),
(100099, 17, 'DSAD', 0, 'Dsa', 'Sadsa', 'HGFHFGH', 'DSAD', '260C1468347954.jpg', '731O1938022288.jpg', '', '2017-12-18 14:55:11', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 13:31:45', '2017-12-18 14:55:11'),
(100100, 1, 'DSADA', 0, 'Dsad', 'Asdsad', 'ASDASD', 'DASDA', '545P99047267.jpg', '697J1445103495.jpg', '780V1418360674.jpg', '2017-12-18 15:07:31', '2017-12-18 15:07:58', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 14:55:38', '2017-12-18 15:07:58'),
(100101, 1, 'SADSA', 0, 'Dsad', 'Sda', 'DSADA', 'DSADSA', '546I2007848296.jpg', '831V376936222.jpg', '824V1090391349.jpg', '2017-12-18 15:08:46', '2017-12-18 15:09:41', 0, '0.00', 0, '', '', 1, 2, 3, 3, '2017-12-18 15:08:27', '2017-12-18 15:09:41'),
(100102, 0, '', 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0.00', 0, '', '', 1, 2, 3, 0, '2017-12-18 15:09:16', '0000-00-00 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `k_parking`
--
ALTER TABLE `k_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100103;

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
