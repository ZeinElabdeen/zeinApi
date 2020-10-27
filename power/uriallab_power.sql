-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 02 يوليو 2020 الساعة 11:38
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
-- Database: `uriallab_power`
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
(1, 'admin', 'admin@admin.com', '$2y$10$aZvVFLvPmEvUQtZNTPVjJ.oTp.m2A5Ka3jdT9uaI012C2UpCj8IM6', NULL, 'YKWf5aw7PwSJCWw5iziGyaKnvx6bZWHJEJVjPTJPuOAQyaAH0aYPqAPVbsfk', '2020-03-11 11:32:36', '2020-03-20 11:32:36');

-- --------------------------------------------------------

--
-- بنية الجدول `ads`
--

CREATE TABLE `ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ads`
--

INSERT INTO `ads` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'car01.jpg', '1', NULL, NULL),
(3, 'car04.jpg', '1', NULL, NULL),
(4, 'car02.jpg', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `attaches`
--

CREATE TABLE `attaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `attaches`
--

INSERT INTO `attaches` (`id`, `order_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 7, '4787757e7377d83a185313568bed2392.png', '2020-02-02 13:41:59', '2020-02-02 13:41:59'),
(2, 8, 'b6bf6b577c0d39e95d603bd7d4f1f9f5.jpg', '2020-02-04 14:57:56', '2020-02-04 14:57:56'),
(3, 9, 'b6a47a74296505a1a6865d5ac92e06bc.jpg', '2020-02-04 14:59:16', '2020-02-04 14:59:16'),
(4, 9, '17760ab6aa47339386acb78c064abf5c.jpg', '2020-02-04 14:59:16', '2020-02-04 14:59:16'),
(5, 10, '0efd243f35107fa295f4f2a26d6f8414.jpg', '2020-02-04 16:11:53', '2020-02-04 16:11:53'),
(6, 10, '7e56f89f5877040cbf76edeff2dcb8ea.jpg', '2020-02-04 16:11:53', '2020-02-04 16:11:53'),
(7, 10, '5d3f68ec8ffc776b9c2051149e371741.jpg', '2020-02-04 16:11:53', '2020-02-04 16:11:53'),
(8, 11, '8f5986b3cad1b52a2aa87d35278e01ff.jpg', '2020-02-04 16:19:13', '2020-02-04 16:19:13'),
(9, 11, '3474a14047a292c9b56eb00b6a11369e.jpg', '2020-02-04 16:19:13', '2020-02-04 16:19:13'),
(10, 12, '457c5310bef6c8e18c01b1b30b16549d.jpg', '2020-02-04 16:20:30', '2020-02-04 16:20:30'),
(11, 13, '22436c822d2cedcfcb0ef507afea0da0.jpg', '2020-02-04 16:24:19', '2020-02-04 16:24:19'),
(12, 13, '59c61ca8f22c34d6166f1fba368d83d9.jpg', '2020-02-04 16:24:19', '2020-02-04 16:24:19'),
(13, 14, 'd00bc04591d5f7a20d9584656411d42b.jpg', '2020-02-04 16:32:29', '2020-02-04 16:32:29'),
(14, 14, '3e4ba305c7a5a157561f309b601e17b5.jpg', '2020-02-04 16:32:29', '2020-02-04 16:32:29'),
(15, 15, '7ffeb31e4b45dbbd30fb6e84f16fb81d.jpg', '2020-02-04 16:53:57', '2020-02-04 16:53:57'),
(16, 15, '0e0ddb7159f4707ceb1dda81962f11df.jpg', '2020-02-04 16:53:57', '2020-02-04 16:53:57'),
(17, 16, '98b014bbc132ac3945822c976bd23962.', '2020-02-05 13:34:41', '2020-02-05 13:34:41'),
(21, 28, 'd7f62437a04c087f9368db150903aa0d.png', '2020-02-24 11:27:17', '2020-02-24 11:27:17'),
(22, 28, '7c2e9daf00baa87a8905cc27952c5bb9.png', '2020-02-24 11:27:17', '2020-02-24 11:27:17'),
(23, 29, 'e9f8b990055f00fb150fb2987dab751b.png', '2020-02-24 11:43:14', '2020-02-24 11:43:14'),
(24, 29, 'dc455ac18add8f22ff81824b66d6555c.png', '2020-02-24 11:43:14', '2020-02-24 11:43:14'),
(25, 30, 'dd26333a2ef5fb1c4a41f75e45f3944c.jpg', '2020-02-24 11:47:11', '2020-02-24 11:47:11'),
(26, 30, '6d0d305a08766f1902187707b98fe8cf.jpg', '2020-02-24 11:47:11', '2020-02-24 11:47:11'),
(27, 31, '700f0e35d4af5ec19555adae32fbf1e0.jpg', '2020-02-24 11:48:23', '2020-02-24 11:48:23'),
(28, 31, '7b2b88676f95c11c35d23661cb091c26.jpg', '2020-02-24 11:48:23', '2020-02-24 11:48:23'),
(29, 32, 'd7ba8117a2424e2d80711360b8d04c73.jpg', '2020-02-24 11:50:21', '2020-02-24 11:50:21'),
(30, 32, '88b9060583b364cb63b3b3cc20796a0f.jpg', '2020-02-24 11:50:21', '2020-02-24 11:50:21'),
(31, 33, '9ae31ec0494deada077b4718d74dc76f.png', '2020-02-24 12:28:10', '2020-02-24 12:28:10'),
(32, 33, '742b4322e2285827ac08afb54f6f46f0.png', '2020-02-24 12:28:10', '2020-02-24 12:28:10'),
(33, 36, '4ccfb1edfaba652c4289b4b2be2fc206.jpeg', '2020-06-01 10:13:51', '2020-06-01 10:13:51');

