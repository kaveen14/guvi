-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 07:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `name` text NOT NULL,
  `dob` date DEFAULT NULL,
  `age` int(6) NOT NULL,
  `gender` text NOT NULL,
  `national` text NOT NULL,
  `qualify` text NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `state` text NOT NULL,
  `city` text NOT NULL,
  `pincode` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`name`, `dob`, `age`, `gender`, `national`, `qualify`, `mobile`, `email`, `password`, `address`, `state`, `city`, `pincode`) VALUES
('sekar', '2001-11-01', 21, 'Male', 'Indian', 'M.Sc.computer science', 9629894628, 'sekar14@gmail.com', 'sekar14', '1/27 East street,\nputhanampatti', 'Tamil Nadu', 'coimbatore', 641014),
('Abinash', '2001-02-12', 21, 'Male', 'Indian', 'B.Sc.Computer science', 6380541996, 'abinash14@gmail.com', 'abinash14', '188 north street', 'Tamil Nadu', 'Salem', 610024),
('kaveenkumar', '2001-03-09', 21, 'Male', 'Indian', 'M.Sc.computer science', 9629894628, 'kaveensekar1456@gmail.com', 'kaveen1456', 'kattur street', 'Tamil Nadu', 'coimbatore', 641031);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
