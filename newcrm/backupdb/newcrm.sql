-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 10:37 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_db`
--

CREATE TABLE `access_db` (
  `id` int(11) NOT NULL,
  `tbl_name` varchar(100) NOT NULL,
  `adding` int(11) NOT NULL,
  `deleting` int(11) NOT NULL,
  `updating` int(11) NOT NULL,
  `viewing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_db`
--

INSERT INTO `access_db` (`id`, `tbl_name`, `adding`, `deleting`, `updating`, `viewing`) VALUES
(1, 'admin', 1, 2, 3, 4),
(2, 'admin_roles', 5, 6, 7, 8),
(3, 'attendance', 9, 10, 11, 12),
(4, 'cgroup', 13, 14, 15, 16),
(5, 'customer', 17, 18, 19, 20),
(6, 'erp_chat', 21, 22, 23, 24),
(7, 'incentive', 25, 26, 27, 28),
(8, 'package', 29, 30, 31, 32),
(9, 'sales_category_type', 33, 34, 35, 36),
(10, 'sales_data_assign', 37, 38, 39, 40),
(11, 'sale_done', 41, 42, 43, 44),
(12, 'sale_target', 45, 46, 47, 48),
(13, 'services', 49, 50, 51, 52),
(14, 'tbl_customer_category', 53, 54, 55, 56),
(15, 'new_data_list', 57, 58, 59, 60),
(16, 'data_target', 61, 62, 63, 64),
(17, 'cities', 65, 66, 67, 68);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `other_info` longtext NOT NULL,
  `admin_role_id` int(11) NOT NULL,
  `position` varchar(11) NOT NULL,
  `uplead_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `actstat` int(2) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `photo`, `other_info`, `admin_role_id`, `position`, `uplead_id`, `team_id`, `actstat`, `last_login`) VALUES
