-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 06:34 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_teacher_review`
--
CREATE DATABASE IF NOT EXISTS `db_teacher_review` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_teacher_review`;

-- --------------------------------------------------------

--
-- Table structure for table `db_reviews`
--

CREATE TABLE `db_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `rating` varchar(64) NOT NULL,
  `post` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_reviews`
--

INSERT INTO `db_reviews` (`id`, `user_id`, `teacher_id`, `rating`, `post`, `date`) VALUES
(1, 2, 1, '[5,5,5,5]', 'He helped me quite a lot during my secondary school days...', '2020-01-02 17:16:29'),
(3, 1, 2, '[4,5,5,5]', 'Their teaching is better than my teacher.', '2020-01-02 17:35:12'),
(4, 2, 3, '[5,5,4,3.5]', 'His german class is the best. ', '2020-01-03 15:18:28'),
(6, 2, 2, '[5,4,4,2]', 'His pacing is as slow as snail but he is fine other than that.', '2020-01-07 19:43:34'),
(7, 2, 4, '[5,5,4.5,5]', 'Tan Swee Fong is the best teacher makes lesson easy.', '2020-01-09 17:00:35'),
(8, 58, 1, '[3.5,3,4,5]', 'Good teacher, funniest thing is the name sounds the same as a football player.', '2020-01-14 18:48:02'),
(10, 3, 4, '[5,5,4,4]', 'Helps me with 1-on-1 tutoring and always give his all. Whenever you need help, please ask him for advice!', '2020-01-14 19:00:31'),
(11, 3, 1, '[3.5,4,5,4.5]', 'Programming has never been more fun with Mr Rashford.', '2020-01-17 14:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `db_teachers`
--

CREATE TABLE `db_teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `cur_school` varchar(64) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `portfolio` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_teachers`
--

INSERT INTO `db_teachers` (`id`, `name`, `cur_school`, `subject`, `portfolio`) VALUES
(1, 'Marcus Rashford', 'Springfield Secondary School', 'English, Mathematics, Programming', 'https://www.asianTwist.com/'),
(2, 'Long John', 'Whitley Secondary School', 'Cooking', 'https://www.longjohnsilver.com/'),
(3, 'Phillip Lahm', 'Whitley Secondary School', 'Language, Mathematics', ''),
(4, 'Tan Swee Fong', 'Nanyang Polytechnic', 'Mathematics, Accounting', 'https://www.linkedin.com/in/swee'),
(5, 'Mark Louis', 'Ang Mo Kio Secondary School', 'Physical Education', '');

-- --------------------------------------------------------

--
-- Table structure for table `db_users`
--

CREATE TABLE `db_users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `logged_in` int(1) NOT NULL DEFAULT '0',
  `privilege` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_users`
--

INSERT INTO `db_users` (`id`, `name`, `pass`, `email`, `logged_in`, `privilege`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 0, 1),
(2, 'NWNPoly', 'Rice', 'nwnpoly@gmail.com', 0, 0),
(3, 'Luke_ShawE12', 'iamluke', 'nwnpoly@gmail.com', 1, 0),
(58, 'PewDiePie', 'pewpewpew', 'nwnpoly@gmail.com', 0, 0),
(59, 'BingoMan', 'dingding', 'bingo@gmail.com', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_reviews`
--
ALTER TABLE `db_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`,`teacher_id`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `db_teachers`
--
ALTER TABLE `db_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_reviews`
--
ALTER TABLE `db_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `db_teachers`
--
ALTER TABLE `db_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `db_users`
--
ALTER TABLE `db_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_reviews`
--
ALTER TABLE `db_reviews`
  ADD CONSTRAINT `db_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `db_users` (`id`),
  ADD CONSTRAINT `db_reviews_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `db_teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
