-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 03:35 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinegrocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressID` int(5) NOT NULL,
  `addressTitle` varchar(50) NOT NULL,
  `receiverName` varchar(100) NOT NULL,
  `receiverPhoneNo` varchar(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `postcode` int(5) NOT NULL,
  `cusID` int(9) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `defaultad` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressID`, `addressTitle`, `receiverName`, `receiverPhoneNo`, `street`, `city`, `postcode`, `cusID`, `state`, `defaultad`) VALUES
(29, 'Tan', 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 100079, 'Johor', 1),
(30, 'T', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 100081, 'Johor', 1),
(31, 'TAN', 'Tan', '017-7779999', '311, Jalan Warni,', 'Segamat', 87776, 100081, 'Johor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(5) NOT NULL,
  `adminType` varchar(20) NOT NULL,
  `aPassword` varchar(255) NOT NULL,
  `aStatus` char(1) DEFAULT 'A',
  `aName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `vkey` varchar(255) DEFAULT NULL,
  `expdate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminType`, `aPassword`, `aStatus`, `aName`, `email`, `vkey`, `expdate`) VALUES
(1000, 'SuperAdmin', '$2y$15$itdfca79TtkuzGcuxdCGc.teBiaP9BOI0F6vzxHgT1t7y6FCfTB3O', 'A', 'Super Admin  1', '1191202488@student.mmu.edu.my', 'ea667eaf3276615aab9dc4ff1d181849', '2021-11-17 00:45:27'),
(1010, 'Admin', '$2y$15$Kv3uUuwsqwXY3qsKwCDMB.3AKzWdsMWLga5ZMRBRZbuj4eG.ltk52', 'A', 'Tan', 'yanlinnn155@gmail.com', NULL, NULL),
(1011, 'SuperAdmin', '$2y$15$jMJZ2NBuuKiQHghTtPl8O.ltLvOkERcwEC78IljtMWjjz33YJ.rFe', 'A', 'Tan', 'tyanlin21@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(10) NOT NULL,
  `qty` int(4) NOT NULL,
  `cusID` int(9) DEFAULT NULL,
  `productID` int(9) DEFAULT NULL,
  `updateTime` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `qty`, `cusID`, `productID`, `updateTime`) VALUES
(453, 1, 100079, 103, '2021-11-10'),
(454, 1, 100079, 108, '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(9) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Beverage'),
(2, 'Cookie'),
(5, 'Fresh Fruits'),
(23, 'Paste'),
(25, 'Frozen Food');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pNum` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cmessage` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `email`, `pNum`, `cname`, `cmessage`, `status`, `Date`) VALUES
(2, 'yanlinnn155@gmail.com', '017-7779999', 'Tan', 'Can I know the shipping fee?	', 0, '2021-11-12'),
(3, 'tyanlin21@gmail.com', '017-7779999', 'Tan', 'How to check my order status?', 1, '2021-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cusID` int(9) NOT NULL,
  `cusFName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cusLName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cusEmail` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cusPhoneNo` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `cusGender` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `walletAmount` decimal(5,2) DEFAULT 0.00,
  `passw` varchar(255) CHARACTER SET latin1 NOT NULL,
  `vkey` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `verified` int(1) DEFAULT 0,
  `vkeyexpired` datetime DEFAULT current_timestamp(),
  `created_date` date DEFAULT curdate(),
  `wActivate` int(1) DEFAULT 0,
  `wPin` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `walletKey` varchar(200) DEFAULT NULL,
  `walletKeyExpired` datetime DEFAULT NULL,
  `cstatus` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusID`, `cusFName`, `cusLName`, `cusEmail`, `cusPhoneNo`, `cusGender`, `walletAmount`, `passw`, `vkey`, `verified`, `vkeyexpired`, `created_date`, `wActivate`, `wPin`, `walletKey`, `walletKeyExpired`, `cstatus`) VALUES
