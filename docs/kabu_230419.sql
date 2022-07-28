-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2019 at 12:42 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kabu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `group` enum('admin','mod') COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `name`, `password`, `group`, `create_time`, `last_login`) VALUES
(1, 'hoangviet11088@gmail.com', 'Hoàng Việt 2', '72a02467e0aadcf0107a7ae3aeb79223', 'admin', 1451988321, 0),
(4, 'hoangviet11088@gmail.com', 'Hanh Phan', '72a02467e0aadcf0107a7ae3aeb79223', 'admin', 1451988321, 0),
(7, 'cuongnd2609@gmail.com', 'Cường', '6a5f9ad8f02e4f6b53d6aae5b50f9c22', 'admin', 1468966930, 0),
(8, 'linhdhnn@gmail.com', 'Linh', 'a076eb0c1d6fdbe8cbe31a8962d9e8e2', 'mod', 1552751386, 0);

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_landingpage_config`
--

CREATE TABLE IF NOT EXISTS `affiliate_landingpage_config` (
`id` int(11) NOT NULL,
  `landingpage_id` int(11) NOT NULL,
  `type` enum('percent','fixed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'percent',
  `amount` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `affiliate_landingpage_config`
--

INSERT INTO `affiliate_landingpage_config` (`id`, `landingpage_id`, `type`, `amount`) VALUES
(1, 2, 'percent', 10),
(2, 5, 'percent', 20),
(3, 3, 'percent', 10);

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_transactions`
--

CREATE TABLE IF NOT EXISTS `affiliate_transactions` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `approve_time` int(11) DEFAULT NULL COMMENT 'thời điểm mà thằng nhân viên đc nhận tiền ( lúc admin approve order)',
  `amount` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('confirmed','cancelled','pending') COLLATE utf8_unicode_ci NOT NULL,
  `user_approve` int(11) NOT NULL,
  `modify_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `affiliate_transactions`
--

INSERT INTO `affiliate_transactions` (`id`, `user_id`, `create_time`, `approve_time`, `amount`, `description`, `status`, `user_approve`, `modify_time`) VALUES
(8, 2, 1549956491, NULL, 49900, '', 'confirmed', 1, 1552231405),
(9, 2, 1549959315, NULL, 29900, 'MU vô địch', 'confirmed', 1, 1552231459),
(10, 2, 1553702405, NULL, 49900, '', 'pending', 0, 0),
(11, 2, 1553702407, NULL, 49900, '', 'pending', 0, 0),
(12, 2, 1553702407, NULL, 49900, '', 'pending', 0, 0),
(13, 2, 1553702407, NULL, 49900, '', 'pending', 0, 0),
(14, 2, 1553702408, NULL, 49900, '', 'pending', 0, 0),
(15, 2, 1553702408, NULL, 49900, '', 'pending', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_user_info`
--

CREATE TABLE IF NOT EXISTS `affiliate_user_info` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` enum('pending','cancelled','active') COLLATE utf8_unicode_ci NOT NULL,
  `total_visite` int(11) NOT NULL,
  `total_click` int(11) NOT NULL,
  `total_order` int(11) NOT NULL,
  `total_money` int(11) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `withdraw` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT '0000-00-00 00:00:00',
  `today_visite` int(11) DEFAULT NULL,
  `today_click` int(11) DEFAULT NULL,
  `today_order` int(11) DEFAULT NULL,
  `today_date` int(11) DEFAULT NULL,
  `this_month_visite` int(11) DEFAULT NULL,
  `this_month_click` int(11) DEFAULT NULL,
  `this_month_order` int(11) DEFAULT NULL,
  `this_month_date` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `affiliate_user_info`
--

INSERT INTO `affiliate_user_info` (`id`, `user_id`, `active`, `total_visite`, `total_click`, `total_order`, `total_money`, `balance`, `withdraw`, `update_at`, `today_visite`, `today_click`, `today_order`, `today_date`, `this_month_visite`, `this_month_click`, `this_month_order`, `this_month_date`) VALUES
(1, 2, 'active', 3, 3, 9, 79800, 79800, 0, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 4, 'cancelled', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 1552150801, 0, 0, 0, 1551373201),
(3, 5, 'pending', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 1552150801, 0, 0, 0, 1551373201);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_clicked` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `alias`, `description`, `image`, `thumb`, `total_clicked`, `url`, `create_time`) VALUES
(1, 'Bí quyết giúp thai nhi khỏe mạnh thông minh', 'bi-quyet-giup-thai-nhi-khoe-manh-thong-minh', 'Trong thai giáo có rất nhiều phương pháp khác nhau. Nếu không có đủ thời gian để áp dụng tất cả thì phải chọn phương pháp nào đây? Ưu tiên phương pháp nào trước để hiệu quả là cao nhất?', '/assets/uploads/sample-thumb.jpeg', '/assets/uploads/sample-thumb.jpeg', 96, 'https://google.com/', 1452568877),
(3, 'Bí quyết thai giáo thành công cho các mẹ bầu thông thái', 'bi-quyet-thai-giao-thanh-cong-cho-cac-me-bau-thong-thai', 'Tôi nghĩ rằng vai trò của người bố trong gia đình là rất quan trọng. Chỉ là từ trước đến giờ các ông bố chưa để ý đến việc này. Một phần do quan niệm của đa số người Việt thì việc nuôi dạy con là trách nhiệm của phụ nữ, còn trách nhiệm của chồng chỉ là kiếm tiền lo cho gia đình. Cần phải có một công cụ nào đó để khơi gợi lên tình yêu và trách nhiệm hơn nữa của Chồng bạn trong việc nuôi dạy con cái. Tôi nghĩ rằng ngay lúc này đây, khi Bạn đang mang bầu là thời điểm tốt nhất để Bạn và Chồng bạn bắt đầu. Đây là lúc Bạn cần và xứng đáng nhận được nhiều sự quan tâm và yêu thương hơn cả. Hãy thai giáo cho Con ngay từ bây giờ.', 'assets/uploads/banners/banner-noi-that-phong-an.jpg', '/assets/uploads/thumb/banners/banner-noi-that-phong-an_thumb.jpg', 0, 'https://google.com', 1545058622);

-- --------------------------------------------------------

--
-- Table structure for table `banners_source_click`
--