(2, 'Komal', 'Singh', 'komal@b2benquiry.com', 'komal', '9876543210', '030117093100AD.png', '', 1, '1', 0, 1, 1, '2018-03-24 12:19:04'),
(4, 'Data Entry', 'Operator', 'data@b2benquiry.com', '1234', '598209471', '', '', 5, '', 2, 0, 1, '2017-01-29 05:14:30'),
(6, 'Verifier', '', 'verify@b2benquiry.com', 'verify', '9789327892', '', '', 6, '', 2, 0, 1, '2017-01-09 08:19:27'),
(8, 'ABhishek', 'Khare', 'abkhare47@gmail.com', 'abhi', '9540597007', '240418020156case1 - Copy.jpg', '', 2, '', 2, 0, 1, '2018-04-24 02:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `privilege` varchar(255) NOT NULL,
  `actstat` int(2) NOT NULL,
  `fld_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `privilege`, `actstat`, `fld_order`) VALUES
(1, 'Manager', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64', 1, 0),
(2, 'Sales', '13,15,16,17,19,20,21,23,24,29,31,32,37,39,40,61,62,63,64', 1, 0),
(3, 'Support', '', 1, 0),
(5, 'Data Entry Operator', '13,15,16,17,19,20,60', 1, 0),
(6, 'Verifier', '19,20,59,60', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `admin_id`, `login_date`) VALUES
(1, 2, '2017-09-16 15:42:52'),
(2, 2, '2017-09-25 07:00:12'),
(3, 2, '2017-10-02 14:07:44'),
(4, 2, '2017-10-31 15:11:18'),
(5, 2, '2017-11-29 14:20:52'),
(6, 2, '2017-12-09 16:05:21'),
(7, 2, '2017-12-12 14:00:17'),
(8, 2, '2018-01-13 07:48:12'),
(9, 2, '2018-02-16 15:08:19'),
(10, 2, '2018-02-16 15:17:54'),
(11, 2, '2018-02-20 15:42:40'),
(12, 7, '2018-02-21 05:53:41'),
(13, 2, '2018-02-23 16:28:18'),
(14, 7, '2018-02-23 16:31:01'),
(15, 2, '2018-02-23 16:32:19'),
(16, 7, '2018-02-23 16:32:45'),
(17, 2, '2018-02-27 07:52:50'),
(18, 2, '2018-03-04 02:04:29'),
(19, 2, '2018-03-24 06:49:04'),
(20, 8, '2018-04-23 20:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `cgroup`
--

CREATE TABLE `cgroup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fld_order` int(11) NOT NULL,
  `actstat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cgroup`
--

INSERT INTO `cgroup` (`id`, `name`, `fld_order`, `actstat`) VALUES
(3, 'IT Company', 0, 1),
(4, 'Handicrafts', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(5) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `city_state` varchar(50) NOT NULL,
  `city_country` varchar(100) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `city_state`, `city_country`, `latitude`, `longitude`) VALUES
(1, 'Port Blair', 'Andaman and Nicobar Islands', 'India', '11.67 N', '92.76 E'),
(2, 'Adilabad', 'Andhra Pradesh', 'India', '19.68 N', '78.53 E'),
(3, 'Adoni', 'Andhra Pradesh', 'India', '15.63 N', '77.28 E'),
(4, 'Alwal', 'Andhra Pradesh', 'India', '17.50 N', '78.54 E'),
(5, 'Anakapalle', 'Andhra Pradesh', 'India', '17.69 N', '83.00 E'),
(6, 'Anantapur', 'Andhra Pradesh', 'India', '14.70 N', '77.59 E'),
(7, 'Bapatla', 'Andhra Pradesh', 'India', '15.91 N', '80.47 E'),
(8, 'Belampalli', 'Andhra Pradesh', 'India', '19.06 N', '79.49 E'),
(9, 'Bhimavaram', 'Andhra Pradesh', 'India', '16.55 N', '81.53 E'),
(10, 'Bhongir', 'Andhra Pradesh', 'India', '17.52 N', '78.88 E'),
(11, 'Bobbili', 'Andhra Pradesh', 'India', '18.57 N', '83.37 E'),
(12, 'Bodhan', 'Andhra Pradesh', 'India', '18.66 N', '77.88 E'),
(13, 'Chilakalurupet', 'Andhra Pradesh', 'India', '16.10 N', '80.16 E'),
(14, 'Chinna Chawk', 'Andhra Pradesh', 'India', '14.47 N', '78.83 E'),
(15, 'Chirala', 'Andhra Pradesh', 'India', '15.84 N', '80.35 E'),
(16, 'Chittur', 'Andhra Pradesh', 'India', '13.22 N', '79.10 E'),
(17, 'Cuddapah', 'Andhra Pradesh', 'India', '14.48 N', '78.81 E'),
(18, 'Dharmavaram', 'Andhra Pradesh', 'India', '14.42 N', '77.71 E'),
(19, 'Dhone', 'Andhra Pradesh', 'India', '15.42 N', '77.88 E'),
(20, 'Eluru', 'Andhra Pradesh', 'India', '16.72 N', '81.11 E'),
(21, 'Gaddiannaram', 'Andhra Pradesh', 'India', '17.36 N', '78.52 E'),
(22, 'Gadwal', 'Andhra Pradesh', 'India', '16.23 N', '77.80 E'),
(23, 'Gajuwaka', 'Andhra Pradesh', 'India', '17.70 N', '83.21 E'),
(24, 'Gudivada', 'Andhra Pradesh', 'India', '16.44 N', '81.00 E'),
(25, 'Gudur', 'Andhra Pradesh', 'India', '14.15 N', '79.84 E'),
(26, 'Guntakal', 'Andhra Pradesh', 'India', '15.18 N', '77.37 E'),
(27, 'Guntur', 'Andhra Pradesh', 'India', '16.31 N', '80.44 E'),
(28, 'Hindupur', 'Andhra Pradesh', 'India', '13.83 N', '77.48 E'),
(29, 'Hyderabad', 'Andhra Pradesh', 'India', '17.40 N', '78.48 E'),
(30, 'Jagtial', 'Andhra Pradesh', 'India', '18.80 N', '78.91 E'),
(31, 'Kadiri', 'Andhra Pradesh', 'India', '14.12 N', '78.16 E'),
(32, 'Kagaznagar', 'Andhra Pradesh', 'India', '19.34 N', '79.48 E'),
(33, 'Kakinada', 'Andhra Pradesh', 'India', '16.96 N', '82.24 E'),
(34, 'Kallur', 'Andhra Pradesh', 'India', '15.69 N', '77.77 E'),
(35, 'Kamareddi', 'Andhra Pradesh', 'India', '18.32 N', '78.35 E'),
(36, 'Kapra', 'Andhra Pradesh', 'India', '17.37 N', '78.48 E'),
(37, 'Karimnagar', 'Andhra Pradesh', 'India', '18.45 N', '79.13 E'),
(38, 'Karnul', 'Andhra Pradesh', 'India', '15.83 N', '78.03 E'),
(39, 'Kavali', 'Andhra Pradesh', 'India', '14.92 N', '79.99 E'),
(40, 'Khammam', 'Andhra Pradesh', 'India', '17.25 N', '80.15 E'),
(41, 'Kodar', 'Andhra Pradesh', 'India', '16.98 N', '79.97 E'),
(42, 'Kondukur', 'Andhra Pradesh', 'India', '15.22 N', '79.91 E'),
(43, 'Koratla', 'Andhra Pradesh', 'India', '18.82 N', '78.72 E'),
(44, 'Kottagudem', 'Andhra Pradesh', 'India', '17.56 N', '80.64 E'),
(45, 'Kukatpalle', 'Andhra Pradesh', 'India', '17.49 N', '78.41 E'),
(46, 'Lalbahadur Nagar', 'Andhra Pradesh', 'India', '17.43 N', '78.50 E'),
(47, 'Machilipatnam', 'Andhra Pradesh', 'India', '16.19 N', '81.14 E'),
(48, 'Mahbubnagar', 'Andhra Pradesh', 'India', '16.74 N', '77.98 E'),
(49, 'Malkajgiri', 'Andhra Pradesh', 'India', '17.55 N', '78.59 E'),
(50, 'Mancheral', 'Andhra Pradesh', 'India', '18.88 N', '79.45 E'),
(51, 'Mandamarri', 'Andhra Pradesh', 'India', '18.97 N', '79.47 E'),
(52, 'Mangalagiri', 'Andhra Pradesh', 'India', '16.44 N', '80.56 E'),
(53, 'Markapur', 'Andhra Pradesh', 'India', '15.73 N', '79.28 E'),
(54, 'Miryalaguda', 'Andhra Pradesh', 'India', '16.87 N', '79.57 E'),
(55, 'Nalgonda', 'Andhra Pradesh', 'India', '17.06 N', '79.26 E'),
(56, 'Nandyal', 'Andhra Pradesh', 'India', '15.49 N', '78.48 E'),
(57, 'Narasapur', 'Andhra Pradesh', 'India', '16.45 N', '81.70 E'),
(58, 'Narasaraopet', 'Andhra Pradesh', 'India', '16.24 N', '80.04 E'),
(59, 'Nellur', 'Andhra Pradesh', 'India', '14.46 N', '79.98 E'),
(60, 'Nirmal', 'Andhra Pradesh', 'India', '19.12 N', '78.35 E'),
(61, 'Nizamabad', 'Andhra Pradesh', 'India', '18.68 N', '78.10 E'),
(62, 'Nuzvid', 'Andhra Pradesh', 'India', '16.78 N', '80.85 E'),
(63, 'Ongole', 'Andhra Pradesh', 'India', '15.50 N', '80.05 E'),
(64, 'Palakollu', 'Andhra Pradesh', 'India', '16.52 N', '81.75 E'),
(65, 'Palasa', 'Andhra Pradesh', 'India', '18.77 N', '84.42 E'),
(66, 'Palwancha', 'Andhra Pradesh', 'India', '17.60 N', '80.68 E'),
(67, 'Patancheru', 'Andhra Pradesh', 'India', '17.53 N', '78.27 E'),
(68, 'Piduguralla', 'Andhra Pradesh', 'India', '16.48 N', '79.90 E'),
(69, 'Ponnur', 'Andhra Pradesh', 'India', '16.07 N', '80.56 E'),
(70, 'Proddatur', 'Andhra Pradesh', 'India', '14.73 N', '78.55 E'),
(71, 'Qutubullapur', 'Andhra Pradesh', 'India', '17.43 N', '78.47 E'),
(72, 'Rajamahendri', 'Andhra Pradesh', 'India', '17.02 N', '81.79 E'),
(73, 'Rajampet', 'Andhra Pradesh', 'India', '14.18 N', '79.17 E'),
(74, 'Rajendranagar', 'Andhra Pradesh', 'India', '17.29 N', '78.39 E'),
(75, 'Ramachandrapuram', 'Andhra Pradesh', 'India', '17.56 N', '78.04 E'),
(76, 'Ramagundam', 'Andhra Pradesh', 'India', '18.80 N', '79.45 E'),
(77, 'Rayachoti', 'Andhra Pradesh', 'India', '14.05 N', '78.75 E'),
(78, 'Rayadrug', 'Andhra Pradesh', 'India', '14.70 N', '76.87 E'),
(79, 'Samalkot', 'Andhra Pradesh', 'India', '17.06 N', '82.18 E'),
(80, 'Sangareddi', 'Andhra Pradesh', 'India', '17.63 N', '78.08 E'),
(81, 'Sattenapalle', 'Andhra Pradesh', 'India', '16.40 N', '80.18 E'),
(82, 'Serilungampalle', 'Andhra Pradesh', 'India', '17.48 N', '78.33 E'),
(83, 'Siddipet', 'Andhra Pradesh', 'India', '18.11 N', '78.84 E'),
(84, 'Sikandarabad', 'Andhra Pradesh', 'India', '17.47 N', '78.52 E'),
(85, 'Sirsilla', 'Andhra Pradesh', 'India', '18.40 N', '78.81 E'),
(86, 'Srikakulam', 'Andhra Pradesh', 'India', '18.30 N', '83.90 E'),
(87, 'Srikalahasti', 'Andhra Pradesh', 'India', '13.76 N', '79.70 E'),
(88, 'Suriapet', 'Andhra Pradesh', 'India', '17.15 N', '79.62 E'),
(89, 'Tadepalle', 'Andhra Pradesh', 'India', '16.48 N', '80.60 E'),
(90, 'Tadepallegudem', 'Andhra Pradesh', 'India', '16.82 N', '81.52 E'),
(91, 'Tadpatri', 'Andhra Pradesh', 'India', '14.91 N', '78.00 E'),
(92, 'Tandur', 'Andhra Pradesh', 'India', '17.25 N', '77.58 E'),
(93, 'Tanuku', 'Andhra Pradesh', 'India', '16.75 N', '81.69 E'),
(94, 'Tenali', 'Andhra Pradesh', 'India', '16.24 N', '80.65 E'),
(95, 'Tirupati', 'Andhra Pradesh', 'India', '13.63 N', '79.41 E'),
(96, 'Tuni', 'Andhra Pradesh', 'India', '17.35 N', '82.55 E'),
(97, 'Uppal Kalan', 'Andhra Pradesh', 'India', '17.38 N', '78.55 E'),
(98, 'Vijayawada', 'Andhra Pradesh', 'India', '16.52 N', '80.63 E'),
(99, 'Vinukonda', 'Andhra Pradesh', 'India', '16.05 N', '79.75 E'),
(100, 'Visakhapatnam', 'Andhra Pradesh', 'India', '17.73 N', '83.30 E'),
(101, 'Vizianagaram', 'Andhra Pradesh', 'India', '18.12 N', '83.40 E'),
(102, 'Vuyyuru', 'Andhra Pradesh', 'India', '16.37 N', '80.85 E'),
(103, 'Wanparti', 'Andhra Pradesh', 'India', '16.37 N', '78.07 E'),
(104, 'Warangal', 'Andhra Pradesh', 'India', '18.01 N', '79.58 E'),
(105, 'Yemmiganur', 'Andhra Pradesh', 'India', '15.73 N', '77.48 E'),
(106, 'Itanagar', 'Arunachal Pradesh', 'India', '27.14 N', '93.61 E'),
(107, 'Barpeta', 'Assam', 'India', '26.32 N', '91.00 E'),
(108, 'Bongaigaon', 'Assam', 'India', '26.48 N', '90.54 E'),
(109, 'Dhuburi', 'Assam', 'India', '26.03 N', '89.97 E'),
(110, 'Dibrugarh', 'Assam', 'India', '27.49 N', '94.91 E'),
(111, 'Diphu', 'Assam', 'India', '25.84 N', '93.43 E'),
(112, 'Guwahati', 'Assam', 'India', '26.19 N', '91.75 E'),
(113, 'Jorhat', 'Assam', 'India', '26.76 N', '94.20 E'),
(114, 'Karimganj', 'Assam', 'India', '24.85 N', '92.36 E'),
(115, 'Lakhimpur', 'Assam', 'India', '27.24 N', '94.10 E'),
(116, 'Lanka', 'Assam', 'India', '25.93 N', '92.95 E'),
(117, 'Nagaon', 'Assam', 'India', '26.35 N', '92.68 E'),
(118, 'Sibsagar', 'Assam', 'India', '26.99 N', '94.63 E'),
(119, 'Silchar', 'Assam', 'India', '24.83 N', '92.77 E'),
(120, 'Tezpur', 'Assam', 'India', '26.63 N', '92.79 E'),
(121, 'Tinsukia', 'Assam', 'India', '27.50 N', '95.36 E'),
(122, 'Alipur Duar', 'West Bengal', 'India', '26.50 N', '89.53 E'),
(123, 'Arambagh', 'West Bengal', 'India', '22.88 N', '87.78 E'),
(124, 'Asansol', 'West Bengal', 'India', '23.69 N', '86.98 E'),
(125, 'Ashoknagar Kalyangarh', 'West Bengal', 'India', '22.84 N', '88.63 E'),
(126, 'Baharampur', 'West Bengal', 'India', '24.10 N', '88.24 E'),
(127, 'Baidyabati', 'West Bengal', 'India', '22.79 N', '88.33 E'),
(128, 'Baj Baj', 'West Bengal', 'India', '22.48 N', '88.17 E'),
(129, 'Bally', 'West Bengal', 'India', '22.65 N', '88.35 E'),
(130, 'Bally Cantonment', 'West Bengal', 'India', '22.65 N', '88.36 E'),
(131, 'Balurghat', 'West Bengal', 'India', '25.23 N', '88.77 E'),
(132, 'Bangaon', 'West Bengal', 'India', '23.05 N', '88.83 E'),
(133, 'Bankra', 'West Bengal', 'India', '22.58 N', '88.31 E'),
(134, 'Bankura', 'West Bengal', 'India', '23.24 N', '87.07 E'),
(135, 'Bansbaria', 'West Bengal', 'India', '22.95 N', '88.40 E'),
(136, 'Baranagar', 'West Bengal', 'India', '22.64 N', '88.37 E'),
(137, 'Barddhaman', 'West Bengal', 'India', '23.24 N', '87.86 E'),
(138, 'Basirhat', 'West Bengal', 'India', '22.66 N', '88.86 E'),
(139, 'Bhadreswar', 'West Bengal', 'India', '22.84 N', '88.35 E'),
(140, 'Bhatpara', 'West Bengal', 'India', '22.89 N', '88.42 E'),
(141, 'Bidhannagar', 'West Bengal', 'India', '22.57 N', '88.42 E'),
(142, 'Binnaguri', 'West Bengal', 'India', '26.74 N', '89.037 E'),
(143, 'Bishnupur', 'West Bengal', 'India', '23.08 N', '87.33 E'),
(144, 'Bolpur', 'West Bengal', 'India', '23.67 N', '87.70 E'),
(145, 'Calcutta', 'West Bengal', 'India', '22.57 N', '88.36 E'),
(146, 'Chakdaha', 'West Bengal', 'India', '22.48 N', '88.35 E'),
(147, 'Champdani', 'West Bengal', 'India', '22.81 N', '88.34 E'),
(148, 'Chandannagar', 'West Bengal', 'India', '22.89 N', '88.37 E'),
(149, 'Contai', 'West Bengal', 'India', '21.79 N', '87.75 E'),
(150, 'Dabgram', 'West Bengal', 'India', '', ''),
(151, 'Darjiling', 'West Bengal', 'India', '27.05 N', '88.26 E'),
(152, 'Dhulian', 'West Bengal', 'India', '24.68 N', '87.97 E'),
(153, 'Dinhata', 'West Bengal', 'India', '26.13 N', '89.47 E'),
(154, 'Dum Dum', 'West Bengal', 'India', '22.63 N', '88.42 E'),
(155, 'Durgapur', 'West Bengal', 'India', '23.50 N', '87.31 E'),
(156, 'Gangarampur', 'West Bengal', 'India', '25.40 N', '88.52 E'),
(157, 'Garulia', 'West Bengal', 'India', '22.83 N', '88.37 E'),
(158, 'Gayespur', 'West Bengal', 'India', '22.98 N', '88.51 E'),
(159, 'Ghatal', 'West Bengal', 'India', '22.67 N', '87.72 E'),
(160, 'Gopalpur', 'West Bengal', 'India', '', ''),
(161, 'Habra', 'West Bengal', 'India', '22.84 N', '88.62 E'),
(162, 'Halisahar', 'West Bengal', 'India', '22.95 N', '88.42 E'),
(163, 'Haora', 'West Bengal', 'India', '22.58 N', '88.33 E'),
(164, 'HugliChunchura', 'West Bengal', 'India', '22.91 N', '88.40 E'),
(165, 'Ingraj Bazar', 'West Bengal', 'India', '25.01 N', '88.14 E'),
(166, 'Islampur', 'West Bengal', 'India', '26.27 N', '88.20 E'),
(167, 'Jalpaiguri', 'West Bengal', 'India', '26.53 N', '88.71 E'),
(168, 'Jamuria', 'West Bengal', 'India', '23.70 N', '87.08 E'),
(169, 'Jangipur', 'West Bengal', 'India', '24.47 N', '88.07 E'),
(170, 'Jhargram', 'West Bengal', 'India', '22.45 N', '86.98 E'),
(171, 'Kaliyaganj', 'West Bengal', 'India', '25.63 N', '88.32 E'),
(172, 'Kalna', 'West Bengal', 'India', '23.22 N', '88.37 E'),
(173, 'Kalyani', 'West Bengal', 'India', '22.98 N', '88.48 E'),
(174, 'Kamarhati', 'West Bengal', 'India', '22.67 N', '88.37 E'),
(175, 'Kanchrapara', 'West Bengal', 'India', '22.95 N', '88.45 E'),
(176, 'Kandi', 'West Bengal', 'India', '23.95 N', '88.03 E'),
(177, 'Karsiyang', 'West Bengal', 'India', '26.88 N', '88.28 E'),
(178, 'Katwa', 'West Bengal', 'India', '23.65 N', '88.13 E'),
(179, 'Kharagpur', 'West Bengal', 'India', '22.34 N', '87.31 E'),
(180, 'Kharagpur Railway Settlement', 'West Bengal', 'India', '22.34 N', '87.26 E'),
(181, 'Khardaha', 'West Bengal', 'India', '22.73 N', '88.38 E'),
(182, 'Kharia', 'West Bengal', 'India', '', ''),
(183, 'Koch Bihar', 'West Bengal', 'India', '26.33 N', '89.46 E'),
(184, 'Konnagar', 'West Bengal', 'India', '22.70 N', '88.36 E'),
(185, 'Krishnanagar', 'West Bengal', 'India', '23.41 N', '88.51 E'),
(186, 'Kulti', 'West Bengal', 'India', '23.72 N', '86.89 E'),
(187, 'Madhyamgram', 'West Bengal', 'India', '22.70 N', '88.45 E'),
(188, 'Maheshtala', 'West Bengal', 'India', '22.51 N', '88.23 E'),
(189, 'Memari', 'West Bengal', 'India', '23.20 N', '88.12 E'),
(190, 'Midnapur', 'West Bengal', 'India', '22.33 N', '87.15 E'),
(191, 'Naihati', 'West Bengal', 'India', '22.91 N', '88.43 E'),
(192, 'Navadwip', 'West Bengal', 'India', '23.42 N', '88.37 E'),
(193, 'Ni Barakpur', 'West Bengal', 'India', '22.77 N', '88.36 E'),
(194, 'North Barakpur', 'West Bengal', 'India', '22.78 N', '88.37 E'),
(195, 'North Dum Dum', 'West Bengal', 'India', '22.64 N', '88.41 E'),
(196, 'Old Maldah', 'West Bengal', 'India', '', ''),
(197, 'Panihati', 'West Bengal', 'India', '22.69 N', '88.37 E'),
(198, 'Phulia', 'West Bengal', 'India', '23.24 N', '88.50 E'),
(199, 'Pujali', 'West Bengal', 'India', '22.47 N', '88.15 E'),
(200, 'Puruliya', 'West Bengal', 'India', '23.34 N', '86.36 E'),
(201, 'Raiganj', 'West Bengal', 'India', '25.62 N', '88.12 E'),
(202, 'Rajpur', 'West Bengal', 'India', '22.44 N', '88.44 E'),
(203, 'Rampur Hat', 'West Bengal', 'India', '24.17 N', '87.78 E'),
(204, 'Ranaghat', 'West Bengal', 'India', '23.19 N', '88.58 E'),
(205, 'Raniganj', 'West Bengal', 'India', '23.62 N', '87.11 E'),
(206, 'Rishra', 'West Bengal', 'India', '22.71 N', '88.36 E'),
(207, 'Shantipur', 'West Bengal', 'India', '23.26 N', '88.44 E'),
(208, 'Shiliguri', 'West Bengal', 'India', '26.73 N', '88.42 E'),
(209, 'Shrirampur', 'West Bengal', 'India', '22.74 N', '88.35 E'),
(210, 'Siuri', 'West Bengal', 'India', '23.91 N', '87.53 E'),
(211, 'South Dum Dum', 'West Bengal', 'India', '22.61 N', '88.41 E'),
(212, 'Titagarh', 'West Bengal', 'India', '22.74 N', '88.38 E'),
(213, 'Ulubaria', 'West Bengal', 'India', '22.47 N', '88.11 E'),
(214, 'UttarparaKotrung', 'West Bengal', 'India', '22.66 N', '88.35 E'),
(215, 'Araria', 'Bihar', 'India', '26.15 N', '87.52 E'),
(216, 'Arrah', 'Bihar', 'India', '25.56 N', '84.66 E'),
(217, 'Aurangabad', 'Bihar', 'India', '24.75 N', '84.37 E'),
(218, 'Bagaha', 'Bihar', 'India', '27.10 N', '84.09 E'),
(219, 'Begusarai', 'Bihar', 'India', '25.42 N', '86.12 E'),
(220, 'Bettiah', 'Bihar', 'India', '26.81 N', '84.50 E'),
(221, 'Bhabua', 'Bihar', 'India', '25.05 N', '83.62 E'),
(222, 'Bhagalpur', 'Bihar', 'India', '25.26 N', '86.98 E'),
(223, 'Bihar', 'Bihar', 'India', '25.21 N', '85.52 E'),
(224, 'Buxar', 'Bihar', 'India', '25.58 N', '83.98 E'),
(225, 'Chhapra', 'Bihar', 'India', '25.78 N', '84.72 E'),
(226, 'Darbhanga', 'Bihar', 'India', '26.16 N', '85.88 E'),
(227, 'Dehri', 'Bihar', 'India', '24.91 N', '84.18 E'),
(228, 'DighaMainpura', 'Bihar', 'India', '', ''),
(229, 'Dinapur', 'Bihar', 'India', '25.64 N', '85.04 E'),
(230, 'Dumraon', 'Bihar', 'India', '25.55 N', '84.15 E'),
(231, 'Gaya', 'Bihar', 'India', '24.81 N', '85.00 E'),
(232, 'Gopalganj', 'Bihar', 'India', '26.47 N', '84.43 E'),
(233, 'Goura', 'Bihar', 'India', '', ''),
(234, 'Hajipur', 'Bihar', 'India', '', ''),
(235, 'Jahanabad', 'Bihar', 'India', '25.22 N', '84.98 E'),
(236, 'Jamalpur', 'Bihar', 'India', '25.32 N', '86.48 E'),
(237, 'Jamui', 'Bihar', 'India', '24.92 N', '86.22 E'),
(238, 'Katihar', 'Bihar', 'India', '25.55 N', '87.57 E'),
(239, 'Khagaria', 'Bihar', 'India', '25.50 N', '86.48 E'),
(240, 'Khagaul', 'Bihar', 'India', '25.58 N', '85.05 E'),
(241, 'Kishanganj', 'Bihar', 'India', '26.11 N', '87.95 E'),
(242, 'Lakhisarai', 'Bihar', 'India', '25.18 N', '86.09 E'),
(243, 'Madhipura', 'Bihar', 'India', '25.92 N', '86.78 E'),
(244, 'Madhubani', 'Bihar', 'India', '26.37 N', '86.06 E'),
(245, 'Masaurhi', 'Bihar', 'India', '25.35 N', '85.03 E'),
(246, 'Mokama', 'Bihar', 'India', '25.40 N', '85.92 E'),
(247, 'Motihari', 'Bihar', 'India', '26.66 N', '84.91 E'),
(248, 'Munger', 'Bihar', 'India', '25.39 N', '86.47 E'),
(249, 'Muzaffarpur', 'Bihar', 'India', '26.13 N', '85.38 E'),
(250, 'Nawada', 'Bihar', 'India', '24.88 N', '85.54 E'),
(251, 'Patna', 'Bihar', 'India', '25.62 N', '85.13 E'),
(252, 'Phulwari', 'Bihar', 'India', '25.60 N', '85.13 E'),
(253, 'Purnia', 'Bihar', 'India', '25.78 N', '87.47 E'),
(254, 'Raxaul', 'Bihar', 'India', '26.98 N', '84.85 E'),
(255, 'Saharsa', 'Bihar', 'India', '25.88 N', '86.59 E'),
(256, 'Samastipur', 'Bihar', 'India', '25.85 N', '85.78 E'),
(257, 'Sasaram', 'Bihar', 'India', '24.96 N', '84.01 E'),
(258, 'Sitamarhi', 'Bihar', 'India', '26.61 N', '85.48 E'),
(259, 'Siwan', 'Bihar', 'India', '26.23 N', '84.35 E'),
(260, 'Supaul', 'Bihar', 'India', '26.12 N', '86.60 E'),
(261, 'Chandigarh', 'Chandigarh', 'India', '30.75 N', '76.78 E'),
(262, 'Ambikapur', 'Chhattisgarh', 'India', '23.13 N', '83.20 E'),
(263, 'Bhilai', 'Chhattisgarh', 'India', '21.21 N', '81.38 E'),
(264, 'Bilaspur', 'Chhattisgarh', 'India', '22.09 N', '82.15 E'),
(265, 'Charoda', 'Chhattisgarh', 'India', '21.23 N', '81.50 E'),
(266, 'Chirmiri', 'Chhattisgarh', 'India', '23.21 N', '82.41 E'),
(267, 'Dhamtari', 'Chhattisgarh', 'India', '20.71 N', '81.55 E'),
(268, 'Durg', 'Chhattisgarh', 'India', '21.20 N', '81.28 E'),
(269, 'Jagdalpur', 'Chhattisgarh', 'India', '19.09 N', '82.03 E'),
(270, 'Korba', 'Chhattisgarh', 'India', '22.35 N', '82.69 E'),
(271, 'Raigarh', 'Chhattisgarh', 'India', '21.90 N', '83.39 E'),
(272, 'Raipur', 'Chhattisgarh', 'India', '21.24 N', '81.63 E'),
(273, 'Rajnandgaon', 'Chhattisgarh', 'India', '21.10 N', '81.04 E'),
(274, 'Bhalswa Jahangirpur', 'Delhi', 'India', '28.74 N', '77.17 E'),
(275, 'Burari', 'Delhi', 'India', '', ''),
(276, 'Chilla Saroda Bangar', 'Delhi', 'India', '', ''),
(277, 'Dallo Pura', 'Delhi', 'India', '', ''),
(278, 'Delhi', 'Delhi', 'India', '28.67 N', '77.21 E'),
(279, 'Deoli', 'Delhi', 'India', '28.49 N', '77.22 E'),
(280, 'Dilli Cantonment', 'Delhi', 'India', '28.57 N', '77.16 E'),
(281, 'Gharoli', 'Delhi', 'India', '', ''),
(282, 'Gokalpur', 'Delhi', 'India', '28.71 N', '77.28 E'),
(283, 'Hastsal', 'Delhi', 'India', '', ''),
(284, 'Jaffrabad', 'Delhi', 'India', '', ''),
(285, 'Karawal Nagar', 'Delhi', 'India', '', ''),
(286, 'Khajuri Khas', 'Delhi', 'India', '', ''),
(287, 'Kirari Suleman Nagar', 'Delhi', 'India', '', ''),
(288, 'Mandoli', 'Delhi', 'India', '', ''),
(289, 'Mithe Pur', 'Delhi', 'India', '', ''),
(290, 'Molarband', 'Delhi', 'India', '', ''),
(291, 'Mundka', 'Delhi', 'India', '', ''),
(292, 'Mustafabad', 'Delhi', 'India', '', ''),
(293, 'Nangloi Jat', 'Delhi', 'India', '28.68 N', '77.07 E'),
(294, 'Ni Dilli', 'Delhi', 'India', '28.60 N', '77.22 E'),
(295, 'Pul Pehlad', 'Delhi', 'India', '', ''),
(296, 'Puth Kalan', 'Delhi', 'India', '', ''),
(297, 'Roshan Pura', 'Delhi', 'India', '28.60 N', '76.99 E'),
(298, 'Sadat Pur Gujran', 'Delhi', 'India', '', ''),
(299, 'Sultanpur Majra', 'Delhi', 'India', '28.76 N', '77.06 E'),
(300, 'Tajpul', 'Delhi', 'India', '', ''),
(301, 'Tigri', 'Delhi', 'India', '28.50 N', '77.22 E'),
(302, 'Ziauddin Pur', 'Delhi', 'India', '', ''),
(303, 'Madgaon', 'Goa', 'India', '15.28 N', '73.94 E'),
(304, 'Mormugao', 'Goa', 'India', '15.42 N', '73.78 E'),
(305, 'Panaji', 'Goa', 'India', '15.50 N', '73.81 E'),
(306, 'Ahmadabad', 'Gujarat', 'India', '23.03 N', '72.58 E'),
(307, 'Amreli', 'Gujarat', 'India', '21.61 N', '71.22 E'),
(308, 'Anand', 'Gujarat', 'India', '22.56 N', '72.95 E'),
(309, 'Anjar', 'Gujarat', 'India', '23.12 N', '70.02 E'),
(310, 'Bardoli', 'Gujarat', 'India', '21.12 N', '73.12 E'),
(311, 'Bharuch', 'Gujarat', 'India', '21.71 N', '72.97 E'),
(312, 'Bhavnagar', 'Gujarat', 'India', '21.79 N', '72.13 E'),
(313, 'Bhuj', 'Gujarat', 'India', '23.26 N', '69.66 E'),
(314, 'Borsad', 'Gujarat', 'India', '22.42 N', '72.90 E'),
(315, 'Botad', 'Gujarat', 'India', '22.18 N', '71.66 E'),
(316, 'Chandkheda', 'Gujarat', 'India', '23.15 N', '72.61 E'),
(317, 'Chandlodiya', 'Gujarat', 'India', '23.10 N', '72.56 E'),
(318, 'Dabhoi', 'Gujarat', 'India', '22.13 N', '73.41 E'),
(319, 'Dahod', 'Gujarat', 'India', '22.84 N', '74.25 E'),
(320, 'Dholka', 'Gujarat', 'India', '22.74 N', '72.44 E'),
(321, 'Dhoraji', 'Gujarat', 'India', '21.74 N', '70.44 E'),
(322, 'Dhrangadhra', 'Gujarat', 'India', '23.00 N', '71.46 E'),
(323, 'Disa', 'Gujarat', 'India', '24.26 N', '72.18 E'),
(324, 'Gandhidham', 'Gujarat', 'India', '23.07 N', '70.13 E'),
(325, 'Gandhinagar', 'Gujarat', 'India', '23.30 N', '72.63 E'),
(326, 'Ghatlodiya', 'Gujarat', 'India', '23.05 N', '72.55 E'),
(327, 'Godhra', 'Gujarat', 'India', '22.77 N', '73.60 E'),
(328, 'Gondal', 'Gujarat', 'India', '21.97 N', '70.80 E'),
(329, 'Himatnagar', 'Gujarat', 'India', '23.60 N', '72.96 E'),
(330, 'Jamnagar', 'Gujarat', 'India', '22.47 N', '70.07 E'),
(331, 'Jamnagar', 'Gujarat', 'India', '', ''),
(332, 'Jetpur', 'Gujarat', 'India', '21.75 N', '70.61 E'),
(333, 'Junagadh', 'Gujarat', 'India', '21.52 N', '70.45 E'),
(334, 'Kalol', 'Gujarat', 'India', '23.25 N', '72.49 E'),
(335, 'Keshod', 'Gujarat', 'India', '21.31 N', '70.23 E'),
(336, 'Khambhat', 'Gujarat', 'India', '22.32 N', '72.61 E'),
(337, 'Kundla', 'Gujarat', 'India', '21.35 N', '71.30 E'),
(338, 'Mahuva', 'Gujarat', 'India', '21.10 N', '71.75 E'),
(339, 'Mangrol', 'Gujarat', 'India', '21.12 N', '70.12 E'),
(340, 'Modasa', 'Gujarat', 'India', '23.47 N', '73.30 E'),
(341, 'Morvi', 'Gujarat', 'India', '22.82 N', '70.83 E'),
(342, 'Nadiad', 'Gujarat', 'India', '22.70 N', '72.85 E'),
(343, 'Navagam Ghed', 'Gujarat', 'India', '', ''),
(344, 'Navsari', 'Gujarat', 'India', '20.96 N', '72.92 E'),
(345, 'Palitana', 'Gujarat', 'India', '21.52 N', '71.83 E'),
(346, 'Patan', 'Gujarat', 'India', '23.86 N', '72.11 E'),
(347, 'Porbandar', 'Gujarat', 'India', '21.65 N', '69.60 E'),
(348, 'Puna', 'Gujarat', 'India', '', ''),
(349, 'Rajkot', 'Gujarat', 'India', '22.31 N', '70.79 E'),
(350, 'Ramod', 'Gujarat', 'India', '', ''),
(351, 'Ranip', 'Gujarat', 'India', '23.03 N', '72.54 E'),
(352, 'Siddhapur', 'Gujarat', 'India', '23.92 N', '72.37 E'),
(353, 'Sihor', 'Gujarat', 'India', '21.70 N', '71.97 E'),
(354, 'Surat', 'Gujarat', 'India', '21.20 N', '72.82 E'),
(355, 'Surendranagar', 'Gujarat', 'India', '22.71 N', '71.67 E'),
(356, 'Thaltej', 'Gujarat', 'India', '', ''),
(357, 'Una', 'Gujarat', 'India', '20.82 N', '71.03 E'),
(358, 'Unjha', 'Gujarat', 'India', '23.81 N', '72.38 E'),
(359, 'Upleta', 'Gujarat', 'India', '21.75 N', '70.27 E'),
(360, 'Vadodara', 'Gujarat', 'India', '22.31 N', '73.18 E'),
(361, 'Valsad', 'Gujarat', 'India', '20.62 N', '72.92 E'),
(362, 'Vapi', 'Gujarat', 'India', '20.37 N', '72.90 E'),
(363, 'Vastral', 'Gujarat', 'India', '', ''),
(364, 'Vejalpur', 'Gujarat', 'India', '', ''),
(365, 'Veraval', 'Gujarat', 'India', '20.92 N', '70.34 E'),
(366, 'Vijalpor', 'Gujarat', 'India', '', ''),
(367, 'Visnagar', 'Gujarat', 'India', '23.71 N', '72.54 E'),
(368, 'Wadhwan', 'Gujarat', 'India', '22.73 N', '71.72 E'),
(369, 'Ambala', 'Haryana', 'India', '30.38 N', '76.77 E'),
(370, 'Ambala Cantonment', 'Haryana', 'India', '30.39 N', '76.86 E'),
(371, 'Ambala Sadar', 'Haryana', 'India', '30.35 N', '76.84 E'),
(372, 'Bahadurgarh', 'Haryana', 'India', '28.69 N', '76.92 E'),
(373, 'Bhiwani', 'Haryana', 'India', '28.81 N', '76.12 E'),
(374, 'Charkhi Dadri', 'Haryana', 'India', '28.60 N', '76.27 E'),
(375, 'Dabwali', 'Haryana', 'India', '29.95 N', '74.73 E'),
(376, 'Faridabad', 'Haryana', 'India', '28.38 N', '77.30 E'),
(377, 'Gohana', 'Haryana', 'India', '29.13 N', '76.70 E'),
(378, 'Hisar', 'Haryana', 'India', '29.17 N', '75.72 E'),
(379, 'Jagadhri', 'Haryana', 'India', '30.18 N', '77.29 E'),
(380, 'Jind', 'Haryana', 'India', '29.31 N', '76.30 E'),
(381, 'Kaithal', 'Haryana', 'India', '29.81 N', '76.40 E'),
(382, 'Karnal', 'Haryana', 'India', '29.69 N', '76.97 E'),
(383, 'Narnaul', 'Haryana', 'India', '28.04 N', '76.10 E'),
(384, 'Narwana', 'Haryana', 'India', '29.62 N', '76.12 E'),
(385, 'Palwal', 'Haryana', 'India', '28.15 N', '77.32 E'),
(386, 'Panchkula', 'Haryana', 'India', '30.70 N', '76.88 E'),
(387, 'Panipat', 'Haryana', 'India', '29.39 N', '76.96 E'),
(388, 'Rewari', 'Haryana', 'India', '28.19 N', '76.60 E'),
(389, 'Rohtak', 'Haryana', 'India', '28.90 N', '76.58 E'),
(390, 'Sirsa', 'Haryana', 'India', '29.53 N', '75.03 E'),
(391, 'Sonipat', 'Haryana', 'India', '28.99 N', '77.01 E'),
(392, 'Thanesar', 'Haryana', 'India', '29.98 N', '76.82 E'),
(393, 'Tohana', 'Haryana', 'India', '29.70 N', '75.90 E'),
(394, 'Yamunanagar', 'Haryana', 'India', '30.14 N', '77.28 E'),
(395, 'Shimla', 'Himachal Pradesh', 'India', '31.11 N', '77.16 E'),
(396, 'Anantnag', 'Jammu and Kashmir', 'India', '33.73 N', '75.15 E'),
(397, 'Baramula', 'Jammu and Kashmir', 'India', '34.20 N', '74.35 E'),
(398, 'Bari Brahmana', 'Jammu and Kashmir', 'India', '', ''),
(399, 'Jammu', 'Jammu and Kashmir', 'India', '32.71 N', '74.85 E'),
(400, 'Kathua', 'Jammu and Kashmir', 'India', '32.37 N', '75.52 E'),
(401, 'Sopur', 'Jammu and Kashmir', 'India', '34.30 N', '74.47 E'),
(402, 'Srinagar', 'Jammu and Kashmir', 'India', '34.09 N', '74.79 E'),
(403, 'Udhampur', 'Jammu and Kashmir', 'India', '32.93 N', '75.13 E'),
(404, 'Adityapur', 'Jharkhand', 'India', '22.80 N', '86.04 E'),
(405, 'Bagbahra', 'Jharkhand', 'India', '22.82 N', '86.20 E'),
(406, 'Bhuli', 'Jharkhand', 'India', '23.79 N', '86.38 E'),
(407, 'Bokaro', 'Jharkhand', 'India', '23.78 N', '85.96 E'),
(408, 'Chaibasa', 'Jharkhand', 'India', '22.56 N', '85.80 E'),
(409, 'Chas', 'Jharkhand', 'India', '23.65 N', '86.17 E'),
(410, 'Daltenganj', 'Jharkhand', 'India', '24.05 N', '84.06 E'),
(411, 'Devghar', 'Jharkhand', 'India', '24.49 N', '86.69 E'),
(412, 'Dhanbad', 'Jharkhand', 'India', '23.80 N', '86.42 E'),
(413, 'Hazaribag', 'Jharkhand', 'India', '24.01 N', '85.36 E'),
(414, 'Jamshedpur', 'Jharkhand', 'India', '22.79 N', '86.20 E'),
(415, 'Jharia', 'Jharkhand', 'India', '23.76 N', '86.42 E'),
(416, 'Jhumri Tilaiya', 'Jharkhand', 'India', '24.43 N', '85.52 E'),
(417, 'Jorapokhar', 'Jharkhand', 'India', '23.79 N', '86.36 E'),
(418, 'Katras', 'Jharkhand', 'India', '23.80 N', '86.28 E'),
(419, 'Lohardaga', 'Jharkhand', 'India', '23.43 N', '84.68 E'),
(420, 'Mango', 'Jharkhand', 'India', '22.85 N', '86.21 E'),
(421, 'Phusro', 'Jharkhand', 'India', '23.68 N', '85.86 E'),
(422, 'Ramgarh', 'Jharkhand', 'India', '23.63 N', '85.51 E'),
(423, 'Ranchi', 'Jharkhand', 'India', '23.36 N', '85.33 E'),
(424, 'Sahibganj', 'Jharkhand', 'India', '25.25 N', '87.62 E'),
(425, 'Saunda', 'Jharkhand', 'India', '23.64 N', '85.37 E'),
(426, 'Sindari', 'Jharkhand', 'India', '23.68 N', '86.49 E'),
(427, 'Bagalkot', 'Karnataka', 'India', '16.19 N', '75.69 E'),
(428, 'Bangalore', 'Karnataka', 'India', '12.97 N', '77.56 E'),
(429, 'Basavakalyan', 'Karnataka', 'India', '17.87 N', '76.95 E'),
(430, 'Belgaum', 'Karnataka', 'India', '15.86 N', '74.50 E'),
(431, 'Bellary', 'Karnataka', 'India', '15.14 N', '76.91 E'),
(432, 'Bhadravati', 'Karnataka', 'India', '13.84 N', '75.69 E'),
(433, 'Bidar', 'Karnataka', 'India', '17.92 N', '77.52 E'),
(434, 'Bijapur', 'Karnataka', 'India', '16.83 N', '75.71 E'),
(435, 'Bommanahalli', 'Karnataka', 'India', '13.01 N', '77.63 E'),
(436, 'Byatarayanapura', 'Karnataka', 'India', '', ''),
(437, 'Challakere', 'Karnataka', 'India', '14.32 N', '76.65 E'),
(438, 'Chamrajnagar', 'Karnataka', 'India', '11.92 N', '76.95 E'),
(439, 'Channapatna', 'Karnataka', 'India', '12.66 N', '77.19 E'),
(440, 'Chik Ballapur', 'Karnataka', 'India', '13.47 N', '77.73 E'),
(441, 'Chikmagalur', 'Karnataka', 'India', '13.32 N', '75.76 E'),
(442, 'Chintamani', 'Karnataka', 'India', '13.40 N', '78.05 E'),
(443, 'Chitradurga', 'Karnataka', 'India', '14.23 N', '76.39 E'),
(444, 'Dasarahalli', 'Karnataka', 'India', '13.01 N', '77.49 E'),
(445, 'Davanagere', 'Karnataka', 'India', '14.46 N', '75.92 E'),
(446, 'Dod Ballapur', 'Karnataka', 'India', '13.30 N', '77.52 E'),
(447, 'Gadag', 'Karnataka', 'India', '15.44 N', '75.63 E'),
(448, 'Gangawati', 'Karnataka', 'India', '15.44 N', '76.52 E'),
(449, 'Gokak', 'Karnataka', 'India', '16.18 N', '74.81 E'),
(450, 'Gulbarga', 'Karnataka', 'India', '17.34 N', '76.82 E'),
(451, 'Harihar', 'Karnataka', 'India', '14.52 N', '75.80 E'),
(452, 'Hassan', 'Karnataka', 'India', '13.01 N', '76.08 E'),
(453, 'Haveri', 'Karnataka', 'India', '14.80 N', '75.40 E'),
(454, 'Hiriyur', 'Karnataka', 'India', '13.97 N', '76.60 E'),
(455, 'Hosakote', 'Karnataka', 'India', '', ''),
(456, 'Hospet', 'Karnataka', 'India', '15.28 N', '76.37 E'),
(457, 'Hubli', 'Karnataka', 'India', '15.36 N', '75.13 E'),
(458, 'Ilkal', 'Karnataka', 'India', '15.97 N', '76.13 E'),
(459, 'Jamkhandi', 'Karnataka', 'India', '16.51 N', '75.28 E'),
(460, 'Kanakapura', 'Karnataka', 'India', '12.54 N', '77.42 E'),
(461, 'Karwar', 'Karnataka', 'India', '14.82 N', '74.12 E'),
(462, 'Kolar', 'Karnataka', 'India', '13.14 N', '78.13 E'),
(463, 'Kollegal', 'Karnataka', 'India', '12.15 N', '77.12 E'),
(464, 'Koppal', 'Karnataka', 'India', '15.35 N', '76.15 E'),
(465, 'Krishnarajapura', 'Karnataka', 'India', '12.97 N', '77.74 E'),
(466, 'Mahadevapura', 'Karnataka', 'India', '', ''),
(467, 'Maisuru', 'Karnataka', 'India', '12.31 N', '76.65 E'),
(468, 'Mandya', 'Karnataka', 'India', '12.54 N', '76.89 E'),
(469, 'Mangaluru', 'Karnataka', 'India', '12.88 N', '74.84 E'),
(470, 'Nipani', 'Karnataka', 'India', '16.41 N', '74.38 E'),
(471, 'Pattanagere', 'Karnataka', 'India', '', ''),
(472, 'Puttur', 'Karnataka', 'India', '12.77 N', '75.22 E'),
(473, 'Rabkavi', 'Karnataka', 'India', '16.47 N', '75.11 E'),
(474, 'Raichur', 'Karnataka', 'India', '16.21 N', '77.35 E'),
(475, 'Ramanagaram', 'Karnataka', 'India', '12.72 N', '77.27 E'),
(476, 'Ranibennur', 'Karnataka', 'India', '14.62 N', '75.61 E'),
(477, 'Robertsonpet', 'Karnataka', 'India', '12.97 N', '78.28 E'),
(478, 'Sagar', 'Karnataka', 'India', '14.17 N', '75.03 E'),
(479, 'Shahabad', 'Karnataka', 'India', '17.13 N', '76.93 E'),
(480, 'Shahpur', 'Karnataka', 'India', '16.70 N', '76.83 E'),
(481, 'Shimoga', 'Karnataka', 'India', '13.93 N', '75.57 E'),
(482, 'Shorapur', 'Karnataka', 'India', '16.52 N', '76.75 E'),
(483, 'Sidlaghatta', 'Karnataka', 'India', '13.38 N', '77.87 E'),
(484, 'Sira', 'Karnataka', 'India', '13.75 N', '76.90 E'),
(485, 'Sirsi', 'Karnataka', 'India', '14.62 N', '74.85 E'),
(486, 'Tiptur', 'Karnataka', 'India', '13.27 N', '76.48 E'),
(487, 'Tumkur', 'Karnataka', 'India', '13.34 N', '77.10 E'),
(488, 'Udupi', 'Karnataka', 'India', '13.35 N', '74.75 E'),
(489, 'Ullal', 'Karnataka', 'India', '12.80 N', '74.85 E'),
(490, 'Yadgir', 'Karnataka', 'India', '16.77 N', '77.13 E'),
(491, 'Yelahanka', 'Karnataka', 'India', '13.10 N', '77.60 E'),
(492, 'Alappuzha', 'Kerala', 'India', '9.50 N', '76.33 E'),
(493, 'Beypur', 'Kerala', 'India', '11.18 N', '75.82 E'),
(494, 'Cheruvannur', 'Kerala', 'India', '11.21 N', '75.84 E'),
(495, 'Edakkara', 'Kerala', 'India', '', ''),
(496, 'Edathala', 'Kerala', 'India', '10.03 N', '76.32 E'),
(497, 'Kalamassery', 'Kerala', 'India', '10.05 N', '76.27 E'),
(498, 'Kannan Devan Hills', 'Kerala', 'India', '', ''),
(499, 'Kannangad', 'Kerala', 'India', '12.34 N', '75.09 E'),
(500, 'Kannur', 'Kerala', 'India', '11.86 N', '75.35 E'),
(501, 'Kayankulam', 'Kerala', 'India', '9.17 N', '76.49 E'),
(502, 'Kochi', 'Kerala', 'India', '10.02 N', '76.22 E'),
(503, 'Kollam', 'Kerala', 'India', '8.89 N', '76.58 E'),
(504, 'Kottayam', 'Kerala', 'India', '9.60 N', '76.52 E'),
(505, 'Koyilandi', 'Kerala', 'India', '11.43 N', '75.70 E'),
(506, 'Kozhikkod', 'Kerala', 'India', '11.26 N', '75.78 E'),
(507, 'Kunnamkulam', 'Kerala', 'India', '10.65 N', '76.08 E'),
(508, 'Malappuram', 'Kerala', 'India', '11.07 N', '76.06 E'),
(509, 'Manjeri', 'Kerala', 'India', '11.12 N', '76.11 E'),
(510, 'Nedumangad', 'Kerala', 'India', '8.61 N', '77.00 E'),
(511, 'Neyyattinkara', 'Kerala', 'India', '8.40 N', '77.08 E'),
(512, 'Palakkad', 'Kerala', 'India', '10.78 N', '76.65 E'),
(513, 'Pallichal', 'Kerala', 'India', '', ''),
(514, 'Payyannur', 'Kerala', 'India', '12.10 N', '75.19 E'),
(515, 'Ponnani', 'Kerala', 'India', '10.78 N', '75.92 E'),
(516, 'Talipparamba', 'Kerala', 'India', '12.03 N', '75.36 E'),
(517, 'Thalassery', 'Kerala', 'India', '11.75 N', '75.49 E'),
(518, 'Thiruvananthapuram', 'Kerala', 'India', '8.51 N', '76.95 E'),
(519, 'Thrippunithura', 'Kerala', 'India', '9.94 N', '76.35 E'),
(520, 'Thrissur', 'Kerala', 'India', '10.52 N', '76.21 E'),
(521, 'Tirur', 'Kerala', 'India', '10.91 N', '75.92 E'),
(522, 'Tiruvalla', 'Kerala', 'India', '9.39 N', '76.57 E'),
(523, 'Vadakara', 'Kerala', 'India', '11.61 N', '75.58 E'),
(524, 'Ashoknagar', 'Madhya Pradesh', 'India', '24.57 N', '77.72 E'),
(525, 'Balaghat', 'Madhya Pradesh', 'India', '21.80 N', '80.18 E'),
(526, 'Basoda', 'Madhya Pradesh', 'India', '23.85 N', '77.93 E'),
(527, 'Betul', 'Madhya Pradesh', 'India', '21.92 N', '77.90 E'),
(528, 'Bhind', 'Madhya Pradesh', 'India', '26.57 N', '78.77 E'),
(529, 'Bhopal', 'Madhya Pradesh', 'India', '23.24 N', '77.40 E'),
(530, 'BinaEtawa', 'Madhya Pradesh', 'India', '24.20 N', '78.20 E'),
(531, 'Burhanpur', 'Madhya Pradesh', 'India', '21.33 N', '76.22 E'),
(532, 'Chhatarpur', 'Madhya Pradesh', 'India', '24.92 N', '79.58 E'),
(533, 'Chhindwara', 'Madhya Pradesh', 'India', '22.07 N', '78.94 E'),
(534, 'Dabra', 'Madhya Pradesh', 'India', '25.90 N', '78.33 E'),
(535, 'Damoh', 'Madhya Pradesh', 'India', '23.85 N', '79.44 E'),
(536, 'Datia', 'Madhya Pradesh', 'India', '25.67 N', '78.45 E'),
(537, 'Dewas', 'Madhya Pradesh', 'India', '22.97 N', '76.05 E'),
(538, 'Dhar', 'Madhya Pradesh', 'India', '22.60 N', '75.29 E'),
(539, 'Gohad', 'Madhya Pradesh', 'India', '26.43 N', '78.45 E'),
(540, 'Guna', 'Madhya Pradesh', 'India', '24.65 N', '77.30 E'),
(541, 'Gwalior', 'Madhya Pradesh', 'India', '26.23 N', '78.17 E'),
(542, 'Harda', 'Madhya Pradesh', 'India', '22.33 N', '77.11 E'),
(543, 'Hoshangabad', 'Madhya Pradesh', 'India', '22.75 N', '77.71 E'),
(544, 'Indore', 'Madhya Pradesh', 'India', '22.72 N', '75.86 E'),
(545, 'Itarsi', 'Madhya Pradesh', 'India', '22.62 N', '77.76 E'),
(546, 'Jabalpur', 'Madhya Pradesh', 'India', '23.17 N', '79.94 E'),
(547, 'Jabalpur Cantonment', 'Madhya Pradesh', 'India', '23.16 N', '79.95 E'),
(548, 'Jaora', 'Madhya Pradesh', 'India', '23.64 N', '75.11 E'),
(549, 'Khandwa', 'Madhya Pradesh', 'India', '21.83 N', '76.35 E'),
(550, 'Khargone', 'Madhya Pradesh', 'India', '21.83 N', '75.60 E'),
(551, 'Mandidip', 'Madhya Pradesh', 'India', '23.10 N', '77.52 E'),
(552, 'Mandsaur', 'Madhya Pradesh', 'India', '24.07 N', '75.07 E'),
(553, 'Mau', 'Madhya Pradesh', 'India', '22.56 N', '75.75 E'),
(554, 'Morena', 'Madhya Pradesh', 'India', '26.51 N', '77.99 E'),
(555, 'Murwara', 'Madhya Pradesh', 'India', '23.85 N', '80.39 E'),
(556, 'Nagda', 'Madhya Pradesh', 'India', '23.46 N', '75.42 E'),
(557, 'Nimach', 'Madhya Pradesh', 'India', '24.47 N', '74.87 E'),
(558, 'Pithampur', 'Madhya Pradesh', 'India', '', ''),
(559, 'Raghogarh', 'Madhya Pradesh', 'India', '24.45 N', '77.20 E'),
(560, 'Ratlam', 'Madhya Pradesh', 'India', '23.35 N', '75.03 E'),
(561, 'Rewa', 'Madhya Pradesh', 'India', '24.53 N', '81.29 E'),
(562, 'Sagar', 'Madhya Pradesh', 'India', '23.85 N', '78.75 E'),
(563, 'Sarni', 'Madhya Pradesh', 'India', '22.04 N', '78.27 E'),
(564, 'Satna', 'Madhya Pradesh', 'India', '24.58 N', '80.83 E'),
(565, 'Sehore', 'Madhya Pradesh', 'India', '23.20 N', '77.08 E'),
(566, 'Sendhwa', 'Madhya Pradesh', 'India', '21.68 N', '75.10 E'),
(567, 'Seoni', 'Madhya Pradesh', 'India', '22.10 N', '79.55 E'),
(568, 'Shahdol', 'Madhya Pradesh', 'India', '23.30 N', '81.36 E'),
(569, 'Shajapur', 'Madhya Pradesh', 'India', '23.43 N', '76.27 E'),
(570, 'Sheopur', 'Madhya Pradesh', 'India', '25.67 N', '76.70 E'),
(571, 'Shivapuri', 'Madhya Pradesh', 'India', '25.43 N', '77.65 E'),
(572, 'Sidhi', 'Madhya Pradesh', 'India', '24.42 N', '81.88 E'),
(573, 'Singrauli', 'Madhya Pradesh', 'India', '23.84 N', '82.27 E'),
(574, 'Tikamgarh', 'Madhya Pradesh', 'India', '24.74 N', '78.83 E'),
(575, 'Ujjain', 'Madhya Pradesh', 'India', '23.19 N', '75.78 E'),
(576, 'Vidisha', 'Madhya Pradesh', 'India', '23.53 N', '77.80 E'),
(577, 'Achalpur', 'Maharashtra', 'India', '21.26 N', '77.50 E'),
(578, 'Ahmadnagar', 'Maharashtra', 'India', '19.10 N', '74.74 E'),
(579, 'Akola', 'Maharashtra', 'India', '20.71 N', '77.00 E'),
(580, 'Akot', 'Maharashtra', 'India', '21.10 N', '77.05 E'),
(581, 'Amalner', 'Maharashtra', 'India', '21.05 N', '75.06 E'),
(582, 'Ambajogai', 'Maharashtra', 'India', '18.73 N', '76.38 E'),
(583, 'Amravati', 'Maharashtra', 'India', '20.95 N', '77.76 E'),
(584, 'Anjangaon', 'Maharashtra', 'India', '21.16 N', '77.31 E'),
(585, 'Aurangabad', 'Maharashtra', 'India', '19.89 N', '75.32 E'),
(586, 'Badlapur', 'Maharashtra', 'India', '19.15 N', '73.27 E'),
(587, 'Ballarpur', 'Maharashtra', 'India', '19.85 N', '79.35 E'),
(588, 'Baramati', 'Maharashtra', 'India', '18.15 N', '74.58 E'),
(589, 'Barsi', 'Maharashtra', 'India', '18.24 N', '75.69 E'),
(590, 'Basmat', 'Maharashtra', 'India', '19.32 N', '77.17 E'),
(591, 'Bhadravati', 'Maharashtra', 'India', '20.11 N', '79.12 E'),
(592, 'Bhandara', 'Maharashtra', 'India', '21.18 N', '79.65 E'),
(593, 'Bhiwandi', 'Maharashtra', 'India', '19.30 N', '73.05 E'),
(594, 'Bhusawal', 'Maharashtra', 'India', '21.05 N', '75.78 E'),
(595, 'Bid', 'Maharashtra', 'India', '18.99 N', '75.76 E'),
(596, 'Mumbai', 'Maharashtra', 'India', '18.96 N', '72.82 E'),
(597, 'Buldana', 'Maharashtra', 'India', '20.54 N', '76.18 E'),
(598, 'Chalisgaon', 'Maharashtra', 'India', '20.46 N', '74.99 E'),
(599, 'Chandrapur', 'Maharashtra', 'India', '19.96 N', '79.30 E'),
(600, 'Chikhli', 'Maharashtra', 'India', '20.35 N', '76.25 E'),
(601, 'Chiplun', 'Maharashtra', 'India', '17.53 N', '73.52 E'),
(602, 'Chopda', 'Maharashtra', 'India', '21.25 N', '75.28 E'),
(603, 'Dahanu', 'Maharashtra', 'India', '19.97 N', '72.73 E'),
(604, 'Deolali', 'Maharashtra', 'India', '19.95 N', '73.84 E'),
(605, 'Dhule', 'Maharashtra', 'India', '20.90 N', '74.77 E'),
(606, 'Digdoh', 'Maharashtra', 'India', '', ''),
(607, 'Diglur', 'Maharashtra', 'India', '18.55 N', '77.60 E'),
(608, 'Gadchiroli', 'Maharashtra', 'India', '20.17 N', '80.00 E'),
(609, 'Gondiya', 'Maharashtra', 'India', '21.47 N', '80.20 E'),
(610, 'Hinganghat', 'Maharashtra', 'India', '20.56 N', '78.83 E'),
(611, 'Hingoli', 'Maharashtra', 'India', '19.72 N', '77.14 E'),
(612, 'Ichalkaranji', 'Maharashtra', 'India', '16.69 N', '74.46 E'),
(613, 'Jalgaon', 'Maharashtra', 'India', '21.01 N', '75.56 E'),
(614, 'Jalna', 'Maharashtra', 'India', '19.85 N', '75.88 E'),
(615, 'Kalyan', 'Maharashtra', 'India', '19.25 N', '73.16 E'),
(616, 'Kamthi', 'Maharashtra', 'India', '21.23 N', '79.20 E'),
(617, 'Karanja', 'Maharashtra', 'India', '20.48 N', '77.48 E'),
(618, 'Khadki', 'Maharashtra', 'India', '18.57 N', '73.83 E'),
(619, 'Khamgaon', 'Maharashtra', 'India', '20.70 N', '76.56 E'),
(620, 'Khopoli', 'Maharashtra', 'India', '18.78 N', '73.33 E'),
(621, 'Kolhapur', 'Maharashtra', 'India', '16.70 N', '74.22 E'),
(622, 'Kopargaon', 'Maharashtra', 'India', '19.88 N', '74.48 E'),
(623, 'Latur', 'Maharashtra', 'India', '18.41 N', '76.58 E'),
(624, 'Lonavale', 'Maharashtra', 'India', '18.75 N', '73.42 E'),
(625, 'Malegaon', 'Maharashtra', 'India', '20.56 N', '74.52 E'),
(626, 'Malkapur', 'Maharashtra', 'India', '20.90 N', '76.19 E'),
(627, 'Manmad', 'Maharashtra', 'India', '20.26 N', '74.43 E'),
(628, 'Mira Bhayandar', 'Maharashtra', 'India', '19.29 N', '72.85 E'),
(629, 'Nagpur', 'Maharashtra', 'India', '21.16 N', '79.08 E'),
(630, 'Nalasopara', 'Maharashtra', 'India', '19.43 N', '72.78 E'),
(631, 'Nanded', 'Maharashtra', 'India', '19.17 N', '77.29 E'),
(632, 'Nandurbar', 'Maharashtra', 'India', '21.38 N', '74.23 E'),
(633, 'Nashik', 'Maharashtra', 'India', '20.01 N', '73.78 E'),
(634, 'Navghar', 'Maharashtra', 'India', '19.34 N', '72.90 E'),
(635, 'Navi Mumbai', 'Maharashtra', 'India', '19.11 N', '73.06 E'),
(636, 'Navi Mumbai', 'Maharashtra', 'India', '19.00 N', '73.10 E'),
(637, 'Osmanabad', 'Maharashtra', 'India', '18.17 N', '76.03 E'),
(638, 'Palghar', 'Maharashtra', 'India', '19.68 N', '72.75 E'),
(639, 'Pandharpur', 'Maharashtra', 'India', '17.68 N', '75.31 E'),
(640, 'Parbhani', 'Maharashtra', 'India', '19.27 N', '76.76 E'),
(641, 'Phaltan', 'Maharashtra', 'India', '17.98 N', '74.43 E'),
(642, 'Pimpri', 'Maharashtra', 'India', '18.62 N', '73.80 E'),
(643, 'Pune', 'Maharashtra', 'India', '18.53 N', '73.84 E'),
(644, 'Pune Cantonment', 'Maharashtra', 'India', '18.50 N', '73.88 E'),
(645, 'Pusad', 'Maharashtra', 'India', '19.91 N', '77.57 E'),
(646, 'Ratnagiri', 'Maharashtra', 'India', '17.00 N', '73.29 E'),
(647, 'SangliMiraj', 'Maharashtra', 'India', '16.86 N', '74.57 E'),
(648, 'Satara', 'Maharashtra', 'India', '17.70 N', '74.00 E'),
(649, 'Shahada', 'Maharashtra', 'India', '21.55 N', '74.47 E'),
(650, 'Shegaon', 'Maharashtra', 'India', '20.78 N', '76.68 E'),
(651, 'Shirpur', 'Maharashtra', 'India', '21.35 N', '74.88 E'),
(652, 'Sholapur', 'Maharashtra', 'India', '17.67 N', '75.89 E'),
(653, 'Shrirampur', 'Maharashtra', 'India', '19.63 N', '74.64 E'),
(654, 'Sillod', 'Maharashtra', 'India', '20.30 N', '75.65 E'),
(655, 'Thana', 'Maharashtra', 'India', '19.20 N', '72.97 E'),
(656, 'Udgir', 'Maharashtra', 'India', '18.40 N', '77.11 E'),
(657, 'Ulhasnagar', 'Maharashtra', 'India', '19.23 N', '73.15 E'),
(658, 'Uran Islampur', 'Maharashtra', 'India', '17.05 N', '74.27 E'),
(659, 'Vasai', 'Maharashtra', 'India', '19.36 N', '72.80 E'),
(660, 'Virar', 'Maharashtra', 'India', '19.47 N', '72.79 E'),
(661, 'Wadi', 'Maharashtra', 'India', '', ''),
(662, 'Wani', 'Maharashtra', 'India', '20.07 N', '78.95 E'),
(663, 'Wardha', 'Maharashtra', 'India', '20.75 N', '78.60 E'),
(664, 'Warud', 'Maharashtra', 'India', '21.47 N', '78.27 E'),
(665, 'Washim', 'Maharashtra', 'India', '20.10 N', '77.13 E'),
(666, 'Yavatmal', 'Maharashtra', 'India', '20.41 N', '78.13 E'),
(667, 'Imphal', 'Manipur', 'India', '24.79 N', '93.94 E'),
(668, 'Shillong', 'Meghalaya', 'India', '25.57 N', '91.87 E'),
(669, 'Tura', 'Meghalaya', 'India', '25.52 N', '90.22 E'),
(670, 'Aizawl', 'Mizoram', 'India', '23.71 N', '92.71 E'),
(671, 'Lunglei', 'Mizoram', 'India', '22.88 N', '92.73 E'),
(672, 'Dimapur', 'Nagaland', 'India', '25.92 N', '93.73 E'),
(673, 'Kohima', 'Nagaland', 'India', '25.67 N', '94.11 E'),
(674, 'Wokha', 'Nagaland', 'India', '26.10 N', '94.27 E'),
(675, 'Balangir', 'Orissa', 'India', '20.71 N', '83.50 E'),
(676, 'Baleshwar', 'Orissa', 'India', '21.49 N', '86.95 E'),
(677, 'Barbil', 'Orissa', 'India', '22.12 N', '85.40 E'),
(678, 'Bargarh', 'Orissa', 'India', '21.34 N', '83.61 E'),
(679, 'Baripada', 'Orissa', 'India', '21.95 N', '86.73 E'),
(680, 'Bhadrak', 'Orissa', 'India', '21.06 N', '86.52 E'),
(681, 'Bhawanipatna', 'Orissa', 'India', '19.91 N', '83.17 E'),
(682, 'Bhubaneswar', 'Orissa', 'India', '20.27 N', '85.84 E'),
(683, 'Brahmapur', 'Orissa', 'India', '19.32 N', '84.80 E'),
(684, 'Brajrajnagar', 'Orissa', 'India', '21.82 N', '83.91 E'),
(685, 'Dhenkanal', 'Orissa', 'India', '20.67 N', '85.60 E'),
(686, 'Jaypur', 'Orissa', 'India', '18.86 N', '82.56 E'),
(687, 'Jharsuguda', 'Orissa', 'India', '21.87 N', '84.01 E'),
(688, 'Kataka', 'Orissa', 'India', '20.47 N', '85.88 E'),
(689, 'Kendujhar', 'Orissa', 'India', '21.63 N', '85.58 E'),
(690, 'Paradwip', 'Orissa', 'India', '20.32 N', '86.62 E'),
(691, 'Puri', 'Orissa', 'India', '19.81 N', '85.83 E'),
(692, 'Raurkela', 'Orissa', 'India', '22.24 N', '84.81 E'),
(693, 'Raurkela Industrial Township', 'Orissa', 'India', '', ''),
(694, 'Rayagada', 'Orissa', 'India', '19.18 N', '83.41 E'),
(695, 'Sambalpur', 'Orissa', 'India', '21.47 N', '83.97 E'),
(696, 'Sunabeda', 'Orissa', 'India', '18.69 N', '82.86 E'),
(697, 'Karaikal', 'Pondicherry', 'India', '10.93 N', '79.83 E'),
(698, 'Ozhukarai', 'Pondicherry', 'India', '11.94 N', '79.77 E'),
(699, 'Pondicherry', 'Pondicherry', 'India', '11.94 N', '79.83 E'),
(700, 'Abohar', 'Punjab', 'India', '30.14 N', '74.20 E'),
(701, 'Amritsar', 'Punjab', 'India', '31.64 N', '74.87 E'),
(702, 'Barnala', 'Punjab', 'India', '30.39 N', '75.54 E'),
(703, 'Batala', 'Punjab', 'India', '31.82 N', '75.21 E'),
(704, 'Bathinda', 'Punjab', 'India', '30.17 N', '74.97 E'),
(705, 'Dhuri', 'Punjab', 'India', '30.37 N', '75.87 E'),
(706, 'Faridkot', 'Punjab', 'India', '30.68 N', '74.74 E'),
(707, 'Fazilka', 'Punjab', 'India', '30.41 N', '74.02 E'),
(708, 'Firozpur', 'Punjab', 'India', '30.92 N', '74.61 E'),
(709, 'Firozpur Cantonment', 'Punjab', 'India', '30.95 N', '74.60 E'),
(710, 'Gobindgarh', 'Punjab', 'India', '30.66 N', '76.31 E'),
(711, 'Gurdaspur', 'Punjab', 'India', '32.04 N', '75.40 E'),
(712, 'Hoshiarpur', 'Punjab', 'India', '31.53 N', '75.91 E'),
(713, 'Jagraon', 'Punjab', 'India', '30.78 N', '75.48 E'),
(714, 'Jalandhar', 'Punjab', 'India', '31.33 N', '75.57 E'),
(715, 'Kapurthala', 'Punjab', 'India', '31.38 N', '75.38 E'),
(716, 'Khanna', 'Punjab', 'India', '30.71 N', '76.21 E'),
(717, 'Kot Kapura', 'Punjab', 'India', '30.59 N', '74.80 E'),
(718, 'Ludhiana', 'Punjab', 'India', '30.91 N', '75.84 E'),
(719, 'Malaut', 'Punjab', 'India', '30.23 N', '74.48 E'),
(720, 'Maler Kotla', 'Punjab', 'India', '30.54 N', '75.87 E'),
(721, 'Mansa', 'Punjab', 'India', '29.98 N', '75.39 E'),
(722, 'Moga', 'Punjab', 'India', '30.82 N', '75.17 E'),
(723, 'Mohali', 'Punjab', 'India', '30.78 N', '76.69 E'),
(724, 'Pathankot', 'Punjab', 'India', '32.27 N', '75.64 E'),
(725, 'Patiala', 'Punjab', 'India', '30.32 N', '76.39 E'),
(726, 'Phagwara', 'Punjab', 'India', '31.22 N', '75.76 E'),
(727, 'Rajpura', 'Punjab', 'India', '30.48 N', '76.59 E'),
(728, 'Rupnagar', 'Punjab', 'India', '30.98 N', '76.52 E'),
(729, 'Samana', 'Punjab', 'India', '30.15 N', '76.20 E'),
(730, 'Sangrur', 'Punjab', 'India', '30.25 N', '75.84 E'),
(731, 'Sirhind', 'Punjab', 'India', '30.65 N', '76.38 E'),
(732, 'Sunam', 'Punjab', 'India', '30.13 N', '75.80 E'),
(733, 'Tarn Taran', 'Punjab', 'India', '31.45 N', '74.92 E'),
(734, 'Ajmer', 'Rajasthan', 'India', '26.45 N', '74.64 E'),
(735, 'Alwar', 'Rajasthan', 'India', '27.56 N', '76.60 E'),
(736, 'Balotra', 'Rajasthan', 'India', '25.83 N', '72.23 E'),
(737, 'Banswara', 'Rajasthan', 'India', '23.54 N', '74.44 E'),
(738, 'Baran', 'Rajasthan', 'India', '25.10 N', '76.51 E'),
(739, 'Bari', 'Rajasthan', 'India', '26.65 N', '77.60 E'),
(740, 'Barmer', 'Rajasthan', 'India', '25.75 N', '71.39 E'),
(741, 'Beawar', 'Rajasthan', 'India', '26.10 N', '74.30 E'),
(742, 'Bharatpur', 'Rajasthan', 'India', '27.23 N', '77.49 E'),
(743, 'Bhilwara', 'Rajasthan', 'India', '25.35 N', '74.63 E'),
(744, 'Bhiwadi', 'Rajasthan', 'India', '', ''),
(745, 'Bikaner', 'Rajasthan', 'India', '28.03 N', '73.32 E'),
(746, 'Bundi', 'Rajasthan', 'India', '25.45 N', '75.63 E'),
(747, 'Chittaurgarh', 'Rajasthan', 'India', '24.89 N', '74.63 E'),
(748, 'Chomun', 'Rajasthan', 'India', '27.17 N', '75.72 E'),
(749, 'Churu', 'Rajasthan', 'India', '28.31 N', '74.96 E'),
(750, 'Daosa', 'Rajasthan', 'India', '26.88 N', '76.33 E'),
(751, 'Dhaulpur', 'Rajasthan', 'India', '26.70 N', '77.87 E'),
(752, 'Didwana', 'Rajasthan', 'India', '27.39 N', '74.57 E'),
(753, 'Fatehpur', 'Rajasthan', 'India', '27.99 N', '74.95 E'),
(754, 'Ganganagar', 'Rajasthan', 'India', '29.93 N', '73.86 E'),
(755, 'Gangapur', 'Rajasthan', 'India', '26.47 N', '76.72 E'),
(756, 'Hanumangarh', 'Rajasthan', 'India', '29.62 N', '74.29 E'),
(757, 'Hindaun', 'Rajasthan', 'India', '26.74 N', '77.02 E'),
(758, 'Jaipur', 'Rajasthan', 'India', '26.92 N', '75.80 E'),
(759, 'Jaisalmer', 'Rajasthan', 'India', '26.92 N', '70.90 E'),
(760, 'Jalor', 'Rajasthan', 'India', '25.35 N', '72.62 E'),
(761, 'Jhalawar', 'Rajasthan', 'India', '24.60 N', '76.15 E'),
(762, 'Jhunjhunun', 'Rajasthan', 'India', '28.13 N', '75.39 E'),
(763, 'Jodhpur', 'Rajasthan', 'India', '26.29 N', '73.02 E'),
(764, 'Karauli', 'Rajasthan', 'India', '26.50 N', '77.02 E'),
(765, 'Kishangarh', 'Rajasthan', 'India', '26.58 N', '74.86 E'),
(766, 'Kota', 'Rajasthan', 'India', '25.18 N', '75.83 E'),
(767, 'Kuchaman', 'Rajasthan', 'India', '27.15 N', '74.85 E'),
(768, 'Ladnun', 'Rajasthan', 'India', '27.64 N', '74.38 E'),
(769, 'Makrana', 'Rajasthan', 'India', '27.05 N', '74.72 E'),
(770, 'Nagaur', 'Rajasthan', 'India', '27.21 N', '73.73 E'),
(771, 'Nawalgarh', 'Rajasthan', 'India', '27.85 N', '75.27 E'),
(772, 'Nimbahera', 'Rajasthan', 'India', '24.62 N', '74.68 E'),
(773, 'Nokha', 'Rajasthan', 'India', '27.60 N', '73.42 E'),
(774, 'Pali', 'Rajasthan', 'India', '25.79 N', '73.32 E'),
(775, 'Rajsamand', 'Rajasthan', 'India', '25.07 N', '73.88 E'),
(776, 'Ratangarh', 'Rajasthan', 'India', '28.09 N', '74.60 E'),
(777, 'Sardarshahr', 'Rajasthan', 'India', '28.45 N', '74.48 E'),
(778, 'Sawai Madhopur', 'Rajasthan', 'India', '26.03 N', '76.34 E'),
(779, 'Sikar', 'Rajasthan', 'India', '27.61 N', '75.13 E'),
(780, 'Sujangarh', 'Rajasthan', 'India', '27.70 N', '74.46 E'),
(781, 'Suratgarh', 'Rajasthan', 'India', '29.32 N', '73.90 E'),
(782, 'Tonk', 'Rajasthan', 'India', '26.17 N', '75.78 E'),
(783, 'Udaipur', 'Rajasthan', 'India', '24.58 N', '73.69 E'),
(784, 'Alandur', 'Tamil Nadu', 'India', '13.03 N', '80.23 E'),
(785, 'Ambattur', 'Tamil Nadu', 'India', '13.11 N', '80.17 E'),
(786, 'Ambur', 'Tamil Nadu', 'India', '12.80 N', '78.72 E'),
(787, 'Arakonam', 'Tamil Nadu', 'India', '13.08 N', '79.67 E'),
(788, 'Arani', 'Tamil Nadu', 'India', '12.68 N', '79.28 E'),
(789, 'Aruppukkottai', 'Tamil Nadu', 'India', '9.51 N', '78.09 E'),
(790, 'Attur', 'Tamil Nadu', 'India', '11.60 N', '78.60 E'),
(791, 'Avadi', 'Tamil Nadu', 'India', '13.12 N', '80.11 E'),
(792, 'Avaniapuram', 'Tamil Nadu', 'India', '9.86 N', '78.12 E'),
(793, 'Bodinayakkanur', 'Tamil Nadu', 'India', '10.01 N', '77.35 E'),
(794, 'Chengalpattu', 'Tamil Nadu', 'India', '12.70 N', '79.97 E'),
(795, 'Dharapuram', 'Tamil Nadu', 'India', '10.74 N', '77.52 E'),
(796, 'Dharmapuri', 'Tamil Nadu', 'India', '12.13 N', '78.16 E'),
(797, 'Dindigul', 'Tamil Nadu', 'India', '10.36 N', '77.97 E'),
(798, 'Erode', 'Tamil Nadu', 'India', '11.35 N', '77.73 E'),
(799, 'Gopichettipalaiyam', 'Tamil Nadu', 'India', '11.46 N', '77.43 E'),
(800, 'Gudalur', 'Tamil Nadu', 'India', '11.76 N', '79.75 E'),
(801, 'Gudiyattam', 'Tamil Nadu', 'India', '12.95 N', '78.86 E'),
(802, 'Hosur', 'Tamil Nadu', 'India', '12.72 N', '77.82 E'),
(803, 'Idappadi', 'Tamil Nadu', 'India', '11.58 N', '77.85 E'),
(804, 'Kadayanallur', 'Tamil Nadu', 'India', '9.08 N', '77.35 E'),
(805, 'Kambam', 'Tamil Nadu', 'India', '9.74 N', '77.28 E'),
(806, 'Kanchipuram', 'Tamil Nadu', 'India', '12.84 N', '79.70 E'),
(807, 'Karur', 'Tamil Nadu', 'India', '10.96 N', '78.07 E'),
(808, 'Kavundampalaiyam', 'Tamil Nadu', 'India', '11.05 N', '76.92 E'),
(809, 'Kovilpatti', 'Tamil Nadu', 'India', '9.19 N', '77.86 E'),
(810, 'Koyampattur', 'Tamil Nadu', 'India', '11.01 N', '76.96 E'),
(811, 'Krishnagiri', 'Tamil Nadu', 'India', '12.54 N', '78.21 E'),
(812, 'Kumarapalaiyam', 'Tamil Nadu', 'India', '11.44 N', '77.73 E'),
(813, 'Kumbakonam', 'Tamil Nadu', 'India', '10.97 N', '79.38 E'),
(814, 'Kuniyamuthur', 'Tamil Nadu', 'India', '10.98 N', '76.95 E'),
(815, 'Kurichi', 'Tamil Nadu', 'India', '10.92 N', '76.96 E'),
(816, 'Madhavaram', 'Tamil Nadu', 'India', '13.02 N', '80.26 E'),
(817, 'Madras', 'Tamil Nadu', 'India', '13.09 N', '80.27 E'),
(818, 'Madurai', 'Tamil Nadu', 'India', '9.92 N', '78.12 E'),
(819, 'Maduravoyal', 'Tamil Nadu', 'India', '', ''),
(820, 'Mannargudi', 'Tamil Nadu', 'India', '10.67 N', '79.45 E'),
(821, 'Mayiladuthurai', 'Tamil Nadu', 'India', '11.11 N', '79.65 E');
INSERT INTO `cities` (`city_id`, `city_name`, `city_state`, `city_country`, `latitude`, `longitude`) VALUES
(822, 'Mettupalayam', 'Tamil Nadu', 'India', '11.30 N', '76.94 E'),
(823, 'Mettur', 'Tamil Nadu', 'India', '11.80 N', '77.80 E'),
(824, 'Nagapattinam', 'Tamil Nadu', 'India', '10.80 N', '79.84 E'),
(825, 'Nagercoil', 'Tamil Nadu', 'India', '8.18 N', '77.43 E'),
(826, 'Namakkal', 'Tamil Nadu', 'India', '11.23 N', '78.17 E'),
(827, 'Nerkunram', 'Tamil Nadu', 'India', '13.04 N', '80.26 E'),
(828, 'Neyveli', 'Tamil Nadu', 'India', '11.62 N', '79.48 E'),
(829, 'Pallavaram', 'Tamil Nadu', 'India', '12.99 N', '80.16 E'),
(830, 'Pammal', 'Tamil Nadu', 'India', '12.97 N', '80.11 E'),
(831, 'Pannuratti', 'Tamil Nadu', 'India', '11.78 N', '79.55 E'),
(832, 'Paramakkudi', 'Tamil Nadu', 'India', '9.54 N', '78.59 E'),
(833, 'Pattukkottai', 'Tamil Nadu', 'India', '10.43 N', '79.31 E'),
(834, 'Pollachi', 'Tamil Nadu', 'India', '10.67 N', '77.00 E'),
(835, 'Pudukkottai', 'Tamil Nadu', 'India', '10.39 N', '78.82 E'),
(836, 'Puliyankudi', 'Tamil Nadu', 'India', '9.18 N', '77.40 E'),
(837, 'Punamalli', 'Tamil Nadu', 'India', '13.05 N', '80.11 E'),
(838, 'Rajapalaiyam', 'Tamil Nadu', 'India', '9.46 N', '77.55 E'),
(839, 'Ramanathapuram', 'Tamil Nadu', 'India', '9.37 N', '78.83 E'),
(840, 'Salem', 'Tamil Nadu', 'India', '11.67 N', '78.16 E'),
(841, 'Sankarankoil', 'Tamil Nadu', 'India', '9.17 N', '77.54 E'),
(842, 'Sivakasi', 'Tamil Nadu', 'India', '9.46 N', '77.79 E'),
(843, 'Srivilliputtur', 'Tamil Nadu', 'India', '9.52 N', '77.63 E'),
(844, 'Tambaram', 'Tamil Nadu', 'India', '12.93 N', '80.12 E'),
(845, 'Tenkasi', 'Tamil Nadu', 'India', '8.96 N', '77.31 E'),
(846, 'Thanjavur', 'Tamil Nadu', 'India', '10.79 N', '79.13 E'),
(847, 'Theni Allinagaram', 'Tamil Nadu', 'India', '10.02 N', '77.48 E'),
(848, 'Thiruthangal', 'Tamil Nadu', 'India', '9.48 N', '77.83 E'),
(849, 'Thiruvarur', 'Tamil Nadu', 'India', '10.78 N', '79.64 E'),
(850, 'Thuthukkudi', 'Tamil Nadu', 'India', '8.81 N', '78.14 E'),
(851, 'Tindivanam', 'Tamil Nadu', 'India', '12.24 N', '79.65 E'),
(852, 'Tiruchchirappalli', 'Tamil Nadu', 'India', '10.81 N', '78.69 E'),
(853, 'Tiruchengode', 'Tamil Nadu', 'India', '11.38 N', '77.90 E'),
(854, 'Tirunelveli', 'Tamil Nadu', 'India', '8.73 N', '77.69 E'),
(855, 'Tirupathur', 'Tamil Nadu', 'India', '12.50 N', '78.57 E'),
(856, 'Tiruppur', 'Tamil Nadu', 'India', '11.09 N', '77.35 E'),
(857, 'Tiruvannamalai', 'Tamil Nadu', 'India', '12.24 N', '79.07 E'),
(858, 'Tiruvottiyur', 'Tamil Nadu', 'India', '13.16 N', '80.29 E'),
(859, 'Udagamandalam', 'Tamil Nadu', 'India', '11.42 N', '76.69 E'),
(860, 'Udumalaipettai', 'Tamil Nadu', 'India', '10.58 N', '77.24 E'),
(861, 'Valparai', 'Tamil Nadu', 'India', '10.38 N', '76.99 E'),
(862, 'Vaniyambadi', 'Tamil Nadu', 'India', '12.69 N', '78.60 E'),
(863, 'Velampalaiyam', 'Tamil Nadu', 'India', '', ''),
(864, 'Velluru', 'Tamil Nadu', 'India', '12.92 N', '79.13 E'),
(865, 'Viluppuram', 'Tamil Nadu', 'India', '11.95 N', '79.49 E'),
(866, 'Virappanchatram', 'Tamil Nadu', 'India', '11.40 N', '77.70 E'),
(867, 'Virudhachalam', 'Tamil Nadu', 'India', '11.51 N', '79.32 E'),
(868, 'Virudunagar', 'Tamil Nadu', 'India', '9.59 N', '77.95 E'),
(869, 'Agartala', 'Tripura', 'India', '23.84 N', '91.27 E'),
(870, 'Agartala MCl', 'Tripura', 'India', '', ''),
(871, 'Badharghat', 'Tripura', 'India', '', ''),
(872, 'Agra', 'Uttar Pradesh', 'India', '27.19 N', '78.01 E'),
(873, 'Aligarh', 'Uttar Pradesh', 'India', '27.89 N', '78.06 E'),
(874, 'Allahabad', 'Uttar Pradesh', 'India', '25.45 N', '81.84 E'),
(875, 'Amroha', 'Uttar Pradesh', 'India', '28.91 N', '78.46 E'),
(876, 'Aonla', 'Uttar Pradesh', 'India', '28.28 N', '79.15 E'),
(877, 'Auraiya', 'Uttar Pradesh', 'India', '26.47 N', '79.50 E'),
(878, 'Ayodhya', 'Uttar Pradesh', 'India', '26.80 N', '82.20 E'),
(879, 'Azamgarh', 'Uttar Pradesh', 'India', '26.07 N', '83.18 E'),
(880, 'Baheri', 'Uttar Pradesh', 'India', '28.78 N', '79.50 E'),
(881, 'Bahraich', 'Uttar Pradesh', 'India', '27.58 N', '81.59 E'),
(882, 'Ballia', 'Uttar Pradesh', 'India', '25.76 N', '84.15 E'),
(883, 'Balrampur', 'Uttar Pradesh', 'India', '27.43 N', '82.18 E'),
(884, 'Banda', 'Uttar Pradesh', 'India', '25.48 N', '80.33 E'),
(885, 'Baraut', 'Uttar Pradesh', 'India', '29.10 N', '77.26 E'),
(886, 'Bareli', 'Uttar Pradesh', 'India', '28.36 N', '79.41 E'),
(887, 'Basti', 'Uttar Pradesh', 'India', '26.80 N', '82.74 E'),
(888, 'Behta Hajipur', 'Uttar Pradesh', 'India', '', ''),
(889, 'Bela', 'Uttar Pradesh', 'India', '25.92 N', '81.99 E'),
(890, 'Bhadohi', 'Uttar Pradesh', 'India', '25.40 N', '82.56 E'),
(891, 'Bijnor', 'Uttar Pradesh', 'India', '29.38 N', '78.13 E'),
(892, 'Bisalpur', 'Uttar Pradesh', 'India', '28.30 N', '79.80 E'),
(893, 'Biswan', 'Uttar Pradesh', 'India', '27.50 N', '81.00 E'),
(894, 'Budaun', 'Uttar Pradesh', 'India', '28.04 N', '79.12 E'),
(895, 'Bulandshahr', 'Uttar Pradesh', 'India', '28.41 N', '77.85 E'),
(896, 'Chandausi', 'Uttar Pradesh', 'India', '28.46 N', '78.78 E'),
(897, 'Chandpur', 'Uttar Pradesh', 'India', '29.14 N', '78.27 E'),
(898, 'Chhibramau', 'Uttar Pradesh', 'India', '27.15 N', '79.52 E'),
(899, 'Chitrakut Dham', 'Uttar Pradesh', 'India', '25.20 N', '80.84 E'),
(900, 'Dadri', 'Uttar Pradesh', 'India', '28.57 N', '77.55 E'),
(901, 'Deoband', 'Uttar Pradesh', 'India', '29.70 N', '77.67 E'),
(902, 'Deoria', 'Uttar Pradesh', 'India', '26.51 N', '83.78 E'),
(903, 'Etah', 'Uttar Pradesh', 'India', '27.57 N', '78.64 E'),
(904, 'Etawah', 'Uttar Pradesh', 'India', '26.78 N', '79.01 E'),
(905, 'Faizabad', 'Uttar Pradesh', 'India', '26.78 N', '82.14 E'),
(906, 'Faridpur', 'Uttar Pradesh', 'India', '28.22 N', '79.53 E'),
(907, 'Farrukhabad', 'Uttar Pradesh', 'India', '27.40 N', '79.57 E'),
(908, 'Fatehpur', 'Uttar Pradesh', 'India', '25.93 N', '80.81 E'),
(909, 'Firozabad', 'Uttar Pradesh', 'India', '27.15 N', '78.39 E'),
(910, 'Gajraula', 'Uttar Pradesh', 'India', '28.85 N', '78.23 E'),
(911, 'Ganga Ghat', 'Uttar Pradesh', 'India', '26.52 N', '80.45 E'),
(912, 'Gangoh', 'Uttar Pradesh', 'India', '29.77 N', '77.25 E'),
(913, 'Ghaziabad', 'Uttar Pradesh', 'India', '28.66 N', '77.41 E'),
(914, 'Ghazipur', 'Uttar Pradesh', 'India', '25.59 N', '83.59 E'),
(915, 'Gola Gokarannath', 'Uttar Pradesh', 'India', '28.08 N', '80.47 E'),
(916, 'Gonda', 'Uttar Pradesh', 'India', '27.14 N', '81.95 E'),
(917, 'Gorakhpur', 'Uttar Pradesh', 'India', '26.76 N', '83.36 E'),
(918, 'Hapur', 'Uttar Pradesh', 'India', '28.73 N', '77.77 E'),
(919, 'Hardoi', 'Uttar Pradesh', 'India', '27.42 N', '80.12 E'),
(920, 'Hasanpur', 'Uttar Pradesh', 'India', '28.72 N', '78.28 E'),
(921, 'Hathras', 'Uttar Pradesh', 'India', '27.60 N', '78.04 E'),
(922, 'Jahangirabad', 'Uttar Pradesh', 'India', '28.42 N', '78.10 E'),
(923, 'Jalaun', 'Uttar Pradesh', 'India', '26.15 N', '79.35 E'),
(924, 'Jaunpur', 'Uttar Pradesh', 'India', '25.76 N', '82.69 E'),
(925, 'Jhansi', 'Uttar Pradesh', 'India', '25.45 N', '78.56 E'),
(926, 'Kadi', 'Uttar Pradesh', 'India', '23.31 N', '72.33 E'),
(927, 'Kairana', 'Uttar Pradesh', 'India', '29.40 N', '77.20 E'),
(928, 'Kannauj', 'Uttar Pradesh', 'India', '27.06 N', '79.91 E'),
(929, 'Kanpur', 'Uttar Pradesh', 'India', '26.47 N', '80.33 E'),
(930, 'Kanpur Cantonment', 'Uttar Pradesh', 'India', '26.50 N', '80.28 E'),
(931, 'Kasganj', 'Uttar Pradesh', 'India', '27.81 N', '78.63 E'),
(932, 'Khatauli', 'Uttar Pradesh', 'India', '29.28 N', '77.72 E'),
(933, 'Khora', 'Uttar Pradesh', 'India', '', ''),
(934, 'Khurja', 'Uttar Pradesh', 'India', '28.26 N', '77.85 E'),
(935, 'Kiratpur', 'Uttar Pradesh', 'India', '29.52 N', '78.20 E'),
(936, 'Kosi Kalan', 'Uttar Pradesh', 'India', '27.80 N', '77.44 E'),
(937, 'Laharpur', 'Uttar Pradesh', 'India', '27.72 N', '80.90 E'),
(938, 'Lakhimpur', 'Uttar Pradesh', 'India', '27.95 N', '80.78 E'),
(939, 'Lakhnau', 'Uttar Pradesh', 'India', '26.85 N', '80.92 E'),
(940, 'Lakhnau Cantonment', 'Uttar Pradesh', 'India', '26.81 N', '80.97 E'),
(941, 'Lalitpur', 'Uttar Pradesh', 'India', '24.70 N', '78.41 E'),
(942, 'Loni', 'Uttar Pradesh', 'India', '28.75 N', '77.28 E'),
(943, 'Mahoba', 'Uttar Pradesh', 'India', '25.30 N', '79.87 E'),
(944, 'Mainpuri', 'Uttar Pradesh', 'India', '27.24 N', '79.02 E'),
(945, 'Mathura', 'Uttar Pradesh', 'India', '27.50 N', '77.68 E'),
(946, 'Mau', 'Uttar Pradesh', 'India', '25.96 N', '83.56 E'),
(947, 'Mauranipur', 'Uttar Pradesh', 'India', '25.24 N', '79.13 E'),
(948, 'Mawana', 'Uttar Pradesh', 'India', '29.11 N', '77.91 E'),
(949, 'Mirat', 'Uttar Pradesh', 'India', '28.99 N', '77.70 E'),
(950, 'Mirat Cantonment', 'Uttar Pradesh', 'India', '29.02 N', '77.67 E'),
(951, 'Mirzapur', 'Uttar Pradesh', 'India', '25.16 N', '82.56 E'),
(952, 'Modinagar', 'Uttar Pradesh', 'India', '28.92 N', '77.62 E'),
(953, 'Moradabad', 'Uttar Pradesh', 'India', '28.84 N', '78.76 E'),
(954, 'Mubarakpur', 'Uttar Pradesh', 'India', '26.09 N', '83.28 E'),
(955, 'Mughal Sarai', 'Uttar Pradesh', 'India', '25.30 N', '83.12 E'),
(956, 'Muradnagar', 'Uttar Pradesh', 'India', '28.78 N', '77.50 E'),
(957, 'Muzaffarnagar', 'Uttar Pradesh', 'India', '29.48 N', '77.69 E'),
(958, 'Nagina', 'Uttar Pradesh', 'India', '29.45 N', '78.43 E'),
(959, 'Najibabad', 'Uttar Pradesh', 'India', '29.62 N', '78.33 E'),
(960, 'Nawabganj', 'Uttar Pradesh', 'India', '26.94 N', '81.19 E'),
(961, 'Noida', 'Uttar Pradesh', 'India', '28.58 N', '77.33 E'),
(962, 'Obra', 'Uttar Pradesh', 'India', '24.42 N', '82.98 E'),
(963, 'Orai', 'Uttar Pradesh', 'India', '25.99 N', '79.45 E'),
(964, 'Pilibhit', 'Uttar Pradesh', 'India', '28.64 N', '79.81 E'),
(965, 'Pilkhuwa', 'Uttar Pradesh', 'India', '28.72 N', '77.65 E'),
(966, 'Rae Bareli', 'Uttar Pradesh', 'India', '26.23 N', '81.23 E'),
(967, 'Ramgarh Nagla Kothi', 'Uttar Pradesh', 'India', '', ''),
(968, 'Rampur', 'Uttar Pradesh', 'India', '28.82 N', '79.02 E'),
(969, 'Rath', 'Uttar Pradesh', 'India', '25.58 N', '79.57 E'),
(970, 'Renukut', 'Uttar Pradesh', 'India', '24.20 N', '83.03 E'),
(971, 'Saharanpur', 'Uttar Pradesh', 'India', '29.97 N', '77.54 E'),
(972, 'Sahaswan', 'Uttar Pradesh', 'India', '28.08 N', '78.74 E'),
(973, 'Sambhal', 'Uttar Pradesh', 'India', '28.59 N', '78.56 E'),
(974, 'Sandila', 'Uttar Pradesh', 'India', '27.08 N', '80.52 E'),
(975, 'Shahabad', 'Uttar Pradesh', 'India', '27.65 N', '79.95 E'),
(976, 'Shahjahanpur', 'Uttar Pradesh', 'India', '27.88 N', '79.90 E'),
(977, 'Shamli', 'Uttar Pradesh', 'India', '29.46 N', '77.31 E'),
(978, 'Sherkot', 'Uttar Pradesh', 'India', '29.35 N', '78.58 E'),
(979, 'Shikohabad', 'Uttar Pradesh', 'India', '27.12 N', '78.58 E'),
(980, 'Sikandarabad', 'Uttar Pradesh', 'India', '28.44 N', '77.69 E'),
(981, 'Sitapur', 'Uttar Pradesh', 'India', '27.57 N', '80.69 E'),
(982, 'Sukhmalpur Nizamabad', 'Uttar Pradesh', 'India', '', ''),
(983, 'Sultanpur', 'Uttar Pradesh', 'India', '26.26 N', '82.06 E'),
(984, 'Tanda', 'Uttar Pradesh', 'India', '26.55 N', '82.65 E'),
(985, 'Tilhar', 'Uttar Pradesh', 'India', '27.98 N', '79.73 E'),
(986, 'Tundla', 'Uttar Pradesh', 'India', '27.20 N', '78.28 E'),
(987, 'Ujhani', 'Uttar Pradesh', 'India', '28.02 N', '79.02 E'),
(988, 'Unnao', 'Uttar Pradesh', 'India', '26.55 N', '80.49 E'),
(989, 'Varanasi', 'Uttar Pradesh', 'India', '25.32 N', '83.01 E'),
(990, 'Vrindavan', 'Uttar Pradesh', 'India', '27.58 N', '77.70 E'),
(991, 'Dehra Dun', 'Uttaranchal', 'India', '30.34 N', '78.05 E'),
(992, 'Dehra Dun Cantonment', 'Uttaranchal', 'India', '30.34 N', '77.97 E'),
(993, 'Gola Range', 'Uttaranchal', 'India', '', ''),
(994, 'Haldwani', 'Uttaranchal', 'India', '29.23 N', '79.52 E'),
(995, 'Haridwar', 'Uttaranchal', 'India', '29.98 N', '78.16 E'),
(996, 'Kashipur', 'Uttaranchal', 'India', '29.22 N', '78.96 E'),
(997, 'Pithoragarh', 'Uttaranchal', 'India', '29.58 N', '80.22 E'),
(998, 'Rishikesh', 'Uttaranchal', 'India', '30.12 N', '78.29 E'),
(999, 'Rudrapur', 'Uttaranchal', 'India', '', ''),
(1000, 'Rurki', 'Uttaranchal', 'India', '29.87 N', '77.89 E');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `addr` varchar(400) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `country` varchar(100) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `nature_of_business` longtext NOT NULL,
  `c_group` varchar(11) NOT NULL,
  `fld_category_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `actstat` varchar(11) NOT NULL,
  `verify_stat` int(2) NOT NULL,
  `sales_stat` int(2) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `c_name`, `email`, `phone`, `addr`, `city`, `state`, `zip`, `country`, `tags`, `nature_of_business`, `c_group`, `fld_category_id`, `password`, `actstat`, `verify_stat`, `sales_stat`, `date_added`, `last_updated`) VALUES
