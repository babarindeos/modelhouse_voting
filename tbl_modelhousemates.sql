-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 10:06 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modelhousemates`
--

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `model_no` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `web_url` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `model_no`, `name`, `picture`, `web_url`, `date_created`) VALUES
(1, '001', 'TeeCasual', 'http://localhost/themodelhousemates/wp-content/uploads/2016/11/Abiodun-Timileyin-600x800.jpg', '', '2021-02-19 12:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(9) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `vote_option` int(3) NOT NULL,
  `channel` varchar(20) NOT NULL,
  `date_paid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reference`, `lastname`, `firstname`, `email`, `phone`, `amount`, `vote_option`, `channel`, `date_paid`) VALUES
(1, '001-487283438', 'Babarinde', 'John', 'babarindeos@funaab.edu.ng', '09061512289', '200000.00', 0, 'card', '0000-00-00 00:00:00'),
(2, '001-571576432', 'Anifowose', 'Isaac', 'kondishiva007@gmail.com', '08062624053', '150000.00', 3000, 'card', '0000-00-00 00:00:00'),
(3, '001-758593927', 'Smith', 'Isaac', 'seyi_babs2002@yahoo.com', '07085355750', '1000.00', 20, 'card', '0000-00-00 00:00:00'),
(4, '001-999826892', 'Anifowose', 'Isaac', 'kondishiva007@gmail.com', '08062624053', '2500.00', 50, 'card', '2021-02-19 21:38:10'),
(5, '001-836429214', 'Okwelum', 'Daniel', 'gbolahan3@yahoo.com', '08134767779', '1000.00', 20, 'card', '2021-02-19 21:40:03'),
(6, '001-939919799', 'Shiva', 'John', 'kondishiva008@gmail.com', '+234-803-2485-583', '500.00', 10, 'card', '2021-02-19 21:42:24'),
(7, '001-443828811', 'Shiva', 'John', 'kondishiva008@gmail.com', '+234-803-2485-583', '750.00', 15, 'card', '2021-02-19 21:44:24'),
(8, '001-469281235', 'Babarinde', 'John', 'babarindeos@funaab.edu.ng', '09061512289', '50.00', 1, 'card', '2021-02-19 23:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(9) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ticket_type` varchar(15) NOT NULL,
  `ticket_amount` varchar(40) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `referrer` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `fullname`, `phone`, `email`, `ticket_type`, `ticket_amount`, `reference`, `referrer`, `status`, `date_created`) VALUES
(1, 'Babarinde Oluwaseyi Abiodun', '07085355750', 'babarindeos@funaab.edu.ng', 'regular', '1000', 'regular-001-1614436100', '001', '', '2021-02-27 15:28:20'),
(2, 'Babarinde Oluwaseyi Abiodun', '07085355750', 'babarindeos@funaab.edu.ng', 'regular', '1000', 'regular-001-1614437381', '001', '', '2021-02-27 15:49:41'),
(3, 'Babarinde Oluwaseyi Abiodun', '08062624053', 'seyibabs.ng@gmail.com', 'moet', '50000', 'moet-000-1614437644', '', 'successful', '2021-02-27 15:54:04'),
(4, 'Babarinde Oluwaseyi Abiodun', '08062624053', 'babarindeos@funaab.edu.ng', 'regular', '1000', 'regular-000-1614463504', '', '', '2021-02-27 23:05:04'),
(5, 'Babarinde Oluwaseyi Abiodun', '08062624053', 'babarindeos@funaab.edu.ng', 'regular', '1000', 'regular-000-1614463530', '', 'successful', '2021-02-27 23:05:30'),
(6, 'Babarinde Oluwaseyi Abiodun', '07085355750', 'babarindeos@funaab.edu.ng', 'vip', '5000', 'vip-001-1614469010', '001', 'successful', '2021-02-28 00:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(9) NOT NULL,
  `model` varchar(50) NOT NULL,
  `votes` int(3) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `model`, `votes`, `reference`, `date_created`) VALUES
(1, '001', 3000, '001-571576432', '0000-00-00 00:00:00'),
(2, '001', 20, '001-758593927', '0000-00-00 00:00:00'),
(3, '001', 50, '001-999826892', '2021-02-19 21:38:10'),
(4, '001', 20, '001-836429214', '2021-02-19 21:40:03'),
(5, '001', 10, '001-939919799', '2021-02-19 21:42:24'),
(6, '001', 15, '001-443828811', '2021-02-19 21:44:24'),
(7, '001', 1, '001-469281235', '2021-02-19 23:26:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