CREATE TABLE IF NOT EXISTS `banners_source_click` (
`id` int(11) NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_click` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
`id` int(11) NOT NULL,
  `term` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `term_id` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=102 ;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `term`, `name`, `term_id`, `value`) VALUES
(1, 'home', 'cat_available', 0, '["1","2"]'),
(2, 'global', 'head_js', 0, ''),
(3, 'global', 'footer_js', 0, ''),
(7, 'home', 'slider_block', 1, '5'),
(8, 'home', 'slider_block', 2, '4'),
(9, 'home', 'slider_block', 3, '3'),
(10, 'home', 'slider_block', 4, '2'),
(11, 'home', 'slider_block', 5, '1'),
(14, 'affiliate', 'cookie_time', 0, '259200'),
(15, 'category', 'slogan', 1, '&nbsp;'),
(16, 'category', 'banner', 1, '/assets/uploads/images/banners/3.jpg'),
(17, 'category', 'featured_new', 1, '["4","1"]'),
(18, 'category', 'slogan', 36, 'Sức khỏe mẹ bầu khi mang thai rất quan trọng với bé sau này'),
(19, 'category', 'banner', 36, '/assets/uploads/images/banners/s-taipan-bar.jpg'),
(20, 'category', 'featured_new', 36, '["7715","7713"]'),
(21, 'category', 'slogan', 37, 'Sức khỏe mẹ bầu khi mang thai rất quan trọng với bé sau này'),
(22, 'category', 'banner', 37, '/assets/uploads/images/banners/3.jpg'),
(23, 'category', 'featured_new', 37, '["7261","7171"]'),
(24, 'category', 'slogan', 38, '&nbsp;'),
(25, 'category', 'banner', 38, '/assets/uploads/images/banners/3.jpg'),
(26, 'category', 'featured_new', 38, '["0"]'),
(27, 'category', 'slogan', 39, '&nbsp;'),
(28, 'category', 'banner', 39, '/assets/uploads/images/banners/3.jpg'),
(29, 'category', 'featured_new', 39, '["0"]'),
(30, 'category', 'slogan', 40, '&nbsp;'),
(31, 'category', 'banner', 40, '/assets/uploads/images/banners/3.jpg'),
(32, 'category', 'featured_new', 40, '["0"]'),
(33, 'category', 'slogan', 41, 'Sức khỏe mẹ bầu khi mang thai rất quan trọng với bé sau này'),
(34, 'category', 'banner', 41, '/assets/uploads/images/banners/slider-bg-1.jpg'),
(35, 'category', 'featured_new', 41, '["7714","7707"]'),
(36, 'category', 'slogan', 43, '&nbsp;'),
(37, 'category', 'banner', 43, '/assets/uploads/images/banners/3.jpg'),
(38, 'category', 'featured_new', 43, '["0"]'),
(39, 'category', 'slogan', 566, '&nbsp;'),
(40, 'category', 'banner', 566, '/assets/uploads/images/banners/3.jpg'),
(41, 'category', 'featured_new', 566, '["0"]'),
(42, 'category', 'slogan', 573, '&nbsp;'),
(43, 'category', 'banner', 573, '/assets/uploads/images/banners/3.jpg'),
(44, 'category', 'featured_new', 573, '["0"]'),
(45, 'category', 'slogan', 574, '&nbsp;'),
(46, 'category', 'banner', 574, '/assets/uploads/images/banners/3.jpg'),
(47, 'category', 'featured_new', 574, '["0"]'),
(48, 'category', 'slogan', 575, '&nbsp;'),
(49, 'category', 'banner', 575, '/assets/uploads/images/banners/3.jpg'),
(50, 'category', 'featured_new', 575, '["0"]'),
(51, 'category', 'slogan', 577, '&nbsp;'),
(52, 'category', 'banner', 577, '/assets/uploads/images/banners/3.jpg'),
(53, 'category', 'featured_new', 577, '["0"]'),
(54, 'category', 'slogan', 578, '&nbsp;'),
(55, 'category', 'banner', 578, '/assets/uploads/images/banners/3.jpg'),
(56, 'category', 'featured_new', 578, '["0"]'),
(57, 'category', 'slogan', 579, '&nbsp;'),
(58, 'category', 'banner', 579, '/assets/uploads/images/banners/3.jpg'),
(59, 'category', 'featured_new', 579, '["0"]'),
(60, 'category', 'slogan', 581, '&nbsp;'),
(61, 'category', 'banner', 581, '/assets/uploads/images/banners/3.jpg'),
(62, 'category', 'featured_new', 581, '["0"]'),
(63, 'category', 'slogan', 582, '&nbsp;'),
(64, 'category', 'banner', 582, '/assets/uploads/images/banners/3.jpg'),
(65, 'category', 'featured_new', 582, '["0"]'),
(66, 'category', 'slogan', 585, '&nbsp;'),
(67, 'category', 'banner', 585, '/assets/uploads/images/banners/3.jpg'),
(68, 'category', 'featured_new', 585, '["0"]'),
(69, 'category', 'slogan', 586, '&nbsp;'),
(70, 'category', 'banner', 586, '/assets/uploads/images/banners/3.jpg'),
(71, 'category', 'featured_new', 586, '["0"]'),
(72, 'category', 'slogan', 587, '&nbsp;'),
(73, 'category', 'banner', 587, '/assets/uploads/images/banners/3.jpg'),
(74, 'category', 'featured_new', 587, '["0"]'),
(75, 'category', 'slogan', 589, '&nbsp;'),
(76, 'category', 'banner', 589, '/assets/uploads/images/banners/3.jpg'),
(77, 'category', 'featured_new', 589, '["0"]'),
(78, 'category', 'slogan', 590, '&nbsp;'),
(79, 'category', 'banner', 590, '/assets/uploads/images/banners/3.jpg'),
(80, 'category', 'featured_new', 590, '["0"]'),
(81, 'category', 'slogan', 591, '&nbsp;'),
(82, 'category', 'banner', 591, '/assets/uploads/images/banners/3.jpg'),
(83, 'category', 'featured_new', 591, '["0"]'),
(84, 'category', 'slogan', 1, '&nbsp;'),
(85, 'category', 'banner', 1, '/assets/uploads/images/banners/3.jpg'),
(86, 'category', 'featured_new', 1, '["4","1"]'),
(87, 'category', 'slogan', 2, '&nbsp;'),
(88, 'category', 'banner', 2, '/assets/uploads/images/banners/3.jpg'),
(89, 'category', 'featured_new', 2, '["5","4"]'),
(90, 'category', 'slogan', 3, '&nbsp;'),
(91, 'category', 'banner', 3, '/assets/uploads/images/banners/3.jpg'),
(92, 'category', 'featured_new', 3, '["0"]'),
(93, 'category', 'slogan', 4, '&nbsp;'),
(94, 'category', 'banner', 4, '/assets/uploads/images/banners/3.jpg'),
(95, 'category', 'featured_new', 4, '["0"]'),
(96, 'category', 'slogan', 2, '&nbsp;'),
(97, 'category', 'banner', 2, '/assets/uploads/images/banners/3.jpg'),
(98, 'category', 'featured_new', 2, '["5","4"]'),
(99, 'category', 'slogan', 3, '&nbsp;'),
(100, 'category', 'banner', 3, '/assets/uploads/images/banners/3.jpg'),
(101, 'category', 'featured_new', 3, '["0"]');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `alias`, `avatar`, `phone`, `birthday`, `address`, `email`, `create_time`) VALUES
(13, 'Sâm Nguyễn', 'sam-nguyen', '', '0911144000', 21, 'Kim Mã', 'sieuthikhoadientu@gmail.com', 1549956357),
(14, 'việt hoàng', 'viet-hoang', '', '0904683491', 12, '73 Lý Nam Đế', 'hoangviet11088@gmail.com', 1549956491),
(15, 'Chí Kiên', 'chi-kien', '', '0123456789', 29, 'Kim Mã', 'chikien149@gmail.com', 1549959315),
(16, '', '', '', '', 0, '', '', 1553702405),
(17, '', '', '', '', 0, '', '', 1553702407),
(18, '', '', '', '', 0, '', '', 1553702407),
(19, '', '', '', '', 0, '', '', 1553702407),
(20, '', '', '', '', 0, '', '', 1553702408),
(21, '', '', '', '', 0, '', '', 1553702408);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL COMMENT 'Upload Date',
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Unblock, 0=Block'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `landing_page`
--

CREATE TABLE IF NOT EXISTS `landing_page` (
`id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `code_header` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `code_footer` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `step_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `display_name` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `parent`, `display_name`, `icon`, `slug`, `number`) VALUES
(1, 1, NULL, 'Trang chủ', 'glyphicon glyphicon-user', '/', 1),
(2, 1, NULL, 'Khóa học bầu', 'glyphicon glyphicon-remove', 'category/khoa-hoc-bau', 2),
(3, 1, NULL, 'Nuôi dạy con', '', 'category/nuoi-day-con', 3),
(4, 1, 2, 'Thai giáo', '', 'category/bau/thai-giao', 1),
(5, 1, 2, 'Chuẩn bị mang thai', '', 'category/bau/chuan-bi-mang-thai', 2),
(6, 1, 2, 'Kiến thức thai kỳ', '', 'category/bau/kien-thuc-thai-ky', 3),
(7, 1, 2, 'Dinh dưỡng thai kỳ', '', 'category/bau/dinh-duong-thai-ky', 4),
(8, 1, 2, 'Bạn hỏi - Chuyên gia trả lời', '', 'category/bau/ban-hoi-chuyen-gia-tra-loi-bau', 5),
(9, 1, 2, 'Sự phát triển của thai nhỉ', '', 'category/bau/su-phat-trien-cua-thai-nhi', 6),
(10, 1, 2, 'Thay đổi cơ thể mẹ bầu qua các tuần thai', '', 'category/bau/thay-doi-co-the-me-bau-qua-cac-tuan-t', 7),
(11, 1, 3, 'Chăm sóc trẻ sơ sinh', '', 'category/nuoi-day-con/cham-soc-tre-so-sinh', 1),
(12, 2, NULL, 'Chính sách 1', '', 'page/about-us', 0),
(17, 1, NULL, 'google', '', 'https://google.com', 0),
(18, 1, NULL, 'Giáo dục trẻ sơ sinh', '', '/category/giao-duc-tre-so-sinh', 0),
(19, 2, NULL, 'Thành viên liên kết', '', '/thanh-vien-lien-ket', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menus_term`
--

CREATE TABLE IF NOT EXISTS `menus_term` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('navigation','footer-1','footer-2','footer-3') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `menus_term`
--

INSERT INTO `menus_term` (`id`, `name`, `position`) VALUES
(1, 'Navigation Menu', 'navigation'),
(2, 'Footer menu 1', 'footer-1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `categoryid` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `author_id` int(11) NOT NULL,
  `count_view` int(11) DEFAULT NULL,
  `type` enum('post','page','landing') COLLATE utf8_unicode_ci DEFAULT 'post',
  `language` enum('vietnamese','english') COLLATE utf8_unicode_ci DEFAULT NULL,
  `original_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `order`, `categoryid`, `title`, `alias`, `description`, `content`, `image`, `thumb`, `create_time`, `meta_title`, `meta_description`, `meta_keywords`, `author_id`, `count_view`, `type`, `language`, `original_date`) VALUES
(1, 1, '["1"]', 'Dấu hiệu mang thai con trai', 'dau-hieu-mang-thai-con-trai', 'sdfsfds', '<p>sdfdsfdsfs</p>\r\n', '/assets/uploads/sample_thumb.png', '/assets/uploads/sample_thumb.png', '2019-04-18 23:55:41', '', '', '', 1, NULL, 'post', NULL, '0000-00-00 00:00:00'),
(2, 2, '["2","3"]', 'Các bệnh nguy hiểm khi mang thai', 'cac-benh-nguy-hiem-khi-mang-thai', '', '<p>https://www.youtube.com/embed/qR1-3uuTT2c</p>\r\n\r\n<p style="text-align:justify">Bị bệnh là điều không ai mong muốn, đặc biệt là mẹ bị bệnh khi mang thai và đang rất lo lắng về sự phát triển của bé cũng như về sức khỏe của chính bản thân mình. Rất may là mẹ có thể đã được miễn dịch với một số loại bệnh truyền nhiễm.</p>\r\n\r\n<p style="text-align:justify">Điều này nhờ vào chiến dịch tiêm chủng ngừa thành công rubella (bệnh sởi Đức), một loại bệnh nhiễm trùng nguy hiểm nhất cho mẹ bầu và thai nhi.</p>\r\n\r\n<p style="text-align:justify">Mẹ cũng sẽ cảm thấy bớt lo lắng hơn khi biết rằng trong thực tế, hầu hết trẻ sơ sinh không bị ảnh hưởng nhiều từ việc mẹ bầu bị nhiễm trùng trong khi mang thai. Tuy nhiên vẫn có&nbsp;các bệnh của mẹ ảnh hưởng đến thai nhi và&nbsp;có thể lây truyền sang trẻ sơ sinh thông qua nhau thai hoặc trong quá trình sinh nở.</p>\r\n\r\n<p>&nbsp; <img alt="Mẹ bầu bị cảm cúm là do đâu" src="https://poh.vn/wp-content/uploads/2019/01/Mẹ-bầu-bị-cảm-cúm-là-do-đâu.jpg" style="height:667px; width:1000px" /></p>\r\n\r\n<p style="text-align:center"><em>Cảm cúm là một trong các bệnh thường gặp ở phụ nữ mang thai.</em></p>\r\n\r\n<p style="text-align:justify">Nếu điều đó xảy ra, nó có thể gây hậu quả rất nghiêm trọng cho em bé của mẹ. Hơn nữa, một số loại bệnh nhiễm trùng có thể khiến cơ thể yếu hơn nếu mắc chúng lúc đang mang thai hoặc có thể dẫn đến các biến chứng nguy hiểm khác như <a href="https://poh.vn/me-bau-sinh-non-lieu-co-nguy-hiem/">sinh non</a>.</p>\r\n\r\n<p style="text-align:justify">Mẹ không thể tránh được tất cả các tác nhân gây nhiễm trùng trong khi đang mang thai. Nhưng hoàn toàn có thể áp dụng một số phương pháp nhất định để giảm nguy cơ mắc các vấn đề nghiêm trọng cho cả mẹ và thai nhi nếu không may bị nhiễm.</p>\r\n\r\n<p style="text-align:justify">Khám thai là điều rất quan trọng. Ví dụ, các xét nghiệm máu đơn giản có thể cho mẹ biết liệu bạn có miễn dịch với một số loại bệnh nhiễm trùng hay không,chẳng hạn như thủy đậu và rubella.</p>\r\n\r\n<p style="text-align:justify">Mẹ cũng có thể được xét nghiệm các loại bệnh nhiễm trùng khác, bao gồm nhiễm trùng đường tiết niệu, liên cầu khuẩn nhóm B, viêm gan B và HIV. Nếu mẹ nghĩ rằng mình đã tiếp xúc với một tác nhân gây nhiễm trùng nghiêm trọng hoặc mẹ bị nhiễm trùng, thăm khám kịp thời có thể giúp ngăn ngừa biến chứng hiệu quả.</p>\r\n\r\n<p style="text-align:justify">Mẹ cũng có thể tự mình làm một số việc. Các biện pháp cơ bản như rửa tay, không dùng chung đồ uống hoặc dụng cụ vệ sinh cá nhân, sử dụng găng tay khi làm vườn và tránh xa bất cứ ai bị bệnh truyền nhiễm sẽ giảm nguy cơ lây bệnh cho mẹ.</p>\r\n\r\n<p style="text-align:justify">Quan hệ tình dục an toàn sẽ giúp ngăn ngừa nhiều loại bệnh lây truyền qua đường tình dục. Ngoài ra mẹ cần lưu ý tránh bị nhiễm trùng do thực phẩm, chẳng hạn như tránh ăn một số loại thực phẩm nhất định, rửa trái cây và rau quả sạch, và đảm bảo thịt, cá và trứng được nấu chín kỹ trước khi ăn và các dụng cụ chế biến thức ăn luôn sạch sẽ an toàn.</p>\r\n\r\n<p style="text-align:justify">Dưới đây là danh sách các bệnh nguy hiểm khi mang thai mẹ nên chú ý:</p>\r\n\r\n<ul>\r\n	<li><a href="https://poh.vn/viem-am-dao-can-benh-ma-phu-nu-nao-cung-can-phai-biet/">Nhiễm khuẩn âm đạo</a></li>\r\n	<li><a href="https://poh.vn/me-bau-bi-thuy-dau-nguy-hiem-doi-voi-thai-nhi-nhu-the-nao/">Thủy đậu</a></li>\r\n	<li>Chikungunya (bệnh virus lây truyền bởi muỗi)</li>\r\n	<li>Chlamydia (bệnh lây truyền qua đường tình dục)</li>\r\n	<li>Cytomegalovirus (gây ra bởi loại virus thuộc nhóm Herpes)</li>\r\n	<li><a href="https://poh.vn/sot-xuat-huyet-trong-thai-ky-co-gay-nguy-hiem-cho-thai-nhi/">Bệnh sốt xuất huyết</a></li>\r\n	<li>Bệnh truyền nhiễm Canine Parvovirus (hay còn gọi là bệnh Parvo)</li>\r\n	<li><a href="https://poh.vn/cam-cum-trong-thai-ky-anh-huong-den-thai-nhi-the-nao/">Cúm</a></li>\r\n	<li><a href="https://poh.vn/benh-lau-trong-thai-ky/">Bệnh lậu</a></li>\r\n	<li>Liên cầu khuẩn nhóm B</li>\r\n	<li><a href="https://poh.vn/me-bau-can-canh-giac-voi-can-benh-viem-gan-b-trong-thai-ky/">Bệnh viêm gan B</a></li>\r\n	<li><a href="https://poh.vn/mun-rop-do-virus-herpes-simplex-anh-huong-nhu-the-nao-doi-voi-thai-ky/">Herpes</a></li>\r\n	<li>HIV</li>\r\n	<li>Listeriosis (gây ra bởi thức ăn bị nhiễm độc)</li>\r\n	<li><a href="https://poh.vn/rubella-can-benh-nguy-hiem-doi-voi-thai-nhi/">Rubella (bệnh sởi Đức)</a></li>\r\n	<li>Bệnh lây truyền qua đường tình dục</li>\r\n	<li><a href="https://poh.vn/me-bau-bi-giang-mai-co-lay-benh-cho-thai-nhi/">Bệnh giang mai</a></li>\r\n	<li>Nhiễm Toxoplasma (nhiễm ký sinh trùng Toxoplasma)</li>\r\n	<li>Nhiễm Trichomonas (một bệnh truyền nhiễm do ký sinh trùng Trichomonas vaginalis gây ra)</li>\r\n	<li><a href="https://poh.vn/nhiem-trung-duong-tiet-nieu-khi-mang-thai/">Nhiễm trùng đường tiết niệu</a></li>\r\n	<li>Vi-rút Zika</li>\r\n</ul>\r\n\r\n<p style="text-align:justify">Nếu mẹ bị bệnh hoặc nghĩ rằng mình đã tiếp xúc với một căn bệnh truyền nhiễm nào đó, hãy đến các cơ sở y tế để tiến hành xét nghiệm và điều trị nếu cần thiết.</p>\r\n\r\n<blockquote><em>Để tìm hiểu chi tiết về các bệnh lý thường gặp trong thai kỳ, ba mẹ tham khảo bài viết&nbsp;<a href="https://poh.vn/19-benh-ly-nguy-hiem-trong-thai-ky-me-bau-can-biet/">19 Bệnh lý nguy hiểm trong thai kỳ mẹ bầu cần biết</a> của POH nhé!</em></blockquote>\r\n\r\n<h2 style="text-align:justify"><strong>Để thai kỳ là quãng thời gian hạnh phúc của mẹ bầu</strong></h2>\r\n\r\n<p style="text-align:justify">Các nhà khoa học cho thấy, bên cạnh việc bổ sung đầy đủ chất dinh dưỡng thiết yếu để mẹ bầu khỏe mạnh, con yêu phát triển thể chất, cân nặng và não bộ tốt trong thai kỳ, ba mẹ còn nên thực hành thai giáo để mẹ bầu tận hưởng thai kỳ tuyệt vời nhất cũng như tối ưu sự phát triển não bộ và đánh thức các giác quan của con phát triển vượt trội.</p>\r\n\r\n<p style="text-align:justify">Do đó, POH xây dựng khóa thực hành thai giáo online_<a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/">Thai giáo 280 ngày yêu thương</a>. Điểm đặc biệt trong chương trình của POH là mẹ sẽ cung cấp ngày dự sinh của con, phần mềm sẽ tính được hôm nay bạn bé đang ở ngày thứ bao nhiêu của thai kỳ.</p>\r\n\r\n<p style="text-align:justify">Từ đó đưa ra bài thực hành phù hợp với sự phát triển của con trong ngày hôm nay, giúp kích thích tốt nhất sự phát triển của con yêu.</p>\r\n\r\n<p style="text-align:justify">Thai giáo còn là cơ hội để người chồng thể hiện tình yêu thương với mẹ bầu và con yêu để tình cảm gia đình thêm gắn kết cũng như sợi dây kết nối ba mẹ và con yêu được bền chặt hơn. Do đó,<a href="https://poh.vn/thai-giao/"> các ông bố hãy cùng vợ thực hành thai giáo cho con yêu</a> mỗi ngày để người vợ cảm thấy mình được yêu thương và quan tâm nhé!</p>\r\n\r\n<p style="text-align:justify">Giúp con yêu phát triển khỏe mạnh và thông minh ngay bây giờ:<a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"> https://poh.vn/khoa-thuc-hanh-thai-giao-poh/</a></p>\r\n\r\n<p style="text-align:justify">---</p>\r\n\r\n<p style="text-align:justify">Nguồn: <a href="https://www.babycenter.com/0_infections-that-can-affect-pregnancy_9223.bc">Babycenter</a></p>\r\n', '/assets/uploads/images/articles/57469185_2202120679834077_4764673475065413632_n.jpg', '/assets/uploads/images/thumb/57469185_2202120679834077_4764673475065413632_n_thumb.jpg', '2019-04-19 00:17:58', '', '', '', 1, NULL, 'post', NULL, '0000-00-00 00:00:00'),
(3, 3, '["2","3"]', 'Những bài tập thể dục tốt nhất cho thai kỳ', 'nhung-bai-tap-the-duc-tot-nhat-cho-thai-ky', '', '<h2 style="text-align: justify;"><span style="font-weight: 400;">Lợi ích của việc tập thể dục khi mang thai</span></h2>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Một điều cần biết là không chỉ tập thể dục tăng khả năng thụ thai mà nó còn đem đến những lợi ích tuyệt vời cho mẹ bầu nếu được áp dụng trong thai kỳ đó.</span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Tập luyện giúp mẹ bầu cải thiện tâm trạng, giấc ngủ và giảm đau nhức cơ thể. Ngoài ra tập luyện còn giúp mẹ chuẩn bị tốt cho việc sinh nở sắp tới bằng cách tăng cường cơ và sức bền, giúp cơ thể lấy lại vóc dáng dễ dàng hơn sau khi sinh em bé. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Nhiều nghiên cứu còn cho thấy tập thể dục trước khi sinh cũng có thể giảm đáng kể nguy cơ mắc bệnh <a href="https://poh.vn/me-bau-dieu-tri-tieu-duong-thai-ky-nhu-the-nao/">tiểu đường thai kỳ</a> và <a href="https://poh.vn/tien-san-giat-thai-ky_van-de-ma-me-bau-khong-the-bo-qua/">tiền sản giật</a>. Nếu được chẩn đoán mắc bệnh tiểu đường thai kỳ thì tập thể dục còn có thể giúp mẹ kiểm soát tình trạng bệnh và ngăn ngừa biến chứng.</span></p>\r\n&nbsp;\r\n\r\n<img class="aligncenter size-large wp-image-7748" src="https://poh.vn/wp-content/uploads/2019/03/tập-thể-dục-tăng-khả-năng-thụ-thai-1024x683.jpg" alt="" width="1024" height="683" />\r\n<p style="text-align: center;"><em>Bài tập thể dục cho bà bầu 3 tháng cuối.</em></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Tập thể dục là hoạt động vô cùng có lợi, thậm chí Hiệp hội phụ khoa Mỹ còn khuyến cáo tất cả những phụ nữ mang thai không biến chứng nên duy trì việc tập thể dục ít nhất 20-30 phút một ngày với cường độ vừa phải vào hầu hết hoặc tất cả các ngày trong tuần. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Tập luyện sẽ giúp tăng tuần hoàn máu đến tim, cơ thể dẻo dai, tăng cân hợp lý và đáp ứng nhu cầu thể chất khác trong quá trình sinh nở cũng như thời kỳ hậu sản mà không gây nguy hiểm lên cả bạn và thai nhi. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Mẹ nên hỏi ý kiến bác sĩ trước khi quyết định tham gia bất cứ loại hình thể dục nào. Nếu luôn duy trìn luyện tập, hãy chú ý lắng nghe cơ thể mình. Tuyệt đối không luyện tập quá sức, và phải dừng lại ngay nếu cảm thấy khó chịu hoặc đau đớn. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Và trước khi bắt đầu quá trình tập luyện, hãy tìm hiểu các quy tắc để bài tập mang thai của mẹ an toàn. Nhiều lớp thể dục cho bà bầu và trung tâm thể hình được thiết kế đặc biệt cho phụ nữ mang thai, tại đó có những hướng dẫn chuyên nghiệp giúp mẹ luyện tập một cách an toàn.</span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Những hoạt động dưới đây thường được coi là an toàn phụ nữ mang thai, tuy nhiên một trong số chúng là không phù hợp để luyện tập nếu ngày dự sinh của mẹ đến gần.</span></p>\r\n\r\n<blockquote><i><span style="font-weight: 400;">Mẹ bầu cần chú ý an toàn chính là yếu tố quan trọng nhất trong việc tập luyện của mẹ bầu, do đó mẹ nên lựa chọn cho mình những bộ môn dành riêng phù hợp cho bà bầu. Mẹ có thể tham khảo bài viết</span></i><a href="https://poh.vn/thai-giao-van-dong/"> <i><span style="font-weight: 400;">Thai giáo vận động</span></i></a><i><span style="font-weight: 400;"> của POH để biết chế độ tập luyện thích hợp nhất cho mình nhé!</span></i></blockquote>\r\n<h2 style="text-align: justify;"><span style="font-weight: 400;">Các hoạt động thể dục tốt cho hệ tim mạch</span></h2>\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Đi bộ</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Đây là một trong những bài tập tim mạch tốt nhất cho phụ nữ mang thai, chúng giúp mẹ khỏe mạnh mà không đến các hoạt động quì gối và gập mắt cá chân. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Hoạt động này rất dễ thực hiện, có thể làm ở bất cứ nơi nào, không yêu cầu bất kỳ thiết bị hỗ trợ nào ngoài một đôi giày phù hợp, và chúng hoàn toàn an toàn khi thực hiện trong suốt chín tháng của thai kỳ miễn sao bà bầu đi bộ đúng cách.</span></p>\r\n\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Bơi lội</span></h3>\r\n&nbsp;\r\n\r\n<img class="aligncenter size-full wp-image-4963" src="https://poh.vn/wp-content/uploads/2018/11/Mẹ-bầu-có-nên-đi-bơi-không.jpg" alt="Mẹ bầu có nên đi bơi không" width="1000" height="667" />\r\n<p style="text-align: center;"><em>Mang thai 3 tháng đầu có nên đi bơi?</em></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Các bác sĩ cũng cho rằng bơi lội là một trong những bài tập tốt và an toàn nhất cho phụ nữ mang thai. Bơi lội rất có ích là do chúng tập luyện các nhóm cơ lớn của cơ thể (cả hai tay và chân), làm lợi cho hệ tim mạch, giảm<a href="https://poh.vn/bi-quyet-cho-me-bau-bi-phu-ne-khi-mang-thai/"> phù nề</a>, và khiến mẹ có cảm giác cơ thể nhẹ nhàng hơn. Hoạt động này đặc biệt có lợi cho những phụ nữ bị đau vùng dưới lưng.</span></p>\r\n\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Thể dục nhịp điệu</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;"> Tập thể dục nhịp điệu giúp tăng cường sức khỏe trái tim của mẹ. Nếu đang tham gia một lớp học thể dục nhịp điệu cho phụ nữ mang thai, hãy trò chuyện tâm sự với những mẹ bầu khác và yên tâm rằng mỗi động tác bạn luyện tập đều an toàn cho cả bạn và thai nhi.</span></p>\r\n\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Nhảy</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Mẹ có thể giúp tăng tuần hoàn hệ tim mạch bằng cách nhún nhảy theo những giai điệu yêu thích của mình trong phòng khách tại nhà hoặc tham gia một lớp học nhảy theo nhóm. Tránh các động tác mạnh như nhảy lên cao hoặc xoay tròn.</span></p>\r\n\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Chạy bộ</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;"> Chạy bộ là một phương pháp tuyệt vời để tập luyện và tăng sức chịu đựng trong khi mang thai. Cường độ chạy của bạn phụ thuộc chủ yếu vào việc mẹ từng tham gia hoạt động này trước đó hay chưa. </span><span style="font-weight: 400;">Nếu là người mới bắt đầu, tốt nhất mẹ nên bắt đầu với tốc độ chậm và trên các đoạn đường ngắn trước khi dần dần tăng lên 30 phút chạy mỗi ngày.</span></p>\r\n\r\n<h2 style="text-align: justify;">Hoạt động giúp tăng tính linh hoạt và sự dẻo dai, độ bền cơ thể</h2>\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Yoga</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Các bài tập yoga cho bà bầu giúp duy trì cường độ các cơ và giữ cơ thể linh hoạt, thậm chí còn tác động lên các khớp. Tuy nhiên để đạt hiệu quả hơn, mẹ có thể kết hợp đi bộ hoặc bơi lội vài lần trong tuần.</span></p>\r\n\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Kéo giãn</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Bài tập kéo giãn là một phương pháp tuyệt vời để giữ cho cơ thể dẻo dai và thư giãn, cũng như ngăn ngừa căng cứng các cơ. Bổ sung bài tập kéo giãn ngoài các bài tập về tim mạch sẽ giúp mẹ có một chế độ thể dục hoàn thiện hơn.</span></p>\r\n\r\n<h3 style="text-align: justify;"><span style="font-weight: 400;">Tập luyện sử dụng trọng lượng cơ thể</span></h3>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Miễn là mẹ có các biện pháp phòng ngừa cần thiết và sử dụng đúng kỹ thuật (luyện tập chậm, kiểm soát sự chuyển động), thì phương pháp tập luyện sử dụng trọng lượng cơ thể là một cách tuyệt vời để luyện tập và tăng cường độ bền các cơ. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Lợi ích có được từ việc tập luyện thể dục trong quá trình mang thai sẽ giúp mẹ có sự chuẩn bị tốt nhất cho việc sinh nở sắp tới. </span></p>\r\n\r\n<h2 style="text-align: justify;"><b>Để thai kỳ là quãng thời gian hạnh phúc của mẹ bầu</b></h2>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Các nhà khoa học cho thấy, bên cạnh việc bổ sung đầy đủ chất dinh dưỡng thiết yếu để mẹ bầu khỏe mạnh, con yêu phát triển thể chất, cân nặng và não bộ tốt trong thai kỳ, ba mẹ còn nên thực hành thai giáo để mẹ bầu tận hưởng thai kỳ tuyệt vời nhất cũng như tối ưu sự phát triển não bộ và đánh thức các giác quan của con phát triển vượt trội.</span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Do đó, POH xây dựng khóa thực hành thai giáo online_</span><a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"><span style="font-weight: 400;">Thai giáo 280 ngày yêu thương</span></a><span style="font-weight: 400;">. Điểm đặc biệt trong chương trình của POH là mẹ sẽ cung cấp ngày dự sinh của con, phần mềm sẽ tính được hôm nay bạn bé đang ở ngày thứ bao nhiêu của thai kỳ. </span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Từ đó đưa ra bài thực hành phù hợp với sự phát triển của con trong ngày hôm nay, giúp kích thích tốt nhất sự phát triển của con yêu.</span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Thai giáo còn là cơ hội để người chồng thể hiện tình yêu thương với mẹ bầu và con yêu để tình cảm gia đình thêm gắn kết cũng như sợi dây kết nối ba mẹ và con yêu được bền chặt hơn. Do đó,</span><a href="https://poh.vn/thai-giao/"><span style="font-weight: 400;"> các ông bố hãy cùng vợ thực hành thai giáo cho con yêu</span></a><span style="font-weight: 400;"> mỗi ngày để người vợ cảm thấy mình được yêu thương và quan tâm nhé!</span></p>\r\n<p style="text-align: justify;"><span style="font-weight: 400;">Giúp con yêu phát triển khỏe mạnh và thông minh ngay bây giờ:</span><a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"> <span style="font-weight: 400;">https://poh.vn/khoa-thuc-hanh-thai-giao-poh/</span></a></p>\r\n<p style="text-align: justify;">---</p>\r\n<p style="text-align: justify;">Nguồn: <a href="https://www.babycenter.com/0_the-best-kinds-of-exercise-for-pregnancy_7880.bc">Babycenter</a></p>', '/assets/uploads/images/articles/ballantines-1.jpg', '/assets/uploads/images/thumb/ballantines-1_thumb.jpg', '2019-04-19 00:21:54', '', '', '', 1, NULL, 'post', NULL, '0000-00-00 00:00:00'),
(4, 4, '["1","2"]', 'Uống rượu trong thai kỳ', 'uong-ruou-trong-thai-ky', '', '<h2 style="text-align: justify;"><span style="font-weight: 400;">Bao nhiêu rượu là có thể gây hại trong thai kỳ</span><span style="font-weight: 400;">?</span></h2><p style="text-align: justify;"><span style="font-weight: 400;">Rượu và thai kỳ không thể tồn tại cùng nhau. Không ai biết chính xác những nguy cơ tiềm ẩn có thể gây hại cho bé mà rượu mang lại, ngay cả với một lượng rất nhỏ. </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Các chuyên gia tại Hiệp hội sản phụ khoa Mỹ, Viện Hàn lâm Nhi khoa Mỹ cũng như các cơ quan y tế công cộng khác ở Hoa Kỳ khuyến cáo phụ nữ mang thai (và phụ nữ đang muốn thụ thai) không nên uống rượu để đảm bảo an toàn.</span></p>&nbsp;<img class="aligncenter size-large wp-image-7731" src="https://poh.vn/wp-content/uploads/2019/03/Trót-uống-rượu-khi-mang-thai-1-1024x538.jpg" alt="Rượu gây dị tật bẩm sinh ở thai nhi" width="1024" height="538" /><p style="text-align: center;"><em>Rượu gây dị tật bẩm sinh ở thai nhi.</em></p><p style="text-align: justify;"><span style="font-weight: 400;">Trong những năm gần đây, một số nghiên cứu đã phát hiện ra rằng nếu trót uống rượu khi mang thai ở mức thấp hoặc trung bình có thể sẽ không gây hại đáng kể cho trẻ em. </span><span style="font-weight: 400;">Ví dụ, vào năm 2012, các nhà nghiên cứu Đan Mạch công bố rộng rãi các nghiên khẳng định không có vấn đề gì lớn đối với các bé dưới 5 tuổi có mẹ uống rượu từ 1 đến 8 lần mỗi tuần.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Mặc dù có những nghiên cứu kể trên nhưng các chuyên gia vẫn khuyến cáo phụ nữ mang thai nên kiêng uống rượu hoàn toàn. Vì sao? Bởi vì không có lượng rượu "an toàn" nào được khuyến khích trong thai kỳ. Mẹ không thể lường trước được những biến chứng nguy hiểm cho thai nhi nếu uống nhiều rượu bia khi mang thai đâu.</span></p><h2 style="text-align: justify;"><span style="font-weight: 400;">Rượu gây hại như thế nào cho thai nhi?</span></h2><p style="text-align: justify;"><span style="font-weight: 400;">Khi người mẹ uống rượu, rượu sẽ nhanh chóng đi vào máu, qua nhau thai và truyền đến em bé trong bụng. Tốc độ phân giải rượu của thai nhi thấp hơn của mẹ rất nhiều, do vậy nồng độ rượu trong máu của bé sẽ cao hơn. </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Uống rượu có thể gây nguy hiểm cho thai nhi bằng nhiều cách: Nó làm tăng nguy cơ <a href="https://poh.vn/nhung-thong-tin-ve-say-thai-ma-me-bau-nen-luu-y/">sảy thai</a> và thai chết lưu. Uống mỗi ngày một chút rượu thôi cũng có thể làm tăng tỷ lệ sảy thai hoặc sinh con có cân nặng thấp, đồng thời khiến trẻ có nhiều nguy cơ mắc các vấn đề về học tập, sự tập trung, ngôn ngữ và trở nên tăng động.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Một số nghiên cứu đã chỉ ra rằng các bà mẹ uống rượu mỗi ngày có <a href="https://poh.vn/me-bau-sinh-non-lieu-co-nguy-hiem/">nguy cơ sinh con</a> có các biểu hiện hành vi hung hăng và hiếu chiến hơn so với những bà mẹ sinh con mà không uống rượu. Một nghiên cứu khác còn cho thấy các bé gái được sinh ra từ người mẹ uống rượu trong thai kỳ thì có nhiều khả năng bị các vấn đề về tâm lý hơn.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">"Rối loạn thai nhi do uống rượu" (FASD) là thuật ngữ chuyên được sử dụng để mô các trường hợp liên quan đến phơi nhiễm rượu trước khi sinh.</span></p>&nbsp;<img class="aligncenter size-large wp-image-7687" src="https://poh.vn/wp-content/uploads/2019/03/Uống-rượu-vừa-phải-không-ảnh-hưởng-đến-khả-năng-sinh-con-của-phụ-nữ-1-1024x768.jpg" alt="" width="1024" height="768" /><p style="text-align: center;"><em>Uống rượu khi mang thai 3 tháng đầu đặc biệt nguy hiểm cho thai nhi.</em></p><p style="text-align: justify;"><span style="font-weight: 400;">Hậu quả nghiêm trọng nhất của việc sử dụng rượu trong thai kỳ là hội chứng thai nhi nghiện rượu (FASD), một bệnh trạng suốt đời gây ra bởi sự phát triển kém (ngay từ trong tử cung, sau khi sinh, hoặc cả hai), các đặc điểm trên khuôn mặt bất thường, dị tật tim và tổn thương hệ thần kinh trung ương.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Những em bé bị mắc hội chứng thai nhi nghiện rượu FASD cũng có thể có đầu và não nhỏ bất thường, các khuyết tật bẩm sinh khác, đặc biệt là tim và cột sống. </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Các ảnh hưởng nghiêm trọng đến hệ thống thần kinh trung ương có thể bao gồm khuyết tật trí não, chậm phát triển thể chất, thị lực và thính giác kém, và một loạt các vấn đề về hành vi.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Uống nhiều rượu (uống từ tám ly rượu trở lên mỗi tuần, hoặc nhiều hơn ba cốc trong một lần uống) sẽ làm tăng nguy cơ con mắc hội chứng FASD. Ngay cả trẻ sơ sinh được sinh ra bởi những mẹ bầu uống ít hơn lượng kể trên cũng có thể mắc FASD, hoặc xuất hiện một số vấn đề về tinh thần, thể chất hoặc hành vi.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Theo Trung tâm kiểm soát dịch bệnh Hoa Kỳ (CDC), việc uống rượu trong thời gian mang thai chính là một trong những nguyên nhân chính gây dị tật bẩm sinh và các vấn đề khác ở thai nhi tại quốc gia này. </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Theo một báo cáo gần đây của CDC, 10% phụ nữ mang thai ở Hoa Kỳ đã uống rượu trong 30 ngày gần nhất. Trong số những phụ nữ này, một phần ba họ thuộc trường hợp uống rất nhiều rượu.</span></p><h2 style="text-align: justify;"><span style="font-weight: 400;">Bia và rượu không cồn có nguy hiểm không?</span></h2><p style="text-align: justify;"><span style="font-weight: 400;">Thuật ngữ "không cồn" sẽ dễ gây hiểu lầm khi nói về bia và rượu vang. Đồ uống có nhãn "không cồn" vẫn có thể chứa một lượng chất cồn nhất định (trong khi những đồ có nhãn "không chứa cồn" nên là loại đồ uống hoàn toàn không chứa cồn). </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Tất cả các loại bia không cồn và các loại rượu vang không chứa cồn thực chất đều có chứa lượng cồn nhất định, thường ít hơn khoảng 50% thành phần. (Ví dụ, một loại bia thông thường chỉ có chứa khoảng 5% cồn.)</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Tuy nhiên, các nhà nghiên cứu đã phát hiện ra rằng một số loại đồ uống có chứa lượng cồn lớn hơn rất nhiều so với lượng niêm yết trên nhãn, thậm chí một số nhãn còn ghi "không chứa cồn".</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Mặc dù rất ít người cho rằng lượng cồn trong một cốc bia có thể gây hại cho bé, nhưng mẹ bầu cần ghi nhớ rằng nếu uống những loại đồ uống này thường xuyên hoặc với số lượng lớn, chúng sẽ ảnh hưởng rất nhiều đến bé. </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Để loại bỏ tất cả các nguy cơ phơi nhiễm rượu, các chuyên gia khuyến cáo rằng các bà mẹ tương lai nên hoàn toàn tránh sử dụng loại đồ uống này.</span></p><h2 style="text-align: justify;"><b>Để thai kỳ là quãng thời gian hạnh phúc của mẹ bầu</b></h2><p style="text-align: justify;"><span style="font-weight: 400;">Các nhà khoa học cho thấy, bên cạnh việc bổ sung đầy đủ chất dinh dưỡng thiết yếu để mẹ bầu khỏe mạnh, con yêu phát triển thể chất, cân nặng và não bộ tốt trong thai kỳ, ba mẹ còn nên thực hành thai giáo để mẹ bầu tận hưởng thai kỳ tuyệt vời nhất cũng như tối ưu sự phát triển não bộ và đánh thức các giác quan của con phát triển vượt trội.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Do đó, POH xây dựng khóa thực hành thai giáo online_</span><a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"><span style="font-weight: 400;">Thai giáo 280 ngày yêu thương</span></a><span style="font-weight: 400;">. Điểm đặc biệt trong chương trình của POH là mẹ sẽ cung cấp ngày dự sinh của con, phần mềm sẽ tính được hôm nay bạn bé đang ở ngày thứ bao nhiêu của thai kỳ. </span></p><p style="text-align: justify;"><span style="font-weight: 400;">Từ đó đưa ra bài thực hành phù hợp với sự phát triển của con trong ngày hôm nay, giúp kích thích tốt nhất sự phát triển của con yêu.</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Thai giáo còn là cơ hội để người chồng thể hiện tình yêu thương với mẹ bầu và con yêu để tình cảm gia đình thêm gắn kết cũng như sợi dây kết nối ba mẹ và con yêu được bền chặt hơn. Do đó,</span><a href="https://poh.vn/thai-giao/"><span style="font-weight: 400;"> các ông bố hãy cùng vợ thực hành thai giáo cho con yêu</span></a><span style="font-weight: 400;"> mỗi ngày để người vợ cảm thấy mình được yêu thương và quan tâm nhé!</span></p><p style="text-align: justify;"><span style="font-weight: 400;">Giúp con yêu phát triển khỏe mạnh và thông minh ngay bây giờ:</span><a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"> <span style="font-weight: 400;">https://poh.vn/khoa-thuc-hanh-thai-giao-poh/</span></a></p>---Nguồn: <a href="https://www.babycenter.com/0_drinking-alcohol-during-pregnancy_3542.bc">Babycenter</a>', '/assets/uploads/images/articles/ballantines-banner.jpg', '/assets/uploads/images/thumb/ballantines-banner_thumb.jpg', '2019-04-19 00:22:20', '', '', '', 1, NULL, 'post', NULL, '0000-00-00 00:00:00');
INSERT INTO `news` (`id`, `order`, `categoryid`, `title`, `alias`, `description`, `content`, `image`, `thumb`, `create_time`, `meta_title`, `meta_description`, `meta_keywords`, `author_id`, `count_view`, `type`, `language`, `original_date`) VALUES
(5, 5, '["2","3"]', 'Làm việc trong quá trình mang thai', 'lam-viec-trong-qua-trinh-mang-thai', '', '<p>&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Bạn có thể làm việc trong suốt thai kỳ của mình không?&lt;/span&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Có bầu đi làm được không? Nếu là một người phụ nữ khỏe mạnh, có thai bình thường và công việc của mẹ không yêu cầu tiếp xúc nhiều với hóa chất độc hại, mẹ có thể tiếp tục làm việc cho đến ngày sinh - hoặc gần sát ngày sinh. Mẹ có thể sẽ dễ cảm thấy mệt mỏi hơn vào cuối thai kỳ, do vậy hãy thả lỏng nhất nếu có thể.&lt;/span&gt;&lt;/p&gt;&amp;nbsp;&lt;img class="aligncenter size-large wp-image-7724" src="https://poh.vn/wp-content/uploads/2019/03/Mẹ-cần-có-chế-độ-nghỉ-ngơi-khi-mang-thai-phù-hợp-1024x634.jpg" alt="Mẹ cần có chế độ nghỉ ngơi khi mang thai phù hợp" width="1024" height="634" /&gt;&lt;p style="text-align: center;"&gt;&lt;em&gt;Mẹ cần có chế độ nghỉ ngơi khi mang thai phù hợp.&lt;/em&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Và luôn để cơ thể mình nghỉ ngơi đủ. Nếu có thể bắt đầu nghỉ thai sản một hoặc hai tuần trước ngày sinh dự tính, hãy cân nhắc sử dụng khoảng thời gian đó để nghỉ ngơi, chuẩn bị và thư giãn bản thân một chút. Đây có thể sẽ là cơ hội cuối cùng để mẹ được làm việc này.&lt;/span&gt;&lt;/p&gt;&lt;h2 style="text-align: justify;"&gt;Giữ hình ảnh chuyên nghiệp khi làm việc trong thai kỳ&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Điều này giúp mẹ đánh giá xem việc mang thai ảnh hưởng bao nhiêu đến công việc đang làm. Trong ba tháng đầu và cuối thai kỳ , thông thường mẹ sẽ thấy mệt mỏi, khó chịu và đầu óc trống rỗng. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Tuy nhiên ở ba tháng thứ hai của thai kỳ, mẹ lại luôn cảm thấy khỏe khoắn và tràn đầy năng lượng. Mặc dù hiện tượng mệt mỏi và đãng trí là bình thường, mẹ vẫn nên tâm sự chuyện mang thai với một người bạn đáng tin cậy tại nơi làm việc để nhận được sự giúp đỡ.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Mặc dù mọi người có thể quan sát thấy mẹ mang thai nhưng đây vẫn là vấn đề mang tính riêng tư. Hãy hạn chế phàn nàn hoặc nói về việc mang thai của mình quá nhiều, đặc biệt là nếu cấp trên hoặc đồng nghiệp không mấy quan tâm tới vấn đề này.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Mẹ có thể có vài khoảnh khắc riêng tư trong ngày, để mơ mộng, lo lắng, lẩm bẩm, thậm chí là suy nghĩ về việc mang thai của mình. Tuy nhiên hãy thận trọng nếu ở xung quanh đang có rất nhiều đồng nghiệp.&lt;/span&gt;&lt;/p&gt;&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Làm thế nào để giảm bớt nôn nghén tại nơi làm việc?&lt;/span&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Hầu hết phụ nữ đều cảm thấy &lt;a href="https://poh.vn/thuoc-chua-om-nghen-nao-an-toan-trong-thai-ky/"&gt;buồn nôn hoặc nôn mửa&lt;/a&gt; tại một số thời điểm trong thai kỳ, và rất có thể điều đó sẽ xảy ra tại nơi mẹ đang làm việc. Hãy nói chuyện với bác sĩ để tìm ra phương pháp giảm bớt hiện tượng này hiệu quả nhé.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu thường xuyên cảm thấy buồn nôn, hãy chuẩn bị sẵn túi nhựa, khăn tắm và nước súc miệng trong ngăn bàn làm việc hoặc xe hơi, và nhanh chóng di chuyển vào phòng vệ sinh nếu có thể. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;(Nếu mẹ chưa sẵn sàng nói với sếp hoặc đồng nghiệp của mình về việc mang thai, hãy chuẩn bị sẵn một lời giải thích thuyết phục trong trường hợp ai đó bắt gặp mẹ nôn mửa nhé.)&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu hiện tượng ốm nghén kéo dài và nghiêm trọng (buồn nôn liên tục hoặc nôn mửa thường xuyên) thì mẹ nên thông báo với sếp của mình về việc đang mang thai sớm hơn dự kiến. Điều này rất quan trọng bởi nếu không giải thích rõ ràng thì người khác sẽ dễ cảm thấy bạn đang không muốn làm hoặc không thể làm việc vậy. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Trước khi quyết định nói ra, mẹ nên xác định rõ thứ cần là gì: Sự cảm thông? Thời gian nghỉ ngơi? Hay một lịch trình làm việc linh hoạt cho đến khi vượt qua giai đoạn tồi tệ nhất? &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Và sẵn sàng cam đoan rằng mẹ có thể tiếp tục hoàn thành tốt công việc của mình. Cuối cùng, hãy đảm bảo với sếp rằng hiện tượng ốm nghén này sẽ biến mất sau ba tháng đầu mang thai. &lt;/span&gt;&lt;/p&gt;&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Làm thế nào tôi có thể thoải mái trong công việc?&lt;/span&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Ngay cả khi công việc không yêu cầu đứng quá lâu hoặc chẳng có gì vất vả ngoài việc trả lời điện thoại, hãy luôn cố gắng chăm sóc bản thân tốt nhất có thể trong quá trình mang thai. Dưới đây là một số mẹo nhỏ mẹ có thể áp dụng:&lt;/span&gt;&lt;/p&gt;&lt;ul style="text-align: justify;"&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Nghỉ giải lao: Nếu phải đứng làm việc, hãy nhấc chân lên hoặc đi bộ xung quanh. Đứng nhiều là điều &nbsp;bà bầu cần tránh khi mang thai. Do đó, mẹ nên di chuyển các cơ để giúp đẩy chất lỏng ra khỏi chân và bàn chân, hạn chế hiện tượng phù nề.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Di chuyển liên tục. Đứng dậy và đi bộ xung quanh hai tiếng một lần. Điều này sẽ giúp giảm&lt;a href="https://poh.vn/bi-quyet-cho-me-bau-bi-phu-ne-khi-mang-thai/"&gt; phù nề&lt;/a&gt; ở bàn chân và mắt cá chân, đồng thời giúp mẹ cảm thấy thoải mái hơn. Khi quá trình mang thai tiến triển, làm một vài bài tập kéo giãn có thể giúp bảo vệ lưng của mẹ.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Ăn mặc thoải mái: Mang giày vừa chân và mặc quần áo rộng. Mẹ cũng có thể thử mặc quần dành riêng cho thai sản hoặc đai hỗ trợ để ngăn ngừa hoặc giảm bớt hiện tượng &lt;a href="https://poh.vn/gian-tinh-mach-khi-mang-thai/"&gt;giãn tĩnh mạch&lt;/a&gt;.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;&lt;a href="https://poh.vn/me-bau-nen-uong-bao-nhieu-nuoc-khi-mang-thai/"&gt;Uống thật nhiều nước&lt;/a&gt;. Luôn dự trữ nước tại bàn làm việc hoặc khu vực làm việc và đi lấy nước thường xuyên. Điều này cũng sẽ cho mẹ cơ hội nghỉ ngơi và đi bộ quanh khu vực làm việc.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Đừng bỏ bữa. Ăn các bữa chính và bữa ăn nhẹ thường xuyên để giảm bớt hiện tượng ốm nghén và giảm lượng đường trong máu. Thưởng thức bữa ăn lành mạnh và bổ dưỡng bất cứ khi nào có thể. Thêm chất xơ vào chế độ ăn uống của mẹ để giảm &lt;a href="https://poh.vn/me-bau-bi-tao-bon-dieu-tri-the-nao/"&gt;táo bón&lt;/a&gt;.&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&amp;nbsp;&lt;img class="aligncenter size-large wp-image-7723" src="https://poh.vn/wp-content/uploads/2019/03/Làm-việc-nhiều-khi-mang-thai-có-thể-khiến-mẹ-mệt-mỏi-1024x638.jpg" alt="Làm việc nhiều khi mang thai có thể khiến mẹ mệt mỏi" width="1024" height="638" /&gt;&lt;p style="text-align: center;"&gt;&lt;em&gt;Làm việc nhiều khi mang thai có thể khiến mẹ mệt mỏi.&lt;/em&gt;&lt;/p&gt;&lt;ul style="text-align: justify;"&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Giảm căng thẳng. Nếu không thể loại bỏ triệt để yếu tố căng thẳng tại nơi làm việc của mình, hãy cố gắng tìm cách giảm bớt nó, chẳng hạn như bằng cách duỗi người, tập hít thở sâu hoặc tập yoga, hoặc chỉ đơn giản là đi bộ một quãng ngắn.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Nghỉ ngơi khi có thể. Công việc của mẹ càng căng thẳng và vất vả, mẹ càng cần nghỉ ngơi thật nhiều, tránh hoạt động mạnh sau khi làm việc.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Xin nghỉ nếu cảm thấy cần thiết. Nếu cảm thấy vô cùng mệt mỏi, hãy xin nghỉ ốm một ngày. Hoặc tận dụng các ngày nghỉ được phép để rút ngắn thời gian làm việc lại. Nếu mẹ quá mệt mỏi, không thể tập trung làm việc, hãy tận dụng giờ nghỉ ngắn để tìm một nơi yên tĩnh hoặc ngồi trong xe khoảng 15 phút để nghỉ ngơi.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Đừng làm quá sức. Từ chối đề nghị làm thêm giờ, đặc biệt nếu bạn cảm thấy kiệt sức hoặc nếu công việc của bạn đòi hỏi hoạt động thể chất quá nhiều.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Đón nhận sự trợ giúp. Nếu đồng nghiệp muốn xem em bé một chút và mẹ không cảm thấy phiền, hãy để họ tự nhiên. Hãy xem đây là một may mắn khi được làm việc tại nơi có nhiều sự quan tâm. Mang thai là một khoảng thời gian đặc biệt và hiếm hoi trong cuộc sống, do vậy mẹ không cần cố giả vờ rằng mình vẫn hoàn toàn bình thường trong quá trình làm việc. &lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Bạn có nên hỏi những đồng nghiệp từng mang thai trước đó? &lt;/span&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu may mắn được làm việc tại nơi có những phụ nữ mang thai hoặc từng mang thai, hãy xin kinh nghiệm mang thai lần đầu cũng như sự giúp đỡ&lt;/span&gt;&lt;span style="font-weight: 400;"&gt; của họ tại những thời điểm thích hợp. Một số vấn đề mẹ có thể xin lời khuyên từ những đồng nghiệp có kinh nghiệm hơn như:&lt;/span&gt;&lt;/p&gt;&lt;ul style="text-align: justify;"&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Kỳ nghỉ thai sản diễn ra như thế nào?&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Sếp và những đồng nghiệp khác sẽ có phản ứng như thế nào khi biết mẹ mang thai?&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Làm thế nào để duy trì hiệu xuất làm việc trong ba tháng cuối thai kỳ mệt mỏi? &lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Làm thế nào để kiểm soát sự đãng trí?&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Có nhóm hoặc tổ chức nào hỗ trợ cho việc làm cha mẹ không? &lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Có phương pháp hiệu quả nào để cân bằng giữa công việc và gia đình không?&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;Làm thế nào để xây dựng một thời gian biểu linh hoạt?&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Khi trở lại với công việc sau khi sinh, các mối quan hệ mẹ đang cố xây dựng lúc này sẽ trở nên gắn kết hơn sau khi mẹ qua thời kỳ mang thai và trở thành một phụ huynh thực sự.&lt;/span&gt;&lt;/p&gt;&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Biến chứng thai kỳ có đồng nghĩa với việc phải nghỉ làm?&lt;/span&gt;&lt;/h2&gt;&amp;nbsp;&lt;img class="aligncenter size-large wp-image-7722" src="https://poh.vn/wp-content/uploads/2019/03/Nếu-mắc-các-bệnh-nguy-hiểm-khi-mang-thai-mẹ-bầu-nên-nghỉ-làm-1-1024x683.jpg" alt="Nếu mắc các bệnh nguy hiểm khi mang thai, mẹ bầu nên nghỉ làm" width="1024" height="683" /&gt;&lt;p style="text-align: center;"&gt;&lt;em&gt;Nếu mắc các bệnh nguy hiểm khi mang thai, mẹ bầu nên nghỉ làm &lt;/em&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Mẹ có thể sẽ phải ngừng làm việc hoặc giảm số giờ làm trong thai kỳ nếu:&lt;/span&gt;&lt;/p&gt;&lt;ul style="text-align: justify;"&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;có nguy cơ &lt;a href="https://poh.vn/me-bau-sinh-non-lieu-co-nguy-hiem/"&gt;sinh non&lt;/a&gt; cao. Điều này thường xảy ra đối với những phụ nữ mang thai đôi hoặc nhiều hơn. &lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;bị &lt;a href="https://poh.vn/huyet-ap-cao-khi-mang-thai-va-nhung-bien-chung-nguy-hiem/"&gt;huyết áp cao&lt;/a&gt; hoặc có nguy cơ bị &lt;a href="https://poh.vn/tien-san-giat-thai-ky_van-de-ma-me-bau-khong-the-bo-qua/"&gt;tiền sản giật&lt;/a&gt;.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;được chẩn đoán mắc nhau tiền đạo.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;bị suy giảm cổ tử cung hoặc có tiền sử sảy thai.&lt;/span&gt;&lt;/li&gt; &nbsp;&nbsp; &nbsp;&lt;li style="font-weight: 400;"&gt;&lt;span style="font-weight: 400;"&gt;thai nhi phát triển không tốt&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu công việc quá vất vả?&lt;/span&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu đang làm việc trong một số ngành nghề nhất định, mẹ có thể sẽ cần phải cân nhắc để thay đổi trong khi mang thai. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Một số nghiên cứu chỉ ra rằng những phụ nữ phải làm việc vất vả trong quá trình mang thai: bao gồm mang vác nặng, đứng trong thời gian dài, giờ làm không đều hoặc làm quá nhiều, có nguy cơ sinh non, sinh con nhẹ cân và mắc bệnh cao huyết áp trong quá trình mang thai.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Hãy nói qua với bác sĩ về công việc đang làm để nhận được lời khuyên phù hợp với tình trạng của mẹ. Nếu đang làm một công việc vất vả, mẹ sẽ phải đưa ra quyết định phù hợp để bảo vệ thai kỳ của mình an toàn nhất.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu công việc của mẹ yêu cầu phải đứng trong thời gian dài, hãy ngồi xuống nghỉ ngơi ngay khi có cơ hội. Và trong lúc đứng, hãy tranh thủ đi bộ loanh quoanh hoặc duỗi người để giúp máu lưu thông tốt hơn.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu có thể, hãy cố gắng chuyển sang những loại công việc đòi hỏi ít thể lực hơn. Ví dụ, có thể đổi việc với một đồng nghiệp để được ngồi bàn thay vì phải di chuyển quá nhiều. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nếu không có lựa chọn khác, hãy cố gắng tận dụng các ngày nghỉ hoặc ngày phép để giảm mệt mỏi, đồng thời giảm số giờ phải làm việc hoặc đứng (đặc biệt là vào tam cá nguyệt thứ hai và cuối).&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nhiều phụ nữ cố gắng tiết kiệm những ngày nghỉ ốm và nghỉ lễ để dành cho việc nghỉ thai sản, tuy nhiên mẹ nên cố gắng cân bằng chúng để luôn duy trì sức khỏe ổn định và cơ thể khỏe mạnh ngay cả trước khi mang thai. &lt;/span&gt;&lt;/p&gt;&lt;h2 style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Nên làm gì nếu phải làm việc trong các môi trường độc hại?&lt;/span&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Hỏi ý kiến bác sĩ: Nếu đang làm việc tại nơi phải tiếp xúc với các hóa chất nguy hiểm đối với thai kỳ: như kim loại nặng (như chì và thủy ngân), dung môi hữu cơ hoặc hóa chất độc hại khác, các tác nhân sinh học hoặc phóng xạ… thì sẽ cần thay đổi môi trường làm việc của mình.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Các hóa chất ảnh hưởng đến thai nhi rất nghiêm trọng như có thể gây quái thai, nghĩa là gây ra các vấn đề như &lt;a href="https://poh.vn/nhung-luu-y-de-tranh-say-thai/"&gt;sảy thai&lt;/a&gt;, sinh non, dị tật bẩm sinh, phát triển chậm hoặc thai nhi bất thường nếu thường xuyên phải tiếp xúc với chúng trong khi mang thai, thậm chí là trước đó. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Những mối nguy hiểm này thường có trong các nhà máy sản xuất chip máy tính, nhà máy giặt, nhà máy cao su, phòng mổ, phòng rửa ảnh, tiệm làm móng, xưởng làm gốm, nhà máy đóng tàu và máy in.&lt;/span&gt;&lt;/p&gt;&lt;h2 style="text-align: justify;"&gt;&lt;b&gt;Để thai kỳ là quãng thời gian hạnh phúc của mẹ bầu&lt;/b&gt;&lt;/h2&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Các nhà khoa học cho thấy, bên cạnh việc bổ sung đầy đủ chất dinh dưỡng thiết yếu để mẹ bầu khỏe mạnh, con yêu phát triển thể chất, cân nặng và não bộ tốt trong thai kỳ, ba mẹ còn nên thực hành thai giáo để mẹ bầu tận hưởng thai kỳ tuyệt vời nhất cũng như tối ưu sự phát triển não bộ và đánh thức các giác quan của con phát triển vượt trội.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Do đó, POH xây dựng khóa thực hành thai giáo online_&lt;/span&gt;&lt;a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"&gt;&lt;span style="font-weight: 400;"&gt;Thai giáo 280 ngày yêu thương&lt;/span&gt;&lt;/a&gt;&lt;span style="font-weight: 400;"&gt;. Điểm đặc biệt trong chương trình của POH là mẹ sẽ cung cấp ngày dự sinh của con, phần mềm sẽ tính được hôm nay bạn bé đang ở ngày thứ bao nhiêu của thai kỳ. &lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Từ đó đưa ra bài thực hành phù hợp với sự phát triển của con trong ngày hôm nay, giúp kích thích tốt nhất sự phát triển của con yêu.&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Thai giáo còn là cơ hội để người chồng thể hiện tình yêu thương với mẹ bầu và con yêu để tình cảm gia đình thêm gắn kết cũng như sợi dây kết nối ba mẹ và con yêu được bền chặt hơn. Do đó,&lt;/span&gt;&lt;a href="https://poh.vn/thai-giao/"&gt;&lt;span style="font-weight: 400;"&gt; các ông bố hãy cùng vợ thực hành thai giáo cho con yêu&lt;/span&gt;&lt;/a&gt;&lt;span style="font-weight: 400;"&gt; mỗi ngày để người vợ cảm thấy mình được yêu thương và quan tâm nhé!&lt;/span&gt;&lt;/p&gt;&lt;p style="text-align: justify;"&gt;&lt;span style="font-weight: 400;"&gt;Giúp con yêu phát triển khỏe mạnh và thông minh ngay bây giờ:&lt;/span&gt;&lt;a href="https://poh.vn/khoa-thuc-hanh-thai-giao-poh/"&gt; &lt;span style="font-weight: 400;"&gt;https://poh.vn/khoa-thuc-hanh-thai-giao-poh/&lt;/span&gt;&lt;/a&gt;&lt;/p&gt;---Nguồn: &lt;a href="https://www.babycenter.com/0_being-pregnant-at-work_490.bc"&gt;Babycenter&lt;/a&gt;</p>\r\n', '/assets/uploads/images/articles/ballantines-2.jpg', '/assets/uploads/images/thumb/ballantines-2_thumb.jpg', '2019-04-19 00:22:48', '', '', '', 1, NULL, 'post', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `featured_news_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `language` enum('vietnamese','english') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vietnamese',
  `banner_top_display` text COLLATE utf8_unicode_ci,
  `banner_bottom_display` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `title`, `alias`, `parent_id`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `featured_news_id`, `language`, `banner_top_display`, `banner_bottom_display`) VALUES
(1, 'Quần áo trẻ em', 'quan-ao-tre-em', 0, '', '', '', '', '', 'vietnamese', '', ''),
(2, 'Thai giáo', 'thai-giao', 0, '', '', '', '', '', 'vietnamese', '', ''),
(3, 'Khóa học bầu', 'khoa-hoc-bau', 2, '', '', '', '', '', 'vietnamese', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `news_order`
--

CREATE TABLE IF NOT EXISTS `news_order` (
`id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `news_array` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news_order`
--

INSERT INTO `news_order` (`id`, `categoryid`, `news_array`) VALUES
(1, 4, '["0"]'),
(2, 2, '["0"]'),
(3, 3, '["0"]');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('text','ckeditor','file') COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `type`, `value`, `description`) VALUES
(1, 'home_logo', 'file', 'assets/img/POH_Official_Logo.png', 'Logo trên navigation website'),
(2, 'home_themes_info', 'ckeditor', '<h1 style="text-align:center"><span style="font-size:36px"><span style="color:rgb(178, 34, 34)"><strong>Du xu&acirc;n B&iacute;nh Th&acirc;n 2016 - cảm x&uacute;c mới </strong></span></span></h1>\n\n<hr />\n<div class="des center" style="text-align: center;">\n<p style="text-align:justify"><span style="font-size:20px">Năm mới, đặt ch&acirc;n l&ecirc;n một v&ugrave;ng đất mới, h&iacute;t h&agrave; kh&ocirc;ng kh&iacute; xu&acirc;n trong l&agrave;nh quả l&agrave; một sự khởi đầu th&uacute; vị v&agrave; thật phong c&aacute;ch. N&oacute; gi&uacute;p bạn nạp đầy năng lượng với những niềm vui v&agrave; sự thoải m&aacute;i, hứa hẹn một năm mới may mắn hạnh ph&uacute;c đang ch&agrave;o đ&oacute;n. AsiaTravel thiết kế ch&ugrave;m Tour &ldquo;<em>Du xu&acirc;n B&iacute;nh Th&acirc;n 2016</em>&rdquo;, để bạn được đặt ch&acirc;n đến th&agrave;nh phố đ&aacute;ng sống nhất Việt Nam v&agrave; cầu mong một năm mới tốt l&agrave;nh tại Linh Ứng Tự nổi tiếng linh thi&ecirc;ng. Hoặc kh&aacute;m ph&aacute; m&ugrave;a xu&acirc;n tr&ecirc;n dẻo cao ph&iacute;a Bắc Việt Nam, chi&ecirc;m ngưỡng bạt ng&agrave;n hoa mận nở trắng đất trời v&agrave; n&ocirc; đ&ugrave;a c&ugrave;ng lũ trẻ m&aacute; ửng h&acirc;y h&acirc;y với Tour &ldquo;Mộc Ch&acirc;u &ndash; tết kết nối&rdquo;. Đắm m&igrave;nh trong lễ hội Roong Pooc của người Gi&aacute;y Tả Van hay tận hưởng những ph&uacute;t gi&acirc;y y&ecirc;n b&igrave;nh, thư gi&atilde;n tại &ldquo;một Sapa kh&aacute;c&rdquo;. Thăm th&uacute; cao nguy&ecirc;n đ&aacute; Đồng Văn &ndash; H&agrave; Giang với những bản người H&rsquo;M&ocirc;ng l&agrave; c&aacute;ch ch&uacute;ng ta mở rộng tr&aacute;i tim v&agrave; đ&ocirc;i mắt để học về thế giới tuyệt vời như thế n&agrave;o. Ch&uacute;ng ta chỉ c&oacute; duy nhất một m&ugrave;a xu&acirc;n trong năm. Nếu cứ tr&igrave; ho&atilde;n những chuyến đi, bạn sẽ chẳng bao giờ c&oacute; lại cơ hội để đi du lịch như l&uacute;c n&agrave;y. H&atilde;y để AsiaTravel hiện thực h&oacute;a kế hoạch về những chuyến đi cho bạn!</span></p>\n</div>\n', 'Mô tả ngắn về chủ đề từng gian đoạn'),
(3, 'footer_aboutus', 'ckeditor', 'POH', 'Giới thiệu ngắn về công ty - địa chỉ liên hệ'),
(4, 'link_facebook', 'text', 'http://facebook.com/', 'Link facebook'),
(5, 'link_twitter', 'text', 'http://twitter.com', 'Link twitter'),
(6, 'link_gplus', 'text', 'http://google.com', 'Link google plus'),
(7, 'link_instagram', 'text', 'http://instagram.com', 'Link instagram'),
(8, 'home_hotline', 'text', '090 468 3491', 'Hotline liên hệ'),
(9, 'home_meta_title', 'text', 'Kabu', 'Thẻ meta title ở trang chủ'),
(10, 'home_meta_description', 'text', 'Kabu', 'Thẻ meta description ở trang chủ'),
(11, 'home_meta_keywords', 'text', 'Kabu', 'Thẻ meta keywords ở trang chủ'),
(12, 'tour_banner', 'ckeditor', '/assets/img/sample_banner2.jpg', 'Banner ở cuối trang tour'),
(13, 'footer_logo_partners', 'ckeditor', '', 'Logo các đối tác của công ty'),
(14, 'home_short_introduction', 'ckeditor', '<h1 style="font-size: 16px;font-weight: 600">MaichauTourist là công ty số 1 về du lịch Mai Châu</h1>\n<p style="font-size: 14px;">Với kinh nghiệm 7 năm tổ chức tour đi Mai Châu cùng hệ thống nhà sàn, khách sạn và đội ngũ hướng dẫn viên chuyên nghiệp nhất Mai Châu.</p>\n', 'Lời chào ngắn dưới slideshow'),
(15, 'global_header_code', 'ckeditor', '<!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-100346405-1"></script><script>  window.dataLayer = window.dataLayer || [];  function gtag(){dataLayer.push(arguments);}  gtag(''js'', new Date());  gtag(''config'', ''UA-100346405-1'');</script><meta name="google-site-verification" content="uKyWx-g2MRIQQbCMmbicFuYzstbiEmWKMTglis6s3-0" /><!-- Facebook Pixel Code --><script>  !function(f,b,e,v,n,t,s)  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?  n.callMethod.apply(n,arguments):n.queue.push(arguments)};  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=''2.0'';  n.queue=[];t=b.createElement(e);t.async=!0;  t.src=v;s=b.getElementsByTagName(e)[0];  s.parentNode.insertBefore(t,s)}(window, document,''script'',  ''https://connect.facebook.net/en_US/fbevents.js'');  fbq(''init'', ''204147040532499'');  fbq(''track'', ''PageView'');</script><noscript><img height="1" width="1" style="display:none"  src="https://www.facebook.com/tr?id=204147040532499&ev=PageView&noscript=1"/></noscript><!-- End Facebook Pixel Code -->', 'Mã trong thẻ <head> đầu trang'),
(16, 'global_footer_code', 'ckeditor', '', 'Mã cuối trang');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `affiliate_transaction_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `type` enum('course','product','other') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('pending','process','confirmed','closed') COLLATE utf8_unicode_ci NOT NULL,
  `payment` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categoryid` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gallery` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` int(2) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `alias`, `sku`, `categoryid`, `price`, `sale_price`, `description`, `short_description`, `image`, `thumb`, `gallery`, `featured`, `meta_title`, `meta_description`, `meta_keywords`, `create_time`) VALUES
(8, 'Dấu hiệu mang thai con trai', 'dau-hieu-mang-thai-con-trai', 'test03', '["1"]', 3333, 2500, '<p>dfg</p>\r\n', 'fdg', 'assets/uploads/images/products/dieu_tri_sinh_san10.png', 'assets/uploads/images/thumb/products/dieu_tri_sinh_san_thumb.png', '[]', 0, '', '', '', '0000-00-00'),
(9, 'Dấu hiệu mang thai con trai', 'dau-hieu-mang-thai-con-trai', 'test03', '["1"]', 3333, 3000, '<p>dfg</p>\r\n', 'fdg', 'assets/uploads/images/products/dieu_tri_sinh_san11.png', 'assets/uploads/images/thumb/products/ballantines-banner_thumb.jpg', '[]', 0, '', '', '', '0000-00-00'),
(10, 'Dấu hiệu mang thai con trai', 'dau-hieu-mang-thai-con-trai-10', 'test02', '["1"]', 10000, 0, '', '', 'assets/uploads/images/products/57469185_2202120679834077_4764673475065413632_n.jpg', 'assets/uploads/images/thumb/products/ballantines-banner_thumb.jpg', '[]', 0, '', '', '', '0000-00-00'),
(11, 'Dấu hiệu mang thai con trai', 'dau-hieu-mang-thai-con-trai-11', 'test02', '["2","12"]', 10000, 0, '', '', 'assets/uploads/images/products/57469185_2202120679834077_4764673475065413632_n1.jpg', 'assets/uploads/images/thumb/products/ballantines-banner_thumb.jpg', '[]', 0, '', '', '', '0000-00-00'),
(12, 'Dấu hiệu mang thai con trai', 'dau-hieu-mang-thai-con-trai-12', 'test02', '["2"]', 10000, 0, '', '', 'assets/uploads/images/products/57469185_2202120679834077_4764673475065413632_n2.jpg', 'assets/uploads/images/thumb/products/ballantines-banner_thumb.jpg', '[]', 0, '', '', '', '0000-00-00'),
(13, 'Bỉm BabyDry X01', 'bim-babydry-x01-13', 'babydryx01', '["1"]', 1000000, 0, '<p>Tã bỉm dành cho trẻ em</p>\r\n', '', 'assets/uploads/images/products/ballantines-banner.jpg', 'assets/uploads/images/thumb/products/ballantines-banner_thumb.jpg', '["assets\\/uploads\\/images\\/products\\/ballantines-1.jpg","assets\\/uploads\\/images\\/products\\/ballantines-2.jpg"]', 1, '', '', '', '0000-00-00'),
(14, 'Test thoi 2', 'test-thoi-2-14', '', '["1"]', 10000, 0, '', '', 'assets/uploads/images/products/ballantines-1.jpg', 'assets/uploads/images/thumb/products/ballantines-1_thumb.jpg', '[]', 0, '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `products_attachdata`
--

CREATE TABLE IF NOT EXISTS `products_attachdata` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attachdata` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products_attachdata`
--

INSERT INTO `products_attachdata` (`id`, `product_id`, `attachdata`, `value`) VALUES
(1, 12, 'combo', '["9"]'),
(2, 13, 'combo', '["8","10"]'),
(3, 14, 'combo', 'null'),
(4, 15, 'combo', 'null'),
(5, 16, 'combo', 'null'),
(6, 17, 'combo', 'null'),
(7, 18, 'combo', 'null'),
(8, 19, 'combo', 'null'),
(9, 14, 'combo', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE IF NOT EXISTS `products_category` (
`id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`id`, `parent_id`, `title`, `alias`, `image`, `thumb`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 0, 'Quần áo trẻ em', 'quan-ao-tre-em', '/assets/uploads/images/articles/screenshot1.png', '/assets/uploads/images/articles/screenshot1.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `caption` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE IF NOT EXISTS `subscriber` (
`id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `active`, `create_time`) VALUES
(1, 'cuongnd2609@gmail.com', 1, 1469959342);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `language` enum('vietnamese','english','japanese') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('normal','affiliate','deactive') COLLATE utf8_unicode_ci NOT NULL,
  `user_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `phone`, `city`, `address`, `role`, `user_code`, `create_time`) VALUES
(2, 'hoangviet11088@gmail.com', 'David Beckham', '72a02467e0aadcf0107a7ae3aeb79223', '0123456789', 'hà nội', 'hà nội', 'affiliate', 'hs93yt8f', 1452568877),
(4, 'chikien149@gmail.com', 'Chí Kiên', 'c10bc23775e037abb964be98f1500a91', '0123456789', '', 'Kim Mã', 'deactive', 'QsfGGrMb', 1552207582),
(5, 'vietth11088@gmail.com', 'viet hoang', '5de1dd535b1d9b12c958b998f80698dc', '0904683491', '', '73 Lý Nam Đế', 'normal', 'j06r0QtD', 1552234868);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_landingpage_config`
--
ALTER TABLE `affiliate_landingpage_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_transactions`
--
ALTER TABLE `affiliate_transactions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_user_info`
--
ALTER TABLE `affiliate_user_info`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners_source_click`
--
ALTER TABLE `banners_source_click`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_page`
--
ALTER TABLE `landing_page`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`id`), ADD KEY `parent` (`parent`);

--
-- Indexes for table `menus_term`
--
ALTER TABLE `menus_term`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_order`
--
ALTER TABLE `news_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attachdata`
--
ALTER TABLE `products_attachdata`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `affiliate_landingpage_config`
--
ALTER TABLE `affiliate_landingpage_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `affiliate_transactions`
--
ALTER TABLE `affiliate_transactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `affiliate_user_info`
--
ALTER TABLE `affiliate_user_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `banners_source_click`
--
ALTER TABLE `banners_source_click`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `landing_page`
--
ALTER TABLE `landing_page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `menus_term`
--
ALTER TABLE `menus_term`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `news_category`
--
ALTER TABLE `news_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news_order`
--
ALTER TABLE `news_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products_attachdata`
--
ALTER TABLE `products_attachdata`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menus` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
