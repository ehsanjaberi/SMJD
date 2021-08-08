-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 08:04 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smjd`
--

-- --------------------------------------------------------

--
-- Table structure for table `base__classes`
--

CREATE TABLE `base__classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `CollegeId` int(11) NOT NULL,
  `ClassStatus` tinyint(1) DEFAULT NULL,
  `ClassType` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__classes`
--

INSERT INTO `base__classes` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `Code`, `CollegeId`, `ClassStatus`, `ClassType`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '1301', '1301', 1, 0, 0, '2020-10-29 05:36:09', '2020-10-29 05:36:09'),
(2, 1, 0, '1302', '1302', 1, 0, 0, '2020-10-29 08:58:54', '2020-10-29 08:58:54'),
(3, 1, 0, '1303', '1303', 1, 0, 0, '2020-10-29 08:59:09', '2020-11-06 02:59:37'),
(4, 1, 0, '1304', '1304', 1, 0, 0, '2020-11-06 03:09:59', '2020-11-06 03:09:59'),
(5, 1, 0, '1305', '1305', 1, 0, 0, '2020-11-05 03:42:09', '2020-11-05 03:42:09'),
(6, 1, 0, '1401', '1401', 4, 0, 0, '2020-11-05 09:08:38', '2020-11-12 07:17:01'),
(7, 1, 0, '1402', '1402', 4, 0, 0, '2020-11-05 09:08:46', '2020-11-12 07:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `base__class_equipments`
--

CREATE TABLE `base__class_equipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `EquipmentCount` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `EquipmentId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base__codings`
--

CREATE TABLE `base__codings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ETitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CodingId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base__colleges`
--

CREATE TABLE `base__colleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `UniversityId` int(11) NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `PostalCode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__colleges`
--

INSERT INTO `base__colleges` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `Name`, `UniversityId`, `Email`, `Website`, `Address`, `PostalCode`, `Logo`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '055', 'دانشکده فنی شهید منتظری مشهد', 1, 'info-055@tvu.ac.ir', 'https://montazeri.tvu.ac.ir', 'مشهد – رضا شهر- میدان شهید کاوه – دانشکده فنی شهید منتظری', '9176994594', '/Colleges/1603951729.jpg', '2020-10-29 02:38:49', '2020-10-29 02:38:49'),
(2, 1, 1, '055', 'دانشکده فنی ثامن مشهد', 1, NULL, 'https://samen.tvu.ac.ir', NULL, '9999999999', NULL, '2020-10-29 02:42:22', '2020-10-29 02:43:29'),
(3, 1, 0, '054', 'دانشکده فنی ثامن مشهد', 1, NULL, 'https://samen.tvu.ac.ir', NULL, '9999999998', '/Colleges/1603952079.png', '2020-10-29 02:44:39', '2020-10-29 02:46:11'),
(4, 1, 0, '033', 'دانشکده فنی باهنر شیراز', 2, 'info-033@tvu.ac.ir', 'https://bahonar.tvu.ac.ir', 'شیراز،فلکه اول', '9176994510', '/Colleges/1603974472.jpg', '2020-10-29 08:57:53', '2020-10-29 08:57:53'),
(5, 1, 1, '852', 'hjk', 1, NULL, NULL, NULL, NULL, NULL, '2020-11-15 01:21:54', '2020-11-16 02:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `base__degrees`
--

CREATE TABLE `base__degrees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__degrees`
--

INSERT INTO `base__degrees` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `Name`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '100', 'کاردانی قدیم', '2020-10-29 02:50:39', '2020-10-29 02:50:39'),
(2, 1, 0, '101', 'کاردانی جدید', '2020-10-29 02:50:48', '2020-10-29 02:51:50'),
(3, 1, 0, '102', 'کارشناسی', '2020-10-29 02:51:00', '2020-10-29 02:51:00'),
(4, 1, 1, '1114', '5', '2020-11-15 02:04:39', '2020-11-15 02:04:48'),
(5, 1, 1, '1114', '54', '2020-11-15 02:04:40', '2020-11-15 02:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `base__employee_posts`
--

CREATE TABLE `base__employee_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `UniversityPostId` int(11) NOT NULL,
  `UniversityEmployeeId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__employee_posts`
--

