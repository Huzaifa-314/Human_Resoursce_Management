-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 04:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `date`, `status`) VALUES
(46, 13, '2024-05-01', 'Present'),
(47, 14, '2024-05-01', 'Present'),
(48, 17, '2024-05-01', 'Present'),
(49, 28, '2024-05-01', 'Present'),
(50, 13, '2024-05-02', 'Present'),
(51, 14, '2024-05-02', 'Present'),
(52, 17, '2024-05-02', 'Present'),
(53, 28, '2024-05-02', 'Present'),
(54, 13, '2024-05-03', 'Present'),
(55, 14, '2024-05-03', 'Present'),
(56, 17, '2024-05-03', 'Present'),
(57, 28, '2024-05-03', 'Absent'),
(58, 13, '2024-05-04', 'Present'),
(59, 14, '2024-05-04', 'Present'),
(60, 17, '2024-05-04', 'Present'),
(61, 28, '2024-05-04', 'Present'),
(62, 13, '2024-05-05', 'Present'),
(63, 14, '2024-05-05', 'Present'),
(64, 17, '2024-05-05', 'Present'),
(65, 28, '2024-05-05', 'Absent'),
(66, 13, '2024-05-06', 'Present'),
(67, 14, '2024-05-06', 'Present'),
(68, 17, '2024-05-06', 'Present'),
(69, 28, '2024-05-06', 'Absent'),
(70, 13, '2024-05-07', 'Present'),
(71, 14, '2024-05-07', 'Present'),
(72, 17, '2024-05-07', 'Absent'),
(73, 28, '2024-05-07', 'Present'),
(74, 13, '2024-05-08', 'Present'),
(75, 14, '2024-05-08', 'Present'),
(76, 17, '2024-05-08', 'Present'),
(77, 28, '2024-05-08', 'Present'),
(78, 13, '2024-05-09', 'Present'),
(79, 14, '2024-05-09', 'Present'),
(80, 17, '2024-05-09', 'Present'),
(81, 28, '2024-05-09', 'Present'),
(82, 13, '2024-05-10', 'Present'),
(83, 14, '2024-05-10', 'Present'),
(84, 17, '2024-05-10', 'Present'),
(85, 28, '2024-05-10', 'Present'),
(86, 13, '2024-05-11', 'Present'),
(87, 14, '2024-05-11', 'Present'),
(88, 17, '2024-05-11', 'Present'),
(89, 28, '2024-05-11', 'Present'),
(90, 13, '2024-05-12', 'Present'),
(91, 14, '2024-05-12', 'Present'),
(92, 17, '2024-05-12', 'Present'),
(93, 28, '2024-05-12', 'Present'),
(94, 13, '2024-05-13', 'Present'),
(95, 14, '2024-05-13', 'Absent'),
(96, 17, '2024-05-13', 'Present'),
(97, 28, '2024-05-13', 'Present'),
(98, 13, '2024-05-14', 'Present'),
(99, 14, '2024-05-14', 'Present'),
(100, 17, '2024-05-14', 'Present'),
(101, 28, '2024-05-14', 'Present'),
(102, 13, '2024-05-16', 'Present'),
(103, 14, '2024-05-16', 'Present'),
(104, 17, '2024-05-16', 'Present'),
(105, 28, '2024-05-16', 'Present'),
(106, 13, '2024-05-17', 'Present'),
(107, 14, '2024-05-17', 'Present'),
(108, 17, '2024-05-17', 'Present'),
(109, 28, '2024-05-17', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Administration'),
(2, 'Employee Relations'),
(3, 'Health and safety'),
(4, 'Training and development');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `department_id`, `name`) VALUES
(32, 1, 'HR Administrator'),
(33, 2, 'HR Coordinator'),
(34, 2, 'Employee Relations Specialist'),
(35, 2, 'Mediator'),
(36, 4, 'Training Coordinator'),
(40, 4, 'Mentor');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `file`, `project_id`, `created_at`) VALUES
(12, 'Training Data', 'This files contains all the data of trainees', 'window.png', 4, '2024-05-15 02:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `subject`, `description`, `attachment`, `status`, `date`, `created_at`, `updated_at`) VALUES
(2, 17, 'Leave for next month', '<p>I am goin on a trip, next month. Its a family trip. I am considering having a 1 month paid leave. I am a great asset to the company, your are ought to follow and respect my decision.</p>', NULL, 'Rejected', '2024-06-01', '2024-05-13 12:35:47', '2024-05-13 12:37:33'),
(5, 29, 'Leave of Absence', '<p>I am going to a trip to india, i want next 1 week paid leave. thank you</p>', 'building-construction-worker-site-with-architect-1 (1).jpg', 'Pending', '2024-05-16', '2024-05-15 02:46:39', '2024-05-15 02:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ID` int(11) NOT NULL,
  `ProjectName` varchar(255) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ID`, `ProjectName`, `Status`, `Description`, `DepartmentID`, `DueDate`, `created_date`) VALUES
(1, 'Employee Training Program', 'In Progress', '<p><strong>Description</strong></p>\r\n<p>Developing a comprehensive training program for new hires</p>\r\n<table style=\"border-collapse: collapse; width: 100.035%;\" border=\"1\"><colgroup><col style=\"width: 49.9471%;\"><col style=\"width: 49.9471%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>Project Work list</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, '2024-07-15', '2024-05-08 10:21:32'),
(4, 'Diversity and Inclusion Training', 'In Progress', '<h1>Project Description:</h1>\r\n<hr>\r\n<p>A project for out client</p>\r\n<div style=\"max-width: 650px;\" data-ephox-embed-iri=\"https://grithrsolutions.com/\">\r\n<div class=\"ephox-summary-card\"><a class=\"ephox-summary-card-link-thumbnail\" href=\"https://grithrsolutions.com/\"> <img class=\"ephox-summary-card-thumbnail\" src=\"https://grithrsolutions.com/wp-content/uploads/2022/05/above-sec-pic-1024x779-1-1.png\"> </a> <a class=\"ephox-summary-card-link\" href=\"https://grithrsolutions.com/\"> <span class=\"ephox-summary-card-title\">About - GritHR</span> <span class=\"ephox-summary-card-description\">After spending years working for one of the country&rsquo;s largest payroll and HR outsourcing companies, the GritHR Solutions founder saw an</span> <span class=\"ephox-summary-card-website\">GritHR</span> </a></div>\r\n</div>\r\n<p>&nbsp;</p>', 4, '2024-08-11', '2024-05-08 10:21:32'),
(12, 'Intern Trainee', 'In Progress', '<p>fwewef</p>', 1, '2024-05-16', '2024-05-15 00:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `user_id`, `amount`, `payment_date`) VALUES
(1, 13, 20000.00, '2024-05-24'),
(8, 14, 20000.00, '0000-00-00'),
(9, 28, 14000.00, '0000-00-00'),
(10, 17, 30000.00, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `NID` varchar(30) NOT NULL,
  `desig_id` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `image`, `gender`, `dob`, `email`, `password`, `NID`, `desig_id`, `role`, `status`) VALUES
(13, 'Saima', 'Ritu', '', 'Female', '0000-00-00', 'Saima@gmail.com', 'Saima', '0', 32, 0, 0),
(14, 'tania', 'jerin', '', 'Female', NULL, 'taniajerin@gmail.com', 'qwert', '', 33, 1, 0),
(17, 'jabed', 'hasan', '6640aa1012eee6.70210664.png', 'Male', NULL, 'j@gmail.com', '123', '', 36, 1, 0),
(28, 'Muntasir', 'Fahim', '664218ebe6bd37.57675595.png', 'Male', '2024-05-16', 'f@gmail.com', '143d893e15d25fc535293bc04f939f6c', '', 32, 0, 0),
(29, 'faiza', 'faiza', '', 'Female', '2001-06-14', 'faiza@gmail.com', '143d893e15d25fc535293bc04f939f6c', '', 36, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_document` (`project_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DepartmentID` (`DepartmentID`),
  ADD KEY `ProjectName` (`ProjectName`) USING BTREE;

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_salary_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_user_attendance` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_document` FOREIGN KEY (`project_id`) REFERENCES `project` (`ID`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`id`);

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `fk_salary_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
