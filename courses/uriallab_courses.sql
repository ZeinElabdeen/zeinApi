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
-- Database: `uriallab_courses`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '966556955512', 1, NULL, '$2y$10$9Eo7fZ9xvZPC3oxvebg5H.aL4MV1F/EV9kpzm3YI.uCgSvxi2gk0y', NULL, '2020-06-23 08:14:36', '2020-06-23 08:14:36');

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_contact_st`
-- (See below for the actual view)
--
CREATE TABLE `admin_contact_st` (
`student_id` int(11)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
,`student_password` varchar(255)
,`student_passport_name` varchar(150)
,`student_passport_number` bigint(20)
,`passport_photo` varchar(250)
,`verification` tinyint(1)
,`access_token` varchar(60)
,`activation_code` int(11)
,`st_created_at` timestamp
,`fcm_token` text
,`mob_lang` varchar(2)
,`message_title_id` int(11)
,`message_title` varchar(255)
,`message_title_ar` varchar(255)
,`message` text
,`sent_at` timestamp
,`read_message` tinyint(1)
,`message_reply` text
,`message_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_courses_user_rates`
-- (See below for the actual view)
--
CREATE TABLE `admin_courses_user_rates` (
`course_rate_id` int(11)
,`course_rate_value` int(11)
,`rate_created_at` timestamp
,`course_id` int(11)
,`course_type_id` int(11)
,`institute_id` int(11)
,`weeks_number` int(11)
,`course_name` varchar(255)
,`course_name_ar` varchar(255)
,`course_details` text
,`course_details_ar` text
,`course_photo` varchar(255)
,`course_price` float(10,2)
,`book_fees` float(10,2)
,`living_fees` float(10,2)
,`mail_fees` float(10,2)
,`summer_fees` float(10,2)
,`registration_fees` float(10,2)
,`tax_fees` float(4,2)
,`housing_price` float(10,2)
,`insurance_price` float(10,2)
,`reception_price` float(10,2)
,`c_created_at` timestamp
,`local_or_global` tinyint(1)
,`student_id` int(11)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
,`student_password` varchar(255)
,`student_passport_name` varchar(150)
,`student_passport_number` bigint(20)
,`passport_photo` varchar(250)
,`verification` tinyint(1)
,`access_token` varchar(60)
,`activation_code` int(11)
,`st_created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_institute_rateuser`
-- (See below for the actual view)
--
CREATE TABLE `admin_institute_rateuser` (
`student_name` varchar(100)
,`institute_rate_id` int(11)
,`institute_rate_value` int(1)
,`student_id` int(11)
,`rate_created_at` timestamp
,`passport_photo` varchar(250)
,`institute_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_msg_noti`
-- (See below for the actual view)
--
CREATE TABLE `admin_msg_noti` (
`message_id` int(11)
,`student_id` int(11)
,`message_title_id` int(11)
,`sent_at` timestamp
,`read_message` tinyint(1)
,`message_title` varchar(255)
,`message_title_ar` varchar(255)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
,`student_passport_number` bigint(20)
,`passport_photo` varchar(250)
,`student_passport_name` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_reservation_noti`
-- (See below for the actual view)
--
CREATE TABLE `admin_reservation_noti` (
`reservation_id` int(11)
,`student_id` int(11)
,`course_id` int(11)
,`read_at` tinyint(1)
,`reserved_at` timestamp
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_resets_st`
-- (See below for the actual view)
--
CREATE TABLE `admin_resets_st` (
`student_id` int(11)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
,`student_password` varchar(255)
,`student_passport_name` varchar(150)
,`student_passport_number` bigint(20)
,`passport_photo` varchar(250)
,`verification` tinyint(1)
,`access_token` varchar(60)
,`activation_code` int(11)
,`st_created_at` timestamp
,`fcm_token` text
,`mob_lang` varchar(2)
,`reset_id` int(11)
,`reset_token` varchar(255)
,`reset_at` timestamp
);

-- --------------------------------------------------------

--
-- بنية الجدول `ads_app`
--

CREATE TABLE `ads_app` (
  `ads_id` int(11) NOT NULL,
  `ads_title` varchar(255) NOT NULL,
  `ads_title_ar` varchar(255) NOT NULL,
  `ads_details` text NOT NULL,
  `ads_details_ar` text NOT NULL,
  `ads_andriod_link` text NOT NULL,
  `ads_ios_link` text NOT NULL,
  `ads_cover_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `ads_app`
--

INSERT INTO `ads_app` (`ads_id`, `ads_title`, `ads_title_ar`, `ads_details`, `ads_details_ar`, `ads_andriod_link`, `ads_ios_link`, `ads_cover_photo`) VALUES
(1, 'You can download our applications on your mobile', 'يمكنك تحميل تطبيقاتنا علي جوالك', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vitae?', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحةو لقد تم توليد هذا النص من مولد النص العربي', 'https://play.google.com/store?hl=en', 'https://www.apple.com/ios/app-store/', 'image2.png');

-- --------------------------------------------------------

--
-- بنية الجدول `airport_rec`
--

CREATE TABLE `airport_rec` (
  `airport_rec_id` int(11) NOT NULL,
  `airport_rec_name` varchar(255) NOT NULL,
  `airport_rec_name_ar` varchar(255) NOT NULL,
  `airport_rec_price` float(10,2) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `airport_rec`
--

INSERT INTO `airport_rec` (`airport_rec_id`, `airport_rec_name`, `airport_rec_name_ar`, `airport_rec_price`, `course_id`) VALUES
(1, 'i want airport reception', 'اريد استقبال في المطار', 600.00, 4),
(2, 'i want airport reception', 'اريد استقبال في المطار', 200.00, 1),
(3, 'i want airport reception', 'اريد استقبال في المطار', 400.00, 2),
(4, 'i want airport reception', 'اريد استقبال في المطار', 150.00, 3),
(5, 'i want airport reception', 'اريد استقبال في المطار', 800.00, 5),
(6, 'i want airport reception', 'اريد استقبال في المطار', 100.00, 6),
(13, 'i do not want airport reception', 'لا احتاج الي استقبال في المطار', 0.00, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `statement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `bank_accounts`
--

INSERT INTO `bank_accounts` (`account_id`, `account_name`, `account_number`, `bank_name`, `statement`) VALUES
(1, 'Lorem Ipsum', '0123698547502', 'audi bank', '253369742'),
(2, 'galal', '0261984651984899256498', 'CIB bank', '0020984894748');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `message_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message_title_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_message` tinyint(1) NOT NULL DEFAULT 0,
  `message_reply` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `contact_us`
--

INSERT INTO `contact_us` (`message_id`, `student_id`, `message_title_id`, `message`, `sent_at`, `read_message`, `message_reply`) VALUES
(1, 1, 2, 'hello world', '2020-06-16 14:52:25', 0, NULL),
(2, 3, 2, 'xsxsx', '2020-06-16 14:59:13', 1, '<h1><b>dear Dondon,</b></h1><p><span style=\"background-color: rgb(255, 0, 0);\">inshallah hn7llk el7war da</span></p><p><u>t7yate...</u></p>'),
(3, 5, 1, 'hello', '2020-06-21 07:34:04', 0, NULL),
(5, 1, 2, 'i want to cancel my embedded system course this summer ,\r\ncan you help me please ? ', '2020-06-21 08:16:41', 0, '<p>ok we will help you soon</p>'),
(6, 3, 2, 'Hellow from website :D', '2020-06-21 09:02:26', 0, '<h4 style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: small;\"><b><font color=\"#424242\">Dear&nbsp;</font><font color=\"#a54a7b\">Dondon,</font></b></h4><h6 style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif;\"><font color=\"#424242\"><b>&nbsp; &nbsp;&nbsp;</b>Please Take care About yourself ,&nbsp;wear a medical mask&nbsp;ًwhile you are on the road&nbsp;</font></h6><h6 style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif;\"><font color=\"#424242\">And c</font><font color=\"#424242\">lean your hands on alco</font><font color=\"#424242\">hol from time to time.</font></h6><h6 style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif;\"><br></h6><h6 style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif;\"><font color=\"#424242\">I look forward to hearing from you!<br></font><font color=\"#424242\">Sincerely,</font></h6>');

--
-- القوادح `contact_us`
--
DELIMITER $$
CREATE TRIGGER `message_noti` AFTER INSERT ON `contact_us` FOR EACH ROW INSERT INTO contact_us_noti  				VALUES(NEW.message_id,NEW.student_id,NEW.message_title_id, DEFAULT,DEFAULT)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us_noti`
--

CREATE TABLE `contact_us_noti` (
  `message_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message_title_id` int(11) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_message` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `contact_us_noti`
--

INSERT INTO `contact_us_noti` (`message_id`, `student_id`, `message_title_id`, `sent_at`, `read_message`) VALUES
(3, 5, 1, '2020-06-21 07:34:04', 1),
(5, 1, 2, '2020-06-21 08:16:41', 0),
(6, 3, 2, '2020-06-21 09:02:26', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_number` int(6) NOT NULL,
  `coupon_discount` float(4,2) NOT NULL,
  `coupon_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_number`, `coupon_discount`, `coupon_status`) VALUES
(1, 12345, 0.25, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_type_id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `weeks_number` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_name_ar` varchar(255) NOT NULL,
  `course_details` text NOT NULL,
  `course_details_ar` text NOT NULL,
  `course_photo` varchar(255) NOT NULL,
  `course_price` float(10,2) NOT NULL,
  `book_fees` float(10,2) NOT NULL,
  `living_fees` float(10,2) NOT NULL,
  `mail_fees` float(10,2) NOT NULL,
  `summer_fees` float(10,2) NOT NULL,
  `registration_fees` float(10,2) NOT NULL,
  `tax_fees` float(4,2) NOT NULL,
  `housing_price` float(10,2) NOT NULL,
  `insurance_price` float(10,2) NOT NULL,
  `reception_price` float(10,2) NOT NULL,
  `c_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `local_or_global` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `courses`
--

INSERT INTO `courses` (`course_id`, `course_type_id`, `institute_id`, `weeks_number`, `course_name`, `course_name_ar`, `course_details`, `course_details_ar`, `course_photo`, `course_price`, `book_fees`, `living_fees`, `mail_fees`, `summer_fees`, `registration_fees`, `tax_fees`, `housing_price`, `insurance_price`, `reception_price`, `c_created_at`, `local_or_global`) VALUES
(1, 3, 3, 4, 'full stack diploma', 'دبلومة full-stack', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '6.jpg', 1502.50, 200.00, 150.00, 256.00, 50.00, 10.00, 0.14, 150.00, 603.00, 450.00, '2020-04-26 13:21:18', 1),
(2, 3, 3, 6, 'embedded system diploma', 'دبلومة امبيديد سيستم ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '4.jpg', 3000.00, 230.00, 253.00, 10.00, 20.00, 30.00, 0.14, 0.00, 0.00, 0.00, '2020-04-26 13:24:29', 1),
(3, 4, 3, 7, 'cyber security', 'امان الانترنت', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '3.jpg', 6000.00, 300.00, 200.00, 10.00, 25.00, 30.00, 0.14, 0.00, 0.00, 0.00, '2020-04-26 13:27:20', 2),
(4, 6, 2, 2, 'business', 'ادارة اعمال', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '1.jpg', 600.00, 105.00, 253.00, 20.00, 50.00, 100.00, 0.14, 0.00, 0.00, 0.00, '2020-04-26 13:29:02', 2),
(5, 1, 2, 3, 'mobile package', 'كورس موبايل', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '5.jpg', 2500.00, 200.00, 150.00, 10.00, 26.00, 20.00, 0.14, 0.00, 0.00, 0.00, '2020-04-26 13:30:45', 1),
(6, 5, 4, 5, 'english language', 'لغة انجليزية', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '2.jpg', 4500.00, 205.00, 120.00, 20.00, 28.00, 10.00, 0.14, 0.00, 0.00, 0.00, '2020-04-26 13:32:10', 2);

-- --------------------------------------------------------

--
-- بنية الجدول `course_rating`
--

CREATE TABLE `course_rating` (
  `course_rate_id` int(11) NOT NULL,
  `course_rate_value` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `rate_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `course_rating`
--

INSERT INTO `course_rating` (`course_rate_id`, `course_rate_value`, `course_id`, `student_id`, `rate_created_at`) VALUES
(6, 3, 1, 3, '2020-06-22 14:09:40'),
(7, 2, 1, 1, '2020-06-22 14:09:40'),
(8, 4, 1, 1, '2020-06-22 14:09:40'),
(9, 3, 1, 3, '2020-06-22 14:09:40'),
(10, 4, 2, 3, '2020-06-22 14:09:40'),
(21, 3, 2, 3, '2020-06-22 14:09:40'),
(22, 2, 3, 1, '2020-06-22 14:09:40'),
(23, 4, 3, 1, '2020-06-22 14:09:40'),
(24, 3, 4, 1, '2020-06-22 14:09:40'),
(25, 4, 4, 1, '2020-06-22 14:09:40'),
(26, 1, 1, 1, '2020-06-22 14:09:40'),
(27, 3, 1, 1, '2020-06-22 14:09:40'),
(28, 3, 1, 1, '2020-06-22 14:09:40'),
(29, 4, 2, 30, '2020-06-22 14:09:40'),
(30, 4, 2, 30, '2020-06-22 14:09:40');

-- --------------------------------------------------------

--
-- بنية الجدول `course_type`
--

CREATE TABLE `course_type` (
  `course_type_id` int(11) NOT NULL,
  `course_type_name` varchar(100) NOT NULL,
  `course_type_name_ar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `course_type`
--

INSERT INTO `course_type` (`course_type_id`, `course_type_name`, `course_type_name_ar`) VALUES
(1, 'mobile network', 'موبايل انترنت'),
(2, 'web technology', 'ويب تكنولوجي'),
(3, 'embedded systems', 'امبيديد سيستم'),
(4, 'network security', 'تامين الشبكات'),
(5, 'english', 'لغة انجليزية'),
(6, 'business mangement', 'ادارة اعمال');

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `institutes`
--

CREATE TABLE `institutes` (
  `institute_id` int(11) NOT NULL,
  `institute_name` varchar(255) NOT NULL,
  `institute_name_ar` varchar(255) NOT NULL,
  `institute_details` text NOT NULL,
  `institute_details_ar` text NOT NULL,
  `institutes_photo` varchar(255) NOT NULL,
  `i_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `institute_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `institutes`
--

INSERT INTO `institutes` (`institute_id`, `institute_name`, `institute_name_ar`, `institute_details`, `institute_details_ar`, `institutes_photo`, `i_created_at`, `location_id`, `city_id`, `institute_email`) VALUES
(2, 'modern academy for engineering', 'مودرن اكادييمي للهندسة', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد ال', '3.jpg', '2020-04-26 11:58:30', 1, 1, NULL),
(3, 'national telecommunication institute', 'المعهد القومي للاتصالت', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '2.jpg', '2020-04-26 12:00:40', 1, 2, 'galal.husseny@gmail.com'),
(4, 'modern university', 'الجامعة الحديثة ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', '1.png', '2020-04-26 12:01:32', 1, 3, NULL),
(5, 'test', 'test', 'test', 'test', 'default.jpg', '2020-04-26 12:06:38', 4, 4, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `institutes_citites`
--

CREATE TABLE `institutes_citites` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_name_ar` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `institutes_citites`
--

INSERT INTO `institutes_citites` (`city_id`, `city_name`, `city_name_ar`, `location_id`) VALUES
(1, 'mokattam', 'المقطم', 1),
(2, 'smart village', 'القرية الذكية', 1),
(3, 'maadi', 'المعادي', 1),
(4, 'new york', 'نيو يورك', 4);

-- --------------------------------------------------------

--
-- بنية الجدول `institute_location`
--

CREATE TABLE `institute_location` (
  `location_id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `country_ar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `institute_location`
--

INSERT INTO `institute_location` (`location_id`, `country`, `country_ar`) VALUES
(1, 'egypt', 'مصر'),
(4, 'america', 'امريكا');

-- --------------------------------------------------------

--
-- بنية الجدول `institute_rating`
--

CREATE TABLE `institute_rating` (
  `institute_rate_id` int(11) NOT NULL,
  `institute_rate_value` int(1) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `rate_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `institute_rating`
--

INSERT INTO `institute_rating` (`institute_rate_id`, `institute_rate_value`, `institute_id`, `student_id`, `rate_created_at`) VALUES
(1, 5, 2, NULL, '2020-06-22 14:10:12'),
(2, 4, 2, NULL, '2020-06-22 14:10:12'),
(3, 5, 2, NULL, '2020-06-22 14:10:12'),
(4, 2, 2, NULL, '2020-06-22 14:10:12'),
(5, 3, 4, NULL, '2020-06-22 14:10:12'),
(6, 2, 4, NULL, '2020-06-22 14:10:12'),
(7, 1, 3, NULL, '2020-06-22 14:10:12'),
(8, 5, 3, NULL, '2020-06-22 14:10:12'),
(9, 1, 5, 1, '2020-06-22 14:10:12'),
(10, 4, 2, 24, '2020-06-22 14:10:12'),
(11, 4, 2, 30, '2020-06-22 14:10:12');

-- --------------------------------------------------------

--
-- بنية الجدول `living`
--

CREATE TABLE `living` (
  `living_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `living_price` float(10,2) NOT NULL,
  `living_name` varchar(255) NOT NULL,
  `living_name_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `living`
--

INSERT INTO `living` (`living_id`, `course_id`, `living_price`, `living_name`, `living_name_ar`) VALUES
(1, 1, 201.00, 'mariot hotel', 'فندق ماريوت '),
(2, 1, 300.00, 'hillton hotel', 'فندق الهيلتون'),
(3, 1, 400.00, 'four season ', 'فندق الفور سيسزون'),
(4, NULL, 0.00, 'i dont need living', 'لا احتاج لسكن');

-- --------------------------------------------------------

--
-- بنية الجدول `medical_insurance`
--

CREATE TABLE `medical_insurance` (
  `medical_insurance_id` int(11) NOT NULL,
  `medical_insurance_name` varchar(255) NOT NULL,
  `medical_insurance_name_ar` varchar(255) NOT NULL,
  `medical_insurance_price` float(10,2) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `medical_insurance`
--

INSERT INTO `medical_insurance` (`medical_insurance_id`, `medical_insurance_name`, `medical_insurance_name_ar`, `medical_insurance_price`, `course_id`) VALUES
(1, 'i want medical insurance', 'اريد تامين طبي ', 250.00, 4),
(2, 'i want medical insurance', 'اريد تامين طبي ', 300.00, 1),
(3, 'i want medical insurance', 'اريد تامين طبي ', 600.00, 2),
(4, 'i want medical insurance', 'اريد تامين طبي ', 100.00, 3),
(5, 'i want medical insurance', 'اريد تامين طبي ', 250.00, 5),
(6, 'i want medical insurance', 'اريد تامين طبي ', 350.00, 6),
(13, 'i do not want medical insurance', 'لا اريد تامين طبي\r\n', 0.00, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `message_title`
--

CREATE TABLE `message_title` (
  `message_title_id` int(11) NOT NULL,
  `message_title` varchar(255) NOT NULL,
  `message_title_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `message_title`
--

INSERT INTO `message_title` (`message_title_id`, `message_title`, `message_title_ar`) VALUES
(1, 'Inquiry', 'استفسار'),
(2, 'Request', 'طلب');

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `student_id` int(1) DEFAULT NULL,
  `note_details` text NOT NULL,
  `note_photo` varchar(255) DEFAULT 'default.jpg',
  `note_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `notes`
--

INSERT INTO `notes` (`note_id`, `student_id`, `note_details`, `note_photo`, `note_created_at`) VALUES
(3, 1, '3 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '3.png', '2020-05-12 08:54:22'),
(4, 1, '4 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500ss', '1591779708.png', '2020-05-12 11:54:22'),
(5, 1, 'asdfghjhgfdssdfghgfdsadfghgfds', '1589281033.png', '2020-05-12 10:57:13'),
(6, NULL, 'with out photo', NULL, '2020-05-12 11:00:35'),
(7, NULL, 'with out photo1', NULL, '2020-05-12 11:30:19'),
(8, NULL, 'with out photo 2', NULL, '2020-05-12 11:37:21'),
(10, NULL, 'with out photo 2*/', NULL, '2020-05-12 11:37:37'),
(11, NULL, 'with out photo2', NULL, '2020-05-12 13:21:14'),
(12, NULL, 'with out photo 2', NULL, '2020-05-12 13:21:23'),
(13, NULL, 'with out photo 2 *', NULL, '2020-05-13 04:56:57'),
(20, 30, 'bahja', NULL, '2020-06-03 11:06:50'),
(21, 30, 'babaha', NULL, '2020-06-03 11:07:00');

-- --------------------------------------------------------

--
-- بنية الجدول `online_courses`
--

CREATE TABLE `online_courses` (
  `online_course_id` int(11) NOT NULL,
  `online_course_name` varchar(255) NOT NULL,
  `online_course_name_ar` varchar(255) NOT NULL,
  `online_course_details` text NOT NULL,
  `online_course_details_ar` text NOT NULL,
  `online_course_link` text NOT NULL,
  `institute_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `online_course_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `online_courses`
--

INSERT INTO `online_courses` (`online_course_id`, `online_course_name`, `online_course_name_ar`, `online_course_details`, `online_course_details_ar`, `online_course_link`, `institute_id`, `created_at`, `online_course_photo`) VALUES
(1, 'english udemy', 'انجليزي يديمي ', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد الن', 'https://www.udemy.com/course/complete-python-bootcamp/', 4, '2020-04-27 14:31:29', '1.png'),
(2, 'php youtube', 'كورس بي اتش بي يوتيوب', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد الن', 'https://www.youtube.com/watch?v=QsBfH4qqk1k&feature=youtu.be', 3, '2020-04-27 14:31:29', '2.png'),
(3, 'javaScript khan academy', 'كورس جافا سكريبت  خان اكاديمي', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد الن', 'https://www.youtube.com/watch?v=EHdIDWFdNjI&list=PLfDx4cQoUNOaQBbxWm4HhZ8l6aEdPiO6T&index=49', 3, '2020-04-27 14:31:29', '3.png');

-- --------------------------------------------------------

--
-- بنية الجدول `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `details_ar` text DEFAULT NULL,
  `page_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `title_ar`, `details`, `details_ar`, `page_photo`) VALUES
(1, 'Lorem Ipsum is simply 1', 'هذا النص هو مثال لنص يمكن أن يستبدل 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 1', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n1', NULL),
(2, 'Lorem Ipsum is simply 2', 'هذا النص هو مثال لنص يمكن أن يستبدل 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 2', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n 2', NULL),
(3, 'Lorem Ipsum is simply 3', 'هذا النص هو مثال لنص يمكن أن يستبدل 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 3', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n 3', NULL),
(4, 'Lorem Ipsum is simply 4', 'هذا النص هو مثال لنص يمكن أن يستبدل 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 4', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n 4', NULL),
(18, 'Lorem Ipsum is simply 18', 'هذا النص هو مثال لنص يمكن أن يستبدل 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 18', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n18', NULL),
(34, 'Lorem Ipsum is simply 34', 'هذا النص هو مثال لنص يمكن أن يستبدل 34', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 34', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n34', 'about.png'),
(45, 'contact us', 'تواصل معنا', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `partners`
--

CREATE TABLE `partners` (
  `partner_id` int(11) NOT NULL,
  `partner_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `partners`
--

INSERT INTO `partners` (`partner_id`, `partner_photo`) VALUES
(1, '6.png'),
(2, '5.png'),
(3, '4.png'),
(4, '1.png'),
(5, '2.png'),
(6, '3.png');

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `pass_resets`
--

CREATE TABLE `pass_resets` (
  `reset_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `reset_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `pass_resets`
--

INSERT INTO `pass_resets` (`reset_id`, `student_id`, `reset_token`, `reset_at`) VALUES
(1, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:17:16'),
(2, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:18:07'),
(3, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:18:20'),
(4, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:18:35'),
(5, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:19:13'),
(6, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:19:25'),
(7, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:19:37'),
(8, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:20:51'),
(9, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:21:02'),
(10, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:21:25'),
(11, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:21:44'),
(12, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:22:03'),
(13, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:22:07'),
(14, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:22:19'),
(15, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:22:45'),
(16, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:22:51'),
(17, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:23:19'),
(18, 30, 'b78206fc6645c4f63f923bf6da93c12e7309b45e8b58581d8374b2f514963b44', '2020-06-08 08:23:35'),
(19, 30, '9ee4d6b33f388e32933f2e9a566587cb2d0234256366243140c4faebe5bdd0de', '2020-06-08 08:41:45'),
(20, 30, '61334a1a59310bb1dab680af40e9ccacef02763722a952b1dd4af98ea0d21e0a', '2020-06-08 08:42:27'),
(21, 30, '38e50461c21bd0365a1483985633ed5992fdeae5a2b1a2bdd7347747c33cb75d', '2020-06-08 08:44:34'),
(22, 37, '3d9ff2769fd90df38d7768cc886943f631e8acb5d6a5b267ab7f8082e0b1953e', '2020-06-10 09:08:24'),
(23, 37, '3d9ff2769fd90df38d7768cc886943f631e8acb5d6a5b267ab7f8082e0b1953e', '2020-06-10 09:08:40'),
(24, 37, '3d9ff2769fd90df38d7768cc886943f631e8acb5d6a5b267ab7f8082e0b1953e', '2020-06-10 09:08:50'),
(25, 37, '3d9ff2769fd90df38d7768cc886943f631e8acb5d6a5b267ab7f8082e0b1953e', '2020-06-10 09:10:21'),
(26, 38, 'd213547cfa4610d17e7ff61e9466fc8f4c7ea0a9bf7d2d90cc7298eafdecfb89', '2020-06-10 09:14:13'),
(27, 39, '0811a9ef1614a7862a39e713cfc0f54af939d4d242a55274311fe5ab93bd0c02', '2020-06-10 09:16:25'),
(28, 39, '0dc81b2374dd476019c2755f8c154f6b93cbdea0f3ec4902bcb7bffa2229873d', '2020-06-10 09:40:18');

-- --------------------------------------------------------

--
-- بنية الجدول `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `photo_title` varchar(255) NOT NULL,
  `photo_title_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_name`, `photo_title`, `photo_title_ar`) VALUES
(1, '1.png', 'Lorem Ipsum', 'هذا النص هو مثال لنص يمكن أن يستبدل 1'),
(2, '2.png', 'Lorem Ipsum2', 'هذا النص هو مثال لنص يمكن أن يستبدل 2'),
(3, '3.png', 'Lorem Ipsum3', 'هذا النص هو مثال لنص يمكن أن يستبدل 3');

-- --------------------------------------------------------

--
-- بنية الجدول `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `coupon` int(11) DEFAULT NULL,
  `living_id` int(11) NOT NULL DEFAULT 4,
  `airport_rec_id` int(11) NOT NULL DEFAULT 13,
  `medical_insurance_id` int(11) NOT NULL DEFAULT 13,
  `reservation_status` tinyint(1) NOT NULL DEFAULT 0,
  `start_at` date NOT NULL,
  `reserved_weeks_number` int(11) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `student_id`, `course_id`, `coupon`, `living_id`, `airport_rec_id`, `medical_insurance_id`, `reservation_status`, `start_at`, `reserved_weeks_number`, `complete`, `created_at`) VALUES
(5, 1, 1, 12345, 1, 2, 2, 1, '2020-04-01', 3, 0, '2020-03-31 22:00:00'),
(6, 1, 1, 12345, 1, 2, 2, 2, '2020-05-30', 3, 0, '2020-04-27 22:00:00'),
(7, 3, 1, 12345, 1, 2, 2, 1, '2020-05-30', 3, 0, '2020-05-05 12:22:46'),
(9, 1, 6, NULL, 4, 13, 13, 0, '2020-05-20', 3, 0, '2020-05-06 14:13:46'),
(12, 1, 1, 12345, 4, 13, 13, 0, '2020-05-30', 3, 0, '2020-05-11 07:43:02'),
(13, 1, 1, 12345, 4, 13, 13, 0, '2020-05-30', 3, 0, '2020-05-13 04:32:41'),
(14, 3, 1, 12345, 4, 13, 13, 0, '2020-05-30', 3, 0, '2020-05-13 11:22:09'),
(15, 24, 1, NULL, 4, 13, 13, 0, '2020-06-01', 2, 0, '2020-05-20 10:10:07'),
(16, 30, 1, NULL, 2, 2, 2, 0, '2020-05-22', 40, 0, '2020-05-22 16:22:49'),
(18, 30, 2, NULL, 4, 3, 3, 0, '2020-05-27', 20, 0, '2020-05-26 20:03:09'),
(19, 33, 3, NULL, 4, 4, 4, 0, '2020-05-31', 4, 0, '2020-05-31 14:06:13'),
(20, 30, 1, NULL, 4, 13, 13, 0, '2020-06-01', 2, 0, '2020-06-01 10:30:42'),
(21, 39, 3, NULL, 4, 13, 13, 0, '2020-06-27', 6, 0, '2020-06-10 09:26:37'),
(22, 39, 2, NULL, 4, 13, 13, 0, '2020-06-22', 4, 0, '2020-06-10 09:27:03'),
(23, 1, 5, NULL, 4, 13, 13, 0, '2020-06-25', 1, 0, '2020-06-11 18:31:15'),
(24, 1, 2, NULL, 4, 13, 13, 0, '2020-06-26', 3, 0, '2020-06-22 12:41:38'),
(25, 1, 2, NULL, 4, 13, 13, 0, '2020-06-26', 3, 0, '2020-06-22 12:44:46');

--
-- القوادح `reservations`
--
DELIMITER $$
CREATE TRIGGER `reservation_admin_noti` AFTER INSERT ON `reservations` FOR EACH ROW INSERT INTO reservation_admin_noti VALUES(NEW.reservation_id,NEW.student_id,NEW.course_id, DEFAULT,DEFAULT)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reservation_notify` AFTER UPDATE ON `reservations` FOR EACH ROW IF NEW.reservation_status = 1 THEN  
		INSERT INTO reservation_noti  				VALUES(null,NEW.student_id,New.reservation_id, NEW.reservation_status,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT);
    ELSEIF( NEW.reservation_status = 2)THEN
     DELETE FROM `reservation_noti` WHERE reservation_id = OLD.reservation_id;
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- بنية الجدول `reservation_admin_noti`
--

CREATE TABLE `reservation_admin_noti` (
  `reservation_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `read_at` tinyint(1) NOT NULL DEFAULT 0,
  `reserved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `reservation_admin_noti`
--

INSERT INTO `reservation_admin_noti` (`reservation_id`, `student_id`, `course_id`, `read_at`, `reserved_at`) VALUES
(37, 1, 3, 1, '2020-06-21 09:18:23'),
(38, 7, 3, 1, '2020-06-21 10:10:19');

-- --------------------------------------------------------

--
-- بنية الجدول `reservation_noti`
--

CREATE TABLE `reservation_noti` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `reservation_status` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `noti_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `details_ar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `reservation_noti`
--

INSERT INTO `reservation_noti` (`id`, `student_id`, `reservation_id`, `reservation_status`, `read`, `noti_created_at`, `title`, `details`, `title_ar`, `details_ar`) VALUES
(7, 1, 5, 1, 0, '2020-05-13 08:46:54', NULL, NULL, NULL, NULL),
(9, 3, 7, 1, 0, '2020-06-03 15:07:06', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(255) NOT NULL,
  `slider_title_ar` varchar(255) NOT NULL,
  `slider_details` text NOT NULL,
  `slider_details_ar` text NOT NULL,
  `slider_link` text NOT NULL,
  `slider_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_title_ar`, `slider_details`, `slider_details_ar`, `slider_link`, `slider_photo`) VALUES
(1, 'YOUR SKILLS FOR THE BETTER', 'بناء المهارات الخاصة بك إلي الأفضل', 'LOREM IPSUM DOLOR, SIT AMET CONSECTETUR ADIPISICING ELIT. ASPERIORES ENIM NON ISTE OBCAECATI EXERCITATIONEM PERFERENDIS.', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحةو لقد تم توليد هذا\r\nالنص من مولد النص العربي,حيث يمكنك إن تولد مثل هذا النص', 'all-courses', 'image.png'),
(2, 'YOUR SKILLS FOR THE BETTER', 'بناء المهارات الخاصة بك إلي الأفضل', 'LOREM IPSUM DOLOR, SIT AMET CONSECTETUR ADIPISICING ELIT. ASPERIORES ENIM NON ISTE OBCAECATI EXERCITATIONEM PERFERENDIS.', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحةو لقد تم توليد هذا\r\nالنص من مولد النص العربي,حيث يمكنك إن تولد مثل هذا النص', 'all-institutes', 'image2.png'),
(3, 'YOUR SKILLS FOR THE BETTER', 'بناء المهارات الخاصة بك إلي الأفضل', 'LOREM IPSUM DOLOR, SIT AMET CONSECTETUR ADIPISICING ELIT. ASPERIORES ENIM NON ISTE OBCAECATI EXERCITATIONEM PERFERENDIS.', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحةو لقد تم توليد هذا\r\nالنص من مولد النص العربي,حيث يمكنك إن تولد مثل هذا النص', 'all-courses', 'image3.png');

-- --------------------------------------------------------

--
-- بنية الجدول `social_media`
--

CREATE TABLE `social_media` (
  `social_id` int(11) NOT NULL,
  `social_link` text NOT NULL,
  `social_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `social_media`
--

INSERT INTO `social_media` (`social_id`, `social_link`, `social_photo`) VALUES
(1, 'http://www.facebook.com', 'face.png'),
(3, 'http://www.google.com', 'google.png'),
(4, 'http://www.twitter.com', 'twitter.png'),
(5, 'http://wwww.instgram.com', 'insta.png');

-- --------------------------------------------------------

--
-- بنية الجدول `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_phone` varchar(20) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `student_passport_name` varchar(150) DEFAULT NULL,
  `student_passport_number` bigint(20) DEFAULT NULL,
  `passport_photo` varchar(250) DEFAULT 'default.jpg',
  `verification` tinyint(1) NOT NULL DEFAULT 1,
  `access_token` varchar(60) DEFAULT NULL,
  `activation_code` int(11) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `mob_lang` varchar(2) NOT NULL DEFAULT 'ar',
  `st_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_email`, `student_phone`, `student_password`, `student_passport_name`, `student_passport_number`, `passport_photo`, `verification`, `access_token`, `activation_code`, `fcm_token`, `mob_lang`, `st_created_at`) VALUES
(1, 'galal husseny', 'galal.husseny@gmail.com', '+201144895434', '$2y$10$WrkiG4isYvYmS1sWkn8X/.ZG9oBucwuswJ3GaNnZtgBKCrXNcfSMW', 'galal alaa', 1235698745, '1592221984.png', 1, 'zDdqMKSlNyNwUaDA3usqXc4zN6lsPQ3YJOQAQrueADE4DthJOB3GBmIkG1mG', 86988, 'abcdef', 'en', '2020-06-22 14:08:17'),
(3, 'donia', 'doniaalaa56@gmail.com', '+201274850767', '$2y$10$WrkiG4isYvYmS1sWkn8X/.ZG9oBucwuswJ3GaNnZtgBKCrXNcfSMW', 'donia alaa', 12356987455, '1589376129.jpeg', 1, 'AjP6JGVl67kytBRTnekqTcZVSdy35MMeu4lZ64KNHLg6WNjRXqBT9VYPJdio', NULL, NULL, 'ar', '2020-06-22 14:08:17'),
(4, 'boda', 'dondon@gmail.com', '+2011158', 'boda@123456', NULL, NULL, NULL, 0, '', NULL, NULL, 'ar', '2020-06-22 14:08:17'),
(5, 'adm', 'adm@gmail.com', '+01123546897', 'Adm@123456', 'default.jpg', NULL, NULL, 0, '', NULL, NULL, 'ar', '2020-06-22 14:08:17'),
(6, 'nisrin husseny', 'nisrin@gmail.com', '+0113549662897', '$2y$10$VxARvC1fIfWc9PN0rjMCae7g1kPCcLQec6TdNzhhYgdf5pij6hDFC', NULL, NULL, NULL, 0, '', NULL, NULL, 'ar', '2020-06-22 14:08:17'),
(7, 'rodyna azzam', 'rodyna@gmail.com', '+201123545686', '$2y$10$veDx5O2uNOXECv5mqvm9W.QKP2zLBA08nSUwd2xCdfaqio96FI7v.', NULL, NULL, NULL, 1, '', 68775, NULL, 'ar', '2020-06-22 14:08:17'),
(8, 'nermen husseny', 'nermen@gmail.com', '+2011253545686', '$2y$10$2ZmgvFHTeg9wh.zPfsQdzu7i2dufwnsp84vgA0m5FGDX4Y6EOJuvi', NULL, NULL, NULL, 1, 'Ql9XwtFhRjsOd9BymaAMSH8OjIVBPvTiLwqL4YhOXtwop0jUR31SvRPRt9K4', 94960, NULL, 'ar', '2020-06-22 14:08:17'),
(9, 'mohamed saliman', 'saliman@gmail.com', '+2011223545686', '$2y$10$dKZK1GpiHzrCJkvgIXluoOjKAh56lXviUav/rA3OY5cnlPzQonUcK', NULL, NULL, NULL, 0, NULL, 25920, NULL, 'ar', '2020-06-22 14:08:17'),
(10, 'hager2 saliman', 'hagergmailcom', '+2011224545686s', '$2y$10$2.n0xpKoUy5BG8oSeCPiOe2OV0OOhTxtZnbhRty9WqmZwK92tgbF.', NULL, NULL, NULL, 0, NULL, 78688, NULL, 'ar', '2020-06-22 14:08:17'),
(18, 'test', 'test@gmail.com', '+2011111233333', '$2y$10$hLHWkcZIKxkIwlcH7et3m.QBk8mshwmIwtqG3HEE0IQZUMfk2QKOC', NULL, NULL, NULL, 1, 'p6l5Uch2Ukjy5AqDbCtuRHxJZfWt96SExy6aJ0jiMNlqmTXvWP8jG8d7wen6', 88770, NULL, 'ar', '2020-06-22 14:08:17'),
(19, 'adm saliman', 'admDoma@gmail.com', '+201122334455', '$2y$10$QSKdMo2wDS.Z5G.F.gMKje5aiS9Jkf1RkQWz.bnPiBWQjf3R71Mku', NULL, NULL, NULL, 0, NULL, 94615, NULL, 'ar', '2020-06-22 14:08:17'),
(20, 'boda saliman', 'bodaadm@gmail.com', '+0119988776655', '$2y$10$be4UN.vqwAjkG8qeLY6ayut4fOTzlN/1HSxax58TP.gJ9d4qgFFhu', NULL, NULL, NULL, 0, 'E6ArGCMuc9bsBVduo3cPLUjoNtAGnjzLTNRAvsyoRRTad5QFSREf0zx4G9rs', 43350, NULL, 'ar', '2020-06-22 14:08:17'),
(21, 'lolosaliman', 'lola@yahoo.com', '+0121144556677', '$2y$10$ysMOE2VPz5mIYEQhg/SqXOl3le/giiTQeJVg3E/BeTXdsNi/hs5Si', NULL, NULL, NULL, 1, 'DaPPDftAOupaNExrd8iiY72kaWOUSK3orL2XAwtf4EFRRqq3R5CcuUwA8hZk', 80058, NULL, 'ar', '2020-06-22 14:08:17'),
(22, 'testSession', 'session@yahoo.com', '+201237896325', '$2y$10$1TgwXVeYyeBATEPWjphwBOWckjNzsS8jlT0kltaFTKOWKhUI9RxO.', NULL, NULL, NULL, 1, NULL, 71183, NULL, 'ar', '2020-06-22 14:08:17'),
(23, 'galal husseny', 'galal.husseny@yahoo.com', '+201237896375', '$2y$10$lRHBUNZgQ1XX7H4YNcWlu.j0jsaY4/T7.8Be0iNVNUMjt1s78fTI.', NULL, NULL, NULL, 1, NULL, 38441, NULL, 'ar', '2020-06-22 14:08:17'),
(24, 'new new', 'carspares54@gmail.com', '+201144895433', '$2y$10$V0XHI2hAe22eilGJUBOvmeTkn03i47zhv4eFmkeu9ozpDsn/GrVba', 'server server', 1234567891056, '1589965807.jpeg', 1, NULL, 20985, NULL, 'ar', '2020-06-22 14:08:17'),
(25, 'mahmood', 'mahmood@mahmood.com', '+201003316096', '$2y$10$lntlJvfMEqw5idS3iAksqexC1f3TVjic680XXtTk0kAA3NOAb3TbO', NULL, NULL, NULL, 0, NULL, 58049, NULL, 'ar', '2020-06-22 14:08:17'),
(26, 'test now', 'newnow@gmail.com', '+201144895431', '$2y$10$49AgFE0WeLCG/f/Lubdp9./XkSuWGs6v0UY1PIiH7Z3weZPibl84G', NULL, NULL, NULL, 1, NULL, 95342, NULL, 'ar', '2020-06-22 14:08:17'),
(27, 'mahmood', 'mahmood@m.com', '+201002216096', '$2y$10$v8CmWtNVaro.pPOuEgnMj.U/34x9ppSXuEtdrBRnCg7LCMcxeqzga', NULL, NULL, NULL, 0, NULL, 39126, NULL, 'ar', '2020-06-22 14:08:17'),
(28, 'Mahmood', 'mahmood@mm.com', '+201005516096', '$2y$10$uwt7CBJJpKKxp0j8RVuKeeKn26fZLSdeehnxcCKMlZEdvuKIDF/jm', NULL, NULL, NULL, 1, NULL, 38128, NULL, 'ar', '2020-06-22 14:08:17'),
(29, 'test now', 'final@gmail.com', '+201144895430', '$2y$10$L6jZSZsK3HwdErqYvRus0eTU2i5sf.ePFDKOUqiuDP7CBLcwYp60y', NULL, NULL, NULL, 0, 'Xs6eqgOP866UmC9XnCRWfNTxYLaSPSyN3kIcJIl7xIxSVQtNBlnlkqX827FP', 25511, NULL, 'ar', '2020-06-22 14:08:17'),
(30, 'mahmoodnew', 'm@m.com', '+201004416096', '$2y$10$oNic5DsG9bz3PtBdeFZcQe3dR0pX.E99MLTD1Z7xk.kj9/6OUprO2', 'server server', 9223372036854775807, '1591003842.png', 1, 'CL7LAtMB28gGCyIpjadtiocERAl4k0wbelrEgeHPLHy4QMn4VEMGqcuYvl1z', 65198, 'dhRgWDnHlSM:APA91bH7tQf_KNDnyy10vZPD3faGUe5_bHCTtkBoUxf6PhkhWxFlHjMjL-nTpUWHO_pVf9OcDemOUaj5chYwyc2WUJBXMZTNRvxShO1_OXdjB2PRSUV0ReUBDGjNMYDOrQkk_Tc3r5rU', 'ar', '2020-06-22 14:08:17'),
(31, 'mahmoodes', 'mahmood@mah.com', '+201004214096', '$2y$10$oEE.RBR36ObCgNmYWabpN.BZDt56ebm/bNVfcFPQIDgxxA6h64GEa', NULL, NULL, NULL, 0, 'A86ugIylzrp0le5pe9pjBHpP71DSWjOL4hLATfE6r8Cv8VI8Yoxvjuu5esJn', 62717, NULL, 'ar', '2020-06-22 14:08:17'),
(32, 'mahmoodww', 'mahmood@ww.com', '+201008846094', '$2y$10$3p9RgEoXenCKHp6ezepT0uAJ7UolstGJc3BaMSMXHLZxOAXT8r9Mq', NULL, NULL, NULL, 0, '6qZoAxmDNRpJRC4Z4oCXPas2l4Pw0H805OusHcikhlTzlufFcPaLSznGH7EP', 21971, NULL, 'ar', '2020-06-22 14:08:17'),
(33, 'Rashed', 'muhammad@gmail.com', '+201000389302', '$2y$10$hNQNce5rgbjRPKYeFEO6t.gJ.3Q.r7Sgzvs3aS5cFcMnPiOkDYlb2', 'Muhammad', 5884455, '1590930373.jpeg', 0, 'w7t4jULtSHuzyepzYAxHiXIUJ7u659gqySlC98SfPJ9K9bJvPZHSdbTbaRg3', 14093, NULL, 'ar', '2020-06-22 14:08:17'),
(34, 'test now', 'final@gmails.com', '+201144897430', '$2y$10$FBMkdwQV6fqNZUyCRFfQLOy4tme4HmHhR3rIRr8dQ5t4Pkuc8GPcO', NULL, NULL, NULL, 0, '5VBQilDhsVJ9XQFpqlM3ONsj5CbSk4KNTqvx8akvsv3vJ5OwTlvcm8HiDLN6', 32676, NULL, 'ar', '2020-06-22 14:08:17'),
(36, 'Magbool', 'magbool.alelyani@gmail.com', '+0556955512', '$2y$10$tSmeUildsaSJCp6HDg7i7ukbJnCh4tS5hKd6Z.DOw719KuCIEjWc6', NULL, NULL, NULL, 0, 'g3JLeelfImO1k0wHFjhKBBemYfiqoQQJ4C910Jk5ZeUFwB0BtEZRX7hwnfHc', 40329, NULL, 'ar', '2020-06-22 14:08:17'),
(37, 'live server', 'live@gmail.com', '01274850766', '$2y$10$WV7VdWLXamvdwzu57Nm7peKni2x7dFj59eLOHPxJMxb.GggM7iV/e', NULL, NULL, NULL, 1, NULL, 41329, NULL, 'ar', '2020-06-22 14:08:17'),
(38, '1test web', 'donia1@gmail.com', '123321', '$2y$10$Dn8TeptefFqOqujvWIWiPO2ohoGtYbIVc/67aiKJQe2wbcE4tPJ3m', NULL, NULL, NULL, 1, NULL, 59234, NULL, 'ar', '2020-06-22 14:08:17'),
(39, 'test2', 'test2test@gmail.com', '123654789', '$2y$10$6PGYOHCnAwwT7IFCx1ylvO4vHPLILXeyRo1iEvCjlp31yFtdKIl.6', 'ssssssssss', 94652130, '1591781186.jpeg', 1, NULL, 96268, NULL, 'ar', '2020-06-22 14:08:17'),
(40, 'user', 'user@domain.com', '01000389302', '$2y$10$Er8SPCk8j72fi3mLLMgwHuiuUfgGvO4mZRL9iuRB7ET2nIIxigG06', NULL, NULL, NULL, 1, NULL, 48855, NULL, 'ar', '2020-06-22 14:08:17'),
(41, 'Rashed', 'user2@domain.com', '+01000389302', '$2y$10$kg/d1LSwuvt/WuJVqG5xT.cQ/VHkC.a6PKyDUkNhkZB8qKwqj14c6', NULL, NULL, NULL, 1, '0xRiFKIAvY9ENnHwICBNvE7N4MiC0b9savOaqhLRV4F6QFR9XII4E9AEjr8P', 46893, NULL, 'ar', '2020-06-22 14:08:17'),
(42, 'Mohamed Fadel', 'msfadel@outlook.com', '01099026602', '$2y$10$QSdsm7tHqOPwq9cJBKS4b.OUmqjHG7fhbDTLGsYt/VZ7BMopO1.jC', NULL, NULL, NULL, 1, NULL, 42515, NULL, 'ar', '2020-06-22 14:08:17'),
(43, 'rxplus', 'rxplusmay2020@gmail.com', '+639175001572', '$2y$10$EP/1/jKr0aVvOrdy1m0dNewiwJ2jSviFqGFYIXz7wKEfOwdOduYQ.', NULL, NULL, 'default.jpg', 1, 'kxlVXM7MPlVRvnGFyXnh8xzRmxC9iUXG4sJ7dbka8CfvE5bVjZYyYxWFP2o6', 43862, NULL, 'ar', '2020-06-30 00:49:09');

-- --------------------------------------------------------

--
-- بنية الجدول `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `term_id` int(11) NOT NULL,
  `term_title` varchar(255) NOT NULL,
  `term_title_ar` varchar(255) NOT NULL,
  `term_details` text NOT NULL,
  `term_details_ar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `terms_conditions`
--

INSERT INTO `terms_conditions` (`term_id`, `term_title`, `term_title_ar`, `term_details`, `term_details_ar`) VALUES
(1, 'Lorem Ipsum is simply 1', 'هذا النص هو مثال لنص يمكن أن يستبدل 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 1', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n1'),
(2, 'Lorem Ipsum is simply 2', 'هذا النص هو مثال لنص يمكن أن يستبدل 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 2', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n 2'),
(3, 'Lorem Ipsum is simply 3', 'هذا النص هو مثال لنص يمكن أن يستبدل 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 3', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n 3'),
(4, 'Lorem Ipsum is simply 4', 'هذا النص هو مثال لنص يمكن أن يستبدل 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s 4', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\n 4');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_courses_rate_view`
-- (See below for the actual view)
--
CREATE TABLE `user_courses_rate_view` (
`avg_rate_c` bigint(13)
,`course_id` int(11)
,`course_type_id` int(11)
,`institute_id` int(11)
,`weeks_number` int(11)
,`course_name` varchar(255)
,`course_name_ar` varchar(255)
,`course_details` text
,`course_details_ar` text
,`course_photo` varchar(255)
,`course_price` float(10,2)
,`book_fees` float(10,2)
,`living_fees` float(10,2)
,`mail_fees` float(10,2)
,`summer_fees` float(10,2)
,`registration_fees` float(10,2)
,`tax_fees` float(4,2)
,`housing_price` float(10,2)
,`insurance_price` float(10,2)
,`reception_price` float(10,2)
,`c_created_at` timestamp
,`local_or_global` tinyint(1)
,`institute_name` varchar(255)
,`institute_name_ar` varchar(255)
,`institute_details` text
,`institute_details_ar` text
,`institutes_photo` varchar(255)
,`i_created_at` timestamp
,`course_rate_id` int(11)
,`course_rate_value` int(11)
,`wishlist_id` int(11)
,`course_type_name` varchar(100)
,`course_type_name_ar` varchar(100)
,`location_id` int(11)
,`city_id` int(11)
,`city_name` varchar(255)
,`city_name_ar` varchar(255)
,`country` varchar(100)
,`country_ar` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_courses_view`
-- (See below for the actual view)
--
CREATE TABLE `user_courses_view` (
`course_id` int(11)
,`course_type_id` int(11)
,`institute_id` int(11)
,`weeks_number` int(11)
,`course_name` varchar(255)
,`course_name_ar` varchar(255)
,`course_details` text
,`course_details_ar` text
,`course_photo` varchar(255)
,`course_price` float(10,2)
,`book_fees` float(10,2)
,`living_fees` float(10,2)
,`mail_fees` float(10,2)
,`summer_fees` float(10,2)
,`registration_fees` float(10,2)
,`tax_fees` float(4,2)
,`housing_price` float(10,2)
,`insurance_price` float(10,2)
,`reception_price` float(10,2)
,`c_created_at` timestamp
,`local_or_global` tinyint(1)
,`institute_name` varchar(255)
,`institute_name_ar` varchar(255)
,`institute_details` text
,`institute_details_ar` text
,`institutes_photo` varchar(255)
,`i_created_at` timestamp
,`location_id` int(11)
,`city_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_institutes_view`
-- (See below for the actual view)
--
CREATE TABLE `user_institutes_view` (
`institute_id` int(11)
,`institute_name` varchar(255)
,`institute_name_ar` varchar(255)
,`institute_details` text
,`institute_details_ar` text
,`institutes_photo` varchar(255)
,`i_created_at` timestamp
,`location_id` int(11)
,`city_id` int(11)
,`country` varchar(100)
,`country_ar` varchar(100)
,`city_name` varchar(255)
,`city_name_ar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_institute_rate_view`
-- (See below for the actual view)
--
CREATE TABLE `user_institute_rate_view` (
`avg_rate_i` bigint(13)
,`institute_id` int(11)
,`institute_name` varchar(255)
,`institute_name_ar` varchar(255)
,`institute_details` text
,`institute_details_ar` text
,`institute_email` varchar(255)
,`institutes_photo` varchar(255)
,`i_created_at` timestamp
,`location_id` int(11)
,`city_id` int(11)
,`country` varchar(100)
,`country_ar` varchar(100)
,`institute_rate_id` int(11)
,`city_name` varchar(255)
,`city_name_ar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_liked_view`
-- (See below for the actual view)
--
CREATE TABLE `user_liked_view` (
`wishlist_id` int(11)
,`course_id` int(11)
,`student_id` int(11)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
,`student_password` varchar(255)
,`verification` tinyint(1)
,`passport_photo` varchar(250)
,`student_passport_number` bigint(20)
,`student_passport_name` varchar(150)
,`activation_code` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_online_course_view`
-- (See below for the actual view)
--
CREATE TABLE `user_online_course_view` (
`online_course_id` int(11)
,`online_course_name` varchar(255)
,`online_course_name_ar` varchar(255)
,`online_course_details` text
,`online_course_details_ar` text
,`online_course_link` text
,`institute_id` int(11)
,`created_at` timestamp
,`online_course_photo` varchar(255)
,`institute_name` varchar(255)
,`institute_name_ar` varchar(255)
,`i_created_at` timestamp
,`institutes_photo` varchar(255)
,`institute_details_ar` text
,`institute_details` text
,`city_id` int(11)
,`location_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_reservations_view`
-- (See below for the actual view)
--
CREATE TABLE `user_reservations_view` (
`course_id` int(11)
,`course_name_ar` varchar(255)
,`course_name` varchar(255)
,`course_details` text
,`course_details_ar` text
,`course_photo` varchar(255)
,`start_at` date
,`created_at` timestamp
,`reservation_id` int(11)
,`reservation_status` tinyint(1)
,`complete` tinyint(1)
,`course_price` float(10,2)
,`activation_code` int(11)
,`verification` tinyint(1)
,`student_id` int(11)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_passport_name` varchar(150)
,`student_passport_number` bigint(20)
,`passport_photo` varchar(250)
,`book_fees` float(10,2)
,`living_fees` float(10,2)
,`mail_fees` float(10,2)
,`summer_fees` float(10,2)
,`registration_fees` float(10,2)
,`tax_fees` float(4,2)
,`housing_price` float(10,2)
,`country` varchar(100)
,`country_ar` varchar(100)
,`city_name_ar` varchar(255)
,`city_name` varchar(255)
,`insurance_price` float(10,2)
,`reception_price` float(10,2)
,`weeks_number` int(11)
,`c_created_at` timestamp
,`medical_insurance_id` int(11)
,`medical_insurance_name` varchar(255)
,`medical_insurance_name_ar` varchar(255)
,`medical_insurance_price` float(10,2)
,`airport_rec_id` int(11)
,`airport_rec_name` varchar(255)
,`airport_rec_name_ar` varchar(255)
,`living_id` int(11)
,`living_price` float(10,2)
,`living_name` varchar(255)
,`living_name_ar` varchar(255)
,`institute_name` varchar(255)
,`institute_details` text
,`institute_details_ar` text
,`institute_name_ar` varchar(255)
,`institute_email` varchar(255)
,`airport_rec_price` float(10,2)
,`total` double(19,2)
,`end_date` date
,`week_price` double(19,2)
,`reserved_weeks_number` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_student_whislist`
-- (See below for the actual view)
--
CREATE TABLE `user_student_whislist` (
`student_id` int(11)
,`student_name` varchar(100)
,`student_email` varchar(50)
,`student_phone` varchar(20)
,`student_password` varchar(255)
,`student_passport_name` varchar(150)
,`student_passport_number` bigint(20)
,`passport_photo` varchar(250)
,`verification` tinyint(1)
,`activation_code` int(11)
,`wishlist_id` int(11)
,`avg_rate_c` bigint(13)
,`course_name` varchar(255)
,`course_name_ar` varchar(255)
,`course_details` text
,`course_details_ar` text
,`course_photo` varchar(255)
,`course_price` float(10,2)
,`institute_name` varchar(255)
,`institute_name_ar` varchar(255)
,`course_id` int(11)
);

-- --------------------------------------------------------

--
-- بنية الجدول `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_title_ar` varchar(255) NOT NULL,
  `cover_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `videos`
--

INSERT INTO `videos` (`video_id`, `video_url`, `video_title`, `video_title_ar`, `cover_photo`) VALUES
(1, '1.mp4', 'Lorem Ipsum1', 'هذا النص هو مثال لنص يمكن أن يستبدل 1', '1.jpg'),
(2, '2.mp4', 'Lorem Ipsum2', 'هذا النص هو مثال لنص يمكن أن يستبدل 2', '2.jpg'),
(3, '3.mp4', 'Lorem Ipsum1', 'هذا النص هو مثال لنص يمكن أن يستبدل 3', '3.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `website_info`
--

CREATE TABLE `website_info` (
  `info_id` int(11) NOT NULL,
  `info_mail` varchar(255) NOT NULL,
  `info_phone` varchar(25) NOT NULL,
  `info_city` varchar(255) NOT NULL,
  `info_city_ar` varchar(255) NOT NULL,
  `info_country` varchar(255) NOT NULL,
  `info_country_ar` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT 'logo.png',
  `logo2` varchar(255) NOT NULL DEFAULT 'logo2.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `website_info`
--

INSERT INTO `website_info` (`info_id`, `info_mail`, `info_phone`, `info_city`, `info_city_ar`, `info_country`, `info_country_ar`, `logo`, `logo2`) VALUES
(1, 'nameemail@gmail.com', '+966 123 456 789', 'Al Riyadh', 'الرياض', ' Saudi Arabia', 'السعودية', 'kas.png', 'kas2.png');

-- --------------------------------------------------------

--
-- بنية الجدول `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `student_id`, `course_id`) VALUES
(3, 4, 4),
(4, 4, 5),
(5, 3, 4),
(6, 3, 3),
(7, 3, 5),
(9, 24, 2),
(10, 25, 2),
(13, 29, 2),
(24, 30, 3),
(25, 30, 1),
(27, 1, 2),
(28, 39, 1);

-- --------------------------------------------------------

--
-- Structure for view `admin_contact_st`
--
DROP TABLE IF EXISTS `admin_contact_st`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `admin_contact_st`  AS  select `students`.`student_id` AS `student_id`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone`,`students`.`student_password` AS `student_password`,`students`.`student_passport_name` AS `student_passport_name`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`passport_photo` AS `passport_photo`,`students`.`verification` AS `verification`,`students`.`access_token` AS `access_token`,`students`.`activation_code` AS `activation_code`,`students`.`st_created_at` AS `st_created_at`,`students`.`fcm_token` AS `fcm_token`,`students`.`mob_lang` AS `mob_lang`,`message_title`.`message_title_id` AS `message_title_id`,`message_title`.`message_title` AS `message_title`,`message_title`.`message_title_ar` AS `message_title_ar`,`contact_us`.`message` AS `message`,`contact_us`.`sent_at` AS `sent_at`,`contact_us`.`read_message` AS `read_message`,`contact_us`.`message_reply` AS `message_reply`,`contact_us`.`message_id` AS `message_id` from ((`contact_us` join `message_title` on(`contact_us`.`message_title_id` = `message_title`.`message_title_id`)) join `students` on(`contact_us`.`student_id` = `students`.`student_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `admin_courses_user_rates`
--
DROP TABLE IF EXISTS `admin_courses_user_rates`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `admin_courses_user_rates`  AS  select `course_rating`.`course_rate_id` AS `course_rate_id`,`course_rating`.`course_rate_value` AS `course_rate_value`,`course_rating`.`rate_created_at` AS `rate_created_at`,`courses`.`course_id` AS `course_id`,`courses`.`course_type_id` AS `course_type_id`,`courses`.`institute_id` AS `institute_id`,`courses`.`weeks_number` AS `weeks_number`,`courses`.`course_name` AS `course_name`,`courses`.`course_name_ar` AS `course_name_ar`,`courses`.`course_details` AS `course_details`,`courses`.`course_details_ar` AS `course_details_ar`,`courses`.`course_photo` AS `course_photo`,`courses`.`course_price` AS `course_price`,`courses`.`book_fees` AS `book_fees`,`courses`.`living_fees` AS `living_fees`,`courses`.`mail_fees` AS `mail_fees`,`courses`.`summer_fees` AS `summer_fees`,`courses`.`registration_fees` AS `registration_fees`,`courses`.`tax_fees` AS `tax_fees`,`courses`.`housing_price` AS `housing_price`,`courses`.`insurance_price` AS `insurance_price`,`courses`.`reception_price` AS `reception_price`,`courses`.`c_created_at` AS `c_created_at`,`courses`.`local_or_global` AS `local_or_global`,`students`.`student_id` AS `student_id`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone`,`students`.`student_password` AS `student_password`,`students`.`student_passport_name` AS `student_passport_name`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`passport_photo` AS `passport_photo`,`students`.`verification` AS `verification`,`students`.`access_token` AS `access_token`,`students`.`activation_code` AS `activation_code`,`students`.`st_created_at` AS `st_created_at` from ((`course_rating` join `courses` on(`course_rating`.`course_id` = `courses`.`course_id`)) join `students` on(`course_rating`.`student_id` = `students`.`student_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `admin_institute_rateuser`
--
DROP TABLE IF EXISTS `admin_institute_rateuser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `admin_institute_rateuser`  AS  select `students`.`student_name` AS `student_name`,`institute_rating`.`institute_rate_id` AS `institute_rate_id`,`institute_rating`.`institute_rate_value` AS `institute_rate_value`,`institute_rating`.`student_id` AS `student_id`,`institute_rating`.`rate_created_at` AS `rate_created_at`,`students`.`passport_photo` AS `passport_photo`,`institutes`.`institute_id` AS `institute_id` from ((`institutes` join `institute_rating` on(`institutes`.`institute_id` = `institute_rating`.`institute_id`)) join `students` on(`institute_rating`.`student_id` = `students`.`student_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `admin_msg_noti`
--
DROP TABLE IF EXISTS `admin_msg_noti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `admin_msg_noti`  AS  select `contact_us_noti`.`message_id` AS `message_id`,`contact_us_noti`.`student_id` AS `student_id`,`contact_us_noti`.`message_title_id` AS `message_title_id`,`contact_us_noti`.`sent_at` AS `sent_at`,`contact_us_noti`.`read_message` AS `read_message`,`message_title`.`message_title` AS `message_title`,`message_title`.`message_title_ar` AS `message_title_ar`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`passport_photo` AS `passport_photo`,`students`.`student_passport_name` AS `student_passport_name` from ((`contact_us_noti` join `students` on(`contact_us_noti`.`student_id` = `students`.`student_id`)) join `message_title` on(`contact_us_noti`.`message_title_id` = `message_title`.`message_title_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `admin_reservation_noti`
--
DROP TABLE IF EXISTS `admin_reservation_noti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `admin_reservation_noti`  AS  select `reservation_admin_noti`.`reservation_id` AS `reservation_id`,`reservation_admin_noti`.`student_id` AS `student_id`,`reservation_admin_noti`.`course_id` AS `course_id`,`reservation_admin_noti`.`read_at` AS `read_at`,`reservation_admin_noti`.`reserved_at` AS `reserved_at`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone` from (`reservation_admin_noti` join `students` on(`reservation_admin_noti`.`student_id` = `students`.`student_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `admin_resets_st`
--
DROP TABLE IF EXISTS `admin_resets_st`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `admin_resets_st`  AS  select `students`.`student_id` AS `student_id`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone`,`students`.`student_password` AS `student_password`,`students`.`student_passport_name` AS `student_passport_name`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`passport_photo` AS `passport_photo`,`students`.`verification` AS `verification`,`students`.`access_token` AS `access_token`,`students`.`activation_code` AS `activation_code`,`students`.`st_created_at` AS `st_created_at`,`students`.`fcm_token` AS `fcm_token`,`students`.`mob_lang` AS `mob_lang`,`pass_resets`.`reset_id` AS `reset_id`,`pass_resets`.`reset_token` AS `reset_token`,`pass_resets`.`reset_at` AS `reset_at` from (`pass_resets` join `students` on(`students`.`student_id` = `pass_resets`.`student_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_courses_rate_view`
--
DROP TABLE IF EXISTS `user_courses_rate_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_courses_rate_view`  AS  select ceiling(avg(`course_rating`.`course_rate_value`)) AS `avg_rate_c`,`courses`.`course_id` AS `course_id`,`courses`.`course_type_id` AS `course_type_id`,`courses`.`institute_id` AS `institute_id`,`courses`.`weeks_number` AS `weeks_number`,`courses`.`course_name` AS `course_name`,`courses`.`course_name_ar` AS `course_name_ar`,`courses`.`course_details` AS `course_details`,`courses`.`course_details_ar` AS `course_details_ar`,`courses`.`course_photo` AS `course_photo`,`courses`.`course_price` AS `course_price`,`courses`.`book_fees` AS `book_fees`,`courses`.`living_fees` AS `living_fees`,`courses`.`mail_fees` AS `mail_fees`,`courses`.`summer_fees` AS `summer_fees`,`courses`.`registration_fees` AS `registration_fees`,`courses`.`tax_fees` AS `tax_fees`,`courses`.`housing_price` AS `housing_price`,`courses`.`insurance_price` AS `insurance_price`,`courses`.`reception_price` AS `reception_price`,`courses`.`c_created_at` AS `c_created_at`,`courses`.`local_or_global` AS `local_or_global`,`institutes`.`institute_name` AS `institute_name`,`institutes`.`institute_name_ar` AS `institute_name_ar`,`institutes`.`institute_details` AS `institute_details`,`institutes`.`institute_details_ar` AS `institute_details_ar`,`institutes`.`institutes_photo` AS `institutes_photo`,`institutes`.`i_created_at` AS `i_created_at`,`course_rating`.`course_rate_id` AS `course_rate_id`,`course_rating`.`course_rate_value` AS `course_rate_value`,`wishlist`.`wishlist_id` AS `wishlist_id`,`course_type`.`course_type_name` AS `course_type_name`,`course_type`.`course_type_name_ar` AS `course_type_name_ar`,`institutes`.`location_id` AS `location_id`,`institutes`.`city_id` AS `city_id`,`institutes_citites`.`city_name` AS `city_name`,`institutes_citites`.`city_name_ar` AS `city_name_ar`,`institute_location`.`country` AS `country`,`institute_location`.`country_ar` AS `country_ar` from ((((((`courses` join `institutes` on(`courses`.`institute_id` = `institutes`.`institute_id`)) left join `course_rating` on(`courses`.`course_id` = `course_rating`.`course_id`)) join `course_type` on(`courses`.`course_type_id` = `course_type`.`course_type_id`)) left join `wishlist` on(`courses`.`course_id` = `wishlist`.`course_id`)) join `institute_location` on(`institutes`.`location_id` = `institute_location`.`location_id`)) join `institutes_citites` on(`institutes`.`city_id` = `institutes_citites`.`city_id`)) group by `courses`.`course_id`,`course_type`.`course_type_id` ;

-- --------------------------------------------------------

--
-- Structure for view `user_courses_view`
--
DROP TABLE IF EXISTS `user_courses_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_courses_view`  AS  select `courses`.`course_id` AS `course_id`,`courses`.`course_type_id` AS `course_type_id`,`courses`.`institute_id` AS `institute_id`,`courses`.`weeks_number` AS `weeks_number`,`courses`.`course_name` AS `course_name`,`courses`.`course_name_ar` AS `course_name_ar`,`courses`.`course_details` AS `course_details`,`courses`.`course_details_ar` AS `course_details_ar`,`courses`.`course_photo` AS `course_photo`,`courses`.`course_price` AS `course_price`,`courses`.`book_fees` AS `book_fees`,`courses`.`living_fees` AS `living_fees`,`courses`.`mail_fees` AS `mail_fees`,`courses`.`summer_fees` AS `summer_fees`,`courses`.`registration_fees` AS `registration_fees`,`courses`.`tax_fees` AS `tax_fees`,`courses`.`housing_price` AS `housing_price`,`courses`.`insurance_price` AS `insurance_price`,`courses`.`reception_price` AS `reception_price`,`courses`.`c_created_at` AS `c_created_at`,`courses`.`local_or_global` AS `local_or_global`,`institutes`.`institute_name` AS `institute_name`,`institutes`.`institute_name_ar` AS `institute_name_ar`,`institutes`.`institute_details` AS `institute_details`,`institutes`.`institute_details_ar` AS `institute_details_ar`,`institutes`.`institutes_photo` AS `institutes_photo`,`institutes`.`i_created_at` AS `i_created_at`,`institutes`.`location_id` AS `location_id`,`institutes`.`city_id` AS `city_id` from (`courses` join `institutes` on(`courses`.`institute_id` = `institutes`.`institute_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_institutes_view`
--
DROP TABLE IF EXISTS `user_institutes_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_institutes_view`  AS  select `institutes`.`institute_id` AS `institute_id`,`institutes`.`institute_name` AS `institute_name`,`institutes`.`institute_name_ar` AS `institute_name_ar`,`institutes`.`institute_details` AS `institute_details`,`institutes`.`institute_details_ar` AS `institute_details_ar`,`institutes`.`institutes_photo` AS `institutes_photo`,`institutes`.`i_created_at` AS `i_created_at`,`institutes`.`location_id` AS `location_id`,`institutes`.`city_id` AS `city_id`,`institute_location`.`country` AS `country`,`institute_location`.`country_ar` AS `country_ar`,`institutes_citites`.`city_name` AS `city_name`,`institutes_citites`.`city_name_ar` AS `city_name_ar` from ((`institutes` join `institute_location` on(`institutes`.`location_id` = `institute_location`.`location_id`)) join `institutes_citites` on(`institutes`.`city_id` = `institutes_citites`.`city_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_institute_rate_view`
--
DROP TABLE IF EXISTS `user_institute_rate_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_institute_rate_view`  AS  select ceiling(avg(`institute_rating`.`institute_rate_value`)) AS `avg_rate_i`,`institutes`.`institute_id` AS `institute_id`,`institutes`.`institute_name` AS `institute_name`,`institutes`.`institute_name_ar` AS `institute_name_ar`,`institutes`.`institute_details` AS `institute_details`,`institutes`.`institute_details_ar` AS `institute_details_ar`,`institutes`.`institute_email` AS `institute_email`,`institutes`.`institutes_photo` AS `institutes_photo`,`institutes`.`i_created_at` AS `i_created_at`,`institutes`.`location_id` AS `location_id`,`institutes`.`city_id` AS `city_id`,`institute_location`.`country` AS `country`,`institute_location`.`country_ar` AS `country_ar`,`institute_rating`.`institute_rate_id` AS `institute_rate_id`,`institutes_citites`.`city_name` AS `city_name`,`institutes_citites`.`city_name_ar` AS `city_name_ar` from (((`institutes` join `institute_location` on(`institutes`.`location_id` = `institute_location`.`location_id`)) left join `institute_rating` on(`institutes`.`institute_id` = `institute_rating`.`institute_id`)) join `institutes_citites` on(`institutes`.`city_id` = `institutes_citites`.`city_id`)) group by `institutes`.`institute_id` ;

-- --------------------------------------------------------

--
-- Structure for view `user_liked_view`
--
DROP TABLE IF EXISTS `user_liked_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_liked_view`  AS  select `wishlist`.`wishlist_id` AS `wishlist_id`,`wishlist`.`course_id` AS `course_id`,`students`.`student_id` AS `student_id`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone`,`students`.`student_password` AS `student_password`,`students`.`verification` AS `verification`,`students`.`passport_photo` AS `passport_photo`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`student_passport_name` AS `student_passport_name`,`students`.`activation_code` AS `activation_code` from (`wishlist` join `students` on(`wishlist`.`student_id` = `students`.`student_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_online_course_view`
--
DROP TABLE IF EXISTS `user_online_course_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_online_course_view`  AS  select `online_courses`.`online_course_id` AS `online_course_id`,`online_courses`.`online_course_name` AS `online_course_name`,`online_courses`.`online_course_name_ar` AS `online_course_name_ar`,`online_courses`.`online_course_details` AS `online_course_details`,`online_courses`.`online_course_details_ar` AS `online_course_details_ar`,`online_courses`.`online_course_link` AS `online_course_link`,`online_courses`.`institute_id` AS `institute_id`,`online_courses`.`created_at` AS `created_at`,`online_courses`.`online_course_photo` AS `online_course_photo`,`institutes`.`institute_name` AS `institute_name`,`institutes`.`institute_name_ar` AS `institute_name_ar`,`institutes`.`i_created_at` AS `i_created_at`,`institutes`.`institutes_photo` AS `institutes_photo`,`institutes`.`institute_details_ar` AS `institute_details_ar`,`institutes`.`institute_details` AS `institute_details`,`institutes`.`city_id` AS `city_id`,`institutes`.`location_id` AS `location_id` from (`online_courses` join `institutes` on(`online_courses`.`institute_id` = `institutes`.`institute_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_reservations_view`
--
DROP TABLE IF EXISTS `user_reservations_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_reservations_view`  AS  select `courses`.`course_id` AS `course_id`,`courses`.`course_name_ar` AS `course_name_ar`,`courses`.`course_name` AS `course_name`,`courses`.`course_details` AS `course_details`,`courses`.`course_details_ar` AS `course_details_ar`,`courses`.`course_photo` AS `course_photo`,`reservations`.`start_at` AS `start_at`,`reservations`.`created_at` AS `created_at`,`reservations`.`reservation_id` AS `reservation_id`,`reservations`.`reservation_status` AS `reservation_status`,`reservations`.`complete` AS `complete`,`courses`.`course_price` AS `course_price`,`students`.`activation_code` AS `activation_code`,`students`.`verification` AS `verification`,`students`.`student_id` AS `student_id`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_passport_name` AS `student_passport_name`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`passport_photo` AS `passport_photo`,`courses`.`book_fees` AS `book_fees`,`courses`.`living_fees` AS `living_fees`,`courses`.`mail_fees` AS `mail_fees`,`courses`.`summer_fees` AS `summer_fees`,`courses`.`registration_fees` AS `registration_fees`,`courses`.`tax_fees` AS `tax_fees`,`courses`.`housing_price` AS `housing_price`,`institute_location`.`country` AS `country`,`institute_location`.`country_ar` AS `country_ar`,`institutes_citites`.`city_name_ar` AS `city_name_ar`,`institutes_citites`.`city_name` AS `city_name`,`courses`.`insurance_price` AS `insurance_price`,`courses`.`reception_price` AS `reception_price`,`courses`.`weeks_number` AS `weeks_number`,`courses`.`c_created_at` AS `c_created_at`,`medical_insurance`.`medical_insurance_id` AS `medical_insurance_id`,`medical_insurance`.`medical_insurance_name` AS `medical_insurance_name`,`medical_insurance`.`medical_insurance_name_ar` AS `medical_insurance_name_ar`,`medical_insurance`.`medical_insurance_price` AS `medical_insurance_price`,`airport_rec`.`airport_rec_id` AS `airport_rec_id`,`airport_rec`.`airport_rec_name` AS `airport_rec_name`,`airport_rec`.`airport_rec_name_ar` AS `airport_rec_name_ar`,`living`.`living_id` AS `living_id`,`living`.`living_price` AS `living_price`,`living`.`living_name` AS `living_name`,`living`.`living_name_ar` AS `living_name_ar`,`institutes`.`institute_name` AS `institute_name`,`institutes`.`institute_details` AS `institute_details`,`institutes`.`institute_details_ar` AS `institute_details_ar`,`institutes`.`institute_name_ar` AS `institute_name_ar`,`institutes`.`institute_email` AS `institute_email`,`airport_rec`.`airport_rec_price` AS `airport_rec_price`,round(`courses`.`registration_fees` + `courses`.`summer_fees` + `courses`.`course_price` / `courses`.`weeks_number` * `reservations`.`reserved_weeks_number` + `courses`.`book_fees` + `courses`.`living_fees` + `courses`.`mail_fees` + `medical_insurance`.`medical_insurance_price` + `living`.`living_price` + `airport_rec`.`airport_rec_price` + (`courses`.`registration_fees` + `courses`.`summer_fees` + `courses`.`course_price` / `courses`.`weeks_number` * `reservations`.`reserved_weeks_number` + `courses`.`book_fees` + `courses`.`living_fees` + `courses`.`mail_fees` + `medical_insurance`.`medical_insurance_price` + `living`.`living_price` + `airport_rec`.`airport_rec_price`) * `courses`.`tax_fees`,2) AS `total`,`reservations`.`start_at` + interval (`reservations`.`reserved_weeks_number` * 7) day AS `end_date`,round(`courses`.`course_price` / `courses`.`weeks_number`,2) AS `week_price`,`reservations`.`reserved_weeks_number` AS `reserved_weeks_number` from ((((((((`reservations` join `courses` on(`reservations`.`course_id` = `courses`.`course_id`)) join `students` on(`reservations`.`student_id` = `students`.`student_id`)) left join `medical_insurance` on(`reservations`.`medical_insurance_id` = `medical_insurance`.`medical_insurance_id`)) left join `airport_rec` on(`reservations`.`airport_rec_id` = `airport_rec`.`airport_rec_id`)) left join `living` on(`reservations`.`living_id` = `living`.`living_id`)) join `institutes` on(`courses`.`institute_id` = `institutes`.`institute_id`)) join `institute_location` on(`institutes`.`location_id` = `institute_location`.`location_id`)) join `institutes_citites` on(`institutes`.`city_id` = `institutes_citites`.`city_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_student_whislist`
--
DROP TABLE IF EXISTS `user_student_whislist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uriallab`@`localhost` SQL SECURITY DEFINER VIEW `user_student_whislist`  AS  select `students`.`student_id` AS `student_id`,`students`.`student_name` AS `student_name`,`students`.`student_email` AS `student_email`,`students`.`student_phone` AS `student_phone`,`students`.`student_password` AS `student_password`,`students`.`student_passport_name` AS `student_passport_name`,`students`.`student_passport_number` AS `student_passport_number`,`students`.`passport_photo` AS `passport_photo`,`students`.`verification` AS `verification`,`students`.`activation_code` AS `activation_code`,`wishlist`.`wishlist_id` AS `wishlist_id`,`user_courses_rate_view`.`avg_rate_c` AS `avg_rate_c`,`user_courses_rate_view`.`course_name` AS `course_name`,`user_courses_rate_view`.`course_name_ar` AS `course_name_ar`,`user_courses_rate_view`.`course_details` AS `course_details`,`user_courses_rate_view`.`course_details_ar` AS `course_details_ar`,`user_courses_rate_view`.`course_photo` AS `course_photo`,`user_courses_rate_view`.`course_price` AS `course_price`,`user_courses_rate_view`.`institute_name` AS `institute_name`,`user_courses_rate_view`.`institute_name_ar` AS `institute_name_ar`,`user_courses_rate_view`.`course_id` AS `course_id` from ((`wishlist` join `students` on(`wishlist`.`student_id` = `students`.`student_id`)) join `user_courses_rate_view` on(`user_courses_rate_view`.`course_id` = `wishlist`.`course_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ads_app`
--
ALTER TABLE `ads_app`
  ADD PRIMARY KEY (`ads_id`);

--
-- Indexes for table `airport_rec`
--
ALTER TABLE `airport_rec`
  ADD PRIMARY KEY (`airport_rec_id`),
  ADD KEY `airport_rec_course_id` (`course_id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `contact_us_student_id` (`student_id`),
  ADD KEY `contact_us_message_title_id` (`message_title_id`);

--
-- Indexes for table `contact_us_noti`
--
ALTER TABLE `contact_us_noti`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courses_type_id` (`course_type_id`),
  ADD KEY `courses_institute_id` (`institute_id`);

--
-- Indexes for table `course_rating`
--
ALTER TABLE `course_rating`
  ADD PRIMARY KEY (`course_rate_id`),
  ADD KEY `rating_course_id` (`course_id`),
  ADD KEY `rating_student_id` (`student_id`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`course_type_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`institute_id`),
  ADD KEY `institute_location_id` (`location_id`),
  ADD KEY `institute_city_id` (`city_id`);

--
-- Indexes for table `institutes_citites`
--
ALTER TABLE `institutes_citites`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `citites_location_id` (`location_id`);

--
-- Indexes for table `institute_location`
--
ALTER TABLE `institute_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `institute_rating`
--
ALTER TABLE `institute_rating`
  ADD PRIMARY KEY (`institute_rate_id`),
  ADD KEY `institute_rating_inst_id` (`institute_id`),
  ADD KEY `institute_rating_student_id` (`student_id`);

--
-- Indexes for table `living`
--
ALTER TABLE `living`
  ADD PRIMARY KEY (`living_id`),
  ADD KEY `living_course_id` (`course_id`);

--
-- Indexes for table `medical_insurance`
--
ALTER TABLE `medical_insurance`
  ADD PRIMARY KEY (`medical_insurance_id`),
  ADD KEY `medical_insurance_course_id` (`course_id`);

--
-- Indexes for table `message_title`
--
ALTER TABLE `message_title`
  ADD PRIMARY KEY (`message_title_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `notes_student_id` (`student_id`);

--
-- Indexes for table `online_courses`
--
ALTER TABLE `online_courses`
  ADD PRIMARY KEY (`online_course_id`),
  ADD KEY `online_course_inst_id` (`institute_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(250));

--
-- Indexes for table `pass_resets`
--
ALTER TABLE `pass_resets`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservations_st_id` (`student_id`),
  ADD KEY `reservations_cop_id` (`coupon`),
  ADD KEY `reservations_course_id` (`course_id`),
  ADD KEY `reservations_living_id` (`living_id`),
  ADD KEY `reservations_airport_rec` (`airport_rec_id`),
  ADD KEY `reservations_medical_insurance` (`medical_insurance_id`);

--
-- Indexes for table `reservation_admin_noti`
--
ALTER TABLE `reservation_admin_noti`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `reservation_noti`
--
ALTER TABLE `reservation_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_email` (`student_email`),
  ADD UNIQUE KEY `student_phone` (`student_phone`),
  ADD UNIQUE KEY `student_passport_number` (`student_passport_number`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `website_info`
--
ALTER TABLE `website_info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `wishlist_st_id` (`student_id`),
  ADD KEY `wishlist_coruse_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads_app`
--
ALTER TABLE `ads_app`
  MODIFY `ads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `airport_rec`
--
ALTER TABLE `airport_rec`
  MODIFY `airport_rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_rating`
--
ALTER TABLE `course_rating`
  MODIFY `course_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `course_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `institute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `institutes_citites`
--
ALTER TABLE `institutes_citites`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `institute_location`
--
ALTER TABLE `institute_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `institute_rating`
--
ALTER TABLE `institute_rating`
  MODIFY `institute_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `living`
--
ALTER TABLE `living`
  MODIFY `living_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medical_insurance`
--
ALTER TABLE `medical_insurance`
  MODIFY `medical_insurance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `message_title`
--
ALTER TABLE `message_title`
  MODIFY `message_title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `online_courses`
--
ALTER TABLE `online_courses`
  MODIFY `online_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pass_resets`
--
ALTER TABLE `pass_resets`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservation_noti`
--
ALTER TABLE `reservation_noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `website_info`
--
ALTER TABLE `website_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `airport_rec`
--
ALTER TABLE `airport_rec`
  ADD CONSTRAINT `airport_rec_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_message_title_id` FOREIGN KEY (`message_title_id`) REFERENCES `message_title` (`message_title_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_us_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_institute_id` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`institute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_type_id` FOREIGN KEY (`course_type_id`) REFERENCES `course_type` (`course_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `course_rating`
--
ALTER TABLE `course_rating`
  ADD CONSTRAINT `rating_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `institutes`
--
ALTER TABLE `institutes`
  ADD CONSTRAINT `institute_city_id` FOREIGN KEY (`city_id`) REFERENCES `institutes_citites` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `institute_location_id` FOREIGN KEY (`location_id`) REFERENCES `institute_location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `institutes_citites`
--
ALTER TABLE `institutes_citites`
  ADD CONSTRAINT `citites_location_id` FOREIGN KEY (`location_id`) REFERENCES `institute_location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `institute_rating`
--
ALTER TABLE `institute_rating`
  ADD CONSTRAINT `institute_rating_inst_id` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`institute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `institute_rating_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `living`
--
ALTER TABLE `living`
  ADD CONSTRAINT `living_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `medical_insurance`
--
ALTER TABLE `medical_insurance`
  ADD CONSTRAINT `medical_insurance_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `online_courses`
--
ALTER TABLE `online_courses`
  ADD CONSTRAINT `online_course_inst_id` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`institute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_airport_rec` FOREIGN KEY (`airport_rec_id`) REFERENCES `airport_rec` (`airport_rec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_living_id` FOREIGN KEY (`living_id`) REFERENCES `living` (`living_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_medical_insurance` FOREIGN KEY (`medical_insurance_id`) REFERENCES `medical_insurance` (`medical_insurance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_st_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_coruse_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_st_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