INSERT INTO `base__employee_posts` (`id`, `ModifyUser`, `IsDeleted`, `UniversityPostId`, `UniversityEmployeeId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 1, '2020-10-29 03:17:15', '2020-10-29 03:17:15'),
(2, 1, 1, 2, 2, '2020-10-29 03:19:51', '2020-10-29 03:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `base__equipments`
--

CREATE TABLE `base__equipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__equipments`
--

INSERT INTO `base__equipments` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `Name`, `Description`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '1', 'میز', 'میز 2 در 3', '2020-11-14 14:13:14', '2020-11-15 00:56:55'),
(3, 1, 0, '2', 'کامپیوتر', 'PC', '2020-11-15 00:38:04', '2020-11-20 05:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `base__fields`
--

CREATE TABLE `base__fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CollegeId` int(11) NOT NULL,
  `IsDaily` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__fields`
--

INSERT INTO `base__fields` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `Name`, `CollegeId`, `IsDaily`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '111', 'مهندسی تکنولوژی نرم افزار', 1, 0, '2020-10-29 02:46:42', '2020-10-29 02:46:42'),
(2, 1, 0, '110', 'مهندسی تکنولوژی سخت افزار', 3, 0, '2020-10-29 02:47:25', '2020-10-29 02:49:35'),
(3, 1, 0, '150', 'معماری کامپیوتر', 4, 1, '2020-11-02 13:11:24', '2020-11-02 13:11:24'),
(4, 1, 0, '121', 'فناوری اطلاعات', 1, 0, '2020-11-05 09:25:12', '2020-11-05 09:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `base__field_classes`
--

CREATE TABLE `base__field_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `FieldId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `TermId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base__grade_types`
--

CREATE TABLE `base__grade_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ETitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__grade_types`
--

INSERT INTO `base__grade_types` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `ETitle`, `created_at`, `updated_at`) VALUES
(2, 1, 0, 'میان ترم', 'میان ترم', '2020-11-13 04:07:01', '2020-11-13 04:07:01'),
(3, 1, 0, 'نمره کلاسی', 'نمره کلاسی', '2020-11-13 04:07:07', '2020-11-13 04:07:07'),
(4, 1, 0, 'حضور در کلاس', 'حضور در کلاس', '2020-11-13 04:07:14', '2020-11-13 04:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `base__lessons`
--

CREATE TABLE `base__lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PracticalUnits` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `TheoricalUnits` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `FieldId` int(11) NOT NULL,
  `DegreeId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__lessons`
--

INSERT INTO `base__lessons` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `Name`, `PracticalUnits`, `TheoricalUnits`, `FieldId`, `DegreeId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '1254032', 'هوش مصنوعی', '1', '2', 1, 3, '2020-10-29 02:53:00', '2020-11-15 02:14:55'),
(2, 1, 0, '1254030', 'برنامه سازی پیشرفته', '2', '1', 1, 3, '2020-10-29 02:57:51', '2020-11-08 09:10:17'),
(3, 1, 0, '97645312', 'مهندسی اینترنت', '2', '1', 2, 2, '2020-11-02 13:10:07', '2020-11-02 13:10:07'),
(4, 1, 0, '64146842', 'مدار منطقی', '2', '2', 3, 2, '2020-11-02 13:12:00', '2020-11-02 13:12:00'),
(5, 1, 0, '6842684354', 'اندیشه اسلامی 2', '0', '2', 4, 3, '2020-11-05 09:30:13', '2020-11-05 09:30:20'),
(6, 1, 0, '8651686', 'مبانی کامپیوتر', '1', '1', 4, 2, '2020-11-08 09:32:08', '2020-11-08 09:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `base__menus`
--

CREATE TABLE `base__menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SubSystemId` int(11) NOT NULL,
  `Url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ParentMenuId` int(11) DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  `PermissionId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__menus`
--

INSERT INTO `base__menus` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `Title`, `SubSystemId`, `Url`, `icon`, `ParentMenuId`, `Order`, `PermissionId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Employee', 'کارمندان', 2, 'Employee', 'fa fa-users', 0, 0, 21, NULL, '2020-11-21 12:26:15'),
(2, 1, 0, 'reportmanagment', 'مدیریت گزارشات', 3, 'ReportManagement', 'fa fa-file', 0, 0, 19, NULL, '2020-11-14 13:36:21'),
(3, 1, 0, 'ReportGroups', 'گروه گزارشات', 3, 'ReportGroup', 'fa fa-ticket', 0, 0, 18, NULL, '2020-11-25 03:04:07'),
(4, 1, 0, 'Class', 'کلاس ها', 4, 'Class', 'fa fa-calendar-times-o', 0, 0, 17, NULL, '2020-11-20 14:12:26'),
(5, 1, 0, 'Student', 'دانشجو', 4, 'Student', 'fa fa-graduation-cap', 0, 0, 16, NULL, '2020-11-25 03:04:04'),
(6, 1, 0, 'Teacher', 'استاد', 4, 'Teacher', 'fa fa-users', 0, 0, 15, NULL, '2020-11-25 03:04:00'),
(7, 1, 0, 'SemesterLessonToClass', 'زمانبندی روزانه کلاس ها', 4, 'SemesterLessonToClass', 'fa fa-address-book', 0, 0, 14, NULL, '2020-11-25 03:03:57'),
(8, 1, 0, 'Semester', 'ترم', 2, 'Semester', 'fa fa-calendar-o', 0, 0, 13, NULL, '2020-11-20 14:13:37'),
(9, 1, 0, 'SemesterLessonStudent', 'ثبت نام دانشجو', 4, 'SemesterLessonStudent', 'fa fa-user-o', 0, 0, 12, NULL, '2020-11-20 14:14:23'),
(10, 1, 0, 'TeacherAttendance', 'حضور و غیاب اساتید', 4, 'TeacherAttendance', 'fa fa-check-circle', 0, 0, 11, NULL, '2020-11-20 14:14:45'),
(11, 1, 0, 'StudentsAttendance', 'حضور و غیاب دانشجو', 4, 'StudentAttendance', 'fa fa-check', 0, 0, 10, NULL, '2020-11-20 14:15:16'),
(12, NULL, 0, 'SemesterLesson', ' دروس در ترم', 4, 'SemesterLesson', 'fa fa-book', 0, 0, 9, NULL, NULL),
(13, NULL, 0, 'Lesson', ' درس ها', 2, 'Lesson', 'fa fa-book', 0, 0, 8, NULL, NULL),
(14, NULL, 0, 'StudentGardes', 'انتساب  نمرات دانشجویان', 4, 'StudentGrade', 'fa fa-calendar', 0, 0, 7, NULL, NULL),
(15, NULL, 0, 'SemesterLessonGrades', 'انتساب انواع نمرات دروس ', 4, 'SemesterLessonGrade', 'fa fa-calendar', 0, 0, 6, NULL, NULL),
(16, NULL, 0, 'Degree', 'مقطع های تحصیلی', 2, 'Degree', 'fa fa-file', 0, 0, 5, NULL, NULL),
(17, NULL, 0, 'GradeType', 'انواع نمرات', 2, 'GradeType', 'fa fa-file', 0, 0, 4, NULL, NULL),
(18, 1, 0, 'Field', 'رشته های تحصیلی', 2, 'Field', 'fa fa-archive', 0, 0, 3, NULL, '2020-11-20 14:16:38'),
(19, 1, 0, 'College', 'دانشکده ها', 2, 'College', 'fa fa-building-o', 0, 0, 2, NULL, '2020-11-20 14:16:53'),
(20, NULL, 0, 'University', 'دانشگاه ها', 2, 'University', 'fa fa-university', 0, 0, 1, NULL, NULL),
(21, NULL, 0, 'Menus', 'منوها', 2, 'Menu', 'fa fa-list-ul', 0, 0, 26, NULL, NULL),
(22, NULL, 0, 'Systems', 'سیستم ها', 2, 'SubSystems', 'fa fa-paperclip', 0, 0, 24, NULL, NULL),
(23, 1, 0, 'dashboard', 'داشبورد', 1, 'dashboard', 'fa fa-dashboard', NULL, 0, NULL, NULL, NULL),
(24, 1, 0, 'User', 'اطلاعات کاربری', 1, 'Users', 'fa fa-users', 0, 0, 23, NULL, '2020-11-20 14:20:52'),
(25, 1, 0, 'Role', 'سطوح دسترسی', 1, 'Permission', 'fa fa-key', 0, 0, 22, NULL, '2020-11-20 14:20:40'),
(26, 1, 0, 'Post', 'سمت ها', 2, 'Post', 'fa fa-spotify', 0, 0, NULL, NULL, NULL),
(27, NULL, 0, 'Equipment', 'تجهیزات', 2, 'Equipment', 'fa fa-wrench', 0, 0, 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `base__persons`
--

CREATE TABLE `base__persons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Family` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `NationalCode` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__persons`
--

INSERT INTO `base__persons` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `Family`, `NationalCode`, `Gender`, `Image`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'احسان', 'جابری', '0640549225', 0, 'defualt', '2020-10-29 03:17:15', '2020-10-29 03:17:15'),
(2, 1, 0, 'علی اکبر', 'طالبی', '0640549226', 0, 'defualt', '2020-10-29 03:19:50', '2020-10-29 03:19:50'),
(3, 1, 0, 'احسان', 'جابری', '0640549229', 0, NULL, '2020-10-31 00:59:37', '2020-10-31 02:22:35'),
(5, 1, 0, 'علی اصغر', 'فلاح', '0870921524', 0, NULL, '2020-11-01 08:57:01', '2020-11-01 10:06:34'),
(6, 1, 0, 'محمد علی', 'محمدی', '0870921525', 0, NULL, '2020-11-02 13:35:45', '2020-11-02 13:35:45'),
(7, 1, 0, 'حبیب الله', 'وظیفه مند', '1258475219', 0, NULL, '2020-11-05 09:31:38', '2020-11-05 09:31:38'),
(8, 1, 0, 'مجید', 'کوهجانی', '0640549220', 0, NULL, '2020-11-08 09:29:59', '2020-11-08 09:29:59'),
(9, 1, 0, 'علی اکبر', 'طالبی', '0640549221', 0, NULL, '2020-11-12 02:51:26', '2020-11-12 02:51:26'),
(10, 1, 0, 'ممد', 'ممدی', '0640549224', 0, NULL, '2020-11-12 07:18:14', '2020-11-24 09:19:00'),
(11, 1, 0, 'فاطمه', 'شیرازی', '4851234856', 1, NULL, '2020-11-12 07:20:02', '2020-11-12 07:20:02'),
(51, 1, 0, 'Test', 'TestF', '0640549335', 1, NULL, '2020-11-24 09:17:25', '2020-11-24 09:17:25'),
(52, 1, 0, 'Test2', 'Test2F', '0640549345', 0, NULL, '2020-11-24 09:17:25', '2020-11-24 09:17:25'),
(53, 1, 0, 'Test', 'TestF', '640549215', 1, NULL, '2020-11-25 12:35:42', '2020-11-25 12:35:42'),
(54, 1, 0, 'Test2', 'Test2F', '640549205', 0, NULL, '2020-11-25 12:35:42', '2020-11-25 12:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `base__phone_types`
--

CREATE TABLE `base__phone_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) NOT NULL,
  `IsDeleted` tinyint(4) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base__semesters`
--

CREATE TABLE `base__semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `UniversityId` int(11) NOT NULL,
  `SessionType` tinyint(1) NOT NULL DEFAULT 0,
  `SessionDuration` int(11) NOT NULL,
  `StartDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `EndDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `IsDefault` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__semesters`
--

INSERT INTO `base__semesters` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `Code`, `UniversityId`, `SessionType`, `SessionDuration`, `StartDate`, `EndDate`, `IsDefault`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'نیمسال اول سال تحصیلی 99-00', '991', 1, 0, 45, '1399/07/05', '1399/10/10', 1, '2020-10-29 03:00:03', '2020-11-25 12:38:24'),
(2, 1, 0, 'نیمسال دوم سال تحصیلی 99-00', '992', 1, 0, 45, '1399/11/17', '1400/03/15', 0, '2020-10-29 03:01:20', '2020-11-25 12:38:28'),
(4, 1, 0, 'نیمسال اول سال تحصیلی 99-00', '991', 2, 0, 45, '1399/07/01', '1399/10/10', 1, '2020-11-12 07:16:25', '2020-11-12 07:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `base__semester_lessons`
--

CREATE TABLE `base__semester_lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `LessonId` int(11) NOT NULL,
  `SemesterId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__semester_lessons`
--

INSERT INTO `base__semester_lessons` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `LessonId`, `SemesterId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '86451245', 3, 1, '2020-11-02 15:03:32', '2020-11-04 03:38:06'),
(2, 1, 0, '45215421', 2, 1, '2020-11-03 00:25:37', '2020-11-08 09:02:59'),
(3, 1, 0, '4107410', 1, 2, '2020-11-05 03:52:14', '2020-11-06 02:06:16'),
(4, 1, 0, '45244421', 5, 1, '2020-11-05 09:32:17', '2020-11-05 09:35:57'),
(5, 1, 0, '84651', 1, 1, '2020-11-08 09:00:19', '2020-11-08 09:00:19'),
(6, 1, 0, '1548', 6, 1, '2020-11-08 09:32:46', '2020-11-08 09:51:06'),
(7, 1, 0, '435454354', 4, 4, '2020-11-12 07:20:21', '2020-11-12 07:20:21'),
(8, 1, 0, '52852852', 2, 2, '2020-11-16 02:56:07', '2020-11-16 02:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `base__semester_lesson_teachers`
--

CREATE TABLE `base__semester_lesson_teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `SemesterLessonId` int(11) NOT NULL,
  `TeacherId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__semester_lesson_teachers`
--

INSERT INTO `base__semester_lesson_teachers` (`id`, `ModifyUser`, `IsDeleted`, `SemesterLessonId`, `TeacherId`, `created_at`, `updated_at`) VALUES
(22, 1, 0, 1, 1, '2020-11-04 03:38:06', '2020-11-04 03:38:06'),
(23, 1, 0, 1, 2, '2020-11-04 03:38:06', '2020-11-04 03:38:06'),
(28, 1, 0, 4, 3, '2020-11-05 09:35:58', '2020-11-05 09:35:58'),
(30, 1, 0, 3, 1, '2020-11-06 02:06:16', '2020-11-06 02:06:16'),
(31, 1, 0, 5, 2, '2020-11-08 09:00:19', '2020-11-08 09:00:19'),
(34, 1, 0, 2, 1, '2020-11-08 09:02:59', '2020-11-08 09:02:59'),
(36, 1, 0, 6, 1, '2020-11-08 09:51:06', '2020-11-08 09:51:06'),
(37, 1, 0, 6, 2, '2020-11-08 09:51:06', '2020-11-08 09:51:06'),
(38, 1, 0, 7, 4, '2020-11-12 07:20:21', '2020-11-12 07:20:21'),
(39, 1, 0, 8, 1, '2020-11-16 02:56:07', '2020-11-16 02:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `base__universities`
--

CREATE TABLE `base__universities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Code` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__universities`
--

INSERT INTO `base__universities` (`id`, `ModifyUser`, `IsDeleted`, `Code`, `Name`, `Address`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '11', 'دانشگاه فنی و حرفه ای خراسان رضوی', 'مشهد،میدان شهید کاوه', '2020-10-29 02:33:16', '2020-11-24 02:45:46'),
(2, 1, 0, '12', 'دانشگاه فنی و حرفه ای شیراز', 'شیراز پلاک 1', '2020-10-29 02:33:37', '2020-11-24 02:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `base__university_employees`
--

CREATE TABLE `base__university_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `PersonId` int(11) NOT NULL,
  `PersonalCode` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `UniversityId` int(11) NOT NULL,
  `DegreeId` int(11) NOT NULL,
  `Field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__university_employees`
--

INSERT INTO `base__university_employees` (`id`, `ModifyUser`, `IsDeleted`, `PersonId`, `PersonalCode`, `UniversityId`, `DegreeId`, `Field`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, '9585756554', 1, 3, 'مهندسی تکنولوژی نرم افزار', '2020-10-29 03:17:15', '2020-10-29 03:17:15'),
(2, 1, 0, 2, '9585756555', 1, 3, 'مهندسی تکنولوژی نرم افزار و سخت افزار', '2020-10-29 03:19:50', '2020-10-29 03:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `base__university_posts`
--

CREATE TABLE `base__university_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `UniversityId` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Code` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__university_posts`
--

INSERT INTO `base__university_posts` (`id`, `ModifyUser`, `IsDeleted`, `UniversityId`, `Name`, `Code`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 'رئیس دانشگاه', '1030', '2020-10-29 03:05:45', '2020-11-15 01:15:52'),
(2, 1, 0, 1, 'مدیرگروه', '1031', '2020-10-29 03:06:29', '2020-11-15 01:17:02'),
(3, 1, 0, 2, 'رئیس گروه', '1020', '2020-11-22 10:01:37', '2020-11-22 10:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `base__university_students`
--

CREATE TABLE `base__university_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `PersonId` int(11) NOT NULL,
  `PersonalCode` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CollegeId` int(11) NOT NULL,
  `FieldId` int(11) NOT NULL,
  `DegreeId` int(11) NOT NULL,
  `StartDate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EndDate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__university_students`
--

INSERT INTO `base__university_students` (`id`, `ModifyUser`, `IsDeleted`, `PersonId`, `PersonalCode`, `CollegeId`, `FieldId`, `DegreeId`, `StartDate`, `EndDate`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 3, '97121055111005', 1, 1, 3, '1397/07/25', '1399/10/07', '2020-10-31 00:59:38', '2020-11-01 08:12:31'),
(2, 1, 0, 8, '97121055111012', 1, 4, 2, '1397/07/01', '1399/10/01', '2020-11-08 09:29:59', '2020-11-08 09:29:59'),
(3, 1, 0, 9, '97121055111008', 1, 1, 3, '1399/07/01', '1400/03/15', '2020-11-12 02:51:26', '2020-11-12 02:51:26'),
(4, 1, 0, 10, '97121044111071', 4, 3, 2, '1399/07/01', '1400/03/15', '2020-11-12 07:18:14', '2020-11-24 09:19:00'),
(13, 1, 0, 51, '97121055111905', 1, 4, 1, NULL, NULL, '2020-11-24 09:17:25', '2020-11-24 09:17:47'),
(14, 1, 0, 52, '97121055111805', 1, 1, 1, '1399/07/01', '1401/06/15', '2020-11-24 09:17:26', '2020-11-24 09:19:54'),
(15, 1, 0, 53, '97121055111905', 1, 1, 1, NULL, NULL, '2020-11-25 12:35:42', '2020-11-25 12:35:42'),
(16, 1, 0, 54, '97121055111805', 1, 1, 1, '1399/07/01', NULL, '2020-11-25 12:35:42', '2020-11-25 12:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `base__university_teachers`
--

CREATE TABLE `base__university_teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `PersonId` int(11) NOT NULL,
  `PersonalCode` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UniversityId` int(11) NOT NULL,
  `DegreeId` int(11) NOT NULL,
  `Field` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `base__university_teachers`
--

INSERT INTO `base__university_teachers` (`id`, `ModifyUser`, `IsDeleted`, `PersonId`, `PersonalCode`, `UniversityId`, `DegreeId`, `Field`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 5, '9874651321', 1, 3, 'کامپیوتر فردوسی', '2020-11-01 08:57:01', '2020-11-02 01:15:39'),
(2, 1, 0, 6, '9585456321', 1, 2, 'هوش مصنوعی', '2020-11-02 13:35:45', '2020-11-02 13:35:45'),
(3, 1, 0, 7, '8574925183', 1, 3, 'سال 6 حوضه', '2020-11-05 09:31:38', '2020-11-05 09:31:38'),
(4, 1, 0, 11, '471359640', 2, 2, 'معماری کامپیوتر', '2020-11-12 07:20:02', '2020-11-12 07:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main__person_phones`
--

CREATE TABLE `main__person_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) NOT NULL,
  `IsDeleted` tinyint(4) NOT NULL,
  `PersonId` int(11) NOT NULL,
  `PhoneTypeId` int(11) NOT NULL,
  `Number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main__schedules`
--

CREATE TABLE `main__schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `SemesterLessonId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `TeacherId` int(11) DEFAULT NULL,
  `StartTime` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `EndTime` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `HoldingData` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Week` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `Day` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main__schedules`
--

INSERT INTO `main__schedules` (`id`, `ModifyUser`, `IsDeleted`, `SemesterLessonId`, `ClassId`, `TeacherId`, `StartTime`, `EndTime`, `HoldingData`, `Week`, `Day`, `created_at`, `updated_at`) VALUES
(9, 1, 0, 2, 1, 1, '08:00', '11:00', '1399/07/05', '0', '0', '2020-11-12 04:52:24', '2020-11-26 17:46:35'),
(10, 1, 0, 5, 3, 2, '08:00', '10:30', '1399/07/05', '0', '0', '2020-11-12 04:52:24', '2020-11-26 17:46:35'),
(14, 1, 0, 6, 1, 1, '08:00', '09:00', '1399/07/05', '0', '1', '2020-11-12 06:04:42', '2020-11-12 06:04:42'),
(15, 1, 0, 7, 6, 4, '08:00', '10:10', '1399/07/05', '0', '0', '2020-11-12 07:20:35', '2020-11-12 07:20:35'),
(16, 1, 0, 8, 2, 1, '09:00', '10:00', '1399/07/05', '0', '0', '2020-11-21 11:56:16', '2020-11-21 11:56:16'),
(17, 1, 0, 4, 2, 3, '10:10', '12:10', '1399/07/05', '0', '0', '2020-11-22 09:57:51', '2020-11-26 17:46:35'),
(18, 1, 0, 5, 5, 2, '10:20', '11:20', '1399/07/05', '1', '0', '2020-11-26 17:38:59', '2020-11-26 17:38:59'),
(19, 1, 0, 5, 4, 2, '10:30', '11:30', '1399/07/05', '2', '0', '2020-11-26 17:39:14', '2020-11-26 17:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `main__semester_lesson_grades`
--

CREATE TABLE `main__semester_lesson_grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `SemesterLessonId` int(11) NOT NULL,
  `GradeTypeId` int(11) NOT NULL,
  `MaxGrade` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main__semester_lesson_grades`
--

INSERT INTO `main__semester_lesson_grades` (`id`, `ModifyUser`, `IsDeleted`, `SemesterLessonId`, `GradeTypeId`, `MaxGrade`, `created_at`, `updated_at`) VALUES
(23, 1, 0, 2, 4, 5, '2020-11-16 02:54:39', '2020-11-16 02:54:39'),
(24, 1, 0, 2, 3, 5, '2020-11-16 02:54:46', '2020-11-16 02:54:46'),
(25, 1, 0, 2, 2, 10, '2020-11-16 02:54:50', '2020-11-16 02:54:50'),
(26, 1, 0, 8, 2, 10, '2020-11-16 02:56:18', '2020-11-16 02:56:18'),
(27, 1, 0, 8, 3, 5, '2020-11-16 02:56:23', '2020-11-16 02:56:23'),
(28, 1, 0, 8, 4, 3, '2020-11-16 02:56:27', '2020-11-16 02:56:27'),
(29, 1, 0, 5, 2, 5, '2020-11-21 11:49:27', '2020-11-21 11:49:27'),
(30, 1, 0, 7, 2, 5, '2020-11-21 11:50:22', '2020-11-21 11:50:22'),
(31, 1, 0, 7, 3, 10, '2020-11-21 11:50:26', '2020-11-21 11:50:26'),
(32, 1, 0, 7, 4, 2, '2020-11-21 11:50:30', '2020-11-21 11:50:30'),
(33, 1, 0, 6, 2, 5, '2020-11-22 09:54:59', '2020-11-22 09:54:59'),
(34, 1, 0, 6, 3, 10, '2020-11-22 09:55:04', '2020-11-22 09:55:04'),
(35, 1, 0, 3, 3, 5, '2020-11-25 12:41:38', '2020-11-25 12:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `main__semester_lesson_students`
--

CREATE TABLE `main__semester_lesson_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `SemesterLessonId` int(11) NOT NULL,
  `SemesterLessonTeacherId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `Grade` double(2,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main__semester_lesson_students`
--

INSERT INTO `main__semester_lesson_students` (`id`, `ModifyUser`, `IsDeleted`, `SemesterLessonId`, `SemesterLessonTeacherId`, `StudentId`, `Grade`, `created_at`, `updated_at`) VALUES
(60, 1, 0, 5, 31, 3, NULL, '2020-11-12 04:47:33', '2020-11-12 04:47:33'),
(61, 1, 0, 2, 34, 3, NULL, '2020-11-12 04:47:33', '2020-11-12 04:47:33'),
(64, 1, 0, 7, 38, 4, NULL, '2020-11-12 07:43:02', '2020-11-12 07:43:02'),
(67, 1, 0, 8, 39, 1, NULL, '2020-11-16 02:57:33', '2020-11-16 02:57:33'),
(68, 1, 0, 4, 28, 2, NULL, '2020-11-22 09:57:01', '2020-11-22 09:57:01'),
(69, 1, 0, 6, 36, 2, NULL, '2020-11-22 09:57:01', '2020-11-22 09:57:01'),
(71, 1, 0, 5, 31, 1, NULL, '2020-11-25 12:54:04', '2020-11-25 12:54:04'),
(72, 1, 0, 2, 34, 1, NULL, '2020-11-25 12:54:04', '2020-11-25 12:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `main__students_attendances`
--

CREATE TABLE `main__students_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `UniversityStudentId` int(11) NOT NULL,
  `ScheduleId` int(11) NOT NULL,
  `HoldingDate` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main__students_attendances`
--

INSERT INTO `main__students_attendances` (`id`, `ModifyUser`, `IsDeleted`, `UniversityStudentId`, `ScheduleId`, `HoldingDate`, `Status`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 1, 9, '1399-07-05', '0', '2020-11-12 09:06:24', '2020-11-13 01:15:10'),
(2, NULL, 0, 3, 9, '1399-07-05', '1', '2020-11-12 09:06:41', '2020-11-14 03:18:45'),
(3, NULL, 0, 1, 9, '1399-07-12', '1', '2020-11-12 09:16:26', '2020-11-14 03:18:57'),
(4, NULL, 0, 3, 9, '1399-07-12', '0', '2020-11-12 09:16:27', '2020-11-23 04:12:55'),
(5, NULL, 0, 1, 9, '1399-07-19', '1', '2020-11-12 09:21:43', '2020-11-12 09:21:43'),
(6, NULL, 0, 1, 9, '1399-07-26', '1', '2020-11-13 00:35:27', '2020-11-13 00:35:27'),
(7, NULL, 0, 3, 9, '1399-07-26', '1', '2020-11-13 00:35:29', '2020-11-13 00:35:29'),
(8, NULL, 0, 2, 14, '1399-07-06', '1', '2020-11-13 00:35:49', '2020-11-13 00:35:49'),
(9, NULL, 0, 2, 14, '1399-08-25', '1', '2020-11-13 00:36:34', '2020-11-13 00:44:21'),
(10, NULL, 0, 2, 14, '1399-09-23', '0', '2020-11-13 00:44:31', '2020-11-13 00:44:32'),
(11, NULL, 0, 3, 10, '1399-07-05', '0', '2020-11-13 00:44:47', '2020-11-26 17:22:55'),
(12, NULL, 0, 3, 10, '1399-07-26', '0', '2020-11-13 01:00:13', '2020-11-13 01:00:15'),
(13, NULL, 0, 1, 9, '1399-08-03', '0', '2020-11-13 01:02:34', '2020-11-13 01:03:05'),
(14, NULL, 0, 3, 9, '1399-08-03', '0', '2020-11-13 01:02:49', '2020-11-13 01:03:05'),
(15, NULL, 0, 1, 9, '1399-08-24', '1', '2020-11-13 01:03:09', '2020-11-13 01:03:25'),
(16, NULL, 0, 3, 9, '1399-08-24', '1', '2020-11-13 01:03:21', '2020-11-13 01:03:24'),
(17, NULL, 0, 3, 9, '1399-08-10', '1', '2020-11-13 01:03:32', '2020-11-13 01:03:32'),
(18, NULL, 0, 1, 9, '1399-08-10', '0', '2020-11-13 01:04:32', '2020-11-13 01:04:34'),
(19, NULL, 0, 3, 9, '1399-09-22', '0', '2020-11-13 01:05:25', '2020-11-13 01:06:03'),
(20, NULL, 0, 1, 9, '1399-09-22', '1', '2020-11-13 01:05:27', '2020-11-13 01:05:59'),
(21, NULL, 0, 1, 9, '1399-10-06', '1', '2020-11-13 01:05:51', '2020-11-13 01:05:51'),
(22, NULL, 0, 3, 9, '1399-10-06', '0', '2020-11-13 01:05:53', '2020-11-13 01:05:53'),
(23, NULL, 0, 1, 9, '1399-09-01', '0', '2020-11-13 01:06:09', '2020-11-13 01:06:13'),
(24, NULL, 0, 3, 9, '1399-09-01', '0', '2020-11-13 01:06:10', '2020-11-13 01:06:13'),
(25, NULL, 0, 3, 10, '1399-09-22', '1', '2020-11-13 01:06:20', '2020-11-13 01:06:29'),
(26, NULL, 0, 3, 9, '1399-07-19', '0', '2020-11-13 01:09:40', '2020-11-13 01:09:40'),
(27, NULL, 0, 2, 14, '1399-07-13', '0', '2020-11-13 01:12:50', '2020-11-13 01:12:56'),
(28, NULL, 0, 3, 10, '1399-07-12', '0', '2020-11-13 01:15:22', '2020-11-13 01:15:26'),
(29, NULL, 0, 3, 10, '1399-07-19', '1', '2020-11-13 01:15:30', '2020-11-13 01:15:32'),
(30, NULL, 0, 1, 16, '1399-11-18', '1', '2020-11-23 04:17:00', '2020-11-23 04:17:00'),
(31, NULL, 0, 1, 10, '1399-07-05', '0', '2020-11-26 17:22:56', '2020-11-26 17:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `main__teachers_attendances`
--

CREATE TABLE `main__teachers_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `ScheduleId` int(11) NOT NULL,
  `HoldingDate` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `Status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main__teachers_attendances`
--

INSERT INTO `main__teachers_attendances` (`id`, `ModifyUser`, `IsDeleted`, `ScheduleId`, `HoldingDate`, `Status`, `created_at`, `updated_at`) VALUES
(6, 1, 0, 1, '1399-07-05', '1', '2020-11-11 08:38:49', '2020-11-11 12:30:42'),
(7, 1, 0, 2, '1399-07-05', '1', '2020-11-11 08:44:59', '2020-11-11 08:44:59'),
(8, 1, 0, 6, '1399-07-05', '0', '2020-11-11 08:45:22', '2020-11-11 12:31:10'),
(9, 1, 0, 5, '1399-07-05', '0', '2020-11-11 08:45:23', '2020-11-11 12:10:32'),
(10, 1, 0, 8, '1399-07-06', '0', '2020-11-11 08:45:38', '2020-11-11 12:10:40'),
(11, 1, 0, 1, '1399-07-12', '1', '2020-11-11 08:46:11', '2020-11-11 08:46:11'),
(12, 1, 0, 3, '۱۳۹۹-۰۷-۱۲', '1', '2020-11-11 09:39:18', '2020-11-11 09:39:18'),
(13, 1, 0, 8, '۱۳۹۹-۰۷-۱۳', '1', '2020-11-11 12:10:55', '2020-11-11 12:10:55'),
(14, 1, 0, 2, '۱۳۹۹-۰۷-۱۲', '1', '2020-11-11 12:30:56', '2020-11-11 12:30:56'),
(15, 1, 0, 6, '۱۳۹۹-۰۷-۱۲', '1', '2020-11-11 12:30:57', '2020-11-11 12:30:57'),
(16, 1, 0, 6, '۱۳۹۹-۰۷-۲۶', '1', '2020-11-11 12:31:06', '2020-11-11 12:31:06'),
(17, 1, 0, 9, '۱۳۹۹-۰۷-۰۵', '1', '2020-11-12 04:54:29', '2020-11-12 04:54:29'),
(18, 1, 0, 10, '۱۳۹۹-۰۷-۰۵', '1', '2020-11-12 04:54:31', '2020-11-12 04:54:31'),
(19, 1, 0, 15, '۱۳۹۹-۰۷-۰۵', '1', '2020-11-12 07:21:12', '2020-11-12 07:21:12'),
(20, 1, 0, 10, '۱۳۹۹-۰۷-۱۹', '1', '2020-11-13 02:04:17', '2020-11-13 02:04:17'),
(21, 1, 0, 9, '۱۳۹۹-۰۷-۱۹', '0', '2020-11-13 02:04:18', '2020-11-26 17:22:33'),
(22, 1, 0, 14, '۱۳۹۹-۰۷-۰۶', '1', '2020-11-16 02:39:18', '2020-11-16 02:39:18'),
(23, 1, 0, 17, '۱۳۹۹-۰۷-۰۵', '1', '2020-11-25 12:52:34', '2020-11-25 12:52:34'),
(24, 1, 0, 17, '۱۳۹۹-۰۷-۱۲', '1', '2020-11-25 12:52:39', '2020-11-25 12:52:39'),
(25, 1, 0, 9, '۱۳۹۹-۰۷-۱۲', '1', '2020-11-25 12:52:40', '2020-11-25 12:52:40'),
(26, 1, 0, 10, '۱۳۹۹-۰۷-۱۲', '1', '2020-11-25 12:52:41', '2020-11-25 12:52:41'),
(27, 1, 0, 17, '۱۳۹۹-۰۷-۱۹', '0', '2020-11-26 17:22:32', '2020-11-26 17:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `main__uni__stu__grades`
--

CREATE TABLE `main__uni__stu__grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `UniversityStudentId` int(11) NOT NULL,
  `SemesterLessonGradeId` int(11) NOT NULL,
  `Grade` int(11) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main__uni__stu__grades`
--

INSERT INTO `main__uni__stu__grades` (`id`, `ModifyUser`, `IsDeleted`, `UniversityStudentId`, `SemesterLessonGradeId`, `Grade`, `Description`, `created_at`, `updated_at`) VALUES
(124, 1, 0, 3, 23, 2, NULL, '2020-11-16 02:55:15', '2020-11-16 02:55:15'),
(125, 1, 0, 3, 24, 3, NULL, '2020-11-16 02:55:15', '2020-11-16 02:55:15'),
(126, 1, 0, 3, 25, 3, NULL, '2020-11-16 02:55:15', '2020-11-16 02:55:15'),
(129, 1, 0, 1, 27, 5, NULL, '2020-11-16 03:08:58', '2020-11-16 03:08:58'),
(130, 1, 0, 1, 28, 3, NULL, '2020-11-16 03:08:58', '2020-11-16 03:08:58'),
(131, 1, 0, 2, 33, 5, NULL, '2020-11-22 09:55:19', '2020-11-22 09:55:19'),
(132, 1, 0, 2, 34, 10, NULL, '2020-11-22 09:55:20', '2020-11-22 09:55:20'),
(133, 1, 0, 1, 24, 1, NULL, '2020-11-25 12:54:19', '2020-11-25 12:54:19'),
(134, 1, 0, 1, 25, 2, NULL, '2020-11-25 12:54:19', '2020-11-25 12:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_10_11_163957_create_roles_table', 1),
(7, '2020_10_11_164052_create_user_roles_table', 1),
(8, '2020_10_11_164115_create_role_perimissions_table', 1),
(10, '2020_10_11_171237_create_base__universities_table', 1),
(11, '2020_10_11_171430_create_base__colleges_table', 1),
(12, '2020_10_11_171756_create_base__fields_table', 1),
(13, '2020_10_11_172145_create_base__grade_types_table', 1),
(14, '2020_10_11_172426_create_base__degrees_table', 1),
(15, '2020_10_11_172703_create_base__lessons_table', 1),
(17, '2020_10_11_174529_create_report__report_groups_table', 1),
(28, '2020_10_11_182947_create_main__person_phones_table', 1),
(31, '2020_10_12_080233_create_base__university_posts_table', 1),
(32, '2020_10_12_080852_create_base__university_employees_table', 1),
(33, '2020_10_12_081323_create_base__semesters_table', 1),
(36, '2020_10_12_082531_create_base__phone_types_table', 1),
(37, '2020_10_12_082740_create_base__persons_table', 1),
(39, '2020_10_12_083531_create_base__field_classes_table', 1),
(40, '2020_10_12_083746_create_base__employee_posts_table', 1),
(41, '2020_10_12_084100_create_base__codings_table', 1),
(43, '2020_10_12_084501_create_base__class_equipments_table', 1),
(44, '2020_10_12_084244_create_base__classes_table', 2),
(45, '2020_10_12_075927_create_base__university_students_table', 3),
(46, '2020_10_12_075535_create_base__university_teachers_table', 4),
(47, '2020_10_12_082048_create_base__semester_lesson_teachers_table', 5),
(48, '2020_10_12_082322_create_base__semester_lessons_table', 5),
(52, '2020_10_11_182719_create_main__schedules_table', 6),
(53, '2020_10_11_182249_create_main__semester_lesson_students_table', 7),
(54, '2020_10_11_182000_create_main__teachers_attendances_table', 8),
(55, '2020_10_11_182114_create_main__students_attendances_table', 9),
(56, '2020_10_11_182423_create_main__semester_lesson_grades_table', 10),
(57, '2020_10_11_181605_create_main__uni__stu__grades_table', 11),
(58, '2020_10_12_083038_create_base__menus_table', 12),
(59, '2020_10_11_180032_create_uni__sub_systems_table', 13),
(60, '2020_10_11_170841_create_base__equipments_table', 14),
(62, '2020_10_11_164031_create_perimissions_table', 15),
(63, '2020_10_11_175415_create_report__reports_table', 16),
(64, '2020_10_11_174029_create_report__report_columns_table', 17),
(65, '2020_10_11_174754_create_report__report_parameters_table', 18),
(66, '2020_10_11_175809_create_report__static_items_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perimissions`
--

CREATE TABLE `perimissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ETitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ParentId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perimissions`
--

INSERT INTO `perimissions` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `ETitle`, `ParentId`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 'دانشگاه ها', 'University', 0, NULL, NULL),
(2, NULL, 0, ' دانشکده ها', 'College', 0, NULL, NULL),
(3, NULL, 0, 'رشته های تحصیلی', 'Field', 0, NULL, NULL),
(4, NULL, 0, 'انواع نمرات', 'GradeType', 0, NULL, NULL),
(5, NULL, 0, 'مقطع های تحصیلی', 'Degree', 0, NULL, NULL),
(6, NULL, 0, 'انتساب انواع نمرات دروس ', 'SemesterLessonGrades', 0, NULL, NULL),
(7, NULL, 0, 'انتساب  نمرات دانشجویان', 'StudentGardes', 0, NULL, NULL),
(8, NULL, 0, ' درس ها', 'Lesson', 0, NULL, NULL),
(9, NULL, 0, ' دروس در ترم', 'SemesterLesson', 0, NULL, NULL),
(10, NULL, 0, 'حضور و غیاب دانشجو', 'StudentsAttendance', 0, NULL, NULL),
(11, NULL, 0, 'حضور و غیاب اساتید', 'TeacherAttendance', 0, NULL, NULL),
(12, NULL, 0, 'ثبت نام دانشجو', 'SemesterLessonStudent', 0, NULL, NULL),
(13, NULL, 0, ' ترم', 'Semester', 0, NULL, NULL),
(14, NULL, 0, 'زمانبندی روزانه کلاس ها', 'SemesterLessonToClass', 0, NULL, NULL),
(15, NULL, 0, ' استاد', 'Teacher', 0, NULL, NULL),
(16, NULL, 0, ' دانشجو', 'Student', 0, NULL, NULL),
(17, NULL, 0, 'کلاس ها', 'Class', 0, NULL, NULL),
(18, NULL, 0, 'گروه گزارشات', 'ReportGroups', 0, NULL, NULL),
(19, NULL, 0, 'مدیریت گزارشات', 'reportmanagment', 0, NULL, NULL),
(20, NULL, 0, 'کارمندان', 'Employee', 0, NULL, NULL),
(21, NULL, 0, 'نقش', 'Role', 0, NULL, NULL),
(22, NULL, 0, 'سطوح دسترسی', 'UserRoles', 0, NULL, NULL),
(23, NULL, 0, 'اطلاعات کاربری', 'User', 0, NULL, NULL),
(24, NULL, 0, 'سیستم ها', 'Systems', 0, NULL, NULL),
(25, NULL, 0, 'تجهیزات', 'Equipment', 0, NULL, NULL),
(26, NULL, 0, 'منوها', 'Menus', 0, NULL, NULL),
(28, NULL, 0, 'لیست', 'Employee.List', 20, NULL, NULL),
(29, NULL, 0, 'درج', 'Employee.Add', 20, NULL, NULL),
(30, NULL, 0, 'حذف', 'Employee.Delete', 20, NULL, NULL),
(31, NULL, 0, 'ویرایش', 'Employee.Edit', 20, NULL, NULL),
(33, NULL, 0, 'لیست', 'College.List', 2, NULL, NULL),
(34, NULL, 0, 'حذف', 'College.Delete', 2, NULL, NULL),
(35, NULL, 0, 'ویرایش', 'College.Edit', 2, NULL, NULL),
(36, NULL, 0, 'درج', 'College.Add', 2, NULL, NULL),
(38, NULL, 0, 'لیست', 'Field.List', 3, NULL, NULL),
(39, NULL, 0, 'حذف', 'Field.Delete', 3, NULL, NULL),
(40, NULL, 0, 'ویرایش', 'Field.Edit', 3, NULL, NULL),
(41, NULL, 0, 'درج', 'Field.Add', 3, NULL, NULL),
(43, NULL, 0, 'لیست', 'GradeType.List', 4, NULL, NULL),
(44, NULL, 0, 'حذف', 'GradeType.Delete', 4, NULL, NULL),
(45, NULL, 0, 'ویرایش', 'GradeType.Edit', 4, NULL, NULL),
(46, NULL, 0, 'درج', 'GradeType.Add', 4, NULL, NULL),
(48, NULL, 0, 'لیست', 'Degree.List', 5, NULL, NULL),
(49, NULL, 0, 'حذف', 'Degree.Delete', 5, NULL, NULL),
(50, NULL, 0, 'ویرایش', 'Degree.Edit', 5, NULL, NULL),
(51, NULL, 0, 'درج', 'Degree.Add', 5, NULL, NULL),
(53, NULL, 0, 'لیست', 'SemesterLessonGrades.List', 6, NULL, NULL),
(54, NULL, 0, 'حذف', 'SemesterLessonGrades.Delete', 6, NULL, NULL),
(55, NULL, 0, 'ویرایش', 'SemesterLessonGrades.Edit', 6, NULL, NULL),
(56, NULL, 0, 'درج', 'SemesterLessonGrades.Add', 6, NULL, NULL),
(57, NULL, 0, 'نمایش', 'SemesterLessonGrades.View', 6, NULL, NULL),
(58, NULL, 0, 'لیست', 'StudentGardes.List', 7, NULL, NULL),
(59, NULL, 0, 'حذف', 'StudentGardes.Delete', 7, NULL, NULL),
(60, NULL, 0, 'ویرایش', 'StudentGardes.Edit', 7, NULL, NULL),
(61, NULL, 0, 'درج', 'University.Add', 1, NULL, NULL),
(62, NULL, 0, 'ویرایش', 'University.Edit', 1, NULL, NULL),
(63, NULL, 0, 'حذف', 'University.Delete', 1, NULL, NULL),
(64, NULL, 0, 'لیست', 'University.List', 1, NULL, NULL),
(65, NULL, 0, 'لیست', 'Equipment.List', 25, NULL, NULL),
(66, NULL, 0, 'حذف', 'Equipment.Delete', 25, NULL, NULL),
(67, NULL, 0, 'ویرایش', 'Equipment.Edit', 25, NULL, NULL),
(68, NULL, 0, 'درج', 'Equipment.Add', 25, NULL, NULL),
(69, NULL, 0, 'نمایش', 'Equipment.View', 25, NULL, NULL),
(70, NULL, 0, 'لیست', 'Role.List', 21, NULL, NULL),
(71, NULL, 0, 'حذف', 'Role.Delete', 21, NULL, NULL),
(72, NULL, 0, 'ویرایش', 'Role.Edit', 21, NULL, NULL),
(73, NULL, 0, 'درج', 'Role.Add', 21, NULL, NULL),
(74, NULL, 0, 'نمایش', 'Role.View', 21, NULL, NULL),
(75, NULL, 0, 'لیست', 'UserRoles.List', 22, NULL, NULL),
(76, NULL, 0, 'حذف', 'UserRoles.Delete', 22, NULL, NULL),
(77, NULL, 0, 'ویرایش', 'UserRoles.Edit', 22, NULL, NULL),
(78, NULL, 0, 'درج', 'UserRoles.Add', 22, NULL, NULL),
(79, NULL, 0, 'درج', 'StudentGardes.Add', 7, NULL, NULL),
(81, NULL, 0, 'حذف', 'User.Delete', 23, NULL, NULL),
(82, NULL, 0, 'ویرایش', 'User.Edit', 23, NULL, NULL),
(83, NULL, 0, 'درج', 'User.Add', 23, NULL, NULL),
(84, NULL, 0, 'نمایش', 'User.View', 23, NULL, NULL),
(87, NULL, 0, 'ویرایش', 'Systems.Edit', 24, NULL, NULL),
(92, NULL, 0, 'ویرایش', 'Menus.Edit', 26, NULL, NULL),
(95, NULL, 0, 'نقش کاربر', 'User.Role', 23, NULL, NULL),
(96, NULL, 0, 'نمایش', 'StudentGardes.View', 7, NULL, NULL),
(97, NULL, 0, 'لیست', 'Teacher.List', 15, NULL, NULL),
(98, NULL, 0, 'حذف', 'Teacher.Delete', 15, NULL, NULL),
(99, NULL, 0, 'ویرایش', 'Teacher.Edit', 15, NULL, NULL),
(100, NULL, 0, 'درج', 'Teacher.Add', 15, NULL, NULL),
(103, NULL, 0, 'لیست', 'SemesterLessonToClass.List', 14, NULL, NULL),
(104, NULL, 0, 'حذف', 'SemesterLessonToClass.Delete', 14, NULL, NULL),
(105, NULL, 0, 'ویرایش', 'SemesterLessonToClass.Edit', 14, NULL, NULL),
(106, NULL, 0, 'درج', 'SemesterLessonToClass.Add', 14, NULL, NULL),
(107, NULL, 0, 'نمایش', 'SemesterLessonToClass.View', 14, NULL, NULL),
(108, NULL, 0, 'لیست', 'reportmanagment.List', 19, NULL, NULL),
(109, NULL, 0, 'حذف', 'reportmanagment.Delete', 19, NULL, NULL),
(110, NULL, 0, 'ویرایش', 'reportmanagment.Edit', 19, NULL, NULL),
(111, NULL, 0, 'درج', 'reportmanagment.Add', 19, NULL, NULL),
(113, NULL, 0, 'لیست', 'ReportGroups.List', 18, NULL, NULL),
(114, NULL, 0, 'حذف', 'ReportGroups.Delete', 18, NULL, NULL),
(115, NULL, 0, 'ویرایش', 'ReportGroups.Edit', 18, NULL, NULL),
(116, NULL, 0, 'درج', 'ReportGroups.Add', 18, NULL, NULL),
(118, NULL, 0, 'لیست', 'Class.List', 17, NULL, NULL),
(119, NULL, 0, 'حذف', 'Class.Delete', 17, NULL, NULL),
(120, NULL, 0, 'ویرایش', 'Class.Edit', 17, NULL, NULL),
(121, NULL, 0, 'درج', 'Class.Add', 17, NULL, NULL),
(123, NULL, 0, 'لیست', 'Student.List', 16, NULL, NULL),
(124, NULL, 0, 'حذف', 'Student.Delete', 16, NULL, NULL),
(125, NULL, 0, 'ویرایش', 'Student.Edit', 16, NULL, NULL),
(126, NULL, 0, 'درج', 'Student.Add', 16, NULL, NULL),
(128, NULL, 0, 'لیست', 'Semester.List', 13, NULL, NULL),
(129, NULL, 0, 'حذف', 'Semester.Delete', 13, NULL, NULL),
(130, NULL, 0, 'ویرایش', 'Semester.Edit', 13, NULL, NULL),
(131, NULL, 0, 'درج', 'Semester.Add', 13, NULL, NULL),
(133, NULL, 0, 'لیست', 'SemesterLessonStudent.List', 12, NULL, NULL),
(134, NULL, 0, 'حذف', 'SemesterLessonStudent.Delete', 12, NULL, NULL),
(135, NULL, 0, 'ویرایش', 'SemesterLessonStudent.Edit', 12, NULL, NULL),
(136, NULL, 0, 'درج', 'SemesterLessonStudent.Add', 12, NULL, NULL),
(137, NULL, 0, 'نمایش', 'SemesterLessonStudent.View', 12, NULL, NULL),
(138, NULL, 0, 'لیست', 'TeacherAttendance.List', 11, NULL, NULL),
(139, NULL, 0, 'حذف', 'TeacherAttendance.Delete', 11, NULL, NULL),
(140, NULL, 0, 'ویرایش', 'TeacherAttendance.Edit', 11, NULL, NULL),
(141, NULL, 0, 'درج', 'TeacherAttendance.Add', 11, NULL, NULL),
(142, NULL, 0, 'نمایش', 'TeacherAttendance.View', 11, NULL, NULL),
(143, NULL, 0, 'لیست', 'StudentsAttendance.List', 10, NULL, NULL),
(144, NULL, 0, 'حذف', 'StudentsAttendance.Delete', 10, NULL, NULL),
(145, NULL, 0, 'ویرایش', 'StudentsAttendance.Edit', 10, NULL, NULL),
(146, NULL, 0, 'درج', 'StudentsAttendance.Add', 10, NULL, NULL),
(147, NULL, 0, 'نمایش', 'StudentsAttendance.View', 10, NULL, NULL),
(148, NULL, 0, 'لیست', 'SemesterLesson.List', 9, NULL, NULL),
(149, NULL, 0, 'حذف', 'SemesterLesson.Delete', 9, NULL, NULL),
(150, NULL, 0, 'ویرایش', 'SemesterLesson.Edit', 9, NULL, NULL),
(151, NULL, 0, 'درج', 'SemesterLesson.Add', 9, NULL, NULL),
(152, NULL, 0, 'نمایش', 'SemesterLesson.View', 9, NULL, NULL),
(153, NULL, 0, 'لیست', 'Lesson.List', 8, NULL, NULL),
(154, NULL, 0, 'حذف', 'Lesson.Delete', 8, NULL, NULL),
(155, NULL, 0, 'ویرایش', 'Lesson.Edit', 8, NULL, NULL),
(156, NULL, 0, 'درج', 'Lesson.Add', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report__reports`
--

CREATE TABLE `report__reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `ReportGroupId` int(11) NOT NULL,
  `Title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Query` text COLLATE utf8_unicode_ci NOT NULL,
  `SumColumns` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ViewColumns` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HasPager` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report__reports`
--

INSERT INTO `report__reports` (`id`, `ModifyUser`, `IsDeleted`, `ReportGroupId`, `Title`, `Query`, `SumColumns`, `ViewColumns`, `HasPager`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 'لیست رشتها', 'select base__colleges.Code AS `کد دانشکده`,base__colleges.Name AS `نام دانشکده`,base__fields.Code AS `کد رشته`,base__fields.Name AS `نام رشته` From base__colleges inner join base__fields ON base__fields.CollegeId=base__colleges.id Where base__fields.IsDeleted=0 AND base__fields.IsDaily=$IsDaily', NULL, NULL, 1, '2020-11-20 04:25:07', '2020-11-22 01:40:47'),
(2, 1, 0, 2, 'رشته های شبانه', 'select base__colleges.Code AS `کد دانشکده`,base__colleges.Name AS `نام دانشکده`,base__fields.Code AS `کد رشته`,base__fields.Name AS `نام رشته` From base__colleges inner join base__fields ON base__fields.CollegeId=base__colleges.id Where base__fields.IsDeleted=0 AND base__fields.IsDaily=1', NULL, NULL, 1, '2020-11-20 04:42:45', '2020-11-20 04:42:45'),
(3, 1, 0, 1, 'گزارش دانشکده ها', 'select base__colleges.Code AS `کد دانشکده`,base__colleges.Name AS `نام دانشکده`,base__colleges.Email AS `ایمیل دانشکده` From base__colleges Where base__colleges.UniversityId=$UniId', NULL, NULL, 0, '2020-11-20 05:08:43', '2020-11-20 09:57:01'),
(5, 1, 0, 2, 'رشته ها', 'Select Code AS`کد رشته`, Name AS`نام رشته` From base__fields Where Code=$FieldId', NULL, NULL, 1, '2020-11-20 08:30:41', '2020-11-22 03:32:07'),
(7, 1, 0, 2, 'تست', 'SELECT SUM(`Grade`) AS `مجموع نمرات` FROM `main__uni__stu__grades` WHERE `UniversityStudentId`=$StuId', NULL, NULL, 1, '2020-11-22 00:44:51', '2020-11-25 02:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `report__report_columns`
--

CREATE TABLE `report__report_columns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `ReportId` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IsSeparator` tinyint(1) NOT NULL DEFAULT 0,
  `IsSum` tinyint(1) NOT NULL DEFAULT 0,
  `IsAverage` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report__report_columns`
--

INSERT INTO `report__report_columns` (`id`, `ModifyUser`, `IsDeleted`, `ReportId`, `Title`, `IsSeparator`, `IsSum`, `IsAverage`, `created_at`, `updated_at`) VALUES
(5, 1, 0, 2, 'کد دانشکده', 0, 0, 0, '2020-11-20 04:42:46', '2020-11-20 04:42:46'),
(6, 1, 0, 2, 'نام دانشکده', 0, 0, 0, '2020-11-20 04:42:46', '2020-11-20 04:42:46'),
(7, 1, 0, 2, 'کد رشته', 0, 0, 0, '2020-11-20 04:42:46', '2020-11-20 04:42:46'),
(8, 1, 0, 2, 'نام رشته', 0, 0, 0, '2020-11-20 04:42:46', '2020-11-20 04:42:46'),
(32, 1, 0, 3, 'کد دانشکده', 0, 0, 0, '2020-11-20 09:57:01', '2020-11-20 09:57:01'),
(33, 1, 0, 3, 'نام دانشکده', 0, 1, 0, '2020-11-20 09:57:01', '2020-11-20 09:57:01'),
(34, 1, 0, 3, 'ایمیل دانشکده', 0, 0, 0, '2020-11-20 09:57:01', '2020-11-20 09:57:01'),
(55, 1, 0, 1, 'کد دانشکده', 0, 0, 0, '2020-11-22 01:40:47', '2020-11-22 01:40:47'),
(56, 1, 0, 1, 'نام دانشکده', 0, 0, 0, '2020-11-22 01:40:47', '2020-11-22 01:40:47'),
(57, 1, 0, 1, 'کد رشته', 0, 0, 0, '2020-11-22 01:40:47', '2020-11-22 01:40:47'),
(58, 1, 0, 1, 'نام رشته', 0, 0, 0, '2020-11-22 01:40:48', '2020-11-22 01:40:48'),
(61, 1, 0, 5, 'کد رشته', 0, 0, 0, '2020-11-22 03:32:07', '2020-11-22 03:32:07'),
(62, 1, 0, 5, 'نام رشته', 0, 0, 0, '2020-11-22 03:32:07', '2020-11-22 03:32:07'),
(82, 1, 0, 7, 'مجموع نمرات', 0, 1, 0, '2020-11-25 02:31:32', '2020-11-25 02:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `report__report_groups`
--

CREATE TABLE `report__report_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `SubSystemId` int(11) NOT NULL DEFAULT 3,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report__report_groups`
--

INSERT INTO `report__report_groups` (`id`, `ModifyUser`, `IsDeleted`, `SubSystemId`, `Name`, `Title`, `Icon`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 3, 'گزارشات آماری', 'StatisicalReport', 'fa fa-file', '2020-11-15 04:22:12', '2020-11-16 04:16:17'),
(2, 1, 0, 3, 'گزارشات اصلی', 'MainReport', 'fa fa-users', '2020-11-16 06:02:25', '2020-11-21 13:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `report__report_parameters`
--

CREATE TABLE `report__report_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `ReportId` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Priority` int(11) NOT NULL,
  `Type` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `Query` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsOptional` tinyint(1) NOT NULL DEFAULT 0,
  `Width` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report__report_parameters`
--

INSERT INTO `report__report_parameters` (`id`, `ModifyUser`, `IsDeleted`, `ReportId`, `Title`, `Name`, `Priority`, `Type`, `Query`, `IsOptional`, `Width`, `created_at`, `updated_at`) VALUES
(7, 1, 0, 3, 'دانشگاه', '$UniId', 1, '7', 'Select id AS`key`,Name AS`value` From base__universities Where IsDeleted=0', 1, '6', '2020-11-20 09:57:01', '2020-11-20 09:57:01'),
(15, 1, 0, 1, 'روزانه|شبانه', '$IsDaily', 1, '6', NULL, 1, '4', '2020-11-22 01:40:48', '2020-11-22 01:40:48'),
(17, 1, 0, 5, 'کد رشته', '$FieldId', 1, '2', NULL, 1, '4', '2020-11-22 03:32:07', '2020-11-22 03:32:07'),
(18, 1, 0, 5, 'تست', '$Test', 2, '6', NULL, 0, '3', '2020-11-22 03:32:07', '2020-11-22 03:32:07'),
(33, 1, 0, 7, 'دانشجو', '$StuId', 1, '7', 'SELECT `id` AS `key`,`PersonalCode`AS`value` FROM `base__university_students`', 1, '4', '2020-11-25 02:31:32', '2020-11-25 02:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `report__static_items`
--

CREATE TABLE `report__static_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `ReportParameterId` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IsDefault` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report__static_items`
--

INSERT INTO `report__static_items` (`id`, `ModifyUser`, `IsDeleted`, `ReportParameterId`, `key`, `value`, `IsDefault`, `created_at`, `updated_at`) VALUES
(10, 1, 0, 15, '0', 'روزانه', 0, '2020-11-22 01:40:48', '2020-11-22 01:40:48'),
(11, 1, 0, 15, '1', 'شبانه', 0, '2020-11-22 01:40:48', '2020-11-22 01:40:48'),
(12, 1, 0, 18, '1', '1', 0, '2020-11-22 03:32:07', '2020-11-22 03:32:07'),
(13, 1, 0, 18, '2', '2', 0, '2020-11-22 03:32:07', '2020-11-22 03:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ETitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `ETitle`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'سوپر ادمین', 'سوپر ادمین', '2020-11-15 08:29:19', '2020-11-15 08:29:19'),
(2, 1, 0, 'مدیر گروه', 'مدیر گروه', '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(3, 1, 0, 'استاد', 'استاد', '2020-11-16 01:19:53', '2020-11-16 01:19:53'),
(4, 1, 1, 'تست', 'تست', '2020-11-23 02:42:53', '2020-11-23 02:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_perimissions`
--

CREATE TABLE `role_perimissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `PermissionId` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_perimissions`
--

INSERT INTO `role_perimissions` (`id`, `ModifyUser`, `IsDeleted`, `PermissionId`, `RoleId`, `created_at`, `updated_at`) VALUES
(157, 1, 0, 6, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(158, 1, 0, 53, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(159, 1, 0, 54, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(160, 1, 0, 55, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(161, 1, 0, 56, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(162, 1, 0, 57, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(163, 1, 0, 7, 2, '2020-11-15 08:31:13', '2020-11-15 08:31:13'),
(164, 1, 0, 58, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(165, 1, 0, 59, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(166, 1, 0, 60, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(167, 1, 0, 79, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(168, 1, 0, 96, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(169, 1, 0, 8, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(170, 1, 0, 153, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(171, 1, 0, 154, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(172, 1, 0, 155, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(173, 1, 0, 156, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(174, 1, 0, 157, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(175, 1, 0, 9, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(176, 1, 0, 148, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(177, 1, 0, 149, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(178, 1, 0, 150, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(179, 1, 0, 151, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(180, 1, 0, 152, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(181, 1, 0, 10, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(182, 1, 0, 143, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(183, 1, 0, 144, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(184, 1, 0, 145, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(185, 1, 0, 146, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(186, 1, 0, 147, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(187, 1, 0, 11, 2, '2020-11-15 08:31:14', '2020-11-15 08:31:14'),
(188, 1, 0, 138, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(189, 1, 0, 139, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(190, 1, 0, 140, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(191, 1, 0, 141, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(192, 1, 0, 142, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(193, 1, 0, 12, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(194, 1, 0, 133, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(195, 1, 0, 134, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(196, 1, 0, 135, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(197, 1, 0, 136, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(198, 1, 0, 137, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(199, 1, 0, 14, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(200, 1, 0, 103, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(201, 1, 0, 104, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(202, 1, 0, 105, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(203, 1, 0, 106, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(204, 1, 0, 107, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(205, 1, 0, 15, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(206, 1, 0, 97, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(207, 1, 0, 98, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(208, 1, 0, 99, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(209, 1, 0, 100, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(210, 1, 0, 101, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(211, 1, 0, 17, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(212, 1, 0, 118, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(213, 1, 0, 119, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(214, 1, 0, 120, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(215, 1, 0, 121, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(216, 1, 0, 122, 2, '2020-11-15 08:31:15', '2020-11-15 08:31:15'),
(217, 1, 0, 18, 2, '2020-11-15 08:31:16', '2020-11-15 08:31:16'),
(218, 1, 0, 113, 2, '2020-11-15 08:31:16', '2020-11-15 08:31:16'),
(219, 1, 0, 114, 2, '2020-11-15 08:31:16', '2020-11-15 08:31:16'),
(220, 1, 0, 115, 2, '2020-11-15 08:31:16', '2020-11-15 08:31:16'),
(221, 1, 0, 116, 2, '2020-11-15 08:31:16', '2020-11-15 08:31:16'),
(222, 1, 0, 117, 2, '2020-11-15 08:31:16', '2020-11-15 08:31:16'),
(289, 1, 0, 7, 3, '2020-11-26 03:20:13', '2020-11-26 03:20:13'),
(290, 1, 0, 58, 3, '2020-11-26 03:20:13', '2020-11-26 03:20:13'),
(291, 1, 0, 59, 3, '2020-11-26 03:20:13', '2020-11-26 03:20:13'),
(292, 1, 0, 60, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(293, 1, 0, 79, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(294, 1, 0, 96, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(295, 1, 0, 10, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(296, 1, 0, 143, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(297, 1, 0, 144, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(298, 1, 0, 145, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(299, 1, 0, 146, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(300, 1, 0, 147, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(301, 1, 0, 22, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(302, 1, 0, 75, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(303, 1, 0, 76, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(304, 1, 0, 77, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(305, 1, 0, 78, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(306, 1, 0, 80, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(307, 1, 0, 23, 3, '2020-11-26 03:20:14', '2020-11-26 03:20:14'),
(308, 1, 0, 81, 3, '2020-11-26 03:20:15', '2020-11-26 03:20:15'),
(309, 1, 0, 82, 3, '2020-11-26 03:20:15', '2020-11-26 03:20:15'),
(310, 1, 0, 83, 3, '2020-11-26 03:20:15', '2020-11-26 03:20:15'),
(311, 1, 0, 84, 3, '2020-11-26 03:20:15', '2020-11-26 03:20:15'),
(312, 1, 0, 95, 3, '2020-11-26 03:20:15', '2020-11-26 03:20:15'),
(313, 1, 0, 1, 1, '2020-11-26 03:36:12', '2020-11-26 03:36:12'),
(314, 1, 0, 32, 1, '2020-11-26 03:36:12', '2020-11-26 03:36:12'),
(315, 1, 0, 61, 1, '2020-11-26 03:36:12', '2020-11-26 03:36:12'),
(316, 1, 0, 62, 1, '2020-11-26 03:36:12', '2020-11-26 03:36:12'),
(317, 1, 0, 63, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(318, 1, 0, 64, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(319, 1, 0, 2, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(320, 1, 0, 33, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(321, 1, 0, 34, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(322, 1, 0, 35, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(323, 1, 0, 36, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(324, 1, 0, 37, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(325, 1, 0, 3, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(326, 1, 0, 38, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(327, 1, 0, 39, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(328, 1, 0, 40, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(329, 1, 0, 41, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(330, 1, 0, 42, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(331, 1, 0, 4, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(332, 1, 0, 43, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(333, 1, 0, 44, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(334, 1, 0, 45, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(335, 1, 0, 46, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(336, 1, 0, 47, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(337, 1, 0, 5, 1, '2020-11-26 03:36:13', '2020-11-26 03:36:13'),
(338, 1, 0, 48, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(339, 1, 0, 49, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(340, 1, 0, 50, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(341, 1, 0, 51, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(342, 1, 0, 52, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(343, 1, 0, 6, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(344, 1, 0, 53, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(345, 1, 0, 54, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(346, 1, 0, 55, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(347, 1, 0, 56, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(348, 1, 0, 57, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(349, 1, 0, 7, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(350, 1, 0, 58, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(351, 1, 0, 59, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(352, 1, 0, 60, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(353, 1, 0, 79, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(354, 1, 0, 96, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(355, 1, 0, 8, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(356, 1, 0, 153, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(357, 1, 0, 154, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(358, 1, 0, 155, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(359, 1, 0, 156, 1, '2020-11-26 03:36:14', '2020-11-26 03:36:14'),
(360, 1, 0, 157, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(361, 1, 0, 9, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(362, 1, 0, 148, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(363, 1, 0, 149, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(364, 1, 0, 150, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(365, 1, 0, 151, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(366, 1, 0, 152, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(367, 1, 0, 10, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(368, 1, 0, 143, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(369, 1, 0, 144, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(370, 1, 0, 145, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(371, 1, 0, 146, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(372, 1, 0, 147, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(373, 1, 0, 11, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(374, 1, 0, 138, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(375, 1, 0, 139, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(376, 1, 0, 140, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(377, 1, 0, 141, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(378, 1, 0, 142, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(379, 1, 0, 12, 1, '2020-11-26 03:36:15', '2020-11-26 03:36:15'),
(380, 1, 0, 133, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(381, 1, 0, 134, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(382, 1, 0, 135, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(383, 1, 0, 136, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(384, 1, 0, 137, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(385, 1, 0, 13, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(386, 1, 0, 128, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(387, 1, 0, 129, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(388, 1, 0, 130, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(389, 1, 0, 131, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(390, 1, 0, 132, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(391, 1, 0, 14, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(392, 1, 0, 103, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(393, 1, 0, 104, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(394, 1, 0, 105, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(395, 1, 0, 106, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(396, 1, 0, 107, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(397, 1, 0, 15, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(398, 1, 0, 97, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(399, 1, 0, 98, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(400, 1, 0, 99, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(401, 1, 0, 100, 1, '2020-11-26 03:36:16', '2020-11-26 03:36:16'),
(402, 1, 0, 101, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(403, 1, 0, 16, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(404, 1, 0, 123, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(405, 1, 0, 124, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(406, 1, 0, 125, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(407, 1, 0, 126, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(408, 1, 0, 127, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(409, 1, 0, 17, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(410, 1, 0, 118, 1, '2020-11-26 03:36:17', '2020-11-26 03:36:17'),
(411, 1, 0, 119, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(412, 1, 0, 120, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(413, 1, 0, 121, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(414, 1, 0, 122, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(415, 1, 0, 18, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(416, 1, 0, 113, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(417, 1, 0, 114, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(418, 1, 0, 115, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(419, 1, 0, 116, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(420, 1, 0, 117, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(421, 1, 0, 19, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(422, 1, 0, 108, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(423, 1, 0, 109, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(424, 1, 0, 110, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(425, 1, 0, 111, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(426, 1, 0, 112, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(427, 1, 0, 20, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(428, 1, 0, 27, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(429, 1, 0, 28, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(430, 1, 0, 29, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(431, 1, 0, 30, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(432, 1, 0, 31, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(433, 1, 0, 21, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(434, 1, 0, 70, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(435, 1, 0, 71, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(436, 1, 0, 72, 1, '2020-11-26 03:36:18', '2020-11-26 03:36:18'),
(437, 1, 0, 73, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(438, 1, 0, 74, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(439, 1, 0, 22, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(440, 1, 0, 75, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(441, 1, 0, 76, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(442, 1, 0, 78, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(443, 1, 0, 23, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(444, 1, 0, 81, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(445, 1, 0, 82, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(446, 1, 0, 83, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(447, 1, 0, 84, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(448, 1, 0, 95, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(449, 1, 0, 24, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(450, 1, 0, 85, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(451, 1, 0, 86, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(452, 1, 0, 87, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(453, 1, 0, 88, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(454, 1, 0, 89, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(455, 1, 0, 25, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(456, 1, 0, 65, 1, '2020-11-26 03:36:19', '2020-11-26 03:36:19'),
(457, 1, 0, 66, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(458, 1, 0, 67, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(459, 1, 0, 68, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(460, 1, 0, 69, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(461, 1, 0, 26, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(462, 1, 0, 90, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(463, 1, 0, 91, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(464, 1, 0, 92, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(465, 1, 0, 93, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(466, 1, 0, 94, 1, '2020-11-26 03:36:20', '2020-11-26 03:36:20'),
(467, 1, 0, 77, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uni__sub_systems`
--

CREATE TABLE `uni__sub_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Order` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uni__sub_systems`
--

INSERT INTO `uni__sub_systems` (`id`, `ModifyUser`, `IsDeleted`, `Name`, `Title`, `Icon`, `Order`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Users', 'سطوح دسترسی', 'fa fa-users', '1', NULL, '2020-11-20 05:19:03'),
(2, 0, 0, 'BaseInformation', 'اطلاعات پایه', 'fa fa-paperclip', '2', NULL, NULL),
(3, 1, 0, 'Reports', 'گزارشات', 'fa fa-file-pdf-o', '3', NULL, '2020-11-20 05:18:52'),
(4, 0, 0, 'management', 'مدیریت', 'fa fa-tasks', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `PersonId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ModifyUser`, `IsDeleted`, `Username`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `PersonId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'ehsanjaberi', '$2y$10$WMcpKpVA5Qy0ulgcXD/sUedIADIVltFxzUTpDkijtDQv64V8uwuH2', NULL, NULL, 1, '2020-10-29 03:21:07', '2020-11-22 09:48:34'),
(2, 1, 0, 'AliAkbarTalebi', '$2y$10$qTKKOUKzFxEW1IhmKn9Onu9ft3nIKYjU0NActHy9FuHiDfi9rTKgm', NULL, NULL, 2, '2020-11-15 08:35:21', '2020-11-22 09:51:15'),
(7, 1, 0, 'Mamadi', '$2y$10$qAO.JiO0ogapmG1kNP.SreKdj.7pGOQB.LMqeG3rqNLgUKd4G4tta', NULL, NULL, 10, '2020-11-22 10:03:16', '2020-11-22 10:03:16'),
(10, 1, 0, 'Fallah', '$2y$10$2BBTUVkcFGceW9HRazMsBOTUKsVomNbHNDE44eHhLrqC4yd5wBJC.', NULL, NULL, 5, '2020-11-22 10:08:30', '2020-11-27 03:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ModifyUser` int(11) DEFAULT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `RoleId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `ModifyUser`, `IsDeleted`, `RoleId`, `UserId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 2, 1, '2020-11-16 03:52:07', '2020-11-27 03:13:18'),
(3, 1, 0, 2, 2, '2020-11-16 03:54:48', '2020-11-16 03:54:48'),
(6, 1, 0, 3, 7, '2020-11-23 02:40:16', '2020-11-23 02:40:16'),
(7, 1, 0, 1, 10, '2020-11-25 05:48:29', '2020-11-27 03:13:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `base__classes`
--
ALTER TABLE `base__classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__class_equipments`
--
ALTER TABLE `base__class_equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__codings`
--
ALTER TABLE `base__codings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__colleges`
--
ALTER TABLE `base__colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__degrees`
--
ALTER TABLE `base__degrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__employee_posts`
--
ALTER TABLE `base__employee_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__equipments`
--
ALTER TABLE `base__equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__fields`
--
ALTER TABLE `base__fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__field_classes`
--
ALTER TABLE `base__field_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__grade_types`
--
ALTER TABLE `base__grade_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__lessons`
--
ALTER TABLE `base__lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__menus`
--
ALTER TABLE `base__menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__persons`
--
ALTER TABLE `base__persons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__phone_types`
--
ALTER TABLE `base__phone_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__semesters`
--
ALTER TABLE `base__semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__semester_lessons`
--
ALTER TABLE `base__semester_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__semester_lesson_teachers`
--
ALTER TABLE `base__semester_lesson_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__universities`
--
ALTER TABLE `base__universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__university_employees`
--
ALTER TABLE `base__university_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__university_posts`
--
ALTER TABLE `base__university_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__university_students`
--
ALTER TABLE `base__university_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base__university_teachers`
--
ALTER TABLE `base__university_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `main__person_phones`
--
ALTER TABLE `main__person_phones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main__schedules`
--
ALTER TABLE `main__schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main__semester_lesson_grades`
--
ALTER TABLE `main__semester_lesson_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main__semester_lesson_students`
--
ALTER TABLE `main__semester_lesson_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main__students_attendances`
--
ALTER TABLE `main__students_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main__teachers_attendances`
--
ALTER TABLE `main__teachers_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main__uni__stu__grades`
--
ALTER TABLE `main__uni__stu__grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perimissions`
--
ALTER TABLE `perimissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report__reports`
--
ALTER TABLE `report__reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report__report_columns`
--
ALTER TABLE `report__report_columns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report__report_groups`
--
ALTER TABLE `report__report_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report__report_parameters`
--
ALTER TABLE `report__report_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report__static_items`
--
ALTER TABLE `report__static_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_perimissions`
--
ALTER TABLE `role_perimissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uni__sub_systems`
--
ALTER TABLE `uni__sub_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`Username`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base__classes`
--
ALTER TABLE `base__classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `base__class_equipments`
--
ALTER TABLE `base__class_equipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base__codings`
--
ALTER TABLE `base__codings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base__colleges`
--
ALTER TABLE `base__colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `base__degrees`
--
ALTER TABLE `base__degrees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `base__employee_posts`
--
ALTER TABLE `base__employee_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `base__equipments`
--
ALTER TABLE `base__equipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `base__fields`
--
ALTER TABLE `base__fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `base__field_classes`
--
ALTER TABLE `base__field_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base__grade_types`
--
ALTER TABLE `base__grade_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `base__lessons`
--
ALTER TABLE `base__lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `base__menus`
--
ALTER TABLE `base__menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `base__persons`
--
ALTER TABLE `base__persons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `base__phone_types`
--
ALTER TABLE `base__phone_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base__semesters`
--
ALTER TABLE `base__semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `base__semester_lessons`
--
ALTER TABLE `base__semester_lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `base__semester_lesson_teachers`
--
ALTER TABLE `base__semester_lesson_teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `base__universities`
--
ALTER TABLE `base__universities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `base__university_employees`
--
ALTER TABLE `base__university_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `base__university_posts`
--
ALTER TABLE `base__university_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `base__university_students`
--
ALTER TABLE `base__university_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `base__university_teachers`
--
ALTER TABLE `base__university_teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main__person_phones`
--
ALTER TABLE `main__person_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main__schedules`
--
ALTER TABLE `main__schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `main__semester_lesson_grades`
--
ALTER TABLE `main__semester_lesson_grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `main__semester_lesson_students`
--
ALTER TABLE `main__semester_lesson_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `main__students_attendances`
--
ALTER TABLE `main__students_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `main__teachers_attendances`
--
ALTER TABLE `main__teachers_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `main__uni__stu__grades`
--
ALTER TABLE `main__uni__stu__grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `perimissions`
--
ALTER TABLE `perimissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `report__reports`
--
ALTER TABLE `report__reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `report__report_columns`
--
ALTER TABLE `report__report_columns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `report__report_groups`
--
ALTER TABLE `report__report_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report__report_parameters`
--
ALTER TABLE `report__report_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `report__static_items`
--
ALTER TABLE `report__static_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_perimissions`
--
ALTER TABLE `role_perimissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT for table `uni__sub_systems`
--
ALTER TABLE `uni__sub_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
