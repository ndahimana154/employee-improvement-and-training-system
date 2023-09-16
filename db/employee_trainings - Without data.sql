-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2023 at 08:30 PM
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
  `depart_name` varchar(255) NOT NULL,
  `depart_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`depart_id`, `depart_name`, `depart_status`) VALUES
(14, 'Human Resource Management', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employees_certificate`
--

CREATE TABLE `employees_certificate` (
  `certficate_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approve_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees_request_certificates`
--

CREATE TABLE `employees_request_certificates` (
  `request_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `request_date` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `request_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees_test_answers`
--

CREATE TABLE `employees_test_answers` (
  `eta_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `marking` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `submission_time` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees_test_marks`
--

CREATE TABLE `employees_test_marks` (
  `etc_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `average_marks` int(11) NOT NULL,
  `total_test_marks` int(11) NOT NULL,
  `marking_time` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `marking_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `msgs_professional_employee`
--

CREATE TABLE `msgs_professional_employee` (
  `msg_id` int(11) NOT NULL,
  `msg_sender` int(11) NOT NULL,
  `msg_receiver` int(11) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_sendtime` varchar(255) NOT NULL,
  `msg_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msgs_professional_employee`
--

INSERT INTO `msgs_professional_employee` (`msg_id`, `msg_sender`, `msg_receiver`, `msg_content`, `msg_sendtime`, `msg_status`) VALUES
(1, 9, 2, 'Hello', '2023-08-12 03:43:57', 'Not read.'),
(2, 2, 9, 'qllhai its good', '2023-08-12 08:57:03', 'Not read.'),
(3, 9, 2, 'Why cani do it?', '2023-08-12 09:06:31', 'Not read.'),
(4, 9, 2, 'yeah ofcourse its good', '2023-08-12 09:06:59', 'Not read.'),
(5, 9, 2, 'i think it will scroll down over', '2023-08-12 09:07:14', 'Not read.'),
(6, 9, 2, 'is that ok??', '2023-08-12 09:07:20', 'Not read.'),
(7, 2, 9, 'Yeah man its cool', '2023-08-12 11:14:19', 'Not read.'),
(8, 9, 2, 'what do you want?', '2023-08-12 11:18:47', 'Not read.'),
(9, 9, 2, 'what do you want?', '2023-08-12 11:19:07', 'Not read.'),
(10, 2, 10, 'Hello cyimana', '2023-08-12 11:24:37', 'Not read.'),
(11, 2, 9, '                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt, ullam. Laboriosam, consectetur? Fugit a minus in? Assumenda excepturi ab vero alias fuga debitis? Eaque exercitationem nobis ipsam atque harum nemo!', '2023-08-12 13:02:31', 'Not read.'),
(12, 1, 9, 'Hello', '2023-08-12 17:54:52', 'Not read.'),
(13, 1, 9, 'Umeze ute bruh>??', '2023-08-12 17:55:00', 'Not read.'),
(14, 1, 10, 'csdfdg;', '2023-08-12 18:18:19', 'Not read.'),
(15, 9, 3, 'Hello', '2023-08-12 18:47:16', 'Not read.'),
(16, 1, 10, 'What are you saying?', '2023-08-15 08:37:50', 'Not read.'),
(17, 1, 10, 'Saying what?', '2023-08-15 08:38:01', 'Not read.'),
(18, 13, 7, 'Hello', '2023-09-02 12:59:58', 'Not read.'),
(19, 13, 7, 'WHo are you??', '2023-09-02 13:00:04', 'Not read.'),
(20, 9, 9, 'r', '2023-09-06 16:54:57', 'Not read.'),
(21, 9, 11, 'ghh', '2023-09-06 16:56:38', 'Not read.'),
(22, 15, 10, 'dfghj', '2023-09-09 13:28:45', 'Not read.'),
(23, 1, 10, 'hello', '2023-09-09 14:39:35', 'Not read.');

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `professional_id` int(11) NOT NULL,
  `professional_fn` varchar(255) NOT NULL,
  `professional_ln` varchar(255) NOT NULL,
  `professional_email` varchar(255) NOT NULL,
  `professional_phone` int(12) NOT NULL,
  `professional_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `test_schedule` varchar(255) NOT NULL,
  `test_questions_num` int(11) NOT NULL,
  `test_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tests_questions`
--

CREATE TABLE `tests_questions` (
  `question_id` int(11) NOT NULL,
  `question_added_time` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `question_text` text NOT NULL,
  `question_answer` text NOT NULL,
  `marks` int(11) NOT NULL DEFAULT 1,
  `test_id` int(11) NOT NULL,
  `training` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test_completion_time`
--

CREATE TABLE `test_completion_time` (
  `completion_id` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `date_time` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `action_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test_employee_answers`
--

CREATE TABLE `test_employee_answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `submission_time` varchar(255) NOT NULL,
  `training` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `answer_status` tinyint(1) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `training_contents`
--

CREATE TABLE `training_contents` (
  `training_content_id` int(11) NOT NULL,
  `training` int(11) NOT NULL,
  `content_name` varchar(255) NOT NULL,
  `content_type` varchar(255) NOT NULL,
  `content_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(19, '11992001233456', 'testing.admin', 'admin_fn', 'admin_ln', 'admin@test.com', 722893974, '81dc9bdb52d04dc20036dbd8313ed055', 'Administration', 14, 'Offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `employees_certificate`
--
ALTER TABLE `employees_certificate`
  ADD PRIMARY KEY (`certficate_id`),
  ADD KEY `srogfmroiemoimewom` (`employee`),
  ADD KEY `dsefrtyujk` (`approved_by`),
  ADD KEY `cdfghjk` (`request_id`),
  ADD KEY `sodijvfioo` (`training`);

--
-- Indexes for table `employees_request_certificates`
--
ALTER TABLE `employees_request_certificates`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `xdsfuilojfgdsdfghj` (`employee`),
  ADD KEY `srtyuinbfvfdvdfsdvrvrw` (`training`);

--
-- Indexes for table `employees_test_answers`
--
ALTER TABLE `employees_test_answers`
  ADD PRIMARY KEY (`eta_id`),
  ADD KEY `erfrawefew` (`test`),
  ADD KEY `ffreferfrefae` (`training`),
  ADD KEY `dffdddffff` (`question`),
  ADD KEY `r3ferfreffdfdffdfdf` (`employee`);

--
-- Indexes for table `employees_test_marks`
--
ALTER TABLE `employees_test_marks`
  ADD PRIMARY KEY (`etc_id`),
  ADD KEY `sjhdfsg` (`employee`),
  ADD KEY `dsf` (`test`);

--
-- Indexes for table `empl_trainings_conent_completion`
--
ALTER TABLE `empl_trainings_conent_completion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sdiovjsdioiojio` (`training`),
  ADD KEY `sdiojsduichi` (`content`),
  ADD KEY `ciojios` (`employee`);

--
-- Indexes for table `msgs_professional_employee`
--
ALTER TABLE `msgs_professional_employee`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`professional_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `efewwfwe` (`training`);

--
-- Indexes for table `tests_questions`
--
ALTER TABLE `tests_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `eweweeew` (`test_id`),
  ADD KEY `ewewfsddds` (`training`);

--
-- Indexes for table `test_completion_time`
--
ALTER TABLE `test_completion_time`
  ADD PRIMARY KEY (`completion_id`),
  ADD KEY `asdfjhkh` (`action_by`),
  ADD KEY `asdfjhdfgef` (`test`),
  ADD KEY `ertyujhgfsfdwe` (`training`);

--
-- Indexes for table `test_employee_answers`
--
ALTER TABLE `test_employee_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `dsfdfdscdscd` (`training`),
  ADD KEY `dsferferferg` (`question_id`);

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
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employees_certificate`
--
ALTER TABLE `employees_certificate`
  MODIFY `certficate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees_request_certificates`
--
ALTER TABLE `employees_request_certificates`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees_test_answers`
--
ALTER TABLE `employees_test_answers`
  MODIFY `eta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `employees_test_marks`
--
ALTER TABLE `employees_test_marks`
  MODIFY `etc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `empl_trainings_conent_completion`
--
ALTER TABLE `empl_trainings_conent_completion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `msgs_professional_employee`
--
ALTER TABLE `msgs_professional_employee`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `professional_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tests_questions`
--
ALTER TABLE `tests_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `test_completion_time`
--
ALTER TABLE `test_completion_time`
  MODIFY `completion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_employee_answers`
--
ALTER TABLE `test_employee_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `training_contents`
--
ALTER TABLE `training_contents`
  MODIFY `training_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `training_professionals`
--
ALTER TABLE `training_professionals`
  MODIFY `tr_pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees_certificate`
--
ALTER TABLE `employees_certificate`
  ADD CONSTRAINT `cdfghjk` FOREIGN KEY (`request_id`) REFERENCES `employees_request_certificates` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dsefrtyujk` FOREIGN KEY (`approved_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sodijvfioo` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srogfmroiemoimewom` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees_request_certificates`
--
ALTER TABLE `employees_request_certificates`
  ADD CONSTRAINT `srtyuinbfvfdvdfsdvrvrw` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `xdsfuilojfgdsdfghj` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees_test_answers`
--
ALTER TABLE `employees_test_answers`
  ADD CONSTRAINT `dffdddffff` FOREIGN KEY (`question`) REFERENCES `tests_questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `erfrawefew` FOREIGN KEY (`test`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ffreferfrefae` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `r3ferfreffdfdffdfdf` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees_test_marks`
--
ALTER TABLE `employees_test_marks`
  ADD CONSTRAINT `dsf` FOREIGN KEY (`test`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sjhdfsg` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `empl_trainings_conent_completion`
--
ALTER TABLE `empl_trainings_conent_completion`
  ADD CONSTRAINT `ciojios` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sdiojsduichi` FOREIGN KEY (`content`) REFERENCES `training_contents` (`training_content_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sdiovjsdioiojio` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `efewwfwe` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tests_questions`
--
ALTER TABLE `tests_questions`
  ADD CONSTRAINT `eweweeew` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ewewfsddds` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_completion_time`
--
ALTER TABLE `test_completion_time`
  ADD CONSTRAINT `asdfjhdfgef` FOREIGN KEY (`test`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asdfjhkh` FOREIGN KEY (`action_by`) REFERENCES `professionals` (`professional_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ertyujhgfsfdwe` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_employee_answers`
--
ALTER TABLE `test_employee_answers`
  ADD CONSTRAINT `dsfdfdscdscd` FOREIGN KEY (`training`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dsferferferg` FOREIGN KEY (`question_id`) REFERENCES `tests_questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
