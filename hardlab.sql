-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 02:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hardlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `registro`
--

CREATE TABLE `registro` (
  `id` int(50) NOT NULL,
  `nombreyapellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registro`
--

INSERT INTO `registro` (`id`, `nombreyapellido`, `usuario`, `contrasena`) VALUES
(1, 'Nicolas Paone', 'Paone', '$2y$10$oIqwv9.sZPeLOi0d5SaZB.U43YJVwFsaouAgkYFDeyNkBlgfvMA16'),
(3, 'Valentino Pittis', 'Pittis', '$2y$10$FOFKp6CDU62E4YOEgiyufuvDzqOOpBmF2uKKKNlXh54GSB/9Zut5a'),
(4, 'Alejo Fernandez', 'Fernandez', '$2y$10$trAWQLzuKYHJNqAtNzHASeA0bjE32a5TvAoDh9oo94U0y3W6QhfDu'),
(5, 'Alejo Fernandez', 'Fernandez', '$2y$10$JGKXgUuqXcyDJJdxW74JR.adc25Pq07gJ2nCw.mktCQs3bvhV89JW'),
(6, 'Alejo Fernandez', 'Fernandez', '$2y$10$LBh9iMqeyjDnTwhwSwbNFORyucICYTabi81FDu83f7k8eLApnGHiq'),
(8, 'Maximiliano G Ariza', 'arizam', '$2y$10$COFGQb6hzS2rRafG25aaBOec1Nt8A99QjeANV5VKNQxKhkE3Q9g3i'),
(9, 'Lautaro Masciotra', 'lautarom', '$2y$10$ms6SZXBRyayariSM6HS1y.HgDVLQyWGHU4pLaWBogn4x5smXm8UmC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
