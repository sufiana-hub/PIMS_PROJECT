-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 04:09 PM
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
-- Database: `pims_pbu`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `email`, `subject`, `feedback`) VALUES
('SUFIANA ADLIN BINTI BAHAROM', 'sufianabaharom@gmail.com', 'BEREBUT MAKANAN DI PI SEWKTU BULAN PUASA', 'hello'),
('SUFIANA ADLIN BINTI BAHAROM', 'sufianabaharom@gmail.com', 'BEREBUT MAKANAN DI PI SEWKTU BULAN PUASA', 'ssdfghiok'),
('ewrydfgsxhk', 'sufianabaharom@gmail.com', 'gdhjsxn', 'gdchnskm'),
('REYWIUOO', 'sufianabaharom@gmail.com', 'DSFGHKJL', 'SFGHLAJK'),
('dctfygvbhuj', 'nauniezanawani@gmail.com', 'vbjnkm', 'knml,');

-- --------------------------------------------------------

--
-- Table structure for table `infaq`
--

CREATE TABLE `infaq` (
  `name` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infaq`
--

INSERT INTO `infaq` (`name`, `description`) VALUES
('SUFIANA ADLIN', 'MAKANAN MINGGUAN'),
('EGFSGWHL', 'RDETFYGHJKL');

-- --------------------------------------------------------

--
-- Table structure for table `program_participants`
--

CREATE TABLE `program_participants` (
  `id` int(11) NOT NULL,
  `ic` varchar(12) NOT NULL,
  `name` varchar(30) NOT NULL,
  `kad_matric` varchar(12) NOT NULL,
  `date_time` datetime NOT NULL,
  `day_of_week` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ramadhan`
--

CREATE TABLE `ramadhan` (
  `fullname` varchar(30) NOT NULL,
  `nomatric` varchar(12) NOT NULL,
  `telephoneno` varchar(30) NOT NULL,
  `roomno` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ramadhan`
--

INSERT INTO `ramadhan` (`fullname`, `nomatric`, `telephoneno`, `roomno`) VALUES
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b206'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b206'),
('kamal apandy', '11111', '01711111', '121'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b204'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304'),
('SUFIANA', 'BINTI BAHARO', '0162184436', 'b304');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(4) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `nomatric` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  `confirm_password` varchar(12) NOT NULL,
  `noic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `fullname`, `nomatric`, `email`, `password`, `confirm_password`, `noic`) VALUES
(1, 'SUFIANA ADLIN BINTI BAHAROM', '21DDT21F1150', 'sufianaadlin@gmail.com', '999', '999', '030620100924'),
(2, 'SUHAIL AZMIN BT BAHAROM', '21DDT19F1206', 'suhailazmin@gmail.com', '000', '000', '010312101425');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `program_participants`
--
ALTER TABLE `program_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `program_participants`
--
ALTER TABLE `program_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
