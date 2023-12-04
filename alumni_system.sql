-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 20, 2023 at 05:19 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` varchar(25) NOT NULL,
  `activity_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_name`) VALUES
('ACT-210327065045-9989', 'เล่นน้ำ'),
('ACT-210329190857-6954', 'ติดจรวจ'),
('ACT-210329190909-4494', 'ดำน้ำ'),
('ACT-210329190922-4232', 'วิชาการ'),
('ACT-210329190928-1670', 'ตีหม้อ');

-- --------------------------------------------------------

--
-- Table structure for table `activity_register`
--

CREATE TABLE `activity_register` (
  `id` int(11) NOT NULL,
  `activity_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `payment_url` varchar(255) DEFAULT NULL,
  `status_payment` tinyint(1) NOT NULL DEFAULT '0',
  `create_dattime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_register`
--

INSERT INTO `activity_register` (`id`, `activity_id`, `user_id`, `status`, `payment_url`, `status_payment`, `create_dattime`) VALUES
(1, 'EV-230315153853-8432', '3', 0, NULL, 0, '2023-04-12 21:18:58'),
(6, 'EV-230315153735-2184', '3', 1, '337289562_484949777066956_3560892450056027344_n.jpg', 1, '2023-04-15 22:40:59'),
(10, 'EV-230315153853-8432', '6', 0, NULL, 0, '2023-04-09 00:23:22'),
(11, 'EV-230317131324-2784', '2', 1, NULL, 0, '2023-04-17 18:46:52'),
(12, 'EV-230317133249-8501', '5', 1, NULL, 1, '2023-04-17 18:46:57'),
(13, 'EV-230315153735-2184', '4', 0, NULL, 0, '2023-04-12 21:18:58'),
(14, 'EV-230315153735-2184', '1', 1, '337289562_484949777066956_3560892450056027344_n.jpg', 1, '2023-04-15 22:40:59'),
(15, 'EV-230315153853-8432', '3', 1, NULL, 1, '2023-04-09 00:23:22'),
(16, 'EV-230317131324-2784', '2', 0, NULL, 1, '2023-04-17 18:46:52'),
(17, 'EV-230317133249-8501', '3', 1, 'pexels-neosiam-590059.jpg', 1, '2023-04-17 18:46:57'),
(19, 'ACT-210329190909-4494', '3', 0, 'Red and Yellow Modern Minimalist Illustrated Chili Pepper Sauce Logo (1).png', 0, '2023-04-18 07:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `std_id` varchar(255) DEFAULT NULL,
  `std_password` varchar(255) DEFAULT NULL,
  `state_good` varchar(25) DEFAULT NULL,
  `std_title_name` varchar(255) DEFAULT NULL,
  `std_name` varchar(255) DEFAULT NULL,
  `std_lastname` varchar(255) DEFAULT NULL,
  `std_phone` varchar(255) DEFAULT NULL,
  `std_email` varchar(255) DEFAULT NULL,
  `std_address` text,
  `prog_id` varchar(255) DEFAULT NULL,
  `std_year_start` int(11) DEFAULT NULL,
  `std_year_complete` int(11) DEFAULT NULL,
  `std_company` varchar(255) DEFAULT NULL,
  `std_compamy_phone` varchar(255) DEFAULT NULL,
  `std_job_position` varchar(255) DEFAULT NULL,
  `std_job_salary` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `create_datatime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `std_id`, `std_password`, `state_good`, `std_title_name`, `std_name`, `std_lastname`, `std_phone`, `std_email`, `std_address`, `prog_id`, `std_year_start`, `std_year_complete`, `std_company`, `std_compamy_phone`, `std_job_position`, `std_job_salary`, `state`, `create_datatime`) VALUES
(1, '59100111111', '1234', NULL, 'นาย', 'สม', 'สี', '0890575945', 'email.1231@gmail.com', 'ไม่พบข้อมูล', 'ปริญญาตรี', 2559, 2566, 'xxx.com', '035435345', 'dev', '12000', 1, '2023-03-16 22:53:43'),
(2, '58100234554', '1234', NULL, 'นาง', 'หมาย', 'สี', '0890434454', 'email1231231@gmail.com', 'ขอนแก่น', 'ปริญญาตรี', 2559, 2566, 'erwe', '453534', 'gdfg', '25000', 1, '2023-03-16 22:53:53'),
(3, '59123456789', '1234', NULL, 'นาย', 'อพิรักษา', 'ดวงใจ', '46464', 'non@non', 'อุดรธานี', 'ประกาศนียบัตรวิชาชีพชั้นสูง', 2559, 2563, 'company', '024546456', 'sale', '20000', 1, '2023-03-17 00:40:28'),
(5, '6943534535', '35345345', NULL, 'นาย', 'gdgg', 'dfgdfg', '53454353', 'gdfg@gmail.com', 'ertertet', 'ระดับประกาศนียบัตรวิชาชีพ', 3453, 3453, '435fgdgd', '35345', NULL, '9000', 0, '2023-03-17 00:50:44'),
(6, '242342342', '234234234', NULL, 'นาย', 'ewfsdf', 'dsdfgdfg', '34535345', 'gdfg45@gmail.com', 'rwewr', 'ระดับประกาศนียบัตรวิชาชีพ', 5345, 3453, '345', '5345', NULL, '30000', 0, '2023-03-17 01:10:22'),
(7, '59100111111', '1234', NULL, 'นาย', 'สม', 'สี', '0890575945', 'emailcoppy.1231@gmail.com', 'ไม่พบข้อมูล', 'ปริญญาตรี', 2559, 2566, 'xxx.com', '035435345', 'dev', '13000', 1, '2023-03-16 22:53:43'),
(8, '58100234554', '1234', NULL, 'นาง', 'หมาย', 'สี', '0890434454', 'emaicoppyl1231231@gmail.com', 'ขอนแก่น', 'ปริญญาตรี', 2559, 2566, 'erwe', '453534', 'gdfg', '25000', 1, '2023-03-16 22:53:53'),
(9, '59123456789', '1234', NULL, 'นาย', 'อพิรักษา', 'ดวงใจ', '46464', 'noncoppy@non', 'อุดรธานี', 'ประกาศนียบัตรวิชาชีพชั้นสูง', 2559, 2563, 'company', '024546456', 'sale', '19000', 1, '2023-03-17 00:40:28'),
(10, '6943534535', '35345345', NULL, 'นาย', 'gdgg', 'dfgdfg', '53454353', 'gdfgcoppy@gmail.com', 'ertertet', 'ระดับประกาศนียบัตรวิชาชีพ', 3453, 3453, '435fgdgd', '35345', NULL, '11000', 0, '2023-03-17 00:50:44'),
(11, '242342342', '234234234', NULL, 'นาย', 'ewfsdf', 'dsdfgdfg', '34535345', 'gdfg45coppy@gmail.com', 'rwewr', 'ระดับประกาศนียบัตรวิชาชีพ', 5345, 3453, '345', '5345', NULL, '24000', 0, '2023-03-17 01:10:22'),
(12, '59100111111', '1234', NULL, 'นาย', 'สม', 'สี', '0890575945', 'email1221.1231@gmail.com', 'ไม่พบข้อมูล', 'ปริญญาตรี', 2559, 2566, 'xxx.com', '035435345', 'dev', '35000', 1, '2023-03-16 22:53:43'),
(13, '58100234554', '1234', NULL, 'นาง', 'หมาย', 'สี', '0890434454', 'email12122131231@gmail.com', 'ขอนแก่น', 'ปริญญาตรี', 2559, 2566, 'erwe', '453534', 'gdfg', '31000', 1, '2023-03-16 22:53:53'),
(14, '59123456789', '1234', NULL, 'นาย', 'อพิรักษา', 'ดวงใจ', '46464', 'non1221@non', 'อุดรธานี', 'ประกาศนียบัตรวิชาชีพชั้นสูง', 2559, 2563, 'company', '024546456', 'sale', '40000', 1, '2023-03-17 00:40:28'),
(15, '6943534535', '35345345', NULL, 'นาย', 'gdgg', 'dfgdfg', '53454353', 'gdf1221g@gmail.com', 'ertertet', 'ระดับประกาศนียบัตรวิชาชีพ', 3453, 3453, '435fgdgd', '35345', NULL, '50000', 0, '2023-03-17 00:50:44'),
(16, '242342342', '234234234', NULL, 'นาย', 'ewfsdf', 'dsdfgdfg', '34535345', 'gdfg412215@gmail.com', 'rwewr', 'ระดับประกาศนียบัตรวิชาชีพ', 5345, 3453, '345', '5345', NULL, '32000', 0, '2023-03-17 01:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

CREATE TABLE `comment_post` (
  `com_post_id` varchar(25) NOT NULL,
  `com_post_detail` text NOT NULL,
  `com_post_user` varchar(25) NOT NULL,
  `news_post_id` varchar(25) NOT NULL,
  `com_post_user_state` varchar(25) NOT NULL,
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_post`
--

INSERT INTO `comment_post` (`com_post_id`, `com_post_detail`, `com_post_user`, `news_post_id`, `com_post_user_state`, `com_date`) VALUES
('CM-210330070459-5703', 'ขอบคุณ', ' admin', ' post-210329162959-6499', ' admin', '2021-03-30 05:04:59'),
('CM-210330092622-6671', 'gdfgdg', ' admin', 'post-210329143504-1928', ' admin', '2021-03-30 07:26:22'),
('CM-210330093230-5665', 'dt', ' admin', 'post-210329143504-1928', ' admin', '2021-03-30 07:32:30'),
('CM-210330093328-2384', 'ดีมากกกก', ' admin', 'post-210329143504-1928', ' admin', '2021-03-30 07:33:28'),
('CM-210330093354-7211', 'รักลุงพล', ' admin', 'post-210329143504-1928', ' admin', '2021-03-30 07:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(25) NOT NULL,
  `course_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`) VALUES
('CS-210327070844-4788', 'กินเหกกกล้าาทึก'),
('CS-210328205011-9121', 'ddddddddddd');

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `event_list_id` varchar(25) NOT NULL,
  `event_list_name` varchar(25) NOT NULL,
  `event_list_type` varchar(25) NOT NULL,
  `event_list_day` varchar(25) NOT NULL,
  `event_list_time` varchar(25) NOT NULL,
  `event_list_time_end` varchar(25) DEFAULT NULL,
  `event_list_loca` varchar(25) NOT NULL,
  `event_list_detali` text NOT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `charges` double DEFAULT '0',
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`event_list_id`, `event_list_name`, `event_list_type`, `event_list_day`, `event_list_time`, `event_list_time_end`, `event_list_loca`, `event_list_detali`, `img_name`, `charges`, `create`) VALUES
('ACT-210329190909-4494', 'วิทย์', 'ACT-210329190922-4232', '2023-03-08', '22:12', '21:32', 'kkn', 'รายละเอียดเพิ่มเติม กิจกรรม', 'cover12.jpg', 120, '2023-04-17 23:46:03'),
('EV-230315153735-2184', 'สงกรานต์', 'ACT-210329190909-4494', '2023-04-12', '15:36', '20:31', 'KKN', 'คำว่า \"สงกรานต์\" มาจากภาษาสันสกฤต ที่มีความหมายว่า \"การเคลื่อนย้าย\" โดยเชื่อว่าในวันสงกรานต์ เป็นช่วงเวลาการเคลื่อนย้ายของจักรราศี อีกนัยหนึ่งก็คือการเคลื่อนสู่ปีใหม่ ทำให้คนไทยยึดถือวันสงกรานต์เป็น \"วันขึ้นปีใหม่ไทย\" มาตั้งแต่สมัยโบราณ จนกระทั่ง พ.ศ. 2483 ก่อนจะปรับเปลี่ยนให้เป็นไปตามแบบแผนสากลนิยม ซึ่งก็คือวันที่ 1 ...Apr 13, 2565 BE', '0032.webp', 100, '2023-04-18 01:53:29'),
('EV-230315153853-8432', 'วันขึ้นปีใหม่', 'ACT-210327065045-9989', '2022-12-09', '22:40', '00:32', 'KKN', 'วันขึ้นปีใหม่ เป็นเวลาที่ปฏิทินปีใหม่เริ่มต้นและนับปีปฏิทินเพิ่มขึ้นหนึ่งปี วันขึ้นปีใหม่ในปฏิทินกริกอเรียนที่ใช้กันทั่วโลกปัจจุบัน ตรงกับวันที่ 1 มกราคม/จจ', 'Grill food Logo (2).png', 200, '2023-04-18 01:25:56'),
('EV-230317133249-8501', 'ธุรกิจ', 'ACT-210327065045-9989', '2023-03-16', '20:32', '21:32', 'qeqwe', '2dfdfgdfgdfg', 'Copy of 17018_Logo.webp', 900, '2023-04-18 00:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `gift_id` varchar(25) NOT NULL,
  `gift_name` varchar(25) NOT NULL,
  `gift_detail` text NOT NULL,
  `gift_price` int(16) NOT NULL,
  `gift_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`gift_id`, `gift_name`, `gift_detail`, `gift_price`, `gift_image`) VALUES
('GF-210329075556-8286', 'hhhh', 'ouououooo', 25000, 'img5386191652661543000.png'),
('GF-210329075628-6444', 'yyyyyyyyy', '252kjhgkkh', 252525, 'img341406789882023900.png');

-- --------------------------------------------------------

--
-- Table structure for table `news_post`
--

CREATE TABLE `news_post` (
  `news_post_id` varchar(25) NOT NULL,
  `news_post_name` varchar(25) NOT NULL,
  `news_post_detail` text NOT NULL,
  `news_post_type` varchar(25) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_post`
--

INSERT INTO `news_post` (`news_post_id`, `news_post_name`, `news_post_detail`, `news_post_type`, `create_date`) VALUES
('post-210329143504-1928', 'admin', 'วันนี้ (89999999999999 ม.ค.2564) ผู้สื่อข่าวรายงานว่า ตำรวจเชิญตัว นายไชย์พล วิภา หรือลุงพล และนางสมพร หรือป้าแต๋น ลุงและป้าของน้องชมพู่ เข้ามาที่ศูนย์พิสูจน์หลักฐาน 1 ปทุมธานี เพื่อเข้าเครื่องจับเท็จ โดยมีผู้เชี่ยวชาญเป็นผู้ซักถามคนละ 3 ชั่วโมง\r\n\r\nทั้งนี้ มีรายงานว่า นายไชย์พล และนางสมพร เดินทางมาถึงด้วยรถตู้เข้ามาตั้งแต่เมื่อช่วงเช้า และถูกนำตัวเข้าไปในตัวอาคาร โดยไม่ได้รับอนุญาตให้ออกมาพบสื่อมวลชน มีรายงานว่า ก่อนเข้าเครื่องจับเท็จทั้งสองคน ไม่รู้สึกเครียด และไม่หนักใจ เพราะเข้าใจในขั้นตอนของกฎหมาย\r\n\r\nสำหรับกระบวนการเข้าเครื่องจับเท็จเริ่มต้นขึ้นตั้งแต่เวลา 10.30 น.โดยมีการสัมภาษณ์ทีละคน ที่มีนักจิตวิทยาร่วมสอบปากคำด้วย เพื่อสังเกตอาการของนายไชย์พล มีการตรวจคลื่นหัวใจ และใช้เครื่องจับเท็จ ซึ่งเป็นขั้นตอนตามกฎหมาย เพื่อนำไปประกอบสำนวนคดี โดยคาดว่าทั้งสองคน ต้องถูกซักถามรวมใช้เวลาไม่ต่ำกว่า 9 ชั่วโมง และมีบุคลากรผู้เชี่ยวชาญร่วมอยู่ด้วยในทุกกระบวนการ\r\n\r\nก่อนหน้านี้ ครอบครัวของน้องชมพู่ รวม 7 คน ถูกเชิญตัวเข้าเครื่องจับเท็จไปแล้ว โดยพนักงานสอบ สวนสถานีตำรวจภูธรกกตูม จ.มุกดาหาร เป็นผู้ประสานกับตำรวจพิสูจน์หลักฐาน เพื่อนำผู้เกี่ยวข้องมาให้ผู้เชี่ยวชาญซักถามก่อนนำเข้าเครื่องจับเท็จ\r\n\r\nสำหรับคดีการเสียชีวิตของ น้องชมพู่ พล.ต.อ. สุวัฒน์ แจ้งยอดสุข ผู้บัญชาการตำรวจแห่งชาติ (ผบ.ตร.) แถลงข่าวไปเมื่อวันที่ 2 ต.ค.2563 ระบุว่า จากข้อมูลพยานหลักฐาน คดีนี้เป็นการตั้งข้อหาว่าพรากเด็ก และกักขังหน่วงเหนี่ยวเป็นเหตุให้ผู้อื่นเสียชีวิต และข้อหาซ่อนเร้นเคลื่อนย้ายทำลายและอำพรางศพ แต่ผู้กระทำผิดยังไม่มีหลักฐานเพียงพอที่จะออกหมายจับ หรือดำเนินคดีกับใครได้ โดนคดีมีอายุความ 20 ปี', 'ลุงพลกับป้าแต๋น', '2021-03-30 07:33:40'),
('post-210330081635-4184', 'admin', 'Not the answer you\'re looking for? Browse other questions tagged javascript jquery ajax or ask your own question.', 'กีฬา', '2021-03-30 07:17:52'),
('post-210330083310-5242', 'admin', 'Strange solution IMO- Introducing javascript to save a couple lines of PHP makes no sense. – Yarin Jun 14 \'12 at 17:24\r\n@Yarin: Agreed, a quick solution, in office by that time, no much time :( – Sarfraz Jun 14 \'12 at 17:27 \r\ngreat solution but kind of sketchy. used on LEMP stack and i was unable to reload nginx. after debugging with sudo tail /var/log/nginx/error.log the errors were directly at these lines and after removing code i was able to reload just fine – sqrepants Apr 12 \'16 at 12:44\r\nvalue is correct but i get ', 'กีฬา', '2021-03-30 07:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `new_type`
--

CREATE TABLE `new_type` (
  `new_type_id` varchar(25) NOT NULL,
  `new_type_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_type`
--

INSERT INTO `new_type` (`new_type_id`, `new_type_name`) VALUES
('NT-210327074011-2152', 'ลุงพลกับป้าแต๋น'),
('NT-210327075831-2962', 'ม๊อบ'),
('NT-210329041830-8752', 'กีฬา');

-- --------------------------------------------------------

--
-- Table structure for table `register_event`
--

CREATE TABLE `register_event` (
  `id` int(11) NOT NULL,
  `event_list_id` varchar(255) NOT NULL,
  `alumni_id` varchar(255) NOT NULL,
  `create_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(25) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_email` varchar(25) NOT NULL,
  `user_pass` varchar(20) NOT NULL,
  `user_phone` varchar(13) NOT NULL,
  `user_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_phone`, `user_status`) VALUES
('U-210327220801-9943', 'admin', 'admin@admin', '1234', '0895701261222', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `activity_register`
--
ALTER TABLE `activity_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_post`
--
ALTER TABLE `comment_post`
  ADD PRIMARY KEY (`com_post_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`event_list_id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`gift_id`);

--
-- Indexes for table `news_post`
--
ALTER TABLE `news_post`
  ADD PRIMARY KEY (`news_post_id`);

--
-- Indexes for table `new_type`
--
ALTER TABLE `new_type`
  ADD PRIMARY KEY (`new_type_id`);

--
-- Indexes for table `register_event`
--
ALTER TABLE `register_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_register`
--
ALTER TABLE `activity_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `register_event`
--
ALTER TABLE `register_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
