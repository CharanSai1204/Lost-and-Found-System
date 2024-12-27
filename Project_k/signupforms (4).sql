-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2023 at 08:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signupforms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(10) NOT NULL,
  `username` varchar(7) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'O190304', 'brahmi'),
(2, 'O190391', 'datascience'),
(3, 'O190702', '702'),
(4, 'O190424', '424'),
(5, 'O190374', '374');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `title`, `description`, `image`) VALUES
(1, 'guddu', 'guddu poindhi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `FoundItems`
--

CREATE TABLE `FoundItems` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ID_Number` varchar(100) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` int(10) NOT NULL,
  `ItemName` varchar(20) NOT NULL,
  `ItemType` varchar(20) NOT NULL,
  `ItemColor` varchar(20) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Image` varchar(3000) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Searching'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FoundItems`
--

INSERT INTO `FoundItems` (`ID`, `Name`, `ID_Number`, `Email`, `Phone`, `ItemName`, `ItemType`, `ItemColor`, `Description`, `Date`, `Location`, `Image`, `Status`) VALUES
(1, 'A Charan Sai', 'O190304', 'eren123@gmail.com', 964079023, 'Vivo Y21', 'Mobile', 'Blue', 'I.ve Found A mobile in Seminar hall', '2023-11-25', 'College Seminar Hall', 'mobile.png', 'Searching');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(360) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `LostItems`
--

CREATE TABLE `LostItems` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ID_Number` varchar(100) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` int(10) NOT NULL,
  `ItemName` varchar(20) NOT NULL,
  `ItemType` varchar(20) NOT NULL,
  `ItemColor` varchar(20) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Image` varchar(5000) NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'searching'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LostItems`
--

INSERT INTO `LostItems` (`ID`, `Name`, `ID_Number`, `Email`, `Phone`, `ItemName`, `ItemType`, `ItemColor`, `Description`, `Date`, `Location`, `Image`, `Status`) VALUES
(1, 'A Charan Sai Tej Kumar', 'O190304', 'eren123@gmail.com', 964079023, 'times', 'watch', 'silver', 'I\'ve lost my watch today in my classroom', '2023-11-25', 'In Classroom ,CSE-C', 'watch.jpg', 'searching'),
(2, 'V Vijay kumar Achari', 'O190324', 'achari@gmail.com', 964892479, 'Maxx Earpods ', 'Earpods', 'Black', 'I\'ve Lost My earpods today in the canteen,if anyone find them please return it to me', '2023-11-25', 'College Canteen', 'earpods.webp', 'searching'),
(3, 'Sandeep', 'O1903351', 'Sandy123@gmail.com', 874623479, 'Vivo Y21', 'Mobile Phone', 'Navy Blue', 'I\'ve Lost My Mobile Today in Seminar Hall,If anyone find it please give it to me ', '2023-11-25', 'College seminar hall', 'mobile.png', 'searching');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `FirstName`, `LastName`, `Email`, `Username`, `Password`) VALUES
(1, 'Charan Sai', '', 'astylishcherry123@gmail.com', 'O190304', '1029c'),
(3, 'Narasimha', 'Patnaik', 'patnaiknarasimha4747@gmail.com', 'O190320', '4747'),
(4, 'Sandeep', 'Serangi', 'serangisandeep2129@gmail.com', 'O190251', '2129'),
(5, 'Abhishek', 'Naik', 'sheiksheik@gmail.com', 'O190317', 'sheik'),
(6, 'bhai', 'zoo', 'bhai@zoo.com', 'o190175', 'biryani'),
(7, 'Manoj Kumar', 'Vadithya', 'manojkumar@gmail.com', 'O190755', '1234'),
(8, 'Vanitha', 'Kotla', 'vanitha123@gmail.com', 'O190391', '1789'),
(9, 'x', 'y', 'xy@gmail.com', 'O19001', '001'),
(10, 'abc', 'xyz', 'abc@gmail.com', 'O190002', '002'),
(11, 'Kilbil ', 'pandey', 'ilakathamaflia@gmail.com', 'O190335', '1029'),
(12, 'ilakatha', 'maflia', 'abc@gmail.com', 'O190321', '123'),
(13, 'ragnar', 'lothbrok', 'ragnar@gmail.com', 'O190111', '111'),
(14, 'brahmi', 'the jaffa', 'jaffa@gmail.com', 'O190323', '323'),
(15, 'maheswari', 'nalabolu', 'maheswari@gmail.com', 'O190374', '374');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `FoundItems`
--
ALTER TABLE `FoundItems`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LostItems`
--
ALTER TABLE `LostItems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_Number` (`ID_Number`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `FoundItems`
--
ALTER TABLE `FoundItems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LostItems`
--
ALTER TABLE `LostItems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
