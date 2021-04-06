-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 08:50 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_punote`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_filename` varchar(255) NOT NULL,
  `faculty` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `user` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_name`) VALUES
(1, 'Management Studies'),
(2, 'Health Science'),
(3, 'Science and Technology'),
(4, 'Humanities and Social Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `fact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `program_name`, `fact_id`) VALUES
(1, 'Bachelor of Business Administration', 1),
(2, 'Bachelor of Business Administration–Banking and Insurance', 1),
(4, 'Bachelor of Business Administration-Travel and Tourism', 1),
(5, 'Bachelor of Computer Information System', 1),
(6, 'Bachelor of Hotel Management', 1),
(7, 'Bachelor in Health Care Management', 1),
(8, 'Post Graduate Diploma in Health Care Management', 1),
(19, 'Bachelor of Pharmaceutical Science', 2),
(20, 'Bachelor of Science in Medical Laboratory Technology', 2),
(21, 'Bachelor of Public Health', 2),
(22, 'Bachelor of Science in Nursing', 2),
(23, 'Bachelor of Science in Biochemistry', 2),
(24, 'Bachelor of Science in Medical Microbiology', 2),
(25, 'Bachelor of Science in Medical Biochemistry', 2),
(26, 'Bachelor of Physiotherapy', 2),
(27, 'Bachelor of Optometry', 2),
(28, 'Bachelor of Nursing in Science (Oncology)', 2),
(29, 'Bachelor of Engineering in Information Technology', 3),
(30, 'Bachelor of Architecture', 3),
(31, 'Bachelor of civil Engineering', 3),
(32, 'Bachelor of Software Engineering', 3),
(33, 'Bachelor of Computer Engineering', 3),
(34, 'Bachelor of Electronics and Communication Engineering', 3),
(35, 'Bachelor of Civil & Rural Engineering', 3),
(36, 'Bachelor of Civil Engineering for Diploma Holders', 3),
(37, 'Bachelor of Electrical and Electronics Engineering', 3),
(38, 'Bachelor of Science in Environmental Management', 3),
(39, 'Bachelor of Computer Application', 3),
(40, 'Bachelor of Development Studies (BDEVS)', 4),
(41, 'Bachelor of English and Communication Studies (BECS)', 4),
(42, 'Bachelor of Entrepreneurship Development (BED)', 4);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` int(11) NOT NULL,
  `syllabus_filename` varchar(255) NOT NULL,
  `faculty` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `is_admin`) VALUES
(1, 'sundardumre69@live.com', '12', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `id` int(11) NOT NULL,
  `is_login` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `program` (`program`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD KEY `user` (`user`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `program` (`program`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fact_id` (`fact_id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `program` (`program`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_login_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enroll_ibfk_3` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`fact_id`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD CONSTRAINT `syllabus_ibfk_1` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `syllabus_ibfk_2` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
