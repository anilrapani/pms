-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 06:57 PM
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
(1, 'Pan Card', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Driving License', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_prices`
--

CREATE TABLE `k_master_prices` (
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

INSERT INTO `k_master_user_company` (`id`, `name`, `phone`, `address`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Kastech', '1234567891', 'Gachibowli, Hyderabad', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Google1', '9874561231', 'madhapur', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Google2', '9876543221', 'madhapur', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Google4', '', '', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Google5', '', '', 1, 2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'google6', '', '', 1, 2, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_user_shifts`
--

CREATE TABLE `k_master_user_shifts` (
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
-- Dumping data for table `k_master_user_shifts`
--

INSERT INTO `k_master_user_shifts` (`id`, `name`, `start_time`, `end_time`, `status`, `deleted`, `created_by`, `updated_by`, `created_time`, `updated_time`) VALUES
(1, 'Super Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Employee', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_master_vehicle_company`
--

CREATE TABLE `k_master_vehicle_company` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active, 2-inactive',
  `deleted` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-deleted, 2-not deleted ',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `k_parking`
--

CREATE TABLE `k_parking` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `vehicle_company_id` int(11) NOT NULL,
  `driver_name` varchar(150) NOT NULL,
  `driving_license_number` int(50) NOT NULL,
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
(2, 'Admin', 'admin', 'admin@pms.com', '9014608228', '$2y$10$.vh0nF8hsjiKGms8sRC1fewLlj5JEyFBs.XqN94TvzQmyODcSWpgO', 2, 1, '2', '', 1, 2, 1, 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `k_user_logs`
--

CREATE TABLE `k_user_logs` (
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
-- Indexes for table `k_master_prices`
--
ALTER TABLE `k_master_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_user_company`
--
ALTER TABLE `k_master_user_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_master_user_shifts`
--
ALTER TABLE `k_master_user_shifts`
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
  ADD KEY `FK_vehicle_type_id` (`vehicle_type_id`),
  ADD KEY `FK_vehicle_company_id` (`vehicle_company_id`),
  ADD KEY `FK_master_prices_id` (`master_prices_id`),
  ADD KEY `FK_created_by` (`created_by`);

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
-- Indexes for table `k_user_logs`
--
ALTER TABLE `k_user_logs`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `k_master_prices`
--
ALTER TABLE `k_master_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_master_user_company`
--
ALTER TABLE `k_master_user_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `k_master_user_shifts`
--
ALTER TABLE `k_master_user_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `k_master_vehicle_company`
--
ALTER TABLE `k_master_vehicle_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_master_vehicle_type`
--
ALTER TABLE `k_master_vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_printer`
--
ALTER TABLE `k_printer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_user`
--
ALTER TABLE `k_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `k_user_role`
--
ALTER TABLE `k_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `k_parking`
--
ALTER TABLE `k_parking`
  ADD CONSTRAINT `FK_created_by` FOREIGN KEY (`created_by`) REFERENCES `k_user` (`id`),
  ADD CONSTRAINT `FK_master_prices_id` FOREIGN KEY (`master_prices_id`) REFERENCES `k_master_prices` (`id`),
  ADD CONSTRAINT `FK_vehicle_company_id` FOREIGN KEY (`vehicle_company_id`) REFERENCES `k_master_vehicle_company` (`id`),
  ADD CONSTRAINT `FK_vehicle_type_id` FOREIGN KEY (`vehicle_type_id`) REFERENCES `k_master_vehicle_type` (`id`);

--
-- Constraints for table `k_user`
--
ALTER TABLE `k_user`
  ADD CONSTRAINT `FK_government_proof_type_id` FOREIGN KEY (`government_proof_type_id`) REFERENCES `k_master_government_proof_type` (`id`),
  ADD CONSTRAINT `FK_k_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `k_user_role` (`id`),
  ADD CONSTRAINT `FK_shift_id` FOREIGN KEY (`shift_id`) REFERENCES `k_master_user_shifts` (`id`),
  ADD CONSTRAINT `FK_user_company_id` FOREIGN KEY (`user_company_id`) REFERENCES `k_master_user_company` (`id`);

--
-- Constraints for table `k_user_logs`
--
ALTER TABLE `k_user_logs`
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `k_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
