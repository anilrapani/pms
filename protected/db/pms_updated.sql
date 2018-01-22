-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2018 at 09:57 AM
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
(12, '2 Wheeler', 0, '0.00', 1, 2, 2, 2, '2018-01-22 13:01:04', '2018-01-22 13:07:11'),
(13, '3 Wheeler', 0, '0.00', 1, 2, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(14, '4 Wheeler', 0, '0.00', 1, 2, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00');

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
(2, 0, 45, '0.00', 13, 1, 2, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(3, 45, 60, '10.00', 13, 1, 2, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(4, 60, 120, '20.00', 13, 1, 2, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(5, 120, 240, '30.00', 13, 1, 2, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(6, 240, 360, '40.00', 13, 1, 2, 2, 0, '2018-01-22 13:06:02', '0000-00-00 00:00:00'),
(7, 0, 45, '0.00', 14, 1, 2, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(8, 45, 60, '10.00', 14, 1, 2, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(9, 60, 120, '20.00', 14, 1, 2, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(10, 120, 240, '30.00', 14, 1, 2, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(11, 240, 360, '40.00', 14, 1, 2, 2, 0, '2018-01-22 13:07:04', '0000-00-00 00:00:00'),
(12, 0, 45, '0.00', 12, 1, 2, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(13, 45, 60, '10.00', 12, 1, 2, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(14, 60, 120, '20.00', 12, 1, 2, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(15, 120, 240, '30.00', 12, 1, 2, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00'),
(16, 240, 360, '40.00', 12, 1, 2, 2, 0, '2018-01-22 13:07:11', '0000-00-00 00:00:00');

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
(1, 'Menzies Aviation Bobba (B\'lor) Pvt Ltd', '1234567891', 'fsdfsd1117@dasda.com', 'Gachibowli, Hyderabad', 1, 2, 2, 2, '0000-00-00 00:00:00', '2018-01-22 10:03:54');

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
(4, 'Cargo Terminal 1', 1, 1, 2, 2, 2, '2017-12-22 17:41:22', '2018-01-22 13:27:47'),
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
(27, 2, '2 Wheeler', 12, 1, 2, 2, 0, '2018-01-22 13:08:02', '0000-00-00 00:00:00'),
(28, 3, '3 Wheeler', 13, 1, 2, 2, 0, '2018-01-22 13:08:19', '0000-00-00 00:00:00'),
(29, 4, '4 Wheeler', 14, 1, 2, 2, 0, '2018-01-22 13:08:30', '0000-00-00 00:00:00');

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
(6, 'Employee1', '', 'employee1@mailinator.com', '9014608228', '$2y$10$rCZJXjPpduqYUUI7F.10KuCDFAPcgIup6aqrIqZFuZISQT9dPZYHy', 11, 1, 'govtid 1', '', 1, 1, 1, 2, 2, 0, '2018-01-22 13:14:44', '0000-00-00 00:00:00'),
(7, 'Employee2', '', 'employee2@mailinator.com', '9014608228', '$2y$10$rEAw7kGqos/qfs0L27KAt..lkJP.gz/L/.HObO48NKFslcbCf4Rey', 3, 1, '1235566282', '', 1, 7, 1, 2, 2, 0, '2018-01-22 13:16:00', '0000-00-00 00:00:00'),
(8, 'Employee 3', '', 'employee3@mailinator.com', '9014608228', '$2y$10$.Zc0iFlO/BVy7sOY9xhGPe7xV56qxErwawe/Aex1cASaPsJucbPuq', 3, 1, '1234567898', '', 1, 1, 1, 2, 2, 0, '2018-01-22 13:17:05', '0000-00-00 00:00:00');

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
(2, 'Admin', 0x613a32303a7b693a313b733a323a226f6e223b693a363b733a323a226f6e223b693a373b733a323a226f6e223b693a383b733a323a226f6e223b693a393b733a323a226f6e223b693a31303b733a323a226f6e223b693a31313b733a323a226f6e223b693a31333b733a323a226f6e223b693a31343b733a323a226f6e223b693a31393b733a323a226f6e223b693a32303b733a323a226f6e223b693a32323b733a323a226f6e223b693a32333b733a323a226f6e223b693a32343b733a323a226f6e223b693a32353b733a323a226f6e223b693a32373b733a323a226f6e223b693a33323b733a323a226f6e223b693a33353b733a323a226f6e223b693a33363b733a323a226f6e223b693a33373b733a323a226f6e223b7d, 1, 2, 1, 2, '0000-00-00 00:00:00', '2018-01-22 13:32:05'),
(3, 'Employee Exit Role', 0x613a313a7b693a32353b733a323a226f6e223b7d, 1, 2, 1, 2, '0000-00-00 00:00:00', '2018-01-22 12:58:33'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `k_master_government_proof_type`
--
ALTER TABLE `k_master_government_proof_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `k_master_price`
--
ALTER TABLE `k_master_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `k_master_price_per_time`
--
ALTER TABLE `k_master_price_per_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `k_master_user_company`
--
ALTER TABLE `k_master_user_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `k_master_user_shift`
--
ALTER TABLE `k_master_user_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `k_master_vehicle_company`
--
ALTER TABLE `k_master_vehicle_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `k_master_vehicle_gate`
--
ALTER TABLE `k_master_vehicle_gate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `k_master_vehicle_gate_employee`
--
ALTER TABLE `k_master_vehicle_gate_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `k_master_vehicle_type`
--
ALTER TABLE `k_master_vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `k_parking`
--
ALTER TABLE `k_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `k_printer`
--
ALTER TABLE `k_printer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_report`
--
ALTER TABLE `k_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `k_user`
--
ALTER TABLE `k_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
