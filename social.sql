-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2021 at 05:15 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`id`, `user_id`, `post_id`, `comment`) VALUES
(1, 2, 1, 'Any fool can write code that a computer can understand. Good programmers write code that humans can understand.'),
(2, 1, 2, 'I gotta say it There is nothing like it'),
(3, 3, 1, 'Sometimes it pays to stay in bed on Monday, rather than spending the rest of the week debugging Monday’s code'),
(4, 3, 2, 'I once watched this movie and it was too violent'),
(5, 1, 1, 'Fix the cause, not the symptom');

-- --------------------------------------------------------

--
-- Table structure for table `FollowUser`
--

CREATE TABLE `FollowUser` (
  `id` int(11) NOT NULL,
  `following_user_id` int(11) DEFAULT NULL,
  `followed_user_id` int(11) NOT NULL,
  `followed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `FollowUser`
--

INSERT INTO `FollowUser` (`id`, `following_user_id`, `followed_user_id`, `followed`) VALUES
(1, 2, 2, 1),
(2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id`, `title`, `picture`, `description`, `date_created`, `user_id`, `likes`) VALUES
(1, 'Programming is good', 'controllers/Screenshot from 2021-05-25 01-44-30.png', 'The late Steve Jobs himself said it that: \"Everyone should know how to program a computer because it teaches you how to think\"', '2021-06-16', 1, NULL),
(2, 'pulp fiction', 'controllers/pulp_fiction.jpeg', 'The movie goes down as one of the most watched and enjoyed movie of all time', '2021-06-17', 2, NULL),
(3, 'Suu House Of Cakes', 'controllers/the_creation_of_adam.jpg.jpg', 'Dont bother userlf looking for a baker, Go to Suu house of cake to get the best ', '2021-06-17', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `PostLike`
--

CREATE TABLE `PostLike` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PostLike`
--

INSERT INTO `PostLike` (`id`, `user_id`, `post_id`, `active`) VALUES
(1, 1, 1, 0),
(4, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `signup_date` date NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(50) DEFAULT NULL,
  `number_of_posts` int(11) NOT NULL DEFAULT 0,
  `number_of_followers` int(11) NOT NULL DEFAULT 0,
  `number_of_likes` int(11) NOT NULL DEFAULT 0,
  `friends` int(11) NOT NULL DEFAULT 0,
  `twitter_username` varchar(50) DEFAULT NULL,
  `facebook_username` varchar(50) DEFAULT NULL,
  `instagram_username` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `first_name`, `last_name`, `username`, `email`, `user_password`, `signup_date`, `profile_picture`, `number_of_posts`, `number_of_followers`, `number_of_likes`, `friends`, `twitter_username`, `facebook_username`, `instagram_username`, `address`, `phone_number`, `is_active`) VALUES
(1, 'Gerald', 'Sanga', 'gerrysanga', 'gerrysanga@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-16', NULL, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'Hellen', 'Mgeni', 'hellena', 'hellena@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-16', NULL, 1, 2, 0, 0, 'hellena', 'hellena', 'hellena', 'Machava - Kigamboni', '0789678678', 1),
(3, 'Neema', 'Mracha', 'neymracha', 'neyoscar@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-17', NULL, 1, 0, 0, 0, 'neema', 'neema', 'neema25', 'Sinza Ilala', '0789678678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `FollowUser`
--
ALTER TABLE `FollowUser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `following_user_id` (`following_user_id`),
  ADD KEY `followed_user_id` (`followed_user_id`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `PostLike`
--
ALTER TABLE `PostLike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `FollowUser`
--
ALTER TABLE `FollowUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `PostLike`
--
ALTER TABLE `PostLike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `FollowUser`
--
ALTER TABLE `FollowUser`
  ADD CONSTRAINT `FollowUser_ibfk_1` FOREIGN KEY (`following_user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FollowUser_ibfk_2` FOREIGN KEY (`followed_user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PostLike`
--
ALTER TABLE `PostLike`
  ADD CONSTRAINT `PostLike_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PostLike_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
