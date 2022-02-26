-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 11:45 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idd_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `FY` int(11) NOT NULL,
  `approved_budget` int(11) NOT NULL,
  `technical_sanction` varchar(1000) NOT NULL,
  `adms_fs` varchar(1000) NOT NULL,
  `nit` varchar(1000) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `mode_of_execution` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `activity_name`, `FY`, `approved_budget`, `technical_sanction`, `adms_fs`, `nit`, `created_date`, `user_id`, `mode_of_execution`) VALUES
(29, 'Construction of school structure  ', 2021, 800000, 'arms.xlsx', 'GThromde.JPG', 'header.PNG', '2021-09-06 04:56:12', 6, 'Departmental'),
(30, 'construction of urban corridor', 2021, 2500000, 'aup.xlsx', 'k.pdf', 'abc.pdf', '2021-09-06 04:56:20', 6, 'Contract'),
(31, 'abc company ', 0, 3000000, 'checklist.pdf', 'checklist.docx', 'online.pdf', '2021-09-06 04:56:27', 7, 'Departmental'),
(32, 'widening of road', 2021, 3500000, 'GovtNET-extension-BPC.pdf', 'Book1.xlsx', 'manual process.pdf', '2021-09-06 04:56:32', 7, 'Departmental'),
(33, 'installation of CCTV', 2021, 1500000, 'AW-1.csv', 'Public Notification.doc', 'db.zip', '2021-09-06 04:56:38', 6, 'Contract'),
(34, 'construction of Aipoli Bridge ', 2021, 5000000, 'Catering 2021-2022.pdf', 'Public Notification.doc', 'AUP.pdf', '2021-09-06 04:56:44', 6, 'Departmental'),
(35, 'Blacktopping of ISC roads', 2022, 1200000, 'Catering 2021-2022.pdf', 'Public Notification.doc', 'GovtNET-extension-BPC.pdf', '2021-09-06 04:46:05', 6, 'Contract'),
(36, 'testing', 2021, 2000, 'Catering 2021-2022.pdf', 'Public Notification.doc', 'GovtNET-extension-BPC.pdf', '2021-09-06 09:12:05', 6, 'Departmental');

-- --------------------------------------------------------

--
-- Table structure for table `advance`
--

