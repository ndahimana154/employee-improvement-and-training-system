-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 12:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_trainings`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `depart_id` int(11) NOT NULL,
  `depart_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`depart_id`, `depart_name`) VALUES
(1, 'Mathematics'),
(2, 'English'),
(3, 'Science'),
(4, 'History'),
(5, 'Physical Education'),
(6, 'Art'),
(7, 'Music'),
(8, 'Computer Science'),
(9, 'Languages'),
(10, 'Social Studies'),
(11, 'Human resource Management');

-- --------------------------------------------------------

--
-- Table structure for table `empl_trainings_conent_completion`
--

CREATE TABLE `empl_trainings_conent_completion` (
  `id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `completion date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empl_trainings_conent_completion`
--

INSERT INTO `empl_trainings_conent_completion` (`id`, `employee`, `training`, `content`, `status`, `completion date`) VALUES
(1, 9, 2, 2, 'Completed', '2023-08-08 20:49:53'),
(2, 9, 3, 4, 'Completed', '2023-08-08 21:12:05'),
(3, 9, 2, 1, 'Completed', '2023-08-08 21:12:25'),
(4, 9, 2, 6, 'Completed', '2023-08-09 00:24:36'),
(5, 9, 2, 5, 'Completed', '2023-08-09 00:25:16'),
(6, 9, 2, 7, 'Completed', '2023-08-09 00:25:43'),
(7, 9, 2, 8, 'Completed', '2023-08-09 00:30:18'),
(8, 9, 2, 9, 'Completed', '2023-08-09 00:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `professional_id` int(11) NOT NULL,
  `professional_fn` varchar(255) NOT NULL,
  `professional_ln` varchar(255) NOT NULL,
  `professional_email` varchar(255) NOT NULL,
  `professional_phone` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `training_id` int(11) NOT NULL,
  `training_topic` varchar(255) NOT NULL,
  `training_description` text NOT NULL DEFAULT 'This is the defaullt description of the trainings',
  `training_start` varchar(255) NOT NULL,
  `training_end` varchar(255) NOT NULL,
  `training_cover` varchar(255) NOT NULL,
  `training_depart` int(11) NOT NULL,
  `training_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`training_id`, `training_topic`, `training_description`, `training_start`, `training_end`, `training_cover`, `training_depart`, `training_status`) VALUES
(1, 'High jump up Skills for good destiny', '', '2023-08-05', '2023-08-12', 'pexels-leon-ardho-2468339.jpg', 6, 'Progress'),
(2, 'N-COmputing management study', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', 'pexels-rdne-stock-project-7948054.jpg', 8, 'Progress'),
(3, 'Starting the days with us can be cool', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-10', '2023-08-30', 'pexels-ivan-samkov-4240497.jpg', 8, 'Progress');

-- --------------------------------------------------------

--
-- Table structure for table `training_contents`
--

CREATE TABLE `training_contents` (
  `training_content_id` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `content_name` varchar(255) NOT NULL,
  `content_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_contents`
--

INSERT INTO `training_contents` (`training_content_id`, `training`, `content_name`, `content_file`) VALUES
(1, 2, 'Start by introduction to N-computing', 'trainings/contents/2Start by introduction to N-computing.pdf'),
(2, 2, 'Content creation', 'trainings/contents/Content creation - N-COmputing management study.pdf'),
(3, 1, 'Day 1 - Condition of jumping', 'trainings/contents/Day 1 - Condition of jumping - High jump up Skills for good destiny.pdf'),
(4, 3, 'Chriss eazy stop', 'trainings/contents/Chriss eazy stop - Starting the days with us can be cool.mp4'),
(5, 2, 'WTF', 'trainings/contents/WTF - N-COmputing management study.pdf'),
(6, 2, 'What happened last time', 'trainings/contents/What happened last time - N-COmputing management study.pdf'),
(7, 2, 'I think DOcx is not problem', 'trainings/contents/I think DOcx is not problem - N-COmputing management study.docx'),
(8, 2, 'Getting it by noe', 'trainings/contents/Getting it by noe - N-COmputing management study.pdf'),
(9, 2, 'fdbfx', 'trainings/contents/fdbfx - N-COmputing management study.pdf'),
(10, 2, 'New test', 'trainings/contents/New test - N-COmputing management study.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `training_professionals`
--

CREATE TABLE `training_professionals` (
  `tr_pro_id` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `professional` int(11) NOT NULL,
  `unique_id` text NOT NULL,
  `tr_pro_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nid` text NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_fn` varchar(255) NOT NULL,
  `user_ln` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `user_state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nid`, `user_name`, `user_fn`, `user_ln`, `user_email`, `user_phone`, `user_pass`, `user_type`, `department`, `user_state`) VALUES
(2, '12222', 'ndahimana154', 'Ndahimana', 'Bonheur', 'ndahimana154@gmail.com', 0, '81dc9bdb52d04dc20036dbd8313ed055', 'Administration', 11, 'Working'),
(9, 'Ll8kmDc4X83mRKKuoF6t5A==', 'twitegure123', 'Twitegure', 'Pacifique', 'twi@gmail.com', 782277377, '827ccb0eea8a706c4c34a16891f84e7b', 'Employee', 8, 'Working');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `empl_trainings_conent_completion`
--
ALTER TABLE `empl_trainings_conent_completion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sdiovjsdioiojio` (`training`),
  ADD KEY `sdiojsduichi` (`content`),
  ADD KEY `ciojios` (`employee`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`professional_id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `cfgbgbxzdf` (`training_depart`);

--
-- Indexes for table `training_contents`
--
ALTER TABLE `training_contents`
  ADD PRIMARY KEY (`training_content_id`),
  ADD KEY `dviojdiojo` (`training`);

--
-- Indexes for table `training_professionals`
--
ALTER TABLE `training_professionals`
  ADD PRIMARY KEY (`tr_pro_id`),
  ADD KEY `ohuiohuio` (`training`),
  ADD KEY `adfchduishui` (`professional`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `78y78h8` (`department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `empl_trainings_conent_completion`
--
ALTER TABLE `empl_trainings_conent_completion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `professional_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_contents`
--
ALTER TABLE `training_contents`
  MODIFY `training_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `training_professionals`
--
ALTER TABLE `training_professionals`
  MODIFY `tr_pro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empl_trainings_conent_completion`
--
ALTER TABLE `empl_trainings_conent_completion`
  ADD CONSTRAINT `ciojios` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sdiojsduichi` FOREIGN KEY (`content`) REFERENCES `training_contents` (`training_content_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sdiovjsdioiojio` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainings`
--
ALTER TABLE `trainings`
  ADD CONSTRAINT `cfgbgbxzdf` FOREIGN KEY (`training_depart`) REFERENCES `departments` (`depart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_contents`
--
ALTER TABLE `training_contents`
  ADD CONSTRAINT `dviojdiojo` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_professionals`
--
ALTER TABLE `training_professionals`
  ADD CONSTRAINT `adfchduishui` FOREIGN KEY (`professional`) REFERENCES `professionals` (`professional_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ohuiohuio` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `78y78h8` FOREIGN KEY (`department`) REFERENCES `departments` (`depart_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
