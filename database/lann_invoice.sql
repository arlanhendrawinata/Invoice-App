-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 01:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lann_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_phone` char(15) NOT NULL,
  `company_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_email`, `client_phone`, `company_name`) VALUES
(1, 'arlan', 'arlanmdg03@gmail.com', '085961542802', 'lann.'),
(2, 'Rana Martina', 'rana@gmail.com', '082023423', 'Rana Shop'),
(3, 'Yusa Nusanggara', 'yusa@gmail.com', '0812574834', 'Yusa');

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `domain_id` int(11) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `domain_annual` int(11) NOT NULL,
  `domain_extension` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`domain_id`, `domain_name`, `domain_annual`, `domain_extension`) VALUES
(1, '.com', 100000, 150000),
(2, '.my.id', 10500, 11000),
(3, '.co.id', 280000, 280000),
(4, '.online', 470000, 470000),
(5, '.net', 136000, 165000);

-- --------------------------------------------------------

--
-- Table structure for table `hosting`
--

CREATE TABLE `hosting` (
  `hosting_id` int(11) NOT NULL,
  `hosting_name` varchar(255) NOT NULL,
  `hosting_annual` int(11) NOT NULL,
  `hosting_extension` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hosting`
--

INSERT INTO `hosting` (`hosting_id`, `hosting_name`, `hosting_annual`, `hosting_extension`) VALUES
(1, 'Hosting Small', 200000, 250000),
(2, 'Hosting Medium', 340000, 340000),
(3, 'Hosting Large', 500000, 500000),
(4, 'Hosting Super', 720000, 720000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_code` bigint(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `hosting_id` int(11) NOT NULL,
  `invoice_paid` int(11) NOT NULL,
  `invoice_total` int(11) NOT NULL,
  `invoice_status` varchar(10) NOT NULL,
  `invoice_datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_code`, `client_id`, `services_id`, `domain_id`, `hosting_id`, `invoice_paid`, `invoice_total`, `invoice_status`, `invoice_datetime`) VALUES
(4, 20220205001, 1, 1, 1, 1, 0, 0, 'unpaid', 124726),
(5, 20220205002, 1, 1, 1, 1, 0, 0, 'unpaid', 20220104),
(6, 20220205006, 2, 3, 1, 2, 200000, 0, 'Unpaid', 20220205),
(7, 20220205007, 3, 2, 2, 1, 100000, 0, 'unpaid', 20220205);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `services_name` varchar(255) NOT NULL,
  `services_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `services_name`, `services_price`) VALUES
(1, 'Website - Company Profile', 300000),
(2, 'Website - Personal', 250000),
(3, 'Website - eCommerce', 1000000),
(4, 'Website - News', 700000),
(5, 'Website - Blog', 500000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`domain_id`);

--
-- Indexes for table `hosting`
--
ALTER TABLE `hosting`
  ADD PRIMARY KEY (`hosting_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `services_id` (`services_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `domain_id` (`domain_id`),
  ADD KEY `hosting_id` (`hosting_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hosting`
--
ALTER TABLE `hosting`
  MODIFY `hosting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`services_id`) REFERENCES `services` (`services_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`domain_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_4` FOREIGN KEY (`hosting_id`) REFERENCES `hosting` (`hosting_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
