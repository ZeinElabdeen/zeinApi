-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 02 يوليو 2020 الساعة 11:37
-- إصدار الخادم: 10.3.23-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uriallab_halawyat`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admins`
--

CREATE TABLE `admins` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `reset_password_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'a@a.com', '$2y$10$18c2pb3zmEgpDc.e0vVEW.JFZQoQaW.2Em7qKz6TaxJ1WDSLSBlwG', NULL, 'a6RdfRjbKzy2mv0tXMmvgHQT36iEPUIzrjHj9rG9mHKDYSFcrhckaaz2RusQ', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `attaches`
--

CREATE TABLE `attaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `title_en`, `parent_id`, `title_ar`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'حلويات ', NULL, ' sweets', 'image', NULL, NULL),
(2, 'حلويات شرقية', 1, 'western sweets', 'image', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` tinyint(3) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `price_type` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => normal item , 1 => item with offer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_000000_create_vendors_table', 1),
(3, '2019_10_28_153011_create_admins_table', 1),
(4, '2019_10_31_095306_create_categories_table', 1),
(5, '2019_10_31_095643_create_items_table', 1),
(6, '2019_10_31_110417_create_attaches_table', 1),
(7, '2019_10_31_110532_create_favorites_table', 1),
(8, '2019_10_31_110627_create_settings_table', 1),
(9, '2019_10_31_110802_create_contact_us_table', 1),
(10, '2019_11_11_144412_create_faq_table', 1),
(11, '2019_11_13_210043_create_orders_table', 1),
(12, '2019_11_13_210211_create_order_items_table', 1),
(13, '2019_11_13_210211_create_price_types_table', 1),
(14, '2019_12_14_120106_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_cost` int(11) DEFAULT NULL,
  `delivery_cost` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=>new,1=>confirmed,2=>canceled,3=>underway,4=>done',
  `payment_method` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => online, 1=>cash on delivery',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `price_types`
--

CREATE TABLE `price_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `setting`, `key`, `value_en`, `value_ar`, `created_at`, `updated_at`) VALUES
(1, 'contact', 'facebook', 'facebook.com', 'facebook.com', '2020-06-02 12:55:20', '2020-06-02 13:00:49'),
(2, 'app_setting', 'about_us', 'about about about about about', 'عن التطبيق عن التطبيق عن التطبيق', '2020-06-02 12:55:20', '2020-06-02 13:00:48'),
(3, 'contact', 'twitter', 'twitter.com', 'twitter.com', '2020-06-02 12:55:20', '2020-06-02 13:00:47'),
(4, 'contact', 'instagram', 'instagram.com', 'instagram.com', '2020-06-02 12:55:20', '2020-06-02 13:00:46'),
(5, 'app_setting', 'terms', 'terms and conditions', 'الشروط والاحكام', '2020-06-02 12:55:20', '2020-06-02 13:10:54');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `email`, `status`, `verified`, `image`, `reset_password_code`, `code_expiration`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'hussein', '$2y$10$r0/bxgIH8ARsReIeRnnW0epOAb0TZS25J.oWIavktCxQaXlpsSIXi', '0505330609', 'user@user.com', '1', '1', NULL, NULL, NULL, NULL, '2020-02-10 07:44:22', '2020-02-10 07:44:34'),
(2, 'Mohamed', '$2y$10$L2sCqMyTqEuKBukoq.BlTucfvWYm5LOvbZL.6TiJqQqxEUxvs/JyO', '0501234567', 'm@m.com', '1', '1', NULL, NULL, NULL, NULL, '2020-02-17 20:05:56', '2020-02-17 20:07:17'),
(3, 'hussein', '$2y$10$rAsz6IZz31Wo2of7GL.ONuz4KE7owxt7XxtOpspO3BpPNS7hW88bq', '0505330608', 'user2@user.com', '1', '1', NULL, NULL, NULL, NULL, '2020-03-19 19:53:48', '2020-04-12 08:50:04'),
(4, 'sdkjkdj', '$2y$10$gCg5gxlSzGOIlkKhN4VtyeZOSWZyD/TKOZBpRvAWE3Hplyax6AStq', '0501234565', 'f@f.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-07 06:34:58', '2020-04-12 09:20:15'),
(5, 'fhfhhf', '$2y$10$wCwXv4A9WvDoBbLovkPRCOVTYpOsEwnbqDz0vh0u7IXMwpsIl3ZT.', '0501234561', 'f@g.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-07 06:35:12', '2020-04-12 09:20:37'),
(6, 'dhfh', '$2y$10$8CkMSc6k7NwbYb6foL/n9uEGGdxphwZnHs0q/HaxQa4coUhs5z5QW', '0501234569', 'd@d.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-07 06:37:55', '2020-04-12 09:26:24'),
(7, 'dhdhhd', '$2y$10$aoQgqb5IvkfoLniEqBizR.vJrelgva8faIn8dwrZsKZAoDxOeMm9S', '0501234560', 'hm@m.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-07 08:07:21', '2020-04-12 09:46:00'),
(8, 'Joh', '$2y$10$6bPQRiImZgC91IqLcRc0DOsnBSmQbMapU/qlYyZsDGrIB0WwpLhQ2', '0501234566', 'mm@m.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-08 06:15:19', '2020-04-12 09:46:01'),
(9, 'mohamed', '$2y$10$bFjO33UJTaKUqamkxlungekYgfqnsv/GkOeE743SnyljuphvyluKO', '0501111111', 'mm@mm.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-09 04:23:44', '2020-04-12 09:46:02'),
(10, 'mohamed', '$2y$10$iUrSpyjqwJcDbrTtGAyyoujcg1frJjsE.h5LA9Ot4kEVni55lGevG', '0505986734', 'dhd@fhf.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-12 08:32:47', '2020-04-12 09:46:03'),
(11, 'mohamed', '$2y$10$xCq5tRfos3Cr25E/A.c5Z.E6ap.moPWWXWVeQeSLBVv0tOEmmuN4K', '0504586295', 'sgsg@dhdh.com', '1', '1', NULL, NULL, NULL, NULL, '2020-04-12 08:49:57', '2020-04-12 09:46:04'),
(12, 'dhdd', '$2y$10$IjkVxI81/epHuHvN6JSOKuTbnAWvQs1Gw5MM9/1Ha6oxwpn30mnmi', '0509999999', 'dg@dh.com', '1', '1', NULL, '55555', '2020-04-12 11:46:20', NULL, '2020-04-12 08:54:06', '2020-04-12 09:46:04'),
(13, 'bch', '$2y$10$fIh5X5wydDYyTOcuoKbRz.M.EGokdNGThHW5QNpB6/aQKnVNkJv42', '0501234555', 'ghdhdj@iggi.com', '1', '1', NULL, NULL, NULL, NULL, '2020-05-01 22:59:54', '2020-05-01 23:00:02');

-- --------------------------------------------------------

--
-- بنية الجدول `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double UNSIGNED NOT NULL DEFAULT 0,
  `delivery_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_cost` double NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `category_id`, `password`, `phone`, `email`, `lat`, `lng`, `rate`, `delivery_time`, `delivery_cost`, `status`, `verified`, `image`, `reset_password_code`, `code_expiration`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'hussein', '1', '$2y$10$cdsTa5xHQbJwkGg/KebT6e/9urnbiExTPDO3b5tUl6t7lu9OGb8uy', '0505330609', 'vendor@vendor.com', '35.445', '45.145', 0, '1:30', 0, '1', '1', NULL, NULL, NULL, NULL, '2020-02-10 06:00:06', '2020-02-10 06:13:37'),
