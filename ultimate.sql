-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 07:52 PM
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`, `image`) VALUES
(2, 'category1', '2020-11-16 06:02:45', '2021-01-10 18:50:06', '/img/profile/91ad9157c0fe3c3649911363cab4a493.png'),
(5, 'category3', '2021-01-10 18:47:32', '2021-01-10 18:47:32', '/img/profile/791a476858063523d6968e7cb2255e08.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user` int(11) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `to_user` int(11) NOT NULL,
  `msg_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `msg`, `from_user`, `booking_id`, `created_at`, `updated_at`, `to_user`, `msg_type`) VALUES
(1, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 6, 1, '2020-11-13 12:20:23', NULL, 2, 'text'),
(2, 'iiiiiiiiiiiiii', 6, 1, '2020-11-24 12:23:15', NULL, 2, 'text'),
(3, 'kkkkkkkkkkkk', 2, 1, '2020-11-24 13:23:22', NULL, 6, 'text'),
(11, 'kkkkkkkllllllllllll', 2, 1, '2020-12-09 18:23:16', '2020-12-09 18:23:16', 6, 'text'),
(12, 'oooooooooo', 6, 1, '2020-12-09 18:23:26', '2020-12-09 18:23:26', 2, 'text'),
(13, 'ollllllllllll', 2, 1, '2020-12-09 18:23:43', '2020-12-09 18:23:43', 6, 'text'),
(14, 'okkkkjjjj', 6, 1, '2020-12-09 18:26:43', '2020-12-09 18:26:43', 2, 'text'),
(15, 'lllllllllllllljjjjjjjjjjjjj', 2, 1, '2020-12-09 18:26:51', '2020-12-09 18:26:51', 6, 'text'),
(16, 'jjjjjjjjjjkkkkkkkkkkk', 6, 1, '2020-12-09 18:28:42', '2020-12-09 18:28:42', 2, 'text'),
(19, 'hi theree', 6, 1, '2021-01-24 13:51:18', '2021-01-24 13:51:18', 2, 'text'),
(20, 'hi allow', 2, 1, '2021-01-24 13:55:09', '2021-01-24 13:55:09', 6, 'text'),
(21, 'hiiii', 2, 1, '2021-01-24 13:57:31', '2021-01-24 13:57:31', 6, 'text'),
(22, 'test', 2, 1, '2021-01-24 14:00:19', '2021-01-24 14:00:19', 6, 'text'),
(23, 'test test', 2, 1, '2021-01-24 14:01:46', '2021-01-24 14:01:46', 6, 'text'),
(24, 'ttt ttt', 2, 1, '2021-01-24 14:19:44', '2021-01-24 14:19:44', 6, 'text'),
(25, 'xxx rrr', 2, 1, '2021-01-24 14:20:43', '2021-01-24 14:20:43', 6, 'text'),
(26, 'okkkk', 6, 1, '2021-01-24 14:20:54', '2021-01-24 14:20:54', 2, 'text'),
(27, 'okk', 2, 1, '2021-01-24 14:34:02', '2021-01-24 14:34:02', 6, 'text'),
(41, '/img/profile/2279579bfe2220d345be09476d5414c6.jpeg', 2, 1, '2021-01-30 12:45:06', '2021-01-30 12:45:06', 6, 'image'),
(42, '/img/profile/cc6fecc168620d9663b47ff7395de794.png', 6, 1, '2021-01-30 12:50:51', '2021-01-30 12:50:51', 2, 'image'),
(43, 'xxx', 2, 1, '2021-01-30 12:56:32', '2021-01-30 12:56:32', 6, 'text'),
(44, 'test', 6, 1, '2021-01-31 06:37:05', '2021-01-31 06:37:05', 2, 'text'),
(45, 'okkk', 2, 1, '2021-01-31 06:37:35', '2021-01-31 06:37:35', 6, 'text'),
(46, 'okkkk', 2, 1, '2021-01-31 06:37:55', '2021-01-31 06:37:55', 6, 'text'),
(51, '/img/profile/042b5c6cace31921c9fda802db36cc36.gif', 2, 1, '2021-02-02 15:41:45', '2021-02-02 15:41:45', 6, 'image'),
(52, 'kiiiiiiiiiiiiiii', 2, 1, '2021-02-02 15:46:16', '2021-02-02 15:46:16', 6, 'text'),
(53, 'xxxxxxxxxx', 2, 1, '2021-02-02 15:57:43', '2021-02-02 15:57:43', 6, 'text'),
(54, 'ttttttt', 2, 1, '2021-02-02 15:58:52', '2021-02-02 15:58:52', 6, 'text'),
(55, '/img/profile/00cd1337679899d95cdd820babc29c8f.gif', 2, 1, '2021-02-02 15:59:01', '2021-02-02 15:59:01', 6, 'image'),
(56, '/img/profile/c13cd6cb23844e68463347461843dfa9.gif', 6, 1, '2021-02-02 16:05:51', '2021-02-02 16:05:51', 2, 'image'),
(57, 'kkkkkkkkkkk,,,,', 6, 1, '2021-02-02 16:06:02', '2021-02-02 16:06:02', 2, 'text'),
(58, '/img/profile/46fb4b7626eadfff45929ee06d03e34a.jpg', 6, 1, '2021-02-02 16:06:59', '2021-02-02 16:06:59', 2, 'image'),
(59, 'lllllllllll', 6, 1, '2021-02-02 16:07:10', '2021-02-02 16:07:10', 2, 'text'),
(60, '/img/profile/5c2998d8055e75e43c339af8abb3e5a1.jpeg', 2, 1, '2021-02-03 11:56:52', '2021-02-03 11:56:52', 6, 'image'),
(61, 'vvvv', 6, 1, '2021-03-08 19:15:55', '2021-03-08 19:15:55', 2, 'text'),
(62, 'jjjj', 6, 1, '2021-03-08 19:32:35', '2021-03-08 19:32:35', 2, 'text'),
(63, '/img/profile/6cbd0f1e0104a8c35aa65239ecce9628.png', 6, 1, '2021-03-08 19:32:47', '2021-03-08 19:32:47', 2, 'image');

-- --------------------------------------------------------

--
-- Table structure for table `complete_excercises`
--

CREATE TABLE `complete_excercises` (
  `id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `day_num` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complete_excercises`
--

INSERT INTO `complete_excercises` (`id`, `programme_id`, `day_num`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 2, '2021-02-03 15:20:36', '2021-02-03 15:20:36'),
(5, 13, 2, 2, '2021-02-03 15:20:46', '2021-02-03 15:20:46');

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
  `from_user` int(11) UNSIGNED DEFAULT NULL,
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
(3, 'is the problem exist', '2020-11-17 22:00:00', 1, 1, '2020-11-18 18:45:04', '2020-11-18 18:45:04'),
(4, 'ok , bro', '2021-01-18 22:00:00', 2, 1, '2021-01-19 14:55:58', '2021-01-19 14:55:58'),
(5, 'ok', '2021-01-18 22:00:00', 2, 1, '2021-01-19 15:05:27', '2021-01-19 15:05:27'),
(6, 'hiiii theree i have problem', '2021-01-30 22:00:00', 2, 3, '2021-01-31 14:03:31', '2021-01-31 14:03:31'),
(7, 'okkkk', '2021-01-30 22:00:00', 1, 3, '2021-01-31 14:03:45', '2021-01-31 14:03:45'),
(8, 'hi', '2021-01-30 22:00:00', 1, 4, '2021-01-31 15:00:04', '2021-01-31 15:00:04'),
(9, 'i have problem', '2021-01-30 22:00:00', 2, 4, '2021-01-31 15:00:23', '2021-01-31 15:00:23');

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
-- Table structure for table `muscles`
--

CREATE TABLE `muscles` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `title_ar` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `muscles`
--

INSERT INTO `muscles` (`id`, `title`, `title_ar`, `created_at`, `updated_at`, `type`) VALUES
(3, 'Chest', 'Chest', '2021-03-01 10:37:35', '2021-03-01 10:37:35', 'muscles'),
(5, 'Cardio', 'Cardio', '2021-03-01 10:39:38', '2021-03-01 10:39:38', 'exercisetype'),
(6, 'Bands', 'Bands', '2021-03-01 10:40:24', '2021-03-01 10:40:24', 'equipment'),
(7, 'Compound', 'Compound', '2021-03-01 10:40:42', '2021-03-01 10:40:42', 'mechanicstype'),
(8, 'Beginner', 'Beginner', '2021-03-01 10:40:57', '2021-03-01 10:40:57', 'level');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` timestamp NULL DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `is_send` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `send_from` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `msg`, `send_date`, `user_id`, `is_send`, `created_at`, `updated_at`, `send_from`) VALUES
(3, 'notifyyyyyyyyyyyyyyyy', '2021-01-27 22:00:00', 10, 1, '2020-11-18 10:58:13', '2021-01-27 22:03:35', NULL),
(4, 'hi user there are new notification', '2021-01-27 22:00:00', 2, 1, '2020-11-18 18:45:39', '2021-01-27 22:04:23', NULL),
(14, 'test', '2021-01-30 22:00:00', 2, 1, '2021-01-31 06:37:05', '2021-01-31 06:37:05', 6),
(15, 'okkk', '2021-01-30 22:00:00', 6, 1, '2021-01-31 06:37:35', '2021-01-31 06:37:35', 2),
(16, 'okkkk', '2021-01-30 22:00:00', 6, 1, '2021-01-31 06:37:56', '2021-01-31 06:37:56', 2),
(17, 'hi', '2021-01-30 22:00:00', 6, 1, '2021-01-31 13:44:05', '2021-01-31 13:44:05', 2),
(18, 'welcome', '2021-01-30 22:00:00', 2, 1, '2021-01-31 13:44:21', '2021-01-31 13:44:21', 6),
(19, '/img/profile/caaa0bfb203f5fe0b37a62181e41abba.png', '2021-01-30 22:00:00', 6, 1, '2021-01-31 13:44:54', '2021-01-31 13:44:54', 2),
(20, '/img/profile/a4b63372963ac2af8a70bf9001541454.png', '2021-01-30 22:00:00', 2, 1, '2021-01-31 13:45:16', '2021-01-31 13:45:16', 6),
(21, '/img/profile/042b5c6cace31921c9fda802db36cc36.gif', '2021-02-01 22:00:00', 6, 1, '2021-02-02 15:41:45', '2021-02-02 15:41:45', 2),
(22, 'kiiiiiiiiiiiiiii', '2021-02-01 22:00:00', 6, 1, '2021-02-02 15:46:16', '2021-02-02 15:46:16', 2),
(23, 'xxxxxxxxxx', '2021-02-01 22:00:00', 6, 1, '2021-02-02 15:57:43', '2021-02-02 15:57:43', 2),
(24, 'ttttttt', '2021-02-01 22:00:00', 6, 1, '2021-02-02 15:58:52', '2021-02-02 15:58:52', 2),
(25, '/img/profile/00cd1337679899d95cdd820babc29c8f.gif', '2021-02-01 22:00:00', 6, 1, '2021-02-02 15:59:01', '2021-02-02 15:59:01', 2),
(26, '/img/profile/c13cd6cb23844e68463347461843dfa9.gif', '2021-02-01 22:00:00', 2, 1, '2021-02-02 16:05:51', '2021-02-02 16:05:51', 6),
(27, 'kkkkkkkkkkk,,,,', '2021-02-01 22:00:00', 2, 1, '2021-02-02 16:06:02', '2021-02-02 16:06:02', 6),
(28, '/img/profile/46fb4b7626eadfff45929ee06d03e34a.jpg', '2021-02-01 22:00:00', 2, 1, '2021-02-02 16:06:59', '2021-02-02 16:06:59', 6),
(29, 'lllllllllll', '2021-02-01 22:00:00', 2, 1, '2021-02-02 16:07:10', '2021-02-02 16:07:10', 6),
(30, '/img/profile/5c2998d8055e75e43c339af8abb3e5a1.jpeg', '2021-02-02 22:00:00', 6, 1, '2021-02-03 11:56:52', '2021-02-03 11:56:52', 2),
(31, 'vvvv', '2021-03-07 22:00:00', 2, 1, '2021-03-08 19:15:55', '2021-03-08 19:15:55', 6),
(32, 'jjjj', '2021-03-07 22:00:00', 2, 1, '2021-03-08 19:32:35', '2021-03-08 19:32:35', 6),
(33, '/img/profile/6cbd0f1e0104a8c35aa65239ecce9628.png', '2021-03-07 22:00:00', 2, 1, '2021-03-08 19:32:47', '2021-03-08 19:32:47', 6);

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
  `package_price` double(8,2) DEFAULT NULL,
  `package_questionaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `accepted_from_admin` tinyint(1) NOT NULL DEFAULT 0,
  `package_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_desc_ar` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `package_desc`, `package_duration_type`, `package_duration`, `package_price`, `package_questionaire`, `created_at`, `updated_at`, `package_type`, `user_id`, `accepted_from_admin`, `package_status`, `package_name_ar`, `package_desc_ar`) VALUES
(1, 'package 1', 'package 1 111111111111111111111', 'week', 2, 200.00, 'ajdhajhdjas', NULL, '2021-01-11 17:08:21', 'paid', 6, 1, 'active', 'باك 1444', 'باكككككككككككك لالالالا'),
(5, 'package2222222', 'ggggggggggggggggg', 'week', 4, 100.00, 'ssssssssssssssssss', '2021-01-11 16:41:22', '2021-01-11 16:44:19', 'free', 6, 0, 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `package_user_plan`
--

CREATE TABLE `package_user_plan` (
  `day_num` int(11) NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `programme_design_id` int(10) UNSIGNED DEFAULT NULL,
  `recepe_id` int(10) UNSIGNED DEFAULT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `set_num` varchar(150) DEFAULT NULL,
  `suplement_serving_size` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_user_plan`
