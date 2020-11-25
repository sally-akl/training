-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 09:06 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ultimate`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'category1', '2020-11-16 06:02:45', '2020-11-16 06:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `msg`, `from_user`, `booking_id`, `created_at`, `updated_at`) VALUES
(1, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 6, 1, '2020-11-13 12:20:23', NULL),
(2, 'iiiiiiiiiiiiii', 6, 1, '2020-11-24 12:23:15', NULL),
(3, 'kkkkkkkkkkkk', 2, 1, '2020-11-24 13:23:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'city 1', '2020-11-16 07:14:25', '2020-11-16 07:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `from_user` bigint(20) UNSIGNED DEFAULT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `msg`, `send_date`, `from_user`, `request_id`, `created_at`, `updated_at`) VALUES
(1, 'i will see the problem', '2020-11-15 22:00:00', 1, 1, '2020-11-16 16:35:10', '2020-11-16 16:35:10'),
(2, 'hi thereee any problem alse', '2020-11-17 22:00:00', 1, 1, '2020-11-18 10:57:44', '2020-11-18 10:57:44'),
(3, 'is the problem exist', '2020-11-17 22:00:00', 1, 1, '2020-11-18 18:45:04', '2020-11-18 18:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_11_04_174221_countries', 1),
(4, '2020_11_04_192309_roles', 1),
(5, '2020_11_04_192534_add_role_to_users', 1),
(8, '2020_11_14_093517_add_picture_to_user', 2),
(9, '2020_11_14_093810_add_discription_to_user', 2),
(10, '2020_11_14_180803_create_package_table', 3),
(11, '2020_11_14_195405_add_package_type_user_id', 4),
(12, '2020_11_15_095929_add_other_details_to_packages', 5),
(13, '2020_11_15_110411_add_transaction_table', 6),
(14, '2020_11_16_075324_add_category_table', 7),
(15, '2020_11_16_084919_add_category_city_in_users', 8),
(17, '2020_11_16_145252_add_notifications_table', 9),
(18, '2020_11_16_172556_add_requests_table', 10),
(19, '2020_11_16_172749_add_messages_table', 11),
(20, '2020_11_18_072910_add_programme_design', 12),
(21, '2020_11_18_073651_add_type_to_programm_design', 13),
(22, '2020_11_24_115415_add_chat_messages', 14),
(23, '2020_11_24_144102_add_programm_design_calendar', 15),
(24, '2020_11_24_161639_add_programme_desig_to_calendar', 16),
(25, '2020_11_24_183343_add_images_programme_design', 17),
(26, '2020_11_24_214943_add_trainer_withdrow', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_send` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `msg`, `send_date`, `user_id`, `is_send`, `created_at`, `updated_at`) VALUES
(3, 'notifyyyyyyyyyyyyyyyy', NULL, 10, 0, '2020-11-18 10:58:13', '2020-11-18 10:58:13'),
(4, 'hi user there are new notification', NULL, 2, 0, '2020-11-18 18:45:39', '2020-11-18 18:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_duration_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_duration` int(11) NOT NULL,
  `package_price` double(8,2) NOT NULL,
  `package_questionaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `accepted_from_admin` tinyint(1) NOT NULL DEFAULT 0,
  `package_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `package_desc`, `package_duration_type`, `package_duration`, `package_price`, `package_questionaire`, `created_at`, `updated_at`, `package_type`, `user_id`, `accepted_from_admin`, `package_status`) VALUES
