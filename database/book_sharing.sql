-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 08:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `details`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 'Satyjit Roy', '<p>abc<br></p>', 1, '2021-07-07 09:53:38', '2021-07-07 09:54:08', NULL, 1),
(2, 'সমরেশ মজুমদার', '<p>abc<br></p>', 1, '2021-07-07 09:54:24', '2021-07-07 09:54:24', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'PK of book_categories.id',
  `book_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summery` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_page` int(11) NOT NULL,
  `author_id` int(11) NOT NULL COMMENT 'PK of authors.id',
  `country_id` int(11) NOT NULL COMMENT 'PK of countries.id',
  `language_id` int(11) NOT NULL COMMENT 'PK of languages.id',
  `finished_reading` int(11) DEFAULT NULL,
  `available_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=available, 0=Not available',
  `approved_status` tinyint(4) DEFAULT 0 COMMENT '0 = Pending\r\n1 = Approved\r\n2 = Decline',
  `book_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'demo.png',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category_id`, `book_id`, `title`, `summery`, `number_of_page`, `author_id`, `country_id`, `language_id`, `finished_reading`, `available_status`, `approved_status`, `book_thumb`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 1, '20210211071', 'Feluda', '<p>The Adventures of Feluda: The Emperor\'s Ring is a story of a man named Feluda and his cousin Topshe as they investigate the disappearance of a priceless Mughal ring. ... When this Mughal ring goes missing, Feluda and Topshe begin to investigate the case and find themselves on the trail of a devious criminal.<br></p>', 250, 1, 18, 1, NULL, 1, 1, '1625206424.png', 1, '2021-07-02 00:13:44', '2021-07-23 23:51:04', NULL, 1),
