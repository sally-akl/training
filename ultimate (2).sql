-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 03:04 PM
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
  `from_user` int(11) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `to_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `msg`, `from_user`, `booking_id`, `created_at`, `updated_at`, `to_user`) VALUES
(1, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 6, 1, '2020-11-13 12:20:23', NULL, 2),
(2, 'iiiiiiiiiiiiii', 6, 1, '2020-11-24 12:23:15', NULL, 2),
(3, 'kkkkkkkkkkkk', 2, 1, '2020-11-24 13:23:22', NULL, 6),
(11, 'kkkkkkkllllllllllll', 2, 1, '2020-12-09 18:23:16', '2020-12-09 18:23:16', 6),
(12, 'oooooooooo', 6, 1, '2020-12-09 18:23:26', '2020-12-09 18:23:26', 2),
(13, 'ollllllllllll', 2, 1, '2020-12-09 18:23:43', '2020-12-09 18:23:43', 6),
(14, 'okkkkjjjj', 6, 1, '2020-12-09 18:26:43', '2020-12-09 18:26:43', 2),
(15, 'lllllllllllllljjjjjjjjjjjjj', 2, 1, '2020-12-09 18:26:51', '2020-12-09 18:26:51', 6),
(16, 'jjjjjjjjjjkkkkkkkkkkk', 6, 1, '2020-12-09 18:28:42', '2020-12-09 18:28:42', 2),
(17, 'tkkkkkkk', 10, 2, '2020-12-09 18:29:04', '2020-12-09 18:29:04', 6),
(18, 'ok prooooooooo', 6, 2, '2020-12-09 18:29:27', '2020-12-09 18:29:27', 10);

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
  `user_id` int(11) UNSIGNED DEFAULT NULL,
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
  `user_id` int(11) UNSIGNED NOT NULL,
  `accepted_from_admin` tinyint(1) NOT NULL DEFAULT 0,
  `package_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `package_desc`, `package_duration_type`, `package_duration`, `package_price`, `package_questionaire`, `created_at`, `updated_at`, `package_type`, `user_id`, `accepted_from_admin`, `package_status`) VALUES
(1, 'package 1', 'package 1 111111111111111111111', 'week', 2, 200.00, 'ajdhajhdjas', NULL, '2020-12-20 11:55:38', 'paid', 6, 1, 'active');

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
  `suplement_serving_size` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_user_plan`
--

INSERT INTO `package_user_plan` (`day_num`, `package_id`, `user_id`, `programme_design_id`, `recepe_id`, `section_id`, `created_at`, `updated_at`, `transaction_id`, `id`, `set_num`, `suplement_serving_size`) VALUES
(8, 1, 2, 4, NULL, NULL, '2020-12-21 17:19:53', '2020-12-21 17:19:53', 1, 12, NULL, ''),
(1, 1, 2, 1, NULL, NULL, '2020-12-28 07:06:21', '2020-12-28 07:06:21', 1, 34, NULL, ''),
(1, 1, 2, 2, NULL, NULL, '2020-12-28 10:40:32', '2020-12-28 10:40:32', 1, 35, '5', ''),
(1, 1, 2, 6, NULL, NULL, '2020-12-28 10:51:08', '2020-12-28 10:51:08', 1, 37, NULL, '6');

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
(14, '/img/programme/5fd11a44647259daa1c65abfeaf339f4.jpg', 13, '2020-12-05 09:34:27', '2020-12-05 09:34:27');

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
  `desc_ar` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programm_designs`
--

