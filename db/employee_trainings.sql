-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 01:34 AM
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
(8, 9, 2, 9, 'Completed', '2023-08-09 00:35:01'),
(9, 9, 2, 11, 'Completed', '2023-08-10 17:47:34'),
(10, 9, 2, 10, 'Completed', '2023-08-10 17:47:45'),
(11, 9, 5, 12, 'Completed', '2023-08-10 18:47:47'),
(12, 9, 10, 16, 'Completed', '2023-08-12 18:56:44'),
(13, 9, 10, 17, 'Completed', '2023-08-12 18:57:27'),
(14, 13, 13, 19, 'Completed', '2023-08-30 01:13:27'),
(15, 13, 13, 20, 'Completed', '2023-08-30 01:37:12'),
(16, 13, 13, 20, 'Completed', '2023-08-30 01:37:21'),
(17, 13, 13, 21, 'Completed', '2023-08-30 01:37:27'),
(18, 13, 13, 21, 'Completed', '2023-08-30 01:37:30'),
(19, 13, 13, 21, 'Completed', '2023-08-30 01:37:36'),
(20, 13, 13, 22, 'Completed', '2023-08-30 01:44:01'),
(21, 13, 13, 23, 'Completed', '2023-08-30 01:47:23');

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
(17, 1, 10, 'Saying what?', '2023-08-15 08:38:01', 'Not read.');

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

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`professional_id`, `professional_fn`, `professional_ln`, `professional_email`, `professional_phone`, `professional_status`) VALUES
(1, 'Kagame', 'Paul', 'kagame@gmail.com', 788722727, 'Online'),
(2, 'Fally', 'Merci', 'fally@gmail.com', 882928372, 'Offline'),
(3, 'Profesional ', 'Lastname', 'orife@gmail.cd', 23892298, 'Offline');

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
(1, 'Dealing with it', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', 'pexels-leon-ardho-2468339.jpg', 8, 'Progress'),
(2, '2', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', 'pexels-rdne-stock-project-7948054.jpg', 8, 'Progress'),
(3, 'What do you think', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', 'pexels-ivan-samkov-4240497.jpg', 8, 'Progress'),
(4, 'TRRR', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', 'pexels-ivan-samkov-4240497.jpg', 8, 'Disabled'),
(5, '2', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', '8bea1236-10a0-460e-8c32-51fc7582059c.png', 8, 'Disabled'),
(6, '2', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', '56074198-e74f-4ef2-9472-8868686afa6b.png', 8, 'Disabled'),
(7, 'Sampling good', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', 'Python-Symbol.png', 8, 'Disabled'),
(8, '2', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', '38e02103-e2c6-4a63-8074-fa75916f265e.png', 8, 'Disabled'),
(9, '2', 'This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good This is the trainings which will be cool when it starts with the after days and it can be best if we create a good contstructing plan. And i think it will be good', '2023-08-06', '2023-08-25', '96855c84-9e92-4049-968c-91939601e4f0_variated.png', 7, 'Disabled'),
(10, 'Web Development Basics', '\"Web Development Basics\" is a foundational training that introduces participants to the essential concepts of web development. Participants will learn about HTML, CSS, and JavaScript – the building blocks of modern websites. By the end of the training, attendees will have a solid understanding of creating static web pages and basic interactivity, setting them on the path to becoming proficient web developers.', '2023-08-12', '2023-09-02', '56074198-e74f-4ef2-9472-8868686afa6b.png', 8, 'Progress'),
(11, 'Starting JS', 'Description', '2023-08-21', '2023-08-31', 'pexels-işıl-17795142.jpg', 8, 'Progress'),
(12, 'Hello world', 'Hello world what is this', '2023-08-30', '2023-08-30', 'Screenshot (98).png', 8, 'Progress'),
(13, 'Amazon devices workout', 'How to use amazon Devices', '2023-10-10', '2023-11-11', 'pexels-cottonbro-studio-5473337.jpg', 2, 'Progress');

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

--
-- Dumping data for table `training_contents`
--

INSERT INTO `training_contents` (`training_content_id`, `training`, `content_name`, `content_type`, `content_file`) VALUES
(1, 2, 'Start by introduction to N-computing', '', 'trainings/contents/2Start by introduction to N-computing.pdf'),
(2, 2, 'Content creation', '', 'trainings/contents/Content creation - N-COmputing management study.pdf'),
(3, 1, 'Day 1 - Condition of jumping', '', 'trainings/contents/Day 1 - Condition of jumping - High jump up Skills for good destiny.pdf'),
(4, 3, 'Chriss eazy stop', '', 'trainings/contents/Chriss eazy stop - Starting the days with us can be cool.mp4'),
(5, 2, 'WTF', '', 'trainings/contents/WTF - N-COmputing management study.pdf'),
(6, 2, 'What happened last time', '', 'trainings/contents/What happened last time - N-COmputing management study.pdf'),
(7, 2, 'I think DOcx is not problem', '', 'trainings/contents/I think DOcx is not problem - N-COmputing management study.docx'),
(8, 2, 'Getting it by noe', '', 'trainings/contents/Getting it by noe - N-COmputing management study.pdf'),
(9, 2, 'fdbfx', '', 'trainings/contents/fdbfx - N-COmputing management study.pdf'),
(10, 2, 'New test', '', 'trainings/contents/New test - N-COmputing management study.pdf'),
(11, 2, 'Yes yes', '', 'trainings/contents/Yes yes - N-COmputing management study.pdf'),
(12, 5, 'Introduction to Python Snakes', '', 'trainings/contents/Introduction to Python Snakes - Bad effect of Python snake.mp4'),
(13, 5, 'Natural Habitat and Distribution', '', 'trainings/contents/Natural Habitat and Distribution - Bad effect of Python snake.mp4'),
(14, 5, 'Introduction to Invasive Species', '', 'trainings/contents/Introduction to Invasive Species - Bad effect of Python snake.mp4'),
(15, 5, 'Introduction to Ecosystems', '', 'trainings/contents/Introduction to Ecosystems - Bad effect of Python snake.mp4'),
(16, 10, 'Day 1 - What does itmean?', '', 'trainings/contents/osdcpkpock - Web Development Basics.mp4'),
(17, 10, 'Yes yes', '', 'trainings/contents/Yes yes - Web Development Basics.mp4'),
(18, 12, 'Hello world 1', 'Document summary', 'trainings/contents/Hello world 1 - Hello world.pdf'),
(19, 13, 'how to ad playstore', 'Video', 'trainings/contents/how to ad playstore - Amazon devices workout.mp4'),
(20, 13, 'Overall summaryy', 'Document summary', 'trainings/contents/Overall summaryy - Amazon devices workout.pdf'),
(21, 13, 'How to start', 'Video', 'trainings/contents/How to start - Amazon devices workout.mp4'),
(22, 13, 'DFVLJKFSK', 'Video', 'trainings/contents/DFVLJKFSK - Amazon devices workout.mp4'),
(23, 13, 'fgfq', 'Video', 'trainings/contents/fgfq - Amazon devices workout.mp4');

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

--
-- Dumping data for table `training_professionals`
--

INSERT INTO `training_professionals` (`tr_pro_id`, `training`, `professional`, `unique_id`, `tr_pro_status`) VALUES
(1, 2, 1, '00', 'Progress'),
(2, 7, 2, '6ad885410077a30caa428bd429e542cb', 'Progress'),
(3, 10, 3, 'f2bf8ab8a484ddf9f464bb24af975f75', 'Progress');

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
(2, '12222', 'ndahimana154', 'Ndahimana', 'Bonheur', 'ndahimana154@gmail.com', 8746626, '81dc9bdb52d04dc20036dbd8313ed055', 'Administration', 11, 'Working'),
(9, 'Ll8kmDc4X83mRKKuoF6t5A==', 'twitegure1234', 'Twitegure', 'Pacifique', 'twi@gmail.com', 782277377, '81dc9bdb52d04dc20036dbd8313ed055', 'Employee', 8, 'Working'),
(10, 'UNnusJAiLsMvlecwnFxGbg==', 'Not set Yet', 'Tsinda', 'Cyimana', 'tsinda@gmail.com', 782736463, '81dc9bdb52d04dc20036dbd8313ed055', 'Employee', 8, 'No account yet'),
(11, 'JCwADL1oOlWbkVwnsaTMEA==', 'Not set Yet', '\'', 'iojio', 'iojoiji@df.fv', 320293, '81dc9bdb52d04dc20036dbd8313ed055', 'Employee', 8, 'No account yet'),
(12, 'gq5hrdel2tpNv0O1ltszbw==', 'Not set Yet', 'pok', 'powpopo', 'pookp@sop.ec', 38948928, '81dc9bdb52d04dc20036dbd8313ed055', 'Employee', 9, 'No account yet'),
(13, 'l9OKrUYglSTNoq6jtEQg7w==', 'khalifa', 'Khalifa', 'Ofiiciall', 'khalifa@gmail.com', 789470597, '81dc9bdb52d04dc20036dbd8313ed055', 'Employee', 2, 'Working');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `msgs_professional_employee`
--
ALTER TABLE `msgs_professional_employee`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `professional_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `training_contents`
--
ALTER TABLE `training_contents`
  MODIFY `training_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `training_professionals`
--
ALTER TABLE `training_professionals`
  MODIFY `tr_pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
