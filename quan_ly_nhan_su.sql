-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 04:31 PM
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
-- Database: `quan_ly_nhan_su`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `position`, `salary`, `hire_date`) VALUES
(2, 'Trần Thị B', 'b.tran@example.com', '0987654321', 'Kỹ sư phần mềm', 12000000.00, '2019-03-22'),
(3, 'Lê Văn C', 'c.le@example.com', '0912345678', 'Nhân viên bán hàng', 10000000.00, '2021-07-10'),
(4, 'Phạm Thị D', 'd.pham@example.com', '0934567890', 'Chuyên viên marketing', 13000000.00, '2022-05-05'),
(5, 'Hoàng Văn E', 'e.hoang@example.com', '0945678901', 'Kế toán', 11000000.00, '2018-11-30'),
(6, 'Nguyễn Thị F', 'f.nguyen@example.com', '0956789012', 'Nhân viên hành chính', 9000000.00, '2023-02-20'),
(13, 'John Doe', 'john.doe@mail.com', '123456789', 'ITer', 5000000.00, '2024-11-09'),
(19, 'John Doom', 'john.doom@example.com', '555-0101', 'Software Engineer', 70000.00, '2023-01-15'),
(20, 'Jane Smith', 'jane.smith@example.com', '555-0102', 'Project Manager', 80000.00, '2022-03-22'),
(21, 'Alice Johnson', 'alice.johnson@example.com', '555-0103', 'UX Designer', 65000.00, '2021-07-30'),
(22, 'Bob Brown', 'bob.brown@example.com', '555-0104', 'Data Analyst', 60000.00, '2020-11-05'),
(23, 'Charlie White', 'charlie.white@example.com', '555-0105', 'DevOps Engineer', 75000.00, '2023-05-12'),
(24, 'Diana Green', 'diana.green@example.com', '555-0106', 'HR Specialist', 55000.00, '2022-09-18'),
(25, 'Ethan Black', 'ethan.black@example.com', '555-0107', 'Marketing Coordinator', 58000.00, '2023-04-25'),
(26, 'Fiona Blue', 'fiona.blue@example.com', '555-0108', 'Sales Associate', 52000.00, '2021-12-10'),
(27, 'George Red', 'george.red@example.com', '555-0109', 'Product Owner', 72000.00, '2022-06-15'),
(28, 'Hannah Yellow', 'hannah.yellow@example.com', '555-0110', 'Customer Support Rep', 48000.00, '2023-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
