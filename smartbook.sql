-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 28, 2021 at 06:19 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `smartbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `couriers-id` varchar(1000) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `couriers-id`, `view`) VALUES
(1, 'Toshkent', '2,3', 1),
(2, 'Namangan', '3', 1),
(5, 'Buxoro', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `orders_id` varchar(1000) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone_number`, `address`, `orders_id`, `view`) VALUES
(1, 'Baxrom Baxromovich', '+998 (97) 444-67-17', 'Toshkent, Uchtepa', '3', 1),
(2, 'Timur Timurovich', '+998 (97) 444-67-17', 'Namangan, qayodadur', '4,5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `address` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '/web/images/placeholder.jpg',
  `equipment` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `salary` int(9) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `password`, `address`, `photo`, `equipment`, `phone_number`, `city_id`, `salary`, `view`) VALUES
(2, 'Otabek Otabekovich', 'MTIz', 'Toshkent, Chilonzor, 24 chorak, 45', '/web/images/516l01RyYAL._SL1158_.jpg', 'Planshet', '+998 (97) 444-67-17', 2, 1500000, 1),
(3, 'Davlat Davlatov', 'MzIx', 'Toshkent, Uchtepa, 30 chorak, 16', '/web/images/man2.jpg', '', '+998 (97) 444-67-17', 1, 1500000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `products_id` varchar(1000) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `courier_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `products_id`, `datetime`, `courier_id`, `city_id`) VALUES
(1, '1:50,2:40', '2021-01-16 15:05:26', 2, 1),
(2, '1:50', '2021-01-27 04:29:53', 3, 2),
(3, '1:40,2:60', '2021-01-27 04:31:05', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `login`, `password`, `name`, `phone_number`, `address`, `email`, `view`) VALUES
(1, 'xasan17', 'test', 'Xasan Shadiyarov', '+998 (97) 444-67-17', 'Toshkent, Uchtepa, 23 choraq, 5 dom, 32 ', 'hasan.shadiyarov@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `price` int(9) NOT NULL,
  `payment_method` enum('cash','click') NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `manager_id` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('delivered','not-delivered','canceled') NOT NULL DEFAULT 'not-delivered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `product`, `address`, `city_id`, `courier_id`, `phone_number`, `price`, `payment_method`, `comment`, `manager_id`, `datetime`, `status`) VALUES
(3, 'Toxir Toxirov', 'Arab tili, kitob, 1 dona', 'Toshkent, Uchtepa', 1, 2, '+998 (97) 444-67-17', 599000, 'click', '', '1', '2021-01-15 02:18:44', 'delivered'),
(4, 'Azamat Azamatovich', 'Arab tili, kitob, 1 dona', 'Toshkent, Uchtepa', 1, 2, '+998 (97) 444-67-17', 599000, 'cash', '', '1', '2021-01-13 00:58:31', 'delivered'),
(5, 'Timur Timurovich', 'Arab tili, kitob, 1 dona', 'Namangan, qayodadur', 2, 2, '+998 (97) 444-67-17', 599000, 'cash', '', '1', '2020-12-16 01:34:38', 'delivered'),
(6, 'Baxodir Baxodirovich', 'Arab tili, kitob, 1 dona', 'Toshkent, Uchtepa', 1, 2, '+998 (97) 444-67-17', 599000, 'click', '', '1', '2021-01-27 16:59:24', 'not-delivered'),
(7, 'Baxrom Baxromovich', 'Arab tili, kitob, 1 dona', 'Namangan, qayodadur', 2, 1, '+998 (97) 444-67-17', 599000, 'cash', '', '1', '2021-01-26 01:36:05', 'not-delivered'),
(8, 'name', 'Arab tili, kitob, 1 dona', 'address', 2, 2, 'phone', 599000, 'click', NULL, '1', '2021-01-27 03:43:42', 'not-delivered'),
(9, 'name', 'Arab tili, kitob, 1 dona', 'address', 1, 2, 'phone123', 599000, 'cash', NULL, '1', '2021-01-27 03:44:04', 'not-delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `price` int(9) NOT NULL,
  `format` varchar(100) NOT NULL,
  `in_stock` int(9) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `price`, `format`, `in_stock`, `view`) VALUES
(1, 'Arab tili', '/web/images/placeholder.jpg', 599000, 'kitob', 1050, 1),
(2, 'Rus tili', '/web/images/placeholder.jpg', 599000, 'kitob', 990, 1),
(3, 'test', '/web/images/516l01RyYAL._SL1158_.jpg', 599000, 'disk', 800, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
