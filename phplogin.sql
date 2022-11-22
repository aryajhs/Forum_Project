-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 05:52 AM
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
-- Database: `phplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'defaultprofilepic.jpg',
  `bio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `profilepic`, `bio`) VALUES
(1, 'Himanshu', 'Ninja', 'test@test.com', '', ''),
(2, 'aryan', 'aryan', 'aryajhs08@gmail.com', '', ''),
(3, 'grave', '1234', 'aryajhs08@gmail.com', 'fx7u4zjb3ub61.jpg', 'GIGA NIGA'),
(4, 'arya', '12345', 'aryajhs08@gmail.com', '', ''),
(5, 'arya1', '12345', 'aryajhs08@gmail.com', '', ''),
(9, 'aditya', '12345', 'aryajhs08@gmail.com', '', ''),
(10, 'dudu', '1234', 'aryajhs08@gmail.com', '', ''),
(11, 'kaamlu', 'supra', 'kaamlu@gmail.com', '', ''),
(12, 'aryang', '12345', 'fdgfdgfd@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` int(11) NOT NULL,
  `commentuser` varchar(255) NOT NULL,
  `postid` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `commentts` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `commentuser`, `postid`, `comment`, `commentts`) VALUES
(1, 'grave', 18, 'hiii', '1668617498'),
(2, 'grave', 18, 'Hiiiiiiiii', '1668617567'),
(3, 'grave', 18, 'kjlhvgb', '1668617757'),
(4, 'grave', 18, 'koko', '1668617991'),
(5, 'grave', 18, 'rtujrtjh', '1668618016'),
(6, 'grave', 18, 'eryhsysryd', '1668618020'),
(7, 'grave', 18, 'fgjtghfgh', '1668618024'),
(8, 'grave', 18, 'dfhdfhdfhdfh', '1668618027'),
(9, 'grave', 18, 'dfhfdhexdhj', '1668618036'),
(10, 'grave', 18, 'ytgfghdfh', '1668618045'),
(11, 'grave', 18, 'wferwgt', '1668618064'),
(12, 'aryang', 18, 'hgjhg', '1668618168');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `postuser` varchar(30) DEFAULT NULL,
  `posttitle` varchar(255) DEFAULT NULL,
  `postcontent` varchar(3000) DEFAULT NULL,
  `postimage` varbinary(8000) NOT NULL,
  `postvideo` varchar(255) DEFAULT NULL,
  `postscore` int(11) DEFAULT 0,
  `postts` varchar(100) NOT NULL,
  `upvotes` int(11) DEFAULT 0,
  `downvotes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `postuser`, `posttitle`, `postcontent`, `postimage`, `postvideo`, `postscore`, `postts`, `upvotes`, `downvotes`) VALUES
(9, 'grave', 'Testing ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 0, '1668288569', 0, 0),
(10, 'grave', 'Devops', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis hendrerit dolor magna eget est lorem ipsum dolor sit. Tincidunt ornare massa eget egestas purus. Amet tellus cras adipiscing enim eu turpis egestas. Aliquam purus sit amet luctus venenatis lectus. Mi tempus imperdiet nulla malesuada pellentesque elit eget gravida cum. Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio eu. Sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. In nibh mauris cursus mattis molestie a iaculis at erat. Porttitor massa id neque aliquam vestibulum morbi blandit cursus. Tortor condimentum lacinia quis vel eros donec. Feugiat in ante metus dictum at tempor commodo. Enim sit amet venenatis urna cursus eget nunc scelerisque.', '', NULL, 0, '1668288626', 0, 0),
(11, 'arya', 'ProjectUpdate', 'Donec pretium vulputate sapien nec sagittis. Faucibus turpis in eu mi bibendum. In nibh mauris cursus mattis molestie a iaculis. Quis lectus nulla at volutpat diam ut. Venenatis tellus in metus vulputate. Duis convallis convallis tellus id interdum velit. Tristique nulla aliquet enim tortor at auctor urna nunc id. Gravida dictum fusce ut placerat orci nulla pellentesque dignissim enim.', '', NULL, 0, '1668288678', 0, 0),
(12, 'arya', 'LOGO', '', '', NULL, 0, '1668348048', 0, 0),
(13, 'grave', 'update X', 'Neque convallis a cras semper auctor neque vitae. Nibh sit amet commodo nulla facilisi nullam vehicula. At auctor urna nunc id cursus metus. Orci porta non pulvinar neque laoreet suspendisse interdum. Ultricies lacus sed turpis tincidunt id aliquet risus feugiat. Ultricies mi quis hendrerit dolor magna eget. Sapien eget mi proin sed libero. In hac habitasse platea dictumst. A diam sollicitudin tempor id eu nisl nunc. Ut venenatis tellus in metus vulputate', '', NULL, 0, '1668385742', 0, 0),
(15, 'arya', 'asdfghjkl', 'lorem repsum ohiasfuh husyagcbvjs asuhdfb jsedfbj oiub lwskjdfb hjdgvf hbf oasdyjfbv slikbf ldjkbf lkjg prghb pwjifrbg kjwgb kjgb adksjhbv slkjbf drbg', '', NULL, 0, '1668392362', 0, 0),
(16, 'arya', 'le kheech meri photo2.0', NULL, 0x6f6d6e69322e706e67, NULL, 0, '1668392399', 0, 0),
(17, 'grave', 'Resizing', NULL, 0x706578656c732d6976616e2d626572746f6c617a7a692d323638313331392e6a7067, NULL, 0, '1668438859', 0, 0),
(18, 'grave', 'testing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 0, '1668552698', 0, 0),
(20, 'grave', 'LOGO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 0, '1668618621', 0, 0),
(21, 'grave', 'logo2.1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 0, '1668620900', 0, 0),
(22, 'grave', 'update X', NULL, '', 'Your-Name-Anime-Whatsapp-Status-Video.mp4', 0, '1668788551', 0, 0),
(23, 'grave', 'DEMO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 0, '1669005881', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

CREATE TABLE `save` (
  `saveid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`saveid`, `postid`, `username`) VALUES
(1045, 23, 'grave'),
(1046, 22, 'grave'),
(1047, 21, 'grave'),
(1048, 20, 'grave'),
(1049, 18, 'grave'),
(1050, 17, 'grave'),
(1051, 16, 'grave'),
(1052, 15, 'grave'),
(1053, 13, 'grave'),
(1054, 12, 'grave'),
(1055, 11, 'grave'),
(1056, 10, 'grave'),
(1057, 9, 'grave');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`saveid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `save`
--
ALTER TABLE `save`
  MODIFY `saveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1058;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