--

INSERT INTO `package_user_plan` (`day_num`, `package_id`, `user_id`, `programme_design_id`, `recepe_id`, `section_id`, `created_at`, `updated_at`, `transaction_id`, `id`, `set_num`, `suplement_serving_size`) VALUES
(8, 1, 2, 4, NULL, NULL, '2020-12-21 17:19:53', '2020-12-21 17:19:53', 1, 12, NULL, ''),
(1, 1, 2, 1, NULL, NULL, '2021-01-24 17:05:00', '2020-12-28 07:06:21', 1, 34, '3 sets x 12', ''),
(1, 1, 2, 2, NULL, NULL, '2021-01-24 17:11:31', '2020-12-28 10:40:32', 1, 35, '3 sets x 15', ''),
(1, 1, 2, 6, NULL, NULL, '2020-12-28 10:51:08', '2020-12-28 10:51:08', 1, 37, NULL, '6'),
(8, 1, 2, 1, NULL, NULL, '2021-01-04 20:15:57', '2021-01-04 20:15:57', 1, 41, NULL, NULL),
(8, 1, 2, 2, NULL, NULL, '2021-01-04 20:15:57', '2021-01-04 20:15:57', 1, 42, NULL, NULL),
(8, 1, 2, 6, NULL, NULL, '2021-01-04 20:15:57', '2021-01-04 20:15:57', 1, 43, NULL, NULL),
(8, 1, 2, 11, NULL, NULL, '2021-01-04 20:15:57', '2021-01-04 20:15:57', 1, 44, NULL, NULL),
(1, 1, 10, 1, NULL, NULL, '2021-01-04 20:17:09', '2021-01-04 20:17:09', 2, 45, NULL, NULL),
(1, 1, 10, 2, NULL, NULL, '2021-01-04 20:17:09', '2021-01-04 20:17:09', 2, 46, NULL, NULL),
(1, 1, 10, 6, NULL, NULL, '2021-01-04 20:17:09', '2021-01-04 20:17:09', 2, 47, NULL, NULL),
(1, 1, 10, 11, NULL, NULL, '2021-01-04 20:17:09', '2021-01-04 20:17:09', 2, 48, NULL, NULL),
(2, 1, 10, 1, NULL, NULL, '2021-01-04 20:33:58', '2021-01-04 20:33:58', 2, 49, NULL, NULL),
(2, 1, 10, 2, NULL, NULL, '2021-01-04 20:33:58', '2021-01-04 20:33:58', 2, 50, NULL, NULL),
(2, 1, 10, 6, NULL, NULL, '2021-01-04 20:33:58', '2021-01-04 20:33:58', 2, 51, NULL, NULL),
(2, 1, 10, 11, NULL, NULL, '2021-01-04 20:33:58', '2021-01-04 20:33:58', 2, 52, NULL, NULL),
(9, 1, 10, 1, NULL, NULL, '2021-01-04 20:34:43', '2021-01-04 20:34:43', 2, 53, NULL, NULL),
(9, 1, 10, 2, NULL, NULL, '2021-01-04 20:34:43', '2021-01-04 20:34:43', 2, 54, NULL, NULL),
(9, 1, 10, 6, NULL, NULL, '2021-01-04 20:34:43', '2021-01-04 20:34:43', 2, 55, NULL, NULL),
(9, 1, 10, 11, NULL, NULL, '2021-01-04 20:34:43', '2021-01-04 20:34:43', 2, 56, NULL, NULL),
(14, 1, 2, 1, NULL, NULL, '2021-01-11 18:22:51', '2021-01-11 18:22:51', 1, 60, NULL, NULL),
(14, 1, 2, 2, NULL, NULL, '2021-01-11 18:22:51', '2021-01-11 18:22:51', 1, 61, NULL, NULL),
(14, 1, 2, 6, NULL, NULL, '2021-01-11 18:22:51', '2021-01-11 18:22:51', 1, 62, NULL, NULL),
(14, 1, 2, 11, NULL, NULL, '2021-01-11 18:22:51', '2021-01-11 18:22:51', 1, 63, NULL, NULL),
(1, 1, 2, 13, NULL, NULL, '2021-01-24 15:09:52', '2021-01-24 15:09:52', 1, 65, '3 sets x 12', NULL),
(1, 1, 2, NULL, 2, NULL, '2021-01-24 16:32:37', '2021-01-24 16:32:37', 1, 66, NULL, NULL),
(2, 1, 2, 13, NULL, NULL, '2021-01-24 19:00:57', '2021-01-24 19:00:57', 1, 67, '2', NULL),
(1, 1, 2, 2, NULL, NULL, '2021-01-30 10:07:54', '2021-01-30 10:07:54', 6, 68, '5', NULL),
(1, 1, 2, 1, NULL, NULL, '2021-01-31 13:46:21', '2021-01-31 13:46:21', 10, 69, '3 sets x 12', NULL),
(1, 1, 2, NULL, 2, NULL, '2021-01-31 13:46:55', '2021-01-31 13:46:55', 10, 70, NULL, NULL),
(1, 1, 2, 6, NULL, NULL, '2021-01-31 13:47:29', '2021-01-31 13:47:29', 10, 71, NULL, NULL),
(1, 1, 2, 2, NULL, NULL, '2021-01-31 13:48:04', '2021-01-31 13:48:04', 10, 72, NULL, NULL),
(2, 1, 2, 6, NULL, NULL, '2021-03-08 13:55:52', '2021-03-08 13:55:52', 1, 84, NULL, NULL),
(2, 1, 2, 1, NULL, NULL, '2021-03-08 14:08:17', '2021-03-08 14:08:17', 1, 85, NULL, NULL),
(2, 1, 2, 2, NULL, NULL, '2021-03-08 14:08:17', '2021-03-08 14:08:17', 1, 86, NULL, NULL),
(2, 1, 2, 13, NULL, NULL, '2021-03-08 14:08:17', '2021-03-08 14:08:17', 1, 87, NULL, NULL),
(1, 1, 6, 3, NULL, NULL, '2021-03-08 15:59:10', '2021-03-08 15:59:10', 1, 91, NULL, NULL),
(1, 1, 6, 4, NULL, NULL, '2021-03-08 15:59:10', '2021-03-08 15:59:10', 1, 92, NULL, NULL);

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
-- Table structure for table `programe_design_integrent`
--

