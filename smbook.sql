-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 03, 2021 at 10:08 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `smartbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '/web/images/placeholder.jpg	',
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `name`, `photo`, `phone_number`, `address`, `email`, `auth_key`) VALUES
(1, 'aziz', '$2y$13$PQzKd9sRT6FmC/.9WT9u9.VSAPRYLa3vmbQ8HavO9pmq.y2cewxOy', 'Aziz', '/web/images/2021-01-31 12.40.19.jpg', '+998 93 565 84 54', 'address', 'info@smartbook.uz', 'HQcsQbv6P12DZPVspVN1jsqZvqHGqMB9');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `couriers-id` varchar(1000) DEFAULT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `couriers-id`, `view`) VALUES
(6, 'Toshkent Viloyati', '', 1),
(7, 'Toshkent Shahar\r\n', '', 1),
(8, 'Andijon', '', 1),
(9, 'Namangan', '', 1),
(10, 'Farg\'ona', '', 1),
(11, 'Sirdaryo', '', 1),
(12, 'Jizzah', '', 1),
(13, 'Samarqand', '', 1),
(14, 'Qashqadaryo', '', 1),
(15, 'Buxoro', '', 1),
(16, 'Surxandaryo', '', 1),
(17, 'Navoiy', '', 1),
(18, 'Xorazm', '', 1),
(19, 'Nukus (Starex)', '', 1),
(20, 'Qoraqalpog\'iston (Starex)', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `orders_id` varchar(1000) DEFAULT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_id`, `name`, `phone_number`, `address`, `orders_id`, `view`) VALUES
(8, 14326, 'HAQULOVA SHOXSANAM', '998889308623', 'URGUT TUMAN TOSHARIQ MAXALLASI', '41,48', 1),
(9, 13261, 'SHAXRIYOR', '998902271759', 'TOYLOQ TUM MAGZANDAK MFY', '42', 1),
(10, 12850, 'Рахматиллох', '998943783336', 'Пахтачи тумани', '43', 1),
(11, 123122, 'name', 'phone', 'address', '44,47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `address` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '/web/images/placeholder.jpg',
  `equipment` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `salary` int(9) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1',
  `auth_key` varchar(255) DEFAULT NULL,
  `qty_left` varchar(1000) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `login`, `password`, `address`, `photo`, `equipment`, `phone_number`, `city_id`, `salary`, `view`, `auth_key`, `qty_left`) VALUES
(5, 'Ixtiyor Yunusov', 'ixtiyor', '$2y$13$xVbKrIuQ.HYp1qHZ2v9a/OzN0Z4ZYN99akaldXCR8YFTLH6BsfiDC', 'Samarqand shaxri, Gagarin kochasi, 89', '/web/images/IMAGE 2021-01-31 13:32:14.jpg', 'Moshina', '+998 93 332 34 37', 13, 1000000, 1, 'SaeCHR18twFns9WXWSvRwehwZK_oDWbt', '0'),
(6, 'Xasan Xasanov', 'xasan', '$2y$13$u2ZXCAgpMCjvr0/EzH8oaedul6pezP6kB2XnNC4z/eHYN7cxYKOQ6', '', '/web/images/2021-01-29 15.51.18.jpg', 'Moshina', '+998 97 444 67 17', 13, 1000000, 0, 'C50c-adVZGLqdnjEOf4m6Z9JT5DWzKuY', '0'),
(7, 'Saman Samanov', 'saman', '$2y$13$4vMj7CSZ.R.0vSqLGfnJP.l9piJF0wFzBGUei6.xBz3SJn6B.lNRi', '', '/web/images/Снимок экрана 2021-01-30 в 07.05.31.png', 'Moshina', '+998 97 444 67 17', 13, 1000000, 1, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `products_id` varchar(1000) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `courier_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `products_id`, `datetime`, `courier_id`, `city_id`, `view`) VALUES
(11, '1,Arab tili,kitob:20', '2021-01-28 20:59:07', 5, 13, 0),
(12, '1,Arab tili,kitob:50', '2021-01-28 20:59:18', 5, 13, 1),
(14, '1,Arab tili,kitob:50', '2021-01-28 21:41:34', 5, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '/web/images/placeholder.jpg',
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1',
  `auth_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `login`, `password`, `name`, `photo`, `phone_number`, `address`, `email`, `view`, `auth_key`) VALUES
