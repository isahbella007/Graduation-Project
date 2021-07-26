-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 09:55 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinefoods`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int(11) NOT NULL,
  `address` varchar(222) NOT NULL,
  `customerid` int(222) NOT NULL,
  `region` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressid`, `address`, `customerid`, `region`) VALUES
(1, 'Luxury Prime Dormitory. Room A127', 5, 'Famagusta'),
(2, 'Prime Living Dormitory. RA126', 5, 'Kyernia'),
(3, 'golden plus,10', 3, 'Famagusta'),
(4, 'Ramen Dormitory. Room B124', 6, 'Famagusta'),
(5, 'Ersoy Birkan Caddesi.', 5, 'Iskele');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` char(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `image`, `email`, `password`) VALUES
('Bella', 'bella.jpg', 'isabellakpai@gmail.com', 'hellothere'),
('Bella', 'bella.jpg', 'isabellakpai@gmail.com', 'hellothere');

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `applyid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `name` char(255) NOT NULL,
  `surname` char(255) NOT NULL,
  `contact` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `gender` char(255) NOT NULL,
  `position` char(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`applyid`, `restaurantid`, `name`, `surname`, `contact`, `address`, `email`, `description`, `gender`, `position`, `image`) VALUES
(6, 3, 'Kpai Raphael', 'Raphael', '4', 'Ersoy Birkan Caddesi.', 'kpairaphael16@gmail.com', 'dfgsdf', 'Woman', 'Kitchen Head', ''),
(15, 3, 'Grace', 'Oluwa', '08763567112', 'Eastern Mediterranean University. DAU 3', 'grace@gmail.com', 'I am very efficient ', 'Woman', 'Kitchen Head', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(50) NOT NULL,
  `name` char(255) NOT NULL,
  `phonenumber` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `name`, `phonenumber`, `password`) VALUES
