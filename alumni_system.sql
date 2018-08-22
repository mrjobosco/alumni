-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2018 at 12:12 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `create_time` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `create_time`) VALUES
(1, 'General', 'this category takes care of the admission process of the university', '1477555303');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `content` text NOT NULL,
  `updateTime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user1`, `user2`, `content`, `updateTime`) VALUES
(38, 10, 15, 'hello', '1481726565'),
(39, 10, 15, 'hey', '1481726568'),
(40, 15, 10, 'hey', '1481726632'),
(41, 15, 10, 'can u hear me', '1481726642'),
(42, 10, 15, 'dddfdf', '1481726673'),
(43, 15, 10, 'dfdgn dfgfnfegv rggeg', '1481726679'),
(44, 15, 10, 'hello', '1481813121'),
(45, 10, 15, 'whats up now', '1481813138'),
(46, 15, 10, 'am good and you nko???', '1481813148'),
(47, 10, 15, 'slow ', '1481813155'),
(48, 10, 15, 'quite slow', '1481813160'),
(49, 15, 10, 'yap i noticed i really noticed', '1481813177'),
(50, 10, 15, 'am fingers are faster than this chat', '1481813199'),
(51, 15, 10, 'elo', '1481813227'),
(64, 10, 15, 'hey', '1482053766'),
(65, 15, 10, 'whats up now', '1482053789'),
(66, 10, 15, 'hello', '1482054740'),
(67, 15, 10, 'hello', '1482054811'),
(68, 15, 10, 'hi', '1482054831'),
(69, 15, 10, 'Sam say', '1482054855'),
(70, 10, 15, 'admin Say', '1482054860'),
(71, 16, 10, 'hello', '1482076067'),
(72, 10, 16, 'hi', '1482076080'),
(73, 10, 16, 'hi', '1482076088'),
(74, 10, 16, 'gdfd', '1482076119'),
(75, 16, 10, 'dfdf', '1482076125'),
(76, 18, 16, 'sdd', '1534723787'),
(77, 18, 16, 'scsdsd', '1534723847'),
(78, 18, 16, 'sddsd', '1534723850');

-- --------------------------------------------------------

--
-- Table structure for table `chat_event`
--

CREATE TABLE `chat_event` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `currentChatTime` int(11) NOT NULL,
  `lastCheckedTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_event`
--

INSERT INTO `chat_event` (`id`, `user1`, `user2`, `currentChatTime`, `lastCheckedTime`) VALUES
(5, 15, 10, 10, 10),
(7, 16, 10, 0, 0),
(9, 16, 15, 0, 0),
(10, 17, 10, 0, 0),
(11, 17, 15, 0, 0),
(12, 17, 16, 0, 0),
(13, 18, 10, 0, 0),
(14, 18, 15, 0, 0),
(15, 18, 16, 0, 0),
(16, 18, 17, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `create_time` varchar(1024) NOT NULL,
  `votes_up` int(11) NOT NULL,
  `votes_down` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `question_id`, `creator_id`, `post`, `create_time`, `votes_up`, `votes_down`) VALUES
