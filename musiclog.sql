-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Ago-2019 às 13:29
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musiclog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entries`
--

CREATE TABLE `entries` (
  `entry_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mp3music`
--

CREATE TABLE `mp3music` (
  `music_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `album` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `music_file` blob NOT NULL,
  `file_renamed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL,
  `playlist_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_permission` enum('a','b','c') NOT NULL DEFAULT 'a',
  `email_activation` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `music_id` (`music_id`,`playlist_id`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `user_id` (`entry_id`);

--
-- Indexes for table `mp3music`
--
ALTER TABLE `mp3music`
  ADD PRIMARY KEY (`music_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mp3music`
--
ALTER TABLE `mp3music`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`music_id`) REFERENCES `mp3music` (`music_id`),
  ADD CONSTRAINT `entries_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Limitadores para a tabela `mp3music`
--
ALTER TABLE `mp3music`
  ADD CONSTRAINT `mp3music_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
