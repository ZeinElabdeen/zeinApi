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
-- Database: `uriallab_guidance`
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
(1, 'admin', 'admin@admin.com', '$2y$10$aZvVFLvPmEvUQtZNTPVjJ.oTp.m2A5Ka3jdT9uaI012C2UpCj8IM6', NULL, '3c2RzzCns8F0v5t8AodVw5Ej2XEZ3C7eRMv9wM3Q4azzHM3ZT1momMhw6hCe', '2020-03-11 11:32:36', '2020-03-20 11:32:36');

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
(2, 'car02.jpg', '1', NULL, NULL),
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
(34, 40, '92c2831612214e0bf27476d79e3f828d.jpeg', '2020-06-15 12:34:34', '2020-06-15 12:34:34'),
(35, 51, '1746f422aa71ad5145f64d78bb547323.jpeg', '2020-06-17 15:22:11', '2020-06-17 15:22:11'),
(36, 56, '0334e1ea9e5c4e49138324fc44b2e65e.jpeg', '2020-06-21 12:36:50', '2020-06-21 12:36:50'),
(38, 63, 'd11be2dfdbe1a528e8165eedce34b02b.png', '2020-06-28 19:00:01', '2020-06-28 19:00:01'),
(39, 65, 'ca8cf8beeed2c228f187276dfdb9842c.png', '2020-06-29 16:19:36', '2020-06-29 16:19:36');

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
(2, 'mahmoud', 'mah@moud.com', 'test test', '2020-03-01 11:49:48', '2020-03-01 11:49:48'),
(4, 'samao', 'samo@yf.fg', 'it was awesome333', '2020-06-02 13:16:20', '2020-06-02 13:16:20'),
(5, 'samao', 'samo@yf.fg', 'it was awesome333', '2020-06-14 10:01:27', '2020-06-14 10:01:27'),
(6, 'samao', 'samo@yf.fg', 'it was awesome333', '2020-06-22 12:56:21', '2020-06-22 12:56:21'),
(7, 'ayagfff', 'uhhy@hg.hg', 'Bvvv', '2020-06-22 13:02:12', '2020-06-22 13:02:12'),
(8, 'ayatest2', 'ggg@jh.jh', 'Vvcxc', '2020-06-22 13:07:32', '2020-06-22 13:07:32'),
(9, 'ayaaaa', 'nvg@nhh.ng', 'Cc’d', '2020-06-22 13:09:12', '2020-06-22 13:09:12'),
(10, 'nights', 'jogi@Joni.jh', 'Njvhoti', '2020-06-22 13:11:12', '2020-06-22 13:11:12');

-- --------------------------------------------------------

--
-- بنية الجدول `deliver_requests`
--

