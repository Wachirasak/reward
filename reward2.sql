-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2019 at 09:07 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reward2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'admin2', '098f6bcd4621d373cade4e832627b4f6');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ins_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lineid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `district` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `province` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `zipcode` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `total_point` int(6) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `cancel_reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ems` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_history`
--

CREATE TABLE `point_history` (
  `id` int(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `add_point` int(11) NOT NULL,
  `minus_point` int(11) NOT NULL,
  `promotion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `point`, `image`, `product_category_id`, `created`) VALUES
(1, 'เงินสด 200 บาท', 'เงินสดโอนเข้าบัญชี  ', 100, 'img_5ceba7b2554be.jpg', 1, '2019-05-27 16:02:42'),
(2, 'iPhone XS 64 Gb (สี Gold)', 'มือถือสุดล้ำสมัย  ', 20000, 'img_5cd935d8cc826.jpg', 2, '2019-05-13 16:16:08'),
(3, 'สร้อยคอทองคำแท้ 1 บาท', 'สร้อยคอทองคำ  ', 10000, 'img_5cd94e8053e74.jpg', 5, '2019-05-13 18:01:20'),
(4, 'เงินสด 500 บาท', 'เงินสดโอนเข้าบัญชี  ', 250, 'img_5cef4f05aeb0b.jpg', 1, '2019-05-30 10:33:25'),
(5, 'เงินสด 1,000 บาท', 'เงินสดโอนเข้าบัญชี  ', 500, 'img_5cef4f1b2a6bf.jpg', 1, '2019-05-30 10:33:47'),
(6, 'เงินสด 5,000 บาท', 'เงินสดโอนเข้าบัญชี  ', 2500, 'img_5cef4f5a6a4b1.jpg', 1, '2019-05-30 10:34:50'),
(7, 'เครดิตเว็บ 300 บาท', 'เครดิตเติมเข้า user ของท่าน  ', 125, 'img_5cef4fd16462e.jpg', 1, '2019-05-30 10:36:49'),
(8, 'เครดิตเว็บ 500 บาท', 'เครดิตเติมเข้า user ของท่าน  ', 200, 'img_5cef4fe811f06.jpg', 1, '2019-05-30 10:37:12'),
(9, 'เครดิตเว็บ 2,000 บาท', 'เครดิตเติมเข้า user ของท่าน  ', 750, 'img_5cef4ffe8e856.jpg', 1, '2019-05-30 10:37:34'),
(10, 'เครดิตเว็บ 5,000 บาท', 'เครดิตเติมเข้า user ของท่าน  ', 1800, 'img_5cef500eb4d52.jpg', 1, '2019-05-30 10:37:50'),
(11, 'Samsung Galaxy S10+ 8/128G', 'มือถือ Android ', 18000, 'img_5cef509347998.jpg', 2, '2019-05-30 10:40:03'),
(12, 'OPPO F11 Pro (สี Thunder Black)', 'Portrait สวย แม้แสงน้อย  ', 5500, 'img_5cef50a405abd.jpg', 2, '2019-05-30 10:40:20'),
(13, 'Vivo V15 Pro (สี Topaz Blue)', 'โดดเด่นด้วยกล้องหน้า', 7500, 'img_5cef50b67e0be.jpg', 2, '2019-05-30 10:40:38'),
(14, 'Huawei MediaPad T5 10', 'แท็บเล็ตคุณภาพดี  ', 2900, 'img_5cef5101768c6.jpg', 2, '2019-05-30 10:41:53'),
(15, 'Samsung Galaxy Note 9', 'มือถือ Android มีปากกาเขียนสนุก เขียนลื่น  ', 16800, 'img_5cef5115cd03a.jpg', 2, '2019-05-30 10:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `code`, `name`) VALUES
(1, 'C001', 'เงินสด,เครดิตเว็บ'),
(2, 'C002', 'มือถือ,แท็ปเล็ต'),
(3, 'C003', 'Gadget'),
(4, 'C004', 'เสื้อผ้า'),
(5, 'C005', 'พรีเมี่ยม'),
(6, 'C006', 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `own_point` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`) USING BTREE,
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `point_history`
--
ALTER TABLE `point_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_history`
--
ALTER TABLE `point_history`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `point_history`
--
ALTER TABLE `point_history`
  ADD CONSTRAINT `fk_user_id_point_history` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
