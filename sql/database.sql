-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 09:05 AM
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
-- Database: `quland_cms_laravel_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_image` varchar(255) NOT NULL,
  `seo_image` varchar(255) NOT NULL,
  `seo_signature` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `about_image`, `seo_image`, `seo_signature`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/about_image--2024-07-10-02-06-21-1129.webp', 'uploads/custom-images/seo_image--2024-07-10-01-33-31-3266.webp', 'uploads/custom-images/seo_signature--2024-07-10-01-32-53-1689.webp', NULL, '2024-07-10 08:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `about_us_translations`
--

CREATE TABLE `about_us_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_us_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `item1` text NOT NULL,
  `item2` text NOT NULL,
  `item3` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_translations`
--

INSERT INTO `about_us_translations` (`id`, `about_us_id`, `lang_code`, `short_title`, `title`, `description`, `item1`, `item2`, `item3`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'About Company', 'Join World\'s Best Marketplace for Workers', '<p class=\"about-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis molestie mi ut arcu conde consequat erat iaculis. Duis quam lorem, bibendum at bibendum ut, auctor a ligula. Alv dolor urna. Proin rutrum lobortis vulputate. Suspendisse tincidunt urna et odio egestas tum. Class aptent taciti sociosqu ad litora torquen. Interdum et malesuada fames ac eu consequat. Nunc facilisis porttitor odio eu finibus.</p>', 'Modern Technology', 'Insured and Bonded', 'One-off, weekly or fortnightly visits', NULL, '2024-05-15 10:53:50'),
(10, 1, 'hd', 'About Company', 'Join World\'s Best Marketplace for Workers', '<p class=\"about-desc\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis molestie mi ut arcu conde consequat erat iaculis. Duis quam lorem, bibendum at bibendum ut, auctor a ligula. Alv dolor urna. Proin rutrum lobortis vulputate. Suspendisse tincidunt urna et odio egestas tum. Class aptent taciti sociosqu ad litora torquen. Interdum et malesuada fames ac eu consequat. Nunc facilisis porttitor odio eu finibus.</p>', 'Modern Technology', 'Insured and Bonded', 'One-off, weekly or fortnightly visits', '2024-07-10 05:34:58', '2024-07-10 05:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enable',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `admin_type` varchar(20) NOT NULL DEFAULT 'super_admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `designation`, `facebook`, `linkedin`, `twitter`, `instagram`, `about_me`, `image`, `admin_type`) VALUES
(4, 'John Deo', 'admin@gmail.com', NULL, '$2y$10$vGITn.I/eQwPG/oKAdP3Yu/Dr.MdNTL9yaF8ZkWdRN.bEGbZljiRW', 'enable', NULL, '2025-07-22 06:58:49', '2025-09-09 04:42:34', 'Owner', 'https://www.fb.com', 'https://www.linkedin.com/', 'https://x.com/?lang=en', 'https://www.instagram.com/accounts/login/?hl=en', 'Welcome the digital realm where innovation meets excellence Company, embark on a relentless journey to redefine the landscape', 'uploads/website-images/john-deo-2025-09-09-10-42-33-2854.png', 'super_admin');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `blog_category_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `show_homepage` varchar(255) NOT NULL DEFAULT 'no',
  `is_popular` varchar(255) NOT NULL DEFAULT 'no',
  `tags` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `slug`, `image`, `admin_id`, `blog_category_id`, `views`, `status`, `show_homepage`, `is_popular`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'innovative-customer-engagement-in-modern-business', 'uploads/custom-images/blog--2025-02-22-04-13-34-8808.webp', 4, 4, 0, 1, 'no', '0', '[{\"value\":\"Digital\"},{\"value\":\"Technology\"},{\"value\":\"Cyber Security\"},{\"value\":\"Business\"},{\"value\":\"IT Solution\"}]', '2025-10-10 09:10:19', '2025-02-22 10:55:10'),
(2, 'the-future-of-customer-experience-staying-ahead-in-business', 'uploads/custom-images/blog--2025-02-22-04-20-28-1729.webp', 4, 4, 0, 1, 'no', '0', '[{\"value\":\"Software\"},{\"value\":\"Cyber Security\"},{\"value\":\"Technology\"},{\"value\":\"Digital\"},{\"value\":\"IT Solution\"}]', '2025-10-10 09:10:19', '2025-02-22 10:54:08'),
(3, 'building-brand-loyalty-with-proactive-customer-support', 'uploads/custom-images/blog--2025-02-22-04-22-30-2480.webp', 4, 5, 0, 1, 'no', '0', '[{\"value\":\"Cyber Security\"},{\"value\":\"Technology\"},{\"value\":\"Finance IT Solution\"}]', '2025-10-10 09:10:19', '2025-02-22 10:53:18'),
(4, 'technology-support-allows-erie-nonprofit-to-serve', 'uploads/custom-images/blog--2025-02-22-04-24-33-7354.webp', 4, 4, 0, 1, 'no', '0', '[{\"value\":\"Business\"},{\"value\":\"Technology\"},{\"value\":\"Cyber Security\"},{\"value\":\"Software\"},{\"value\":\"Finance\"}]', '2025-10-10 09:10:19', '2025-02-22 10:52:09'),
(5, 'core-on-web-vitals-a-smas-magazine-case-study', 'uploads/custom-images/blog--2025-02-22-04-25-44-2024.webp', 4, 4, 0, 1, 'no', '0', '[{\"value\":\"Finance\"},{\"value\":\"Software\"},{\"value\":\"Cyber Security\"},{\"value\":\"Technology\"},{\"value\":\"IT Solution\"}]', '2025-10-10 09:10:19', '2025-02-22 10:51:16'),
(6, 'human-capital-cost-trends', 'uploads/custom-images/blog--2025-02-22-04-26-31-7673.webp', 4, 4, 0, 1, 'no', '0', '[{\"value\":\"Software\"},{\"value\":\"Cyber Security\"},{\"value\":\"Technology\"},{\"value\":\"Finance\"},{\"value\":\"IT Solution\"}]', '2025-10-10 09:10:19', '2025-08-10 05:21:36'),
(7, 'labor-expense-optimization-strategies', 'uploads/custom-images/blog--2025-08-10-11-20-39-4702.webp', 4, 7, 0, 1, 'no', '0', '[{\"value\":\"Business\"},{\"value\":\"IT Solution\"},{\"value\":\"Technology\"},{\"value\":\"Cyber Security\"},{\"value\":\"Software\"},{\"value\":\"Finance\"}]', '2025-10-10 09:10:19', '2025-08-10 05:20:39'),
(8, 'people-the-office-analyzing-checking-finance-graphs', 'uploads/custom-images/blog--2025-08-10-11-05-33-5541.webp', 4, 4, 0, 1, 'no', '0', '[{\"value\":\"Finance\"},{\"value\":\"Software\"},{\"value\":\"Cyber Security\"},{\"value\":\"Technology\"}]', '2025-10-10 09:10:19', '2025-08-10 05:05:34'),
(10, 'workforce-cost-management-insights', 'uploads/custom-images/blog--2025-08-10-11-17-27-5544.webp', 4, 6, 0, 1, 'no', '0', '[{\"value\":\"Finance\"},{\"value\":\"Software\"},{\"value\":\"Cyber Security\"},{\"value\":\"Technology\"}]', '2025-10-10 09:10:19', '2025-08-10 05:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'design-branding', 1, '2024-07-10 09:06:01', '2025-08-10 05:08:45'),
(4, 'it-design-solutions', 1, '2024-07-10 09:06:28', '2025-08-10 05:08:34'),
(5, 'seo-optimizations', 1, '2024-07-10 09:06:41', '2025-08-10 05:08:14'),
(6, 'marketing', 1, '2025-02-22 10:32:27', '2025-02-22 10:32:27'),
(7, 'web-design-development', 1, '2025-02-22 10:32:40', '2025-08-10 05:07:52'),
(8, 'cyber-security', 1, '2025-02-22 10:32:58', '2025-08-10 05:07:27'),
(9, 'digital-marketing', 1, '2025-02-22 10:33:12', '2025-08-10 05:07:09'),
(10, 'uncategorized', 1, '2025-02-22 10:33:23', '2025-02-22 10:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category_translations`
--

CREATE TABLE `blog_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_category_translations`
--

INSERT INTO `blog_category_translations` (`id`, `blog_category_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Design & Branding', '2024-07-10 09:06:01', '2025-08-10 05:08:45'),
(7, 4, 'en', 'IT Design Solutions', '2024-07-10 09:06:28', '2025-08-10 05:08:34'),
(9, 5, 'en', 'SEO Optimizations', '2024-07-10 09:06:41', '2025-08-10 05:08:14'),
(11, 6, 'en', 'Marketing', '2025-02-22 10:32:27', '2025-02-22 10:32:27'),
(13, 7, 'en', 'Web Design & Development', '2025-02-22 10:32:40', '2025-08-10 05:07:52'),
(15, 8, 'en', 'Cyber Security', '2025-02-22 10:32:58', '2025-08-10 05:07:27'),
(17, 9, 'en', 'Digital Marketing', '2025-02-22 10:33:12', '2025-08-10 05:07:09'),
(19, 10, 'en', 'Uncategorized', '2025-02-22 10:33:23', '2025-02-22 10:33:23'),
(45, 1, 'esp', 'Design & Branding', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(46, 4, 'esp', 'IT Design Solutions', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(47, 5, 'esp', 'SEO Optimizations', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(48, 6, 'esp', 'Marketing', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(49, 7, 'esp', 'Web Design & Development', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(50, 8, 'esp', 'Cyber Security', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(51, 9, 'esp', 'Digital Marketing', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(52, 10, 'esp', 'Uncategorized', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `name`, `email`, `phone`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'David Simmonsss', 'david@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2024-07-15 10:01:30', '2024-07-15 10:02:15'),
(5, 2, 'David Richard', 'user@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2024-07-15 10:01:46', '2024-07-15 10:02:16'),
(6, 2, 'David Warner', 'david@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2024-07-15 10:02:11', '2024-07-15 10:02:16'),
(7, 1, 'Mahe Karim', 'rashedadnaan@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2024-12-31 09:35:43', '2024-12-31 09:35:43'),
(8, 3, 'Suhail Husain', 'suhail@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:18:39', '2025-02-22 11:20:10'),
(9, 3, 'David Richard', 'ichard@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:19:50', '2025-02-22 11:20:09'),
(10, 2, 'David Richard', 'sidar@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:23:58', '2025-02-22 11:36:25'),
(11, 2, 'Nawyantong', 'nawyantong@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:24:58', '2025-02-22 11:36:25'),
(12, 4, 'Suhail Husain', 'sohail@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:25:47', '2025-02-22 11:36:17'),
(13, 4, 'David Richard', 'jar@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:26:28', '2025-02-22 11:36:17'),
(14, 5, 'David Richard', 'kari@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:27:51', '2025-02-22 11:36:16'),
(15, 5, 'Nayem Husain', 'nayem@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:28:56', '2025-02-22 11:36:14'),
(16, 6, 'Alvantan Khan', 'khan@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-02-22 11:30:15', '2025-02-22 11:36:14'),
(17, 6, 'Nawyantong', 'yajka@gmail.com', NULL, 'Providing examples of companies excelling in proactive customer service would strengthen this discussion.', 1, '2025-02-22 11:30:50', '2025-02-22 11:36:13'),
(18, 7, 'Michael James', 'james@gmail.com', NULL, 'Addressing the challenges businesses face in implementing proactive customer experience strategies would provide a more balanced perspective.', 1, '2025-02-22 11:32:53', '2025-02-22 11:36:12'),
(19, 7, 'Henry Joseph', 'joseph@gmail.com', NULL, 'Balancing automation and human touch is essential for a successful customer experience.', 1, '2025-02-22 11:33:45', '2025-02-22 11:36:11'),
(20, 8, 'Daniel Christopher', 'daniel@gmail.com', NULL, 'Adding real-life case studies would make this discussion even more impactful.', 1, '2025-02-22 11:35:06', '2025-02-22 11:36:10'),
(21, 8, 'Nathan Alexander', 'nathan@gmail.com', NULL, 'Exploring how small businesses can adopt proactive customer experience strategies would add great value.', 1, '2025-02-22 11:35:58', '2025-02-22 11:36:09'),
(22, 6, 'Daniel Christopher', 'daniel@gmail.com', NULL, 'Exploring how small businesses can adopt proactive customer experience strategies would add great value.', 1, '2025-02-22 11:38:46', '2025-02-22 11:39:53'),
(23, 10, 'Kamal Uddin', 'client@gmail.com', NULL, 'Exploring how small businesses can adopt proactive customer experience strategies would add great value.', 1, '2025-07-29 06:16:04', '2025-08-10 07:07:23'),
(24, 10, 'Junayed Alam', 'user@gmail.com', NULL, 'Exploring how small businesses can adopt proactive customer experience strategies would add great value.', 1, '2025-07-29 06:18:16', '2025-07-29 06:23:05'),
(25, 10, 'Nur Alam', 'client@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-08-07 04:07:34', '2025-08-07 04:08:15'),
(26, 1, 'Michael S. Manning', 'user@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-08-10 07:03:35', '2025-08-10 07:03:53'),
(27, 8, 'Michael S. Manning', 'user@gmail.com', NULL, 'Exploring how small businesses can adopt proactive customer experience strategies would add great value.', 1, '2025-08-10 07:05:36', '2025-08-10 07:05:41'),
(28, 3, 'Michael S. Manning', 'user@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-08-10 07:07:10', '2025-08-10 07:07:21'),
(29, 4, 'Ibrahim Khalil', 'user@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-08-10 07:08:12', '2025-08-10 07:08:26'),
(30, 5, 'Junayed Khan', 'user@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-08-10 08:03:30', '2025-08-10 08:03:37'),
(31, 7, 'kamal Hossain', 'client@gmail.com', NULL, 'Addressing the challenges businesses face in implementing proactive customer experience strategies would provide a more balanced perspective.', 1, '2025-08-10 08:06:49', '2025-08-10 08:07:00'),
(32, 10, 'Hasan', 'hasan@gmail.com', NULL, 'testing', 0, '2025-08-11 03:35:54', '2025-08-11 03:35:54'),
(33, 1, 'Nur Alam', 'nirob@gmail.com', NULL, 'Our team is comprised of seasoned professionals, each bringing a wealth of experience expertise to the table with years of dedicated service in their respective', 1, '2025-10-16 04:35:50', '2025-10-16 04:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `short_description` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `blog_id`, `lang_code`, `title`, `description`, `short_description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Innovative Customer Engagement in Modern Business', '<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.<br><br>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.<br><br>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>', 'In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide.', 'Innovative Customer Engagement in Modern Business', 'Innovative Customer Engagement in Modern Business', '2024-07-10 09:10:19', '2025-07-29 03:15:43'),
(3, 2, 'en', 'The Future of Customer Experience: Staying Ahead in Business', '<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br></li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>', 'In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide.', 'The Future of Customer Experience: Staying Ahead in Business', 'The Future of Customer Experience: Staying Ahead in Business', '2024-07-15 09:41:32', '2025-07-29 03:15:34'),
(5, 3, 'en', 'Building Brand Loyalty with Proactive Customer Support', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</li>\r\n</ul>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>', 'In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide.', 'Building Brand Loyalty with Proactive Customer Support', 'Building Brand Loyalty with Proactive Customer Support', '2024-07-15 09:43:46', '2025-07-29 03:15:23'),
(7, 4, 'en', 'Technology support allows erie non-profit to serve', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br></li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>', 'In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide.', 'Technology support allows erie non-profit to serve', 'Technology support allows erie non-profit to serve', '2024-07-15 09:45:37', '2025-07-29 03:15:07'),
(9, 5, 'en', 'Core on web vitals, a smas magazine case study', '<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n</ul>\r\n<p><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.<br><br>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.<br><br>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>', 'In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide.', 'Core on web vitals, a smas magazine case study', 'Core on web vitals, a smas magazine case study', '2024-07-15 09:48:08', '2025-07-29 03:14:57'),
(11, 6, 'en', 'Human Capital Cost Trends', '<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.<br><br>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.<br><br>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>', 'Meet our Support Engineer, the backbone of our technical assistance and customer satisfaction. Armed with a robust blend of technical acumen and exceptional problem-solving skills, our Support dedicated', 'Human Capital Cost Trends', 'Human Capital Cost Trends', '2024-07-15 09:49:50', '2025-08-10 05:21:36'),
(13, 7, 'en', 'Labor Expense Optimization Strategies', '<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br></li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>', 'Meet our Support Engineer, the backbone of our technical assistance and customer satisfaction. Armed with a robust blend of technical acumen and exceptional problem-solving skills, our Support dedicated', 'Labor Expense Optimization Strategies', 'Labor Expense Optimization Strategies', '2024-07-15 09:54:05', '2025-08-10 05:20:39'),
(15, 8, 'en', 'People The Office Analyzing Checking Finance Graphs', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n</ul>\r\n<p><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>', 'Meet our Support Engineer, the backbone of our technical assistance and customer satisfaction. Armed with a robust blend of technical acumen and exceptional problem-solving skills, our Support dedicatedccess resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide.', 'Planning your online business goals with a specialist', 'Planning your online business goals with a specialist', '2024-07-15 09:56:42', '2025-08-10 05:16:02'),
(19, 10, 'en', 'Workforce Cost Management Insights', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n</ul>\r\n<p><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>', 'Meet our Support Engineer, the backbone of our technical assistance and customer satisfaction. Armed with a robust blend of technical acumen and exceptional problem-solving skills, our Support dedicated', 'Workforce Cost Management Insights', 'Workforce Cost Management Insights', '2024-07-15 09:56:42', '2025-08-10 05:19:30'),
(50, 1, 'esp', 'Innovative Customer Engagement in Modern Business', '<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.<br><br>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.<br><br>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>', NULL, 'Innovative Customer Engagement in Modern Business', 'Innovative Customer Engagement in Modern Business', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(51, 2, 'esp', 'The Future of Customer Experience: Staying Ahead in Business', '<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br></li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>', NULL, 'The Future of Customer Experience: Staying Ahead in Business', 'The Future of Customer Experience: Staying Ahead in Business', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(52, 3, 'esp', 'Building Brand Loyalty with Proactive Customer Support', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</li>\r\n</ul>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>', NULL, 'Building Brand Loyalty with Proactive Customer Support', 'Building Brand Loyalty with Proactive Customer Support', '2025-09-09 07:13:42', '2025-09-09 07:13:42');
INSERT INTO `blog_translations` (`id`, `blog_id`, `lang_code`, `title`, `description`, `short_description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(53, 4, 'esp', 'Technology support allows erie non-profit to serve', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br></li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>', NULL, 'Technology support allows erie non-profit to serve', 'Technology support allows erie non-profit to serve', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(54, 5, 'esp', 'Core on web vitals, a smas magazine case study', '<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n</ul>\r\n<p><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.<br><br>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.<br><br>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>', NULL, 'Core on web vitals, a smas magazine case study', 'Core on web vitals, a smas magazine case study', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(55, 6, 'esp', 'Human Capital Cost Trends', '<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.<br><br>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.<br><br>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>', NULL, 'Human Capital Cost Trends', 'Human Capital Cost Trends', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(56, 7, 'esp', 'Labor Expense Optimization Strategies', '<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>One of the key benefits of cloud computing is its global reach, enabling businesses to expand their operations beyond geographical boundaries. With cloud-based solutions, teams can collaborate in real-time from anywhere in the world, breaking down communication barriers and fostering a more connected and productive workforce. This global accessibility not only enhances business operations but also improves customer service by providing seamless access to products and services on a global scale.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.<br><br></p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n<li><strong>Innovation:</strong> Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.<br><br></li>\r\n</ul>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>', NULL, 'Labor Expense Optimization Strategies', 'Labor Expense Optimization Strategies', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(57, 8, 'esp', 'People The Office Analyzing Checking Finance Graphs', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n</ul>\r\n<p><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>', NULL, 'Planning your online business goals with a specialist', 'Planning your online business goals with a specialist', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(58, 10, 'esp', 'Workforce Cost Management Insights', '<p>In today\'s digital age, cloud computing has revolutionized the way businesses operate and store their data. With the ability to access resources and applications over the internet, cloud computing offers unparalleled flexibility, scalability, and cost-efficiency for organizations worldwide. From small startups to large enterprises, businesses are leveraging the power of the cloud to streamline operations, improve collaboration, and drive innovation.</p>\r\n<p>Cloud computing provides businesses with the agility to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance. This flexibility enables companies to respond quickly to changing market conditions, launch new products and services faster, and stay ahead of the competition. Additionally, the pay-as-you-go model of cloud services allows organizations to pay only for the resources they use, reducing overall IT costs and maximizing operational efficiency.</p>\r\n<p>Moreover, cloud computing empowers companies to innovate and experiment with emerging technologies without the constraints of traditional IT infrastructure. From machine learning and artificial intelligence to Internet of Things (IoT) applications, the cloud provides a platform for organizations to test new ideas, develop custom solutions, and drive digital transformation initiatives. By harnessing the power of cloud-based tools and services, businesses can stay agile, competitive, and future-ready in a rapidly evolving technological landscape.</p>\r\n<ul>\r\n<li><strong>Scalability:</strong>&nbsp;Cloud computing allows businesses to scale resources up or down based on demand, eliminating the need for costly hardware investments and infrastructure maintenance.</li>\r\n<li><strong>Global Reach:</strong>&nbsp;Cloud-based solutions enable teams to collaborate globally in real-time, breaking down communication barriers and fostering a connected workforce.</li>\r\n<li><strong>Cost-Efficiency:</strong>&nbsp;The pay-as-you-go model of cloud services reduces overall IT costs by allowing organizations to pay only for the resources they use.</li>\r\n<li><strong>Security Measures:</strong>&nbsp;Cloud service providers invest in robust security measures to protect data from unauthorized access, breaches, and cyber threats.</li>\r\n</ul>\r\n<p><strong>Innovation:</strong>&nbsp;Cloud computing empowers businesses to experiment with emerging technologies and drive digital transformation initiatives without the constraints of traditional IT infrastructure.</p>\r\n<p>In conclusion, cloud computing is a game-changer for businesses looking to enhance their operations on a global scale. By embracing cloud technologies, organizations can optimize efficiency, reduce costs, improve collaboration, strengthen security measures, and drive innovation across all facets of their operations. As businesses continue to navigate the complexities of the digital economy, leveraging the capabilities of cloud computing will be essential for staying agile, resilient, and competitive in an increasingly interconnected world.</p>\r\n<p>Security is a top priority for businesses when it comes to adopting cloud computing solutions. Cloud service providers invest heavily in robust security measures to protect data from unauthorized access, breaches, and cyber threats. By storing data in secure cloud environments, businesses can mitigate risks, ensure compliance with data privacy regulations, and safeguard sensitive information against potential security vulnerabilities.</p>', NULL, 'Workforce Cost Management Insights', 'Workforce Cost Management Insights', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('enable','disable') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'xiaomi', 'enable', '2025-01-13 04:50:58', '2025-01-13 04:51:03'),
(3, 'realme', 'enable', '2025-01-13 05:50:48', '2025-01-13 05:50:48'),
(6, 'samsung', 'enable', '2025-02-22 11:50:07', '2025-02-22 11:50:07'),
(8, 'sony', 'enable', '2025-02-22 11:50:41', '2025-02-22 11:50:41'),
(9, 'lg', 'enable', '2025-02-23 04:51:36', '2025-02-23 04:51:36'),
(10, 'zara', 'enable', '2025-02-23 04:51:57', '2025-02-23 04:51:57'),
(11, 'dove', 'enable', '2025-02-23 04:52:24', '2025-02-23 04:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `brand_translations`
--

CREATE TABLE `brand_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_translations`
--

INSERT INTO `brand_translations` (`id`, `lang_code`, `brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'en', 2, 'Xiaomi', '2025-01-13 04:50:58', '2025-01-13 04:50:58'),
(3, 'en', 3, 'Realme', '2025-01-13 05:50:48', '2025-01-13 05:50:48'),
(9, 'en', 6, 'Samsung', '2025-02-22 11:50:07', '2025-02-22 11:50:07'),
(13, 'en', 8, 'Sony', '2025-02-22 11:50:41', '2025-02-22 11:50:41'),
(15, 'en', 9, 'LG', '2025-02-23 04:51:36', '2025-02-23 04:51:36'),
(17, 'en', 10, 'Zara', '2025-02-23 04:51:57', '2025-02-23 04:51:57'),
(19, 'en', 11, 'Dove', '2025-02-23 04:52:24', '2025-02-23 04:52:24'),
(21, 'esp', 2, 'Xiaomi', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(22, 'esp', 3, 'Realme', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(23, 'esp', 6, 'Samsung', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(24, 'esp', 8, 'Sony', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(25, 'esp', 9, 'LG', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(26, 'esp', 10, 'Zara', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(27, 'esp', 11, 'Dove', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(4, NULL, 'k7UR1pdgACTZbXUImvyyV3NwFhYEQc7nm9UGjBzU', 1, 1, '2025-09-30 05:32:26', '2025-09-30 05:32:26'),
(32, NULL, 'ajYu3qinMCDOY8GRFfltEV1IpheHNLr6PtYiRB2S', 1, 1, '2025-10-20 03:59:14', '2025-10-20 03:59:14'),
(41, 13, 'rKjR009lWRUKkSoQAuvHt5nPYRXnLYPeTxXcf901', 1, 1, '2025-10-20 05:40:33', '2025-10-20 05:40:33'),
(42, 13, '6jrRSy71PnIO4febiUYjBh2AX7RTCIx3Ls50JZ2D', 1, 1, '2025-10-20 05:41:49', '2025-10-20 05:42:04'),
(43, 13, '5dXg51ladDUpIT8TRDfy6sMragftMRF30KTIMX9r', 1, 1, '2025-10-25 06:10:08', '2025-10-25 06:10:57'),
(44, 13, 'u79cJI6wbCtYaa8NRU21420gOv73Wg4E2lHspfLM', 1, 1, '2025-10-28 03:40:17', '2025-10-28 03:53:38'),
(45, 13, 'u79cJI6wbCtYaa8NRU21420gOv73Wg4E2lHspfLM', 2, 1, '2025-10-28 03:40:20', '2025-10-28 03:53:38'),
(46, 15, 'u79cJI6wbCtYaa8NRU21420gOv73Wg4E2lHspfLM', 1, 1, '2025-10-28 05:02:47', '2025-10-28 05:02:47'),
(47, 15, 'yQ7cYjtlgR4G2r4P2EbVLzJe29cWg0wX45C1GNvA', 3, 1, '2025-10-28 05:03:22', '2025-10-28 05:03:22'),
(48, NULL, 'dJtDXjsVSmU9PPqNOcTmgqyghT1LBfb8UAzcYKoa', 2, 1, '2025-11-06 06:43:43', '2025-11-06 06:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `status`, `created_at`, `updated_at`, `icon`) VALUES
(5, 'charger', 'enable', '2024-07-10 05:58:38', '2025-08-10 09:41:44', 'uploads/custom-images/category--2025-08-10-03-41-44-2578.webp'),
(9, 'doorbell', 'enable', '2024-07-10 06:00:17', '2025-08-10 09:41:15', 'uploads/custom-images/category--2025-08-10-03-41-15-9531.webp'),
(10, 'keyboard', 'enable', '2024-07-10 06:00:34', '2025-08-10 09:40:46', 'uploads/custom-images/category--2025-08-10-03-40-46-1372.webp'),
(14, 'cctv', 'enable', '2025-02-22 11:53:12', '2025-08-10 09:40:02', 'uploads/custom-images/category--2025-02-22-05-53-12-1626.webp'),
(15, 'suitcase', 'enable', '2025-02-23 04:40:24', '2025-08-10 09:39:03', 'uploads/custom-images/category--2025-08-10-03-39-03-9377.webp'),
(16, 'sofa-chair', 'enable', '2025-02-23 04:45:49', '2025-08-10 09:39:15', 'uploads/custom-images/category--2025-08-10-03-39-15-6402.webp'),
(17, 'headphone', 'enable', '2025-02-23 04:49:57', '2025-08-10 09:39:31', 'uploads/custom-images/category--2025-08-10-03-39-31-3260.webp'),
(18, 'hand-bag', 'enable', '2025-08-10 09:42:00', '2025-08-10 09:42:15', 'uploads/custom-images/category--2025-08-10-03-42-15-1604.webp'),
(19, 'watch', 'enable', '2025-08-10 09:42:43', '2025-08-10 09:42:43', 'uploads/custom-images/category--2025-08-10-03-42-43-2995.webp'),
(20, 'laptop', 'enable', '2025-08-10 09:43:04', '2025-08-10 09:43:04', 'uploads/custom-images/category--2025-08-10-03-43-04-1120.webp'),
(21, 'bag', 'enable', '2025-08-10 09:43:27', '2025-08-10 09:43:27', 'uploads/custom-images/category--2025-08-10-03-43-27-9040.webp');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `lang_code`, `name`, `created_at`, `updated_at`, `category_id`) VALUES
(9, 'en', 'Charger', '2024-07-10 05:58:38', '2025-08-10 09:41:44', 5),
(17, 'en', 'Doorbell', '2024-07-10 06:00:17', '2025-08-10 09:41:15', 9),
(19, 'en', 'Keyboard', '2024-07-10 06:00:34', '2025-08-10 09:40:46', 10),
(27, 'en', 'CCTV', '2025-02-22 11:53:12', '2025-08-10 09:40:02', 14),
(29, 'en', 'Suitcase', '2025-02-23 04:40:24', '2025-08-10 09:39:03', 15),
(31, 'en', 'Sofa Chair', '2025-02-23 04:45:49', '2025-08-10 09:38:43', 16),
(33, 'en', 'Headphone', '2025-02-23 04:49:57', '2025-08-10 09:38:11', 17),
(35, 'en', 'Hand Bag', '2025-08-10 09:42:00', '2025-08-10 09:42:00', 18),
(37, 'en', 'Watch', '2025-08-10 09:42:43', '2025-08-10 09:42:43', 19),
(39, 'en', 'Laptop', '2025-08-10 09:43:04', '2025-08-10 09:43:04', 20),
(41, 'en', 'Bag', '2025-08-10 09:43:27', '2025-08-10 09:43:27', 21),
(76, 'esp', 'Charger', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 5),
(77, 'esp', 'Doorbell', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 9),
(78, 'esp', 'Keyboard', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 10),
(79, 'esp', 'CCTV', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 14),
(80, 'esp', 'Suitcase', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 15),
(81, 'esp', 'Sofa Chair', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 16),
(82, 'esp', 'Headphone', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 17),
(83, 'esp', 'Hand Bag', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 18),
(84, 'esp', 'Watch', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 19),
(85, 'esp', 'Laptop', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 20),
(86, 'esp', 'Bag', '2025-09-09 07:13:42', '2025-09-09 07:13:42', 21);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `created_at`, `updated_at`, `image`) VALUES
(1, '2024-07-10 06:27:43', '2024-07-10 06:27:43', 'uploads/custom-images/city--2024-07-10-12-27-43-4809.webp'),
(2, '2024-07-10 06:27:56', '2024-07-10 06:27:56', 'uploads/custom-images/city--2024-07-10-12-27-56-3200.webp'),
(3, '2024-07-10 06:28:12', '2024-07-10 06:28:12', 'uploads/custom-images/city--2024-07-10-12-28-12-2224.webp');

-- --------------------------------------------------------

--
-- Table structure for table `city_translations`
--

CREATE TABLE `city_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_translations`
--

INSERT INTO `city_translations` (`id`, `city_id`, `lang_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Dhaka', '2024-07-10 06:27:43', '2024-07-10 06:27:43'),
(3, 2, 'en', 'Noakhali', '2024-07-10 06:27:56', '2024-07-10 06:27:56'),
(5, 3, 'en', 'Chittagong', '2024-07-10 06:28:12', '2024-07-10 06:28:12'),
(16, 1, 'esp', 'Dhaka', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(17, 2, 'esp', 'Noakhali', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(18, 3, 'esp', 'Chittagong', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(9, 'Nirob', 'client@gmail.com', '01798563334', 'sd', '2025-08-30 04:57:16', '2025-08-30 04:57:16'),
(10, 'Nirob', 'client@gmail.com', '01798563334', 'sd', '2025-08-30 04:59:18', '2025-08-30 04:59:18'),
(11, 'Nirob', 'user@gmail.com', '01798563334', 'drgtdf', '2025-08-30 05:01:43', '2025-08-30 05:01:43'),
(12, 'Nirob', 'test@gmail.com', '01798563334', 'drbhf', '2025-08-30 05:03:18', '2025-08-30 05:03:18'),
(13, 'Alam', 'nirob@gmail.com', '0177344258', 'this is a test messages', '2025-10-28 04:32:49', '2025-10-28 04:32:49'),
(14, 'gddf', 'nirob@gmail.com', '234235', 'dsfvdggvdfg', '2025-10-28 05:28:12', '2025-10-28 05:28:12'),
(15, 'sdfs', 'nirob@gmail.com', '32543', 'dfghfhbgb', '2025-10-28 05:29:05', '2025-10-28 05:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `map_code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `phone`, `email`, `phone2`, `email2`, `map_code`, `created_at`, `updated_at`) VALUES
(1, '(+47)1221 09878', 'abdur.rohman2003@gmail.com', '+88 234 567 8992', 'Quland@gmail.com', 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14599.579502735794!2d90.36542960000001!3d23.82233695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1701237009812!5m2!1sen!2sbd', NULL, '2025-10-05 05:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_translations`
--

CREATE TABLE `contact_us_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_us_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `contact_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us_translations`
--

INSERT INTO `contact_us_translations` (`id`, `contact_us_id`, `lang_code`, `address`, `title`, `description`, `contact_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', '55 Road, 2nd block, 3rd Floor Melbourne, Australia', 'Contact Us', 'We peel back the layers uncertainty, uncovering hidden truth that lie beneath the surface of our reality.', 'Contrary to popular belief Lorem Ipsum is not simply random text.It has roots in a piece of classical Latin literature', '2024-01-28 09:47:29', '2025-10-05 05:49:42'),
(30, 1, 'esp', '55 Road, 2.ª cuadra, 3.er piso, Melbourne, Australia', 'Contacta con nosotras', 'Pelamos las capas de incertidumbre y descubrimos la verdad oculta que se encuentra debajo de la superficie de nuestra realidad.', NULL, '2025-10-20 03:40:28', '2025-10-20 03:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `min_purchase_price` decimal(8,2) NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `discount_amount` decimal(8,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'disable',
  `restaurant_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `expired_date`, `min_purchase_price`, `discount_type`, `discount_amount`, `status`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(1, 'Big Deal', 'bigdeal002', '2025-08-20', 40.00, 'percentage', 10.00, 'enable', 0, '2025-08-14 03:32:54', '2025-08-14 04:28:37'),
(2, 'Big Deal 02', 'bigdeal003', '2025-08-16', 40.00, 'amount', 10.00, 'enable', 0, '2025-08-14 04:36:55', '2025-08-14 04:45:39'),
(3, 'Big offer', 'nirob422', '2025-09-10', 40.00, 'percentage', 25.00, 'enable', 0, '2025-08-30 04:28:31', '2025-08-30 04:28:31'),
(4, 'New', 'new', '2025-10-29', 40.00, 'percentage', 20.00, 'enable', 0, '2025-10-19 04:06:04', '2025-10-19 04:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_histories`
--

CREATE TABLE `coupon_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `discount_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_histories`
--

INSERT INTO `coupon_histories` (`id`, `user_id`, `coupon_code`, `coupon_id`, `discount_amount`, `created_at`, `updated_at`) VALUES
(9, 13, 'bigdeal002', 1, 6.00, '2025-08-14 09:18:43', '2025-08-14 09:18:43'),
(10, 13, 'bigdeal002', 1, 6.00, '2025-08-14 09:18:43', '2025-08-14 09:18:43'),
(11, 13, 'bigdeal002', 1, 6.00, '2025-08-14 09:21:08', '2025-08-14 09:21:08'),
(12, 13, 'bigdeal003', 2, 10.00, '2025-08-14 09:24:35', '2025-08-14 09:24:35'),
(13, 13, 'nirob422', 3, 43.75, '2025-08-30 04:31:30', '2025-08-30 04:31:30'),
(14, 13, 'nirob422', 3, 43.75, '2025-08-30 04:31:30', '2025-08-30 04:31:30'),
(15, 13, 'nirob422', 3, 43.75, '2025-08-30 04:31:30', '2025-08-30 04:31:30'),
(16, 13, 'nirob422', 3, 43.75, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(17, 13, 'nirob422', 3, 43.75, '2025-08-30 04:31:32', '2025-08-30 04:31:32'),
(18, 13, 'nirob422', 3, 43.75, '2025-08-30 04:31:32', '2025-08-30 04:31:32'),
(19, 13, 'nirob422', 3, 65.00, '2025-08-30 06:55:02', '2025-08-30 06:55:02'),
(20, 13, 'new', 4, 15.44, '2025-10-19 04:15:26', '2025-10-19 04:15:26'),
(21, 13, 'new', 4, 15.28, '2025-10-20 05:39:54', '2025-10-20 05:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_icon` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL DEFAULT 'no',
  `currency_rate` decimal(8,2) NOT NULL,
  `currency_position` varchar(255) NOT NULL DEFAULT 'before_price',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_code`, `country_code`, `currency_icon`, `is_default`, `currency_rate`, `currency_position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'USD', 'USD', 'USA', '$', 'yes', 1.00, 'before_price', 'active', '2024-05-07 12:20:36', '2024-05-07 12:20:36'),
(8, 'INR', 'INR', 'IN', '₹', 'no', 2.00, 'before_price', 'active', '2024-07-10 05:35:14', '2024-07-10 05:35:14'),
(9, 'NGN', 'NGN', 'NG', '₦', 'no', 3.00, 'before_price', 'active', '2025-08-07 10:05:31', '2025-08-07 10:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_pages`
--

INSERT INTO `custom_pages` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'custom-page-one', 1, '2024-07-10 08:25:59', '2024-07-10 08:25:59'),
(2, 'custom-page-two', 0, '2024-07-10 08:26:08', '2025-08-13 05:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `custom_page_translations`
--

CREATE TABLE `custom_page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_page_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_page_translations`
--

INSERT INTO `custom_page_translations` (`id`, `custom_page_id`, `lang_code`, `page_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Custom Page One', '<h3><strong>1. What is custom page?</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>2. How does work custom page</strong></h3>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h3><strong>Features :</strong></h3>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h3><strong>3. Protect Your Property</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>4. What to Include in Terms and Conditions for Online Stores</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<h3><strong>05.Pricing and Payment Terms</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2024-07-10 08:25:59', '2025-02-26 11:14:40'),
(3, 2, 'en', 'Custom Page Two', '<h3><strong>1. What is custom page?</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>2. How does work custom page</strong></h3>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h3><strong>Features :</strong></h3>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h3><strong>3. Protect Your Property</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>4. What to Include in Terms and Conditions for Online Stores</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<h3><strong>05.Pricing and Payment Terms</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2024-07-10 08:26:08', '2025-02-26 11:15:06'),
(9, 1, 'esp', 'Custom Page One', '<h3><strong>1. What is custom page?</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>2. How does work custom page</strong></h3>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h3><strong>Features :</strong></h3>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h3><strong>3. Protect Your Property</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>4. What to Include in Terms and Conditions for Online Stores</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<h3><strong>05.Pricing and Payment Terms</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(10, 2, 'esp', 'Custom Page Two', '<h3><strong>1. What is custom page?</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriefss asbut also the on leap into a electironc typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andeiss more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>2. How does work custom page</strong></h3>\r\n<p>While it&rsquo;s not legally required for ecommerce websites to have a terms and conditions agreement, adding one will help protect your as sonline business.As terms and conditions are legally enforceable rules, they allow you to set standards for how users interact with your site. Here are some of the major abenefits of including terms and conditions on your ecommerce site:</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the obb1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop.</p>\r\n<h3><strong>Features :</strong></h3>\r\n<ul>\r\n<li>Slim body with metal cover</li>\r\n<li>Latest Intel Core i5-1135G7 processor (4 cores / 8 threads)</li>\r\n<li>8GB DDR4 RAM and fast 512GB PCIe SSD</li>\r\n<li>NVIDIA GeForce MX350 2GB GDDR5 graphics card backlit keyboard, touchpad with gesture support</li>\r\n</ul>\r\n<h3><strong>3. Protect Your Property</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3><strong>4. What to Include in Terms and Conditions for Online Stores</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas&nbsp; Ipsum to make a type specimen book.</p>\r\n<h3><strong>05.Pricing and Payment Terms</strong></h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>Five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sender_name', 'Quland', NULL, '2025-10-28 04:28:19'),
(2, 'mail_host', 'sandbox.smtp.mailtrap.io', NULL, '2025-10-28 04:28:19'),
(3, 'email', 'test@gmail.com', NULL, '2025-10-28 04:28:19'),
(4, 'smtp_username', '1f4fe2aa9b73f3', NULL, '2025-10-28 04:28:19'),
(5, 'smtp_password', 'af27a73ed423c9', NULL, '2025-10-28 04:28:19'),
(6, 'mail_port', '587', NULL, '2025-10-28 04:28:19'),
(7, 'mail_encryption', 'tls', NULL, '2025-10-28 04:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Reset Password', 'Reset Password', '<h4>Dear <strong>{{user_name}}</strong>,</h4><p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p><p><strong>{{reset_link}}</strong></p><p>&nbsp;</p><p>Thank You</p><p>Quland</p>', NULL, '2025-02-26 11:30:42'),
(2, 'Contact Email', 'Contact Email', '<p>Hello there,</p><p><strong>Mr. {{user_name}} </strong>has send a new email to you. See the message description below:</p><p>Email: <strong>{{user_email}}</strong></p><p>Phone: <strong>{{user_phone}}</strong></p><p>Message: <strong>{{message}}</strong></p><p>&nbsp;</p><p>Thank You</p><p>Quland</p>', NULL, '2025-02-26 11:30:54'),
(3, 'NewsLetter Verification', 'NewsLetter Verification', '<h2><strong>Hi there</strong>,</h2><p>Congratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription.&nbsp;</p><p><strong>{{verification_link}}</strong></p><p>&nbsp;</p><p>Thank You</p><p>Quland</p>', NULL, '2025-07-28 06:23:09'),
(4, 'User Verification', 'User Verification', '<p>Dear <strong>{{user_name}}</strong>,</p><p>Congratulations! Your Account has been created successfully. Please Click the following link and Active your Account.</p><p><strong>{{varification_link}}</strong></p><p>&nbsp;</p><p>Thank You</p><p>Quland</p>', NULL, '2025-02-26 11:31:16'),
(5, 'New Order Mail to Client', 'New Order Mail to Client', '<p>Hi&nbsp;{{name}}, Thanks for your new order. Your order has been placed.</p><p>Order Id : {{order_id}}</p><p>Amount : {{amount}}</p>', NULL, '2025-08-14 08:00:49'),
(6, 'Subscription Purchase Mail to Client', 'Your Subscription to {{plan_name}} is Confirmed!', '<p>Hi&nbsp;{{name}},</p>\r\n  <p>Thank you for subscribing to the <strong>{{plan_name}}</strong> plan.</p>\r\n  <p>Here are your subscription details:</p>\r\n  <ul>\r\n    <li><strong>Subscription ID:</strong> {{order_id}}</li>\r\n    <li><strong>Plan:</strong> {{plan_name}}</li>\r\n    <li><strong>Amount Paid:</strong> {{plan_price}}</li>\r\n    <li><strong>Payment Method:</strong> {{payment_method}}</li>\r\n    <li><strong>Payment Status:</strong> {{payment_status}}</li>\r\n    <li><strong>Subscription Status:</strong> {{status}}</li>\r\n    <li><strong>Expiration Date:</strong> {{expiration_date}}</li>\r\n    <li><strong>Transaction ID:</strong> {{transaction}}</li>\r\n  </ul>\r\n  <p>If you have any questions or need assistance, feel free to contact our support team.</p>\r\n  <p>Thanks again,<br>The {{company_name}} Team</p>', NULL, '2025-08-14 08:00:49');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_position`, `created_at`, `updated_at`) VALUES
(2, 'top', '2024-07-15 08:25:58', '2025-08-17 09:40:33'),
(3, 'top', '2024-07-15 08:26:14', '2025-08-17 09:41:46'),
(4, 'top', '2024-07-15 08:26:32', '2024-07-15 08:26:32'),
(5, 'top', '2024-07-15 08:26:48', '2025-08-17 09:42:16'),
(6, 'top', '2024-07-15 08:27:24', '2025-08-17 09:42:40'),
(7, 'top', '2024-07-15 08:27:44', '2025-08-17 09:43:00'),
(8, 'bottom', '2025-08-17 09:43:40', '2025-08-17 09:43:40'),
(9, 'bottom', '2025-08-17 09:44:07', '2025-08-17 09:44:07'),
(10, 'bottom', '2025-08-17 09:44:28', '2025-08-17 09:44:28'),
(11, 'bottom', '2025-08-17 09:45:03', '2025-08-17 09:45:03'),
(12, 'bottom', '2025-08-17 09:46:00', '2025-08-17 09:46:00'),
(13, 'bottom', '2025-08-17 09:46:25', '2025-08-17 09:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `lang_code`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(3, 2, 'en', 'What is digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2024-07-15 08:25:58', '2025-08-10 05:37:19'),
(5, 3, 'en', 'Why is digital marketing important?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2024-07-15 08:26:14', '2025-08-10 05:37:05'),
(7, 4, 'en', 'What are the key components of digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2024-07-15 08:26:32', '2025-08-10 05:36:45'),
(9, 5, 'en', 'What is Search Engine Optimization (SEO)?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2024-07-15 08:26:48', '2025-08-10 05:36:15'),
(11, 6, 'en', 'What is Pay-Per-Click Advertising (PPC)', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2024-07-15 08:27:24', '2025-08-17 09:42:49'),
(13, 7, 'en', 'What is Social Media Marketing (SMM)?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2024-07-15 08:27:44', '2025-08-10 05:35:48'),
(15, 8, 'en', 'What is digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-08-17 09:43:40', '2025-08-17 09:43:40'),
(17, 9, 'en', 'Why is digital marketing important?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-08-17 09:44:07', '2025-08-17 09:44:07'),
(19, 10, 'en', 'What are the key components of digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-08-17 09:44:28', '2025-08-17 09:44:28'),
(21, 11, 'en', 'What is Search Engine Optimization (SEO)?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-08-17 09:45:03', '2025-08-17 09:45:03'),
(23, 12, 'en', 'What is Social Media Marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-08-17 09:46:00', '2025-08-17 09:46:00'),
(25, 13, 'en', 'What is Affiliate Marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-08-17 09:46:25', '2025-08-17 09:46:25'),
(63, 2, 'esp', 'What is digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(64, 3, 'esp', 'Why is digital marketing important?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(65, 4, 'esp', 'What are the key components of digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(66, 5, 'esp', 'What is Search Engine Optimization (SEO)?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(67, 6, 'esp', 'What is Pay-Per-Click Advertising (PPC)', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(68, 7, 'esp', 'What is Social Media Marketing (SMM)?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(69, 8, 'esp', 'What is digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(70, 9, 'esp', 'Why is digital marketing important?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(71, 10, 'esp', 'What are the key components of digital marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(72, 11, 'esp', 'What is Search Engine Optimization (SEO)?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(73, 12, 'esp', 'What is Social Media Marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(74, 13, 'esp', 'What is Affiliate Marketing?', 'However, link building isn\'t merely about quantity; quality and relevance are paramount. High-quality links from reputable websites carry more weight in search engine algorithms, contributing significantly to a website\'s overall SEO performance.', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `playstore` varchar(255) DEFAULT NULL,
  `appstore` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `facebook`, `twitter`, `linkedin`, `instagram`, `copyright`, `address`, `phone`, `email`, `playstore`, `appstore`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com', 'https://www.instagram.com', 'Copyright 2025, Quland. All Rights Reserved.', '55 Street, 2nd block, 3rd Floor Melbourne, Australia', '123-343-4444', 'infoquland@gmail.com', 'https://play.google.com/', 'https://www.apple.com/app-store/', NULL, '2025-08-12 10:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `footer_translations`
--

CREATE TABLE `footer_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `footer_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `about_us` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_translations`
--

INSERT INTO `footer_translations` (`id`, `footer_id`, `lang_code`, `about_us`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'SEO agencies typically work businesses of all sizes across various industries to help them achieve their online', NULL, '2025-08-13 03:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(255) NOT NULL,
  `data_values` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data_translations` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`, `data_translations`) VALUES
(6, 'about.content', '{\"heading\":\"Hello Heading 28bv\",\"description\":\"Tom Hank 2 m\",\"solar_image\":{},\"images\":{\"solar_image\":\"uploads\\/website-images\\/1733563235_solar_image.jpeg\"}}', '2024-12-04 06:21:03', '2024-12-07 09:20:35', NULL),
(7, 'categories.content', '{\"heading\":\"Nah Bhalo nai\"}', '2024-12-04 06:22:01', '2024-12-23 06:46:04', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Nah Bhalo nai\"}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"Nah Bhalo nai\"}}]'),
(8, 'main_demo_hero.content', '{\"heading\":\"We provide professional IT services\",\"description\":\"Delivering tech solutions for your startups\",\"small_description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work with us\",\"left_button_url\":\"\\/contact-us\",\"right_button_text\":\"View Service\",\"right_button_url\":\"services\",\"images\":{\"hero_image\":\"uploads\\/website-images\\/1738735274_hero_image.png\"}}', '2024-12-18 11:58:28', '2025-02-26 09:30:05', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"We provide professional IT services\",\"description\":\"Delivering tech solutions for your startups\",\"small_description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work with us\",\"left_button_url\":\"\\/contact-us\",\"right_button_text\":\"View Service\",\"right_button_url\":\"services\"}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"\\u092e\\u0948\\u0902 \\u0905\\u092a\\u0928\\u0947 \\u0926\\u0947\\u0936 \\u0938\\u0947 \\u092a\\u094d\\u092f\\u093e\\u0930 \\u0915\\u0930\\u0924\\u093e \\u0939\\u0941\\u0901\",\"description\":\"\\u0915\\u094d\\u0935\\u0947\\u0928 \\u0921\\u0940\\u092a\\u0938\\u0940\\u0915 \\u0913\\u092a\\u0928\\u090f\\u0906\\u0908 \\u091c\\u0947\\u092e\\u093f\\u0928\\u0940\",\"small_description\":\"\\u0939\\u092e \\u0915\\u094d\\u0935\\u094b\\u092e\\u094b\\u0921\\u094b \\u0906\\u091c \\u0915\\u0940 \\u091c\\u0930\\u0942\\u0930\\u0924\\u094b\\u0902 \\u0915\\u094b \\u092a\\u0942\\u0930\\u093e \\u0915\\u0930\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0936\\u0915\\u094d\\u0924\\u093f\\u0936\\u093e\\u0932\\u0940 \\u0914\\u0930 \\u0905\\u0928\\u0941\\u0915\\u0942\\u0932\\u0928\\u0940\\u092f \\u0921\\u093f\\u091c\\u093f\\u091f\\u0932 \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928\\u094b\\u0902 \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0905\\u0927\\u093f\\u0915\\u093e\\u0902\\u0936 \\u092a\\u094d\\u0930\\u092e\\u0941\\u0916 \\u0915\\u094d\\u0937\\u0947\\u0924\\u094d\\u0930\\u094b\\u0902 \\u0915\\u0947 \\u0935\\u094d\\u092f\\u0935\\u0938\\u093e\\u092f\\u094b\\u0902 \\u0915\\u094b \\u092c\\u0926\\u0932\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964\",\"left_button_text\":\"\\u092e\\u0947\\u0930\\u0947 \\u0938\\u093e\\u0925 \\u0915\\u093e\\u092e \\u0915\\u0930\\u094b\",\"left_button_url\":\"http:\\/\\/localhost\\/Quland\\/left\",\"right_button_text\":\"\\u0938\\u0947\\u0935\\u093e \\u0926\\u0947\\u0916\\u0947\\u0902\",\"right_button_url\":\"http:\\/\\/localhost\\/Quland\\/right\"}}]'),
(9, 'key_feature.content', '{\"title\":\"Why you should choose us?\",\"heading_1\":\"Highly Expert Team\",\"description_1\":\"We provide the most responsive and functional IT design\",\"service_url_1\":\"service\\/digital-Marketing-Services\",\"heading_2\":\"24\\/7 Customer Service\",\"description_2\":\"We provide the most responsive and functional Qumod\",\"service_url_2\":\"service\\/Web-Mobile-App-Development\",\"heading_3\":\"Competitive Pricing\",\"description_3\":\"We provide the most responsive and functional Qum\",\"service_url_3\":\"service\\/Data-Tracking-Security\",\"images\":{\"image1\":\"uploads\\/website-images\\/1740298247_image1.svg\",\"image2\":\"uploads\\/website-images\\/1740298247_image2.svg\",\"image3\":\"uploads\\/website-images\\/1740560522_image3.svg\"}}', '2024-12-19 09:14:27', '2025-02-26 09:44:22', '[{\"language_code\":\"en\",\"values\":{\"title\":\"Why you should choose us?\",\"heading_1\":\"Highly Expert Team\",\"description_1\":\"We provide the most responsive and functional IT design\",\"service_url_1\":\"service\\/digital-Marketing-Services\",\"heading_2\":\"24\\/7 Customer Service\",\"description_2\":\"We provide the most responsive and functional Qumod\",\"service_url_2\":\"service\\/Web-Mobile-App-Development\",\"heading_3\":\"Competitive Pricing\",\"description_3\":\"We provide the most responsive and functional Qum\",\"service_url_3\":\"service\\/Data-Tracking-Security\"}},{\"language_code\":\"hd\",\"values\":{\"heading_1\":\"\\u0905\\u0924\\u093f\\u0936\\u092f \\u092a\\u0942\\u0930\\u094d\\u0935 \\u0939\\u093f\\u0928\\u094d\\u0926\\u0940\",\"description_1\":\"\\u0939\\u092e \\u0938\\u092c\\u0938\\u0947 \\u0905\\u0927\\u093f\\u0915 \\u0938\\u0902\\u0935\\u0947\\u0926\\u0928\\u0936\\u0940\\u0932 \\u0914\\u0930 \\u0915\\u093e\\u0930\\u094d\\u092f\\u093e\\u0924\\u094d\\u092e\\u0915 \\u0915\\u094d\\u092f\\u0942\\u092e\\u094b\\u0921\\u094b \\u092a\\u094d\\u0930\\u0926\\u093e\\u0928 \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\",\"heading_2\":\"24\\/7 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0938\\u0947\\u0935\\u093e\",\"description_2\":\"\\u0939\\u092e \\u0938\\u092c\\u0938\\u0947 \\u0905\\u0927\\u093f\\u0915 \\u0938\\u0902\\u0935\\u0947\\u0926\\u0928\\u0936\\u0940\\u0932 \\u0914\\u0930 \\u0915\\u093e\\u0930\\u094d\\u092f\\u093e\\u0924\\u094d\\u092e\\u0915 \\u092a\\u094d\\u0930\\u0926\\u093e\\u0928 \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\",\"heading_3\":\"\\u092a\\u094d\\u0930\\u0924\\u093f\\u0938\\u094d\\u092a\\u0930\\u094d\\u0927\\u0940 \\u092e\\u0942\\u0932\\u094d\\u092f \\u0928\\u093f\\u0930\\u094d\\u0927\\u093e\\u0930\\u0923\",\"description_3\":\"\\u0939\\u092e \\u0938\\u092c\\u0938\\u0947 \\u0905\\u0927\\u093f\\u0915 \\u0938\\u0902\\u0935\\u0947\\u0926\\u0928\\u0936\\u0940\\u0932 \\u0914\\u0930 \\u0915\\u093e\\u0930\\u094d\\u092f\\u093e\\u0924\\u094d\\u092e\\u0915 \\u092a\\u094d\\u0930\\u0926\\u093e\\u0928 \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\"}}]'),
(10, 'about_us.content', '{\"heading\":\"nepira english\",\"description\":\"text\",\"button_link\":\"text\",\"image\":{},\"images\":{\"image\":\"uploads\\/website-images\\/1734943931_image.jpg\"}}', '2024-12-23 06:47:17', '2024-12-23 08:52:15', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"nepira english\",\"description\":\"text\",\"button_link\":\"text\",\"image\":[]}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"nepira hindi\",\"description\":\"text\",\"button_link\":\"text\"}}]'),
(11, 'main_demo_about_us.content', '{\"heading\":\"Exclusive technology to provide IT solutions\",\"sub_heading\":\"During this time, we\\u2019ve built a reputation for excellent clients satisfaction as evidenced by our\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"button_text\":\"More About Us\",\"button_link\":\"about-us\",\"left_text\":\"Happy Clients\",\"left_counter\":\"1800\",\"right_text\":\"Finished Projects\",\"right_counter\":\"620\",\"image_1\":{},\"image_2\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740300517_image_1.png\",\"image_2\":\"uploads\\/website-images\\/1740300517_image_2.png\"}}', '2024-12-24 04:48:14', '2025-02-23 08:48:37', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Exclusive technology to provide IT solutions\",\"sub_heading\":\"During this time, we\\u2019ve built a reputation for excellent clients satisfaction as evidenced by our\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"button_text\":\"More About Us\",\"button_link\":\"about-us\",\"left_text\":\"Happy Clients\",\"left_counter\":\"1800\",\"right_text\":\"Finished Projects\",\"right_counter\":\"620\",\"image_1\":{},\"image_2\":{}}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"25+ \\u0935\\u0930\\u094d\\u0937\\u094b\\u0902 \\u0938\\u0947 \\u0905\\u0927\\u093f\\u0915 \\u0938\\u092e\\u092f \\u0938\\u0947 \\u0939\\u092e \\u0906\\u0908\\u091f\\u0940 \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u092a\\u094d\\u0930\\u0926\\u093e\\u0928 \\u0915\\u0930 \\u0930\\u0939\\u0947 \\u0939\\u0948\\u0902\",\"sub_heading\":\"\\u0907\\u0938 \\u0938\\u092e\\u092f \\u0915\\u0947 \\u0926\\u094c\\u0930\\u093e\\u0928, \\u0939\\u092e\\u0928\\u0947 \\u0909\\u0924\\u094d\\u0915\\u0943\\u0937\\u094d\\u091f \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0938\\u0902\\u0924\\u0941\\u0937\\u094d\\u091f\\u093f \\u0915\\u0947 \\u0932\\u093f\\u090f \\u092a\\u094d\\u0930\\u0924\\u093f\\u0937\\u094d\\u0920\\u093e \\u092c\\u0928\\u093e\\u0908 \\u0939\\u0948 \\u091c\\u0948\\u0938\\u093e \\u0915\\u093f \\u0939\\u092e\\u093e\\u0930\\u0947 \\u0926\\u094d\\u0935\\u093e\\u0930\\u093e \\u092a\\u094d\\u0930\\u092e\\u093e\\u0923\\u093f\\u0924 \\u0939\\u0948\",\"description\":\"Teba \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u092c\\u0928\\u093e\\u092f\\u093e \\u0917\\u092f\\u093e \\u092a\\u094d\\u0930\\u0924\\u094d\\u092f\\u0947\\u0915 \\u0921\\u0947\\u092e\\u094b \\u0905\\u0932\\u0917 \\u0926\\u093f\\u0916\\u093e\\u0908 \\u0926\\u0947\\u0917\\u093e\\u0964 \\u0906\\u092a \\u0905\\u092a\\u0928\\u0940 \\u0935\\u0947\\u092c\\u0938\\u093e\\u0907\\u091f \\u0915\\u0947 \\u0938\\u094d\\u0935\\u0930\\u0942\\u092a \\u092e\\u0947\\u0902 \\u0915\\u0941\\u091b \\u092d\\u0940 \\u092c\\u0926\\u0932\\u093e\\u0935 \\u0915\\u0947\\u0935\\u0932 \\u0915\\u0941\\u091b \\u0915\\u094d\\u0932\\u093f\\u0915 \\u0938\\u0947 \\u0915\\u0930 \\u0938\\u0915\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 Teba \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u092c\\u0928\\u093e\\u092f\\u093e \\u0917\\u092f\\u093e \\u092a\\u094d\\u0930\\u0924\\u094d\\u092f\\u0947\\u0915 \\u0921\\u0947\\u092e\\u094b \\u0905\\u0932\\u0917 \\u0926\\u093f\\u0916\\u093e\\u0908 \\u0926\\u0947\\u0917\\u093e\\u0964\",\"button_text\":\"\\u0939\\u092e\\u093e\\u0930\\u0947 \\u092c\\u093e\\u0930\\u0947 \\u092e\\u0947\\u0902 \\u0905\\u0927\\u093f\\u0915 \\u091c\\u093e\\u0928\\u0915\\u093e\\u0930\\u0940\",\"button_link\":\"faq\"}}]'),
(12, 'main_demo_service_section.content', '{\"heading\":\"Our awesome services to give you success\"}', '2024-12-24 05:16:26', '2025-02-23 09:30:07', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Our awesome services to give you success\"}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"\\u0939\\u092e\\u093e\\u0930\\u0940 \\u0936\\u093e\\u0928\\u0926\\u093e\\u0930 \\u0938\\u0947\\u0935\\u093e\\u090f\\u0901 \\u0906\\u092a\\u0915\\u094b \\u0938\\u092b\\u0932\\u0924\\u093e \\u0926\\u093f\\u0932\\u093e\\u090f\\u0902\\u0917\\u0940\"}}]'),
(13, 'how_to_order.content', '{\"heading\":\"text\",\"description\":\"text\",\"button_link\":\"text\",\"video_link\":\"text\",\"image\":{},\"images\":{\"image\":\"uploads\\/website-images\\/1735129123_image.JPG\"}}', '2024-12-25 12:18:43', '2024-12-25 12:18:43', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"text\",\"description\":\"text\",\"button_link\":\"text\",\"video_link\":\"text\",\"image\":{}}}]'),
(14, 'main_demo_cta_section.content', '{\"heading\":\"Let\\u2019s work together\",\"description\":\"Each demo built with Teba will look different. You can customize anything appearance of your website with only a few clicks\",\"button_link\":\"contact-us\",\"button_text\":\"Let\\u2019s Start a Project\"}', '2024-12-26 06:49:24', '2025-02-23 09:02:42', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Let\\u2019s work together\",\"description\":\"Each demo built with Teba will look different. You can customize anything appearance of your website with only a few clicks\",\"button_link\":\"contact-us\",\"button_text\":\"Let\\u2019s Start a Project\"}}]'),
(15, 'main_demo_sidebar_cta_section.content', '{\"heading\":\"Don\'t hesitate to contact\",\"description\":\"At our solution , we are committed to exceptional\",\"button_link\":\"https:\\/\\/Quland-laravel.themedox.com\\/contact-us\",\"button_text\":\"Poke us\"}', '2024-12-26 10:49:17', '2025-03-02 08:29:14', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Don\'t hesitate to contact\",\"description\":\"At our solution , we are committed to exceptional\",\"button_link\":\"https:\\/\\/Quland-laravel.themedox.com\\/contact-us\",\"button_text\":\"Poke us\"}}]'),
(16, 'main_demo_process_section.content', '{\"heading\":\"Our working process on how to grow your business\",\"step_1\":\"Initiation & Planning\",\"step_2\":\"Execution & Development\",\"step_3\":\"Testing & Maintenance\",\"description_1\":\"We are architects innovation trailblazers of technological advancement\",\"description_2\":\"We are architects innovation trailblazers of technological advancement training\",\"description_3\":\"We are architects innovation trailblazers of technological advancement\",\"image_3\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740031728_image_1.svg\",\"image_2\":\"uploads\\/website-images\\/1740031880_image_2.svg\",\"image_3\":\"uploads\\/website-images\\/1740562924_image_3.svg\"}}', '2024-12-26 13:09:05', '2025-02-26 09:42:04', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Our working process on how to grow your business\",\"step_1\":\"Initiation & Planning\",\"step_2\":\"Execution & Development\",\"step_3\":\"Testing & Maintenance\",\"description_1\":\"We are architects innovation trailblazers of technological advancement\",\"description_2\":\"We are architects innovation trailblazers of technological advancement training\",\"description_3\":\"We are architects innovation trailblazers of technological advancement\",\"image_3\":{}}}]'),
(17, 'main_demo_service_success_section.content', '{\"heading\":\"Increasing business success with technology\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"service_name_1\":\"IT Solution & Management\",\"service_percentage_1\":\"86\",\"service_name_2\":\"Website & App Development\",\"service_percentage_2\":\"72\",\"service_name_3\":\"SEO & Digital Marketing\",\"service_percentage_3\":\"83\",\"image_1\":{},\"image_2\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740303450_image_1.png\",\"image_2\":\"uploads\\/website-images\\/1740303450_image_2.png\"}}', '2024-12-28 06:22:04', '2025-02-23 09:37:30', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Increasing business success with technology\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"service_name_1\":\"IT Solution & Management\",\"service_percentage_1\":\"86\",\"service_name_2\":\"Website & App Development\",\"service_percentage_2\":\"72\",\"service_name_3\":\"SEO & Digital Marketing\",\"service_percentage_3\":\"83\",\"image_1\":{},\"image_2\":{}}}]'),
(18, 'main_demo_testimonial_section.content', '{\"heading\":\"Don\\u2019t take our word, see what our customers say\"}', '2024-12-28 11:07:59', '2024-12-28 11:07:59', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Don\\u2019t take our word, see what our customers say\"}}]'),
(19, 'main_demo_blog_section.content', '{\"heading\":\"Recent blog & articles about technology\",\"button_text\":\"View All Posts\"}', '2024-12-28 11:14:57', '2025-02-23 08:54:32', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Recent blog & articles about technology\",\"button_text\":\"View All Posts\"}}]'),
(20, 'expert_feature.content', '{\"heading\":\"Our expert team is always ready horny\",\"images\":{\"image_1\":\"uploads\\/website-images\\/1735541415_image_1.png\",\"image_2\":\"uploads\\/website-images\\/1735541415_image_2.png\",\"image_3\":\"uploads\\/website-images\\/1735541415_image_3.png\",\"image_4\":\"uploads\\/website-images\\/1735541415_image_4.png\"}}', '2024-12-30 06:50:15', '2024-12-30 11:11:06', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Our expert team is always ready horny\"}}]'),
(21, 'expert_feature_section.content', '{\"heading\":\"Our expert team is always ready to help you\"}', '2024-12-30 11:12:19', '2025-02-23 06:33:14', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Our expert team is always ready to help you\"}}]'),
(22, 'contact_us_section.content', '{\"heading\":\"Let\\u2019s build an awesome app together\",\"description\":\"Each demo built look different. You can customize almost anything in the appearance of your website with only a few clicks.\"}', '2024-12-31 11:21:18', '2024-12-31 11:21:18', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Let\\u2019s build an awesome app together\",\"description\":\"Each demo built look different. You can customize almost anything in the appearance of your website with only a few clicks.\"}}]'),
(23, 'it_consulting_hero_section.content', '{\"heading\":\"Optimize your enterprise with our leading guidance\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work with us\",\"form_title\":\"Fill The Contact Form\",\"form_description\":\"Get Free Consultation For IT Solutions\",\"form_button_text\":\"Send Message\",\"hero_image\":{},\"images\":{\"hero_image\":\"uploads\\/website-images\\/1740562824_hero_image.png\"}}', '2025-01-01 10:09:52', '2025-02-26 09:40:24', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Optimize your enterprise with our leading guidance\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work with us\",\"form_title\":\"Fill The Contact Form\",\"form_description\":\"Get Free Consultation For IT Solutions\",\"form_button_text\":\"Send Message\",\"hero_image\":{}}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"Optimize your enterprise data with our RAG System Hindi\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Contact with us\",\"form_title\":\"Fill The Doc\",\"form_description\":\"Get Free Consultation For IT Solutions\",\"form_button_text\":\"Submit Here\"}}]'),
(24, 'it_consulting_counter_section.content', '{\"counter_1\":\"1800\",\"title_1\":\"Happy Clients\",\"counter_2\":\"600\",\"title_2\":\"Finished Projects\",\"counter_3\":\"200\",\"title_3\":\"Skilled Experts\",\"counter_4\":\"26\",\"title_4\":\"Clients Satisfaction\",\"image_2\":{},\"image_3\":{},\"image_4\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740564347_image_1.svg\",\"image_2\":\"uploads\\/website-images\\/1740564385_image_2.svg\",\"image_3\":\"uploads\\/website-images\\/1740564385_image_3.svg\",\"image_4\":\"uploads\\/website-images\\/1740564385_image_4.svg\"}}', '2025-01-01 12:35:41', '2025-02-26 10:06:25', '[{\"language_code\":\"en\",\"values\":{\"counter_1\":\"1800\",\"title_1\":\"Happy Clients\",\"counter_2\":\"600\",\"title_2\":\"Finished Projects\",\"counter_3\":\"200\",\"title_3\":\"Skilled Experts\",\"counter_4\":\"26\",\"title_4\":\"Clients Satisfaction\",\"image_2\":{},\"image_3\":{},\"image_4\":{}}}]'),
(25, 'it_solutions_hero_section.content', '{\"heading\":\"The best innovative tech solutions\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"button_text\":\"Work With Us\",\"hero_image\":{},\"images\":{\"hero_image\":\"uploads\\/website-images\\/1740294799_hero_image.png\"}}', '2025-01-02 06:54:29', '2025-02-23 07:13:19', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"The best innovative tech solutions\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"button_text\":\"Work With Us\",\"hero_image\":{}}}]'),
(26, 'it_solutions_about_us.content', '{\"heading\":\"Exclusive technology to provide IT solutions\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"feature_text_1\":\"Easily Build Custom Reports And Dashboards\",\"feature_text_2\":\"Legacy Software Modernization\",\"feature_text_3\":\"Software For The Open Enterprise\",\"button_text\":\"More About Us\",\"images\":{\"image_1\":\"uploads\\/website-images\\/1739968088_image_1.png\",\"image_2\":\"uploads\\/website-images\\/1739968088_image_2.png\"}}', '2025-01-02 08:24:20', '2025-02-23 07:11:26', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Exclusive technology to provide IT solutions\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"feature_text_1\":\"Easily Build Custom Reports And Dashboards\",\"feature_text_2\":\"Legacy Software Modernization\",\"feature_text_3\":\"Software For The Open Enterprise\",\"button_text\":\"More About Us\"}}]'),
(27, 'contact_form_section.content', '{\"heading\":\"Fill The Contact Form\",\"description\":\"Feel free to contact with us, we don\\u2019t spam your email\",\"button_text\":\"Send Message\"}', '2025-01-02 10:03:02', '2025-02-23 05:56:30', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Fill The Contact Form\",\"description\":\"Feel free to contact with us, we don\\u2019t spam your email\",\"button_text\":\"Send Message\"}}]'),
(28, 'contact_info_section.content', '{\"heading\":\"Let\\u2019s build some awesome project together with AI Image\",\"description\":\"Each demo built will look different. You can customize almost anything in the appearance of your website with only a few clicks.\",\"office_hours\":\"Sat\\u2013 Fri: 10:00 AM \\u2013 06:30 PM\"}', '2025-01-02 10:09:37', '2025-02-23 10:35:31', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Let\\u2019s build some awesome project together with AI Image\",\"description\":\"Each demo built will look different. You can customize almost anything in the appearance of your website with only a few clicks.\",\"office_hours\":\"Sat\\u2013 Fri: 10:00 AM \\u2013 06:30 PM\"}}]'),
(29, 'it_solutions_pricing_section.content', '{\"heading\":\"Explore flexible pricing for you\",\"package_information\":{\"package_1\":{\"title\":\"Startup\",\"description\":\"Best for Startup business owners who needs website for business.\",\"price\":\"99\",\"features\":{\"feature_1\":\"10 GB disk space availability\",\"feature_2\":\"50 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\",\"feature_4\":\"Free lifetime updates facility\",\"feature_5\":\"Free one year support\",\"feature_6\":\"24\\/7 Support\"}},\"package_2\":{\"title\":\"Business\",\"description\":\"Best for Startup business owners who needs website for business.\",\"price\":\"299\",\"features\":{\"feature_1\":\"10 GB disk space availability\",\"feature_2\":\"50 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\",\"feature_4\":\"Free lifetime updates facility\",\"feature_5\":\"Free one year support\",\"feature_6\":\"24\\/7 Support\"}},\"package_3\":{\"title\":\"Enterprise\",\"description\":\"Best for Startup business owners who needs website for business.\",\"price\":\"779\",\"features\":{\"feature_1\":\"100 GB disk space availability\",\"feature_2\":\"1150 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\",\"feature_4\":\"Free lifetime updates facility\",\"feature_5\":\"Free one year support\",\"feature_6\":\"24\\/7 Support\"}}}}', '2025-01-02 11:15:13', '2025-02-23 10:25:15', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Explore flexible pricing for you\",\"package_information\":{\"package_1\":{\"title\":\"Startup\",\"description\":\"Best for Startup business owners who needs website for business.\",\"price\":\"99\",\"features\":{\"feature_1\":\"10 GB disk space availability\",\"feature_2\":\"50 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\",\"feature_4\":\"Free lifetime updates facility\",\"feature_5\":\"Free one year support\",\"feature_6\":\"24\\/7 Support\"}},\"package_2\":{\"title\":\"Business\",\"description\":\"Best for Startup business owners who needs website for business.\",\"price\":\"299\",\"features\":{\"feature_1\":\"10 GB disk space availability\",\"feature_2\":\"50 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\",\"feature_4\":\"Free lifetime updates facility\",\"feature_5\":\"Free one year support\",\"feature_6\":\"24\\/7 Support\"}},\"package_3\":{\"title\":\"Enterprise\",\"description\":\"Best for Startup business owners who needs website for business.\",\"price\":\"779\",\"features\":{\"feature_1\":\"100 GB disk space availability\",\"feature_2\":\"1150 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\",\"feature_4\":\"Free lifetime updates facility\",\"feature_5\":\"Free one year support\",\"feature_6\":\"24\\/7 Support\"}}}}},{\"language_code\":\"hd\",\"values\":{\"heading\":\"Explore flexible pricing Hindi\",\"package_information\":{\"package_1\":{\"title\":\"Startup Hindi\",\"description\":\"Package 1 Description\",\"price\":\"99\",\"features\":{\"feature_1\":\"10 GB disk space availability\",\"feature_2\":\"50 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\"}},\"package_2\":{\"title\":\"Business\",\"description\":\"Social Economic Business\",\"price\":\"299\",\"features\":{\"feature_1\":\"10 GB disk space availability\",\"feature_2\":\"50 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\"}},\"package_3\":{\"title\":\"Enterprise\",\"description\":\"Package 3 Description\",\"price\":\"779\",\"features\":{\"feature_1\":\"100 GB disk space availability\",\"feature_2\":\"1150 GB NVMe SSD for use\",\"feature_3\":\"Free platform access for all\"}}}}}]'),
(30, 'digital_agency_hero_section.content', '{\"heading\":\"We provide professional IT services\",\"title\":\"Software crafting for digital success\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work With Us\",\"right_button_text\":\"View Services\",\"hero_image\":{},\"images\":{\"hero_image\":\"uploads\\/website-images\\/1740311178_hero_image.png\"}}', '2025-01-04 11:15:44', '2025-02-23 11:46:18', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"We provide professional IT services\",\"title\":\"Software crafting for digital success\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work With Us\",\"right_button_text\":\"View Services\",\"hero_image\":{}}}]'),
(31, 'customer_brand_section.content', '{\"heading\":\"Empowered professionals to connect with top-tier opportunities\",\"image_6\":{},\"image_7\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740290298_image_1.svg\",\"image_2\":\"uploads\\/website-images\\/1740290323_image_2.svg\",\"image_3\":\"uploads\\/website-images\\/1740290669_image_3.svg\",\"image_4\":\"uploads\\/website-images\\/1740290669_image_4.svg\",\"image_5\":\"uploads\\/website-images\\/1740290669_image_5.svg\",\"image_6\":\"uploads\\/website-images\\/1740290787_image_6.svg\",\"image_7\":\"uploads\\/website-images\\/1740290787_image_7.svg\"}}', '2025-01-04 12:06:26', '2025-02-23 06:06:27', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Empowered professionals to connect with top-tier opportunities\",\"image_6\":{},\"image_7\":{}}}]'),
(32, 'digital_agency_feature_section.content', '{\"heading\":\"Providing IT solutions & services for SaaS\",\"feature_1_heading\":\"Quality Solution for SaaS\",\"feature_2_heading\":\"Amazing Expert Teams\",\"feature_3_heading\":\"Urgent Support For Clients\",\"feature_1_url\":\"contact-us\",\"feature_2_url\":\"services\",\"feature_3_url\":\"about-us\",\"feature_description_1\":\"Each demo built will look different. customize almost anything in the appearance of your\",\"feature_description_2\":\"Each demo built will look different. customize almost anything in the appearance of your\",\"feature_description_3\":\"Each demo built will look different. customize almost anything in the appearance of your\",\"image_4\":{},\"image_5\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1739968482_image_1.png\",\"image_2\":\"uploads\\/website-images\\/1739968482_image_2.png\",\"image_3\":\"uploads\\/website-images\\/1739968636_image_3.svg\",\"image_4\":\"uploads\\/website-images\\/1739968670_image_4.svg\",\"image_5\":\"uploads\\/website-images\\/1739968670_image_5.svg\"}}', '2025-01-04 12:36:09', '2025-02-19 12:37:50', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Providing IT solutions & services for SaaS\",\"feature_1_heading\":\"Quality Solution for SaaS\",\"feature_2_heading\":\"Amazing Expert Teams\",\"feature_3_heading\":\"Urgent Support For Clients\",\"feature_1_url\":\"contact-us\",\"feature_2_url\":\"services\",\"feature_3_url\":\"about-us\",\"feature_description_1\":\"Each demo built will look different. customize almost anything in the appearance of your\",\"feature_description_2\":\"Each demo built will look different. customize almost anything in the appearance of your\",\"feature_description_3\":\"Each demo built will look different. customize almost anything in the appearance of your\",\"image_4\":{},\"image_5\":{}}}]'),
(33, 'digital_agency_faqs.content', '{\"heading\":\"Have any questions? here some answers\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only\",\"button_text\":\"Ask Any Question\"}', '2025-01-05 06:35:16', '2025-02-23 06:11:40', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Have any questions? here some answers\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only\",\"button_text\":\"Ask Any Question\"}}]'),
(34, 'startup_home_hero_section.content', '{\"heading\":\"We provide professional IT services\",\"description\":\"Best IT services for your agency\",\"small_description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work With Us\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"View Services\",\"right_button_url\":\"services\",\"images\":{\"hero_image\":\"uploads\\/website-images\\/1740304257_hero_image.png\"}}', '2025-01-05 12:55:30', '2025-02-23 10:22:49', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"We provide professional IT services\",\"description\":\"Best IT services for your agency\",\"small_description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work With Us\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"View Services\",\"right_button_url\":\"services\"}}]'),
(35, 'startup_home_about_us.content', '{\"heading\":\"We provide perfect IT solutions & technology\",\"sub_heading\":\"During this time, we\\u2019ve built a reputation for excellent clients satisfaction as evidenced by our\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"left_text\":\"Provide Skills Services\",\"right_text\":\"Urgent Support For Clients\",\"images\":{\"image_1\":\"uploads\\/website-images\\/1739967918_image_1.png\",\"image_2\":\"uploads\\/website-images\\/1739967918_image_2.png\"}}', '2025-01-06 04:54:56', '2025-02-23 09:46:38', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"We provide perfect IT solutions & technology\",\"sub_heading\":\"During this time, we\\u2019ve built a reputation for excellent clients satisfaction as evidenced by our\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"left_text\":\"Provide Skills Services\",\"right_text\":\"Urgent Support For Clients\"}}]'),
(36, 'tech_agency_hero_section.content', '{\"heading\":\"Delivering tech solutions for your startups\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work With Us\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"Our Services\",\"right_button_url\":\"services\",\"hero_image\":{},\"images\":{\"hero_image\":\"uploads\\/website-images\\/1740305145_hero_image.png\"}}', '2025-01-06 06:26:46', '2025-02-23 10:05:45', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Delivering tech solutions for your startups\",\"description\":\"We transform businesses of most major sectors with powerful and adaptable digital solutions that satisfy the needs of today.\",\"left_button_text\":\"Work With Us\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"Our Services\",\"right_button_url\":\"services\",\"hero_image\":{}}}]'),
(37, 'tech_agency_brand_section.content', '{\"heading\":\"Empowered professionals to connect with top-tier opportunities\",\"image_1\":{},\"image_2\":{},\"image_3\":{},\"image_4\":{},\"image_5\":{},\"image_6\":{},\"image_7\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740304965_image_1.svg\",\"image_2\":\"uploads\\/website-images\\/1740304965_image_2.svg\",\"image_3\":\"uploads\\/website-images\\/1740304965_image_3.svg\",\"image_4\":\"uploads\\/website-images\\/1740304965_image_4.svg\",\"image_5\":\"uploads\\/website-images\\/1740304965_image_5.svg\",\"image_6\":\"uploads\\/website-images\\/1740304965_image_6.svg\",\"image_7\":\"uploads\\/website-images\\/1740304965_image_7.svg\"}}', '2025-01-06 06:31:20', '2025-02-23 10:02:45', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Empowered professionals to connect with top-tier opportunities\",\"image_1\":{},\"image_2\":{},\"image_3\":{},\"image_4\":{},\"image_5\":{},\"image_6\":{},\"image_7\":{}}}]'),
(38, 'tech_company_hero_section.content', '{\"heading\":\"We provide best tech solutions for your business\",\"description\":\"We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization\",\"left_button_text\":\"Work With Us\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"View Services\",\"right_button_url\":\"services\"}', '2025-01-06 10:31:20', '2025-02-23 10:07:15', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"We provide best tech solutions for your business\",\"description\":\"We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization\",\"left_button_text\":\"Work With Us\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"View Services\",\"right_button_url\":\"services\"}}]'),
(39, 'faq_section.content', '{\"heading\":\"Have any questions? here some answers\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only\",\"button_text\":\"Ask Any Question\"}', '2025-01-08 12:27:25', '2025-02-23 06:39:00', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Have any questions? here some answers\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only\",\"button_text\":\"Ask Any Question\"}}]'),
(40, 'login_section.content', '{\"heading\":\"Login for an account\",\"description\":\"Welcome to Quland\"}', '2025-01-09 05:00:00', '2025-02-23 08:39:49', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Login for an account\",\"description\":\"Welcome to Quland\"}}]'),
(41, 'main_demo_service_highlight.content', '{\"heading\":\"Increasing business success with technology\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"about_1\":\"IT Solution & Management\",\"percentage_1\":\"86\",\"about_2\":\"Website & App Development\",\"percentage_2\":\"72\",\"about_3\":\"SEO & Digital Marketing\",\"percentage_3\":\"83\"}', '2025-02-23 09:13:05', '2025-02-23 09:13:05', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Increasing business success with technology\",\"description\":\"Each demo built with Teba will look different. You can customize almost anything in the appearance of your website with only a few clicks. Each demo built with Teba will look different.\",\"about_1\":\"IT Solution & Management\",\"percentage_1\":\"86\",\"about_2\":\"Website & App Development\",\"percentage_2\":\"72\",\"about_3\":\"SEO & Digital Marketing\",\"percentage_3\":\"83\"}}]'),
(42, 'about_us_counter_section.content', '{\"counter_1\":\"1800\",\"title_1\":\"Happy Clients\",\"counter_2\":\"600\",\"title_2\":\"Finished Projects\",\"counter_3\":\"200\",\"title_3\":\"Skilled Experts\",\"counter_4\":\"26\",\"title_4\":\"Clients Satisfaction\",\"image_1\":{},\"image_2\":{},\"image_3\":{},\"image_4\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1740563417_image_1.svg\",\"image_2\":\"uploads\\/website-images\\/1740563417_image_2.svg\",\"image_3\":\"uploads\\/website-images\\/1740563417_image_3.svg\",\"image_4\":\"uploads\\/website-images\\/1740563417_image_4.svg\"}}', '2025-02-26 09:48:51', '2025-02-26 09:50:17', '[{\"language_code\":\"en\",\"values\":{\"counter_1\":\"1800\",\"title_1\":\"Happy Clients\",\"counter_2\":\"600\",\"title_2\":\"Finished Projects\",\"counter_3\":\"200\",\"title_3\":\"Skilled Experts\",\"counter_4\":\"26\",\"title_4\":\"Clients Satisfaction\",\"image_1\":{},\"image_2\":{},\"image_3\":{},\"image_4\":{}}}]'),
(43, 'template_1_hero.content', '{\"subtitle\":\"Quland digital agency\",\"heading\":\"We\\u2019re Modern & effective <span>digital<\\/span> <span>marketing agency<\\/span>\",\"description\":\"Digital marketing agency, we craft compelling narratives & leverage cutting-edge technologies to propel brands towards\",\"left_button_text\":\"Learn More\",\"left_button_url\":\"about-us\",\"right_button_text\":\"Our Services\",\"right_button_url\":\"services\",\"card_text_one\":\"SEO & Marketing\",\"card_text_two\":\"Website Optimizations\",\"card_text_three\":\"Marketing & Growth\",\"card_text_four\":\"Keywords Research\",\"images\":{\"hero_image\":\"uploads\\/website-images\\/1753175040_hero_image.webp\"}}', '2025-07-22 08:36:45', '2025-10-14 09:27:40', '[{\"language_code\":\"en\",\"values\":{\"subtitle\":\"Quland digital agency\",\"heading\":\"We\\u2019re Modern & effective <span>digital<\\/span> <span>marketing agency<\\/span>\",\"description\":\"Digital marketing agency, we craft compelling narratives & leverage cutting-edge technologies to propel brands towards\",\"left_button_text\":\"Learn More\",\"left_button_url\":\"about-us\",\"right_button_text\":\"Our Services\",\"right_button_url\":\"services\",\"card_text_one\":\"SEO & Marketing\",\"card_text_two\":\"Website Optimizations\",\"card_text_three\":\"Marketing & Growth\",\"card_text_four\":\"Keywords Research\"}},{\"language_code\":\"esp\",\"values\":{\"subtitle\":\"Agencia digital Quland\",\"heading\":\"Somos una agencia de marketing <span>digital<\\/span> <span>moderna y eficaz.<\\/span>\",\"description\":\"Agencia de marketing digital, creamos narrativas convincentes y aprovechamos tecnolog\\u00edas de vanguardia para impulsar las marcas hacia\",\"left_button_text\":\"Learn More\",\"left_button_url\":\"blogs\",\"right_button_text\":\"Our Services\",\"right_button_url\":\"services\",\"card_text_one\":\"SEO & Marketing\",\"card_text_two\":\"Website Optimizations\",\"card_text_three\":\"Marketing & Growth\",\"card_text_four\":\"Keywords Research\"}}]'),
(44, 'about_company.content', '{\"section_title\":\"About Company\",\"trafic_title\":\"Monthly Traffic\",\"trafic_no\":\"120\",\"trafic_percent\":\"55.8\",\"title\":\"Team of SEO experts Is ready to help you\",\"description\":\"SEO agencies typically work with businesses sizes across various industries help them achieve their online marketing objectives such as increasing website traffic, generating leads\",\"title_one\":\"Expert Team Member\",\"title_two\":\"Expert Team Member\",\"description_one\":\"An SEO Optimization agency is company that specializes\",\"description_two\":\"An SEO Optimization agency is company that specializes\",\"learn_more_button\":\"Learn More\",\"learn_more_url\":\"about-us\",\"seo_service_button\":\"Explore SEO Services\",\"seo_service_url\":\"services\",\"images\":{\"about_company_image\":\"uploads\\/website-images\\/1754823428_about_company_image.webp\"}}', '2025-07-22 10:08:53', '2025-08-31 04:37:31', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"About Company\",\"trafic_title\":\"Monthly Traffic\",\"trafic_no\":\"120\",\"trafic_percent\":\"55.8\",\"title\":\"Team of SEO experts Is ready to help you\",\"description\":\"SEO agencies typically work with businesses sizes across various industries help them achieve their online marketing objectives such as increasing website traffic, generating leads\",\"title_one\":\"Expert Team Member\",\"title_two\":\"Expert Team Member\",\"description_one\":\"An SEO Optimization agency is company that specializes\",\"description_two\":\"An SEO Optimization agency is company that specializes\",\"learn_more_button\":\"Learn More\",\"learn_more_url\":\"about-us\",\"seo_service_button\":\"Explore SEO Services\",\"seo_service_url\":\"services\"}}]'),
(45, 'template_1_about_company.content', '{\"marketing_growth\":\"Marketing & Growth\",\"trusted_clients\":\"Trusted Clients\",\"sub_title\":\"About Company\",\"heading\":\"Digital Transforming Brands, Elevating Reach Crafting Success\",\"description\":\"Defined by digital dynamism, our digital marketing agency emerges as a beacon of innovation and strategic prowess.\",\"feature_text_one\":\"Transform & businesses\",\"feature_text_two\":\"Unified product catalog\",\"feature_text_three\":\"All-in-one SaaS solution\",\"feature_text_four\":\"Wide largest companies\",\"button_text\":\"Learn More\",\"button_url\":\"about-us\",\"images\":{\"about_main_image\":\"uploads\\/website-images\\/1753240891_about_main_image.webp\",\"client_image\":\"uploads\\/website-images\\/1753240891_client_image.webp\"}}', '2025-07-23 03:21:31', '2025-10-14 09:29:48', '[{\"language_code\":\"en\",\"values\":{\"marketing_growth\":\"Marketing & Growth\",\"trusted_clients\":\"Trusted Clients\",\"sub_title\":\"About Company\",\"heading\":\"Digital Transforming Brands, Elevating Reach Crafting Success\",\"description\":\"Defined by digital dynamism, our digital marketing agency emerges as a beacon of innovation and strategic prowess.\",\"feature_text_one\":\"Transform & businesses\",\"feature_text_two\":\"Unified product catalog\",\"feature_text_three\":\"All-in-one SaaS solution\",\"feature_text_four\":\"Wide largest companies\",\"button_text\":\"Learn More\",\"button_url\":\"about-us\"}}]'),
(46, 'template_1_trasted_partner.content', '{\"title\":\"We\\u2019ve more than 1250+ global clients\"}', '2025-07-23 04:28:52', '2025-07-23 04:28:52', '[{\"language_code\":\"en\",\"values\":{\"title\":\"We\\u2019ve more than 1250+ global clients\"}}]'),
(47, 'template_1_fun_fact.content', '{\"sub_title\":\"Our Fun Fact\",\"title\":\"We worked with diverse clients and industries.\",\"description\":\"Defined by digital dynamism, our digital marketing agency emerges beacon of innovation and strategic prowess.\",\"button_text\":\"Learn More\",\"button_url\":\"about-us\",\"counter_number_one\":\"15\",\"counter_text_one\":\"Project Complete\",\"counter_number_two\":\"28\",\"counter_text_two\":\"Satisfactions Customer\",\"counter_number_three\":\"10\",\"counter_text_three\":\"Years Of Experience\",\"images\":{\"hover_image\":\"uploads\\/website-images\\/1753246806_hover_image.webp\"}}', '2025-07-23 05:00:06', '2025-10-19 04:44:57', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Our Fun Fact\",\"title\":\"We worked with diverse clients and industries.\",\"description\":\"Defined by digital dynamism, our digital marketing agency emerges beacon of innovation and strategic prowess.\",\"button_text\":\"Learn More\",\"button_url\":\"about-us\",\"counter_number_one\":\"15\",\"counter_text_one\":\"Project Complete\",\"counter_number_two\":\"28\",\"counter_text_two\":\"Satisfactions Customer\",\"counter_number_three\":\"10\",\"counter_text_three\":\"Years Of Experience\"}}]'),
(48, 'service_title.content', '{\"sub_title\":\"Explore Services\",\"title\":\"High Impact Marketing Services to grow your business\"}', '2025-07-23 05:46:17', '2025-07-23 05:48:26', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Explore Services\",\"title\":\"High Impact Marketing Services to grow your business\"}}]'),
(49, 'template_1_working_process.content', '{\"sub_title\":\"Working Process\",\"title\":\"Efficiency in Motion Navigating the Working Process\",\"card_number_one\":\"01\",\"card_title_one\":\"Discover & Analysis\",\"card_description_one\":\"Discover & Analysis\\\" encapsulates the crucial initial stages of any project or venture. During this phase, teams\",\"card_number_two\":\"02\",\"card_title_two\":\"Strategy Development\",\"card_description_two\":\"Discover & Analysis\\\" encapsulates the crucial initial stages of any project or venture. During this phase, teams\",\"card_number_three\":\"03\",\"card_title_three\":\"Launch & Execution\",\"card_description_three\":\"Discover & Analysis\\\" encapsulates the crucial initial stages of any project or venture. During this phase, teams\",\"sales_and_marketing\":\"Sales and marketing\",\"marketing_growth\":\"Marketing & Growth\",\"images\":{\"working_process_image\":\"uploads\\/website-images\\/1753259796_working_process_image.webp\",\"icon\":\"uploads\\/website-images\\/1753259796_icon.webp\",\"hover_image\":\"uploads\\/website-images\\/1753259796_hover_image.webp\"}}', '2025-07-23 08:36:36', '2025-07-24 04:21:04', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Working Process\",\"title\":\"Efficiency in Motion Navigating the Working Process\",\"card_number_one\":\"01\",\"card_title_one\":\"Discover & Analysis\",\"card_description_one\":\"Discover & Analysis\\\" encapsulates the crucial initial stages of any project or venture. During this phase, teams\",\"card_number_two\":\"02\",\"card_title_two\":\"Strategy Development\",\"card_description_two\":\"Discover & Analysis\\\" encapsulates the crucial initial stages of any project or venture. During this phase, teams\",\"card_number_three\":\"03\",\"card_title_three\":\"Launch & Execution\",\"card_description_three\":\"Discover & Analysis\\\" encapsulates the crucial initial stages of any project or venture. During this phase, teams\",\"sales_and_marketing\":\"Sales and marketing\",\"marketing_growth\":\"Marketing & Growth\"}}]'),
(50, 'template_1_testimonial.content', '{\"sub_title\":\"Our Testimonials\",\"title\":\"Customer Say About Our Services\",\"trusted_clients\":\"Trusted Clients\",\"quality_service\":\"Quality Service\",\"shape_image\":{},\"images\":{\"client_image\":\"uploads\\/website-images\\/1753262777_client_image.webp\",\"testimonial_image\":\"uploads\\/website-images\\/1753262777_testimonial_image.webp\",\"quotation_image\":\"uploads\\/website-images\\/1753262777_quotation_image.webp\",\"shape_image\":\"uploads\\/website-images\\/1753263199_shape_image.webp\"}}', '2025-07-23 09:26:17', '2025-07-23 09:33:19', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Our Testimonials\",\"title\":\"Customer Say About Our Services\",\"trusted_clients\":\"Trusted Clients\",\"quality_service\":\"Quality Service\",\"shape_image\":{}}}]'),
(51, 'template_1_blog.content', '{\"sub_title\":\"News & Blog\",\"title\":\"Read and explore Our latest news\",\"read_more\":\"Read More\"}', '2025-07-23 10:01:06', '2025-07-23 10:25:59', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"News & Blog\",\"title\":\"Read and explore Our latest news\",\"read_more\":\"Read More\"}}]'),
(52, 'template_1_cta.content', '{\"sub_title\":\"Get Consultations\",\"title\":\"Get your free digital marketing audit\",\"description\":\"We\\u2019ve 25+ years of experience in digital marketing\",\"button_text\":\"Get Consultation\",\"button_url\":\"contact-us\",\"images\":{\"image_1\":\"uploads\\/website-images\\/1753266929_image_1.webp\",\"image_2\":\"uploads\\/website-images\\/1753266929_image_2.webp\"}}', '2025-07-23 10:35:29', '2025-08-11 05:03:59', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Get Consultations\",\"title\":\"Get your free digital marketing audit\",\"description\":\"We\\u2019ve 25+ years of experience in digital marketing\",\"button_text\":\"Get Consultation\",\"button_url\":\"contact-us\"}}]');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`, `data_translations`) VALUES
(53, 'themplate_3_hero_section.content', '{\"sub_title\":\"Quland Creative Agency\",\"title\":\"We Make Creative & Interesting Think to build Design & Branding\",\"description\":\"25+ Years Of Experience In Creative Agency Solutions\",\"left_button_text\":\"Explore Service\",\"left_button_url\":\"services\",\"right_button_text\":\"Learn More\",\"right_button_url\":\"about-us\",\"images\":{\"hero_image\":\"uploads\\/website-images\\/1753334003_hero_image.webp\",\"animation_image\":\"uploads\\/website-images\\/1753334003_animation_image.svg\"}}', '2025-07-24 05:09:55', '2025-08-10 10:58:57', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Quland Creative Agency\",\"title\":\"We Make Creative & Interesting Think to build Design & Branding\",\"description\":\"25+ Years Of Experience In Creative Agency Solutions\",\"left_button_text\":\"Explore Service\",\"left_button_url\":\"services\",\"right_button_text\":\"Learn More\",\"right_button_url\":\"about-us\"}}]'),
(54, 'template_3_about_company.content', '{\"sub_title\":\"About Company\",\"title\":\"Leading curated design agency, we create modern friendly & clean design\",\"description_one\":\"A creative agency is a dynamic hub where innovative ideas merge with strategic thinking bring visions life agency thrives on the power of imagination, leveraging various\",\"description_two\":\"Through a blend of artistry, technology storytelling, creative agencies craft compelling narratives emotion, spark inspiration drive action. With diverse team of designers, writers, strategists, and technologists, these navigate the ever-evolving landscape of creativity, constantly\",\"button_text\":\"Contact US\",\"button_link\":\"contact-us\",\"counter_text_one\":\"15\",\"counter_details_one\":\"Project Complete\",\"counter_text_two\":\"10\",\"counter_details_two\":\"Years Of Experience\",\"counter_text_three\":\"28\",\"counter_details_three\":\"Satisfactions Customer\",\"counter_text_four\":\"50\",\"counter_details_four\":\"Expert Team Member\",\"images\":{\"hover_image\":\"uploads\\/website-images\\/1753337700_hover_image.svg\"}}', '2025-07-24 06:13:30', '2025-08-10 11:03:21', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"About Company\",\"title\":\"Leading curated design agency, we create modern friendly & clean design\",\"description_one\":\"A creative agency is a dynamic hub where innovative ideas merge with strategic thinking bring visions life agency thrives on the power of imagination, leveraging various\",\"description_two\":\"Through a blend of artistry, technology storytelling, creative agencies craft compelling narratives emotion, spark inspiration drive action. With diverse team of designers, writers, strategists, and technologists, these navigate the ever-evolving landscape of creativity, constantly\",\"button_text\":\"Contact US\",\"button_link\":\"contact-us\",\"counter_text_one\":\"15\",\"counter_details_one\":\"Project Complete\",\"counter_text_two\":\"10\",\"counter_details_two\":\"Years Of Experience\",\"counter_text_three\":\"28\",\"counter_details_three\":\"Satisfactions Customer\",\"counter_text_four\":\"50\",\"counter_details_four\":\"Expert Team Member\"}}]'),
(55, 'template_3_pricing_section.content', '{\"sub_title\":\"Pricing Package\",\"title\":\"We Provide Amazing Pricing Package For Creative Solutions\",\"package_information\":{\"package_1\":{\"package_name\":\"Regular Plan\",\"price\":\"29.00\",\"description\":\"Basic plan for all users\",\"button_text\":\"Choose This Package\",\"button_url\":\"#\",\"features\":{\"feature_one\":\"Design & Development\",\"feature_two\":\"SEO & Digital Marketing\",\"feature_three\":\"Branding Design\",\"feature_four\":\"Custom Support\"}},\"package_2\":{\"package_name\":\"Standard Plan\",\"price\":\"49.00\",\"description\":\"Ideal plan for individual creators\",\"button_text\":\"Choose This Package\",\"button_url\":\"#\",\"features\":{\"feature_one\":\"Design & Development\",\"feature_two\":\"SEO & Digital Marketing\",\"feature_three\":\"Branding Design\",\"feature_four\":\"Custom Support\",\"feature_five\":\"Unlimited Revisions\"}},\"package_3\":{\"package_name\":\"Diamond Plan\",\"price\":\"99.00\",\"description\":\"Ideal plan for individual creators\",\"button_text\":\"Choose This Package\",\"button_url\":\"#\",\"features\":{\"feature_one\":\"Design & Development\",\"feature_two\":\"SEO & Digital Marketing\",\"feature_three\":\"Branding Design\",\"feature_four\":\"Custom Support\",\"feature_five\":\"Unlimited Revisions\",\"feature_six\":\"24\\/7 Online Support\"}}}}', '2025-07-27 03:08:45', '2025-07-27 03:08:45', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Pricing Package\",\"title\":\"We Provide Amazing Pricing Package For Creative Solutions\",\"package_information\":{\"package_1\":{\"package_name\":\"Regular Plan\",\"price\":\"29.00\",\"description\":\"Basic plan for all users\",\"button_text\":\"Choose This Package\",\"button_url\":\"#\",\"features\":{\"feature_one\":\"Design & Development\",\"feature_two\":\"SEO & Digital Marketing\",\"feature_three\":\"Branding Design\",\"feature_four\":\"Custom Support\"}},\"package_2\":{\"package_name\":\"Standard Plan\",\"price\":\"49.00\",\"description\":\"Ideal plan for individual creators\",\"button_text\":\"Choose This Package\",\"button_url\":\"#\",\"features\":{\"feature_one\":\"Design & Development\",\"feature_two\":\"SEO & Digital Marketing\",\"feature_three\":\"Branding Design\",\"feature_four\":\"Custom Support\",\"feature_five\":\"Unlimited Revisions\"}},\"package_3\":{\"package_name\":\"Diamond Plan\",\"price\":\"99.00\",\"description\":\"Ideal plan for individual creators\",\"button_text\":\"Choose This Package\",\"button_url\":\"#\",\"features\":{\"feature_one\":\"Design & Development\",\"feature_two\":\"SEO & Digital Marketing\",\"feature_three\":\"Branding Design\",\"feature_four\":\"Custom Support\",\"feature_five\":\"Unlimited Revisions\",\"feature_six\":\"24\\/7 Online Support\"}}}}}]'),
(56, 'template_3_cta_section.content', '{\"sub_title\":\"Get Consultations\",\"title\":\"Ready to Talk Our Expertise\",\"button_text\":\"Contact US\",\"button_url\":\"contact-us\",\"follow_us_text\":null,\"social_media\":{\"facebook\":{\"social_media_name\":\"Facebook\",\"url\":\"https:\\/\\/www.facebook.com\\/\"},\"instagram\":{\"social_media_name\":\"Instagram\",\"url\":\"https:\\/\\/www.instagram.com\\/\"},\"dribbble\":{\"social_media_name\":\"Dribbble\",\"url\":\"https:\\/\\/dribbble.com\\/\"},\"twitter\":{\"social_media_name\":\"Twitter\",\"url\":\"https:\\/\\/x.com\\/\"},\"linkedin\":{\"social_media_name\":\"Linkedin\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"},\"youtube\":{\"social_media_name\":\"Youtube\",\"url\":\"https:\\/\\/www.youtube.com\\/\"}}}', '2025-07-27 05:22:26', '2025-08-11 03:24:52', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Get Consultations\",\"title\":\"Ready to Talk Our Expertise\",\"button_text\":\"Contact US\",\"button_url\":\"contact-us\",\"follow_us_text\":null,\"social_media\":{\"facebook\":{\"social_media_name\":\"Facebook\",\"url\":\"https:\\/\\/www.facebook.com\\/\"},\"instagram\":{\"social_media_name\":\"Instagram\",\"url\":\"https:\\/\\/www.instagram.com\\/\"},\"dribbble\":{\"social_media_name\":\"Dribbble\",\"url\":\"https:\\/\\/dribbble.com\\/\"},\"twitter\":{\"social_media_name\":\"Twitter\",\"url\":\"https:\\/\\/x.com\\/\"},\"linkedin\":{\"social_media_name\":\"Linkedin\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"},\"youtube\":{\"social_media_name\":\"Youtube\",\"url\":\"https:\\/\\/www.youtube.com\\/\"}}}}]'),
(57, 'template_5_about_us_section.content', '{\"sub_title\":\"About Company\",\"title\":\"Empowering Your Business for Success with Expert Guidance\",\"description\":\"Business agencies often feature a diverse team of professionals expertise in various areas such as marketing, finance\",\"button_text\":\"Explore Service\",\"button_url\":\"services\",\"feature_text_one\":\"Write and translate to all languages\",\"feature_text_two\":\"Crafting quality content has been very easier\",\"feature_text_three\":\"Built for scale and enterprise level security\",\"experience_text\":\"25+ Years of Experience\",\"images\":{\"about_image_one\":\"uploads\\/website-images\\/1753597795_about_image_one.webp\",\"about_image_two\":\"uploads\\/website-images\\/1753597795_about_image_two.webp\"}}', '2025-07-27 06:29:55', '2025-08-10 11:32:45', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"About Company\",\"title\":\"Empowering Your Business for Success with Expert Guidance\",\"description\":\"Business agencies often feature a diverse team of professionals expertise in various areas such as marketing, finance\",\"button_text\":\"Explore Service\",\"button_url\":\"services\",\"feature_text_one\":\"Write and translate to all languages\",\"feature_text_two\":\"Crafting quality content has been very easier\",\"feature_text_three\":\"Built for scale and enterprise level security\",\"experience_text\":\"25+ Years of Experience\"}}]'),
(58, 'template_5_we_provide_section.content', '{\"sub_title\":\"What We Provide\",\"title\":\"Business agency services refer to a range of professional services provided\",\"tab_one_title\":\"Marketing & Advertising\",\"tab_one_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_one_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_two_title\":\"Public Relations (PR)\",\"tab_two_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_two_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_three_title\":\"Consulting Services\",\"tab_three_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_three_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_four_title\":\"Sales and Distribution\",\"tab_four_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_four_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_five_title\":\"Legal & Regulatory Compliance\",\"tab_five_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_five_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_six_title\":\"Financial & Investment Services\",\"tab_six_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_six_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_one_image\":{},\"tab_two_image\":{},\"tab_three_image\":{},\"tab_four_image\":{},\"tab_five_image\":{},\"tab_six_image\":{},\"images\":{\"tab_one_image\":\"uploads\\/website-images\\/1753600452_tab_one_image.webp\",\"tab_two_image\":\"uploads\\/website-images\\/1753600452_tab_two_image.webp\",\"tab_three_image\":\"uploads\\/website-images\\/1753600452_tab_three_image.webp\",\"tab_four_image\":\"uploads\\/website-images\\/1753600452_tab_four_image.webp\",\"tab_five_image\":\"uploads\\/website-images\\/1753600452_tab_five_image.webp\",\"tab_six_image\":\"uploads\\/website-images\\/1753600452_tab_six_image.webp\"}}', '2025-07-27 07:12:57', '2025-07-27 07:14:12', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"What We Provide\",\"title\":\"Business agency services refer to a range of professional services provided\",\"tab_one_title\":\"Marketing & Advertising\",\"tab_one_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_one_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_two_title\":\"Public Relations (PR)\",\"tab_two_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_two_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_three_title\":\"Consulting Services\",\"tab_three_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_three_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_four_title\":\"Sales and Distribution\",\"tab_four_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_four_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_five_title\":\"Legal & Regulatory Compliance\",\"tab_five_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_five_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_six_title\":\"Financial & Investment Services\",\"tab_six_details_title\":\"Elevating Your Presence through Strategic Marketing and Advertising Solutions\",\"tab_six_details\":\"Agencies may offer services related to market research, branding, advertising campaigns, digital marketing, social media management, and content creation to help businesses promote\",\"tab_one_image\":{},\"tab_two_image\":{},\"tab_three_image\":{},\"tab_four_image\":{},\"tab_five_image\":{},\"tab_six_image\":{}}}]'),
(59, 'template_3_testimonial_section.content', '{\"sub_title\":\"Our Testimonials\",\"title\":\"Customer Say About Our Services\",\"description\":\"We\\u2019ve 15m+ Global and Local Happy Customers\",\"avg_rating\":\"Avg rating 4.8\",\"happy_clients\":\"5m+ Happy Clients\",\"client_image\":{},\"images\":{\"client_image\":\"uploads\\/website-images\\/1753611066_client_image.png\"}}', '2025-07-27 10:11:06', '2025-07-27 10:11:06', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Our Testimonials\",\"title\":\"Customer Say About Our Services\",\"description\":\"We\\u2019ve 15m+ Global and Local Happy Customers\",\"avg_rating\":\"Avg rating 4.8\",\"happy_clients\":\"5m+ Happy Clients\",\"client_image\":{}}}]'),
(60, 'theme_5_counter_section.content', '{\"counter_one_title\":\"Project Complete\",\"counter_one_number\":\"28\",\"counter_details_one\":\"Agencies may services related market research, branding\",\"counter_two_title\":\"Happy Customers\",\"counter_two_number\":\"35\",\"counter_details_two\":\"Agencies may services related market research, branding\",\"counter_three_title\":\"Expert Team Member\",\"counter_three_number\":\"30\",\"counter_details_three\":\"Agencies may services related market research, branding\",\"counter_four_title\":\"Years Of Experience\",\"counter_four_number\":\"25\",\"counter_details_four\":\"Agencies may services related market research, branding\",\"counter_one_image\":{},\"counter_two_image\":{},\"counter_three_image\":{},\"counter_four_image\":{},\"images\":{\"counter_one_image\":\"uploads\\/website-images\\/1753675789_counter_one_image.svg\",\"counter_two_image\":\"uploads\\/website-images\\/1753675789_counter_two_image.svg\",\"counter_three_image\":\"uploads\\/website-images\\/1753675789_counter_three_image.svg\",\"counter_four_image\":\"uploads\\/website-images\\/1753675789_counter_four_image.svg\"}}', '2025-07-28 03:54:09', '2025-07-28 04:09:49', '[{\"language_code\":\"en\",\"values\":{\"counter_one_title\":\"Project Complete\",\"counter_one_number\":\"28\",\"counter_details_one\":\"Agencies may services related market research, branding\",\"counter_two_title\":\"Happy Customers\",\"counter_two_number\":\"35\",\"counter_details_two\":\"Agencies may services related market research, branding\",\"counter_three_title\":\"Expert Team Member\",\"counter_three_number\":\"30\",\"counter_details_three\":\"Agencies may services related market research, branding\",\"counter_four_title\":\"Years Of Experience\",\"counter_four_number\":\"25\",\"counter_details_four\":\"Agencies may services related market research, branding\",\"counter_one_image\":{},\"counter_two_image\":{},\"counter_three_image\":{},\"counter_four_image\":{}}}]'),
(61, 'theme_5_testimonial_section.content', '{\"sub_title\":\"Our Success Story\",\"title\":\"Our Customer Feedback\",\"background_image\":{},\"images\":{\"background_image\":\"uploads\\/website-images\\/1753676472_background_image.svg\"}}', '2025-07-28 04:21:12', '2025-07-28 04:21:12', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Our Success Story\",\"title\":\"Our Customer Feedback\",\"background_image\":{}}}]'),
(62, 'theme_5_cta_section.content', '{\"sub_title\":\"Get Consultations\",\"title\":\"Get free business consultation today\",\"description\":\"No credit card required, 10+ tools to explore\",\"button_text\":\"Start Free Trial\",\"button_url\":\"http:\\/\\/localhost\\/quland_cms_laravel\\/pricing-plan\",\"video_link\":\"ZUXNCY2R5Wo?si=E8zWRcLieSpVH2z4\",\"images\":{\"background_image\":\"uploads\\/website-images\\/1753680852_background_image.webp\",\"play_video_image\":\"uploads\\/website-images\\/1753682119_play_video_image.svg\"}}', '2025-07-28 05:34:12', '2025-10-20 06:21:12', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Get Consultations\",\"title\":\"Get free business consultation today\",\"description\":\"No credit card required, 10+ tools to explore\",\"button_text\":\"Start Free Trial\",\"button_url\":\"http:\\/\\/localhost\\/quland_cms_laravel\\/pricing-plan\",\"video_link\":\"ZUXNCY2R5Wo?si=E8zWRcLieSpVH2z4\"}}]'),
(63, 'theme_two_hero.content', '{\"heading_short\":\"Your Trusted\",\"heading\":\"SEO Company for Real Results\",\"description\":\"Digital marketing agency, craft compelling narratives & leverage cutting-edge technologies to propel brands towards\",\"left_button_text\":\"Get SEO Proposal\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"Case Studies\",\"right_button_url\":\"portfolio\",\"average_ratng\":\"4.5\",\"global_customer\":\"5\",\"images\":{\"hero_customer_image\":\"uploads\\/website-images\\/1753248976_hero_customer_image.png\",\"hero_image\":\"uploads\\/website-images\\/1753172346_hero_image.webp\"}}', NULL, '2025-08-10 10:21:51', '[{\"language_code\":\"en\",\"values\":{\"heading_short\":\"Your Trusted\",\"heading\":\"SEO Company for Real Results\",\"description\":\"Digital marketing agency, craft compelling narratives & leverage cutting-edge technologies to propel brands towards\",\"left_button_text\":\"Get SEO Proposal\",\"left_button_url\":\"contact-us\",\"right_button_text\":\"Case Studies\",\"right_button_url\":\"portfolio\",\"average_ratng\":\"4.5\",\"global_customer\":\"5\"}}]'),
(64, 'theme_two_tools.content', '{\"section_title\":\"The tools you really need\",\"title\":\"We Support Early Stage Startups and Leading Tech Giants.\",\"title_one\":\"Online Support\",\"title_one_url\":\"services\",\"description_one\":\"Defined by digital dynamism, our digital marketing agency as a beacon\",\"title_two\":\"Market Analysis\",\"title_two_url\":\"services\",\"description_two\":\"Defined by digital dynamism, our digital marketing agency as a beacon\",\"title_three\":\"Annual Reports\",\"title_three_url\":\"services\",\"description_three\":\"Defined by digital dynamism, our digital marketing agency as a beacon\",\"images\":{\"tools_image_one\":\"uploads\\/website-images\\/1753177495_tools_image_one.svg\",\"tools_image_two\":\"uploads\\/website-images\\/1753177495_tools_image_two.svg\",\"tools_image_three\":\"uploads\\/website-images\\/1753177495_tools_image_three.svg\"}}', NULL, '2025-09-28 09:20:53', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"The tools you really need\",\"title\":\"We Support Early Stage Startups and Leading Tech Giants.\",\"title_one\":\"Online Support\",\"title_one_url\":\"services\",\"description_one\":\"Defined by digital dynamism, our digital marketing agency as a beacon\",\"title_two\":\"Market Analysis\",\"title_two_url\":\"services\",\"description_two\":\"Defined by digital dynamism, our digital marketing agency as a beacon\",\"title_three\":\"Annual Reports\",\"title_three_url\":\"services\",\"description_three\":\"Defined by digital dynamism, our digital marketing agency as a beacon\"}}]'),
(66, 'explore_services.content', '{\"section_title\":\"Explore Services\",\"title\":\"Advanced SEO services to help your business grow\",\"bg_shape_image\":{},\"images\":{\"bg_shape_image\":\"uploads\\/website-images\\/1753377797_bg_shape_image.svg\"}}', '2025-07-23 00:54:00', '2025-07-24 11:23:17', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Explore Services\",\"title\":\"Advanced SEO services to help your business grow\",\"bg_shape_image\":{}}}]'),
(67, 'case_studies.content', '{\"section_title\":\"Case Studies\",\"title\":\"Not Convinced? Take a look at some of our case studies\",\"title_one\":\"Keywords Research\",\"title_one_url\":\"home\",\"description_one\":\"How we helped improve Company users retention\",\"title_two\":\"Content Marketing\",\"title_two_url\":\"#\",\"description_two\":\"How we helped improve Company users retention\",\"title_three\":\"SEO Optimization\",\"title_three_url\":\"#\",\"description_three\":\"How we helped improve Company users retention\",\"read_more_button\":\"Read More\",\"read_more_url\":\"#\",\"images\":{\"case_image_one\":\"uploads\\/website-images\\/1753261083_case_image_one.svg\",\"case_image_two\":\"uploads\\/website-images\\/1753261083_case_image_two.svg\",\"case_image_three\":\"uploads\\/website-images\\/1753261083_case_image_three.svg\"}}', '2025-07-23 02:58:03', '2025-07-24 00:52:33', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Case Studies\",\"title\":\"Not Convinced? Take a look at some of our case studies\",\"title_one\":\"Keywords Research\",\"title_one_url\":\"home\",\"description_one\":\"How we helped improve Company users retention\",\"title_two\":\"Content Marketing\",\"title_two_url\":\"#\",\"description_two\":\"How we helped improve Company users retention\",\"title_three\":\"SEO Optimization\",\"title_three_url\":\"#\",\"description_three\":\"How we helped improve Company users retention\",\"read_more_button\":\"Read More\",\"read_more_url\":\"#\"}}]'),
(68, 'our_testimonials.content', '{\"section_title\":\"Out Testimonials\",\"title\":\"Customer Say About Our Services\"}', '2025-07-23 04:00:23', '2025-07-23 04:00:23', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Out Testimonials\",\"title\":\"Customer Say About Our Services\"}}]'),
(69, 'faqs.content', '{\"section_title\":\"FAQs\",\"title\":\"Asked Questions & Answer\"}', '2025-07-23 04:34:44', '2025-07-23 04:34:44', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"FAQs\",\"title\":\"Asked Questions & Answer\"}}]'),
(70, 'contact_us.content', '{\"title_one\":\"Get Consultations\",\"description_one\":\"Get a Free SEO Audit! Let\\u2019s Talk Experts\",\"title_two\":\"Newsletter\",\"description_two\":\"Subscribe To Our Newsletter\",\"button_one\":\"Contact Us\",\"button_one_url\":\"contact-us\",\"button_two\":\"Sign Up\",\"button_two_url\":\"contact-us\",\"bg_image\":{},\"images\":{\"bg_image\":\"uploads\\/website-images\\/1753339451_bg_image.svg\"}}', '2025-07-23 04:58:07', '2025-07-24 00:44:11', '[{\"language_code\":\"en\",\"values\":{\"title_one\":\"Get Consultations\",\"description_one\":\"Get a Free SEO Audit! Let\\u2019s Talk Experts\",\"title_two\":\"Newsletter\",\"description_two\":\"Subscribe To Our Newsletter\",\"button_one\":\"Contact Us\",\"button_one_url\":\"contact-us\",\"button_two\":\"Sign Up\",\"button_two_url\":\"contact-us\",\"bg_image\":{}}}]'),
(71, 'theme_four_hero.content', '{\"heading\":\"Empowering Intelligence Through\",\"heading_short\":\"AI Software\",\"description\":\"Introducing our groundbreaking AI software, designed to revolutionize the way businesses operate in the digital age. Our AI software combines cutting-edge algorithms\",\"left_button_text\":\"Start Free Trial\",\"left_button_url\":\"pricing-plan\",\"right_button_text\":\"How IT Works\",\"video_link\":\"ZUXNCY2R5Wo?si=E8zWRcLieSpVH2z4\",\"images\":{\"hero_shap_one_image\":\"uploads\\/website-images\\/1753347733_hero_shap_one_image.webp\",\"hero_shap_two_image\":\"uploads\\/website-images\\/1753586487_hero_shap_two_image.webp\",\"hero_thumb_image\":\"uploads\\/website-images\\/1753347733_hero_thumb_image.webp\",\"hero_shadow_image\":\"uploads\\/website-images\\/1753349338_hero_shadow_image.svg\"}}', '2025-07-24 03:02:13', '2025-08-10 11:25:15', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Empowering Intelligence Through\",\"heading_short\":\"AI Software\",\"description\":\"Introducing our groundbreaking AI software, designed to revolutionize the way businesses operate in the digital age. Our AI software combines cutting-edge algorithms\",\"left_button_text\":\"Start Free Trial\",\"left_button_url\":\"pricing-plan\",\"right_button_text\":\"How IT Works\",\"video_link\":\"ZUXNCY2R5Wo?si=E8zWRcLieSpVH2z4\"}}]'),
(72, 'ur_cool_features.content', '{\"section_title\":\"Our Cool Features\",\"title_top\":\"Faster, Smarter, Start\",\"title_bottom\":\"to use in few seconds\",\"title_one\":\"Unified Design Language\",\"description_one\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_two\":\"Effortless Collaboration\",\"description_two\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_three\":\"Customizable Workflows\",\"description_three\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"shape_one_image\":{},\"shape_two_image\":{},\"shape_three_image\":{},\"shape_four_image\":{},\"images\":{\"logo_one_image\":\"uploads\\/website-images\\/1753351549_logo_one_image.webp\",\"logo_two_image\":\"uploads\\/website-images\\/1753351549_logo_two_image.webp\",\"logo_three_image\":\"uploads\\/website-images\\/1753351549_logo_three_image.webp\",\"cool_right_image\":\"uploads\\/website-images\\/1753352010_cool_right_image.webp\",\"shape_one_image\":\"uploads\\/website-images\\/1753352374_shape_one_image.webp\",\"shape_two_image\":\"uploads\\/website-images\\/1753352374_shape_two_image.webp\",\"shape_three_image\":\"uploads\\/website-images\\/1753352374_shape_three_image.webp\",\"shape_four_image\":\"uploads\\/website-images\\/1753352374_shape_four_image.webp\"}}', '2025-07-24 04:05:49', '2025-07-24 04:19:34', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Our Cool Features\",\"title_top\":\"Faster, Smarter, Start\",\"title_bottom\":\"to use in few seconds\",\"title_one\":\"Unified Design Language\",\"description_one\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_two\":\"Effortless Collaboration\",\"description_two\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_three\":\"Customizable Workflows\",\"description_three\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"shape_one_image\":{},\"shape_two_image\":{},\"shape_three_image\":{},\"shape_four_image\":{}}}]'),
(73, 'what_we_do.content', '{\"section_title\":\"What We Do\",\"title\":\"Generate AI Copy writing Favorite Tools\",\"title_one\":\"Natural Language Processing (NLP) Platforms Solutions\",\"description_one\":\"NLP services enable computers underst interpret generate human language there used for sentiment analysis\",\"title_two\":\"AI-Powered Natural Language Processing Solutions & Platforms\",\"description_two\":\"Harness the power of NLP to help machines understand, analyze, and generate human language for tasks like sentiment analysis and more.\",\"title_three\":\"Smart NLP Solutions for Real-World Language Challenges\",\"description_three\":\"Our NLP services help systems interpret and respond to human language, making them ideal for chatbots, sentiment analysis, and intelligent automation.\",\"title_four\":\"Unlock Language Intelligence with Advanced NLP Solutions\",\"description_four\":\"Our Natural Language Processing services empower systems to interpret, analyze, and generate human language, enhancing everything from sentiment analysis to virtual assistants.\",\"title_five\":\"Transform Language Data with NLP Technology\",\"description_five\":\"NLP helps convert human language into actionable insights for applications like sentiment analysis, text summarization, and intelligent search.\",\"title_six\":\"AI-Driven NLP Tools for Smarter Communication\",\"description_six\":\"We build NLP solutions that allow computers to understand, process, and generate human language for better automation and analysis.\",\"images\":{\"shape_one_image\":\"uploads\\/website-images\\/1753353405_shape_one_image.webp\",\"shape_two_image\":\"uploads\\/website-images\\/1753353405_shape_two_image.webp\",\"shape_three_image\":\"uploads\\/website-images\\/1753353405_shape_three_image.webp\",\"shape_four_image\":\"uploads\\/website-images\\/1753353405_shape_four_image.webp\",\"shape_five_image\":\"uploads\\/website-images\\/1753353405_shape_five_image.webp\",\"shape_six_image\":\"uploads\\/website-images\\/1753353405_shape_six_image.webp\",\"shape_background_image\":\"uploads\\/website-images\\/1753353804_shape_background_image.webp\"}}', '2025-07-24 04:36:45', '2025-07-27 15:06:08', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"What We Do\",\"title\":\"Generate AI Copy writing Favorite Tools\",\"title_one\":\"Natural Language Processing (NLP) Platforms Solutions\",\"description_one\":\"NLP services enable computers underst interpret generate human language there used for sentiment analysis\",\"title_two\":\"AI-Powered Natural Language Processing Solutions & Platforms\",\"description_two\":\"Harness the power of NLP to help machines understand, analyze, and generate human language for tasks like sentiment analysis and more.\",\"title_three\":\"Smart NLP Solutions for Real-World Language Challenges\",\"description_three\":\"Our NLP services help systems interpret and respond to human language, making them ideal for chatbots, sentiment analysis, and intelligent automation.\",\"title_four\":\"Unlock Language Intelligence with Advanced NLP Solutions\",\"description_four\":\"Our Natural Language Processing services empower systems to interpret, analyze, and generate human language, enhancing everything from sentiment analysis to virtual assistants.\",\"title_five\":\"Transform Language Data with NLP Technology\",\"description_five\":\"NLP helps convert human language into actionable insights for applications like sentiment analysis, text summarization, and intelligent search.\",\"title_six\":\"AI-Driven NLP Tools for Smarter Communication\",\"description_six\":\"We build NLP solutions that allow computers to understand, process, and generate human language for better automation and analysis.\"}}]'),
(74, 'theme_four_faqs.content', '{\"title\":\"FAQs\",\"description\":\"Asked Questions & Answer\"}', '2025-07-24 05:00:32', '2025-07-24 05:00:32', '[{\"language_code\":\"en\",\"values\":{\"title\":\"FAQs\",\"description\":\"Asked Questions & Answer\"}}]'),
(75, 'theme_4_testimonials.content', '{\"section_title\":\"Our Testimonials\",\"count\":\"1250\",\"title\":\"Customer Say Our Services\"}', '2025-07-24 22:58:04', '2025-07-25 09:28:24', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Our Testimonials\",\"count\":\"1250\",\"title\":\"Customer Say Our Services\"}}]'),
(76, 'theme_4_pricing_section.content', '{\"heading\":\"We Provide Amazing Pricing Package For Creative Solutions\",\"package_information\":{\"package_1\":{\"plan_title\":\"Regular Plan\",\"price\":\"29\",\"plan_short_description\":\"Basic plan for all users\",\"plan_chooche_button\":\"Choose This Package\",\"plan_chooche_url\":\"#\",\"features\":{\"feature_1\":\"Subscription-Based Pricing\",\"feature_2\":\"Pay-Per-Use Based Pricing\",\"feature_3\":\"10,000 Monthly Word Limit\",\"feature_4\":\"10+ Languages trasnlations\",\"feature_5\":\"All types of content\"}},\"package_2\":{\"plan_title\":\"Standard Plan\",\"price\":\"40\",\"plan_short_description\":\"Ideal plan for individual creators\",\"plan_chooche_button\":\"Choose This Package\",\"plan_chooche_url\":\"#\",\"features\":{\"feature_1\":\"Subscription-Based Pricing\",\"feature_2\":\"Pay-Per-Use Based Pricing\",\"feature_3\":\"10,000 Monthly Word Limit\",\"feature_4\":\"10+ Languages trasnlations\",\"feature_5\":\"All types of content\"}},\"package_3\":{\"plan_title\":\"Diamond Plan\",\"price\":\"98\",\"plan_short_description\":\"Ideal plan for individual creators\",\"plan_chooche_button\":\"Choose This Package\",\"plan_chooche_url\":\"#\",\"features\":{\"feature_1\":\"Subscription-Based Pricing\",\"feature_2\":\"Pay-Per-Use Based Pricing\",\"feature_3\":\"10,000 Monthly Word Limit\",\"feature_4\":\"10+ Languages trasnlations\",\"feature_5\":\"All types of content\"}}}}', '2025-07-25 00:13:11', '2025-07-25 00:41:11', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"We Provide Amazing Pricing Package For Creative Solutions\",\"package_information\":{\"package_1\":{\"plan_title\":\"Regular Plan\",\"price\":\"29\",\"plan_short_description\":\"Basic plan for all users\",\"plan_chooche_button\":\"Choose This Package\",\"plan_chooche_url\":\"#\",\"features\":{\"feature_1\":\"Subscription-Based Pricing\",\"feature_2\":\"Pay-Per-Use Based Pricing\",\"feature_3\":\"10,000 Monthly Word Limit\",\"feature_4\":\"10+ Languages trasnlations\",\"feature_5\":\"All types of content\"}},\"package_2\":{\"plan_title\":\"Standard Plan\",\"price\":\"40\",\"plan_short_description\":\"Ideal plan for individual creators\",\"plan_chooche_button\":\"Choose This Package\",\"plan_chooche_url\":\"#\",\"features\":{\"feature_1\":\"Subscription-Based Pricing\",\"feature_2\":\"Pay-Per-Use Based Pricing\",\"feature_3\":\"10,000 Monthly Word Limit\",\"feature_4\":\"10+ Languages trasnlations\",\"feature_5\":\"All types of content\"}},\"package_3\":{\"plan_title\":\"Diamond Plan\",\"price\":\"98\",\"plan_short_description\":\"Ideal plan for individual creators\",\"plan_chooche_button\":\"Choose This Package\",\"plan_chooche_url\":\"#\",\"features\":{\"feature_1\":\"Subscription-Based Pricing\",\"feature_2\":\"Pay-Per-Use Based Pricing\",\"feature_3\":\"10,000 Monthly Word Limit\",\"feature_4\":\"10+ Languages trasnlations\",\"feature_5\":\"All types of content\"}}}}}]'),
(77, 'theme_four_moving_image.content', '{\"moving_one_image\":{},\"moving_two_image\":{},\"moving_three_image\":{},\"moving_four_image\":{},\"images\":{\"moving_one_image\":\"uploads\\/website-images\\/1753436076_moving_one_image.webp\",\"moving_two_image\":\"uploads\\/website-images\\/1753436076_moving_two_image.webp\",\"moving_three_image\":\"uploads\\/website-images\\/1753436076_moving_three_image.webp\",\"moving_four_image\":\"uploads\\/website-images\\/1753436076_moving_four_image.webp\"}}', '2025-07-25 03:34:36', '2025-07-25 03:34:36', '[{\"language_code\":\"en\",\"values\":{\"moving_one_image\":{},\"moving_two_image\":{},\"moving_three_image\":{},\"moving_four_image\":{}}}]'),
(78, 'our_cool_features.content', '{\"section_title\":\"Our Cool Features\",\"title\":\"Faster Smarter, Start to use in few seconds\",\"title_one\":\"Unified Design Language\",\"description_one\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_two\":\"Effortless Collaboration\",\"description_two\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_three\":\"Customizable Workflows\",\"description_three\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"images\":{\"logo_one_image\":\"uploads\\/website-images\\/1753439593_logo_one_image.webp\",\"logo_two_image\":\"uploads\\/website-images\\/1753439593_logo_two_image.webp\",\"logo_three_image\":\"uploads\\/website-images\\/1753439593_logo_three_image.webp\"}}', '2025-07-25 04:33:13', '2025-07-27 16:08:56', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Our Cool Features\",\"title\":\"Faster Smarter, Start to use in few seconds\",\"title_one\":\"Unified Design Language\",\"description_one\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_two\":\"Effortless Collaboration\",\"description_two\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\",\"title_three\":\"Customizable Workflows\",\"description_three\":\"Unified Design Language (UDL) is the cornerstone of harmonious and intuitive design philosophy\"}}]'),
(79, 'theme_4_moving_image.content', '{\"moving_one_image\":{},\"moving_two_image\":{},\"moving_three_image\":{},\"moving_four_image\":{},\"images\":{\"moving_one_image\":\"uploads\\/website-images\\/1753439952_moving_one_image.webp\",\"moving_two_image\":\"uploads\\/website-images\\/1753439952_moving_two_image.webp\",\"moving_three_image\":\"uploads\\/website-images\\/1753439952_moving_three_image.webp\",\"moving_four_image\":\"uploads\\/website-images\\/1753439952_moving_four_image.webp\"}}', '2025-07-25 04:39:12', '2025-07-25 04:39:12', '[{\"language_code\":\"en\",\"values\":{\"moving_one_image\":{},\"moving_two_image\":{},\"moving_three_image\":{},\"moving_four_image\":{}}}]'),
(80, 'theme_six_hero.content', '{\"heading\":\"Digital Education to Empowering Minds in Virtual Classroom\",\"short_description\":\"E-learning, also known as electronic learning, revolutionizes education by leveraging digital technologies to deliver instructional\",\"left_button_text\":\"Explore Courses\",\"left_button_url\":\"#\",\"right_button_text\":\"Learn More\",\"right_button_url\":\"#\",\"milion_student_text\":\"Over 15+ million students\",\"cources_text\":\"More than 38,000 courses\",\"student_happy_text\":\"Student Are happy\",\"student_happy_count\":\"98\",\"trusted_client_text\":\"Trusted Clients\",\"reviews_text\":\"25k+ reviews\",\"images\":{\"trusted_client_image\":\"uploads\\/website-images\\/1753554050_trusted_client_image.webp\",\"hero_thumb_image\":\"uploads\\/website-images\\/1753554050_hero_thumb_image.png\",\"square_image\":\"uploads\\/website-images\\/1753554050_square_image.svg\",\"circle_image\":\"uploads\\/website-images\\/1753554050_circle_image.png\",\"video_image\":\"uploads\\/website-images\\/1753554050_video_image.png\",\"videoplay_inner_image\":\"uploads\\/website-images\\/1753558168_videoplay_inner_image.svg\",\"videoplay_outer_image\":\"uploads\\/website-images\\/1753557963_videoplay_outer_image.svg\"}}', '2025-07-26 12:20:50', '2025-07-26 21:51:46', '[{\"language_code\":\"en\",\"values\":{\"heading\":\"Digital Education to Empowering Minds in Virtual Classroom\",\"short_description\":\"E-learning, also known as electronic learning, revolutionizes education by leveraging digital technologies to deliver instructional\",\"left_button_text\":\"Explore Courses\",\"left_button_url\":\"#\",\"right_button_text\":\"Learn More\",\"right_button_url\":\"#\",\"milion_student_text\":\"Over 15+ million students\",\"cources_text\":\"More than 38,000 courses\",\"student_happy_text\":\"Student Are happy\",\"student_happy_count\":\"98\",\"trusted_client_text\":\"Trusted Clients\",\"reviews_text\":\"25k+ reviews\"}}]'),
(81, 'theme_six_top_categories.content', '{\"section_title\":\"Top Categories\",\"title\":\"E-Learning Exploration Navigating Diverse Learning Domains\"}', '2025-07-26 22:00:33', '2025-07-26 22:00:33', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Top Categories\",\"title\":\"E-Learning Exploration Navigating Diverse Learning Domains\"}}]'),
(82, 'theme_seven_hero.content', '{\"section_title\":\"Quland IT Business\",\"title\":\"The Platform to help your IT business grow on fast to success\",\"short_description\":\"Digital marketing agency, craft compelling narratives & leverage cutting-edge technologies to propel brands towards\",\"left_button_text\":\"Learn More\",\"left_button_url\":\"about-us\",\"right_button_text\":\"Case Studies\",\"right_button_url\":\"portfolio\",\"images\":{\"thumb_image\":\"uploads\\/website-images\\/1753590319_thumb_image.png\"}}', '2025-07-26 22:25:19', '2025-08-11 03:54:12', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Quland IT Business\",\"title\":\"The Platform to help your IT business grow on fast to success\",\"short_description\":\"Digital marketing agency, craft compelling narratives & leverage cutting-edge technologies to propel brands towards\",\"left_button_text\":\"Learn More\",\"left_button_url\":\"about-us\",\"right_button_text\":\"Case Studies\",\"right_button_url\":\"portfolio\"}}]'),
(83, 'theme_seven_partner.content', '{\"title\":\"We\\u2019ve more then 1250+ global clients\"}', '2025-07-26 22:46:59', '2025-07-26 22:46:59', '[{\"language_code\":\"en\",\"values\":{\"title\":\"We\\u2019ve more then 1250+ global clients\"}}]'),
(84, 'theme_seven_about_company.content', '{\"section_title\":\"About Company\",\"title\":\"High-impact IT service to grow your business\",\"short_description\":\"Welcome to Lumina Learning Institute, where education meets innovation. Our institute is dedicated to providing high-quality online learning experiences to individuals seeking enhance\",\"button_url\":\"about-us\",\"images\":{\"about_company_image\":\"uploads\\/website-images\\/1753592150_about_company_image.png\"}}', '2025-07-26 22:55:50', '2025-08-11 03:57:36', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"About Company\",\"title\":\"High-impact IT service to grow your business\",\"short_description\":\"Welcome to Lumina Learning Institute, where education meets innovation. Our institute is dedicated to providing high-quality online learning experiences to individuals seeking enhance\",\"button_url\":\"about-us\"}}]'),
(85, 'theme_seven_explore_services.content', '{\"section_title\":\"Popular Services\",\"title\":\"High Impact Creative Services to grow your business\"}', '2025-07-26 23:15:54', '2025-07-26 23:15:54', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Popular Services\",\"title\":\"High Impact Creative Services to grow your business\"}}]'),
(86, 'theme_seven_working_process.content', '{\"section_title\":\"Working Process\",\"title\":\"Four working processes commonly employed by IT businesses\",\"title_1\":\"Assessment & Planning\",\"description_1\":\"Evaluate IT systems, infrastructure, processes, and capabilities to identify strengths, weakness, inefficiencies,\",\"title_2\":\"Design and Architecture\",\"description_2\":\"Define the desired future state of IT systems, infrastructure, an operations aligned with business objectives\",\"title_3\":\"Implementation & Execution\",\"description_3\":\"Adopt agile methodologies iterative and incremental delive transformation initiatives, allowing for flexibility\",\"title_4\":\"Monitoring & Optimization\",\"description_4\":\"Define key performance indicators a metrics to track the progress a impact of IT transformation initiatives\",\"youtube_video_id\":\"u31qwQUeGuM\",\"images\":{\"working_process_main_image\":\"uploads\\/website-images\\/1753593868_working_process_main_image.png\",\"working_process_image_1\":\"uploads\\/website-images\\/1753593868_working_process_image_1.png\",\"working_process_image_2\":\"uploads\\/website-images\\/1753593868_working_process_image_2.png\",\"working_process_image_3\":\"uploads\\/website-images\\/1753593868_working_process_image_3.png\",\"working_process_image_4\":\"uploads\\/website-images\\/1753593868_working_process_image_4.png\"}}', '2025-07-26 23:23:32', '2025-10-19 05:04:27', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Working Process\",\"title\":\"Four working processes commonly employed by IT businesses\",\"title_1\":\"Assessment & Planning\",\"description_1\":\"Evaluate IT systems, infrastructure, processes, and capabilities to identify strengths, weakness, inefficiencies,\",\"title_2\":\"Design and Architecture\",\"description_2\":\"Define the desired future state of IT systems, infrastructure, an operations aligned with business objectives\",\"title_3\":\"Implementation & Execution\",\"description_3\":\"Adopt agile methodologies iterative and incremental delive transformation initiatives, allowing for flexibility\",\"title_4\":\"Monitoring & Optimization\",\"description_4\":\"Define key performance indicators a metrics to track the progress a impact of IT transformation initiatives\",\"youtube_video_id\":\"u31qwQUeGuM\"}}]'),
(87, 'theme_seven_case_story.content', '{\"section_title\":\"Our Cases Story\",\"title\":\"Our Journey to Success Navigating Challenges, Achieving Milestones, and Building a Legacy\",\"card_shape_image\":{},\"images\":{\"card_shape_image\":\"uploads\\/website-images\\/1753595939_card_shape_image.svg\"}}', '2025-07-26 23:53:07', '2025-07-26 23:58:59', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Our Cases Story\",\"title\":\"Our Journey to Success Navigating Challenges, Achieving Milestones, and Building a Legacy\",\"card_shape_image\":{}}}]'),
(88, 'theme_seven_business_benefits.content', '{\"section_title\":\"Business Benefits\",\"title\":\"IT business offer numerous benefits to both their clients & the broader economy\",\"title_1\":\"Innovation & Technological Advancement\",\"description_1\":\"IT businesses drive innovation by developing new technologies, software solutions, and digital platforms that enhance\",\"title_2\":\"Enhanced Customer Experience\",\"description_2\":\"IT businesses drive innovation by developing new technologies, software solutions, and digital platforms that enhance\",\"title_3\":\"Security and Risk Management\",\"description_3\":\"IT businesses drive innovation by developing new technologies, software solutions, and digital platforms that enhance\",\"read_more_button_url\":\"about-us\",\"experience_count\":\"25\",\"experience_text\":\"Years of Experience\",\"images\":{\"main_image\":\"uploads\\/website-images\\/1753596660_main_image.png\"}}', '2025-07-27 00:10:17', '2025-08-11 03:59:23', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Business Benefits\",\"title\":\"IT business offer numerous benefits to both their clients & the broader economy\",\"title_1\":\"Innovation & Technological Advancement\",\"description_1\":\"IT businesses drive innovation by developing new technologies, software solutions, and digital platforms that enhance\",\"title_2\":\"Enhanced Customer Experience\",\"description_2\":\"IT businesses drive innovation by developing new technologies, software solutions, and digital platforms that enhance\",\"title_3\":\"Security and Risk Management\",\"description_3\":\"IT businesses drive innovation by developing new technologies, software solutions, and digital platforms that enhance\",\"read_more_button_url\":\"about-us\",\"experience_count\":\"25\",\"experience_text\":\"Years of Experience\"}}]'),
(89, 'theme_seven_testimonial.content', '{\"section_title\":\"Out Testimonials\",\"title\":\"Customer Say About Our Services\"}', '2025-07-27 00:33:33', '2025-07-27 00:33:33', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Out Testimonials\",\"title\":\"Customer Say About Our Services\"}}]'),
(90, 'theme_seven_faqs.content', '{\"section_title\":\"FAQs\",\"title\":\"Frequently Asked Questions & Answer\",\"short_description\":\"IT businesses help organizations develop and implement robust business continuity plans disaster\",\"learn_more_button_text\":\"Contact Us\",\"learn_more_button_url\":\"contact-us\"}', '2025-07-27 00:40:02', '2025-10-16 03:59:42', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"FAQs\",\"title\":\"Frequently Asked Questions & Answer\",\"short_description\":\"IT businesses help organizations develop and implement robust business continuity plans disaster\",\"learn_more_button_text\":\"Contact Us\",\"learn_more_button_url\":\"contact-us\"}}]'),
(91, 'theme_seven_get_consultations.content', '{\"section_title\":\"Get Consultations\",\"title\":\"Ready to Get Consultations?\",\"short_description\":\"We\\u2019ve 25+ years of experience in digital marketing\",\"button_text\":\"Get Consultation\",\"button_url\":\"contact-us\",\"images\":{\"cta-shape-1\":\"uploads\\/website-images\\/1753599776_cta-shape-1.svg\",\"cta-shape-2\":\"uploads\\/website-images\\/1753599776_cta-shape-2.svg\",\"cta-shape-3\":\"uploads\\/website-images\\/1753599776_cta-shape-3.svg\"}}', '2025-07-27 01:02:56', '2025-08-11 09:09:51', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Get Consultations\",\"title\":\"Ready to Get Consultations?\",\"short_description\":\"We\\u2019ve 25+ years of experience in digital marketing\",\"button_text\":\"Get Consultation\",\"button_url\":\"contact-us\"}}]');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`, `data_translations`) VALUES
(92, 'theme_eight_hero.content', '{\"title\":\"Unified Observability for Micro services & Applications\",\"short_description\":\"Welcome to our innovative Software as a Service SaaS platform, where seamless integration meets unparalleled functionality cutting-edge solution is designed to revolutionize\",\"left_button_text\":\"Start Free 14-days Trial\",\"left_button_url\":\"pricing-plan\",\"right_button_text\":\"Case Studies\",\"right_button_url\":\"portfolio\",\"note_one\":\"Best Products 2023\",\"note_two\":\"Access to all content\",\"note_three\":\"Best Products 2023\",\"popup_video_id\":\"ZUXNCY2R5Wo\",\"images\":{\"thumb_image\":\"uploads\\/website-images\\/1753672516_thumb_image.png\"}}', '2025-07-27 21:15:16', '2025-08-17 08:45:18', '[{\"language_code\":\"en\",\"values\":{\"title\":\"Unified Observability for Micro services & Applications\",\"short_description\":\"Welcome to our innovative Software as a Service SaaS platform, where seamless integration meets unparalleled functionality cutting-edge solution is designed to revolutionize\",\"left_button_text\":\"Start Free 14-days Trial\",\"left_button_url\":\"pricing-plan\",\"right_button_text\":\"Case Studies\",\"right_button_url\":\"portfolio\",\"note_one\":\"Best Products 2023\",\"note_two\":\"Access to all content\",\"note_three\":\"Best Products 2023\",\"popup_video_id\":\"ZUXNCY2R5Wo\"}}]'),
(93, 'theme_eight_partner.content', '{\"title\":\"We\\u2019ve more then 1250+ global clients\"}', '2025-07-27 21:34:30', '2025-07-27 21:34:30', '[{\"language_code\":\"en\",\"values\":{\"title\":\"We\\u2019ve more then 1250+ global clients\"}}]'),
(94, 'theme_eight_why_use_us.content', '{\"section_title\":\"Why Use Us\",\"title\":\"Quland is a better way to build products\",\"short_description\":\"Welcome to Lumina Learning Institute, where education meets innovation. Our institute is dedicated to providing high-quality online learning experiences to individuals seeking their skills\",\"get_start_button_text\":\"Get Started Now\",\"get_start_button_url\":\"pricing-plan\",\"testimonial_image\":{},\"images\":{\"why_use_us_image\":\"uploads\\/website-images\\/1753673874_why_use_us_image.png\",\"testimonial_image\":\"uploads\\/website-images\\/1756623285_testimonial_image.png\"}}', '2025-07-27 21:37:54', '2025-08-31 06:54:45', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Why Use Us\",\"title\":\"Quland is a better way to build products\",\"short_description\":\"Welcome to Lumina Learning Institute, where education meets innovation. Our institute is dedicated to providing high-quality online learning experiences to individuals seeking their skills\",\"get_start_button_text\":\"Get Started Now\",\"get_start_button_url\":\"pricing-plan\",\"testimonial_image\":{}}}]'),
(95, 'theme_eight_core_features.content', '{\"section_title\":\"Core Features\",\"title\":\"Experience the power of automation and watch your revenue rise\",\"project_complete_count\":\"15\",\"project_complete_keyword\":\"K\",\"project_complete_text\":\"Project Complete\",\"experience_count\":\"10\",\"experience_keyword\":\"K\",\"experience_text\":\"Years Of Experience\",\"client_satisfaction_count\":\"28\",\"client_satisfaction_keyword\":\"K\",\"client_satisfaction_text\":\"Satisfactions Customer\",\"expert_team_member_count\":\"50\",\"expert_team_member_keyword\":\"M\",\"expert_team_member_text\":\"Expert Team Member\"}', '2025-07-27 21:53:20', '2025-07-27 23:13:20', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Core Features\",\"title\":\"Experience the power of automation and watch your revenue rise\",\"project_complete_count\":\"15\",\"project_complete_keyword\":\"K\",\"project_complete_text\":\"Project Complete\",\"experience_count\":\"10\",\"experience_keyword\":\"K\",\"experience_text\":\"Years Of Experience\",\"client_satisfaction_count\":\"28\",\"client_satisfaction_keyword\":\"K\",\"client_satisfaction_text\":\"Satisfactions Customer\",\"expert_team_member_count\":\"50\",\"expert_team_member_keyword\":\"M\",\"expert_team_member_text\":\"Expert Team Member\"}}]'),
(96, 'theme_eight_core_features_two.content', '{\"section_title\":\"Core Features\",\"title\":\"Create your first funnel in One minutes Headache-free\",\"title_1\":\"First Editing\",\"description_1\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"title_2\":\"Proven templates\",\"description_2\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"title_3\":\"Unique design\",\"description_3\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"title_4\":\"Personalized approach\",\"description_4\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"main_image\":{},\"images\":{\"main_image\":\"uploads\\/website-images\\/1753676165_main_image.png\"}}', '2025-07-27 22:16:05', '2025-07-27 22:16:05', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Core Features\",\"title\":\"Create your first funnel in One minutes Headache-free\",\"title_1\":\"First Editing\",\"description_1\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"title_2\":\"Proven templates\",\"description_2\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"title_3\":\"Unique design\",\"description_3\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"title_4\":\"Personalized approach\",\"description_4\":\"Our cutting-edge solution is designed to revolutionize to see business.\",\"main_image\":{}}}]'),
(97, 'theme_eight_why_use_us_two.content', '{\"section_title\":\"Why Use Us\",\"title\":\"Quland is a better way to build products\",\"short_description\":\"Welcome to Lumina Learning Institute, where education meets innovation. Our institute is dedicated to providing high-quality online learning experiences to individuals seeking their skills\",\"get_start_button_text\":\"Get Started Now\",\"get_start_button_url\":\"pricing-plan\",\"images\":{\"main_image\":\"uploads\\/website-images\\/1753676554_main_image.png\"}}', '2025-07-27 22:22:34', '2025-08-11 04:20:06', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"Why Use Us\",\"title\":\"Quland is a better way to build products\",\"short_description\":\"Welcome to Lumina Learning Institute, where education meets innovation. Our institute is dedicated to providing high-quality online learning experiences to individuals seeking their skills\",\"get_start_button_text\":\"Get Started Now\",\"get_start_button_url\":\"pricing-plan\"}}]'),
(98, 'theme_eight_faqs.content', '{\"section_title\":\"FAQs\",\"title\":\"Asked Questions & Answer\"}', '2025-07-27 22:45:51', '2025-07-27 22:45:51', '[{\"language_code\":\"en\",\"values\":{\"section_title\":\"FAQs\",\"title\":\"Asked Questions & Answer\"}}]'),
(99, 'theme_eight_automating_design_system.content', '{\"title\":\"Start automating your design system effectively today\",\"get_start_button_text\":\"Start Free 14-days Trial\",\"get_start_button_url\":\"pricing-plan\",\"popup_video_id\":\"ZUXNCY2R5Wo\",\"images\":{\"main_image\":\"uploads\\/website-images\\/1753678733_main_image.png\"}}', '2025-07-27 22:54:37', '2025-08-17 08:48:53', '[{\"language_code\":\"en\",\"values\":{\"title\":\"Start automating your design system effectively today\",\"get_start_button_text\":\"Start Free 14-days Trial\",\"get_start_button_url\":\"pricing-plan\",\"popup_video_id\":\"ZUXNCY2R5Wo\"}}]'),
(100, 'theme_eight_testimonials.content', '{\"title\":\"Customer Say About Our Services\"}', '2025-07-28 08:37:02', '2025-07-28 08:37:02', '[{\"language_code\":\"en\",\"values\":{\"title\":\"Customer Say About Our Services\"}}]'),
(101, 'team_hero_section.content', '{\"sub_title\":\"Who We Are\",\"title\":\"We Have a Dedicated Team member to grow your business\",\"long_description\":\"Transform your educational journey accessible online courses believe learning should convenient, and tailored to your needs\",\"button_text\":\"Read More\",\"button_url\":\"about-us\",\"counter_number_one\":\"12\",\"counter_number_two\":\"8\",\"counter_details_one\":\"Years Of Experience\",\"counter_details_two\":\"Project Complete\",\"images\":{\"image_one\":\"uploads\\/website-images\\/1754536889_image_one.png\",\"image_two\":\"uploads\\/website-images\\/1754536889_image_two.png\",\"image_three\":\"uploads\\/website-images\\/1754536889_image_three.png\",\"image_four\":\"uploads\\/website-images\\/1754536889_image_four.png\",\"image_five\":\"uploads\\/website-images\\/1754536889_image_five.png\",\"image_six\":\"uploads\\/website-images\\/1754536889_image_six.png\",\"image_seven\":\"uploads\\/website-images\\/1754536889_image_seven.png\",\"image_eight\":\"uploads\\/website-images\\/1754536889_image_eight.png\",\"image_nine\":\"uploads\\/website-images\\/1754536889_image_nine.png\"}}', '2025-07-30 04:32:21', '2025-08-17 04:05:28', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Who We Are\",\"title\":\"We Have a Dedicated Team member to grow your business\",\"long_description\":\"Transform your educational journey accessible online courses believe learning should convenient, and tailored to your needs\",\"button_text\":\"Read More\",\"button_url\":\"about-us\",\"counter_number_one\":\"12\",\"counter_number_two\":\"8\",\"counter_details_one\":\"Years Of Experience\",\"counter_details_two\":\"Project Complete\"}}]'),
(102, 'blog_details_add.content', '{\"title\":\"Modern IT Design Consulting Services\",\"phone_number\":\"+236 (456) 896 22\",\"images\":{\"add_image\":\"uploads\\/website-images\\/1754796896_add_image.png\"}}', '2025-08-06 03:20:25', '2025-08-10 03:35:51', '[{\"language_code\":\"en\",\"values\":{\"title\":\"Modern IT Design Consulting Services\",\"phone_number\":\"+236 (456) 896 22\"}}]'),
(103, 'about_company_section.content', '{\"section_name\":\"About Company\",\"title\":\"Digital Transforming Brands, Elevating Reach Crafting Success\",\"short_description\":\"Defined by digital dynamism, our digital marketing agency emerges as a beacon of innovation and strategic prowess.\",\"title_1\":\"Expert Team Member\",\"description_1\":\"An SEO Optimization agency is company that specializes\",\"title_2\":\"Custom SEO Support\",\"description_2\":\"These agencies typically offer range of services aimed\",\"trusted_client\":\"Trusted Clients\",\"years_of_experience\":\"25+ Years of Experience\",\"project_complete_count\":\"15\",\"project_complete_keyword\":\"K\",\"project_complete_text\":\"Project Complete\",\"experience_count\":\"10\",\"experience_keyword\":\"K\",\"experience_text\":\"Years of Experience\",\"client_satisfaction_count\":\"28\",\"client_satisfaction_keyword\":\"M\",\"client_satisfaction_text\":\"Satisfactions Customer\",\"expert_team_member_count\":\"50\",\"expert_team_member_keyword\":\"M\",\"expert_team_member_text\":\"Expert Team Member\",\"trusted_client_image\":{},\"thumb_image\":{},\"images\":{\"trusted_client_image\":\"uploads\\/website-images\\/1753758886_trusted_client_image.png\",\"thumb_image\":\"uploads\\/website-images\\/1753758886_thumb_image.webp\"}}', NULL, NULL, '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"About Company\",\"title\":\"Digital Transforming Brands, Elevating Reach Crafting Success\",\"short_description\":\"Defined by digital dynamism, our digital marketing agency emerges as a beacon of innovation and strategic prowess.\",\"title_1\":\"Expert Team Member\",\"description_1\":\"An SEO Optimization agency is company that specializes\",\"title_2\":\"Custom SEO Support\",\"description_2\":\"These agencies typically offer range of services aimed\",\"trusted_client\":\"Trusted Clients\",\"years_of_experience\":\"25+ Years of Experience\",\"project_complete_count\":\"15\",\"project_complete_keyword\":\"K\",\"project_complete_text\":\"Project Complete\",\"experience_count\":\"10\",\"experience_keyword\":\"K\",\"experience_text\":\"Years of Experience\",\"client_satisfaction_count\":\"28\",\"client_satisfaction_keyword\":\"M\",\"client_satisfaction_text\":\"Satisfactions Customer\",\"expert_team_member_count\":\"50\",\"expert_team_member_keyword\":\"M\",\"expert_team_member_text\":\"Expert Team Member\",\"trusted_client_image\":{},\"thumb_image\":{}}}]'),
(104, 'about_us_digital_transforming_brands.content', '{\"title\":\"Digital Transforming Brands, Elevating Reach Crafting Success\",\"short_description\":\"Defined by digital dynamism, our digital marketing agency emerges as a beacon of innovation and strategic prowess.\",\"explore_service_button\":\"Explore Service\",\"explore_service_button_url\":\"services\",\"award_winning_text\":\"25+ Awards Winning\",\"images\":{\"main_image\":\"uploads\\/website-images\\/1753765225_main_image.webp\"}}', NULL, '2025-08-11 05:00:36', '[{\"language_code\":\"en\",\"values\":{\"title\":\"Digital Transforming Brands, Elevating Reach Crafting Success\",\"short_description\":\"Defined by digital dynamism, our digital marketing agency emerges as a beacon of innovation and strategic prowess.\",\"explore_service_button\":\"Explore Service\",\"explore_service_button_url\":\"services\",\"award_winning_text\":\"25+ Awards Winning\"}}]'),
(105, 'about_us_explore_services.content', '{\"section_name\":\"Explore Services\",\"title\":\"High Impact Marketing Services to grow your business\"}', NULL, NULL, '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"Explore Services\",\"title\":\"High Impact Marketing Services to grow your business\"}}]'),
(106, 'about_us_our_benefit.content', '{\"section_name\":\"Our Benefit\",\"title\":\"Digital Marketing Agency Can Provide Numerous Benefits\",\"title_1\":\"Expertise Marketing\",\"description_1\":\"Provide visualizations an reports time saving for vacation\",\"title_2\":\"Access tools & resources\",\"description_2\":\"Provide visualizations an reports time saving for vacation\",\"title_3\":\"Cost-effectiveness\",\"description_3\":\"Provide visualizations an reports time saving for vacation\",\"title_4\":\"Creativity & innovation\",\"description_4\":\"Provide visualizations an reports time saving for vacation\",\"title_5\":\"Time-saving\",\"description_5\":\"Provide visualizations an reports time saving for vacation\",\"title_6\":\"Consistent results\",\"description_6\":\"Provide visualizations an reports time saving for vacation\",\"popup_video_id\":\"ZUXNCY2R5Wo\",\"images\":{\"play_video_image\":\"uploads\\/website-images\\/1753759029_play_video_image.webp\"}}', NULL, '2025-08-17 08:55:17', '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"Our Benefit\",\"title\":\"Digital Marketing Agency Can Provide Numerous Benefits\",\"title_1\":\"Expertise Marketing\",\"description_1\":\"Provide visualizations an reports time saving for vacation\",\"title_2\":\"Access tools & resources\",\"description_2\":\"Provide visualizations an reports time saving for vacation\",\"title_3\":\"Cost-effectiveness\",\"description_3\":\"Provide visualizations an reports time saving for vacation\",\"title_4\":\"Creativity & innovation\",\"description_4\":\"Provide visualizations an reports time saving for vacation\",\"title_5\":\"Time-saving\",\"description_5\":\"Provide visualizations an reports time saving for vacation\",\"title_6\":\"Consistent results\",\"description_6\":\"Provide visualizations an reports time saving for vacation\",\"popup_video_id\":\"ZUXNCY2R5Wo\"}}]'),
(109, 'about_us_testimonials.content', '{\"section_name\":\"Clients Feedback\",\"title\":\"Our Customer Feedback\"}', NULL, NULL, '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"Clients Feedback\",\"title\":\"Our Customer Feedback\"}}]'),
(110, 'service_faqs.content', '{\"section_name\":\"FAQs\",\"title\":\"Asked Questions & Answer\"}', NULL, NULL, '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"FAQs\",\"title\":\"Asked Questions & Answer\"}}]'),
(111, 'service_explore_services.content', '{\"section_name\":\"Explore Services\",\"title\":\"High Impact Marketing Services to grow your business\"}', NULL, '2025-10-16 05:23:04', '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"Explore Services\",\"title\":\"High Impact Marketing Services to grow your business\"}}]'),
(112, 'faqs_page.content', '{\"section_name\":\"FAQs\",\"title_1\":\"Have Any Questions On Mind? Questions & Answer here\",\"title_2\":\"Feel free to customize these questions and answers to better\",\"image_1\":{},\"image_2\":{},\"images\":{\"image_1\":\"uploads\\/website-images\\/1753789668_image_1.webp\",\"image_2\":\"uploads\\/website-images\\/1753789668_image_2.webp\"}}', NULL, NULL, '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"FAQs\",\"title_1\":\"Have Any Questions On Mind? Questions & Answer here\",\"title_2\":\"Feel free to customize these questions and answers to better\",\"image_1\":{},\"image_2\":{}}}]'),
(113, 'about_us_team_member.content', '{\"section_name\":\"Team Member Nirob\",\"title\":\"Experience Team Member\",\"team_member_count\":\"Team Member\",\"team_member_text\":null,\"join_team_button\":null,\"join_team_button_url\":null}', '2025-08-11 04:48:25', '2025-08-11 04:48:30', '[{\"language_code\":\"en\",\"values\":{\"section_name\":\"Team Member Nirob\",\"title\":\"Experience Team Member\",\"team_member_count\":\"Team Member\",\"team_member_text\":null,\"join_team_button\":null,\"join_team_button_url\":null}}]'),
(114, 'home_5_hero_section.content', '{\"sub_title\":\"Quland Business Agency\",\"title_one\":\"The Innovating Solutions for Your Business Challenges\",\"title_two\":\"Quland digital agency We\\u2019re Modern & effective DIGITAL\",\"title_three\":\"Crafting Smart Answers for Your Business Problems\",\"button_url\":\"services\",\"hero_video_id\":\"ZUXNCY2R5Wo?si=E8zWRcLieSpVH2z4\",\"images\":{\"thumb_image\":\"uploads\\/website-images\\/1754890206_thumb_image.webp\"}}', '2025-08-11 05:30:06', '2025-08-16 10:16:34', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Quland Business Agency\",\"title_one\":\"The Innovating Solutions for Your Business Challenges\",\"title_two\":\"Quland digital agency We\\u2019re Modern & effective DIGITAL\",\"title_three\":\"Crafting Smart Answers for Your Business Problems\",\"button_url\":\"services\",\"hero_video_id\":\"ZUXNCY2R5Wo?si=E8zWRcLieSpVH2z4\"}}]'),
(117, 'home_4_cta_section.content', '{\"sub_title\":\"Get Consultations\",\"title\":\"AI Generate Content in One Seconds\",\"description\":\"No credit card required, 10+ tools to explore\",\"button_text\":\"Start Free Trial\",\"button_url\":\"pricing-plan\",\"cta_shape_one\":{},\"cta_shape_two\":{},\"images\":{\"cta_image\":\"uploads\\/website-images\\/1755059992_cta_image.webp\",\"cta_shape_one\":\"uploads\\/website-images\\/1756531787_cta_shape_one.webp\",\"cta_shape_two\":\"uploads\\/website-images\\/1756531787_cta_shape_two.svg\"}}', '2025-08-13 04:38:45', '2025-08-30 05:29:47', '[{\"language_code\":\"en\",\"values\":{\"sub_title\":\"Get Consultations\",\"title\":\"AI Generate Content in One Seconds\",\"description\":\"No credit card required, 10+ tools to explore\",\"button_text\":\"Start Free Trial\",\"button_url\":\"pricing-plan\",\"cta_shape_one\":{},\"cta_shape_two\":{}}}]');

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE `global_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_settings`
--

INSERT INTO `global_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', 'uploads/website-images/logo-2025-08-10-12-07-50-1608.png', NULL, '2025-08-10 06:07:50'),
(2, 'favicon', 'uploads/website-images/favicon-2025-08-10-12-07-50-2423.png', NULL, '2025-08-10 06:07:50'),
(3, 'app_name', 'Quland', NULL, '2025-11-06 06:24:42'),
(4, 'contact_message_mail', 'quland@gmail.com', NULL, '2025-11-06 06:24:42'),
(5, 'timezone', 'Asia/Dhaka', NULL, '2025-11-06 06:24:42'),
(6, 'selected_theme', 'all_theme', NULL, '2025-11-06 06:24:42'),
(7, 'recaptcha_status', '0', NULL, '2025-10-14 09:21:33'),
(8, 'recaptcha_site_key', '6LdnfvkpAAAAAOoDqEeVqqOA-BIdVmYd4bBPejuq', NULL, '2025-10-14 09:21:33'),
(9, 'recaptcha_secret_key', '6LdnfvkpAAAAAC0GBj1_ERX2y581bVRUdSpNDgJm', NULL, '2025-10-14 09:21:33'),
(10, 'tawk_chat_link', 'https://embed.tawk.to/5a7c31ded7591465c7077c48/default', NULL, '2024-05-07 10:53:59'),
(11, 'tawk_status', '1', NULL, '2024-05-07 10:53:59'),
(12, 'google_analytic_id', '55525522', NULL, '2024-07-10 05:25:46'),
(13, 'google_analytic_status', '0', NULL, '2024-07-10 05:25:46'),
(14, 'pixel_app_id', '156905933', NULL, '2024-07-02 12:10:44'),
(15, 'pixel_status', '1', NULL, '2024-07-02 12:10:44'),
(16, 'placeholder_image', 'uploads/website-images/placeholder-image.png', NULL, '2024-05-07 11:05:22'),
(17, 'cookie_consent_status', '0', NULL, '2024-07-10 07:23:48'),
(18, 'cookie_consent_message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the when an unknown printer took.', NULL, '2024-07-10 07:23:48'),
(19, 'error_image', 'uploads/website-images/error-image-2025-11-06-11-07-26-7742.png', NULL, '2025-11-06 05:07:27'),
(20, 'login_page_bg', 'uploads/website-images/login-bg-image-2025-02-19-06-44-50-4308.png', NULL, '2025-02-19 12:44:50'),
(21, 'admin_login', 'uploads/website-images/admin-bg-image-2025-10-20-09-12-13-2164.png', NULL, '2025-10-20 03:12:13'),
(22, 'breadcrumb_image', 'uploads/website-images/breadcrumb-image-2025-02-19-05-07-58-7890.png', NULL, '2025-02-19 11:07:58'),
(23, 'is_facebook', '1', NULL, '2025-02-26 11:31:49'),
(24, 'facebook_client_id', '1844188565781706', NULL, '2025-02-26 11:31:49'),
(25, 'facebook_secret_id', '18441885657817', NULL, '2025-02-26 11:31:49'),
(26, 'facebook_redirect_url', 'http://localhost/callback/facebook', NULL, '2025-02-26 11:31:49'),
(27, 'is_gmail', '1', NULL, '2025-02-26 11:31:49'),
(28, 'gmail_client_id', '673210704627-g002lb3mstedn57b4geupsfhakcqo316.apps.googleusercontent.com', NULL, '2025-02-26 11:31:49'),
(29, 'gmail_secret_id', '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', NULL, '2025-02-26 11:31:49'),
(30, 'gmail_redirect_url', 'http://localhost/callback/google', NULL, '2025-02-26 11:31:49'),
(31, 'default_avatar', 'uploads/website-images/avatar-image-2025-10-16-10-39-45-3702.webp', NULL, '2025-10-16 04:39:46'),
(32, 'default_cover_image', 'uploads/website-images/default-cover-image-2024-05-09-06-53-46-2041.png', NULL, '2024-05-09 00:53:47'),
(33, 'maintenance_status', '0', NULL, '2025-09-08 06:48:22'),
(34, 'maintenance_image', 'uploads/website-images/maintenance-image-2024-07-08-03-59-12-7938.png', NULL, '2024-07-08 09:59:12'),
(35, 'maintenance_text', 'We are upgrading our site.  We will come back soon.  \r\nPlease stay with us. \r\nThank you.', NULL, '2025-09-08 06:48:22'),
(36, 'app_version', '3.0.0', NULL, '2024-09-15 04:46:44'),
(37, 'facebook_link', 'facebook_link', NULL, NULL),
(38, 'twitter_link', 'twitter_link', NULL, NULL),
(39, 'linkedin_link', 'linkedin_link', NULL, NULL),
(40, 'instagram_link', 'instagram_link', NULL, NULL),
(41, 'footer_logo', 'uploads/website-images/footer-logo-2025-08-10-12-07-50-9657.png', '2024-07-02 11:51:07', '2025-08-10 06:07:50'),
(42, 'empty_image', 'uploads/website-images/empty-2024-05-17-11-50-01-3653.png', '2024-07-03 14:39:42', NULL),
(43, 'not_found', 'uploads/website-images/not-found-2024-05-17-11-50-01-3653.svg', '2024-07-08 10:07:05', NULL),
(44, 'blog_type', 'all', '2024-09-15 03:54:23', '2025-08-16 09:38:36'),
(48, 'white_logo', 'uploads/website-images/white_logo-2025-08-12-10-24-06-9343.png', '2024-12-18 08:49:33', '2025-08-12 04:24:06'),
(49, 'portfolio_type', 'all', '2024-09-15 03:54:23', '2025-08-16 09:38:36'),
(50, 'preloader_status', 'disable', NULL, '2025-11-06 06:24:42'),
(51, 'home_five_logo', 'uploads/website-images/home_five_logo-2025-08-17-12-49-44-2184.png', NULL, '2025-08-17 06:49:44'),
(52, 'home_six_footer_logo', 'uploads/website-images/home_five_logo-2025-08-17-12-53-58-5710.png', NULL, '2025-08-17 06:53:58'),
(53, 'home_six_logo', 'uploads/website-images/home_five_logo-2025-08-17-12-49-44-6916.png', NULL, '2025-08-17 06:49:44'),
(54, 'openai_api_key', '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', '2025-09-23 11:13:35', '2025-09-23 11:45:02'),
(55, 'openai_organization', '', '2025-09-23 11:13:35', '2025-09-23 11:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `homepages`
--

CREATE TABLE `homepages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intro_banner_one` varchar(255) DEFAULT NULL,
  `intro_banner_two` varchar(255) DEFAULT NULL,
  `customer_image` varchar(255) DEFAULT NULL,
  `explore_image` varchar(255) DEFAULT NULL,
  `explore_total_customer` varchar(255) DEFAULT NULL,
  `explore_total_service` varchar(255) DEFAULT NULL,
  `explore_total_job` varchar(255) DEFAULT NULL,
  `join_seller_image` varchar(255) DEFAULT NULL,
  `mobile_app_image` varchar(255) DEFAULT NULL,
  `working_step_icon1` varchar(255) DEFAULT NULL,
  `working_step_icon2` varchar(255) DEFAULT NULL,
  `working_step_icon3` varchar(255) DEFAULT NULL,
  `working_step_icon4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile_playstore` varchar(255) DEFAULT NULL,
  `mobile_appstore` varchar(255) DEFAULT NULL,
  `feature_icon1` varchar(255) DEFAULT NULL,
  `feature_icon2` varchar(255) DEFAULT NULL,
  `feature_icon3` varchar(255) DEFAULT NULL,
  `feature_icon4` varchar(255) DEFAULT NULL,
  `feature_icon5` varchar(255) DEFAULT NULL,
  `home2_intro_bg` varchar(255) DEFAULT NULL,
  `home2_intro_forground` varchar(255) DEFAULT NULL,
  `home2_intro_tags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepages`
--

INSERT INTO `homepages` (`id`, `intro_banner_one`, `intro_banner_two`, `customer_image`, `explore_image`, `explore_total_customer`, `explore_total_service`, `explore_total_job`, `join_seller_image`, `mobile_app_image`, `working_step_icon1`, `working_step_icon2`, `working_step_icon3`, `working_step_icon4`, `created_at`, `updated_at`, `mobile_playstore`, `mobile_appstore`, `feature_icon1`, `feature_icon2`, `feature_icon3`, `feature_icon4`, `feature_icon5`, `home2_intro_bg`, `home2_intro_forground`, `home2_intro_tags`) VALUES
(1, 'uploads/custom-images/intro-one--2024-07-10-12-03-05-5735.webp', 'uploads/custom-images/intro-one--2024-05-14-10-06-01-1053.webp', 'uploads/custom-images/intro-two--2024-07-10-12-24-55-5158.webp', 'uploads/custom-images/explore--2024-07-10-12-28-50-6980.webp', '56', '59', '65', 'uploads/custom-images/working-step--2024-07-10-12-58-03-4540.webp', 'uploads/custom-images/working-step--2024-05-14-12-08-19-7969.webp', 'uploads/custom-images/working-step--2024-07-10-12-34-52-1055.webp', 'uploads/custom-images/working-step--2024-07-10-12-34-52-8063.webp', 'uploads/custom-images/working-step--2024-07-10-12-34-52-8354.webp', 'uploads/custom-images/working-step--2024-07-10-12-34-52-1463.webp', NULL, '2024-07-10 06:58:03', 'Play store link', 'App store link', 'uploads/custom-images/feature_icon1--2024-07-10-12-39-51-1271.webp', 'uploads/custom-images/feature_icon2--2024-07-10-12-45-16-9285.webp', 'uploads/custom-images/feature_icon3--2024-07-10-12-45-16-1439.webp', 'uploads/custom-images/feature_icon4--2024-07-10-12-45-16-7641.webp', 'uploads/custom-images/feature_icon5--2024-07-10-12-45-16-9388.webp', 'uploads/custom-images/intro-one--2024-07-10-12-55-27-4546.webp', 'uploads/custom-images/intro-two--2024-07-10-12-08-32-3503.webp', '[{\"value\":\"laravel\"},{\"value\":\"php\"},{\"value\":\"javascript\"},{\"value\":\"html\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_translations`
--

CREATE TABLE `homepage_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `homepage_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `intro_title` varchar(255) DEFAULT NULL,
  `total_customer` varchar(255) DEFAULT NULL,
  `total_rating` varchar(255) DEFAULT NULL,
  `explore_short_title` varchar(255) DEFAULT NULL,
  `explore_title` text DEFAULT NULL,
  `explore_description` text DEFAULT NULL,
  `working_step_title1` varchar(255) DEFAULT NULL,
  `working_step_title2` varchar(255) DEFAULT NULL,
  `working_step_title3` varchar(255) DEFAULT NULL,
  `working_step_title4` varchar(255) DEFAULT NULL,
  `join_seller_title` text DEFAULT NULL,
  `join_seller_des` text DEFAULT NULL,
  `mobile_app_title` varchar(255) DEFAULT NULL,
  `mobile_app_des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `working_step_des1` varchar(255) DEFAULT NULL,
  `working_step_des2` varchar(255) DEFAULT NULL,
  `working_step_des3` varchar(255) DEFAULT NULL,
  `working_step_des4` varchar(255) DEFAULT NULL,
  `feature_title1` varchar(255) DEFAULT NULL,
  `feature_title2` varchar(255) DEFAULT NULL,
  `feature_title3` varchar(255) DEFAULT NULL,
  `feature_title4` varchar(255) DEFAULT NULL,
  `feature_title5` varchar(255) DEFAULT NULL,
  `home2_intro_title` text DEFAULT NULL,
  `home2_intro_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage_translations`
--

INSERT INTO `homepage_translations` (`id`, `homepage_id`, `lang_code`, `intro_title`, `total_customer`, `total_rating`, `explore_short_title`, `explore_title`, `explore_description`, `working_step_title1`, `working_step_title2`, `working_step_title3`, `working_step_title4`, `join_seller_title`, `join_seller_des`, `mobile_app_title`, `mobile_app_des`, `created_at`, `updated_at`, `working_step_des1`, `working_step_des2`, `working_step_des3`, `working_step_des4`, `feature_title1`, `feature_title2`, `feature_title3`, `feature_title4`, `feature_title5`, `home2_intro_title`, `home2_intro_description`) VALUES
(1, 1, 'en', 'Find Your Perfect <span>Freelancer</span> Quick and Easy', '35M+', '4.9', 'Explore New Life', 'Don’t just find. Be found put your CV in front of great employers', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words.', 'Proof of Quality Works', 'No Cost Until You Hire', 'Safe and Secure Payment Both', 'A whole world of freelance talent at your fingertip', 'Find the talent needed to get your business growing.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.', 'Get a Mobile Application Enjoy Food Experience', 'We\'ve done it carefully and simply. Combined with the ingredients makes for beautiful landings.', NULL, '2024-07-12 09:14:29', 'There are many variations of passages of Lorem our Ipsum available, but the majority have suffered', 'There are many variations of passages of Lorem our Ipsum available, but the majority have suffered', 'There are many variations of passages of Lorem our Ipsum available, but the majority have suffered', 'Pay online with Multiple credit Cards or Cash!', 'Hourly Rated Jobs', 'Projects Gig Catalogue', 'Paid Membership', 'Custom Order', 'Live Chat System', 'Hire the best freelancers for any job, online', 'For optimal online freelancing hires, precisely outline project requirements, select reputable platforms, and thoroughly vet candidates\' profiles, ensuring a seamless collaboration.'),
(9, 1, 'hd', 'Find Your Perfect <span>Freelancer</span> Quick and Easy', '35M+', '4.9', 'Explore New Life', 'Don’t just find. Be found put your CV in front of great employers', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words.', 'Proof of Quality Works', 'No Cost Until You Hire', 'Safe and Secure Payment Both', 'A whole world of freelance talent at your fingertip', 'Find the talent needed to get your business growing.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.', 'Get a Mobile Application Enjoy Food Experience', 'We\'ve done it carefully and simply. Combined with the ingredients makes for beautiful landings.', '2024-07-10 05:34:58', '2024-07-10 05:34:58', 'There are many variations of passages of Lorem our Ipsum available, but the majority have suffered', 'There are many variations of passages of Lorem our Ipsum available, but the majority have suffered', 'There are many variations of passages of Lorem our Ipsum available, but the majority have suffered', NULL, 'Hourly Rated Jobs', 'Projects Gig Catalogue', 'Paid Membership', 'Custom Order', 'Live Chat System', 'Hire the best freelancers for any job, online', 'For optimal online freelancing hires, precisely outline project requirements, select reputable platforms, and thoroughly vet candidates\' profiles, ensuring a seamless collaboration.');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_name` varchar(255) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `lang_direction` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL DEFAULT 'yes',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `lang_code`, `lang_direction`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'left_to_right', 'Yes', 1, '2024-05-07 11:56:30', '2025-08-31 08:22:57'),
(26, 'Spanish', 'esp', 'left_to_right', 'No', 1, '2025-09-09 07:13:41', '2025-09-09 07:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `thumb_image` varchar(255) DEFAULT NULL,
  `theme_2_thumbnail_image` varchar(255) DEFAULT NULL,
  `theme_5_thumbnail_image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'disable',
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `it_business_icon` varchar(255) DEFAULT NULL,
  `saas_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `sub_category_id`, `category_id`, `thumb_image`, `theme_2_thumbnail_image`, `theme_5_thumbnail_image`, `slug`, `status`, `seo_title`, `seo_description`, `created_at`, `updated_at`, `background_image`, `it_business_icon`, `saas_icon`) VALUES
(15, NULL, 9, 'uploads/custom-images/category--2025-08-16-12-10-14-9923.png', 'uploads/custom-images/category--2025-10-15-09-18-40-8183.svg', 'uploads/custom-images/category--2025-10-15-10-30-59-6301.svg', 'website-optimization', 'enable', 'Website Optimization', 'Website Optimization', '2025-02-23 10:49:12', '2025-10-15 07:02:01', 'uploads/custom-images/listing-2025-08-10-11-54-47-7827.webp', 'uploads/custom-images/category--2025-10-15-12-46-10-6015.svg', 'uploads/custom-images/category--2025-10-15-01-02-01-1966.svg'),
(16, NULL, 15, 'uploads/custom-images/category--2025-08-16-12-13-43-6868.png', 'uploads/custom-images/category--2025-10-15-09-19-30-2766.svg', 'uploads/custom-images/category--2025-10-15-10-41-11-3052.svg', 'content-marketing', 'enable', 'Content Marketing', 'Content Marketing', '2025-02-23 10:49:12', '2025-10-15 07:02:50', 'uploads/custom-images/listing-2025-08-10-11-56-14-1570.webp', 'uploads/custom-images/category--2025-10-15-12-46-50-1204.svg', 'uploads/custom-images/category--2025-10-15-01-02-50-6996.svg'),
(17, NULL, 15, 'uploads/custom-images/category--2025-10-15-10-55-35-5348.svg', NULL, 'uploads/custom-images/category--2025-10-15-10-51-53-3377.svg', 'website-design', 'enable', 'Website Design', 'Website Design', '2025-02-23 10:49:12', '2025-10-15 07:03:40', 'uploads/custom-images/listing-2025-08-10-11-47-22-9730.webp', NULL, 'uploads/custom-images/category--2025-10-15-01-03-40-3059.svg'),
(18, NULL, 9, 'uploads/custom-images/category--2025-08-10-11-49-12-1739.png', NULL, 'uploads/custom-images/category--2025-10-15-10-46-18-7193.svg', 'media-marketing', 'enable', 'Media Marketing', 'Media Marketing', '2025-02-23 10:49:12', '2025-10-15 07:04:27', 'uploads/custom-images/listing-2025-08-10-11-49-12-5842.webp', NULL, 'uploads/custom-images/category--2025-10-15-01-04-27-3760.svg'),
(19, NULL, 14, 'uploads/custom-images/category--2025-10-15-10-57-24-2928.svg', NULL, 'uploads/custom-images/category--2025-10-15-10-57-24-1664.svg', 'design-branding', 'enable', 'Design & branding', 'Design & branding', '2025-02-23 10:49:12', '2025-10-15 07:05:02', 'uploads/custom-images/listing-2025-08-10-11-51-15-6476.webp', NULL, 'uploads/custom-images/category--2025-10-15-01-05-02-7700.svg'),
(20, NULL, 14, 'uploads/custom-images/category--2025-08-16-12-03-21-6954.png', NULL, 'uploads/custom-images/category--2025-10-15-10-43-22-5399.svg', 'Data-Tracking-Security', 'enable', 'Data Tracking Security', 'Data Tracking Security', '2025-02-23 10:49:12', '2025-10-15 07:05:39', 'uploads/custom-images/listing-2025-08-10-11-53-20-7297.webp', NULL, 'uploads/custom-images/category--2025-10-15-01-05-39-2965.svg'),
(22, NULL, 9, 'uploads/custom-images/category--2025-08-16-12-09-30-3520.png', 'uploads/custom-images/category--2025-10-15-09-17-14-2837.svg', 'uploads/custom-images/category--2025-10-15-10-30-10-1502.svg', 'keyword-research', 'enable', 'Keyword Research', 'Keyword Research', '2025-07-23 06:38:30', '2025-10-15 07:00:44', 'uploads/custom-images/listing-2025-08-30-02-04-27-1514.webp', 'uploads/custom-images/category--2025-10-15-12-45-32-6271.svg', 'uploads/custom-images/category--2025-10-15-01-00-44-5245.svg'),
(23, NULL, 5, 'uploads/custom-images/category--2025-08-16-12-10-34-8169.png', 'uploads/custom-images/category--2025-10-15-09-42-37-9648.svg', 'uploads/custom-images/category--2025-10-15-10-41-56-9008.svg', 'website-development', 'enable', 'Website Design', 'Website Design', '2025-08-10 05:58:19', '2025-10-15 06:59:47', 'uploads/custom-images/listing-2025-08-10-11-58-18-1161.webp', 'uploads/custom-images/category--2025-10-15-12-44-09-8968.svg', 'uploads/custom-images/category--2025-10-15-12-59-47-4393.svg');

-- --------------------------------------------------------

--
-- Table structure for table `listing_translations`
--

CREATE TABLE `listing_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `short_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_translations`
--

INSERT INTO `listing_translations` (`id`, `listing_id`, `lang_code`, `title`, `description`, `short_description`, `created_at`, `updated_at`) VALUES
(29, 15, 'en', 'Website Optimization', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-02-23 10:49:12', '2025-08-10 05:41:42'),
(31, 16, 'en', 'Content Marketing', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-02-23 10:49:12', '2025-08-10 05:56:14'),
(33, 17, 'en', 'Website Design', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-02-23 10:49:12', '2025-10-15 04:55:52'),
(35, 18, 'en', 'Media Marketing', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-02-23 10:49:12', '2025-08-10 05:49:12'),
(37, 19, 'en', 'Design & branding', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-02-23 10:49:12', '2025-10-15 04:57:24'),
(39, 20, 'en', 'Data Tracking Security', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-02-23 10:49:12', '2025-02-23 10:49:33'),
(43, 22, 'en', 'Keyword Research', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-07-23 06:38:30', '2025-08-10 06:44:50'),
(45, 23, 'en', 'Website Development', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'They identify relevant keywords and phrases that potential customers use search for products, services, or information related to their\' businesses.', '2025-08-10 05:58:19', '2025-10-15 08:47:31'),
(79, 15, 'esp', 'Website Optimization', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(80, 16, 'esp', 'Content Marketing', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(81, 17, 'esp', 'Email Marketing', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(82, 18, 'esp', 'Media Marketing', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(83, 19, 'esp', 'IT Management Service', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(84, 20, 'esp', 'Data Tracking Security', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(85, 22, 'esp', 'Keyword Research', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(86, 23, 'esp', 'Website Design', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>Features</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Goal</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining cutting-edge technology and strategic expertise to optimize your digital operations. From proactive system monitoring to rapid issue resolution, our team ensures that your IT environment remains secure, scalable, and highly efficient. With tailored solutions that align with your business objectives', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `manage_sections`
--

CREATE TABLE `manage_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `component_name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_sections`
--

INSERT INTO `manage_sections` (`id`, `page_name`, `section_name`, `component_name`, `status`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 'home_one', 'hero_section', '_hero_section', 1, 1, NULL, '2025-08-31 08:17:24'),
(2, 'home_one', 'partner_section', '_partner_section', 1, 2, NULL, '2025-08-31 08:17:24'),
(3, 'home_one', 'about_section', '_about_section', 1, 3, NULL, '2025-08-31 08:17:24'),
(4, 'home_one', 'our_fun_fact_section', '_our_fun_fact_section', 1, 4, NULL, '2025-08-31 08:17:24'),
(5, 'home_one', 'services_section', '_service_section', 1, 5, NULL, '2025-08-31 08:17:24'),
(6, 'home_one', 'working_process', '_wroking_process_section', 1, 6, NULL, '2025-08-31 08:17:24'),
(7, 'home_one', 'testimonials_section', '_testimonial_section', 1, 7, NULL, '2025-08-31 08:17:24'),
(8, 'home_one', 'blog_section', '_blog_section', 1, 8, NULL, '2025-08-31 08:17:24'),
(9, 'home_one', 'cta_section', '_cta_section', 1, 9, NULL, '2025-08-31 08:17:24'),
(10, 'home_two', 'hero_section', '_hero_section', 1, 1, NULL, NULL),
(11, 'home_two', 'features_section', '_features_section', 1, 2, NULL, NULL),
(12, 'home_two', 'partner_section', '_partner_section', 1, 3, NULL, NULL),
(13, 'home_two', 'about_section', '_about_section', 1, 4, NULL, NULL),
(14, 'home_two', 'services_case_study_section', '_services_case_study_section', 1, 5, NULL, NULL),
(16, 'home_two', 'testimonials_section', '_testimonial_section', 1, 6, NULL, '2025-08-31 04:57:25'),
(17, 'home_two', 'faqs_section', '_faq_section', 1, 7, NULL, '2025-08-31 04:57:25'),
(18, 'home_two', 'cta_section', '_cta_section', 1, 8, NULL, '2025-08-31 04:57:25'),
(19, 'home_three', 'hero_section', '_hero_section', 1, 1, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(20, 'home_three', 'about_section', '_about_section', 1, 2, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(21, 'home_three', 'popular_services', '_services_section', 1, 3, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(22, 'home_three', 'case_studies_section', '_case_study_section', 1, 4, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(23, 'home_three', 'team_member_section', '_team_section', 1, 5, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(24, 'home_three', 'pricing_section', '_pricing_plan', 1, 6, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(25, 'home_three', 'our_testimonials_section', '_testimonial_section', 1, 7, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(26, 'home_three', 'blog_section', '_blog_section', 1, 8, '2025-08-30 10:37:04', '2025-08-30 10:44:40'),
(27, 'home_four', 'hero_section', '_hero_section', 1, 1, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(28, 'home_four', 'our_cool_features_section', '_features_section', 1, 2, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(29, 'home_four', 'what_we_do_section', '_what_we_do_section', 1, 3, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(30, 'home_four', 'pricing_package_section', '_pricing_section', 1, 4, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(31, 'home_four', 'faqs_section', '_faq_section', 1, 5, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(32, 'home_four', 'our_testimonials_section', '_testimonial_section', 1, 6, '2025-08-30 10:37:04', '2025-08-31 05:48:21'),
(33, 'home_four', 'cta_section', '_cta_section', 1, 7, '2025-08-30 10:37:04', '2025-08-31 05:47:48'),
(34, 'home_five', 'hero_section', '_hero_section', 1, 1, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(35, 'home_five', 'about_section', '_about_section', 1, 2, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(36, 'home_five', 'provide_section', '_provide_section', 1, 3, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(37, 'home_five', 'team_member_section', '_team_section', 1, 4, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(38, 'home_five', 'project_section', '_success_story_section', 1, 5, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(39, 'home_five', 'counter_section', '_counter_section', 1, 6, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(40, 'home_five', 'testimonial_section', '_testimonial_section', 1, 7, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(41, 'home_five', 'blog_section', '_blog_section', 1, 8, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(42, 'home_five', 'partner_section', '_partner_section', 1, 9, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(43, 'home_five', 'cta_section', '_cta_section', 1, 10, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(44, 'home_six', 'hero_section', '_hero_section', 1, 1, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(45, 'home_six', 'about_section', '_about_section', 1, 2, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(46, 'home_six', 'service_section', '_services_section', 1, 3, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(47, 'home_six', 'working_process_section', '_working_process_section', 1, 4, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(48, 'home_six', 'project_section', '_project_section', 1, 5, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(49, 'home_six', 'benefits_section', '_benefits_section', 1, 6, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(50, 'home_six', 'testimonials_section', '_testimonial_section', 1, 7, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(51, 'home_six', 'faq_section', '_faq_section', 1, 8, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(52, 'home_six', 'cta_section', '_cta_section', 1, 9, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(53, 'home_seven', 'hero_section', '_hero_section', 1, 1, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(54, 'home_seven', 'partner_section', '_partner_section', 1, 2, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(55, 'home_seven', 'why_use_us_section', '_use_us_section', 1, 3, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(56, 'home_seven', 'services_section', '_feature_service_section', 1, 4, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(57, 'home_seven', 'counter_section', '_counter_section', 1, 5, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(58, 'home_seven', 'feature_section', '_core_feature_section', 1, 6, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(59, 'home_seven', 'build_products_section', '_why_use_us_section', 1, 7, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(61, 'home_seven', 'faq_section', '_faq_section', 1, 8, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(62, 'home_seven', 'video_section', '_video_section', 1, 9, '2025-08-30 10:37:04', '2025-08-30 10:37:04'),
(63, 'home_three', 'cta_section', '_cta_section', 1, 9, '2025-08-30 10:37:04', '2025-08-30 10:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'header',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `location`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Header', 'header', 1, 1, '2025-08-12 02:53:12', '2025-08-12 03:16:05'),
(7, 'Footer', 'footer', 1, 2, '2025-08-12 09:05:42', '2025-08-12 09:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(255) NOT NULL DEFAULT '_self',
  `icon` varchar(255) DEFAULT NULL,
  `css_class` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `title`, `url`, `target`, `icon`, `css_class`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(17, 6, NULL, 'Home', NULL, '_self', NULL, NULL, 1, 1, '2025-08-12 03:16:27', '2025-08-12 03:16:27'),
(18, 6, NULL, 'About Us', '/about-us', '_self', NULL, NULL, 2, 1, '2025-08-12 03:16:51', '2025-10-21 02:54:01'),
(19, 6, 21, 'Services', '/services', '_self', NULL, NULL, 3, 1, '2025-08-12 03:17:25', '2025-09-09 04:27:30'),
(20, 6, NULL, 'Blogs', '/blogs', '_self', NULL, NULL, 4, 1, '2025-08-12 03:19:00', '2025-08-12 03:19:00'),
(21, 6, NULL, 'Pages', NULL, '_self', NULL, NULL, 5, 1, '2025-08-12 03:19:24', '2025-08-12 03:19:24'),
(22, 6, 21, 'Projects', '/portfolio', '_self', NULL, NULL, 1, 1, '2025-08-12 03:26:12', '2025-08-12 03:26:12'),
(23, 6, 21, 'Pricing', '/pricing-plan', '_self', NULL, NULL, 2, 1, '2025-08-12 03:29:16', '2025-08-12 03:29:16'),
(24, 6, 21, 'Team Members', '/teams', '_self', NULL, NULL, 2, 1, '2025-08-12 03:29:42', '2025-08-12 03:31:44'),
(25, 6, 21, 'FAQ\'S', '/faq', '_self', NULL, NULL, 3, 1, '2025-08-12 03:30:20', '2025-08-12 03:30:38'),
(27, 6, NULL, 'Shop', '/shop', '_self', NULL, NULL, 3, 1, '2025-08-12 03:33:12', '2025-09-09 04:26:15'),
(28, 6, NULL, 'Contact', '/contact-us', '_self', NULL, NULL, 6, 1, '2025-08-12 03:33:59', '2025-08-12 03:33:59'),
(29, 6, 17, 'Digital Marketing', '?theme=theme_five', '_self', NULL, NULL, 5, 1, '2025-08-12 03:34:38', '2025-10-20 03:59:47'),
(30, 6, 17, 'SEO Agency', '?theme=theme_two', '_self', NULL, NULL, 2, 1, '2025-08-12 03:35:33', '2025-08-12 03:35:33'),
(31, 6, 17, 'Creative Agency', '?theme=theme_three', '_self', NULL, NULL, 3, 1, '2025-08-12 08:27:48', '2025-08-12 08:27:48'),
(32, 6, 17, 'AI Software', '?theme=theme_four', '_self', NULL, NULL, 4, 1, '2025-08-12 08:28:27', '2025-08-12 08:28:27'),
(33, 6, 17, 'Business Consulting', '?theme=theme_one', '_self', NULL, NULL, 0, 1, '2025-08-12 08:28:57', '2025-10-20 03:56:16'),
(34, 6, 17, 'IT Business', '?theme=theme_six', '_self', NULL, NULL, 6, 1, '2025-08-12 08:29:28', '2025-08-16 09:50:07'),
(35, 6, 17, 'Saas', '?theme=theme_seven', '_self', NULL, NULL, 7, 1, '2025-08-12 08:29:57', '2025-08-16 09:50:24'),
(37, 6, 21, 'Privacy Policy', '/privacy-policy', '_self', NULL, NULL, 8, 1, '2025-08-12 08:35:14', '2025-08-12 08:35:14'),
(38, 6, 21, 'Terms & Conditions', '/terms-conditions', '_self', NULL, NULL, 6, 1, '2025-08-12 08:54:32', '2025-08-12 08:54:32'),
(39, 6, 21, 'Custom Page one', '/custom-page/custom-page-one', '_self', NULL, NULL, 8, 1, '2025-08-12 08:55:39', '2025-10-20 06:10:32'),
(45, 7, NULL, 'Services', NULL, '_self', NULL, NULL, 1, 1, '2025-08-12 09:48:15', '2025-08-12 09:48:15'),
(46, 7, 45, 'Keyword Research', '/service/keyword-research', '_self', NULL, NULL, 1, 1, '2025-08-12 09:50:10', '2025-10-14 10:30:47'),
(47, 7, 45, 'Email marketing', '/service/design-branding', '_self', NULL, NULL, 2, 1, '2025-08-12 09:51:13', '2025-10-27 05:02:15'),
(48, 7, 45, 'Content marketing', '/service/content-marketing', '_self', NULL, NULL, 3, 1, '2025-08-12 09:51:37', '2025-10-14 10:32:38'),
(49, 7, 45, 'Web Development', '/service/website-design', '_self', NULL, NULL, 4, 1, '2025-08-12 09:52:59', '2025-10-14 10:36:25'),
(51, 7, NULL, 'Quick Link', NULL, '_self', NULL, NULL, 2, 1, '2025-08-12 09:55:04', '2025-08-12 09:55:04'),
(54, 7, 51, 'Create a ticket', '/user/ticket-support/create', '_self', NULL, NULL, 3, 1, '2025-08-12 09:56:51', '2025-10-14 10:56:20'),
(55, 7, 51, 'Meet Our Team', '/teams', '_self', NULL, NULL, 4, 1, '2025-08-12 09:57:36', '2025-08-12 09:57:36'),
(56, 7, 51, 'FAQs', '/faq', '_self', NULL, NULL, 5, 1, '2025-08-12 09:57:54', '2025-08-12 09:57:54'),
(57, 7, NULL, 'Company', NULL, '_self', NULL, NULL, 3, 1, '2025-08-12 09:58:45', '2025-08-12 09:58:45'),
(58, 7, 57, 'About us', '/about-us', '_self', NULL, NULL, 1, 1, '2025-08-12 09:59:24', '2025-08-12 09:59:24'),
(59, 7, 57, 'Projects', '/portfolio', '_self', NULL, NULL, 2, 1, '2025-08-12 09:59:52', '2025-08-12 09:59:52'),
(60, 7, 57, 'News & Blog', '/blogs', '_self', NULL, NULL, 3, 1, '2025-08-12 10:00:33', '2025-08-12 10:00:33'),
(61, 7, 57, 'Pricing', '/pricing-plan', '_self', NULL, NULL, 4, 1, '2025-08-12 10:01:12', '2025-08-12 10:01:12'),
(62, 7, 57, 'Contact Us', '/contact-us', '_self', NULL, NULL, 5, 1, '2025-08-12 10:01:31', '2025-08-12 10:01:31'),
(65, 7, 51, 'Cart View', '/cart/view', '_self', NULL, NULL, 1, 1, '2025-10-14 11:11:31', '2025-10-14 11:12:49'),
(66, 7, 51, 'Wish List', '/user/wishlist', '_self', NULL, NULL, 2, 1, '2025-10-14 11:13:49', '2025-10-14 11:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_translations`
--

CREATE TABLE `menu_item_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_item_translations`
--

INSERT INTO `menu_item_translations` (`id`, `menu_item_id`, `locale`, `title`, `created_at`, `updated_at`) VALUES
(33, 17, 'en', 'Home', '2025-08-12 03:16:27', '2025-08-12 03:16:27'),
(34, 17, 'hd', 'Home', '2025-08-12 03:16:27', '2025-08-12 03:16:27'),
(35, 18, 'en', 'About Us', '2025-08-12 03:16:51', '2025-09-09 04:22:12'),
(36, 18, 'hd', 'About Us', '2025-08-12 03:16:51', '2025-09-09 04:29:49'),
(37, 19, 'en', 'Services', '2025-08-12 03:17:25', '2025-08-12 03:17:25'),
(38, 19, 'hd', 'Services', '2025-08-12 03:17:25', '2025-08-12 03:17:25'),
(39, 20, 'en', 'Blogs', '2025-08-12 03:19:00', '2025-08-12 03:19:00'),
(40, 20, 'hd', 'Blogs', '2025-08-12 03:19:00', '2025-08-12 03:19:00'),
(41, 21, 'en', 'Pages', '2025-08-12 03:19:24', '2025-08-12 03:19:24'),
(42, 21, 'hd', 'Pages', '2025-08-12 03:19:24', '2025-08-12 03:19:24'),
(43, 22, 'en', 'Projects', '2025-08-12 03:26:12', '2025-08-12 03:26:12'),
(44, 22, 'hd', 'Projects', '2025-08-12 03:26:12', '2025-08-12 03:26:12'),
(45, 23, 'en', 'Pricing', '2025-08-12 03:29:16', '2025-08-12 03:29:16'),
(46, 23, 'hd', 'Pricing', '2025-08-12 03:29:16', '2025-08-12 03:29:16'),
(47, 24, 'en', 'Team Members', '2025-08-12 03:29:42', '2025-08-12 03:29:42'),
(48, 24, 'hd', 'Team Members', '2025-08-12 03:29:42', '2025-08-12 03:29:42'),
(49, 25, 'en', 'FAQ\'S', '2025-08-12 03:30:20', '2025-08-12 03:30:20'),
(50, 25, 'hd', 'FAQ\'S', '2025-08-12 03:30:20', '2025-08-12 03:30:20'),
(53, 27, 'en', 'Shop', '2025-08-12 03:33:12', '2025-08-12 03:33:12'),
(54, 27, 'hd', 'Shop', '2025-08-12 03:33:12', '2025-08-12 03:33:12'),
(55, 28, 'en', 'Contact', '2025-08-12 03:33:59', '2025-08-12 03:33:59'),
(56, 28, 'hd', 'Contact', '2025-08-12 03:33:59', '2025-08-12 03:33:59'),
(57, 29, 'en', 'Digital Marketing', '2025-08-12 03:34:38', '2025-08-12 03:34:38'),
(58, 29, 'hd', 'Digital Marketing', '2025-08-12 03:34:38', '2025-08-12 03:34:38'),
(59, 30, 'en', 'SEO Agency', '2025-08-12 03:35:33', '2025-08-12 03:35:33'),
(60, 30, 'hd', 'SEO Agency', '2025-08-12 03:35:33', '2025-08-12 03:35:33'),
(61, 31, 'en', 'Creative Agency', '2025-08-12 08:27:48', '2025-08-12 08:27:48'),
(62, 31, 'hd', 'Creative Agency', '2025-08-12 08:27:48', '2025-08-12 08:27:48'),
(63, 32, 'en', 'AI Software', '2025-08-12 08:28:27', '2025-08-12 08:28:27'),
(64, 32, 'hd', 'AI Software', '2025-08-12 08:28:27', '2025-08-12 08:28:27'),
(65, 33, 'en', 'Business Consulting', '2025-08-12 08:28:57', '2025-08-12 08:28:57'),
(66, 33, 'hd', 'Business Consulting', '2025-08-12 08:28:57', '2025-08-12 08:28:57'),
(67, 34, 'en', 'IT Business', '2025-08-12 08:29:28', '2025-08-12 08:29:28'),
(68, 34, 'hd', 'IT Business', '2025-08-12 08:29:28', '2025-08-12 08:29:28'),
(69, 35, 'en', 'Saas', '2025-08-12 08:29:57', '2025-08-12 08:29:57'),
(70, 35, 'hd', 'Saas', '2025-08-12 08:29:57', '2025-08-12 08:29:57'),
(73, 37, 'en', 'Privacy Policy', '2025-08-12 08:35:14', '2025-08-12 08:35:14'),
(74, 37, 'hd', 'Privacy Policy', '2025-08-12 08:35:14', '2025-08-12 08:35:14'),
(75, 38, 'en', 'Terms & Conditions', '2025-08-12 08:54:32', '2025-08-12 08:54:32'),
(76, 38, 'hd', 'Terms & Conditions', '2025-08-12 08:54:32', '2025-08-12 08:54:32'),
(77, 39, 'en', 'Custom Page one', '2025-08-12 08:55:39', '2025-08-12 08:55:39'),
(78, 39, 'hd', 'Custom Page one', '2025-08-12 08:55:39', '2025-08-12 08:55:39'),
(89, 45, 'en', 'Services', '2025-08-12 09:48:15', '2025-08-12 09:48:15'),
(90, 45, 'hd', 'Services', '2025-08-12 09:48:15', '2025-08-12 09:48:15'),
(91, 46, 'en', 'Keyword Research', '2025-08-12 09:50:10', '2025-08-12 09:50:10'),
(92, 46, 'hd', 'Keyword Research', '2025-08-12 09:50:10', '2025-08-12 09:50:10'),
(93, 47, 'en', 'Design & branding', '2025-08-12 09:51:13', '2025-10-27 05:02:15'),
(94, 47, 'hd', 'Email marketing', '2025-08-12 09:51:13', '2025-08-12 09:51:13'),
(95, 48, 'en', 'Content marketing', '2025-08-12 09:51:37', '2025-08-12 09:51:37'),
(96, 48, 'hd', 'Content marketing', '2025-08-12 09:51:37', '2025-08-12 09:51:37'),
(97, 49, 'en', 'Web Development', '2025-08-12 09:52:59', '2025-08-12 09:52:59'),
(98, 49, 'hd', 'Web Development', '2025-08-12 09:52:59', '2025-08-12 09:52:59'),
(101, 51, 'en', 'Quick Link', '2025-08-12 09:55:04', '2025-08-12 09:55:04'),
(102, 51, 'hd', 'Quick Link', '2025-08-12 09:55:04', '2025-08-12 09:55:04'),
(107, 54, 'en', 'Create a ticket', '2025-08-12 09:56:51', '2025-08-12 09:56:51'),
(108, 54, 'hd', 'Create a ticket', '2025-08-12 09:56:51', '2025-08-12 09:56:51'),
(109, 55, 'en', 'Meet Our Team', '2025-08-12 09:57:36', '2025-08-12 09:57:36'),
(110, 55, 'hd', 'Meet Our Team', '2025-08-12 09:57:36', '2025-08-12 09:57:36'),
(111, 56, 'en', 'FAQs', '2025-08-12 09:57:54', '2025-08-12 09:57:54'),
(112, 56, 'hd', 'FAQs', '2025-08-12 09:57:54', '2025-08-12 09:57:54'),
(113, 57, 'en', 'Company', '2025-08-12 09:58:45', '2025-08-12 09:58:45'),
(114, 57, 'hd', 'Company', '2025-08-12 09:58:45', '2025-08-12 09:58:45'),
(115, 58, 'en', 'About us', '2025-08-12 09:59:24', '2025-08-12 09:59:24'),
(116, 58, 'hd', 'About us', '2025-08-12 09:59:24', '2025-08-12 09:59:24'),
(117, 59, 'en', 'Projects', '2025-08-12 09:59:52', '2025-08-12 09:59:52'),
(118, 59, 'hd', 'Projects', '2025-08-12 09:59:52', '2025-08-12 09:59:52'),
(119, 60, 'en', 'News & Blog', '2025-08-12 10:00:33', '2025-08-12 10:00:33'),
(120, 60, 'hd', 'News & Blog', '2025-08-12 10:00:33', '2025-08-12 10:00:33'),
(121, 61, 'en', 'Pricing', '2025-08-12 10:01:12', '2025-08-12 10:01:12'),
(122, 61, 'hd', 'Pricing', '2025-08-12 10:01:12', '2025-08-12 10:01:12'),
(123, 62, 'en', 'Contact Us', '2025-08-12 10:01:31', '2025-08-12 10:01:31'),
(124, 62, 'hd', 'Contact Us', '2025-08-12 10:01:31', '2025-08-12 10:01:31'),
(129, 65, 'en', 'Cart View', '2025-10-14 11:11:31', '2025-10-14 11:11:31'),
(130, 65, 'esp', 'Cart View', '2025-10-14 11:11:31', '2025-10-14 11:11:31'),
(131, 66, 'en', 'Wish List', '2025-10-14 11:13:49', '2025-10-14 11:13:49'),
(132, 66, 'esp', 'Wish List', '2025-10-14 11:13:49', '2025-10-14 11:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `menu_translations`
--

CREATE TABLE `menu_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_documents`
--

CREATE TABLE `message_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_id` int(11) NOT NULL DEFAULT 1,
  `file_name` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_documents`
--

INSERT INTO `message_documents` (`id`, `message_id`, `file_name`, `model_name`, `created_at`, `updated_at`) VALUES
(1, 4, 'support-ticket-17586930520.jpg', 'SupportTicketMessage', '2025-09-24 05:50:52', '2025-09-24 05:50:52'),
(3, 20, 'support-ticket-17600009600.jpg', 'SupportTicketMessage', '2025-10-09 09:09:20', '2025-10-09 09:09:20');

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
(8, '2014_10_12_100000_create_password_resets_table', 2),
(9, '2024_05_06_161335_create_admins_table', 3),
(10, '2024_05_06_182035_create_global_settings_table', 4),
(11, '2024_05_07_174113_create_languages_table', 5),
(12, '2024_05_07_180516_create_currencies_table', 6),
(15, '2024_05_09_045544_create_testimonials_table', 7),
(16, '2024_05_09_045555_create_testimonial_trasnlations_table', 7),
(19, '2024_05_09_080956_create_email_settings_table', 8),
(20, '2024_05_09_082850_create_email_templates_table', 9),
(21, '2024_05_09_090449_add_statu_to_users', 10),
(22, '2024_05_09_090506_add_personal_info_to_admins', 10),
(23, '2024_05_09_091106_add_avatar_to_admins', 11),
(24, '2024_05_09_100009_create_seo_settings_table', 12),
(27, '2024_05_09_110823_create_term_and_conditions_table', 13),
(28, '2024_05_09_111521_create_privacy_policies_table', 13),
(29, '2024_05_09_114012_create_faqs_table', 14),
(30, '2024_05_09_114027_create_faq_translations_table', 14),
(31, '2024_05_08_151634_create_blogs_table', 15),
(32, '2024_05_08_152208_create_blog_categories_table', 15),
(33, '2024_05_08_152741_create_blog_translations_table', 15),
(34, '2024_05_08_152807_create_blog_category_translations_table', 15),
(35, '2024_05_12_064013_create_blog_comments_table', 16),
(36, '2024_01_31_044113_create_cities_table', 17),
(37, '2024_01_31_045030_create_city_translations_table', 17),
(38, '2024_02_24_052456_create_categories_table', 17),
(39, '2024_02_24_054937_create_sub_categories_table', 17),
(40, '2024_02_24_054952_create_sub_category_translations_table', 17),
(44, '2024_05_13_053040_add_city_image_to_cities', 18),
(45, '2024_05_13_060052_create_category_translations', 19),
(46, '2024_05_13_062301_add_icon_to_categories', 20),
(47, '2024_05_13_062424_add_category_id_to_category_translation', 21),
(48, '2024_05_13_081716_create_payment_gateways_table', 22),
(53, '2024_05_13_121650_create_homepages_table', 24),
(54, '2024_05_13_122614_create_homepage_translations_table', 24),
(55, '2024_05_14_102923_add_working_des_to_homepage_translations', 25),
(56, '2024_05_14_115626_add_app_link_to_homepages', 26),
(58, '2024_01_31_092624_create_listing_translations_table', 50),
(59, '2024_02_01_104552_create_listing_galleries_table', 50),
(60, '2024_03_20_060641_create_job_requests_table', 27),
(61, '2024_05_02_171413_create_job_posts_table', 27),
(62, '2024_05_02_171618_create_job_post_translations_table', 27),
(63, '2024_05_14_144849_add_banned_to_users', 28),
(64, '2024_05_15_163816_create_about_us_table', 29),
(65, '2024_05_15_163829_create_about_us_translations_table', 29),
(66, '2024_05_27_161629_create_listing_packages_table', 50),
(67, '2024_06_09_155059_create_newsletters_table', 31),
(68, '2024_06_15_154748_create_footers_table', 32),
(69, '2024_06_15_155130_create_footer_translations_table', 32),
(70, '2024_06_26_105119_create_orders_table', 33),
(71, '2024_06_28_122222_create_reviews_table', 34),
(72, '2024_06_28_145313_create_withdraw_methods_table', 34),
(73, '2024_06_28_161601_create_seller_withdraws_table', 34),
(74, '2024_07_02_220449_create_custom_pages_table', 35),
(75, '2024_07_02_221522_create_custom_page_translations_table', 35),
(76, '2024_07_03_121953_create_contact_messages_table', 36),
(77, '2024_07_03_125356_add_features_to_homepages', 37),
(78, '2024_07_03_125617_add_features_to_homepage_translations', 38),
(79, '2024_07_06_105541_add_home2_intro_to_homepages', 39),
(80, '2024_07_06_105607_add_home2_intro_to_homepage_translations', 39),
(81, '2024_07_06_171027_create_wishlists_table', 40),
(82, '2024_07_25_123830_create_messages_table', 41),
(83, '2024_07_25_204121_create_wallets_table', 42),
(84, '2024_07_25_204251_create_wallet_transactions_table', 42),
(85, '2024_07_28_212722_add_submit_file_to_orders', 43),
(86, '2024_07_28_215446_create_refund_requests_table', 43),
(89, '2024_08_24_165133_create_sub_categories_table', 44),
(90, '2024_08_24_165613_create_sub_category_translates_table', 44),
(92, '2024_08_27_155829_create_kyc_types_table', 46),
(93, '2024_08_27_155830_create_kyc_information_table', 46),
(94, '2024_08_27_182402_add_kyc_status_to_users_table', 46),
(95, '2024_08_28_141156_add_status_columns_to_users_table', 46),
(102, '2024_11_25_125500_create_frontends_table', 48),
(103, '2024_12_19_162802_add_data_translations_column_to_frontends_table', 49),
(106, '2024_08_25_122955_add_category_id_to_listings_table', 52),
(107, '2024_01_31_090220_create_listings_table', 53),
(110, '2024_12_28_144301_create_project_galleries_table', 54),
(111, '2024_12_28_160450_add_rating_column_to_testimonial_table', 54),
(114, '2024_12_28_144245_create_project_translations_table', 56),
(115, '2024_12_28_144236_create_projects_table', 57),
(117, '2025_01_05_163935_create_sliders_table', 59),
(119, '2025_01_05_163956_create_slider_translations_table', 60),
(120, '2025_01_06_190028_create_team_translations_table', 62),
(121, '2024_12_30_142443_create_teams_table', 63),
(124, '2024_11_02_102600_create_product_galleries_table', 64),
(125, '2024_11_02_105807_create_product_reviews_table', 64),
(126, '2024_11_05_061817_create_carts_table', 64),
(127, '2024_11_05_070331_create_orders_table', 65),
(128, '2024_11_05_070354_create_order_details_table', 65),
(129, '2024_11_05_074635_create_shipping_methods_table', 65),
(131, '2024_11_02_102556_create_product_translations_table', 66),
(132, '2025_01_11_170518_create_wishlists_table', 67),
(135, '2024_01_30_110607_create_brand_translations_table', 69),
(136, '2024_01_30_104319_create_brands_table', 70),
(137, '2024_11_02_102551_create_products_table', 71),
(139, '2025_02_17_111625_add_long_des_to_products_table', 72),
(140, '2025_02_22_110050_add_background_image_to_listings_table', 73),
(141, '2024_12_26_172846_create_partners_table', 74),
(142, '2025_07_24_154240_add_short_description_to_project_translations_table', 75),
(143, '2025_07_29_085745_add_short_description_to_blog_translations_table', 76),
(148, '2025_07_29_145707_add_project_overview_to_project_translations_table', 77),
(149, '2025_07_29_150011_add_reviewer_details_to_projects_table', 77),
(151, '2025_08_04_085543_add_quantity_sku_to_products_table', 79),
(152, '2024_09_29_054314_create_countries_table', 80),
(153, '2024_12_01_000004_add_foreign_keys_to_users_table', 80),
(154, '2025_05_05_180325_create_states_table', 80),
(155, '2025_05_05_180711_create_state_translations_table', 80),
(156, '2024_02_11_095157_create_subscription_plans_table', 81),
(157, '2024_01_01_000001_create_menus_table', 82),
(158, '2024_01_01_000002_create_menu_items_table', 82),
(159, '2024_01_01_000003_create_menu_translations_table', 82),
(160, '2024_01_01_000004_create_menu_item_translations_table', 82),
(161, '2024_05_13_103531_create_coupons_table', 83),
(162, '2025_08_14_141721_create_coupon_histories_table', 84),
(164, '2025_08_16_092804_add_theme_2_thumbnail_image_to_listings_table', 85),
(166, '2025_08_16_112142_add_images_column_to_projects_table', 86),
(168, '2025_08_16_163652_add_partner_icon_column_to_partners_table', 87),
(169, '2025_08_17_153619_add_faq_position_to_faqs_table', 88),
(170, '2025_08_30_141443_create_manage_sections_table', 89),
(171, '2025_08_31_091805_add_component_name_to_manage_sections_table', 90),
(172, '2025_01_29_161317_create_support_tickets_table', 91),
(173, '2025_01_29_162535_create_support_ticket_messages_table', 91),
(174, '2025_01_29_173226_create_message_documents_table', 91),
(175, '2024_12_19_000000_create_pwa_icon_settings_table', 92),
(176, '2024_02_14_121751_create_subscription_histories_table', 93),
(177, '2025_10_15_123225_add_icon_to_listings_table', 94);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `verified_token` varchar(255) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `verified_token`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES
(17, 'admin@gmail.com', NULL, 1, 1, '2025-08-18 04:05:55', '2025-08-18 04:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `subtotal` decimal(28,8) NOT NULL,
  `shipping_charge` decimal(28,8) NOT NULL,
  `total` decimal(28,8) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` tinyint(4) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `subtotal`, `shipping_charge`, `total`, `shipping_method_id`, `address`, `payment_method`, `payment_status`, `order_status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(40, 13, '175516312358279', 60.00000000, 10.00000000, 64.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"1791 Yorkshire Circle Kitty Hawk\"}', 'Stripe', 1, 0, 'txn_3RvxJ1F56Pb8BOOX1AWhkmVX', '2025-08-14 09:18:43', '2025-08-14 09:18:43'),
(41, 13, '175516312387378', 60.00000000, 10.00000000, 64.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"1791 Yorkshire Circle Kitty Hawk\"}', 'Stripe', 1, 0, 'txn_3RvxJ1F56Pb8BOOX0DXNGIo5', '2025-08-14 09:18:43', '2025-08-14 09:18:43'),
(42, 13, '175516326859525', 60.00000000, 10.00000000, 64.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Mollie', 1, 0, NULL, '2025-08-14 09:21:08', '2025-08-14 09:21:08'),
(43, 13, '175516347036862', 60.00000000, 20.00000000, 70.00000000, 4, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 4, 'txn_3RvxObF56Pb8BOOX1yoO6PmP', '2025-08-14 09:24:30', '2025-08-17 10:44:41'),
(44, 13, '175516544050862', 20.00000000, 10.00000000, 30.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"wes\"}', 'Mollie', 1, 4, NULL, '2025-08-14 09:57:20', '2025-08-16 02:45:33'),
(45, 13, '175540570851348', 20.00000000, 10.00000000, 30.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 5, 'txn_3RwyPbF56Pb8BOOX0D9UPXLN', '2025-08-17 04:41:48', '2025-08-18 04:49:59'),
(46, 13, '175652828784693', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRjF56Pb8BOOX09pYl2WP', '2025-08-30 04:31:27', '2025-08-30 04:31:27'),
(47, 13, '175652828700112', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRlF56Pb8BOOX1kMerepT', '2025-08-30 04:31:27', '2025-08-30 04:31:27'),
(48, 13, '175652828849587', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRnF56Pb8BOOX0jE5ramm', '2025-08-30 04:31:28', '2025-08-30 04:31:28'),
(49, 13, '175652828958461', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRoF56Pb8BOOX0fVYxJTc', '2025-08-30 04:31:29', '2025-08-30 04:31:29'),
(50, 13, '175652829040673', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRpF56Pb8BOOX1GgWHaRD', '2025-08-30 04:31:30', '2025-08-30 04:31:30'),
(51, 13, '175652829076804', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRpF56Pb8BOOX0Y2ni70m', '2025-08-30 04:31:30', '2025-08-30 04:31:30'),
(52, 13, '175652829547349', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRuF56Pb8BOOX1aOuulQR', '2025-08-30 04:31:35', '2025-08-30 04:31:35'),
(53, 13, '175652829622476', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRvF56Pb8BOOX0xYFNpRf', '2025-08-30 04:31:36', '2025-08-30 04:31:36'),
(54, 13, '175652829646555', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRwF56Pb8BOOX1I2BGzJT', '2025-08-30 04:31:36', '2025-08-30 04:31:36'),
(55, 13, '175652829852425', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRxF56Pb8BOOX1wkzZBwm', '2025-08-30 04:31:38', '2025-08-30 04:31:38'),
(56, 13, '175652829816843', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRyF56Pb8BOOX1CMHjcnh', '2025-08-30 04:31:38', '2025-08-30 04:31:38'),
(57, 13, '175652830005626', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRzF56Pb8BOOX0txMFZvm', '2025-08-30 04:31:40', '2025-08-30 04:31:40'),
(58, 13, '175652830022627', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRzF56Pb8BOOX0Yqy60r0', '2025-08-30 04:31:40', '2025-08-30 04:31:40'),
(59, 13, '175652830013753', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gRzF56Pb8BOOX1FcHasmk', '2025-08-30 04:31:40', '2025-08-30 04:31:40'),
(60, 13, '175652830027189', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS0F56Pb8BOOX1CYGgp7I', '2025-08-30 04:31:40', '2025-08-30 04:31:40'),
(61, 13, '175652830146696', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS0F56Pb8BOOX1TZIEhX5', '2025-08-30 04:31:41', '2025-08-30 04:31:41'),
(62, 13, '175652830184532', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS0F56Pb8BOOX0Ggz7Tzt', '2025-08-30 04:31:41', '2025-08-30 04:31:41'),
(63, 13, '175652830414180', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS3F56Pb8BOOX0hJWpczQ', '2025-08-30 04:31:44', '2025-08-30 04:31:44'),
(64, 13, '175652830537865', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS4F56Pb8BOOX1RQzYxtQ', '2025-08-30 04:31:45', '2025-08-30 04:31:45'),
(65, 13, '175652830565457', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS4F56Pb8BOOX1A2h14hD', '2025-08-30 04:31:45', '2025-08-30 04:31:45'),
(66, 13, '175652830605485', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS5F56Pb8BOOX1P6sc5LU', '2025-08-30 04:31:46', '2025-08-30 04:31:46'),
(67, 13, '175652830644319', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS4F56Pb8BOOX0gLDUV8t', '2025-08-30 04:31:46', '2025-08-30 04:31:46'),
(68, 13, '175652830601793', 175.00000000, 10.00000000, 141.25000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Mirpur, Dhaka\"}', 'Stripe', 1, 0, 'txn_3S1gS5F56Pb8BOOX0eXlSVPS', '2025-08-30 04:31:46', '2025-08-30 04:31:46'),
(69, 13, '175653689702856', 260.00000000, 20.00000000, 215.00000000, 4, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"1791 Yorkshire Circle Kitty Hawk\"}', 'Paystack', 1, 5, NULL, '2025-08-30 06:54:57', '2025-08-31 10:37:49'),
(70, 13, '175739476227836', 120.00000000, 10.00000000, 120.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Jackson Heights, 11372, NY, United States e b\"}', 'Stripe', 1, 0, 'txn_3S5Jr1F56Pb8BOOX1ZXpLxaB', '2025-09-09 05:12:42', '2025-09-09 05:12:42'),
(71, 13, '175739514971148', 55.00000000, 10.00000000, 55.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Jackson Heights, 11372, NY, United States e b\"}', 'Stripe', 1, 0, 'txn_3S5JxSF56Pb8BOOX0NXOnloR', '2025-09-09 05:19:09', '2025-09-09 05:19:09'),
(72, 13, '175879554390046', 30.00000000, 10.00000000, 30.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"ssss\"}', 'Bank_Payment', 0, 0, 'sdfsfsdfsd', '2025-09-25 10:19:03', '2025-09-25 10:19:03'),
(73, 13, '176084731999604', 77.20000000, 10.00000000, 77.20000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Dhaka\"}', 'Stripe', 1, 0, 'txn_3SJo1WF56Pb8BOOX0WKUHweG', '2025-10-19 04:15:19', '2025-10-19 04:15:19'),
(74, 13, '176093703537657', 35.00000000, 10.00000000, 35.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"c\"}', 'Paystack', 1, 0, NULL, '2025-10-20 05:10:35', '2025-10-20 05:10:35'),
(75, 13, '176093708073193', 35.00000000, 10.00000000, 35.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"c\"}', 'Paystack', 1, 0, NULL, '2025-10-20 05:11:20', '2025-10-20 05:11:20'),
(76, 13, '176093768540886', 29.00000000, 10.00000000, 29.00000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"dfg\"}', 'Paystack', 1, 0, NULL, '2025-10-20 05:21:25', '2025-10-20 05:21:25'),
(77, 13, '176093878995236', 76.40000000, 10.00000000, 76.40000000, 3, '{\"name\":\"Ibrahim Khalil\",\"email\":\"user@gmail.com\",\"phone\":\"\\u202a202-529-7619\",\"address\":\"Dhaka\"}', 'Paystack', 1, 0, NULL, '2025-10-20 05:39:49', '2025-10-20 05:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(6, 9, 1, 3, 60.00000000, '2025-02-23 12:56:02', '2025-02-23 12:56:02'),
(7, 9, 2, 1, 20.00000000, '2025-02-23 12:56:02', '2025-02-23 12:56:02'),
(8, 10, 4, 1, 25.00000000, '2025-02-23 12:59:26', '2025-02-23 12:59:26'),
(9, 10, 5, 1, 25.00000000, '2025-02-23 12:59:26', '2025-02-23 12:59:26'),
(10, 10, 6, 1, 45.00000000, '2025-02-23 12:59:26', '2025-02-23 12:59:26'),
(11, 11, 2, 1, 20.00000000, '2025-08-07 09:37:10', '2025-08-07 09:37:10'),
(12, 12, 2, 1, 20.00000000, '2025-08-07 09:37:10', '2025-08-07 09:37:10'),
(13, 11, 1, 1, 19.60000000, '2025-08-07 09:37:10', '2025-08-07 09:37:10'),
(14, 12, 1, 1, 19.60000000, '2025-08-07 09:37:10', '2025-08-07 09:37:10'),
(15, 17, 3, 1, 50.00000000, '2025-08-07 10:13:05', '2025-08-07 10:13:05'),
(16, 22, 4, 1, 25.00000000, '2025-08-10 02:49:14', '2025-08-10 02:49:14'),
(17, 23, 1, 3, 60.00000000, '2025-08-14 05:42:20', '2025-08-14 05:42:20'),
(18, 24, 3, 1, 50.00000000, '2025-08-14 05:51:10', '2025-08-14 05:51:10'),
(19, 25, 1, 3, 60.00000000, '2025-08-14 06:45:58', '2025-08-14 06:45:58'),
(20, 26, 1, 3, 60.00000000, '2025-08-14 06:49:48', '2025-08-14 06:49:48'),
(21, 27, 1, 3, 60.00000000, '2025-08-14 06:49:48', '2025-08-14 06:49:48'),
(22, 28, 1, 2, 40.00000000, '2025-08-14 07:02:30', '2025-08-14 07:02:30'),
(23, 29, 1, 2, 40.00000000, '2025-08-14 07:02:30', '2025-08-14 07:02:30'),
(24, 32, 1, 3, 60.00000000, '2025-08-14 08:54:18', '2025-08-14 08:54:18'),
(25, 34, 1, 3, 60.00000000, '2025-08-14 09:00:38', '2025-08-14 09:00:38'),
(26, 36, 1, 3, 60.00000000, '2025-08-14 09:03:23', '2025-08-14 09:03:23'),
(27, 39, 1, 3, 60.00000000, '2025-08-14 09:09:44', '2025-08-14 09:09:44'),
(28, 40, 1, 3, 60.00000000, '2025-08-14 09:18:43', '2025-08-14 09:18:43'),
(29, 42, 1, 3, 60.00000000, '2025-08-14 09:21:08', '2025-08-14 09:21:08'),
(30, 43, 1, 3, 60.00000000, '2025-08-14 09:24:35', '2025-08-14 09:24:35'),
(31, 44, 1, 1, 20.00000000, '2025-08-14 09:57:27', '2025-08-14 09:57:27'),
(32, 45, 1, 1, 20.00000000, '2025-08-17 04:41:54', '2025-08-17 04:41:54'),
(33, 48, 1, 4, 80.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(34, 47, 1, 4, 80.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(35, 46, 1, 4, 80.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(36, 48, 2, 4, 80.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(37, 46, 2, 4, 80.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(38, 47, 2, 4, 80.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(39, 48, 18, 1, 15.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(40, 46, 18, 1, 15.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(41, 47, 18, 1, 15.00000000, '2025-08-30 04:31:31', '2025-08-30 04:31:31'),
(42, 69, 1, 1, 20.00000000, '2025-08-30 06:55:02', '2025-08-30 06:55:02'),
(43, 69, 2, 1, 20.00000000, '2025-08-30 06:55:02', '2025-08-30 06:55:02'),
(44, 69, 8, 3, 165.00000000, '2025-08-30 06:55:02', '2025-08-30 06:55:02'),
(45, 69, 10, 1, 55.00000000, '2025-08-30 06:55:02', '2025-08-30 06:55:02'),
(46, 70, 2, 1, 20.00000000, '2025-09-09 05:12:54', '2025-09-09 05:12:54'),
(47, 70, 6, 2, 90.00000000, '2025-09-09 05:12:54', '2025-09-09 05:12:54'),
(48, 71, 2, 1, 20.00000000, '2025-09-09 05:19:18', '2025-09-09 05:19:18'),
(49, 71, 5, 1, 25.00000000, '2025-09-09 05:19:18', '2025-09-09 05:19:18'),
(50, 72, 1, 1, 20.00000000, '2025-09-25 10:19:06', '2025-09-25 10:19:06'),
(51, 73, 15, 2, 84.00000000, '2025-10-19 04:15:26', '2025-10-19 04:15:26'),
(52, 74, 4, 1, 25.00000000, '2025-10-20 05:10:42', '2025-10-20 05:10:42'),
(53, 76, 1, 1, 19.00000000, '2025-10-20 05:21:31', '2025-10-20 05:21:31'),
(54, 77, 2, 2, 38.00000000, '2025-10-20 05:39:54', '2025-10-20 05:39:54'),
(55, 77, 6, 1, 45.00000000, '2025-10-20 05:39:54', '2025-10-20 05:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `home_three_icon` varchar(255) DEFAULT NULL,
  `home_four_icon` varchar(255) DEFAULT NULL,
  `home_six_icon` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `logo`, `home_three_icon`, `home_four_icon`, `home_six_icon`, `link`, `status`, `created_at`, `updated_at`) VALUES
(2, 'uploads/custom-images/Partner-2025-11-06-11-58-30-2492.svg', 'uploads/custom-images/Partner-2025-11-06-12-10-18-4057.svg', 'uploads/custom-images/Partner-2025-11-06-12-15-19-3067.svg', 'uploads/custom-images/Partner-2025-11-06-12-21-11-1598.svg', '#', 'enable', '2025-07-23 04:12:06', '2025-11-06 06:21:11'),
(3, 'uploads/custom-images/Partner-2025-11-06-12-00-25-2726.svg', 'uploads/custom-images/Partner-2025-11-06-12-11-02-3825.svg', 'uploads/custom-images/Partner-2025-11-06-12-16-27-2901.svg', 'uploads/custom-images/Partner-2025-11-06-12-21-30-2289.svg', '#', 'enable', '2025-07-23 04:12:23', '2025-11-06 06:21:30'),
(4, 'uploads/custom-images/Partner-2025-11-06-12-00-49-7048.svg', 'uploads/custom-images/Partner-2025-11-06-12-11-19-5031.svg', 'uploads/custom-images/Partner-2025-11-06-12-16-40-5056.svg', 'uploads/custom-images/Partner-2025-11-06-12-22-07-4932.svg', '#', 'enable', '2025-07-23 04:12:34', '2025-11-06 06:22:07'),
(5, 'uploads/custom-images/Partner-2025-11-06-12-01-17-4618.svg', 'uploads/custom-images/Partner-2025-11-06-12-12-17-2101.svg', 'uploads/custom-images/Partner-2025-11-06-12-16-57-9921.svg', 'uploads/custom-images/Partner-2025-11-06-12-22-25-5371.svg', '#', 'enable', '2025-07-23 04:12:53', '2025-11-06 06:22:25'),
(6, 'uploads/custom-images/Partner-2025-11-06-12-01-37-2879.svg', 'uploads/custom-images/Partner-2025-11-06-12-12-39-5876.svg', 'uploads/custom-images/Partner-2025-11-06-12-17-16-9542.svg', 'uploads/custom-images/Partner-2025-11-06-12-22-36-2284.svg', '#', 'enable', '2025-07-23 04:13:03', '2025-11-06 06:22:36'),
(7, 'uploads/custom-images/Partner-2025-11-06-12-02-07-9845.svg', 'uploads/custom-images/Partner-2025-11-06-12-12-56-7256.svg', 'uploads/custom-images/Partner-2025-11-06-12-17-36-3612.svg', 'uploads/custom-images/Partner-2025-11-06-12-22-57-6557.svg', '#', 'enable', '2025-07-23 04:13:13', '2025-11-06 06:22:57'),
(8, 'uploads/custom-images/Partner-2025-11-06-12-02-24-2053.svg', 'uploads/custom-images/Partner-2025-11-06-12-13-16-1350.svg', 'uploads/custom-images/Partner-2025-11-06-12-17-52-9924.svg', 'uploads/custom-images/Partner-2025-11-06-12-23-17-9470.svg', '#', 'enable', '2025-07-23 04:13:22', '2025-11-06 06:23:17'),
(13, 'uploads/custom-images/Partner-2025-11-06-12-02-41-4842.svg', 'uploads/custom-images/Partner-2025-11-06-12-13-35-6706.svg', 'uploads/custom-images/Partner-2025-11-06-12-18-08-2924.svg', 'uploads/custom-images/Partner-2025-11-06-12-23-40-1991.svg', NULL, 'enable', '2025-10-16 09:39:20', '2025-11-06 06:23:40'),
(14, 'uploads/custom-images/our-partner-2025-11-06-12-03-00-4773.svg', 'uploads/custom-images/Partner-2025-11-06-12-13-50-4872.svg', 'uploads/custom-images/Partner-2025-11-06-12-18-20-7143.svg', 'uploads/custom-images/Partner-2025-11-06-12-23-50-4350.svg', NULL, 'enable', '2025-11-06 06:03:00', '2025-11-06 06:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'stripe_status', '1', NULL, '2024-06-26 03:47:57'),
(2, 'stripe_image', 'uploads/website-images/stripe-2024-06-26-09-11-39-8478.png', NULL, '2024-06-26 03:11:39'),
(3, 'stripe_currency_id', '1', NULL, '2024-07-10 05:34:33'),
(4, 'stripe_key', 'pk_test_51JU61aF56Pb8BOOX5ucAe5DlDwAkCZyffqlKMDUWsAwhKbdtuY71VvIzr0NgFKjq4sOVVaaeeyVXXnNWwu5dKgeq00kMzCBUm5', NULL, '2024-06-26 03:47:57'),
(5, 'stripe_secret', 'sk_test_51JU61aF56Pb8BOOXlz7jGkzJsCkozuAoRlFJskYGsgunfaHLmcvKLubYRQLCQOuyYHq0mvjoBFLzV7d8F6q8f6Hv00CGwULEEV', NULL, '2024-06-26 03:47:57'),
(6, 'paypal_status', '1', NULL, '2025-02-05 09:08:08'),
(7, 'paypal_image', 'uploads/website-images/paypal-2024-06-26-09-12-11-9195.png', NULL, '2024-06-26 03:12:11'),
(8, 'paypal_account_mode', 'sandbox', NULL, '2025-02-05 09:08:08'),
(9, 'paypal_currency_id', '1', NULL, '2025-02-05 09:08:08'),
(10, 'paypal_client_id', 'AWlV5x8Lhj9BRF8-TnawXtbNs-zt69mMVXME1BGJUIoDdrAYz8QIeeTBQp0sc2nIL9E529KJZys32Ipy', NULL, '2025-02-05 09:08:08'),
(11, 'paypal_secret_key', 'EEvn1J_oIC6alxb-FoF4t8buKwy4uEWHJ4_Jd_wolaSPRMzFHe6GrMrliZAtawDDuE-WKkCKpWGiz0Yn', NULL, '2025-02-05 09:08:08'),
(12, 'razorpay_status', '1', NULL, '2025-02-26 11:32:35'),
(13, 'razorpay_image', 'uploads/website-images/paypal-2024-06-26-09-12-18-5252.png', NULL, '2024-06-26 03:12:18'),
(14, 'razorpay_currency_id', '8', NULL, '2025-02-26 11:32:35'),
(15, 'razorpay_key', 'rzp_test_K7CipNQYyyMPiS', NULL, '2025-02-26 11:32:35'),
(16, 'razorpay_secret', 'zSBmNMorJrirOrnDrbOd1ALO', NULL, '2025-02-26 11:32:35'),
(17, 'razorpay_name', 'Quland', NULL, '2025-02-26 11:32:35'),
(18, 'razorpay_description', 'Online MarketPlace', NULL, '2025-02-26 11:32:35'),
(19, 'razorpay_theme_color', '#57c20f', NULL, '2025-02-26 11:32:35'),
(30, 'paystack_status', '1', NULL, '2025-08-07 10:12:42'),
(31, 'paystack_image', 'uploads/website-images/paypal-2024-06-26-09-12-47-9168.png', NULL, '2024-06-26 03:12:47'),
(32, 'paystack_currency_id', '9', NULL, '2025-08-07 10:12:42'),
(33, 'paystack_public_key', 'pk_test_057dfe5dee14eaf9c3b4573df1e3760c02c06e38', NULL, '2025-08-07 10:12:42'),
(34, 'paystack_secret_key', 'sk_test_77cb93329abbdc18104466e694c9f720a7d69c97', NULL, '2025-08-07 10:12:42'),
(35, 'instamojo_status', '1', NULL, '2024-07-03 06:04:33'),
(36, 'instamojo_image', 'uploads/website-images/paypal-2024-06-26-09-12-53-1868.png', NULL, '2024-06-26 03:12:53'),
(37, 'instamojo_account_mode', 'Sandbox', NULL, '2024-07-03 06:04:33'),
(38, 'instamojo_currency_id', '1', NULL, '2024-07-10 05:34:33'),
(39, 'instamojo_api_key', 'test_5f4a2c9a58ef216f8a1a688910f', NULL, '2024-07-03 06:04:33'),
(40, 'instamojo_auth_token', 'test_994252ada69ce7b3d282b9941c2', NULL, '2024-07-03 06:04:33'),
(41, 'bank_status', '1', NULL, '2025-10-19 04:24:02'),
(42, 'bank_image', 'uploads/website-images/paypal-2024-06-26-09-12-59-4505.png', NULL, '2024-06-26 03:12:59'),
(43, 'bank_account_info', 'Bank Name: Your bank name\r\nAccount Number:  Your bank account number\r\nRouting Number: Your bank routing number\r\nBranch: Your bank branch name', NULL, '2025-10-19 04:24:02');

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
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `lang_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'en', '<h3>01.Introduction</h3>\r\n<p>A Privacy Policy is a legal document that informs users about the data collected, how it\'s used, and how it\'s protected. It typically includes information about the type of personal our ainformation collected (such as names, email addresses, etc.), the purpose of collection, and whether the information is shared with third parties. It outlines the rights of users regarding their data, such as the right to access, correct, or delete their information.</p>\r\n<h3>02.Quland of Privacy and Policy</h3>\r\n<p>Terms of Service (also known as Terms and Conditions or Terms of Use) set the rules and guidelines for using a particular service or platform. They establish the contractual relationship between the user and the service provider. They often include details about user behavior, content usage policies, disclaimers, limitations of liability, and procedures for dispute resolution.Users typically agree to these terms by using the service.When you visit a website or use an online service, you are usually asked to agree to both the Privacy Policy and the Terms of Service. These documents are crucial for transparency, legal compliance, and establishing the terms under which users can access and use the service.</p>\r\n<p>It\'s important for businesses and service providers to keep these documents up-to-date and easily accessible to users. If you have specific questions or concerns about privacy policies or terms of service, feel free to provide more details, and I\'ll do my best to assist you.</p>\r\n<h3>3. Protect Your Property</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3>4. What to Include in Terms and Conditions for Limitations of Liability</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>ive centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n<h3>05.Pricing and Payment Policy</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', NULL, '2025-02-26 11:13:48'),
(23, 'esp', '<h3>01.Introduction</h3>\r\n<p>A Privacy Policy is a legal document that informs users about the data collected, how it\'s used, and how it\'s protected. It typically includes information about the type of personal our ainformation collected (such as names, email addresses, etc.), the purpose of collection, and whether the information is shared with third parties. It outlines the rights of users regarding their data, such as the right to access, correct, or delete their information.</p>\r\n<h3>02.Quland of Privacy and Policy</h3>\r\n<p>Terms of Service (also known as Terms and Conditions or Terms of Use) set the rules and guidelines for using a particular service or platform. They establish the contractual relationship between the user and the service provider. They often include details about user behavior, content usage policies, disclaimers, limitations of liability, and procedures for dispute resolution.Users typically agree to these terms by using the service.When you visit a website or use an online service, you are usually asked to agree to both the Privacy Policy and the Terms of Service. These documents are crucial for transparency, legal compliance, and establishing the terms under which users can access and use the service.</p>\r\n<p>It\'s important for businesses and service providers to keep these documents up-to-date and easily accessible to users. If you have specific questions or concerns about privacy policies or terms of service, feel free to provide more details, and I\'ll do my best to assist you.</p>\r\n<h3>3. Protect Your Property</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3>4. What to Include in Terms and Conditions for Limitations of Liability</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>ive centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n<h3>05.Pricing and Payment Policy</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `offer_price` decimal(8,2) DEFAULT NULL,
  `thumbnail_image` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `sku` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `slug`, `price`, `offer_price`, `thumbnail_image`, `tags`, `quantity`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 17, 2, 'wireless-headphones', 20.00, 5.00, 'uploads/custom-images/listing-2025-08-13-11-19-44-8507.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 20, 'J-8521', 1, '2025-08-02 06:13:21', '2025-10-16 06:51:25'),
(2, 16, 10, 'luxury-arm-chair-isolated', 20.00, 5.00, 'uploads/custom-images/listing-2025-10-08-03-16-02-7225.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"Sofa\"},{\"value\":\"Chair\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-10-08 09:16:02'),
(3, 15, 2, 'travel-tour-yellow-suitcase', 50.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-25-45-9480.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 20, 'J-8521', 1, '2025-02-23 12:13:21', '2025-08-13 05:25:45'),
(4, 14, 3, 'security-indoor-camera', 25.00, NULL, 'uploads/custom-images/listing-2025-10-08-03-13-59-7744.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"cctv\"},{\"value\":\"camera\"}]', 10, 'J-8521', 1, '2025-02-23 12:13:21', '2025-10-08 09:13:59'),
(5, 10, 8, 'wireless-bluetooth-keyboard', 25.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-30-33-9079.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 5, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:30:33'),
(6, 9, 8, 'wifi-video-doorbell', 45.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-34-59-2967.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:35:00'),
(7, 5, 6, 'magnetic-phone-charger', 55.00, NULL, 'uploads/custom-images/listing-2025-10-08-03-14-33-1368.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-10-08 09:14:34'),
(8, 18, 10, 'leather-messenger-bag', 55.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-38-20-2770.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 24, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:38:20'),
(9, 19, 6, 'gray-smart-watch-for-men', 55.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-40-45-2652.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"watch\"}]', 23, 'J-8521', 1, '2025-02-23 12:13:21', '2025-08-13 05:40:45'),
(10, 20, 6, 'smart-laptop-corei7', 55.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-43-10-3912.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"leptop\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:43:25'),
(11, 21, 10, 'leather-messenger-bag', 99.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-45-10-4056.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"bag\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:45:10'),
(12, 17, 6, 'black-bluetooth-headphone', 99.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-47-44-1939.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 10, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:47:44'),
(13, 20, 9, 'smart-touch-7th-gen-laptop', 420.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-53-51-3826.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"leptop\"}]', 12, NULL, 1, '2025-02-23 06:13:21', '2025-08-13 05:53:52'),
(14, 5, 3, 'portable-chager', 42.00, NULL, 'uploads/custom-images/listing-2025-08-13-12-02-34-9248.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 06:02:34'),
(15, 14, 9, 'compact-digital-cctv-camera', 42.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-55-56-2601.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"cctv\"}]', 50, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:55:56'),
(16, 15, 10, 'waterproof-travel-suitcase', 42.00, NULL, 'uploads/custom-images/listing-2025-08-13-12-08-03-8824.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 0, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 06:08:03'),
(17, 19, 6, 'smart-watch', 22.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-59-38-6640.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 0, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:59:38'),
(18, 17, 3, 'multiport-wire-less-headphone', 15.00, NULL, 'uploads/custom-images/listing-2025-08-13-11-50-43-3805.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"}]', 0, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 05:50:43'),
(19, 18, 10, 'hand-bag', 15.00, NULL, 'uploads/custom-images/listing-2025-08-13-12-05-35-2681.webp', '[{\"value\":\"mobile\"},{\"value\":\"headphone\"},{\"value\":\"electronics\"},{\"value\":\"iphon\"},{\"value\":\"handbag\"}]', 0, NULL, 1, '2025-02-23 12:13:21', '2025-08-13 06:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(68, 1, 'uploads/custom-images/listing-2025-08-13-11-21-28-4704.webp', '2025-08-13 05:21:28', '2025-08-13 05:21:28'),
(69, 1, 'uploads/custom-images/listing-2025-08-13-11-21-28-6337.webp', '2025-08-13 05:21:28', '2025-08-13 05:21:28'),
(70, 1, 'uploads/custom-images/listing-2025-08-13-11-21-28-4742.webp', '2025-08-13 05:21:28', '2025-08-13 05:21:28'),
(71, 2, 'uploads/custom-images/listing-2025-08-13-11-24-06-2063.webp', '2025-08-13 05:24:06', '2025-08-13 05:24:06'),
(72, 2, 'uploads/custom-images/listing-2025-08-13-11-24-06-1749.webp', '2025-08-13 05:24:06', '2025-08-13 05:24:06'),
(73, 2, 'uploads/custom-images/listing-2025-08-13-11-24-06-3616.webp', '2025-08-13 05:24:06', '2025-08-13 05:24:06'),
(74, 3, 'uploads/custom-images/listing-2025-08-13-11-26-36-9692.webp', '2025-08-13 05:26:36', '2025-08-13 05:26:36'),
(75, 3, 'uploads/custom-images/listing-2025-08-13-11-26-36-7960.webp', '2025-08-13 05:26:36', '2025-08-13 05:26:36'),
(76, 3, 'uploads/custom-images/listing-2025-08-13-11-26-36-4216.webp', '2025-08-13 05:26:36', '2025-08-13 05:26:36'),
(77, 4, 'uploads/custom-images/listing-2025-08-13-11-29-09-2275.webp', '2025-08-13 05:29:09', '2025-08-13 05:29:09'),
(78, 4, 'uploads/custom-images/listing-2025-08-13-11-29-09-9652.webp', '2025-08-13 05:29:09', '2025-08-13 05:29:09'),
(79, 4, 'uploads/custom-images/listing-2025-08-13-11-29-09-7153.webp', '2025-08-13 05:29:09', '2025-08-13 05:29:09'),
(81, 5, 'uploads/custom-images/listing-2025-08-13-11-31-15-8078.webp', '2025-08-13 05:31:15', '2025-08-13 05:31:15'),
(82, 5, 'uploads/custom-images/listing-2025-08-13-11-31-15-2761.webp', '2025-08-13 05:31:15', '2025-08-13 05:31:15'),
(83, 5, 'uploads/custom-images/listing-2025-08-13-11-32-53-4037.webp', '2025-08-13 05:32:54', '2025-08-13 05:32:54'),
(84, 6, 'uploads/custom-images/listing-2025-08-13-11-36-09-1059.webp', '2025-08-13 05:36:09', '2025-08-13 05:36:09'),
(85, 6, 'uploads/custom-images/listing-2025-08-13-11-36-09-3782.webp', '2025-08-13 05:36:09', '2025-08-13 05:36:09'),
(86, 6, 'uploads/custom-images/listing-2025-08-13-11-36-09-6908.webp', '2025-08-13 05:36:09', '2025-08-13 05:36:09'),
(87, 7, 'uploads/custom-images/listing-2025-08-13-11-37-26-3388.webp', '2025-08-13 05:37:26', '2025-08-13 05:37:26'),
(88, 7, 'uploads/custom-images/listing-2025-08-13-11-37-26-8330.webp', '2025-08-13 05:37:26', '2025-08-13 05:37:26'),
(89, 7, 'uploads/custom-images/listing-2025-08-13-11-37-26-5984.webp', '2025-08-13 05:37:26', '2025-08-13 05:37:26'),
(90, 8, 'uploads/custom-images/listing-2025-08-13-11-39-33-1288.webp', '2025-08-13 05:39:33', '2025-08-13 05:39:33'),
(91, 8, 'uploads/custom-images/listing-2025-08-13-11-39-33-5979.webp', '2025-08-13 05:39:33', '2025-08-13 05:39:33'),
(92, 8, 'uploads/custom-images/listing-2025-08-13-11-39-33-7453.webp', '2025-08-13 05:39:33', '2025-08-13 05:39:33'),
(93, 9, 'uploads/custom-images/listing-2025-08-13-11-41-48-6977.webp', '2025-08-13 05:41:48', '2025-08-13 05:41:48'),
(94, 9, 'uploads/custom-images/listing-2025-08-13-11-41-48-2303.webp', '2025-08-13 05:41:48', '2025-08-13 05:41:48'),
(95, 9, 'uploads/custom-images/listing-2025-08-13-11-41-48-5733.webp', '2025-08-13 05:41:48', '2025-08-13 05:41:48'),
(96, 10, 'uploads/custom-images/listing-2025-08-13-11-44-16-5061.webp', '2025-08-13 05:44:16', '2025-08-13 05:44:16'),
(97, 10, 'uploads/custom-images/listing-2025-08-13-11-44-16-5160.webp', '2025-08-13 05:44:16', '2025-08-13 05:44:16'),
(98, 10, 'uploads/custom-images/listing-2025-08-13-11-44-16-2173.webp', '2025-08-13 05:44:16', '2025-08-13 05:44:16'),
(99, 11, 'uploads/custom-images/listing-2025-08-13-11-46-19-5275.webp', '2025-08-13 05:46:19', '2025-08-13 05:46:19'),
(100, 11, 'uploads/custom-images/listing-2025-08-13-11-46-19-9823.webp', '2025-08-13 05:46:19', '2025-08-13 05:46:19'),
(101, 11, 'uploads/custom-images/listing-2025-08-13-11-46-19-4500.webp', '2025-08-13 05:46:19', '2025-08-13 05:46:19'),
(102, 12, 'uploads/custom-images/listing-2025-08-13-11-49-05-3777.webp', '2025-08-13 05:49:05', '2025-08-13 05:49:05'),
(103, 12, 'uploads/custom-images/listing-2025-08-13-11-49-05-9977.webp', '2025-08-13 05:49:06', '2025-08-13 05:49:06'),
(104, 12, 'uploads/custom-images/listing-2025-08-13-11-49-06-4370.webp', '2025-08-13 05:49:06', '2025-08-13 05:49:06'),
(105, 18, 'uploads/custom-images/listing-2025-08-13-11-51-54-2467.webp', '2025-08-13 05:51:54', '2025-08-13 05:51:54'),
(106, 18, 'uploads/custom-images/listing-2025-08-13-11-51-54-5922.webp', '2025-08-13 05:51:54', '2025-08-13 05:51:54'),
(107, 18, 'uploads/custom-images/listing-2025-08-13-11-51-54-2475.webp', '2025-08-13 05:51:55', '2025-08-13 05:51:55'),
(108, 13, 'uploads/custom-images/listing-2025-08-13-11-54-41-3283.webp', '2025-08-13 05:54:41', '2025-08-13 05:54:41'),
(109, 13, 'uploads/custom-images/listing-2025-08-13-11-54-41-9536.webp', '2025-08-13 05:54:42', '2025-08-13 05:54:42'),
(110, 13, 'uploads/custom-images/listing-2025-08-13-11-54-42-3480.webp', '2025-08-13 05:54:42', '2025-08-13 05:54:42'),
(111, 15, 'uploads/custom-images/listing-2025-08-13-11-56-52-4162.webp', '2025-08-13 05:56:52', '2025-08-13 05:56:52'),
(112, 15, 'uploads/custom-images/listing-2025-08-13-11-56-52-3773.webp', '2025-08-13 05:56:52', '2025-08-13 05:56:52'),
(113, 15, 'uploads/custom-images/listing-2025-08-13-11-56-52-9192.webp', '2025-08-13 05:56:52', '2025-08-13 05:56:52'),
(114, 17, 'uploads/custom-images/listing-2025-08-13-12-00-35-8356.webp', '2025-08-13 06:00:35', '2025-08-13 06:00:35'),
(115, 17, 'uploads/custom-images/listing-2025-08-13-12-00-35-9399.webp', '2025-08-13 06:00:35', '2025-08-13 06:00:35'),
(116, 17, 'uploads/custom-images/listing-2025-08-13-12-00-35-8788.webp', '2025-08-13 06:00:35', '2025-08-13 06:00:35'),
(117, 14, 'uploads/custom-images/listing-2025-08-13-12-03-11-6850.webp', '2025-08-13 06:03:11', '2025-08-13 06:03:11'),
(118, 14, 'uploads/custom-images/listing-2025-08-13-12-03-11-5781.webp', '2025-08-13 06:03:11', '2025-08-13 06:03:11'),
(119, 14, 'uploads/custom-images/listing-2025-08-13-12-03-11-1353.webp', '2025-08-13 06:03:11', '2025-08-13 06:03:11'),
(120, 19, 'uploads/custom-images/listing-2025-08-13-12-06-26-6747.webp', '2025-08-13 06:06:26', '2025-08-13 06:06:26'),
(121, 19, 'uploads/custom-images/listing-2025-08-13-12-06-26-8142.webp', '2025-08-13 06:06:26', '2025-08-13 06:06:26'),
(122, 19, 'uploads/custom-images/listing-2025-08-13-12-06-26-6407.webp', '2025-08-13 06:06:26', '2025-08-13 06:06:26'),
(123, 16, 'uploads/custom-images/listing-2025-08-13-12-08-39-9296.webp', '2025-08-13 06:08:39', '2025-08-13 06:08:39'),
(124, 16, 'uploads/custom-images/listing-2025-08-13-12-08-39-8869.webp', '2025-08-13 06:08:39', '2025-08-13 06:08:39'),
(125, 16, 'uploads/custom-images/listing-2025-08-13-12-08-39-4381.webp', '2025-08-13 06:08:40', '2025-08-13 06:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `reviews` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `rating`, `reviews`, `created_at`, `updated_at`) VALUES
(5, 13, 1, 5, 'There are many variations of passages of Lorem Ipsum available, but the majoritys have su alteration in some form humour, or randomised words which don&#039;t. observations to get visibility into employees.', '2025-02-23 13:12:11', '2025-02-23 13:12:11'),
(6, 13, 2, 4, 'There are many variations of passages of Lorem Ipsum available, but the majoritys have su alteration in some form humour, or randomised words which don\'t. observations to get visibility into employees. ', '2025-02-23 13:12:11', '2025-02-23 13:12:11'),
(7, 13, 2, 2, 'There are many variations of passages of Lorem Ipsum available, but the majoritys have su alteration in some form humour, or randomised words which don\'t. observations to get visibility into employees. ', '2025-02-23 13:12:11', '2025-02-23 13:12:11'),
(8, 13, 2, 5, 'There are many variations of passages of Lorem Ipsum available, but the majoritys have su alteration in some form humour, or randomised words which don\'t. observations to get visibility into employees. ', '2025-02-23 13:12:11', '2025-02-23 13:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `short_description` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_translations`
--

INSERT INTO `product_translations` (`id`, `product_id`, `lang_code`, `name`, `description`, `short_description`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Wireless Headphones', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'It is a long established fact that a reader will be distracted by the readable there content of a page when looking at its layout into the find to make it amazing to end.', 'Wireless Headphones', 'Wireless Headphones', '2025-02-23 12:13:21', '2025-10-06 08:39:27'),
(3, 2, 'en', 'Luxury arm chair isolated', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Luxury arm chair isolated', 'Luxury arm chair isolated', '2025-02-23 12:13:21', '2025-08-10 09:25:24'),
(5, 3, 'en', 'Travel tour yellow suitcase', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Travel tour yellow suitcase', 'Travel tour yellow suitcase', '2025-02-23 12:13:21', '2025-08-10 09:44:17'),
(7, 4, 'en', 'Security indoor camera', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Security indoor camera', 'Security indoor camera', '2025-02-23 12:13:21', '2025-08-10 09:46:26'),
(9, 5, 'en', 'Wireless Bluetooth Keyboard', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Wireless Bluetooth Keyboard', 'Wireless Bluetooth Keyboard', '2025-02-23 12:13:21', '2025-08-10 09:47:00'),
(11, 6, 'en', 'Wi-Fi Video Doorbell', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Wi-Fi Video Doorbell', 'Wi-Fi Video Doorbell', '2025-02-23 12:13:21', '2025-08-10 09:47:40'),
(13, 7, 'en', 'Magnetic Phone Charger', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Magnetic Phone Charger', 'Magnetic Phone Charger', '2025-02-23 12:13:21', '2025-08-10 09:48:37'),
(15, 8, 'en', 'Leather messenger bag', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'It is a long established fact that a reader will be distracted by the readable there content of a page when looking at its layout into the find to make it amazing to end.', 'Leather messenger bag', 'Leather messenger bag', '2025-02-23 12:13:21', '2025-10-06 08:46:49'),
(17, 9, 'en', 'Gray smart watch for men', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Gray smart watch for men', 'Gray smart watch for men', '2025-02-23 12:13:21', '2025-08-10 09:50:06'),
(19, 10, 'en', 'Smart laptop core-i7', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Smart laptop core-i7', 'Smart laptop core-i7', '2025-02-23 12:13:21', '2025-08-10 09:51:02'),
(22, 11, 'en', 'Leather messenger bag', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Leather messenger bag', 'Leather messenger bag', '2025-02-23 12:13:21', '2025-08-10 09:52:16'),
(23, 12, 'en', 'Black Bluetooth headphone', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Black Bluetooth headphone', 'Black Bluetooth headphone', '2025-02-23 12:13:21', '2025-08-10 09:53:08'),
(25, 13, 'en', 'Smart touch 7th Gen Laptop', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Smart touch 7th Gen Laptop', 'Smart touch 7th Gen Laptop', '2025-02-23 12:13:21', '2025-02-23 12:45:42'),
(29, 14, 'en', 'Portable Chager', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Portable Chager', 'Portable Chager', '2025-02-23 12:13:21', '2025-08-13 06:02:18'),
(30, 15, 'en', 'Compact Digital Cctv Camera', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Compact Digital Cctv Camera', 'Compact Digital Cctv Camera', '2025-02-23 12:13:21', '2025-08-13 05:55:56'),
(32, 16, 'en', 'Waterproof Travel Suitcase', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Waterproof Travel Suitcase', 'Waterproof Travel Suitcase', '2025-02-23 12:13:21', '2025-08-13 06:08:03'),
(34, 17, 'en', 'Smart Watch', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Smart Watch', 'Smart Watch', '2025-02-23 12:13:21', '2025-08-13 05:59:38'),
(36, 18, 'en', 'Multi-Port Wire Less Headphone', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Multi-Port Wire Less Headphone', 'Multi-Port Wire Less Headphone', '2025-02-23 12:13:21', '2025-02-23 12:42:59'),
(38, 19, 'en', 'Hand Bag', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', 'We are architects of innovation, trailblazers of technological advancement, and partners in your success. As a dynamic and forward-thinking organization', 'Hand Bag', 'Hand Bag', '2025-02-23 12:13:21', '2025-08-13 06:05:35'),
(65, 1, 'esp', 'Wireless Headphones', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Wireless Headphones', 'Wireless Headphones', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(66, 2, 'esp', 'Luxury arm chair isolated', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Luxury arm chair isolated', 'Luxury arm chair isolated', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(67, 3, 'esp', 'Travel tour yellow suitcase', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Travel tour yellow suitcase', 'Travel tour yellow suitcase', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(68, 4, 'esp', 'Security indoor camera', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Security indoor camera', 'Security indoor camera', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(69, 5, 'esp', 'Wireless Bluetooth Keyboard', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Wireless Bluetooth Keyboard', 'Wireless Bluetooth Keyboard', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(70, 6, 'esp', 'Wi-Fi Video Doorbell', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Wi-Fi Video Doorbell', 'Wi-Fi Video Doorbell', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(71, 7, 'esp', 'Magnetic Phone Charger', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Magnetic Phone Charger', 'Magnetic Phone Charger', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(72, 8, 'esp', 'Leather messenger bag', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Leather messenger bag', 'Leather messenger bag', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(73, 9, 'esp', 'Gray smart watch for men', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Gray smart watch for men', 'Gray smart watch for men', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(74, 10, 'esp', 'Smart laptop core-i7', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Smart laptop core-i7', 'Smart laptop core-i7', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(75, 11, 'esp', 'Leather messenger bag', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Leather messenger bag', 'Leather messenger bag', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(76, 12, 'esp', 'Black Bluetooth headphone', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Black Bluetooth headphone', 'Black Bluetooth headphone', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(77, 13, 'esp', 'Smart touch 7th Gen Laptop', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Smart touch 7th Gen Laptop', 'Smart touch 7th Gen Laptop', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(78, 14, 'esp', 'Portable Chager', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Portable Chager', 'Portable Chager', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(79, 15, 'esp', 'Compact Digital Cctv Camera', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Compact Digital Cctv Camera', 'Compact Digital Cctv Camera', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(80, 16, 'esp', 'Waterproof Travel Suitcase', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Waterproof Travel Suitcase', 'Waterproof Travel Suitcase', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(81, 17, 'esp', 'Smart Watch', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Smart Watch', 'Smart Watch', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(82, 18, 'esp', 'Multi-Port Wire Less Headphone', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Multi-Port Wire Less Headphone', 'Multi-Port Wire Less Headphone', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(83, 19, 'esp', 'Hand Bag', '<p>Use both direct conversations and indirect observations to get visibility into employees&rsquo; challenges and concerns. Use every opportunity to make to employees that you support and care them. To facilitate regular conversations between managers and employees, provide managers with guidance on how best to broach sensitive subjects arising from the COVID-19 pandemic</p>', NULL, 'Hand Bag', 'Hand Bag', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `theme_2_thumb_image` varchar(255) DEFAULT NULL,
  `details_thumb_image` varchar(255) DEFAULT NULL,
  `theme_3_thumb_image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `project_date` varchar(255) NOT NULL,
  `project_fb` varchar(255) DEFAULT NULL,
  `project_x` varchar(255) DEFAULT NULL,
  `project_linkedin` varchar(255) DEFAULT NULL,
  `project_instagram` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_designation` varchar(255) DEFAULT NULL,
  `author_image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `category_id`, `sub_category_id`, `thumb_image`, `theme_2_thumb_image`, `details_thumb_image`, `theme_3_thumb_image`, `slug`, `website_url`, `project_date`, `project_fb`, `project_x`, `project_linkedin`, `project_instagram`, `status`, `created_at`, `updated_at`, `author_name`, `author_designation`, `author_image`, `video_url`) VALUES
(9, 5, NULL, 'uploads/custom-images/project-2025-08-10-11-26-42-2843.webp', 'uploads/custom-images/project-2025-08-16-03-19-15-1946.webp', NULL, 'uploads/custom-images/project-2025-08-16-03-19-15-2658.webp', 'lessons-learned-from-an-it-transformation-journey', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-16 09:19:15', 'Patrica W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-31-00-5392.webp', 'u31qwQUeGuM'),
(10, 9, NULL, 'uploads/custom-images/project-2025-08-10-11-27-44-3752.webp', 'uploads/custom-images/project-2025-08-16-03-20-37-4563.webp', NULL, 'uploads/custom-images/project-2025-08-16-03-20-37-8093.webp', 'cybersecurity-case-study-proactive', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-16 09:20:37', 'Patrica W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-31-52-5163.webp', NULL),
(11, 9, NULL, 'uploads/custom-images/project-2025-08-10-11-28-35-3899.webp', 'uploads/custom-images/project-2025-08-16-03-23-41-4190.webp', NULL, 'uploads/custom-images/project-2025-08-16-03-23-41-7586.webp', 'leveraging-data-analytics-for-business-growth', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-16 09:23:41', 'Patrica W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-32-08-8261.webp', NULL),
(12, 14, NULL, 'uploads/custom-images/project-2025-08-10-11-29-13-7878.webp', 'uploads/custom-images/project-2025-08-16-03-24-16-6509.webp', NULL, 'uploads/custom-images/project-2025-08-16-03-24-16-8989.webp', 'insights-from-an-it-transformation-experience', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-16 09:24:17', 'Patrica W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-32-20-4971.webp', NULL),
(13, 14, NULL, 'uploads/custom-images/project-2025-08-10-11-29-56-7151.webp', NULL, NULL, NULL, 'project-for-key-takeaways-from-our-it', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-10 08:37:27', 'W. Sanders', 'Senior Marketer', 'uploads/custom-images/project-author-2025-08-07-09-32-34-4918.webp', NULL),
(14, 10, NULL, 'uploads/custom-images/project-2025-08-10-11-31-12-5525.webp', NULL, NULL, NULL, 'what-we-learned-on-the-it-transformation-path', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-10 05:31:12', 'W. Sanders', 'Senior Marketer', 'uploads/custom-images/project-author-2025-08-07-09-32-47-5849.webp', NULL),
(15, 15, NULL, 'uploads/custom-images/project-2025-08-10-11-31-52-3974.webp', NULL, NULL, NULL, 'reflections-on-an-it-transformation-journey', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-10 05:31:52', 'Richard V. Weiner', 'Senior Marketer', 'uploads/custom-images/project-author-2025-08-07-09-33-03-9399.webp', NULL),
(16, 10, NULL, 'uploads/custom-images/project-2025-08-10-11-32-31-9826.webp', NULL, NULL, NULL, 'discoveries-from-the-it-transformation-process', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-10 05:32:32', 'W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-33-16-8417.webp', NULL),
(17, 15, NULL, 'uploads/custom-images/project-2025-08-10-11-33-09-9909.webp', NULL, NULL, NULL, 'learning-through-it-transformation', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-10 05:33:09', 'Patrica W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-33-29-6791.webp', NULL),
(18, 15, NULL, 'uploads/custom-images/project-2025-02-26-03-21-09-9525.webp', NULL, NULL, NULL, 'modern-app-development', 'https://www.google.com/', '2024-12-31', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.instagram.com/', 'enable', '2025-02-23 09:06:14', '2025-08-07 03:33:42', 'Patrica W. Sanders', 'Senior Manager', 'uploads/custom-images/project-author-2025-08-07-09-33-42-4545.webp', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_galleries`
--

CREATE TABLE `project_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_translations`
--

CREATE TABLE `project_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `seo_title` text DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `author_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_translations`
--

INSERT INTO `project_translations` (`id`, `project_id`, `lang_code`, `title`, `short_description`, `description`, `client_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`, `author_comment`) VALUES
(17, 9, 'en', 'Lessons Learned from an  IT Transformation Journey', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Lessons Learned from an  IT Transformation Journey', 'Lessons Learned from an IT Transformation Journey', '2025-02-23 09:06:14', '2025-08-10 05:26:42', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(19, 10, 'en', 'Cybersecurity Case Study Proactive', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Cybersecurity Case Study Proactive', 'Cybersecurity Case Study Proactive', '2025-02-23 09:06:14', '2025-08-10 08:36:50', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(21, 11, 'en', 'Leveraging Data Analytics for Business Growth', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Leveraging Data Analytics for Business Growth', 'Leveraging Data Analytics for Business Growth', '2025-02-23 09:06:14', '2025-08-10 05:28:35', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(23, 12, 'en', 'Insights from an IT Transformation Experience', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Insights from an IT Transformation Experience', 'Insights from an IT Transformation Experience', '2025-02-23 09:06:14', '2025-08-10 05:29:13', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(25, 13, 'en', 'Project for Key Takeaways from Our IT', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Key Takeaways from Our IT', 'Key Takeaways from Our IT', '2025-02-23 09:06:14', '2025-08-10 08:37:27', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(27, 14, 'en', 'What We Learned on the IT Transformation Path', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'What We Learned on the IT Transformation Path', 'What We Learned on the IT Transformation Path', '2025-02-23 09:06:14', '2025-08-10 05:31:12', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(29, 15, 'en', 'Reflections on an IT Transformation Journey', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h3>Project overview</h3>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>The challenge of project</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Reflections on an IT Transformation Journey', 'Reflections on an IT Transformation Journey', '2025-02-23 09:06:14', '2025-08-10 05:31:52', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(32, 16, 'en', 'Discoveries from the IT Transformation Process', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h3>Project overview</h3>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>The challenge of project</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Discoveries from the IT Transformation Process', 'Discoveries from the IT Transformation Process', '2025-02-23 09:06:14', '2025-08-10 05:32:32', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(33, 17, 'en', 'Learning Through IT Transformation', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Learning Through IT Transformation', 'Learning Through IT Transformation', '2025-02-23 09:06:14', '2025-08-10 05:33:09', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(35, 18, 'en', 'Modern SEO Marketing', 'Defined by digital dynamism our digital marketing agency emerges as a beacon', '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', 'Modern SEO Marketing', 'Modern SEO Marketing', '2025-02-23 09:06:14', '2025-07-29 11:05:56', 'In the ever-evolving landscape of technology, businesses require robust and reliable solutions to manage their IT infrastructure seamlessly. Our IT Managed Solutions offer a comprehensive approach, combining and technology'),
(79, 9, 'esp', 'Lessons Learned from an  IT Transformation Journey', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(80, 10, 'esp', 'Cybersecurity Case Study Proactive', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(81, 11, 'esp', 'Leveraging Data Analytics for Business Growth', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(82, 12, 'esp', 'Insights from an IT Transformation Experience', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(83, 13, 'esp', 'Project for Key Takeaways from Our IT', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(84, 14, 'esp', 'What We Learned on the IT Transformation Path', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(85, 15, 'esp', 'Reflections on an IT Transformation Journey', NULL, '<h3>Project overview</h3>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>The challenge of project</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(86, 16, 'esp', 'Discoveries from the IT Transformation Process', NULL, '<h3>Project overview</h3>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h3>The challenge of project</h3>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(87, 17, 'esp', 'Learning Through IT Transformation', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL),
(88, 18, 'esp', 'Modern SEO Marketing', NULL, '<h2>Project overview</h2>\r\n<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively. There are various kinds of content management systems available&mdash;from cloud-based to a headless</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<h2>The challenge of project</h2>\r\n<p>A content management system (CMS) is an application that is used to manage content, allowing multiple contributors to create, edit and publish. Content in a CMS is typically stored in a database and displayed in a presentation layer based on a set of templates like a website.</p>\r\n<p>CMS provides user-friendly features for easy editing and is compatible with installing plugins and tools that provide even more features for advanced functions. API CMS&rsquo;s are built to have an excellent user-friendly interface that is easy to use.</p>\r\n<ul>\r\n<li>Creating and editing content</li>\r\n<li>Workflows, reporting, and content organization</li>\r\n<li>User &amp; role-based administration and security</li>\r\n<li>Flexibility, scalability, and performance and analysis</li>\r\n<li>Multilingual content capabilities</li>\r\n</ul>\r\n<h3>Final results</h3>\r\n<p>Having a content management system for your website allows you to have control of your content. It means having the ability to update, change or delete any images, text, video, or audio. It allows you to keep your site organized, up to date and looking.</p>', 'Ibrahim Khalil', NULL, NULL, '2025-09-09 07:13:42', '2025-09-09 07:13:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pwa_icon_settings`
--

CREATE TABLE `pwa_icon_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon_size` varchar(255) NOT NULL,
  `icon_path` varchar(255) DEFAULT NULL,
  `icon_type` varchar(255) NOT NULL DEFAULT 'image/png',
  `purpose` varchar(255) NOT NULL DEFAULT 'any maskable',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pwa_icon_settings`
--

INSERT INTO `pwa_icon_settings` (`id`, `icon_size`, `icon_path`, `icon_type`, `purpose`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '72x72', 'uploads/pwa-icons/icon-72x72.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(2, '96x96', 'uploads/pwa-icons/icon-96x96.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(3, '128x128', 'uploads/pwa-icons/icon-128x128.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(4, '144x144', 'uploads/pwa-icons/icon-144x144.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(5, '152x152', 'uploads/pwa-icons/icon-152x152.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(6, '192x192', 'uploads/pwa-icons/icon-192x192.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(7, '384x384', 'uploads/pwa-icons/icon-384x384.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14'),
(8, '512x512', 'uploads/pwa-icons/icon-512x512.png', 'image/png', 'any maskable', 1, '2025-09-24 04:32:14', '2025-09-24 04:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `seo_title` text NOT NULL,
  `seo_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `page_name`, `seo_title`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home Page || Quland - Laravel Content Management System', '<p>Home Page || Quland Laravel Content Management System</p>', NULL, '2025-09-09 04:35:18'),
(2, 'Blogs', 'Blogs || Quland - Laravel Content Management System', '<p>Blogs || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:35:05'),
(3, 'About Us', 'About Us || Quland - Laravel Content Management System', '<p>About Us || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:35:37'),
(4, 'Contact Us', 'Contact Us || Quland - Laravel Content Management System', '<p>Contact Us || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:35:55'),
(5, 'FAQ', 'FAQ || Quland - Laravel Content Management System', '<p>FAQ || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:36:10'),
(6, 'Terms & Conditions', 'Terms & Conditions || Quland - Laravel Content Management System', '<p>Terms &amp; Conditions || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:36:23'),
(9, 'Privacy Policy', 'Privacy Policy || Quland - Laravel Content Management System', '<p>Privacy Policy || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:36:40'),
(10, 'Service', 'Service || Quland - Laravel Content Management System', '<p>Service || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:36:55'),
(11, 'Teams', 'Teams || Quland - Laravel Content Management System', '<p>Teams || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:37:59'),
(12, 'Shop', 'My Shop || Quland - Laravel Content Management System', '<p>My Shop || Quland - Laravel Content Management System</p>', NULL, '2025-09-09 04:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `price`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Inside City', 10.00000000, 1, '2025-02-23 12:55:16', '2025-02-23 12:55:16'),
(4, 'Outside City', 20.00000000, 1, '2025-02-23 12:55:26', '2025-08-30 10:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `url`, `created_at`, `updated_at`) VALUES
(1, 'uploads/custom-images/slider-2025-01-05-05-23-35-4676.webp', 'about-us', '2025-01-05 11:23:35', '2025-01-05 11:23:35'),
(2, 'uploads/custom-images/slider-2025-01-05-05-53-25-9809.webp', 'contact-us', '2025-01-05 11:53:26', '2025-01-05 11:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `slider_translations`
--

CREATE TABLE `slider_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` mediumtext NOT NULL,
  `small_text` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_translations`
--

INSERT INTO `slider_translations` (`id`, `slider_id`, `lang_code`, `title`, `small_text`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'We provide professional IT services', 'Software crafting for digital success', 'Work With Us', '2025-01-05 11:23:35', '2025-02-23 12:33:22'),
(3, 2, 'en', 'We provide professional IT services', 'Affordable big IT & technology solutions', 'Work With Us', '2025-01-05 11:53:26', '2025-02-23 12:32:33'),
(9, 1, 'esp', 'We provide professional IT services', 'Software crafting for digital success', 'Work With Us', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(10, 2, 'esp', 'We provide professional IT services', 'Affordable big IT & technology solutions', 'Work With Us', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `state_translations`
--

CREATE TABLE `state_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_histories`
--

CREATE TABLE `subscription_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_price` decimal(8,2) NOT NULL,
  `plan_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `expiration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_histories`
--

INSERT INTO `subscription_histories` (`id`, `order_id`, `user_id`, `subscription_plan_id`, `plan_name`, `plan_price`, `plan_info`, `expiration_date`, `expiration`, `status`, `payment_method`, `payment_status`, `transaction`, `created_at`, `updated_at`) VALUES
(8, '175896564592380', 13, 1, 'Regular Plan', 29.00, '[{\"id\":1,\"plan_name\":\"Regular Plan\",\"plan_price\":\"29.00\",\"expiration_date\":\"monthly\",\"short_description\":\"Basic plan for  all users\",\"features\":\"Subscription-Based Pricing\\r\\nPay-Per-Use Based Pricing\\r\\n10,000 Monthly Word Limit\\r\\n10+ Languages trasnlations\\r\\nAll types of content\",\"status\":\"active\",\"serial\":1,\"created_at\":\"2025-07-30T05:45:32.000000Z\",\"updated_at\":\"2025-07-30T06:11:06.000000Z\"}]', '2025-10-27', 'monthly', 'pending', 'Bank_Payment', 'pending', 'dadasdas', '2025-09-27 09:34:05', '2025-09-27 09:34:05'),
(9, '175896699263210', 13, 3, 'Standard Plan', 49.00, '[{\"id\":3,\"plan_name\":\"Standard Plan\",\"plan_price\":\"49.00\",\"expiration_date\":\"monthly\",\"short_description\":\"Ideal plan for individual creators\",\"features\":\"Subscription-Based Pricing\\r\\nPay-Per-Use Based Pricing\\r\\n10,000 Monthly Word Limit\\r\\n10+ Languages trasnlations\\r\\nAll types of content\",\"status\":\"active\",\"serial\":2,\"created_at\":\"2025-07-30T05:55:57.000000Z\",\"updated_at\":\"2025-08-06T04:04:38.000000Z\"}]', '2025-10-27', 'monthly', 'active', 'Bank_Payment', 'success', 'AC:asdasd', '2025-09-27 09:56:32', '2025-09-27 10:35:29'),
(10, '175896819375709', 13, 4, 'Diamond Plan', 99.00, '[{\"id\":4,\"plan_name\":\"Diamond Plan\",\"plan_price\":\"99.00\",\"expiration_date\":\"monthly\",\"short_description\":\"Ideal plan for individual creators\",\"features\":\"Subscription-Based Pricing\\r\\nPay-Per-Use Based Pricing\\r\\n10,000 Monthly Word Limit\\r\\n10+ Languages trasnlations\\r\\nAll types of content\",\"status\":\"active\",\"serial\":3,\"created_at\":\"2025-07-30T05:56:53.000000Z\",\"updated_at\":\"2025-08-06T04:04:47.000000Z\"}]', '2025-10-27', 'monthly', 'active', 'Mollie', 'success', 'TXN-17589681936695259722', '2025-09-27 10:16:33', '2025-09-27 10:16:33'),
(11, '175896913993729', 13, 3, 'Standard Plan', 49.00, '[{\"id\":3,\"plan_name\":\"Standard Plan\",\"plan_price\":\"49.00\",\"expiration_date\":\"monthly\",\"short_description\":\"Ideal plan for individual creators\",\"features\":\"Subscription-Based Pricing\\r\\nPay-Per-Use Based Pricing\\r\\n10,000 Monthly Word Limit\\r\\n10+ Languages trasnlations\\r\\nAll types of content\",\"status\":\"active\",\"serial\":2,\"created_at\":\"2025-07-30T05:55:57.000000Z\",\"updated_at\":\"2025-08-06T04:04:38.000000Z\"}]', '2025-10-27', 'monthly', 'active', 'Razorpay', 'success', 'pay_RMaszWjgQNdd5p', '2025-09-27 10:32:19', '2025-09-27 10:32:19'),
(12, '176085178454738', 13, 3, 'Standard Plan', 49.00, '[{\"id\":3,\"plan_name\":\"Standard Plan\",\"plan_price\":\"49.00\",\"expiration_date\":\"monthly\",\"short_description\":\"Ideal plan for individual creators\",\"features\":\"Subscription-Based Pricing\\r\\nPay-Per-Use Based Pricing\\r\\n10,000 Monthly Word Limit\\r\\n10+ Languages trasnlations\\r\\nAll types of content\",\"status\":\"active\",\"serial\":2,\"created_at\":\"2025-07-30T05:55:57.000000Z\",\"updated_at\":\"2025-08-06T04:04:38.000000Z\"}]', '2025-11-19', 'monthly', 'active', 'Stripe', 'success', 'txn_3SJpBZF56Pb8BOOX17TYGHvj', '2025-10-19 05:29:44', '2025-10-19 05:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_price` decimal(8,2) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `features` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `plan_name`, `plan_price`, `expiration_date`, `short_description`, `features`, `status`, `serial`, `created_at`, `updated_at`) VALUES
(1, 'Regular Plan', 29.00, 'monthly', 'Basic plan for  all users', 'Subscription-Based Pricing\r\nPay-Per-Use Based Pricing\r\n10,000 Monthly Word Limit\r\n10+ Languages trasnlations\r\nAll types of content', 'active', 1, '2025-07-30 05:45:32', '2025-07-30 06:11:06'),
(3, 'Standard Plan', 49.00, 'monthly', 'Ideal plan for individual creators', 'Subscription-Based Pricing\r\nPay-Per-Use Based Pricing\r\n10,000 Monthly Word Limit\r\n10+ Languages trasnlations\r\nAll types of content', 'active', 2, '2025-07-30 05:55:57', '2025-08-06 04:04:38'),
(4, 'Diamond Plan', 99.00, 'monthly', 'Ideal plan for individual creators', 'Subscription-Based Pricing\r\nPay-Per-Use Based Pricing\r\n10,000 Monthly Word Limit\r\n10+ Languages trasnlations\r\nAll types of content', 'active', 3, '2025-07-30 05:56:53', '2025-08-06 04:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_type` varchar(255) NOT NULL DEFAULT 'user' COMMENT 'admin, user',
  `ticket_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` enum('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `user_type`, `ticket_id`, `subject`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 'user', 'TKT-17586904438383', 'Office problem', 'open', '2025-09-24 05:07:23', '2025-09-24 05:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_messages`
--

CREATE TABLE `support_ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(11) NOT NULL,
  `message_user_id` int(11) NOT NULL,
  `send_by` varchar(255) NOT NULL DEFAULT 'user' COMMENT 'user, admin',
  `message` text NOT NULL,
  `is_seen` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_ticket_messages`
--

INSERT INTO `support_ticket_messages` (`id`, `support_ticket_id`, `message_user_id`, `send_by`, `message`, `is_seen`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'user', 'Test', 1, '2025-09-24 05:07:23', '2025-09-25 04:32:45'),
(2, 1, 13, 'user', 'I faced problem', 1, '2025-09-24 05:46:00', '2025-09-25 04:32:45'),
(3, 1, 4, 'admin', 'ok i will solved it', 1, '2025-09-24 05:47:48', '2025-09-25 04:41:04'),
(4, 1, 4, 'admin', 'see this foof', 1, '2025-09-24 05:50:52', '2025-09-25 04:41:04'),
(6, 1, 13, 'user', 'hello', 1, '2025-09-25 04:41:27', '2025-09-25 04:46:40'),
(7, 1, 13, 'user', 'test', 1, '2025-09-25 04:41:34', '2025-09-25 04:46:40'),
(8, 1, 4, 'admin', 'sasasd', 1, '2025-09-25 04:46:39', '2025-09-25 04:47:02'),
(9, 1, 4, 'admin', 'asdasd', 1, '2025-09-25 04:46:44', '2025-09-25 04:47:02'),
(10, 1, 13, 'user', 'asdasdasdas', 1, '2025-09-25 04:47:01', '2025-09-25 05:05:44'),
(11, 1, 13, 'user', 'asdasd', 1, '2025-09-25 04:47:07', '2025-09-25 05:05:44'),
(12, 1, 4, 'admin', 'okk', 1, '2025-09-25 05:06:06', '2025-09-25 05:07:46'),
(13, 1, 4, 'admin', 'jjjjj', 1, '2025-09-25 05:06:11', '2025-09-25 05:07:46'),
(14, 1, 13, 'user', 'test', 1, '2025-09-25 05:08:01', '2025-09-25 05:27:57'),
(15, 1, 13, 'user', 'ttt', 1, '2025-09-25 05:08:08', '2025-09-25 05:27:57'),
(16, 1, 13, 'user', 'ttt', 1, '2025-09-25 05:08:09', '2025-09-25 05:27:57'),
(17, 1, 13, 'user', '...', 1, '2025-09-25 05:27:40', '2025-09-25 05:27:57'),
(18, 1, 4, 'admin', 'ok done', 1, '2025-09-25 05:28:04', '2025-10-08 05:59:22'),
(19, 1, 13, 'user', 'sdsadsadadsdsa', 0, '2025-10-09 06:04:18', '2025-10-09 06:04:18'),
(20, 1, 13, 'user', 'sdasdas', 0, '2025-10-09 09:09:20', '2025-10-09 09:09:20'),
(21, 1, 13, 'user', 'hi therere aadasfasddfasdaksjdkjasjhlasdhkjasdjkhasdjhkasdhjkasdalkjasdjklasdjklasdjklasdljkasdlkjasdljklajsdjlkasd', 0, '2025-10-09 10:44:29', '2025-10-09 10:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `slug`, `image`, `mail`, `phone_number`, `facebook`, `twitter`, `linkedin`, `instagram`, `created_at`, `updated_at`) VALUES
(2, 'pasquale-s-larson', 'uploads/custom-images/team-2025-08-10-03-07-05-9400.webp', 'rashed@mail.com', '01303062727', 'https://www.facebook.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-01-07 06:05:54', '2025-08-10 09:07:06'),
(3, 'paul-m-morgan', 'uploads/custom-images/team-2025-08-10-03-05-50-9648.webp', 'mail@mail.com', '+1 (344) 722-7403', 'https://www.facebook.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-01-07 06:27:37', '2025-08-10 09:05:50'),
(4, 'howard-c-shoup', 'uploads/custom-images/team-2025-08-10-03-05-17-5575.webp', 'software@deligram.com', '0130306272727', 'https://www.fb.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-01-07 06:31:24', '2025-08-10 09:05:17'),
(5, 'dexter-m-banister', 'uploads/custom-images/team-2025-08-10-03-04-43-6717.webp', 'cmo@cmo.com', '01303062727', 'https://www.facebook.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-01-07 06:38:49', '2025-08-10 09:04:43'),
(6, 'richard-s-sanders', 'uploads/custom-images/team-2025-08-10-03-04-02-8441.webp', 'rashed@mail.com', '0130306272727', 'https://www.fb.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-02-16 09:57:00', '2025-08-10 09:04:02'),
(7, 'matthew-d-banks', 'uploads/custom-images/team-2025-08-10-03-03-23-5871.webp', 'aboutkhalil.83@gmail.com', '01234565676', 'https://www.fb.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-02-19 07:30:42', '2025-08-10 09:03:23'),
(8, 'lawrence-p-harrison', 'uploads/custom-images/team-2025-08-10-03-02-49-2370.webp', 'asid@gmail.com', '01234565676', 'https://www.fb.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-02-23 11:52:17', '2025-08-10 09:02:49'),
(9, 'steven-n-manning', 'uploads/custom-images/team-2025-08-10-03-01-55-7135.webp', 'lead@gmail.com', '01234533676', 'https://www.fb.com', 'https://x.com/?lang=en', 'https://www.linkedin.com/', 'https://www.instagram.com/accounts/login/?hl=en', '2025-02-23 11:53:22', '2025-08-10 09:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `team_translations`
--

CREATE TABLE `team_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_translations`
--

INSERT INTO `team_translations` (`id`, `team_id`, `lang_code`, `name`, `description`, `designation`, `created_at`, `updated_at`) VALUES
(3, 2, 'en', 'Pasquale S. Larson', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Jr. Motion Designer', '2025-01-07 06:05:54', '2025-08-10 09:07:06'),
(5, 3, 'en', 'Paul M. Morgan', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Graphics Designer', '2025-01-07 06:27:37', '2025-08-10 09:05:50'),
(7, 4, 'en', 'Howard C. Shoup', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Web Developer', '2025-01-07 06:31:24', '2025-08-10 09:05:17'),
(9, 5, 'en', 'Dexter M. Banister', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Product Designer', '2025-01-07 06:38:49', '2025-08-10 09:04:43'),
(11, 6, 'en', 'Richard S. Sanders', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Motion Designer', '2025-02-16 09:57:00', '2025-08-10 09:04:02'),
(13, 7, 'en', 'Matthew D. Banks', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Graphics Designer', '2025-02-19 07:30:42', '2025-08-10 09:03:23'),
(15, 8, 'en', 'Lawrence P. Harrison', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Web Developer', '2025-02-23 11:52:17', '2025-08-10 09:02:49'),
(17, 9, 'en', 'Steven N. Manning', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Product Designer', '2025-02-23 11:53:22', '2025-08-10 09:01:55'),
(35, 2, 'esp', 'Pasquale S. Larson', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Jr. Motion Designer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(36, 3, 'esp', 'Paul M. Morgan', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Graphics Designer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(37, 4, 'esp', 'Howard C. Shoup', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Web Developer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(38, 5, 'esp', 'Dexter M. Banister', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Product Designer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(39, 6, 'esp', 'Richard S. Sanders', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Motion Designer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(40, 7, 'esp', 'Matthew D. Banks', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Graphics Designer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(41, 8, 'esp', 'Lawrence P. Harrison', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Web Developer', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(42, 9, 'esp', 'Steven N. Manning', '<p>A content management system helps you create, manage, and publish content on the web. It also keep content organized and accessible so it can be used and repurposed effectively.</p>', 'Product Designer', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `term_and_conditions`
--

CREATE TABLE `term_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_and_conditions`
--

INSERT INTO `term_and_conditions` (`id`, `lang_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'en', '<h3>01.Introduction</h3>\r\n<p>A Privacy Policy is a legal document that informs users about the data collected, how it\'s used, and how it\'s protected. It typically includes information about the type of personal our ainformation collected (such as names, email addresses, etc.), the purpose of collection, and whether the information is shared with third parties. It outlines the rights of users regarding their data, such as the right to access, correct, or delete their information.</p>\r\n<h3>02. Quland Terms of Service</h3>\r\n<p>Terms of Service (also known as Terms and Conditions or Terms of Use) set the rules and guidelines for using a particular service or platform. They establish the contractual relationship between the user and the service provider. They often include details about user behavior, content usage policies, disclaimers, limitations of liability, and procedures for dispute resolution.Users typically agree to these terms by using the service.When you visit a website or use an online service, you are usually asked to agree to both the Privacy Policy and the Terms of Service. These documents are crucial for transparency, legal compliance, and establishing the terms under which users can access and use the service.</p>\r\n<p>It\'s important for businesses and service providers to keep these documents up-to-date and easily accessible to users. If you have specific questions or concerns about privacy policies or terms of service, feel free to provide more details, and I\'ll do my best to assist you.</p>\r\n<h3>3. Protect Your Property</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3>4. What to Include in Terms and Conditions for Limitations of Liability</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>ive centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n<h3>05.Pricing and Payment Policy</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', NULL, '2025-02-26 11:12:54'),
(23, 'esp', '<h3>01.Introduction</h3>\r\n<p>A Privacy Policy is a legal document that informs users about the data collected, how it\'s used, and how it\'s protected. It typically includes information about the type of personal our ainformation collected (such as names, email addresses, etc.), the purpose of collection, and whether the information is shared with third parties. It outlines the rights of users regarding their data, such as the right to access, correct, or delete their information.</p>\r\n<h3>02. Quland Terms of Service</h3>\r\n<p>Terms of Service (also known as Terms and Conditions or Terms of Use) set the rules and guidelines for using a particular service or platform. They establish the contractual relationship between the user and the service provider. They often include details about user behavior, content usage policies, disclaimers, limitations of liability, and procedures for dispute resolution.Users typically agree to these terms by using the service.When you visit a website or use an online service, you are usually asked to agree to both the Privacy Policy and the Terms of Service. These documents are crucial for transparency, legal compliance, and establishing the terms under which users can access and use the service.</p>\r\n<p>It\'s important for businesses and service providers to keep these documents up-to-date and easily accessible to users. If you have specific questions or concerns about privacy policies or terms of service, feel free to provide more details, and I\'ll do my best to assist you.</p>\r\n<h3>3. Protect Your Property</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown as printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuriezcs but also the on leap into as eylectronic typesetting, remaining as essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraszvxet sheets containing Lorem Ipsum our spassages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book. five centuries but also a the on leap into electronic typesetting, remaining essentially unchanged. It aswasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop our aspublishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<h3>4. What to Include in Terms and Conditions for Limitations of Liability</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also the on leap into as electronic ki typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of as Leitraset sheets containing Loriem Ipsum passages, our andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>ive centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset as sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Loriem Ipsum to make a type our as specimen book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets as containing Lorem Ipsum passages, andei more recently with a desktop publishing software like Aldus PageMaker including versions of Loremas Ipsum to make a type specimen book.</p>\r\n<h3>05.Pricing and Payment Policy</h3>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the as 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five as centuries but also as the on leap into electronic as typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release as of Letraset sheets containing Lorem Ipsum our spassages, andei more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>\r\n<p>five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing software like Aldus PageMaker our as including versions of Lorem aIpsum to make a type specimen our as book. It wasn&rsquo;t popularised in the 1960s with the release of Letraset sheetsasd containing Lorem Ipsum passages, andei more recentlysl with desktop publishing software like Aldus PageMaker including versions of Loremadfsfds Ipsum to make a type specimen book.</p>\r\n<p>It has survived not only five centuries but also the on leap into electronic typesetting, remaining essentially unchanged. It wasn&rsquo;t popularised in the our 1960s with the release of Letraset sheets containing Lorem Ipsum passages, andei more recently with desktop publishing asou software like Aldus PageMaker including versions of Lorem Ipsum to make a type specimen book.</p>', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `logo`, `image`, `status`, `created_at`, `updated_at`, `rating`) VALUES
(2, NULL, 'uploads/custom-images/chi-b-wooden-20250817094519.png', 'active', '2024-12-28 10:58:11', '2025-08-17 03:45:19', 4),
(3, NULL, 'uploads/custom-images/matthew-c-lan-20250817094442.png', 'active', '2025-02-23 10:30:43', '2025-08-17 03:44:42', 5),
(4, NULL, 'uploads/custom-images/michael-s-draper-20250817094358.png', 'active', '2025-02-23 12:00:43', '2025-08-17 03:43:58', 5),
(5, NULL, 'uploads/custom-images/stuart-g-garcia-20250817094236.png', 'active', '2025-02-23 12:01:39', '2025-08-17 03:42:36', 5),
(6, NULL, 'uploads/custom-images/chi-b-wooden-20250817094303.png', 'active', '2025-02-23 12:02:58', '2025-08-17 03:43:03', 5),
(7, NULL, 'uploads/custom-images/rogelio-j-treiber-20250817094132.png', 'active', '2025-02-23 12:03:45', '2025-08-17 03:41:32', 5),
(8, NULL, 'uploads/custom-images/david-j-barber-20250817093942.png', 'active', '2025-02-23 12:05:40', '2025-08-17 03:39:42', 5),
(9, NULL, 'uploads/custom-images/nathan-s-tucker-20250817094038.png', 'active', '2025-02-23 12:06:56', '2025-08-17 03:40:38', 5);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_trasnlations`
--

CREATE TABLE `testimonial_trasnlations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_id` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial_trasnlations`
--

INSERT INTO `testimonial_trasnlations` (`id`, `testimonial_id`, `lang_code`, `name`, `designation`, `comment`, `created_at`, `updated_at`) VALUES
(3, 2, 'en', 'Chi B. Wooden', 'Enigneer', 'Partnering with “Quland” rewrote success for our brand their innovative mindset and careful planning transformed marketing efforts outcomes stunned us.', '2024-12-28 10:58:11', '2025-08-17 05:22:54'),
(5, 3, 'en', 'Matthew C. Lan', 'Founder', 'Choosing “Quland” brought new life to our brand their strategic thinking and fine execution revamped our marketing journey results outdid expectations.', '2025-02-23 10:30:43', '2025-08-17 05:22:36'),
(7, 4, 'en', 'Michael S. Draper', 'CEO & Founder', 'Collaborating with “Quland” altered the course of our brand their bold tactics and eye for detail renewed our marketing system results shocked us.', '2025-02-23 12:00:43', '2025-08-17 05:22:08'),
(9, 5, 'en', 'Stuart G. Garcia', 'designer', 'Hiring “Quland” changed the pace for our brand their focused methods and refined vision boosted our marketing approach results were beyond belief.', '2025-02-23 12:01:39', '2025-08-17 05:21:41'),
(11, 6, 'en', 'Chi B. Wooden', 'Enigneer', 'Choosing “Quland” changed everything for our brand their bold creativity and eye for detail reshaped our marketing direction outcomes topped expectations.', '2025-02-23 12:02:58', '2025-08-17 05:20:12'),
(13, 7, 'en', 'Rogelio J. Treiber', 'Manager', 'Partnering with “Quland” made a huge impact on our brand their strategic insights and precision helped relaunch marketing efforts outcomes went beyond hopes.', '2025-02-23 12:03:45', '2025-08-17 05:19:17'),
(15, 8, 'en', 'David J. Barber', 'Businessman', 'Working with “Quland” proved transformative for our brand their clever thinking and sharp execution rebuilt our marketing vision results exceeded predictions', '2025-02-23 12:05:40', '2025-08-17 05:18:18'),
(17, 9, 'en', 'Nathan S. Tucker', 'Designer', 'Working with “Quland” was a game-changer for obrand their innovative approach attentions to detail helped us revamp marketing strategy completely results were bey.', '2025-02-23 12:06:56', '2025-08-17 07:13:23'),
(43, 2, 'esp', 'Chi B. Wooden', 'Enigneer', 'Partnering with “Quland” rewrote success for our brand their innovative mindset and careful planning transformed marketing efforts outcomes stunned us.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(44, 3, 'esp', 'Matthew C. Lan', 'Founder', 'Choosing “Quland” brought new life to our brand their strategic thinking and fine execution revamped our marketing journey results outdid expectations.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(45, 4, 'esp', 'Michael S. Draper', 'CEO & Founder', 'Collaborating with “Quland” altered the course of our brand their bold tactics and eye for detail renewed our marketing system results shocked us.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(46, 5, 'esp', 'Stuart G. Garcia', 'designer', 'Hiring “Quland” changed the pace for our brand their focused methods and refined vision boosted our marketing approach results were beyond belief.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(47, 6, 'esp', 'Chi B. Wooden', 'Enigneer', 'Choosing “Quland” changed everything for our brand their bold creativity and eye for detail reshaped our marketing direction outcomes topped expectations.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(48, 7, 'esp', 'Rogelio J. Treiber', 'Manager', 'Partnering with “Quland” made a huge impact on our brand their strategic insights and precision helped relaunch marketing efforts outcomes went beyond hopes.', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(49, 8, 'esp', 'David J. Barber', 'Businessman', 'Working with “Quland” proved transformative for our brand their clever thinking and sharp execution rebuilt our marketing vision results exceeded predictions', '2025-09-09 07:13:42', '2025-09-09 07:13:42'),
(50, 9, 'esp', 'Nathan S. Tucker', 'Designer', 'Working with “Quland” was a game-changer for obrand their innovative approach attentions to detail helped us revamp marketing strategy completely results were bey.', '2025-09-09 07:13:42', '2025-09-09 07:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `kyc_status` int(11) DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'disable',
  `is_banned` varchar(255) NOT NULL DEFAULT 'no',
  `language` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `forget_password_token` varchar(255) DEFAULT NULL,
  `online` varchar(255) DEFAULT NULL,
  `feez_status` tinyint(1) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `kyc_status`, `phone`, `address`, `zip`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `is_banned`, `language`, `verification_token`, `provider`, `provider_id`, `forget_password_token`, `online`, `feez_status`, `country_id`, `state_id`, `city_id`) VALUES
(13, 'Ibrahim Khalil', 'ibrahim-khalil-20250223065409', 'user@gmail.com', 0, '‪202-529-7619', '218/7 Begum Rokeya Avenue, Dhaka, Bangladesh', NULL, 'uploads/custom-images/ibrahim-khalil-2025-08-11-08-46-47-5125.png', '2025-02-23 12:54:26', '$2y$10$Us3bIAHLMJieST67wP9YmOq65yQebOQVNHO0G6EWNwUOMJdUQad1a', '0Ru1ZJOTCAbbNnpRlzm6EfLFJtxRt1KLALi2rspl1CON3c1OuywXAqF8SPFA', '2025-02-23 12:54:09', '2025-10-16 08:43:26', 'enable', 'no', NULL, NULL, NULL, NULL, 'MQl6oMxRb93xFZKxU8HmjiCMbIq1kVYHzKdiwkD89Iu5pLIZBzSNxQBBtQwii3Xg72TYIG5hgctueFeXzWb4geM1RlbK6xkg5TCs', '0', NULL, NULL, NULL, NULL),
(14, 'nirob', 'nirob-20251027113432', 'me11@sdf.com', 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$WxZ8YEqhZvbY9B6Mx8RfDeD1bwuOg8rxAtmlw8zU4dvAlfjDU65RC', NULL, '2025-10-27 05:34:32', '2025-10-27 05:34:32', 'enable', 'no', NULL, 'XMuQEges5hwcxWnPqJK0g4ccytYfpgaEC0nPF7q6JlmBvyA0I6QKUcAzgFHCSCVnpIZh4QmAVblL4KRW1wyT4yfBnmTRsQrHwArn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Nirob', 'nirob-20251028102920', 'rowafeg957@ametitas.com', 0, NULL, NULL, NULL, 'uploads/custom-images/nirob-2025-10-28-10-30-09-2871.webp', '2025-10-28 04:29:53', '$2y$10$vP4DODDMqEjyjcKN5iVZ..2DPhStKGEOUyqdC6jb6EdUl5gUjTE6.', NULL, '2025-10-28 04:29:20', '2025-10-28 04:30:09', 'enable', 'no', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(47, 11, 2, '2025-02-17 13:01:12', '2025-02-17 13:01:12'),
(199, 13, 4, '2025-10-19 03:49:08', '2025-10-19 03:49:08'),
(209, 13, 8, '2025-10-19 03:58:43', '2025-10-19 03:58:43'),
(216, 13, 3, '2025-10-19 07:01:01', '2025-10-19 07:01:01'),
(218, 13, 1, '2025-10-19 08:39:31', '2025-10-19 08:39:31'),
(219, 15, 1, '2025-10-28 05:02:34', '2025-10-28 05:02:34'),
(220, 15, 2, '2025-10-28 05:03:17', '2025-10-28 05:03:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us_translations`
--
ALTER TABLE `about_us_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category_translations`
--
ALTER TABLE `blog_category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_translations`
--
ALTER TABLE `contact_us_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_page_translations`
--
ALTER TABLE `custom_page_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_translations`
--
ALTER TABLE `footer_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepages`
--
ALTER TABLE `homepages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_translations`
--
ALTER TABLE `homepage_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing_translations`
--
ALTER TABLE `listing_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_sections`
--
ALTER TABLE `manage_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_items_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_item_translations_menu_item_id_locale_unique` (`menu_item_id`,`locale`);

--
-- Indexes for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_translations_menu_id_locale_unique` (`menu_id`,`locale`);

--
-- Indexes for table `message_documents`
--
ALTER TABLE `message_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_galleries`
--
ALTER TABLE `project_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_translations`
--
ALTER TABLE `project_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwa_icon_settings`
--
ALTER TABLE `pwa_icon_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_translations`
--
ALTER TABLE `slider_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_translations`
--
ALTER TABLE `state_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_histories`
--
ALTER TABLE `subscription_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_slug_unique` (`slug`);

--
-- Indexes for table `team_translations`
--
ALTER TABLE `team_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_and_conditions`
--
ALTER TABLE `term_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_trasnlations`
--
ALTER TABLE `testimonial_trasnlations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_us_translations`
--
ALTER TABLE `about_us_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog_category_translations`
--
ALTER TABLE `blog_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `brand_translations`
--
ALTER TABLE `brand_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us_translations`
--
ALTER TABLE `contact_us_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupon_histories`
--
ALTER TABLE `coupon_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custom_page_translations`
--
ALTER TABLE `custom_page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_translations`
--
ALTER TABLE `footer_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `homepages`
--
ALTER TABLE `homepages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homepage_translations`
--
ALTER TABLE `homepage_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `listing_translations`
--
ALTER TABLE `listing_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `manage_sections`
--
ALTER TABLE `manage_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `menu_translations`
--
ALTER TABLE `menu_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_documents`
--
ALTER TABLE `message_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `project_galleries`
--
ALTER TABLE `project_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_translations`
--
ALTER TABLE `project_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `pwa_icon_settings`
--
ALTER TABLE `pwa_icon_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider_translations`
--
ALTER TABLE `slider_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state_translations`
--
ALTER TABLE `state_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_histories`
--
ALTER TABLE `subscription_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team_translations`
--
ALTER TABLE `team_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `term_and_conditions`
--
ALTER TABLE `term_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonial_trasnlations`
--
ALTER TABLE `testimonial_trasnlations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD CONSTRAINT `menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