CREATE TABLE `deliver_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `cost` int(11) NOT NULL,
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `deliver_requests`
--

INSERT INTO `deliver_requests` (`id`, `order_id`, `driver_id`, `cost`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 57, 1, 100, '55.55', '33.22', '2020-06-21 12:47:16', '2020-06-21 12:47:16');

-- --------------------------------------------------------

--
-- بنية الجدول `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet` double NOT NULL DEFAULT 0,
  `car_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_front_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_back_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_form_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_model_id` int(10) UNSIGNED NOT NULL,
  `car_type_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => male, 1 => female',
  `service` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 => people driver, 1 => package driver',
  `rate` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `notification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `drivers`
--

INSERT INTO `drivers` (`id`, `username`, `phone`, `email`, `password`, `image`, `id_number`, `wallet`, `car_color`, `id_image`, `car_front_image`, `car_back_image`, `car_form_image`, `driving_license_image`, `car_model_id`, `car_type_id`, `gender`, `service`, `rate`, `reset_password_code`, `code_expiration`, `fcm_token`, `status`, `notification`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'driver people', '0505330609', 'driver@driver.com', '$2y$10$eRXmPPBPOZXY8KW5BDmLq.C8apQB4OzISK7/4qz65GjOqc/04sRyS', 'e4af143f655a4c0862d058b2669e7792.jpg', '56456465466', 7.559999999999999, 'red', 'e4af143f655a4c0862d058b2669e7792.jpg', 'front.png', 'back.png', 'de.jpeg', 'de.jpeg', 1, 1, '1', '0', '3', '55555', '2020-03-24 12:01:43', 'dQje2UcrwfA:APA91bH-5drJXmhtPmL2yc--76nMlKzevRYBIqGKKNekAcd6O7-9VKJbjE9aNqzypgkheMYbN1-9p5vWb9XA_AVkWuQYOUGC62_evvM0bAtwZymnCRsMwUieuRMY8mBq86VqAXFpfv7V', '1', '0', '1', '2020-02-05 15:37:16', '2020-06-30 17:33:15'),
(2, 'hussein', '0505330609', 'driver@driver.com', '$2y$10$V2fOOkWX5Bzi03Vm3Ai1.eqggLzH8s/657ozokIAmrvIWsYafxLtq', 'e4af143f655a4c0862d058b2669e7792.jpg', '56456465466', 0, 'red', 'e4af143f655a4c0862d058b2669e7792.jpg', 'front.png', 'back.png', 'de.jpeg', 'de.jpeg', 1, 1, '1', '0', '4', '55555', '2020-02-05 16:20:34', NULL, '1', '1', '1', '2020-02-05 15:37:16', '2020-02-09 13:41:26'),
(3, 'Aya driver', '0501111111', 'aya@aya.com', '$2y$10$eRXmPPBPOZXY8KW5BDmLq.C8apQB4OzISK7/4qz65GjOqc/04sRyS', 'e4af143f655a4c0862d058b2669e7792.jpg', '56456465466', 0, 'red', 'e4af143f655a4c0862d058b2669e7792.jpg', 'front.png', 'back.png', 'de.jpeg', 'de.jpeg', 1, 1, '1', '1', '0', NULL, NULL, 'fjp3EvsfFLQ:APA91bGRjYfoIayxU0SJmsudG8Th7-VCP8QrNSVd0qLvRHbqITHg1OZi7c6K4LJn_7LQKrromD7qtZ6o62V3LfAqCfw3E7xxim3FWzKGDh7JsRI5njeoS0W7Ejzj9z8qLlAgXhhXpfQP', '1', '0', '1', '2020-03-19 12:04:10', '2020-06-21 09:02:01'),
(4, 'mahmoud3', '0505330602', 'mah2@moud.com', '$2y$10$wtpkcs9AHXqEFsWw9vhV6OkyHEI5bot9H1emkEH1XfnL2TAcBE7Um', 'a337c1b4f8ecbd810f592740b86f24b4.jpg', '123456', 0, 'red', '8b0b063726dd195bf3d2a915bbc2aee6.jpeg', '5e039388c2c689369519a9b6384c621b.jpeg', 'e52ce9e9efaca7a97d5d5de58ab2eaf6.jpeg', 'ebb8453c1afe79c361bc66e725513bb7.jpeg', '5857b3a35621618671072cf920673046.jpeg', 1, 1, '0', '0', '0', '55555', '2020-06-16 17:10:01', NULL, '1', '1', '1', '2020-06-16 15:01:03', '2020-06-16 15:05:22'),
(5, 'Aya driver people', '0500000000', 'aya@gmail.com', '$2y$10$NeGYPL2LVL99VlbXxRVeKukfPHAVyRFv3heDVsE25ys68oICNsF4O', NULL, '846464845424645', 0, 'red', 'be6d5e4ad05781e738c201c91470172e.jpeg', '69825ef158095319479cdd09736074ae.jpeg', 'de34a09ff7fc083a938b8b680c828227.jpeg', '27d9eaf5f2179fdd25a8042528f68124.jpeg', '7b648b3e509dbb5ddaba480215101d15.jpeg', 1, 2, '1', '0', '0', NULL, NULL, 'eUwyvV5CFdQ:APA91bEetJCo7pCPtQoN4ndObmRiP4i9yMFXkGSBD8Bg0aC_iKYajETtdPf9kG9VCJa4myEsKiscyifTLfnzIpbe-4tIks9rFeQwtKZENG-kaaNoAF1Kgzl6wt_MVTfPt1oWycbM6Aof', '1', '1', '1', '2020-06-21 12:40:50', '2020-06-21 12:41:22'),
(6, 'Aya Driver', '0505555555', 'aya@yahoo.com', '$2y$10$Ksc056LQA5sd88.mZCnIIumUlVnudU12cB.9MIRklVVaSnul6VCFm', 'f21ec7772562534ed7ab61f86458a0c1.png', '56456465466', 988.06, 'red', '451027565028d4f1de6e1328135d85b9.png', '8f8a0abc653f6aa6b9a176301675cc12.png', '7b5c4d361f0dd8587b79b947243c64aa.png', '5d68af99460d63e0517fea049190d531.png', 'af230d9da6674270ce34fe1a8af2ef29.png', 1, 1, '1', '1', '0', NULL, NULL, 'eUwyvV5CFdQ:APA91bEetJCo7pCPtQoN4ndObmRiP4i9yMFXkGSBD8Bg0aC_iKYajETtdPf9kG9VCJa4myEsKiscyifTLfnzIpbe-4tIks9rFeQwtKZENG-kaaNoAF1Kgzl6wt_MVTfPt1oWycbM6Aof', '1', '1', '1', '2020-06-23 10:46:25', '2020-06-30 18:31:13');

-- --------------------------------------------------------

--
-- بنية الجدول `driver_rates`
--

CREATE TABLE `driver_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate` double(8,2) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `driver_rates`
--

INSERT INTO `driver_rates` (`id`, `order_id`, `driver_id`, `user_id`, `rate`, `review`, `created_at`, `updated_at`) VALUES
(3, 53, 1, 3, 4.00, 'رائع', '2020-06-17 16:52:16', '2020-06-17 16:52:16'),
(4, 43, 1, 1, 4.00, 'it was awesome', '2020-06-18 08:52:46', '2020-06-18 08:52:46'),
(5, 67, 6, 10, 1.00, 'nice', '2020-06-29 20:39:49', '2020-06-29 20:39:49');

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
  `pickup_time` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` int(10) UNSIGNED DEFAULT NULL,
  `car_type` int(10) UNSIGNED DEFAULT NULL,
  `payment_method` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 =>cash,1 => credit',
  `gender` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 =>male,1 => female',
  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 =>people transfer,1 => packages transfer',
  `status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 =>new,1 => waiting for transmitting,2 =>underway,3 =>done, 4 =>canceled ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `code`, `user_id`, `driver_id`, `start_lat`, `start_lng`, `end_lat`, `end_lng`, `pickup_time`, `description`, `cost`, `car_type`, `payment_method`, `gender`, `type`, `status`, `created_at`, `updated_at`) VALUES
(59, 187415, 10, 6, '35.445', '45.145', '36.4', '41.214', '2021-06-13', NULL, 100, 1, '0', '0', '0', '1', '2020-06-23 10:41:32', '2020-06-25 19:54:52'),
(58, 672970, 7, 1, '30.102861113679005', '31.271168477833275', '30.21425927738251', '31.317888535559174', '2020-06-29', NULL, 100, 1, '0', NULL, '0', '1', '2020-06-21 12:48:42', '2020-06-21 12:49:22'),
(57, 984509, 7, NULL, '30.107014341427774', '31.27166736871004', '30.101898702452964', '31.271364614367485', '2020-06-25', NULL, NULL, 1, '0', NULL, '0', '0', '2020-06-21 12:37:45', '2020-06-21 12:37:45'),
(56, 754371, 7, NULL, '30.19854371589382', '31.30646266043186', '30.330296028760554', '31.210023164749146', '2020-06-26', 'hzhh', NULL, NULL, '0', NULL, '1', '0', '2020-06-21 12:36:50', '2020-06-21 12:36:50'),
(55, 444308, 7, NULL, '30.178929501247705', '31.283764466643337', '30.23683756325182', '31.130459792912006', '2020-06-24', NULL, NULL, 1, '0', NULL, '0', '0', '2020-06-21 12:31:59', '2020-06-21 12:31:59'),
(54, 740511, 1, NULL, '30.042169697183404', '31.212334223091602', '30.066354280416807', '31.217788830399513', '2020-06-27', NULL, NULL, 1, '0', NULL, '0', '0', '2020-06-20 09:09:58', '2020-06-20 09:09:58'),
(53, 169508, 3, 1, '26.05048014021241', '32.79637008905411', '26.05048014021241', '32.79637008905411', '2020-06-17', NULL, 45, 1, '0', NULL, '0', '3', '2020-06-17 16:51:05', '2020-06-17 16:52:07'),
(52, 594483, 3, 1, '26.050030124769194', '32.79640328139067', '26.050030124769194', '32.79640328139067', '2020-06-17', NULL, 58, 1, '0', NULL, '0', '3', '2020-06-17 16:43:02', '2020-06-17 16:47:09'),
(51, 548656, 3, 1, '26.0500084372343', '32.796516604721546', '26.04992168705467', '32.79640831053257', '2020-06-17', 'test', 88, NULL, '0', NULL, '1', '3', '2020-06-17 15:22:11', '2020-06-17 15:34:39'),
(50, 711650, 3, 1, '26.050153321939792', '32.796641662716866', '26.050115067575494', '32.796618193387985', '2020-06-17', NULL, 33, 1, '0', NULL, '0', '3', '2020-06-17 11:17:19', '2020-06-17 14:16:37'),
(45, 196340, 4, NULL, '26.049813249239826', '32.79644150286913', '26.049813249239826', '32.79644150286913', '2020-06-16', NULL, NULL, 1, '0', NULL, '0', '0', '2020-06-16 13:10:02', '2020-06-16 13:10:02'),
(43, 538350, 4, 1, '26.050136755090637', '32.796433456242085', '26.050136755090637', '32.796433456242085', '2020-06-16', NULL, 55, 1, '0', NULL, '0', '3', '2020-06-16 11:00:12', '2020-06-16 14:17:06'),
(44, 304775, 4, 1, '26.04976656070533', '32.79647670686245', '26.04976656070533', '32.79647670686245', '2020-06-16', NULL, 100, 1, '0', NULL, '0', '1', '2020-06-16 13:07:46', '2020-06-16 13:08:39'),
(40, 705976, 3, NULL, '26.050043378260746', '32.79676169157028', '26.050043378260746', '32.79676169157028', '2020-06-15', 'تيست', 55, NULL, '0', NULL, '1', '4', '2020-06-15 12:34:34', '2020-06-16 16:01:12'),
(60, 859472, 10, NULL, '30.091988006447973', '31.26604554595212', '30.091988623243942', '31.266042965461498', '2020-07-26', NULL, 100, 1, '0', '1', '0', '4', '2020-06-26 16:49:21', '2020-06-30 17:33:15'),
(64, 191880, 10, NULL, '30.092028006285975', '31.265996585735248', '30.09201665612684', '31.26602806896202', '2020-07-01', NULL, NULL, 1, '0', '1', '0', '0', '2020-06-29 16:18:49', '2020-06-29 16:18:49'),
(65, 388296, 10, NULL, '30.09201547821421', '31.266028628184067', '30.092015509019728', '31.26602952513263', '2020-07-01', NULL, 66, NULL, '1', NULL, '1', '4', '2020-06-29 16:19:36', '2020-06-30 18:31:13'),
(63, 272250, 10, NULL, '30.091980249804248', '31.266058123928953', '30.091994838175523', '31.266045926731913', '2020-06-28', NULL, NULL, NULL, '1', NULL, '1', '0', '2020-06-28 19:00:01', '2020-06-28 19:00:01'),
(66, 757502, 10, 6, '30.091992492789558', '31.266015969845103', '30.091992709828453', '31.266016853725944', '2020-06-30', NULL, 66, 1, '1', '1', '0', '3', '2020-06-29 17:12:51', '2020-06-30 18:30:03'),
(67, 146713, 10, 6, '30.09202233476258', '31.26601490871527', '30.092014245606222', '31.266026211157854', '2020-07-08', NULL, 33, 1, '0', '0', '0', '3', '2020-06-29 20:35:04', '2020-06-29 20:39:38');

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
(2, 3, 40, '2020-06-16 16:01:12', '2020-06-16 16:01:12'),
(3, 1, 60, '2020-06-30 17:33:15', '2020-06-30 17:33:15'),
(4, 2, 65, '2020-06-30 18:31:13', '2020-06-30 18:31:13');

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
(33, 3, 3, 40, '1', '0', 'new order', 'طلب جديد', '2020-06-15 12:34:34', '2020-06-15 12:34:34'),
(34, 3, 1, 40, '0', '0', 'driver people Offers To Perform Your Order', 'قام driver people بتقديم عرض توصيل ', '2020-06-15 12:35:48', '2020-06-15 12:35:48'),
(35, 3, 1, 40, '1', '0', 'Mah moud Accepted Your Offer', 'قام Mah moud بالموافقة على عرضك ', '2020-06-16 09:29:56', '2020-06-16 09:29:56'),
(36, 4, 1, 43, '1', '0', 'new order', 'طلب جديد', '2020-06-16 11:00:12', '2020-06-16 11:00:12'),
(37, 4, 2, 43, '1', '0', 'new order', 'طلب جديد', '2020-06-16 11:00:12', '2020-06-16 11:00:12'),
(38, 4, 1, 43, '0', '0', 'driver people Offers To Perform Your Order', 'قام driver people بتقديم عرض توصيل ', '2020-06-16 11:08:23', '2020-06-16 11:08:23'),
(39, 4, 1, 43, '0', '0', 'driver people Offers To Perform Your Order', 'قام driver people بتقديم عرض توصيل ', '2020-06-16 11:09:13', '2020-06-16 11:09:13'),
(40, 4, 1, 43, '1', '0', 'mahmoud2 Accepted Your Offer', 'قام mahmoud2 بالموافقة على عرضك ', '2020-06-16 11:12:39', '2020-06-16 11:12:39'),
(41, 4, 1, 44, '1', '0', 'new order', 'طلب جديد', '2020-06-16 13:07:46', '2020-06-16 13:07:46'),
(42, 4, 2, 44, '1', '0', 'new order', 'طلب جديد', '2020-06-16 13:07:46', '2020-06-16 13:07:46'),
(44, 4, 1, 44, '1', '0', 'mahmoud2 Accepted Your Offer', 'قام mahmoud2 بالموافقة على عرضك ', '2020-06-16 13:08:39', '2020-06-16 13:08:39'),
(45, 4, 1, 45, '1', '0', 'new order', 'طلب جديد', '2020-06-16 13:10:02', '2020-06-16 13:10:02'),
(46, 4, 2, 45, '1', '0', 'new order', 'طلب جديد', '2020-06-16 13:10:02', '2020-06-16 13:10:02'),
(47, 4, 1, 45, '0', '0', 'driver people Offers To Perform Your Order', 'قام driver people بتقديم عرض توصيل ', '2020-06-16 13:10:13', '2020-06-16 13:10:13'),
(48, 4, 1, 43, '1', '0', 'mahmoud2 Order Status Has Been Changed', ' mahmoud2 تم تغيير حالة الطلب', '2020-06-16 14:17:06', '2020-06-16 14:17:06'),
(49, 3, 1, 40, '1', '0', 'Mah moud Order Status Has Been Changed', ' Mah moud تم تغيير حالة الطلب', '2020-06-16 16:01:12', '2020-06-16 16:01:12'),
(50, 3, 1, 46, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:08:39', '2020-06-17 11:08:39'),
(51, 3, 1, 47, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:13:37', '2020-06-17 11:13:37'),
(52, 3, 1, 48, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:13:50', '2020-06-17 11:13:50'),
(53, 3, 1, 49, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:16:09', '2020-06-17 11:16:09'),
(54, 3, 2, 49, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:16:09', '2020-06-17 11:16:09'),
(55, 3, 4, 49, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:16:09', '2020-06-17 11:16:09'),
(56, 3, 1, 50, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:17:19', '2020-06-17 11:17:19'),
(57, 3, 2, 50, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:17:19', '2020-06-17 11:17:19'),
(58, 3, 4, 50, '1', '0', 'new order', 'طلب جديد', '2020-06-17 11:17:20', '2020-06-17 11:17:20'),
(60, 3, 1, 50, '1', '0', 'Mah moud Accepted Your Offer', 'قام Mah moud بالموافقة على عرضك ', '2020-06-17 12:43:05', '2020-06-17 12:43:05'),
(61, 3, 1, 50, '1', '0', 'Mah moud Order Status Has Been Changed', ' Mah moud تم تغيير حالة الطلب', '2020-06-17 14:16:37', '2020-06-17 14:16:37'),
(62, 3, 3, 51, '1', '0', 'new order', 'طلب جديد', '2020-06-17 15:22:11', '2020-06-17 15:22:11'),
(64, 3, 1, 51, '1', '0', 'Mah moud Accepted Your Offer', 'قام Mah moud بالموافقة على عرضك ', '2020-06-17 15:23:16', '2020-06-17 15:23:16'),
(65, 3, 1, 51, '0', '0', 'driver people Order Status Has Been Changed', ' driver people تم تغيير حالة الطلب', '2020-06-17 15:34:39', '2020-06-17 15:34:39'),
(66, 3, 1, 52, '1', '0', 'new order', 'طلب جديد', '2020-06-17 16:43:02', '2020-06-17 16:43:02'),
(67, 3, 2, 52, '1', '0', 'new order', 'طلب جديد', '2020-06-17 16:43:02', '2020-06-17 16:43:02'),
(68, 3, 4, 52, '1', '0', 'new order', 'طلب جديد', '2020-06-17 16:43:02', '2020-06-17 16:43:02'),
(70, 3, 1, 52, '1', '0', 'Mah moud Accepted Your Offer', 'قام Mah moud بالموافقة على عرضك ', '2020-06-17 16:43:47', '2020-06-17 16:43:47'),
(71, 3, 1, 52, '0', '0', 'driver people Order Status Has Been Changed', ' driver people تم تغيير حالة الطلب', '2020-06-17 16:47:09', '2020-06-17 16:47:09'),
(72, 3, 1, 53, '1', '0', 'new order', 'طلب جديد', '2020-06-17 16:51:05', '2020-06-17 16:51:05'),
(73, 3, 2, 53, '1', '0', 'new order', 'طلب جديد', '2020-06-17 16:51:05', '2020-06-17 16:51:05'),
(74, 3, 4, 53, '1', '0', 'new order', 'طلب جديد', '2020-06-17 16:51:05', '2020-06-17 16:51:05'),
(76, 3, 1, 53, '1', '0', 'Mah moud Accepted Your Offer', 'قام Mah moud بالموافقة على عرضك ', '2020-06-17 16:51:43', '2020-06-17 16:51:43'),
(77, 3, 1, 53, '0', '0', 'driver people Order Status Has Been Changed', ' driver people تم تغيير حالة الطلب', '2020-06-17 16:52:07', '2020-06-17 16:52:07'),
(78, 1, 1, 54, '1', '0', 'new order', 'طلب جديد', '2020-06-20 09:09:58', '2020-06-20 09:09:58'),
(79, 1, 2, 54, '1', '0', 'new order', 'طلب جديد', '2020-06-20 09:09:58', '2020-06-20 09:09:58'),
(80, 1, 4, 54, '1', '0', 'new order', 'طلب جديد', '2020-06-20 09:09:58', '2020-06-20 09:09:58'),
(81, 7, 1, 55, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:31:59', '2020-06-21 12:31:59'),
(82, 7, 2, 55, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:31:59', '2020-06-21 12:31:59'),
(83, 7, 4, 55, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:31:59', '2020-06-21 12:31:59'),
(84, 7, 3, 56, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:36:50', '2020-06-21 12:36:50'),
(85, 7, 1, 57, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:37:45', '2020-06-21 12:37:45'),
(86, 7, 2, 57, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:37:45', '2020-06-21 12:37:45'),
(87, 7, 4, 57, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:37:45', '2020-06-21 12:37:45'),
(88, 7, 1, 57, '0', '0', 'driver people Offers To Perform Your Order', 'قام driver people بتقديم عرض توصيل ', '2020-06-21 12:47:16', '2020-06-21 12:47:16'),
(89, 7, 1, 58, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:48:42', '2020-06-21 12:48:42'),
(90, 7, 2, 58, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:48:42', '2020-06-21 12:48:42'),
(91, 7, 4, 58, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:48:43', '2020-06-21 12:48:43'),
(92, 7, 5, 58, '1', '0', 'new order', 'طلب جديد', '2020-06-21 12:48:43', '2020-06-21 12:48:43'),
(94, 7, 1, 58, '1', '0', 'hussein Accepted Your Offer', 'قام hussein بالموافقة على عرضك ', '2020-06-21 12:49:22', '2020-06-21 12:49:22'),
(95, 10, 1, 59, '1', '0', 'new order', 'طلب جديد', '2020-06-23 10:41:32', '2020-06-23 10:41:32'),
(96, 10, 2, 59, '1', '0', 'new order', 'طلب جديد', '2020-06-23 10:41:33', '2020-06-23 10:41:33'),
(97, 10, 4, 59, '1', '0', 'new order', 'طلب جديد', '2020-06-23 10:41:33', '2020-06-23 10:41:33'),
(98, 10, 5, 59, '1', '0', 'new order', 'طلب جديد', '2020-06-23 10:41:33', '2020-06-23 10:41:33'),
(100, 10, 6, 59, '1', '0', 'Aya Client 5 Accepted Your Offer', 'قام Aya Client 5 بالموافقة على عرضك ', '2020-06-25 19:54:52', '2020-06-25 19:54:52'),
(101, 10, 1, 60, '1', '0', 'new order', 'طلب جديد', '2020-06-26 16:49:21', '2020-06-26 16:49:21'),
(102, 10, 2, 60, '1', '0', 'new order', 'طلب جديد', '2020-06-26 16:49:21', '2020-06-26 16:49:21'),
(103, 10, 4, 60, '1', '0', 'new order', 'طلب جديد', '2020-06-26 16:49:21', '2020-06-26 16:49:21'),
(104, 10, 5, 60, '1', '0', 'new order', 'طلب جديد', '2020-06-26 16:49:21', '2020-06-26 16:49:21'),
(105, 10, 1, 61, '1', '0', 'new order', 'طلب جديد', '2020-06-28 17:23:41', '2020-06-28 17:23:41'),
(106, 10, 2, 61, '1', '0', 'new order', 'طلب جديد', '2020-06-28 17:23:41', '2020-06-28 17:23:41'),
(107, 10, 4, 61, '1', '0', 'new order', 'طلب جديد', '2020-06-28 17:23:41', '2020-06-28 17:23:41'),
(108, 10, 5, 61, '1', '0', 'new order', 'طلب جديد', '2020-06-28 17:23:41', '2020-06-28 17:23:41'),
(109, 10, 3, 62, '1', '0', 'new order', 'طلب جديد', '2020-06-28 18:59:12', '2020-06-28 18:59:12'),
(110, 10, 6, 62, '1', '0', 'new order', 'طلب جديد', '2020-06-28 18:59:12', '2020-06-28 18:59:12'),
(111, 10, 3, 63, '1', '0', 'new order', 'طلب جديد', '2020-06-28 19:00:01', '2020-06-28 19:00:01'),
(112, 10, 6, 63, '1', '0', 'new order', 'طلب جديد', '2020-06-28 19:00:01', '2020-06-28 19:00:01'),
(114, 10, 1, 64, '1', '0', 'new order', 'طلب جديد', '2020-06-29 16:18:49', '2020-06-29 16:18:49'),
(115, 10, 2, 64, '1', '0', 'new order', 'طلب جديد', '2020-06-29 16:18:49', '2020-06-29 16:18:49'),
(116, 10, 4, 64, '1', '0', 'new order', 'طلب جديد', '2020-06-29 16:18:49', '2020-06-29 16:18:49'),
(117, 10, 5, 64, '1', '0', 'new order', 'طلب جديد', '2020-06-29 16:18:49', '2020-06-29 16:18:49'),
(118, 10, 3, 65, '1', '0', 'new order', 'طلب جديد', '2020-06-29 16:19:36', '2020-06-29 16:19:36'),
(119, 10, 6, 65, '1', '0', 'new order', 'طلب جديد', '2020-06-29 16:19:36', '2020-06-29 16:19:36'),
(120, 10, 1, 60, '1', '0', 'Aya Client 5 Accepted Your Offer', 'قام Aya Client 5 بالموافقة على عرضك ', '2020-06-29 16:28:02', '2020-06-29 16:28:02'),
(122, 10, 6, 65, '1', '0', 'Aya Client 5 Accepted Your Offer', 'قام Aya Client 5 بالموافقة على عرضك ', '2020-06-29 17:02:15', '2020-06-29 17:02:15'),
(123, 10, 1, 66, '1', '0', 'new order', 'طلب جديد', '2020-06-29 17:12:51', '2020-06-29 17:12:51'),
(124, 10, 2, 66, '1', '0', 'new order', 'طلب جديد', '2020-06-29 17:12:51', '2020-06-29 17:12:51'),
(125, 10, 4, 66, '1', '0', 'new order', 'طلب جديد', '2020-06-29 17:12:51', '2020-06-29 17:12:51'),
(126, 10, 5, 66, '1', '0', 'new order', 'طلب جديد', '2020-06-29 17:12:51', '2020-06-29 17:12:51'),
(128, 10, 6, 66, '1', '0', 'Aya Client 5 Accepted Your Offer', 'قام Aya Client 5 بالموافقة على عرضك ', '2020-06-29 19:02:01', '2020-06-29 19:02:01'),
(129, 10, 1, 67, '1', '0', 'new order', 'طلب جديد', '2020-06-29 20:35:04', '2020-06-29 20:35:04'),
(130, 10, 2, 67, '1', '0', 'new order', 'طلب جديد', '2020-06-29 20:35:04', '2020-06-29 20:35:04'),
(131, 10, 4, 67, '1', '0', 'new order', 'طلب جديد', '2020-06-29 20:35:04', '2020-06-29 20:35:04'),
(132, 10, 5, 67, '1', '0', 'new order', 'طلب جديد', '2020-06-29 20:35:04', '2020-06-29 20:35:04'),
(134, 10, 6, 67, '1', '0', 'Aya Client 5 Accepted Your Offer', 'قام Aya Client 5 بالموافقة على عرضك ', '2020-06-29 20:35:28', '2020-06-29 20:35:28'),
(135, 10, 6, 67, '0', '0', 'Aya Driver Order Status Has Been Changed', ' Aya Driver تم تغيير حالة الطلب', '2020-06-29 20:39:38', '2020-06-29 20:39:38'),
(136, 10, 1, 60, '1', '0', 'Aya Client 5 Order Status Has Been Changed', ' Aya Client 5 تم تغيير حالة الطلب', '2020-06-30 17:33:15', '2020-06-30 17:33:15'),
(137, 10, 6, 66, '1', '0', 'Aya Client 5 Order Status Has Been Changed', ' Aya Client 5 تم تغيير حالة الطلب', '2020-06-30 18:30:03', '2020-06-30 18:30:03'),
(138, 10, 6, 65, '1', '0', 'Aya Client 5 Order Status Has Been Changed', ' Aya Client 5 تم تغيير حالة الطلب', '2020-06-30 18:31:13', '2020-06-30 18:31:13');

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
(4, 3, 40, 1, '1', '2020-06-16 09:29:56', '2020-06-16 16:01:12'),
(5, 4, 43, 1, '1', '2020-06-16 11:12:39', '2020-06-16 14:17:06'),
(6, 4, 44, 1, '0', '2020-06-16 13:08:39', '2020-06-16 13:08:39'),
(7, 3, 50, 1, '1', '2020-06-17 12:43:05', '2020-06-17 14:16:37'),
(8, 3, 51, 1, '1', '2020-06-17 15:23:16', '2020-06-17 15:34:39'),
(9, 3, 52, 1, '1', '2020-06-17 16:43:47', '2020-06-17 16:47:09'),
(10, 3, 53, 1, '1', '2020-06-17 16:51:43', '2020-06-17 16:52:07'),
(11, 7, 58, 1, '0', '2020-06-21 12:49:22', '2020-06-21 12:49:22'),
(12, 10, 59, 6, '0', '2020-06-25 19:54:52', '2020-06-25 19:54:52'),
(13, 10, 60, 1, '1', '2020-06-29 16:28:03', '2020-06-30 17:33:15'),
(14, 10, 65, 6, '1', '2020-06-29 17:02:15', '2020-06-30 18:31:13'),
(15, 10, 66, 6, '1', '2020-06-29 19:02:01', '2020-06-30 18:30:03'),
(16, 10, 67, 6, '1', '2020-06-29 20:35:28', '2020-06-29 20:39:38');

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
(16, 5, 4, 'test', '1', '0', '0', '2020-06-16 11:13:01', '2020-06-16 11:13:01'),
(17, 5, 4, 'test 2', '1', '0', '0', '2020-06-16 11:36:25', '2020-06-16 11:36:25'),
(18, 5, 4, 'm', '1', '0', '0', '2020-06-16 11:38:46', '2020-06-16 11:38:46'),
(19, 5, 4, '57e0e2429f48560bfc865a7e7624b939.jpeg', '2', '0', '0', '2020-06-16 12:24:08', '2020-06-16 12:24:08'),
(20, 4, 3, '1', '1', '0', '0', '2020-06-16 15:58:07', '2020-06-16 15:58:07'),
(21, 6, 1, 't', '1', '0', '1', '2020-06-17 08:57:05', '2020-06-17 08:57:05'),
(22, 5, 1, 'test mess saaa user', '1', '0', '1', '2020-06-17 10:12:00', '2020-06-17 10:12:00'),
(23, 7, 1, 'test', '1', '0', '1', '2020-06-17 12:48:05', '2020-06-17 12:48:05'),
(24, 7, 3, 'test 2', '1', '0', '0', '2020-06-17 12:48:43', '2020-06-17 12:48:43'),
(25, 7, 1, 'd699d603b0017d04dca0fe2dbce3f8a9.jpeg', '2', '0', '1', '2020-06-17 12:53:12', '2020-06-17 12:53:12'),
(26, 7, 1, 't', '1', '0', '1', '2020-06-17 12:55:43', '2020-06-17 12:55:43'),
(27, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 12:57:46', '2020-06-17 12:57:46'),
(28, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 12:58:35', '2020-06-17 12:58:35'),
(29, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 13:01:03', '2020-06-17 13:01:03'),
(30, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 13:12:49', '2020-06-17 13:12:49'),
(31, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 13:13:46', '2020-06-17 13:13:46'),
(32, 7, 3, 'y', '1', '0', '0', '2020-06-17 13:15:25', '2020-06-17 13:15:25'),
(33, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 13:22:13', '2020-06-17 13:22:13'),
(34, 7, 1, 'test postman', '1', '0', '1', '2020-06-17 13:24:06', '2020-06-17 13:24:06'),
(35, 7, 1, 'test postman 2', '1', '0', '1', '2020-06-17 13:38:21', '2020-06-17 13:38:21'),
(36, 7, 1, 'test postman 3', '1', '0', '1', '2020-06-17 13:41:16', '2020-06-17 13:41:16'),
(37, 7, 1, 'test postman 4', '1', '0', '1', '2020-06-17 13:43:24', '2020-06-17 13:43:24'),
(38, 7, 3, 'h', '1', '0', '0', '2020-06-17 13:44:38', '2020-06-17 13:44:38'),
(39, 7, 3, 'test postman 4', '1', '0', '0', '2020-06-17 13:48:07', '2020-06-17 13:48:07'),
(40, 7, 3, 'test postman 4', '1', '0', '0', '2020-06-17 13:51:38', '2020-06-17 13:51:38'),
(41, 7, 3, 'test postman 4', '1', '0', '0', '2020-06-17 13:52:32', '2020-06-17 13:52:32'),
(42, 7, 1, 'test postman 4', '1', '0', '1', '2020-06-17 13:53:16', '2020-06-17 13:53:16'),
(43, 7, 1, 'test postman 4', '1', '0', '1', '2020-06-17 14:06:12', '2020-06-17 14:06:12'),
(44, 7, 3, 'test postman 4', '1', '0', '0', '2020-06-17 14:07:03', '2020-06-17 14:07:03'),
(45, 7, 1, 'test postman 4', '1', '0', '1', '2020-06-17 14:10:25', '2020-06-17 14:10:25'),
(46, 8, 1, 'h', '1', '0', '1', '2020-06-17 15:25:43', '2020-06-17 15:25:43'),
(47, 8, 3, 'y', '1', '0', '0', '2020-06-17 15:26:23', '2020-06-17 15:26:23'),
(48, 9, 3, 'ت', '1', '0', '0', '2020-06-17 16:43:52', '2020-06-17 16:43:52'),
(49, 10, 3, 'ت', '1', '0', '0', '2020-06-17 16:51:46', '2020-06-17 16:51:46'),
(50, 13, 10, 'السلام عليكم', '1', '0', '0', '2020-06-29 17:14:02', '2020-06-29 17:14:02'),
(51, 15, 6, 'السلام عليكم', '1', '0', '1', '2020-06-29 19:02:50', '2020-06-29 19:02:50'),
(52, 15, 6, '997b4a6033b9d56baeb7958416ce85dd.jpeg', '2', '0', '1', '2020-06-29 19:03:12', '2020-06-29 19:03:12'),
(53, 15, 6, 'اهلا', '1', '0', '1', '2020-06-29 19:03:20', '2020-06-29 19:03:20'),
(54, 15, 6, 'tesy', '1', '0', '1', '2020-06-29 19:03:26', '2020-06-29 19:03:26'),
(55, 15, 6, 'test', '1', '0', '1', '2020-06-29 19:03:31', '2020-06-29 19:03:31'),
(56, 16, 10, 'السلام عليكم', '1', '0', '0', '2020-06-29 20:38:30', '2020-06-29 20:38:30'),
(57, 16, 10, 'a77e93d6a3784be8c5dd7247212fa9e6.jpeg', '2', '0', '0', '2020-06-29 20:38:51', '2020-06-29 20:38:51'),
(58, 15, 10, 'bvv', '1', '0', '0', '2020-06-29 21:40:18', '2020-06-29 21:40:18'),
(59, 15, 10, 'hi', '1', '0', '0', '2020-06-30 14:51:08', '2020-06-30 14:51:08'),
(60, 15, 10, 'dffc4ba06dcb2512410bfc06cc3ea534.png', '2', '0', '0', '2020-06-30 15:05:09', '2020-06-30 15:05:09'),
(61, 15, 10, 'bd4364df7dbe3c6f56df1eb34a93bddd.png', '2', '0', '0', '2020-06-30 15:13:07', '2020-06-30 15:13:07'),
(62, 15, 10, 'hello', '1', '0', '0', '2020-06-30 15:13:34', '2020-06-30 15:13:34');

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
(1, 'IY84YMe7k4', 150, 1, '2020-06-02 16:06:17', '2020-06-02 16:06:39'),
(3, 'IY84YM555e7k4', 150, 0, '2020-06-02 16:06:17', '2020-06-03 13:54:26'),
(4, 'ucACqiFSDZ', 1000, 0, '2020-06-23 12:20:24', '2020-06-23 12:23:42');

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
(5, 'app_setting', 'terms', 'terms and conditions', 'الشروط والاحكام', '2020-06-02 12:55:20', '2020-06-02 13:10:54'),
(6, 'app_setting', 'rate_percent', '6', '6', '2020-06-02 12:55:20', '2020-06-15 14:29:16');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `notification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `verified` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `password`, `image`, `rate`, `reset_password_code`, `code_expiration`, `fcm_token`, `status`, `notification`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'husssein', '0505330609', 'husssein@gmail.com', '$2y$10$ezMMzJwON0XlgQreNm9ReeX2e4LG7sW2VNcyXr8RQABljNkOvW0K.', '0908cf4688431b059adcc9f2a3d916df.jpg', '0', '55555', '2020-02-05 16:32:49', '9999', '1', '0', '1', '2020-01-28 05:51:31', '2020-06-30 20:05:55'),
(2, '2mahmoud', '0505330608', 'mah@moud.com', '$2y$10$5j.59zGMhQb73jB0Re7Bk.7c81iOtqtIChcGULJur4PHIqxAF.38.', '0908cf4688431b059adcc9f2a3d916df.jpg', '0', '55555', '2020-01-28 14:59:15', NULL, '1', '1', '1', '2020-01-28 11:42:06', '2020-02-05 11:49:02'),
(3, 'Mah moud', '0505330606', 'Mah@moud.com', '$2y$10$RqsXknf5daZ/WKsYvcO.PuktBWIb/wZoxyuu7/qWXDW0L0leJktvK', '0908cf4688431b059adcc9f2a3d916df.jpg', '0', NULL, NULL, 'cZwjarLDaP4:APA91bHQWa7G8l5bn1FbVQ85RBiiP_rE1eOPtp-UGzMGv_qk2mbKa1n-mge_wE5ef927R9hm3yZaPajMLU6y6rU5hK80aiNayjBVOsejnp8Ar1X-CXHAvyNtkzLz-9jB0-Gnnjbl_4yx', '1', '1', '1', '2020-06-01 08:10:39', '2020-06-15 13:43:46'),
(4, 'mahmoud2', '0505330601', 'mah@moud.com', '$2y$10$1KAweemq77QhKQnv/CWYh.JxY/0pDNrXUUkTTLPH1S0DEzTtjbe1a', '3ece5dddf8dd7d424dc635fb3725b6ee.jpeg', '0', NULL, NULL, 'foM8p16VbCI:APA91bHwLhuhlQe1YNFePFHPRFFK8j_X7SYu4C5bkgjVCH8aqnWOAfreGC32kJXEguVjhIiFIHbOV5HgnzJoh8x_tdHq8OVbZWZo-Ai0_UaZotk_dMjjjqeBSJHwy4CMbV663YjUFhiR', '1', '1', '1', '2020-06-16 10:08:42', '2020-06-28 19:32:19'),
(5, 'Rashed', '561234567', 'user1@domain.com', '$2y$10$z9ckb20i7onjGdcoAuFbG.SGislu2ugH3N/ghMpfKjx0ykrlp7KnC', NULL, '0', NULL, NULL, NULL, '1', '1', '1', '2020-06-18 11:08:54', '2020-06-21 09:27:36'),
(6, 'hussein', '0505330605', 'user@user.com', '$2y$10$lKmXdr6sgba6HeALPezQnuS3fFCS/J2bQ2aCPfYMpYyeDnE4RApXW', NULL, '0', NULL, NULL, 'f8Cg3c_O4rk:APA91bHw43iSowpcRa65JQ50G3DLF-xwkIPNmM1GBYpljWp82JF3k_1pv2ku4um0P_XB4DAEBOgdC06cJX35KrENS9Gnm8dPdFsBSNJYg9NRcgG1aIP0Tekurog82ylNJr366Yk5yJN6', '1', '1', '1', '2020-06-21 09:25:15', '2020-06-21 12:28:24'),
(7, 'hussein', '0505330604', 'user@user.com', '$2y$10$gFbz9NasTMWkGbiPzDD6WuL4L44c0mGXGw0kwN7Oqk4U0s1ei3o.O', NULL, '0', '55555', '2020-06-22 15:43:50', 'f8Cg3c_O4rk:APA91bHw43iSowpcRa65JQ50G3DLF-xwkIPNmM1GBYpljWp82JF3k_1pv2ku4um0P_XB4DAEBOgdC06cJX35KrENS9Gnm8dPdFsBSNJYg9NRcgG1aIP0Tekurog82ylNJr366Yk5yJN6', '1', '1', '1', '2020-06-21 09:27:00', '2020-06-22 13:38:50'),
(8, 'Aya client', '0500000000', 'aya@yahoo.com', '$2y$10$cz99Mi904WJv55yBwDmYHeXpr9.OTgHdSrkRr1tSoSDx.29a3/1ha', NULL, '0', NULL, NULL, 'f8Cg3c_O4rk:APA91bHw43iSowpcRa65JQ50G3DLF-xwkIPNmM1GBYpljWp82JF3k_1pv2ku4um0P_XB4DAEBOgdC06cJX35KrENS9Gnm8dPdFsBSNJYg9NRcgG1aIP0Tekurog82ylNJr366Yk5yJN6', '1', '1', '1', '2020-06-21 12:28:06', '2020-06-22 10:12:31'),
(9, 'test', '0506666666', 'hshsg@hsgs.jd', '$2y$10$1SfAQhj0MoYm.re.OsRJz.Ofj4QtMEjkxU/CaOXWom1YWvQj1.1fi', NULL, '0', NULL, NULL, NULL, '1', '1', '1', '2020-06-22 11:09:20', '2020-06-22 11:29:53'),
(10, 'Aya Client 5', '0505555555', 'user@user.com', '$2y$10$mIuLBXXHKx5X3xPu/k7.K.fbr4STyG3Egt3hNhJAi.OUTOAc5tP9q', '5d666bc4f03f56b7de2c24f7e7a33f83.png', '1', '55555', '2020-06-22 16:11:17', 'eYf4qcJNPiU:APA91bEucG8s5pbb5cQHJy-Wpj2N4RqHUG8HjIm0nNaZJgBD0Kd0_pFNrUimUMeAnpuEQVn1NbgTP39soMmiMoDS92HDx7BZJpxIBCeo2VFaVJqUZd4JPeQxlRt_g2KjmxVBibpC9ybl', '1', '1', '1', '2020-06-22 11:10:44', '2020-06-30 20:05:15'),
(11, 'ayatest1', '0505555554', 'user@user.com', '$2y$10$QintbtYbZx.X2K4W2A/bA.Kb/vijuyWML4X8.WGJhL0yglHy8c1U.', NULL, '0', NULL, NULL, NULL, '1', '1', '1', '2020-06-22 12:11:24', '2020-06-22 12:29:05'),
(12, 'ayatest2', '0504444444', 'hahsh@hdh.jd', '$2y$10$rv2Qk4V4ZJ4MpqXWHrWEKO4oq7y4bFnwUYN0Kyx0/lKys5QoExRsa', NULL, '0', NULL, NULL, NULL, '1', '1', '55555', '2020-06-22 12:22:08', '2020-06-22 12:22:08'),
(13, 'hdhdh', '0505454545', 'hdhd@jdh.hd', '$2y$10$Z6NIK95xnDIVJY2KuQOM/eGdbDu8uxOzjUKb7g0bP1EI402lJU2t2', NULL, '0', NULL, NULL, NULL, '1', '1', '55555', '2020-06-22 12:29:01', '2020-06-22 12:29:01');

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
(7, 1, '35.12', '45.4', '2020-03-19 10:48:55', '2020-03-19 10:48:55'),
(8, 7, '30.317989676450964', '31.216387040913105', '2020-06-21 12:34:20', '2020-06-21 12:34:20'),
(9, 10, '30.33618602305134', '31.342395879328254', '2020-06-28 22:28:58', '2020-06-28 22:28:58'),
(10, 10, '30.14858369324696', '31.309240758419037', '2020-06-30 15:33:58', '2020-06-30 15:33:58'),
(11, 10, '30.09199386462386', '31.26603293390762', '2020-06-30 15:38:54', '2020-06-30 15:38:54');

-- --------------------------------------------------------

--
-- بنية الجدول `user_rates`
--

CREATE TABLE `user_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `rate` double(8,2) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user_rates`
--

INSERT INTO `user_rates` (`id`, `order_id`, `user_id`, `driver_id`, `rate`, `review`, `created_at`, `updated_at`) VALUES
(2, 43, 1, 1, 4.00, 'it was awesome', '2020-06-18 08:51:03', '2020-06-18 08:51:03');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deliver_requests`
--
ALTER TABLE `deliver_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `driver_rates`
--
ALTER TABLE `driver_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_cancel_reason`
--
ALTER TABLE `order_cancel_reason`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_notifications`
--
ALTER TABLE `order_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_messages`
--
ALTER TABLE `room_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `salecodes`
--
ALTER TABLE `salecodes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_places`
--
ALTER TABLE `user_places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_rates`
--
ALTER TABLE `user_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `order_notifications_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `order_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
