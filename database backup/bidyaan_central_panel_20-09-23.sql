-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2023 at 04:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidyaan_central_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `custom_invoice_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `invoice_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'income,invoice',
  `month` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `total_student` int NOT NULL,
  `gross_amount` double(10,2) NOT NULL,
  `net_amount` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `paid_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Unpaid',
  `date` text NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `modified_by` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `custom_invoice_id`, `invoice_type`, `month`, `total_student`, `gross_amount`, `net_amount`, `discount`, `paid_status`, `date`, `note`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(1, 'INV-000001', 'invoice', '09', 539, 5390.00, 5390.00, 0.00, 'unpaid', '09-2023', '', 1, '2023-09-19 07:40:47', '2023-09-19 07:40:47', 1, 1),
(2, 'INV-000002', 'invoice', '09', 539, 5390.00, 5390.00, 0.00, 'unpaid', '09-2023', '', 1, '2023-09-19 11:22:45', '2023-09-19 11:22:45', 1, 1),
(3, 'INV-000003', 'invoice', '09', 539, 5390.00, 5390.00, 0.00, 'unpaid', '09-2023', '', 1, '2023-09-19 11:43:46', '2023-09-19 11:43:46', 1, 1),
(4, 'INV-000004', 'invoice', '09', 539, 5390.00, 5390.00, 0.00, 'unpaid', '09-2023', '', 1, '2023-09-19 11:31:47', '2023-09-19 11:31:47', 1, 1),
(5, 'INV-000005', 'invoice', '09', 539, 5390.00, 5390.00, 0.00, 'unpaid', '09-2023', '', 1, '2023-09-20 09:16:34', '2023-09-20 09:16:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `school_id` int NOT NULL,
  `month` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `student` int DEFAULT NULL,
  `gross_amount` float NOT NULL,
  `discount` float NOT NULL,
  `net_amount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `modified_by` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `invoice_id`, `school_id`, `month`, `student`, `gross_amount`, `discount`, `net_amount`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(1, 4, 1, '09-2023', 198, 1980, 0, 1980, 1, '2023-09-19 11:31:47', '2023-09-19 11:31:47', 1, 1),
(2, 4, 2, '09-2023', 341, 3410, 0, 3410, 1, '2023-09-19 11:31:47', '2023-09-19 11:31:47', 1, 1),
(3, 5, 1, '09-2023', 198, 1980, 0, 1980, 1, '2023-09-20 09:17:34', '2023-09-20 09:17:34', 1, 1),
(4, 5, 2, '09-2023', 341, 3410, 0, 3410, 1, '2023-09-20 09:17:34', '2023-09-20 09:17:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_03_0906587211_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_active_students`
--

CREATE TABLE `monthly_active_students` (
  `id` int NOT NULL,
  `school_id` int NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `total` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `modified_by` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `monthly_active_students`
--

INSERT INTO `monthly_active_students` (`id`, `school_id`, `month`, `year`, `total`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(29, 1, '01', '2023', 191, 1, '2023-09-04 13:58:50', '2023-09-04 13:58:50', 11, 11),
(30, 2, '01', '2023', 120, 1, '2023-09-04 13:58:50', '2023-09-04 13:58:50', 11, 11),
(31, 1, '02', '2023', 193, 1, '2023-09-04 13:58:50', '2023-09-04 13:58:50', 11, 11),
(32, 2, '02', '2023', 100, 1, '2023-09-04 13:58:50', '2023-09-04 13:58:50', 11, 11),
(33, 1, '09', '2023', 198, 1, NULL, NULL, NULL, NULL),
(34, 2, '09', '2023', 341, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'web', 'dashboard', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(2, 'dashboard.edit', 'web', 'dashboard', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(3, 'user.create', 'web', 'user', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(4, 'user.view', 'web', 'user', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(5, 'user.edit', 'web', 'user', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(6, 'user.delete', 'web', 'user', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(7, 'user.approve', 'web', 'user', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(8, 'role.create', 'web', 'role', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(9, 'role.view', 'web', 'role', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(10, 'role.edit', 'web', 'role', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(11, 'role.delete', 'web', 'role', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(12, 'role.approve', 'web', 'role', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(13, 'permission.create', 'web', 'permission', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(14, 'permission.view', 'web', 'permission', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(15, 'permission.edit', 'web', 'permission', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(16, 'permission.delete', 'web', 'permission', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(17, 'permission.approve', 'web', 'permission', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(18, 'package.create', 'web', 'package', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(19, 'package.view', 'web', 'package', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(20, 'package.edit', 'web', 'package', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(21, 'customer.create', 'web', 'customer', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(22, 'customer.view', 'web', 'customer', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(23, 'customer.edit', 'web', 'customer', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(24, 'bill.create', 'web', 'bill', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(25, 'bill.view', 'web', 'bill', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(26, 'bill.edit', 'web', 'bill', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(27, 'expense.create', 'web', 'expense', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(28, 'expense.view', 'web', 'expense', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(29, 'expense.edit', 'web', 'expense', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(30, 'account.create', 'web', 'account', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(31, 'account.view', 'web', 'account', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(32, 'account.edit', 'web', 'account', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(33, 'transaction.create', 'web', 'transaction', '2023-09-04 01:57:22', '2023-09-04 01:57:22'),
(34, 'transaction.view', 'web', 'transaction', '2023-09-04 01:57:23', '2023-09-04 01:57:23'),
(35, 'transaction.edit', 'web', 'transaction', '2023-09-04 01:57:23', '2023-09-04 01:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(2, 'admin', 'web', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(3, 'client', 'web', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(4, 'editor', 'web', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(5, 'user', 'web', '2023-09-04 01:57:21', '2023-09-04 01:57:21'),
(6, 'kha', 'web', '2023-09-14 04:13:23', '2023-09-14 04:13:23'),
(7, 'khaa', 'web', '2023-09-14 04:15:13', '2023-09-14 04:15:13'),
(8, 'fgfgf', 'web', '2023-09-14 05:17:08', '2023-09-14 05:17:08'),
(9, 'Masud', 'web', '2023-09-14 05:35:04', '2023-09-14 05:35:04'),
(10, 'numan', 'web', '2023-09-14 06:03:24', '2023-09-14 06:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
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
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

CREATE TABLE `school_info` (
  `id` int NOT NULL,
  `school_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `database_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_info`
--

INSERT INTO `school_info` (`id`, `school_name`, `domain_name`, `database_name`, `status`, `created_at`) VALUES
(1, 'BIDYAAN SCHOOL', 'http://v2.bidyaan.com', 'school_1', 1, '2023-09-04 00:00:00'),
(2, 'Gopalgonj Adventist Pre-Seminary', 'https://gaps.bidyaan.com', 'school_2', 1, '1900-01-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$v2pTH44td0hmadjJZc1Rz.9ZD5Yr5aOQVi4VzcT8xMuLSa6v3OwNq', NULL, '2023-09-04 01:57:23', '2023-09-04 01:57:23');

--
-- Indexes for dumped tables
--

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
  ADD KEY `id` (`id`),
  ADD KEY `custom_invoice_id` (`custom_invoice_id`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `invoice_id` (`invoice_id`);

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
-- Indexes for table `monthly_active_students`
--
ALTER TABLE `monthly_active_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `school_info`
--
ALTER TABLE `school_info`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `monthly_active_students`
--
ALTER TABLE `monthly_active_students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_info`
--
ALTER TABLE `school_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
