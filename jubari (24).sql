-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 04 فبراير 2021 الساعة 02:52
-- إصدار الخادم: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jubari`
--

-- --------------------------------------------------------

--
-- بنية الجدول `adds`
--

DROP TABLE IF EXISTS `adds`;
CREATE TABLE IF NOT EXISTS `adds` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adds_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adds_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adds_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(255) NOT NULL DEFAULT '1',
  `is_delete` int(255) NOT NULL DEFAULT '0',
  `how_create_it` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `adds_users`
--

DROP TABLE IF EXISTS `adds_users`;
CREATE TABLE IF NOT EXISTS `adds_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `adds_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1:send from admin',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `airlines`
--

DROP TABLE IF EXISTS `airlines`;
CREATE TABLE IF NOT EXISTS `airlines` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `airline_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `how_add_it` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `airline_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IATA` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `bus_services`
--

DROP TABLE IF EXISTS `bus_services`;
CREATE TABLE IF NOT EXISTS `bus_services` (
  `bus_id` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ses_status` int(11) NOT NULL,
  `bus_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dep_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `arr_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_date` date NOT NULL,
  `bus_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_to_supp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_cost` decimal(8,2) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `service_id` int(11) NOT NULL,
  `passnger_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `service_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT '0',
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_num` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `errorlog` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `bookmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `bus_services`
--

INSERT INTO `bus_services` (`bus_id`, `Issue_date`, `refernce`, `passenger_name`, `ses_status`, `bus_number`, `Dep_city`, `arr_city`, `dep_date`, `bus_name`, `due_to_supp`, `provider_cost`, `ses_cur_id`, `due_to_customer`, `cost`, `service_id`, `passnger_currency`, `remark`, `deleted`, `service_status`, `created_at`, `updated_at`, `user_id`, `user_status`, `attachment`, `bill_num`, `errorlog`, `how_add_bill`, `bookmark`, `how_add_bookmark`, `manager_id`) VALUES
('73d90acc-6215-4b3b-87b6-cb941a42e620', '2021-01-28', '88', 'KJYJHFBGBV', 3, '7000000000', 'jnm/b', 'jkm/htu/hg', '2021-01-28', 'L;IHGTYFG', '3', '800.00', 1, '9', '900.00', 2, 'YER', 'KJHHGBDVC', 0, 2, '2021-01-28 08:34:33', '2021-01-28 08:35:01', '9', 0, '828420.PNG,', NULL, 0, 0, '0', 0, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `car_services`
--

DROP TABLE IF EXISTS `car_services`;
CREATE TABLE IF NOT EXISTS `car_services` (
  `car_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passenger_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ses_status` int(1) NOT NULL DEFAULT '1',
  `voucher_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_info` text COLLATE utf8_unicode_ci NOT NULL,
  `Dep_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `arr_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dep_date` date NOT NULL,
  `due_to_supp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_cost` decimal(50,0) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(50,0) NOT NULL,
  `passnger_currency` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `service_status` int(1) NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` int(1) NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `errorlog` int(1) NOT NULL DEFAULT '0',
  `bill_num` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `bookmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `cur_id` int(11) NOT NULL,
  `cur_name` varchar(10) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `currency`
--

INSERT INTO `currency` (`cur_id`, `cur_name`, `is_active`) VALUES
(1, 'YER ', 1),
(2, 'USD ', 1),
(3, 'SAR', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(250) NOT NULL,
  `cus_account` bigint(20) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_title` varchar(255) NOT NULL,
  `telephon1` bigint(11) NOT NULL,
  `telephon2` bigint(11) NOT NULL,
  `fax1` varchar(255) NOT NULL,
  `fax2` varchar(255) NOT NULL,
  `whatsapp` bigint(11) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `country` varchar(255) NOT NULL,
  `def_currency` varchar(255) NOT NULL,
  `vip` int(11) NOT NULL DEFAULT '1',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `how_create_it` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `emp_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_middel_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_thired_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_hirdate` date NOT NULL,
  `emp_salary` decimal(8,2) NOT NULL,
  `emp_ssn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `emp_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `attchment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `general_services`
--

DROP TABLE IF EXISTS `general_services`;
CREATE TABLE IF NOT EXISTS `general_services` (
  `gen_id` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ses_status` int(11) NOT NULL,
  `voucher_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gen_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_to_supp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_cost` decimal(8,2) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `service_id` int(11) NOT NULL,
  `passnger_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `service_status` int(11) NOT NULL,
  `general_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT '0',
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `busher_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `errorlog` int(11) NOT NULL DEFAULT '0',
  `bill_num` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `bookmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `hotel_services`
--

DROP TABLE IF EXISTS `hotel_services`;
CREATE TABLE IF NOT EXISTS `hotel_services` (
  `hotel_id` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ses_status` int(11) NOT NULL,
  `voucher_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_out` date NOT NULL,
  `check_in` date NOT NULL,
  `due_to_supp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_cost` decimal(8,2) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `service_id` int(11) NOT NULL,
  `passnger_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `service_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT '0',
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `errorlog` int(11) NOT NULL DEFAULT '0',
  `bill_num` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `bookmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remarker_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `main_servic_id` int(11) NOT NULL,
  `service_id` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark_body` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- بنية الجدول `medical_services`
--

DROP TABLE IF EXISTS `medical_services`;
CREATE TABLE IF NOT EXISTS `medical_services` (
  `med_id` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ses_status` int(11) NOT NULL,
  `document_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `med_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dep_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `arr_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_date` date NOT NULL,
  `due_to_supp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_cost` decimal(8,2) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `service_id` int(11) NOT NULL,
  `passnger_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `service_status` int(11) NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT '0',
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `errorlog` int(11) NOT NULL DEFAULT '0',
  `bill_num` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bookmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2020_12_10_152801_department_table', 1),
(3, '2020_12_10_163821_employee_table', 1),
(4, '2020_12_11_004601_create_airlines_table', 1),
(5, '2020_12_12_063730_create_roles_table', 1),
(6, '2020_12_12_155020_create_adds_table', 1),
(7, '2020_12_12_180105_create__service_table', 1),
(8, '2020_12_15_010321_create_users_table', 1),
(9, '2020_12_16_195630_create__ticket_service_table', 2),
(10, '2020_12_17_065620_create__bus_service_table', 2),
(11, '2020_12_17_070154_create__hotel_service_table', 2),
(12, '2020_12_17_070528_create__car_service_table', 2),
(13, '2020_12_17_070844_create__visa_service_table', 2),
(14, '2020_12_17_071134_create__medical_service_table', 2),
(15, '2020_12_17_071603_create__general_service_table', 2),
(16, '2014_10_12_000000_create_users_table', 3),
(17, '2014_10_12_100000_create_password_resets_table', 4),
(18, '2020_12_12_063730_create_rolees_table', 4),
(19, '2020_12_19_193200_laratrust_setup_tables', 5);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `resiver` int(11) NOT NULL,
  `body` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `main_service` int(11) DEFAULT '0',
  `servic_id` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=893 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `how_add_it` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `is_delete`, `is_active`, `how_add_it`) VALUES
(5, 'admin', 'admin', 'Superadministrator yhgfgs', '2020-12-19 00:36:19', '2021-01-13 01:45:56', 0, 1, 0),
(2, 'sale_manager', 'sale_manager', 'Administrator', '2020-12-19 00:36:19', '2021-01-09 18:36:29', 0, 1, 11),
(3, 'sale_executive', 'sale_executive', 'is an employee how add services data and do some opration in it', '2020-12-19 00:36:20', '2021-01-08 01:38:54', 0, 1, 6),
(4, 'accountant', 'accountant', 'Role Nameghfhg', '2020-12-19 00:36:20', '2021-01-18 15:51:37', 0, 1, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `how_create_it` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`, `is_delete`, `how_create_it`) VALUES
(5, 9, 'App\\User', 0, 9),
(4, 9, 'App\\User', 0, 11),
(2, 9, 'App\\User', 0, 9),
(3, 9, 'App\\User', 0, 9);

-- --------------------------------------------------------

--
-- بنية الجدول `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `ser_id` bigint(20) UNSIGNED NOT NULL,
  `ser_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discrption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `emp_id_how_create` int(11) NOT NULL,
  `updated_at` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `services`
--

INSERT INTO `services` (`ser_id`, `ser_name`, `discrption`, `created_at`, `is_active`, `deleted`, `emp_id_how_create`, `updated_at`) VALUES
(1, 'Ticket 11', 'Traveling with jubari travel', '2020-12-20', 1, 0, 1, '2020-12-28 09:13:55'),
(2, 'Bus Services', 'translate between cites', '2020-12-20', 1, 0, 1, '2020-12-20 05:18:28'),
(3, 'Car Services', 'translate between cites', '2020-12-20', 1, 0, 1, '2020-12-20 05:18:49'),
(4, 'Medical Services', 'Take Reports', '2020-12-20', 1, 0, 1, '2020-12-20 05:23:48'),
(5, 'Hotel Services', '5 Strars hotel', '2020-12-20', 1, 0, 1, '2020-12-20 05:20:10'),
(6, 'Visa Service', 'Help to tack Visa for any country', '2020-12-20', 1, 0, 1, '2020-12-20 05:21:30'),
(7, 'General Service', 'Other Service', '2020-12-20', 1, 0, 1, '2020-12-20 05:28:43'),
(0, 'MNHJNG', 'GFGFVC', '2021-01-25', 0, 1, 9, '2021-01-25 14:30:17');

-- --------------------------------------------------------

--
-- بنية الجدول `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `s_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_acc_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `suppliers`
--

INSERT INTO `suppliers` (`s_no`, `supplier_name`, `supplier_mobile`, `supplier_phone`, `supplier_email`, `supplier_photo`, `supplier_address`, `supplier_acc_no`, `supplier_remark`, `is_active`, `updated_at`, `created_at`, `is_deleted`) VALUES
(1, 'sup1', '777777777', '888888', 'sd.alwajeeh@gmail.com', '1609743231Capture.PNG', 'مذبح', '999999999', 'jkhgfdx', 1, '2021-01-04 11:34:47', '2021-01-04 03:53:51', 0),
(2, 'HHH', '999999999', '0000000', 'sd.alwajeeh@gmail.com', '1609834373Capture.PNG', 'مذبح', '777', 'HGGFGFDD', 1, '2021-01-24 08:26:06', '2021-01-05 05:12:53', 1),
(3, 'محمد علي', '888888888', '999999', 'SD@FDHGF', '1611487514Capture.PNG', 'HGGH', '9999999999', 'GFTHGBF', 1, '2021-01-24 08:25:56', '2021-01-24 08:25:14', 0),
(4, 'YYYمحمد علي', '888888888', '888888', 'SD@FDHGF', '1611585087IMG-20200724-WA0002.jpg', 'HGGH', '8888', 'JKGHFDFG', 1, '2021-01-25 21:31:27', '2021-01-25 21:31:27', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `sup_currency`
--

DROP TABLE IF EXISTS `sup_currency`;
CREATE TABLE IF NOT EXISTS `sup_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_id` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- بنية الجدول `sup_services`
--

DROP TABLE IF EXISTS `sup_services`;
CREATE TABLE IF NOT EXISTS `sup_services` (
  `sup_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `sup_id` (`sup_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `ticket_services`
--

DROP TABLE IF EXISTS `ticket_services`;
CREATE TABLE IF NOT EXISTS `ticket_services` (
  `tecket_id` varchar(170) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline_id` int(11) NOT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ses_status` int(11) NOT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dep_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dep_city2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arr_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arr_city2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dep_date` date NOT NULL,
  `dep_date2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_to_supp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_cost` decimal(8,2) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(8,2) NOT NULL,
  `service_id` int(11) NOT NULL DEFAULT '1',
  `passnger_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `bursher_time` text COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `service_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci,
  `user_status` int(1) NOT NULL DEFAULT '0',
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `errorlog` int(11) NOT NULL DEFAULT '0',
  `bill_num` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `bookmark` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tecket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `how_add_it` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `how_add_it`, `is_delete`, `is_active`, `email`, `email_verified_at`, `password`, `pass`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'SOSO SO', 11, 0, 1, 'sd1.alwajeeh1@gmail.com', NULL, '$2y$10$VfOnrdgN87S/R74k9spSzOqDt.GXIrafkl/U7ndh4HaP.c4X0dLf2', 'ASASASAS', NULL, '2021-01-18 08:08:52', '2021-01-27 20:37:45');

-- --------------------------------------------------------

--
-- بنية الجدول `visa_services`
--

DROP TABLE IF EXISTS `visa_services`;
CREATE TABLE IF NOT EXISTS `visa_services` (
  `visa_id` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Issue_date` date NOT NULL,
  `refernce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ses_status` int(11) NOT NULL,
  `voucher_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_to_supp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_cost` decimal(8,2) NOT NULL,
  `ses_cur_id` int(11) NOT NULL,
  `due_to_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `service_id` int(11) NOT NULL,
  `passnger_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `service_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '0',
  `errorlog` int(11) NOT NULL DEFAULT '0',
  `bill_num` int(11) NOT NULL DEFAULT '0',
  `how_add_bill` int(11) NOT NULL DEFAULT '0',
  `bookmark` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `how_add_bookmark` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`visa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
