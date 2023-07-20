-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 01:41 PM
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
-- Database: `orion`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_level` smallint(2) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_field` char(255) NOT NULL,
  `date_registered` date NOT NULL,
  `img` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`


-- These are the de-hashed saved users passwords:

-- eddyogyner@outlook.com   admin
-- mel123@outlook.com       mel
-- myra@gmail.com           myra
-- zuri@casey.com           zuri
-- new@member.com           new
-- eddyogyner@gmail.com     eddie
-- elyse@ogyner.com         elyse
-- kcau@gmail.com           kcau
-- oketch@gmail.com         oketch

INSERT INTO `users` (`id`, `user_level`, `first_name`, `second_name`, `email`, `password_field`, `date_registered`, `img`) VALUES
(1, 1, 'Eddie', 'Otieno', 'eddyogyner@outlook.com', '$2y$10$Woq04DCAJuEm5EEB4IXAkOMMe13wOye8kG8izxbxYKhjcmvzkLPei', '2023-05-11', 0x313636323133343530353739347e32202832292e6a7067),
(2, 0, 'Melody', 'Nyakio', 'mel123@outlook.com', '$2y$10$JBnIftbmyBFSxc4EuSJnJOufoS4bcBnqC37R/FGPETD21Q3r0ijcG', '2023-06-11', 0x36303464376638303737366538646234346465626539393431343538393863392d2d73686f72742d6e61747572616c2d686169727374796c65732d73686f72742d68616972637574732e6a7067),
(3, 0, 'Myra', 'Sika', 'myra@gmail.com', '$2y$10$SbUwKoJSkmzUFJ4fdH8oXOcDjifHmvXdAfult2IWmWzhu5nzwPKdK', '2023-07-11', 0x4d7972612e6a706567),
(5, 0, 'Zuri', 'Casey', 'zuri@casey.com', '$2y$10$le2GVmHAdPPdUnNqBzfvF./h1rdWEe23ntgBqVvhNNUuyytJ1g08m', '2023-07-13', 0x64656661756c74312e706e67),
(6, 0, 'New', 'Member', 'new@member.com', '$2y$10$8P7FCxy9t8YRPiNzQMInOOpGqco2hPCKifcv9SsSQtussh.f9d69m', '2023-07-20', 0x64656661756c74312e706e67),
(7, 0, 'Eddie', 'Ogyner', 'eddyogyner@gmail.com', '$2y$10$AceLg2LSql4oRHipqcmZv.tPQwcGwqt7Z0.IkyrS65ecczT407OMi', '2023-07-20', 0x313636323133343530353739347e32202832292e6a7067),
(8, 0, 'Elyse', 'Ogyner', 'elyse@ogyner.com', '$2y$10$WVOXmksAb9R0keoFkmpBuu2ldpN/olm1NWNfe3XHRcnwLWg6Q7dTi', '2023-07-20', 0x64656661756c74312e706e67),
(9, 0, 'Kca', 'University', 'kcau@gmail.com', '$2y$10$gl8GbgwLD7FjuJ.DwbEU/uAgFPYhh9ZZFawwdf0H4ZIOfQUAbtcV.', '2023-07-20', 0x64656661756c74312e706e67),
(10, 0, 'User', 'Oketch', 'oketch@gmail.com', '$2y$10$XGWTZTO.37Yw5IYJSk50oubm3SJfMVKR63fyygirsAvMY3JSJ9hUO', '2023-07-20', 0x64656661756c74312e706e67);

-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
