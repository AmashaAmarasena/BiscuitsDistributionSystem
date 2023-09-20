-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 04:13 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distribution_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `fk_st_id` int(11) NOT NULL,
  `fk_veh_id` int(11) NOT NULL,
  `assing_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(20) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `cus_email` varchar(20) NOT NULL,
  `cus_address` varchar(20) NOT NULL,
  `cus_regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cus_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_phone`, `cus_email`, `cus_address`, `cus_regdate`, `cus_stt`) VALUES
(1, 'D.kanishka', '222222', 'bbbbb', 'abc,dsa.', '2021-10-19 18:30:00', 'Active'),
(2, 'S.Bandara', '0714578777', 'abbba@gga.com', 'kandy rode,peradeniy', '2021-10-19 18:30:00', 'delete'),
(3, 'B.kamal', '0789945123', 'qwe@gmail.com', 'kandy rode,matale.', '2021-10-14 18:30:00', 'Active'),
(4, 'Indika Gunawardhana', '0718476244', 'iiragunawardana@gmai', 'Rattota rode.Weragam', '2022-02-01 18:30:00', 'delete'),
(5, 'A.Amarasena', '0789945123', 'qwe@gmail.com', 'kandy rode,matale.', '2021-10-14 18:30:00', 'Active'),
(6, 'S.Bandara', '0714410172', 'bandara@gmail.com', 'Pallepola rd.Matale', '2023-02-12 18:30:00', 'Active'),
(7, 'thtruyt', '1111111111', 'dffdgdf', 'sfgrgre', '2023-03-28 04:31:38', 'delete'),
(8, 'S', '0714410178', 'iojiojoijo', 'jjkjo', '2023-03-29 18:30:00', 'Active'),
(9, 'S', '0714410178', 'iojiojoijo', 'jjkjo', '2023-03-28 06:03:31', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `damage`
--

CREATE TABLE `damage` (
  `damage_id` int(10) NOT NULL,
  `damage_date` date NOT NULL,
  `damage_note` varchar(50) NOT NULL,
  `damage_stt` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damage`
--