(100079, 'Yan Lin', 'Tan', 'yanlinnn155@gmail.com', NULL, NULL, '26.83', '$2y$15$KNIMI1DY0zXsrymbto4qvuDXH6/G6ske.59GHdClUAjf/39dKYVGK', '18a0df90179d3610ea3f8c1fdc5c2adc', 1, '2021-11-17 00:36:00', '2021-11-10', 0, '$2y$15$kTqQMN.t7MQVXcO9andajenvGzfSBcjzLDNBkHWIXOBy0mGmfvN3a', '984901', '2021-11-10 14:26:00', 1),
(100081, 'Tan', 'Tan', '1191202488@student.mmu.edu.my', '', 'Female', '8.32', '$2y$15$eLQxgt2AmHGsEGmVHuJDO.b.1x1Fkm/PtTdVs/KJgn4x2a0gfcYq2', '96948cbbeadb7ea518f1139b757be06e', 1, '2021-11-17 00:26:08', '2021-11-10', 1, '$2y$15$tvr00vJarW7FChP5934Mo.nfEJ0FVC5cngMYggCTlXbrTZ/ZrTsha', '743914', '2021-11-16 20:38:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `oDID` int(9) NOT NULL,
  `qty` int(5) NOT NULL,
  `price_used` decimal(5,2) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `oDPrice` decimal(5,2) NOT NULL,
  `productID` int(9) NOT NULL,
  `orderID` int(9) NOT NULL,
  `oDttl` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`oDID`, `qty`, `price_used`, `discount`, `oDPrice`, `productID`, `orderID`, `oDttl`) VALUES
(160, 1, '2.20', 0, '2.20', 103, 104, '2.20'),
(161, 1, '6.49', 0, '6.49', 108, 104, '6.49'),
(162, 2, '0.99', 0, '0.99', 126, 104, '1.98'),
(163, 1, '2.20', 0, '2.20', 103, 105, '2.20'),
(164, 1, '6.49', 0, '6.49', 108, 105, '6.49'),
(165, 1, '0.99', 0, '0.99', 126, 105, '0.99'),
(166, 1, '3.29', 0, '3.29', 107, 105, '3.29'),
(167, 1, '2.50', 0, '2.50', 127, 106, '2.50'),
(168, 1, '0.99', 0, '0.99', 126, 106, '0.99'),
(169, 1, '2.90', 0, '2.90', 129, 106, '2.90'),
(170, 1, '2.20', 0, '2.20', 103, 107, '2.20'),
(171, 1, '2.50', 0, '2.50', 127, 107, '2.50'),
(172, 1, '15.90', 0, '15.90', 128, 107, '15.90'),
(173, 1, '6.49', 0, '6.49', 108, 108, '6.49'),
(174, 1, '0.99', 0, '0.99', 126, 108, '0.99'),
(175, 1, '2.50', 0, '2.50', 127, 108, '2.50'),
(176, 1, '2.20', 0, '2.20', 103, 109, '2.20'),
(177, 1, '6.49', 0, '6.49', 108, 109, '6.49'),
(178, 1, '0.99', 0, '0.99', 126, 109, '0.99'),
(179, 1, '2.50', 0, '2.50', 127, 109, '2.50'),
(180, 3, '0.99', 0, '0.99', 126, 110, '2.97'),
(181, 1, '3.29', 0, '3.29', 107, 110, '3.29'),
(182, 1, '2.50', 0, '2.50', 127, 110, '2.50'),
(183, 1, '0.99', 0, '0.99', 126, 111, '0.99'),
(184, 1, '2.20', 0, '2.20', 103, 112, '2.20'),
(185, 1, '2.20', 0, '2.20', 104, 112, '2.20'),
(186, 1, '5.40', 10, '4.86', 100, 112, '4.86'),
(187, 13, '0.99', 0, '0.99', 126, 113, '12.87'),
(188, 2, '2.90', 0, '2.90', 129, 114, '5.80'),
(189, 2, '15.90', 0, '15.90', 128, 114, '31.80'),
(190, 2, '6.49', 0, '6.49', 108, 115, '12.98'),
(191, 1, '2.20', 0, '2.20', 103, 115, '2.20'),
(192, 1, '5.40', 10, '4.86', 100, 115, '4.86'),
(193, 1, '2.20', 0, '2.20', 104, 115, '2.20'),
(194, 1, '2.20', 0, '2.20', 103, 116, '2.20'),
(195, 1, '6.49', 0, '6.49', 108, 116, '6.49'),
(196, 1, '3.29', 0, '3.29', 107, 117, '3.29'),
(197, 1, '2.20', 0, '2.20', 103, 118, '2.20'),
(198, 1, '6.49', 0, '6.49', 108, 118, '6.49'),
(199, 2, '2.20', 0, '2.20', 104, 119, '4.40'),
(200, 1, '2.29', 0, '2.29', 103, 119, '2.29'),
(201, 1, '6.49', 0, '6.49', 108, 120, '6.49'),
(202, 1, '2.20', 0, '2.20', 104, 120, '2.20'),
(203, 2, '2.29', 0, '2.29', 103, 121, '4.58'),
(204, 1, '3.29', 1, '3.26', 133, 121, '3.26'),
(205, 1, '6.49', 0, '6.49', 108, 121, '6.49');