(1, 'Adarsh', 'Kuch Bhi', 'adarsh@gmail.com', '4548674534', 'Adarsh Home', 'Delhi', 'Delhi', '110058', 'India', '', '<p>IT</p>\r\n', '3', 0, '1234', '', 1, 0, '2018-04-23 20:34:12', '2018-04-23 20:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_target`
--

CREATE TABLE `data_target` (
  `id` int(11) NOT NULL,
  `data_operator_id` int(11) NOT NULL,
  `target` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_target`
--

INSERT INTO `data_target` (`id`, `data_operator_id`, `target`) VALUES
(4, 4, '500'),
(5, 6, '500');

-- --------------------------------------------------------

--
-- Table structure for table `erp_chat`
--

CREATE TABLE `erp_chat` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` longtext NOT NULL,
  `cid` int(11) NOT NULL,
  `tdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nextdate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_chat`
--

INSERT INTO `erp_chat` (`id`, `sales_id`, `status`, `remarks`, `cid`, `tdate`, `nextdate`) VALUES
(14, 1, 4, '', 2, '2017-01-03 13:25:45', '0000-00-00 00:00:00'),
(15, 1, 2, 'Call After Some Time&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;', 1, '2017-01-03 13:44:52', '0000-00-00 00:00:00'),
(16, 1, 1, 'Deal Done&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;', 1, '2017-01-03 13:45:26', '0000-00-00 00:00:00'),
(17, 1, 4, ' Today Test', 2, '2017-01-12 07:00:46', '0000-00-00 00:00:00'),
(18, 1, 4, 'Call After Some Time', 2, '2017-01-12 16:17:59', '0000-00-00 00:00:00'),
(19, 1, 3, 'Call After Some Time', 2, '2017-01-12 16:18:55', '0000-00-00 00:00:00'),
(20, 1, 0, '', 3, '2017-01-14 04:17:32', '0000-00-00 00:00:00'),
(21, 1, 0, '', 3, '2017-01-14 04:19:19', '0000-00-00 00:00:00'),
(22, 1, 0, '', 3, '2017-01-14 04:20:47', '0000-00-00 00:00:00'),
(23, 1, 4, '', 3, '2017-01-14 04:28:15', '0000-00-00 00:00:00'),
(24, 1, 1, '', 2, '2017-01-16 06:57:22', '0000-00-00 00:00:00'),
(25, 1, 3, 'XYZ April', 3, '2017-04-27 06:08:33', '0000-00-00 00:00:00'),
(26, 1, 2, ' gf ', 10, '2017-04-27 07:22:11', '0000-00-00 00:00:00'),
(27, 1, 2, 'gre gr', 10, '2017-04-27 07:22:43', '0000-00-00 00:00:00'),
(28, 1, 2, 'hgvfyu', 10, '2017-04-27 07:26:52', '0000-00-00 00:00:00'),
(29, 1, 2, 'vcdfvr gver ', 10, '2017-04-27 09:25:23', '0000-00-00 00:00:00'),
(30, 1, 2, '2804-2017', 10, '2017-04-28 04:43:05', '0000-00-00 00:00:00'),
(31, 1, 2, 'new test', 10, '2017-04-28 10:20:18', '04/28/2017 4:00 PM'),
(37, 1, 2, 'vbgrbgyt', 10, '2017-04-28 13:15:40', '04/28/2017 7:34 PM'),
(40, 1, 2, 'Call back Later', 10, '2017-05-01 05:08:19', '05/01/2017 12:00 AM'),
(41, 1, 2, 'New Test for totals', 10, '2017-05-17 15:24:05', '05/17/2017 9:00 PM'),
(42, 1, 1, 'Client Done Testing', 10, '2017-05-17 15:26:49', '05/17/2017 12:00 AM'),
(43, 1, 1, '', 3, '2017-05-26 06:37:55', '05/26/2017 12:00 AM'),
(44, 7, 3, 'Call back Tomorrow\r\n', 13, '2017-05-31 13:45:12', '06/01/2017 12:00 PM'),
(45, 7, 3, '', 13, '2017-06-02 05:13:57', '06/02/2017 10:45 AM'),
(46, 7, 3, '', 13, '2017-06-03 10:17:16', '06/03/2017 12:00 AM'),
(47, 7, 3, '', 13, '2017-06-03 11:55:29', '06/04/2017 12:00 AM'),
(48, 7, 3, 'Deal Final from Client Side He is paying a number of total Rs 12000/-\r\n\r\nBelow is the proposal Description\r\n\r\n&amp;nbsp;\r\n', 13, '2017-06-06 14:21:10', '06/06/2017 12:00 AM'),
(49, 7, 1, 'Deal Final from Client Side He is paying a number of total Rs 12000/-\r\n\r\nBelow is the proposal Description &amp;nbsp;\r\n', 13, '2017-06-06 14:22:04', '06/07/2017 12:00 AM'),
(50, 7, 6, 'Testing Prospective\r\n\r\n&amp;nbsp;\r\n', 15, '2017-06-14 06:24:44', '06/14/2017 12:00 AM'),
(51, 8, 1, '', 1, '2018-04-23 20:36:26', '04/23/2018 12:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `incentive`
--

CREATE TABLE `incentive` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `amt` varchar(100) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incentive`
--

INSERT INTO `incentive` (`id`, `admin_id`, `amt`, `dated`) VALUES
(1, 1, '1000', '2017-01-10 07:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `sent_times` int(11) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_price` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_data_list`
--

CREATE TABLE `new_data_list` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_by` int(11) NOT NULL,
  `date_last` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_data_list`
--

INSERT INTO `new_data_list` (`id`, `cid`, `admin_id`, `dated`, `verified_by`, `date_last`) VALUES
(1, 10, 4, '2017-01-07 05:41:02', 0, '2017-01-07 05:41:02'),
(2, 11, 4, '2017-01-07 12:00:25', 0, '2017-01-07 12:00:25'),
(3, 12, 4, '2017-01-07 12:02:57', 2, '2017-01-07 12:02:57'),
(4, 13, 4, '2017-01-10 04:30:06', 0, '2017-01-10 04:30:06'),
(5, 11, 4, '2017-01-10 06:07:01', 0, '2017-01-10 06:07:01'),
(6, 12, 4, '2017-01-10 06:33:16', 0, '2017-01-10 06:33:16'),
(7, 13, 7, '2017-03-25 03:50:16', 0, '2017-03-25 03:50:16'),
(8, 14, 7, '2017-03-25 04:00:14', 0, '2017-03-25 04:00:14'),
(9, 15, 7, '2017-03-25 04:31:45', 0, '2017-03-25 04:31:45'),
(10, 16, 7, '2017-03-25 04:37:42', 0, '2017-03-25 04:37:42'),
(11, 17, 7, '2017-03-25 05:05:28', 0, '2017-03-25 05:05:28'),
(12, 13, 7, '2017-05-31 03:44:10', 0, '2017-05-31 03:44:10'),
(13, 1, 2, '2018-04-23 20:34:12', 2, '2018-04-23 20:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `services_id` text NOT NULL,
  `max_no_of_product` int(11) NOT NULL,
  `max_no_of_enquiry` int(11) NOT NULL,
  `des` longtext NOT NULL,
  `price` varchar(100) NOT NULL,
  `fld_order` int(11) NOT NULL,
  `actstat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `services_id`, `max_no_of_product`, `max_no_of_enquiry`, `des`, `price`, `fld_order`, `actstat`) VALUES
(1, 'Silver Package', '', 17, 7, 'vfdvf', '800.00', 0, 1),
(2, 'Gold Package', '', 12, 7, '<p>New GOLD Package&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n', '2900.00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `msg_to` varchar(255) NOT NULL,
  `msg_from` varchar(255) NOT NULL,
  `msg_sub` varchar(255) NOT NULL,
  `msg_package_description` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `cid`, `admin_id`, `msg_to`, `msg_from`, `msg_sub`, `msg_package_description`, `date`) VALUES
(1, 13, 7, 'new_test@gmail.com', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', 'New GOLD Package    \n', '2017-06-03 10:02:58'),
(2, 13, 7, 'new_test@gmail.com', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', 'vfdvf', '2017-06-03 10:03:25'),
(3, 13, 7, 'new_test@gmail.com', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-03 10:04:07'),
(4, 13, 7, 'new_test@gmail.com,', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-03 13:19:47'),
(5, 15, 7, 'abkhare47s@gmail.com', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 03:40:15'),
(6, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:01:40'),
(7, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:02:01'),
(8, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:03:05'),
(9, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:03:30'),
(10, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:14:01'),
(11, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:14:30'),
(12, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:19:51'),
(13, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:20:32'),
(14, 15, 7, '', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', '&amp;lt;p&amp;gt;vfdvf&amp;lt;/p&amp;gt;', '2017-06-05 05:42:01'),
(15, 15, 7, 'abkhare47s@gmail.com', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', 'vfdvf\n', '2017-06-05 05:53:14'),
(16, 15, 7, 'abkhare47s@gmail.com', 'ankush@b2benquiry.com', 'Proposal from Metaphor IT', 'vfdvf jfi anf ABHISF\n\nncuj f\n', '2017-06-05 05:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `sales_category_type`
--

CREATE TABLE `sales_category_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fld_order` varchar(100) NOT NULL,
  `actstat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_category_type`
--

INSERT INTO `sales_category_type` (`id`, `name`, `fld_order`, `actstat`) VALUES
(1, 'Matured', '1', 1),
(2, 'Committed', '3', 1),
(3, 'Follow Up', '4', 1),
(4, 'Fresh', '5', 1),
(5, 'Not Interested', '6', 1),
(6, 'Prospective', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_data_assign`
--

CREATE TABLE `sales_data_assign` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '4',
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `next_follow` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_data_assign`
--

INSERT INTO `sales_data_assign` (`id`, `cid`, `assign_by`, `assign_to`, `status`, `dated`, `next_follow`) VALUES
(1, 1, 2, 1, 1, '2016-12-23 01:13:42', '2018-04-23 00:00:00'),
(2, 2, 2, 1, 1, '2016-12-23 01:13:42', '0000-00-00 00:00:00'),
(3, 10, 2, 1, 1, '2017-01-09 05:08:39', '2017-05-17 00:00:00'),
(4, 3, 2, 1, 1, '2017-01-09 05:09:13', '2017-05-26 00:00:00'),
(6, 15, 0, 7, 6, '2017-03-25 04:31:45', '2017-06-14 00:00:00'),
(8, 17, 0, 7, 1, '2017-03-25 05:05:28', '0000-00-00 00:00:00'),
(9, 13, 0, 7, 1, '2017-05-31 03:44:10', '2017-06-07 00:00:00'),
(10, 1, 8, 8, 1, '2018-04-23 20:35:21', '2018-04-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sale_done`
--

CREATE TABLE `sale_done` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `actstat` int(2) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `package` int(11) NOT NULL,
  `des` longtext NOT NULL,
  `take_tax` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_done`
--

INSERT INTO `sale_done` (`id`, `cid`, `sales_id`, `price`, `actstat`, `balance`, `dated`, `last_updated`, `package`, `des`, `take_tax`) VALUES
(7, 1, 8, '50000', 0, '50000', '2018-04-23 20:36:26', '0000-00-00 00:00:00', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_target`
--

CREATE TABLE `sale_target` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `target` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_target`
--

INSERT INTO `sale_target` (`id`, `sales_id`, `target`) VALUES
(5, 8, '10000');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `features` longtext NOT NULL,
  `actstat` int(2) NOT NULL,
  `fld_order` int(11) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `features`, `actstat`, `fld_order`, `price`) VALUES
(2, 'Domain Registration', '1 year Registration&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;', 1, 1, '1000.00'),
(3, 'Hosting', 'One Domain Hosting account&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;', 1, 0, '2000');

-- --------------------------------------------------------

--
-- Table structure for table `snooze`
--

CREATE TABLE `snooze` (
  `id` int(11) NOT NULL,
  `erp_chat_id` int(11) NOT NULL,
  `snooze_time` int(11) NOT NULL,
  `snooze_for` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snooze`
--

INSERT INTO `snooze` (`id`, `erp_chat_id`, `snooze_time`, `snooze_for`, `date`, `cid`) VALUES
(1, 40, 1, '5', '2017-05-01 11:29:04', 10),
(2, 40, 1, '5', '2017-05-01 12:05:14', 10),
(3, 40, 2, '15', '2017-05-01 12:10:31', 10),
(4, 46, 0, '5', '2017-06-03 10:37:38', 13),
(5, 46, 1, '5', '2017-06-03 10:38:24', 13),
(6, 46, 2, '5', '2017-06-03 10:41:57', 13),
(7, 46, 3, '20', '2017-06-03 10:43:20', 13),
(8, 46, 4, '20', '2017-06-03 10:45:31', 13),
(9, 46, 5, '20', '2017-06-03 11:23:59', 13),
(10, 46, 6, '5', '2017-06-03 12:11:38', 13),
(11, 47, 0, '20', '2017-06-04 03:28:52', 13),
(12, 47, 1, '20', '2017-06-04 06:51:15', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_category`
--

CREATE TABLE `tbl_customer_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `fld_order` int(11) NOT NULL,
  `actstat` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer_category`
--

INSERT INTO `tbl_customer_category` (`id`, `category_name`, `fld_order`, `actstat`) VALUES
(1, 'Web Services', 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_db`
--
ALTER TABLE `access_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cgroup`
--
ALTER TABLE `cgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_target`
--
ALTER TABLE `data_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_chat`
--
ALTER TABLE `erp_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incentive`
--
ALTER TABLE `incentive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_data_list`
--
ALTER TABLE `new_data_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_category_type`
--
ALTER TABLE `sales_category_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_data_assign`
--
ALTER TABLE `sales_data_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_done`
--
ALTER TABLE `sale_done`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_target`
--
ALTER TABLE `sale_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snooze`
--
ALTER TABLE `snooze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_category`
--
ALTER TABLE `tbl_customer_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_db`
--
ALTER TABLE `access_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cgroup`
--
ALTER TABLE `cgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_target`
--
ALTER TABLE `data_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `erp_chat`
--
ALTER TABLE `erp_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `incentive`
--
ALTER TABLE `incentive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_data_list`
--
ALTER TABLE `new_data_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales_category_type`
--
ALTER TABLE `sales_category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_data_assign`
--
ALTER TABLE `sales_data_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sale_done`
--
ALTER TABLE `sale_done`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_target`
--
ALTER TABLE `sale_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `snooze`
--
ALTER TABLE `snooze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_customer_category`
--
ALTER TABLE `tbl_customer_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
