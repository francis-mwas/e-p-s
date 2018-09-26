-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 05:15 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `date_time` varchar(200) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `last_name` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `validation_code` text NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `profile_pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `date_time`, `first_name`, `last_name`, `email`, `password`, `validation_code`, `phone_number`, `profile_pic`) VALUES
(6, 'May-03-2018 12:08:00', 'danlyproperties', 'dan-pesa', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '779ea94626d6153c78ccaf8a35cd8b45', '0717445860', 'img7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_abbr` varchar(200) NOT NULL,
  `streams` varchar(50) NOT NULL,
  `class_teacher` varchar(200) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_abbr`, `streams`, `class_teacher`, `date_added`) VALUES
(21, 'F1', 'F1A', 'Victor kamau', 'August-17-2018 00:02:22'),
(22, 'F1', 'F1B', 'Peris', 'August-17-2018 00:02:47'),
(23, 'F1', 'F1C', 'warren', 'August-17-2018 00:03:12'),
(24, 'F2', 'F2A', 'Maina', 'August-17-2018 00:03:32'),
(25, 'F2', 'F2B', 'kamiti', 'August-17-2018 00:03:46'),
(26, 'F2', 'F2C', 'karanja', 'August-17-2018 00:04:25'),
(27, 'F3', 'F3A', 'muiruri', 'August-17-2018 00:04:40'),
(28, 'F3', 'F3B', 'Kadie', 'August-17-2018 00:04:59'),
(29, 'F3', 'F3C', 'Monica', 'August-17-2018 00:05:30'),
(30, 'F4', 'F4A', 'kinya', 'August-17-2018 00:05:42'),
(31, 'F4', 'F4A', 'Peninah', 'August-17-2018 00:06:08'),
(32, 'F4', 'F4C', 'wamuyu', 'August-17-2018 00:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `exam_code` varchar(200) NOT NULL,
  `max_mark` varchar(200) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `type`, `exam_code`, `max_mark`, `date_added`) VALUES
(4, 'Opener', '010', '50', 'August-01-2018 16:47:00'),
(5, 'CAT', '020', '40', 'August-01-2018 16:47:21'),
(6, 'End Term', '030', '100', 'August-05-2018 20:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `adm_no` varchar(100) NOT NULL,
  `class_id` int(100) NOT NULL,
  `yearOfAdmission` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `profile_photo` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `updated_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `fullname`, `adm_no`, `class_id`, `yearOfAdmission`, `gender`, `profile_photo`, `date_added`, `updated_date`) VALUES
(24, 'betty kinya', '4444', 27, '2016', 'Female', 'av.png', 'August-17-2018 17:10:36', 'August-17-2018 17:10:36'),
(25, 'David maina', '1234', 21, '2015', 'Male', 'av.png', 'August-17-2018 17:12:00', 'August-17-2018 17:12:00'),
(26, 'Veronica wanjiru', '5555', 23, '2015', 'Female', 'av.png', 'August-17-2018 17:13:41', 'August-17-2018 17:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(200) NOT NULL,
  `sub_code` varchar(200) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `updated_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`, `sub_code`, `date_added`, `updated_date`) VALUES