-- --------------------------------------------------------

--
-- Table structure for table `orderp`
--

CREATE TABLE `orderp` (
  `orderID` int(9) NOT NULL,
  `orderDate` datetime DEFAULT current_timestamp(),
  `totalPrice` decimal(5,2) DEFAULT NULL,
  `cusID` int(9) DEFAULT NULL,
  `updated_Time` datetime DEFAULT NULL,
  `receiverName` varchar(100) NOT NULL,
  `receiverPhoneNo` varchar(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `postcode` int(5) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `status` int(3) DEFAULT 1,
  `shipping_fee` decimal(5,2) DEFAULT NULL,
  `ttlorder` decimal(5,2) DEFAULT NULL,
  `shipDate` date DEFAULT NULL,
  `timeslot` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderp`
--

INSERT INTO `orderp` (`orderID`, `orderDate`, `totalPrice`, `cusID`, `updated_Time`, `receiverName`, `receiverPhoneNo`, `street`, `city`, `postcode`, `state`, `status`, `shipping_fee`, `ttlorder`, `shipDate`, `timeslot`) VALUES
(104, '2021-09-12 13:52:22', '16.66', 100079, '2021-11-16 23:23:21', 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 5, '5.99', '10.67', '2021-11-13', 2),
(105, '2021-11-10 14:05:51', '17.96', 100079, '2021-11-10 18:27:06', 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 4, '4.99', '12.97', '2021-11-11', 3),
(106, '2021-11-10 14:08:25', '7.39', 100079, '2021-11-17 00:06:01', 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 3, '1.00', '6.39', '2021-11-16', 1),
(107, '2021-11-10 14:09:38', '21.60', 100079, '2021-11-17 00:04:57', 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 3, '1.00', '20.60', '2021-11-17', 1),
(108, '2021-11-10 14:10:39', '15.97', 100079, NULL, 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 7, '5.99', '9.98', '2021-11-11', 2),
(109, '2021-11-10 14:39:38', '18.17', 100079, '2021-11-10 14:40:10', 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 5, '5.99', '12.18', '2021-11-11', 2),
(110, '2021-11-10 15:43:47', '13.75', 100079, NULL, 'Tan', '017-88888888', '28, Jalan Merah 2, ', 'Segamat', 85000, 'Johor', 7, '4.99', '8.76', '2021-11-11', 3),
(111, '2021-11-10 16:41:43', '5.98', 100081, NULL, 'Tan', '017-7779999', '311, Jalan Warni,', 'Segamat', 87776, 'Johor', 7, '4.99', '0.99', '2021-11-11', 3),
(112, '2021-11-10 18:37:05', '15.25', 100081, '2021-11-12 13:14:51', 'Tan', '017-7779999', '311, Jalan Warni,', 'Segamat', 87776, 'Johor', 5, '5.99', '9.26', '2021-11-11', 2),
(113, '2021-11-10 18:37:40', '17.86', 100081, '2021-11-16 20:19:17', 'Tan', '017-7779999', '311, Jalan Warni,', 'Segamat', 87776, 'Johor', 4, '4.99', '12.87', '2021-11-12', 5),
(114, '2021-11-10 18:38:35', '41.59', 100081, '2021-11-16 20:19:23', 'Tan', '017-7779999', '311, Jalan Warni,', 'Segamat', 87776, 'Johor', 4, '3.99', '37.60', '2021-11-13', 4),
(115, '2021-11-12 12:54:21', '28.23', 100081, '2021-11-12 13:06:02', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 7, '5.99', '22.24', '2021-11-14', 2),
(116, '2021-11-12 12:54:44', '13.68', 100081, '2021-11-16 20:20:54', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 5, '4.99', '8.69', '2021-11-13', 3),
(117, '2021-11-12 12:58:18', '4.29', 100081, NULL, 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 1, '1.00', '3.29', '2021-11-13', 1),
(118, '2021-11-16 20:15:51', '9.69', 100081, '2021-11-16 20:20:11', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 5, '1.00', '8.69', '2021-11-19', 1),
(119, '2021-11-16 23:58:34', '10.68', 100081, '2021-11-17 00:05:05', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 3, '3.99', '6.69', '2021-11-17', 7),
(120, '2021-11-16 23:58:52', '12.68', 100081, '2021-11-17 00:05:10', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 3, '3.99', '8.69', '2021-11-17', 7),
(121, '2021-11-18 15:25:39', NULL, 100081, '2021-11-18 15:26:25', 'Tan', '017-7779999', '321, Jalan Warni,', 'Segamat', 87776, 'Johor', 7, NULL, NULL, NULL, NULL);

--
-- Triggers `orderp`
--
DELIMITER $$
CREATE TRIGGER `udt` AFTER UPDATE ON `orderp` FOR EACH ROW UPDATE orderp, orderdetail b, product c SET c.pqty = c.pqty + b.qty WHERE old.orderID = b.orderID AND b.productID = c.productID AND OLD.status = 1 AND NEW.status = 7
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `osID` int(3) NOT NULL,
  `osName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`osID`, `osName`) VALUES
(1, 'To Pay'),
(2, 'Confirmed'),
(3, 'Out of Delivery'),
(4, 'Delivered'),
(5, 'Completed'),
(7, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(9) NOT NULL,
  `pAmount` decimal(5,2) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp(),
  `orderID` int(9) DEFAULT NULL,
  `pmID` int(9) DEFAULT NULL,
  `payDay` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `pAmount`, `createdDate`, `orderID`, `pmID`, `payDay`) VALUES
(99, '16.66', '2021-11-10 13:52:22', 104, 3, '2021-11-10 13:52:36'),
(100, '17.96', '2021-11-10 14:05:51', 105, 3, '2021-11-10 14:05:57'),
(101, '7.39', '2021-11-10 14:08:25', 106, 3, '2021-11-10 14:08:34'),
(102, '21.60', '2021-11-10 14:09:38', 107, 3, '2021-11-10 14:09:45'),
(103, '15.97', '2021-11-10 14:10:39', 108, 3, NULL),
(104, '18.17', '2021-11-10 14:39:38', 109, 2, '2021-11-10 14:39:50'),
(105, '13.75', '2021-11-10 15:43:47', 110, 3, NULL),
(106, '5.98', '2021-11-10 16:41:43', 111, 3, NULL),
(107, '15.25', '2021-11-10 18:37:05', 112, 3, '2021-11-10 18:37:13'),
(108, '17.86', '2021-11-10 18:37:40', 113, 3, '2021-11-10 18:37:45'),
(109, '41.59', '2021-11-10 18:38:35', 114, 3, NULL),
(110, '28.23', '2021-11-12 12:54:21', 115, 3, NULL),
(111, '13.68', '2021-11-12 12:54:44', 116, 2, '2021-11-12 12:54:56'),
(112, '4.29', '2021-11-12 12:58:18', 117, 2, NULL),
(113, '9.69', '2021-11-16 20:15:51', 118, 3, '2021-11-16 20:15:59'),
(114, '10.68', '2021-11-16 23:58:34', 119, 1, NULL),
(115, '12.68', '2021-11-16 23:58:52', 120, 1, NULL),
(116, '20.32', '2021-11-18 15:25:39', 121, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `pmID` int(9) NOT NULL,
  `pmName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`pmID`, `pmName`) VALUES
(1, 'Cash'),
(2, 'Wallet'),
(3, 'Credit/ Debit Card');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(9) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `pPrice` decimal(5,2) NOT NULL,
  `pQty` int(5) DEFAULT 0,
  `pDesc` text DEFAULT NULL,
  `pImage1` text DEFAULT NULL,
  `pImage2` text DEFAULT NULL,
  `pImage3` text DEFAULT NULL,
  `pImage4` text DEFAULT NULL,
  `AddedTime` date DEFAULT current_timestamp(),
  `categoryID` int(9) DEFAULT NULL,
  `productStatus` char(1) DEFAULT 'A',
  `discountPercent` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `pName`, `pPrice`, `pQty`, `pDesc`, `pImage1`, `pImage2`, `pImage3`, `pImage4`, `AddedTime`, `categoryID`, `productStatus`, `discountPercent`) VALUES
(100, 'Tropicana Twister Orange 1L', '5.40', 36, '', '../product/t1.jpg', '../product/cm1.jpg', '', '', '2021-07-15', 1, 'A', 10),
(101, 'Milo 1.5L', '5.99', 200, '', 'https://www.freshngo.my/image/freshngo/image/cache/data/all_product_images/product-317/Milo%20Chill%201L-800x800.png', '', '', '', '2021-08-21', 1, 'I', 20),
(102, 'Homesoy Original Soya Milk 1L', '2.99', 20, '', 'https://secure.ap-tescoassets.com/assets/MY/532/9556007000532/ShotType1_540x540.jpg', NULL, NULL, NULL, '2021-08-21', 1, 'I', NULL),
(103, 'Coca-Cola', '2.29', 196, '', 'https://cdn.shopify.com/s/files/1/0278/5027/6929/products/e0c195ca-cdff-4ea6-8662-eaee8f50b839_600x.jpg?v=1593769372', 'https://cdn.shopify.com/s/files/1/1576/9979/products/CokeCaninfo_600x.png?v=1594893834', NULL, NULL, '2021-09-19', 1, 'A', NULL),
(104, 'Ice Lemon Tea', '2.20', 55, '', 'https://fnlife.com.my/media/catalog/product/cache/2503d1a533559c286d5665a5918a46ab/b/e/beverage_seasons_tea_lemon_can_6_1__1.jpg', 'https://cdn.store-assets.com/s/333036/i/17321083.jpg?width=1024&format=webp', NULL, NULL, '2021-09-27', 1, 'A', NULL),
(105, 'Tropicana Twister Apple', '6.99', 0, '', 'https://mygroser.s3.ap-southeast-1.amazonaws.com/productImages/1000X1000/1577695755629-Tropicana%20Twister%20Apple.jpeg', '', '', '', '2021-09-03', 1, 'A', NULL),
(107, 'FUJI Apple', '3.29', 156, 'FUJI Apple', 'https://sc04.alicdn.com/kf/Ude352989ff47493da0c018fd6784ea6aW.jpg', 'https://www.cameronfresh.com.my/wp-content/uploads/2020/03/fresh-fruit-red-Fuji-apple-with-good.jpg', '', '', '2021-09-06', 5, 'A', NULL),
(108, 'GrapeFruit 600G (600G+-/PKT)', '6.49', 27, '', 'https://mygroser.s3.ap-southeast-1.amazonaws.com/productImages/1000X1000/1568951946487-200400002%20Grapefruit%20-%20Ruby%20%28L%29%20South%20Africa.png', '', '', '', '2021-09-06', 5, 'A', NULL),
(126, 'Chips More Mini', '0.99', 0, '', '../product/cm1.jpg', '../product/cm2.jpg', '', '', '2021-10-12', 2, 'A', 0),
(127, 'Oreo', '2.50', 496, 'Rich, smooth Chocolate Crème sandwiched between two crunchy chocolate wafers. Twist, Lick and Dunk the nostalgic childhood snack that everyone can’t get enough of. Delightful bitter flavor of chocolate wafers assorted with a burst of sweetness from the double cream filling curates a perfectly balanced bitter-sweet Oreo Snack. One pack is never enough but a set of 3 is just right! Reminisce your perfect childhood snack, Oreo, with your loved ones. ', '../product/oreo1.jpg', '', '', '', '2021-10-12', 2, 'A', 0),
(128, 'White Miso Paste 500G', '15.90', 117, 'Ingredients: Water, Organic Soybeans, Organic Rice, Salt, Yeast, Koji Culture.', '../product/miso1.jpg', '../product/miso2.jpg', '', '', '2021-10-24', 23, 'A', 0),
(129, 'Tiger Original Biscuits 180g', '2.90', 4997, 'Tiger biscuit contains important vitamins and minerals including Vitamin B1 &amp;amp; B2 which aid in release of energy.', '../product/tiger1.jpg', '', '', '', '2021-10-25', 2, 'A', 0),
(133, 'FUJI Apple', '3.29', 1, '', '../product/ShotType1_540x540.jpg', '', '', '', '2021-11-18', 1, 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `p_t_status`
--

CREATE TABLE `p_t_status` (
  `sid` int(1) NOT NULL,
  `stype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `p_t_status`
--

INSERT INTO `p_t_status` (`sid`, `stype`) VALUES
(0, 'Pending'),
(1, 'Successful'),
(2, 'Failed');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(9) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rating` float NOT NULL,
  `cusID` int(9) NOT NULL,
  `productID` int(9) NOT NULL,
  `orderID` int(9) NOT NULL,
  `rtime` date NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1,
  `reply` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `comment`, `rating`, `cusID`, `productID`, `orderID`, `rtime`, `status`, `reply`, `retime`) VALUES
(41, 'Good Product!', 5, 100079, 103, 105, '2021-11-10', 0, 'Thank!', NULL),
(42, 'Fresh!', 4, 100079, 108, 105, '2021-11-10', 0, '', NULL),
(43, 'Good!', 3, 100079, 126, 105, '2021-11-10', 1, 'Thanks for your support!', '2021-11-12'),
(44, 'Nice!', 5, 100079, 107, 105, '2021-11-10', 1, '', NULL),
(45, 'Nice', 5, 100079, 103, 104, '2021-11-10', 1, 'Thanks for your support!', NULL),
(46, 'GOOD', 5, 100079, 108, 104, '2021-11-10', 1, '', NULL),
(47, '', 3, 100079, 126, 104, '2021-11-10', 1, '', NULL),
(48, 'Good!', 5, 100079, 103, 109, '2021-11-10', 1, 'Thanks!', '2021-11-16'),
(49, '', 2, 100079, 108, 109, '2021-11-10', 1, '', NULL),
(50, '', 2, 100079, 126, 109, '2021-11-10', 0, '', NULL),
(51, '', 4, 100079, 127, 109, '2021-11-10', 1, '', NULL),
(52, 'sdsadas', 1, 100081, 103, 118, '2021-11-16', 0, '', NULL),
(53, 'asdas', 2, 100081, 108, 118, '2021-11-16', 0, '', NULL),
(54, 'Goos', 4, 100081, 103, 116, '2021-11-16', 1, '', NULL),
(55, 'sdsa', 3, 100081, 108, 116, '2021-11-16', 1, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timeSlot` int(9) NOT NULL,
  `timeRange` varchar(255) DEFAULT NULL,
  `numberOfSlot` int(3) NOT NULL,
  `dprice` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeSlot`, `timeRange`, `numberOfSlot`, `dprice`) VALUES
(1, '8:00 - 10:00', 22, '1.00'),
(2, '10:00 - 12:00', 49, '5.99'),
(3, '12:00 - 14:00', 3, '4.99'),
(4, '14:00 - 16:00', 20, '3.99'),
(5, '16:00 - 18:00', 20, '4.99'),
(6, '18:00 - 20:00', 12, '5.99'),
(7, '20:00 - 22:00', 2, '3.99');

-- --------------------------------------------------------

--
-- Table structure for table `wallettransaction`
--

CREATE TABLE `wallettransaction` (
  `transID` int(9) NOT NULL,
  `transAmount` decimal(10,2) DEFAULT NULL,
  `transName` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `createdTime` datetime DEFAULT current_timestamp(),
  `cusID` int(9) DEFAULT NULL,
  `paymentID` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallettransaction`
--

INSERT INTO `wallettransaction` (`transID`, `transAmount`, `transName`, `status`, `createdTime`, `cusID`, `paymentID`) VALUES
(35, '45.00', 'Topup', 1, '2021-11-10 14:18:37', 100079, NULL),
(36, '18.17', 'Payment', 1, '2021-11-10 14:39:50', 100079, 104),
(37, '22.00', 'Topup', 1, '2021-11-10 16:37:26', 100081, NULL),
(38, '13.68', 'Payment', 1, '2021-11-12 12:54:56', 100081, 111),
(39, '55.00', 'Topup', 0, '2021-11-17 00:22:43', 100081, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressID`),
  ADD KEY `cusID` (`cusID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `cusID` (`cusID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`oDID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orderp`
--
ALTER TABLE `orderp`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `cusID` (`cusID`),
  ADD KEY `status` (`status`),
  ADD KEY `timeslot` (`timeslot`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`osID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `pmID` (`pmID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`pmID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `p_t_status`
--
ALTER TABLE `p_t_status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `cusID` (`cusID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timeSlot`);

--
-- Indexes for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
  ADD PRIMARY KEY (`transID`),
  ADD KEY `cusID` (`cusID`),
  ADD KEY `paymentID` (`paymentID`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100086;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `oDID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `orderp`
--
ALTER TABLE `orderp`
  MODIFY `orderID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `osID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `pmID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `p_t_status`
--
ALTER TABLE `p_t_status`
  MODIFY `sid` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeSlot` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
  MODIFY `transID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `customer` (`cusID`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orderp` (`orderID`);

--
-- Constraints for table `orderp`
--
ALTER TABLE `orderp`
  ADD CONSTRAINT `orderp_ibfk_2` FOREIGN KEY (`cusID`) REFERENCES `customer` (`cusID`),
  ADD CONSTRAINT `orderp_ibfk_3` FOREIGN KEY (`status`) REFERENCES `orderstatus` (`osID`),
  ADD CONSTRAINT `orderp_ibfk_4` FOREIGN KEY (`timeslot`) REFERENCES `timeslot` (`timeSlot`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`pmID`) REFERENCES `paymentmethod` (`pmID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orderp` (`orderID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `customer` (`cusID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`orderID`) REFERENCES `orderp` (`orderID`);

--
-- Constraints for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
  ADD CONSTRAINT `wallettransaction_ibfk_1` FOREIGN KEY (`cusID`) REFERENCES `customer` (`cusID`),
  ADD CONSTRAINT `wallettransaction_ibfk_2` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`),
  ADD CONSTRAINT `wallettransaction_ibfk_3` FOREIGN KEY (`status`) REFERENCES `p_t_status` (`sid`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `Cancelorder` ON SCHEDULE EVERY 1 SECOND STARTS '2021-10-01 13:36:08' ON COMPLETION NOT PRESERVE ENABLE DO update orderp 
set status= 7
where CURRENT_TIMESTAMP > orderDate+ INTERVAL '1' HOUR and status=1$$

CREATE DEFINER=`root`@`localhost` EVENT `CompleteOrder` ON SCHEDULE EVERY 1 SECOND STARTS '2021-10-01 13:39:18' ON COMPLETION NOT PRESERVE ENABLE DO update orderp 
set status= 5
where CURRENT_TIMESTAMP > updatedTime+ INTERVAL '7' DAY and status=4$$

CREATE DEFINER=`root`@`localhost` EVENT `updateTrans` ON SCHEDULE EVERY 1 SECOND STARTS '2021-10-01 13:55:03' ON COMPLETION NOT PRESERVE ENABLE DO update wallettransaction
set status= 2
where CURRENT_TIMESTAMP > createdTime+ INTERVAL '10' MINUTE and status=0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
