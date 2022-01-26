-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 09:01 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_trans`
--

CREATE TABLE `inquiry_trans` (
  `trans_id` int(11) NOT NULL,
  `trans_inquiry_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` double(16,2) NOT NULL,
  `qty` int(101) NOT NULL,
  `final_amount` double(16,2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry_trans`
--

INSERT INTO `inquiry_trans` (`trans_id`, `trans_inquiry_id`, `product_id`, `rate`, `qty`, `final_amount`, `status`) VALUES
(1, 17, 10, 5550.00, 5, 27750.00, 0),
(2, 17, 12, 220.00, 7, 1540.00, 0),
(3, 17, 11, 150.00, 5, 750.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiry_trans`
--
ALTER TABLE `inquiry_trans`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiry_trans`
--
ALTER TABLE `inquiry_trans`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