INSERT INTO `damage` (`damage_id`, `damage_date`, `damage_note`, `damage_stt`) VALUES
(1, '2022-12-21', 'expired', 'Active'),
(2, '2022-12-14', 'expired', 'Active'),
(3, '2022-12-14', 'expired', 'Active'),
(4, '2023-01-04', 'expired', 'Active'),
(5, '2023-03-24', 'Damaged', 'Active'),
(6, '2023-03-09', 'expired', 'Active'),
(7, '2023-03-15', 'lkjjh', 'Active'),
(8, '0000-00-00', '', 'Active'),
(9, '0000-00-00', '', 'Active'),
(10, '0000-00-00', '', 'Active'),
(11, '0000-00-00', '', 'Active'),
(12, '2023-03-20', 'expired', 'Active'),
(13, '0000-00-00', '', 'Active'),
(14, '0000-00-00', '', 'Active'),
(15, '0000-00-00', '', 'Active'),
(16, '0000-00-00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `damage_list`
--

CREATE TABLE `damage_list` (
  `damagelt_id` int(20) NOT NULL,
  `damagelt_itemcode` int(15) NOT NULL,
  `damagelt_qty` int(20) NOT NULL,
  `fk_damage_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damage_list`
--

INSERT INTO `damage_list` (`damagelt_id`, `damagelt_itemcode`, `damagelt_qty`, `fk_damage_id`) VALUES
(1, 2, 5, 0),
(2, 2, 5, 0),
(3, 2, 5, 0),
(4, 2, 5, 0),
(5, 2, 5, 0),
(6, 2, 5, 0),
(7, 2, 4, 0),
(8, 2, 6, 1),
(9, 2, 5, 2),
(10, 2, 5, 3),
(11, 2, 45, 4),
(12, 6, 80, 5),
(13, 2, 7, 6),
(14, 9, 2, 7),
(15, 2, 12, 12),
(16, 1, 50, 12);

-- --------------------------------------------------------

--
-- Table structure for table `grn`
--

CREATE TABLE `grn` (
  `grn_id` int(11) NOT NULL,
  `grn_date` date NOT NULL,
  `grn_refno` varchar(20) NOT NULL,
  `grn_note` varchar(100) NOT NULL,
  `grn_total_bill` decimal(20,0) NOT NULL,
  `fk_mac_id` int(11) NOT NULL,
  `grn_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grn`
--

INSERT INTO `grn` (`grn_id`, `grn_date`, `grn_refno`, `grn_note`, `grn_total_bill`, `fk_mac_id`, `grn_stt`) VALUES
(5, '2022-12-02', '2231', 'y6', '0', 2, 'Active'),
(6, '2022-12-01', 'hhh', 'uu', '0', 1, 'Active'),
(7, '2022-12-01', 'hhh', 'uu', '0', 1, 'Active'),
(8, '2022-11-25', '2111', 'ddddda', '0', 1, 'Active'),
(9, '2022-11-24', '2111', 'yyy', '0', 2, 'Active'),
(10, '2022-11-25', '223144', 'fff', '0', 1, 'Active'),
(11, '2022-11-30', '4455', 'aaaa', '0', 4, 'Active'),
(12, '2022-11-28', '9999', 'bbbb', '0', 4, 'Active'),
(13, '2022-11-22', '223144', 'tdjtf', '0', 4, 'Active'),
(14, '2022-11-22', '223144', 'tdjtf', '0', 4, 'Active'),
(15, '2022-11-24', '2231', 'tdjtf', '0', 3, 'Active'),
(16, '2022-11-24', '2231', 'tdjtf', '0', 3, 'Active'),
(17, '2022-11-01', '223144', 'tdjtf', '0', 2, 'Active'),
(18, '2022-11-01', '2231', 'tdjtf', '0', 2, 'Active'),
(19, '2022-11-01', '2231', 'tdjtf', '0', 2, 'Active'),
(20, '2022-11-03', '2111', 'tdjtf', '0', 2, 'Active'),
(25, '2022-12-07', '2231', 'tdjtf', '0', 2, 'Active'),
(26, '2022-12-09', '2231', 'tdjtf', '0', 1, 'Active'),
(27, '2022-12-09', '2231', 'tdjtf', '0', 4, 'Active'),
(28, '2022-12-15', '888', 'vvv', '0', 2, 'Active'),
(29, '2022-12-15', '2231', 'tdjtf', '0', 1, 'Active'),
(30, '2022-12-08', 'hhh', 'tdjtf', '0', 2, 'Active'),
(31, '2022-12-08', 'hhh', 'tdjtf', '0', 2, 'Active'),
(32, '2022-12-08', '223144', 'tdjtf', '0', 2, 'Active'),
(33, '2022-12-08', '223144', 'ddddda', '0', 2, 'Active'),
(34, '0000-00-00', '2231', 'tdjtf', '0', 1, 'Active'),
(35, '2022-12-08', '2231', 'tdjtf', '0', 2, 'Active'),
(36, '0000-00-00', '2231', 'tdjtf', '0', 1, 'Active'),
(37, '0000-00-00', '2231', 'tdjtf', '0', 1, 'Active'),
(38, '2022-12-01', '2231', 'ddddda', '0', 1, 'Active'),
(39, '2022-12-10', '2231', 'tdjtf', '0', 2, 'Active'),
(40, '2022-12-08', '2231', 'tdjtf', '0', 1, 'Active'),
(41, '2022-12-07', '2231', 'tdjtf', '0', 1, 'Active'),
(42, '2022-12-07', '223144', 'tdjtf', '0', 2, 'Active'),
(43, '2022-12-15', '223144', 'ddddda', '0', 3, 'Active'),
(44, '2022-12-08', '2231', 'ddddda', '0', 2, 'Active'),
(45, '2022-12-15', '2231', 'tdjtf', '0', 3, 'Active'),
(46, '2022-12-16', 'hhh', 'y6', '0', 1, 'Active'),
(47, '0000-00-00', '', '', '0', 1, 'Active'),
(48, '0000-00-00', '', '', '0', 1, 'Active'),
(49, '0000-00-00', '2231', 'tdjtf', '0', 1, 'Active'),
(50, '2022-12-14', '223144', 'uu', '0', 2, 'Active'),
(51, '2022-12-16', '2236', 'tdjtf', '0', 2, 'Active'),
(52, '2022-12-31', '9090', 'NNN', '0', 2, 'Active'),
(53, '2023-01-02', '2231', 'y6', '0', 2, 'Active'),
(54, '2023-01-07', '2231', 'ddddda', '0', 2, 'Active'),
(55, '0000-00-00', '', '                                            ', '0', 1, 'Active'),
(56, '0000-00-00', '', '                                            ', '0', 1, 'Active'),
(57, '2023-03-08', '2231', '    ssssss                                        ', '0', 2, 'Active'),
(58, '2023-03-07', '45', 'two rows                               ', '0', 2, 'Active'),
(59, '2023-03-08', '2231', 'asaadwdss                                            ', '14000', 2, 'Active'),
(60, '2023-03-07', '12', 'Aoejweofuhasdjasojoj                                         ', '6000', 4, 'Active'),
(61, '0000-00-00', '', '                                            ', '10000', 1, 'Active'),
(62, '0000-00-00', '', '                                            ', '10000', 1, 'Active'),
(63, '2023-03-09', '20', 'ereeewq                                            ', '32000', 3, 'Active'),
(64, '2023-03-09', '77[', 'lllll', '18000', 2, 'Active'),
(65, '2023-03-07', '17', 'hgjbhjvv', '7000', 4, 'Active'),
(66, '2023-03-07', '', '                                            ', '5400', 4, 'Active'),
(67, '2023-03-07', '', '                                            ', '5400', 4, 'Active'),
(68, '0000-00-00', '', '                                            ', '25000', 2, 'Active'),
(69, '0000-00-00', '', '                                            ', '25000', 2, 'Active'),
(70, '0000-00-00', '', '                                            ', '25000', 2, 'Active'),
(71, '2023-03-21', 'lkl', '                                            ', '100000', 3, 'Active'),
(72, '2023-03-08', '7', 'ddfsdf                                           ', '50000', 2, 'Active'),
(73, '2023-03-09', '2231', 'qrrwerr                                     ', '75000', 4, 'Active'),
(74, '0000-00-00', '', '                                            ', '0', 1, 'Active'),
(75, '2023-03-24', 'ffff', '          ffff                                  ', '400', 3, 'Active'),
(76, '2023-03-24', 'ffff', '          ffff                                  ', '400', 3, 'Active'),
(77, '2023-03-24', 'ffff', '          ffff                                  ', '400', 3, 'Active'),
(78, '2023-03-24', 'ffff', '          ffff                                  ', '400', 3, 'Active'),
(79, '2023-04-06', '658', ' New stock                                    ', '5000', 1, 'Active'),
(80, '2023-04-04', '10', 'New GRN                                            ', '1000', 1, 'Active'),
(81, '2023-04-07', '48', '    New item                                        ', '5600', 5, 'Active'),
(82, '2023-04-07', '52', '                                            ', '28000', 5, 'Active'),
(83, '2023-04-12', '49', '                                            ', '1200', 5, 'Active'),
(84, '2023-04-11', '41', '                                            ', '10000', 5, 'Active'),
(85, '2023-04-11', '41', '                                            ', '10000', 5, 'Active'),
(86, '2023-04-08', '17', '                                            ', '12000', 5, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `grn_list`
--

CREATE TABLE `grn_list` (
  `grnls_id` int(11) NOT NULL,
  `grnls_itmcode` int(15) NOT NULL,
  `grnls_descip` varchar(50) NOT NULL,
  `grnls_qty` varchar(20) NOT NULL,
  `grnls_purchase_price` varchar(15) NOT NULL,
  `grnls_ex_date` date NOT NULL,
  `grnls_sales_price` int(11) NOT NULL,
  `grnlt_item_amount` decimal(20,0) NOT NULL,
  `fk_grn_id` int(11) NOT NULL,
  `grnlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grn_list`
--

INSERT INTO `grn_list` (`grnls_id`, `grnls_itmcode`, `grnls_descip`, `grnls_qty`, `grnls_purchase_price`, `grnls_ex_date`, `grnls_sales_price`, `grnlt_item_amount`, `fk_grn_id`, `grnlt_stt`, `fk_pro_id`) VALUES
(1, 0, '', '55', '100', '2022-09-10', 80, '0', 40, 'Active', 0),
(2, 0, 'ccc', '55', '100', '2022-09-10', 80, '0', 40, 'Active', 0),
(3, 0, 'ccc', '55', '100', '2022-09-10', 80, '0', 40, 'Active', 0),
(4, 0, 'ccc', '55', '100', '2022-09-10', 80, '0', 41, 'Active', 0),
(5, 0, 'ccc', '55', '100', '2022-09-10', 80, '0', 42, 'Active', 0),
(6, 0, 'ccc', '55', '100', '2022-09-10', 80, '0', 43, 'Active', 0),
(7, 0, 'ccc', '55', '100', '2022-09-10', 80, '0', 44, 'Active', 0),
(8, 0, 'ccc', '55', '100', '2022-09-10', 120, '0', 45, 'Active', 0),
(9, 0, 'ccc', '55', '50', '2022-09-10', 120, '0', 46, 'Active', 0),
(10, 0, 'ssssa', '30', '200', '2022-09-10', 80, '0', 47, 'Active', 0),
(11, 16, 'dds', '20', '50', '2022-09-08', 80, '0', 48, 'Active', 0),
(12, 1, 'ccc', '40', '100', '2022-09-10', 80, '0', 49, 'Active', 0),
(13, 6, 'ccc', '55', '44', '2022-09-10', 140, '0', 50, 'Active', 0),
(14, 2, 'ccc', '20', '100', '2022-09-10', 120, '0', 51, 'Active', 0),
(15, 2, 'Biscuits', '100', '40', '2022-09-10', 60, '0', 52, 'Active', 0),
(16, 2, 'ccc', '55', '100', '2023-01-02', 120, '0', 53, 'Active', 0),
(17, 2, 'ccc', '30', '100', '2022-09-10', 120, '0', 54, 'Active', 0),
(18, 1, 'ccc', '10', '10', '2023-03-07', 110, '100', 57, 'Active', 0),
(19, 2, 'ccc', '10', '100', '2024-03-12', 120, '1000', 58, 'Active', 0),
(20, 6, 'ccck', '50', '250', '2025-01-01', 280, '12500', 58, 'Active', 0),
(21, 1, 'reqqd', '10', '500', '2024-02-06', 520, '5000', 59, 'Active', 0),
(22, 2, 'gjhvm', '50', '180', '2024-05-06', 200, '9000', 59, 'Active', 0),
(23, 2, 'Mini Biscuit', '50', '120', '2025-01-07', 150, '6000', 60, 'Active', 0),
(24, 6, 'Biscuits', '80', '400', '2024-05-07', 420, '32000', 63, 'Active', 0),
(25, 1, 'hfgggg', '60', '300', '2023-03-29', 320, '18000', 64, 'Active', 0),
(26, 2, 'kjj', '14', '500', '2023-03-28', 540, '7000', 65, 'Active', 0),
(27, 1, '', '54', '100', '0000-00-00', 150, '5400', 66, 'Active', 0),
(28, 1, '', '54', '100', '0000-00-00', 150, '5400', 67, 'Active', 0),
(29, 1, '', '100', '1000', '2023-02-28', 1150, '100000', 71, 'Active', 0),
(30, 1, 'BIscuits', '150', '500', '2023-04-05', 520, '75000', 73, 'Active', 0),
(31, 2, 'ffff', '20', '20', '2023-04-04', 30, '400', 75, 'Active', 0),
(32, 2, 'ffff', '20', '20', '2023-04-04', 30, '400', 76, 'Active', 0),
(33, 2, 'ffff', '20', '20', '2023-04-04', 30, '400', 78, 'Active', 0),
(34, 6, 'New Stock', '100', '50', '2024-04-30', 55, '5000', 79, 'Active', 0),
(35, 49, 'New GRN', '10', '100', '2023-04-26', 120, '1000', 80, 'Active', 0),
(36, 50, '', '40', '140', '2023-04-27', 150, '5600', 81, 'Active', 0),
(37, 9, '', '70', '400', '2024-10-30', 425, '28000', 82, 'Active', 0),
(38, 49, '', '10', '120', '2023-04-25', 130, '1200', 83, 'Active', 0),
(39, 41, '', '100', '100', '2023-04-26', 120, '10000', 84, 'Active', 0),
(40, 41, '', '100', '100', '2023-04-26', 120, '10000', 85, 'Active', 0),
(41, 49, '', '80', '150', '2023-04-11', 1602, '12000', 86, 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_totammount` decimal(20,0) NOT NULL,
  `invoice_duedate` date NOT NULL,
  `invoice_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `load`
--

CREATE TABLE `load` (
  `load_id` int(11) NOT NULL,
  `fk_veh_id` int(11) NOT NULL,
  `load_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `load_date` date NOT NULL,
  `load_note` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `load list`
--

CREATE TABLE `load list` (
  `loadlt_id` int(15) NOT NULL,
  `loadlt_itemcode` int(15) NOT NULL,
  `loadlt_qty` varchar(8) NOT NULL DEFAULT 'Active',
  `loadlt_stt` int(15) NOT NULL,
  `fk_load_id` int(11) NOT NULL,
  `fk_pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE `manufacture` (
  `mac_id` int(11) NOT NULL,
  `mac_name` varchar(30) NOT NULL,
  `mac_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `mac_descrip` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`mac_id`, `mac_name`, `mac_stt`, `mac_descrip`) VALUES
(1, 'CBL', 'Active', 'Biscuits'),
(2, 'CBL FOOD', 'Active', 'Food'),
(3, 'CBL FOOD 2', 'Active', 'Food'),
(4, 'CBL FOOD 3', 'Active', 'Food'),
(5, 'CBL Biscuits', 'Active', 'Manufacture of CBL biscuits');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `orderlt_descrip` varchar(100) NOT NULL,
  `orderlt_qty` varchar(20) NOT NULL,
  `orderlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_mac_id` int(11) NOT NULL,
  `fk_order_id` int(11) NOT NULL,
  `orderlt_id` int(11) NOT NULL,
  `fk_pro_id` int(11) NOT NULL,
  `orderlt_item_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`orderlt_descrip`, `orderlt_qty`, `orderlt_stt`, `fk_mac_id`, `fk_order_id`, `orderlt_id`, `fk_pro_id`, `orderlt_item_id`) VALUES
('biscuits', '10', 'Active', 0, 54, 1, 0, 0),
('biscuits', '20', 'Active', 0, 54, 2, 0, 0),
('biscuits', '20', 'Active', 0, 94, 3, 0, 0),
('biscuits', '20', 'Active', 0, 101, 4, 0, 2),
('cerial', '50', 'Active', 0, 102, 5, 0, 12),
('uuu', '20', 'Active', 0, 103, 6, 0, 2),
('ffffgg', '12', 'Active', 0, 10, 7, 0, 0),
('dsddd', '80', 'Active', 0, 11, 8, 0, 0),
('biscuits', '20', 'Active', 0, 104, 9, 0, 6),
('biscuits', '20', 'Active', 0, 105, 10, 0, 1),
('biscuits', '20', 'Active', 0, 106, 11, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ordr`
--

CREATE TABLE `ordr` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_mac_id` int(11) NOT NULL,
  `Staff_st_id` int(11) NOT NULL,
  `order_refno` varchar(30) NOT NULL,
  `order_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordr`
--

INSERT INTO `ordr` (`order_id`, `order_date`, `order_stt`, `fk_mac_id`, `Staff_st_id`, `order_refno`, `order_note`) VALUES
(1, '2022-01-04', 'Active', 4, 0, '', ''),
(2, '2022-01-04', 'Active', 3, 0, '', ''),
(3, '2022-01-04', 'Active', 3, 0, '', ''),
(4, '2022-01-04', 'Active', 5, 0, '', ''),
(5, '2022-01-04', 'Active', 5, 0, '', ''),
(6, '2022-01-04', 'Active', 5, 0, '', ''),
(89, '0000-00-00', 'Active', 1, 0, '', ''),
(90, '0000-00-00', 'Active', 1, 0, '', ''),
(91, '2022-03-05', 'Active', 2, 0, '', ''),
(92, '2022-03-06', 'Active', 2, 0, '', ''),
(93, '2022-03-10', 'Active', 2, 0, '', ''),
(94, '2022-03-10', 'Active', 2, 0, '123322', 'sfgs'),
(95, '2022-03-12', 'Active', 4, 0, '134533', 'vdsaw'),
(96, '2022-03-13', 'Active', 4, 0, '221123', 'sdgdfgf'),
(97, '2022-03-13', 'Active', 4, 0, '221123', 'sdgdfgf'),
(98, '2022-03-13', 'Active', 4, 0, '221123', 'sdgdfgf'),
(99, '2022-03-13', 'Active', 4, 0, '221123', 'sdgdfgf'),
(100, '2022-03-15', 'Active', 2, 0, '221127', 'dffd'),
(101, '2022-03-15', 'Active', 2, 0, '221127', 'dffd'),
(102, '2022-11-23', 'Active', 2, 0, '1349', 'dsdd'),
(103, '2022-11-18', 'Active', 2, 0, '777iu', 'uu'),
(104, '2022-11-27', 'Active', 4, 0, '333', 'mmm'),
(105, '2022-12-06', 'Active', 3, 0, '22112', 'dwaasffwwcdd'),
(106, '2022-12-06', 'Active', 3, 0, '1345', 'dhh'),
(107, '2022-12-15', 'Active', 2, 0, '1345', 'dhh'),
(108, '2022-12-04', 'Active', 3, 0, '1345', 'dwaasffwwcddsss'),
(109, '0000-00-00', 'Active', 1, 0, '', ''),
(110, '0000-00-00', 'Active', 1, 0, '', ''),
(111, '0000-00-00', 'Active', 2, 0, '', ''),
(112, '0000-00-00', 'Active', 2, 0, '', ''),
(113, '0000-00-00', 'Active', 1, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `cash` decimal(12,0) NOT NULL,
  `cheque_amount` decimal(12,0) NOT NULL,
  `cheque_no` varchar(10) NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_bank` varchar(20) NOT NULL,
  `credit` decimal(20,0) NOT NULL,
  `paid_amount` int(30) NOT NULL,
  `pay_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_sales_id` int(10) NOT NULL,
  `fk_method_id` int(11) NOT NULL,
  `fk_cus_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `cash`, `cheque_amount`, `cheque_no`, `cheque_date`, `cheque_bank`, `credit`, `paid_amount`, `pay_stt`, `fk_sales_id`, `fk_method_id`, `fk_cus_id`) VALUES
(1, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 61, 0, 0),
(2, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 64, 0, 0),
(3, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 65, 0, 0),
(4, '500', '0', '2', '2023-02-11', 'BOC', '1400', 0, 'Active', 66, 0, 0),
(5, '2000', '0', '5', '2023-02-08', 'BOC', '1800', 0, 'Active', 67, 0, 0),
(6, '1000', '0', '5', '2023-02-08', 'BOC', '900', 0, 'Active', 68, 0, 0),
(7, '50', '50', '', '0000-00-00', '', '900', 0, 'Active', 74, 0, 0),
(8, '100', '100', '2', '0000-00-00', 'BOC', '750', 0, 'Active', 75, 0, 0),
(9, '500', '500', '1', '2023-02-11', 'boc', '9000', 1, 'Active', 76, 0, 0),
(10, '500', '500', '1', '2023-02-11', 'boc', '9000', 1, 'Active', 77, 0, 0),
(11, '900', '0', '', '0000-00-00', '', '9100', 900, 'Active', 78, 0, 0),
(12, '500', '1000', '25', '2023-02-18', 'BOC', '7620', 1000, 'Active', 79, 0, 6),
(13, '500', '500', '5', '0000-00-00', 'BOC', '1400', 1000, 'Active', 81, 0, 6),
(14, '1000', '1000', '20', '2023-02-26', 'BOC', '1920', 2000, 'Active', 82, 0, 6),
(15, '1000', '1000', '20', '2023-02-26', 'BOC', '1920', 2000, 'Active', 84, 0, 6),
(16, '1000', '1000', '20', '2023-02-26', 'BOC', '1920', 2000, 'Active', 85, 0, 6),
(17, '1000', '1000', '20', '2023-02-26', 'BOC', '1920', 2000, 'Active', 86, 0, 6),
(18, '1000', '1000', '20', '2023-02-26', 'BOC', '1920', 2000, 'Active', 87, 0, 6),
(19, '1000', '1000', '20', '2023-02-26', 'BOC', '1920', 2000, 'Active', 88, 0, 6),
(20, '8000', '120', '77', '0000-00-00', 'BOC', '0', 8120, 'Active', 0, 0, 0),
(22, '8000', '120', '5', '0000-00-00', 'boc', '0', 8120, 'Active', 79, 0, 0),
(23, '1000', '920', '2', '0000-00-00', 'boc', '0', 1920, 'Active', 87, 0, 0),
(24, '1000', '0', '2', '2023-02-28', 'NSB', '0', 1000, 'Active', 89, 0, 1),
(25, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 89, 0, 1),
(26, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 90, 0, 1),
(27, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 90, 0, 1),
(28, '1000', '2000', '8', '2023-02-28', 'BOC', '1365', 3000, 'Active', 91, 0, 3),
(29, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 91, 0, 3),
(30, '1000', '5000', '6', '2023-02-28', 'NSB', '3000', 6000, 'Active', 93, 0, 6),
(31, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 93, 0, 6),
(32, '100', '0', '5', '2023-02-24', 'NSB', '4650', 100, 'Active', 94, 0, 1),
(33, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 94, 0, 1),
(34, '100', '100', '8', '0000-00-00', 'BOC', '560', 200, 'Active', 95, 0, 1),
(35, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 95, 0, 1),
(36, '1000', '1000', '4', '2023-02-24', 'NSB', '1772', 2000, 'Active', 96, 0, 3),
(37, '5000', '400', '2', '2023-02-28', 'boc', '13200', 5400, 'Active', 96, 0, 3),
(38, '1000', '1000', '4', '2023-02-24', 'NSB', '1772', 2000, 'Active', 97, 0, 3),
(39, '5000', '400', '2', '2023-02-28', 'boc', '13200', 5400, 'Active', 97, 0, 3),
(40, '1000', '1000', '4', '2023-02-24', 'NSB', '1772', 2000, 'Active', 98, 0, 3),
(41, '5000', '400', '2', '2023-02-28', 'boc', '13200', 5400, 'Active', 98, 0, 3),
(42, '500', '100', '5', '2023-02-27', 'NSB', '350', 600, 'Active', 100, 0, 3),
(43, '1000', '2000', '8', '2023-02-27', 'NSB', '2000', 3000, 'Active', 100, 0, 3),
(44, '500', '100', '5', '2023-02-27', 'NSB', '350', 600, 'Active', 101, 0, 3),
(45, '1000', '2000', '8', '2023-02-27', 'NSB', '2000', 3000, 'Active', 101, 0, 3),
(46, '0', '0', 'Array', '0000-00-00', 'Array', '0', 0, 'Active', 0, 0, 0),
(47, '0', '0', 'Array', '0000-00-00', 'Array', '0', 0, 'Active', 0, 0, 0),
(48, '0', '0', 'Array', '0000-00-00', 'Array', '0', 0, 'Active', 0, 0, 0),
(49, '0', '0', 'Array', '0000-00-00', 'Array', '0', 0, 'Active', 0, 0, 0),
(50, '0', '0', 'Array', '0000-00-00', 'Array', '0', 0, 'Active', 0, 0, 0),
(51, '0', '0', 'Array', '0000-00-00', 'Array', '0', 0, 'Active', 0, 0, 0),
(52, '0', '0', '5', '0000-00-00', 'BOC', '2750', 2000, 'Active', 0, 0, 0),
(53, '0', '0', '6', '0000-00-00', 'bbb', '4700', 1000, 'Active', 0, 0, 0),
(54, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 0, 0, 0),
(55, '0', '0', '2', '0000-00-00', 'NSB', '14500', 10000, 'Active', 0, 0, 0),
(56, '0', '0', '9', '0000-00-00', 'NSB', '1350', 1500, 'Active', 0, 0, 0),
(57, '0', '0', '2', '0000-00-00', 'NDB', '4860', 2000, 'Active', 0, 0, 0),
(58, '0', '0', '5', '0000-00-00', 'mnv', '2000', 2000, 'Active', 0, 0, 0),
(59, '0', '0', '23', '0000-00-00', 'boc', '3000', 2000, 'Active', 0, 0, 0),
(60, '0', '0', '6', '0000-00-00', 'nnn', '21750', 2000, 'Active', 0, 0, 0),
(61, '0', '0', '6', '0000-00-00', 'nnn', '21750', 2000, 'Active', 0, 0, 0),
(62, '0', '0', '1', '0000-00-00', 'boc', '28200', 2000, 'Active', 0, 0, 0),
(63, '0', '0', '4', '0000-00-00', 'NDB', '21360', 10000, 'Active', 0, 0, 0),
(64, '0', '0', '5', '0000-00-00', 'NDB', '4550', 10000, 'Active', 0, 0, 0),
(65, '0', '0', '8', '0000-00-00', 'dddd', '17400', 2000, 'Active', 0, 0, 0),
(66, '1000', '1000', '66', '2023-03-07', 'bbb', '21750', 2000, 'Active', 0, 0, 0),
(67, '500', '500', '5', '2023-02-28', 'nnn', '1880', 1000, 'Active', 0, 0, 0),
(68, '1000', '1000', '5', '2023-03-08', 'NSB', '3000', 2000, 'Active', 0, 0, 0),
(69, '2000', '2000', '4', '2023-03-07', 'NDB', '24800', 4000, 'Active', 126, 0, 0),
(70, '5000', '5000', '4', '2023-02-28', 'NDB', '41225', 10000, 'Active', 127, 0, 0),
(72, '24800', '0', '4', '2023-03-08', 'NDB', '0', 24800, 'Active', 126, 0, 0),
(73, '9970', '0', '6', '2023-03-09', 'NSB', '0', 9970, 'Active', 127, 0, 0),
(74, '10000', '500', '8', '2023-03-09', 'BOC', '29500', 10500, 'Active', 128, 0, 0),
(75, '29500', '0', '6', '2023-03-07', 'BOC', '0', 29500, 'Active', 128, 0, 0),
(76, '5000', '5000', '4', '2023-03-08', 'NSB', '7280', 10000, 'Active', 129, 0, 0),
(77, '7280', '0', '6', '2023-03-11', 'NSB', '0', 7280, 'Active', 129, 0, 0),
(78, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 130, 0, 0),
(79, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 131, 0, 0),
(80, '5000', '10000', '80', '2023-03-22', 'HSBC', '15886', 15000, 'Active', 132, 0, 0),
(81, '15886', '0', '81', '0000-00-00', 'HSBC', '0', 15886, 'Active', 132, 0, 0),
(82, '52', '0', '', '0000-00-00', '', '-52', 52, 'Active', 133, 0, 0),
(83, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 134, 0, 0),
(84, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 135, 0, 0),
(85, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 136, 0, 0),
(86, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 137, 0, 0),
(87, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 138, 0, 0),
(88, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 139, 0, 0),
(89, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 140, 0, 0),
(90, '0', '0', '', '0000-00-00', '', '0', 0, 'Active', 144, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `method_id` int(11) NOT NULL,
  `method_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(45) NOT NULL,
  `pro_code` varchar(20) NOT NULL,
  `pro_packsize` varchar(12) NOT NULL,
  `pro_items_in_pack` varchar(8) NOT NULL,
  `pro_weight` varchar(20) NOT NULL,
  `pro_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_procat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `pro_code`, `pro_packsize`, `pro_items_in_pack`, `pro_weight`, `pro_stt`, `fk_procat_id`) VALUES
(1, 'Choco pie', '77', '300g', '70', '3kg', 'Active', 1),
(2, 'Tikiri mari', '879', '200kg', '50', '50kg', 'Active', 1),
(3, 'Milk short cake', '1500', '120g', '100', '23kg', 'delete', 1),
(4, 'Cream cracker', '1500', '24kg', '45', '100g', 'delete', 1),
(5, 'potato crackers', '190', '450kg', '50', '15kg', 'delete', 1),
(6, 'choco Bits', '1589', '100kg', '37', '50g', 'Active', 3),
(7, 'Samaposha', '123', '100g', '50', '5kg', 'delete', 4),
(8, 'Ginger biscuit', '555', '100g', '20', '2kg', 'delete', 3),
(9, 'Milk short Mini', '444', '5kg', '50', '200g', 'Active', 1),
(10, 'Milk short handy', '111', '33kg', '2', '22kg', 'delete', 1),
(11, 'Milk short cake2', '879', '125kg', '12', '44kg', 'Active', 3),
(12, 'oats', '9999', '150g', '20', '200g', 'Active', 4),
(13, 'brand crsss', '4788', '120kg', '88', '444kg', 'delete', 5),
(14, 'zfd', 'w111', '44kg', '44', '5kg', 'delete', 3),
(15, 'zfd', 'w111', '44kg', '44', '5kg', 'delete', 3),
(16, 'sdgs', 'srtr', 'fgkgkg', '40', 'rrkgkg', 'delete', 3),
(17, 'sdf', 'sr', 'wrtrwtkg', 'srtr', 'rtrkg', 'delete', 3),
(18, 'Brand Cracker', '004', '100gkg', '20', '8kgkg', 'Active', 1),
(19, 'tt', 'tt', 'ttkg', 'tt', 'ttkg', 'delete', 3),
(20, 'j', '1500', '150kg', '45', '5kg', 'delete', 3),
(21, 'Mi', '444', '4455kg', '55', '2kg', 'delete', 3),
(22, 'm', 'sff', 'fkg', 'f', 'fkg', 'delete', 1),
(23, 'm', 'sff', 'fkg', 'f', 'fkg', 'delete', 1),
(24, 'm', 'sff', 'fkg', 'f', 'fkg', 'delete', 1),
(25, 'Mi', '4', '4kg', '4', '4kg', 'delete', 1),
(26, 'Milk short cake', '444', '200kg', '3', '100kg', 'delete', 3),
(27, 'Milk short cake', '44', '45kg', '37', '55kg', 'delete', 3),
(28, 'Milk short cake', '545', '5kg', '55', '55kg', 'delete', 3),
(29, 'Milk short cake', '048', '0kg', '50', '50kg', 'delete', 4),
(30, 'Milk short cake', '444', '1kg', '37', '2kg', 'delete', 1),
(31, 'Milk short cake', '444', '99kg', '37', '50kg', 'delete', 3),
(32, 'mik', '44', '4kg', '4', '4kg', 'delete', 1),
(33, '444', '444', '200kg', '37', '50kg', 'delete', 3),
(34, 'Milk short cake', '444', '444444kg', '37', '50kg', 'delete', 3),
(35, 'Mil', '444', '111kg', '11', '50kg', 'delete', 3),
(36, 'm', '444', '200kg', '60', '50kg', 'delete', 1),
(37, 'm', '444', '200kg', '60', '50kg', 'delete', 1),
(38, 'd', '444', '150kg', '50', '4kg', 'delete', 3),
(39, 'd', '444', '150kg', '50', '4kg', 'delete', 3),
(40, 'wyytttrr', '14', '150g', '7', '7g', 'delete', 1),
(41, 'Butter carols', '444', '100', '37', '100kg', 'Active', 1),
(42, 'fgdfdfd', '77', '100', '50', '7kg', 'Active', 3),
(43, 'fgdfdfd', '77', '100', '50', '7kg', 'Active', 3),
(44, 'fgdfdfd', '77', '100', '50', '7kg', 'Active', 3),
(45, 'fgdfdfd', '77', '100', '50', '7kg', 'Active', 3),
(46, 'fgdfdfd', '77', '100', '50', '7kg', 'Active', 3),
(47, 'Tikiri mari', '772', '100', '45', '100kg', 'Active', 4),
(48, 'Milk short cake', '773', '150', '50', '50kg', 'Active', 13),
(49, 'Vanila maari', '03', '100', '45', '5kg', 'Active', 1),
(50, 'Savory snack', '30', '6', '15', '300g', 'Active', 13),
(51, 'Savory snack', '30', '6', '15', '300g', 'delete', 13);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `procat_id` int(11) NOT NULL,
  `procat_name` varchar(20) NOT NULL,
  `procat_descrip` varchar(100) NOT NULL,
  `procat_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`procat_id`, `procat_name`, `procat_descrip`, `procat_stt`) VALUES
(1, 'Cream Cracker', '111', 'Active'),
(2, 'Munchee4', 'Biscuits4', 'del'),
(3, 'Chocolate', 'this is choco', 'Active'),
(4, 'Cereal', 'Samaposha bar', 'Active'),
(5, 'Biscuits', 'Biscuits', 'delete'),
(6, 'Cream Cracker', 'Handy Pack', 'delete'),
(7, 'Cream Cracker', 'Handy Pack', 'delete'),
(8, 'Cream Cracker', 'Handy Pack', 'delete'),
(9, 'Cream Cracker', 'Handy Pack', 'delete'),
(10, 'Cream Cracker', 'Handy Pack', 'delete'),
(11, 'Cream Cracker', 'ghddjsjs', 'delete'),
(12, 'Cream Cracker', 'Handy Pack', 'Active'),
(13, 'Spicy Cracker', '111', 'Active'),
(14, 'Sweet Cracker', '111', 'Active'),
(15, 'Sweet Cracker', '111', 'Active'),
(16, 'Chocolate', 'premium dark chocolate', 'Active'),
(17, 'Chocolate', 'premium chocolate', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product_load`
--

CREATE TABLE `product_load` (
  `load_id` int(15) NOT NULL,
  `load_date` date NOT NULL,
  `load_note` varchar(40) NOT NULL,
  `load_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_veh_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_load`
--

INSERT INTO `product_load` (`load_id`, `load_date`, `load_note`, `load_stt`, `fk_veh_id`) VALUES
(1, '0000-00-00', '$this->pack_note', 'Active', 0),
(2, '2022-12-14', 'aaaa', 'Active', 18),
(3, '2022-12-13', 'aaaa', 'Active', 17),
(4, '2022-12-14', 'aaaa', 'Active', 17),
(5, '2022-12-07', 'aaaa', 'Active', 18),
(6, '2022-12-08', 'aaaa', 'Active', 18),
(7, '2022-12-15', 'cccc', 'Active', 17),
(8, '2022-12-14', 'aaaa', 'Active', 18),
(9, '2022-12-21', 'aaaa', 'Active', 18),
(10, '2022-12-08', 'aaaa', 'Active', 17),
(11, '2022-12-14', 'aaaa', 'Active', 19),
(12, '2022-12-15', 'cccc', 'Active', 19),
(13, '2022-12-15', 'cccc', 'Active', 19),
(14, '2022-12-14', 'aaaa', 'Active', 18),
(15, '2022-12-06', 'aaaa', 'Active', 18),
(16, '2022-12-12', 'dddd', 'Active', 19),
(17, '2022-12-13', 'aaaa', 'Active', 18),
(18, '2022-12-13', 'zzz', 'Active', 19),
(19, '2022-12-17', 'zxzx', 'Active', 18),
(20, '2022-12-08', 'aaaa', 'Active', 18),
(21, '2022-12-22', 'cccc', 'Active', 18),
(22, '2022-12-09', 'aaa', 'Active', 17),
(23, '2022-12-15', 'aaaa', 'Active', 17),
(24, '2022-12-15', 'cccc', 'Active', 17),
(25, '2022-12-15', 'cccc', 'Active', 17),
(26, '2022-12-15', 'aaaa', 'Active', 18),
(27, '2022-12-08', 'aaaa', 'Active', 19),
(28, '2022-12-08', 'aaaa', 'Active', 18),
(29, '2022-12-15', 'wwww', 'Active', 18),
(30, '2022-12-15', 'aaaa', 'Active', 18),
(31, '2022-12-17', 'aaaa', 'Active', 18),
(32, '2022-12-21', 'qqqq', 'Active', 17),
(33, '2022-12-07', 'aaaa', 'Active', 18),
(34, '2023-01-04', 'Loded', 'Active', 17),
(35, '2023-01-01', 'Loded', 'Active', 19),
(36, '2023-01-07', 'Loded', 'Active', 18),
(37, '2023-03-09', 'Loded', 'Active', 18),
(38, '2023-03-08', 'Loded', 'Active', 17),
(39, '2023-03-16', 'lkkkk', 'Active', 17),
(40, '2023-03-02', '555', 'Active', 17),
(41, '0000-00-00', '', 'Active', 17),
(42, '0000-00-00', '', 'Active', 17),
(43, '2023-04-04', 'NEW LOAD', 'Active', 20),
(44, '2023-04-07', '', 'Active', 18),
(45, '2023-04-08', '', 'Active', 20),
(46, '2023-04-08', '', 'Active', 17),
(47, '2023-04-08', '', 'Active', 17),
(48, '2023-04-08', '', 'Active', 20),
(49, '2023-04-08', '', 'Active', 20),
(50, '2023-04-09', '', 'Active', 20),
(51, '2023-04-09', '', 'Active', 20),
(52, '2023-04-08', '', 'Active', 19),
(53, '2023-04-07', '', 'Active', 20),
(54, '2023-04-07', '', 'Active', 20);

-- --------------------------------------------------------

--
-- Table structure for table `product_load_list`
--

CREATE TABLE `product_load_list` (
  `pro_loadlt_id` int(15) NOT NULL,
  `pro_loadlt_itemcode` int(20) NOT NULL,
  `pro_loadlt_qty` int(11) NOT NULL,
  `pro_loadlt_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_load_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_load_list`
--

INSERT INTO `product_load_list` (`pro_loadlt_id`, `pro_loadlt_itemcode`, `pro_loadlt_qty`, `pro_loadlt_stt`, `fk_load_id`) VALUES
(1, 1, 20, 'Active', 3),
(2, 2, 40, 'Active', 4),
(3, 2, 20, 'Active', 27),
(4, 6, 45, 'Active', 28),
(5, 2, 40, 'Active', 29),
(6, 2, 20, 'Active', 30),
(7, 2, 55, 'Active', 31),
(8, 2, 50, 'Active', 32),
(9, 1, 5, 'Active', 33),
(10, 6, 80, 'Active', 36),
(11, 49, 60, 'Active', 50),
(12, 49, 60, 'Active', 50),
(13, 50, 20, 'Active', 52),
(14, 9, 25, 'Active', 53),
(15, 9, 10, 'Active', 54);

-- --------------------------------------------------------

--
-- Table structure for table `product_order_list`
--

CREATE TABLE `product_order_list` (
  `product_order_qty` int(11) NOT NULL,
  `fk_pro_id` int(11) NOT NULL,
  `fk_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_unload`
--

CREATE TABLE `product_unload` (
  `unload_id` int(20) NOT NULL,
  `unload_date` date NOT NULL,
  `unload_note` varchar(50) NOT NULL,
  `unload_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_veh_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_unload`
--

INSERT INTO `product_unload` (`unload_id`, `unload_date`, `unload_note`, `unload_stt`, `fk_veh_id`) VALUES
(1, '2023-02-22', 'Expired', 'Active', 18);

-- --------------------------------------------------------

--
-- Table structure for table `product_unload_list`
--

CREATE TABLE `product_unload_list` (
  `unloadlt_id` int(20) NOT NULL,
  `unloadlt_itemcode` varchar(20) NOT NULL,
  `unloadlt_qty` int(11) NOT NULL,
  `unloadlt_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_unload_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_unload_list`
--

INSERT INTO `product_unload_list` (`unloadlt_id`, `unloadlt_itemcode`, `unloadlt_qty`, `unloadlt_stt`, `fk_unload_id`) VALUES
(1, '2', 10, 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requested`
--

CREATE TABLE `requested` (
  `req_id` int(11) NOT NULL,
  `req_date` date NOT NULL,
  `req_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_rqlt_id` int(11) NOT NULL,
  `fk_cus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requested list`
--

CREATE TABLE `requested list` (
  `rqlt_id` int(11) NOT NULL,
  `reqlt_qty` varchar(20) NOT NULL,
  `reqlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `return_id` int(11) NOT NULL,
  `return_date` date NOT NULL,
  `return_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return list`
--

CREATE TABLE `return list` (
  `return_qty` varchar(15) NOT NULL,
  `returnlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_return_id` int(11) NOT NULL,
  `fk_pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `root`
--

CREATE TABLE `root` (
  `root_id` int(10) NOT NULL,
  `root_code` int(15) NOT NULL,
  `root_name` varchar(30) NOT NULL,
  `root_stt` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `root`
--

INSERT INTO `root` (`root_id`, `root_code`, `root_name`, `root_stt`) VALUES
(1, 0, 'rattota', 'delete'),
(2, 0, 'rattota', 'delete'),
(3, 0, 'rattota', 'delete'),
(4, 0, 'rattota', 'delete'),
(5, 0, 'rattota', 'delete'),
(6, 0, 'rattota', 'delete'),
(7, 0, 'Matale', 'Active'),
(8, 111, 'Rattota', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sales_refno` int(10) NOT NULL,
  `sales_note` varchar(50) NOT NULL,
  `sales_total_bill` double NOT NULL,
  `sales_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_cus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_date`, `sales_refno`, `sales_note`, `sales_total_bill`, `sales_stt`, `fk_cus_id`) VALUES
(1, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(2, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(3, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(4, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(5, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(6, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(7, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(8, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(9, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(10, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(11, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(12, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(13, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(14, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(15, '2022-12-30 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(16, '2022-12-29 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(17, '2022-12-29 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(18, '2022-12-29 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(19, '2023-01-02 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(20, '2022-12-31 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(22, '2023-01-01 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(23, '2023-01-01 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(24, '2023-01-01 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(25, '2022-12-31 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(26, '2023-01-03 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(27, '2023-01-03 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(28, '2023-01-04 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(29, '2023-01-06 18:30:00', 0, 'gygy', 0, 'Active', 3),
(30, '2023-01-03 18:30:00', 0, 'gygy', 0, 'Active', 3),
(31, '2023-01-03 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(32, '0000-00-00 00:00:00', 0, 'ee', 0, 'Active', 3),
(33, '2022-12-31 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(34, '2022-12-31 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(35, '2022-12-31 18:30:00', 0, 'early Sales', 0, 'Active', 5),
(36, '2023-01-01 18:30:00', 0, 'Sale', 0, 'Active', 5),
(37, '2023-01-15 18:30:00', 0, 'Sales', 0, 'Active', 1),
(38, '2023-01-15 18:30:00', 0, 'Sales', 0, 'Active', 1),
(39, '2023-01-16 18:30:00', 0, 'jj', 0, 'Active', 3),
(40, '2023-01-19 18:30:00', 0, 'ADD SALES', 0, 'Active', 5),
(41, '2023-01-19 18:30:00', 0, 'ADD SALES', 0, 'Active', 5),
(42, '2023-01-28 18:30:00', 0, 'Urgent', 0, 'Active', 5),
(43, '2023-01-21 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(44, '2023-01-21 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(45, '2023-01-21 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(46, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(47, '0000-00-00 00:00:00', 0, '', 0, 'Active', 3),
(50, '2023-01-14 18:30:00', 0, 'Urgent', 0, 'Active', 5),
(51, '2023-01-14 18:30:00', 0, 'early Sales', 0, 'Active', 1),
(52, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(53, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(54, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(55, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(56, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(57, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(58, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(59, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(60, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(61, '2023-02-04 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(62, '2023-02-06 18:30:00', 0, 'ADD SALES', 0, 'Active', 5),
(63, '2023-02-05 18:30:00', 1236, 'Urgent', 0, 'Active', 3),
(64, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(65, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(66, '2023-02-05 18:30:00', 0, 'early Sales', 0, 'Active', 5),
(67, '2023-01-31 18:30:00', 0, 'Early Sales', 0, 'Active', 3),
(68, '2023-01-31 18:30:00', 0, 'ADD SALES', 0, 'Active', 3),
(69, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(70, '2023-02-06 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(71, '2023-02-06 18:30:00', 0, 'early Sales', 0, 'Active', 3),
(72, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(73, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(74, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(75, '2023-02-10 18:30:00', 123, 'ADD SALES', 0, 'Active', 3),
(76, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(77, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(78, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(79, '2023-02-12 18:30:00', 25, 'Urgent', 0, 'Active', 6),
(80, '2023-02-12 18:30:00', 1236, 'early Sales', 0, 'Active', 3),
(81, '2023-02-13 18:30:00', 3, 'ADD SALES', 0, 'Active', 6),
(82, '2023-02-21 18:30:00', 20, 'Urgent', 0, 'Active', 6),
(83, '2023-02-22 18:30:00', 26, 'ADD SALES', 0, 'Active', 5),
(84, '2023-02-21 18:30:00', 20, 'Urgent', 0, 'Active', 6),
(85, '2023-02-21 18:30:00', 20, 'Urgent', 0, 'Active', 6),
(86, '2023-02-21 18:30:00', 20, 'Urgent', 0, 'Active', 6),
(87, '2023-02-21 18:30:00', 20, 'Urgent', 0, 'Active', 6),
(88, '2023-02-21 18:30:00', 20, 'Urgent', 0, 'Active', 6),
(89, '2023-02-22 18:30:00', 10, 'Urgent', 0, 'Active', 1),
(90, '2023-02-22 18:30:00', 123, 'early Sales', 0, 'Active', 1),
(91, '2023-02-22 18:30:00', 10, 'early Sales', 0, 'Active', 3),
(92, '2023-02-24 18:30:00', 5, 'Sale', 0, 'Active', 6),
(93, '2023-02-24 18:30:00', 5, 'Sale', 0, 'Active', 6),
(94, '2023-02-26 18:30:00', 44, 'GGT', 0, 'Active', 1),
(95, '2023-02-26 18:30:00', 44, 'GGT', 0, 'Active', 1),
(96, '2023-02-21 18:30:00', 123, 'ADD SALES', 0, 'Active', 3),
(97, '2023-02-21 18:30:00', 123, 'ADD SALES', 0, 'Active', 3),
(98, '2023-02-21 18:30:00', 123, 'ADD SALES', 0, 'Active', 3),
(99, '2023-02-14 18:30:00', 0, '', 0, 'Active', 1),
(100, '2023-02-25 18:30:00', 4, 'Urgent', 0, 'Active', 3),
(101, '2023-02-25 18:30:00', 4, 'Urgent', 0, 'Active', 3),
(102, '2023-02-26 18:30:00', 12, 'ADD SALES', 0, 'Active', 3),
(103, '2023-02-26 18:30:00', 48, 'early Sales', 0, 'Active', 6),
(104, '2023-02-26 18:30:00', 48, 'early Sales', 0, 'Active', 6),
(105, '2023-02-26 18:30:00', 48, 'early Sales', 0, 'Active', 6),
(106, '2023-02-26 18:30:00', 48, 'early Sales', 0, 'Active', 6),
(107, '2023-02-26 18:30:00', 48, 'early Sales', 0, 'Active', 6),
(108, '2023-02-27 18:30:00', 45, 'early Sales', 0, 'Active', 3),
(109, '2023-02-27 18:30:00', 1236, 'ADD SALES', 0, 'Active', 6),
(110, '2023-02-21 18:30:00', 20, 'early Sales', 0, 'Active', 3),
(111, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(112, '2023-02-21 18:30:00', 123, 'ADD SALES', 24500, 'Active', 1),
(113, '2023-02-27 18:30:00', 20, 'ADD SALES', 2850, 'Active', 5),
(114, '2023-02-27 18:30:00', 20, 'Urgent', 6860, 'Active', 5),
(115, '0000-00-00 00:00:00', 0, '', 4000, 'Active', 1),
(116, '0000-00-00 00:00:00', 0, '', 5000, 'Active', 1),
(117, '2023-02-20 18:30:00', 123, 'Urgent', 23750, 'Active', 3),
(118, '2023-02-20 18:30:00', 123, 'Urgent', 23750, 'Active', 3),
(119, '2023-02-27 18:30:00', 10, 'early Sales', 30200, 'Active', 3),
(120, '2023-02-27 18:30:00', 11, 'early Sales', 31360, 'Active', 5),
(121, '2023-02-20 18:30:00', 24, 'Urgent', 14550, 'Active', 3),
(122, '2023-02-21 18:30:00', 44, 'Urgent', 19400, 'Active', 3),
(123, '2023-02-27 18:30:00', 11, 'ADD SALES', 23750, 'Active', 3),
(124, '2023-02-27 18:30:00', 11, 'ADD SALES', 2880, 'Active', 5),
(125, '0000-00-00 00:00:00', 0, '', 5000, 'Active', 1),
(126, '2023-02-27 18:30:00', 128, 'early Sales', 28800, 'Active', 5),
(128, '2023-02-27 18:30:00', 11, 'early Sales', 40000, 'Active', 5),
(129, '2023-03-01 07:15:24', 54, 'Promotion', 17280, 'Active', 6),
(130, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(131, '0000-00-00 00:00:00', 0, '', 0, 'Active', 1),
(132, '2023-03-13 18:30:00', 0, '', 30886, 'Active', 5),
(133, '0000-00-00 00:00:00', 0, '', 1000, 'Active', 0),
(134, '0000-00-00 00:00:00', 0, '', 0, 'Active', 0),
(135, '2023-04-10 18:30:00', 0, '', 3000, 'Active', 3),
(136, '0000-00-00 00:00:00', 0, '', 570, 'Active', 0),
(137, '0000-00-00 00:00:00', 0, '', 570, 'Active', 0),
(138, '0000-00-00 00:00:00', 0, '', 1000, 'Active', 0),
(139, '2023-04-07 18:30:00', 0, '', 950, 'Active', 1),
(140, '2023-04-07 18:30:00', 0, '', 980, 'Active', 6),
(141, '2023-04-12 18:30:00', 0, '', 196, 'Active', 3),
(142, '2023-04-12 18:30:00', 0, '', 100, 'Active', 3),
(143, '0000-00-00 00:00:00', 0, '', 118, 'Active', 0),
(144, '2023-04-09 18:30:00', 0, '', 58, 'Active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales return`
--

CREATE TABLE `sales return` (
  `salesreturn_id` int(11) NOT NULL,
  `salesreturn_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales return list`
--

CREATE TABLE `sales return list` (
  `salesreturnlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_pro_id` int(11) NOT NULL,
  `fk_salesreturn_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_list`
--

CREATE TABLE `sales_list` (
  `saleslt_id` int(11) NOT NULL,
  `saleslt_item` varchar(20) NOT NULL,
  `saleslt_qty` varchar(20) NOT NULL,
  `saleslt_issue_price` int(10) NOT NULL,
  `saleslt_free` int(11) NOT NULL,
  `saleslt_discount` decimal(10,0) NOT NULL,
  `saleslt_total_bill` decimal(10,0) NOT NULL,
  `saleslt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_list`
--

INSERT INTO `sales_list` (`saleslt_id`, `saleslt_item`, `saleslt_qty`, `saleslt_issue_price`, `saleslt_free`, `saleslt_discount`, `saleslt_total_bill`, `saleslt_stt`, `fk_sales_id`) VALUES
(1, '2', '50', 50, 5, '0', '0', 'Active', 18),
(2, '2', '30', 50, 5, '0', '0', 'Active', 19),
(3, '2', '30', 50, 5, '5', '0', 'Active', 34),
(4, '2', '30', 40, 5, '5', '0', 'Active', 35),
(5, '6', '50', 120, 8, '3', '0', 'Active', 35),
(6, '2', '50', 70, 5, '5', '0', 'Active', 36),
(7, '', '', 0, 0, '0', '0', 'Active', 48),
(8, '2', '40', 0, 0, '0', '0', 'Active', 49),
(9, '2', '75', 70, 6, '5', '0', 'Active', 50),
(10, '18', '50', 60, 0, '0', '0', 'Active', 51),
(11, '6', '30', 100, 2, '4', '0', 'Active', 51),
(12, '2', '50', 120, 5, '5', '0', 'Active', 61),
(13, '1', '30', 100, 5, '5', '0', 'Active', 62),
(14, '2', '20', 120, 5, '5', '1900', 'Active', 68),
(15, '1', '10', 0, 0, '0', '1000', 'Active', 74),
(16, '2', '10', 120, 5, '5', '950', 'Active', 75),
(17, '1', '10', 0, 0, '0', '10000', 'Active', 76),
(18, '1', '10', 0, 0, '0', '10000', 'Active', 77),
(19, '1', '10', 0, 0, '0', '10000', 'Active', 78),
(20, '2', '80', 150, 5, '5', '9120', 'Active', 79),
(21, '1', '50', 70, 3, '4', '2400', 'Active', 81),
(22, '2', '50', 100, 5, '2', '3920', 'Active', 82),
(23, '2', '50', 100, 5, '2', '3920', 'Active', 84),
(24, '2', '50', 100, 5, '2', '3920', 'Active', 85),
(25, '2', '50', 100, 5, '2', '3920', 'Active', 86),
(26, '2', '50', 100, 5, '2', '3920', 'Active', 87),
(27, '2', '50', 100, 5, '2', '3920', 'Active', 88),
(28, '2', '10', 120, 5, '0', '1000', 'Active', 89),
(29, '', '', 0, 0, '0', '0', 'Active', 89),
(30, '', '', 0, 0, '0', '0', 'Active', 90),
(31, '', '', 0, 0, '0', '0', 'Active', 90),
(32, '1', '50', 110, 0, '3', '4365', 'Active', 91),
(33, '', '', 0, 0, '0', '0', 'Active', 91),
(34, '1', '20', 500, 2, '0', '9000', 'Active', 92),
(35, '1', '20', 500, 2, '0', '9000', 'Active', 93),
(36, '', '', 0, 0, '0', '0', 'Active', 93),
(37, '1', '50', 150, 5, '5', '4750', 'Active', 94),
(38, '', '', 0, 0, '0', '0', 'Active', 94),
(39, '2', '40', 60, 5, '5', '760', 'Active', 95),
(40, '', '', 0, 0, '0', '0', 'Active', 95),
(41, '1', '41', 150, 5, '8', '3772', 'Active', 96),
(42, '2', '50', 450, 5, '7', '18600', 'Active', 96),
(43, '1', '41', 150, 5, '8', '3772', 'Active', 97),
(44, '2', '50', 450, 5, '7', '18600', 'Active', 97),
(45, '1', '41', 150, 5, '8', '3772', 'Active', 98),
(46, '2', '50', 450, 5, '7', '18600', 'Active', 98),
(47, '2', '10', 120, 5, '5', '950', 'Active', 100),
(48, '6', '50', 150, 5, '0', '5000', 'Active', 100),
(49, '2', '10', 120, 5, '5', '950', 'Active', 101),
(50, '6', '50', 150, 5, '0', '5000', 'Active', 101),
(51, '2', '20', 100, 5, '5', '1900', 'Active', 102),
(52, '1', '40', 170, 3, '2', '6664', 'Active', 102),
(53, '6', '50', 280, 5, '5', '13300', 'Active', 103),
(54, '2', '10', 450, 6, '2', '4410', 'Active', 103),
(55, '6', '50', 280, 5, '5', '13300', 'Active', 105),
(56, '2', '10', 450, 6, '2', '4410', 'Active', 105),
(57, '6', '50', 280, 5, '5', '13300', 'Active', 106),
(58, '2', '10', 450, 6, '2', '4410', 'Active', 106),
(59, '6', '50', 280, 5, '5', '13300', 'Active', 107),
(60, '2', '10', 450, 6, '2', '4410', 'Active', 107),
(61, '2', '10', 1500, 5, '5', '14250', 'Active', 108),
(62, '6', '10', 500, 600, '5', '4750', 'Active', 109),
(63, '2', '10', 600, 5, '5', '5700', 'Active', 110),
(64, '1', '10', 60, 0, '0', '600', 'Active', 111),
(65, '2', '50', 500, 5, '2', '24500', 'Active', 112),
(66, '2', '50', 60, 5, '5', '2850', 'Active', 113),
(67, '6', '20', 350, 2, '2', '6860', 'Active', 114),
(68, '1', '40', 100, 0, '0', '4000', 'Active', 115),
(69, '1', '10', 500, 0, '0', '5000', 'Active', 116),
(70, '1', '50', 500, 5, '5', '23750', 'Active', 117),
(71, '1', '50', 500, 5, '5', '23750', 'Active', 118),
(72, '6', '50', 500, 5, '2', '24500', 'Active', 119),
(73, '6', '100', 60, 5, '5', '5700', 'Active', 119),
(74, '6', '40', 800, 6, '2', '31360', 'Active', 120),
(75, '2', '30', 500, 4, '3', '14550', 'Active', 121),
(76, '6', '40', 500, 4, '3', '19400', 'Active', 122),
(77, '2', '50', 60, 4, '4', '2880', 'Active', 124),
(78, '1', '10', 500, 4, '0', '5000', 'Active', 125),
(79, '2', '50', 600, 5, '4', '28800', 'Active', 126),
(80, '2', '30', 450, 5, '5', '12825', 'Active', 127),
(82, '2', '80', 500, 5, '0', '40000', 'Active', 128),
(83, '1', '60', 300, 2, '4', '17280', 'Active', 129),
(84, '1', '50', 120, 5, '5', '5700', 'Active', 132),
(85, '2', '40', 80, 2, '2', '3136', 'Active', 132),
(86, '6', '60', 250, 4, '3', '14550', 'Active', 132),
(87, '9', '50', 150, 0, '0', '7500', 'Active', 132),
(88, '1', '10', 100, 1, '2', '980', 'Active', 133),
(89, '1', '10', 100, 2, '0', '1000', 'Active', 133),
(90, '49', '50', 60, 5, '0', '3000', 'Active', 135),
(91, '49', '10', 60, 5, '5', '570', 'Active', 136),
(92, '49', '10', 60, 5, '5', '570', 'Active', 137),
(93, '49', '10', 100, 5, '0', '1000', 'Active', 138),
(94, '41', '10', 100, 5, '5', '950', 'Active', 139),
(95, '41', '10', 100, 5, '2', '980', 'Active', 140),
(96, '41', '2', 100, 5, '2', '196', 'Active', 141),
(97, '41', '1', 100, 5, '0', '100', 'Active', 142),
(98, '41', '2', 60, 5, '1', '118', 'Active', 143),
(99, '41', '1', 60, 4, '3', '58', 'Active', 144);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `sporder_id` int(10) NOT NULL,
  `sporder_date` date NOT NULL,
  `sporder_refno` varchar(20) NOT NULL,
  `sporder_note` varchar(50) NOT NULL,
  `sporder_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_store_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_order`
--

INSERT INTO `shop_order` (`sporder_id`, `sporder_date`, `sporder_refno`, `sporder_note`, `sporder_stt`, `fk_store_id`) VALUES
(1, '2022-12-20', '', '', 'Active', 0),
(2, '2022-12-25', '', '', 'Active', 0),
(3, '2022-12-25', '', '', 'Active', 0),
(4, '2022-12-25', '', 'Biscuits', 'Active', 0),
(5, '2022-12-25', '', 'Biscuits', 'Active', 0),
(6, '2022-12-25', '', 'Biscuits', 'Active', 0),
(7, '2022-12-07', '', 'Biscuits', 'Active', 1),
(8, '2022-12-15', '', 'Biscuits', 'Active', 1),
(9, '2022-12-15', '', 'Biscuits', 'Active', 1),
(10, '2022-12-15', '', 'Biscuits', 'Active', 1),
(11, '2022-12-21', '', '', 'Active', 1),
(12, '2022-12-21', '', '', 'Active', 1),
(13, '2022-12-07', '', 'Biscuits', 'Active', 1),
(14, '2022-12-07', '', 'Biscuits', 'Active', 1),
(15, '2022-12-22', '5434', 'Biscuits', 'Active', 1),
(16, '2022-12-22', '5434', 'Biscuits', 'Active', 1),
(17, '2022-12-22', '5434', 'Biscuits', 'Active', 1),
(18, '2022-12-23', '5434', 'Biscuits', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_list`
--

CREATE TABLE `shop_order_list` (
  `shop_orderlt_id` int(15) NOT NULL,
  `shop_orderlt_itemcode` int(15) NOT NULL,
  `shop_orderlt_qty` varchar(50) NOT NULL,
  `fk_shop_id` int(10) NOT NULL,
  `shop_orderlt_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_sporder_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_order_list`
--

INSERT INTO `shop_order_list` (`shop_orderlt_id`, `shop_orderlt_itemcode`, `shop_orderlt_qty`, `fk_shop_id`, `shop_orderlt_stt`, `fk_sporder_id`) VALUES
(1, 2, '40', 0, 'Active', 9),
(2, 2, '40', 0, 'Active', 9),
(3, 2, '40', 0, 'Active', 10),
(4, 6, '32', 0, 'Active', 11),
(5, 2, '30', 0, 'Active', 15),
(6, 2, '40', 0, 'Active', 16),
(7, 2, '40', 17, 'Active', 17),
(8, 6, '20', 18, 'Active', 18);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(45) NOT NULL,
  `st_gender` varchar(10) NOT NULL,
  `st_dob` date NOT NULL,
  `st_nic` varchar(20) NOT NULL,
  `st_address` varchar(45) NOT NULL,
  `st_phone` varchar(45) NOT NULL,
  `st_email` varchar(45) NOT NULL,
  `st_user_name` varchar(10) NOT NULL,
  `st_user_psswd` varchar(10) NOT NULL,
  `st_stt` varchar(8) NOT NULL,
  `st_user_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_role_id` int(11) NOT NULL,
  `fk_veh_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`st_id`, `st_name`, `st_gender`, `st_dob`, `st_nic`, `st_address`, `st_phone`, `st_email`, `st_user_name`, `st_user_psswd`, `st_stt`, `st_user_stt`, `fk_role_id`, `fk_veh_id`) VALUES
(46, 'S.Kumar', 'Male', '2023-01-02', '111214422', 'roroeoeo', '78855', 'annkumar@gmail.com', 'raj', '123', 'Active', 'Active', 1, 0),
(49, 'Kanishka Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754125', 'dk123@gmail.com', 'damindu', 'dami@123', 'Active', 'Active', 1, 0),
(50, 'Damindu Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754125', 'dk123@gmail.com', 'damindu', 'dami@123', 'delete', 'Active', 2, 0),
(51, 'Damindu Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754125', 'dk123@gmail.com', 'kanishka', 'dami@123', 'delete', 'Active', 2, 0),
(52, 'Damindu Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754126', 'dk123@gmail.com', 'kanishka', 'dami@123', 'delete', 'Active', 2, 0),
(53, 'S.Kumar', 'Male', '0000-00-00', '478596712V', '', '0775874350', 'bbbb@gmail.com', 'damindu', '789', 'delete', 'Active', 2, 0),
(54, 'S.Kumar', 'Male', '0000-00-00', '789654123V', '', '047', '444', 'yyy', '14', 'delete', 'Active', 3, 0),
(55, 'Nimal karunarathna', 'Male', '0000-00-00', '478596774V', '', '0714784512', 'nimalgmail.com', 'nimal', 'sale123', 'Active', 'Active', 5, 17),
(56, 'Nimal karunarathna', 'Male', '0000-00-00', '478596774V', '', '0714784512', 'nimalgmail.com', 'nimal', 'sale123', 'Active', 'Active', 5, 18),
(57, 'S.viraj', 'Male', '0000-00-00', '789452145V', '', '0747895412', 'wes@gmail.com', 'viraj', '123vi', 'Active', 'Active', 5, 0),
(58, 'M.Viraj', 'Male', '0000-00-00', '987485412V', '', '0745784514', 'viraj@gmail.com', 'viraj', 'viraj123', 'Active', 'Active', 5, 19),
(59, 'Nimal.gunawardhana', 'Male', '0000-00-00', '987485412V', '', '0718593478', 'nim2@gmail.com', 'nimal', '123nimal', 'Active', 'Active', 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `staff_role`
--

CREATE TABLE `staff_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) NOT NULL,
  `role_stt` varchar(15) NOT NULL DEFAULT 'Active',
  `role_descrip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_role`
--

INSERT INTO `staff_role` (`role_id`, `role_name`, `role_stt`, `role_descrip`) VALUES
(1, 'Admin', 'Active', 'Manage system'),
(2, 'Cash collector', 'Active', 'manage cash'),
(3, 'stock keeper', 'Active', 'manage stock'),
(4, 'Cash collector', 'deactivate', 'Manage system'),
(5, 'Sales representative', 'Active', 'Deliver orders');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(20) NOT NULL,
  `stock_in` int(10) NOT NULL DEFAULT '0',
  `stock_out` int(10) NOT NULL DEFAULT '0',
  `sdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `fk_veh_id` int(11) NOT NULL,
  `store` int(20) NOT NULL DEFAULT '1',
  `fk_grn_id` int(20) NOT NULL,
  `fk_grnls_itmcode` int(20) NOT NULL,
  `stock_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_in`, `stock_out`, `sdate`, `fk_veh_id`, `store`, `fk_grn_id`, `fk_grnls_itmcode`, `stock_stt`) VALUES
(14, 0, 10, '2022-12-14 14:27:24.511615', 0, 1, 25, 2, 'Active'),
(15, 0, 100, '2022-12-14 14:29:58.161805', 0, 1, 26, 2, 'Active'),
(16, 0, 20, '2022-12-14 14:31:47.416350', 0, 1, 27, 2, 'Active'),
(17, 45, 0, '2022-12-14 14:34:06.003821', 0, 1, 28, 6, 'Active'),
(18, 40, 0, '2022-12-14 14:34:57.675059', 0, 1, 29, 2, 'Active'),
(19, 0, 40, '2022-12-14 14:34:57.743761', 0, 1, 29, 2, 'Active'),
(20, 20, 0, '2022-12-15 09:54:08.997531', 18, 18, 30, 2, 'Active'),
(21, 0, 20, '2022-12-14 14:41:28.072839', 18, 1, 30, 2, 'Active'),
(22, 55, 0, '2022-12-15 09:54:30.822294', 18, 18, 31, 2, 'Active'),
(23, 0, 55, '2022-12-15 05:45:48.744709', 18, 1, 31, 2, 'Active'),
(24, 20, 0, '2022-12-18 10:21:35.293285', 0, 1, 14, 2, 'Active'),
(25, 0, 6, '2022-12-20 04:09:58.079575', 0, 1, 0, 2, 'Active'),
(26, 0, 6, '2022-12-20 04:11:00.495241', 0, 1, 0, 2, 'Active'),
(27, 50, 0, '2022-12-20 04:33:22.883873', 17, 1, 32, 2, 'Active'),
(28, 0, 50, '2022-12-20 04:33:22.931754', 17, 1, 32, 2, 'Active'),
(29, 5, 0, '2022-12-20 04:38:18.182506', 18, 1, 33, 1, 'Active'),
(30, 0, 5, '2022-12-20 04:38:18.300723', 18, 1, 33, 1, 'Active'),
(31, 0, 5, '2022-12-20 05:18:51.713476', 0, 1, 0, 2, 'Active'),
(32, 0, 5, '2022-12-20 05:58:03.739158', 0, 1, 2, 2, 'Active'),
(33, 0, 5, '2022-12-20 05:59:43.576665', 0, 1, 3, 2, 'Active'),
(34, 100, 0, '2022-12-29 05:04:48.260021', 0, 1, 15, 2, 'Active'),
(35, 55, 0, '2023-01-02 13:48:41.922033', 0, 1, 16, 2, 'Active'),
(36, 10, 0, '2023-01-10 07:29:37.249523', 17, 1, 34, 1, 'Active'),
(37, 0, 10, '2023-01-10 07:29:37.345373', 17, 1, 34, 1, 'Active'),
(38, 70, 0, '2023-01-10 07:58:16.742506', 19, 1, 35, 2, 'Active'),
(39, 0, 70, '2023-01-10 07:58:16.850133', 19, 1, 35, 2, 'Active'),
(40, 80, 0, '2023-01-10 08:05:17.584211', 18, 1, 36, 6, 'Active'),
(41, 0, 80, '2023-01-10 08:05:17.653352', 18, 1, 36, 6, 'Active'),
(42, 30, 0, '2023-01-10 10:20:14.779712', 0, 1, 17, 2, 'Active'),
(43, 0, 45, '2023-01-12 04:11:50.709605', 0, 1, 4, 2, 'Active'),
(44, 10, 0, '2023-02-22 12:58:05.081909', 18, 1, 1, 2, 'Active'),
(45, 0, 10, '2023-02-22 12:58:05.195456', 18, 1, 1, 2, 'Active'),
(46, 10, 0, '2023-03-05 20:29:17.224032', 0, 1, 18, 1, 'Active'),
(47, 10, 0, '2023-03-05 20:34:06.621458', 0, 1, 19, 2, 'Active'),
(48, 50, 0, '2023-03-05 20:34:06.713667', 0, 1, 20, 6, 'Active'),
(49, 10, 0, '2023-03-05 21:17:32.974714', 0, 1, 21, 1, 'Active'),
(50, 50, 0, '2023-03-05 21:17:33.239629', 0, 1, 22, 2, 'Active'),
(51, 50, 0, '2023-03-07 14:46:57.521406', 0, 1, 23, 2, 'Active'),
(52, 100, 0, '2023-03-07 17:06:36.986645', 0, 1, 61, 1, 'Active'),
(53, 100, 0, '2023-03-07 17:28:59.280273', 0, 1, 62, 1, 'Active'),
(54, 80, 0, '2023-03-07 17:31:39.017673', 0, 1, 24, 6, 'Active'),
(55, 60, 0, '2023-03-08 04:15:35.880538', 0, 1, 25, 1, 'Active'),
(56, 14, 0, '2023-03-08 04:21:19.435004', 0, 1, 26, 2, 'Active'),
(57, 54, 0, '2023-03-08 04:23:33.953756', 0, 1, 27, 1, 'Active'),
(58, 54, 0, '2023-03-08 04:25:11.527211', 0, 1, 28, 1, 'Active'),
(59, 50, 0, '2023-03-08 04:25:43.462360', 0, 1, 68, 1, 'Active'),
(60, 50, 0, '2023-03-08 04:26:36.483553', 0, 1, 69, 1, 'Active'),
(61, 50, 0, '2023-03-08 04:29:30.369431', 0, 1, 70, 1, 'Active'),
(62, 100, 0, '2023-03-08 04:30:18.002874', 0, 1, 29, 1, 'Active'),
(63, 100, 0, '2023-03-08 04:38:57.597543', 0, 1, 72, 2, 'Active'),
(64, 150, 0, '2023-03-08 04:53:15.750923', 0, 1, 30, 1, 'Active'),
(65, 60, 0, '2023-03-08 06:07:10.742355', 18, 1, 37, 6, 'Active'),
(66, 0, 60, '2023-03-08 06:07:10.826333', 18, 1, 37, 6, 'Active'),
(67, 0, 80, '2023-03-08 06:10:12.172360', 0, 1, 5, 6, 'Active'),
(68, 0, 7, '2023-03-08 06:16:49.374360', 0, 1, 6, 2, 'Active'),
(69, 0, 2, '2023-03-08 07:41:49.198434', 0, 1, 7, 9, 'Active'),
(70, 50, 0, '2023-03-08 07:45:36.151726', 17, 1, 38, 9, 'Active'),
(71, 0, 50, '2023-03-08 07:45:36.275911', 17, 1, 38, 9, 'Active'),
(72, 60, 0, '2023-03-08 07:45:36.311768', 17, 1, 38, 6, 'Active'),
(73, 0, 60, '2023-03-08 07:45:36.359799', 17, 1, 38, 6, 'Active'),
(74, 1222, 0, '2023-03-08 08:04:01.520642', 17, 1, 39, 1, 'Active'),
(75, 0, 1222, '2023-03-08 08:04:01.604409', 17, 1, 39, 1, 'Active'),
(76, 400, 0, '2023-03-08 08:04:42.108158', 17, 1, 40, 2, 'Active'),
(77, 0, 400, '2023-03-08 08:04:42.191380', 17, 1, 40, 2, 'Active'),
(78, 0, 12, '2023-03-19 12:01:51.656976', 0, 1, 12, 2, 'Active'),
(79, 0, 50, '2023-03-19 12:01:51.784616', 0, 1, 12, 1, 'Active'),
(80, 20, 0, '2023-03-23 08:03:57.196625', 0, 1, 31, 2, 'Active'),
(81, 20, 0, '2023-03-23 08:40:47.877440', 0, 1, 32, 2, 'Active'),
(82, 20, 0, '2023-03-23 09:28:13.678146', 0, 1, 33, 2, 'Active'),
(83, 100, 0, '2023-04-04 10:31:01.062005', 0, 1, 34, 6, 'Active'),
(84, 10, 0, '2023-04-04 11:27:47.943594', 0, 1, 35, 49, 'Active'),
(85, 2, 0, '2023-04-04 11:34:42.590646', 20, 1, 43, 49, 'Active'),
(86, 0, 2, '2023-04-04 11:47:12.669169', 0, 1, 43, 49, 'Active'),
(87, 40, 0, '2023-04-06 22:18:16.506342', 0, 1, 36, 50, 'Active'),
(88, 25, 0, '2023-04-06 22:23:43.405765', 18, 1, 44, 50, 'Active'),
(89, 0, 25, '2023-04-06 22:23:43.493215', 18, 1, 44, 50, 'Active'),
(90, 30, 0, '2023-04-07 04:08:20.486883', 20, 1, 45, 9, 'Active'),
(91, 0, 30, '2023-04-07 04:08:20.518888', 20, 1, 45, 9, 'Active'),
(92, 20, 0, '2023-04-07 04:27:01.207410', 19, 1, 52, 50, 'Active'),
(93, 0, 20, '2023-04-07 04:27:01.303710', 19, 1, 52, 50, 'Active'),
(94, 70, 0, '2023-04-07 04:33:48.372757', 0, 1, 37, 9, 'Active'),
(95, 25, 0, '2023-04-07 04:36:06.164609', 20, 1, 53, 9, 'Active'),
(96, 0, 25, '2023-04-07 04:36:06.204434', 20, 1, 53, 9, 'Active'),
(97, 10, 0, '2023-04-07 04:43:18.086837', 20, 1, 54, 9, 'Active'),
(98, 0, 10, '2023-04-07 04:43:18.153108', 0, 1, 54, 9, 'Active'),
(99, 10, 0, '2023-04-07 07:21:20.970291', 0, 1, 38, 49, 'Active'),
(100, 100, 0, '2023-04-07 09:14:56.518305', 20, 1, 39, 41, 'Active'),
(101, 100, 0, '2023-04-07 09:19:23.649034', 20, 1, 40, 41, 'Active'),
(102, 0, 20, '2023-04-07 10:23:10.097263', 20, 1, 41, 49, 'Active'),
(103, 0, 2, '2023-04-07 11:11:37.384518', 20, 1, 0, 41, 'Active'),
(104, 0, 1, '2023-04-07 11:12:55.238704', 20, 1, 0, 41, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(15) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `store_address` varchar(60) NOT NULL,
  `store_phone` int(10) NOT NULL,
  `store_email` varchar(20) NOT NULL,
  `fk_root_id` int(10) NOT NULL,
  `store_stt` varchar(20) NOT NULL DEFAULT 'Active',
  `fk_cus_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_address`, `store_phone`, `store_email`, `fk_root_id`, `store_stt`, `fk_cus_id`) VALUES
(1, '0', 'hhh', 714478451, 'eda@gmail.com', 6, 'delete', 0),
(2, 'Jayanthi Super', '', 714478451, 'eda@gmail.com', 8, 'Active', 0),
(3, 'Jayanthi Super', '', 714478451, 'eda@gmail.com', 8, 'Active', 0),
(4, 'Jayanthi Super', '', 714478451, 'eda@gmail.com', 8, 'Active', 0),
(5, 'Jayanthi Super', '', 714478451, 'aaa@gmail.com', 7, 'Active', 0),
(6, 'Jayanthi Super', '', 714478451, 'aaa@gmail.com', 7, 'Active', 0),
(7, 'Jayanthi Super', '', 714478451, 'aaa@gmail.com', 7, 'Active', 0),
(8, 'Jayanthi Super', '', 714478451, 'aaa@gmail.com', 7, 'Active', 0),
(9, 'kamal store', '', 714478452, 'aaaa@gmail.com', 8, 'Active', 0),
(10, 'kamal store', '', 714478452, 'aaaa@gmail.com', 8, 'Active', 0),
(11, 'kamal store', '   aaaaaa                                         ', 714478451, 'aaa@gmail.com', 8, 'Active', 0),
(12, 'Jayanthi Super', 'eeeeee                                            ', 714478451, 'rda@gmail.com', 8, 'delete', 0),
(13, 'Jayanthi Super', 'eeeeee                                            ', 714478451, 'rda@gmail.com', 8, 'delete', 0),
(14, 'Jayanthi Super', '                                            ', 714478451, 'eda@gmail.com', 8, 'delete', 0),
(15, 'Jayanthi Super', '                                            ', 714478451, 'eewad@gmail.com', 7, 'Active', 0),
(16, 'Jayanthi Super', '                                            ', 714478451, 'eewad@gmail.com', 7, 'Active', 0),
(17, 'Jayanthi Super', '   qqqqq                                         ', 714478451, 'rda@gmail.com', 8, 'Active', 0),
(18, 'Jayanthi Super', ' adddd                                          ', 714478451, 'aaaa@gmail.com', 8, 'Active', 0),
(19, 'Jayanthi Super', '      asddff                                      ', 714478754, 'aaaa@gmail.com', 8, 'Active', 1),
(20, 'kamal store', ' aaaaa                                           ', 714478451, 'rda@gmail.com', 8, 'Active', 1),
(21, 'kamal store', ' aaaaa                                           ', 714478451, 'rda@gmail.com', 8, 'Active', 1),
(22, 'kamal store', ' aaaaa                                           ', 714478451, 'rda@gmail.com', 8, 'Active', 1),
(23, 'kamal store', ' aaaaa                                           ', 714478451, 'rda@gmail.com', 8, 'Active', 1),
(24, 'kamal store', '      aaaa                                      ', 714478451, 'aaa@gmail.com', 8, 'delete', 3),
(25, 'Bandara store', '     22/A,Pallepola Rode.Matale                             ', 714410172, 'bandarast@gmIail.con', 8, 'Active', 6);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment`
--

CREATE TABLE `supplier_payment` (
  `sup_pay_id` int(11) NOT NULL,
  `sup_cash` decimal(12,0) NOT NULL,
  `sup_cheque_amount` decimal(12,0) NOT NULL,
  `sup_cheque_no` varchar(10) NOT NULL,
  `sup_cheque_date` date NOT NULL,
  `sup_cheque_bank` varchar(20) NOT NULL,
  `sup_credit` decimal(20,0) NOT NULL,
  `sup_paid_amount` decimal(20,0) NOT NULL,
  `sup_pay_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_grn_id` varchar(8) NOT NULL,
  `fk_mac_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_payment`
--

INSERT INTO `supplier_payment` (`sup_pay_id`, `sup_cash`, `sup_cheque_amount`, `sup_cheque_no`, `sup_cheque_date`, `sup_cheque_bank`, `sup_credit`, `sup_paid_amount`, `sup_pay_stt`, `fk_grn_id`, `fk_mac_id`) VALUES
(1, '0', '0', '', '0000-00-00', '', '0', '0', 'Active', '', 0),
(2, '0', '0', '', '0000-00-00', '', '0', '0', 'Active', '', 0),
(3, '0', '0', '', '0000-00-00', '', '0', '0', 'Active', '', 0),
(4, '0', '0', '', '0000-00-00', '', '0', '0', 'Active', '', 0),
(5, '0', '0', '', '0000-00-00', '', '0', '0', 'Active', '', 0),
(6, '1000', '1000', '4', '2023-03-14', 'BOC', '4000', '2000', 'Active', '', 0),
(8, '1000', '50', '', '0000-00-00', '', '8950', '1050', 'Active', '', 0),
(9, '1000', '50', '', '0000-00-00', '', '8950', '1050', 'Active', '1', 0),
(10, '1000', '1000', '9', '2023-03-15', 'HSBC', '30000', '2000', 'Active', '63', 0),
(11, '1000', '1000', '87', '2023-03-29', 'BOC', '16000', '2000', 'Active', '1', 0),
(12, '1000', '500', '98', '2023-04-04', 'boc', '5500', '1500', 'Active', '1', 0),
(13, '5000', '45', '8', '2023-04-05', 'oiu', '355', '5045', 'Active', '', 0),
(14, '5000', '45', '8', '2023-04-05', 'oiu', '355', '5045', 'Active', '', 0),
(15, '5000', '45', '8', '2023-04-05', 'oiu', '355', '5045', 'Active', '', 0),
(16, '100', '1000', '5', '0000-00-00', 'CD', '23900', '1100', 'Active', '', 0),
(17, '100', '1000', '5', '0000-00-00', 'CD', '23900', '1100', 'Active', '1', 0),
(18, '100', '1000', '5', '0000-00-00', 'CD', '23900', '1100', 'Active', '1', 0),
(19, '1000', '5000', '8', '0000-00-00', 'nsb', '94000', '6000', 'Active', '1', 0),
(20, '500', '5005', '', '0000-00-00', 'NSB', '44495', '5505', 'Active', '1', 0),
(21, '5000', '1000', '98', '2023-03-15', 'NSB', '69000', '6000', 'Active', '73', 0),
(22, '15000', '15000', '8', '2023-03-21', 'BOC', '0', '30000', 'Active', '63', 0),
(23, '69000', '0', '7', '0000-00-00', 'BOC', '0', '69000', 'Active', '73', 0),
(24, '0', '0', '', '0000-00-00', '', '0', '0', 'Active', '74', 0),
(25, '100', '0', '47', '2023-03-30', 'ndb', '300', '100', 'Active', '76', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unload`
--

CREATE TABLE `unload` (
  `unload_id` int(11) NOT NULL,
  `fk_veh_id` int(11) NOT NULL,
  `unload_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unload list`
--

CREATE TABLE `unload list` (
  `unloadlt_qty` varchar(20) NOT NULL,
  `unloadlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_pro_id` int(11) NOT NULL,
  `fk_unload_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_psswd` varchar(32) NOT NULL,
  `user_stt` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_psswd`, `user_stt`) VALUES
(3, 'user', '1234', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `veh_id` int(11) NOT NULL,
  `veh_model` varchar(20) NOT NULL,
  `veh_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `veh_number` varchar(15) NOT NULL,
  `veh_capacity` int(11) NOT NULL,
  `veh_fuel` decimal(10,0) NOT NULL,
  `veh_brand` varchar(20) NOT NULL,
  `fk_vehtype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`veh_id`, `veh_model`, `veh_stt`, `veh_number`, `veh_capacity`, `veh_fuel`, `veh_brand`, `fk_vehtype_id`) VALUES
(17, 'ABC123', 'Active', 'CP-AA-9387', 60000, '6', 'Mazda', 1),
(18, 'Mxq123', 'Active', 'CP-QA-2213', 40000, '5', 'Toyota', 2),
(19, 'Mxq1287', 'Active', 'CP-QA-2210', 80000, '4', 'Nissan', 2),
(20, 'Mxq123', 'Active', 'WP-AAA-5774', 80000, '5', 'Nissan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehtype`
--

CREATE TABLE `vehtype` (
  `vehtype_id` int(20) NOT NULL,
  `vehtype_name` varchar(40) NOT NULL,
  `vehtype_stt` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehtype`
--

INSERT INTO `vehtype` (`vehtype_id`, `vehtype_name`, `vehtype_stt`) VALUES
(1, 'Lorry', 'Active'),
(2, 'Van', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`fk_st_id`,`fk_veh_id`),
  ADD KEY `fk_Assign_Vehicle1_idx` (`fk_veh_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `damage`
--
ALTER TABLE `damage`
  ADD PRIMARY KEY (`damage_id`);

--
-- Indexes for table `damage_list`
--
ALTER TABLE `damage_list`
  ADD PRIMARY KEY (`damagelt_id`);

--
-- Indexes for table `grn`
--
ALTER TABLE `grn`
  ADD PRIMARY KEY (`grn_id`,`fk_mac_id`),
  ADD KEY `fk_GRN_Manufacture_idx` (`fk_mac_id`);

--
-- Indexes for table `grn_list`
--
ALTER TABLE `grn_list`
  ADD PRIMARY KEY (`grnls_id`,`fk_grn_id`,`fk_pro_id`),
  ADD KEY `fk_GRN list_GRN1_idx` (`fk_grn_id`),
  ADD KEY `fk_GRN_list_Product1_idx` (`fk_pro_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`,`fk_sales_id`),
  ADD KEY `fk_Invoice_Sales1_idx` (`fk_sales_id`);

--
-- Indexes for table `load`
--
ALTER TABLE `load`
  ADD PRIMARY KEY (`load_id`,`fk_veh_id`),
  ADD KEY `fk_Load_Vehicle1_idx` (`fk_veh_id`);

--
-- Indexes for table `load list`
--
ALTER TABLE `load list`
  ADD PRIMARY KEY (`loadlt_id`),
  ADD KEY `fk_Load list_Load1_idx` (`fk_load_id`),
  ADD KEY `fk_Load list_Product1_idx` (`fk_pro_id`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`mac_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`orderlt_id`),
  ADD KEY `fk_Order list_Manufacture1_idx` (`fk_mac_id`),
  ADD KEY `fk_Order list_Order1_idx` (`fk_order_id`);

--
-- Indexes for table `ordr`
--
ALTER TABLE `ordr`
  ADD PRIMARY KEY (`order_id`,`fk_mac_id`,`Staff_st_id`),
  ADD KEY `fk_Order_Staff1_idx` (`Staff_st_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`,`fk_method_id`),
  ADD KEY `fk_Payment_payment_method1_idx` (`fk_method_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`,`fk_procat_id`),
  ADD KEY `fk_Product_Product Category1_idx` (`fk_procat_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`procat_id`);

--
-- Indexes for table `product_load`
--
ALTER TABLE `product_load`
  ADD PRIMARY KEY (`load_id`);

--
-- Indexes for table `product_load_list`
--
ALTER TABLE `product_load_list`
  ADD PRIMARY KEY (`pro_loadlt_id`);

--
-- Indexes for table `product_order_list`
--
ALTER TABLE `product_order_list`
  ADD PRIMARY KEY (`fk_order_id`,`fk_pro_id`),
  ADD KEY `fk_product_order_list_Order1_idx` (`fk_order_id`);

--
-- Indexes for table `product_unload`
--
ALTER TABLE `product_unload`
  ADD PRIMARY KEY (`unload_id`);

--
-- Indexes for table `product_unload_list`
--
ALTER TABLE `product_unload_list`
  ADD PRIMARY KEY (`unloadlt_id`);

--
-- Indexes for table `requested`
--
ALTER TABLE `requested`
  ADD PRIMARY KEY (`req_id`,`fk_rqlt_id`,`fk_cus_id`),
  ADD KEY `fk_Requested_Requested list1_idx` (`fk_rqlt_id`),
  ADD KEY `fk_Requested_Customer1_idx` (`fk_cus_id`);

--
-- Indexes for table `requested list`
--
ALTER TABLE `requested list`
  ADD PRIMARY KEY (`rqlt_id`,`fk_pro_id`),
  ADD KEY `fk_Requested list_Product1_idx` (`fk_pro_id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `return list`
--
ALTER TABLE `return list`
  ADD PRIMARY KEY (`fk_return_id`,`fk_pro_id`),
  ADD KEY `fk_Return list_Return1_idx` (`fk_return_id`),
  ADD KEY `fk_Return list_Product1_idx` (`fk_pro_id`);

--
-- Indexes for table `root`
--
ALTER TABLE `root`
  ADD PRIMARY KEY (`root_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`,`fk_cus_id`),
  ADD KEY `fk_Sales_Customer1_idx` (`fk_cus_id`);

--
-- Indexes for table `sales return`
--
ALTER TABLE `sales return`
  ADD PRIMARY KEY (`salesreturn_id`,`fk_sales_id`),
  ADD KEY `fk_Sales return_Sales1_idx` (`fk_sales_id`);

--
-- Indexes for table `sales return list`
--
ALTER TABLE `sales return list`
  ADD PRIMARY KEY (`fk_pro_id`,`fk_salesreturn_id`),
  ADD KEY `fk_Sales return list_Product1_idx` (`fk_pro_id`),
  ADD KEY `fk_Sales return list_Sales return1_idx` (`fk_salesreturn_id`);

--
-- Indexes for table `sales_list`
--
ALTER TABLE `sales_list`
  ADD PRIMARY KEY (`saleslt_id`,`saleslt_item`,`fk_sales_id`),
  ADD KEY `fk_Sales list_Product1_idx` (`saleslt_item`),
  ADD KEY `fk_Sales list_Sales1_idx` (`fk_sales_id`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`sporder_id`);

--
-- Indexes for table `shop_order_list`
--
ALTER TABLE `shop_order_list`
  ADD PRIMARY KEY (`shop_orderlt_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`st_id`,`fk_role_id`),
  ADD KEY `fk_Staff_staff_role1_idx` (`fk_role_id`);

--
-- Indexes for table `staff_role`
--
ALTER TABLE `staff_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  ADD PRIMARY KEY (`sup_pay_id`);

--
-- Indexes for table `unload`
--
ALTER TABLE `unload`
  ADD PRIMARY KEY (`unload_id`,`fk_veh_id`),
  ADD KEY `fk_Unload_Vehicle1_idx` (`fk_veh_id`);

--
-- Indexes for table `unload list`
--
ALTER TABLE `unload list`
  ADD PRIMARY KEY (`fk_pro_id`,`fk_unload_id`),
  ADD KEY `fk_Unload list_Unload1_idx` (`fk_unload_id`),
  ADD KEY `fk_Unload list_Product1_idx` (`fk_pro_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`veh_id`);

--
-- Indexes for table `vehtype`
--
ALTER TABLE `vehtype`
  ADD PRIMARY KEY (`vehtype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `damage`
--
ALTER TABLE `damage`
  MODIFY `damage_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `damage_list`
--
ALTER TABLE `damage_list`
  MODIFY `damagelt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grn`
--
ALTER TABLE `grn`
  MODIFY `grn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `grn_list`
--
ALTER TABLE `grn_list`
  MODIFY `grnls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `load`
--
ALTER TABLE `load`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `load list`
--
ALTER TABLE `load list`
  MODIFY `loadlt_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `mac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `orderlt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ordr`
--
ALTER TABLE `ordr`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `procat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_load`
--
ALTER TABLE `product_load`
  MODIFY `load_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `product_load_list`
--
ALTER TABLE `product_load_list`
  MODIFY `pro_loadlt_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_unload`
--
ALTER TABLE `product_unload`
  MODIFY `unload_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_unload_list`
--
ALTER TABLE `product_unload_list`
  MODIFY `unloadlt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requested`
--
ALTER TABLE `requested`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requested list`
--
ALTER TABLE `requested list`
  MODIFY `rqlt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `root`
--
ALTER TABLE `root`
  MODIFY `root_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `sales return`
--
ALTER TABLE `sales return`
  MODIFY `salesreturn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `saleslt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `sporder_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shop_order_list`
--
ALTER TABLE `shop_order_list`
  MODIFY `shop_orderlt_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `staff_role`
--
ALTER TABLE `staff_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  MODIFY `sup_pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `unload`
--
ALTER TABLE `unload`
  MODIFY `unload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `veh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vehtype`
--
ALTER TABLE `vehtype`
  MODIFY `vehtype_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