(2, 1, '23232', 'abc', '<p>dsf</p>', 333, 1, 2, 1, NULL, 1, 0, '1625213657.png', 1, '2021-07-02 02:14:17', '2021-07-02 02:16:26', '2021-07-02 02:16:26', 0),
(3, 1, '20210211072', 'পাহারে ফেলুদা', '<p><span style=\"color: rgb(24, 24, 24); font-family: Merriweather, Georgia, serif; font-size: 14px;\">গোয়েন্দাগিরিতে ফেলুদার হাতেখড়ি পাহাড়ে। দার্জিলিঙের পটভূমিকায় লেখা স্বরণীয় সেই কাহিনীর নাম ‘ফেলুদার গোয়েন্দাগিরি’। তখনও জটায়ু আসেননি, তোপসে নিতান্ত বালক। তবু ফেলুদা একাই একশো। অসামান্য পর্যবেক্ষণ ক্ষমতা তাঁর, বিরল বিশ্লেষণী ক্ষমতা। সেই কাহিনী থেকেই ফেলুদা বাংলা সাহিত্যে চিরকালের এক গোয়েন্দাচরিত্র হয়ে থেকে গেলেন</span><br></p>', 221, 1, 18, 1, NULL, 1, 1, '1625225724.png', 1, '2021-07-02 05:35:25', '2021-07-23 23:51:27', NULL, 1),
(4, 1, '20210211073', 'অপুর পাঁচালি', '<p><span style=\"color: rgb(34, 34, 34); font-family: consolas, &quot;lucida console&quot;, &quot;courier new&quot;, monospace; font-size: 12px; white-space: pre-wrap;\">সত্যজিৎ রায়ের পথের পাঁচালি’ যে শুধু বাংলা চলচ্ছবি নয়, গােটা ভারতীয় চলচ্ছবিকেই রাতারাতি বয়স্ক করে তুলেছিল, এবং তার সামনে এঁকে দিয়েছিল এক নূতন পথের নিশানা, তা আমরা সবাই জানি। কীভাবে, কত বিঘ-বিপদ তুচ্ছ করে তােলা হয়েছিল এই ছবি, তারও কিছু-না-কিছু খবর রাখি। আমরা এবারে এই গ্রন্থে তার সামগ্রিক বিবরণ আমরা পাচ্ছি। শুধু ‘পথের পাঁচালি’ নয়, ‘অপরাজিত ও ‘অপুর সংসার’, এবং সেই সঙ্গে ‘পরশপাথর\' ও ‘জলসাঘর’-এরও প্রস্তুতি-পর্ব ও নিমার্ণকালীন এমন নানা তথ্য এখানে স্বয়ং সত্যজিতের মুখে আমরা শুনছি, যে-বিষয়ে অনেক কিছুই এতকাল আমাদের জানা ছিল না। তাঁর চলচ্চিত্র তাে দেখেছি আমরা ; বস্তুত তাঁর প্রায় প্রতিটি চলচ্চিত্রই আমরা অনেকে একাধিকবার দেখেছি। এখানে,—তাঁর ভাষা যেহেতু ছবি ফোটায়, তাই—সেই চলচ্চিত্রের নেপথ্যবর্তী চিত্রগুলিও তিনি আমাদের চোখের সামনে তুলে ধরেছেন। একই সঙ্গে তিনি এখানে বলে যাচ্ছেন পাশ্চাত্য সংগীত ও চলচ্চিত্র-শিল্পের প্রতি তাঁর আকৈশাের অনুরাগের কথা, অন্য বৃত্তির প্রভূত সাফল্যকে হেলায় তুচ্ছ করে কীভাবে চলচ্চিত্রের জগতে চলে এলেন সেই কথা, প্রতিকূল পরিবেশের মধ্যেও আপন লক্ষ্যে অবিচল থাকার কথা, এমনকি মাত্র আড়াইশাে টাকার অভাবে ‘পথের পাঁচালি’র শুটিং কীভাবে একদিন বন্ধ হওয়ার উপক্রম হয়েছিল, সেই কথাও। খুঁটিনাটি অজস্র তথ্যের মাধ্যমে সত্যজিৎ তাঁর আপন ব্যক্তিত্বকেই যেন এখানে আমাদের সামনে মেলে ধরেছেন। এক দিক থেকে এ-বই এক অন্তরঙ্গ স্মৃতিকথা, আবার অন্য দিক থেকে ঐতিহাসিক দলিলও বটে। </span><br></p>', 360, 1, 18, 1, NULL, 1, 0, '1625225921.png', 1, '2021-07-02 05:38:41', '2021-07-02 05:38:41', NULL, 1),
(5, 2, '20210606071', 'কালবেলা', '<p>কলকাতায় পা দিয়েই অনিমেষ দেখল রাস্তায় ট্রাম জ্বলছে, গুলি চলছে। মফস্বল থেকে আসা এই তরুণটি সেদিন দুর্ঘটনার শিকার হয়েছিল। তারপর আর পাঁচটা মানুষের মতাে গা ভাসিয়ে ভেসে যেতে যেতে হঠাৎ তার জীবনের মােড় পাল্টালাে। ছাত্র-রাজনীতি তাকে নিয়ে গেল জটিল আবর্তে । দেশের মানুষের পাশে দাড়ানাের দুর্বার বাসনায় বিভক্ত কমিউনিস্ট পার্টির পতাকার নীচে গিয়ে দাঁড়াল অনিমেষ। কিন্তু মনুষ্যত্ব এবং মানবিক মূল্যবােধ তাকে সরিয়ে নিয়ে এল উগ্র রাজনীতিতে। উত্তাল আগুনে ঝাঁপ দিয়ে নিজেকে দগ্ধ করে সে দেখল, দাহ্যবস্তুর কোনও সৃষ্টিশীল ক্ষমতা নেই। পুলিশের নির্মম অত্যাচারে সে যখন বিকলাঙ্গ তখন বিপ্লবের শরিকরা হয় নিঃশেষ নয় গুছিয়ে নিয়েছে আখের। অনিমেষ অবাক হয়ে দেখল মাধবীলতাকে। মাধবীলতা কোনও রাজনীতি করেনি কখনও, শুধু তাকে ভালবেসে আলােকস্তম্ভের মতাে একা মাথা তুলে দাঁড়িয়ে আছে। খরতপ্ত মধ্যাহ্নে যে এক গ্লাস শীতল পানীয়ের চেয়ে বেশি কিছু হতে চায় না। বাংলাদেশের এই মেয়ে যে কিনা শুধু ধূপের মতাে নিজেকে পােড়ায় আগামীকালকে সুন্দর করতে। দেশ গড়ার জন্যে বিপ্লবের নিষ্ফল হতাশায় ডুবে যেতে যেতে অনিমেষ আবিষ্কার করেছিল বিপ্লবের আর এক নাম মাধবীলতা। দেশ পত্রিকায় ধারাবাহিক প্রকাশের সময় এই দুটি চরিত্র লক্ষ পাঠকের ভালবাসা পেয়েছিল। কালজয়ী উপন্যাসের এইখানেই সার্থকতা। <br><br></p>', 300, 2, 100, 1, NULL, 1, 0, '1625597045.png', 2, '2021-07-06 12:44:06', '2021-07-06 12:44:06', NULL, 1),
(6, 2, '20210211074', 'demo', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span><br></p>', 225, 2, 18, 1, NULL, 1, 1, '1626201007.png', 1, '2021-07-13 12:30:07', '2021-07-23 23:53:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 'Psychology', 1, '2021-07-01 10:40:46', '2021-07-01 10:41:43', NULL, 1),
(2, 'পশ্চিমবঙ্গের উপন্যাস', 1, '2021-07-06 12:40:25', '2021-07-06 12:40:25', NULL, 1),
(3, 'কম্পিউটার, ফ্রিল্যান্সিং ও প্রোগ্রামিং', 1, '2021-07-06 12:41:33', '2021-07-06 12:41:33', NULL, 1),
(4, 'সায়েন্স ফিকশন', 1, '2021-07-06 12:41:47', '2021-07-06 12:41:47', NULL, 1),
(5, 'ইতিহাস ও ঐতিহ্য', 1, '2021-07-06 12:42:06', '2021-07-06 12:42:06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

CREATE TABLE `book_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL COMMENT 'pk of users.id',
  `owner_id` int(11) NOT NULL COMMENT 'pk of users.id',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Accept, 2=Reject',
  `status_update_time` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_requests`
--

INSERT INTO `book_requests` (`id`, `book_id`, `sender_id`, `owner_id`, `status`, `status_update_time`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 3, 1, 1, 0, '2021-07-24 20:58:04', 1, '2021-07-24 20:58:04', '2021-07-24 20:58:04', NULL, 1),
(2, 6, 1, 1, 0, '2021-07-24 20:58:04', 1, '2021-07-24 20:58:04', '2021-07-24 20:58:04', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `edu_blogs`
--

CREATE TABLE `edu_blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=publish, 0=unpublish',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edu_blog_comments`
--

CREATE TABLE `edu_blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL COMMENT 'fk of edu_blogs.id',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = unpublish 1 = publish',
  `created_by` int(11) NOT NULL COMMENT 'fk of users.id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edu_contact_us`
--

CREATE TABLE `edu_contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edu_provider_users`
--

CREATE TABLE `edu_provider_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edu_provider_users`
--

INSERT INTO `edu_provider_users` (`id`, `name`, `address`, `phone`, `image`, `email`, `email_verified`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `status`, `valid`) VALUES
(1, 'Md.Provider', NULL, NULL, NULL, 'provider@gmail.com', 1, NULL, '$2y$10$QA2tpIzuEbbRf//TxfSj.OkRg4.4k/PiLI8TE2IpNBqJuC9A9nZH6', NULL, '2020-10-14 11:38:27', '2020-10-14 11:38:27', NULL, 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edu_student_social_links`
--

CREATE TABLE `edu_student_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK = users.id',
  `fb_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 'Bangla', 1, '2021-07-01 11:36:47', '2021-07-01 11:38:00', NULL, 1);

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_14_150726_create_edu_provider_users_table', 1),
(5, '2020_10_29_175735_create_edu_contact_us_table', 1),
(6, '2021_01_30_180238_create_edu_student_social_links_table', 1),
(7, '2021_04_09_045131_create_edu_blogs_table', 1),
(8, '2021_04_13_174842_create_edu_blog_comments_table', 1),
(9, '2021_07_01_161032_create_book_categories_table', 1),
(10, '2021_07_01_165116_create_add_books_table', 2),
(11, '2021_07_01_165116_create_books_table', 3),
(12, '2021_07_01_172425_create_languages_table', 4),
(14, '2021_07_02_043151_create_authors_table', 5),
(15, '2021_07_07_154212_create_book_requests_table', 5);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Yes, 0=No',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '1=Yes, 0=No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `address`, `phone`, `image`, `email_verified`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `valid`) VALUES
(1, 'Rudra', '', 'rudra@gmail.com', 'Mohammadpur, Dhaka', '01738201055', '1625202398.png', 1, '2021-07-02 04:53:18', '$2y$10$QA2tpIzuEbbRf//TxfSj.OkRg4.4k/PiLI8TE2IpNBqJuC9A9nZH6', NULL, '2021-07-02 04:53:18', '2021-07-01 23:06:38', NULL, 1),
(2, 'abc', 'def', 'abc@gmail.com', 'Mirpur, Dhaka', '123456789', NULL, 1, NULL, '$2y$10$iVBXZa.RmPEIAG45C0lWm.n8ZN2ODjzcCnUZ6Q84qBBUjl6Vp6P5y', NULL, '2021-07-03 10:28:45', '2021-07-03 10:28:45', NULL, 1),
(3, 'Rokonuzzaman', '', 'rokonuzzaman@gmail.com', 'Banani, Dhaka', '012364587945', '1625202398.png', 1, '2021-07-02 04:53:18', '$2y$10$QA2tpIzuEbbRf//TxfSj.OkRg4.4k/PiLI8TE2IpNBqJuC9A9nZH6', NULL, '2021-07-02 04:53:18', '2021-07-01 23:06:38', NULL, 1),
(4, 'Jhon', '', 'jhon@gmail.com', 'Banani, Dhaka', '012364587945', '1625202398.png', 1, '2021-07-02 04:53:18', '$2y$10$QA2tpIzuEbbRf//TxfSj.OkRg4.4k/PiLI8TE2IpNBqJuC9A9nZH6', NULL, '2021-07-02 04:53:18', '2021-07-01 23:06:38', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_blogs`
--
ALTER TABLE `edu_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_blog_comments`
--
ALTER TABLE `edu_blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_contact_us`
--
ALTER TABLE `edu_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_provider_users`
--
ALTER TABLE `edu_provider_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `edu_provider_users_email_unique` (`email`);

--
-- Indexes for table `edu_student_social_links`
--
ALTER TABLE `edu_student_social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `edu_blogs`
--
ALTER TABLE `edu_blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_blog_comments`
--
ALTER TABLE `edu_blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_contact_us`
--
ALTER TABLE `edu_contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edu_provider_users`
--
ALTER TABLE `edu_provider_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edu_student_social_links`
--
ALTER TABLE `edu_student_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