(4, 'abdulaziz', '$2y$13$.VRjSlcbTXDPraJA194Ty.Thju9oC7iW3l87UOHWbdGHf5b1xBnbi', 'Abdulaziz', '/web/images/2021-01-31 12.40.19.jpg', '+998 93 565 84 54', 'darxon', 'emransalikhoff@gmail.com', 1, 'DIA8zjQ0yfltKunAxWOIGWhXSPnl3SgJ'),
(5, 'muhammad', '$2y$13$aPZJ.fUfkD6/Yn4XenWLS.m0YT9z2Q5ikhPtVdf.6mmBHWR2u64SO', 'Muhammad Sayyid', '/web/images/IMAGE 2021-01-31 13:00:34.jpg', '+998 91 165 03 05', '', 'muhammad_sayyidoff@gmail.com', 0, 'CCIU9FAAgWGVAJht2zMoSf6wd4jMLm7d');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `price` int(9) NOT NULL,
  `payment_method` enum('cash','click','click-paid') NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `manager_id` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('delivered','not-delivered','canceled') NOT NULL DEFAULT 'not-delivered',
  `accounting` tinyint(1) NOT NULL DEFAULT '0',
  `last_changed_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_changed_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `name`, `product`, `address`, `city_id`, `courier_id`, `phone_number`, `price`, `payment_method`, `comment`, `manager_id`, `datetime`, `status`, `accounting`, `last_changed_time`, `last_changed_user`) VALUES
(41, NULL, 'HAQULOVA SHOXSANAM', 'Arab tili, to\'liq to\'plam, 1 dona', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 5, '998889308623', 799000, 'cash', NULL, '4', '2021-01-29 20:40:45', 'not-delivered', 0, '2021-01-29 13:01:58', 'Abdulaziz'),
(42, NULL, 'SHAXRIYOR', 'Arab tili, to\'liq to\'plam, 1 dona', 'TOYLOQ TUM MAGZANDAK MFY', 13, 5, '998902271759', 799000, 'cash', NULL, '4', '2021-01-31 12:41:10', 'delivered', 0, '2021-02-01 09:02:45', 'Abdulaziz'),
(43, NULL, 'Рахматиллох', 'Arab tili, to\'liq to\'plam, 1 dona', 'Пахтачи тумани', 13, 5, '998943783336', 799000, 'cash', NULL, '4', '2021-01-31 14:26:21', 'delivered', 0, '2021-01-31 01:01:40', 'Abdulaziz'),
(44, NULL, 'name', 'Arab tili, to\'liq to\'plam, 1 dona', 'address', 13, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 10:26:02', 'delivered', 0, '2021-02-01 07:02:56', 'Abdulaziz'),
(45, NULL, 'name', 'Arab tili, to\'liq to\'plam, 1 dona', 'address', 13, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 12:42:29', 'not-delivered', 0, '2021-02-01 07:02:29', 'Abdulaziz'),
(46, NULL, 'name', 'Arab tili, to\'liq to\'plam, 1 dona', 'address', 13, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 12:42:38', 'not-delivered', 0, '2021-02-01 07:02:38', 'Abdulaziz'),
(47, NULL, 'name', 'Arab tili, to\'liq to\'plam, 1 dona', 'address', 13, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 12:43:25', 'not-delivered', 0, '2021-02-01 07:02:25', 'Abdulaziz'),
(48, NULL, 'HAQULOVA SHOXSANAM', 'Arab tili, to\'liq to\'plam, 1 dona', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 5, '998889308623', 799000, 'cash', NULL, '4', '2021-02-02 12:06:23', 'not-delivered', 0, '2021-02-02 07:02:23', 'Abdulaziz');

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
(1, 'Arab tili', '/web/images/IMAGE 2021-01-31 13:45:58.jpg', 799000, 'to\'liq to\'plam', 646, 1),
(2, 'Rus tili', '/web/images/placeholder.jpg', 599000, 'kitob', 910, 0),
(3, 'test', '/web/images/516l01RyYAL._SL1158_.jpg', 599000, 'disk', 800, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
