-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 12:18 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_repair`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `status`) VALUES
(1, 'DELL', 'Y'),
(2, 'NO Brand', 'Y'),
(3, 'HP', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `inventory` varchar(50) DEFAULT NULL,
  `start` datetime(3) DEFAULT NULL,
  `end` datetime(3) DEFAULT NULL,
  `link_url` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `inventory`, `start`, `end`, `link_url`, `color`, `type`) VALUES
(1, 'บำรุงรักษาตามแผน', '1', '2020-02-06 00:00:00.000', '2020-02-06 00:00:00.000', NULL, '#DC143C', 'PM'),
(2, 'บำรุงรักษาตามแผน', '1', '2020-02-19 00:00:00.000', '2020-02-19 00:00:00.000', NULL, '#00FFFF', 'PM'),
(3, 'บำรุงรักษาตามแผน', '1', '2020-02-02 00:00:00.000', '2020-02-02 00:00:00.000', NULL, '#5F9EA0', 'PM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `updated_at`, `created_date`) VALUES
(1, 'conputer', 'Y', NULL, NULL),
(2, 'notebook', 'Y', NULL, NULL),
(3, 'Software', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `owner_name` varchar(200) DEFAULT NULL,
  `serial_number` varchar(200) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `section` varchar(200) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `inven_status` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `expire_date` varchar(50) DEFAULT NULL,
  `os_name` varchar(50) DEFAULT NULL,
  `cpu_model` varchar(50) DEFAULT NULL,
  `ram_model` varchar(50) DEFAULT NULL,
  `hdd_model` varchar(50) DEFAULT NULL,
  `monitor_model` varchar(50) DEFAULT NULL,
  `pm_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `owner_name`, `serial_number`, `category`, `section`, `type`, `brand`, `photo`, `inven_status`, `updated_at`, `created_at`, `expire_date`, `os_name`, `cpu_model`, `ram_model`, `hdd_model`, `monitor_model`, `pm_day`) VALUES
