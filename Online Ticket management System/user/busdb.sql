-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2019 at 05:10 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_ticket`
--

CREATE TABLE `bus_ticket` (
  `server_id` int(11) NOT NULL,
  `bus_from` varchar(100) NOT NULL,
  `bus_to` varchar(100) NOT NULL,
  `bus_date` varchar(100) NOT NULL,
  `ticket_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_ticket`
--

INSERT INTO `bus_ticket` (`server_id`, `bus_from`, `bus_to`, `bus_date`, `ticket_no`) VALUES
(2, 'Dhaka', 'Chittagong', '28-07-2019', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_handle`
--

CREATE TABLE `user_handle` (
  `server_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_handle`
--

INSERT INTO `user_handle` (`server_id`, `username`, `pass`) VALUES
(1, 'user1', 'pass1'),
(2, 'user2', 'pass2');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `server_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`server_id`, `first_name`, `last_name`, `email`, `contact_no`) VALUES
(1, 'Jhon', 'Doe', 'jhon@mail.com', '01437891425'),
(2, 'Kelly', 'Broke', 'kelly@mail.com', '01456783256');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_ticket`
--
ALTER TABLE `bus_ticket`
  ADD PRIMARY KEY (`server_id`,`bus_from`,`bus_to`,`bus_date`,`ticket_no`) USING BTREE;

--
-- Indexes for table `user_handle`
--
ALTER TABLE `user_handle`
  ADD PRIMARY KEY (`server_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`server_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_ticket`
--
ALTER TABLE `bus_ticket`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_ticket`
--
ALTER TABLE `bus_ticket`
  ADD CONSTRAINT `btfkui` FOREIGN KEY (`server_id`) REFERENCES `user_info` (`server_id`);

--
-- Constraints for table `user_handle`
--
ALTER TABLE `user_handle`
  ADD CONSTRAINT `ulFKui` FOREIGN KEY (`server_id`) REFERENCES `user_info` (`server_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
