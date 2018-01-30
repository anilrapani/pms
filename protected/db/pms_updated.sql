-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2018 at 11:04 AM
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
-- Database: `pms_22_jan_2018`
--

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
(1, 'Driving License', 1, 2, 2, 2, '0000-00-00 00:00:00', '2018-01-18 21:08:56'),
(11, 'Aadhar Card', 1, 2, 2, 0, '2018-01-22 12:36:36', '0000-00-00 00:00:00'),
(12, 'Voter Id', 1, 2, 2, 0, '2018-01-22 12:36:58', '0000-00-00 00:00:00'),
(14, 'Pan Card', 1, 2, 2, 0, '2018-01-22 12:38:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_price`
--

CREATE TABLE `k_master_price` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `more_than_minutes` int(11) NOT NULL,
  `more_than_minutes_per_hour_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
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

INSERT INTO `k_master_price` (`id`, `name`, `more_than_minutes`, `more_than_minutes_per_hour_amount`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(12, 'Free Vehicle', 0, '0.00', 1, 2, 2, 2, '2018-01-22 13:01:04', '2018-01-22 19:39:29'),
(13, '3 Wheeler', 0, '0.00', 1, 2, 2, 2, '2018-01-22 13:06:02', '2018-01-22 20:14:51'),
(14, '4 Wheeler', 0, '0.00', 1, 2, 2, 2, '2018-01-22 13:07:04', '2018-01-22 20:16:13'),
(15, '6 Wheeler', 0, '0.00', 1, 2, 2, 2, '2018-01-22 19:35:32', '2018-01-22 19:47:59'),
(16, '10 Wheeler', 0, '0.00', 1, 2, 2, 0, '2018-01-22 20:12:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_price_per_time`
--

CREATE TABLE `k_master_price_per_time` (
  `id` int(11) NOT NULL,
  `from_minutes` int(11) NOT NULL,
  `to_minutes` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `price_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_master_price_per_time`
--

INSERT INTO `k_master_price_per_time` (`id`, `from_minutes`, `to_minutes`, `amount`, `price_id`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 0, 45, '0.00', 12, 1, 1, 2, 0, '2018-01-22 13:01:04', '0000-00-00 00:00:00'),
(2, 0, 45, '0.00', 13, 1, 1, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(3, 45, 60, '10.00', 13, 1, 1, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(4, 60, 120, '20.00', 13, 1, 1, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(5, 120, 240, '30.00', 13, 1, 1, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(6, 240, 360, '40.00', 13, 1, 1, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(7, 0, 45, '0.00', 14, 1, 1, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(8, 45, 60, '10.00', 14, 1, 1, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(9, 60, 120, '20.00', 14, 1, 1, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(10, 120, 240, '30.00', 14, 1, 1, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(11, 240, 360, '40.00', 14, 1, 1, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(12, 0, 45, '0.00', 12, 1, 1, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(13, 45, 60, '10.00', 12, 1, 1, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(14, 60, 120, '20.00', 12, 1, 1, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(15, 120, 240, '30.00', 12, 1, 1, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(16, 240, 360, '40.00', 12, 1, 1, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(17, 0, 9999999, '0.00', 15, 1, 1, 2, 0, '2018-01-22 19:35:32', '0000-00-00 00:00:00'),
(18, 0, 9999999, '0.00', 12, 1, 2, 2, 0, '2018-01-22 19:39:29', '0000-00-00 00:00:00'),
(19, 0, 2592000, '0.00', 15, 1, 1, 2, 0, '2018-01-22 19:40:14', '0000-00-00 00:00:00'),
(20, 0, 45, '0.00', 15, 1, 2, 2, 0, '2018-01-22 19:47:59', '0000-00-00 00:00:00'),
(21, 46, 165, '40.00', 15, 1, 2, 2, 0, '2018-01-22 19:47:59', '0000-00-00 00:00:00'),
(22, 166, 285, '80.00', 15, 1, 2, 2, 0, '2018-01-22 19:47:59', '0000-00-00 00:00:00'),
(23, 286, 405, '120.00', 15, 1, 2, 2, 0, '2018-01-22 19:47:59', '0000-00-00 00:00:00'),
(24, 0, 45, '0.00', 16, 1, 2, 2, 0, '2018-01-22 20:12:19', '0000-00-00 00:00:00'),
(25, 45, 165, '40.00', 16, 1, 2, 2, 0, '2018-01-22 20:12:19', '0000-00-00 00:00:00'),
(26, 165, 285, '80.00', 16, 1, 2, 2, 0, '2018-01-22 20:12:19', '0000-00-00 00:00:00'),
(27, 286, 405, '120.00', 16, 1, 2, 2, 0, '2018-01-22 20:12:19', '0000-00-00 00:00:00'),
(28, 0, 45, '0.00', 13, 1, 2, 2, 0, '2018-01-22 20:14:51', '0000-00-00 00:00:00'),
(29, 46, 165, '40.00', 13, 1, 2, 2, 0, '2018-01-22 20:14:51', '0000-00-00 00:00:00'),
(30, 166, 285, '80.00', 13, 1, 2, 2, 0, '2018-01-22 20:14:51', '0000-00-00 00:00:00'),
(31, 286, 405, '120.00', 13, 1, 2, 2, 0, '2018-01-22 20:14:51', '0000-00-00 00:00:00'),
(32, 0, 45, '0.00', 14, 1, 2, 2, 0, '2018-01-22 20:16:13', '0000-00-00 00:00:00'),
(33, 46, 165, '40.00', 14, 1, 2, 2, 0, '2018-01-22 20:16:13', '0000-00-00 00:00:00'),
(34, 166, 285, '80.00', 14, 1, 2, 2, 0, '2018-01-22 20:16:13', '0000-00-00 00:00:00'),
(35, 286, 405, '120.00', 14, 1, 2, 2, 0, '2018-01-22 20:16:13', '0000-00-00 00:00:00');

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
(1, 'Menzies Aviation Bobba (B\'lore) Pvt Ltd', '1234567891', 'fsdfsd1117@dasda.com', 'Gachibowli, Hyderabad', 1, 2, 2, 2, '0000-00-00 00:00:00', '2018-01-22 10:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_user_shift`
--

CREATE TABLE `k_master_user_shift` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
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
(1, 'Morning Shift', '10:00:00', '18:00:00', 1, 2, 1, 2, '0000-00-00 00:00:00', '2018-01-18 21:09:20'),
(7, 'Evening Shift', '18:00:00', '02:00:00', 1, 2, 2, 2, '2017-12-14 16:13:38', '2018-01-19 16:04:16'),
(8, 'Night Shift', '02:00:00', '10:00:00', 1, 2, 2, 2, '2017-12-14 16:13:44', '2018-01-18 16:05:37');

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
(1, 'Birla Super', 'test@mail.com', '1234567891', 'test', 1, 2, 2, 2, '2017-12-14 16:44:30', '2018-01-22 12:49:37'),
(2, 'Reliance Industries', 'company@mail.com', '1234567891', 'Bangalore', 1, 2, 2, 2, '2017-12-14 17:48:50', '2018-01-22 12:49:58'),
(3, 'Tata Exports', 'vc2@mail.com', '1234567891', 'test', 1, 2, 2, 2, '2018-01-09 14:59:08', '2018-01-22 12:50:26');

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
(4, 'Cargo Terminal-1, KIAL', 1, 1, 2, 2, 2, '2017-12-22 17:41:22', '2018-01-29 12:38:41'),
(5, 'Cargo Terminal 2', 2, 1, 2, 2, 2, '2017-12-23 06:44:07', '2018-01-22 12:55:24'),
(6, 'Cargo Terminal 3', 2, 1, 2, 2, 2, '2017-12-23 06:44:41', '2018-01-22 12:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_gate_employee`
--

CREATE TABLE `k_master_vehicle_gate_employee` (
  `id` int(11) NOT NULL,
  `vehicle_gate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `device_registry_id` int(11) NOT NULL,
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

INSERT INTO `k_master_vehicle_gate_employee` (`id`, `vehicle_gate_id`, `user_id`, `shift_id`, `device_registry_id`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(110, 4, 0, 0, 0, 1, 1, 2, 0, '2018-01-22 12:53:02', '0000-00-00 00:00:00'),
(111, 5, 0, 0, 0, 1, 1, 2, 0, '2018-01-22 12:53:10', '0000-00-00 00:00:00'),
(112, 6, 0, 0, 0, 1, 1, 2, 0, '2018-01-22 12:53:19', '0000-00-00 00:00:00'),
(113, 6, 0, 0, 0, 1, 2, 2, 0, '2018-01-22 12:55:20', '0000-00-00 00:00:00'),
(114, 5, 0, 0, 0, 1, 2, 2, 0, '2018-01-22 12:55:24', '0000-00-00 00:00:00'),
(115, 4, 0, 0, 0, 1, 1, 2, 0, '2018-01-22 12:55:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_type`
--

CREATE TABLE `k_master_vehicle_type` (
  `id` int(11) NOT NULL,
  `number_of_wheels` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price_id` int(11) NOT NULL,
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

INSERT INTO `k_master_vehicle_type` (`id`, `number_of_wheels`, `name`, `price_id`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(27, 2, 'Free Vehicle', 12, 1, 2, 2, 2, '2018-01-22 13:08:02', '2018-01-22 20:16:48'),
(28, 3, '3 Wheeler', 13, 1, 2, 2, 2, '2018-01-22 13:08:19', '2018-01-22 20:19:54'),
(29, 4, '4 Wheeler', 14, 2, 2, 2, 2, '2018-01-22 13:08:30', '2018-01-23 14:47:09'),
(30, 6, '6 Wheeler', 15, 1, 2, 2, 0, '2018-01-22 20:20:28', '0000-00-00 00:00:00'),
(31, 10, '10 Wheeler Or Above', 16, 1, 2, 2, 2, '2018-01-22 20:20:42', '2018-01-29 16:49:08');

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
  `entry_printed` tinyint(4) NOT NULL DEFAULT '2' COMMENT '2- not yet printed, 1- printed',
  `exit_printed` tinyint(4) NOT NULL DEFAULT '2' COMMENT '2- not yet printed, 1- printed',
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

INSERT INTO `k_parking` (`id`, `vehicle_type_id`, `vehicle_number`, `vehicle_company_id`, `vehicle_company`, `driver_name`, `rc`, `driving_license_number`, `image_driving_license_number`, `image_vehicle_number_plate`, `image_vehicle_number_plate_exit`, `entry_time`, `exit_time`, `master_prices_id`, `total_amount`, `total_minutes`, `barcode`, `master_price_details`, `gate_id_entry`, `gate_id_exit`, `paid_to_admin`, `exited_by`, `customer_paid_by_cash_or_card`, `entry_printed`, `exit_printed`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(56, 27, 'VN1', 0, 'New Company', 'VN1', 'VN1', 'VN1', '148G1029004294.jpg', '815E1895522860.jpg', '', '2018-01-22 14:34:02', '0000-00-00 00:00:00', 0, '0.00', 0, '667415166118421601', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-22 14:34:02', '0000-00-00 00:00:00'),
(57, 27, 'VN1', 0, 'New Company', 'Vn1', 'VN1', 'VN1', '913I1466378109.jpg', '392I1416981796.jpg', '', '2018-01-22 14:39:34', '2018-01-24 20:31:04', 0, '0.00', 0, '408715166121745254', '', 4, 6, 2, 2, 0, 2, 2, 1, 2, 6, 2, '2018-01-22 14:39:34', '2018-01-24 20:31:04'),
(58, 27, 'VN1', 0, 'New Company', 'Dn1', 'RC', 'DL1', '121I969958768.jpg', '151F739673021.jpg', '', '2018-01-22 20:32:20', '0000-00-00 00:00:00', 0, '0.00', 0, '718315166333391579', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-22 20:32:20', '0000-00-00 00:00:00'),
(59, 27, 'VN1', 0, 'Da', 'Dn1', 'RC', 'DL1', '352B1233700913.jpg', '636P1754710083.jpg', '', '2018-01-22 20:32:35', '2018-01-24 19:47:43', 0, '0.00', 0, '430915166333555358', '', 4, 0, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-22 20:32:35', '2018-01-24 19:47:43'),
(60, 27, 'VN1', 0, 'NC1', 'DN1', 'RC1', 'DL1', '312P2112625752.jpg', '899G1019022612.jpg', '', '2018-01-22 20:48:24', '2018-01-24 20:24:24', 0, '0.00', 0, '343415166343042348', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-22 20:48:24', '2018-01-24 20:24:24'),
(61, 27, 'VN1', 0, 'NC1', 'DN1', 'RC1', 'DL1', '523Q1137341946.jpg', '131P25816533.jpg', '', '2018-01-22 20:49:52', '2018-01-22 20:56:38', 0, '0.00', 0, '553815166343924665', '', 4, 5, 2, 7, 0, 2, 2, 1, 2, 2, 7, '2018-01-22 20:49:52', '2018-01-22 20:56:38'),
(62, 28, '', 0, 'Test', '', '', '', '', '889J605417995.jpg', '', '2018-01-24 19:40:14', '0000-00-00 00:00:00', 0, '0.00', 0, '711215168030146531', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-24 19:40:14', '0000-00-00 00:00:00'),
(63, 28, '', 0, 'New Company', '', '', '', '', '973L1553991347.jpg', '', '2018-01-24 19:44:09', '0000-00-00 00:00:00', 0, '0.00', 0, '935715168032497388', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-24 19:44:09', '0000-00-00 00:00:00'),
(64, 27, 'TEST', 0, 'Test', 'Test', '123', '123456', '', '994Y1955347990.jpg', '', '2018-01-24 20:04:55', '2018-01-24 20:08:28', 0, '0.00', 0, '871315168044959481', '', 4, 0, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 20:04:55', '2018-01-24 20:08:28'),
(65, 30, 'VN1', 0, 'NC1', 'Dn1', 'RC1', 'DL1', '', '316G1253213164.jpg', '', '2018-01-24 20:38:13', '2018-01-24 20:40:46', 0, '0.00', 0, '181015168064931850', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 20:38:13', '2018-01-24 20:40:46'),
(66, 27, '', 0, 'New Company', '', '', '', '', '436L870898725.jpg', '', '2018-01-24 20:43:59', '2018-01-24 20:44:29', 0, '0.00', 0, '934715168068392641', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 20:43:59', '2018-01-24 20:44:29'),
(67, 27, '', 0, 'New Company', '', '', '', '', '993C1177974843.jpg', '', '2018-01-24 20:44:46', '2018-01-24 20:45:06', 0, '0.00', 0, '910515168068869235', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 20:44:46', '2018-01-24 20:45:06'),
(68, 28, '', 0, 'New Company', '', '', '', '', '210G1964184427.jpg', '', '2018-01-24 20:45:41', '2018-01-24 20:46:12', 0, '0.00', 0, '267115168069415675', '', 4, 6, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 20:45:41', '2018-01-24 20:46:12'),
(69, 28, '', 0, 'New Company', '', '', '', '', '831G2125277387.jpg', '', '2018-01-24 21:04:12', '2018-01-24 21:05:14', 0, '0.00', 0, '184715168080527189', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 21:04:12', '2018-01-24 21:05:14'),
(70, 28, '', 0, 'New Company', '', '', '', '', '570H236112983.jpg', '', '2018-01-24 21:05:29', '2018-01-24 21:05:37', 0, '0.00', 0, '437315168081295800', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 21:05:29', '2018-01-24 21:05:37'),
(71, 28, 'DSADSA', 0, 'Dasdsadsa', 'Dsad', 'SADSAD', 'DSAD', '531C536479006.jpg', '665D2057266391.jpg', '', '2018-01-24 22:00:47', '0000-00-00 00:00:00', 0, '0.00', 0, '901215168114465402', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-24 22:00:47', '0000-00-00 00:00:00'),
(72, 28, 'DSADAS', 0, 'Test', '', '', '', '', '937X1042183740.jpg', '', '2018-01-24 22:03:33', '2018-01-24 22:06:10', 0, '0.00', 0, '721215168116132770', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 22:03:33', '2018-01-24 22:06:10'),
(73, 28, 'DSAD', 0, '123456', 'Asdsad', 'ASDSADSA', 'SADSAD', '159G1862127909.jpg', '893U182876351.jpg', '', '2018-01-24 22:08:12', '0000-00-00 00:00:00', 0, '0.00', 0, '152415168118926817', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-24 22:08:12', '0000-00-00 00:00:00'),
(74, 28, '', 0, 'New Company', '', '', '', '', '692L2111366682.jpg', '', '2018-01-24 22:12:19', '2018-01-24 22:12:53', 0, '0.00', 0, '220915168121394228', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 22:12:19', '2018-01-24 22:12:53'),
(75, 28, '', 0, 'New Company', '', '', '', '', '849C1668069251.jpg', '', '2018-01-24 22:14:27', '2018-01-24 22:15:55', 0, '0.00', 0, '410515168122674720', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-24 22:14:27', '2018-01-24 22:15:55'),
(76, 30, '', 0, 'New Company', '', '', '', '', '544D2047885675.jpg', '', '2018-01-24 22:18:58', '0000-00-00 00:00:00', 0, '0.00', 0, '114215168125387555', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-24 22:18:58', '0000-00-00 00:00:00'),
(77, 28, '', 0, 'New Company', '', '', '', '', '884E555842911.jpg', '', '2018-01-25 15:20:37', '2018-01-25 15:20:55', 0, '0.00', 0, '617515168738367776', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-25 15:20:37', '2018-01-25 15:20:55'),
(78, 28, '', 0, 'Test', '', '', '', '', '533X1389334113.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '40.00', 0, '954015168740156635', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:23:35', '0000-00-00 00:00:00'),
(79, 28, '', 0, 'Dasd', '', '', '', '', '489Y1772595146.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '40.00', 0, '807815168746837793', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:34:43', '0000-00-00 00:00:00'),
(80, 28, '', 0, 'Dasd', '', '', '', '', '259P600610208.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '40.00', 0, '552915168747962245', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:36:36', '0000-00-00 00:00:00'),
(81, 28, '', 0, 'Dasd', '', '', '', '', '188E732650667.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '40.00', 0, '502315168752855198', '', 4, 4, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:44:45', '0000-00-00 00:00:00'),
(82, 28, '', 0, 'Dasd', '', '', '', '', '734F406164556.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '40.00', 0, '615515168753268137', '', 4, 4, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:45:26', '0000-00-00 00:00:00'),
(83, 28, '', 0, 'Test', '', '', '', '', '891O53677172.jpg', '', '2018-01-10 10:30:00', '2018-01-10 10:40:00', 0, '50.00', 0, '659115168754754610', '', 4, 4, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:47:55', '0000-00-00 00:00:00'),
(84, 30, '', 0, 'Test', '', '', '', '', '687C89121702.jpg', '', '2018-01-09 10:40:00', '2018-01-09 09:20:00', 0, '50.00', 0, '899015168756709822', '', 5, 5, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:51:10', '0000-00-00 00:00:00'),
(85, 28, '', 0, 'New Company', '', '', '', '', '416J1416512769.jpg', '', '2018-01-16 10:50:00', '2018-01-16 03:00:00', 0, '0.00', 0, '750915168757869772', '', 5, 5, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-25 15:53:06', '0000-00-00 00:00:00'),
(86, 28, 'TEST', 0, 'Dsada', '', '', '', '601R134569962.jpg', '378W1135474302.jpg', '', '2018-01-29 11:34:40', '0000-00-00 00:00:00', 0, '0.00', 0, '257615172058797949', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-29 11:34:40', '0000-00-00 00:00:00'),
(87, 28, 'TEST', 0, 'Test', 'Asdas', 'DSAD', 'AF', '650B834042226.jpg', '877F1137090235.jpg', '', '2018-01-29 11:39:05', '0000-00-00 00:00:00', 0, '0.00', 0, '126515172061459491', '', 4, 0, 2, 0, 0, 2, 2, 1, 2, 2, 0, '2018-01-29 11:39:05', '0000-00-00 00:00:00'),
(88, 28, '', 0, 'New Company', '', '', '', '797Q6350883.jpg', '454L510088359.jpg', '', '2018-01-29 11:56:52', '2018-01-29 17:42:21', 0, '120.00', 346, '306915172072122502', '', 4, 5, 2, 7, 0, 1, 2, 1, 2, 2, 7, '2018-01-29 11:56:52', '2018-01-29 17:42:21'),
(89, 28, '', 0, 'Test', '', '', '', '225B215296079.jpg', '752I120706186.jpg', '', '2018-01-29 12:25:27', '0000-00-00 00:00:00', 0, '0.00', 0, '967215172089277955', '', 4, 0, 2, 0, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:25:27', '2018-01-29 12:28:47'),
(90, 28, 'DSAD', 0, 'Test', 'Dsad', 'ADSAD', 'ASDASDA', '187L1602822565.jpg', '784J1283824901.jpg', '', '2018-01-29 12:30:29', '2018-01-29 13:41:40', 0, '40.00', 0, '697615172092296110', '', 4, 5, 2, 2, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:30:29', '2018-01-29 13:41:40'),
(91, 28, 'VN1', 0, 'Test', 'Vn1', '', 'VN1', '787N702631997.jpg', '715J161545693.jpg', '', '2018-01-29 12:53:36', '0000-00-00 00:00:00', 0, '0.00', 0, '901915172106164597', '', 4, 0, 2, 0, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:53:36', '2018-01-29 12:53:45'),
(92, 28, 'VN2', 0, 'New Company', 'Vn2', '', 'VN2', '687W962264342.jpg', '933I1708464678.jpg', '', '2018-01-29 12:54:58', '0000-00-00 00:00:00', 0, '0.00', 0, '888915172106989232', '', 4, 0, 2, 0, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:54:58', '2018-01-29 12:55:02'),
(93, 28, 'VN2', 0, 'New Company', 'Vn2', '', 'VN2', '128Q1391278139.jpg', '225B1833791105.jpg', '', '2018-01-29 12:56:19', '0000-00-00 00:00:00', 0, '0.00', 0, '672415172107796958', '', 4, 0, 2, 0, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:56:19', '2018-01-29 12:56:21'),
(94, 28, 'VN2', 0, 'New Company', 'Vn2', '', 'VN2', '628F1829715143.jpg', '273U1089040460.jpg', '', '2018-01-29 12:56:32', '0000-00-00 00:00:00', 0, '0.00', 0, '819515172107924546', '', 4, 0, 2, 0, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:56:32', '2018-01-29 12:56:34'),
(95, 28, 'VN2', 0, 'New Company', 'Vn2', '', 'VN2', '872W1567957135.jpg', '260R2003115761.jpg', '', '2018-01-29 12:58:20', '2018-01-29 12:58:39', 0, '0.00', 0, '541015172109006820', '', 4, 5, 2, 2, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 12:58:20', '2018-01-29 12:58:39'),
(96, 28, 'SADSAD', 0, 'New Company', 'Dsadad', '', 'DSADA', '912H1307763464.jpg', '810W224009924.jpg', '', '2018-01-29 13:51:46', '2018-01-29 13:52:05', 0, '0.00', 1, '612615172141063128', '', 4, 5, 2, 2, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 13:51:46', '2018-01-29 14:07:39'),
(97, 28, 'VN5', 0, 'New Company', 'Vn5', '', 'VN5', '990Y1790747400.jpg', '736D1699084828.jpg', '', '2018-01-29 14:08:30', '2018-01-29 14:08:38', 0, '0.00', 1, '519615172151102883', '', 4, 5, 2, 2, 0, 2, 2, 1, 2, 2, 2, '2018-01-29 14:08:30', '2018-01-29 14:08:38'),
(98, 28, 'DSADA', 0, 'New Company', 'Asdsad', '', 'DASDSAD', '986V379569296.jpg', '347E1799443891.jpg', '', '2018-01-29 14:14:44', '0000-00-00 00:00:00', 0, '0.00', 0, '612715172154847710', '', 4, 0, 2, 0, 0, 1, 2, 1, 2, 2, 2, '2018-01-29 14:14:44', '2018-01-29 14:14:45');

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
  `total_vehicles_exited` int(11) NOT NULL,
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

INSERT INTO `k_report` (`id`, `user_id`, `cash_amount`, `card_amount`, `card_start_transaction_id`, `card_end_transaction_id`, `total_amount`, `gate_id`, `paid_to_admin`, `first_parking_id_time_after_login`, `last_parking_id_time_after_login`, `parking_id_from`, `parking_id_to`, `total_vehicles_exited`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 7, '0.00', '0.00', 0, 0, '0.00', 5, 1, '2018-01-22 20:56:38', '2018-01-22 20:56:38', 61, 61, 0, 1, 2, 7, 0, '2018-01-29 17:03:11', '0000-00-00 00:00:00'),
(2, 7, '0.00', '0.00', 0, 0, '120.00', 5, 1, '2018-01-29 17:42:21', '2018-01-29 17:42:21', 88, 88, 1, 1, 2, 7, 0, '2018-01-29 17:56:24', '0000-00-00 00:00:00');

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
  `shift_id` int(11) DEFAULT NULL,
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
(1, 'Super Admin', 'superadmin', 'superadmin@pms.com', '9014608228', '$2y$10$.vh0nF8hsjiKGms8sRC1fewLlj5JEyFBs.XqN94TvzQmyODcSWpgO', 1, 1, '2', '', 1, 1, 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Admin', 'admin', 'admin@mailinator.com', '9014608228', '$2y$10$F1dZNBVg21lyfpn55bDP/uU50uR1ZXZzNJos4uBCa0dVP2VDLOt7e', 2, 1, '2', '', 1, 1, 1, 2, 1, 2, '0000-00-00 00:00:00', '2018-01-09 14:17:25'),
(6, 'Employee1', 'employee1', 'employee1@mailinator.com', '9014608228', '$2y$10$KZWOZKPgxtHnqdXqpbqhMOWRRjiv86hCKZb6oQmsT5YUdfQD5koGC', 11, 1, 'govtid 1', '', 1, 1, 1, 2, 2, 2, '2018-01-22 13:14:44', '2018-01-22 15:21:17'),
(7, 'Employee2', 'employee2', 'employee2@mailinator.com', '9014608228', '$2y$10$KLHhjqtVyJxlN6nnAgzMeOn25dPkdaeMrnrYxZz/Hp1mt6dvJhUAq', 3, 1, '1235566282', '', 1, 7, 1, 2, 2, 2, '2018-01-22 13:16:00', '2018-01-22 15:21:02'),
(8, 'Employee 3', 'employee3', 'employee3@mailinator.com', '9014608228', '$2y$10$/q0DIgBAmHo.AzdiYJ6USug/d7WpKocUbC3uVIKjdIKS9km/KDon.', 3, 1, '1234567898', '', 1, 1, 1, 2, 2, 2, '2018-01-22 13:17:05', '2018-01-22 15:20:33'),
(9, 'Employee4', 'employee4', 'employee4@mailinator.com', '1234567981', '$2y$10$VfynNcyScW2qgCoky6eEH.r043SAT8RyVN/IBZBy37jqCrBmmMNt6', 3, 1, '1234567891', '', 1, 1, 1, 2, 2, 0, '2018-01-22 15:22:05', '0000-00-00 00:00:00'),
(11, 'Employee6', 'employee6', 'employee6@mail.com', '1234567891', '$2y$10$qLRtN.U9fKnh4H//HAz6QuYwdAZ1lHnpnCRQd4.16qOd11Qzq0FW2', 3, 11, 'employee6', '', 1, 8, 1, 2, 2, 2, '2018-01-29 18:32:15', '2018-01-29 18:37:34'),
(12, 'Employee8', 'employee8', 'employee8@mail.com', '1234567891', '$2y$10$aA5MnVbdlFLVDGgG.4j2EuOgeJfTWcvtbjKFfk.tTIxwzXNhbfAea', 3, 1, '12345678', '', 1, 8, 1, 2, 2, 2, '2018-01-29 18:40:00', '2018-01-29 18:40:58');

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
  `privileges` mediumblob NOT NULL,
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

INSERT INTO `k_user_role` (`id`, `name`, `privileges`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Super Admin', 0x613a313a7b693a31303b733a323a226f6e223b7d, 2, 1, 1, 2, '0000-00-00 00:00:00', '2018-01-16 16:23:10'),
(2, 'Admin', 0x613a32313a7b693a313b733a323a226f6e223b693a363b733a323a226f6e223b693a373b733a323a226f6e223b693a383b733a323a226f6e223b693a393b733a323a226f6e223b693a31303b733a323a226f6e223b693a31313b733a323a226f6e223b693a31333b733a323a226f6e223b693a31343b733a323a226f6e223b693a31393b733a323a226f6e223b693a32303b733a323a226f6e223b693a32323b733a323a226f6e223b693a32333b733a323a226f6e223b693a32343b733a323a226f6e223b693a32353b733a323a226f6e223b693a32373b733a323a226f6e223b693a32383b733a323a226f6e223b693a33323b733a323a226f6e223b693a33353b733a323a226f6e223b693a33363b733a323a226f6e223b693a33373b733a323a226f6e223b7d, 1, 2, 1, 2, '0000-00-00 00:00:00', '2018-01-25 14:27:50'),
(3, 'Employee Exit Role', 0x613a343a7b693a32353b733a323a226f6e223b693a32383b733a323a226f6e223b693a34333b733a323a226f6e223b693a34343b733a323a226f6e223b7d, 1, 2, 1, 2, '0000-00-00 00:00:00', '2018-01-29 17:00:27'),
(11, 'Employee Entry Role', 0x613a313a7b693a32333b733a323a226f6e223b7d, 1, 2, 2, 0, '2018-01-22 12:58:44', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `k_master_price_per_time`
--
ALTER TABLE `k_master_price_per_time`
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
-- AUTO_INCREMENT for table `k_master_device_registry`
--
ALTER TABLE `k_master_device_registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_master_government_proof_type`
--
ALTER TABLE `k_master_government_proof_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `k_master_price`
--
ALTER TABLE `k_master_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `k_master_price_per_time`
--
ALTER TABLE `k_master_price_per_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `k_master_user_company`
--
ALTER TABLE `k_master_user_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `k_master_user_shift`
--
ALTER TABLE `k_master_user_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `k_master_vehicle_company`
--
ALTER TABLE `k_master_vehicle_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `k_master_vehicle_gate`
--
ALTER TABLE `k_master_vehicle_gate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `k_master_vehicle_gate_employee`
--
ALTER TABLE `k_master_vehicle_gate_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `k_master_vehicle_type`
--
ALTER TABLE `k_master_vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `k_parking`
--
ALTER TABLE `k_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `k_printer`
--
ALTER TABLE `k_printer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_report`
--
ALTER TABLE `k_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `k_user`
--
ALTER TABLE `k_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `k_user_role`
--
ALTER TABLE `k_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
