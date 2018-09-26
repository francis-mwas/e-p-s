-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2018 at 03:23 PM
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
-- Database: `realtor`
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
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `validation_code` text NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `profile_pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `date_time`, `first_name`, `last_name`, `username`, `password`, `validation_code`, `phone_number`, `profile_pic`) VALUES
(6, 'May-03-2018 12:08:00', 'danlyproperties', 'dan-pesa', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '779ea94626d6153c78ccaf8a35cd8b45', '0717445860', 'img7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id` int(11) NOT NULL,
  `date_time` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `image` varchar(500) NOT NULL,
  `post` varchar(1000) NOT NULL,
  `Price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `date_time`, `title`, `category`, `author`, `image`, `post`, `Price`) VALUES
(3, 'February-23-2018 20:34:34', 'Lenovo T400 model Think pad', 'house for sale', 'mwas', 'img7.jpg', 'during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham                            ', '550,00'),
(4, 'February-23-2018 20:47:08', 'helllow', 'Lenovo', 'mwas', 'img13.jpg', 'during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham               ', '65000000'),
(8, 'February-25-2018 18:13:51', 'trending', 'house for sale', 'mwas', 'img15.jpg', '  Own A Plot Today Located In Fathi, Near Nyahururu-Nyeri Tarmac. Located 10Km From Nyahururu Town And 5Km Of Tarmac.Both Electricity And Water Is On Site , Ideal For AgriBusiness And Hotel Industry Investment.                              \r\n                            ', '900000'),
(10, 'February-25-2018 19:26:44', 'kilimani supurb', 'house for sale', 'mwas', '15.jpg', '           Own A Plot Today Located In Fathi, Near Nyahururu-Nyeri Tarmac. Located 10Km From Nyahururu Town And 5Km Of Tarmac.Both Electricity And Water Is On Site , Ideal For AgriBusiness And Hotel Industry Investment.                     \r\n                            ', '678889'),
(12, 'February-25-2018 19:27:40', 'thika land for sale', 'land for sale', 'mwas', 'full-bg-7.jpg', '                               Own A Plot Today Located In Fathi, Near Nyahururu-Nyeri Tarmac. Located 10Km From Nyahururu Town And 5Km Of Tarmac.Both Electricity And Water Is On Site , Ideal For AgriBusiness And Hotel Industry Investment. \r\n                            ', '150000'),
(13, 'March-13-2018 21:17:24', 'Rua plots', 'land and plots', 'mwas', 'img10.jpg', '                                                                                            \r\n Own A Plot Today Located In Fathi, Near Nyahururu-Nyeri Tarmac. Located 10Km From Nyahururu Town And 5Km Of                                                                  ', '2000000'),
(14, 'March-12-2018 21:03:50', '78', 'furnished and holiday rentals.', 'admin', 'c6.PNG', '                   testing            \r\n                            ', ''),
(15, 'March-12-2018 21:05:03', '500', 'furnished and holiday rentals.', 'mwas', 'c1.PNG', '                 test              \r\n                            ', ''),
(16, 'March-13-2018 00:34:17', '4000', 'land and plots', 'admin', 'c4.PNG', 'the do jumpo                               \r\n                     the dog jumped over the gate       ', ''),
(17, 'March-13-2018 00:35:28', '8900', 'houses and apartment for sale.', 'admin', '1.jpg', '    another test where the hen lkthey                            \r\n                            ', ''),
(18, 'March-13-2018 00:38:41', '7099', 'land and plots', 'mwas', 'mt.JPG', '                                                              is this is another test yet.                \r\n                                                                                    ', ''),
(19, 'March-13-2018 00:37:49', '5500', 'houses and apartment for sale.', 'admin', 'blue_water.jpg', '      hey there jerk, how can we do.                         \r\n                            ', ''),
(20, 'March-13-2018 00:40:40', '769800', 'land and plots', 'admin', 'nai.jpg', ' not yet but iwill make it works.                              \r\n                            ', ''),
(21, 'March-13-2018 00:41:30', '4000', 'houses and apartment for sale.', 'admin', 'migrate.jpg', ' ooh yes, sure, go ahead.                              \r\n                            ', ''),
(22, 'March-13-2018 15:24:04', '25760', 'houses and apartment for sale.', 'admin', 'logo.PNG', '             this is a test pos emerging                  \r\n                            ', ''),
(23, 'March-15-2018 04:03:24', '7900', 'land and plots', 'mwas', '15.jpg', '                                 this is a post by admin.                                                                                        ', ''),
(24, 'March-13-2018 15:25:41', '450000', 'furnished and holi', 'admin', 'img16.jpg', '                   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.                \r\n                            ', ''),
(25, 'March-13-2018 15:28:50', '78600', 'land and plots', 'mwas', 'slider2.png', '                                                              \r\n      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.                                                      ', ''),
(26, 'March-13-2018 15:26:28', '7600', 'furnished and holi', 'admin', '3.jpg', '                               \r\n    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.                            ', ''),
(27, 'March-13-2018 17:44:50', '65000', 'houses and apartment for sale.', 'admin', 'img6.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.                                \r\n                            ', ''),
(28, 'March-29-2018 11:27:09', '6799', 'houses and apartment for sale.', 'admin', 'blue_water.jpg', '                this is a new test.               \r\n                            ', ''),
(29, 'March-29-2018 11:33:16', 'another new test', 'land and plots', 'admin', 'bannermonik.jpg', 'testing if new posts works.                               \r\n                            ', '65900'),
(30, 'May-03-2018 10:30:38', 'rrrRunda flats for sale', '', '', 'flamingo.jpg', '                 ff              \r\n                            ', '444');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL,
  `ad_title` text NOT NULL,
  `ad_price` text NOT NULL,
  `ad_category` varchar(100) NOT NULL,
  `ad_location` varchar(100) NOT NULL,
  `mobile_number` text NOT NULL,
  `ad_images` varchar(500) NOT NULL,
  `ad_description` varchar(1000) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `ad_status` text NOT NULL,
  `ad_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `ad_title`, `ad_price`, `ad_category`, `ad_location`, `mobile_number`, `ad_images`, `ad_description`, `date_added`, `created_by`, `ad_status`, `ad_code`) VALUES
