-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 09:03 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_about`
--

CREATE TABLE `tb_about` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `detail` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_about`
--

INSERT INTO `tb_about` (`id`, `name`, `detail`, `email`, `phone`) VALUES
(1, 'เว็บไซต์สำหรับท่องเที่ยวจังหวัดประจวบ ', 'เว็บไซต์สำหรับท่องเที่ยวจังหวัดประจวบ สำหรับนักเดินทางที่กำลังมองหาที่กิน ที่พัก ที่เที่ยว เน้นการนำเสนอเนื้อหาเพื่อสนับสนุนการท่องเที่ยวจังหวัดประจวบ\r\n\r\n  เนื้อหาในเว็บไซต์แบ่งเป็นรายละเอียด ข้อมูลสถานที่ท่องเที่ยว แนะนำที่กิน แนะนำที่พัก ข้อมูลข่าวสารใหม่ๆ เบอร์โทรติดต่อฉุกเฉินกรณีเกินเหตุร้าย\r\n\r\n  อีกทั้งเว็บไซต์ของเรายังเน้นถึงการที่สามารถนำไปใช้ได้จริงในการวางแผนท่องเที่ยว', 'king_nin007@hotmail.com', '0970020052');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `fristname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `user_admin` varchar(200) NOT NULL,
  `pass_admin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `image`, `fristname`, `lastname`, `email`, `phone`, `user_admin`, `pass_admin`) VALUES
(1, '1632253947138612497_1036666356843308_1754082390950022937_o.jpg', 'Loga1', 'Pimmas1', 'honess1@gmail.com', '0892325546', 'bee', '35171068e9377f00597574ae2a1438731b2dc034');

-- --------------------------------------------------------

--
-- Table structure for table `tb_phone`
--

CREATE TABLE `tb_phone` (
  `id` int(10) NOT NULL,
  `district` varchar(255) NOT NULL,
  `agency` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_place`
--

CREATE TABLE `tb_place` (
  `id` int(11) NOT NULL,
  `type_place_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `title_s` varchar(200) NOT NULL,
  `detail` text NOT NULL,
  `district` varchar(200) NOT NULL,
  `location` text NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_place_gallery`
--

CREATE TABLE `tb_place_gallery` (
  `id` int(10) NOT NULL,
  `id_place` int(10) NOT NULL,
  `image` text NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_type_place`
--

CREATE TABLE `tb_type_place` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_type_place`
--

INSERT INTO `tb_type_place` (`id`, `title`) VALUES
(2, 'à¸£à¹‰à¸²à¸™à¸­à¸²à¸«à¸²à¸£'),
(3, 'à¸ªà¸–à¸²à¸™à¸—à¸µà¹ˆà¸—à¹ˆà¸­à¸‡à¹€à¸—à¸µà¹ˆà¸¢à¸§'),
(4, 'à¸ªà¸–à¸²à¸™à¸—à¸µà¹ˆà¸žà¸±à¸');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_phone`
--
ALTER TABLE `tb_phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_place`
--
ALTER TABLE `tb_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_place_gallery`
--
ALTER TABLE `tb_place_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_type_place`
--
ALTER TABLE `tb_type_place`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_phone`
--
ALTER TABLE `tb_phone`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_place`
--
ALTER TABLE `tb_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_place_gallery`
--
ALTER TABLE `tb_place_gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_type_place`
--
ALTER TABLE `tb_type_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