(1, 'Amina', '0', ''),
(2, 'Joy', '0', ''),
(3, 'Stepp', '05338244378', 'food'),
(4, 'Oxe', '0', ''),
(5, 'Isabella', '05338244377', 'hello'),
(6, 'Masala', '05338244567', 'ilovefood');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `name` char(255) NOT NULL,
  `surname` char(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT 'welcome',
  `contact` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` char(255) NOT NULL,
  `position` char(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` char(255) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeid`, `restaurantid`, `name`, `surname`, `password`, `contact`, `address`, `email`, `gender`, `position`, `image`, `status`) VALUES
(1000, 1, 'Bella', 'Kpai', 'welcome', '533456654', 'Prime Dorm', 'hello@gmail.com', 'Woman', 'Kitchen Head', 'person3.jpg', 'Available'),
(1001, 3, 'Kpai Raphael', 'Raphael', 'welcome', '8766', 'Ersoy Birkan Caddesi.', 'hello@gmail.com', 'Woman', 'Kitchen Head', 'person8boy.jpg', 'FIRED'),
(1002, 1, 'Nekabari', 'Kpai', 'welcome', '2147483647', 'Prime Living Luxury Student Housing', 'bella@gmail.com', 'Woman', 'Kitchen Head', 'person9girl.jpg', 'Available'),
(1003, 1, 'Nekabari', 'Amin', 'welcome', '2147483649', 'Prime Living Luxury Student Housing', 'amin@gmail.com', 'Woman', 'Delivery Worker', 'person9girl.jpg', 'Available'),
(1004, 1, 'Kpai Raphael', 'Tembo', 'isabella', '23456778', 'Ersoy Birkan Caddesi.', 'kpairaphael@gmail.com', 'Man', 'Kitchen Staff', '', 'Available'),
(1005, 1, 'Namjoon', 'Kim', 'welcome', '9986547321', 'Home Dorm Dormitory', 'namjoon@gmail.com', 'Man', 'Kitchen Staff', '', 'Available'),
(1006, 1, 'Jimin', 'Park', 'welcome', '0908765443', 'Akdenix Dormitory', 'park@gmail.com', 'Man', 'Delivery Worker', 'person4.jpg', 'Available'),
(1007, 2, 'Fuse', 'Tea', 'deliveryman', '99876545', 'Prime', 'fuse@gmail.com', 'Other', 'Delivery Worker', '', 'Available'),
(1008, 2, 'Mogul', 'Bells', 'welcome', '8876543', 'prime', 'musk@gmail.com', 'Other', 'Kitchen Staff', '', 'Available'),
(1009, 2, 'Katherine', 'Wachukwu', 'welcome', '98765433', 'Ramen Dormitory', 'kath@gmail.com', 'Woman', 'Kitchen Head', '', 'Available'),
(1010, 1, 'beb', 'omah', 'welcome', '33455', 'ph', 'beb@gmail.com', 'Man', 'Delivery Worker', '', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `employeehistory`
--

CREATE TABLE `employeehistory` (
  `employeehistoryid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `employeeid` int(50) NOT NULL,
  `orderid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeehistory`
--

INSERT INTO `employeehistory` (`employeehistoryid`, `restaurantid`, `employeeid`, `orderid`) VALUES
(1, 1, 1004, '60b4e6ad68d8f'),
(2, 1, 1003, '60b4e6ad68d8f'),
(3, 1, 1004, '60b760e057dd1'),
(4, 1, 1003, '60b760e057dd1'),
(5, 1, 1004, '60b76ad22ae18'),
(6, 1, 1003, '60b76ad22ae18'),
(7, 1, 1005, '60b9eb7aee718'),
(8, 1, 1004, '60b9ef2487567'),
(9, 1, 1006, '60b9eb7aee718'),
(10, 1, 1003, '60b9ef2487567'),
(11, 2, 1008, '60b9ff9f42928'),
(12, 2, 1007, '60b9ff9f42928'),
(13, 1, 1005, '60bdf84a92ab7'),
(14, 1, 1006, '60bdf84a92ab7'),
(15, 1, 1005, '60be2649d51d1'),
(16, 1, 1006, '60be2649d51d1'),
(17, 1, 1005, '60c7a6b8c306f'),
(18, 1, 1006, '60c7a6b8c306f'),
(19, 1, 1005, '60d2efa1ddbcc'),
(20, 1, 1010, '60d2efa1ddbcc'),
(21, 1, 1005, '60d2f5efc1af7'),
(22, 1, 1003, '60d2f5efc1af7'),
(23, 1, 1005, '60d89233305a0'),
(24, 1, 1010, '60d89233305a0'),
(25, 1, 1005, '60d97a99c06a9'),
(26, 1, 1010, '60d97a99c06a9');

-- --------------------------------------------------------

--
-- Table structure for table `foodcategory`
--

CREATE TABLE `foodcategory` (
  `foodcategoryid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `foodcategoryname` char(25) DEFAULT NULL,
  `datecreated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foodcategory`
--

INSERT INTO `foodcategory` (`foodcategoryid`, `restaurantid`, `foodcategoryname`, `datecreated`) VALUES
(1, 1, 'Main dish', '2021-04-11'),
(3, 2, 'Main Dishes', '2021-04-11'),
(4, 3, 'Main Dishe', '2021-04-12'),
(6, 1, 'Swallow', '2021-05-21'),
(7, 1, 'Snacks', '2021-05-21'),
(8, 5, 'Best Selling', '2021-06-27'),
(9, 5, 'Wraps', '2021-06-27'),
(10, 5, 'Side Dishes', '2021-06-27'),
(11, 5, 'Drinks', '2021-06-27'),
(12, 6, 'Desserts', '2021-06-27'),
(13, 6, 'Drinks', '2021-06-27'),
(14, 7, 'Doners', '2021-06-27'),
(15, 7, 'Doner In Pita', '2021-06-27'),
(16, 7, 'Pizzas', '2021-06-27'),
(17, 7, 'Kebabs', '2021-06-27'),
(18, 7, 'Drinks', '2021-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `foodinventory`
--

CREATE TABLE `foodinventory` (
  `id` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `itemname` char(255) NOT NULL,
  `cost` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `datebought` date NOT NULL,
  `dateentered` datetime NOT NULL,
  `submittedby` char(255) NOT NULL,
  `updatedby` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foodmenu`
--

CREATE TABLE `foodmenu` (
  `foodmenuid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `foodcategoryid` int(50) NOT NULL,
  `foodcategory` char(20) NOT NULL,
  `itemname` char(25) NOT NULL,
  `price` int(10) NOT NULL,
  `description` char(50) NOT NULL,
  `image` blob DEFAULT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foodmenu`
--

INSERT INTO `foodmenu` (`foodmenuid`, `restaurantid`, `foodcategoryid`, `foodcategory`, `itemname`, `price`, `description`, `image`, `datecreated`) VALUES
(1, 1, 1, 'Main dish', 'Coconut Rice', 35, 'Yummy Jollof Rice', 0x636f636f6e757420726963652e6a7067, '2021-04-11'),
(3, 2, 3, 'Main Dishes', 'Fried Rice', 45, 'Yummy Fried Rice', 0x64656661756c742e6a7067, '2021-04-11'),
(4, 3, 4, 'Main Dishe', 'Fried Rice', 45, 'Yummy Jollof rice', 0x6672696564726963652e6a7067, '2021-04-12'),
(5, 1, 7, 'Snacks', 'Plantain', 30, 'Deep Fried Sweet plantain', 0x706c616e7461696e2e6a7067, '2021-05-21'),
(6, 1, 6, 'Swallow', 'Egusi + Fufu', 50, 'Party Egusi', 0x65677573692e6a7067, '2021-05-21'),
(7, 1, 1, 'Main dish', 'Fried Rice', 30, 'Yummy Fried Rice', 0x667269656420726963652e6a7067, '2021-05-21'),
(8, 5, 8, 'Best Selling', 'Meat Doner Wrap', 24, '', '', '2021-06-27'),
(9, 5, 8, 'Best Selling', 'Mix Doner Wrap', 24, '', '', '2021-06-27'),
(10, 5, 8, 'Best Selling', 'Meat Iskender', 30, '', '', '2021-06-27'),
(11, 5, 9, 'Wraps', 'Meat Doner Wrap', 24, '', '', '2021-06-27'),
(12, 5, 9, 'Wraps', 'Meat Doner in Special Bre', 24, '', '', '2021-06-27'),
(13, 5, 9, 'Wraps', 'Mix Doner in Special Brea', 24, '', '', '2021-06-27'),
(14, 5, 10, 'Side Dishes', 'Rice', 10, '', '', '2021-06-27'),
(15, 5, 10, 'Side Dishes', 'Salad', 10, '', '', '2021-06-27'),
(16, 5, 10, 'Side Dishes', 'Yogurt', 7, '', '', '2021-06-27'),
(17, 5, 11, 'Drinks', 'Ayran', 3, '', '', '2021-06-27'),
(18, 5, 11, 'Drinks', 'Fruity Soda', 5, '', '', '2021-06-27'),
(19, 5, 11, 'Drinks', 'Water', 5, '', '', '2021-06-27'),
(20, 6, 12, 'Desserts', 'Caramel Cake', 18, '', '', '2021-06-27'),
(21, 6, 12, 'Desserts', 'Chocolate Cake', 22, '', 0x63686f636c6174652063616b652e6a7067, '2021-06-27'),
(22, 6, 13, 'Drinks', 'Coca-cola', 6, '', '', '2021-06-27'),
(23, 6, 13, 'Drinks', 'Coca-cola zero', 6, '', '', '2021-06-27'),
(24, 6, 13, 'Drinks', 'Fanta', 6, '', '', '2021-06-27'),
(25, 6, 13, 'Drinks', 'Fuse Tea', 6, '', '', '2021-06-27'),
(26, 7, 14, 'Doners', 'Meat Doner Service', 37, '', '', '2021-06-27'),
(27, 7, 14, 'Doners', 'Chicken Doner Service', 35, '', '', '2021-06-27'),
(28, 7, 14, 'Doners', 'Mix Doner Service', 37, '', '', '2021-06-27'),
(29, 7, 15, 'Doner In Pita', 'Meat Doner in Pita', 30, '', '', '2021-06-27'),
(30, 7, 16, 'Pizzas', 'Chicken Pizza', 43, '', 0x636869636b656e2070697a7a612e6a7067, '2021-06-27'),
(31, 7, 16, 'Pizzas', 'Mix Pizza', 50, '', 0x6d69782070697a7a612e6a7067, '2021-06-27'),
(32, 7, 17, 'Kebabs', 'Chicken kebab service', 50, '', 0x6b6562616220736572766963652e6a7067, '2021-06-27'),
(33, 7, 18, 'Drinks', 'Sprite', 6, '', '', '2021-06-27'),
(34, 7, 18, 'Drinks', 'Beer', 12, '', '', '2021-06-27'),
(35, 2, 3, 'Main Dishes', 'Oxtail menu', 50, '', 0x576861747341707020496d61676520323032312d30362d31362061742031312e35372e35322e6a706567, '2021-06-27'),
(36, 2, 3, 'Main Dishes', 'Steamed bread menu', 40, '', 0x576861747341707020496d61676520323032312d30362d31362061742031312e35372e3533202831292e6a706567, '2021-06-27'),
(37, 2, 3, 'Main Dishes', 'Braai special', 75, '', 0x576861747341707020496d61676520323032312d30362d31362061742031322e31302e3135202831292e6a706567, '2021-06-27'),
(38, 6, 12, 'Desserts', 'Donut', 12, '', 0x576861747341707020496d61676520323032312d30362d31362061742031322e31302e31362e6a706567, '2021-06-27'),
(39, 1, 1, 'Main dish', 'Chicken liver menu', 45, '', 0x576861747341707020496d61676520323032312d30362d31362061742031322e31302e3136202831292e6a706567, '2021-06-27'),
(40, 1, 1, 'Main dish', 'Pap and beans', 40, '', 0x576861747341707020496d61676520323032312d30362d31362061742031322e30342e34342e6a706567, '2021-06-27'),
(41, 1, 7, 'Snacks', 'Nuts and cassava', 10, '', 0x576861747341707020496d61676520323032312d30362d31362061742031322e31302e31372e6a706567, '2021-06-27'),
(42, 1, 7, 'Snacks', 'Meat pie', 8, '', 0x576861747341707020496d61676520323032312d30362d31362061742031322e31302e31352e6a706567, '2021-06-27'),
(43, 1, 6, 'Swallow', 'Efo riro + Fufu', 45, '', 0x65666f72207269726f2e6a7067, '2021-06-27'),
(44, 1, 6, 'Swallow', 'okra soup + plantain flou', 45, '', 0x6f6b61726f20736f75702e6a7067, '2021-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderid` varchar(222) NOT NULL,
  `customerid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `addressid` int(10) NOT NULL,
  `itemname` char(255) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(12) NOT NULL,
  `paymentmethod` char(50) NOT NULL,
  `message` text DEFAULT NULL,
  `orderdate` date DEFAULT current_timestamp(),
  `status` char(255) NOT NULL DEFAULT 'New',
  `status_message` text NOT NULL DEFAULT '\'Food has been delivered\'',
  `timeoforder` timestamp NOT NULL DEFAULT current_timestamp(),
  `rate_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `customerid`, `restaurantid`, `addressid`, `itemname`, `price`, `quantity`, `paymentmethod`, `message`, `orderdate`, `status`, `status_message`, `timeoforder`, `rate_status`) VALUES
(35, '60b4e6ad68d8f', 5, 1, 1, 'Coconut Rice', 105, 3, 'Card at Door', 'Please make the rice spicy.', '2021-05-31', 'DELIVERED', 'Food has been delivered', '2021-05-31 13:37:49', 0),
(36, '60b4e6ad68d8f', 5, 1, 1, 'Plantain', 60, 2, 'Card at Door', 'Please make the rice spicy.', '2021-05-31', 'DELIVERED', 'Food has been delivered', '2021-05-31 13:37:49', 0),
(37, '60b760e057dd1', 5, 1, 1, 'Coconut Rice', 105, 3, 'Cash', '', '2021-06-02', 'DELIVERED', 'Food has been delivered', '2021-06-02 10:43:44', 1),
(38, '60b760e057dd1', 5, 1, 1, 'Plantain', 120, 4, 'Cash', '', '2021-06-02', 'DELIVERED', 'Food has been delivered', '2021-06-02 10:43:44', 1),
(39, '60b76ad22ae18', 5, 1, 1, 'Plantain', 150, 5, 'Cash', 'Please make it salty. Thank you', '2021-06-02', 'DELIVERED', 'Food has been delivered', '2021-06-02 11:26:10', 1),
(40, '60b9eb7aee718', 6, 1, 4, 'Egusi + Fufu', 100, 2, 'Cash', '', '2021-06-04', 'DELIVERED', 'Food has been delivered', '2021-06-04 08:59:38', 0),
(41, '60b9ef2487567', 6, 1, 4, 'Fried Rice', 90, 3, 'Cash', 'Add enough chicken ', '2021-06-04', 'DELIVERED', 'Food has been delivered', '2021-06-04 09:15:16', 0),
(42, '60b9ff9f42928', 6, 2, 4, 'Fried Rice', 135, 3, 'Card at Door', '', '2021-06-04', 'DELIVERED', 'Food has been delivered', '2021-06-04 10:25:35', 1),
(43, '60bcb08c6d7fd', 5, 1, 1, 'Coconut Rice', 70, 2, 'Cash', 'Spicy ', '2021-06-06', 'ACCEPTED', 'Food has been delivered', '2021-06-06 11:25:00', 0),
(44, '60bdf84a92ab7', 5, 1, 1, 'Fried Rice', 90, 3, 'Cash', 'Please, make it spicy. Thanks ', '2021-06-07', 'DELIVERED', 'Food has been delivered', '2021-06-07 10:43:22', 1),
(45, '60be2649d51d1', 5, 1, 1, 'Fried Rice', 60, 2, 'Card at Door', '', '2021-06-07', 'DELIVERED', 'Food has been delivered', '2021-06-07 13:59:37', 1),
(46, '60c7a6b8c306f', 5, 1, 1, 'Plantain', 60, 2, 'Card at Door', '', '2021-06-14', 'DELIVERED', '\'Food has been delivered\'', '2021-06-14 18:58:00', 0),
(47, '60d2efa1ddbcc', 5, 1, 1, 'Fried Rice', 30, 1, 'Card at Door', '', '2021-06-23', 'DELIVERED', '\'Food has been delivered\'', '2021-06-23 08:24:01', 0),
(48, '60d2f5efc1af7', 5, 1, 1, 'Coconut Rice', 140, 4, 'Cash', 'please make room delivery', '2021-06-23', 'DELIVERED', '\'Food has been delivered\'', '2021-06-23 08:50:55', 0),
(49, '60d891c9db94a', 5, 2, 1, 'Fried Rice', 90, 2, 'Card at Door', 'Please make spicy', '2021-06-27', 'PENDING', '\'Food has been delivered\'', '2021-06-27 14:57:14', 0),
(50, '60d89233305a0', 5, 1, 1, 'Coconut Rice', 70, 2, 'Card at Door', 'please make spicy', '2021-06-27', 'DELIVERED', '\'Food has been delivered\'', '2021-06-27 14:58:59', 1),
(51, '60d97a99c06a9', 5, 1, 1, 'Fried Rice', 90, 3, 'Card at Door', 'Please make it spicy ', '2021-06-28', 'DELIVERED', '\'Food has been delivered\'', '2021-06-28 07:30:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurantid` int(50) NOT NULL,
  `name` char(25) DEFAULT NULL,
  `address` varchar(25) DEFAULT NULL,
  `category` char(25) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `region` char(20) DEFAULT NULL,
  `FLAG` char(20) DEFAULT 'PENDING',
  `datecreated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurantid`, `name`, `address`, `category`, `email`, `password`, `region`, `FLAG`, `datecreated`) VALUES
(1, 'Arewa Chef', 'Near ShoeFor me store', 'African', 'arewa@gmail.com', 'foodislife', 'Famagusta', 'CONFIRMED', NULL),
(2, 'Home Africa', 'EMU Stadium', 'African', 'homeafrica@gmail.com', 'hello', 'Famagusta', 'CONFIRMED', NULL),
(3, 'Prime Res', 'Prime Living Luxury Stude', 'African', 'prime@gmail.com', 'hello', 'Famagusta', 'CONFIRMED', NULL),
(4, 'Panda', 'adam street28', 'Asian', 'panda@yahoo.com', '12', 'Famagusta', 'CONFIRMED', NULL),
(5, 'Armagan Doner', 'Salamis Road', 'Middle East', 'doner@gmail.com', 'doner', 'Famagusta', 'CONFIRMED', NULL),
(6, 'My Sweet World', 'City Mall', 'Eastern Europe', 'sweet@gmail.com', 'sweet', 'Famagusta', 'CONFIRMED', NULL),
(7, 'Bulent Usta', 'Anit Cemberi', 'Middle East', 'usta@gmail.com', 'usta', 'Famagusta', 'CONFIRMED', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `vacancyid` int(50) NOT NULL,
  `restaurantid` int(50) NOT NULL,
  `position` char(25) NOT NULL,
  `availability` int(50) NOT NULL,
  `description` text NOT NULL,
  `flag` char(25) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`vacancyid`, `restaurantid`, `position`, `availability`, `description`, `flag`) VALUES
(1, 3, 'Kitchen Head', 1, 'Must be willing to work at all times', 'ACTIVE'),
(4, 1, 'Kitchen Staff', 0, 'Must be willing to work at all times', 'CLOSED'),
(5, 1, 'Delivery Worker', 1, 'Be good with a scooter', 'ACTIVE'),
(6, 2, 'Kitchen Head', 0, 'Must be willing to work at all times', 'ACTIVE'),
(7, 2, 'Kitchen Staff', 0, 'Good Cook', 'ACTIVE'),
(8, 2, 'Delivery Worker', 0, 'Ride the scooter', 'ACTIVE'),
(11, 1, 'Kitchen Head', 2, 'Must be willing to work at all times', 'ACTIVE'),
(12, 5, 'Kitchen Head', 1, 'Must be willing to work at all times', 'ACTIVE'),
(13, 5, 'Delivery Worker', 1, 'Must be willing to work at all times', 'ACTIVE'),
(14, 5, 'Kitchen Staff', 1, 'Must be willing to work at all times', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressid`);

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`applyid`),
  ADD KEY `restaurantid` (`restaurantid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeid`),
  ADD KEY `restaurantid` (`restaurantid`);

--
-- Indexes for table `employeehistory`
--
ALTER TABLE `employeehistory`
  ADD PRIMARY KEY (`employeehistoryid`),
  ADD KEY `restaurantid` (`restaurantid`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Indexes for table `foodcategory`
--
ALTER TABLE `foodcategory`
  ADD PRIMARY KEY (`foodcategoryid`),
  ADD KEY `restaurantid` (`restaurantid`);

--
-- Indexes for table `foodinventory`
--
ALTER TABLE `foodinventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantid` (`restaurantid`);

--
-- Indexes for table `foodmenu`
--
ALTER TABLE `foodmenu`
  ADD PRIMARY KEY (`foodmenuid`),
  ADD KEY `restaurantid` (`restaurantid`),
  ADD KEY `foodcategoryid` (`foodcategoryid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantid` (`restaurantid`),
  ADD KEY `addressid` (`addressid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurantid`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`vacancyid`),
  ADD KEY `restaurantid` (`restaurantid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `applyid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `employeehistory`
--
ALTER TABLE `employeehistory`
  MODIFY `employeehistoryid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `foodcategory`
--
ALTER TABLE `foodcategory`
  MODIFY `foodcategoryid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `foodinventory`
--
ALTER TABLE `foodinventory`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foodmenu`
--
ALTER TABLE `foodmenu`
  MODIFY `foodmenuid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurantid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `vacancyid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`);

--
-- Constraints for table `employeehistory`
--
ALTER TABLE `employeehistory`
  ADD CONSTRAINT `employeehistory_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE CASCADE,
  ADD CONSTRAINT `employeehistory_ibfk_2` FOREIGN KEY (`employeeid`) REFERENCES `employee` (`employeeid`) ON DELETE CASCADE;

--
-- Constraints for table `foodcategory`
--
ALTER TABLE `foodcategory`
  ADD CONSTRAINT `foodcategory_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`);

--
-- Constraints for table `foodinventory`
--
ALTER TABLE `foodinventory`
  ADD CONSTRAINT `foodinventory_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`);

--
-- Constraints for table `foodmenu`
--
ALTER TABLE `foodmenu`
  ADD CONSTRAINT `foodmenu_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`),
  ADD CONSTRAINT `foodmenu_ibfk_2` FOREIGN KEY (`foodcategoryid`) REFERENCES `foodcategory` (`foodcategoryid`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`) ON DELETE CASCADE;

--
-- Constraints for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `vacancy_ibfk_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