-- --------------------------------------------------------

--
-- بنية الجدول `cancel_reasons`
--

CREATE TABLE `cancel_reasons` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `reason_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => user reasons, 2 =>driver-reasons',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cancel_reasons`
--

INSERT INTO `cancel_reasons` (`id`, `reason_ar`, `reason_en`, `type`, `created_at`, `updated_at`) VALUES
(1, 'سبب عميل', 'customer reason', '1', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(2, 'سبب عميل', 'customer reason', '1', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(3, 'سبب عميل', 'customer reason', '1', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(4, 'سبب عميل', 'customer reason', '1', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(5, 'سبب سائق', 'driver reason', '2', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(6, 'سبب سائق', 'driver reason', '2', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(7, 'سبب سائق', 'driver reason', '2', '2020-06-03 12:10:05', '2020-06-03 12:10:05'),
(8, 'سبب سائق', 'driver reason', '2', '2020-06-03 12:10:05', '2020-06-03 12:10:05');

-- --------------------------------------------------------

--
-- بنية الجدول `cars_models`
--

CREATE TABLE `cars_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cars_models`
--

INSERT INTO `cars_models` (`id`, `title_en`, `title_ar`, `created_at`, `updated_at`) VALUES
(1, 'model1', 'موديل1', '2020-06-03 11:25:46', '2020-06-03 11:25:46'),
(2, 'model2', 'موديل2', '2020-06-03 11:25:46', '2020-06-03 11:25:46');

-- --------------------------------------------------------

--
-- بنية الجدول `cars_types`
--

CREATE TABLE `cars_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cars_types`
--

INSERT INTO `cars_types` (`id`, `title_en`, `title_ar`, `created_at`, `updated_at`) VALUES
(1, 'type1', 'نوع1', NULL, NULL),
(2, 'type2', 'نوع2', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(6, 'samao power', 'samo@power.com', 'it was awesome power', '2020-06-09 12:43:24', '2020-06-09 12:43:24'),
(7, 'samao', 'samo@yf.fg', 'it was awesome333', '2020-06-11 17:06:59', '2020-06-11 17:06:59'),
(8, 'samao', 'samo@yf.fg', 'it was awesome333ddddd', '2020-06-11 17:07:10', '2020-06-11 17:07:10');

-- --------------------------------------------------------

--
-- بنية الجدول `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'samaa11', 10, '0', '2020-06-09 17:32:38', '2020-06-09 17:34:19'),
(2, 'samaa1122', 10, '0', '2020-06-09 17:32:38', '2020-06-09 17:36:41'),
(3, '8lX4lNnY9A', 3, '0', '2020-06-10 17:28:01', '2020-06-11 16:24:18');

-- --------------------------------------------------------

--
-- بنية الجدول `deliver_requests`
--

CREATE TABLE `deliver_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `deliver_requests`
--

INSERT INTO `deliver_requests` (`id`, `order_id`, `driver_id`, `cost`, `created_at`, `updated_at`) VALUES
(5, 43, 8, 40, '2020-06-11 17:39:38', '2020-06-11 17:39:38');

-- --------------------------------------------------------

--
-- بنية الجدول `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` int(10) NOT NULL DEFAULT 0,
  `car_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_front_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_back_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_form_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_insurance_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_model_id` int(10) UNSIGNED NOT NULL,
  `car_type_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => male, 1 => female',
  `service` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 => people driver, 1 => package driver',
  `rate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `notification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `drivers`
--

INSERT INTO `drivers` (`id`, `username`, `phone`, `email`, `password`, `image`, `id_number`, `wallet`, `car_color`, `car_number`, `id_image`, `car_front_image`, `car_back_image`, `car_form_image`, `car_insurance_image`, `driving_license_image`, `car_model_id`, `car_type_id`, `gender`, `service`, `rate`, `reset_password_code`, `code_expiration`, `fcm_token`, `status`, `notification`, `verified`, `created_at`, `updated_at`) VALUES
(4, 'samaa sameh', '0505330155', NULL, '$2y$10$X6/MHIJXYMM4L2VQEKcTYOoxRgmn5O9p4utJELnzzhGZWAnDrKVTS', '7110136363208109fd4fcd5f871f13a7.jpg', NULL, 200, 'blue', 'sm2299', 'c085710d8e4d78164d83d4f1ddc8e1ae.PNG', '49b28cfed04cd6f606379fe296b32d51.png', 'dabf5d76f4c2df842aee77424008e912.png', '0822335efe4546374875de9ce8601f50.PNG', '417ddeb52079132814ce9be19d12e6cc.PNG', 'c18214d6c5a061013c2c5134e0bec4ff.PNG', 1, 1, '1', '0', '3', '25586', '2020-06-09 16:24:33', '1255888jkjkjjnhttttytt55tgggggg', '1', '1', '1', '2020-06-09 13:52:09', '2020-06-18 12:55:55'),
(8, 'adam driver', '0505330166', NULL, '$2y$10$FnKIaEqMi7Az.ba9Zx9A3uId44s9Y4okkTEegUSwjY9ZM5ecRLGMW', 'bc31ca7658166e498a53af951077031e.jpg', NULL, 81, 'blue', 'ad18569', '9d08c1c95161e91cd59438113ed1b492.jpeg', 'b88ae5601f00fbe9154783433474c0f7.png', 'a4eb20b833a99fd995750122ea79ab79.png', 'f29cb698bc6ad33fe6beea2b600d4f31.jpeg', '2247e5bc91216cd4b04542f526238836.jpg', '78d4c7f61881fe0ec64d3f411685e57c.jpeg', 1, 1, '0', '0', '0', '25744', '2020-06-11 19:19:48', 'eHqrPG6IdvM:APA91bF3_BxHPg5Uni3NtwSWkEeGSgpMEA22KkrxinC2QLdRpUJuhUg3ZogutB_3p75ciUn_zX4E0aK6ztRBCTA-9-t2tLXt0peez82jMBBuc6ZsxALiPweXDR-wQ8txHC5vFDkppkuw', '1', '1', '1', '2020-06-11 17:10:51', '2020-06-23 08:13:48'),
(9, 'adam', '0505330169', NULL, '$2y$10$iePF062fGGNR0/2UVSOC9.pWpxiWb7xQpMVEt6YTHlB7Zh488Cgze', '7083af5b2f49183463e9e62d779c725e.jpg', NULL, 0, 'blue', 'ad18569', '2e467dcf391951fa2391e0ed39c35518.png', '8c2266356a96bdb6dfe85f9e3eeef7aa.png', 'e12b23e84a03f6330ef9d95c1106b6be.png', '2c7e0dc2d2eb6add43ed86096cb08b00.jpg', '8966dddf84cf615fe98d1f992e56a942.jpg', '89f603faffe77e64157deae4c5e18627.jpg', 1, 1, '0', '0', '0', NULL, NULL, NULL, '0', '1', '82298', '2020-06-18 12:31:57', '2020-06-18 12:31:57');

-- --------------------------------------------------------

--
-- بنية الجدول `driver_rates`
--

CREATE TABLE `driver_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `driver_rates`
--

INSERT INTO `driver_rates` (`id`, `order_id`, `driver_id`, `user_id`, `rate`, `review`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 4, 'it was awesome', '2020-02-09 13:41:12', '2020-02-09 13:41:12'),
(2, 0, 1, 2, 4, 'it was awesome', '2020-03-19 12:15:35', '2020-03-19 12:15:35'),
(4, 0, 4, 1, 4, 'it was awesommmmme', '2020-06-09 15:09:54', '2020-06-09 15:09:54'),
(5, 0, 8, 5, 3, 'it was awesome good client', '2020-06-11 17:24:29', '2020-06-11 17:24:29'),
(6, 44, 8, 5, 3, 'it was awesome good client', '2020-06-18 12:57:22', '2020-06-18 12:57:22');

-- --------------------------------------------------------

--
-- بنية الجدول `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `faq`
--

INSERT INTO `faq` (`id`, `title_en`, `title_ar`, `description_en`, `description_ar`, `created_at`, `updated_at`) VALUES
(1, 'title', 'العنوان', 'description', 'الوصف', NULL, NULL),
(2, 'title', 'العنوان', 'description', 'الوصف', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `general_notifications`
--

CREATE TABLE `general_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `message_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, '2014_10_12_000000_create_drivers_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2019_10_31_110627_create_settings_table', 1),
(5, '2019_11_13_124801_create_contact_us_table', 1),
(6, '2019_11_18_111225_create_admins_table', 1),
(7, '2019_11_24_104139_create_attaches_table', 1),
(8, '2019_11_27_113439_create_cars_models_table', 1),
(9, '2019_11_27_113439_create_cars_types_table', 1),
(10, '2019_11_27_113439_create_rates_table', 1),
(15, '2020_01_08_131838_create_deliver_requests_table', 1),
(16, '2020_01_08_131817_create_orders_table', 2),
(17, '2020_01_29_104922_create_user_places_table', 2),
(18, '2019_11_27_113439_create_driver_rates_table', 3),
(19, '2019_11_27_113439_create_user_rates_table', 3),
(25, '2019_12_01_133412_create_general_notifications_table', 4),
(26, '2019_12_01_133412_create_order_notifications_table', 4),
(27, '2019_12_23_124223_create_rooms_table', 5),
(30, '2019_12_31_092744_create_room_messages_table', 6),
(31, '2019_12_23_122131_create_ads_table', 7),
(32, '2019_11_11_144412_create_faq_table', 8),
(33, '2019_12_01_133412_create_notifications_table', 9),
(34, '2020_01_29_104922_create_cancel_reasons_table', 9),
(35, '2020_01_29_104922_create_order_cancel_reason_table', 9);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `driver_id` int(10) UNSIGNED DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `destination` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double UNSIGNED DEFAULT NULL,
  `coupon_code` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_type` int(10) UNSIGNED DEFAULT NULL,
  `payment_method` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 =>cash,1 => credit',
  `gender` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 =>male,1 => female',
  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 =>people transfer,1 => packages transfer',
  `status` enum('0','1','2','3','5','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 =>new,1 => waiting for transmitting,2 =>underway,3 =>end trip,5=>done and paid, 4 =>canceled ',
  `created_at` timestamp NULL DEFAULT NULL,
  `req_expiration` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `code`, `user_id`, `driver_id`, `start_lat`, `start_lng`, `end_lat`, `end_lng`, `distance`, `cost`, `coupon_code`, `coupon_value`, `car_type`, `payment_method`, `gender`, `type`, `status`, `created_at`, `req_expiration`, `updated_at`) VALUES
(44, 351744, 5, 8, '35.445', '45.145', '36.4', '41.214', '15', 150, '8lX4lNnY9A', '3', 2, '0', '0', '0', '3', '2020-06-11 16:24:18', NULL, '2020-06-22 17:20:21'),
(43, 565466, 5, NULL, '35.445', '45.145', '36.4', '41.214', '', NULL, NULL, NULL, 2, '0', '0', '0', '4', '2020-06-11 16:23:10', NULL, '2020-06-22 16:16:53'),
(41, 994948, 4, 4, '35.445', '45.145', '36.4', '41.214', '', 50, 'samaa1122', '10', 1, '0', '1', '0', '1', '2020-06-09 17:36:41', NULL, '2020-06-09 17:49:17'),
(40, 517234, 4, 4, '35.445', '45.145', '36.4', '41.214', '', 40, 'samaa11', '10', 1, '0', '1', '0', '1', '2020-06-09 17:33:52', NULL, '2020-06-10 13:45:29'),
(58, 987643, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-21 13:50:24', '2020-06-21 01:50:54', '2020-06-21 13:50:24'),
(59, 749718, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-21 13:53:16', '2020-06-21 01:53:46', '2020-06-21 13:53:16'),
(60, 865645, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-21 14:01:05', '2020-06-21 02:01:35', '2020-06-21 14:01:05'),
(61, 664167, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-21 14:27:19', '2020-06-21 02:27:49', '2020-06-21 14:27:19'),
(62, 733690, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-21 14:27:44', '2020-06-21 02:28:14', '2020-06-21 14:27:44'),
(63, 653748, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-21 14:31:08', '2020-06-21 02:31:38', '2020-06-21 14:31:08'),
(64, 850468, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '5', '2020-06-21 14:32:38', '2020-06-21 02:33:08', '2020-06-21 14:32:38'),
(65, 831100, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-22 16:15:25', '2020-06-22 04:15:55', '2020-06-22 16:15:25'),
(66, 537049, 5, NULL, '35.445', '45.145', '36.4', '41.214', '10', 100, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-23 10:51:18', '2020-06-23 10:51:48', '2020-06-23 10:51:18'),
(67, 775245, 5, NULL, '35.445', '45.145', '36.4', '41.214', '1000', 10000, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-23 10:51:47', '2020-06-23 10:52:17', '2020-06-23 10:51:47'),
(68, 263915, 5, NULL, '35.445', '45.145', '36.4', '41.214', '1000', 10000, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-23 11:00:57', '2020-06-22 23:01:27', '2020-06-23 11:00:57'),
(69, 493293, 5, NULL, '35.445', '45.145', '36.4', '41.214', '1000', 10000, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-23 11:01:18', '2020-06-22 23:01:48', '2020-06-23 11:01:18'),
(70, 116834, 5, NULL, '35.445', '45.145', '36.4', '41.214', '1000', 10000, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-23 11:17:55', '2020-06-22 23:18:25', '2020-06-23 11:17:55'),
(71, 540572, 5, NULL, '35.445', '45.145', '36.4', '41.214', '1000', 10000, NULL, NULL, 2, '0', '0', '0', '0', '2020-06-23 11:28:43', '2020-06-22 23:29:13', '2020-06-23 11:28:43');

-- --------------------------------------------------------

--
-- بنية الجدول `order_cancel_reason`
--

CREATE TABLE `order_cancel_reason` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason_id` tinyint(3) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_cancel_reason`
--

INSERT INTO `order_cancel_reason` (`id`, `reason_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 41, '2020-06-09 17:45:50', '2020-06-09 17:45:50'),
(2, 1, 41, '2020-06-09 17:47:09', '2020-06-09 17:47:09'),
(3, 1, 43, '2020-06-11 16:41:02', '2020-06-11 16:41:02'),
(4, 1, 43, '2020-06-11 16:41:05', '2020-06-11 16:41:05'),
(5, 1, 43, '2020-06-22 16:16:53', '2020-06-22 16:16:53'),
(6, 1, 43, '2020-06-22 16:16:56', '2020-06-22 16:16:56');

-- --------------------------------------------------------

--
-- بنية الجدول `order_notifications`
--

CREATE TABLE `order_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => for user, 1 => for driver',
  `is_read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `message_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_notifications`
--

INSERT INTO `order_notifications` (`id`, `user_id`, `driver_id`, `order_id`, `type`, `is_read`, `message_en`, `message_ar`, `created_at`, `updated_at`) VALUES
(33, 4, 4, 39, '1', '0', 'new order', 'طلب جديد', '2020-06-09 17:31:10', '2020-06-09 17:31:10'),
(34, 4, 4, 40, '1', '0', 'new order', 'طلب جديد', '2020-06-09 17:33:52', '2020-06-09 17:33:52'),
(35, 4, 4, 41, '1', '0', 'new order', 'طلب جديد', '2020-06-09 17:36:41', '2020-06-09 17:36:41'),
(36, 4, 4, 41, '1', '0', 'samo user Accepted Your Offer', 'قام samo user بالموافقة على عرضك ', '2020-06-09 17:49:17', '2020-06-09 17:49:17'),
(37, 4, 4, 40, '1', '0', 'samo user Accepted Your Offer', 'قام samo user بالموافقة على عرضك ', '2020-06-10 13:45:29', '2020-06-10 13:45:29'),
(38, 4, 4, 39, '1', '0', 'samo user Accepted Your Offer', 'قام samo user بالموافقة على عرضك ', '2020-06-10 13:48:58', '2020-06-10 13:48:58'),
(39, 5, 4, 43, '1', '0', 'new order', 'طلب جديد', '2020-06-11 16:23:10', '2020-06-11 16:23:10'),
(40, 5, 8, 44, '1', '0', 'new order', 'طلب جديد', '2020-06-11 16:24:18', '2020-06-11 16:24:18'),
(41, 5, 8, 44, '1', '0', 'hamza user Accepted Your Offer', 'قام hamza user بالموافقة على عرضك ', '2020-06-11 16:43:19', '2020-06-11 16:43:19'),
(42, 5, 8, 44, '1', '0', 'hamza user Accepted Your Offer', 'قام hamza user بالموافقة على عرضك ', '2020-06-11 16:52:09', '2020-06-11 16:52:09'),
(43, 5, 8, 44, '1', '0', 'hamza user Accepted Your Offer', 'قام hamza user بالموافقة على عرضك ', '2020-06-11 16:56:20', '2020-06-11 16:56:20'),
(45, 5, 8, 43, '0', '0', 'adam driver Offers To Perform Your Order', 'قام adam driver بتقديم عرض توصيل ', '2020-06-11 17:39:38', '2020-06-11 17:39:38'),
(46, 5, 8, 44, '0', '0', 'adam driver Order Status Has Been Changed', ' adam driver تم تغيير حالة الطلب', '2020-06-11 17:49:02', '2020-06-11 17:49:02'),
(47, 5, 8, 44, '0', '0', 'adam driver Order Status Has Been Changed', ' adam driver تم تغيير حالة الطلب', '2020-06-11 17:50:55', '2020-06-11 17:50:55'),
(48, 5, 4, 46, '1', '0', 'new order', 'طلب جديد', '2020-06-18 16:30:08', '2020-06-18 16:30:08'),
(49, 5, 8, 46, '1', '0', 'new order', 'طلب جديد', '2020-06-18 16:30:10', '2020-06-18 16:30:10'),
(50, 5, 4, 47, '1', '0', 'new order', 'طلب جديد', '2020-06-21 11:55:49', '2020-06-21 11:55:49'),
(51, 5, 8, 47, '1', '0', 'new order', 'طلب جديد', '2020-06-21 11:55:50', '2020-06-21 11:55:50'),
(52, 5, 4, 48, '1', '0', 'new order', 'طلب جديد', '2020-06-21 11:58:19', '2020-06-21 11:58:19'),
(53, 5, 8, 48, '1', '0', 'new order', 'طلب جديد', '2020-06-21 11:58:19', '2020-06-21 11:58:19'),
(54, 5, 4, 50, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:36:31', '2020-06-21 13:36:31'),
(55, 5, 4, 51, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:37:27', '2020-06-21 13:37:27'),
(56, 5, 4, 52, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:37:51', '2020-06-21 13:37:51'),
(57, 5, 4, 53, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:41:17', '2020-06-21 13:41:17'),
(58, 5, 4, 54, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:42:00', '2020-06-21 13:42:00'),
(59, 5, 4, 55, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:42:39', '2020-06-21 13:42:39'),
(60, 5, 4, 56, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:42:53', '2020-06-21 13:42:53'),
(61, 5, 4, 57, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:43:48', '2020-06-21 13:43:48'),
(62, 5, 4, 58, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:50:24', '2020-06-21 13:50:24'),
(63, 5, 4, 59, '1', '0', 'new order', 'طلب جديد', '2020-06-21 13:53:16', '2020-06-21 13:53:16'),
(64, 5, 4, 60, '1', '0', 'new order', 'طلب جديد', '2020-06-21 14:01:05', '2020-06-21 14:01:05'),
(65, 5, 4, 61, '1', '0', 'new Trip', 'رحلة جديدة', '2020-06-21 14:27:19', '2020-06-21 14:27:19'),
(66, 5, 4, 62, '1', '0', 'new Trip', 'رحلة جديدة', '2020-06-21 14:27:44', '2020-06-21 14:27:44'),
(67, 5, 4, 63, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-21 14:31:08', '2020-06-21 14:31:08'),
(68, 5, 4, 64, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-21 14:32:38', '2020-06-21 14:32:38'),
(69, 5, 8, 64, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-21 14:32:39', '2020-06-21 14:32:39'),
(70, 5, 8, 44, '0', '0', 'adam driver Order Status Has Been Changed', ' adam driver تم تغيير حالة الطلب', '2020-06-21 16:08:49', '2020-06-21 16:08:49'),
(71, 5, 4, 65, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-22 16:15:25', '2020-06-22 16:15:25'),
(72, 5, 8, 65, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-22 16:15:35', '2020-06-22 16:15:35'),
(73, 5, 8, 44, '0', '0', 'adam driver Order Status Has Been Changed', ' adam driver تم تغيير حالة الطلب', '2020-06-22 16:17:42', '2020-06-22 16:17:42'),
(74, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 16:57:50', '2020-06-22 16:57:50'),
(75, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 17:04:23', '2020-06-22 17:04:23'),
(76, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 17:20:21', '2020-06-22 17:20:21'),
(77, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 17:32:23', '2020-06-22 17:32:23'),
(78, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 17:33:15', '2020-06-22 17:33:15'),
(79, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 17:33:53', '2020-06-22 17:33:53'),
(80, 5, 8, 44, '0', '0', 'adam driver The end of the trip has been reached', 'adam driver تم الوصول لمكان نهاية الرحلة ', '2020-06-22 18:02:58', '2020-06-22 18:02:58'),
(81, 5, 4, 66, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 10:51:18', '2020-06-23 10:51:18'),
(82, 5, 8, 66, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 10:51:18', '2020-06-23 10:51:18'),
(83, 5, 4, 67, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 10:51:47', '2020-06-23 10:51:47'),
(84, 5, 8, 67, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 10:51:47', '2020-06-23 10:51:47'),
(85, 5, 4, 68, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:00:57', '2020-06-23 11:00:57'),
(86, 5, 8, 68, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:00:57', '2020-06-23 11:00:57'),
(87, 5, 4, 69, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:01:18', '2020-06-23 11:01:18'),
(88, 5, 8, 69, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:01:19', '2020-06-23 11:01:19'),
(89, 5, 4, 70, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:17:55', '2020-06-23 11:17:55'),
(90, 5, 8, 70, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:17:55', '2020-06-23 11:17:55'),
(91, 5, 4, 71, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:28:43', '2020-06-23 11:28:43'),
(92, 5, 8, 71, '1', '0', 'hamza user Has added New Trip', 'hamza user قام بأضافة رحلة جديدة', '2020-06-23 11:28:43', '2020-06-23 11:28:43');

-- --------------------------------------------------------

--
-- بنية الجدول `order_status`
--

CREATE TABLE `order_status` (
  `id` int(10) NOT NULL,
  `value` int(10) NOT NULL DEFAULT 0,
  `name_ar` varchar(100) DEFAULT NULL,
  `name_en` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `order_status`
--

INSERT INTO `order_status` (`id`, `value`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 0, 'رحلة جديد', 'new trip', '2020-06-22 16:26:28', '2020-06-22 16:26:28'),
(2, 1, 'في اتتظار سائق', 'waiting for driver ', '2020-06-22 16:26:41', '2020-06-22 16:28:27'),
(3, 2, 'لقد وصل', 'has been arrived ', '2020-06-22 16:26:46', '2020-06-22 16:29:37'),
(4, 3, 'تم الوصول لمكان نهاية الرحلة ', 'The end of the trip has been reached', '2020-06-22 16:26:52', '2020-06-22 16:32:03'),
(5, 4, 'تم الغاء الرحلة ', '\r\nتم الغاء الرحلة \r\ntama \'iilgha\' alrihla\r\n16/5000\r\nThe trip has been canceled\r\nbeenbin\r\nDefinitions', '2020-06-22 16:27:08', '2020-06-22 16:31:49'),
(6, 5, 'تم انهاء الرحلة ', 'The trip has been ended', '2020-06-22 16:27:12', '2020-06-22 16:32:45');

-- --------------------------------------------------------

--
-- بنية الجدول `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `rate` tinyint(3) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `is_closed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0:open,1:closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `rooms`
--

INSERT INTO `rooms` (`id`, `user_id`, `order_id`, `driver_id`, `is_closed`, `created_at`, `updated_at`) VALUES
(4, 4, 41, 4, '0', '2020-06-09 17:49:18', '2020-06-09 17:49:18'),
(5, 4, 40, 4, '0', '2020-06-10 13:45:39', '2020-06-10 13:45:39'),
(6, 4, 39, 4, '0', '2020-06-10 13:48:59', '2020-06-10 13:48:59'),
(7, 5, 44, 4, '0', '2020-06-11 16:43:20', '2020-06-11 16:43:20'),
(8, 5, 44, 8, '1', '2020-06-11 16:52:09', '2020-06-11 17:50:55');

-- --------------------------------------------------------

--
-- بنية الجدول `room_messages`
--

CREATE TABLE `room_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => text, 2 => image, 3 => voice',
  `read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => from user message, 1 => from vendor message',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `room_messages`
--

INSERT INTO `room_messages` (`id`, `room_id`, `sender_id`, `content`, `content_type`, `read`, `type`, `created_at`, `updated_at`) VALUES
(15, 4, 4, 'test from user to driver', '1', '0', '0', '2020-06-09 17:59:12', '2020-06-09 17:59:12'),
(17, 7, 4, 'teddd  driv mm', '1', '0', '1', '2020-06-11 17:02:38', '2020-06-11 17:02:38'),
(18, 7, 5, 'teddd  user mm', '1', '0', '0', '2020-06-11 17:02:54', '2020-06-11 17:02:54');

-- --------------------------------------------------------

--
-- بنية الجدول `salecodes`
--

CREATE TABLE `salecodes` (
  `id` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `salevalue` int(11) NOT NULL,
  `statu` float NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `salecodes`
--

INSERT INTO `salecodes` (`id`, `code`, `salevalue`, `statu`, `created_at`, `updated_at`) VALUES
(1, 'IY84YMe7k4', 150, 0, '2020-06-02 16:06:17', '2020-06-09 14:40:30'),
(3, 'IY84YM555e7k4', 150, 0, '2020-06-02 16:06:17', '2020-06-03 13:54:26'),
(4, 'x2l8l10xwO', 50, 0, '2020-06-09 14:56:03', '2020-06-09 14:59:28'),
(5, 'HcVAgXghld', 100, 0, '2020-06-11 17:21:22', '2020-06-11 17:21:38');

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
(2, 'app_setting', 'about_us', 'about about about about about\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'عن التطبيق\r\nهناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص،', '2020-06-02 12:55:20', '2020-06-09 12:54:05'),
(3, 'contact', 'twitter', 'twitter.com', 'twitter.com', '2020-06-02 12:55:20', '2020-06-02 13:00:47'),
(4, 'contact', 'instagram', 'instagram.com', 'instagram.com', '2020-06-02 12:55:20', '2020-06-02 13:00:46'),
(5, 'app_setting', 'terms', 'terms and conditions\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'الشروط والاحكام\r\nناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص،', '2020-06-02 12:55:20', '2020-06-09 12:54:56'),
(6, 'app_setting', 'rate_percent', '13', '13', '2020-06-02 12:55:20', '2020-06-21 09:28:35'),
(7, 'app_setting', 'km_price', '10', '10', '2020-06-02 12:55:20', '2020-06-18 16:46:37');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `notification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `password`, `birth_date`, `image`, `reset_password_code`, `code_expiration`, `fcm_token`, `status`, `notification`, `verified`, `rate`, `created_at`, `updated_at`) VALUES
(4, 'samo user', '0505330800', NULL, '$2y$10$ZWPtkn5GP6QB5TW0NdtGS.TLVGn3.gG2IS/5g0nw7dgIVcRWNN/9.', '1992-09-22', '715ebfa66b593dce7f73760421cbeaae.jpg', NULL, NULL, 'sasasaeewuuyyyy5585858', '1', '1', '1', NULL, '2020-06-09 16:39:42', '2020-06-09 16:55:32'),
(5, 'hamza user', '0505330609', NULL, '$2y$10$IWxTmLhSEJ0RPj2ywskIx.EwkOyoJXOkS2qSO1CZZqujC5a7XAyNO', '2020-05-16', '87bae8279bfdb7454366e53b49132175.jpg', '49048', '2020-06-11 18:10:43', 'asasasasasasa', '1', '1', '1', '3', '2020-06-11 16:01:15', '2020-06-11 17:24:29');

-- --------------------------------------------------------

--
-- بنية الجدول `user_places`
--

CREATE TABLE `user_places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user_places`
--

INSERT INTO `user_places` (`id`, `user_id`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(3, 2, '37.421998333333335', '-122.08400000000002', '2020-02-05 13:19:44', '2020-02-05 13:19:44'),
(6, 1, '29.943696666666664', '31.27334', '2020-02-24 09:25:59', '2020-02-24 09:25:59'),
(9, 5, '35.12', '45.4222', '2020-06-11 16:58:32', '2020-06-11 16:58:32'),
(8, 1, '35.55', '45.4', '2020-06-09 12:58:45', '2020-06-09 12:58:45');

-- --------------------------------------------------------

--
-- بنية الجدول `user_rates`
--

CREATE TABLE `user_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user_rates`
--

INSERT INTO `user_rates` (`id`, `order_id`, `user_id`, `driver_id`, `rate`, `review`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 4, 'it was awesome', '2020-02-09 11:41:26', '2020-02-09 11:41:26'),
(2, 0, 4, 4, 4, 'it was perfct trip', '2020-06-09 16:52:21', '2020-06-09 16:52:21'),
(3, 0, 5, 4, 4, 'it was awesome trip with him', '2020-06-11 16:15:11', '2020-06-11 16:15:11'),
(4, 44, 5, 4, 4, 'it was awesome trip with him', '2020-06-18 12:55:29', '2020-06-18 12:55:29'),
(5, 43, 5, 4, 2, 'it was awesome trip with him', '2020-06-18 12:55:55', '2020-06-18 12:55:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attaches`
--
ALTER TABLE `attaches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_reasons`
--
ALTER TABLE `cancel_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars_models`
--
ALTER TABLE `cars_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars_types`
--
ALTER TABLE `cars_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliver_requests`
--
ALTER TABLE `deliver_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_rates`
--
ALTER TABLE `driver_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_rates_driver_id_foreign` (`driver_id`),
  ADD KEY `driver_rates_user_id_foreign` (`user_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_notifications`
--
ALTER TABLE `general_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `general_notifications_user_id_foreign` (`user_id`),
  ADD KEY `general_notifications_driver_id_foreign` (`driver_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `order_cancel_reason`
--
ALTER TABLE `order_cancel_reason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_cancel_reason_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_notifications`
--
ALTER TABLE `order_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_notifications_user_id_foreign` (`user_id`),
  ADD KEY `order_notifications_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_user_id_foreign` (`user_id`),
  ADD KEY `rooms_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `room_messages`
--
ALTER TABLE `room_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_messages_room_id_foreign` (`room_id`);

--
-- Indexes for table `salecodes`
--
ALTER TABLE `salecodes`
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
-- Indexes for table `user_places`
--
ALTER TABLE `user_places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_places_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_rates`
--
ALTER TABLE `user_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rates_user_id_foreign` (`user_id`),
  ADD KEY `user_rates_driver_id_foreign` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attaches`
--
ALTER TABLE `attaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cancel_reasons`
--
ALTER TABLE `cancel_reasons`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cars_models`
--
ALTER TABLE `cars_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cars_types`
--
ALTER TABLE `cars_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliver_requests`
--
ALTER TABLE `deliver_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver_rates`
--
ALTER TABLE `driver_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_notifications`
--
ALTER TABLE `general_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `order_cancel_reason`
--
ALTER TABLE `order_cancel_reason`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_notifications`
--
ALTER TABLE `order_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_messages`
--
ALTER TABLE `room_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `salecodes`
--
ALTER TABLE `salecodes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_places`
--
ALTER TABLE `user_places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_rates`
--
ALTER TABLE `user_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `general_notifications`
--
ALTER TABLE `general_notifications`
  ADD CONSTRAINT `general_notifications_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `general_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `order_notifications`
--
ALTER TABLE `order_notifications`
  ADD CONSTRAINT `order_notifications_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `room_messages`
--
ALTER TABLE `room_messages`
  ADD CONSTRAINT `room_messages_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
