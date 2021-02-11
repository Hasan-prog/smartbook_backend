-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 11, 2021 at 07:56 AM
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
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `view`) VALUES
(6, 'Toshkent Viloyati', 1),
(7, 'Toshkent Shahar\r\n', 1),
(8, 'Andijon', 1),
(9, 'Namangan', 1),
(10, 'Farg\'ona', 1),
(11, 'Sirdaryo', 1),
(12, 'Jizzax', 1),
(13, 'Samarqand', 1),
(14, 'Qashqadaryo', 1),
(15, 'Buxoro', 1),
(16, 'Surxandaryo', 1),
(17, 'Navoiy', 1),
(18, 'Xorazm', 1),
(19, 'Nukus (Starex)', 1),
(20, 'Qoraqalpog\'iston (Starex)', 1);

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
(8, 14326, 'HAQULOVA SHOXSANAM', '998889308623', 'URGUT TUMAN TOSHARIQ MAXALLASI', '41,48,111,112,41', 1),
(9, 13261, 'SHAXRIYOR', '998902271759', 'TOYLOQ TUM MAGZANDAK MFY', '42', 1),
(10, 12850, 'Рахматиллох', '998943783336', 'Пахтачи тумани', '43', 1),
(11, 123122, 'name', 'phone', 'address', '44,47,54,55,56,60,61,62', 1),
(12, 12312, 'Hasan Sh', '+998 97 444 67 17', 'URGUT TUMAN TOSHARIQ MAXALLASI', '49,50', 1),
(13, 33333, 'Khasan Shadiyarov', '+998 97 444 67 17, +998 33 033 09 33', 'URGUT TUMAN TOSHARIQ MAXALLASI', '51', 1),
(14, 12312233, 'name', '+998 97 444 67 17', 'address', '52', 1),
(15, 123122, 'Jocker', '+998 97 444 67 17', 'TOYLOQ TUM MAGZANDAK MFY', '53', 1),
(16, 12312, 'test', '+998 97 444 67 17', 'TOYLOQ TUM MAGZANDAK MFY', '57,58,59,71', 1),
(19, 12312, 'name23', '+998 97 444 67 17', 'address', '67,68', 1),
(21, 12312, '12321312', 'phone', 'Пахтачи тумани', '69', 1),
(22, 12312, '11123sadas', '12312', '3123123', '73', 1),
(23, 123122, 'йцуйцуйцу', 'phone', 'address', '79', 1),
(24, 12312, 'test', 'phone', 'address', '82,89,90,91,93,98', 1),
(25, 12312, 'HAQULOVA SHOXSANAM', '+998 97 444 67 17', 'address', '108,110', 1),
(26, 11232, 'HAQULOVA SHOXSANAM1', '998889308623', 'URGUT TUMAN TOSHARIQ MAXALLASI', '41', 1),
(27, 11232, 'HAQULOVA SHOXSANAM1', '9988893086231', 'URGUT TUMAN TOSHARIQ MAXALLASI1', '41', 1),
(28, 12312, 'HAQULOVA SHOXSANAM2', '+998 97 444 67 17,+998 65 564 65 46', 'URGUT TUMAN TOSHARIQ MAXALLASI', '113', 1),
(29, 12321, 'HAQULOVA SHOXSANAM', '+998 88 930 86 24', 'URGUT TUMAN TOSHARIQ MAXALLASI', '48', 1),
(30, 12321, 'HAQULOVA SHOXSANAM', '+998 88 930 86 25', 'URGUT TUMAN TOSHARIQ MAXALLASI', '48', 1),
(31, 12312, 'name', '+998 94 444 67 17', 'URGUT TUMAN TOSHARIQ MAXALLASI', '114', 1),
(32, 123122, 'HAQULOVA SHOXSANAM', '+998 45 454 65 54,+998 84 654 65 65,+998 __ ___ __ __,+998 __ ___ __ __', 'TOYLOQ TUM MAGZANDAK MFY', '115', 1);

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
  `districts_id` varchar(100) DEFAULT NULL,
  `salary` int(9) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1',
  `auth_key` varchar(255) DEFAULT NULL,
  `qty_left` varchar(1000) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `login`, `password`, `address`, `photo`, `equipment`, `phone_number`, `city_id`, `districts_id`, `salary`, `view`, `auth_key`, `qty_left`) VALUES