(1, 'Maths', '121', 'August-04-2018 17:14:07', 'August-04-2018 17:14:07'),
(2, 'English', '101', 'August-04-2018 17:21:35', 'August-04-2018 17:36:33'),
(3, 'Kiswahili', '102', 'August-04-2018 17:21:56', 'August-04-2018 17:21:56'),
(4, 'Comp', '451', 'August-04-2018 17:35:03', 'August-04-2018 18:29:00'),
(5, 'Bio', '231', 'August-04-2018 21:29:01', 'August-04-2018 21:29:01'),
(6, 'Chem', '233', 'August-04-2018 21:29:17', 'August-04-2018 21:29:17'),
(7, 'Phys', '232', 'August-04-2018 21:29:31', 'August-04-2018 21:29:31'),
(8, 'Hist', '311', 'August-04-2018 21:29:44', 'August-04-2018 21:29:44'),
(9, 'Geo', '312', 'August-04-2018 21:29:57', 'August-04-2018 21:29:57'),
(10, 'CRE', '313', 'August-04-2018 21:30:10', 'August-04-2018 21:30:10'),
(11, 'Agri', '443', 'August-04-2018 21:30:22', 'August-16-2018 23:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `subjectcombination`
--

CREATE TABLE `subjectcombination` (
  `c_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `assigned_teacher_id` int(11) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `updated_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjectcombination`
--

INSERT INTO `subjectcombination` (`c_id`, `class_id`, `subject_id`, `assigned_teacher_id`, `date_added`, `updated_date`) VALUES
(77, 22, 2, 29, 'August-17-2018 00:26:06', 'August-17-2018 00:26:06'),
(80, 23, 5, 15, 'August-17-2018 00:26:45', 'August-17-2018 00:26:45'),
(81, 21, 6, 15, 'August-17-2018 00:28:05', 'August-17-2018 00:28:05'),
(82, 21, 1, 15, 'August-17-2018 00:35:17', 'August-17-2018 00:35:17'),
(83, 21, 2, 29, 'August-17-2018 00:37:22', 'August-17-2018 00:37:22'),
(84, 23, 7, 26, 'August-17-2018 00:45:26', 'August-17-2018 00:45:26'),
(85, 21, 4, 30, 'August-17-2018 09:51:42', 'August-17-2018 09:51:42'),
(86, 21, 5, 46, 'August-17-2018 17:18:44', 'August-17-2018 17:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `s_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` varchar(100) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `posted_by` varchar(100) NOT NULL,
  `typeId` int(11) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `term_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`id`, `s_id`, `class_id`, `sub_id`, `marks`, `PostingDate`, `UpdationDate`, `posted_by`, `typeId`, `remarks`, `term_id`) VALUES
(181, 5, 1, 5, 67, 'August-16-2018 22:33:19', NULL, 'warren@gmail.com', 4, '   Good work.', 3),
(182, 16, 1, 5, 78, 'August-16-2018 22:34:08', NULL, 'warren@gmail.com', 4, '   Excellent.', 3),
(183, 13, 1, 5, 87, 'August-16-2018 22:35:12', NULL, 'warren@gmail.com', 4, '   Excellent job.', 3),
(184, 3, 3, 2, 67, 'August-16-2018 22:36:07', NULL, 'warren@gmail.com', 6, '   Good.', 5),
(185, 18, 3, 2, 78, 'August-16-2018 22:36:34', NULL, 'warren@gmail.com', 6, '   Great job.', 5),
(186, 3, 3, 2, 80, 'August-16-2018 22:38:26', NULL, 'mwas@gmail.com', 5, '  Excellent job, keep up good work.', 4),
(187, 18, 3, 2, 78, 'August-16-2018 22:38:52', NULL, 'mwas@gmail.com', 5, '   Great work.', 4),
(188, 3, 3, 2, 777, 'August-16-2018 22:44:15', NULL, 'mwas@gmail.com', 6, '   yyy', 5),
(189, 15, 5, 6, 67, 'August-16-2018 22:46:51', NULL, 'victor@gmail.com', 5, '   gg', 4),
(190, 6, 5, 6, 88, 'August-16-2018 22:47:27', NULL, 'victor@gmail.com', 5, '   ggg', 5),
(191, 16, 1, 5, 78, 'August-16-2018 22:48:46', NULL, 'victor@gmail.com', 5, '   gg', 4),
(192, 5, 1, 5, 89, 'August-16-2018 22:49:01', NULL, 'victor@gmail.com', 4, '   hh', 4),
(193, 13, 1, 5, 777, 'August-16-2018 22:50:04', NULL, 'victor@gmail.com', 4, '   yy', 3),
(194, 20, 2, 2, 78, 'August-16-2018 23:12:03', NULL, 'victor@gmail.com', 4, '   this great job.', 5),
(195, 19, 1, 5, 80, 'August-16-2018 23:13:10', NULL, 'victor@gmail.com', 4, '   good', 5),
(196, 19, 1, 5, 78, 'August-16-2018 23:14:48', NULL, 'warren@gmail.com', 4, '   good work', 5),
(258, 21, 21, 2, 55, 'August-17-2018 13:23:30', NULL, 'victor@gmail.com', 5, '   great', 3),
(259, 21, 21, 6, 67, 'August-17-2018 13:24:42', NULL, 'warren@gmail.com', 4, '   good job.', 5),
(260, 21, 21, 1, 77, 'August-17-2018 13:24:42', NULL, 'warren@gmail.com', 4, '   good job.', 5),
(261, 21, 21, 4, 89, 'August-17-2018 13:25:48', NULL, 'peris@gmail.com', 5, '   good job, keep up.', 5),
(262, 25, 21, 5, 67, 'August-17-2018 17:19:27', NULL, 'victor@gmail.com', 4, '   good.', 3),
(263, 25, 21, 6, 67, 'August-17-2018 17:22:32', NULL, 'warren@gmail.com', 4, '   goood', 4),
(264, 25, 21, 1, 88, 'August-17-2018 17:22:32', NULL, 'warren@gmail.com', 4, '   goood', 4);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tsc_no` varchar(20) NOT NULL,
  `profile_photo` varchar(500) NOT NULL,
  `date_added` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `fullname`, `username`, `tsc_no`, `profile_photo`, `date_added`) VALUES
(15, 'warren kamau', 'warren@gmail.com', '172667', 'slider2.png', 'August-14-2018 16:37:17'),
(24, 'Francis mwangi', 'mwas@gmail.com', '123456', 'blue_water.jpg', 'August-08-2018 13:24:45'),
(26, 'ibrahim kinyua', 'ibrahim@gmail.com', '888888', '13.jpg', 'August-08-2018 13:35:21'),
(46, 'victor kamau', 'victor@gmail.com', '222222', 'av.png', 'August-17-2018 15:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `term_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `name`, `year`, `date_added`) VALUES
(3, 'Term 2', '2017', 'August-02-2018 12:16:25'),
(4, 'Term 3', '2018', 'August-02-2018 12:13:29'),
(5, 'Term 1', '2018', 'August-02-2018 12:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `validation_code` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `date_registered` varchar(100) NOT NULL,
  `profile_pic` text NOT NULL,
  `gender` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `mobile_number`, `password`, `validation_code`, `active`, `date_registered`, `profile_pic`, `gender`) VALUES
