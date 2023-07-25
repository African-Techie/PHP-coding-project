
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
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `category_id` varchar(30) NOT NULL,
  `track_name` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `track_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `category_id`, `track_name`, `artist`, `track_path`) VALUES
(9, 'EDM', 'Alan Walker', 'Sing Me to sleep', '../uploads/songs/Alan-Walker-Sing-Me-To-Sleep_2i2khp_npdE.mp3'),
(10, 'Pop', 'Celine Dion', 'A new Day Has Come', '../uploads/songs/Celine A New Day Has Come.mp3'),
(11, 'Pop', 'Rewrite the stars', 'Zendaya and Zac Efron', '../uploads/songs/Zac_Efron%2C_Zendaya_-_Rewrite_The_Stars__Lyrics___Lyrics_Video_(251).mp3'),
(12, 'Worship', 'Breathe', 'Hillsong Praise', '../uploads/songs/BREATHE_HILLSONG_LYRICS_VIDEO(256k).mp3'),
(13, 'Worship', 'Nachotaka ni we', 'Emma Omonge', '../uploads/songs/Emma_Omonge_-__Nachotaka__Official_video__%5BDial%5D__837_589%23(256k).mp3'),
(14, 'Pop', 'Love me like you do', 'Ellie Goulding', '../uploads/songs/Ellie_Goulding_-_Love_Me_Like_You_Do_(Official_Video)(256k).mp3'),
(15, 'Pop', 'Unbreak my heart', 'Tony Braxton', '../uploads/songs/Toni_Braxton_-_Un-Break_My_Heart_(Official_HD_Video)(256k).mp3'),
(16, 'Pop', 'Stay a little longer', 'Anushka Shahaney', '../uploads/songs/Stay_A_Little_Longer_-_Full_Video__Half_Girlfriend__Arjun_Kapoor%2C_Shraddha_Kapoor___Anushka_Shahaney(256k).mp3'),
(17, 'Unknown', 'Lost Without You', 'Ami Mishra & Anushka Shahaney', '../uploads/songs/Lost_Without_You_-_Lyrical___Half_Girlfriend___Arjun_K___Shraddha_K___Ami_Mishra___Anushka_Shahaney(256k).mp3'),

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
--

INSERT INTO `users` (`id`, `user_level`, `first_name`, `second_name`, `email`, `password_field`, `date_registered`, `img`) VALUES
(1, 1, 'Eddie', 'Ogyner', 'eddyogyner@outlook.com', '$2y$10$bLnExJGu6vB/9s5ixeKAbeL0OrZvaSX9oZFvhKY5KRhhz13jPv21S', '2023-07-11', 0x313636353530333838343438372d30317e322e6a7067),
(2, 1, 'Mel', 'Nyakio', 'mel@outlook.com', '$2y$10$tIr1d0SSJRDQ7T865N7wEOMz4577rZT5wVMXPYkHObJjr6wXY0Sjq', '2023-07-11', 0x53637265656e73686f745f32303233303631305f3134343332365f57686174734170702e706e67),
(3, 0, 'Myra', 'Sika', 'myra@gmail.com', '$2y$10$SbUwKoJSkmzUFJ4fdH8oXOcDjifHmvXdAfult2IWmWzhu5nzwPKdK', '2023-07-11', 0x4d7972612e6a706567),
(5, 0, 'Zuri', 'Brittany', 'zuri@gmail.com', '$2y$10$v8ylp4hlMQ3.rswZHU42/u5eqoVh6Q5rnvatlly2go.qp1UGdnKXu', '2023-07-20', 0x6170702e69636f),
(7, 0, 'Nick', 'Lusweti', 'nick@gmail.com', '$2y$10$zluYKXFNDO2o2l8t7uoAqeHKXt0kMpBIYMJymEVMLFQ/Fyhl8sjum', '2023-07-20', 0x4b4341552d6c6f676f2e706e67),
(8, 0, 'Elyse', 'Ogyner', 'elyse@ogyner.com', '$2y$10$WVOXmksAb9R0keoFkmpBuu2ldpN/olm1NWNfe3XHRcnwLWg6Q7dTi', '2023-07-20', 0x36303464376638303737366538646234346465626539393431343538393863392d2d73686f72742d6e61747572616c2d686169727374796c65732d73686f72742d68616972637574732e6a7067),
(13, 0, 'Eddie', 'Otieno', 'eddyogyner@gmail.com', '$2y$10$JX2pug1b/XfIDf00wk4ncOzt9iXzb7XTNWa64IBPXM1bhTeFyXM0O', '2023-07-23', 0x313636323133343530353739347e32202832292e6a7067),
(16, 0, 'O\'reilly', 'Jones', 'jones@kcau.ac.ke', '$2y$10$Z/eX6zdTXW5ocyiSP.vTCexjnh3mTzLOulAZvFGqDRn6KcAlORnIi', '2023-07-23', 0x4564646965312e706e67),
(17, 0, 'Mumo', 'Nzinga', 'mumo@outlook.com', '$2y$10$kvDHELgKRmerYK1Q8JY86OK8ZDHql0a8fwamU7E7YnNtdEch3nJgK', '2023-07-23', 0x64656661756c74312e706e67),
(18, 0, 'Faith', 'Nkatha', 'fay1@gmail.com', '$2y$10$.Ti4pHSPeaefPFwNGa0MBuABqIPftOmIBXuiwdiYdrjIpTPLoRZLC', '2023-07-25', 0x313636323133343530353739347e32202832292e6a7067),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
