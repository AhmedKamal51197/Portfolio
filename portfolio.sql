-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 08, 2025 at 12:23 AM
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
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `adopted_methodologies`
--

CREATE TABLE `adopted_methodologies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_ar` varchar(255) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adopted_methodologies`
--

INSERT INTO `adopted_methodologies` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `created_at`, `updated_at`) VALUES
(1, 'المنهجية المعتمدة ', 'Adopted Methodology 1', 'وصف المنهجية المعتمدة 1 باللغة العربية.', 'Description of Adopted Methodology 1 in English.', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `community_impacts`
--

CREATE TABLE `community_impacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `community_impacts`
--

INSERT INTO `community_impacts` (`id`, `title_ar`, `title_en`, `created_at`, `updated_at`) VALUES
(1, 'أثر المجتمع', 'Community Impact', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `community_impact_images`
--

CREATE TABLE `community_impact_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `community_impact_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL COMMENT 'Path to the image file',
  `position` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `community_impact_images`
--

INSERT INTO `community_impact_images` (`id`, `community_impact_id`, `image`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'image1.jpg', 0, '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(2, 1, 'image2.jpg', 1, '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(3, 1, 'image3.jpg', 2, '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `current_projects`
--

CREATE TABLE `current_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `current_projects`
--

INSERT INTO `current_projects` (`id`, `title_ar`, `title_en`, `created_at`, `updated_at`) VALUES
(1, 'المشروع الحالي', 'Current Project', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name_ar` varchar(255) DEFAULT NULL,
  `client_name_en` varchar(255) DEFAULT NULL,
  `evaluate_ar` text DEFAULT NULL,
  `evaluate_en` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `client_name_ar`, `client_name_en`, `evaluate_ar`, `evaluate_en`, `image`, `video`, `created_at`, `updated_at`) VALUES
(2, 'اسم عميل آخر باللغة العربية', 'Another Client Name in English', NULL, NULL, 'another_evaluation_image.jpg', 'another_evaluation_video.mp4', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(3, 'اسم العميل باللغة العربية', 'Client Name in English', 'تقييم باللغة العربية', 'Evaluation in English', 'evaluation3_image.jpg', NULL, '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(4, 'اسم عميل آخر باللغة العربية', 'Another Client Name in English', 'تقييم آخر باللغة العربية', 'Another Evaluation in English', 'another_evaluation4_image.jpg', NULL, '2025-08-07 17:32:58', '2025-08-07 17:32:58');

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
-- Table structure for table `hero_section`
--

CREATE TABLE `hero_section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_section`
--

INSERT INTO `hero_section` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `image`, `created_at`, `updated_at`) VALUES
(1, 'مرحبا بكم في موقعنا', 'Welcome to Our Website', 'نحن نقدم أفضل الخدمات', 'We Offer the Best Services', 'hero_image.jpg', '2025-08-07 17:28:59', '2025-08-07 17:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `instegram_broadcasts`
--

CREATE TABLE `instegram_broadcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `all_broadcast_link` varchar(255) DEFAULT NULL,
  `banner_title_ar` varchar(255) DEFAULT NULL,
  `banner_title_en` varchar(255) DEFAULT NULL,
  `banner_description_ar` varchar(255) DEFAULT NULL,
  `banner_description_en` varchar(255) DEFAULT NULL,
  `broadcast_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instegram_broadcasts`
--

INSERT INTO `instegram_broadcasts` (`id`, `title_ar`, `title_en`, `all_broadcast_link`, `banner_title_ar`, `banner_title_en`, `banner_description_ar`, `banner_description_en`, `broadcast_link`, `image`, `created_at`, `updated_at`) VALUES
(1, 'عنوان البانر باللغة العربية', 'Banner Title in English', 'https://www.instagram.com/', 'عنوان البانر باللغة العربية', 'Banner Title in English', 'وصف البانر باللغة العربية', 'Banner Description in English', 'https://www.instagram.com/', 'banner_image.jpg', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(2, 'عنوان البث باللغة العربية', 'Broadcast Title in English', NULL, NULL, NULL, NULL, NULL, 'https://www.instagram.com/', 'broadcast_image.jpg', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(3, 'عنوان بث آخر باللغة العربية', 'Another Broadcast Title in English', NULL, NULL, NULL, NULL, NULL, 'https://www.instagram.com/', 'broadcast2_image.jpg', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(4, 'عنوان بث آخر باللغة العربية', 'Another Broadcast Title in English', NULL, NULL, NULL, NULL, NULL, 'https://www.instagram.com/', 'broadcast3_image.jpg', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(5, 'عنوان بث آخر باللغة العربية', 'Another Broadcast Title in English', NULL, NULL, NULL, NULL, NULL, 'https://www.instagram.com/', 'broadcast4_image.jpg', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `client_country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `client_name`, `client_email`, `client_phone`, `client_country`, `created_at`, `updated_at`) VALUES
(1, 'اسم العميل', 'client@gmail.com', '+201034567890', 'مصر', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(2, 'اسم العميل', 'client@gmail.com', '+201034567890', 'مصر', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(3, 'اسم العميل', 'client@gmail.com', '+201034567890', 'مصر', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(4, 'اسم العميل', 'client@gmail.com', '+201034567890', 'مصر', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_25_144139_create_hero_section', 1),
(6, '2025_07_26_092130_create_my_vision_mission', 2),
(10, '2025_07_26_145252_create_professional_appreciation_groups_table', 3),
(11, '2025_07_26_145319_create_professional_appreciation_cards_table', 3),
(12, '2025_07_27_055414_create_the_adopted_methodologies', 4),
(13, '2025_07_27_073546_create_training_programs', 5),
(14, '2025_07_27_200050_create_current_projects', 6),
(15, '2025_07_28_210832_create_community_impacts', 7),
(16, '2025_07_29_061411_create_community_impact_images', 8),
(17, '2025_07_29_164157_add_position_to_community_impact_images_table', 9),
(18, '2025_07_29_191231_create_instegram_broadcasts', 10),
(19, '2025_07_31_211859_create_mails', 11),
(20, '2025_08_01_131725_create_privacy_policy', 12),
(21, '2025_08_01_163204_create_terms_conditions', 13),
(22, '2025_08_01_173816_create_social_medias', 14),
(23, '2025_08_01_181556_create_social_medias', 15),
(24, '2025_08_01_221333_create_reset_password_tokens_table', 16),
(25, '2025_08_03_172224_create_evaluations', 17),
(26, '2025_08_07_155146_create_social_medias', 18);

-- --------------------------------------------------------

--
-- Table structure for table `my_vision_mission`
--

CREATE TABLE `my_vision_mission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `type` enum('vision','mission') NOT NULL DEFAULT 'vision',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_vision_mission`
--

INSERT INTO `my_vision_mission` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `icon`, `type`, `created_at`, `updated_at`) VALUES
(1, 'رؤيتنا', 'Our Vision', 'نحن نهدف إلى تحقيق التميز في كل ما نقوم به.', 'We aim to achieve excellence in everything we do.', 'vision_icon.png', 'vision', '2025-08-07 17:28:59', '2025-08-07 17:28:59'),
(2, 'رؤيتنا', 'Our Vision', 'نحن نهدف إلى تحقيق التميز في كل ما نقوم به.', 'We aim to achieve excellence in everything we do.', 'mission_icon.png', 'mission', '2025-08-07 17:28:59', '2025-08-07 17:28:59');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `content_ar` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `title_ar`, `title_en`, `content_ar`, `content_en`, `created_at`, `updated_at`) VALUES
(1, 'سياسة الخصوصية', 'Privacy Policy', 'محتوى سياسة الخصوصية باللغة العربية.', 'Content of the privacy policy in English.', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `professional_appreciation_cards`
--

CREATE TABLE `professional_appreciation_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cardable_id` bigint(20) UNSIGNED NOT NULL,
  `cardable_type` varchar(255) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_appreciation_cards`
--

INSERT INTO `professional_appreciation_cards` (`id`, `cardable_id`, `cardable_type`, `position`, `description_ar`, `description_en`, `icon`, `created_at`, `updated_at`) VALUES
(1, 2, 'App\\Models\\ProfessionalAppreciationGroup', 1, 'وصف البطاقة 1 باللغة العربية.', 'Description of Card 1 in English.', 'icon.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(2, 2, 'App\\Models\\ProfessionalAppreciationGroup', 2, 'وصف البطاقة 2 باللغة العربية.', 'Description of Card 2 in English.', 'icon2.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(3, 2, 'App\\Models\\ProfessionalAppreciationGroup', 3, 'وصف البطاقة 3 باللغة العربية.', 'Description of Card 3 in English.', 'icon3.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(4, 1, 'App\\Models\\AdoptedMethodology', 1, 'وصف البطاقة 1 باللغة العربية.', 'Description of Card 1 in English.', 'icon1.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(5, 1, 'App\\Models\\AdoptedMethodology', 2, 'وصف البطاقة 2 باللغة العربية.', 'Description of Card 2 in English.', 'icon2.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(6, 1, 'App\\Models\\AdoptedMethodology', 3, 'وصف البطاقة 3 باللغة العربية.', 'Description of Card 3 in English.', 'icon3.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(7, 1, 'App\\Models\\AdoptedMethodology', 4, 'وصف البطاقة 4 باللغة العربية.', 'Description of Card 4 in English.', 'icon4.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(8, 1, 'App\\Models\\TrainingProgram', 1, 'وصف البطاقة 1 باللغة العربية.', 'Description of Card 1 in English.', 'icon1.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(9, 1, 'App\\Models\\TrainingProgram', 2, 'وصف البطاقة 2 باللغة العربية.', 'Description of Card 2 in English.', 'icon2.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(10, 1, 'App\\Models\\TrainingProgram', 3, 'وصف البطاقة 3 باللغة العربية.', 'Description of Card 3 in English.', 'icon3.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(11, 1, 'App\\Models\\TrainingProgram', 4, 'وصف البطاقة 4 باللغة العربية.', 'Description of Card 4 in English.', 'icon4.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(12, 1, 'App\\Models\\TrainingProgram', 5, 'وصف البطاقة 5 باللغة العربية.', 'Description of Card 5 in English.', 'icon5.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(13, 1, 'App\\Models\\TrainingProgram', 6, 'وصف البطاقة 6 باللغة العربية.', 'Description of Card 6 in English.', 'icon6.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(14, 1, 'App\\Models\\TrainingProgram', 7, 'وصف البطاقة 7 باللغة العربية.', 'Description of Card 7 in English.', 'icon7.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(15, 1, 'App\\Models\\CommunityImpact', 1, 'وصف البطاقة 1 باللغة العربية.', 'Description of Card 1 in English.', 'icon1.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(16, 1, 'App\\Models\\CommunityImpact', 2, 'وصف البطاقة 2 باللغة العربية.', 'Description of Card 2 in English.', 'icon2.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(17, 1, 'App\\Models\\CommunityImpact', 3, 'وصف البطاقة 3 باللغة العربية.', 'Description of Card 3 in English.', 'icon3.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(18, 1, 'App\\Models\\CommunityImpact', 4, 'وصف البطاقة 4 باللغة العربية.', 'Description of Card 4 in English.', 'icon4.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(19, 1, 'App\\Models\\CurrentProject', 1, 'وصف البطاقة 1 باللغة العربية.', 'Description of Card 1 in English.', 'icon1.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(20, 1, 'App\\Models\\CurrentProject', 2, 'وصف البطاقة 2 باللغة العربية.', 'Description of Card 2 in English.', 'icon2.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(21, 1, 'App\\Models\\CurrentProject', 3, 'وصف البطاقة 3 باللغة العربية.', 'Description of Card 3 in English.', 'icon3.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58'),
(22, 1, 'App\\Models\\CurrentProject', 4, 'وصف البطاقة 4 باللغة العربية.', 'Description of Card 4 in English.', 'icon4.png', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `professional_appreciation_groups`
--

CREATE TABLE `professional_appreciation_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_appreciation_groups`
--

INSERT INTO `professional_appreciation_groups` (`id`, `title_ar`, `title_en`, `created_at`, `updated_at`) VALUES
(2, 'عنوان التقدير المهني باللغة العربية', 'Professional Appreciation Title in English', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_tokens`
--

CREATE TABLE `reset_password_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_medias`
--

CREATE TABLE `social_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL COMMENT 'Name of the social media platform',
  `name_en` varchar(255) NOT NULL COMMENT 'Name of the social media platform in English',
  `link` varchar(255) DEFAULT NULL COMMENT 'Link to the social media platform',
  `icon` varchar(255) DEFAULT NULL COMMENT 'Icon of the social media platform',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Status of the social media platform, 1 for active, 0 for inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_medias`
--

INSERT INTO `social_medias` (`id`, `name_ar`, `name_en`, `link`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'واتساب', 'WhatsApp', 'https://www.whatsapp.com', 'whatsapp.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26'),
(2, 'فيسبوك', 'Facebook', 'https://www.facebook.com', 'facebook.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26'),
(3, 'انستجرام', 'Instegram', 'https://www.instagram.com', 'instagram.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26'),
(4, 'تيليجرام', 'Telegram', 'https://www.telegram.com', 'telegram.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26'),
(5, 'جيميل', 'Gmail', 'https://www.gmail.com', 'gmail.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26'),
(6, 'تيك توك', 'TikTok', 'https://www.tiktok.com', 'tiktok.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26'),
(7, 'يوتيوب', 'YouTube', 'https://www.youtube.com', 'youtube.png', 1, '2025-08-07 17:35:26', '2025-08-07 17:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `content_ar` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `title_ar`, `title_en`, `content_ar`, `content_en`, `created_at`, `updated_at`) VALUES
(1, 'الشروط والأحكام', 'Terms and Conditions', 'محتوى الشروط والأحكام باللغة العربية.', 'Content of the terms and conditions in English.', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

CREATE TABLE `training_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_ar` varchar(255) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`id`, `title_ar`, `title_en`, `description_ar`, `description_en`, `created_at`, `updated_at`) VALUES
(1, 'برنامج التدريب', 'Training Program', 'وصف برنامج التدريب باللغة العربية.', 'Description of the training program in English.', '2025-08-07 17:32:58', '2025-08-07 17:32:58');

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
(1, 'Habeba', 'eng.ahmedkamal357@gmail.com', '2025-08-18 23:53:52', '$2y$12$NKiMCaEjO05ztUQ.DVNlkebV7DumpwkcKvi/8GLuq9FkJDDMDyP7a', NULL, NULL, '2025-08-01 21:35:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopted_methodologies`
--
ALTER TABLE `adopted_methodologies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_impacts`
--
ALTER TABLE `community_impacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_impact_images`
--
ALTER TABLE `community_impact_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `community_impact_images_community_impact_id_foreign` (`community_impact_id`);

--
-- Indexes for table `current_projects`
--
ALTER TABLE `current_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hero_section`
--
ALTER TABLE `hero_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instegram_broadcasts`
--
ALTER TABLE `instegram_broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_vision_mission`
--
ALTER TABLE `my_vision_mission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professional_appreciation_cards`
--
ALTER TABLE `professional_appreciation_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cardable_position_unique` (`cardable_id`,`cardable_type`,`position`);

--
-- Indexes for table `professional_appreciation_groups`
--
ALTER TABLE `professional_appreciation_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password_tokens`
--
ALTER TABLE `reset_password_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_medias`
--
ALTER TABLE `social_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
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
-- AUTO_INCREMENT for table `adopted_methodologies`
--
ALTER TABLE `adopted_methodologies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `community_impacts`
--
ALTER TABLE `community_impacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `community_impact_images`
--
ALTER TABLE `community_impact_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `current_projects`
--
ALTER TABLE `current_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_section`
--
ALTER TABLE `hero_section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `instegram_broadcasts`
--
ALTER TABLE `instegram_broadcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `my_vision_mission`
--
ALTER TABLE `my_vision_mission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professional_appreciation_cards`
--
ALTER TABLE `professional_appreciation_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `professional_appreciation_groups`
--
ALTER TABLE `professional_appreciation_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reset_password_tokens`
--
ALTER TABLE `reset_password_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_medias`
--
ALTER TABLE `social_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `community_impact_images`
--
ALTER TABLE `community_impact_images`
  ADD CONSTRAINT `community_impact_images_community_impact_id_foreign` FOREIGN KEY (`community_impact_id`) REFERENCES `community_impacts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
