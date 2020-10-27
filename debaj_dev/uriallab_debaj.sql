-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 02 يوليو 2020 الساعة 11:36
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
-- Database: `uriallab_debaj`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_password_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `reset_password_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$aZvVFLvPmEvUQtZNTPVjJ.oTp.m2A5Ka3jdT9uaI012C2UpCj8IM6', NULL, '8iF0srOJtGyJQJDq4m6zeSsmPd3Ocb7OWf5wqzqONmAGwERerlwm7jtaor3f', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `ads_slider`
--

CREATE TABLE `ads_slider` (
  `id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text_ar` varchar(255) DEFAULT NULL,
  `text_en` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '  1 active  ,0 inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `ads_slider`
--

INSERT INTO `ads_slider` (`id`, `image`, `text_ar`, `text_en`, `link`, `status`, `created_at`, `updated_at`) VALUES
(5, '5581850d85781f0746145014f06bb1d8.jpg', NULL, NULL, NULL, '1', '2020-05-31 07:54:35', '2020-05-31 07:54:35'),
(6, '55ca7b6f7d64316fe26e9d73819c57cc.jpg', NULL, NULL, NULL, '1', '2020-05-31 07:56:11', '2020-05-31 07:56:11'),
(7, '80e279a4b099b6ca2133ec838fefaadf.jpg', NULL, NULL, NULL, '1', '2020-05-31 07:56:42', '2020-05-31 07:56:42'),
(8, 'f7339d30236e774123fd70b29d5f1199.jpg', NULL, NULL, NULL, '1', '2020-05-31 07:57:02', '2020-05-31 07:57:02');

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` float NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `title_ar`, `title_en`, `tags_ar`, `tags_en`, `image`, `is_home`, `created_at`, `updated_at`) VALUES
(7, 'اثاث', 'furniture', 'اثاث', 'furniture', '61014241830dd7609ac71dd8460e8153.png', 1, '2020-03-15 09:53:45', '2020-04-06 13:10:43'),
(8, 'كراسي', 'Chairs', 'كراسي,كرسي', 'Chairs,Chair', '61014241830dd7609ac71dd8460e8153.png', 0, '2020-03-15 11:13:34', '2020-04-03 20:08:41'),
(9, 'ترابيزات', 'Tables', 'ترابيزات,تربيزه', 'Tables,Table', '9585f0324da000110a3b345cf04664fe.jpg', 0, '2020-04-03 20:12:08', '2020-04-03 20:12:08'),
(15, 'ترابيزات2', 'Tables2', 'ترابيزات,تربيزه', 'Tables,Table', '1.png', 1, '2020-04-03 20:12:08', '2020-04-06 13:10:35'),
(16, 'كراسي2', 'Chairs2', 'كراسي,كرسي', 'Chairs,Chair', '61014241830dd7609ac71dd8460e8153.png', 0, '2020-03-15 11:13:34', '2020-04-03 20:08:41'),
(17, 'اثاث2', 'furniture2', 'اثاث', 'furniture', '2b21b61582620c7cc12698aa75296fa1.jpg', 0, '2020-03-15 09:53:45', '2020-03-15 11:13:59'),
(18, 'ترابيزات4', 'Tables4', 'ترابيزات,تربيزه', 'Tables,Table', '9585f0324da000110a3b345cf04664fe.jpg', 0, '2020-04-03 20:12:08', '2020-04-03 20:12:08'),
(19, 'اثاث3', 'furniture3', 'اثاث', 'furniture', 'ec519b8d2fd2c095fa908b19b30a71a8.png', 1, '2020-03-15 09:53:45', '2020-04-06 13:10:23');

-- --------------------------------------------------------

