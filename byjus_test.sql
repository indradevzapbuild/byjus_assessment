-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2019 at 12:39 AM
-- Server version: 5.7.20-0ubuntu0.17.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `byjus_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic_info`
--

CREATE TABLE `basic_info` (
  `id` int(11) NOT NULL,
  `first_name` text,
  `last_name` text,
  `email` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basic_info`
--

INSERT INTO `basic_info` (`id`, `first_name`, `last_name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'qzlQ3C4fIT5z0ph2B1jvlUGj6gBK+7aKnRVAhMoAAdPVgt2u/GDG', 'zIaULLWuNQu5GiIjvw7LKK7ujBmN9TjZ1sq2Ay9cw6fL4qShf68=', 'd/85CkZLsKNmvTxYVzfOPDcMfQRDoGBI8sWsbxHUVp61T8kyCDZ7XpmVtIQQcEOyewL9rq7sdg==', '2019-02-06 17:06:53', '2019-02-06 11:36:53'),
(2, 'hjG4MSDaysU3zQm2bfv0cNYGN9wv5+gPMmml0jXHnYTxS6NtxgGpsw==', '8VUYHhZ4XaLEG7Oo7+9VLcsNhnF2TWws9s/K1j3HXWxzV51j5xM=', 'Wb99S3mdv0HH5MucJH2oOVg5XmJESJOPuWkObuVsCmjYvRu1IRXfBPi8NWq70SB4FcIfXUbsgW7hLGgU', '2019-02-06 17:07:21', '2019-02-06 11:37:21'),
(3, 'w2xgpq7xli4F8oSOWl1OeP2HTkhTDi+HduD1sF0UFfevceu2', 'kLJMQCZ4izQGNkW0g7ZmVCCVH/1BC3gVoTPpUpV8F1EMc9DhD2qN', '1c68qc3EPTsnYlAiPJ3das0M+9Wqug6Axb/g9l+vPHqcoiLgzU7P0RRSN6FvRWTvzw==', '2019-02-06 23:44:52', '2019-02-06 18:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `college_location` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `college_location`, `created_at`, `updated_at`, `url`) VALUES
(1, 'JMIT', 'Haryana', '2019-02-07 00:12:27', '2019-02-06 18:42:28', 'http://jmit.ac.in/board-of-governors-at-jmit/'),
(2, 'JMIT', 'Mohali', '2019-02-07 00:17:11', '2019-02-06 18:47:11', 'http://jmit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `fname`, `lname`, `email`, `location`, `country`, `picture_url`, `profile_url`, `created`, `modified`) VALUES
(3, 'linkedin', 'all-FKxRc4', 'Indradev', 'Prasad', 'kumarindradevd9211@gmail.com', 'Chandigarh Area, India', 'in', 'https://media.licdn.com/dms/image/C5103AQH1pyjdpJ2Z5g/profile-displayphoto-shrink_100_100/0?e=1554940800&v=beta&t=P6FL7nTh9fbVQ1gn9n6UcAoiFdPmduYdaT9uHcD95Xk', 'http://www.linkedin.com/in/indradev-prasad', '2019-02-06 15:12:14', '2019-02-06 20:49:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_info`
--
ALTER TABLE `basic_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_info`
--
ALTER TABLE `basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
