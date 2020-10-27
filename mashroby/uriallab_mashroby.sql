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
-- Database: `uriallab_mashroby`
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
(1, 'admin', 'admin@admin.com', '$2y$10$L.t08xgpxHaaKmqGdHunqeeaDO/dqLYLnNYC/c84O3m0Yyq/U5.uO', NULL, '9kMPh6gLPznqJXww90v1ud1qU1kVM4JwWGXNHBhve4LKARkqgmp1nMdK4l4S', '2019-11-14 06:16:00', NULL),
(2, 'مصطفى السبيتي', 'mms.alsubiti@gmail.com', '$2y$10$aQE9FoEILoMLywfWzlAEue5eqqOaasjnUSaeoQW29I0rqaxCsyaDq', NULL, NULL, '2020-05-17 10:29:17', '2020-05-17 10:29:17');

-- --------------------------------------------------------

--
-- بنية الجدول `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `size_id` tinyint(3) UNSIGNED NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => normal ad , 2 => ad with offer',
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ads`
--

INSERT INTO `ads` (`id`, `category_id`, `size_id`, `title_ar`, `title_en`, `price`, `image`, `type`, `status`, `discount`, `stock`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 'اعلان فاضل', 'fadel add', 65, '99ffe1dfb07f81c8fc7cc7c49e5a6745.jpg', '2', '1', 3, 5, '2020-03-19 23:54:06', '2020-05-17 10:38:08'),
(4, 1, 2, 'التطبيق قيد الانشاء', 'mmm', 50, '82992e105d9cc4922f20b239b21aab85.jpg', '2', '1', 55, 64, '2020-03-19 23:56:00', '2020-05-18 08:02:48'),
(5, 1, 2, 'التطبيق قيد الانشاء', 'water', 200, '96eeca69bb8c3c1a995063250ea2d420.png', '2', '1', 70, 46, '2020-05-05 03:27:09', '2020-05-18 07:57:17'),
(6, 1, 1, 'منتج جديد', 'test    pro', 55, '7d79525a006bde2760afcd9bcd5237ab.png', '1', '1', NULL, 200, '2020-06-14 12:11:14', '2020-06-14 12:11:14');

-- --------------------------------------------------------

--
-- بنية الجدول `attaches`
--

CREATE TABLE `attaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` int(10) UNSIGNED NOT NULL,
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
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `title_en`, `title_ar`, `created_at`, `updated_at`) VALUES
(1, 'Soft drinks', 'مشروبات الغازية', '2019-11-14 20:08:27', '2020-05-18 07:52:00'),
(2, 'Energy Drinks', 'مشروبات الطاقة', '2020-03-19 23:51:42', '2020-05-18 07:52:46'),
(3, 'Water', 'المياه', '2020-03-20 00:02:10', '2020-05-18 08:01:49'),
(4, 'Dairy products', 'منتجات الالبان', '2020-05-05 12:00:00', '2020-05-18 07:56:07'),
(5, 'Juice drinks', 'مشروبات العصائر', '2020-05-17 11:25:00', '2020-05-18 07:53:56'),
(6, 'Vermicelli drinks', 'مشروبات الشعيرية', '2020-05-17 11:25:41', '2020-05-17 11:25:41');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_us`
--

INSERT INTO `contact_us` (`id`, `email`, `phone`, `name`, `title`, `message`, `created_at`, `updated_at`) VALUES
(3, 'samaa.milano@yy.com', '012555s555', 'samaa', 'testttt', 'testttt', '2020-05-05 00:44:12', '2020-05-05 00:44:12'),
(4, 'sa@ss.com', '012565885', 'samaa', 'testt', 'sasasww fefeeere', '2020-05-05 02:20:28', '2020-05-05 02:20:28'),
(5, 'sa@ss.com', '012565885', 'samaa', 'testt', 'sasasww fefeeere', '2020-05-05 02:28:42', '2020-05-05 02:28:42'),
(7, 'dg@dh.com', '5', 'gfh', 'gdo', 'fh', '2020-05-05 02:47:04', '2020-05-05 02:47:04'),
(9, 'msfadel@outlook.com', '01099026602', 'fadel', 'nanahg', 'jaolansvs s usjanshs', '2020-05-05 03:31:29', '2020-05-05 03:31:29');

-- --------------------------------------------------------

--
-- بنية الجدول `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(2, 'AmT6X3T40d', 1, '0', '2020-05-21 01:23:27', '2020-05-21 02:12:49');

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

