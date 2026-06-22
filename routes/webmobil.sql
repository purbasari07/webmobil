-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2026 at 12:03 PM
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
-- Database: `webmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `complaint` text DEFAULT NULL,
  `is_offline` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `vehicle_id`, `service_id`, `booking_date`, `booking_time`, `status`, `complaint`, `is_offline`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 1, '2026-06-15', '11:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 1, '2026-06-20 02:06:36', '2026-06-20 02:06:36'),
(2, 7, 3, 2, '2026-05-25', '08:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:36', '2026-06-20 02:06:36'),
(3, 8, 4, 3, '2026-06-07', '08:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 1, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(4, 9, 5, 4, '2026-06-06', '08:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(5, 6, 6, 5, '2026-06-15', '16:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 1, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(6, 7, 7, 6, '2026-06-10', '10:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(7, 8, 8, 1, '2026-06-04', '10:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 1, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(8, 9, 9, 2, '2026-06-01', '11:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(9, 6, 10, 3, '2026-06-14', '08:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(10, 7, 11, 4, '2026-06-03', '08:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(11, 8, 12, 5, '2026-06-13', '13:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(12, 9, 13, 6, '2026-06-10', '11:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(13, 6, 14, 1, '2026-05-22', '12:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 1, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(14, 7, 15, 2, '2026-06-18', '14:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 0, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(15, 8, 16, 3, '2026-06-18', '09:00:00', 'Completed', 'Servis rutin berkala, tolong cek kelistrikan.', 1, '2026-06-20 02:06:37', '2026-06-20 02:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2026_06_20_083900_create_vehicles_table', 1),
(5, '2026_06_20_083902_create_services_table', 1),
(6, '2026_06_20_083903_create_bookings_table', 1),
(7, '2026_06_20_083903_create_spareparts_table', 1),
(8, '2026_06_20_083904_create_transactions_table', 1),
(9, '2026_06_20_083905_create_payments_table', 1),
(10, '2026_06_20_083906_create_transaction_spareparts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount_paid` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `transaction_id`, `payment_date`, `amount_paid`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-06-15 09:06:35', 530000.00, 'Cash', 'Paid', '2026-06-15 02:06:35', '2026-06-15 02:06:35'),
(2, 2, '2026-05-25 09:06:35', 445000.00, 'Transfer', 'Paid', '2026-05-25 02:06:35', '2026-05-25 02:06:35'),
(3, 3, '2026-06-07 09:06:35', 540000.00, 'Transfer', 'Paid', '2026-06-07 02:06:35', '2026-06-07 02:06:35'),
(4, 4, '2026-06-06 09:06:35', 2090000.00, 'QRIS', 'Paid', '2026-06-06 02:06:35', '2026-06-06 02:06:35'),
(5, 5, '2026-06-15 09:06:35', 165000.00, 'Cash', 'Paid', '2026-06-15 02:06:35', '2026-06-15 02:06:35'),
(6, 6, '2026-06-10 09:06:35', 550000.00, 'Cash', 'Paid', '2026-06-10 02:06:35', '2026-06-10 02:06:35'),
(7, 7, '2026-06-04 09:06:35', 235000.00, 'Cash', 'Paid', '2026-06-04 02:06:35', '2026-06-04 02:06:35'),
(8, 8, '2026-06-01 09:06:35', 580000.00, 'Transfer', 'Paid', '2026-06-01 02:06:35', '2026-06-01 02:06:35'),
(9, 9, '2026-06-14 09:06:35', 595000.00, 'QRIS', 'Paid', '2026-06-14 02:06:35', '2026-06-14 02:06:35'),
(10, 10, '2026-06-03 09:06:35', 345000.00, 'Cash', 'Paid', '2026-06-03 02:06:35', '2026-06-03 02:06:35'),
(11, 11, '2026-06-13 09:06:35', 995000.00, 'Cash', 'Paid', '2026-06-13 02:06:35', '2026-06-13 02:06:35'),
(12, 12, '2026-06-10 09:06:35', 345000.00, 'Transfer', 'Paid', '2026-06-10 02:06:35', '2026-06-10 02:06:35'),
(13, 13, '2026-05-22 09:06:35', 275000.00, 'QRIS', 'Paid', '2026-05-22 02:06:35', '2026-05-22 02:06:35'),
(14, 14, '2026-06-18 09:06:35', 370000.00, 'Transfer', 'Paid', '2026-06-18 02:06:35', '2026-06-18 02:06:35'),
(15, 15, '2026-06-18 09:06:35', 1110000.00, 'QRIS', 'Paid', '2026-06-18 02:06:35', '2026-06-18 02:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `estimated_time` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `description`, `price`, `estimated_time`, `created_at`, `updated_at`) VALUES
(1, 'Ganti Oli Mesin', 'Ganti oli mesin standard beserta filter oli.', 150000.00, '30 Menit', '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(2, 'Servis Rem Paket', 'Pembersihan rem depan dan belakang, ganti minyak rem jika diperlukan.', 200000.00, '45 Menit', '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(3, 'Tune-Up Mesin', 'Tune-up menyeluruh, pembersihan throtle body, busi, dan scan ECU.', 350000.00, '60 Menit', '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(4, 'Servis AC Ringan', 'Vacuum AC, isi freon baru, dan pembersihan filter kabin.', 250000.00, '60 Menit', '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(5, 'Ganti Aki Mobil', 'Jasa penggantian aki beserta backup kelistrikan mobil.', 75000.00, '20 Menit', '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(6, 'Servis Kaki-Kaki', 'Pengecekan shockbreaker, tierod, rackend, dan bushing arm.', 300000.00, '90 Menit', '2026-06-20 02:06:35', '2026-06-20 02:06:35');

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
('OzCVfH53PbidduFNc8oIifcpMouHIxyoJ5Q980Pu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Avast/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialdFNUNBbzk5elZRWnp6NjRBSk5BUHpidElwbWhIN0EyM3RpQmVYQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781946804);

-- --------------------------------------------------------

--
-- Table structure for table `spareparts`
--

CREATE TABLE `spareparts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spareparts`
--

INSERT INTO `spareparts` (`id`, `name`, `brand`, `stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Oli Shell Helix HX7 10W-40 4L', 'Shell', 30, 380000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(2, 'Kampas Rem Depan Avanza', 'Aisin', 15, 245000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(3, 'Busi Denso Iridium Power', 'Denso', 100, 95000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(4, 'Aki GS Astra MF NS60', 'GS Astra', 10, 920000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(5, 'Filter Oli Avanza/Xenia', 'Denso', 50, 45000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(6, 'Filter Udara Avanza', 'Toyota Genuine Parts', 20, 125000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(7, 'Freon R134a 1 Kaleng', 'Kleas', 40, 85000.00, '2026-06-20 02:06:35', '2026-06-20 02:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mekanik_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kasir_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_service` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_sparepart` decimal(12,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `booking_id`, `mekanik_id`, `kasir_id`, `total_service`, `total_sparepart`, `grand_total`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 150000.00, 380000.00, 530000.00, '2026-06-15 02:06:35', '2026-06-15 02:06:35'),
(2, 2, 3, 2, 200000.00, 245000.00, 445000.00, '2026-05-25 02:06:35', '2026-05-25 02:06:35'),
(3, 3, 3, 2, 350000.00, 190000.00, 540000.00, '2026-06-07 02:06:35', '2026-06-07 02:06:35'),
(4, 4, 3, 2, 250000.00, 1840000.00, 2090000.00, '2026-06-06 02:06:35', '2026-06-06 02:06:35'),
(5, 5, 3, 2, 75000.00, 90000.00, 165000.00, '2026-06-15 02:06:35', '2026-06-15 02:06:35'),
(6, 6, 3, 2, 300000.00, 250000.00, 550000.00, '2026-06-10 02:06:35', '2026-06-10 02:06:35'),
(7, 7, 3, 2, 150000.00, 85000.00, 235000.00, '2026-06-04 02:06:35', '2026-06-04 02:06:35'),
(8, 8, 3, 2, 200000.00, 380000.00, 580000.00, '2026-06-01 02:06:35', '2026-06-01 02:06:35'),
(9, 9, 3, 2, 350000.00, 245000.00, 595000.00, '2026-06-14 02:06:35', '2026-06-14 02:06:35'),
(10, 10, 3, 2, 250000.00, 95000.00, 345000.00, '2026-06-03 02:06:35', '2026-06-03 02:06:35'),
(11, 11, 3, 2, 75000.00, 920000.00, 995000.00, '2026-06-13 02:06:35', '2026-06-13 02:06:35'),
(12, 12, 3, 2, 300000.00, 45000.00, 345000.00, '2026-06-10 02:06:35', '2026-06-10 02:06:35'),
(13, 13, 3, 2, 150000.00, 125000.00, 275000.00, '2026-05-22 02:06:35', '2026-05-22 02:06:35'),
(14, 14, 3, 2, 200000.00, 170000.00, 370000.00, '2026-06-18 02:06:35', '2026-06-18 02:06:35'),
(15, 15, 3, 2, 350000.00, 760000.00, 1110000.00, '2026-06-18 02:06:35', '2026-06-18 02:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_spareparts`
--

CREATE TABLE `transaction_spareparts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `sparepart_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_spareparts`
--

INSERT INTO `transaction_spareparts` (`id`, `transaction_id`, `sparepart_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 380000.00, '2026-06-15 02:06:35', '2026-06-15 02:06:35'),
(2, 2, 2, 1, 245000.00, '2026-05-25 02:06:35', '2026-05-25 02:06:35'),
(3, 3, 3, 2, 95000.00, '2026-06-07 02:06:35', '2026-06-07 02:06:35'),
(4, 4, 4, 2, 920000.00, '2026-06-06 02:06:35', '2026-06-06 02:06:35'),
(5, 5, 5, 2, 45000.00, '2026-06-15 02:06:35', '2026-06-15 02:06:35'),
(6, 6, 6, 2, 125000.00, '2026-06-10 02:06:35', '2026-06-10 02:06:35'),
(7, 7, 7, 1, 85000.00, '2026-06-04 02:06:35', '2026-06-04 02:06:35'),
(8, 8, 1, 1, 380000.00, '2026-06-01 02:06:35', '2026-06-01 02:06:35'),
(9, 9, 2, 1, 245000.00, '2026-06-14 02:06:35', '2026-06-14 02:06:35'),
(10, 10, 3, 1, 95000.00, '2026-06-03 02:06:35', '2026-06-03 02:06:35'),
(11, 11, 4, 1, 920000.00, '2026-06-13 02:06:35', '2026-06-13 02:06:35'),
(12, 12, 5, 1, 45000.00, '2026-06-10 02:06:35', '2026-06-10 02:06:35'),
(13, 13, 6, 1, 125000.00, '2026-05-22 02:06:35', '2026-05-22 02:06:35'),
(14, 14, 7, 2, 85000.00, '2026-06-18 02:06:35', '2026-06-18 02:06:35'),
(15, 15, 1, 2, 380000.00, '2026-06-18 02:06:35', '2026-06-18 02:06:35');

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
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Workshop Admin', 'admin@gmail.com', NULL, '$2y$12$7oA69hT53ZL.wptnziYQPOnzHOUXnQ51r7a/1BgeX0dObkF.xWhz.', 'admin', '081234567890', 'Jl. Admin No. 1, Jakarta', NULL, '2026-06-20 02:06:34', '2026-06-20 02:06:34'),
(2, 'Workshop Kasir', 'kasir@gmail.com', NULL, '$2y$12$EHv6iywcTgq.bA9JjSox1eEFV3Tgzv6btkeFvM.P6H.CSwmjXTLN6', 'kasir', '081234567891', 'Jl. Kasir No. 2, Jakarta', NULL, '2026-06-20 02:06:34', '2026-06-20 02:06:34'),
(3, 'Workshop Mekanik', 'mekanik@gmail.com', NULL, '$2y$12$oLCQfw01QvjCBDEG5wAyH.0x57zmsiZQTNcZZAuoEBaauYN8XIEM.', 'mekanik', '081234567892', 'Jl. Mekanik No. 3, Jakarta', NULL, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(4, 'Workshop Owner', 'owner@gmail.com', NULL, '$2y$12$OiUkf19WhWjWVRuJ3xvHi.BYhpEwXQAbyxRuNDWRx/BXC58C42Jg.', 'owner', '081234567893', 'Jl. Owner No. 4, Jakarta', NULL, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(5, 'Workshop Customer', 'customer@gmail.com', NULL, '$2y$12$Zn78eUL56XfUdmBegFvJCOM9Sz4jS.O66liDgN50VvAocJ8rR1eW6', 'customer', '081234567894', 'Jl. Customer No. 5, Jakarta', NULL, '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(6, 'Budi Santoso', 'budi@gmail.com', NULL, '$2y$12$JYjWH2jQbP6sc2u3Uf13Lea2hyZNbkBco/mgfHre15UcUNeVhOIb6', 'customer', '089876543210', 'Jl. Sudirman No. 12, Bandung', NULL, '2026-06-20 02:06:36', '2026-06-20 02:06:36'),
(7, 'Dewi Lestari', 'dewi@gmail.com', NULL, '$2y$12$PnsazvQ1bwE24Q5.t8Q.De9..MtGOpGID3RXMaI3Ud33PAiZdaIG2', 'customer', '089876543211', 'Jl. Merdeka No. 45, Bandung', NULL, '2026-06-20 02:06:36', '2026-06-20 02:06:36'),
(8, 'Eko Prasetyo', 'eko@gmail.com', NULL, '$2y$12$L7YAVfLjvt3DBzOlKgMjA.Mi/6nKjN6DiV0.qA1ScgMpBiSJyXYW6', 'customer', '089876543212', 'Jl. Pajajaran No. 3, Bandung', NULL, '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(9, 'Siti Aminah', 'siti@gmail.com', NULL, '$2y$12$1A/mMg.8BMqakkylMrIqROUX7RHl2DneBBSl27dVfi8GCOU2nb8FG', 'customer', '089876543213', 'Jl. Gatot Subroto No. 56, Bandung', NULL, '2026-06-20 02:06:37', '2026-06-20 02:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `license_plate` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `user_id`, `brand`, `model`, `year`, `license_plate`, `color`, `created_at`, `updated_at`) VALUES
(1, 5, 'Toyota', 'Avanza Veloz', 2021, 'B 1234 ABC', 'Hitam Metalik', '2026-06-20 02:06:35', '2026-06-20 02:06:35'),
(2, 6, 'Honda', 'Civic Turbo', 2019, 'D 999 BS', 'Merah', '2026-06-20 02:06:36', '2026-06-20 02:06:36'),
(3, 7, 'Suzuki', 'Ertiga', 2018, 'D 888 DW', 'Abu-abu', '2026-06-20 02:06:36', '2026-06-20 02:06:36'),
(4, 8, 'Mitsubishi', 'Xpander', 2020, 'D 777 EK', 'Putih', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(5, 9, 'Daihatsu', 'Ayla', 2017, 'D 555 ST', 'Silver', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(6, 6, 'Honda', 'Civic Turbo', 2019, 'D 999 BS', 'Merah', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(7, 7, 'Suzuki', 'Ertiga', 2018, 'D 888 DW', 'Abu-abu', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(8, 8, 'Mitsubishi', 'Xpander', 2020, 'D 777 EK', 'Putih', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(9, 9, 'Daihatsu', 'Ayla', 2017, 'D 555 ST', 'Silver', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(10, 6, 'Honda', 'Civic Turbo', 2019, 'D 999 BS', 'Merah', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(11, 7, 'Suzuki', 'Ertiga', 2018, 'D 888 DW', 'Abu-abu', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(12, 8, 'Mitsubishi', 'Xpander', 2020, 'D 777 EK', 'Putih', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(13, 9, 'Daihatsu', 'Ayla', 2017, 'D 555 ST', 'Silver', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(14, 6, 'Honda', 'Civic Turbo', 2019, 'D 999 BS', 'Merah', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(15, 7, 'Suzuki', 'Ertiga', 2018, 'D 888 DW', 'Abu-abu', '2026-06-20 02:06:37', '2026-06-20 02:06:37'),
(16, 8, 'Mitsubishi', 'Xpander', 2020, 'D 777 EK', 'Putih', '2026-06-20 02:06:37', '2026-06-20 02:06:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `bookings_service_id_foreign` (`service_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `spareparts`
--
ALTER TABLE `spareparts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_booking_id_foreign` (`booking_id`),
  ADD KEY `transactions_mekanik_id_foreign` (`mekanik_id`),
  ADD KEY `transactions_kasir_id_foreign` (`kasir_id`);

--
-- Indexes for table `transaction_spareparts`
--
ALTER TABLE `transaction_spareparts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_spareparts_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_spareparts_sparepart_id_foreign` (`sparepart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `spareparts`
--
ALTER TABLE `spareparts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaction_spareparts`
--
ALTER TABLE `transaction_spareparts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_kasir_id_foreign` FOREIGN KEY (`kasir_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_mekanik_id_foreign` FOREIGN KEY (`mekanik_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transaction_spareparts`
--
ALTER TABLE `transaction_spareparts`
  ADD CONSTRAINT `transaction_spareparts_sparepart_id_foreign` FOREIGN KEY (`sparepart_id`) REFERENCES `spareparts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_spareparts_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