INSERT INTO `programm_designs` (`id`, `title`, `desc`, `vedio`, `media_type`, `created_at`, `updated_at`, `type`, `number_of_sets`, `serving_size`, `title_ar`, `desc_ar`) VALUES
(1, 'excerices 1', 'Look, my liege! The Knights Who Say Ni demand a sacrifice! …Are you suggesting that coconuts migr', NULL, 'image', '2020-11-18 07:11:46', '2020-11-18 07:19:07', 'exercises', NULL, NULL, '', ''),
(2, 'excercise two', 'excerrrrrrrrrrrrrrrrrrrrrrrr', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1piFN_ioMVI\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'vedio', '2020-11-18 10:06:40', '2020-11-24 16:09:37', 'exercises', NULL, NULL, '', ''),
(3, 'excercise3333', 'this is excercise 333', NULL, 'image', '2020-11-18 10:59:02', '2020-11-18 11:39:13', 'exercises', NULL, NULL, '', ''),
(4, 'excercise new edit', 'this is excercies new  this is excercies new this is excercies new this is excercies new this is excercies new this is excercies new this is excercies new', '', 'image', '2020-11-18 18:46:48', '2020-11-19 11:56:31', 'exercises', NULL, NULL, '', ''),
(5, 'daily meals content', 'daily meals content daily meals content daily meals content', NULL, 'image', '2020-11-24 14:41:20', '2020-12-06 19:39:31', 'dietary meals', NULL, NULL, 'llllllllllllllllllll', 'kkkkkkkkkkkkkkkkkkkkkkkkkkk'),
(6, 'food 3', 'food 3 food 3 food 3 food 3 food 3 food 3', '', 'image', '2020-11-24 15:16:11', '2020-11-24 16:59:17', 'food supplements', NULL, NULL, '', ''),
(11, 'test images', 'test test', NULL, 'image', '2020-12-05 06:10:21', '2020-12-05 06:10:21', 'exercises', NULL, NULL, '', ''),
(12, 'test vedio', 'kkkkkkkkkkkkkkkkllllllllllllllllllll', '<iframe width=\"377\" height=\"243\" src=\"https://www.youtube.com/embed/oc4QS2USKmk\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\"></iframe>', 'vedio', '2020-12-05 06:14:56', '2020-12-05 09:39:49', 'exercises', '3', NULL, 'iiiiiiiiiiiiiiiiiiii', 'vvvvvvvvvvvvvvvv'),
(13, 'test excercise', 'nnnnnnnnnnnnnnnn', NULL, 'image', '2020-12-05 06:32:03', '2020-12-05 09:34:27', 'exercises', '2', NULL, 'oooooooooooooo', 'pppppppppppppp'),
(14, 'test supplement', 'lllllllllllllllllllll', NULL, NULL, '2020-12-05 06:35:12', '2020-12-05 09:31:28', 'food supplements', NULL, '3', 'kkkkkkkkkkkkkk', 'ppppppppppp'),
(16, 'chicken', 'ccccccccccccccc', NULL, NULL, '2020-12-05 08:13:36', '2020-12-07 17:33:07', 'dietary meals', NULL, NULL, 'cccccccccccccccc', 'ttttttttttttttttttttttt');

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
(2, 'hjdsjfhjhhh', 10, 6, 1, '2020-12-21 18:05:28', 1, 'visa', 'hdfjhsjf', 'flkfgflgk', 200.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
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
  `city_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_ar` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `image`, `desc`, `category_id`, `city_id`, `name_ar`, `description_ar`, `city_ar`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$T1HpU833cwqKxqHTr0nXCOvQLMs0w19Z.Vg0I6WZzSEut//qQX7z2', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'test2', 'test2@yahoo.com', NULL, '$2y$10$Tm6HOS.ZWwnwMhvaf0ioFu5nrqauhWPO3OtiwlzmsePeJ/mqlOMAS', NULL, '2020-11-14 11:19:22', '2020-11-16 12:27:20', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'trainer', 'trainer@yahoo.com', NULL, '$2y$10$12zAYY6SWhs5ymRHVEWhJ.aWP.nvEIvylf11Fc.2adN6UyIblqi5C', NULL, '2020-11-14 15:29:32', '2020-12-28 07:48:18', 2, '/img/profile/9048c6aacf6fc03dcc1d6f68ada63484.jpg', 'this is trainer description', 2, 'city 666', 'مدرب 111', 'وصف 1111', 'مدينة 1111'),
(8, 'subadmin', 'subadmin@admin.com', NULL, '$2y$10$Hg0nPKpQT2/tQDIdSEKleuWyZ6wth6hZbSL1gIFIAnrCpwJCv1n2.', NULL, '2020-11-16 06:23:20', '2020-11-16 06:23:20', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'trainer2', 'trainer2@yahoo.com', NULL, '$2y$10$gIrm9vRq/Kwz72jiBCV57OH0ABKuH4e.oWPvYLht72b5m7RY0nOrS', NULL, '2020-11-16 07:16:49', '2020-11-16 07:16:49', 2, '/img/profile/cf60ce1b74487bbb83ee651077e7692f.png', 'this is trainer2', 2, '2', NULL, NULL, NULL),
(10, 'test3', 'test3@yahoo.com', NULL, '$2y$10$7ulntF6hUYbal9zYqtu4XefODM6vJGS/qIyJZxpJEg4DoQGot9N/q', NULL, '2020-11-16 12:38:10', '2020-11-16 12:38:10', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'trainer3', 'trainer3@yahoo.com', NULL, '$2y$10$K5qivXyGgvrYnNTtVAHSXuKeS5qkrnrBAIrGXVYtEa4OXHWq15rE6', NULL, '2020-12-04 08:28:35', '2020-12-04 08:28:35', 2, '/img/profile/5f7ddc4ea4b3af08f7b9882b6311fa4e.jpg', 'trainer3 trainer3 trainer3 trainer3  trainer3', 2, 'citydddd', NULL, NULL, NULL),
(18, 'trainer test 8888', 'trainer888999@yahoo.com', NULL, '$2y$10$YytykpZRMGt.50U8.E6gY.RUFN.rrDgZdMrWVkbJ3IZCCYIP3IAvm', NULL, '2020-12-28 08:14:13', '2020-12-28 08:14:13', 2, '/img/profile/3b4ed8c30e2aebbedcdbc4250c15ed33.png', 'description1111', 2, 'city8888', 'مدرب 8888', 'وصف 1111', 'مدينة 8888');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_user_plan`
--
ALTER TABLE `package_user_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `programe_design_integrent`
--
ALTER TABLE `programe_design_integrent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `programme_images`
--
ALTER TABLE `programme_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `programm_designs`
--
ALTER TABLE `programm_designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `programm_design_calendar`
--
ALTER TABLE `programm_design_calendar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