(5, 'Ixtiyor Yunusov', 'ixtiyor', '$2y$13$GFaRtC/DbTrbj9/aowpEFOUCzPd3oym9CcjXqKUiVdTEDq1lDI7vO', 'Samarqand shaxri, Gagarin kochasi, 89', '/web/images/IMAGE 2021-01-31 13:32:14.jpg', '', '+998 93 332 34 37', 13, '12', 1000000, 1, 'MjEr6Oj5ZIsXe2-z-psGvSna4NRsRtrv', '1,Arab tili,kiril:1'),
(6, 'Xasan Xasanov', 'xasan', '$2y$13$7Xk62wiaLaVmNQAcFhYFx.YbSrRPJqeO7l0/hIdHNcJ/urI10ivR.', '', '/web/images/2021-01-29 15.51.18.jpg', 'JPS,Moshina', '+998 97 444 67 17', 13, '13', 1000000, 1, 'C50c-adVZGLqdnjEOf4m6Z9JT5DWzKuY', '1,Arab tili,kiril:55/2,Rus tili,lotin:40'),
(7, 'Saman Samanov', 'saman', '$2y$13$vgRPBzIhK.GM/uej3ptsC.b9L2er.euu9F93UIib6IQ8yNkYl9PsW', '', '/web/images/Снимок экрана 2021-01-30 в 07.05.31.png', 'Moshina', '+998 97 444 67 17', 7, '7', 1000000, 1, NULL, '1,Arab tili,kiril:55/2,Rus tili,lotin:40'),
(8, 'name', 'ixtiyor', '$2y$13$z3YTI5NQUJOEXuYxZH.ndub4qqZoomAJxB5ekrMlhtB5GnGIb.a.O', 'address', '/web/images/001590.jpg', 'SIM', 'phone', 13, '13', 1000000, 1, NULL, '1,Arab tili,kiril:100');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `city_id`, `view`) VALUES
(1, 'Olmazor tumani', 7, 1),
(2, 'Bektemir tumani', 7, 1),
(3, 'Mirobod tumani', 7, 1),
(4, 'Mirzo-Ulug\'bek tumani', 7, 1),
(5, 'Sergeli tumani', 7, 1),
(6, 'Uchtepa tumani', 7, 1),
(7, 'Chilonzor tumani', 7, 1),
(8, 'Shayxontohur tumani', 7, 1),
(9, 'Yunusobod tumani', 7, 1),
(10, 'Yakkasaroy tumani', 7, 1),
(11, 'Yashnobod tumani', 7, 1),
(12, 'Payariq tumani', 13, 1),
(13, 'Ishtixon tumani', 13, 1);

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
(14, '1,Arab tili,kitob:50', '2021-01-28 21:41:34', 5, 13, 0),
(15, '1,Arab tili,to\'liq to\'plam:1', '2021-02-04 12:45:20', 6, 13, 1),
(16, '1,Arab tili,to\'liq to\'plam:9', '2021-02-04 12:45:39', 6, 13, 1),
(17, '1,Arab tili,to\'liq to\'plam:5', '2021-02-04 12:46:03', 7, 13, 1),
(18, '2,Rus tili,kitob:50', '2021-02-04 12:46:25', 7, 13, 1),
(19, '1,Arab tili,kiril:100', '2021-02-09 23:18:40', 8, 13, 1);

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
(4, 'abdulaziz', '$2y$13$.VRjSlcbTXDPraJA194Ty.Thju9oC7iW3l87UOHWbdGHf5b1xBnbi', 'Abdulaziz', '/web/images/2021-01-31 12.40.19.jpg', '+998 93 565 84 54', 'darxon', 'emransalikhoff@gmail.com', 1, 'KNPJFDXfAADgx51AeoXEgCIn0H4CJOOX'),
(5, 'muhammad', '$2y$13$aPZJ.fUfkD6/Yn4XenWLS.m0YT9z2Q5ikhPtVdf.6mmBHWR2u64SO', 'Muhammad Sayyid', '/web/images/IMAGE 2021-01-31 13:00:34.jpg', '+998 91 165 03 05', '', 'muhammad_sayyidoff@gmail.com', 0, 'CCIU9FAAgWGVAJht2zMoSf6wd4jMLm7d');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT '/web/images/placeholder.jpg',
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `name`, `photo`, `phone_number`, `address`, `email`, `view`) VALUES
(1, 'Rustam Rustomov', '/web/images/placeholder.jpg', '+998 97 444 67 17', 'address', 'rustam@gmail.com', 0),
(2, 'Test', '/web/images/download-10.jpg', 'test', 'test', 'test', 1),
(3, '12322', '/web/images/Снимок экрана 2021-01-30 в 07.05.31.png', '123', '123', '123', 1),
(4, '21312', '/web/images/placeholder.jpg', '123213', '123123', '1231', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `operator_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
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
  `last_changed_user` varchar(255) DEFAULT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `operator_id`, `name`, `product`, `address`, `city_id`, `district_id`, `courier_id`, `phone_number`, `price`, `payment_method`, `comment`, `manager_id`, `datetime`, `status`, `accounting`, `last_changed_time`, `last_changed_user`, `view`) VALUES
(41, 1232, 2, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 12, 6, '998889308623', 799000, 'cash', '', '4', '2021-01-29 20:40:45', 'delivered', 0, '2021-02-09 07:02:26', 'Abdulaziz', 0),
(42, 1232, 2, 'SHAXRIYOR', '1,Arab tili,to\'liq to\'plam:1', 'TOYLOQ TUM MAGZANDAK MFY', 13, 0, 6, '998902271759', 799000, 'cash', NULL, '4', '2021-01-31 12:41:10', 'delivered', 0, '2021-02-01 09:02:45', 'Abdulaziz', 1),
(43, 1232, 2, 'Рахматиллох', '1,Arab tili,to\'liq to\'plam:1', 'Пахтачи тумани', 13, 0, 5, '998943783336', 799000, 'cash', NULL, '4', '2021-01-31 14:26:21', 'delivered', 0, '2021-01-31 01:01:40', 'Abdulaziz', 1),
(44, 1232, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 13, 0, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 10:26:02', 'delivered', 0, '2021-02-01 07:02:56', 'Abdulaziz', 1),
(45, 1232, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 13, 0, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 12:42:29', 'not-delivered', 0, '2021-02-01 07:02:29', 'Abdulaziz', 1),
(46, 1232, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 13, 0, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 12:42:38', 'not-delivered', 0, '2021-02-01 07:02:38', 'Abdulaziz', 1),
(47, 1232, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 13, 0, 6, 'phone', 799000, 'cash', NULL, '4', '2021-02-01 12:43:25', 'not-delivered', 0, '2021-02-01 07:02:25', 'Abdulaziz', 1),
(48, 12321, 2, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 0, 5, '+998 88 930 86 25', 799000, 'cash', '1233', '4', '2021-02-02 12:06:23', 'delivered', 0, '2021-02-09 12:02:05', 'Abdulaziz', 1),
(49, 12312, 2, 'Hasan Sh', '1,Arab tili,to\'liq to\'plam:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 0, 5, '+998 97 444 67 17', 799000, 'cash', '', '4', '2021-02-04 01:30:26', 'delivered', 0, '2021-02-04 10:02:10', 'Abdulaziz', 1),
(50, 12312, 2, 'Hasan Sh', '1,Arab tili,to\'liq to\'plam:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 0, 5, '+998 97 444 67 17', 799000, 'click-paid', '', '4', '2021-02-05 01:32:45', 'not-delivered', 0, '2021-02-04 10:02:01', 'Abdulaziz', 0),
(51, 33333, 2, 'Khasan Shadiyarov', '1,Arab tili,to\'liq to\'plam:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 0, 5, '+998 97 444 67 17,+998 33 033 09 33', 799000, 'cash', '', '4', '2021-02-05 04:36:54', 'delivered', 0, '2021-02-09 04:02:24', 'Ixtiyor Yunusov', 1),
(52, 12312233, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 13, 0, 5, '+998 97 444 67 17', 799000, 'cash', '', '4', '2021-02-05 12:29:58', 'delivered', 0, '2021-02-09 04:02:28', 'Ixtiyor Yunusov', 1),
(53, 123122, 2, 'Jocker', '1,Arab tili,to\'liq to\'plam:1', 'TOYLOQ TUM MAGZANDAK MFY', 13, 0, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-05 12:34:13', 'not-delivered', 0, '2021-02-05 07:02:13', 'Abdulaziz', 1),
(54, 12312, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'Пахтачи тумани', 6, 13, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-06 06:13:41', 'not-delivered', 0, '2021-02-06 01:02:41', 'Abdulaziz', 0),
(55, 12312, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'Пахтачи тумани', 13, 12, 5, 'phone', 799000, 'cash', '', '4', '2021-02-06 06:14:05', 'delivered', 0, '2021-02-11 06:29:09', 'Ixtiyor Yunusov', 1),
(56, 0, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 13, 0, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-06 09:56:01', 'not-delivered', 0, '2021-02-06 04:02:01', 'Abdulaziz', 1),
(57, 12312, 2, 'test', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, 0, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-06 09:56:14', 'not-delivered', 0, '2021-02-06 04:02:14', 'Abdulaziz', 0),
(58, 12312, 2, 'test', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, 0, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-06 09:56:57', 'not-delivered', 0, '2021-02-06 04:02:57', 'Abdulaziz', 1),
(59, 12312, 2, 'test', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, 0, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-06 09:57:00', 'not-delivered', 0, '2021-02-06 04:02:00', 'Abdulaziz', 1),
(60, 12312, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, 0, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-06 09:57:09', 'not-delivered', 0, '2021-02-06 04:02:09', 'Abdulaziz', 1),
(61, 12312, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, 0, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-06 09:57:17', 'not-delivered', 0, '2021-02-06 04:02:17', 'Abdulaziz', 1),
(62, 12312, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, 0, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-06 09:57:24', 'not-delivered', 0, '2021-02-06 04:02:24', 'Abdulaziz', 1),
(63, 12312, 2, 'name', '1,Arab tili,to\'liq to\'plam:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-06 09:58:07', 'not-delivered', 0, '2021-02-06 04:02:07', 'Abdulaziz', 1),
(64, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, 1, 5, 'phone', 799000, 'cash', 'asdasd', '4', '2021-02-07 16:21:50', 'delivered', 0, '2021-02-08 05:02:06', 'Ixtiyor Yunusov', 1),
(65, 12312, 2, 'name23', '1,Arab tili,kiril:1', 'address', 6, 1, 5, '+998 97 444 67 17', 799000, 'cash', '', '4', '2021-02-07 16:25:03', 'delivered', 0, '2021-02-08 05:02:27', 'Ixtiyor Yunusov', 1),
(66, 12312, 2, 'name23', '1,Arab tili,kiril:1', 'address', 6, 1, 5, '+998 97 444 67 17', 799000, 'cash', '', '4', '2021-02-07 16:25:05', 'delivered', 0, '2021-02-08 05:02:08', 'Ixtiyor Yunusov', 1),
(67, 12312, 2, 'name23', '1,Arab tili,kiril:1', 'address', 6, 1, 5, '+998 97 444 67 17', 799000, 'cash', '', '4', '2021-02-07 16:27:02', 'canceled', 0, '2021-02-08 05:02:33', 'Ixtiyor Yunusov', 1),
(68, 12312, 2, 'name23', '1,Arab tili,kiril:1', 'address', 6, 1, 5, '+998 97 444 67 17', 799000, 'cash', '', '4', '2021-02-07 16:27:18', 'canceled', 0, '2021-02-08 05:02:41', 'Ixtiyor Yunusov', 1),
(69, 12312, 2, '12321312', '1,Arab tili,kiril:1', 'Пахтачи тумани', 6, 1, 5, 'phone', 799000, 'cash', '', '4', '2021-02-07 16:43:23', 'canceled', 0, '2021-02-08 05:02:45', 'Ixtiyor Yunusov', 1),
(70, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, 1, 5, 'phone', 799000, 'cash', '', '4', '2021-02-07 16:43:39', 'canceled', 0, '2021-02-08 05:02:07', 'Ixtiyor Yunusov', 1),
(71, 12312, 2, 'test', '1,Arab tili,kiril:1', 'TOYLOQ TUM MAGZANDAK MFY', 6, 1, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-07 16:51:20', 'not-delivered', 0, '2021-02-07 11:02:20', 'Abdulaziz', 1),
(72, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, 0, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 16:54:08', 'not-delivered', 0, '2021-02-07 11:02:08', 'Abdulaziz', 1),
(73, 12312, 2, '11123sadas', '1,Arab tili,kiril:1', '3123123', 6, NULL, 5, '12312', 799000, 'cash', NULL, '4', '2021-02-07 16:55:36', 'not-delivered', 0, '2021-02-07 11:02:36', 'Abdulaziz', 1),
(74, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 16:56:04', 'not-delivered', 0, '2021-02-07 11:02:04', 'Abdulaziz', 1),
(75, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:19:17', 'not-delivered', 0, '2021-02-07 12:02:17', 'Abdulaziz', 1),
(76, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:19:34', 'not-delivered', 0, '2021-02-07 12:02:34', 'Abdulaziz', 1),
(77, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:20:07', 'not-delivered', 0, '2021-02-07 12:02:07', 'Abdulaziz', 1),
(78, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:20:43', 'not-delivered', 0, '2021-02-07 12:02:43', 'Abdulaziz', 1),
(79, 123122, 2, 'йцуйцуйцу', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:22:20', 'not-delivered', 0, '2021-02-07 12:02:20', 'Abdulaziz', 1),
(80, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:23:36', 'not-delivered', 0, '2021-02-07 12:02:36', 'Abdulaziz', 1),
(81, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:23:50', 'not-delivered', 0, '2021-02-07 12:02:50', 'Abdulaziz', 1),
(82, 12312, 2, 'test', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:24:24', 'not-delivered', 0, '2021-02-07 12:02:24', 'Abdulaziz', 1),
(83, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:25:14', 'not-delivered', 0, '2021-02-07 12:02:14', 'Abdulaziz', 1),
(84, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:25:34', 'not-delivered', 0, '2021-02-07 12:02:34', 'Abdulaziz', 1),
(85, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:25:46', 'not-delivered', 0, '2021-02-07 12:02:46', 'Abdulaziz', 1),
(86, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:26:41', 'not-delivered', 0, '2021-02-07 12:02:41', 'Abdulaziz', 1),
(87, 123122, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:27:45', 'not-delivered', 0, '2021-02-07 12:02:45', 'Abdulaziz', 1),
(88, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:27:50', 'not-delivered', 0, '2021-02-07 12:02:50', 'Abdulaziz', 1),
(89, 12312, 2, 'test', '1,Arab tili,kiril:1', 'test', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:28:16', 'not-delivered', 0, '2021-02-07 12:02:16', 'Abdulaziz', 1),
(90, 12312, 2, 'test', '1,Arab tili,kiril:1', 'test', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:28:19', 'not-delivered', 0, '2021-02-07 12:02:19', 'Abdulaziz', 1),
(91, 12312, 2, 'test', '1,Arab tili,kiril:1', 'test', 7, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:28:37', 'not-delivered', 0, '2021-02-07 12:02:37', 'Abdulaziz', 1),
(92, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:29:47', 'not-delivered', 0, '2021-02-07 12:02:47', 'Abdulaziz', 1),
(93, 12312, 2, 'test', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:30:01', 'not-delivered', 0, '2021-02-07 12:02:01', 'Abdulaziz', 1),
(94, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:31:28', 'not-delivered', 0, '2021-02-07 12:02:28', 'Abdulaziz', 1),
(95, 12312, 2, 'name', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:31:53', 'not-delivered', 0, '2021-02-07 12:02:53', 'Abdulaziz', 1),
(96, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:32:37', 'not-delivered', 0, '2021-02-07 12:02:37', 'Abdulaziz', 1),
(97, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:33:00', 'not-delivered', 0, '2021-02-07 12:02:00', 'Abdulaziz', 1),
(98, 12312, 2, 'test', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:33:29', 'not-delivered', 0, '2021-02-07 12:02:29', 'Abdulaziz', 1),
(99, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:34:30', 'not-delivered', 0, '2021-02-07 12:02:30', 'Abdulaziz', 1),
(100, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:34:58', 'not-delivered', 0, '2021-02-07 12:02:58', 'Abdulaziz', 1),
(101, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:35:12', 'not-delivered', 0, '2021-02-07 12:02:12', 'Abdulaziz', 1),
(102, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:35:38', 'not-delivered', 0, '2021-02-07 12:02:38', 'Abdulaziz', 1),
(103, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:39:52', 'not-delivered', 0, '2021-02-07 12:02:52', 'Abdulaziz', 1),
(104, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:40:12', 'not-delivered', 0, '2021-02-07 12:02:12', 'Abdulaziz', 1),
(105, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:40:40', 'not-delivered', 0, '2021-02-07 12:02:40', 'Abdulaziz', 1),
(106, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:41:19', 'not-delivered', 0, '2021-02-07 12:02:19', 'Abdulaziz', 1),
(107, 12312, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:41:37', 'not-delivered', 0, '2021-02-07 12:02:37', 'Abdulaziz', 1),
(108, 12312, 2, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 6, NULL, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-07 17:42:05', 'delivered', 1, '2021-02-08 12:02:49', 'Abdulaziz', 1),
(109, 123122, 2, 'name', '1,Arab tili,kiril:1', 'address', 6, NULL, 5, 'phone', 799000, 'cash', NULL, '4', '2021-02-07 17:43:23', 'not-delivered', 0, '2021-02-07 12:02:23', 'Abdulaziz', 1),
(110, 12312, 2, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'address', 13, 12, 5, '+998 97 444 67 17', 799000, 'cash', NULL, '4', '2021-02-07 17:43:40', 'not-delivered', 0, '2021-02-07 12:02:40', 'Abdulaziz', 1),
(111, 12321, 3, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, NULL, 5, '998889308623', 799000, 'click', NULL, '4', '2021-02-09 11:52:49', 'delivered', 0, '2021-02-11 06:05:43', 'Abdulaziz', 1),
(112, 12321, 3, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, NULL, 5, '998889308623', 799000, 'click', NULL, '4', '2021-02-09 11:53:04', 'delivered', 1, '2021-02-10 11:59:02', 'Abdulaziz', 1),
(113, 12312, 2, 'HAQULOVA SHOXSANAM2', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 13, 5, '+998 97 444 67 17,+998 65 564 65 46', 799000, 'cash', NULL, '4', '2021-02-09 17:20:12', 'not-delivered', 1, '2021-02-10 12:28:29', 'Abdulaziz', 1),
(114, 12312, 2, 'name', '1,Arab tili,kiril:1', 'URGUT TUMAN TOSHARIQ MAXALLASI', 13, 12, 5, '+998 94 444 67 17', 799000, 'cash', NULL, '4', '2021-02-11 11:17:00', 'not-delivered', 0, '2021-02-11 06:17:00', 'Abdulaziz', 1),
(115, 123122, 2, 'HAQULOVA SHOXSANAM', '1,Arab tili,kiril:1', 'TOYLOQ TUM MAGZANDAK MFY', 6, NULL, 7, '+998 45 454 65 54,+998 84 654 65 65,+998 __ ___ __ __,+998 __ ___ __ __', 799000, 'cash', NULL, '4', '2021-02-11 11:17:42', 'not-delivered', 0, '2021-02-11 06:17:42', 'Abdulaziz', 1);

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
(1, 'Arab tili', '/web/images/IMAGE 2021-01-31 13:45:58.jpg', 799000, 'kiril', 176, 1),
(2, 'Rus tili', '/web/images/placeholder.jpg', 599000, 'kitob', 860, 0),
(3, 'test', '/web/images/516l01RyYAL._SL1158_.jpg', 599000, 'disk', 800, 0);

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
-- Indexes for table `districts`
--
ALTER TABLE `districts`
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
-- Indexes for table `operators`
--
ALTER TABLE `operators`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
