-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 06:16 PM
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
  `course_name` varchar(255) NOT NULL,
  `path` varchar(500) NOT NULL,
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

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`user`, `faculty`, `program`) VALUES
(2, 1, 4),
(3, 3, 33),
(4, 1, 1),
(4, 3, 1),
(4, 1, 1),
(4, 1, 1),
(4, 1, 1),
(4, 1, 1),
(4, 1, 1),
(4, 1, 1),
(4, 1, 1),
(4, 1, 1),
(4, 3, 33),
(4, 3, 33),
(4, 3, 33),
(4, 3, 33),
(4, 3, 33),
(4, 3, 33),
(4, 3, 33),
(4, 3, 33),
(4, 1, 1),
(4, 1, 1);

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `feedback_text` longtext NOT NULL,
  `feedback_by` int(11) NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `feedback_text`, `feedback_by`, `posted_date`) VALUES
(2, 'Thanks Admin Its very much dami!!!', 2, '2021-04-10 09:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `notice_info` longtext NOT NULL,
  `faculty` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice_info`, `faculty`, `program`, `semester`, `added_by`, `added_date`) VALUES
(4, '      helloo dost', 1, 1, 1, 4, '2021-04-10 15:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `old_question`
--

CREATE TABLE `old_question` (
  `id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `path` varchar(400) NOT NULL,
  `faculty` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `old_question`
--

INSERT INTO `old_question` (`id`, `question`, `path`, `faculty`, `program`, `semester`, `year`, `added_by`, `added_date`) VALUES
(1, 'Computer Graphics ', 'C:/xampp/htdocs/PUNotes/View/static/Faculty/Science and Technology/Bachelor of Software Engineering/OldQuestions/Semester/3/2016 Spring/Computer Graphics .pdf', 3, 32, 3, '2016 Spring', 4, '2021-04-10 11:23:30');

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
  `syllabus_name` varchar(255) NOT NULL,
  `path` varchar(500) NOT NULL,
  `faculty` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `syllabus_name`, `path`, `faculty`, `program`, `semester`, `added_by`, `added_date`) VALUES
(1, 'Comp sixth semester courses', 'C:/xampp/htdocs/PUNotes/View/static/Faculty/Science and Technology/Bachelor of Computer Engineering/Syllabus/Semester/7/Comp sixth semester courses.pdf', 3, 33, 7, 4, '2021-04-10 10:59:48');

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
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `college` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `is_admin`, `college`) VALUES
(2, 'roshandumre45@gmail.com', 'roshan12', 'Roshan', 'Dumre', 0, 'KWS'),
(3, 'sundardumre69@live.com', '1234', 'Sundar', 'Dumre', 0, 'Nepal Engineering College'),
(4, 'suresh@gmail.com', 'admin', 'Suresh', 'Yadav', 1, '');

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
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_by` (`feedback_by`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `program` (`program`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `old_question`
--
ALTER TABLE `old_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `program` (`program`),
  ADD KEY `added_by` (`added_by`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `old_question`
--
ALTER TABLE `old_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`feedback_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notice_ibfk_2` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notice_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `old_question`
--
ALTER TABLE `old_question`
  ADD CONSTRAINT `old_question_ibfk_1` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `old_question_ibfk_2` FOREIGN KEY (`program`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `old_question_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