--
-- إرجاع أو استيراد بيانات الجدول `faq`
--

INSERT INTO `faq` (`id`, `question_en`, `question_ar`, `answer_en`, `answer_ar`, `created_at`, `updated_at`) VALUES
(1, 'question_en', 'سؤال عربي', 'answer_en', 'اجابة عربي', NULL, NULL),
(2, 'question_en 2', '2 سؤال عربي', 'answer_en 2', 'اجابة عربي 2 ', NULL, NULL),
(3, 'question_en', 'سؤال عربي', 'answer_en', 'اجابة عربي', NULL, NULL),
(4, 'question_en 2', '2 سؤال عربي', 'answer_en 2', 'اجابة عربي 2 ', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ad_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `ad_id`, `order_id`, `created_at`, `updated_at`) VALUES
(6, 1, NULL, 4, '2019-12-10 18:24:38', '2019-12-10 18:24:38'),
(13, 10, NULL, 20, '2020-05-05 06:49:37', '2020-05-05 06:49:37'),
(29, 9, NULL, 25, '2020-05-06 03:42:02', '2020-05-06 03:42:02');

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
(2, '2019_10_28_153011_create_admins_table', 1),
(3, '2019_10_31_095306_create_categories_table', 1),
(5, '2019_10_31_110417_create_attaches_table', 1),
(6, '2019_10_31_110532_create_favorites_table', 1),
(7, '2019_10_31_110627_create_settings_table', 1),
(8, '2019_10_31_110802_create_contact_us_table', 1),
(9, '2019_11_11_144412_create_faq_table', 1),
(10, '2019_11_13_202240_create_sizes_table', 1),
(13, '2019_10_31_095643_create_ads_table', 2),
(14, '2014_10_12_000000_create_users_table', 3),
(16, '2019_11_13_210211_create_order_items_table', 5),
(17, '2019_11_13_210043_create_orders_table', 6),
(18, '2019_12_14_120106_create_notifications_table', 7);

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

