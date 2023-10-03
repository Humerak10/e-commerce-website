-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2022 at 11:47 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `products_id` varchar(200) NOT NULL,
  `order_date` varchar(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `num` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `products_id`, `order_date`, `name`, `email`, `num`, `address`) VALUES
(39, 'humera', '3-5;1-1', '20 May 2022', 'humera', 'hum@gmail.com', 1234567890, 'ggggnbnhghjjhh'),
(40, 'humerak', '18-1', '20 May 2022', 'humera', 'test@gmail.com', 1234567890, 'hhhhhhhh'),
(41, 'admin', '1-1', '20 May 2022', 'humera', 'test@gmail.com', 1234567890, 'gggggg');

-- --------------------------------------------------------

--
-- Table structure for table `saket`
--

CREATE TABLE `saket` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(160) NOT NULL,
  `IMAGE` varchar(100) DEFAULT NULL,
  `featured` int(10) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `more_images` varchar(1000) DEFAULT 'a:0:{}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saket`
--

INSERT INTO `saket` (`ID`, `NAME`, `IMAGE`, `featured`, `price`, `description`, `more_images`) VALUES
(1, 'erasor', './stationary/products/OIP (1).jpg', 1, 20, 'description for erasor (edit this later)', 'a:4:{i:0;s:33:\"./stationary/products/OIP (1).jpg\";i:1;s:25:\"./assets/images/feat2.jpg\";i:2;s:25:\"./assets/images/feat3.jpg\";i:3;s:24:\"./assets/images/feat.jpg\";}'),
(2, 'long scale', './stationary/products/OIP (2).jpg', 1, 29, NULL, 'a:2:{i:0;s:33:\"./stationary/products/OIP (2).jpg\";i:1;s:25:\"./assets/images/feat2.jpg\";}'),
(3, 'luxor ink pen', './stationary/products/OIP (3).jpg', 1, 50, NULL, 'a:3:{i:0;s:33:\"./stationary/products/OIP (3).jpg\";i:1;s:25:\"./assets/images/feat2.jpg\";i:2;s:25:\"./assets/images/feat3.jpg\";}'),
(4, 'color ball pens', './stationary/products/OIP (4).jpg', 1, 159, NULL, 'a:1:{i:0;s:33:\"./stationary/products/OIP (4).jpg\";}'),
(5, 'color pens pack', './stationary/products/OIP (4).jpg', 2, 99, 'A set of color pens, vibrant colors, long lasting', 'a:1:{i:0;s:33:\"./stationary/products/OIP (4).jpg\";}'),
(6, 'Faber castle connector colour marker pens', './stationary/products/100.jpeg', 1, 150, NULL, 'a:0:{}'),
(7, 'Classmate Pulse Ruled 180 Pages Pulse Avengers Cover', './stationary/products/101.jpeg', 1, 64, 'premium pages notebook', 'a:0:{}'),
(8, 'Classmate Octane Gel ', './stationary/products/102.jpeg', 1, 226, 'Gel 25s Jar- 20 Blue Gel Pens + 5 Black Gel Pens', 'a:0:{}'),
(9, 'Cello Geltech Fun Glitter Pen', './stationary/products/103.jpeg', 1, 87, '(Pack of 10 pens in Multicolour Link)', 'a:0:{}'),
(10, 'Multi Coloured Box Files', './stationary/products/105.jpeg', 1, 799, 'pack of 8', 'a:0:{}'),
(11, 'uni-ball SIGNO ', './stationary/products/106.jpeg', 1, 300, '100 Gel Pen (Orange Ink, Pack of 6)', 'a:0:{}'),
(12, 'Classmate Premium 6 Subject Spiral Notebook', './stationary/products/107.jpeg', 1, 140, '203mm x 267mm, Soft Cover, 300 Pages, Unruled', 'a:0:{}'),
(13, 'Scotch Magic Tape ', './stationary/products/108.jpeg', 1, 124, 'The Original Matte-Finish Invisible Tape by 3M (1 Roll, Width 1.9cm Length 32.9m)', 'a:0:{}'),
(14, 'KABEER ART Short Black Handle Synthetic Mix Artist Paint Brush ', './stationary/products/109.jpeg', 1, 310, 'Set, 5 Pieces', 'a:0:{}'),
(15, 'Solimo Medium Grain Cotton Canvas Board', './stationary/products/110.jpeg', 1, 269, 'Black, 8 x 10 inch, Set of 4', 'a:0:{}'),
(16, 'Pidilite Fevistick Super Glue Stick ', './stationary/products/16.jpeg', 1, 50, 'Non Toxic Transparent Adhesive (25g)', 'a:0:{}'),
(17, 'Maped essential soft scissor', './stationary/products/17.jpeg', 1, 125, '17cm ', 'a:0:{}'),
(18, 'VADOSARI® Premium Artist Wooden Easel Stand', './stationary/products/18.jpeg', 2, 1190, '5 FEET with Angle and Height Adjustment for Canvas Painting Display 5 ft [154 cm]', 'a:0:{}'),
(19, 'The Power of A Positive Attitude: Your Road To Success', './stationary/products/19.jpeg', 2, 125, NULL, 'a:0:{}'),
(20, 'Ohuhu Acrylic 44pcs Painting Set ', './stationary/products/20.jpeg', 2, 3399, 'Wood Table-Top Easel Box, Art Painting Brushes, 24 Colours Acrylic Paint Tubes, and Acrylic Painting Pads for Artist Students', 'a:0:{}'),
(21, 'Blending stump', './stationary/products/stump.jpeg', 1, 99, 'Blending stumps are premium quality paper stumps useful in sketching...gives u a flawless shade', 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$fMvXlbWIgtKqavNcKq0pjuvPGy6OkrVTktSr8ZXK5X1KmDfvkZFiW', '2022-04-24 15:49:57'),
(2, 'admin2', '$2y$10$gbb/bVwNgobdqIMCP.ns0OdU6d7f50Z0BgVpf6jLkxWIIyU15D9vi', '2022-04-24 15:57:33'),
(3, 'admin3', '$2y$10$HOEFjG6JaH5FKU474lFsJubEhtSCtkcfvo8Vh42kPy7yFaV3AAXn6', '2022-04-24 15:58:14'),
(4, 'pranavkale', '$2y$10$4vA64LEEvwGPWQIrViPXqeaXtZKU6lDzU3m5j4sZSmxXcHHVmiiGy', '2022-05-16 15:21:13'),
(5, 'newuser', '$2y$10$g9Ibeo7vBFIu4hywsPEAoO.1wYn/kdjyNhSfAsz.hVENIOtkFYYF.', '2022-05-17 18:04:54'),
(6, 'humera', '$2y$10$fM86t7ONSCzEZNeYSzYzSOxVaEg2MJRVNIGOkdGRGkY5ltppSdz/y', '2022-05-18 21:26:22'),
(7, 'humerak', '$2y$10$7dPoPaQGUH/u88CZGq9iSuO1VjJgGA10hOI4bZC0Rlg3jqEARgMsO', '2022-05-20 14:01:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `saket`
--
ALTER TABLE `saket`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `saket`
--
ALTER TABLE `saket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
