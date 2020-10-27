-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 02 يوليو 2020 الساعة 11:39
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
-- Database: `uriallab_wasly`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
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

INSERT INTO `admins` (`id`, `role`, `username`, `email`, `password`, `reset_password_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'admin', 'admin@admin.com', '$2y$10$aZvVFLvPmEvUQtZNTPVjJ.oTp.m2A5Ka3jdT9uaI012C2UpCj8IM6', NULL, '7f2RyeGtdpRzIy3teeTv4vEmUrbt2z8V5NTKbB8eYlygXMO4AEk8eo2ZZrpB', '2020-03-08 13:03:26', '2020-03-08 13:03:26'),
(2, '2', 'moahmed', 'msfadel@outlook.com', '$2y$10$A4K2dDrqWrmBlCy12Y0BMOUObBvKNmJIeCC4gEg5f.vjQbtEFhNEe', NULL, NULL, '2020-03-19 22:34:20', '2020-03-19 22:34:20'),
(4, '2', 'admin1@admin.com', 'admin1@admin.com', '$2y$10$iPvgWPH/N9TjC4EHVhFFXOvuS7naMhUsJb5xbMdlpz4KoZ8y95Nt6', NULL, NULL, '2020-04-27 19:46:47', '2020-04-27 19:46:47'),
(5, '2', 'samaa samo', 'samaa@samo.com', '$2y$10$ssUv.cy5letjluwi5UQ3huTbr8hK7NheXEtjyZKiHWM.KIbuaDzOS', NULL, NULL, '2020-04-28 16:19:10', '2020-04-28 16:19:10');

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
(2, '18ba9bfc978dcf7e0fdbbf8da94cce86.jpg', '1', '2020-05-02 19:47:33', '2020-05-02 19:47:33'),
(3, '27befbdced3858e66747bed0a0e2e4f8.jpg', '1', '2020-05-02 19:48:07', '2020-05-02 19:48:07'),
(4, '686671a7ba236cedfa1f3bdf616115bb.jpg', '1', '2020-05-02 19:49:32', '2020-05-02 19:49:32'),
(5, '9bf0190d93b864623de64047205e20bd.jpg', '1', '2020-05-02 19:50:09', '2020-05-02 19:50:09'),
(6, '0d06e776e70d59af2049c4df75d006c2.jpg', '1', '2020-05-02 19:53:15', '2020-05-02 19:53:15');

-- --------------------------------------------------------

--
-- بنية الجدول `attaches`
--

CREATE TABLE `attaches` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `attaches`
--

INSERT INTO `attaches` (`id`, `item_id`, `image`, `created_at`, `updated_at`) VALUES
(11, 9, 'f992e80e53d9710ceea1e85a2b2c12ab.jpg', '2020-05-02 19:23:53', '2020-05-02 19:23:53'),
(12, 10, '2f18f9e194dd8deb4d3849d4a745c298.jpg', '2020-05-02 19:30:45', '2020-05-02 19:30:45'),
(13, 11, 'cf7147411200f8e4a34cee88c61445ec.jpg', '2020-05-02 19:38:29', '2020-05-02 19:38:29'),
(14, 12, '7f7e5a163d725811b1d5e6e1e47ad51a.jpg', '2020-05-02 19:39:22', '2020-05-02 19:39:22'),
(15, 13, '8e0fbd7defc0bcedf1389398a9ac9d18.jpg', '2020-05-02 19:45:46', '2020-05-02 19:45:46'),
(16, 14, '23e1995003c3c25e818c21b3fa16c814.jpg', '2020-05-02 19:46:40', '2020-05-02 19:46:40'),
(17, 15, '8b98d9cfe150ea01e2c3a2a8fdaf8c02.jpg', '2020-05-02 20:27:23', '2020-05-02 20:27:23'),
(18, 16, 'fa9401a72929666a67ace5d0d3af7e63.jpg', '2020-05-02 20:27:25', '2020-05-02 20:27:25'),
(19, 17, '21e059c34f1fa0572c4551a298bb63b6.jpg', '2020-05-02 20:58:44', '2020-05-02 20:58:44'),
(20, 18, 'bacfd4a8a0a3afd3e36be18ae413ec36.jpg', '2020-05-02 20:59:33', '2020-05-02 20:59:33'),
(21, 19, '31882207fcd595f753b1bfbbd4ef3e2d.jpg', '2020-05-02 21:00:29', '2020-05-02 21:00:29'),
(22, 20, '6fe46ed0042aa1cfbdd2305fe41683af.jpg', '2020-05-02 21:01:20', '2020-05-02 21:01:20'),
(23, 21, '5e453dfa9caad62d3a83b6bb0b1dd58b.jpg', '2020-05-02 21:03:42', '2020-05-02 21:03:42'),
(24, 22, '326f0096620d3c6b3fab4e4c26f3ee2d.jpg', '2020-05-02 21:19:33', '2020-05-02 21:19:33'),
(25, 23, 'ad481cee972ed6b6e688799881978ee9.jpg', '2020-05-02 21:20:04', '2020-05-02 21:20:04'),
(26, 24, '4243c17f126b1a3dfef8a0f2f5077708.jpg', '2020-05-02 21:37:37', '2020-05-02 21:37:37'),
(27, 25, '16e092f9fa2d4816d491c5e454f63590.jpg', '2020-06-22 16:40:53', '2020-06-22 16:40:53'),
(28, 26, '581590251cec87a64a181083853568f6.jpg', '2020-06-22 16:42:32', '2020-06-22 16:42:32'),
(29, 27, 'a86ac7941ae75ec90119b07e01175d1d.jpg', '2020-06-22 16:43:49', '2020-06-22 16:43:49'),
(30, 28, '2206cb231dd18274078bf01001d92a9f.jpg', '2020-06-22 16:44:39', '2020-06-22 16:44:39'),
(31, 29, '2db154bb2df63a7a012a7dbee728d8b9.jpg', '2020-06-22 16:45:54', '2020-06-22 16:45:54'),
(32, 30, '3c8097d550600a8680b281beb97f2faf.jpg', '2020-06-22 16:46:50', '2020-06-22 16:46:50'),
(33, 31, '33455a7735d28dc036ba5394d4e0ea1c.jpg', '2020-06-22 16:48:30', '2020-06-22 16:48:30'),
(34, 32, 'd85c67f44415a24fd635b97486fee640.jpg', '2020-06-22 16:50:50', '2020-06-22 16:50:50'),
(35, 33, '0b6184ec3ffd4c60a654a6813e96bee3.jpg', '2020-06-22 16:51:56', '2020-06-22 16:51:56'),
(36, 34, '5d3a17b9f79cc12b418cb1ef71e90b31.jpg', '2020-06-22 16:52:51', '2020-06-22 16:52:51'),
(37, 35, '7dff7e357f172ddfdc18411e0a6bd20a.jpg', '2020-06-22 16:53:41', '2020-06-22 16:53:41'),
(38, 36, 'f9204ca448bb53e73baea89f6fc93913.jpg', '2020-06-22 16:55:24', '2020-06-22 16:55:24'),
(39, 37, 'b561a389e839082c726188de924b7dbd.jpg', '2020-06-22 16:56:28', '2020-06-22 16:56:28'),
(40, 38, 'c9ea9d3cffd1c92212d72b2dc84b70a6.jpg', '2020-06-22 16:57:10', '2020-06-22 16:57:10'),
(41, 39, 'ac2a792a32eb6b16c48a1980cb85ecbe.jpg', '2020-06-22 16:57:53', '2020-06-22 16:57:53'),
(42, 40, '26e134f6ae03e2020786eb5fa173f6e8.jpg', '2020-06-22 16:58:47', '2020-06-22 16:58:47'),
(43, 41, '3deda488eb6fb67987f3ebe792c64cea.jpg', '2020-06-22 16:59:43', '2020-06-22 16:59:43'),
(44, 42, '20203aed6ab1e3f2cddfe5aa3eed2417.jpg', '2020-06-22 17:00:51', '2020-06-22 17:00:51'),
(45, 43, 'fc2b49068b28dd529943cb764bf94127.jpg', '2020-06-22 17:05:51', '2020-06-22 17:05:51'),
(46, 44, '9f62abbadea5f6ea569d6157b07b213d.jpg', '2020-06-22 17:07:15', '2020-06-22 17:07:15'),
(47, 45, 'f786cc3d18c7cbbe8d1d6cebeee3748f.jpg', '2020-06-22 17:08:47', '2020-06-22 17:08:47'),
(48, 46, 'c5b72a2a82d6ead02e258246bdb564cc.jpg', '2020-06-22 17:09:43', '2020-06-22 17:09:43'),
(49, 47, 'f75da7783c1dbf8bb0c56448631b6abc.jpg', '2020-06-22 17:10:42', '2020-06-22 17:10:42'),
(50, 48, '1dba18296dc24928f780095d213eae56.jpg', '2020-06-22 17:11:50', '2020-06-22 17:11:50');

-- --------------------------------------------------------

--
-- بنية الجدول `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `brands`
--

INSERT INTO `brands` (`id`, `category_id`, `city_id`, `image`, `title`, `created_at`, `updated_at`) VALUES
(9, 5, 16, 'd9d639037cb4f35e820b533cde2d0b31.jpg', 'مقله السنبلاوين', '2020-05-02 19:16:27', '2020-05-02 19:43:33'),
(10, 6, 16, '926bfae53dbdc642c41c1a384317993c.jpg', 'مخبز خمس نجوم', '2020-05-02 19:58:11', '2020-05-02 19:58:11'),
(12, 8, 16, 'c7cfd93a5d030b5b8f52eb7f5387a9e3.jpg', 'عسل نحل الحوت', '2020-05-02 21:17:17', '2020-05-02 21:17:17'),
(13, 9, 16, 'b570f13e801ef00e38d499934800fba9.jpg', 'الفسخانى اصل نبروه', '2020-05-02 21:35:00', '2020-05-02 21:35:00'),
(15, 10, 16, '9a52c1892db1d7a21ddf4db67600862e.jpg', 'بازار شيكوبون', '2020-06-22 16:28:21', '2020-06-22 16:28:21');

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `image`, `title`, `created_at`, `updated_at`) VALUES
(5, '26247862100b49b1b1599bfce600113d.jpg', 'تسالى', '2020-05-02 19:02:49', '2020-05-02 19:02:49'),
(6, '01513bae1372fe47821161d554cddadf.jpg', 'المخبوزات والمعجنات', '2020-05-02 19:55:41', '2020-05-02 19:55:41'),
(8, '74f992fdc1cbbda9e6f803cb2d2925be.jpg', 'منتجات عسل النحل', '2020-05-02 21:16:44', '2020-05-02 21:16:44'),
(9, '1ed0a565df2b7ab288dbbb79ea00ccfe.jpg', 'قسم الفسيخ والرنجه', '2020-05-02 21:27:30', '2020-05-02 21:27:30'),
(10, 'df58746dfd04079eb7810a05088a2870.jpg', 'عشاق الشيكولاته', '2020-06-22 16:25:40', '2020-06-22 16:25:40');