CREATE TABLE `advance` (
  `id` int(11) NOT NULL,
  `mobilization_advance` int(11) NOT NULL,
  `mobilisation_advance_date` date NOT NULL,
  `material_advance` int(11) NOT NULL,
  `material_advance_date` date NOT NULL,
  `contract_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `advance`
--

INSERT INTO `advance` (`id`, `mobilization_advance`, `mobilisation_advance_date`, `material_advance`, `material_advance_date`, `contract_details_id`, `user_id`) VALUES
(15, 35000, '2021-09-02', 0, '0000-00-00', 20, 6),
(16, 10000, '2021-09-03', 0, '0000-00-00', 20, 6),
(17, 10000, '2021-09-10', 25000, '2021-09-10', 22, 7);

-- --------------------------------------------------------

--
-- Table structure for table `contract_details`
--

CREATE TABLE `contract_details` (
  `id` int(11) NOT NULL,
  `firm_name` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `contract_amount` int(11) NOT NULL,
  `loi` varchar(100) NOT NULL,
  `loa` varchar(100) NOT NULL,
  `work_order` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `contract_duration` varchar(100) NOT NULL,
  `time_extension` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_details`
--

INSERT INTO `contract_details` (`id`, `firm_name`, `contact_no`, `email_id`, `contract_amount`, `loi`, `loa`, `work_order`, `start_date`, `end_date`, `contract_duration`, `time_extension`, `user_id`, `activity_id`) VALUES
(20, 'abc', 123, 'abc@gmail.com', 1000000, 'Kemith-IWP.pdf', 'ams api.txt', 'Public Notification.doc', '2021-09-02', '2021-09-09', '1 week', 'Jungle clearance.docx', 6, 29),
(21, 'New Edge technology', 123444, 'new@edge.com', 1000000, 'Stakeholder Consultative MoM.pdf', '11.pdf', '12.pdf', '2021-09-02', '2022-09-02', '1 year', 'checklist.docx', 6, 30),
(22, 'Itechnologies, Thimphu', 123, 'itech@h.com', 30000, 'arms.xlsx', 'water.csv', 'Kemith-IWP.pdf', '2021-09-03', '2021-09-10', '4 months', 'online.pdf', 7, 31),
(23, 'NGN, gelephu', 12345, 'ngn@yahoo.com', 350000, '001.jpg', 'arms.xlsx', 'water.csv', '2021-09-03', '2021-09-24', '3 weeks', 'manual process.pdf', 7, 32);

-- --------------------------------------------------------

--
-- Table structure for table `masteroll`
--

CREATE TABLE `masteroll` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `no_of_labours` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masteroll`
--

INSERT INTO `masteroll` (`id`, `date`, `no_of_labours`, `rate`, `amount`, `remarks`, `user_id`, `activity_id`) VALUES
(1, '2021-09-03', 10, 2000, 20000, 'Done', 6, 33),
(5, '2021-09-04', 5, 1000, 5000, 'Issued', 6, 33);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `date`, `item`, `rate`, `quantity`, `amount`, `remarks`, `user_id`, `activity_id`) VALUES
(1, '2021-09-03', 'item1', 2000, 2, 5000, 'okay', 7, 32),
(2, '2021-09-04', 'hdpe pipe', 5000, 5, 25000, 'Issued', 7, 31),
(3, '2021-09-10', 'wire', 100, 10, 1000, 'Issued', 7, 31),
(4, '2021-09-03', '', 1000, 0, 10000, 'Done', 6, 33),
(5, '2021-09-06', 'sky jacker', 20000, 5, 100000, 'issued', 6, 36);

-- --------------------------------------------------------

--
-- Table structure for table `running_bill`
--

CREATE TABLE `running_bill` (
  `id` int(11) NOT NULL,
  `running_bill` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `tds` int(11) NOT NULL,
  `retention_money` int(11) NOT NULL,
  `mobilization_advance` int(11) NOT NULL,
  `material_advance` int(11) NOT NULL,
  `liquidity_damage` int(11) NOT NULL,
  `Net_payable` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contract_details_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `running_bill`
--

INSERT INTO `running_bill` (`id`, `running_bill`, `date`, `amount`, `tds`, `retention_money`, `mobilization_advance`, `material_advance`, `liquidity_damage`, `Net_payable`, `user_id`, `contract_details_id`) VALUES
(1, '1', '0000-00-00', 2000, 2000, 2000, 2000, 2000, 200, 20000, 6, 21),
(2, '2nd RA', '2021-09-04', 50000, 500, 20000, 129090, 20000, 500, 30000, 6, 21),
(3, '3rd RA', '2021-09-06', 3000, 300, 30000, 40000, 30000, 3000, 400000, 6, 21),
(10, '4th RA', '2021-09-10', 50000, 1000, 20000, 400, 3000, 10000, 5000, 6, 21),
(11, '5th RA', '2021-09-13', 200000, 1000, 2000, 129090, 21000, 500, 400000, 6, 21),
(12, '1st RA ', '2021-09-03', 200000, 1000, 20000, 40000, 21000, 500, 5000, 6, 20),
(13, '1st RA ', '2021-09-03', 51000, 1000, 15000, 40000, 3500, 4000, 400001, 7, 22),
(14, '2nd RA', '2021-09-10', 200000, 500, 30000, 40000, 3100, 2500, 700000, 7, 22),
(16, '1st RA ', '2021-09-03', 23000, 12, 123, 12345, 123, 344, 34554, 7, 23),
(17, '2nd RA', '2021-09-10', 423, 234, 343, 53544, 234234, 32434, 35345, 7, 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `emp_id`, `username`, `email_id`, `password`, `created_date`) VALUES
(6, 'kemith', 'kemith', 20190113041, 'kemith', 'kemith@gmail.com', '7dcb34527f7bc64419a38a1cdd7754c7', '2021-09-02 09:49:12'),
(7, 'karma', 'Dema', 20001, 'karma', 'karma@gmail.com', '320feace9cefcab73c6b9de1f4f13512', '2021-09-02 09:50:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `advance`
--
ALTER TABLE `advance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advance_ibfk_1` (`user_id`),
  ADD KEY `contract_details_id` (`contract_details_id`);

--
-- Indexes for table `contract_details`
--
ALTER TABLE `contract_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `contract_details_ibfk_1` (`activity_id`);

--
-- Indexes for table `masteroll`
--
ALTER TABLE `masteroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `masteroll_ibfk_1` (`activity_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_ibfk_1` (`activity_id`);

--
-- Indexes for table `running_bill`
--
ALTER TABLE `running_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `running_bill_ibfk_1` (`contract_details_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `advance`
--
ALTER TABLE `advance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `contract_details`
--
ALTER TABLE `contract_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `masteroll`
--
ALTER TABLE `masteroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `running_bill`
--
ALTER TABLE `running_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `advance`
--
ALTER TABLE `advance`
  ADD CONSTRAINT `advance_ibfk_1` FOREIGN KEY (`contract_details_id`) REFERENCES `contract_details` (`id`);

--
-- Constraints for table `contract_details`
--
ALTER TABLE `contract_details`
  ADD CONSTRAINT `contract_details_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

--
-- Constraints for table `masteroll`
--
ALTER TABLE `masteroll`
  ADD CONSTRAINT `masteroll_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

--
-- Constraints for table `running_bill`
--
ALTER TABLE `running_bill`
  ADD CONSTRAINT `running_bill_ibfk_1` FOREIGN KEY (`contract_details_id`) REFERENCES `contract_details` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
