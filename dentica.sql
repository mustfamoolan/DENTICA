-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2025 at 04:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentica`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اسم الحساسية',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'انبنسلين فطر براسيتول', '2025-04-03 21:33:16', '2025-04-03 21:33:16'),
(2, 'انبسلين', '2025-04-03 21:33:47', '2025-04-03 21:33:47'),
(3, 'النوم', '2025-04-05 05:36:12', '2025-04-05 05:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL COMMENT 'تاريخ الموعد',
  `appointment_time` time NOT NULL COMMENT 'وقت الموعد',
  `amount` decimal(10,2) DEFAULT NULL COMMENT 'المبلغ',
  `session_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'نوع الجلسة',
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'حالة الموعد',
  `is_starred` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'مميز بنجمة',
  `is_archived` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'مؤرشف',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `appointment_date`, `appointment_time`, `amount`, `session_type`, `status`, `is_starred`, `is_archived`, `created_at`, `updated_at`) VALUES
(2, 2, '2025-04-04', '03:37:00', '50000.00', NULL, 'pending', 0, 0, '2025-04-03 21:34:47', '2025-04-03 22:50:54'),
(3, 1, '2025-04-05', '03:36:00', '30000.00', NULL, 'pending', 0, 0, '2025-04-03 21:35:47', '2025-04-03 23:05:55'),
(4, 1, '2025-04-05', '03:37:00', '30000.00', NULL, 'pending', 0, 0, '2025-04-03 21:36:19', '2025-04-03 23:05:54'),
(5, 1, '2025-04-04', '03:38:00', '30000.00', NULL, 'pending', 1, 0, '2025-04-03 21:37:06', '2025-04-03 23:06:05'),
(6, 1, '2025-04-04', '04:43:00', '50000.00', NULL, 'pending', 1, 0, '2025-04-03 22:40:21', '2025-04-03 23:06:05'),
(7, 2, '2025-04-04', '04:46:00', '50000.00', 'خلع', 'pending', 1, 0, '2025-04-03 22:46:09', '2025-04-03 23:06:05'),
(8, 2, '2025-04-05', '05:09:00', '20000.00', 'حشوة', 'pending', 0, 0, '2025-04-03 23:08:46', '2025-04-03 23:08:46'),
(9, 1, '2025-04-05', '05:17:00', '20000.00', 'مراجعة ثانية', 'pending', 0, 0, '2025-04-03 23:13:11', '2025-04-03 23:13:11'),
(10, 2, '2025-04-12', '05:15:00', '500000.00', 'تقويم', 'pending', 0, 0, '2025-04-03 23:13:40', '2025-04-03 23:13:40'),
(11, 3, '2025-04-04', '05:21:00', '20000.00', 'حشوة', 'pending', 0, 0, '2025-04-03 23:22:02', '2025-04-04 12:56:45'),
(12, 4, '2025-04-05', '23:40:00', '50000.00', 'تبييض', 'pending', 0, 1, '2025-04-05 05:40:13', '2025-04-05 05:40:46'),
(13, 2, '2025-04-07', '04:41:00', '50000.00', 'مراجعة ثانية', 'pending', 0, 0, '2025-04-06 22:41:42', '2025-04-06 22:41:42'),
(14, 1, '2025-04-07', '12:45:00', '134.00', 'تبييض أسنان', 'cancelled', 0, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(15, 1, '2025-04-07', '09:00:00', '106.00', 'فحص أولي', 'completed', 0, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(16, 1, '2025-04-07', '14:00:00', '52.00', 'حشوة أسنان', 'cancelled', 0, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(17, 1, '2025-04-07', '17:30:00', '182.00', 'خلع سن', 'pending', 0, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(18, 1, '2025-04-07', '17:00:00', '139.00', 'تركيب طربوش', 'pending', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(19, 1, '2025-04-07', '12:45:00', '30.00', 'تنظيف أسنان', 'pending', 0, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(20, 1, '2025-04-07', '09:15:00', '166.00', 'متابعة تقويم', 'pending', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(21, 1, '2025-04-07', '10:00:00', '133.00', 'تركيب تقويم', 'cancelled', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(22, 1, '2025-04-07', '16:00:00', '75.00', 'تركيب تقويم', 'pending', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(23, 1, '2025-04-07', '16:15:00', '54.00', 'متابعة تقويم', 'cancelled', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(24, 1, '2025-04-07', '16:45:00', '83.00', 'فحص أولي', 'cancelled', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(25, 1, '2025-04-07', '16:30:00', '154.00', 'علاج عصب', 'completed', 0, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(26, 1, '2025-04-07', '09:00:00', '99.00', 'حشوة أسنان', 'pending', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(27, 1, '2025-04-07', '13:45:00', '196.00', 'متابعة تقويم', 'completed', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(28, 1, '2025-04-07', '17:30:00', '50.00', 'تركيب طربوش', 'completed', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(29, 2, '2025-04-07', '14:45:00', '194.00', 'علاج عصب', 'pending', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(30, 2, '2025-04-07', '15:15:00', '181.00', 'حشوة أسنان', 'completed', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(31, 2, '2025-04-07', '12:00:00', '125.00', 'تنظيف أسنان', 'cancelled', 0, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(32, 2, '2025-04-07', '16:00:00', '53.00', 'علاج عصب', 'cancelled', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(33, 2, '2025-04-07', '11:45:00', '35.00', 'تركيب تقويم', 'completed', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(34, 2, '2025-04-07', '15:00:00', '50.00', 'تركيب طربوش', 'completed', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(35, 2, '2025-04-07', '12:15:00', '154.00', 'متابعة تقويم', 'completed', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(36, 2, '2025-04-07', '14:15:00', '198.00', 'تركيب تقويم', 'cancelled', 0, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(37, 2, '2025-04-07', '12:30:00', '123.00', 'فحص أولي', 'completed', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(38, 2, '2025-04-07', '10:30:00', '63.00', 'تنظيف أسنان', 'completed', 0, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(39, 2, '2025-04-07', '09:30:00', '140.00', 'فحص أولي', 'cancelled', 0, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(40, 2, '2025-04-07', '12:30:00', '26.00', 'تنظيف أسنان', 'cancelled', 0, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(41, 2, '2025-04-07', '17:15:00', '121.00', 'علاج عصب', 'pending', 1, 0, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(42, 2, '2025-04-07', '14:30:00', '89.00', 'فحص أولي', 'completed', 1, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(43, 2, '2025-04-07', '10:15:00', '164.00', 'تبييض أسنان', 'pending', 0, 1, '2025-04-06 23:36:21', '2025-04-06 23:36:21'),
(44, 1, '2025-04-07', '05:50:00', '200000.00', 'فحص أولي', 'pending', 0, 0, '2025-04-06 23:48:44', '2025-04-06 23:48:44'),
(45, 1, '2025-04-07', '09:00:00', '20000.00', 'فحص أولي', 'pending', 0, 0, '2025-04-06 23:56:10', '2025-04-06 23:56:10'),
(46, 5, '2025-04-07', '11:00:00', '22132.00', 'حشوة أسنان', 'pending', 0, 0, '2025-04-06 23:59:52', '2025-04-06 23:59:52'),
(47, 3, '2025-04-07', '13:30:00', '3233.00', 'تنظيف أسنان', 'pending', 0, 0, '2025-04-07 00:01:50', '2025-04-07 00:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chronic_diseases`
--

CREATE TABLE `chronic_diseases` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اسم المرض المزمن',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chronic_diseases`
--

INSERT INTO `chronic_diseases` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'سكر ضغط قلب', '2025-04-03 21:33:16', '2025-04-03 21:33:16'),
(2, 'سكر', '2025-04-03 21:33:47', '2025-04-03 21:33:47'),
(3, 'العمل', '2025-04-05 05:36:12', '2025-04-05 05:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_notes`
--

CREATE TABLE `clinic_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `dental_clinic_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'محتوى الملاحظة',
  `is_important` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'هل الملاحظة مهمة',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinic_notes`
--

INSERT INTO `clinic_notes` (`id`, `dental_clinic_id`, `content`, `is_important`, `created_at`, `updated_at`) VALUES
(5, 1, 'ابا نيو', 0, '2025-04-06 23:13:06', '2025-04-06 23:13:06'),
(7, 1, 'موزين11', 0, '2025-04-06 23:13:32', '2025-04-06 23:17:32'),
(9, 1, '1', 0, '2025-04-06 23:19:34', '2025-04-06 23:19:34'),
(10, 1, '3', 0, '2025-04-06 23:19:37', '2025-04-06 23:19:37'),
(11, 1, '3', 0, '2025-04-06 23:19:40', '2025-04-06 23:19:40'),
(12, 1, '222', 0, '2025-04-06 23:19:43', '2025-04-06 23:19:43'),
(13, 1, '222222', 0, '2025-04-06 23:19:47', '2025-04-06 23:19:47'),
(14, 1, '2222222', 0, '2025-04-06 23:19:52', '2025-04-06 23:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `dental_clinics`
--

CREATE TABLE `dental_clinics` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اسم العيادة',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'عنوان العيادة',
  `opening_time` time NOT NULL COMMENT 'وقت بدء الدوام',
  `closing_time` time NOT NULL COMMENT 'وقت انتهاء الدوام',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dental_clinics`
--

INSERT INTO `dental_clinics` (`id`, `name`, `address`, `opening_time`, `closing_time`, `created_at`, `updated_at`) VALUES
(1, 'بابل1', 'أم قصر', '03:32:00', '15:32:00', '2025-04-03 21:32:54', '2025-04-03 21:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `dental_doctors`
--

CREATE TABLE `dental_doctors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اسم الطبيب',
  `dental_specialty_id` bigint UNSIGNED NOT NULL,
  `dental_clinic_id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'رقم الهاتف للتواصل وتسجيل الدخول',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'البريد الإلكتروني (اختياري)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'كلمة المرور',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dental_doctors`
--

INSERT INTO `dental_doctors` (`id`, `name`, `dental_specialty_id`, `dental_clinic_id`, `phone`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'مصطفى سعدي', 7, 1, '07742209251', NULL, '$2y$12$E7uqTiHys2HV5CKJlICpvOfkNoIJbi4PX9nU73dyc7xm4n82LhZBG', NULL, '2025-04-03 21:32:54', '2025-04-03 21:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `dental_specialties`
--

CREATE TABLE `dental_specialties` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اسم التخصص',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dental_specialties`
--

INSERT INTO `dental_specialties` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'طب الأسنان العام', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(2, 'تقويم الأسنان', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(3, 'جراحة الفم والوجه والفكين', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(4, 'طب أسنان الأطفال', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(5, 'علاج جذور الأسنان', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(6, 'أمراض اللثة', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(7, 'طب الأسنان التجميلي', '2025-04-03 21:32:22', '2025-04-03 21:32:22'),
(8, 'زراعة الأسنان', '2025-04-03 21:32:22', '2025-04-03 21:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `dental_clinic_id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `invoice_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `session_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `dental_clinic_id`, `patient_id`, `invoice_type`, `issue_date`, `amount`, `paid_amount`, `remaining_amount`, `session_title`, `note`, `is_paid`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'علاج عصب', '2025-04-07', '50000.00', '20000.00', '30000.00', 'ثثثثث', 'سسييب', 0, '2025-04-07 00:52:53', '2025-04-07 00:52:53'),
(2, 1, 2, 'كشف أولي', '2025-04-07', '50000.00', '20.00', '49980.00', 'صصص', 'صييصي', 0, '2025-04-07 01:02:47', '2025-04-07 01:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_types`
--

CREATE TABLE `invoice_types` (
  `id` bigint UNSIGNED NOT NULL,
  `dental_clinic_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_types`
--

INSERT INTO `invoice_types` (`id`, `dental_clinic_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'كشف أولي', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(2, 1, 'حشوة أسنان', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(3, 1, 'علاج عصب', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(4, 1, 'تنظيف أسنان', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(5, 1, 'خلع سن', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(6, 1, 'تركيب تقويم', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(7, 1, 'متابعة تقويم', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(8, 1, 'تركيب طربوش', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(9, 1, 'تبييض أسنان', '2025-04-07 00:43:52', '2025-04-07 00:43:52'),
(10, 1, 'زراعة أسنان', '2025-04-07 00:43:52', '2025-04-07 00:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000001_create_dental_clinics_table', 1),
(5, '2024_01_01_000002_create_dental_specialties_table', 1),
(6, '2024_01_01_000003_create_dental_doctors_table', 1),
(7, '2024_01_02_000001_create_patients_table', 1),
(8, '2024_01_03_000001_create_appointments_table', 1),
(9, '2024_01_15_000001_add_fields_to_appointments_table', 2),
(10, '2024_10_10_000001_create_clinic_notes_table', 3),
(11, '2024_10_19_000001_create_invoices_table', 4),
(12, '2024_10_19_000002_create_invoice_types_table', 4),
(13, '2024_10_20_000001_create_notifications_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `dental_clinic_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint UNSIGNED NOT NULL,
  `dental_clinic_id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'اسم المريض الثلاثي',
  `age` int NOT NULL COMMENT 'عمر المريض',
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'جنس المريض',
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'رقم الهاتف',
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'الوظيفة',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'محل السكن',
  `patient_number` int NOT NULL COMMENT 'تسلسل المريض',
  `registration_date` date NOT NULL COMMENT 'تاريخ الإضافة',
  `registration_time` time NOT NULL COMMENT 'وقت الإضافة',
  `notes` text COLLATE utf8mb4_unicode_ci COMMENT 'ملاحظات',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `dental_clinic_id`, `full_name`, `age`, `gender`, `phone_number`, `occupation`, `address`, `patient_number`, `registration_date`, `registration_time`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'mustfa sadae', 30, 'male', '07742209251', 'مهندس', 'umq', 1, '2025-04-04', '00:33:16', 'ثبصثبصثبصثب', '2025-04-03 21:33:16', '2025-04-03 21:33:16'),
(2, 1, 'ياسمين', 22, 'female', '07700000000', 'ابا نيو', 'العنوان ام قصر بصرة', 2, '2025-04-04', '00:33:47', 'صضيصضيصضي', '2025-04-03 21:33:47', '2025-04-03 21:33:47'),
(3, 1, 'محمد', 50, 'male', '07742209251', 'مهندس', 'umq', 3, '2025-04-04', '02:15:14', NULL, '2025-04-03 23:15:14', '2025-04-03 23:15:14'),
(4, 1, 'اسلام', 20, 'female', '07700000001', 'مهندسة', 'بابل', 4, '2025-04-05', '08:36:11', 'تجريبي', '2025-04-05 05:36:11', '2025-04-05 05:36:11'),
(5, 1, 'جعفر', 27, 'male', '077426565251', 'ابا نيو', 'umq', 5, '2025-04-07', '01:52:59', NULL, '2025-04-06 22:52:59', '2025-04-06 22:52:59'),
(6, 1, 'حسن', 25, 'male', '07742889251', 'سالموني', 'umq', 6, '2025-04-07', '01:53:40', NULL, '2025-04-06 22:53:40', '2025-04-06 22:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `patient_allergy`
--

CREATE TABLE `patient_allergy` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `allergy_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_allergy`
--

INSERT INTO `patient_allergy` (`id`, `patient_id`, `allergy_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_chronic_disease`
--

CREATE TABLE `patient_chronic_disease` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `chronic_disease_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_chronic_disease`
--

INSERT INTO `patient_chronic_disease` (`id`, `patient_id`, `chronic_disease_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gpG0KfgE8xccg7jIJja3XfA7cGM0h6LmKYWYzFCk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGxueVZGeEVRenA3RUEzRW55UU5TWEJmY0RSUUh6S3VHc3ZYT1FrbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kZW50aWNhLnRlc3QvcGF0aWVudHMvNiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1744000592);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-04-03 21:32:22', '$2y$12$6RGcuLTF/.ulsckX2mBwYOmr9NbJ4Zlvua29kb.PMBtLj1SFrFQ9m', 'VNPL3bHwAT', '2025-04-03 21:32:22', '2025-04-03 21:32:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinic_notes`
--
ALTER TABLE `clinic_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_notes_dental_clinic_id_foreign` (`dental_clinic_id`);

--
-- Indexes for table `dental_clinics`
--
ALTER TABLE `dental_clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dental_doctors`
--
ALTER TABLE `dental_doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dental_doctors_phone_unique` (`phone`),
  ADD KEY `dental_doctors_dental_specialty_id_foreign` (`dental_specialty_id`),
  ADD KEY `dental_doctors_dental_clinic_id_foreign` (`dental_clinic_id`);

--
-- Indexes for table `dental_specialties`
--
ALTER TABLE `dental_specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_dental_clinic_id_foreign` (`dental_clinic_id`),
  ADD KEY `invoices_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `invoice_types`
--
ALTER TABLE `invoice_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_types_dental_clinic_id_foreign` (`dental_clinic_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_dental_clinic_id_foreign` (`dental_clinic_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_dental_clinic_id_foreign` (`dental_clinic_id`);

--
-- Indexes for table `patient_allergy`
--
ALTER TABLE `patient_allergy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_allergy_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_allergy_allergy_id_foreign` (`allergy_id`);

--
-- Indexes for table `patient_chronic_disease`
--
ALTER TABLE `patient_chronic_disease`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_chronic_disease_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_chronic_disease_chronic_disease_id_foreign` (`chronic_disease_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinic_notes`
--
ALTER TABLE `clinic_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dental_clinics`
--
ALTER TABLE `dental_clinics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dental_doctors`
--
ALTER TABLE `dental_doctors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dental_specialties`
--
ALTER TABLE `dental_specialties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_types`
--
ALTER TABLE `invoice_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_allergy`
--
ALTER TABLE `patient_allergy`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_chronic_disease`
--
ALTER TABLE `patient_chronic_disease`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_notes`
--
ALTER TABLE `clinic_notes`
  ADD CONSTRAINT `clinic_notes_dental_clinic_id_foreign` FOREIGN KEY (`dental_clinic_id`) REFERENCES `dental_clinics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dental_doctors`
--
ALTER TABLE `dental_doctors`
  ADD CONSTRAINT `dental_doctors_dental_clinic_id_foreign` FOREIGN KEY (`dental_clinic_id`) REFERENCES `dental_clinics` (`id`),
  ADD CONSTRAINT `dental_doctors_dental_specialty_id_foreign` FOREIGN KEY (`dental_specialty_id`) REFERENCES `dental_specialties` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_dental_clinic_id_foreign` FOREIGN KEY (`dental_clinic_id`) REFERENCES `dental_clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_types`
--
ALTER TABLE `invoice_types`
  ADD CONSTRAINT `invoice_types_dental_clinic_id_foreign` FOREIGN KEY (`dental_clinic_id`) REFERENCES `dental_clinics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_dental_clinic_id_foreign` FOREIGN KEY (`dental_clinic_id`) REFERENCES `dental_clinics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_dental_clinic_id_foreign` FOREIGN KEY (`dental_clinic_id`) REFERENCES `dental_clinics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_allergy`
--
ALTER TABLE `patient_allergy`
  ADD CONSTRAINT `patient_allergy_allergy_id_foreign` FOREIGN KEY (`allergy_id`) REFERENCES `allergies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_allergy_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_chronic_disease`
--
ALTER TABLE `patient_chronic_disease`
  ADD CONSTRAINT `patient_chronic_disease_chronic_disease_id_foreign` FOREIGN KEY (`chronic_disease_id`) REFERENCES `chronic_diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_chronic_disease_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
