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
-- Database: `uriallab_shopnstar`
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
(1, 'admin', 'a@a.com', '$2y$10$bF.X7zJBmp3v78t80UiYL.i7/B9n2gAmE1QpiNh5/5MqmnZF2eDgq', NULL, 'HqCn0uD89yvsDymvstDkXuYNczVduf3l7Xcx6niGLOIdxJ3WqfoCTqHEPm9J', NULL, '2020-05-20 23:46:25');

-- --------------------------------------------------------

--
-- بنية الجدول `ads`
--

CREATE TABLE `ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `ads`
--

INSERT INTO `ads` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, '1ef73792e1028f688c9b5b50fa2c840d.jpg', '1', '2020-05-20 23:08:10', '2020-05-20 23:12:27'),
(2, 'f831a528f0272e87d9cfadf4372a7793.jpg', '1', '2020-05-20 23:08:10', '2020-05-20 23:15:18');

-- --------------------------------------------------------

--
-- بنية الجدول `attaches`
--

CREATE TABLE `attaches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `attaches`
--

INSERT INTO `attaches` (`id`, `item_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'cf85327539a22fb9e93aa80f4e491533.jpg', '2020-05-11 08:29:58', '2020-05-11 14:22:54'),
(2, 3, 'c456256ce413eb69e042bbce4bd2b239.jpg', '2020-05-11 08:29:58', '2020-05-11 14:22:55'),
(5, 5, 'bef0861d577254a890c1ed9536fa98f9.jpg', '2020-06-12 17:09:30', '2020-06-12 17:09:30'),
(6, 5, 'a4f92b92953306a9b488fd8c211b9010.jpg', '2020-06-12 17:09:30', '2020-06-12 17:09:30'),
(7, 6, '215fcf7ec196617f5685f89fe191fed1.jpg', '2020-06-12 17:15:24', '2020-06-12 17:15:24'),
(14, 10, '8979996da2b1f880661aa1703ef466d3.jpg', '2020-06-15 10:47:29', '2020-06-15 10:47:29'),
(15, 10, '8f22f0f98cf7ffad28f1527587dc814e.jpg', '2020-06-15 10:47:29', '2020-06-15 10:47:29'),
(16, 10, 'c518ca05300cbe4d301ff0f035315ef3.jpg', '2020-06-15 10:47:29', '2020-06-15 10:47:29'),
(17, 11, 'f55b6ecab2e8c3c3b4b01c4733b4d976.jpg', '2020-06-15 11:13:22', '2020-06-15 11:13:22'),
(18, 12, '10a1f9e964d8d27cde649b47dba01a6f.jpg', '2020-06-15 11:17:55', '2020-06-15 11:17:55'),
(19, 13, 'b39b234fb0aab16fb07d6a334b61ebdd.jpg', '2020-06-16 19:16:52', '2020-06-16 19:16:52'),
(20, 14, '2657720b5e58845f06f997bf20a9b77c.jpg', '2020-06-30 12:19:15', '2020-06-30 12:19:15');

-- --------------------------------------------------------

--
-- بنية الجدول `basket`
--

CREATE TABLE `basket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `item_id` bigint(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `basket`
--

INSERT INTO `basket` (`id`, `user_id`, `item_id`, `created_at`, `updated_at`) VALUES
(6, 21, 4, '2020-06-16 11:11:53', '2020-06-16 11:11:53'),
(7, 23, 4, '2020-06-16 11:53:21', '2020-06-16 11:53:21'),
(8, 24, 4, '2020-06-16 11:56:24', '2020-06-16 11:56:24'),
(9, 1, 4, '2020-06-16 11:58:59', '2020-06-16 11:58:59'),
(11, 26, 4, '2020-06-16 19:14:33', '2020-06-16 19:14:33'),
(13, 26, 13, '2020-06-16 19:25:14', '2020-06-16 19:25:14'),
(14, 28, 13, '2020-06-17 09:55:56', '2020-06-17 09:55:56');

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` bigint(10) UNSIGNED NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `vendor_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2020-05-11 01:09:58', '2020-06-22 13:52:05'),
(3, 1, 6, '2020-05-11 01:09:58', '2020-06-22 13:52:15'),
(7, 1, 7, '2020-05-11 02:30:20', '2020-06-22 13:52:20'),
(13, 9, 7, '2020-06-12 15:26:56', '2020-06-22 13:52:55'),
(16, 12, 6, '2020-06-16 19:15:02', '2020-06-22 13:52:52'),
(17, 13, 4, '2020-06-17 10:13:49', '2020-06-22 13:52:46'),
(18, 1, 8, '2020-06-22 14:56:17', '2020-06-22 14:56:17'),
(19, 14, 4, '2020-06-29 08:06:36', '2020-06-29 08:06:36'),
(20, 14, 6, '2020-06-29 08:06:36', '2020-06-29 08:06:36'),
(21, 14, 7, '2020-06-29 08:07:09', '2020-06-29 08:07:09'),
(22, 12, 4, '2020-06-29 12:35:46', '2020-06-29 12:35:46'),
(23, 12, 7, '2020-06-29 12:35:46', '2020-06-29 12:35:46');

-- --------------------------------------------------------

--
-- بنية الجدول `cats`
--

CREATE TABLE `cats` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cats`
--

INSERT INTO `cats` (`id`, `title`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(4, 'حلويات', 'حلويات', '76e3a0a5cf66d790cbad3b5322fdbad4.jpg', '2020-06-22 13:50:25', '2020-06-22 11:03:11'),
(6, 'كيك', 'كيك', 'ececb8ae3c6d6d3da6fdd73d12eef8a6.jpg', '2020-06-22 13:50:25', '2020-06-22 11:03:34'),
(7, 'كيك مزين', 'كيك مزين', 'a92e79a1d1f29d30215b14ee2952e309.jpg', '2020-06-22 13:50:25', '2020-06-22 11:03:55'),
(8, 'قسم  جديد', 'قسم  جديد', 'faf1107b4a4749944e412567ef22c224.png', '2020-06-22 14:55:12', '2020-06-22 14:55:12');

-- --------------------------------------------------------

--
-- بنية الجدول `chat`
--

CREATE TABLE `chat` (
  `id` int(10) NOT NULL,
  `order_id` bigint(10) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `vendor_id` bigint(10) UNSIGNED NOT NULL,
  `statue` float NOT NULL DEFAULT 0 COMMENT '0->open ,1->closed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `chat`
--

INSERT INTO `chat` (`id`, `order_id`, `user_id`, `vendor_id`, `statue`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 1, 0, '2020-06-15 09:21:34', '2020-06-15 09:21:34'),
(2, 24, 1, 1, 0, '2020-06-15 10:21:14', '2020-06-15 10:21:14'),
(3, 26, 21, 2, 0, '2020-06-16 11:14:23', '2020-06-16 11:14:23'),
(4, 27, 23, 2, 0, '2020-06-16 11:53:48', '2020-06-16 11:53:48'),
(5, 28, 24, 2, 0, '2020-06-16 11:56:50', '2020-06-16 11:56:50');

-- --------------------------------------------------------

--
-- بنية الجدول `chat_mess`
--

CREATE TABLE `chat_mess` (
  `id` int(10) NOT NULL,
  `chat_id` int(10) NOT NULL,
  `sender_type` int(11) NOT NULL COMMENT '1-user,2-vendor',
  `seen` float NOT NULL DEFAULT 0 COMMENT '0-unseen,1-seen',
  `mesg` text NOT NULL,
  `type` float NOT NULL DEFAULT 1 COMMENT '1-text,2-file',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `chat_mess`
--

INSERT INTO `chat_mess` (`id`, `chat_id`, `sender_type`, `seen`, `mesg`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 'test mess twooo', 1, '2020-06-15 09:26:16', '2020-06-15 09:26:16'),
(2, 1, 2, 0, 'test mess خىثثثث', 1, '2020-06-15 09:27:32', '2020-06-15 09:27:32'),
(3, 1, 2, 0, 'test mess خىثثثث', 1, '2020-06-15 10:16:37', '2020-06-15 10:16:37'),
(4, 1, 2, 0, 'test mess خىثثثث', 1, '2020-06-15 10:16:45', '2020-06-15 10:16:45'),
(5, 1, 2, 0, 'ahmed', 1, '2020-06-15 16:33:19', '2020-06-15 16:33:19'),
(6, 1, 2, 0, 'ali', 1, '2020-06-15 16:35:13', '2020-06-15 16:35:13'),
(7, 1, 2, 0, 'hi ‎there ‎just ‎trying ‎now ‎', 1, '2020-06-16 11:25:46', '2020-06-16 11:25:46'),
(8, 1, 2, 0, 'user ‎Messege ‎for ‎testing ‎,', 1, '2020-06-16 11:59:00', '2020-06-16 11:59:00'),
(9, 1, 2, 0, 'user ‎anthor ‎testing ‎message', 1, '2020-06-16 11:59:52', '2020-06-16 11:59:52'),
(10, 1, 2, 0, 'test mess twooo', 1, '2020-06-16 12:02:14', '2020-06-16 12:02:14'),
(11, 1, 1, 0, 'hi', 1, '2020-06-16 12:11:40', '2020-06-16 12:11:40'),
(12, 5, 1, 0, 'hi', 1, '2020-06-16 12:34:15', '2020-06-16 12:34:15'),
(13, 1, 2, 0, 'test mess twooo', 1, '2020-06-16 12:35:24', '2020-06-16 12:35:24'),
(14, 5, 2, 0, 'test mess twooo', 1, '2020-06-16 12:35:58', '2020-06-16 12:35:58'),
(15, 5, 2, 0, 'memy to mahmood heloo from the other side', 1, '2020-06-16 12:38:10', '2020-06-16 12:38:10'),
(16, 5, 2, 0, 'to mahmood heloo from the other side', 1, '2020-06-16 12:48:38', '2020-06-16 12:48:38'),
(17, 5, 2, 0, 'to mahmood heloo from the other side', 1, '2020-06-16 12:49:24', '2020-06-16 12:49:24'),
(18, 5, 2, 0, 'to mahmood heloo from the other side', 1, '2020-06-16 12:59:56', '2020-06-16 12:59:56'),
(19, 5, 2, 0, 'to mahmood heloo from the other side', 1, '2020-06-16 13:05:43', '2020-06-16 13:05:43'),
(20, 5, 2, 0, 'to somone else heloo from the other side', 1, '2020-06-16 13:06:18', '2020-06-16 13:06:18'),
(21, 5, 2, 0, 'to somone else heloo from the other side', 1, '2020-06-16 13:12:14', '2020-06-16 13:12:14'),
(22, 5, 2, 0, 'this message is not like the previous messsage', 1, '2020-06-16 13:13:52', '2020-06-16 13:13:52'),
(23, 5, 2, 0, 'this message is not like the previous messsage', 1, '2020-06-16 13:13:57', '2020-06-16 13:13:57'),
(24, 5, 2, 0, 'اى كلام فاضى', 1, '2020-06-16 13:15:14', '2020-06-16 13:15:14'),
(25, 5, 2, 0, 'اى كلام مش فاضى', 1, '2020-06-16 13:26:21', '2020-06-16 13:26:21'),
(26, 5, 2, 0, 'اخر رسالة ان شاء الله', 1, '2020-06-16 13:27:49', '2020-06-16 13:27:49'),
(27, 5, 2, 0, 'اخر رسالة ان شاء الله 2', 1, '2020-06-16 13:29:36', '2020-06-16 13:29:36'),
(28, 5, 2, 0, 'hk ahx hggi hk ahx hggi hov shgi', 1, '2020-06-16 13:31:44', '2020-06-16 13:31:44'),
(29, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة', 1, '2020-06-16 13:32:27', '2020-06-16 13:32:27'),
(30, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص', 1, '2020-06-16 13:33:36', '2020-06-16 13:33:36'),
(31, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص 2', 1, '2020-06-16 13:34:42', '2020-06-16 13:34:42'),
(32, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص 2', 1, '2020-06-16 13:34:48', '2020-06-16 13:34:48'),
(33, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص والله', 1, '2020-06-16 13:35:54', '2020-06-16 13:35:54'),
(34, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص والله وهقوم اصلى العصر', 1, '2020-06-16 13:36:18', '2020-06-16 13:36:18'),
(35, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص والله وهقوم اصلى العصر والضهر', 1, '2020-06-16 13:37:10', '2020-06-16 13:37:10'),
(36, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص والله وهقوم اصلى العصر والضهر', 1, '2020-06-16 13:37:23', '2020-06-16 13:37:23'),
(37, 5, 2, 0, 'ان شاء الله ان شاء الله اخر رسالة خلاص والله وهقوم اصلى العصر والضهر والمغرب', 1, '2020-06-16 13:38:14', '2020-06-16 13:38:14'),
(38, 5, 2, 0, 'فاينال ماسيدج', 1, '2020-06-16 13:38:30', '2020-06-16 13:38:30'),
(39, 5, 2, 0, 'فاينال thdkhg  ماسيدج', 1, '2020-06-16 13:44:20', '2020-06-16 13:44:20'),
(40, 5, 2, 0, 'فاينال thdkhg  ماسيدج sdfgsdfg', 1, '2020-06-16 13:48:02', '2020-06-16 13:48:02'),
(41, 5, 2, 0, 'فاينال thdkhg  ماسيدج sdfgsdfg', 1, '2020-06-16 13:49:11', '2020-06-16 13:49:11'),
(42, 5, 2, 0, 'فاينال thdkhg  ماسيدج sdfgsdfg', 1, '2020-06-16 13:50:19', '2020-06-16 13:50:19'),
(43, 5, 2, 0, 'thdkhg', 1, '2020-06-16 13:50:30', '2020-06-16 13:50:30'),
(44, 5, 2, 0, 'اه ياااانى', 1, '2020-06-16 13:52:02', '2020-06-16 13:52:02'),
(45, 5, 2, 0, 'اه ياااانى', 1, '2020-06-16 13:52:31', '2020-06-16 13:52:31'),
(46, 5, 2, 0, 'عندى قمر بسهر معاه عندى محمود وحبيبى لغاه', 1, '2020-06-16 13:53:25', '2020-06-16 13:53:25'),
(47, 5, 2, 0, 'الحصان الطائر', 1, '2020-06-16 13:54:51', '2020-06-16 13:54:51'),
(48, 5, 2, 0, 'الحصان الطائر', 1, '2020-06-16 15:10:15', '2020-06-16 15:10:15'),
(49, 5, 2, 0, 'الحصان الطائر', 1, '2020-06-16 15:12:44', '2020-06-16 15:12:44'),
(50, 5, 2, 0, 'الحصان الطائر', 1, '2020-06-16 15:13:58', '2020-06-16 15:13:58'),
(51, 5, 2, 0, 'الحصان الطائر d\'dv', 1, '2020-06-16 15:14:13', '2020-06-16 15:14:13'),
(52, 5, 2, 0, 'الحصان الطائر يطير بجناحيه', 1, '2020-06-16 15:24:48', '2020-06-16 15:24:48'),
(53, 5, 2, 0, 'الحصان الطائر يطير بجناحيه 2', 1, '2020-06-16 15:27:08', '2020-06-16 15:27:08'),
(54, 5, 2, 0, 'الحصان الطائر يطير بجناحيه 3', 1, '2020-06-16 15:32:10', '2020-06-16 15:32:10'),
(55, 5, 2, 0, 'الحصان الطائر يطير بجناحيه 4', 1, '2020-06-16 15:33:10', '2020-06-16 15:33:10'),
(56, 5, 2, 0, 'الحصان الطائر يطير بجناحيه5', 1, '2020-06-16 15:34:22', '2020-06-16 15:34:22'),
(57, 5, 2, 0, 'الحصان الطائر يطير بجناحيه 6', 1, '2020-06-16 15:39:21', '2020-06-16 15:39:21'),
(58, 5, 2, 0, 'الحصان الطائر يطير بجناحيه 6', 1, '2020-06-16 15:44:53', '2020-06-16 15:44:53'),
(59, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 08:57:54', '2020-06-17 08:57:54'),
(60, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 08:58:09', '2020-06-17 08:58:09'),
(61, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:00:14', '2020-06-17 09:00:14'),
(62, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:00:33', '2020-06-17 09:00:33'),
(63, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:03:58', '2020-06-17 09:03:58'),
(64, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:06:54', '2020-06-17 09:06:54'),
(65, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:16:20', '2020-06-17 09:16:20'),
(66, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:23:42', '2020-06-17 09:23:42'),
(67, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:27:35', '2020-06-17 09:27:35'),
(68, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:28:27', '2020-06-17 09:28:27'),
(69, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:33:47', '2020-06-17 09:33:47'),
(70, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:56:10', '2020-06-17 09:56:10'),
(71, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:58:54', '2020-06-17 09:58:54'),
(72, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 09:59:00', '2020-06-17 09:59:00'),
(73, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 10:13:33', '2020-06-17 10:13:33'),
(74, 5, 2, 0, 'test', 1, '2020-06-17 10:19:24', '2020-06-17 10:19:24'),
(75, 5, 2, 0, 'test', 1, '2020-06-17 10:20:54', '2020-06-17 10:20:54'),
(76, 5, 2, 0, 'test', 1, '2020-06-17 10:28:05', '2020-06-17 10:28:05'),
(77, 5, 2, 0, 'test', 1, '2020-06-17 10:28:31', '2020-06-17 10:28:31'),
(78, 5, 2, 0, 'test', 1, '2020-06-17 10:28:38', '2020-06-17 10:28:38'),
(79, 5, 2, 0, 'test', 1, '2020-06-17 10:30:08', '2020-06-17 10:30:08'),
(80, 5, 2, 0, 'test', 1, '2020-06-17 10:31:16', '2020-06-17 10:31:16'),
(81, 5, 2, 0, 'test', 1, '2020-06-17 10:32:32', '2020-06-17 10:32:32'),
(82, 5, 2, 0, 'test', 1, '2020-06-17 10:33:03', '2020-06-17 10:33:03'),
(83, 5, 2, 0, 'test', 1, '2020-06-17 10:37:06', '2020-06-17 10:37:06'),
(84, 5, 2, 0, 'test', 1, '2020-06-17 10:37:43', '2020-06-17 10:37:43'),
(85, 5, 2, 0, 'test', 1, '2020-06-17 10:38:16', '2020-06-17 10:38:16'),
(86, 5, 2, 0, 'test', 1, '2020-06-17 10:41:44', '2020-06-17 10:41:44'),
(87, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 10:50:51', '2020-06-17 10:50:51'),
(88, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 10:54:25', '2020-06-17 10:54:25'),
(89, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 10:56:51', '2020-06-17 10:56:51'),
(90, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 10:59:20', '2020-06-17 10:59:20'),
(91, 5, 2, 0, 'test mess twooo', 1, '2020-06-17 11:00:16', '2020-06-17 11:00:16'),
(92, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:00:36', '2020-06-17 11:00:36'),
(93, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:01:38', '2020-06-17 11:01:38'),
(94, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:02:27', '2020-06-17 11:02:27'),
(95, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:03:41', '2020-06-17 11:03:41'),
(96, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:04:28', '2020-06-17 11:04:28'),
(97, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:05:54', '2020-06-17 11:05:54'),
(98, 5, 2, 0, 'test mahmood', 1, '2020-06-17 11:10:07', '2020-06-17 11:10:07');

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
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `item_id` bigint(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `item_id`, `created_at`, `updated_at`) VALUES
(12, 1, 4, '2020-06-11 14:11:28', '2020-06-11 14:11:28');

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `items`
--

INSERT INTO `items` (`id`, `category_id`, `vendor_id`, `title`, `price`, `description`, `discount`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 'اسم المنتج جديد', 200, 'وريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر', 0, '2020-05-11 08:32:51', '2020-05-13 14:27:48'),
(5, 13, 9, 'mahmood', 20000, 'mahmood', 0, '2020-06-12 17:09:30', '2020-06-12 17:09:30'),
(6, 13, 9, 'mahmood	‎', 2000, 'mahmood	‎', 20, '2020-06-12 17:15:24', '2020-06-12 17:15:24'),
(13, 16, 12, 'New ‎bags', 2000, 'New ‎bags', 0, '2020-06-16 19:16:52', '2020-06-16 19:16:52'),
(14, 17, 13, 'كاكاو', 345, 'كاكاو', 4, '2020-06-30 12:19:14', '2020-06-30 12:19:14');

-- --------------------------------------------------------

--
-- بنية الجدول `item_rates`
--

CREATE TABLE `item_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `rate` tinyint(3) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `order_id` bigint(10) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `order_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'test data notifcation ', '2020-06-10 14:58:48', '2020-06-10 14:58:48');

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(10) UNSIGNED NOT NULL,
  `vendor_id` bigint(11) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_cost` float DEFAULT NULL,
  `delivery_cost` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=>new,1=>confirmed,2=>underway,3=>rejected,4=>done',
  `reject_reason` int(11) DEFAULT NULL COMMENT '1=>res1,2=>res2,3=>res3,4=>res4',
  `payment_method` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 => online, 1=>cash on delivery',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `vendor_id`, `code`, `order_cost`, `delivery_cost`, `total_cost`, `lat`, `lng`, `status`, `reject_reason`, `payment_method`, `created_at`, `updated_at`) VALUES
(17, 1, 2, '8122325', 600, NULL, 600, '36.33', '12.33', '0', NULL, '1', '2020-05-13 12:31:58', '2020-05-21 01:28:12'),
(18, 1, 1, '8739584', 603.9, NULL, 604, '36.33', '12.33', '4', NULL, '1', '2020-06-10 06:49:02', '2020-06-14 14:20:51'),
(19, 1, 2, '5916132', 600, NULL, 600, '36.33', '12.33', '0', NULL, '1', '2020-06-10 06:49:02', '2020-06-10 06:49:02'),
(20, 1, 1, '3019610', 603.9, NULL, 604, '36.33', '12.33', '1', NULL, '1', '2020-06-10 21:21:05', '2020-06-15 08:30:39'),
(21, 1, 2, '6073726', 600, NULL, 600, '36.33', '12.33', '0', NULL, '1', '2020-06-10 21:21:05', '2020-06-10 21:21:05'),
(22, 1, 1, '4584382', 270, NULL, 270, '36.33', '12.33', '4', NULL, '1', '2020-06-10 21:51:19', '2020-06-14 14:30:59'),
(23, 1, 1, '4377743', NULL, NULL, NULL, '37.3860517', '-122.0838511', '3', 2, '1', '2020-06-12 12:29:56', '2020-06-17 13:42:34'),
(24, 1, 1, '3580895', 810, NULL, 810, '37.3860517', '-122.0838511', '3', 1, '1', '2020-06-12 12:30:46', '2020-06-16 16:39:36'),
(25, 1, 1, '6368450', 810, NULL, 810, '37.3860517', '-122.0838511', '1', NULL, '1', '2020-06-12 12:33:16', '2020-06-14 14:29:21'),
(26, 21, 2, '2153055', 400, NULL, 400, '37.3860517', '-122.0838511', '0', NULL, '1', '2020-06-16 11:12:41', '2020-06-16 11:12:41'),
(27, 23, 2, '9252137', 600, NULL, 600, '37.3860517', '-122.0838511', '0', NULL, '1', '2020-06-16 11:53:41', '2020-06-16 11:53:41'),
(28, 24, 2, '7195690', 200, NULL, 200, '37.3860517', '-122.0838511', '0', NULL, '1', '2020-06-16 11:56:43', '2020-06-16 11:56:43');

-- --------------------------------------------------------

--
-- بنية الجدول `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(10) UNSIGNED NOT NULL,
  `item_id` bigint(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `count`, `price`, `discount`, `created_at`, `updated_at`) VALUES
(2, 19, 4, 3, 200, 0, '2020-06-10 06:49:02', '2020-06-10 06:49:02'),
(4, 21, 4, 3, 200, 0, '2020-06-10 21:21:05', '2020-06-10 21:21:05'),
(8, 26, 4, 2, 200, 0, '2020-06-16 11:12:41', '2020-06-16 11:12:41'),
(9, 27, 4, 3, 200, 0, '2020-06-16 11:53:41', '2020-06-16 11:53:41'),
(10, 28, 4, 1, 200, 0, '2020-06-16 11:56:43', '2020-06-16 11:56:43');

-- --------------------------------------------------------

--
-- بنية الجدول `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `rate` tinyint(3) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `reasons`
--

CREATE TABLE `reasons` (
  `id` int(10) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `reasons`
--

INSERT INTO `reasons` (`id`, `reason`, `created_at`, `updated_at`) VALUES
(1, 'عنوان غير واضح', '2020-06-17 12:26:32', '2020-06-17 12:26:32'),
(2, 'لم يتم التاكيد من العميل ', '2020-06-17 12:26:32', '2020-06-17 12:26:32'),
(3, 'رقم هاتف غير موجود', '2020-06-17 12:26:32', '2020-06-17 12:26:32');

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
(1, 'settings', 'about_us', 'من نحن\r\nهنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلمات أو عبارات غير لائقة أو ما شابه. وهذا ماxs يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.', 'en', NULL, '2020-05-21 03:50:07'),
(2, 'settings', 'terms_and_conditions', 'الشروط و الاحكام\r\nهنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلماتx أو عبارات غير لائقة أو ما شابه. وهذا ما يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.', 'en', NULL, '2020-05-21 03:49:54'),
(3, 'contact', 'facebook', 'facebookpp', 'en', NULL, '2020-05-21 04:18:28'),
(4, 'contact', 'instagram', 'instagram', 'en', NULL, NULL),
(5, 'contact', 'whatsapp', 'whatsapp', 'en', NULL, NULL),
(6, 'contact', 'twitter', 'twitter', 'en', NULL, NULL),
(7, 'contact', 'phone', '3115115', 'en', NULL, NULL),
(8, 'contact', 'email', 'email@email.com', 'en', NULL, NULL);

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
(1, 'سما ء', '$2y$10$iAwkAii8IE92ChxKqcs.CuHZhQBXpx1hlGz.PGDyXuvRtcZlGnGMm', '966569532955', 'samaa@user.com', '1', '1', '3ad33bb80ba2da35053d802a30030aca.jpg', '54132', '2020-06-10 17:58:20', 'cVD1MZkeN1Q:APA91bEnhBOXzDvkaYwVHI637T1LCjTH9nj6vy7IqwhkTKI42yfXKuNYkqpGrB_-dtvH2HK4FfiM3-0YKt5pcQTvX_lvV8hO4V-ZTy4q_VNOWpqrWzl5os7LaF2StEK-Fbj2qOPKTe-k', '2020-05-10 11:09:37', '2020-06-16 16:46:32'),
(7, 'mahmoodesmail', '$2y$10$1Raj7sCmuUIMeDr93f4PGeh7kL4nWsRR4ATLCMm1Cl4ml5XROtVYq', '0505330607', 'mahmoodesmail97@gmail.com', '1', '74325', NULL, NULL, NULL, NULL, '2020-06-04 10:43:07', '2020-06-04 10:43:07'),
(8, 'mahmoodesmail', '$2y$10$wFhOBwfsAaLshOkNA0Fhsee1XFeJ8H42ET68Pxn4a1npNsPTSsroC', '0505330604', 'mahmoodesmail97@gssmail.com', '1', '46244', NULL, NULL, NULL, NULL, '2020-06-04 10:46:04', '2020-06-04 10:46:04'),
(9, 'mahmoodesmail', '$2y$10$35.YVXOHID0KNCDStmSoqOde75bCdWKu07t35OfBkD1FKZNdSzr5e', '0505330601', 'mahmoodesmail97@g8smail.com', '1', '76699', NULL, NULL, NULL, NULL, '2020-06-04 10:50:43', '2020-06-04 10:50:43'),
(10, 'mahmoodesmail', '$2y$10$u2DX.0WhUXzTf5a9o/NnKO1fNJzAxZfB.inVn58x.5hS8IyC5iwkK', '0505330600', 'mahmoodesmail97@g8fsmail.com', '1', '10876', NULL, NULL, NULL, NULL, '2020-06-04 11:04:49', '2020-06-04 11:04:49'),
(11, 'memy as user', '$2y$10$B3YqUK2oDlkYDXgtwI99x.boS9J9E5.GDdcOqUp8wTRrt3NeEBoWG', '966569523977', 'usermemy@memy.com', '1', '1', NULL, NULL, NULL, NULL, '2020-06-07 15:13:02', '2020-06-07 15:13:21'),
(12, 'memy as user', '$2y$10$RvAceayC.lANSUEeEXIU7uSMe7ija8KG.FG2crU.Un2HDgqiVT.p.', '966569523477', 'usermemy@memy2.com', '1', '1', NULL, NULL, NULL, NULL, '2020-06-07 15:14:12', '2020-06-07 15:14:24'),
(13, 'memy as user', '$2y$10$p04lEkkMAjFOMHtF611pmuGTxriqmff/Ec0jJQFjs.0dZOp9CCR0C', '966569523470', 'usermemy@memy32.com', '1', '1', NULL, NULL, NULL, NULL, '2020-06-07 15:15:55', '2020-06-07 15:16:05'),
(14, 'samaa', '$2y$10$GCB/cArrjj0xE198Zo8K1ODXI.R7Q7pCIIAzrZtQJnQOf7XAj99Oq', '966569532951', 'samaa@user2.com', '1', '1', NULL, NULL, NULL, NULL, '2020-06-07 15:28:08', '2020-06-07 15:29:36'),
(15, 'memy', '$2y$10$LSMgIyVAKGuAE5FGnebWiuhM4GCq.OHEAh245sAUUjyX5LVKWwNVK', '966569532322', 'memy2224@memyco.com', '1', '1', NULL, NULL, NULL, NULL, '2020-06-09 04:38:14', '2020-06-10 12:45:00'),
(16, 'Rashed', '$2y$10$S.pt/9B7A8rIi40OjKIbFOeA7EmOiexLdCe/TZcyJo1zuoYjHcuL6', '0501234567', 'Muhammad.S.Rashed@gmail.com', '1', '71905', NULL, NULL, NULL, NULL, '2020-06-14 11:56:02', '2020-06-14 11:56:02'),
(17, 'user1', '$2y$10$U7hEWzGcnNclRIifRQNAF.y8xDQZo6b0Ska9sjxrtLlFxpH2TX0BG', '0501212123', 'user@domain.com', '1', '44673', NULL, NULL, NULL, NULL, '2020-06-14 13:41:08', '2020-06-14 13:41:08'),
(18, 'Mohamed ‎fadel', '$2y$10$QDN3x5bQMoThIicWRb9qv.FFbnYstB9ACW0B1zAm2z720RRnHHyAq', '0501234560', 'msfadel@outlook.com', '1', '75261', NULL, NULL, NULL, NULL, '2020-06-15 09:06:41', '2020-06-15 09:06:41'),
(19, 'Rashed', '$2y$10$WWl4iX5N7bXgJAkDJqP5mOq79cpF6vQp6y7g0AG2Nk2vMvyBnKyLq', '0501313123', 'user3@domain.com', '1', '63020', NULL, NULL, NULL, NULL, '2020-06-15 13:24:24', '2020-06-15 13:24:24'),
(20, 'mahmood	‎', '$2y$10$OUmk80jjju7TAr3gHJnQPuAwVnrhEzuaPWK4goHPuvdmVq0VRl2zO', '0505333609', 'mahmoodes@gmail.com', '1', '74630', NULL, NULL, NULL, 'dD0rjKd0Myc:APA91bFN8mFgEaMuC9w1AtMQbUEqgCDWYUPEs5c-RFWxLM0evnkco0XCEtO1rpQkOAlmDr8fBp94C6pGxnjGaCDYzqRvCX6UnYntFoPtiBw_naClGKV8hIDl6cSHrP5tz0AYSYLS5ni5', '2020-06-16 11:04:33', '2020-06-16 11:04:33'),
(21, 'mahmood', '$2y$10$xaQCfVPdZZjbp/G8Ct9Ht.h27gDtSECmiNrGMq93IDk4dl5VO0FIy', '0505331609', 'm@mm.com', '1', '1', NULL, NULL, NULL, 'dD0rjKd0Myc:APA91bFN8mFgEaMuC9w1AtMQbUEqgCDWYUPEs5c-RFWxLM0evnkco0XCEtO1rpQkOAlmDr8fBp94C6pGxnjGaCDYzqRvCX6UnYntFoPtiBw_naClGKV8hIDl6cSHrP5tz0AYSYLS5ni5', '2020-06-16 11:11:07', '2020-06-16 11:11:37'),
(22, 'samaa', '$2y$10$9zJvAzjsp1pjeVcLlWwLx.xWqsdfFCwT0D8rkDIZWkBCv20xMIed6', '966568532955', 'samaa@auser.com', '1', '1', NULL, NULL, NULL, NULL, '2020-06-16 11:43:56', '2020-06-16 11:44:23'),
(23, 'mahmood', '$2y$10$y3hQhbLFUlp6tQXrvKTE4e9NkkkEaIVSezZchVLA1Qot2SWV/Vazq', '0505333638', 'mahmoodesmail@mm.com', '1', '1', NULL, NULL, NULL, 'dD0rjKd0Myc:APA91bFN8mFgEaMuC9w1AtMQbUEqgCDWYUPEs5c-RFWxLM0evnkco0XCEtO1rpQkOAlmDr8fBp94C6pGxnjGaCDYzqRvCX6UnYntFoPtiBw_naClGKV8hIDl6cSHrP5tz0AYSYLS5ni5', '2020-06-16 11:53:02', '2020-06-16 11:53:11'),
(24, 'mahmoodee', '$2y$10$CT7sGo5v4tP8OO.VKG4sDOkoRza0vlToDyw8fPZdziwndjmx9yh8S', '0505333637', 'ee@e.com', '1', '1', NULL, NULL, NULL, 'f1iYTIx6QV6-_OARnZLM_0:APA91bH1ibUSgPQs_w0dx2gAAIbgzkUaxyLbx1jTVQAbrP04LO3Y_Vc_SFwsq1ggGPyudfFQZPO5teTCvDrEIAyO2jgkxUN_KLFOrUluzPg7xb9_lMKrJ8PHr7rCs-K9F6oEeAWy9ge7', '2020-06-16 11:55:49', '2020-06-29 14:01:57'),
(25, 'Rashed‎', '$2y$10$WJ8SsNuIzStJZ807z3Rm3uJMhE85fYJXyDqKXzzYHSpMv0hpKV.ai', '0501234561', 'user1@domain.com', '1', '1', NULL, NULL, NULL, 'dknBCUuw9cY:APA91bHyVE7TBCaueKOw-Usw4gR97DctVkaQ6IcfdZA-VbMYhChPW0EssGlH77Yb_IwCugSg13Wzp0eEWMqcd3n4uq4BrOjoa1NFnqt5xby8HQcTxp2UJBY3c3XVqqiqunOY0Qml1SdW', '2020-06-16 18:11:05', '2020-06-16 18:11:27'),
(26, 'manah', '$2y$10$WTeCMsEpvB3B80L72gy1buE9K6TPDTGxPYgJTtIvcSD.PSwAIBfje', '0501234569', 'kajah@jsj.com', '1', '1', NULL, NULL, NULL, 'cDChh-mN5O0:APA91bGk8erkmSYeZD4jpebLsCoqKdli4zH7ZK1LwrkF_XV1rmS6SH9WkCWIPzX1QItpDcnHsMinY4ijA-PAFipoOKnlnVbn552MRtQv7NQ71q0osxEmenBxVFxBsQvwjQ0QYpKpr-8O', '2020-06-16 19:12:33', '2020-06-16 19:12:44'),
(27, 'mneer', '$2y$10$UC2HcIiaiTz4mlkuzd5wK.PGr77Oha0jhzxWFMd6jZTssUeV55ST.', '0500300981', 'mneer14003@gmail.com', '1', '99634', NULL, NULL, NULL, 'eRMwfb7PY4A:APA91bH4rS6dd-kP6Wrp7ngfTeHKbILRW1m_qvB_8WQII68WmGpdJL35O_RlCUeey8MvhpIeh3APqie0W3U8cugyy10aTcSMKmal0oCuq-EQ1VArzJ7aoW2ri_Mal7-PrRwoW-ZKsMqR', '2020-06-17 03:34:25', '2020-06-17 03:35:28'),
(28, 'layla', '$2y$10$O6CQvNYbWQEBpg0sHZf0F.ss8sHEkclYvGxXBIqBOamE/e5aJ.pMy', '0556167527', 'lolosalem385@gmail.com', '1', '1', NULL, NULL, NULL, 'egFjjuz0Sj-yXK6ifh8kZF:APA91bHpawIF4thbGpCzUsdCyHqhUCblu9gxWyewHq9m1rN7sLnZOvVimczaaNgxTW_9tlOG1-SRiMZCGgpuELVhD9ncrHuikPb-4yP5J6wLyg3M6XprMryvq9YIpqd0q89EKsfQGtWI', '2020-06-17 09:52:25', '2020-06-30 12:22:44'),
(29, 'Mahmood ‎test', '$2y$10$giVmUBfVGFcI0Z2FeB9tluAuDKNKIgNsCll8X2gkzHp276LWDO.NS', '0505332155', 'mmm@mmm.com', '1', '1', NULL, NULL, NULL, 'fIf2aSzWSVqU-fE5ChZBMq:APA91bHyFctIAzMhdcgn7AaL3Rj5l2xCGdA_RCBy_PcxtbO5lgvHbAByXZFRgrXbmCdIRGA9eKeMVigCUccZY39Gqe7G2IG3Lm4cZkROgMnZTX0b_5hatPm24wPNea-c9_pdy8xeUAVD', '2020-06-22 10:48:14', '2020-06-22 10:48:40'),
(30, 'ahsjid ‎jsiaoa', '$2y$10$c4NXj.t3A7I61KARTJ23wOTEncaBqE0u0F1KbKTizjuM9REpeQoKK', '0512203639', 'babel3126341@gmail.com', '1', '52203', NULL, NULL, NULL, 'c00gkgS6RGGdWAYEAQbd1n:APA91bHmEfO7bhji5sNxo6EJhXcXu8Zg2JxzCgakMVFdpbWvuKSEDE2EohKmxFCf7DdvmtAlO5A-fZUw5QBe1lgyMMtcG084qb0Tq1F9BmuQ_Pn3z768mpXMhwesL70GXQGBDRwaOOK_', '2020-06-23 07:23:41', '2020-06-23 07:23:41');

-- --------------------------------------------------------

--
-- بنية الجدول `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double UNSIGNED NOT NULL DEFAULT 0,
  `delivery_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_cost` double DEFAULT NULL,
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

INSERT INTO `vendors` (`id`, `name`, `description`, `category_id`, `password`, `phone`, `email`, `lat`, `lng`, `rate`, `delivery_time`, `delivery_cost`, `status`, `verified`, `image`, `reset_password_code`, `code_expiration`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'rrrsamaavendor', 'test description for vendors', NULL, '$2y$10$cf3uvJP8sepF9ICVIfUjyu.QJ8KaOoDRHM.2AntLwKBiHmLQmef.S', '0505330155', 'samaa@vendor.com', '35.445', '45.145', 0, NULL, NULL, '1', '1', '798a5a976b7a4bb6f89e5953b5f0f9e7.jpg', '43874', '2020-06-10 17:58:26', 'cVD1MZkeN1Q:APA91bEnhBOXzDvkaYwVHI637T1LCjTH9nj6vy7IqwhkTKI42yfXKuNYkqpGrB_-dtvH2HK4FfiM3-0YKt5pcQTvX_lvV8hO4V-ZTy4q_VNOWpqrWzl5os7LaF2StEK-Fbj2qOPKTe-k', '2020-05-10 22:04:04', '2020-06-16 15:22:23'),
(2, 'vendor', ' description for vendor', NULL, '$2y$10$Qs88SkSUJoQgen7a4yReee6abVbJfIp8hjr5jhi4ykopX4wSWjm22', '0505330166', 'vendor@vendor.com', '35.445', '45.145', 0, NULL, NULL, '1', '1', '798a5a976b7a4bb6f89e5953b5f0f9e7.jpg', '46577', '2020-05-11 00:24:35', NULL, '2020-05-10 22:04:04', '2020-05-20 23:39:05'),
(4, 'samaaV', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a', NULL, '$2y$10$3A6XCme6yYSzzIicUIQUEug2fqP5QPe0O0M9tUuWcK5qtmCBK881K', '0505330555', 'samaa@ve8ndor.com', '35.445', '45.145', 0, NULL, NULL, '1', '37054', 'ae815b1bee8cd8faa8606dc7a3bb13a8.PNG', NULL, NULL, NULL, '2020-06-04 10:17:39', '2020-06-04 10:17:39'),
(5, 'memy collection', 'the best memy ever', NULL, '$2y$10$DVuOIWhHFqlVPgs8dkrpiOcXlq6jrFv7veufagrcG1v/zOI9fEJ7e', '966569832955', 'memy@memy.com', '37.3860517', '-122.0838511', 0, NULL, NULL, '1', '36935', '3dda774e2537579d6f9969127b53cece.jpg', NULL, NULL, NULL, '2020-06-07 14:52:37', '2020-06-07 14:52:37'),
(6, 'memy collection 2', 'ever ever', NULL, '$2y$10$TNqcDzF6C9Mi982nxPh44OVyxThI9U37yzx4NPMFa07umTtrIUUWe', '966569832944', 'memy@memy2.com', '37.3860517', '-122.0838511', 0, NULL, NULL, '1', '34427', '8b5e3d26a96c6f252d837d8db9c55e05.jpg', NULL, NULL, NULL, '2020-06-07 14:57:32', '2020-06-07 14:57:32'),
(7, 'memy collection 22', 'ever ever', NULL, '$2y$10$7gdbeYDk2gYLspHxE5Nq4OkKxOul4FD/aw7XeHbavo80vxRtne1u2', '966569832940', 'memy@memy22.com', '37.3860517', '-122.0838511', 0, NULL, NULL, '1', '54226', '451acda166f4398f0fa024c346f6d406.jpg', NULL, NULL, NULL, '2020-06-07 15:04:31', '2020-06-07 15:04:31'),
(8, 'samaaV', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a', NULL, '$2y$10$TiHXLy5RmnqQKaE6RbqZ3.B3LpY2gMtbKYPLHGFO/hYV/u3N1iCtu', '0505380155', 'samaa@vendor.com', '35.445', '45.145', 0, NULL, NULL, '1', '15720', 'c7ad38fac3b526e0de5d675acad9f187.PNG', NULL, NULL, NULL, '2020-06-08 21:30:06', '2020-06-08 21:30:06'),
(9, 'mahmood ‎Store', 'store ‎To ‎Sell ‎Dummy ‎Things ‎', NULL, '$2y$10$gEb3fJNhAcbRdNFsVtagnekZ5reOycRpQ9I9ez/AHYRm/XwCtOsY2', '0505480155', 'mahmo@mo.com', '37.3860517', '-122.0838511', 0, NULL, NULL, '1', '1', 'da7deec08486bba04f29038aa8e90f5f.jpg', NULL, NULL, NULL, '2020-06-08 21:39:10', '2020-06-08 21:39:30'),
(10, 'ShipTrack', 'Retail', NULL, '$2y$10$D3KoyAVK9HeltHiPxa8OxeluT0L59XvldLVM2bMKgvu4LbGvS8gWK', '0501231234', 'Retail@stores.com', '21.3890824', '39.85791180000001', 0, NULL, NULL, '1', '47895', 'de39186c4dec9b60cb5f8998bc4545d8.jpg', NULL, NULL, NULL, '2020-06-15 09:22:13', '2020-06-15 09:22:13'),
(11, 'ahmood', 'mmmmajkjslfkjdsjfasjdgjfsdg', NULL, '$2y$10$Beh4INv7kgl0wB0iVpW9luCAc1X10Jovs6fb46h2mlk07Xryis80q', '0505333639', 'mmmm@mm.com', '37.3860517', '-122.0838511', 0, NULL, NULL, '1', '1', '0c452daba293a97ea0f620e9850b821f.jpg', NULL, NULL, 'dD0rjKd0Myc:APA91bFN8mFgEaMuC9w1AtMQbUEqgCDWYUPEs5c-RFWxLM0evnkco0XCEtO1rpQkOAlmDr8fBp94C6pGxnjGaCDYzqRvCX6UnYntFoPtiBw_naClGKV8hIDl6cSHrP5tz0AYSYLS5ni5', '2020-06-16 11:52:08', '2020-06-16 11:52:18'),
(12, 'gawran', 'retail', NULL, '$2y$10$EEtZ6/r6RBslaudVt/WzaukUgh5K1rXL0EcT5NpTHksTDsFKIYC.K', '0501231231', 'user5@domain.com', '21.3890824', '39.85791180000001', 0, NULL, NULL, '1', '1', '2719a7915bfad2c8bcdbc3bf88fff352.jpg', NULL, NULL, 'eH1prOHNTgSyqwjmv-k9uQ:APA91bHkHAfyKng64XtYaBM6lvH_xYjmVmRUdgnfQLXArmrVe1M0-iVX0hSI8XQsa3c48HDZAkPEtDMILw0lcETOmj9XX9ApPPJwjDgb4EyZjBep_Cz_8mRNYSCN7KlfaUBIO0r82h04', '2020-06-16 19:09:22', '2020-06-29 15:53:46'),
(13, 'سايلنس', 'كماليات', NULL, '$2y$10$zAm5sMWUIvULX5XZ8Ic9qezM1k3CINHyfkUDOOeXrYQT3YI1ZhT2q', '0502999819', 'lolosalem385@gmail.com', '17.5813848', '44.4401737', 0, NULL, NULL, '1', '1', '9df2230779cdbc74696dc1738430b29e.jpg', NULL, NULL, 'egFjjuz0Sj-yXK6ifh8kZF:APA91bHpawIF4thbGpCzUsdCyHqhUCblu9gxWyewHq9m1rN7sLnZOvVimczaaNgxTW_9tlOG1-SRiMZCGgpuELVhD9ncrHuikPb-4yP5J6wLyg3M6XprMryvq9YIpqd0q89EKsfQGtWI', '2020-06-17 09:46:50', '2020-06-30 12:10:53'),
(14, 'test', 'test ‎test', NULL, '$2y$10$liqDGepF7Zwp8o5XSKDmzOs6Bw5RsUW4yi4x0NNl3oAfxbp8Xr0Qa', '0505334155', 'mm@mm.bbom', '37.3860517', '-122.0838511', 0, NULL, NULL, '1', '1', '604103d3e88e370bab2184c73c3aa239.jpg', NULL, NULL, 'f1iYTIx6QV6-_OARnZLM_0:APA91bH1ibUSgPQs_w0dx2gAAIbgzkUaxyLbx1jTVQAbrP04LO3Y_Vc_SFwsq1ggGPyudfFQZPO5teTCvDrEIAyO2jgkxUN_KLFOrUluzPg7xb9_lMKrJ8PHr7rCs-K9F6oEeAWy9ge7', '2020-06-22 09:14:12', '2020-06-29 14:02:43');

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
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_basket_users` (`user_id`),
  ADD KEY `FK_basket_items` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categories_vendors` (`vendor_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1user` (`user_id`),
  ADD KEY `FK2vendors` (`vendor_id`),
  ADD KEY `FK_chat_orders` (`order_id`);

--
-- Indexes for table `chat_mess`
--
ALTER TABLE `chat_mess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_chat_mess_chat` (`chat_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_favorites_users` (`user_id`),
  ADD KEY `FK_favorites_items` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_vendor_id_foreign` (`vendor_id`),
  ADD KEY `FK_items_categories` (`category_id`);

--
-- Indexes for table `item_rates`
--
ALTER TABLE `item_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_item_rates_users` (`user_id`),
  ADD KEY `FK_item_rates_items` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_notifications_users` (`user_id`),
  ADD KEY `FK_notifications_orders` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_users` (`user_id`),
  ADD KEY `FK_orders_vendors` (`vendor_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_items_orders` (`order_id`),
  ADD KEY `FK_order_items_items` (`item_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_rates_users` (`user_id`),
  ADD KEY `FK_rates_vendors` (`vendor_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
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
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attaches`
--
ALTER TABLE `attaches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat_mess`
--
ALTER TABLE `chat_mess`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_rates`
--
ALTER TABLE `item_rates`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `FK_basket_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_basket_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_categories_vendors` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_chat_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_chat_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_chat_vendors` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `chat_mess`
--
ALTER TABLE `chat_mess`
  ADD CONSTRAINT `FK_chat_mess_chat` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `FK_favorites_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_favorites_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_items_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `item_rates`
--
ALTER TABLE `item_rates`
  ADD CONSTRAINT `FK_item_rates_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_item_rates_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `FK_notifications_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_notifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_orders_vendors` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_order_items_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `FK_rates_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rates_vendors` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
