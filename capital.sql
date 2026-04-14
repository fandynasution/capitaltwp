-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 12:31 PM
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
-- Database: `capital`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `id_foreign` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `id_foreign`, `name`) VALUES
(1, 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `all_login`
--

CREATE TABLE `all_login` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(140) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pict` varchar(255) DEFAULT NULL,
  `handphone` varchar(60) DEFAULT NULL,
  `tableforeign` varchar(60) NOT NULL,
  `idforeign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_login`
--

INSERT INTO `all_login` (`id`, `name`, `email`, `password`, `pict`, `handphone`, `tableforeign`, `idforeign`) VALUES
(1, 'Admin', 'admin@ifca.co.id', 'b4af804009cb036a4ccdc33431ef9ac9', 'https://demo.property365.co.id:4421/capital/webadmin/images/user/angel.jpg', '085710005641', 'administrator', 1),
(2, 'PT ALIBABA CLOUD INDONESIA', 'abdul.kahfi@ifca.co.id', 'b4af804009cb036a4ccdc33431ef9ac9', 'https://demo.property365.co.id:4421/capital/webtenant/img/user/capital_place.jpg', '081514131640', 'tenant', 2),
(3, 'Admin', 'amanda_afero@bat.com', 'b4af804009cb036a4ccdc33431ef9ac9', 'https://demo.property365.co.id:4421/capital/webadmin/images/user/angel.jpg', '085710005641', 'tenant', 3),
(12, 'PT PENJAMINAN INFRASTRUKTUR INDONESIA', 'ahmad.ariffandy@ifca.co.id', '8558fdee298f52c1edfdd9c8fbaba958', 'https://demo.property365.co.id:4421/capital/webtenant/img/user/whats_on_1.jpeg', '081514131640', 'tenant', 12),
(15, 'PT A.T. KEARNEY', 'abdulkahfi369@gmail.com', '48bf4fab397fbc6ce1c04202ea793907', 'https://demo.property365.co.id:4421/capital/webtenant/img/user/pagani_zonda_r-wide.jpg', '081514131640', 'tenant', 14),
(20, 'PT MSC MEDITERRANEAN SHIPPING INDONESIA', 'ahmad.ariffandy@gmail.com', '48bf4fab397fbc6ce1c04202ea793907', NULL, NULL, 'tenant', 20);

-- --------------------------------------------------------

--
-- Table structure for table `image_login`
--

CREATE TABLE `image_login` (
  `id` int(11) NOT NULL,
  `seq_no` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `webname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_login`
--

INSERT INTO `image_login` (`id`, `seq_no`, `image_url`, `webname`) VALUES
(4, '4', 'https://demo.property365.co.id:4421/capital/webadmin/images/slides/tenant/pb-1.jpg', 'tenant'),
(5, '5', 'https://demo.property365.co.id:4421/capital/webadmin/images/slides/tenant/pb-3.jpg', 'tenant'),
(6, '6', 'https://demo.property365.co.id:4421/capital/webadmin/images/slides/tenant/pb-2.jpg', 'tenant'),
(7, '1', 'https://demo.property365.co.id:4421/capital/webadmin/images/slides/tenant/pb-1.jpg', 'admin'),
(8, '2', 'https://demo.property365.co.id:4421/capital/webadmin/images/slides/tenant/pb-2.jpg', 'admin'),
(9, '3', 'https://demo.property365.co.id:4421/capital/webadmin/images/slides/tenant/pb-3.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `id` int(11) NOT NULL,
  `idforeign` int(11) NOT NULL,
  `logintime` datetime NOT NULL,
  `ipaddress` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`id`, `idforeign`, `logintime`, `ipaddress`) VALUES
(3072, 2, '2026-03-04 14:14:02', '::1'),
(3073, 2, '2026-03-04 15:22:01', '112.78.163.150'),
(3074, 2, '2026-03-04 15:29:51', '112.78.163.150'),
(3075, 3, '2026-03-04 15:31:17', '112.78.163.150'),
(3076, 2, '2026-03-05 11:44:05', '112.78.163.150'),
(3077, 2, '2026-03-11 11:25:59', '45.8.25.67'),
(3078, 2, '2026-04-06 09:54:36', '112.78.164.186'),
(3079, 2, '2026-04-09 10:42:22', '182.253.12.14'),
(3080, 2, '2026-04-09 10:45:00', '182.253.12.14'),
(3081, 2, '2026-04-09 10:52:18', '182.253.12.14'),
(3082, 2, '2026-04-09 11:09:02', '222.165.240.158'),
(3083, 2, '2026-04-09 11:27:40', '182.253.12.14'),
(3084, 2, '2026-04-09 13:35:51', '182.253.12.14'),
(3085, 2, '2026-04-09 13:52:51', '182.253.12.14'),
(3086, 2, '2026-04-09 14:48:03', '182.253.12.14'),
(3087, 2, '2026-04-09 14:51:52', '182.253.12.14'),
(3088, 2, '2026-04-09 14:57:36', '182.253.12.14'),
(3089, 2, '2026-04-09 15:24:21', '182.253.12.14'),
(3090, 2, '2026-04-09 15:36:28', '182.253.12.14'),
(3091, 2, '2026-04-09 15:45:24', '182.253.12.14'),
(3092, 2, '2026-04-09 15:49:23', '::1'),
(3093, 2, '2026-04-13 10:45:58', '182.253.12.14'),
(3094, 2, '2026-04-13 11:03:17', '182.253.12.14'),
(3095, 2, '2026-04-13 13:22:20', '182.253.12.14'),
(3096, 2, '2026-04-13 13:27:59', '182.253.12.14'),
(3097, 2, '2026-04-13 13:36:30', '182.253.12.14'),
(3098, 3, '2026-04-13 15:28:47', '::1'),
(3099, 3, '2026-04-13 15:30:49', '::1'),
(3100, 13, '2026-04-13 16:46:52', '::1'),
(3101, 13, '2026-04-13 16:49:11', '182.253.12.14'),
(3102, 13, '2026-04-13 16:51:59', '182.253.12.14'),
(3103, 13, '2026-04-13 17:00:57', '::1'),
(3104, 13, '2026-04-13 17:02:27', '::1'),
(3105, 13, '2026-04-13 17:06:18', '::1'),
(3106, 13, '2026-04-13 17:06:34', '::1'),
(3107, 13, '2026-04-13 17:07:39', '182.253.12.14'),
(3108, 13, '2026-04-13 17:14:15', '182.253.12.14'),
(3109, 13, '2026-04-13 17:14:47', '182.253.12.14'),
(3110, 13, '2026-04-13 17:22:57', '182.253.12.14'),
(3111, 13, '2026-04-14 13:57:21', '182.253.12.14'),
(3112, 13, '2026-04-14 14:00:26', '182.253.12.14'),
(3113, 13, '2026-04-14 14:00:27', '182.253.12.14'),
(3114, 13, '2026-04-14 14:01:05', '182.253.12.14'),
(3115, 12, '2026-04-14 14:15:19', '182.253.12.14'),
(3116, 12, '2026-04-14 14:23:03', '182.253.12.14'),
(3117, 12, '2026-04-14 14:26:08', '182.253.12.14'),
(3118, 12, '2026-04-14 14:29:33', '182.253.12.14'),
(3119, 12, '2026-04-14 14:29:53', '182.253.12.14'),
(3120, 12, '2026-04-14 14:30:59', '182.253.12.14'),
(3121, 12, '2026-04-14 14:40:31', '::1'),
(3122, 12, '2026-04-14 14:42:32', '::1'),
(3123, 12, '2026-04-14 14:52:14', '::1'),
(3124, 12, '2026-04-14 15:27:36', '::1'),
(3125, 12, '2026-04-14 15:28:38', '182.253.12.14'),
(3126, 14, '2026-04-14 15:32:20', '182.253.12.14'),
(3127, 14, '2026-04-14 15:35:04', '::1'),
(3128, 20, '2026-04-14 16:46:30', '182.253.12.14'),
(3129, 12, '2026-04-14 16:50:44', '182.253.12.14'),
(3130, 20, '2026-04-14 17:01:11', '182.253.12.14');

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `id` int(11) NOT NULL,
  `subject` varchar(160) NOT NULL,
  `content` text NOT NULL,
  `content_type` varchar(10) NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `attach_type` varchar(10) NOT NULL,
  `youtube_link` text DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsfeed`
--

INSERT INTO `newsfeed` (`id`, `subject`, `content`, `content_type`, `status`, `date_created`, `attach_type`, `youtube_link`, `picture`, `active`) VALUES
(13, 'NEWS BARU', '<p>NEWS BARU</p>', 'news', 1, '2026-04-09 08:05:49', 'P', NULL, 'https://demo.property365.co.id:4421/capital/webadmin/images/newspromo/WhatsApp_Image_2026-02-05_at_14.13.56.jpeg', 1),
(14, 'LINK YOUTUBE', '<p>LINK YOUTUBE</p>', 'news', 1, '2026-04-09 08:06:23', 'Y', 'https://www.youtube.com/watch?v=A0A7IZugRd4', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ot_trx`
--

CREATE TABLE `ot_trx` (
  `entity_cd` varchar(4) NOT NULL,
  `project_no` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `id_tenancy` int(11) NOT NULL,
  `lot_no` varchar(8) NOT NULL,
  `status` char(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `description` text NOT NULL,
  `approved` char(1) NOT NULL,
  `start_overtime` datetime NOT NULL,
  `end_overtime` datetime NOT NULL,
  `status_email` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ot_trx`
--

INSERT INTO `ot_trx` (`entity_cd`, `project_no`, `id`, `id_tenant`, `id_tenancy`, `lot_no`, `status`, `date_created`, `description`, `approved`, `start_overtime`, `end_overtime`, `status_email`) VALUES
('0001', 'JSE01', 1, 2, 2, '23-D', 'Z', '2026-04-09 05:57:24', 'Overtime Testing Kahfi IFCA (Mohon di abaikan)', 'Y', '2026-04-09 05:57:24', '2026-04-09 05:57:24', 'N'),
('0001', 'JSE01', 31, 2, 2, '23-D', 'X', '2026-04-09 12:21:55', 'TWP (Tenant Web Portal)', 'N', '2026-04-09 18:00:00', '2026-04-09 19:00:00', 'N'),
('0001', 'JSE01', 32, 2, 2, '23-D', 'Z', '2026-04-09 13:54:17', 'Request Overtime IFCA', 'Y', '2026-04-09 20:00:00', '2026-04-09 21:00:00', 'N'),
('0001', 'JSE01', 33, 2, 2, '23-D', 'Z', '2026-04-09 14:48:17', 'TWP (Tenant Web Portal)', 'Y', '2026-04-10 18:00:00', '2026-04-10 19:00:00', 'N'),
('0001', 'JSE01', 34, 12, 12, '08-A', 'Z', '2026-04-14 14:19:59', 'Request overtime untuk audit', 'Y', '2026-04-14 18:00:00', '2026-04-14 20:00:00', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `ot_trxdt`
--

CREATE TABLE `ot_trxdt` (
  `id` int(11) NOT NULL,
  `id_overtime` int(11) NOT NULL,
  `dt_starttime` datetime NOT NULL,
  `dt_endtime` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ot_trxdt`
--

INSERT INTO `ot_trxdt` (`id`, `id_overtime`, `dt_starttime`, `dt_endtime`, `date_created`) VALUES
(31, 1, '2026-04-09 05:58:29', '2026-04-09 05:58:29', '2026-04-09 05:58:29'),
(32, 31, '2026-04-09 18:00:00', '2026-04-09 19:00:00', '2026-04-09 12:21:55'),
(33, 32, '2026-04-09 20:00:00', '2026-04-09 21:00:00', '2026-04-09 13:54:17'),
(34, 33, '2026-04-10 18:00:00', '2026-04-10 19:00:00', '2026-04-09 14:48:17'),
(35, 34, '2026-04-14 18:00:00', '2026-04-14 20:00:00', '2026-04-14 14:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `pm_survey_dt`
--

CREATE TABLE `pm_survey_dt` (
  `id` int(11) NOT NULL,
  `publish_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `line_no` int(11) NOT NULL,
  `options` varchar(255) NOT NULL,
  `flag_remark` int(11) NOT NULL,
  `audit_user` varchar(20) NOT NULL,
  `audit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_survey_dt`
--

INSERT INTO `pm_survey_dt` (`id`, `publish_id`, `survey_id`, `line_no`, `options`, `flag_remark`, `audit_user`, `audit_date`) VALUES
(62, 26, 26, 1, 'TIDAK', 0, '1', '2026-04-09 08:14:28'),
(63, 26, 26, 2, 'YA', 0, '1', '2026-04-09 08:14:28'),
(64, 27, 27, 1, '111', 0, '1', '2026-04-09 08:38:29'),
(65, 27, 27, 2, '333', 0, '1', '2026-04-09 08:38:29'),
(66, 28, 28, 1, 'ffff', 0, '1', '2026-04-09 08:38:36'),
(67, 28, 28, 2, 'lll', 1, '1', '2026-04-09 08:38:36'),
(68, 29, 29, 1, 'Remarks isi', 0, '1', '2026-04-09 08:40:42'),
(69, 29, 29, 2, 'Isi Remarks', 1, '1', '2026-04-09 08:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `pm_survey_hd`
--

CREATE TABLE `pm_survey_hd` (
  `id` int(11) NOT NULL,
  `publish_id` int(11) NOT NULL,
  `quest_no` int(11) NOT NULL,
  `subject` varchar(160) NOT NULL,
  `content` text NOT NULL,
  `audit_user` varchar(20) NOT NULL,
  `audit_date` datetime NOT NULL,
  `tmpsurvey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_survey_hd`
--

INSERT INTO `pm_survey_hd` (`id`, `publish_id`, `quest_no`, `subject`, `content`, `audit_user`, `audit_date`, `tmpsurvey_id`) VALUES
(26, 26, 1, 'BARU', 'GANTENG', '1', '2026-04-09 08:14:28', 15),
(27, 27, 1, '123', '111', '1', '2026-04-09 08:38:29', 16),
(28, 28, 1, 'aaaad', 'dddd', '1', '2026-04-09 08:38:36', 17),
(29, 29, 1, 'Remarks', 'ada Remarks', '1', '2026-04-09 08:40:42', 18);

-- --------------------------------------------------------

--
-- Table structure for table `pm_survey_publish`
--

CREATE TABLE `pm_survey_publish` (
  `id` int(11) NOT NULL,
  `title` varchar(160) NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `expireddate` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `flag_publish` smallint(6) NOT NULL,
  `audit_user` varchar(20) NOT NULL,
  `audit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_survey_publish`
--

INSERT INTO `pm_survey_publish` (`id`, `title`, `publishdate`, `expireddate`, `date_created`, `flag_publish`, `audit_user`, `audit_date`) VALUES
(26, 'BARU', '2026-04-09 00:00:00', '2026-04-11 00:00:00', '2026-04-09 08:14:28', 1, '1', '2026-04-09 08:14:40'),
(27, '123', '2026-04-09 00:00:00', '2026-04-10 00:00:00', '2026-04-09 08:38:29', 1, '1', '2026-04-09 08:38:48'),
(28, 'aa', '2026-04-09 00:00:00', '2026-04-11 00:00:00', '2026-04-09 08:38:36', 1, '1', '2026-04-09 08:38:56'),
(29, 'Remarks', '2026-04-09 00:00:00', '2026-04-12 00:00:00', '2026-04-09 08:40:42', 1, '1', '2026-04-09 08:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `pm_survey_respon`
--

CREATE TABLE `pm_survey_respon` (
  `id` int(11) NOT NULL,
  `publish_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `respon` int(11) NOT NULL,
  `remark` text DEFAULT NULL,
  `user_id` varchar(20) NOT NULL,
  `email_addr` varchar(60) NOT NULL,
  `date_created` datetime NOT NULL,
  `audit_user` varchar(10) NOT NULL,
  `audit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_survey_respon`
--

INSERT INTO `pm_survey_respon` (`id`, `publish_id`, `survey_id`, `respon`, `remark`, `user_id`, `email_addr`, `date_created`, `audit_user`, `audit_date`) VALUES
(23, 26, 26, 2, NULL, '00000011', 'abdul.kahfi@ifca.co.id', '2026-04-09 15:14:54', '', '2026-04-09 15:14:54'),
(24, 27, 27, 2, NULL, '00000011', 'abdul.kahfi@ifca.co.id', '2026-04-09 15:39:13', '', '2026-04-09 15:39:13'),
(25, 28, 28, 2, NULL, '00000011', 'abdul.kahfi@ifca.co.id', '2026-04-09 15:39:20', '', '2026-04-09 15:39:20'),
(28, 29, 29, 2, 'ISI', '00000011', 'abdul.kahfi@ifca.co.id', '2026-04-09 15:43:00', '', '2026-04-09 15:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `pm_tenancy`
--

CREATE TABLE `pm_tenancy` (
  `id` int(11) NOT NULL,
  `tenant_no` varchar(20) NOT NULL,
  `entity_cd` varchar(4) NOT NULL,
  `project_no` varchar(20) NOT NULL,
  `contract_date` datetime DEFAULT NULL,
  `commence_date` datetime DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `business_no` varchar(20) DEFAULT NULL,
  `entity_desc` varchar(60) DEFAULT NULL,
  `project_desc` varchar(60) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_tenancy`
--

INSERT INTO `pm_tenancy` (`id`, `tenant_no`, `entity_cd`, `project_no`, `contract_date`, `commence_date`, `expiry_date`, `business_no`, `entity_desc`, `project_desc`, `status`) VALUES
(2, '034-ALIBABA', '0001', 'JSE01', '2021-11-08 00:00:00', '2021-12-13 00:00:00', '2026-12-12 00:00:00', '00000011', 'PT ALIBABA CLOUD INDONESIA', 'IFCA TOWER', 'A'),
(3, 'MPP', '0001', 'JSE01', '2022-01-25 00:00:00', '2022-01-25 00:00:00', '2028-01-25 00:00:00', '00000001', 'PT. IFCA Property365 Indonesia', 'IFCA TOWER', 'A'),
(12, '002-PENJAMINAN', '0001', 'JSE01', '2025-11-17 00:00:00', '2023-09-01 00:00:00', '2026-08-31 00:00:00', '00000002', 'PT MAHKOTA PRIMA PROPERTI', 'CAPITAL PLACE', 'A'),
(14, '004-KEARNEY', '0001', 'JSE01', '2025-11-17 00:00:00', '2022-04-01 00:00:00', '2027-03-31 00:00:00', '00000004', 'PT MAHKOTA PRIMA PROPERTI', 'CAPITAL PLACE', 'A'),
(20, '010-MSC', '0001', 'JSE01', '2025-11-17 00:00:00', '2025-07-01 00:00:00', '2027-12-31 00:00:00', '00000006', 'PT MAHKOTA PRIMA PROPERTI', 'CAPITAL PLACE', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pm_tmpsurvey`
--

CREATE TABLE `pm_tmpsurvey` (
  `id` int(11) NOT NULL,
  `subject` varchar(160) NOT NULL,
  `content` text NOT NULL,
  `date_created` datetime NOT NULL,
  `audit_user` varchar(20) NOT NULL,
  `audit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_tmpsurvey`
--

INSERT INTO `pm_tmpsurvey` (`id`, `subject`, `content`, `date_created`, `audit_user`, `audit_date`) VALUES
(15, 'BARU', 'GANTENG', '2026-04-09 08:14:11', '1', '2026-04-09 08:14:11'),
(16, '123', '111', '2026-04-09 08:35:55', '1', '2026-04-09 08:35:55'),
(17, 'aaaad', 'dddd', '2026-04-09 08:36:10', '1', '2026-04-09 08:36:10'),
(18, 'Remarks', 'ada Remarks', '2026-04-09 08:40:29', '1', '2026-04-09 08:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `pm_tmpsurvey_dtl`
--

CREATE TABLE `pm_tmpsurvey_dtl` (
  `id` int(11) NOT NULL,
  `tmpsurvey_id` int(11) NOT NULL,
  `options` varchar(255) NOT NULL,
  `line_no` int(11) NOT NULL,
  `flag_remark` smallint(6) NOT NULL,
  `audit_user` varchar(20) NOT NULL,
  `audit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pm_tmpsurvey_dtl`
--

INSERT INTO `pm_tmpsurvey_dtl` (`id`, `tmpsurvey_id`, `options`, `line_no`, `flag_remark`, `audit_user`, `audit_date`) VALUES
(65, 15, 'TIDAK', 1, 0, '1', '2026-04-09 08:14:11'),
(66, 15, 'YA', 2, 0, '1', '2026-04-09 08:14:11'),
(67, 16, '111', 1, 0, '1', '2026-04-09 08:35:55'),
(68, 16, '333', 2, 0, '1', '2026-04-09 08:35:55'),
(69, 17, 'ffff', 1, 0, '1', '2026-04-09 08:36:10'),
(70, 17, 'lll', 2, 1, '1', '2026-04-09 08:36:10'),
(71, 18, 'Remarks isi', 1, 0, '1', '2026-04-09 08:40:29'),
(72, 18, 'Isi Remarks', 2, 1, '1', '2026-04-09 08:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `sv_entry_multi`
--

CREATE TABLE `sv_entry_multi` (
  `id` int(5) NOT NULL,
  `complain_no` varchar(10) NOT NULL,
  `id_tenant` int(5) NOT NULL,
  `reported_by` varchar(10) DEFAULT NULL,
  `reported_date` date DEFAULT NULL,
  `serv_req_by` varchar(60) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `floor` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `billing_type` char(1) DEFAULT NULL,
  `complain_type` char(1) DEFAULT NULL,
  `complain_source` varchar(20) DEFAULT NULL,
  `category_cd` varchar(4) DEFAULT NULL,
  `lot_no` varchar(8) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `work_requested` varchar(255) DEFAULT NULL,
  `id_tenancy` int(5) NOT NULL,
  `report_no` varchar(20) DEFAULT NULL,
  `tenant_no` varchar(20) DEFAULT NULL,
  `entity_cd` varchar(4) DEFAULT NULL,
  `project_no` varchar(20) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `pic_attached` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sv_entry_multi`
--

INSERT INTO `sv_entry_multi` (`id`, `complain_no`, `id_tenant`, `reported_by`, `reported_date`, `serv_req_by`, `location`, `floor`, `contact_no`, `billing_type`, `complain_type`, `complain_source`, `category_cd`, `lot_no`, `status`, `work_requested`, `id_tenancy`, `report_no`, `tenant_no`, `entity_cd`, `project_no`, `picture`, `pic_attached`) VALUES
(2486, '26000036', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'Ruang Finance', '23', '081247484857556', 'T', 'R', '01', '4002', '23-D', 'R', 'asdasdasd', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/025.jpg', NULL),
(2487, '26000036', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'Ruang Finance', '23', '081247484857556', 'T', 'R', '01', '4002', '23-D', 'R', 'asdasd', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/025.jpg', NULL),
(2488, '26000036', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'IFCA TEST', '23', '081247484857556', 'T', 'R', '01', '4002', '23-D', 'R', 'asdasdasd', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/025.jpg', NULL),
(2489, '26000037', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'Ruang Finance', '23', '081247484857556', 'T', 'R', '01', '4002', '23-D', 'R', 'asdasdasd', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/1763546003588.jpg', NULL),
(2490, '26000037', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'Ruang Finance', '23', '081247484857556', 'T', 'R', '01', '4002', '23-D', 'R', 'asdasdasd', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/1763546003588.jpg', NULL),
(2491, '26000038', 2, 'TWP', '2026-04-09', 'Kahfi Lantai 4', 'Ruang Meeting Besar', '23', '081514131640', 'T', 'C', '01', '0507', '23-D', 'R', 'Kabel banyak yang tidak rapih, berserakan dan juga ada kabel terbuka di ruang meeting besar IFCA', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/WhatsApp_Image_2026-03-12_at_15.54.07.jpeg', NULL),
(2492, '73', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'IFCA TEST', '23', '081295150532', 'T', 'R', '01', '4002', '23-D', 'R', 'Request / Complain Testing Kahfi IFCA (Mohon di abaikan)', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/Screenshot_(13).png', NULL),
(2493, '74', 2, 'TWP', '2026-04-09', 'Kahfi IFCA', 'Kantor IFCA', '23', '081514131640', 'T', 'C', '01', '2701', '23-D', 'R', 'Koneksi Internet Mati di lantai 2 NEO, segera diperbaiki', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/image001_(1).png', NULL),
(2494, '75', 2, 'TWP', '2026-04-09', 'IFCA KAHFI', 'IFCA TEST', '23', '081295150532', 'T', 'R', '01', '0102', '23-D', 'A', 'Freon tolong ditambahkan', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/WhatsApp_Image_2026-02-19_at_11.34.29.jpeg', NULL),
(2495, '76', 2, 'TWP', '2026-04-09', 'IFCA Kahfi', 'Kantor IFCA', '23', '081514131640', 'T', 'C', '01', '4001', '23-D', 'R', 'Tiket masih belum bisa mengupdate status di postgre (TWP)', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/image_2026-04-09_145217392.png', NULL),
(2496, '77', 2, 'TWP', '2026-04-13', 'Ilham IFCA', 'Lantai 4 IFCA', '23', '081514131640', 'T', 'C', '01', '1804', '23-D', 'A', 'Kipas angin mati karena konslet kesiram air', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/image001_(2).png', NULL),
(2497, '78', 2, 'TWP', '2026-04-13', 'Ilham IFCA', 'Lantai 4 IFCA', '23', '081514131640', 'T', 'C', '01', '2502', '23-D', 'A', 'Kehilangan kepala chargeran Iphone 17 PRO MAX', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/WhatsApp_Image_2026-01-08_at_13.40.47.jpeg', NULL),
(2498, '79', 2, 'TWP', '2026-04-13', 'Ilham IFCA', 'Lantai 2', '23', '081514131640', 'T', 'C', '01', '2602', '23-D', 'A', 'Ada tikus lewat', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/A.png', NULL),
(2499, '80', 2, 'TWP', '2026-04-13', 'Fandy', 'Lantai 2 Pojok', '23', '-', 'T', 'C', '01', '0113', '23-D', 'C', 'AC Bocor, air menetes', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/image001_(2).png', NULL),
(2500, '81', 2, 'TWP', '2026-04-13', 'Abdul Kahfi', 'Pantry Lantai 4', '23', '0', 'T', 'C', '01', '2103', '23-D', 'C', 'Ada genangan air di lantai depan toilet sebelah kanan di Pantry Lantai 4, rawan orang terpleset', 2, NULL, '034-ALIBABA', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/A.png', NULL),
(2501, '82', 12, 'TWP', '2026-04-14', 'Arieffandy', 'R. Finance Lt 7', '07', '02191085269', 'T', 'R', '01', '1201', '07-A', 'C', 'Tolong tambahkan lampu penerangan di ruang finance karena sangat remang-remang', 12, NULL, '002-PENJAMINAN', '0001', 'JSE01', 'https://demo.property365.co.id:4421/capital/webtenant/storage/file_ticket/12012026002.png', NULL),
(2502, '83', 13, 'TWP', '2026-04-14', 'Fardi', 'Lantai 2 Neo', '48', '-', 'T', 'C', '01', '2602', '48-A1', 'R', 'Bersihkan sarang laba-laba', 13, NULL, '004-KEARNEY', '0001', 'JSE01', 'https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1', NULL),
(2503, '84', 20, 'TWP', '2026-04-14', 'Admin', 'Koridor', '39', '-', 'T', 'R', '01', '2606', '39-B', 'C', 'Banyak debu dan kotoran di karpet sepanjang jalan koridor', 20, NULL, '010-MSC', '0001', 'JSE01', 'https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `contact_name` varchar(60) DEFAULT NULL,
  `contact_mobile` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(160) NOT NULL,
  `status` smallint(6) NOT NULL,
  `business_no` varchar(20) NOT NULL,
  `tenant_no_df` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `name`, `phone`, `contact_name`, `contact_mobile`, `address`, `email`, `status`, `business_no`, `tenant_no_df`) VALUES
(2, 'PT ALIBABA CLOUD INDONESIA', '021-8282455', 'PT ALIBABA CLOUD INDONESIA', NULL, 'Jln. Sultan Agung no. 58AB Manggarai Jakarta Selatan 12970', 'abdul.kahfi@ifca.co.id', 1, '00000011', '034-ALIBABA'),
(3, 'PT BENTOEL INTERNASIONAL INVESTAMA, Tbk.', NULL, 'Ibu Amanda Afero, Ibu Kiara Hati, Bapak Budi Karteja', NULL, 'Trinity Tower, Basement 1   ', 'amanda_afero@bat.com', 1, '00000001', 'MPP'),
(12, 'PT PENJAMINAN INFRASTRUKTUR INDONESIA', NULL, 'Bapak Ricky Chaniago,Bapak Zulfikar', '', 'CAPITAL PLACE LT. 7-8 JL GATOT SUBROTO KAV. 18, RT 006, RW 001, KUNINGAN BARAT, MAMPANG PRAPATAN, KOTA ADM. JAKARTA SELATAN, DKI JAKARTA  12710', 'ahmad.ariffandy@ifca.co.id', 1, '00000002', '002-PENJAMINAN'),
(14, 'PT A.T. KEARNEY', NULL, 'Ibu Lusiana Lukman,Ibu Anita Andriyani,Bapak Barjah Mohamad', '', 'CAPITAL PLACE LT. 48 JL GATOT SUBROTO KAV. 18, RT 006, RW 001, KUNINGAN BARAT, MAMPANG PRAPATAN, KOTA ADM. JAKARTA SELATAN, DKI JAKARTA  12710', 'abdulkahfi369@gmail.com', 1, '00000004', '004-KEARNEY'),
(20, 'PT MSC MEDITERRANEAN SHIPPING INDONESIA', NULL, 'Ibu Ayu Mukti, Ibu Rena Eka', '', 'CAPITAL PLACE LT. 39 JL GATOT SUBROTO KAV. 18, RT 006, RW 001, KUNINGAN BARAT, MAMPANG PRAPATAN, KOTA ADM. JAKARTA SELATAN, DKI JAKARTA  12710', 'ahmad.ariffandy@gmail.com', 1, '00000006', '010-MSC');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ot_tenancy`
-- (See below for the actual view)
--
CREATE TABLE `v_ot_tenancy` (
`entity_cd` varchar(4)
,`entity_desc` varchar(60)
,`project_no` varchar(20)
,`project_desc` varchar(60)
,`tenant_no` varchar(20)
,`id` int(11)
,`id_tenant` int(11)
,`id_tenancy` int(11)
,`lot_no` varchar(8)
,`status` char(1)
,`date_created` datetime
,`description` text
,`approved` char(1)
,`start_overtime` datetime
,`end_overtime` datetime
,`status_email` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pmpublish_pmsurveyhd`
-- (See below for the actual view)
--
CREATE TABLE `v_pmpublish_pmsurveyhd` (
`title` varchar(160)
,`publish_id` int(11)
,`expireddate` datetime
,`publishdate` datetime
,`flag_publish` smallint(6)
,`quest_no` int(11)
,`subject` varchar(160)
,`content` text
,`tmpsurvey_id` int(11)
,`survey_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pm_survey`
-- (See below for the actual view)
--
CREATE TABLE `v_pm_survey` (
`survey_id` int(11)
,`publish_id` int(11)
,`subject` varchar(160)
,`content` text
,`options` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pm_survey_all`
-- (See below for the actual view)
--
CREATE TABLE `v_pm_survey_all` (
`survey_id` int(11)
,`publish_id` int(11)
,`quest_no` int(11)
,`subject` varchar(160)
,`content` text
,`options` varchar(255)
,`line_no` int(11)
,`flag_remark` int(11)
,`tmpsurvey_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pm_survey_publish`
-- (See below for the actual view)
--
CREATE TABLE `v_pm_survey_publish` (
`title` varchar(160)
,`publish_id` int(11)
,`expireddate` datetime
,`publishdate` datetime
,`subjects` mediumtext
,`flag_publish` smallint(6)
,`is_active` varchar(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pm_survey_result`
-- (See below for the actual view)
--
CREATE TABLE `v_pm_survey_result` (
`publish_id` int(11)
,`title` varchar(160)
,`content` text
,`options` varchar(255)
,`flag_remark` int(11)
,`expireddate` datetime
,`publishdate` datetime
,`quest_no` int(11)
,`line_no` int(11)
,`jumlah` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pm_tmpsurvey_all`
-- (See below for the actual view)
--
CREATE TABLE `v_pm_tmpsurvey_all` (
`tmpsurvey_id` int(11)
,`subject` varchar(160)
,`content` text
,`options` varchar(255)
,`date_created` datetime
,`line_no` int(11)
,`flag_remark` smallint(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tmpsurvey`
-- (See below for the actual view)
--
CREATE TABLE `v_tmpsurvey` (
`tmpsurvey_id` int(11)
,`subject` varchar(160)
,`content` text
,`date_created` datetime
,`options` mediumtext
);

-- --------------------------------------------------------

--
-- Structure for view `v_ot_tenancy`
--
DROP TABLE IF EXISTS `v_ot_tenancy`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ot_tenancy`  AS SELECT `pt`.`entity_cd` AS `entity_cd`, `pt`.`entity_desc` AS `entity_desc`, `pt`.`project_no` AS `project_no`, `pt`.`project_desc` AS `project_desc`, `pt`.`tenant_no` AS `tenant_no`, `ot`.`id` AS `id`, `ot`.`id_tenant` AS `id_tenant`, `ot`.`id_tenancy` AS `id_tenancy`, `ot`.`lot_no` AS `lot_no`, `ot`.`status` AS `status`, `ot`.`date_created` AS `date_created`, `ot`.`description` AS `description`, `ot`.`approved` AS `approved`, `ot`.`start_overtime` AS `start_overtime`, `ot`.`end_overtime` AS `end_overtime`, `ot`.`status_email` AS `status_email` FROM (`ot_trx` `ot` join `pm_tenancy` `pt` on(`pt`.`id` = `ot`.`id_tenancy`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pmpublish_pmsurveyhd`
--
DROP TABLE IF EXISTS `v_pmpublish_pmsurveyhd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pmpublish_pmsurveyhd`  AS SELECT `a`.`title` AS `title`, `a`.`id` AS `publish_id`, `a`.`expireddate` AS `expireddate`, `a`.`publishdate` AS `publishdate`, `a`.`flag_publish` AS `flag_publish`, `b`.`quest_no` AS `quest_no`, `b`.`subject` AS `subject`, `b`.`content` AS `content`, `b`.`tmpsurvey_id` AS `tmpsurvey_id`, `b`.`id` AS `survey_id` FROM (`pm_survey_publish` `a` join `pm_survey_hd` `b` on(`a`.`id` = `b`.`publish_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pm_survey`
--
DROP TABLE IF EXISTS `v_pm_survey`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pm_survey`  AS SELECT `v_pm_survey_all`.`survey_id` AS `survey_id`, `v_pm_survey_all`.`publish_id` AS `publish_id`, `v_pm_survey_all`.`subject` AS `subject`, `v_pm_survey_all`.`content` AS `content`, group_concat(`v_pm_survey_all`.`options` separator ', ') AS `options` FROM `v_pm_survey_all` GROUP BY `v_pm_survey_all`.`survey_id` ORDER BY `v_pm_survey_all`.`quest_no` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_pm_survey_all`
--
DROP TABLE IF EXISTS `v_pm_survey_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pm_survey_all`  AS SELECT `a`.`id` AS `survey_id`, `a`.`publish_id` AS `publish_id`, `a`.`quest_no` AS `quest_no`, `a`.`subject` AS `subject`, `a`.`content` AS `content`, `b`.`options` AS `options`, `b`.`line_no` AS `line_no`, `b`.`flag_remark` AS `flag_remark`, `a`.`tmpsurvey_id` AS `tmpsurvey_id` FROM (`pm_survey_hd` `a` join `pm_survey_dt` `b`) WHERE `a`.`id` = `b`.`survey_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_pm_survey_publish`
--
DROP TABLE IF EXISTS `v_pm_survey_publish`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pm_survey_publish`  AS SELECT `a`.`title` AS `title`, `a`.`id` AS `publish_id`, `a`.`expireddate` AS `expireddate`, `a`.`publishdate` AS `publishdate`, group_concat(`b`.`subject` separator ', ') AS `subjects`, `a`.`flag_publish` AS `flag_publish`, CASE WHEN current_timestamp() between `a`.`publishdate` and `a`.`expireddate` THEN '1' ELSE '0' END AS `is_active` FROM (`pm_survey_publish` `a` join `v_pm_survey` `b` on(`a`.`id` = `b`.`publish_id`)) GROUP BY `a`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_pm_survey_result`
--
DROP TABLE IF EXISTS `v_pm_survey_result`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pm_survey_result`  AS SELECT `c`.`id` AS `publish_id`, `c`.`title` AS `title`, `a`.`content` AS `content`, `b`.`options` AS `options`, `b`.`flag_remark` AS `flag_remark`, `c`.`expireddate` AS `expireddate`, `c`.`publishdate` AS `publishdate`, `a`.`quest_no` AS `quest_no`, `b`.`line_no` AS `line_no`, (select count(1) from `pm_survey_respon` `d` where `d`.`survey_id` = `b`.`survey_id` and `d`.`respon` = `b`.`line_no`) AS `jumlah` FROM ((`pm_survey_hd` `a` join `pm_survey_dt` `b`) join `pm_survey_publish` `c`) WHERE `a`.`id` = `b`.`survey_id` AND `a`.`publish_id` = `c`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_pm_tmpsurvey_all`
--
DROP TABLE IF EXISTS `v_pm_tmpsurvey_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pm_tmpsurvey_all`  AS SELECT `a`.`id` AS `tmpsurvey_id`, `a`.`subject` AS `subject`, `a`.`content` AS `content`, `b`.`options` AS `options`, `a`.`date_created` AS `date_created`, `b`.`line_no` AS `line_no`, `b`.`flag_remark` AS `flag_remark` FROM (`pm_tmpsurvey` `a` join `pm_tmpsurvey_dtl` `b`) WHERE `a`.`id` = `b`.`tmpsurvey_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_tmpsurvey`
--
DROP TABLE IF EXISTS `v_tmpsurvey`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tmpsurvey`  AS SELECT `vpta`.`tmpsurvey_id` AS `tmpsurvey_id`, `vpta`.`subject` AS `subject`, `vpta`.`content` AS `content`, `vpta`.`date_created` AS `date_created`, group_concat(`vpta`.`options` separator ', ') AS `options` FROM `v_pm_tmpsurvey_all` AS `vpta` GROUP BY `vpta`.`tmpsurvey_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_login`
--
ALTER TABLE `all_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_login`
--
ALTER TABLE `image_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_trx`
--
ALTER TABLE `ot_trx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_trxdt`
--
ALTER TABLE `ot_trxdt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_survey_dt`
--
ALTER TABLE `pm_survey_dt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_survey_hd`
--
ALTER TABLE `pm_survey_hd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_survey_publish`
--
ALTER TABLE `pm_survey_publish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_survey_respon`
--
ALTER TABLE `pm_survey_respon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_tenancy`
--
ALTER TABLE `pm_tenancy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_tmpsurvey`
--
ALTER TABLE `pm_tmpsurvey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_tmpsurvey_dtl`
--
ALTER TABLE `pm_tmpsurvey_dtl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sv_entry_multi`
--
ALTER TABLE `sv_entry_multi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all_login`
--
ALTER TABLE `all_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `image_login`
--
ALTER TABLE `image_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3131;

--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ot_trx`
--
ALTER TABLE `ot_trx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ot_trxdt`
--
ALTER TABLE `ot_trxdt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pm_survey_dt`
--
ALTER TABLE `pm_survey_dt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pm_survey_hd`
--
ALTER TABLE `pm_survey_hd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pm_survey_publish`
--
ALTER TABLE `pm_survey_publish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pm_survey_respon`
--
ALTER TABLE `pm_survey_respon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pm_tenancy`
--
ALTER TABLE `pm_tenancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pm_tmpsurvey`
--
ALTER TABLE `pm_tmpsurvey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pm_tmpsurvey_dtl`
--
ALTER TABLE `pm_tmpsurvey_dtl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `sv_entry_multi`
--
ALTER TABLE `sv_entry_multi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2504;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
