-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2019 at 09:39 AM
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
  `user_id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bestscore`
--

INSERT INTO `bestscore` (`user_id`, `category_id`, `score`) VALUES
(4, 12, 4),
(4, 14, 0),
(4, 2, 5),
(4, 21, 1),
(4, 5, 3),
(4, 20, 1),
(4, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_category` (`parent_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `parent_category_id`) VALUES
(1, 'Vietnam', 'https://file.alotrip.com/photo/vietnam/weather/vietnam-climate-map-699.jpeg', 12),
(2, 'World', 'https://hinessocialstudies.files.wordpress.com/2016/06/flag-map.jpg?w=1024&h=530&crop=1', 12),
(3, 'Vietnam ', 'https://3.bp.blogspot.com/-an5F0fXoC0U/WnWj1yawIbI/AAAAAAAAEYA/k8aza0N4HFchYyb-kkzYSA_-BvvBdWPXQCLcBGAs/s1600/Chien-Tranh-Viet-Nam-War-2.jpg', 13),
(4, 'World', 'https://rec.gov.bt/wp-content/uploads/2019/03/his7-cover-1024x686.jpg', 13),
(5, 'Animals', 'https://www.animaltransportationassociation.org/images/raxo_thumbs/amp/tb-w610-h490-crop-int-19ffc6d920cc9867444fa505af1dfbee.jpg', NULL),
(12, 'Geography', 'http://getwallpapers.com/wallpaper/full/1/8/6/401366.jpg', NULL),
(13, 'History', 'https://blogs.studyinsweden.se/wp-content/uploads/2016/02/1123676.jpg', NULL),
(14, 'Sport', 'http://baochinhphu.vn/Uploaded/buithuhuong/2018_07_19/1531968178U23VN.png', NULL),
(15, 'Music', 'https://www.vpopwire.com/wp-content/uploads/2019/04/Den-Vau-vietnam-rapper-vpop-640x337.jpg', NULL),
(16, 'Europe', 'https://www.nationsonline.org/maps/countries_europe_map.jpg', 12),
(17, 'France', 'https://media.cntraveler.com/photos/5cf96a9dd9fb41f17ed08435/4:3/w_420,c_limit/Eiffel%2520Tower_GettyImages-1005348968.jpg', 16),
(18, 'America', 'https://render.fineartamerica.com/images/rendered/default/canvas-print/10.000/7.000/mirror/break/images/artworkimages/medium/1/united-states-drawing-collage-map-6-mb-art-factory-canvas-print.jpg', 13),
(19, '2019', 'http://www.boonahsoccerclub.org.au/wp-content/uploads/2019/01/Boonah-Soccer-Club-2019-Season.jpg', 14),
(20, 'Africa', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJw8140rgnsvRoVYToCt7WBFSS1pQeIPND3Lr-PghCFRxSDD4c&s', 5),
(21, 'Ancient', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSn01ZZAWw4Z2IiY8pJHGud4uBgk9-f_oWvzjQ-XvXtd7IYwzn4&s', 5),
(22, 'Around the World', 'https://i.ytimg.com/vi/lLa14lICYRE/maxresdefault.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(200) NOT NULL,
  `question` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_category` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `category_id`, `question`, `a`, `b`, `c`, `d`, `answer`, `picture`) VALUES
(1, 2, 'Berlin is the capital of which country?', 'Belgium', 'Netherlands', 'Germany', 'Vietnam', 'c', 'https://static.magiquiz.com/cdn-cgi/image/width=1000,quality=85,fit=scale-down,format=auto,onerror=redirect/https://static.magiquiz.com/wp-content/uploads/2017/02/General-01.jpg'),
(2, 2, 'Which country does this flag belong to?\r\n', 'America', 'Netherlands', 'France', 'Russia', 'd', 'https://quizstone.com/002/media/images/1420.gif'),
(3, 2, 'Which country does this flag belong to?\r\n', 'Cayman Islands', 'New Zealand', 'British Virgin Islands', 'Cook Islands', 'a', 'https://quizstone.com/002/media/images/1140.gif'),
(4, 2, 'In which country is the capital called Lima?', 'Peru', 'Chile', 'Vietnam', 'Colombia', 'a', 'https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/south-america/cathedral-lima-peru.adapt.1900.1.jpg'),
(5, 2, 'Which country does this flag belong to?', 'Colombia', 'Ecuador', 'Bolivia', 'China', 'c', 'https://quizstone.com/002/media/images/1104.gif'),
(6, 2, 'Mongolia lies on which continent?', 'North America', 'Europe', 'South America', 'Asia', 'd', 'https://i.ytimg.com/vi/KwQvyYzcOJU/maxresdefault.jpg'),
(7, 2, 'In which country is Hanoi the capital?', 'Vietnam', 'Laos', 'Cambodia', 'China', 'a', 'https://cdn.getyourguide.com/img/tour_img-772267-146.jpg'),
(8, 2, 'Which country does this flag belong to?\r\n', 'France', 'Italia', 'Nigeria', 'Turkey', 'b', 'https://cdn.pixabay.com/photo/2012/04/11/15/35/flag-28543_960_720.png'),
(9, 1, 'Which is the highest mountain in Vietnam?', 'Everest', 'Fuji', 'Tram', 'Fansipan', 'd', 'https://www.worldatlas.com/r/w1200-h701-c1200x701/upload/90/c4/ea/fansipan.jpg'),
(10, 2, 'Cambodia belongs to?', 'Asia', 'Vietnam', 'Laos', 'Thailand', 'a', 'https://www.intrepidtravel.com/adventures/wp-content/uploads/2018/10/Intrepid-Travel-cambodia_angkor-temple-stone-face-bayon.jpg'),
(11, 3, 'what relationship between Quang Trung and Nguyen Hue', 'Brothers', 'Father-Son', 'The same people', 'Mother-Son', 'c', 'https://3.bp.blogspot.com/-JoXkFy1Nz38/WjQzYcGBztI/AAAAAAAAoTw/n9x3MiMkPo826HpILDUJp42uxL3GASFnACLcBGAs/s1600/quang-trung.jpg'),
(12, 4, 'What was Hitler\'s first name?', 'Donald', 'Karl', 'Vladimir', 'Adolf', 'd', 'http://streaming1.danviet.vn/upload/4-2019/images/2019-10-25/Hitler-suyt-so-huu-bom-hat-nhan-huy-diet-khung-khiep-721-1572015724-width1920height1080.jpg'),
(13, 4, 'which is the first country invaded in WW2?', 'France', 'Turkey', 'Poland', 'Finland', 'c', 'https://www.history.com/.image/t_share/MTU4MTA0NTU2NjQxNzI0MDI2/ww2.jpg'),
(14, 4, 'Where was Barack Obama born in?', 'New York', 'California', 'Yemen', 'Hawaii', 'd', 'https://img.thedailybeast.com/image/upload/c_crop,d_placeholder_euli9k,h_1440,w_2561,x_0,y_0/dpr_1.5/c_limit,w_1044/fl_lossy,q_auto/v1491847182/articles/2017/03/06/barack-obama-s-politically-active-post-presidency-isn-t-normal-or-good/170302-lewis-obama-tesae_emerpj'),
(15, 3, 'what is other name of Tran Quoc Tuan?', 'Tran Hung Dao', 'Tran Quoc Toan', 'Tran Khanh Du', 'Tran Nhat Duat', 'a', 'https://i1-ione.vnecdn.net/2018/12/29/5-jpeg-5653-1546064236.jpg?w=680&h=0&q=100&dpr=2&fit=crop&s=VM2eCLVDaKXBpgRTGxavTw'),
(16, 4, 'How many U.S. Presidents have there been?', '44', '45', '46', '47', 'b', 'https://eogn.files.wordpress.com/2017/02/presidents.jpeg?w=740'),
(19, 22, 'Which of these is the largest animal on the planet?', 'Blue Whale', '\r\nRhino', 'Elephant', 'Human', 'a', 'https://i2-prod.mirror.co.uk/incoming/article13651638.ece/ALTERNATES/s615/3_Cow.jpg'),
(20, 21, 'What does dinosaur mean?', '\"Mean monster\"', '\"Terrible lizard\"', '\"Huge lizard\"', '\"Big monster\"', 'b', 'https://www.gannett-cdn.com/-mm-/317b22386514c54484da1870b1d8435de7caefd0/c=188-0-2343-1217/local/-/media/2018/06/21/USATODAY/USATODAY/636651879463971779-Jurassic-World-Fallen-Kingdom.JPG?width=1600&height=800&fit=crop'),
(21, 5, 'What is this animal?', 'Chicken', 'Duck', 'Human', 'Platypus', 'd', 'https://assetsds.cdnedge.bluemix.net/sites/default/files/styles/very_big_1/public/feature/images/how_all_of_us_are_perry_the_platypus_0.jpg?itok=2ruGCdMN'),
(22, 20, 'One of these animals kills most people in Africa.', 'Lion', 'Leopard', 'Hippo', '', 'c', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSlQ-3dq8r082GwJS53wO1ekxgH18njRM-DVHYrpO8048QJ_0t&s'),
(23, 22, 'Africaâ€™s big five consist of...?', 'Buffalo, elephant, rhino, lion, leopard', ' Buffalo, elephant, rhino, lion, cheetah', '', '', 'a', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `create_at`, `point`) VALUES
(1, 'Duong Dang', 'duongdang@gmail.com', '123456', '2019-11-06 09:03:00', 0),
(2, 'Ahihi Hanh', 'ahihi@gmail.com', '123456', '2019-11-06 09:03:00', 0),
(3, 'Anh Tu', 'anhtu@gmail.com', '123456', '2019-12-09 14:05:03', 0),
(4, 'Linux', 'linux@gmail.com', '123456', '2019-12-17 13:58:52', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
