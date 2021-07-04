-- phpMyAdmin SQL Dump
-- version 5.1.0-dev
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2021 at 11:04 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webint`
--

-- --------------------------------------------------------

--
-- Table structure for table `bodyworks`
--

CREATE TABLE `bodyworks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bodyworks`
--

INSERT INTO `bodyworks` (`id`, `name`, `vehicle_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hatchback', NULL, 1, '2021-03-21 21:32:09', '2021-03-21 21:32:09'),
(2, 'Sedan', NULL, 1, '2021-03-21 21:32:16', '2021-03-21 21:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `vehicle_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ford', NULL, 1, '2021-03-21 21:32:26', '2021-03-21 21:32:26'),
(2, 'Skoda', NULL, 1, '2021-03-21 21:32:32', '2021-03-21 21:32:32'),
(3, 'Toyota', NULL, 1, '2021-03-21 21:32:39', '2021-03-21 21:32:39'),
(4, 'Volkswagen', NULL, 1, '2021-03-21 21:32:51', '2021-03-21 21:32:51'),
(5, 'Nissan', NULL, 1, '2021-03-21 21:33:07', '2021-03-21 21:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `metallic` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `vehicle_id`, `status`, `metallic`, `created_at`, `updated_at`) VALUES
(1, 'Red', NULL, 1, 0, '2021-03-21 21:31:01', '2021-03-21 21:31:01'),
(2, 'Green - metallic', NULL, 1, 1, '2021-03-21 21:31:07', '2021-03-21 21:31:36'),
(3, 'Blue', NULL, 1, 0, '2021-03-21 21:31:13', '2021-03-21 21:31:13'),
(4, 'Black - metallic', NULL, 1, 1, '2021-03-21 21:31:20', '2021-03-21 21:31:33'),
(5, 'White', NULL, 1, 0, '2021-03-21 21:31:25', '2021-03-21 21:31:25'),
(6, 'Black', NULL, 1, 0, '2021-03-21 21:31:43', '2021-03-21 21:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `engines`
--

CREATE TABLE `engines` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `engines`
--

INSERT INTO `engines` (`id`, `name`, `vehicle_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gasoline', NULL, 1, '2021-03-21 21:31:54', '2021-03-21 21:31:54'),
(2, 'Diesel', NULL, 1, '2021-03-21 21:31:59', '2021-03-21 21:31:59');

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
(1, '2021_03_12_165948_create_brands_table', 1),
(2, '2021_03_12_171908_create_bodyworks_table', 1),
(3, '2021_03_12_171954_create_engines_table', 1),
(4, '2021_03_12_172253_create_colors_table', 1),
(5, '2021_03_12_183710_create_vehicle_models_table', 1),
(6, '2021_03_13_170103_create_vehicles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` longtext COLLATE utf8mb4_unicode_ci,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `bodywork_id` int(10) UNSIGNED NOT NULL,
  `engine_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageurl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `version`, `info`, `brand_id`, `model_id`, `bodywork_id`, `engine_id`, `color_id`, `image`, `imageurl`, `_token`, `status`, `created_at`, `updated_at`) VALUES
(1, '2.0', '<p>Sample Text</p>', 1, 1, 1, 1, 3, '/tmp/php7UEPjk', 'ford_focus.jpeg', 'xyflHHGcGxB023MlGS2JGNkJI864SgVky7MwqT82', 0, '2021-03-21 21:42:38', '2021-03-21 22:42:11'),
(2, '1.0', '<p>Sample Text</p>', 1, 2, 1, 2, 2, '/tmp/phpkwojDn', 'ford_fiesta.jpeg', 'xyflHHGcGxB023MlGS2JGNkJI864SgVky7MwqT82', 0, '2021-03-21 21:43:36', '2021-03-21 22:59:54'),
(3, '1.0', '<p>Sample Text</p>', 1, 3, 2, 1, 5, '/tmp/phpTiOeys', 'ford_mondeo.jpeg', 'xyflHHGcGxB023MlGS2JGNkJI864SgVky7MwqT82', 1, '2021-03-21 21:46:29', '2021-03-21 21:46:29'),
(4, '1.0', '<p>Sample Text</p>', 2, 4, 1, 1, 1, '/tmp/phpzvLn2e', 'skoda_octavia_hatchback.jpeg', 'xyflHHGcGxB023MlGS2JGNkJI864SgVky7MwqT82', 1, '2021-03-21 21:48:45', '2021-03-21 21:48:45'),
(5, '2.0', '<p>Text</p>', 2, 4, 2, 2, 1, '/tmp/phpr4HZmj', 'skoda_octavia_sedan.jpeg', 'xyflHHGcGxB023MlGS2JGNkJI864SgVky7MwqT82', 1, '2021-03-21 21:49:16', '2021-03-21 21:49:16'),
(6, '3.0', '<p>Sample Text</p>', 2, 5, 1, 1, 6, '/tmp/phpbRqHSi', 'skoda_kamiq.jpeg', 'xyflHHGcGxB023MlGS2JGNkJI864SgVky7MwqT82', 1, '2021-03-21 21:51:09', '2021-03-21 21:51:09'),
(7, '1.0', '<p>text</p>', 1, 2, 2, 1, 4, '/tmp/php4wgHPT', 'download.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 1, '2021-03-21 22:45:56', '2021-03-21 22:45:56'),
(8, '1.0', '<p>Sample Text</p>', 3, 8, 1, 2, 1, '/tmp/phpfmTboi', 'yaris.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 0, '2021-03-21 22:50:52', '2021-03-21 22:59:50'),
(9, '2.0', '<p>Avensis</p>', 3, 9, 2, 1, 3, '/tmp/php2MqB2x', 'car_toyota_2.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 1, '2021-03-21 22:51:56', '2021-03-21 22:52:02'),
(10, '1.0', '<p>Sample Text</p>', 3, 10, 1, 1, 5, '/tmp/php3epAN4', 'car_toyota.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 1, '2021-03-21 22:53:36', '2021-03-21 22:53:48'),
(11, '2.0', '<p>Skoda</p>', 2, 7, 2, 2, 5, '/tmp/phpkXMeJJ', 'skoda.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 1, '2021-03-21 22:55:41', '2021-03-21 22:55:41'),
(12, '1.0', '<p>Passat</p>', 4, 11, 1, 1, 1, '/tmp/php11uuqI', 'passat.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 1, '2021-03-21 22:57:43', '2021-03-21 22:58:19'),
(13, '1.0', '<p>Micra</p>', 5, 12, 1, 1, 3, '/tmp/php8wbhgz', 'micra.jpeg', 'gTqpzdHD5Qfza8evvUHsaS1MB3uTWjr7mSZ9q74l', 1, '2021-03-21 22:59:43', '2021-03-21 22:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `name`, `brand_id`, `vehicle_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Focus', 1, NULL, 1, '2021-03-21 21:33:45', '2021-03-21 21:33:45'),
(2, 'Fiesta', 1, NULL, 1, '2021-03-21 21:34:01', '2021-03-21 21:34:01'),
(3, 'Mondeo', 1, NULL, 1, '2021-03-21 21:35:02', '2021-03-21 21:35:02'),
(4, 'Octavia', 2, NULL, 1, '2021-03-21 21:35:28', '2021-03-21 21:35:28'),
(5, 'Kamiq', 2, NULL, 1, '2021-03-21 21:35:52', '2021-03-21 21:35:52'),
(6, 'Karoq', 2, NULL, 1, '2021-03-21 21:36:12', '2021-03-21 21:36:12'),
(7, 'Fabia', 2, NULL, 1, '2021-03-21 21:36:33', '2021-03-21 21:36:33'),
(8, 'Yaris', 3, NULL, 1, '2021-03-21 21:37:11', '2021-03-21 21:37:11'),
(9, 'Avensis', 3, NULL, 1, '2021-03-21 21:37:19', '2021-03-21 21:37:19'),
(10, 'Aygo', 3, NULL, 1, '2021-03-21 21:37:55', '2021-03-21 21:37:55'),
(11, 'Passat', 4, NULL, 1, '2021-03-21 22:56:40', '2021-03-21 22:56:40'),
(12, 'Micra', 5, NULL, 1, '2021-03-21 22:58:51', '2021-03-21 22:58:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodyworks`
--
ALTER TABLE `bodyworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `engines`
--
ALTER TABLE `engines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_brand_id_foreign` (`brand_id`),
  ADD KEY `vehicles_model_id_foreign` (`model_id`),
  ADD KEY `vehicles_bodywork_id_foreign` (`bodywork_id`),
  ADD KEY `vehicles_engine_id_foreign` (`engine_id`),
  ADD KEY `vehicles_color_id_foreign` (`color_id`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_models_brand_id_foreign` (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bodyworks`
--
ALTER TABLE `bodyworks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `engines`
--
ALTER TABLE `engines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_bodywork_id_foreign` FOREIGN KEY (`bodywork_id`) REFERENCES `bodyworks` (`id`),
  ADD CONSTRAINT `vehicles_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `vehicles_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `vehicles_engine_id_foreign` FOREIGN KEY (`engine_id`) REFERENCES `engines` (`id`),
  ADD CONSTRAINT `vehicles_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`);

--
-- Constraints for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD CONSTRAINT `vehicle_models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