(12, 'this is another site', '23400', 'office,shops and commercial.', 'kahahawa', '09888', 'nai.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-05-2018 15:58:58', 'betty@gmail.com', 'published', '1939'),
(13, 'test img', '90000', 'office,shops and commercial.', 'kiambu', '098765432', 'blue_water.jpg', 'thi is ?a chance The tourist attraction site located in kenyan coastal region. The tourist attraction site located in kenyan coastal region. ', 'April-05-2018 16:02:38', 'j@gmail.com', 'draft', '3395'),
(14, 'this is another site', '9000', 'furnished and holiday rentals.', 'kahahawa', '098765', 'banner 3.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-05-2018 16:21:50', 'betty@gmail.com', 'published', '8374'),
(15, 'this is another site', '9000', 'office,shops and commercial.', 'fffdd', '098765432', 'slider2.png', 'thi is ?a chance The tourist attraction site located in kenyan coastal region. The tourist attraction site located in kenyan coastal region. ', 'April-05-2018 16:23:16', 'betty@gmail.com', 'draft', '1485'),
(16, 'this is another site', '9000', 'houses and apartment for sale', 'kahahawa', '098765432', '13.jpg', 'thi is ?a chance The tourist attraction site located in kenyan coastal region. The tourist attraction site located in kenyan coastal region. ', 'April-05-2018 16:25:42', 'betty@gmail.com', 'published', '2073'),
(17, 'this is another site', '1234455', 'furnished and holiday rentals.', 'kahahawa', '098765', 'blue_water.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-05-2018 16:44:30', 'fram@gmail.com', 'published', '2730'),
(18, 'kamulu plots for sale', '660000', 'furnished and holiday rentals.', 'Nyahururu kwajiko', '07866666666', 'img12.JPG', ' and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'April-05-2018 16:49:53', 'john@gmail.com', 'published', '3084'),
(19, 'this is created', '1234455', 'office,shops and commercial.', 'kahahawa', '098765', '3.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', 'April-05-2018 16:51:08', 'mwas@gmail.com', 'published', '5073'),
(20, 'this is another image testing hype', '9000', 'houses and apartment for sale', 'kayole', '0987654', '3.jpg', 'thi is ?a chance The tourist attraction site located in kenyan coastal region. The tourist attraction site located in kenyan coastal region. ', 'April-10-2018 12:44:03', 'da@gmail.com', 'published', '8019'),
(21, 'this is another site', '1234455', 'houses and apartment for sale', 'fffdd', '098765', '13.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', 'April-10-2018 12:55:03', 'da@gmail.com', 'published', '6491'),
(22, 'rrrrrrrrrrrrrr', '66544', 'office,shops and commercial.', 'vfggnhh', '876543', 'mt.JPG', 'style=\'font-size:16px;\'', 'April-10-2018 18:11:27', 'da@gmail.com', 'published', '1747'),
(23, 'this is another site', '1234455', 'furnished and holiday rentals.', 'kiambu', '098765432', 'img7.jpg', '&lt;?php display_message();?&gt;', 'April-11-2018 10:13:42', 'john@gmail.com', 'published', '2647'),
(24, 'hello there', '89700', 'houses and apartment for sale', 'kericho', '098765432', 'blue_water.jpg', 'i is ?a chance The tourist attraction site located in kenyan coastal region. The tourist attraction site located in kenyan coastal region.', 'April-14-2018 14:15:44', 'betty@gmail.com', 'published', '1289'),
(25, 'here it is.', '34500', 'furnished and holiday rentals.', 'kasarani', '098765432', 'img2.jpg', 'thi is ?a chance The tourist attraction site located in kenyan coastal region. The tourist attraction site located in kenyan coastal region. ', 'April-16-2018 21:09:54', 'john@gmail.com', 'draft', '4752'),
(26, 'Kamulu', '7800', 'office,shops and commercial.', 'kawangware', '0987654', 'img16.jpg', ' It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-18-2018 12:28:38', 'betty@gmail.com', 'draft', '5834'),
(27, 'ffffg', '100000000', 'land and plots.', 'naks', '098765432', 'mara.jpg', 'dsrefrvhgvvftgvfrdercx', 'April-24-2018 22:05:42', 'betty@gmail.com', 'published', '4363'),
(28, 'Nyahurur plot', '320000', 'land and plots.', 'Nyahururu', '09876543', '15.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-25-2018 13:27:08', 'john@gmail.com', 'published', '4831'),
(29, 'betty posting ', '45000', 'land and plots.', 'kamulu', '098765', 'lion.jpg', ' It was popularised in the with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.It was popularised in the with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-26-2018 11:55:42', 'admin@gmail.com', 'draft', '1734'),
(30, 'this is another image testing hype', '1234455', 'land and plots.', 'kiambu', '098765', 'img15.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-26-2018 16:53:15', 'admin@gmail.com', 'published', '6455'),
(31, 'admin testing site', '44500', 'land and plots.', 'kinangop', '09876543', 'mara.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'April-26-2018 16:55:48', 'admin@gmail.com', 'published', '2598');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `date_time` varchar(200) NOT NULL,
  `ad_category` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `date_time`, `ad_category`, `author`) VALUES
(7, 'February-28-2018 15:44:55', 'houses and apartment for sale', 'njuguna'),
(8, '', 'furnished and holiday rentals.', 'mwas'),
(9, '', 'office,shops and commercial.', 'mwas'),
(10, '', 'land and plots.', 'nn');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` varchar(600) NOT NULL,
  `approved_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `admin_panel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `date_time`, `name`, `email`, `comment`, `approved_by`, `status`, `admin_panel_id`) VALUES
(9, '  March-07-2018 22:54:14', ' mwas', 'testing@gmail.com', 'this is a test.                               \r\n                            ', 'admin', 'ON', 13),
(10, '  March-07-2018 23:30:34', 'john doe', 'johndoe@gmail.com', ' Lorem Ipsum has been the industry\'s,Lorem Ipsum has been the industry\'s \nLorem Ipsum has been the industry\'s \nLorem Ipsum has been the industry\'s \n\n\n\n                    \n                            ', 'mwas', 'ON', 12),
(14, '  March-08-2018 23:42:46', 'TEST NAME', 'qww@gmail.com', '                 this is a great idea              \r\n                            ', '', 'OFF', 4),
(15, '  March-08-2018 23:43:03', 'sss', 'aaa@gmail', '              another test                 \r\n                            ', '', 'ON', 4),
(16, '  March-12-2018 21:45:15', 'hhh', 'ch@gmail.com', '               qqq                \r\n                            ', '', 'OFF', 15);

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
(19, 'victor', 'kamau', 'victor@gmail.com', '0715445860', 'ffc150a160d37e92012c196b6af4160d', 'ef8a4d956ae2db063ad46ead7108961a', 0, 'May-01-2018 22:11:36', 'logo.PNG', 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `admin_panel_id` (`admin_panel_id`);

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
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