(1, 'package 1', 'package 1 111111111111111111111', 'month', 2, 200.00, 'ajdhajhdjas', NULL, '2020-11-18 10:57:11', 'paid', 6, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programme_images`
--

CREATE TABLE `programme_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programme_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programme_images`
--

INSERT INTO `programme_images` (`id`, `image`, `programme_id`, `created_at`, `updated_at`) VALUES
(1, '/img/programme/50342d96a8c99c04a2d40e9ab106e5b3.jpg', 6, '2020-11-24 16:40:33', '2020-11-24 16:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `programm_designs`
--

CREATE TABLE `programm_designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vedio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programm_designs`
--

INSERT INTO `programm_designs` (`id`, `title`, `desc`, `vedio`, `media_type`, `created_at`, `updated_at`, `type`) VALUES
(1, 'excerices 1', 'Look, my liege! The Knights Who Say Ni demand a sacrifice! …Are you suggesting that coconuts migr', NULL, 'image', '2020-11-18 07:11:46', '2020-11-18 07:19:07', 'exercises'),
(2, 'excercise two', 'excerrrrrrrrrrrrrrrrrrrrrrrr', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1piFN_ioMVI\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'vedio', '2020-11-18 10:06:40', '2020-11-24 16:09:37', 'exercises'),
(3, 'excercise3333', 'this is excercise 333', NULL, 'image', '2020-11-18 10:59:02', '2020-11-18 11:39:13', 'exercises'),
(4, 'excercise new edit', 'this is excercies new  this is excercies new this is excercies new this is excercies new this is excercies new this is excercies new this is excercies new', '', 'image', '2020-11-18 18:46:48', '2020-11-19 11:56:31', 'exercises'),
(5, 'daily meals content', 'daily meals content daily meals content daily meals content', NULL, 'image', '2020-11-24 14:41:20', '2020-11-24 14:41:20', 'dietary meals'),
(6, 'food 3', 'food 3 food 3 food 3 food 3 food 3 food 3', '', 'image', '2020-11-24 15:16:11', '2020-11-24 16:59:17', 'food supplements');

-- --------------------------------------------------------

--
-- Table structure for table `programm_design_calendar`
--

CREATE TABLE `programm_design_calendar` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `programme_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programm_design_calendar`
--

INSERT INTO `programm_design_calendar` (`id`, `start`, `end`, `booking_id`, `created_at`, `updated_at`, `programme_id`) VALUES
(1, '2020-11-20 16:26:16', '2020-11-21 16:26:16', 1, NULL, NULL, 1),
(2, '2020-11-23 16:41:37', NULL, 1, NULL, NULL, 5),
(3, '2020-11-26 17:16:22', '2020-11-27 17:16:22', 1, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `msg`, `send_date`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'this is first request', '2020-11-18 20:44:34', 2, 'in progress', NULL, '2020-11-18 18:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'Trainer', NULL, NULL),
(3, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trainer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transfer_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_payable` int(11) NOT NULL,
  `transfer_payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentToken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_num`, `user_id`, `trainer_id`, `package_id`, `transfer_date`, `is_payable`, `transfer_payment_type`, `paymentToken`, `paymentId`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'hjdsjfh', 2, 6, 1, '2020-11-16 12:52:37', 1, 'visa', 'hdfjhsjf', 'flkfgflgk', 200.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `image`, `desc`, `category_id`, `city_id`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$T1HpU833cwqKxqHTr0nXCOvQLMs0w19Z.Vg0I6WZzSEut//qQX7z2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, 'test2', 'test2@yahoo.com', NULL, '$2y$10$Tm6HOS.ZWwnwMhvaf0ioFu5nrqauhWPO3OtiwlzmsePeJ/mqlOMAS', NULL, '2020-11-14 11:19:22', '2020-11-16 12:27:20', 3, NULL, NULL, NULL, NULL),
(6, 'trainer', 'trainer@yahoo.com', NULL, '$2y$10$1eAkbN8dbvOX0NXLDC.4sOYITVQab7cg0/0.5YKZvhZXgTijh5jMm', NULL, '2020-11-14 15:29:32', '2020-11-16 07:14:42', 2, '/img/profile/9048c6aacf6fc03dcc1d6f68ada63484.jpg', 'this is trainer description', 2, 2),
(8, 'subadmin', 'subadmin@admin.com', NULL, '$2y$10$Hg0nPKpQT2/tQDIdSEKleuWyZ6wth6hZbSL1gIFIAnrCpwJCv1n2.', NULL, '2020-11-16 06:23:20', '2020-11-16 06:23:20', 1, NULL, NULL, NULL, NULL),
(9, 'trainer2', 'trainer2@yahoo.com', NULL, '$2y$10$gIrm9vRq/Kwz72jiBCV57OH0ABKuH4e.oWPvYLht72b5m7RY0nOrS', NULL, '2020-11-16 07:16:49', '2020-11-16 07:16:49', 2, '/img/profile/cf60ce1b74487bbb83ee651077e7692f.png', 'this is trainer2', 2, 2),
(10, 'test3', 'test3@yahoo.com', NULL, '$2y$10$7ulntF6hUYbal9zYqtu4XefODM6vJGS/qIyJZxpJEg4DoQGot9N/q', NULL, '2020-11-16 12:38:10', '2020-11-16 12:38:10', 3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `withdrow_record`
--

CREATE TABLE `withdrow_record` (
  `id` int(10) UNSIGNED NOT NULL,
  `withdrw_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdrw_amount` double(8,2) NOT NULL,
  `is_execute` int(11) NOT NULL DEFAULT 0,
  `execute_date` timestamp NULL DEFAULT NULL,
  `trainer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_from_user_foreign` (`from_user`),
  ADD KEY `chat_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_from_user_foreign` (`from_user`),
  ADD KEY `messages_request_id_foreign` (`request_id`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `programme_images`
--
ALTER TABLE `programme_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programme_images_programme_id_foreign` (`programme_id`);

--
-- Indexes for table `programm_designs`
--
ALTER TABLE `programm_designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programm_design_calendar`
--
ALTER TABLE `programm_design_calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programm_design_calendar_booking_id_foreign` (`booking_id`),
  ADD KEY `programm_design_calendar_programme_id_foreign` (`programme_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_trainer_id_foreign` (`trainer_id`),
  ADD KEY `transactions_package_id_foreign` (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `withdrow_record`
--
ALTER TABLE `withdrow_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrow_record_trainer_id_foreign` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programme_images`
--
ALTER TABLE `programme_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programm_designs`
--
ALTER TABLE `programm_designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programm_design_calendar`
--
ALTER TABLE `programm_design_calendar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `withdrow_record`
--
ALTER TABLE `withdrow_record`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programme_images`
--
ALTER TABLE `programme_images`
  ADD CONSTRAINT `programme_images_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programm_designs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programm_design_calendar`
--
ALTER TABLE `programm_design_calendar`
  ADD CONSTRAINT `programm_design_calendar_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `programm_design_calendar_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programm_designs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrow_record`
--
ALTER TABLE `withdrow_record`
  ADD CONSTRAINT `withdrow_record_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