(1, 'COM-IT-001', 'IT', '', '2', '1', '1', '1', '1581316608_26.png', '1', NULL, NULL, '', 'win10', '5.3', '4GB', '500GB', '19\"', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `osname`
--

CREATE TABLE `osname` (
  `os_id` varchar(50) NOT NULL,
  `os_name` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `osname`
--

INSERT INTO `osname` (`os_id`, `os_name`, `status`) VALUES
('nonos', '-', 'Y'),
('win10', 'Windows 10', 'Y'),
('win2003', 'Windows Server 2003', 'Y'),
('win7', 'Windows 7', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `per_id` int(11) NOT NULL,
  `per_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`per_id`, `per_name`) VALUES
(1, 'Administrator'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `preventive`
--

CREATE TABLE `preventive` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `preventive`
--

INSERT INTO `preventive` (`id`, `name`, `status`) VALUES
(1, 'งานซ่อมประจำวัน', 'Y'),
(2, 'บำรุงรักษาตามแผน', 'Y'),
(3, 'งานซ่อมประจำวัน', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cate_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `name`, `status`, `cate_id`) VALUES
(1, 'เครื่องเปิดไม่ติด', 'Y', '1'),
(2, 'ใช้งาน Internet ไม่ได้', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `problem` varchar(200) DEFAULT NULL,
  `repairer` varchar(200) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `doc_date` date DEFAULT NULL,
  `doc_status` varchar(50) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`id`, `type`, `inventory_id`, `problem`, `repairer`, `title`, `description`, `user_id`, `updated_at`, `created_at`, `user_name`, `doc_date`, `doc_status`, `photo`) VALUES
(1, NULL, 1, '1', 'lชาย', NULL, 'ดกเดกเ', NULL, '2020-02-10 13:43:50', '2020-02-10 13:43:50', NULL, '2020-02-10', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_detail`
--

CREATE TABLE `repair_detail` (
  `id` int(11) NOT NULL,
  `repair_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `per_name` varchar(200) DEFAULT NULL,
  `amount` int(11) DEFAULT 0,
  `breakdown` int(11) DEFAULT 0,
  `inventory_id` varchar(50) DEFAULT NULL,
  `doc_date` date DEFAULT NULL,
  `problem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `repair_detail`
--

INSERT INTO `repair_detail` (`id`, `repair_id`, `status_id`, `note`, `user_name`, `updated_at`, `created_at`, `per_name`, `amount`, `breakdown`, `inventory_id`, `doc_date`, `problem_id`) VALUES
(1, 1, 3, NULL, NULL, '2020-02-10 13:43:50', '2020-02-10 13:43:50', NULL, 0, 0, '1', '2020-02-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'IT', 'Y', NULL, NULL),
(2, 'MK', 'Y', NULL, NULL),
(3, 'EG', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `row_index` int(11) NOT NULL,
  `docdate` date DEFAULT NULL,
  `inven_id` int(11) DEFAULT NULL,
  `borrow_name` varchar(200) DEFAULT NULL,
  `sec_id` int(11) DEFAULT NULL,
  `type_name` char(10) DEFAULT NULL,
  `type_in` int(11) DEFAULT NULL,
  `type_out` int(11) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  `doc_refer` char(10) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `create_date_time` datetime(3) DEFAULT NULL,
  `due_date` varchar(50) DEFAULT NULL,
  `row_refer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`row_index`, `docdate`, `inven_id`, `borrow_name`, `sec_id`, `type_name`, `type_in`, `type_out`, `remark`, `doc_refer`, `tel`, `create_date_time`, `due_date`, `row_refer`) VALUES
(1, '2020-02-18', 1, 'gfhgh', 1, 'ISSUE', 1, 0, 'gfhfgh', '', '', '2020-02-18 17:04:12.000', '', 1),
(2, '2020-02-18', 1, NULL, 1, 'REC', 0, 1, '', '', '', '2020-02-18 17:04:15.000', '', 1),
(3, '2020-02-28', 1, 'เอกชัย55', 2, 'ISSUE', 1, 0, '', '', '9999999999', '2020-02-28 11:30:57.000', '', 3),
(4, '2020-02-28', 1, 'เอกชัย55', 2, 'ISSUE', 1, 0, '', '', '9999999999', '2020-02-28 11:31:49.000', '', 4),
(5, '2020-02-28', 1, 'เอกชัย55', 2, 'ISSUE', 1, 0, '', '', '9999999999', '2020-02-28 11:32:19.000', '', 5),
(6, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:33:11.000', '', 6),
(7, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:35:29.000', '', 7),
(8, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:37:01.000', '', 8),
(9, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:37:41.000', '', 9),
(10, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:38:12.000', '', 10),
(11, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:39:37.000', '', 11),
(12, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:40:19.000', '', 12),
(13, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:44:46.000', '', 13),
(14, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:45:09.000', '', 14),
(15, '2020-02-28', 1, 'asdasd', 1, 'ISSUE', 1, 0, '', '', 'sadasdasd', '2020-02-28 11:46:11.000', '', 15),
(16, '2020-02-28', 1, 'fdgdfg', 1, 'ISSUE', 1, 0, '', '', '', '2020-02-28 11:46:22.000', '', 16),
(17, '2020-02-28', 1, 'dfgfg', 2, 'ISSUE', 1, 0, '', '', '', '2020-02-28 11:46:40.000', '', 17),
(18, '2020-02-28', 1, 'sadsd', 1, 'ISSUE', 1, 0, '', '', 'sss', '2020-02-28 11:47:52.000', '', 18),
(19, '2020-02-28', 1, '99999999999', 3, 'ISSUE', 1, 0, '', '', '99999999999', '2020-02-28 11:48:13.000', '', 19),
(20, '2020-02-28', 1, NULL, 2, 'REC', 0, 1, '', '', '', '2020-02-28 11:49:22.000', '', 3),
(21, '2020-02-28', 1, NULL, 2, 'REC', 0, 1, '', '', '', '2020-02-28 11:51:55.000', '', 3),
(22, '2020-02-28', 1, NULL, 2, 'REC', 0, 1, '', '', '', '2020-02-28 11:51:59.000', '', 3),
(23, '2020-02-28', 1, NULL, 2, 'REC', 0, 1, '', '', '', '2020-02-28 11:52:41.000', '', 3),
(24, '2020-02-28', 1, 'fff', 1, 'ISSUE', 1, 0, '99999999999999', '', '999999999999', '2020-02-28 12:05:10.000', '', 24),
(25, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:06:15.000', '', 13),
(26, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:07:27.000', '', 13),
(27, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:08:08.000', '', 13),
(28, '2020-02-28', 1, 'เอกชัย55', 2, 'REC', 0, 1, '', '', '', '2020-02-28 12:08:18.000', '', 4),
(29, '2020-02-28', 1, 'เอกชัย55', 2, 'REC', 0, 1, '', '', '', '2020-02-28 12:08:59.000', '', 5),
(30, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:09:07.000', '', 6),
(31, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:10:08.000', '', 7),
(32, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:10:16.000', '', 8),
(33, '2020-02-28', 1, '99999999999', 3, 'REC', 0, 1, '', '', '', '2020-02-28 12:11:57.000', '', 19),
(34, '2020-02-28', 1, 'fff', 1, 'REC', 0, 1, '99999999999999', '', '', '2020-02-28 12:12:08.000', '', 24),
(35, '2020-02-28', 1, 'sadsd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:12:16.000', '2020-02-16', 18),
(36, '2020-02-28', 1, 'fdgdfg', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:12:25.000', '2020-02-14', 16),
(37, '2020-02-28', 1, 'dfgfg', 2, 'REC', 0, 1, '', '', '', '2020-02-28 12:13:54.000', '2020-02-16', 17),
(38, '2020-02-28', 1, 'asdasd', 1, 'REC', 0, 1, '', '', '', '2020-02-28 12:15:10.000', '2020-02-15', 15),
(39, '2020-02-28', 1, 'สมชาย', 1, 'REC', 0, 1, '', '', '088888888', '2020-02-28 12:16:32.000', '2020-02-16', 14),
(40, '2020-02-28', 1, 'ขจร', 2, 'ISSUE', 1, 0, 'ไปบางนา', '', '9999999999', '2020-02-28 12:17:06.000', '', 40);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'ปกติ'),
(2, 'จำหน่าย'),
(3, 'รอซ่อม'),
(4, 'หมดอายุ'),
(5, 'อยู่ระหว่างซ่อม'),
(6, 'ซ่อมเสร็จ'),
(7, 'เข้า Internetไม่ได้');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `line_token` varchar(50) NOT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `title`, `name`, `line_token`, `updated_at`, `created_at`) VALUES
(1, 'IT CARE', 'IT CARE', '7jU2vvt9FNhXT01D2qS1ZmRjexX1Vh8FY3JjahjToVj', '2019-12-26 19:05:49', '2019-12-26 19:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'CPU i7', 'Y', NULL, NULL),
(2, 'CPU i3', 'Y', NULL, NULL),
(3, 'CPU i5', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birthdate` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `profile` varchar(50) DEFAULT NULL,
  `permission` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `email`, `phone_number`, `profile`, `permission`, `status`, `updated_at`, `created_at`) VALUES
(1, 'admin', '$2y$10$QlDBfJ1.weyu9xKbIm26NuTf.6wF2wzND19MApb1AqjWoXG0xGviW', 'เอกชัย', 'พิจารณ์', 'M', '1978-06-06', 'akachai1526@hotmail.com', '0898918431', '1579776113_26.jpg', '1', 'Y', 'Dec 27 2019  4:28AM', 'Dec 27 2019  4:28AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `osname`
--
ALTER TABLE `osname`
  ADD PRIMARY KEY (`os_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `preventive`
--
ALTER TABLE `preventive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`row_index`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `preventive`
--
ALTER TABLE `preventive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `repair_detail`
--
ALTER TABLE `repair_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `row_index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
