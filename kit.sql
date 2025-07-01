-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 06:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kit`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_balance` decimal(15,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `account_balance`, `type`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 0.00, 'asset', '1000', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(2, 'Bank', 0.00, 'asset', '1010', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(3, 'Accounts Receivable', 0.00, 'asset', '1100', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(4, 'Inventory', 0.00, 'asset', '1200', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(5, 'Equipment', 0.00, 'asset', '1300', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(6, 'Accounts Payable', 0.00, 'liability', '2000', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(7, 'Accrued Expenses', 0.00, 'liability', '2100', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(8, 'Owner\'s Equity', 0.00, 'equity', '3000', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(9, 'Retained Earnings', 0.00, 'equity', '3100', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(10, 'Consultation Revenue', 0.00, 'income', '4000', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(11, 'Lab Revenue', 0.00, 'income', '4100', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(12, 'Pharmacy Revenue', 0.00, 'income', '4200', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(13, 'Other Income', 0.00, 'income', '4300', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(14, 'Salaries Expense', 0.00, 'expense', '5000', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(15, 'Supplies Expense', 0.00, 'expense', '5100', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(16, 'Rent Expense', 0.00, 'expense', '5200', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(17, 'Utilities Expense', 0.00, 'expense', '5300', '2025-06-06 13:32:22', '2025-06-06 13:32:22'),
(18, 'Other Expense', 0.00, 'expense', '5400', '2025-06-06 13:32:22', '2025-06-06 13:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `account_mappings`
--

CREATE TABLE `account_mappings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_type` varchar(255) NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `requested_by` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `bed_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `admission_date` datetime DEFAULT NULL,
  `discharge_date` datetime DEFAULT NULL,
  `status` enum('pending','admitted','discharged','cancelled') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `patient_id`, `visit_id`, `requested_by`, `approved_by`, `bed_id`, `ward_id`, `admission_date`, `discharge_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 1, 1, 3, 2, '2025-06-05 10:35:21', NULL, 'admitted', 'in a bad conditions', '2025-06-05 06:19:57', '2025-06-05 07:36:41'),
(2, 2, 6, 1, 1, 3, 2, '2025-06-05 09:45:13', NULL, 'admitted', 'test', '2025-06-05 06:27:11', '2025-06-05 09:13:31'),
(3, 2, 6, 1, 1, 2, 1, '2025-06-08 18:27:42', NULL, 'admitted', NULL, '2025-06-08 15:26:48', '2025-06-08 15:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_number` varchar(100) NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(50) DEFAULT 'Waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_number`, `patient_id`, `doctor_id`, `date`, `time`, `status`, `created_at`, `updated_at`) VALUES
(7, '', 1, 2, '2025-06-01', '10:00:00', 'Scheduled', '2025-06-02 10:59:21', '2025-06-02 10:20:54'),
(11, '', 1, 1, '2025-06-02', '17:50:00', 'Cancelled', '2025-06-02 09:50:26', '2025-06-02 10:03:40'),
(12, '', 1, 2, '2025-06-02', '13:40:00', 'Waiting', '2025-06-02 16:40:27', '2025-06-02 16:40:27'),
(13, 'APPT-20250605-68413418AABB7', 5, 2, '2025-06-06', '11:09:00', 'No Show', '2025-06-05 03:07:20', '2025-06-08 11:32:35'),
(14, 'APPT-20250608-68459F46DC474', 21, 4, '2025-06-08', '19:34:00', 'Waiting', '2025-06-08 11:33:42', '2025-06-08 11:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `auditable_type` varchar(255) DEFAULT NULL,
  `auditable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `old_values` text DEFAULT NULL,
  `new_values` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'Created a Visit', 'App\\Models\\Visit', 4, NULL, '{\"visit_number\":\"VIS-6840AC853C228\"}', '127.0.0.1', '2025-06-04 17:28:53', '2025-06-04 17:28:53'),
(2, 1, 'Created an Invoice for Visit', 'App\\Models\\Billing\\Invoice', 4, NULL, '{\"invoice_number\":\"INV-6840AC8546CD6\",\"amount\":0}', '127.0.0.1', '2025-06-04 17:28:53', '2025-06-04 17:28:53'),
(3, 1, 'Created a Visit', 'App\\Models\\Visit', 5, NULL, '{\"visit_number\":\"VIS-6840ACF8677FD\",\"patient_id\":\"13\",\"doctor_id\":\"2\",\"type\":\"OPD\",\"start_date\":\"2025-06-04\",\"is_active\":\"1\"}', '127.0.0.1', '2025-06-04 17:30:48', '2025-06-04 17:30:48'),
(4, 1, 'Created an Invoice for Visit', 'App\\Models\\Billing\\Invoice', 5, NULL, '{\"invoice_number\":\"INV-6840ACF86E59A\",\"amount\":0}', '127.0.0.1', '2025-06-04 17:30:48', '2025-06-04 17:30:48'),
(5, NULL, 'logout', NULL, NULL, NULL, NULL, NULL, '2025-06-04 17:40:19', '2025-06-04 17:40:19'),
(6, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-04 17:40:37', '2025-06-04 17:40:37'),
(7, NULL, 'logout', NULL, NULL, NULL, NULL, NULL, '2025-06-04 17:40:52', '2025-06-04 17:40:52'),
(8, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-04 17:41:25', '2025-06-04 17:41:25'),
(9, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-05 02:14:28', '2025-06-05 02:14:28'),
(10, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-05 02:50:33', '2025-06-05 02:50:33'),
(11, 1, 'Created a Visit', 'App\\Models\\Visit', 6, NULL, '{\"visit_number\":\"VIS-684160CCDAAB1\",\"patient_id\":\"2\",\"doctor_id\":\"4\",\"type\":\"IP\",\"start_date\":\"2025-06-05\",\"is_active\":\"1\"}', '127.0.0.1', '2025-06-05 06:18:04', '2025-06-05 06:18:04'),
(12, 1, 'Created an Invoice for Visit', 'App\\Models\\Billing\\Invoice', 6, NULL, '{\"invoice_number\":\"INV-684160CCECB37\",\"amount\":0}', '127.0.0.1', '2025-06-05 06:18:04', '2025-06-05 06:18:04'),
(13, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-05 13:15:30', '2025-06-05 13:15:30'),
(14, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-06 10:00:14', '2025-06-06 10:00:14'),
(15, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-06 15:05:49', '2025-06-06 15:05:49'),
(16, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-07 07:14:18', '2025-06-07 07:14:18'),
(17, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-07 15:30:49', '2025-06-07 15:30:49'),
(18, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-08 00:15:27', '2025-06-08 00:15:27'),
(19, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-08 11:19:03', '2025-06-08 11:19:03'),
(20, 1, 'Created a Visit', 'App\\Models\\Visit', 7, NULL, '{\"visit_number\":\"VIS-68459FE8D82B0\",\"patient_id\":\"21\",\"doctor_id\":\"4\",\"type\":\"OPD\",\"start_date\":\"2025-06-08\",\"is_active\":\"1\"}', '127.0.0.1', '2025-06-08 11:36:24', '2025-06-08 11:36:24'),
(21, 1, 'Created an Invoice for Visit', 'App\\Models\\Billing\\Invoice', 7, NULL, '{\"invoice_number\":\"INV-68459FE8E231F\",\"amount\":0}', '127.0.0.1', '2025-06-08 11:36:24', '2025-06-08 11:36:24'),
(22, 1, 'login', NULL, NULL, NULL, NULL, NULL, '2025-06-08 15:12:41', '2025-06-08 15:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ward_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `charge` decimal(10,2) DEFAULT 0.00,
  `status` enum('available','occupied','maintenance') DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `ward_id`, `name`, `charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bed 1', 1000.00, 'occupied', '2025-06-05 10:08:02', '2025-06-05 08:41:21'),
(2, 1, 'Bed 2', 1000.00, 'occupied', '2025-06-05 10:08:02', '2025-06-08 15:29:02'),
(3, 2, 'Bed 3', 2500.00, 'occupied', '2025-06-05 10:08:02', '2025-06-05 09:13:31'),
(4, 2, 'Bed 4', 2500.00, 'available', '2025-06-05 10:08:02', '2025-06-05 10:08:02'),
(5, 3, 'Bed 5', 5000.00, 'available', '2025-06-05 10:08:02', '2025-06-05 09:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `services` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `visit_id`, `services`, `total`, `created_at`, `updated_at`) VALUES
(7, 1, '2', 50.00, '2025-06-04 10:51:26', '2025-06-04 10:51:26'),
(8, 1, '1', 20.00, '2025-06-04 10:51:35', '2025-06-04 10:51:35'),
(9, 1, '2', 50.00, '2025-06-04 10:51:45', '2025-06-04 10:51:45'),
(10, 1, '2', 50.00, '2025-06-04 10:51:54', '2025-06-04 10:51:54'),
(11, 2, '1', 20.00, '2025-06-04 10:54:16', '2025-06-04 10:54:16'),
(12, 2, '1', 20.00, '2025-06-04 10:54:26', '2025-06-04 10:54:26'),
(13, 2, '1', 20.00, '2025-06-04 10:54:36', '2025-06-04 10:54:36'),
(14, 2, '1', 20.00, '2025-06-04 10:54:52', '2025-06-04 10:54:52'),
(15, 2, '1', 20.00, '2025-06-04 13:00:58', '2025-06-04 13:00:58'),
(16, 1, '1', 20.00, '2025-06-04 14:18:40', '2025-06-04 14:18:40'),
(17, 2, '1', 20.00, '2025-06-04 14:23:35', '2025-06-04 14:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('clinicemr_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:14:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"viewpatients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"createpatients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:18:\"viewpatientsummary\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:24:\"uploadpatientattachments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:16:\"viewappointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:18:\"createappointments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:20:\"viewappointmentqueue\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:10:\"viewvisits\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"createvisits\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"viewvisitqueue\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:20:\"viewvisitmedications\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:16:\"viewvisitbilling\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"viewvisitvitals\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"viewvisitnotes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"systemadmin\";s:1:\"c\";s:3:\"web\";}}}', 1749482614),
('clinicemr_cache_test@example.com|127.0.0.1', 'i:1;', 1748807511),
('clinicemr_cache_test@example.com|127.0.0.1:timer', 'i:1748807511;', 1748807511),
('laravel_cache_test@example.com|127.0.0.1', 'i:1;', 1748783297),
('laravel_cache_test@example.com|127.0.0.1:timer', 'i:1748783297;', 1748783297);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Consumables', '2025-06-03 08:03:55', '2025-06-03 08:03:55'),
(2, 'Equipment', '2025-06-03 08:03:55', '2025-06-03 08:03:55'),
(3, 'Medicines', '2025-06-03 08:03:55', '2025-06-03 08:03:55'),
(4, 'Supplies', '2025-06-03 08:03:55', '2025-06-03 08:03:55'),
(5, 'Laboratory', '2025-06-03 08:03:55', '2025-06-03 08:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text NOT NULL,
  `past_history` text DEFAULT NULL,
  `general_examination` text DEFAULT NULL,
  `systematic_examination` text DEFAULT NULL,
  `investigation` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `icd11_diagnosis` text DEFAULT NULL,
  `treatment_plan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `visit_id`, `notes`, `past_history`, `general_examination`, `systematic_examination`, `investigation`, `diagnosis`, `icd11_diagnosis`, `treatment_plan`, `created_at`, `updated_at`) VALUES
(3, 7, 'test', 'test', 'test', 'test', 'test', 'test', '2A00 - Malignant neoplasm of lip', 'test plan', '2025-06-08 11:37:51', '2025-06-08 11:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT 'other',
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialty`, `phone`, `email`, `gender`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Alice Smith', 'Cardiologist', '1234567890', 'alice@example.com', 'female', '123 Heart St, MedCity', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(2, 'Dr. Bob Johnson', 'Dermatologist', '2345678901', 'bob@example.com', 'male', '456 Skin Ave, HealthTown', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(3, 'Dr. Clara Lee', 'Pediatrician', '3456789012', 'clara@example.com', 'female', '789 Child Rd, KidCare', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(4, 'Dr. David Kim', 'Orthopedic Surgeon', '4567890123', 'david@example.com', 'male', '321 Bone Blvd, JointCity', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(5, 'Dr. Emma Davis', 'Neurologist', '5678901234', 'emma@example.com', 'female', '654 Brain Ln, NeuroVille', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(6, 'Dr. Frank Brown', 'ENT Specialist', '6789012345', 'frank@example.com', 'male', '987 Ear Nose Rd, HearTown', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(7, 'Dr. Grace Wilson', 'Gynecologist', '7890123456', 'grace@example.com', 'female', '159 Women St, GynoPlace', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(8, 'Dr. Henry White', 'General Physician', '8901234567', 'henry@example.com', 'male', '753 Wellness Dr, MedBase', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(9, 'Dr. Irene Moore', 'Psychiatrist', '9012345678', 'irene@example.com', 'female', '852 Mind Ave, CalmCity', '2025-06-02 12:38:25', '2025-06-02 12:38:25'),
(10, 'Dr. Jack Taylor', 'Oncologist', '0123456789', 'jack@example.com', 'male', '951 Cancer Ct, HopeTown', '2025-06-02 12:38:25', '2025-06-02 12:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `dosages`
--

CREATE TABLE `dosages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosages`
--

INSERT INTO `dosages` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '500mg twice daily', '2025-06-02 20:57:13', '2025-06-02 20:57:13'),
(2, '250mg three times daily', '2025-06-02 20:57:13', '2025-06-02 20:57:13'),
(3, '200mg once daily', '2025-06-02 20:57:13', '2025-06-02 20:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', '2025-06-02 20:57:13', '2025-06-02 20:57:13'),
(2, 'Amoxicillin', '2025-06-02 20:57:13', '2025-06-02 20:57:13'),
(3, 'Ibuprofen', '2025-06-02 20:57:13', '2025-06-02 20:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_received_notes`
--

CREATE TABLE `goods_received_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grn_number` varchar(50) NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `received_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `icd11s`
--

CREATE TABLE `icd11s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `icd11s`
--

INSERT INTO `icd11s` (`id`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, '1A00', 'Cholera due to Vibrio cholerae 01, biovar cholerae', '2025-06-02 18:34:13', '2025-06-02 18:34:13'),
(2, '1B10', 'Typhoid fever', '2025-06-02 18:34:13', '2025-06-02 18:34:13'),
(3, '2A00', 'Malignant neoplasm of lip', '2025-06-02 18:34:13', '2025-06-02 18:34:13'),
(4, '3B00', 'Diabetes mellitus type 1', '2025-06-02 18:34:13', '2025-06-02 18:34:13'),
(5, '4A00', 'Essential (primary) hypertension', '2025-06-02 18:34:13', '2025-06-02 18:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `visit_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `visit_id`, `invoice_number`, `patient_name`, `visit_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'INV-683F26C9BD5C2', 'Humphrey Lidwaji', 'OPD', 0.00, 'Unpaid', '2025-06-03 13:46:01', '2025-06-03 13:46:01'),
(2, 2, 'INV-68404FDF9E8F7', 'James Brown', 'OPD', 1760.00, 'Unpaid', '2025-06-04 10:53:35', '2025-06-04 17:00:16'),
(3, 4, 'INV-6840AC85449FC', 'Patricia Johnson', 'OPD', 960.00, 'Unpaid', '2025-06-04 17:28:53', '2025-06-07 08:13:55'),
(4, 5, 'INV-6840ACF86CDA2', 'Richard Wilson', 'OPD', 0.00, 'Unpaid', '2025-06-04 17:30:48', '2025-06-04 17:30:48'),
(5, 6, 'INV-684160CCE9015', 'Mary Smith', 'IP', 990.00, 'Unpaid', '2025-06-05 06:18:04', '2025-06-05 10:25:34'),
(6, 7, 'INV-68459FE8DFED6', 'patient one patient one', 'OPD', 0.00, 'Unpaid', '2025-06-08 11:36:24', '2025-06-08 11:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `description`, `quantity`, `unit_price`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 'CT Scan', 1, 500.00, 500.00, '2025-06-04 16:59:20', '2025-06-04 16:59:20'),
(2, 2, 'Complete Blood Count', 1, 40.00, 40.00, '2025-06-04 16:59:35', '2025-06-04 16:59:35'),
(3, 2, 'Consultation', 1, 20.00, 20.00, '2025-06-04 17:00:15', '2025-06-04 17:00:15'),
(4, 2, 'Cataract Surgery', 1, 1200.00, 1200.00, '2025-06-04 17:00:15', '2025-06-04 17:00:15'),
(5, 5, 'Complete Blood Count', 1, 40.00, 40.00, '2025-06-05 10:25:34', '2025-06-05 10:25:34'),
(6, 5, 'Chest X-Ray', 1, 100.00, 100.00, '2025-06-05 10:25:34', '2025-06-05 10:25:34'),
(7, 5, 'X-ray', 1, 50.00, 50.00, '2025-06-05 10:25:34', '2025-06-05 10:25:34'),
(8, 5, 'Colonoscopy', 1, 800.00, 800.00, '2025-06-05 10:25:34', '2025-06-05 10:25:34'),
(9, 3, 'Complete Blood Count', 1, 40.00, 40.00, '2025-06-07 08:13:30', '2025-06-07 08:13:30'),
(10, 3, 'MRI', 1, 900.00, 900.00, '2025-06-07 08:13:55', '2025-06-07 08:13:55'),
(11, 3, 'Consultation', 1, 20.00, 20.00, '2025-06-07 08:13:55', '2025-06-07 08:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `sku`, `category_id`, `stock`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Hp computer', 'ks', 2, 10, 'Pcs', '2025-06-03 05:09:24', '2025-06-03 05:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_orders`
--

CREATE TABLE `lab_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `lab_test_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_orders`
--

INSERT INTO `lab_orders` (`id`, `visit_id`, `lab_test_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 40.00, 'billed', '2025-06-04 14:16:56', '2025-06-04 16:59:35'),
(2, 6, 1, 1, 40.00, 'billed', '2025-06-05 10:13:53', '2025-06-05 10:25:34'),
(3, 4, 1, 1, 40.00, 'billed', '2025-06-07 08:05:40', '2025-06-07 08:13:30'),
(4, 6, 3, 1, 25.00, 'pending', '2025-06-08 11:22:01', '2025-06-08 11:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `lab_requests`
--

CREATE TABLE `lab_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `date_requested` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_results`
--

CREATE TABLE `lab_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `results` text NOT NULL,
  `resulted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_results`
--

INSERT INTO `lab_results` (`id`, `order_id`, `template_id`, `results`, `resulted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '\"{\\\"general\\\":\\\"test result\\\"}\"', '2025-06-08 02:41:22', '2025-06-08 02:41:22', '2025-06-08 02:41:22'),
(2, 1, 4, '{\"test filed\":{\"value\":45,\"unit\":null,\"reference\":null,\"flag\":null}}', '2025-06-08 04:01:01', '2025-06-08 04:01:01', '2025-06-08 04:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `lab_result_templates`
--

CREATE TABLE `lab_result_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`fields`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_result_templates`
--

INSERT INTO `lab_result_templates` (`id`, `name`, `fields`, `created_at`, `updated_at`) VALUES
(1, 'Complete Blood Count (CBC)', '[\n    {\"name\": \"WBC\", \"unit\": \"x10^9/L\"},\n    {\"name\": \"RBC\", \"unit\": \"x10^12/L\"},\n    {\"name\": \"Hemoglobin\", \"unit\": \"g/dL\"},\n    {\"name\": \"Hematocrit\", \"unit\": \"%\"},\n    {\"name\": \"Platelets\", \"unit\": \"x10^9/L\"}\n  ]', '2025-06-08 04:59:55', '2025-06-08 04:59:55'),
(2, 'Liver Function Test (LFT)', '[\r\n    {\"name\": \"ALT (SGPT)\", \"unit\": \"U/L\"},\r\n    {\"name\": \"AST (SGOT)\", \"unit\": \"U/L\"},\r\n    {\"name\": \"Alkaline Phosphatase\", \"unit\": \"U/L\"},\r\n    {\"name\": \"Total Bilirubin\", \"unit\": \"mg/dL\"},\r\n    {\"name\": \"Albumin\", \"unit\": \"g/dL\"}\r\n  ]', '2025-06-08 04:59:55', '2025-06-08 04:59:55'),
(3, 'Renal Function Test (RFT)', '[\r\n    {\"name\": \"Urea\", \"unit\": \"mg/dL\"},\r\n    {\"name\": \"Creatinine\", \"unit\": \"mg/dL\"},\r\n    {\"name\": \"Uric Acid\", \"unit\": \"mg/dL\"},\r\n    {\"name\": \"Sodium\", \"unit\": \"mmol/L\"},\r\n    {\"name\": \"Potassium\", \"unit\": \"mmol/L\"}\r\n  ]', '2025-06-08 04:59:55', '2025-06-08 04:59:55'),
(4, 'test', '[{\"name\":\"test filed\",\"unit\":\"ml\",\"ref_range\":\"23\",\"flag\":\"Normal\"}]', '2025-06-08 03:39:49', '2025-06-08 03:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `lab_tests`
--

CREATE TABLE `lab_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `account_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_tests`
--

INSERT INTO `lab_tests` (`id`, `name`, `price`, `description`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Complete Blood Count', 40.00, 'CBC test', 11, '2025-06-04 13:28:49', '2025-06-07 11:34:39'),
(2, 'Liver Function Test', 60.00, 'LFT test', 11, '2025-06-04 13:28:49', '2025-06-07 11:37:16'),
(3, 'Blood Sugar', 25.00, 'Blood sugar test', 11, '2025-06-04 13:28:49', '2025-06-07 11:38:35'),
(5, 'BR FOR MBS', 200.00, 'BR FOR MBS', 11, '2025-06-07 11:40:16', '2025-06-07 11:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `medications` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `drug_id` bigint(20) UNSIGNED NOT NULL,
  `dosage_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `visit_id`, `medications`, `created_at`, `updated_at`, `drug_id`, `dosage_id`, `route_id`) VALUES
(5, 6, '', '2025-06-08 08:08:46', '2025-06-08 08:08:46', 2, 2, 1),
(6, 6, '', '2025-06-08 08:08:46', '2025-06-08 08:08:46', 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_05_062052_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('lidwaji7@gmail.com', '$2y$12$anzSrAP/Vw651QmfhnVUGObHOT3qvyoogC0U0313dQZsWJwjloh4q', '2025-06-02 20:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_no` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_relationship` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `guardian_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_no`, `first_name`, `last_name`, `dob`, `id_number`, `gender`, `phone`, `email`, `guardian_name`, `guardian_relationship`, `guardian_phone`, `guardian_email`, `created_at`, `updated_at`) VALUES
(1, 'KSC-20240604-A1B2', 'John', 'Doe', '1990-01-15', 'ID1001', 'Male', '0712345678', 'john.doe@example.com', 'Jane Doe', 'Mother', '0712345679', 'jane.doe@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(2, 'KSC-20240604-C3D4', 'Mary', 'Smith', '1985-03-22', 'ID1002', 'Female', '0723456789', 'mary.smith@example.com', 'Paul Smith', 'Father', '0723456790', 'paul.smith@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(3, 'KSC-20240604-E5F6', 'James', 'Brown', '1978-07-09', 'ID1003', 'Male', '0734567890', 'james.brown@example.com', 'Linda Brown', 'Wife', '0734567891', 'linda.brown@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(4, 'KSC-20240604-G7H8', 'Patricia', 'Johnson', '1992-11-30', 'ID1004', 'Female', '0745678901', 'patricia.johnson@example.com', 'Mark Johnson', 'Husband', '0745678902', 'mark.johnson@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(5, 'KSC-20240604-I9J0', 'Robert', 'Williams', '1980-05-18', 'ID1005', 'Male', '0756789012', 'robert.williams@example.com', 'Susan Williams', 'Mother', '0756789013', 'susan.williams@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(6, 'KSC-20240604-K1L2', 'Linda', 'Jones', '1995-09-25', 'ID1006', 'Female', '0767890123', 'linda.jones@example.com', 'Peter Jones', 'Father', '0767890124', 'peter.jones@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(7, 'KSC-20240604-M3N4', 'Michael', 'Garcia', '1988-02-14', 'ID1007', 'Male', '0778901234', 'michael.garcia@example.com', 'Maria Garcia', 'Mother', '0778901235', 'maria.garcia@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(8, 'KSC-20240604-O5P6', 'Barbara', 'Martinez', '1975-06-12', 'ID1008', 'Female', '0789012345', 'barbara.martinez@example.com', 'Carlos Martinez', 'Husband', '0789012346', 'carlos.martinez@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(9, 'KSC-20240604-Q7R8', 'William', 'Rodriguez', '1993-12-03', 'ID1009', 'Male', '0790123456', 'william.rodriguez@example.com', 'Ana Rodriguez', 'Wife', '0790123457', 'ana.rodriguez@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(10, 'KSC-20240604-S9T0', 'Elizabeth', 'Hernandez', '1982-08-21', 'ID1010', 'Female', '0701234567', 'elizabeth.hernandez@example.com', 'Jose Hernandez', 'Father', '0701234568', 'jose.hernandez@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(11, 'KSC-20240604-U1V2', 'David', 'Lopez', '1991-04-10', 'ID1011', 'Male', '0712345670', 'david.lopez@example.com', 'Laura Lopez', 'Mother', '0712345671', 'laura.lopez@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(12, 'KSC-20240604-W3X4', 'Jennifer', 'Gonzalez', '1987-10-29', 'ID1012', 'Female', '0723456701', 'jennifer.gonzalez@example.com', 'Miguel Gonzalez', 'Father', '0723456702', 'miguel.gonzalez@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(13, 'KSC-20240604-Y5Z6', 'Richard', 'Wilson', '1979-03-17', 'ID1013', 'Male', '0734567012', 'richard.wilson@example.com', 'Nancy Wilson', 'Wife', '0734567013', 'nancy.wilson@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(14, 'KSC-20240604-A7B8', 'Maria', 'Anderson', '1994-07-05', 'ID1014', 'Female', '0745670123', 'maria.anderson@example.com', 'George Anderson', 'Father', '0745670124', 'george.anderson@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(15, 'KSC-20240604-C9D0', 'Charles', 'Thomas', '1983-01-23', 'ID1015', 'Male', '0756701234', 'charles.thomas@example.com', 'Helen Thomas', 'Mother', '0756701235', 'helen.thomas@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(16, 'KSC-20240604-E1F2', 'Susan', 'Taylor', '1996-05-16', 'ID1016', 'Female', '0767012345', 'susan.taylor@example.com', 'Frank Taylor', 'Father', '0767012346', 'frank.taylor@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(17, 'KSC-20240604-G3H4', 'Joseph', 'Moore', '1981-09-28', 'ID1017', 'Male', '0770123456', 'joseph.moore@example.com', 'Diana Moore', 'Wife', '0770123457', 'diana.moore@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(18, 'KSC-20240604-I5J6', 'Karen', 'Jackson', '1990-12-11', 'ID1018', 'Female', '0781234567', 'karen.jackson@example.com', 'Edward Jackson', 'Father', '0781234568', 'edward.jackson@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(19, 'KSC-20240604-K7L8', 'Thomas', 'Martin', '1986-06-07', 'ID1019', 'Male', '0792345678', 'thomas.martin@example.com', 'Patricia Martin', 'Mother', '0792345679', 'patricia.martin@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(20, 'KSC-20240604-M9N0', 'Nancy', 'Lee', '1992-02-19', 'ID1020', 'Female', '0703456789', 'nancy.lee@example.com', 'Henry Lee', 'Father', '0703456790', 'henry.lee@example.com', '2025-06-04 11:50:30', '2025-06-04 11:50:30'),
(21, 'KSC-20250608-754A', 'patient one', 'patient one', '2016-05-11', '12345678', 'Male', '0798646636', 'patientone@gmail.com', 'patient gurdian', 'Mother', '0892828288', 'p@gmail.com', '2025-06-08 11:28:21', '2025-06-08 11:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `patient_attachments`
--

CREATE TABLE `patient_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_attachments`
--

INSERT INTO `patient_attachments` (`id`, `patient_id`, `file_path`, `description`, `created_at`, `updated_at`) VALUES
(1, 18, 'attachments/dzyTXsFrcBHDBiR9XUGn05CKskcWxdjbUSOqS93g.png', 'radiology', '2025-06-04 09:43:01', '2025-06-04 09:43:01'),
(2, 21, 'attachments/elXC4JHbCpUrfWps12nbdow2YghuTEgyszJd7PcU.pdf', 'lab report', '2025-06-08 11:30:17', '2025-06-08 11:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_number` varchar(50) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `method` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'viewpatients', 'web', '2025-06-05 04:01:35', '2025-06-05 04:01:35'),
(2, 'createpatients', 'web', '2025-06-05 04:06:06', '2025-06-05 04:06:06'),
(3, 'viewpatientsummary', 'web', '2025-06-05 04:08:09', '2025-06-05 04:08:09'),
(4, 'uploadpatientattachments', 'web', '2025-06-05 04:08:31', '2025-06-05 04:08:31'),
(5, 'viewappointments', 'web', '2025-06-05 04:56:45', '2025-06-05 04:56:45'),
(6, 'createappointments', 'web', '2025-06-05 04:57:00', '2025-06-05 04:57:00'),
(7, 'viewappointmentqueue', 'web', '2025-06-05 04:57:15', '2025-06-05 04:57:15'),
(8, 'viewvisits', 'web', '2025-06-05 05:08:49', '2025-06-05 05:08:49'),
(9, 'createvisits', 'web', '2025-06-05 05:09:20', '2025-06-05 05:09:20'),
(10, 'viewvisitqueue', 'web', '2025-06-05 05:09:35', '2025-06-05 05:09:35'),
(11, 'viewvisitmedications', 'web', '2025-06-05 05:09:52', '2025-06-05 05:09:52'),
(12, 'viewvisitbilling', 'web', '2025-06-05 05:10:10', '2025-06-05 05:10:10'),
(13, 'viewvisitvitals', 'web', '2025-06-05 05:13:06', '2025-06-05 05:13:06'),
(14, 'viewvisitnotes', 'web', '2025-06-05 10:39:27', '2025-06-05 10:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `procedures`
--

INSERT INTO `procedures` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Appendectomy', 1500.00, 'Surgical removal of the appendix', '2025-06-04 13:28:09', '2025-06-04 13:28:09'),
(2, 'Colonoscopy', 800.00, 'Examination of the colon', '2025-06-04 13:28:09', '2025-06-04 13:28:09'),
(3, 'Cataract Surgery', 1200.00, 'Removal of cataract from the eye', '2025-06-04 13:28:09', '2025-06-04 13:28:09'),
(4, 'Appendectomy', 1500.00, 'Surgical removal of the appendix', '2025-06-04 13:28:15', '2025-06-04 13:28:15'),
(5, 'Colonoscopy', 800.00, 'Examination of the colon', '2025-06-04 13:28:15', '2025-06-04 13:28:15'),
(6, 'Cataract Surgery', 1200.00, 'Removal of cataract from the eye', '2025-06-04 13:28:15', '2025-06-04 13:28:15'),
(7, 'Appendectomy', 1500.00, 'Surgical removal of the appendix', '2025-06-04 13:28:49', '2025-06-04 13:28:49'),
(8, 'Colonoscopy', 800.00, 'Examination of the colon', '2025-06-04 13:28:49', '2025-06-04 13:28:49'),
(9, 'Cataract Surgery', 1200.00, 'Removal of cataract from the eye', '2025-06-04 13:28:49', '2025-06-04 13:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `procedure_orders`
--

CREATE TABLE `procedure_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `procedure_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `procedure_orders`
--

INSERT INTO `procedure_orders` (`id`, `visit_id`, `procedure_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 9, 1, 1200.00, 'billed', '2025-06-04 14:35:47', '2025-06-04 17:00:16'),
(2, 6, 2, 1, 800.00, 'billed', '2025-06-05 10:14:35', '2025-06-05 10:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `expected_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `supplier_id`, `status`, `expected_date`, `created_at`, `updated_at`) VALUES
(1, 'PO-33993', 1, 'pending', '2025-06-03', '2025-06-03 06:22:01', '2025-06-03 06:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `radiology_orders`
--

CREATE TABLE `radiology_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `radiology_service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radiology_orders`
--

INSERT INTO `radiology_orders` (`id`, `visit_id`, `radiology_service_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 500.00, 'billed', '2025-06-04 14:24:47', '2025-06-04 16:59:20'),
(2, 6, 1, 1, 100.00, 'billed', '2025-06-05 10:14:07', '2025-06-05 10:25:34'),
(3, 4, 3, 1, 900.00, 'billed', '2025-06-07 08:07:49', '2025-06-07 08:13:55'),
(4, 6, 1, 1, 100.00, 'pending', '2025-06-08 08:04:34', '2025-06-08 08:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `radiology_results`
--

CREATE TABLE `radiology_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `resulted_by` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radiology_results`
--

INSERT INTO `radiology_results` (`id`, `order_id`, `test_name`, `resulted_by`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 3, 'test', 'test', 'test', '2025-06-08 07:05:02', '2025-06-08 07:05:02'),
(2, 3, 'MRI', 'admin', 'tuko sawa sasa', '2025-06-08 07:46:25', '2025-06-08 07:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `radiology_services`
--

CREATE TABLE `radiology_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `radiology_services`
--

INSERT INTO `radiology_services` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Chest X-Ray', 100.00, 'Radiographic image of the chest', '2025-06-04 13:28:09', '2025-06-04 13:28:09'),
(2, 'CT Scan', 500.00, 'Computed Tomography scan', '2025-06-04 13:28:09', '2025-06-04 13:28:09'),
(3, 'MRI', 900.00, 'Magnetic Resonance Imaging', '2025-06-04 13:28:09', '2025-06-04 13:28:09'),
(4, 'Chest X-Ray', 100.00, 'Radiographic image of the chest', '2025-06-04 13:28:15', '2025-06-04 13:28:15'),
(5, 'CT Scan', 500.00, 'Computed Tomography scan', '2025-06-04 13:28:15', '2025-06-04 13:28:15'),
(6, 'MRI', 900.00, 'Magnetic Resonance Imaging', '2025-06-04 13:28:15', '2025-06-04 13:28:15'),
(7, 'Chest X-Ray', 100.00, 'Radiographic image of the chest', '2025-06-04 13:28:49', '2025-06-04 13:28:49'),
(8, 'CT Scan', 500.00, 'Computed Tomography scan', '2025-06-04 13:28:49', '2025-06-04 13:28:49'),
(9, 'MRI', 900.00, 'Magnetic Resonance Imaging', '2025-06-04 13:28:49', '2025-06-04 13:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'systemadmin', 'web', '2025-06-05 03:43:11', '2025-06-05 03:43:11'),
(2, 'accounts', 'web', '2025-06-05 03:43:45', '2025-06-05 03:43:45'),
(3, 'doctor', 'web', '2025-06-05 03:44:08', '2025-06-05 03:44:08'),
(4, 'nurse', 'web', '2025-06-05 03:44:27', '2025-06-05 03:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Oral', '2025-06-02 20:57:13', '2025-06-02 20:57:13'),
(2, 'Intravenous', '2025-06-02 20:57:13', '2025-06-02 20:57:13'),
(3, 'Topical', '2025-06-02 20:57:13', '2025-06-02 20:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `sample_collections`
--

CREATE TABLE `sample_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `sample_type` varchar(50) NOT NULL,
  `collected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sample_collections`
--

INSERT INTO `sample_collections` (`id`, `order_id`, `sample_type`, `collected_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'blood', '2025-06-08 01:17:31', '2025-06-08 01:17:31', '2025-06-08 01:17:31'),
(2, 3, 'blood', '2025-06-08 01:18:27', '2025-06-08 01:18:27', '2025-06-08 01:18:27'),
(3, 4, 'blood', '2025-06-08 11:24:40', '2025-06-08 11:24:40', '2025-06-08 11:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Consultation', 20.00, '2025-06-02 21:32:28', '2025-06-02 21:32:28'),
(2, 'X-ray', 50.00, '2025-06-02 21:32:28', '2025-06-02 21:32:28'),
(3, 'Lab Test', 30.00, '2025-06-02 21:32:28', '2025-06-02 21:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `service_orders`
--

CREATE TABLE `service_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_orders`
--

INSERT INTO `service_orders` (`id`, `visit_id`, `service_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 20.00, 'billed', '2025-06-04 14:29:32', '2025-06-04 17:00:15'),
(2, 6, 2, 1, 50.00, 'billed', '2025-06-05 10:14:22', '2025-06-05 10:25:34'),
(3, 4, 1, 1, 20.00, 'billed', '2025-06-07 08:08:20', '2025-06-07 08:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('g9MNTlmd9qMqGBY44LGXrS7z9FkKJbQAx407B7LK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT0FSd0lXZnRmcnBBaVZKZ2t3bHVJWVRXNXlCUHlFRlFOcTZORlpYRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb25zdWx0YXRpb24vY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1749407473),
('VOq2jxG1DzaglwwpwbH4r9NqRq0FMCM6fuELaZdS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnJZdUxubHJTWEJ4R3JVenhhd0JtNEZsdXVrbXhiMmJFZHRNekhBciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmlhbC1iYWxhbmNlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1749396432);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `from_store_id` bigint(20) UNSIGNED NOT NULL,
  `to_store_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `transfer_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` enum('debit','credit') NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `account_id`, `date`, `description`, `type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-06', 'money', 'credit', 20000.00, '2025-06-06 15:14:34', '2025-06-06 15:14:34'),
(2, 1, '2025-06-06', 'money', 'credit', 20000.00, '2025-06-06 15:15:41', '2025-06-06 15:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_histories`
--

CREATE TABLE `transfer_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) UNSIGNED NOT NULL,
  `from_ward_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_ward_id` bigint(20) UNSIGNED NOT NULL,
  `from_bed_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_bed_id` bigint(20) UNSIGNED NOT NULL,
  `transferred_by` bigint(20) UNSIGNED NOT NULL,
  `transferred_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_histories`
--

INSERT INTO `transfer_histories` (`id`, `admission_id`, `from_ward_id`, `to_ward_id`, `from_bed_id`, `to_bed_id`, `transferred_by`, `transferred_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 2, 5, 3, 1, '2025-06-05 09:13:31', NULL, '2025-06-05 09:13:31', '2025-06-05 09:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'lidwaji7@gmail.com', NULL, '$2y$12$yqiqxBxWsQVqOt/Rv81.rOl6GdVzYkSPtLLsd1QynGKnsW/Foyqyy', NULL, '2025-06-01 10:11:17', '2025-06-01 10:11:17'),
(2, 'humphrey', 'hamphreyirausa@gmail.com', NULL, '$2y$12$Dod1NCoFFTD2Zqo31Qkkp.X2HVGGl3mBoj8lfIYACZjECHW2jLZHi', NULL, '2025-06-02 19:57:56', '2025-06-02 19:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `contact_person`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'MediSupplies Ltd', 'Jane Doe', '0712345678', 'jane@medisupplies.com', '2025-06-03 09:07:27', '2025-06-03 09:07:27'),
(2, 'Pharma Distributors', 'John Smith', '0723456789', 'john@pharmadist.com', '2025-06-03 09:07:27', '2025-06-03 09:07:27'),
(3, 'LabTech Solutions', 'Alice Brown', '0734567890', 'alice@labtech.com', '2025-06-03 09:07:27', '2025-06-03 09:07:27'),
(4, 'HealthEquip Co', 'Bob White', '0745678901', 'bob@healthequip.com', '2025-06-03 09:07:27', '2025-06-03 09:07:27'),
(5, 'Clinic Essentials', 'Mary Green', '0756789012', 'mary@clinicessentials.com', '2025-06-03 09:07:27', '2025-06-03 09:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `visit_number` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `patient_id`, `doctor_id`, `type`, `start_date`, `is_active`, `visit_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'OPD', '2025-06-03', 1, 'VIS-683F26C9BBFC6', '2025-06-03 13:46:01', '2025-06-03 13:46:01'),
(2, 3, 3, 'OPD', '2025-06-04', 1, 'VIS-68404FDF9D49E', '2025-06-04 10:53:35', '2025-06-04 10:53:35'),
(3, 15, 3, 'OPD', '2025-06-04', 1, 'VIS-6840AB947FD68', '2025-06-04 17:24:52', '2025-06-04 17:24:52'),
(4, 4, 2, 'OPD', '2025-06-04', 1, 'VIS-6840AC853C228', '2025-06-04 17:28:53', '2025-06-04 17:28:53'),
(5, 13, 2, 'OPD', '2025-06-04', 1, 'VIS-6840ACF8677FD', '2025-06-04 17:30:48', '2025-06-04 17:30:48'),
(6, 2, 4, 'IP', '2025-06-05', 0, 'VIS-684160CCDAAB1', '2025-06-05 06:18:04', '2025-06-05 13:27:58'),
(7, 21, 4, 'OPD', '2025-06-08', 1, 'VIS-68459FE8D82B0', '2025-06-08 11:36:24', '2025-06-08 11:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED NOT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `pulse` int(11) DEFAULT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `resp` int(11) DEFAULT NULL,
  `spo2` int(11) DEFAULT NULL,
  `rbs` decimal(6,2) DEFAULT NULL,
  `fbs` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`id`, `visit_id`, `blood_pressure`, `pulse`, `temperature`, `weight`, `resp`, `spo2`, `rbs`, `fbs`, `created_at`, `updated_at`) VALUES
(3, 7, '120/20', 35, 25.00, 24.00, 24, 242, 42.00, 45.00, '2025-06-08 12:23:28', '2025-06-08 12:23:28'),
(4, 7, '23', 15, 25.00, 13.00, 13, 32, 23.00, 13.00, '2025-06-08 12:25:44', '2025-06-08 12:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'General Ward', 'General patients ward', '2025-06-05 10:08:02', '2025-06-05 10:08:02'),
(2, 'Private Ward', 'Private rooms for patients', '2025-06-05 10:08:02', '2025-06-05 10:08:02'),
(3, 'ICU', 'Intensive Care Unit', '2025-06-05 10:08:02', '2025-06-05 10:08:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `account_mappings`
--
ALTER TABLE `account_mappings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_entity_account` (`entity_type`,`entity_id`),
  ADD KEY `fk_account_mappings_account` (`account_id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admissions_patient` (`patient_id`),
  ADD KEY `fk_admissions_visit` (`visit_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointments_patient` (`patient_id`),
  ADD KEY `fk_appointments_doctor` (`doctor_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_auditable` (`auditable_type`,`auditable_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beds_ward` (`ward_id`);

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosages`
--
ALTER TABLE `dosages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `goods_received_notes`
--
ALTER TABLE `goods_received_notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grn_number` (`grn_number`),
  ADD KEY `purchase_order_id` (`purchase_order_id`);

--
-- Indexes for table `icd11s`
--
ALTER TABLE `icd11s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`);

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
-- Indexes for table `lab_orders`
--
ALTER TABLE `lab_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `lab_test_id` (`lab_test_id`);

--
-- Indexes for table `lab_requests`
--
ALTER TABLE `lab_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_results_order_id_foreign` (`order_id`),
  ADD KEY `lab_results_template_id_foreign` (`template_id`);

--
-- Indexes for table `lab_result_templates`
--
ALTER TABLE `lab_result_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `drug_id` (`drug_id`),
  ADD KEY `dosage_id` (`dosage_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_attachments`
--
ALTER TABLE `patient_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_number` (`payment_number`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procedure_orders`
--
ALTER TABLE `procedure_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `procedure_id` (`procedure_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `po_number` (`po_number`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `radiology_orders`
--
ALTER TABLE `radiology_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `radiology_service_id` (`radiology_service_id`);

--
-- Indexes for table `radiology_results`
--
ALTER TABLE `radiology_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_radiology_results_patient` (`order_id`);

--
-- Indexes for table `radiology_services`
--
ALTER TABLE `radiology_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_collections`
--
ALTER TABLE `sample_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`order_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `from_store_id` (`from_store_id`),
  ADD KEY `to_store_id` (`to_store_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transactions_account` (`account_id`);

--
-- Indexes for table `transfer_histories`
--
ALTER TABLE `transfer_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transfer_histories_admission` (`admission_id`),
  ADD KEY `fk_transfer_histories_from_ward` (`from_ward_id`),
  ADD KEY `fk_transfer_histories_to_ward` (`to_ward_id`),
  ADD KEY `fk_transfer_histories_from_bed` (`from_bed_id`),
  ADD KEY `fk_transfer_histories_to_bed` (`to_bed_id`),
  ADD KEY `fk_transfer_histories_user` (`transferred_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `account_mappings`
--
ALTER TABLE `account_mappings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dosages`
--
ALTER TABLE `dosages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods_received_notes`
--
ALTER TABLE `goods_received_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `icd11s`
--
ALTER TABLE `icd11s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_orders`
--
ALTER TABLE `lab_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lab_requests`
--
ALTER TABLE `lab_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_results`
--
ALTER TABLE `lab_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_result_templates`
--
ALTER TABLE `lab_result_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `patient_attachments`
--
ALTER TABLE `patient_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `procedure_orders`
--
ALTER TABLE `procedure_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radiology_orders`
--
ALTER TABLE `radiology_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `radiology_results`
--
ALTER TABLE `radiology_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `radiology_services`
--
ALTER TABLE `radiology_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sample_collections`
--
ALTER TABLE `sample_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfer_histories`
--
ALTER TABLE `transfer_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_mappings`
--
ALTER TABLE `account_mappings`
  ADD CONSTRAINT `fk_account_mappings_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `fk_admissions_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `fk_admissions_visit` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointments_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appointments_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `fk_beds_ward` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `billings`
--
ALTER TABLE `billings`
  ADD CONSTRAINT `billings_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `goods_received_notes`
--
ALTER TABLE `goods_received_notes`
  ADD CONSTRAINT `goods_received_notes_ibfk_1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lab_orders`
--
ALTER TABLE `lab_orders`
  ADD CONSTRAINT `lab_orders_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lab_orders_ibfk_2` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lab_requests`
--
ALTER TABLE `lab_requests`
  ADD CONSTRAINT `lab_requests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lab_results`
--
ALTER TABLE `lab_results`
  ADD CONSTRAINT `lab_results_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `lab_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lab_results_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `lab_result_templates` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `medications`
--
ALTER TABLE `medications`
  ADD CONSTRAINT `medications_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_ibfk_3` FOREIGN KEY (`dosage_id`) REFERENCES `dosages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_ibfk_4` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_attachments`
--
ALTER TABLE `patient_attachments`
  ADD CONSTRAINT `patient_attachments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `procedure_orders`
--
ALTER TABLE `procedure_orders`
  ADD CONSTRAINT `procedure_orders_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `procedure_orders_ibfk_2` FOREIGN KEY (`procedure_id`) REFERENCES `procedures` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `radiology_orders`
--
ALTER TABLE `radiology_orders`
  ADD CONSTRAINT `radiology_orders_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `radiology_orders_ibfk_2` FOREIGN KEY (`radiology_service_id`) REFERENCES `radiology_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `radiology_results`
--
ALTER TABLE `radiology_results`
  ADD CONSTRAINT `fk_radiology_results_patient` FOREIGN KEY (`order_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sample_collections`
--
ALTER TABLE `sample_collections`
  ADD CONSTRAINT `sample_collections_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD CONSTRAINT `service_orders_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_orders_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD CONSTRAINT `stock_transfers_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_2` FOREIGN KEY (`from_store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transfers_ibfk_3` FOREIGN KEY (`to_store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `transfer_histories`
--
ALTER TABLE `transfer_histories`
  ADD CONSTRAINT `fk_transfer_histories_admission` FOREIGN KEY (`admission_id`) REFERENCES `admissions` (`id`),
  ADD CONSTRAINT `fk_transfer_histories_from_bed` FOREIGN KEY (`from_bed_id`) REFERENCES `beds` (`id`),
  ADD CONSTRAINT `fk_transfer_histories_from_ward` FOREIGN KEY (`from_ward_id`) REFERENCES `wards` (`id`),
  ADD CONSTRAINT `fk_transfer_histories_to_bed` FOREIGN KEY (`to_bed_id`) REFERENCES `beds` (`id`),
  ADD CONSTRAINT `fk_transfer_histories_to_ward` FOREIGN KEY (`to_ward_id`) REFERENCES `wards` (`id`),
  ADD CONSTRAINT `fk_transfer_histories_user` FOREIGN KEY (`transferred_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vitals`
--
ALTER TABLE `vitals`
  ADD CONSTRAINT `vitals_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
