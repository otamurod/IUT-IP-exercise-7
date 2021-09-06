-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2021 at 02:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
     `id` int(11) NOT NULL,
     `title` varchar(250) NOT NULL,
     `body` text NOT NULL,
     `publishDate` date NOT NULL,
     `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `publishDate`, `userId`) VALUES
(1, 'THE SEVEN HABITS OF HIGHLY EFFECTIVE PEOPLE', 'Stephen Covey has written a remarkable book about the human condition, so elegantly written, so\r\nunderstanding of our embedded concerns, so useful for our organization and personal lives, that it\'s\r\ngoing to be my gift to everyone I know.\r\n-- Warren Bennis, author of On Becoming a Leader\r\nI\'ve never known any teacher or mentor on improving personal effectiveness to generate such an\r\noverwhelmingly positive reaction.... This book captures beautifully Stephen\'s philosophy of principles.\r\nI think anyone reading it will quickly understand the enormous reaction I and others have had to Dr.\r\nCovey\'s teachings.\r\n-- John Pepper, President, Procter and Gamble', '2021-04-11', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `dob`) VALUES
(11, 'otamurod', 'o.safarov@student.inha.uz', 'Password', 'Otamurod Safarov', '1999-05-16'),
(12, 'bobur', 'b.abdurakhmonov@gmail.com', 'boburbek', 'Bobur Abdurakhmonov', '1990-04-12'),
(13, 'ibrokhimbek', 'I.Saparov@gmail.com', 'ibrokhimbek', 'Ibrokhimbek Saparov', '1990-09-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;