--
-- بنية الجدول `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `colors`
--

CREATE TABLE `colors` (
  `id` int(10) NOT NULL,
  `name_ar` varchar(150) NOT NULL,
  `name_en` varchar(150) NOT NULL,
  `code` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `colors`
--

INSERT INTO `colors` (`id`, `name_ar`, `name_en`, `code`, `created_at`, `updated_at`) VALUES
(1, 'أحمر', 'Red', '#e44343', '2020-04-04 21:28:13', '2020-04-26 23:06:37'),
(2, 'أصفر', 'Yellow', '#f1d90c', '2020-04-04 21:39:13', '2020-04-26 23:06:00'),
(3, 'أسود', 'Black', '#000000', '2020-04-04 21:44:11', '2020-04-04 21:44:11'),
(4, 'أزرق', 'blue', '#14a1d6', '2020-04-06 16:59:53', '2020-04-26 23:07:10'),
(5, 'رمادي', 'gray', '#c0c0c0', '2020-04-06 17:00:32', '2020-04-06 17:00:32');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_data`
--

CREATE TABLE `contact_data` (
  `id` int(10) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `adress_ar` varchar(255) NOT NULL,
  `adress_en` varchar(255) NOT NULL,
  `map_fram` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `contact_data`
--

INSERT INTO `contact_data` (`id`, `mobile`, `tel`, `mail`, `adress_ar`, `adress_en`, `map_fram`, `created_at`, `updated_at`) VALUES
(1, '02223987727', '022889936', 'samaa.milano@yahoo.com', '22 شارع العبور - حلوان - القاهره -مصر', '22 El-Obour Street - Helwan - Cairo - Egypt', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d27683.44736399595!2d31.3025001!3d29.851844!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x521084edc1f78b38!2sTelecom%20Egypt%20-%20Helwan%20Central!5e0!3m2!1sen!2seg!4v1586893499905!5m2!1sen!2seg\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', '2020-03-16 11:58:16', '2020-04-14 17:45:15');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_us`
--

INSERT INTO `contact_us` (`id`, `title`, `name`, `mail`, `message`, `created_at`, `updated_at`) VALUES
(17, 'رسالة تواصل معانا', 'samaa sameh', 'test@test.com', 'test meaakkkk', '2020-05-05 03:38:38', '2020-05-05 03:38:38');

-- --------------------------------------------------------

--
-- بنية الجدول `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `faq`
--

INSERT INTO `faq` (`id`, `question_en`, `question_ar`, `answer_en`, `answer_ar`, `created_at`, `updated_at`) VALUES
(5, 'How do I place an order?', 'كيف يمكنني وضع النظام؟', 'Click on a Product Photo or Product Name to see more detailed information. To place your order, choose the specification you want and enter the quantity, and click ‘Buy Now’.\r\n\r\n', 'خذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبش\r\nخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار م', '2020-03-15 12:44:05', '2020-04-14 16:36:04'),
(6, 'What payment methods are accepted?', 'ما هي طرق الدفع المقبولة؟', 'Click on a Product Photo or Product Name to see more detailed information. To place your order, choose the specification you want and enter the quantity, and click ‘Buy Now’.\r\n\r\nPlease enter the required information such as Delivery Address, Quantity Type', 'خذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبش\r\nخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار م\r\nخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبش\r\nخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار م', '2020-03-15 12:44:05', '2020-04-14 16:36:56');

-- --------------------------------------------------------

--
-- بنية الجدول `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_23_122007_create_admins_table', 1),
(4, '2019_12_23_122131_create_ads_table', 1),
(5, '2019_12_23_122139_create_categories_table', 1),
(6, '2019_12_23_124055_create_cities_table', 1),
(7, '2019_12_23_124115_create_plans_table', 1),
(8, '2019_12_23_124133_create_vendor_plans_table', 1),
(9, '2019_12_23_124151_create_favorites_table', 1),
(10, '2019_12_23_124205_create_notifications_table', 1),
(12, '2019_12_23_124233_create_attaches_table', 1),
(13, '2019_12_24_131730_create_rates_table', 1),
(14, '2019_12_23_122053_create_vendor_details_table', 2),
(15, '2019_12_23_124223_create_rooms_table', 3),
(17, '2019_12_31_092744_create_room_messages_table', 4),
(18, '2019_11_13_124801_create_contact_us_table', 5),
(19, '2019_11_11_144412_create_faq_table', 6),
(20, '2019_10_31_110627_create_settings_table', 7),
(21, '2020_03_25_121110_create_products_table', 8),
(22, '2020_03_26_121126_create_product_images_table', 9);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `body_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '0:new,1:confirmed,2:inshipping,3:done,4:canceled',
  `new_ship_adress` text DEFAULT NULL,
  `salecode` varchar(255) DEFAULT NULL,
  `salecode_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `new_ship_adress`, `salecode`, `salecode_value`, `created_at`, `updated_at`) VALUES
(2, 12, 0, '13 شارع منصور حلوان', NULL, NULL, '2020-04-22 18:27:28', '2020-04-23 02:04:03'),
(3, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-04-22 18:30:08', '2020-04-23 02:01:11'),
(4, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-04-22 21:38:15', '2020-04-23 02:01:16'),
(5, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-04-23 20:42:20', '2020-04-23 20:42:20'),
(6, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-04-23 21:02:44', '2020-04-23 21:02:44'),
(7, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-05-04 18:52:32', '2020-05-04 18:52:32'),
(8, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-05-04 18:54:06', '2020-05-04 18:54:06'),
(9, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-05-04 21:06:29', '2020-05-04 21:06:29'),
(10, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-05-04 21:09:48', '2020-05-04 21:09:48'),
(11, 12, 0, 'سيد جندي حلوان', 'pMXVJXR9n2', '50', '2020-05-04 21:29:59', '2020-05-04 21:29:59'),
(12, 12, 0, 'سيد جندي حلوان', 'HCF8kWhVMg', '20', '2020-05-04 21:38:39', '2020-05-04 21:38:39'),
(15, 12, 0, 'سيد جندي حلوان', NULL, NULL, '2020-05-08 01:26:23', '2020-05-08 01:26:23');

-- --------------------------------------------------------

--
-- بنية الجدول `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(10) NOT NULL,
  `orders_id` int(10) DEFAULT NULL,
  `pro_id` int(10) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `size_num` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `price_befor_sale` varchar(50) DEFAULT NULL,
  `sale_percent` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `order_item_status` int(11) DEFAULT 0 COMMENT '0:new,1:confirmed,2:inshipping,3:done,4:canceled',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `orders_details`
--

INSERT INTO `orders_details` (`id`, `orders_id`, `pro_id`, `name_ar`, `name_en`, `quantity`, `size_num`, `price`, `price_befor_sale`, `sale_percent`, `photo`, `color`, `size`, `order_item_status`, `created_at`, `updated_at`) VALUES
(3, 2, 6, '1اسم المنتج العربى', NULL, 1, '6.5', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', NULL, NULL, 1, '2020-04-22 18:27:28', '2020-05-08 02:57:02'),
(4, 3, 6, '1اسم المنتج العربى', 'Lorem Ipsum 1', 4, '3.4', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', NULL, NULL, 0, '2020-04-22 18:30:08', '2020-05-08 03:41:12'),
(5, 4, 6, '1اسم المنتج العربى', 'Lorem Ipsum 1', 1, '3.4', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', NULL, NULL, 2, '2020-04-22 21:38:15', '2020-05-08 02:58:04'),
(7, 2, 11, '1اسم المنتج العربى', NULL, 1, '0.5', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', NULL, NULL, 1, '2020-04-22 18:27:28', '2020-05-08 02:57:03'),
(8, 5, 6, '1اسم المنتج العربى', 'Lorem Ipsum 1', 1, '6.5', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', NULL, NULL, 1, '2020-04-23 20:42:21', '2020-05-08 03:11:35'),
(9, 5, 4, 'اسم المنتج العربى2', 'Lorem Ipsum 2\r\n', 1, '0.5', ' 30.00', NULL, NULL, '1585825402.Bubbles-Lumppini-Fotolia-1080x675.jpg', NULL, NULL, 1, '2020-04-23 20:42:21', '2020-05-08 03:11:36'),
(10, 6, 6, '1اسم المنتج العربى', 'Lorem Ipsum 1', 2, '6.5', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', '#ff0000', 's', 3, '2020-04-23 21:02:44', '2020-05-08 02:58:20'),
(11, 6, 4, 'اسم المنتج العربى2', 'Lorem Ipsum 2\r\n', 1, '0.5', ' 30.00', NULL, NULL, '1585825402.Bubbles-Lumppini-Fotolia-1080x675.jpg', NULL, NULL, 3, '2020-04-23 21:02:44', '2020-05-08 02:58:21'),
(12, 7, 3, 'ا سم المنتج العربى  فندور', 'Lorem Ipsum', 2, '0.5', '22.5', '25', '10', '1586300032.p13.jpg', NULL, NULL, 0, '2020-05-04 18:52:32', '2020-05-08 03:41:03'),
(13, 8, 4, 'اسم المنتج العربى2', 'Lorem Ipsum 2\r\n', 1, '3.4', ' 30.00', NULL, NULL, '1585825402.Bubbles-Lumppini-Fotolia-1080x675.jpg', NULL, NULL, 0, '2020-05-04 18:54:06', '2020-05-08 03:41:11'),
(14, 9, 3, 'ا سم المنتج العربى  فندور', 'Lorem Ipsum', 1, '6.5', '22.5', '25', '10', '1586300032.p13.jpg', NULL, NULL, 0, '2020-05-04 21:06:29', '2020-05-08 03:41:40'),
(15, 10, 3, 'ا سم المنتج العربى  فندور', 'Lorem Ipsum', 1, '0.5', '22.5', '25', '10', '1586300032.p13.jpg', NULL, NULL, 0, '2020-05-04 21:09:48', '2020-05-08 03:41:02'),
(16, 11, 3, 'ا سم المنتج العربى  فندور', 'Lorem Ipsum', 1, '3.4', '22.5', '25', '10', '1586300032.p13.jpg', NULL, NULL, 0, '2020-05-04 21:29:59', '2020-05-08 03:41:10'),
(17, 12, 6, '1اسم المنتج العربى', 'Lorem Ipsum 1', 1, '0.5', ' 90.00', NULL, NULL, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', NULL, NULL, 0, '2020-05-04 21:38:39', '2020-05-08 03:40:59'),
(18, 15, 3, 'ا سم المنتج العربى  فندور', 'Lorem Ipsum', 1, '3.4', '22.5', '25', '10', '1586300032.p13.jpg', NULL, NULL, 0, '2020-05-08 01:26:23', '2020-05-08 01:26:23');

-- --------------------------------------------------------

--
-- بنية الجدول `pages`
--

CREATE TABLE `pages` (
  `id` int(10) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `content_ar` longtext NOT NULL,
  `content_en` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `pages`
--

INSERT INTO `pages` (`id`, `title_en`, `title_ar`, `content_ar`, `content_en`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'من نحن', '<p><strong>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال &quot;lorem ipsum&quot; في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.ss</strong></p>', '<p><strong>Lsssorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</strong></p>', '2020-03-17 09:59:19', '2020-05-05 02:58:18'),
(2, 'Terms and Conditions', 'الشروط والاحكام', '<p><strong>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال &quot;lorem ipsum&quot; في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.&nbsp;&nbsp;الشروط والاحكام</strong></p>', '<p><strong>Terms and Conditions Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</strong></p>', '2020-03-17 09:59:19', '2020-05-05 03:00:02');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` int(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `vendor_id` int(10) UNSIGNED DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortDetails_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortDetails_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_num` float DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additionalInfo_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additionalInfo_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_percentage` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `category_id`, `admin_id`, `vendor_id`, `main_image`, `name_ar`, `name_en`, `shortDetails_ar`, `shortDetails_en`, `quantity`, `size`, `size_num`, `color`, `ref`, `description_ar`, `description_en`, `additionalInfo_ar`, `additionalInfo_en`, `price`, `sale_percentage`, `created_at`, `updated_at`) VALUES
(3, 9, 0, 4, '1586300032.p13.jpg', 'ا سم المنتج العربى  فندور', 'Lorem Ipsum', '<p>ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد</p>', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop&nbsp;</p>', 88, 'm,l', 6.3, '3,4,5', 'SS155', '<p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال &quot;lorem ipsum&quot; في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيdddبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.</p>', '<p>First Product&nbsp; tesrvg&nbsp; uiuuuu</p>', '<p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال &quot;lorem ipsum&quot; في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحيddddddاناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.</p>', '<p>First Product222</p>', '25', 10, '2020-04-02 07:30:23', '2020-05-04 09:04:35'),
(4, 8, 0, 4, '1585825402.Bubbles-Lumppini-Fotolia-1080x675.jpg', 'اسم المنتج العربى2', 'Lorem Ipsum 2\r\n', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 66, 's,m', 3.4, '1,2', 'sa555', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>xaxzxxxxxaxaaaaaaaa sssssssssssssssssssssssssssssssssssssssssss</p>', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>xxxxxxxxx&nbsp; xxxxxxxxxxxxxxxxxxxxxxxx</p>', ' 30.00', 20, '2020-04-02 09:03:22', '2020-04-02 09:03:22'),
(5, 9, 0, 4, '1585953614.Bubbles-Lumppini-Fotolia-1080x675.jpg', 'اسم المنتج العربى3', 'Lorem Ipsum 3\r\n', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 22, 's,m', 6.3, '1,2', 'ddsds', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>sdsdsd</p>', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>dsdsdsds</p>', ' 70.00', 13, '2020-04-03 20:40:14', '2020-04-03 20:40:14'),
(6, 7, 0, 4, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', '1اسم المنتج العربى', 'Lorem Ipsum 1', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 22, 's,m', 3.4, '1,2', '33', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>ييييييييييييي</p>', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>يييييييييييييي</p>', ' 90.00', 30, '2020-04-03 21:08:46', '2020-04-03 21:08:46'),
(7, 9, 0, 4, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', 'اسم المنتج العربى-4', 'Lorem Ipsum4\r\n', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 33, 's,m', 3.4, '1,2', 'R123', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;testtest prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test</p>', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.\r\n\r\n', '<p>test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;testtest prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test prodecttt&nbsp;&nbsp;test</p>', ' 60.00', 5, '2020-04-04 20:24:55', '2020-04-04 20:31:32'),
(8, 9, 0, 4, '1586176640.1.png', 'اسم المنتج  test', 'test prodeLorem Ipsum4', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 3, 's,m', 6.3, '1,2', 'S122', '<p>test prode</p>', '<p>test prode</p>', '<p>test prode</p>', '<p>test prode</p>', '233', 2, '2020-04-06 10:37:20', '2020-04-06 10:37:21'),
(9, 9, 0, 4, '1586176734.1.png', 'اسم المنتج  test22', 'swasasasaLorem Ipsum4', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 3, 's,m', 3.4, '1,2', 'S152', '<p>test prode</p>', '<p>test prode</p>', '<p>test prode</p>', '<p>test prode</p>', '233', 15, '2020-04-06 10:38:54', '2020-04-06 10:38:54'),
(10, 16, 0, 4, '1586180630.2b21b61582620c7cc12698aa75296fa1.jpg', 'tesssssاسم المنتج  test', 'ssasasaLorem Ipsum4', 'ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد', '<p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu</p>', 22, 's,m', 3.4, '1,2', 'dd66', '<p>ssdd</p>', '<p>dsds</p>', '<p>ddsdsd</p>', '<p>dsdsdsd</p>', '66', 10, '2020-04-06 11:43:50', '2020-04-06 11:43:50'),
(11, 17, NULL, 4, '1587176320.75398323_3577211892289278_5529560709001641984_o.jpg', 'اسم المنتج العربىss', 'sasasasa', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربى</p>', '<p>sasasa dada</p>', 11, 'm,l', 3.4, '1,2,4', 'AA122', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربى</p>', '<p>add sa asassasasasa</p>', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج العربى</p>', '<p>dsdsdd</p>', '33', 0, '2020-04-18 00:18:40', '2020-04-18 00:18:40'),
(12, 17, NULL, 4, '1587176432.river.jpg', 'sasasasa', 'sasasasa', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم sasasالمنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج العربى</p>', '<p>sasasa dadasasasa</p>', 11, 's,m,l,xl', 6.3, '1,2,3,4,5', 'AA142', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج العربىاسم المنتج asasa</p>', '<p>add sa asassasasasaasasasas</p>', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج sasa</p>', '<p>dsdsddsasasa</p>', '44', 0, '2020-04-18 00:20:31', '2020-04-18 00:20:32'),
(13, 16, NULL, 4, '1588489666.1585825402.Bubbles-Lumppini-Fotolia-1080x675.jpg', 'sasa', 'sas', '<p>sasas</p>', '<p>sas</p>', NULL, 's', 6.3, '1', '2222', '<p>sasa</p>', '<p>asa</p>', '<p>saa</p>', '<p>aas</p>', '22', 0, '2020-05-03 05:07:46', '2020-05-03 05:31:38'),
(14, 9, NULL, 4, '1588491247.e219388e1b9feed650d0d682dd04a774.jpg', 'صصص', 'صص', '<p>صص</p>', '<p>صص</p>', NULL, 's', 3.4, '2', 'First 22', '<p>صصص</p>', '<p>صصص</p>', '<p>صصص</p>', '<p>صص</p>', '222', 0, '2020-05-03 05:34:07', '2020-05-03 05:34:07'),
(16, 18, NULL, 4, '1588659783.1.png', 'اسم المنتج العربى', 'ssassa sadad', '<p>اسم المنتج العربىاسم المنتج العربىاسم المنتج العربى</p>', '<p>assasasasas</p>', NULL, NULL, NULL, '1,3', '777', '<p>sasasasasa</p>', '<p>asasas</p>', '<p>sasasa</p>', '<p>asa</p>', '22', NULL, '2020-05-05 04:23:03', '2020-05-05 04:23:03');

-- --------------------------------------------------------

--
-- بنية الجدول `product_images`
--

CREATE TABLE `product_images` (
  `id` int(20) UNSIGNED NOT NULL,
  `product_id` int(20) UNSIGNED NOT NULL,
  `imageName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `imageName`, `created_at`, `updated_at`) VALUES
(46, 4, '1585953614.Bubbles-Lumppini-Fotolia-1080x675.jpg', '2020-04-02 09:03:22', '2020-04-02 09:03:22'),
(47, 4, '1585825402.75398323_3577211892289278_5529560709001641984_o.jpg', '2020-04-02 09:03:22', '2020-04-02 09:03:22'),
(50, 5, '1585953614.Bubbles-Lumppini-Fotolia-1080x675.jpg', '2020-04-03 20:40:14', '2020-04-03 20:40:14'),
(51, 5, '1585953614.flower-landscape-hd-29016-29733-hd-wallpapers.jpg', '2020-04-03 20:40:14', '2020-04-03 20:40:14'),
(52, 6, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', '2020-04-03 21:08:47', '2020-04-03 21:08:47'),
(53, 7, '1586039095.2b21b61582620c7cc12698aa75296fa1.jpg', '2020-04-04 20:24:55', '2020-04-04 20:24:55'),
(54, 7, '1586039095.ec519b8d2fd2c095fa908b19b30a71a8.png', '2020-04-04 20:24:55', '2020-04-04 20:24:55'),
(55, 8, '1586176640.1.png', '2020-04-06 10:37:20', '2020-04-06 10:37:20'),
(56, 8, '1586176641.2b21b61582620c7cc12698aa75296fa1.jpg', '2020-04-06 10:37:21', '2020-04-06 10:37:21'),
(57, 9, '1586176734.1.png', '2020-04-06 10:38:54', '2020-04-06 10:38:54'),
(58, 9, '1586176734.2b21b61582620c7cc12698aa75296fa1.jpg', '2020-04-06 10:38:54', '2020-04-06 10:38:54'),
(59, 10, '1586180630.2b21b61582620c7cc12698aa75296fa1.jpg', '2020-04-06 11:43:50', '2020-04-06 11:43:50'),
(60, 10, '1586180630.9585f0324da000110a3b345cf04664fe.jpg', '2020-04-06 11:43:50', '2020-04-06 11:43:50'),
(66, 3, '1586300032.p13.jpg', '2020-04-07 20:53:52', '2020-04-07 20:53:52'),
(67, 3, '1586300032.p2-1.jpg', '2020-04-07 20:53:52', '2020-04-07 20:53:52'),
(68, 3, '1587176212.92099168_1293842734149795_5326382440636219392_n.jpg', '2020-04-18 00:16:52', '2020-04-18 00:16:52'),
(69, 11, '1587176320.75398323_3577211892289278_5529560709001641984_o.jpg', '2020-04-18 00:18:40', '2020-04-18 00:18:40'),
(70, 11, '1587176320.river.jpg', '2020-04-18 00:18:40', '2020-04-18 00:18:40'),
(71, 12, '1587176432.river.jpg', '2020-04-18 00:20:32', '2020-04-18 00:20:32'),
(72, 13, '1588489666.1585825402.Bubbles-Lumppini-Fotolia-1080x675.jpg', '2020-05-03 05:07:46', '2020-05-03 05:07:46'),
(73, 14, '1588491247.e219388e1b9feed650d0d682dd04a774.jpg', '2020-05-03 05:34:07', '2020-05-03 05:34:07'),
(75, 16, '1588659783.1.png', '2020-05-05 04:23:03', '2020-05-05 04:23:03'),
(76, 16, '1588659783.2b21b61582620c7cc12698aa75296fa1.jpg', '2020-05-05 04:23:03', '2020-05-05 04:23:03'),
(77, 16, '1588659783.9585f0324da000110a3b345cf04664fe.jpg', '2020-05-05 04:23:03', '2020-05-05 04:23:03'),
(78, 16, '1588659783.61014241830dd7609ac71dd8460e8153.png', '2020-05-05 04:23:03', '2020-05-05 04:23:03'),
(79, 16, '1588659783.ec519b8d2fd2c095fa908b19b30a71a8.png', '2020-05-05 04:23:03', '2020-05-05 04:23:03');

-- --------------------------------------------------------

--
-- بنية الجدول `pro_comments`
--

CREATE TABLE `pro_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `pro_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `stars` int(10) DEFAULT NULL,
  `status` float DEFAULT 0 COMMENT '0:notpublished,1:published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `pro_comments`
--

INSERT INTO `pro_comments` (`id`, `pro_id`, `vendor_id`, `name`, `email`, `comment`, `stars`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 4, 'samaa', 'asas@ss.bvv', 'ضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\"', 3, 1, '2020-04-24 00:18:02', '2020-04-23 23:47:48'),
(2, 6, 4, 'سماء', 'eng.samaa@gmail.com', 'جيد جدااا', 4, 1, '2020-04-23 23:02:09', '2020-04-24 01:02:27'),
(3, 6, 4, 'adam', 'eng.adam@gmail.com', 'good job', 5, 0, '2020-04-23 23:03:07', '2020-04-23 23:03:07');

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
(3, 'pMXVJXR9n2', 50, 0, '2020-03-15 17:24:33', '2020-05-04 21:29:59'),
(6, 'HCF8kWhVMg', 20, 0, '2020-04-03 20:13:56', '2020-05-04 21:38:39'),
(7, 'Gz4Qknaeat', 21, 1, '2020-05-04 20:30:12', '2020-05-04 20:30:12');

-- --------------------------------------------------------

--
-- بنية الجدول `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` int(10) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `keywords_ar` text DEFAULT NULL,
  `keywords_en` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `title_en`, `title_ar`, `description_ar`, `description_en`, `keywords_ar`, `keywords_en`, `created_at`, `updated_at`) VALUES
(1, 'debaj', 'ديباج', 'ديباج', 'debaj', 'ديباج', 'debaj', '2020-03-16 09:41:02', '2020-03-16 09:43:47');

-- --------------------------------------------------------

--
-- بنية الجدول `social_page`
--

CREATE TABLE `social_page` (
  `id` int(10) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twiter` varchar(255) DEFAULT NULL,
  `instgram` varchar(255) DEFAULT NULL,
  `pintrist` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `social_page`
--

INSERT INTO `social_page` (`id`, `facebook`, `twiter`, `instgram`, `pintrist`, `updated_at`, `created_at`) VALUES
(1, 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.pinterest.com/', '2020-03-17 07:54:02', '2020-03-16 09:34:21');

-- --------------------------------------------------------

--
-- بنية الجدول `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `created_at`, `updated_at`) VALUES
(4, 'samaa.ii@sd.ckm', '2020-04-14 13:25:43', '2020-04-14 13:25:43'),
(5, 'as@eee.ccc', '2020-04-16 15:27:17', '2020-04-16 15:27:17'),
(6, 'samaamild@ggg.nkm', '2020-04-26 05:29:15', '2020-04-26 05:29:15');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL COMMENT '0 => user, 1=> vendor ',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_expiration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `verified` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `type`, `username`, `full_name`, `phone`, `email`, `password`, `address`, `image`, `reset_password_code`, `code_expiration`, `status`, `verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 1, 'samaamilano', 'سماء سامح هاشم محمود خليل', '01123800855', 'samaa.milano@hotmail.com', '$2y$10$5yutObTpZsOYLDkCH1tvb.qrX2iHXQB3E2gt0EhqdknIMIICIhlBu', 'سيد جندي حلوان23', '8020a4a07cacc99c1adaaabdd7e2a872.jpg', NULL, NULL, '1', '1', NULL, '2020-01-08 06:50:51', '2020-04-23 19:11:02'),
(6, 0, 'samaa22', 'سماء سامح هاشم', '01123800827', 'samaa.milano@yahoo.com', '$2y$10$SSSi9OXeaalMOkPdBDU.tuQclFV.Vzn6YlZGpgeoHrwtX7bJX9qv2', 'سيد جندي حلوان', NULL, NULL, NULL, '1', '1', NULL, '2020-01-08 06:50:51', '2020-04-13 12:05:22'),
(12, 0, 'samaosamao', 'samaa sameh hashem mahmoud', '01123800827', 'samaa.samaosamao@yahoo.com', '$2y$10$02HH4F7bbZE6nn70/DwLy.N9YpPEHJOLH8sdZ5FyCQpjKFNLMmo5q', 'سيد جندي حلوان', '5f8d1ad4029780ad078f3eb87db80e08.jpg', NULL, NULL, '1', '6GiYfeau6Q', 'TwtjL8gMjdXNlLNDy2ix7YKbfQB93FF8sb3kge2bz6g1ZkbWMxGKioR5YwPp', '2020-04-16 16:36:03', '2020-05-08 07:36:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads_slider`
--
ALTER TABLE `ads_slider`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_data`
--
ALTER TABLE `contact_data`
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
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_details_orders` (`orders_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_products_users` (`vendor_id`),
  ADD KEY `FK_products_categories` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_images_products` (`product_id`);

--
-- Indexes for table `pro_comments`
--
ALTER TABLE `pro_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pro_comments_products` (`pro_id`),
  ADD KEY `FK_pro_comments_users` (`vendor_id`);

--
-- Indexes for table `salecodes`
--
ALTER TABLE `salecodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_page`
--
ALTER TABLE `social_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads_slider`
--
ALTER TABLE `ads_slider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_data`
--
ALTER TABLE `contact_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `pro_comments`
--
ALTER TABLE `pro_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salecodes`
--
ALTER TABLE `salecodes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_page`
--
ALTER TABLE `social_page`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `FK_orders_details_orders` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_products_users` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_product_images_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `pro_comments`
--
ALTER TABLE `pro_comments`
  ADD CONSTRAINT `FK_pro_comments_products` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pro_comments_users` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