(1, 1, 16, '25th of this month', '1482077734', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `description`, `author_id`, `create_time`, `status`, `category_id`) VALUES
(1, 'Please when is the next seminar holding', 'Please when is the next seminar holding?', 16, 1482077694, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_tags`
--

CREATE TABLE `question_tags` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_tags`
--

INSERT INTO `question_tags` (`id`, `question_id`, `tag_id`) VALUES
(1, 1, 3),
(2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `create_time` varchar(1014) NOT NULL,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `post_id`, `reply`, `create_time`, `creator_id`) VALUES
(1, 1, 'this is correct\n', '1482077758', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `description`, `count`) VALUES
(1, '1997', '', 1),
(2, 'reunion', '', 1),
(3, 'seminar', '', 1),
(4, 'holding', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `comment` text NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `creator_id`, `topic_id`, `create_time`, `comment`, `votes`) VALUES
(1, 16, 1, 1482076654, 'this is not cool', 1),
(2, 16, 1, 1482076773, 'reunion on the second of this month\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `threads_reply`
--

CREATE TABLE `threads_reply` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `threads_reply`
--

INSERT INTO `threads_reply` (`id`, `thread_id`, `reply`, `create_time`, `creator_id`) VALUES
(1, 1, 'yap not cool', '1482076743', 16);

-- --------------------------------------------------------

--
-- Table structure for table `threads_reply_votes`
--

CREATE TABLE `threads_reply_votes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `threads_reply_votes`
--

INSERT INTO `threads_reply_votes` (`id`, `post_id`, `user_id`, `status`) VALUES
(1, 1, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `description` text NOT NULL,
  `creator_id` int(11) NOT NULL,
  `create_time` varchar(1024) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `description`, `creator_id`, `create_time`, `category_id`) VALUES
(1, 'Whats up with the reunion 1997', 'fhnfghfh hddjgm dfj f', 10, '1482076277', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topic_tags`
--

CREATE TABLE `topic_tags` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_tags`
--

INSERT INTO `topic_tags` (`id`, `topic_id`, `tags_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `topic_views`
--

CREATE TABLE `topic_views` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_views`
--

INSERT INTO `topic_views` (`id`, `topic_id`, `count`) VALUES
(1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `profile_picture` varchar(1024) NOT NULL,
  `online` int(11) NOT NULL DEFAULT '0',
  `year_of_graduation` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `place_of_work` text,
  `department` text,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `salt`, `email`, `user_type`, `profile_picture`, `online`, `year_of_graduation`, `phone_number`, `place_of_work`, `department`, `address`) VALUES
(10, 'admin', 'admin', 'admin', '6b8781ff4469fb498eb9c24d99a097e2f64af91134d021fa9cdc02a7ffc8fcbd', '²CRý•‡ÎjòQ5î})XB,½$¶GfSOþîZ¥9·#ÄU…‘{$ºˆŽ9‡.chl†ŠžsÒFN¾é	', 'admin@gmail.con', 1, 'images/male.jpg', 0, NULL, NULL, NULL, NULL, NULL),
(15, 'Samuel', 'Kwabe', 'samuel', '14cd5a85c8b66b3e3462022f1034cb73f3f4070dc771ef3d417f061ae979f5e1', '¡±vÑP§§†\05ú°8¤@ùvÉSÈ™K3•F‚…Í‚ç¾¯ÈÆ•}.iÖ…Ï¹´jãI!¹ÁÙ£/°â', 'samuealkwabe@gmail.com', 4, 'file/images/0cjoesph passport.jpg', 0, NULL, NULL, NULL, NULL, NULL),
(16, 'ifeanyi', 'onuoha', 'fxonuoha', '430a9c59c0547bcbc1890a5ff8abab096e9db337bc9f6f8df9486efaae67b221', '™öÀ_[f¤·®"IÙè$;g’H©„{&Ï€“¢¹©kÕ6&Ùü>Œƒ	.7wýý/NDfs®§‚&}¹mÄmd¹', 'checkonuoha@yahoo.com', 2, 'file/images/33avengers-hulk.jpg', 1, NULL, NULL, NULL, NULL, NULL),
(17, 'dfvf', 'dvsv', 'joey', '687204e3c40376b08f1b000b3026df463020ae9d096d7083e662f9aaa97b99fc', 'í)(Ö}U“•å>*Á®|ûoCFöâ_þŒ·êŽÚguÆ!3Dá<ÀÉ?²šÓñ‡ÌT¸—]Üt­ñbd¦¨h®ï', 'mrjobosco@gmail.com', 4, 'images/male.jpg', 0, NULL, NULL, NULL, NULL, NULL),
(18, 'dflvm', 'dfdf', 'hey', 'ff57b71fb61de1957ac70f99cf970544e4daafd967b333bc4f03ba1af9534382', '²hÈSO3_½Àâ¦¹…ny„Z´ò3õ`ÔQF«ÌW¸#[ ß¢¡—=ä$ËèÌµéœêí`å<Í×+ì5', 'mlkfdlf@gmail.com', 4, 'images/male.jpg', 1, '2015', '07032832738', 'Sokoto', 'Sokoto', 'SOkoto');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`, `description`) VALUES
(1, 1, 'Administrator'),
(2, 2, 'moderator'),
(3, 3, 'student'),
(4, 4, 'Guest Student');

-- --------------------------------------------------------

--
-- Table structure for table `user_views`
--

CREATE TABLE `user_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `view_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `question_id`, `count`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `post_id`, `user_id`, `status`) VALUES
(1, 1, 16, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_event`
--
ALTER TABLE `chat_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`question_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `categoy_id` (`category_id`);

--
-- Indexes for table `question_tags`
--
ALTER TABLE `question_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `threads_reply`
--
ALTER TABLE `threads_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `threads_reply_votes`
--
ALTER TABLE `threads_reply_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `topic_tags`
--
ALTER TABLE `topic_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `tags_id` (`tags_id`);

--
-- Indexes for table `topic_views`
--
ALTER TABLE `topic_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_views`
--
ALTER TABLE `user_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `chat_event`
--
ALTER TABLE `chat_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `question_tags`
--
ALTER TABLE `question_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `threads_reply`
--
ALTER TABLE `threads_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `threads_reply_votes`
--
ALTER TABLE `threads_reply_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `topic_tags`
--
ALTER TABLE `topic_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `topic_views`
--
ALTER TABLE `topic_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_views`
--
ALTER TABLE `user_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `moderator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `question_tags`
--
ALTER TABLE `question_tags`
  ADD CONSTRAINT `question_tags_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `question_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `threads_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `topic_tags`
--
ALTER TABLE `topic_tags`
  ADD CONSTRAINT `topic_tags_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`),
  ADD CONSTRAINT `topic_tags_ibfk_2` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`);

--
-- Constraints for table `user_views`
--
ALTER TABLE `user_views`
  ADD CONSTRAINT `user_views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_views_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