--
-- إرجاع أو استيراد بيانات الجدول `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message_ar`, `message_en`, `created_at`, `updated_at`) VALUES
(1, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(2, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(3, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(4, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(5, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(6, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(7, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(8, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(9, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(10, 1, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(11, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(12, 1, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(13, 2, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL),
(14, 1, ' الرسالة بالعربي الرسالة بالعربي الرسالة بالعربي', 'english message english message english message english message ', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_cost` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `cash_req` int(10) DEFAULT NULL,
  `from_wallet` int(10) DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_code_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_creation_date` date NOT NULL COMMENT 'store order date and updated every repeat',
  `status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=>new,1=>confirmed,2=>canceled,3=>underway,4=>done',
  `payment_method` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=>cash,2=>visa,3=>master,4=>mda,5=>sdad',
  `delivery_time` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=>morning,2=>night,3=>any time',
  `repeat` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=>once,2=>every 2 week,3=>every month',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `code`, `order_cost`, `tax`, `total_cost`, `cash_req`, `from_wallet`, `lat`, `lng`, `address`, `promo_code`, `promo_code_value`, `order_creation_date`, `status`, `payment_method`, `delivery_time`, `repeat`, `created_at`, `updated_at`) VALUES
(19, 10, '7823690', 265, 13, 278, 278, 0, '29.94404379586567', '31.273117773234844', '', 'AmT6X3T40d', '1', '2020-05-05', '4', '1', '1', '1', '2020-05-05 03:29:04', '2020-05-06 03:58:24'),
(20, 10, '5857225', 1565, 78, 1643, 1643, 0, '29.94404379586567', '31.273117773234844', '', NULL, NULL, '2020-05-05', '3', '1', '1', '1', '2020-05-05 03:35:33', '2020-05-05 07:38:24'),
(21, 9, '3271477', 50, 2, 52, 52, 0, '29.94433431666471', '31.273056752979755', '', NULL, NULL, '2020-05-05', '1', '1', '1', '1', '2020-05-05 03:51:51', '2020-05-05 07:25:03'),
(22, 9, '1926873', 50, 2, 52, 52, 0, '29.94353131510746', '31.273074857890606', '', NULL, NULL, '2020-05-05', '2', '1', '1', '1', '2020-05-05 04:02:43', '2020-05-05 07:46:58'),
(23, 9, '7383149', 50, 2, 52, 52, 0, '29.943526957266545', '31.27307888120413', '', NULL, NULL, '2020-05-05', '3', '1', '1', '1', '2020-05-05 04:05:38', '2020-05-06 03:02:14'),
(24, 9, '8584176', 65, 3, 68, 68, 0, '29.94353247719833', '31.273071840405464', '', NULL, NULL, '2020-05-05', '2', '1', '1', '1', '2020-05-05 04:47:36', '2020-05-05 04:47:36'),
(25, 9, '3468740', 65, 3, 68, 68, 0, '29.9435321866756', '31.273081228137016', '', NULL, NULL, '2020-05-05', '2', '1', '1', '1', '2020-05-05 04:50:48', '2020-05-06 16:28:07'),
(26, 9, '3132006', 50, 2, 52, 52, 0, '30.042398401455547', '31.109150648117065', '', NULL, NULL, '2020-06-05', '4', '1', '1', '1', '2020-05-05 23:31:15', '2020-05-18 08:03:09'),
(27, 9, '5494626', 65, 3, 68, 65, 3, '30.04231568486984', '31.109142936766148', '', NULL, NULL, '2020-06-05', '1', '1', '1', '1', '2020-05-06 00:24:25', '2020-05-06 00:24:25'),
(28, 9, '9679922', 65, 3, 68, 68, 0, '30.042329616089102', '31.109146289527416', NULL, NULL, NULL, '2020-06-05', '0', '1', '1', '1', '2020-05-06 03:30:30', '2020-05-06 03:30:30');

-- --------------------------------------------------------

--
-- بنية الجدول `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(10) UNSIGNED NOT NULL,
  `item_id` bigint(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `count`, `price`, `created_at`, `updated_at`) VALUES
(34, 19, 5, 1, 200, '2020-05-05 03:29:04', '2020-05-05 03:29:04'),
(35, 19, 3, 1, 65, '2020-05-05 03:29:04', '2020-05-05 03:29:04'),
(36, 20, 5, 1, 200, '2020-05-05 03:35:33', '2020-05-05 03:35:33'),
(37, 20, 3, 1, 65, '2020-05-05 03:35:33', '2020-05-05 03:35:33'),
(38, 20, 3, 20, 65, '2020-05-05 03:35:33', '2020-05-05 03:35:33'),
(39, 21, 4, 1, 50, '2020-05-05 03:51:51', '2020-05-05 03:51:51'),
(40, 22, 4, 1, 50, '2020-05-05 04:02:43', '2020-05-05 04:02:43'),
(41, 23, 4, 1, 50, '2020-05-05 04:05:38', '2020-05-05 04:05:38'),
(42, 24, 3, 1, 65, '2020-05-05 04:47:36', '2020-05-05 04:47:36'),
(43, 25, 3, 1, 65, '2020-05-05 04:50:48', '2020-05-05 04:50:48'),
(44, 26, 4, 1, 50, '2020-05-05 23:31:15', '2020-05-05 23:31:15'),
(45, 27, 3, 1, 65, '2020-05-06 00:24:25', '2020-05-06 00:24:25'),
(46, 28, 3, 1, 65, '2020-05-06 03:30:30', '2020-05-06 03:30:30');

-- --------------------------------------------------------

--
-- بنية الجدول `order_logs`
--

CREATE TABLE `order_logs` (
  `id` int(10) NOT NULL,
  `order_id` bigint(10) UNSIGNED NOT NULL,
  `admin_id` tinyint(10) UNSIGNED NOT NULL,
  `admin_name` varchar(191) NOT NULL,
  `action` varchar(252) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `order_logs`
--

INSERT INTO `order_logs` (`id`, `order_id`, `admin_id`, `admin_name`, `action`, `created_at`, `updated_at`) VALUES
(1, 19, 1, 'admin', '4', '2020-05-06 03:58:24', '2020-05-06 03:58:24'),
(2, 25, 1, 'admin', '2', '2020-05-06 16:28:07', '2020-05-06 16:28:07'),
(3, 26, 1, 'admin', '1', '2020-05-18 08:02:48', '2020-05-18 08:02:48'),
(4, 26, 1, 'admin', '3', '2020-05-18 08:02:57', '2020-05-18 08:02:57'),
(5, 26, 1, 'admin', '4', '2020-05-18 08:03:09', '2020-05-18 08:03:09');

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` enum('en','ar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `setting`, `key`, `value`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'app_settings', 'tax', '5', 'en', '2019-12-13 06:16:00', NULL),
(2, 'app_settings', 'point_value', '0.2', 'en', '2019-12-13 06:16:00', '2020-05-01 03:07:46'),
(3, 'app_settings', 'item_point', '2', 'en', '2019-12-13 06:16:00', NULL),
(5, 'setting', 'about_us_en', '<p>about app</p>', 'en', '2020-05-01 02:39:13', '2020-05-03 01:04:01'),
(6, 'setting', 'about_us_ar', '<p>عن التطبيق&nbsp;</p>', 'ar', '2020-05-01 02:39:13', '2020-05-03 01:04:39'),
(7, 'setting', 'terms_and_conditions_ar', '<p dir=\"rtl\">الشروط و الاحكام بالعربية</p>', 'ar', '2020-05-01 02:39:13', '2020-05-01 03:00:23'),
(8, 'setting', 'terms_and_conditions_en', '<p>terms and conditions</p>', 'en', '2020-05-01 02:39:13', '2020-05-03 01:10:31');

-- --------------------------------------------------------

--
-- بنية الجدول `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `sizes`
--

INSERT INTO `sizes` (`id`, `title_en`, `title_ar`, `created_at`, `updated_at`) VALUES
(1, 'size 1 update', 'حجم 1 تعديل', '2019-11-15 05:53:25', '2019-11-15 05:54:17'),
(2, 'size 2', 'حجم 2', '2019-11-15 05:53:47', '2019-11-15 05:53:47');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `wallet` int(11) NOT NULL DEFAULT 0,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` enum('en','ar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `image`, `points`, `wallet`, `reset_password_code`, `code_expiration`, `fcm_token`, `language`, `status`, `is_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'Mohamed Adel', '$2y$10$Jke9KCZe1/86bcAvamzgxeA9Kyg1LQUrOaa6UcPIStbA6Rvlbu/96', '01013930990', 'de7b449531442df388dc7d9f827de680.jpg', 4, 0, NULL, NULL, NULL, 'en', '1', '1', NULL, '2020-05-04 22:20:24', '2020-05-06 03:30:30'),
(10, 'hsmo fadel', '$2y$10$1.7h8A8SOYrxy3fWMW2wluCdQ7Y1n1SR2bc2ZdH85XsX5knav5Acq', '01099026602', NULL, 10, 0, NULL, NULL, NULL, 'en', '1', '1', NULL, '2020-05-05 03:19:56', '2020-05-05 03:35:33'),
(11, 'ىنلهف', '$2y$10$E0V2J.MR4w8nOBejv2bInO8uWedRibZZiq9/xt0HVsvooupSAfaFe', '05025896375', NULL, 0, 0, NULL, NULL, NULL, 'en', '1', '35125', NULL, '2020-06-15 10:45:04', '2020-06-15 10:45:04'),
(12, 'ffff', '$2y$10$RKD29Obe4pa/GWRKRNhfyuxXoPGKU.F4hJqqoHUgkreOWGg/bfywi', '54555', NULL, 0, 0, NULL, NULL, NULL, 'en', '1', '32488', NULL, '2020-06-20 13:14:04', '2020-06-20 13:14:04');

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
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
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
  ADD KEY `FK_orders_users` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_items_orders` (`order_id`),
  ADD KEY `FK_order_items_ads` (`item_id`);

--
-- Indexes for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_logs_orders` (`order_id`),
  ADD KEY `FK_order_logs_admins` (`admin_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attaches`
--
ALTER TABLE `attaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_order_items_ads` FOREIGN KEY (`item_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `order_logs`
--
ALTER TABLE `order_logs`
  ADD CONSTRAINT `FK_order_logs_admins` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_logs_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
