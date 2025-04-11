-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 07:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '-',
  `isServed` tinyint(1) NOT NULL,
  `order_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`order_data`)),
  `amount` int(11) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `comment` varchar(180) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_status`, `order_data`, `bill_amount`, `rating`, `comment`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ordered', '{\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 03:27:36', '2025-04-08 03:27:36'),
(2, 2, 'Ordered', '{\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 03:28:09', '2025-04-08 03:28:09'),
(3, 2, 'Ordered', '{\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 03:28:25', '2025-04-08 03:28:25'),
(4, 2, 'Ordered', '{\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[]},{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":201.78,\"SGST\":201.78,\"CGST\":0,\"Service charges\":230},\"subTotal\":1121,\"total\":1754.56}', 1755, '1', NULL, NULL, '2025-04-08 03:30:03', '2025-04-08 03:30:03'),
(5, 2, 'Ordered', '{\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[{\"modifier_id\":2,\"modifier_name\":\"Medium\",\"modifier_rate\":200}]},{\"item_id\":3,\"item_name\":\"Veg Sandwich\",\"item_rate\":184.5,\"modifiers\":[]},{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":4,\"modifier_name\":\"BBQ\",\"modifier_rate\":50}]}],\"taxes\":{\"GST\":269.82,\"SGST\":269.82,\"CGST\":0,\"Service charges\":230},\"subTotal\":1499,\"total\":2268.64}', 2269, '1', NULL, NULL, '2025-04-08 03:36:24', '2025-04-08 03:36:24'),
(6, 2, 'Ordered', '{\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]},{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":5,\"modifier_name\":\"Alfredo\",\"modifier_rate\":200}]}],\"taxes\":{\"GST\":227.52,\"SGST\":227.52,\"CGST\":0,\"Service charges\":230},\"subTotal\":1264,\"total\":1949.04}', 1949, '1', NULL, NULL, '2025-04-08 03:56:42', '2025-04-08 03:56:42'),
(7, 2, 'Ordered', '{\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:15:37', '2025-04-08 04:15:37'),
(8, 2, 'Ordered', '{\"tables\":[13],\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:19:16', '2025-04-08 04:19:16'),
(9, 2, 'Ordered', '{\"tables\":[13],\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:19:27', '2025-04-08 04:19:27'),
(10, 2, 'Ordered', '{\"tables\":[13],\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:20:22', '2025-04-08 04:20:22'),
(11, 2, 'Ordered', '{\"tables\":[13],\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:21:03', '2025-04-08 04:21:03'),
(12, 2, 'Ordered', '{\"tables\":[13],\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:22:53', '2025-04-08 04:22:53'),
(13, 2, 'Ordered', '{\"tables\":[13],\"items\":[{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":100.8,\"SGST\":100.8,\"CGST\":0,\"Service charges\":230},\"subTotal\":560,\"total\":991.6}', 992, '1', NULL, NULL, '2025-04-08 04:24:15', '2025-04-08 04:24:15'),
(14, 2, 'Ordered', '{\"tables\":[10],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":1,\"modifier_name\":\"Small\",\"modifier_rate\":100}]}],\"taxes\":{\"GST\":108.72,\"SGST\":108.72,\"CGST\":0,\"Service charges\":230},\"subTotal\":604,\"total\":1051.44}', 1051, '1', NULL, NULL, '2025-04-08 04:29:36', '2025-04-08 04:29:36'),
(15, 4, 'Ordered', '{\"tables\":[],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":7,\"modifier_name\":\"Jumbo\",\"modifier_rate\":80},{\"modifier_id\":8,\"modifier_name\":\"Regular\",\"modifier_rate\":60}]}],\"taxes\":{\"GST\":115.92,\"SGST\":115.92,\"CGST\":0,\"Service charges\":230},\"subTotal\":644,\"total\":1105.8400000000001}', 1106, '1', NULL, NULL, '2025-04-08 04:30:55', '2025-04-08 04:30:55'),
(16, 4, 'Ordered', '{\"tables\":[],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":7,\"modifier_name\":\"Jumbo\",\"modifier_rate\":80},{\"modifier_id\":8,\"modifier_name\":\"Regular\",\"modifier_rate\":60}]}],\"taxes\":{\"GST\":115.92,\"SGST\":115.92,\"CGST\":0,\"Service charges\":230},\"subTotal\":644,\"total\":1105.8400000000001}', 1106, '1', NULL, NULL, '2025-04-08 04:31:24', '2025-04-08 04:31:24'),
(17, 4, 'Ordered', '{\"tables\":[],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":7,\"modifier_name\":\"Jumbo\",\"modifier_rate\":80},{\"modifier_id\":8,\"modifier_name\":\"Regular\",\"modifier_rate\":60}]}],\"taxes\":{\"GST\":115.92,\"SGST\":115.92,\"CGST\":0,\"Service charges\":230},\"subTotal\":644,\"total\":1105.8400000000001}', 1106, '1', NULL, NULL, '2025-04-08 04:34:13', '2025-04-08 04:34:13'),
(18, 4, 'Ordered', '{\"tables\":[],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":7,\"modifier_name\":\"Jumbo\",\"modifier_rate\":80},{\"modifier_id\":8,\"modifier_name\":\"Regular\",\"modifier_rate\":60}]}],\"taxes\":{\"GST\":115.92,\"SGST\":115.92,\"CGST\":0,\"Service charges\":230},\"subTotal\":644,\"total\":1105.8400000000001}', 1106, '1', NULL, NULL, '2025-04-08 04:37:22', '2025-04-08 04:37:22'),
(19, 7, 'Ordered', '{\"tables\":[12,16],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":5,\"modifier_name\":\"Alfredo\",\"modifier_rate\":200}]}],\"taxes\":{\"GST\":126.72,\"SGST\":126.72,\"CGST\":0,\"Service charges\":230},\"subTotal\":704,\"total\":1187.44}', 1187, '1', NULL, NULL, '2025-04-08 04:38:40', '2025-04-08 04:38:40'),
(20, 7, 'Ordered', '{\"tables\":[12,16],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":5,\"modifier_name\":\"Alfredo\",\"modifier_rate\":200}]}],\"taxes\":{\"GST\":126.72,\"SGST\":126.72,\"CGST\":0,\"Service charges\":230},\"subTotal\":704,\"total\":1187.44}', 1187, '1', NULL, NULL, '2025-04-08 04:38:46', '2025-04-08 04:38:46'),
(21, 7, 'Ordered', '{\"tables\":[12,16],\"items\":[{\"item_id\":5,\"item_name\":\"Tandoori Burger\",\"item_rate\":504,\"modifiers\":[{\"modifier_id\":5,\"modifier_name\":\"Alfredo\",\"modifier_rate\":200}]}],\"taxes\":{\"GST\":126.72,\"SGST\":126.72,\"CGST\":0,\"Service charges\":230},\"subTotal\":704,\"total\":1187.44}', 1187, '1', NULL, NULL, '2025-04-08 04:45:05', '2025-04-08 04:45:05'),
(22, 8, 'Ordered', '{\"tables\":[15],\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[{\"modifier_id\":1,\"modifier_name\":\"Small\",\"modifier_rate\":100}]},{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]}],\"taxes\":{\"GST\":219.78,\"SGST\":219.78,\"CGST\":0,\"Service charges\":230},\"subTotal\":1221,\"total\":1890.56}', 1891, '1', NULL, NULL, '2025-04-08 04:53:32', '2025-04-08 04:53:32'),
(23, 2, 'Ordered', '{\"tables\":[],\"items\":[{\"item_id\":6,\"item_name\":\"Cheeze Tweeze\",\"item_rate\":352.82,\"modifiers\":[{\"modifier_id\":5,\"modifier_name\":\"Alfredo\",\"modifier_rate\":200}]},{\"item_id\":2,\"item_name\":\"Thin Crust\",\"item_rate\":560.88,\"modifiers\":[]},{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[{\"modifier_id\":1,\"modifier_name\":\"Small\",\"modifier_rate\":100}]}],\"taxes\":{\"GST\":319.32,\"SGST\":319.32,\"CGST\":0,\"Service charges\":230},\"subTotal\":1774,\"total\":2642.64}', 2643, '1', NULL, NULL, '2025-04-08 05:27:51', '2025-04-08 05:27:51'),
(24, 9, 'Ordered', '{\"tables\":[19],\"items\":[{\"item_id\":1,\"item_name\":\"Margherita\",\"item_rate\":560.88,\"modifiers\":[{\"modifier_id\":8,\"modifier_name\":\"Regular\",\"modifier_rate\":60},{\"modifier_id\":2,\"modifier_name\":\"Medium\",\"modifier_rate\":200}]}],\"taxes\":{\"GST\":147.6,\"SGST\":147.6,\"CGST\":0,\"Service charges\":230},\"subTotal\":820,\"total\":1345.2}', 1345, '1', NULL, NULL, '2025-04-08 06:24:28', '2025-04-08 06:24:28');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_id_unique` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