(5, 'john', 'mwangi', 'betty@gmail.com', '0798097256', '779ea94626d6153c78ccaf8a35cd8b45', '0', 1, 'April-05-2018 15:58:58', 'logo.PNG', 'female'),
(10, 'daudi', 'daudi', 'da@gmail.com', '098765', 'ee11cbb19052e40b07aac0ca060c23ee', '0', 1, 'April-05-2018 15:58:58', 'logo.PNG', 'female'),
(15, 'john kajana', 'kariuki', 'john@gmail.com', '098765432', '827ccb0eea8a706c4c34a16891f84e7b', '0', 1, 'May-04-2018 15:00:57', 'logo.PNG', 'male'),
(16, 'maina', 'maina', 'maina@gmail.com', '098765432', '55bcb5b22e126345d70814c13a99d22e', '0', 1, 'April-05-2018 15:58:58', 'logo.PNG', 'male'),
(17, 'kariuki', 'kariuki', 'kariuki@gmail.com', '098765432', 'f25b8258b6f0865c460ce3107d6f0116', '95c18dde9b7ce69994fbe53627360223', 0, 'April-05-2018 15:58:58', 'logo.PNG', 'male'),
(19, 'victor', 'kamau', 'victor@gmail.com', '0715445860', 'ffc150a160d37e92012c196b6af4160d', 'ef8a4d956ae2db063ad46ead7108961a', 0, 'May-01-2018 22:11:36', 'logo.PNG', 'Male'),
(20, 'joshua', 'josh', 'josh@gmail.com', '098765432', 'f94adcc3ddda04a8f34928d862f404b4', '7e8b2aff2baaaa03cbf1b6d64f96e633', 1, 'May-07-2018 08:40:16', 'logo.PNG', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `subjectcombination`
--
ALTER TABLE `subjectcombination`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjectcombination`
--
ALTER TABLE `subjectcombination`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