-- --------------------------------------------------------

--
-- بنية الجدول `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cities`
--

INSERT INTO `cities` (`id`, `state`, `state_id`, `city`, `city_id`, `village`, `shipping_cost`, `status`, `created_at`, `updated_at`) VALUES
(13, 'الدقهليه', NULL, NULL, NULL, NULL, NULL, '1', '2020-04-27 20:41:12', '2020-05-02 19:12:01'),
(16, 'الدقهليه', 13, 'السنبلاوين', NULL, NULL, NULL, '1', '2020-05-02 19:12:29', '2020-05-02 19:12:29'),
(18, 'الدقهليه', 13, 'السنبلاوين', 16, 'عزبه صقر', 10, '1', '2020-05-02 19:14:14', '2020-05-02 19:14:14'),
(19, 'الدقهليه', 13, 'السنبلاوين', 16, 'حى النزهه', 10, '1', '2020-05-02 19:14:35', '2020-05-02 19:14:35'),
(21, 'الدقهليه', 13, 'السنبلاوين', 16, 'حى البستان', 10, '1', '2020-05-02 20:44:47', '2020-05-02 20:44:47'),
(22, 'الدقهليه', 13, 'السنبلاوين', 16, 'ارض عبدالجليل', 10, '1', '2020-05-02 20:45:22', '2020-05-02 20:45:22'),
(23, 'الدقهليه', 13, 'السنبلاوين', 16, 'عزبه ملتاز', 10, '1', '2020-05-02 20:45:38', '2020-05-02 20:45:38'),
(24, 'الدقهليه', 13, 'السنبلاوين', 16, 'الحوال', 10, '1', '2020-05-02 20:45:54', '2020-05-02 20:45:54'),
(25, 'الدقهليه', 13, 'السنبلاوين', 16, 'السوعه', 10, '1', '2020-05-02 20:46:06', '2020-05-02 20:46:06'),
(26, 'الدقهليه', 13, 'السنبلاوين', 16, 'الزراعيه', 10, '1', '2020-05-02 20:46:17', '2020-05-02 20:46:17'),
(27, 'الدقهليه', 13, 'السنبلاوين', 16, 'شارع المستشار', 10, '1', '2020-05-02 20:46:35', '2020-05-02 20:46:35'),
(28, 'الدقهليه', 13, 'السنبلاوين', 16, 'المعاهده', 10, '1', '2020-05-02 20:46:50', '2020-05-02 20:46:50'),
(29, 'الدقهليه', 13, 'السنبلاوين', 16, 'حى الطيارة', 10, '1', '2020-05-02 20:47:00', '2020-05-02 20:47:00'),
(30, 'الدقهليه', 13, 'السنبلاوين', 16, 'حى الطيارة', 10, '1', '2020-05-02 20:47:00', '2020-05-02 20:47:00'),
(31, 'الدقهليه', 13, 'السنبلاوين', 16, 'المنشيه', 10, '1', '2020-05-02 20:47:11', '2020-05-02 20:47:11'),
(32, 'الدقهليه', 13, 'السنبلاوين', 16, 'ارض مدين', 10, '1', '2020-05-02 20:47:24', '2020-05-02 20:47:24'),
(33, 'الدقهليه', 13, 'السنبلاوين', 16, 'الشيخ عمر', 0, '1', '2020-05-02 20:47:38', '2020-06-19 19:59:52'),
(34, 'الدقهليه', 13, 'السنبلاوين', 16, 'ميدان سعفان', 10, '1', '2020-05-02 20:47:52', '2020-05-02 20:47:52'),
(35, 'الدقهليه', 13, 'السنبلاوين', 16, 'النوارده', 10, '1', '2020-05-02 20:48:02', '2020-05-02 20:48:02'),
(36, 'الدقهليه', 13, 'السنبلاوين', 16, 'البرجاس', 10, '1', '2020-05-02 20:48:11', '2020-05-02 20:48:11'),
(37, 'الدقهليه', 13, 'السنبلاوين', 16, 'ارض المحلج', 10, '1', '2020-05-02 20:48:24', '2020-05-02 20:48:24'),
(38, 'الدقهليه', 13, 'السنبلاوين', 16, 'حى ابو فندى', 10, '1', '2020-05-02 20:48:36', '2020-05-02 20:48:36');