(2, 'hussein', '1', '$2y$10$uRDCtwmCuKfMUqJ3kGwSReuBx94kj9O2Mc2ZMSwtQ3f.D8irybfWm', '0505330608', 'vendor@vendor.com', '35.445', '45.145', 0, '1:30', 15, '1', '1', NULL, NULL, NULL, NULL, '2020-03-19 20:06:09', '2020-04-12 10:26:40'),
(3, 'dggdh', '1', '$2y$10$NSTQYadVdD0KDE9qA7LB/unsC.09teMU6NlUQj3Ic/8bmbgg2d5m2', '0501246565', 'dg@dh.com', '30.042541776707164', '31.10920161008835', 0, '1:1', 1.2, '1', '1', NULL, NULL, NULL, NULL, '2020-04-12 08:46:04', '2020-04-12 10:31:05'),
(4, 'Shop name', '1', '$2y$10$amYo1JhB9d6ipRdhoi/hNuk4KYS2pgkckakKh0/qfx2NQYFG4Qsdi', '0509999999', 'a@a.com', '30.042369087866405', '31.109288781881332', 0, '1:1', 1.5, '1', '1', NULL, NULL, NULL, NULL, '2020-04-12 10:26:35', '2020-04-12 10:31:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attaches`
--
ALTER TABLE `attaches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_types`
--
ALTER TABLE `price_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attaches`
--
ALTER TABLE `attaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_types`
--
ALTER TABLE `price_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
