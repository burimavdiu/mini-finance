-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2017 at 08:53 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minifinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `contact_person` varchar(30) NOT NULL,
  `job_position` varchar(30) NOT NULL,
  `address_1` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `tel_no` varchar(20) NOT NULL,
  `client_email` varchar(30) NOT NULL,
  `client_web` varchar(40) DEFAULT NULL,
  `business_register_no` varchar(30) NOT NULL,
  `fiscal_no` varchar(30) NOT NULL,
  `vat_no` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date NOT NULL,
  `client` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `contact_person`, `job_position`, `address_1`, `city`, `state`, `mobile_no`, `tel_no`, `client_email`, `client_web`, `business_register_no`, `fiscal_no`, `vat_no`, `user_id`, `registration_date`, `client`) VALUES
(0, 'person', 'pozita', ' Adresa', 'qyteti', 'shteti', 'pozita', 'pozita', 'user@hotmail.com', 'https://www.google.com', '12345', '123', 12, 8, '2017-12-30', 'Klient');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `compay_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `address_1` varchar(30) NOT NULL,
  `address_2` varchar(30) NOT NULL,
  `tel_no` varchar(20) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `fax_no` varchar(30) NOT NULL,
  `business_no` varchar(30) NOT NULL,
  `vat` tinyint(4) NOT NULL,
  `fiscal_no` varchar(20) NOT NULL,
  `bank_acc_1` varchar(30) NOT NULL,
  `bank_acc_2` varchar(30) NOT NULL,
  `company_email` varchar(40) NOT NULL,
  `company_web` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dep_id`, `dep_name`) VALUES
(1, 'I shitjeve'),
(2, 'marketingut');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sale_type` varchar(30) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_ref` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sale_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `service_description` text NOT NULL,
  `actual_price` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `password`, `dep_id`, `email`, `username`, `phone`, `reg_id`) VALUES
(8, 'Florent', 'Imeri', '123', 1, 'florentimeri@gmail.com', 'florentimeri', '044/263-053', 1),
(9, 'Edi', 'Gashi', '342', 1, 'edi.gashi@yahoo.com', 'edigashi', '044/123-345', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`compay_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `dep_id` (`dep_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `dep_id` (`dep_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `compay_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