-- --------------------------------------------------------

--
-- بنية الجدول `classifications`
--

CREATE TABLE `classifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `classifications`
--

INSERT INTO `classifications` (`id`, `brand_id`, `image`, `title`, `created_at`, `updated_at`) VALUES
(6, 9, '9db1e146ce7484c76dccb99d3bd4d594.jpg', 'قسم المحمصات', '2020-05-02 19:18:30', '2020-05-02 19:18:30'),
(7, 10, '049ca46333e9195a127d1342be1191a0.jpg', 'مخبوزات', '2020-05-02 20:26:50', '2020-05-02 20:26:50'),
(10, 12, 'f13bff0aa4c087d2908d80afb0b8b5fa.jpg', 'عسل نحل مصرى', '2020-05-02 21:18:30', '2020-05-02 21:18:30'),
(11, 13, 'cddc00cfdf6cd4a04f883eb1fbed80c5.jpg', 'قسم الفسيخ', '2020-05-02 21:36:56', '2020-05-02 21:36:56'),
(12, 15, 'b4d8698138cd14593f44a49f4b375acd.jpg', 'قسم الشيكولاته', '2020-06-22 16:39:52', '2020-06-22 16:39:52');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_us`
--

INSERT INTO `contact_us` (`id`, `phone`, `title`, `message`, `created_at`, `updated_at`) VALUES
(1, '025552522', 'test', 'testttt', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `coupons`
--

INSERT INTO `coupons` (`id`, `brand_id`, `code`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(5, 12, 'ANY4PmTXrZ', 50, '0', '2020-05-04 22:11:05', '2020-05-04 22:12:14'),
(8, 12, 'HHnmaTtwo5', 1, '1', '2020-06-19 19:37:08', '2020-06-19 19:37:08');

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
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ad_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `classification_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `rate` double(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `items`
--

INSERT INTO `items` (`id`, `brand_id`, `classification_id`, `title`, `description`, `price`, `rate`, `status`, `discount`, `stock`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9, 9, 6, 'لب عباد الشمس مملح', 'لب عباد الشمس مملح', 48, 0.00, '1', NULL, 0, NULL, '2020-05-02 19:23:53', '2020-05-02 19:23:53'),
(10, 9, 6, 'لب سوبر', 'لب سوبر', 96, 0.00, '1', NULL, 0, NULL, '2020-05-02 19:30:45', '2020-05-02 19:30:45'),
(11, 9, 6, 'سودانى اسوانى مقشر', 'سودانى اسوانى مقشر', 48, 0.00, '1', NULL, 0, NULL, '2020-05-02 19:38:29', '2020-05-02 19:38:29'),
(12, 9, 6, 'سودانى مملح مقشر', 'سودانى مملح مقشر', 48, 0.00, '1', NULL, 0, NULL, '2020-05-02 19:39:22', '2020-05-02 19:39:22'),
(13, 9, 6, 'ذرة فيشار', 'ذرة فيشار', 20, 0.00, '1', NULL, 0, NULL, '2020-05-02 19:45:46', '2020-05-02 19:45:46'),
(14, 9, 6, 'ذرة اسبانى', 'ذرة اسبانى', 72, 0.00, '1', NULL, 0, NULL, '2020-05-02 19:46:40', '2020-05-02 19:46:40'),
(15, 10, 7, 'عيش كيزر بالقطعه', 'عيش كيزر بالقطعه', 1, 0.00, '1', NULL, 0, NULL, '2020-05-02 20:27:23', '2020-05-02 20:27:23'),
(16, 10, 7, 'عيش كيزر بالقطعه', 'عيش كيزر بالقطعه', 1, 0.00, '1', NULL, 0, '2020-05-02 20:57:25', '2020-05-02 20:27:25', '2020-05-02 20:57:25'),
(17, 10, 7, 'عيش فرنساوى كيس (4 قطع)', 'عيش فرنساوى كيس (4 قطع)', 4, 0.00, '1', NULL, 0, NULL, '2020-05-02 20:58:44', '2020-05-02 20:58:44'),
(18, 10, 7, 'بقسماط سادة (كيس )', 'بقسماط سادة (كيس )', 12, 0.00, '1', NULL, 0, NULL, '2020-05-02 20:59:33', '2020-05-02 20:59:33'),
(19, 10, 7, 'بقسماط سمسم ( كيس)', 'بقسماط سمسم ( كيس)', 12, 0.00, '1', NULL, 0, NULL, '2020-05-02 21:00:29', '2020-05-02 21:00:29'),
(20, 10, 7, 'باتون ساليه ( كيس)', 'باتون ساليه ( كيس)', 12, 0.00, '1', NULL, 0, NULL, '2020-05-02 21:01:20', '2020-05-02 21:01:20'),
(21, 10, 7, 'عيش سن ( 1كيلو )', 'عيش سن ( 1كيلو )', 20, 0.00, '1', NULL, 0, NULL, '2020-05-02 21:03:42', '2020-05-02 21:03:42'),
(22, 12, 10, 'عسل نحل بالمكسرات كيلو', 'عسل نحل بالمكسرات كيلو', 90, 0.00, '1', NULL, 0, NULL, '2020-05-02 21:19:33', '2020-05-02 21:19:33'),
(23, 12, 10, 'عسل نحل بالمكسرات 1/2 كيلو', 'عسل نحل بالمكسرات 1/2 كيلو', 40, 3.00, '1', NULL, 0, NULL, '2020-05-02 21:20:04', '2020-05-04 22:06:37'),
(24, 13, 11, 'كيلو فسيخ 3 حبات', 'كيلو فسيخ 3 حبات', 80, 0.00, '1', NULL, 0, NULL, '2020-05-02 21:37:37', '2020-05-02 21:37:37'),
(25, 15, 12, 'milka mmmax peanut caramel 100 gm', 'milka mmmax peanut caramel 100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:40:53', '2020-06-22 16:40:53'),
(26, 15, 12, 'milka mmmax triolade100 gm', 'milka mmmax triolade100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:42:32', '2020-06-22 16:42:32'),
(27, 15, 12, 'milka mmmax toffe ganznuss  100 gm', 'milka mmmax toffe ganznuss  100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:43:49', '2020-06-22 16:43:49'),
(28, 15, 12, 'milka mmmax noisette100 gm', 'milka mmmax noisette100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:44:39', '2020-06-22 16:44:39'),
(29, 15, 12, 'milka mmmax oreo 100 gm', 'milka mmmax oreo 100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:45:54', '2020-06-22 16:45:54'),
(30, 15, 12, 'milka mmmax trauben-nuss 100 gm', 'milka mmmax trauben-nuss 100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:46:50', '2020-06-22 16:46:50'),
(31, 15, 12, 'milka mmmax schoko&keks 100 gm', 'milka mmmax schoko&keks 100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:48:30', '2020-06-22 16:48:30'),
(32, 15, 12, 'milka mmmax strawberry 100 gm', 'milka mmmax strawberry 100 gm \r\nمنتج المانى', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:50:50', '2020-06-22 16:50:50'),
(33, 15, 12, 'milka moments mix', 'milka moments mix', 50, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:51:56', '2020-06-22 16:51:56'),
(34, 9, 12, 'milka tuc', 'milka tuc', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:52:51', '2020-06-22 17:16:05'),
(35, 9, 12, 'milka dark milk', 'milka dark milk', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:53:41', '2020-06-22 17:14:34'),
(36, 15, 12, 'milka oreo', 'milka oreo', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:55:24', '2020-06-22 16:55:24'),
(37, 9, 12, 'milka alpine milk', 'milka alpine milk', 25, 0.00, '1', NULL, 0, '2020-06-22 22:08:05', '2020-06-22 16:56:28', '2020-06-22 22:08:05'),
(38, 9, 12, 'milka bubbly alpine milk', 'milka bubbly alpine milk', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:57:10', '2020-06-22 17:13:06'),
(39, 9, 12, 'milka bubbly white', 'milka bubbly white', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:57:53', '2020-06-22 17:13:25'),
(40, 15, 12, 'milka oreo brownie', 'milka oreo brownie', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:58:47', '2020-06-22 16:58:47'),
(41, 9, 12, 'milka rasberry crème', 'milka rasberry crème', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 16:59:43', '2020-06-22 17:15:03'),
(42, 9, 12, 'milka caramel', 'milka caramel', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:00:51', '2020-06-22 17:13:51'),
(43, 9, 12, 'milka chocolate mousse', 'milka chocolate mousse', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:05:51', '2020-06-22 17:14:14'),
(44, 15, 12, 'milka triple caramel', 'milka triple caramel', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:07:15', '2020-06-22 17:07:15'),
(45, 15, 12, 'milka chips ahoy!', 'milka chips ahoy!', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:08:47', '2020-06-22 17:08:47'),
(46, 15, 12, 'milka whole hazelnuts', 'milka whole hazelnuts', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:09:43', '2020-06-22 17:09:43'),
(47, 15, 12, 'milka caramel cream', 'milka caramel cream', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:10:42', '2020-06-22 17:10:42'),
(48, 15, 12, 'milka triple choco cocoa', 'milka triple choco cocoa', 25, 0.00, '1', NULL, 0, NULL, '2020-06-22 17:11:50', '2020-06-22 17:11:50');

-- --------------------------------------------------------

--
-- بنية الجدول `item_details`
--

CREATE TABLE `item_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(2, '2019_07_20_095551_create_cities_table', 1),
(3, '2019_10_28_153011_create_admins_table', 1),
(4, '2019_10_31_095306_create_categories_table', 1),
(5, '2019_10_31_095307_create_brands_table', 1),
(6, '2019_10_31_095308_create_classifications_table', 1),
(7, '2019_10_31_095643_create_items_table', 1),
(8, '2019_10_31_095644_create_item_details_table', 1),
(9, '2019_10_31_110417_create_attaches_table', 1),
(10, '2019_10_31_110532_create_favorites_table', 1),
(11, '2019_10_31_110627_create_settings_table', 1),
(12, '2019_10_31_110802_create_contact_us_table', 1),
(13, '2019_11_11_144412_create_faq_table', 1),
(14, '2019_11_13_210043_create_orders_table', 1),
(15, '2019_11_13_210211_create_order_items_table', 1),
(16, '2019_12_14_120106_create_notifications_table', 1),
(17, '2019_12_23_122131_create_ads_table', 1),
(18, '2019_12_23_122131_create_coupons_table', 1),
(19, '2019_12_24_131730_create_rates_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => with order, 2 => without order',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `order_id`, `body`, `type`, `created_at`, `updated_at`) VALUES
(49, 12, 16, '6940539 تم تأكيد طلبك رقم ', '1', '2020-04-28 23:44:05', '2020-04-28 23:44:05'),
(50, 12, 14, '7943643 تم تأكيد طلبك رقم ', '1', '2020-04-28 23:44:19', '2020-04-28 23:44:19'),
(51, 12, 14, '7943643 تم شحن طلبك رقم ', '1', '2020-04-28 23:44:37', '2020-04-28 23:44:37'),
(52, 12, 15, '9504456 تم تأكيد طلبك رقم ', '1', '2020-04-28 23:44:59', '2020-04-28 23:44:59'),
(53, 12, 15, '9504456 تم شحن طلبك رقم ', '1', '2020-04-28 23:45:14', '2020-04-28 23:45:14'),
(54, 12, 15, '9504456 تم توصيل طلبك رقم ', '1', '2020-04-28 23:45:27', '2020-04-28 23:45:27'),
(55, 12, 17, '8923853 تم إلغاء طلبك رقم ', '1', '2020-04-28 23:53:18', '2020-04-28 23:53:18'),
(58, 12, 13, '5533736 تم إلغاء طلبك رقم ', '1', '2020-05-02 20:38:33', '2020-05-02 20:38:33'),
(61, 11, 18, '9952763 تم تأكيد طلبك رقم ', '1', '2020-05-04 22:18:23', '2020-05-04 22:18:23'),
(62, 11, 18, '9952763 تم شحن طلبك رقم ', '1', '2020-05-04 22:18:31', '2020-05-04 22:18:31'),
(63, 20, 24, '4964871 تم إلغاء طلبك رقم ', '1', '2020-05-19 20:19:06', '2020-05-19 20:19:06'),
(64, 22, 21, '3937681 تم إلغاء طلبك رقم ', '1', '2020-05-19 20:20:55', '2020-05-19 20:20:55'),
(65, 22, 21, '3937681 تم إلغاء طلبك رقم ', '1', '2020-05-19 20:20:55', '2020-05-19 20:20:55'),
(66, 20, 23, '2069657 تم تأكيد طلبك رقم ', '1', '2020-05-19 20:21:39', '2020-05-19 20:21:39'),
(67, 20, 23, '2069657 تم شحن طلبك رقم ', '1', '2020-05-19 20:22:00', '2020-05-19 20:22:00'),
(68, 20, 20, '4641790 تم إلغاء طلبك رقم ', '1', '2020-05-19 20:26:26', '2020-05-19 20:26:26'),
(69, 22, 22, '5578078 تم إلغاء طلبك رقم ', '1', '2020-05-19 20:26:29', '2020-05-19 20:26:29'),
(70, 11, 19, '6139831 تم إلغاء طلبك رقم ', '1', '2020-05-19 20:26:31', '2020-05-19 20:26:31'),
(71, 25, 25, '6699713 تم تأكيد طلبك رقم ', '1', '2020-06-17 19:50:55', '2020-06-17 19:50:55'),
(72, 12, 26, '4496749 تم تأكيد طلبك رقم ', '1', '2020-06-19 19:10:46', '2020-06-19 19:10:46'),
(73, 11, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(74, 12, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(75, 14, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(76, 15, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(77, 16, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(78, 17, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(79, 18, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(80, 19, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(81, 20, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(82, 21, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(83, 22, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(84, 23, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(85, 24, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(86, 25, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(87, 26, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(88, 27, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(89, 28, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(90, 29, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(91, 30, NULL, 'حاليا تم تشغيل التطبيق', '2', '2020-06-19 19:16:27', '2020-06-19 19:16:27'),
(92, 11, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(93, 12, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(94, 14, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(95, 15, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(96, 16, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(97, 17, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(98, 18, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(99, 19, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(100, 20, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(101, 21, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(102, 22, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(103, 23, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(104, 24, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(105, 25, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(106, 26, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(107, 27, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(108, 28, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(109, 29, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(110, 30, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25'),
(111, 31, NULL, 'تتاابلممممللر', '2', '2020-06-19 20:05:25', '2020-06-19 20:05:25');

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `village_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_cost` int(11) DEFAULT NULL,
  `shipping_cost` int(11) NOT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=>new,1=>confirmed,2=>canceled,3=>underway,4=>done',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `village_id`, `code`, `address_description`, `order_cost`, `shipping_cost`, `total_cost`, `coupon`, `coupon_discount`, `status`, `created_at`, `updated_at`) VALUES
(13, 12, 15, '5533736', 'fffff', 100, 50, 150, NULL, NULL, '2', '2020-04-28 23:39:39', '2020-05-02 20:38:33'),
(14, 12, 15, '7943643', 'ggfgg', 400, 50, 450, NULL, NULL, '3', '2020-04-28 23:40:29', '2020-04-28 23:44:37'),
(15, 12, 15, '9504456', 'frrrrr', 100, 50, 150, NULL, NULL, '4', '2020-04-28 23:41:23', '2020-04-28 23:45:27'),
(16, 12, 15, '6940539', 'gffff', 100, 50, 150, NULL, NULL, '1', '2020-04-28 23:41:47', '2020-04-28 23:44:05'),
(17, 12, 15, '8923853', 'yyytttg', 200, 50, 250, NULL, NULL, '2', '2020-04-28 23:52:14', '2020-04-28 23:53:18'),
(18, 11, 23, '9952763', 'hgdtyu', 40, 10, 30, 'ANY4PmTXrZ', '50', '3', '2020-05-04 22:12:14', '2020-05-04 22:18:31'),
(19, 11, 28, '6139831', 'yyyt', 80, 10, 50, '6uG1q0zioj', '50', '2', '2020-05-04 22:16:20', '2020-05-19 20:26:31'),
(20, 20, 18, '4641790', 'بجوار مسجد ابوزكي', 340, 10, 350, NULL, NULL, '2', '2020-05-12 05:01:19', '2020-05-19 20:26:26'),
(21, 22, 18, '3937681', 'شارع احمد حسن', 80, 10, 90, NULL, NULL, '2', '2020-05-15 22:41:18', '2020-05-19 20:20:55'),
(22, 22, 26, '5578078', 'عزتثتن', 1, 10, 11, NULL, NULL, '2', '2020-05-15 22:46:24', '2020-05-19 20:26:29'),
(23, 20, 22, '2069657', 'ةىىىر', 80, 10, 90, NULL, NULL, '3', '2020-05-16 17:24:49', '2020-05-19 20:22:00'),
(24, 20, 32, '4964871', 'تنظةلل', 416, 10, 426, NULL, NULL, '2', '2020-05-19 20:16:22', '2020-05-19 20:19:06'),
(25, 25, 23, '6699713', 'ا', 200, 10, 210, NULL, NULL, '1', '2020-05-27 22:20:31', '2020-06-17 19:50:55'),
(26, 12, 27, '4496749', 'اااات', 80, 10, 90, NULL, NULL, '1', '2020-06-03 11:59:06', '2020-06-19 19:10:46'),
(27, 25, 23, '8735984', 'شارع احا', 90, 10, 100, NULL, NULL, '0', '2020-06-19 19:18:34', '2020-06-19 19:18:34'),
(28, 29, 28, '6787490', 'بطيخ', 25, 10, 35, NULL, NULL, '0', '2020-06-22 20:09:09', '2020-06-22 20:09:09'),
(29, 29, 25, '8298117', 'بطيخ', 80, 10, 90, NULL, NULL, '0', '2020-06-22 20:10:29', '2020-06-22 20:10:29');

-- --------------------------------------------------------

--
-- بنية الجدول `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL COMMENT 'for one peace',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `count`, `price`, `created_at`, `updated_at`) VALUES
(19, 18, 23, 1, 40, '2020-05-04 22:12:14', '2020-05-04 22:12:14'),
(20, 19, 24, 1, 80, '2020-05-04 22:16:20', '2020-05-04 22:16:20'),
(21, 20, 22, 2, 90, '2020-05-12 05:01:19', '2020-05-12 05:01:19'),
(22, 20, 23, 2, 40, '2020-05-12 05:01:19', '2020-05-12 05:01:19'),
(23, 20, 24, 1, 80, '2020-05-12 05:01:19', '2020-05-12 05:01:19'),
(24, 21, 24, 1, 80, '2020-05-15 22:41:18', '2020-05-15 22:41:18'),
(25, 22, 15, 1, 1, '2020-05-15 22:46:24', '2020-05-15 22:46:24'),
(26, 23, 24, 1, 80, '2020-05-16 17:24:49', '2020-05-16 17:24:49'),
(27, 24, 17, 4, 4, '2020-05-19 20:16:22', '2020-05-19 20:16:22'),
(28, 24, 24, 5, 80, '2020-05-19 20:16:22', '2020-05-19 20:16:22'),
(29, 25, 23, 5, 40, '2020-05-27 22:20:31', '2020-05-27 22:20:31'),
(30, 26, 24, 1, 80, '2020-06-03 11:59:06', '2020-06-03 11:59:06'),
(31, 27, 22, 1, 90, '2020-06-19 19:18:34', '2020-06-19 19:18:34'),
(32, 28, 42, 1, 25, '2020-06-22 20:09:09', '2020-06-22 20:09:09'),
(33, 29, 24, 1, 80, '2020-06-22 20:10:29', '2020-06-22 20:10:29');

-- --------------------------------------------------------

--
-- بنية الجدول `rates`
--

CREATE TABLE `rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rate` double(8,2) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `rates`
--

INSERT INTO `rates` (`id`, `item_id`, `user_id`, `rate`, `review`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 0.00, 'good', '2020-04-22 13:38:04', '2020-04-22 13:38:04'),
(2, 1, 3, 0.00, 'hsjue', '2020-04-27 01:20:09', '2020-04-27 01:20:09'),
(3, 3, 3, 4.00, 'hhhhhh', '2020-04-27 01:58:14', '2020-04-27 01:58:14'),
(4, 2, 3, 3.00, 'yyy', '2020-04-27 17:17:49', '2020-04-27 17:17:49'),
(5, 8, 11, 4.00, 'حلوه اوي', '2020-04-27 20:31:07', '2020-04-27 20:31:07'),
(6, 8, 12, 4.00, 'fffff', '2020-04-28 15:36:28', '2020-04-28 15:36:28'),
(7, 23, 11, 3.00, 'hhhh', '2020-05-04 22:06:37', '2020-05-04 22:06:37');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `setting`, `key`, `value`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'about_us', 'about_us', 'تطبيق وصلى _ wassaly\r\nهو اول تطبيق مخصوص للسنبلاوين والقرى المجاوره\r\nتقدر من خلاله توفر كل متطلبات بيتك بطريقه سهله وسريعه  امنه', 'en', '2020-04-27 19:29:18', '2020-06-13 18:08:33'),
(2, 'settings', 'terms_and_conditions', 'الشروط والاحكام\r\nالموافقة على شروط واحكام الاستخدام\r\n\r\nعند تصفح تطبيق وصلى أو القيام باي نشاط عليه ستكون هذه موافقة رسمية/ قانونية منك على شروط واحكام التطبيق\r\n\r\nأذا كنت غير موافق على شروط واحكام صفحتنا فنرجوا عدم استخدام التطبيق. شركه وصلى تحتفظ بحق تغيير أي من هذه الاحكام و الشروط في أي وقت بدون شرط اعلام المستخدم أولا.\r\n\r\nتفاصيل و أمان الحساب الخاص بك\r\n\r\nقبل استخدام تطبيق وصلى يجب ان تقوم بالتسجيل وانشاء حساب خاص عن طريق إدخال معلومات شخصية مثل الاسم,  رقم الهاتف , العنوان و كلمة السر للحساب\r\n\r\nيجب ان تقوم بإدخال معلومات صحيحة, حديثة وكاملة عن نفسك كما هو مطلوب في استمارة التسجيل وفي حالة تغير أي من هذه المعلومات يجب تحدثها على التطبيق في حالة ادخال معلومات غير صحيحة أو غير واضحة ,شركه وصلى لها الحق في تعليق الخدمة و رفض الشخص كمستخدم في المستقبل.مستخدم تطبيق وصلى مسئول عن الحفاظ على كلمة السر و الحساب الشخصي و يجب على المستخدم ابلاغ الشركه في حالة الشك إنه تم استخدام حسابه الشخصي بدون علمه عن طريق اختراق كلمة السر.شركه وصلى مسئوله عن حماية المعلومات الموجودة على قاعدة البيانات( العنوان البريدي و كلمة السر) ولكنه غير مسئول بالمرة عن حماية المعلومات التي يتم مشاركتها مع المطاعم مثل العنوان ورقم الهاتف ( هذه خطوة اساسية لتوصيل طلبك )\r\n\r\nإستخدام الموقع\r\n\r\nعند القيام باستخدام التطبيق, تكون موافق على:\r\nص\r\nلن تقوم بارسال أي شيء يكون محتوياته غير مناسبة , يعبر عن تفرقة عنصرية, يشمل الفاظ خارجة أو يحتوي على احاءات جنسية.كمستخدم ,غير مسموح لك ان تقوم باي اعلان عن خدمات أو مواقع أخرى من خلال التطبيق بدون الحصول على موافقه مكتوبة من شركه وصلى أولايجب ان تكون على علم ان عند القيام بطلبيه يجب ان تكون مستعد لاستلامها و دفع المستحق\r\n\r\nتعريف مسئولية تطبيق وصلى\r\n\r\nتطبيق وصلى هو خدمه لطلب الطعام الجاهز والبقالة والطعام الطازج و الحلويات و العطارة من خلال الإنترنت حيث تتيح للمستخدم طلب الطعام من المطاعم والسوبرماركت والمتاجر المسجلة على تطبيق وصلى ( هذه الخدمة متاحة من خلال الهاتف و الحاسوب) شركه وصلى لا تتدخل في عملية تحضير الطعام أو تصنيعه فقط التوصيل و حساب المبلغ المستحق, نحن فقط نعمل كهمزة وصل بين المستخدم و المطاعم والسوبرماركت والمتاجر ولا نتحمل أي مسئولة لأي نوع من الاضرار و الاصابات من جراء تناوله.\r\n\r\nتوقف أو تغير الخدمة المقدمة\r\n\r\nشركه وصلى تحتفظ بحق تغير, تعليق أو وقف الخدمة تماما المتاحة من خلال التطبيق وهذا يشمل التصفح أو التعامل مع أي من محتويات الموقع المقدمة من تطبيق وصلى', 'en', NULL, '2020-06-19 19:15:54'),
(3, 'contacts', 'facebook', 'facebook.com/wassalyapp', 'en', NULL, '2020-06-19 19:54:46'),
(4, 'contacts', 'instagram', 'instagram.com', 'en', NULL, '2020-05-17 13:22:28'),
(5, 'contacts', 'whatsapp', '01069500169', 'en', NULL, '2020-06-19 19:47:14'),
(6, 'contacts', 'twitter', 'twitter.com', 'en', NULL, '2020-05-17 19:54:46'),
(7, 'contacts', 'phone', '01069500169', 'en', NULL, '2020-06-13 18:42:39'),
(8, 'contacts', 'email', 'Wassaly.app@gmail.com', 'en', NULL, '2020-06-13 18:31:43');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `phone`, `city_id`, `image`, `reset_password_code`, `code_expiration`, `fcm_token`, `status`, `is_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'Mohamed', 'fadel', '$2y$10$zHS7OZViGFrU8MvAG5xopedPID0LYPRuFEdw9Q1E7f9afY.3rJj1.', '01099026602', 16, '98e35f5bf548e708940263dd0746b11e.jpg', NULL, NULL, NULL, '1', '1', NULL, '2020-04-27 20:20:38', '2020-05-09 04:06:23'),
(12, 'Mohamed', 'Adel', '$2y$10$zU/JME1h2ArSrdDlQfxuC.iSVs3BIkyAFIIhyVVggBo4qmXDI.L46', '01013930990', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-04-28 15:31:28', '2020-04-28 15:31:32'),
(14, 'mmmn', 'mmmmm', '$2y$10$HLthzrRXxR2x628d3iBxTuJoSHNvvI24EejipXLISx9Mk1zSBBtve', '01013930088', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-04-29 00:29:08', '2020-04-29 00:29:08'),
(15, 'beshoy', 'ghaly', '$2y$10$Rdb8nkpPB.MYE064fYW5l..VKF5TV2KQY1hKafMNglZJIX4INBtce', '01016345612', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-02 20:06:39', '2020-05-02 20:06:39'),
(16, 'Mohamed', 'Adel', '$2y$10$9tasoig4hmatI8J27hHtJOFxG24PsfHhufJDhffr8x7S3qZYPVnpi', '01013930000', 16, '5a74dcf896b38947e275071d71607fdd.jpg', NULL, NULL, NULL, '1', '1', NULL, '2020-05-04 21:03:46', '2020-05-05 00:11:18'),
(17, 'ahmed', 'zika', '$2y$10$hU5/WsmYraTmoyUQlud4s.OfBLJxwGQCm.IyzN/M1B8rqJ92zNtXW', '01142753269', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-06 23:11:31', '2020-05-06 23:11:31'),
(18, 'بيشوي', 'غالي', '$2y$10$6AH5TXbWe3SWE79x.0IK1uWJmjO.ZYm6qVnESp9gpKt9mlbW5u002', '01069500169', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-09 07:49:08', '2020-05-09 07:49:08'),
(19, 'hossam', 'nabil', '$2y$10$rG4AeBoEyG1XWpnMzwvcpuHBeUgURg6fP/2REukW9dSl6bjP8Z8T6', '01234567890', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-11 17:28:47', '2020-05-11 17:28:47'),
(20, 'حسين', 'شعبان', '$2y$10$V7ZVcWLyC5NBIUw7amqx7eplegupPjHbiOcMyRF1OS05ScCUrqPRC', '01118957823', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-11 19:33:02', '2020-05-11 19:33:02'),
(21, 'عايده', 'زكي', '$2y$10$MkViTPthB8i1mZgXGXH3aelQc7Q8HMxC6AyiOuhCHcNao.DBUWKDO', '01558397510', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-11 20:11:34', '2020-05-11 20:11:34'),
(22, 'نورا', 'المصرى', '$2y$10$o5qeXvAC0EkgAQQikc7NA.NTFScxHqVGqHUQj8OK6Z.ugQHdDZ3kq', '01094423224', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-15 22:39:06', '2020-05-15 22:39:06'),
(23, 'معتز', 'صفى الدين', '$2y$10$X1o653VEi9UNUdJkitKPB.gmOdhO65N0EVvvQAdk1qO8Jl8OeAO66', '01098490800', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-21 10:08:05', '2020-05-21 10:08:05'),
(24, 'محمود', 'عثمان', '$2y$10$yfWyVSrxUr7bo8S3tJ.Sh.ucEjwWHNePSxqsYuYdXQW/pb/xZnn7G', '01000093894', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-21 13:08:59', '2020-05-21 13:08:59'),
(25, 'بيشوي', 'غالي', '$2y$10$oKy0c4/Sw4W8hcjxtYPKOu1.UGgouBczaGtK1YMTomA2IJxvb2eEq', '01211967709', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-27 17:19:07', '2020-05-27 17:19:07'),
(26, 'Esraa', 'Abd El Maksoud', '$2y$10$Ue8te0RANBYaXinUsmpzf.rZRx1CBe2vbZEd.grTCAzDUO/DVETlC', '01065265612', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-05-29 01:17:12', '2020-05-29 01:17:12'),
(27, 'ghada', 'hassan', '$2y$10$fFL8NRPqx0XEb4ut9q30o.sl4ZOEVDTQSzyRVrRnE/1N3EfhMHbSe', '01026648375', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-06-01 11:44:13', '2020-06-01 11:44:13'),
(28, 'Mostafa', 'hussien', '$2y$10$GNe65MQknKo/ipwwWUs53OndqRAWhcS1v3Pp8K0.c.axbNfHC52Eq', '01008160228', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-06-10 17:52:55', '2020-06-10 17:52:55'),
(29, 'حسين', 'الشوربجي', '$2y$10$ks6RoDAMW1KXGIsFX76PpubwSjzdVLy3FNCsN3EGuC7oDFuwhh0ha', '01211042664', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-06-14 13:18:47', '2020-06-14 13:18:47'),
(30, 'ahmed', 'zika', '$2y$10$XpI4W58mQ/4M9WywD7/Beuvjq53X6.SByPrmuvxbXpWOSytBD2Z4i', '01010924512', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-06-19 18:57:52', '2020-06-19 18:57:52'),
(31, 'نرمين', 'عادل', '$2y$10$SqBF/.g77Ud5bJlhZv5UQeeyD/02QH2oeVmqhjQY4FRkbL2BrgakO', '01092481056', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-06-19 19:41:50', '2020-06-19 19:41:50'),
(32, 'mohamed', 'gamal', '$2y$10$FGqXU.jfkKqc4MeJfSTqJO2o4JBHEXwu6bdUkHI/ukD8XcGElIKCu', '01068155022', 16, NULL, NULL, NULL, NULL, '1', '1', NULL, '2020-06-22 20:02:36', '2020-06-22 20:02:36');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_attaches_items` (`item_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_category_id_foreign` (`category_id`),
  ADD KEY `brands_city_id_foreign` (`city_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifications`
--
ALTER TABLE `classifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classifications_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_coupons_brands` (`brand_id`);

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
  ADD KEY `FK_favorites_users` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_items_brands` (`brand_id`),
  ADD KEY `FK_items_classifications` (`classification_id`);

--
-- Indexes for table `item_details`
--
ALTER TABLE `item_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_details_item_id_foreign` (`item_id`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_order_id_foreign` (`order_id`);

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
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `FK_order_items_items` (`item_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_item_id_foreign` (`item_id`),
  ADD KEY `rates_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attaches`
--
ALTER TABLE `attaches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `classifications`
--
ALTER TABLE `classifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `item_details`
--
ALTER TABLE `item_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `attaches`
--
ALTER TABLE `attaches`
  ADD CONSTRAINT `FK_attaches_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `FK_brands_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_brands_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `classifications`
--
ALTER TABLE `classifications`
  ADD CONSTRAINT `FK_classifications_brands` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `FK_coupons_brands` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `FK_favorites_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_items_brands` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_items_classifications` FOREIGN KEY (`classification_id`) REFERENCES `classifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `item_details`
--
ALTER TABLE `item_details`
  ADD CONSTRAINT `FK_item_details_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_order_items_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
