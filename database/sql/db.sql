-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 08:45 AM
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
-- Database: `profitport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json`)),
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `tag`, `password`, `remember_token`, `json`, `status`, `updated`, `date`) VALUES
(1, 'master', '$2y$12$9.2R2RU7GN1Sz.n1lbnmI.7y9P4QjjPZONMpxhScf9/bqX.zFGjAS', 'koNLzX7ydWY6z1wyPt0A8g0YWSZzT3ZVESB6QvRxmfGkKxjc8UV8Er6FH4Xv', NULL, 'active', '2026-03-07 17:02:07', '2026-03-07 17:02:07');

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`url`)),
  `icon` text DEFAULT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`)),
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`body`)),
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json`)),
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'json status format for user and admin wether read or unread' CHECK (json_valid(`status`)),
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uniqid`, `url`, `icon`, `title`, `body`, `json`, `status`, `updated`, `date`) VALUES
(1, 'ejLgtsU6l5V6', '{\"admins\":\"http:\\/\\/localhost\\/profitport\\/public\\/admins\\/transaction\\/receipt?id=2\",\"users\":\"http:\\/\\/localhost\\/profitport\\/public\\/users\\/transaction\\/receipt?id=2\"}', NULL, '{\"users\":\"Withdrawal placed\",\"admins\":\"withdrawal request\"}', '{\"users\":\"You placed a withdrawal\",\"admins\":\"New withdrawal request from Emmanuel\"}', NULL, '{\"admins\": \"read\", \"users\": \"unread\"}', '2026-03-25 03:58:16', '2026-03-25 03:58:16'),
(2, 'XGrGpcc4kzRX', '{\"admins\":\"http:\\/\\/localhost\\/profitport\\/public\\/admins\\/transaction\\/receipt?id=2\",\"users\":\"http:\\/\\/localhost\\/profitport\\/public\\/users\\/transaction\\/receipt?id=2\"}', NULL, '{\"users\":\"Withdrawal placed\",\"admins\":\"withdrawal request\"}', '{\"users\":\"You placed a withdrawal\",\"admins\":\"New withdrawal request from Emmanuel\"}', NULL, '{\"admins\": \"read\", \"users\": \"unread\"}', '2026-03-25 03:58:17', '2026-03-25 03:58:17'),
(3, 'CPmuQCKITAwC', '{\"admins\":\"http:\\/\\/localhost\\/profitport\\/public\\/admins\\/transaction\\/receipt?id=2\",\"users\":\"http:\\/\\/localhost\\/profitport\\/public\\/users\\/transaction\\/receipt?id=2\"}', NULL, '{\"users\":\"Withdrawal placed\",\"admins\":\"withdrawal request\"}', '{\"users\":\"You placed a withdrawal\",\"admins\":\"New withdrawal request from Emmanuel\"}', NULL, '{\"admins\": \"read\", \"users\": \"unread\"}', '2026-03-25 03:58:20', '2026-03-25 03:58:20'),
(4, 'dDV8NJjqJXL4', '{\"admins\":\"http:\\/\\/localhost\\/profitport\\/public\\/admins\\/transaction\\/receipt?id=2\",\"users\":\"http:\\/\\/localhost\\/profitport\\/public\\/users\\/transaction\\/receipt?id=2\"}', NULL, '{\"users\":\"Withdrawal placed\",\"admins\":\"withdrawal request\"}', '{\"users\":\"You placed a withdrawal\",\"admins\":\"New withdrawal request from Emmanuel\"}', NULL, '{\"admins\": \"read\", \"users\": \"unread\"}', '2026-03-25 03:58:22', '2026-03-25 03:58:22'),
(5, '1gKE6vHfCJoE', '{\"admins\":\"http:\\/\\/localhost\\/profitport\\/public\\/admins\\/transaction\\/receipt?id=2\",\"users\":\"http:\\/\\/localhost\\/profitport\\/public\\/users\\/transaction\\/receipt?id=2\"}', NULL, '{\"users\":\"Withdrawal placed\",\"admins\":\"withdrawal request\"}', '{\"users\":\"You placed a withdrawal\",\"admins\":\"New withdrawal request from Emmanuel\"}', NULL, '{\"admins\": \"read\", \"users\": \"unread\"}', '2026-03-25 03:58:25', '2026-03-25 03:58:25'),
(6, 'RjCHowXUCXhh', '{\"admins\":\"http:\\/\\/localhost\\/profitport\\/public\\/admins\\/transaction\\/receipt?id=2\",\"users\":\"http:\\/\\/localhost\\/profitport\\/public\\/users\\/transaction\\/receipt?id=2\"}', NULL, '{\"users\":\"Withdrawal placed\",\"admins\":\"withdrawal request\"}', '{\"users\":\"You placed a withdrawal\",\"admins\":\"New withdrawal request from Emmanuel\"}', NULL, '{\"admins\": \"read\", \"users\": \"unread\"}', '2026-03-25 03:58:31', '2026-03-25 03:58:31');

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
('DMXtokLpIog7Jy0H1buoyDlLzzQNrFROFwqBnQ8G', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMnppcUJpVkZsaGJGSkVpak5EN3poOWdsYVlVdVlVNm1iTjl3R0MzOCI7czo1MzoibG9naW5fYWRtaW5zXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo1NToiaHR0cDovL2xvY2FsaG9zdC9wcm9maXRwb3J0L3B1YmxpYy9hZG1pbnMvbm90aWZpY2F0aW9ucyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774389017);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value`)),
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json`)),
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `json`, `status`, `updated`, `date`) VALUES
(1, 'general_settings', '{\"email_verification\":\"on\",\"maintenance_mode\":\"on\"}', NULL, 'active', '2026-03-24 07:18:07', '2026-03-24 03:09:32'),
(2, 'social_settings', '{\"whatsapp_community\":\"https:\\/\\/hhsgd.sh\",\"telegram_community\":\"https:\\/\\/gsgsh.edhd\",\"site_notification\":\"sho8dyy\"}', NULL, 'active', '2026-03-24 03:48:50', '2026-03-24 03:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT 0,
  `fee` float DEFAULT 0,
  `icon` text NOT NULL DEFAULT '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z"></path></svg>',
  `wallet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`wallet`)),
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '{}',
  `status` varchar(255) NOT NULL DEFAULT 'success',
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `uniqid`, `user_id`, `title`, `class`, `type`, `amount`, `fee`, `icon`, `wallet`, `json`, `status`, `updated`, `date`) VALUES
(1, 'IBSJHVRSHL', 1, 'Welcome Bonus', 'credit', 'welcome_bonus', 500, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"admin\",\"to\":\"main_balance\"}', '{\"balance\":{\"before\":0,\"after\":500}}', 'success', '2026-03-10 19:26:36', '2026-03-10 19:26:36'),
(2, 'UO6TYPGRO2', 1, 'Welcome Bonus', 'credit', 'welcome_bonus', 500, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"admin\",\"to\":\"main_balance\"}', '{}{\"balance\":{\"before\":0,\"after\":500}}', 'success', '2026-03-10 19:26:38', '2026-03-10 19:26:38'),
(3, 'ZCEFM8NCWH', 2, 'Welcome Bonus', 'credit', 'welcome_bonus', 500, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"admin\",\"to\":\"main_balance\"}', '{\"balance\":{\"before\":0,\"after\":500}}', 'success', '2026-03-10 19:28:11', '2026-03-10 19:28:11'),
(4, '8YRM97TAN4', 3, 'Welcome Bonus', 'credit', 'welcome_bonus', 500, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"admin\",\"to\":\"main_balance\"}', '{\"balance\":{\"before\":0,\"after\":500}}', 'success', '2026-03-10 19:28:17', '2026-03-10 19:28:17'),
(5, 'CPCSVA96RS', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_balance\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'pending', '2026-03-10 19:47:47', '2026-03-10 19:47:47'),
(6, 'KHLZ58PYZN', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_wallet\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'pending', '2026-03-10 19:48:42', '2026-03-10 19:48:42'),
(7, '3MW3RWVYYE', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_balance\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'success', '2026-03-10 19:48:44', '2026-03-10 19:48:44'),
(8, 'X9FWK6AMV9', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_wallet\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'success', '2026-03-10 19:48:54', '2026-03-10 19:48:54'),
(9, 'KDBLIKXDFA', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_wallet\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'success', '2026-03-10 19:48:56', '2026-03-10 19:48:56'),
(10, '8ASPFZE1TO', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_wallet\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'rejected', '2026-03-10 19:49:06', '2026-03-10 19:49:06'),
(11, '4L0PRAHCTK', 1, 'Withdrawal', 'debit', 'withdrawal', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_wallet\",\"to\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\"}}', '{\"balance\":{\"before\":10000,\"after\":4000}}', 'rejected', '2026-03-10 19:49:09', '2026-03-10 19:49:09'),
(12, 'GAMQD1K5KU', 1, 'Deposit', 'credit', 'deposit', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\",\"receipt\":null},\"to\":\"main_balance\"}', '{\"balance\":{\"before\":10000,\"after\":16000}}', 'pending', '2026-03-10 19:53:28', '2026-03-10 19:53:28'),
(13, 'KKH2SDWGL8', 1, 'Deposit', 'credit', 'deposit', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\",\"receipt\":null},\"to\":\"main_wallet\"}', '{\"balance\":{\"before\":10000,\"after\":16000}}', 'success', '2026-03-10 19:53:56', '2026-03-10 19:53:56'),
(14, '83NFCY8YR1', 1, 'Deposit', 'credit', 'deposit', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\",\"receipt\":null},\"to\":\"main_wallet\"}', '{\"balance\":{\"before\":10000,\"after\":16000}}', 'success', '2026-03-10 19:53:57', '2026-03-10 19:53:57'),
(15, 'GFFS0YM7I8', 1, 'Deposit', 'credit', 'deposit', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\",\"receipt\":null},\"to\":\"main_wallet\"}', '{\"balance\":{\"before\":10000,\"after\":16000}}', 'rejected', '2026-03-10 19:54:05', '2026-03-10 19:54:05'),
(16, 'Z80XBETV4D', 1, 'Deposit', 'credit', 'deposit', 6000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":{\"account_number\":50005016577,\"bank_name\":\"Standard Chartered Bank\",\"account_name\":\"David James Abakpa\",\"receipt\":null},\"to\":\"main_wallet\"}', '{\"balance\":{\"before\":10000,\"after\":16000}}', 'rejected', '2026-03-10 19:54:08', '2026-03-10 19:54:08'),
(17, 'URT0YUTPGP', 6, 'Admin Gift', 'credit', 'credit_alert', 677, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"admin\",\"to\":\"main_balance\"}', '{\"balance\":{\"before\":13800,\"after\":14477},\"primary_wallet\":\"Main Wallet\"}', 'success', '2026-03-22 19:22:43', '2026-03-22 19:22:43'),
(18, 'FFVUBOU0PY', 6, 'Extra Debit', 'debit', 'debit_alert', 5000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_balance\",\"to\":\"\"}', '{\"balance\":{\"before\":9477,\"after\":14477},\"primary_wallet\":\"Main Wallet\"}', 'success', '2026-03-22 19:35:10', '2026-03-22 19:35:10'),
(19, 'HJD5KU7HAL', 6, 'Debit', 'debit', 'debit_alert', 5000, 0, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 256 256\" fill=\"CurrentColor\" height=\"20\" width=\"20\"><path d=\"M208,44H48A28,28,0,0,0,20,72V184a28,28,0,0,0,28,28H208a28,28,0,0,0,28-28V72A28,28,0,0,0,208,44ZM48,68H208a4,4,0,0,1,4,4V88H160a12,12,0,0,0-12,12,20,20,0,0,1-40,0A12,12,0,0,0,96,88H44V72A4,4,0,0,1,48,68ZM208,188H48a4,4,0,0,1-4-4V112H85.66a44,44,0,0,0,84.68,0H212v72A4,4,0,0,1,208,188Z\"></path></svg>', '{\"from\":\"main_balance\",\"to\":\"\"}', '{\"balance\":{\"before\":4477,\"after\":-523},\"primary_wallet\":\"Main Wallet\"}', 'success', '2026-03-22 19:36:43', '2026-03-22 19:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'user',
  `username` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'nigeria',
  `currency` varchar(255) NOT NULL DEFAULT '₦',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `main_balance` float NOT NULL DEFAULT 0,
  `deposit_balance` float NOT NULL DEFAULT 0,
  `withdrawal_balance` float NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json`)),
  `status` varchar(255) DEFAULT 'active',
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uniqid`, `type`, `username`, `photo`, `phone`, `country`, `currency`, `name`, `email`, `main_balance`, `deposit_balance`, `withdrawal_balance`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `json`, `status`, `updated`, `date`) VALUES
(1, 'MUKWRAB1BC', 'user', 'techie5961', '89f1cb3d-c173-4b60-b1da-ced57c534553.jpeg', '09013350351', 'nigeria', '₦', 'David James', 'techie5961@gmail.com', 6000, 0, 0, NULL, '$2y$12$Y0p4dkBiHbq3wGkrHCjutu/YaXi3EKmnY5IRvQ0KWcfVFEQ9/4qFm', NULL, NULL, NULL, NULL, 'active', '2026-03-10 19:17:22', '2026-03-10 19:17:22'),
(4, 'GOAYOT62WJ', 'user', 'blaady05', NULL, '08118768360', 'nigeria', '₦', 'Abakpa David', 'abakpadavid05@gmail.com', 0, 0, 0, NULL, '$2y$12$2K/.pLkCDq85K3kKAJhNiOo.nbJ00.nuPQNKWa5YjjN85r4JK/I1.', NULL, NULL, NULL, NULL, 'active', '2026-03-10 19:18:47', '2026-03-10 19:18:47'),
(5, 'QOTCY3RRMF', 'user', 'emmywise', NULL, '09051159947', 'nigeria', '₦', 'Emmanuel Oche', 'emmanueloche903@gmail.com', 0, 0, 0, NULL, '$2y$12$7d9.oKAmD12R/sXd5RrXe.6x5uMAJJ0PYtBuzvhdcK9F9zopUpGnq', 'dPh9HHnEeUCJLzBllPmvtSxtpaUHq6ijypm0iFgnClGsE8EHZMvxMDira1xl', NULL, NULL, NULL, 'active', '2026-03-10 19:19:24', '2026-03-10 19:19:24'),
(6, 'XVNPPIWW5V', 'user', 'tonia', NULL, '07035074663', 'nigeria', '₦', 'Antonia Daniel', 'tonia10@gmail.com', -523, 0, 0, NULL, '$2y$12$jbA/d4UcsjY0M5fEhJmSK.e9j6VH9WvP2LyYgd3fARdc3akJAxBvW', NULL, NULL, NULL, NULL, 'active', '2026-03-22 19:36:43', '2026-03-10 19:20:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