CREATE TABLE `programe_design_integrent` (
  `id` int(11) UNSIGNED NOT NULL,
  `programme_id` int(11) UNSIGNED NOT NULL,
  `serving_size` varchar(250) NOT NULL,
  `calories` float NOT NULL,
  `carbs` float NOT NULL,
  `protein` float NOT NULL,
  `fat` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programe_design_integrent`
--

INSERT INTO `programe_design_integrent` (`id`, `programme_id`, `serving_size`, `calories`, `carbs`, `protein`, `fat`, `created_at`, `updated_at`) VALUES
(8, 5, '1', 500, 500, 500, 500, '2020-12-06 19:39:31', '2020-12-06 19:39:31'),
(9, 16, '2', 200, 200, 200, 200, '2020-12-07 17:33:07', '2020-12-07 17:33:07'),
(10, 16, '3', 300, 300, 300, 300, '2020-12-07 17:33:07', '2020-12-07 17:33:07'),
(11, 16, '4', 400, 400, 400, 400, '2020-12-07 17:33:07', '2020-12-07 17:33:07');

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
(1, '/img/programme/50342d96a8c99c04a2d40e9ab106e5b3.jpg', 6, '2020-11-24 16:40:33', '2020-11-24 16:40:33'),
(9, '/img/programme/a83f72adc5906dcd5f67da308be2dbae.jpg', 11, '2020-12-05 06:10:21', '2020-12-05 06:10:21'),
(10, '/img/programme/6a6985356d936742c56cb94eeb0608c6.jpg', 11, '2020-12-05 06:10:21', '2020-12-05 06:10:21'),
(11, '/img/programme/0de3ea07f4b835cce46c9a345bfd1406.jpg', 11, '2020-12-05 06:10:21', '2020-12-05 06:10:21'),
(12, '/img/programme/2849ea704328db2223e31d6df17538b3.jpg', 13, '2020-12-05 06:32:03', '2020-12-05 06:32:03'),
(14, '/img/programme/5fd11a44647259daa1c65abfeaf339f4.jpg', 13, '2020-12-05 09:34:27', '2020-12-05 09:34:27'),
(16, '/img/programme/031d90cfd0685209bb12ed1462eddb7c.png', 1, '2021-01-24 15:00:50', '2021-01-24 15:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `programm_designs`
--

CREATE TABLE `programm_designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vedio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_sets` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serving_size` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_of_reps` int(11) DEFAULT NULL,
  `muscles` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exercise_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mechanics_type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programm_designs`
--

INSERT INTO `programm_designs` (`id`, `title`, `desc`, `vedio`, `media_type`, `created_at`, `updated_at`, `type`, `number_of_sets`, `serving_size`, `title_ar`, `desc_ar`, `num_of_reps`, `muscles`, `exercise_type`, `equipment`, `mechanics_type`, `level`) VALUES
(1, 'excerices 1', 'Look, my liege! The Knights Who Say Ni demand a sacrifice! …Are you suggesting that coconuts migr', NULL, 'image', '2020-11-18 07:11:46', '2021-01-24 15:00:50', 'exercises', '3 sets x 12', NULL, 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'excercise two', 'excerrrrrrrrrrrrrrrrrrrrrrrr', 'https://www.youtube.com/embed/oc4QS2USKmk', 'vedio', '2020-11-18 10:06:40', '2020-11-24 16:09:37', 'exercises', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'excercise3333', 'this is excercise 333', NULL, 'image', '2020-11-18 10:59:02', '2020-11-18 11:39:13', 'exercises', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'excercise new edit', 'this is excercies new  this is excercies new this is excercies new this is excercies new this is excercies new this is excercies new this is excercies new', '', 'image', '2020-11-18 18:46:48', '2020-11-19 11:56:31', 'exercises', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'daily meals content', 'daily meals content daily meals content daily meals content', NULL, 'image', '2020-11-24 14:41:20', '2020-12-06 19:39:31', 'dietary meals', NULL, NULL, 'llllllllllllllllllll', 'kkkkkkkkkkkkkkkkkkkkkkkkkkk', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'food 3', 'food 3 food 3 food 3 food 3 food 3 food 3', '', 'image', '2020-11-24 15:16:11', '2020-11-24 16:59:17', 'food supplements', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'test images', 'test test', NULL, 'image', '2020-12-05 06:10:21', '2020-12-05 06:10:21', 'exercises', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'test vedio', 'kkkkkkkkkkkkkkkkllllllllllllllllllll', 'https://www.youtube.com/embed/oc4QS2USKmk', 'vedio', '2020-12-05 06:14:56', '2020-12-05 09:39:49', 'exercises', '3', NULL, 'iiiiiiiiiiiiiiiiiiii', 'vvvvvvvvvvvvvvvv', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'test excercise', 'nnnnnnnnnnnnnnnn', NULL, 'image', '2020-12-05 06:32:03', '2020-12-05 09:34:27', 'exercises', '2', NULL, 'oooooooooooooo', 'pppppppppppppp', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'test supplement', 'lllllllllllllllllllll', NULL, NULL, '2020-12-05 06:35:12', '2020-12-05 09:31:28', 'food supplements', NULL, '3', 'kkkkkkkkkkkkkk', 'ppppppppppp', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'chicken', 'ccccccccccccccc', NULL, NULL, '2020-12-05 08:13:36', '2020-12-07 17:33:07', 'dietary meals', NULL, NULL, 'cccccccccccccccc', 'ttttttttttttttttttttttt', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'test tessss', 'wkdlwkldkwdlkwd', 'https://www.youtube.com/embed/oc4QS2USKmk', 'vedio', '2021-01-30 09:24:49', '2021-03-01 09:28:03', 'exercises', '3', NULL, 'tes', 'fgl;rkgkrkglrkg', 2, NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `questionaire`
--

CREATE TABLE `questionaire` (
  `id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `answer` varchar(750) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionaire`
--

INSERT INTO `questionaire` (`id`, `message`, `answer`, `user_id`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 'my first question', '', 2, 1, '2021-03-01 17:42:42', '2021-03-01 15:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `title_ar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `created_at`, `updated_at`, `title_ar`) VALUES
(1, 'weight', '2021-03-09 06:33:04', '2021-03-09 06:33:04', 'الوزن'),
(2, 'height', '2021-03-09 06:33:20', '2021-03-09 06:33:20', 'الطول');

-- --------------------------------------------------------

--
-- Table structure for table `questions_answers`
--

CREATE TABLE `questions_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions_answers`
--

INSERT INTO `questions_answers` (`id`, `question_id`, `answer`, `created_at`, `updated_at`, `transaction_id`) VALUES
(3, 1, '100', '2021-03-09 18:31:52', '2021-03-09 18:31:52', 16),
(4, 2, '160', '2021-03-09 18:31:52', '2021-03-09 18:31:52', 16);

-- --------------------------------------------------------

--
-- Table structure for table `ready_plan`
--

CREATE TABLE `ready_plan` (
  `id` int(11) NOT NULL,
  `day_num` int(11) NOT NULL,
  `programme_design_id` int(10) UNSIGNED NOT NULL,
  `recepe_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `set_num` varchar(150) DEFAULT NULL,
  `suplement_serving_size` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ready_plan`
--

INSERT INTO `ready_plan` (`id`, `day_num`, `programme_design_id`, `recepe_id`, `created_at`, `updated_at`, `set_num`, `suplement_serving_size`) VALUES
(3, 1, 1, 0, '2021-03-10 16:30:10', '2021-03-10 16:30:10', '3 sets x 12', NULL),
(4, 1, 2, 0, '2021-03-10 16:30:10', '2021-03-10 16:30:10', '20', NULL),
(5, 2, 1, 0, '2021-03-10 16:30:29', '2021-03-10 16:30:29', '3 sets x 12', NULL),
(6, 1, 6, 0, '2021-03-10 16:30:50', '2021-03-10 16:30:50', NULL, '3'),
(7, 7, 0, 2, '2021-03-10 16:31:11', '2021-03-10 16:31:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receips`
--

CREATE TABLE `receips` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `desciption` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receips`
--

INSERT INTO `receips` (`id`, `name`, `desciption`, `image`, `created_at`, `updated_at`) VALUES
(2, 'recep one', 'recep one recep one  recep one recep one v', '/img/programme/b35e74f0f2ca5212cfabf1b806bd5961.jpg', '2020-12-06 22:27:05', '2020-12-06 20:27:05'),
(3, 'recep2', 'ccccccccccccccbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '/img/programme/3097cc8d54d8745b7ea2590678e6794a.jpg', '2020-12-21 14:50:22', '2020-12-21 14:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `receips_integration`
--

CREATE TABLE `receips_integration` (
  `recep_id` int(11) UNSIGNED NOT NULL,
  `integrate_programme_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `serving` int(11) NOT NULL,
  `programme_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receips_integration`
--

INSERT INTO `receips_integration` (`recep_id`, `integrate_programme_id`, `created_at`, `updated_at`, `serving`, `programme_id`) VALUES
(2, 8, '2020-12-06 20:27:05', '2020-12-06 20:27:05', 2, 5),
(3, 8, '2020-12-21 14:51:20', '2020-12-21 14:51:20', 4, 5),
(3, 11, '2020-12-21 14:51:20', '2020-12-21 14:51:20', 5, 16),
(2, 8, '2020-12-06 20:27:05', '2020-12-06 20:27:05', 2, 5),
(3, 8, '2020-12-21 14:51:20', '2020-12-21 14:51:20', 4, 5),
(3, 11, '2020-12-21 14:51:20', '2020-12-21 14:51:20', 5, 16);

-- --------------------------------------------------------

--
-- Table structure for table `recepis_sections`
--

CREATE TABLE `recepis_sections` (
  `id` int(11) UNSIGNED NOT NULL,
  `section_name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recepis_sections`
--

INSERT INTO `recepis_sections` (`id`, `section_name`, `created_at`, `updated_at`) VALUES
(2, 'Lanch', '2020-12-06 18:53:32', '2020-12-06 16:53:32'),
(3, 'Snakes', '2020-12-06 18:54:03', '2020-12-06 16:54:03'),
(5, 'Dinner', '2020-12-06 16:54:16', '2020-12-06 16:54:16'),
(6, 'Snake two', '2020-12-07 17:50:54', '2020-12-07 17:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `msg`, `send_date`, `user_id`, `status`, `created_at`, `updated_at`, `subject`) VALUES
(1, 'this is first request', '2021-01-19 17:50:30', 2, 'resolved', NULL, '2021-01-19 15:50:30', 'request one'),
(2, 'test test test  support', '2021-01-18 22:00:00', 2, 'in progress', '2021-01-19 15:50:02', '2021-01-19 15:50:02', 'test support'),
(3, 'new hiiiii', '2021-01-31 16:34:32', 2, 'resolved', '2021-01-31 14:02:38', '2021-01-31 14:34:32', 'new ticket from user'),
(4, 'this is new ticket', '2021-01-31 17:00:45', 2, 'resolved', '2021-01-31 14:59:35', '2021-01-31 15:00:45', 'new ticket test2');

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
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(3, '/img/profile/b5bbb2f899f5c20083abab1f82a5f77e.png', '2021-02-03 09:57:50', '2021-02-03 09:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `msg` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `assign_to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `trainer_id` int(11) UNSIGNED DEFAULT NULL,
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
(1, 'hjdsjfh', 2, 6, 1, '2020-11-16 12:52:37', 1, 'visa', 'hdfjhsjf', 'flkfgflgk', 200.00, NULL, NULL),
(13, 'I1QLdirJ6W', 2, 6, 1, '2021-01-30 22:00:00', 1, 'visa', 'none', 'none', 200.00, '2021-01-31 14:58:53', '2021-01-31 14:58:53'),
(14, 'yIv3jG7Elj', 2, 6, 1, '2021-03-08 22:00:00', 1, 'visa', 'none', 'none', 200.00, '2021-03-09 18:21:15', '2021-03-09 18:21:15'),
(15, 'CkBNdFpucV', 2, 6, 1, '2021-03-08 22:00:00', 1, 'visa', 'none', 'none', 200.00, '2021-03-09 18:24:26', '2021-03-09 18:24:26'),
(16, '6Mk3UdflTu', 2, 6, 1, '2021-03-08 22:00:00', 1, 'visa', 'none', 'none', 200.00, '2021-03-09 18:31:41', '2021-03-09 18:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `city_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_ar` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `image`, `desc`, `category_id`, `city_id`, `name_ar`, `description_ar`, `city_ar`, `google_id`, `apple_id`, `phone`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$T1HpU833cwqKxqHTr0nXCOvQLMs0w19Z.Vg0I6WZzSEut//qQX7z2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'test23333', 'test2@yahoo.com', NULL, '$2y$10$zmnpfZLg6uNjhvNQetQnXu48vIR/68dOAUx0rRbvlZfnVk4bpSY7W', NULL, '2020-11-14 11:19:22', '2021-03-01 14:41:40', 3, '/img/profile/90a75251516a0b18297436dc1f215c89.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01008754678'),
(6, 'trainer', 'trainer@yahoo.com', NULL, '$2y$10$12zAYY6SWhs5ymRHVEWhJ.aWP.nvEIvylf11Fc.2adN6UyIblqi5C', NULL, '2020-11-14 15:29:32', '2020-12-28 07:48:18', 2, '/img/profile/9048c6aacf6fc03dcc1d6f68ada63484.jpg', 'this is trainer description', 2, 'city 666', 'مدرب 111', 'وصف 1111', 'مدينة 1111', NULL, NULL, NULL),
(8, 'subadmin', 'subadmin@admin.com', NULL, '$2y$10$Hg0nPKpQT2/tQDIdSEKleuWyZ6wth6hZbSL1gIFIAnrCpwJCv1n2.', NULL, '2020-11-16 06:23:20', '2020-11-16 06:23:20', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'trainer2', 'trainer2@yahoo.com', NULL, '$2y$10$gIrm9vRq/Kwz72jiBCV57OH0ABKuH4e.oWPvYLht72b5m7RY0nOrS', NULL, '2020-11-16 07:16:49', '2020-11-16 07:16:49', 2, '/img/profile/cf60ce1b74487bbb83ee651077e7692f.png', 'this is trainer2', 2, '2', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'test3', 'test3@yahoo.com', NULL, '$2y$10$7ulntF6hUYbal9zYqtu4XefODM6vJGS/qIyJZxpJEg4DoQGot9N/q', NULL, '2020-11-16 12:38:10', '2020-11-16 12:38:10', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'trainer3', 'trainer3@yahoo.com', NULL, '$2y$10$K5qivXyGgvrYnNTtVAHSXuKeS5qkrnrBAIrGXVYtEa4OXHWq15rE6', NULL, '2020-12-04 08:28:35', '2020-12-04 08:28:35', 2, '/img/profile/5f7ddc4ea4b3af08f7b9882b6311fa4e.jpg', 'trainer3 trainer3 trainer3 trainer3  trainer3', 2, 'citydddd', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'trainer test 8888', 'trainer888999@yahoo.com', NULL, '$2y$10$YytykpZRMGt.50U8.E6gY.RUFN.rrDgZdMrWVkbJ3IZCCYIP3IAvm', NULL, '2020-12-28 08:14:13', '2020-12-28 08:14:13', 2, '/img/profile/3b4ed8c30e2aebbedcdbc4250c15ed33.png', 'description1111', 2, 'city8888', 'مدرب 8888', 'وصف 1111', 'مدينة 8888', NULL, NULL, NULL),
(19, 'test4', 'test4@yahoo.com', NULL, '$2y$10$snLsMPnxmKFvBFQtgvyHwudNpgObs8KtTelI.SoRqUA.sWbU.AEKy', NULL, '2021-01-05 15:25:30', '2021-01-05 15:25:30', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'subadmn2', 'subadmn2@yahoo.com', NULL, '$2y$10$Ldltvbrn24Kg.A3NJTRjE.BcDX2GU8NbTexs1WDI3RbKIb5933j3u', NULL, '2021-01-06 07:42:17', '2021-01-06 07:42:17', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'testnnnn', 'testnnnn@yahoo.com', NULL, '$2y$10$xAAJGCNbbKEmfK/.i7jrG.vwNw3e.2jHeWXLvxwyLzszXxi4B5idu', NULL, '2021-01-19 11:27:27', '2021-03-01 14:41:24', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01008765456');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permssion_name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `user_id`, `permssion_name`, `created_at`, `updated_at`) VALUES
(13, 22, 'manage_user', '2021-01-11 15:37:49', '2021-01-11 15:37:49'),
(14, 22, 'view_sales', '2021-01-11 15:37:49', '2021-01-11 15:37:49'),
(15, 22, 'manage_program_design', '2021-01-11 15:37:49', '2021-01-11 15:37:49'),
(16, 22, 'manage_dashboard', '2021-01-11 15:37:49', '2021-01-11 15:37:49');

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
  `trainer_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrow_record`
--

INSERT INTO `withdrow_record` (`id`, `withdrw_num`, `withdrw_amount`, `is_execute`, `execute_date`, `trainer_id`, `created_at`, `updated_at`) VALUES
(1, 'xo4I5Ak097', 20.00, 0, NULL, 6, '2020-12-05 12:19:15', '2020-12-05 12:19:15');

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
  ADD KEY `chat_booking_id_foreign` (`booking_id`),
  ADD KEY `chat_user_foreign` (`from_user`);

--
-- Indexes for table `complete_excercises`
--
ALTER TABLE `complete_excercises`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `messages_request_id_foreign` (`request_id`),
  ADD KEY `message_user_forign` (`from_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muscles`
--
ALTER TABLE `muscles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_user_forign` (`user_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_user_forign` (`user_id`);

--
-- Indexes for table `package_user_plan`
--
ALTER TABLE `package_user_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `programe_design_integrent`
--
ALTER TABLE `programe_design_integrent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programme_id` (`programme_id`);

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
-- Indexes for table `questionaire`
--
ALTER TABLE `questionaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ready_plan`
--
ALTER TABLE `ready_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receips`
--
ALTER TABLE `receips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receips_integration`
--
ALTER TABLE `receips_integration`
  ADD KEY `fk_recept` (`recep_id`),
  ADD KEY `fk_integrate` (`integrate_programme_id`),
  ADD KEY `fk_programme` (`programme_id`);

--
-- Indexes for table `recepis_sections`
--
ALTER TABLE `recepis_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_forign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_package_id_foreign` (`package_id`),
  ADD KEY `transaction_trainer_forign` (`trainer_id`),
  ADD KEY `transaction_user_forign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrow_record`
--
ALTER TABLE `withdrow_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrow_trainer_forign` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `complete_excercises`
--
ALTER TABLE `complete_excercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `muscles`
--
ALTER TABLE `muscles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_user_plan`
--
ALTER TABLE `package_user_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `programe_design_integrent`
--
ALTER TABLE `programe_design_integrent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `programme_images`
--
ALTER TABLE `programme_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `programm_designs`
--
ALTER TABLE `programm_designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `programm_design_calendar`
--
ALTER TABLE `programm_design_calendar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionaire`
--
ALTER TABLE `questionaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions_answers`
--
ALTER TABLE `questions_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ready_plan`
--
ALTER TABLE `ready_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receips`
--
ALTER TABLE `receips`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recepis_sections`
--
ALTER TABLE `recepis_sections`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `withdrow_record`
--
ALTER TABLE `withdrow_record`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_user_forign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notification_user_forign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_user_forign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programe_design_integrent`
--
ALTER TABLE `programe_design_integrent`
  ADD CONSTRAINT `fk_programme_id` FOREIGN KEY (`programme_id`) REFERENCES `programm_designs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `receips_integration`
--
ALTER TABLE `receips_integration`
  ADD CONSTRAINT `fk_integrate` FOREIGN KEY (`integrate_programme_id`) REFERENCES `programe_design_integrent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_programme` FOREIGN KEY (`programme_id`) REFERENCES `programm_designs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recept` FOREIGN KEY (`recep_id`) REFERENCES `receips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_user_forign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transaction_trainer_forign` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaction_user_forign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrow_record`
--
ALTER TABLE `withdrow_record`
  ADD CONSTRAINT `withdrow_trainer_forign` FOREIGN KEY (`trainer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
