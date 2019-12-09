-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2019 at 02:06 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestscore`
--

DROP TABLE IF EXISTS `bestscore`;
CREATE TABLE IF NOT EXISTS `bestscore` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bestscore`
--

INSERT INTO `bestscore` (`user_id`, `category_id`, `score`) VALUES
(2, 1, 4),
(1, 1, 4),
(1, 2, 5),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`) VALUES
(1, 'Geography', 'http://getwallpapers.com/wallpaper/full/1/8/6/401366.jpg'),
(2, 'History', 'https://blogs.studyinsweden.se/wp-content/uploads/2016/02/1123676.jpg'),
(3, 'Literature', 'https://qph.fs.quoracdn.net/main-qimg-380d5d538c67efbcaefbad4800b09eeb'),
(4, 'Movies', 'https://www.androidcentral.com/sites/androidcentral.com/files/styles/w1600h900crop/public/field/image/2019/06/disney-pixar-films-4nto-4nto.jpg'),
(5, 'Music', 'https://cdn.wallpapersafari.com/99/4/FYTSmt.jpg'),
(6, 'Sport', 'http://cafefcdn.com/thumb_w/650/2018/1/27/photo1517067378905-1517067378907269558170.png');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `a`, `b`, `c`, `d`, `answer`, `picture`) VALUES
(1, 'Berlin is the capital of which country?', 'Belgium', 'Netherlands', 'Germany', 'Vietnam', 'c', 'https://static.magiquiz.com/cdn-cgi/image/width=1000,quality=85,fit=scale-down,format=auto,onerror=redirect/https://static.magiquiz.com/wp-content/uploads/2017/02/General-01.jpg'),
(2, 'Which country does this flag belong to?\r\n', 'America', 'Netherlands', 'France', 'Russia', 'd', 'https://quizstone.com/002/media/images/1420.gif'),
(3, 'Which country does this flag belong to?\r\n', 'Cayman Islands', 'New Zealand', 'British Virgin Islands', 'Cook Islands', 'a', 'https://quizstone.com/002/media/images/1140.gif'),
(4, 'In which country is the capital called Lima?', 'Peru', 'Chile', 'Vietnam', 'Colombia', 'a', 'https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/south-america/cathedral-lima-peru.adapt.1900.1.jpg'),
(5, 'Which country does this flag belong to?', 'Colombia', 'Ecuador', 'Bolivia', 'China', 'c', 'https://quizstone.com/002/media/images/1104.gif'),
(6, 'Mongolia lies on which continent?', 'North America', 'Europe', 'South America', 'Asia', 'd', 'https://i.ytimg.com/vi/KwQvyYzcOJU/maxresdefault.jpg'),
(7, 'In which country is Hanoi the capital?', 'Vietnam', 'Laos', 'Cambodia', 'China', 'a', 'https://cdn.getyourguide.com/img/tour_img-772267-146.jpg'),
(8, 'Which country does this flag belong to?\r\n', 'France', 'Italia', 'Nigeria', 'Turkey', 'b', 'https://cdn.pixabay.com/photo/2012/04/11/15/35/flag-28543_960_720.png'),
(9, 'Which is the highest mountain in Vietnam?', 'Everest', 'Fuji', 'Tram', 'Fansipan', 'd', 'https://www.worldatlas.com/r/w1200-h701-c1200x701/upload/90/c4/ea/fansipan.jpg'),
(10, 'Cambodia belongs to?', 'Asia', 'Vietnam', 'Laos', 'Thailand', 'a', 'https://www.intrepidtravel.com/adventures/wp-content/uploads/2018/10/Intrepid-Travel-cambodia_angkor-temple-stone-face-bayon.jpg'),
(11, 'what relationship between Quang Trung and Nguyen Hue', 'Brothers', 'Father-Son', 'The same people', 'Mother-Son', 'c', 'https://3.bp.blogspot.com/-JoXkFy1Nz38/WjQzYcGBztI/AAAAAAAAoTw/n9x3MiMkPo826HpILDUJp42uxL3GASFnACLcBGAs/s1600/quang-trung.jpg'),
(12, 'What was Hitler\'s first name?', 'Donald', 'Karl', 'Vladimir', 'Adolf', 'd', 'http://streaming1.danviet.vn/upload/4-2019/images/2019-10-25/Hitler-suyt-so-huu-bom-hat-nhan-huy-diet-khung-khiep-721-1572015724-width1920height1080.jpg'),
(13, 'which is the first country invaded in WW2?', 'France', 'Turkey', 'Poland', 'Finland', 'c', 'https://www.history.com/.image/t_share/MTU4MTA0NTU2NjQxNzI0MDI2/ww2.jpg'),
(14, 'Where was Barack Obama born in?', 'New York', 'California', 'Yemen', 'Hawaii', 'd', 'https://img.thedailybeast.com/image/upload/c_crop,d_placeholder_euli9k,h_1440,w_2561,x_0,y_0/dpr_1.5/c_limit,w_1044/fl_lossy,q_auto/v1491847182/articles/2017/03/06/barack-obama-s-politically-active-post-presidency-isn-t-normal-or-good/170302-lewis-obama-tesae_emerpj'),
(15, 'what is other name of Tran Quoc Tuan?', 'Tran Hung Dao', 'Tran Quoc Toan', 'Tran Khanh Du', 'Tran Nhat Duat', 'a', 'https://i1-ione.vnecdn.net/2018/12/29/5-jpeg-5653-1546064236.jpg?w=680&h=0&q=100&dpr=2&fit=crop&s=VM2eCLVDaKXBpgRTGxavTw'),
(16, 'How many U.S. Presidents have there been?', '44', '45', '46', '47', 'b', 'https://eogn.files.wordpress.com/2017/02/presidents.jpeg?w=740');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` int(200) NOT NULL,
  `question_id` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `question_id` (`question_id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `category`, `question_id`) VALUES
(1, 1, '1'),
(2, 1, '2'),
(3, 1, '3'),
(4, 1, '4'),
(5, 1, '5'),
(6, 1, '6'),
(7, 1, '7'),
(8, 1, '8'),
(9, 1, '9'),
(10, 1, '10'),
(11, 2, '11'),
(12, 2, '12'),
(13, 2, '13'),
(14, 2, '14'),
(15, 2, '15'),
(16, 2, '16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `create_at`, `point`) VALUES
(1, 'Duong Dang', 'duongdang@gmail.com', '123456', '2019-11-06 09:03:00', 0),
(2, 'Ahihi Hanh', 'ahihi@gmail.com', '123456', '2019-11-06 09:03:00', 0),
(3, 'Anh Tu', 'anhtu@gmail.com', '123456', '2019-12-09 14:05:03', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
