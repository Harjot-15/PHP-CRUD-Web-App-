-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 12:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_crud_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`Id`, `Title`, `Description`, `Image_path`) VALUES
(20, 'Learner Forever', 'My Name Is Harjot Singh', 'uploads/Harjot.jpg'),
(21, 'Sat Sri Akal', 'It Is Greeting In Punjabi', 'uploads/Sat Sri Akal.jpg'),
(22, 'I am From Punjab', 'I live In Hoshiarpur ANd Hrjot Is My Cousin', 'uploads/M 26.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `Id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `EMail` varchar(100) NOT NULL,
  `Password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`Id`, `Username`, `EMail`, `Password`) VALUES
(11, 'Harjot', 'harjotsinghtamber15@gmail.com', '$2y$10$NuHmbfwc7QSVinNp.GZgBuII.FQDeDxAPOO3QBsX2BNGnzlscxzva'),
(12, 'Gurminder Singh', 'guri@gmail.com', '$2y$10$GDups22TBAS08SyvxW9mO.YTY4BWR7aI78NP1thZHXzl3cr1AG7yy'),
(13, 'Harminder Singh', 'Baaz@gmail.com', '$2y$10$5uaC1XN53Im89on/t.W9.OmcBuLZ6WOxold3mdjxaY41ppxTkpyWS'),
(14, 'Harjot Singh', 'Beperwah@gmail.com', '$2y$10$T5xIaH9uEGxkDUadqwBVau1ABh0eFgHATZTVAZKXoj4rrGaYRY4I2'),
(15, 'Japinder Singh', 'Kaka@gmail.com', '$2y$10$XVaWwSM5Aga10EywNsxzn.iBIHHbypIuN8MNSTH5LUKsyMQgAzfjG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
