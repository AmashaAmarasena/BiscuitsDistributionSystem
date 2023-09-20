-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 02:52 AM
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
  `cus_address` varchar(60) NOT NULL,
  `cus_regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cus_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_phone`, `cus_email`, `cus_address`, `cus_regdate`, `cus_stt`) VALUES
(1, 'A.Amarasena', '0718806458', 'amaamarasena@gmail', '2.A,Rose street.Matale', '2023-01-10 18:30:00', 'Active'),
(2, 'S.Bandara', '0718', 'bandara@gmail.com', 'Rattota rode.Weragam', '2023-05-21 10:02:52', 'Active'),
(3, 'D.Bandara', '0775487523', 'dkanishka@gmail.com', 'No 11.Matale road.Kandy', '2023-01-23 18:30:00', 'Active'),
(4, 'I.Gunawardhana', '0754410157', 'ikrguna@gmail.com', 'No 27.Pilimathalawa road.Kandy', '2023-01-21 18:30:00', 'Active'),
(5, 'Kamal Wijerathna', '0765498514', 'kamalwije@gmail.com', 'Pallepola road.Matale', '2023-01-22 18:30:00', 'Active'),
(6, 'Amali Gunawardhana', '0752135214', 'amalipere@gmail.com', 'No.3/2.Rattota road.Weragama', '2023-04-30 07:54:11', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `cus_invoice`
--

CREATE TABLE `cus_invoice` (
  `cus_invoice_id` int(20) NOT NULL,
  `cus_invoice_date` date NOT NULL,
  `cus_invoice_refno` varchar(30) NOT NULL,
  `cus_invoice_note` varchar(50) NOT NULL,
  `cus_invoice_total_amount` int(30) NOT NULL,
  `cus_invoice_stt` varchar(20) NOT NULL DEFAULT 'Active',
  `cus_invoice_type` varchar(20) NOT NULL,
  `fk_cus_returns_id` varchar(30) NOT NULL,
  `fk_sales_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cus_invoice`
--

INSERT INTO `cus_invoice` (`cus_invoice_id`, `cus_invoice_date`, `cus_invoice_refno`, `cus_invoice_note`, `cus_invoice_total_amount`, `cus_invoice_stt`, `cus_invoice_type`, `fk_cus_returns_id`, `fk_sales_id`) VALUES
(1, '2023-07-07', '', '', 1152, 'Active', 'Sale', '', ''),
(2, '2023-07-07', '', 'fytfjghfjgh', 660, 'Active', 'Return', '', '1'),
(3, '2023-07-07', '', 'fytfjghfjgh', 660, 'Active', 'Return', '', '1'),
(4, '2023-07-07', '', 'fytfjghfjgh', 660, 'Active', 'Return', '', '1'),
(5, '2023-07-07', '', 'fytfjghfjgh', 660, 'Active', 'Return', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cus_retrurns_payment`
--

CREATE TABLE `cus_retrurns_payment` (
  `creturns_pay_id` int(30) NOT NULL,
  `creturns_pay_cash` int(20) NOT NULL,
  `creturns_pay_cheque_amnt` int(20) NOT NULL,
  `creturns_pay_cheque_no` int(20) NOT NULL,
  `creturns_pay_date` date NOT NULL,
  `creturns_pay_cheque_bank` varchar(30) NOT NULL,
  `creturns_pay_credit` int(20) NOT NULL,
  `creturns_pay_paid_amount` int(20) NOT NULL,
  `creturns_pay_stt` varchar(20) NOT NULL DEFAULT 'Active',
  `fk_cus_returns_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cus_returns`
--

CREATE TABLE `cus_returns` (
  `cus_returns_id` int(20) NOT NULL,
  `cus_returns_date` date NOT NULL,
  `cus_returns_note` varchar(100) NOT NULL,
  `cus_returns_total_bill` int(20) NOT NULL,
  `cus_returns_stt` varchar(20) NOT NULL DEFAULT 'Active',
  `fk_cus_id` int(20) NOT NULL,
  `fk_veh_id` int(20) NOT NULL,
  `fk_sales_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cus_returns`
--

INSERT INTO `cus_returns` (`cus_returns_id`, `cus_returns_date`, `cus_returns_note`, `cus_returns_total_bill`, `cus_returns_stt`, `fk_cus_id`, `fk_veh_id`, `fk_sales_id`) VALUES
(1, '2023-06-09', '', 0, 'Active', 0, 0, ''),
(2, '2023-06-09', '', 0, 'Active', 0, 0, ''),
(3, '2023-06-10', '', 0, 'Active', 4, 0, ''),
(4, '2023-06-08', '', 0, 'Active', 1, 0, ''),
(5, '2023-06-10', '', 0, 'Active', 4, 0, ''),
(6, '2023-06-25', '', 16490, 'Active', 1, 0, ''),
(7, '2023-06-25', 'New return                            ', 1200, 'Active', 2, 0, ''),
(8, '2023-06-27', '                                ', 0, 'Active', 2, 0, ''),
(9, '2023-06-28', '            gfhvhj                    ', 0, 'Active', 2, 0, ''),
(10, '2023-06-28', 'Last returns of the month                               ', 0, 'Active', 4, 0, ''),
(11, '2023-07-02', 'Year end sales return list                          ', 0, 'Active', 4, 0, ''),
(12, '0000-00-00', '                                ', 0, 'Active', 0, 0, ''),
(13, '0000-00-00', '                                ', 0, 'Active', 0, 0, ''),
(14, '0000-00-00', '                                ', 0, 'Active', 0, 0, ''),
(15, '2023-07-10', '          jghjgjhg                      ', 5400, 'Active', 2, 0, '5'),
(16, '2023-07-10', '          jghjgjhg                      ', 5400, 'Active', 2, 0, '5'),
(17, '2023-07-10', '          jghjgjhg                      ', 4500, 'Active', 2, 0, '5'),
(18, '2023-07-10', '          jghjgjhg                      ', 4500, 'Active', 2, 0, '5'),
(19, '2023-07-04', 'To return invoice', 200, 'Active', 1, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cus_returns_list`
--

CREATE TABLE `cus_returns_list` (
  `cus_retunslt_id` int(20) NOT NULL,
  `cus_returnslt_qty` int(50) NOT NULL,
  `cus_returnslt_issue_price` int(50) NOT NULL,
  `cus_returnslt_item_amount` int(50) NOT NULL,
  `fk_pro_id` int(30) NOT NULL,
  `cus_returnslt_stt` varchar(30) NOT NULL DEFAULT 'Active',
  `fk_cus_returns_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cus_returns_list`
--

INSERT INTO `cus_returns_list` (`cus_retunslt_id`, `cus_returnslt_qty`, `cus_returnslt_issue_price`, `cus_returnslt_item_amount`, `fk_pro_id`, `cus_returnslt_stt`, `fk_cus_returns_id`) VALUES
(1, 5, 200, 0, 0, 'Active', 3),
(2, 5, 120, 0, 3, 'Active', 5),
(3, 2, 120, 240, 1, 'Active', 6),
(4, 5, 250, 1250, 4, 'Active', 6),
(5, 2, 400, 800, 4, 'Active', 0),
(6, 10, 120, 1200, 3, 'Active', 7),
(7, 10, 240, 20, 10, 'Active', 15),
(8, 10, 300, 10, 10, 'Active', 15),
(9, 10, 240, 20, 10, 'Active', 16),
(10, 10, 300, 10, 10, 'Active', 16),
(11, 10, 240, 20, 10, 'Active', 17),
(12, 7, 300, 10, 7, 'Active', 17),
(13, 10, 240, 20, 1, 'Active', 18),
(14, 7, 300, 10, 2, 'Active', 18),
(15, 2, 100, 10, 1, 'Active', 19),
(20, 3, 100, 10, 1, 'Active', 2),
(21, 3, 120, 10, 1, 'Active', 2),
(22, 3, 100, 10, 1, 'Active', 3),
(23, 3, 120, 10, 1, 'Active', 3),
(24, 3, 100, 10, 1, 'Active', 4),
(25, 3, 120, 10, 1, 'Active', 4),
(26, 3, 100, 10, 1, 'Active', 5),
(27, 3, 120, 10, 1, 'Active', 5);

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
  `grn_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_mac_id` int(11) NOT NULL,
  `fk_order_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grn`
--

INSERT INTO `grn` (`grn_id`, `grn_date`, `grn_refno`, `grn_note`, `grn_total_bill`, `grn_stt`, `fk_mac_id`, `fk_order_id`) VALUES
(1, '2023-05-02', 'SO-01', '1st order of the month.                                           ', '9000', 'Active', 1, 0),
(2, '2023-05-02', 'S0-02', '                                            ', '12000', 'Active', 1, 0),
(3, '2023-05-03', '223144', '                                            ', '4000', 'Active', 1, 0),
(4, '2023-05-09', '12', '                                            ', '10200', 'Active', 1, 0),
(5, '2023-05-10', 'S0-05', 'May 1st order                                            ', '45600', 'Active', 1, 0),
(6, '2023-05-10', 'S0-06', '                                            ', '65000', 'Active', 1, 0),
(7, '2023-05-11', 'S0-07', '                                            ', '21000', 'Active', 1, 0),
(8, '2023-05-10', 'S0-08', '                                            ', '50000', 'Active', 1, 0),
(9, '2023-06-29', 'SPO4', 'GRN for june supplier order.                                            ', '192500', 'Active', 1, 0),
(10, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(11, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(12, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(13, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(14, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(15, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(16, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(17, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(18, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(19, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(20, '2023-06-29', 'SPO5', '2nd GRN order for june                                            ', '150000', 'Active', 1, 0),
(21, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(22, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(23, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(24, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(25, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(26, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(27, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(28, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(29, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(30, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(31, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(32, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(33, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0),
(34, '0000-00-00', '', '                                            ', '0', 'Active', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grn_list`
--

CREATE TABLE `grn_list` (
  `grnls_id` int(11) NOT NULL,
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

INSERT INTO `grn_list` (`grnls_id`, `grnls_descip`, `grnls_qty`, `grnls_purchase_price`, `grnls_ex_date`, `grnls_sales_price`, `grnlt_item_amount`, `fk_grn_id`, `grnlt_stt`, `fk_pro_id`) VALUES
(1, '', '150', '60', '2025-05-12', 80, '9000', 1, 'Active', 1),
(2, '', '200', '120', '2024-06-11', 140, '24000', 1, 'Active', 3),
(3, '', '250', '200', '2024-12-29', 240, '50000', 1, 'Active', 5),
(4, '', '150', '80', '2025-05-02', 120, '12000', 2, 'Active', 2),
(5, '', '120', '250', '2025-06-10', 270, '30000', 2, 'Active', 8),
(6, '', '200', '150', '2025-01-28', 180, '30000', 2, 'Active', 9),
(7, '', '250', '130', '2024-09-03', 150, '32500', 2, 'Active', 6),
(8, '', '20', '200', '2023-09-11', 250, '4000', 3, 'Active', 0),
(9, '', '200', '100', '2023-05-31', 120, '20000', 3, 'Active', 3),
(10, '', '100', '100', '2023-05-09', 150, '10000', 4, 'Active', 1),
(11, '', '10', '20', '2023-05-09', 90, '200', 4, 'Active', 1),
(12, '', '80', '120', '2025-09-15', 150, '9600', 5, 'Active', 1),
(13, '', '150', '80', '2024-05-10', 100, '12000', 5, 'Active', 2),
(14, '', '150', '100', '2024-01-11', 150, '15000', 5, 'Active', 4),
(15, '', '180', '50', '2024-06-10', 80, '9000', 5, 'Active', 8),
(16, '', '150', '80', '2025-01-03', 100, '12000', 6, 'Active', 3),
(17, '', '200', '40', '2024-06-05', 65, '8000', 6, 'Active', 4),
(18, '', '250', '180', '2024-06-04', 200, '45000', 6, 'Active', 6),
(19, '', '150', '140', '2023-05-18', 160, '21000', 7, 'Active', 3),
(20, '', '200', '250', '2024-02-07', 280, '50000', 8, 'Active', 2),
(21, '', '200', '120', '2024-12-12', 140, '24000', 9, 'Active', 1),
(22, '', '100', '150', '2024-09-22', 165, '15000', 9, 'Active', 7),
(23, '', '150', '230', '0000-00-00', 250, '34500', 9, 'Active', 8),
(24, '', '300', '180', '2024-11-21', 200, '54000', 9, 'Active', 6),
(25, '', '200', '200', '2025-05-04', 230, '40000', 9, 'Active', 5),
(26, '', '250', '100', '2024-11-22', 120, '25000', 9, 'Active', 3),
(27, '', '500', '300', '2024-11-13', 330, '150000', 10, 'Active', 2),
(28, '', '500', '300', '2024-11-13', 330, '150000', 11, 'Active', 2),
(29, '', '500', '300', '2024-11-13', 330, '150000', 12, 'Active', 2),
(30, '', '500', '300', '2024-11-13', 330, '150000', 13, 'Active', 2),
(31, '', '500', '300', '2024-11-13', 330, '150000', 14, 'Active', 2),
(32, '', '500', '300', '2024-11-13', 330, '150000', 15, 'Active', 2),
(33, '', '500', '300', '2024-11-13', 330, '150000', 16, 'Active', 2),
(34, '', '500', '300', '2024-11-13', 330, '150000', 17, 'Active', 2),
(35, '', '500', '300', '2024-11-13', 330, '150000', 18, 'Active', 2),
(36, '', '500', '300', '2024-11-13', 330, '150000', 19, 'Active', 2),
(37, '', '500', '300', '2024-11-13', 330, '150000', 20, 'Active', 2);

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
(1, 'CBL Biscuits', 'Active', 'They offer a wide range of products including cream biscuits, chocolate biscuits, wafer biscuits, sandwich biscuits, and more.');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `orderlt_id` int(11) NOT NULL,
  `orderlt_descrip` varchar(100) NOT NULL,
  `orderlt_qty` varchar(20) NOT NULL,
  `orderlt_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_order_id` int(11) NOT NULL,
  `fk_pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`orderlt_id`, `orderlt_descrip`, `orderlt_qty`, `orderlt_stt`, `fk_order_id`, `fk_pro_id`) VALUES
(1, '', '300', 'Active', 1, 1),
(2, '', '400', 'Active', 1, 2),
(3, '', '200', 'Active', 1, 6),
(4, '', '100', 'Active', 1, 9),
(5, 'biscuits', '20', 'Active', 2, 1),
(6, 'biscuits', '150', 'Active', 3, 8),
(7, '', '20', 'Active', 4, 1),
(8, '', '50', 'Active', 4, 4),
(9, '', '60', 'Active', 4, 6),
(10, '', '300', 'Active', 4, 7),
(11, '', '10', 'Active', 5, 2),
(12, '', '10', 'Active', 6, 2),
(13, '', '50', 'Active', 6, 5),
(14, '', '40', 'Active', 6, 9),
(15, '', '30', 'Active', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ordr`
--

CREATE TABLE `ordr` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_mac_id` int(11) NOT NULL,
  `order_refno` varchar(30) NOT NULL,
  `order_note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordr`
--

INSERT INTO `ordr` (`order_id`, `order_date`, `order_stt`, `fk_mac_id`, `order_refno`, `order_note`) VALUES
(1, '2023-04-27', 'Active', 1, 'SPO01', ''),
(2, '2023-04-27', 'Active', 1, 'SPO02', ''),
(3, '2023-05-03', 'Active', 1, 'SPO03', ''),
(4, '2023-06-29', 'Active', 1, 'SPO4', '                                        '),
(5, '2023-06-29', 'Active', 1, 'SPO5', '                                        '),
(6, '2023-07-06', 'Active', 1, '154', '1st order for the month of july.');

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
  `paid_amount` int(30) NOT NULL,
  `pay_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_sales_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `cash`, `cheque_amount`, `cheque_no`, `cheque_date`, `cheque_bank`, `paid_amount`, `pay_stt`, `fk_sales_id`) VALUES
(1, '0', '0', '', '0000-00-00', '', 0, 'Active', 1),
(2, '0', '0', '', '0000-00-00', '', 0, 'Active', 2),
(3, '5000', '5000', '10', '2023-05-17', 'NDB', 10000, 'Active', 3),
(4, '2000', '5000', '9', '2023-06-05', 'BOC', 7000, 'Active', 4),
(5, '5000', '10000', '11', '2023-05-30', 'BOC', 15000, 'Active', 5),
(7, '3000', '5000', '14', '2023-05-31', 'NSB', 8000, 'Active', 7),
(8, '4000', '0', '', '0000-00-00', 'NSB', 4000, 'Active', 7),
(9, '110', '0', '', '0000-00-00', 'NDB', 110, 'Active', 1),
(10, '0', '0', '', '0000-00-00', '', 0, 'Active', 8),
(11, '0', '0', '', '0000-00-00', '', 0, 'Active', 1);

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
  `pro_reorder_level` int(20) NOT NULL,
  `pro_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_procat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `pro_code`, `pro_packsize`, `pro_items_in_pack`, `pro_weight`, `pro_reorder_level`, `pro_stt`, `fk_procat_id`) VALUES
(1, 'Lite marie small', 'CMB1020', '', '', '80g', 0, 'Active', 1),
(2, 'Cream Cracker Handy', 'CMB8046', '', '', '200g', 0, 'Active', 3),
(3, 'Chocolate cream handy', 'CMB7681', '', '', '80g', 0, 'Active', 2),
(4, 'Milk Shortcake large', 'CMB4672', '', '', '200g', 0, 'Active', 1),
(5, 'Potato Cracker', 'CMR6571', '', '', '110g', 0, 'Active', 3),
(6, 'Lemon Puff', 'CMB3462', '', '', '200g', 0, 'Active', 2),
(7, 'Nice small', 'CMB6574', '', '', '100g', 0, 'Active', 1),
(8, 'Kurakkan Cracker 2', 'CMB3322', '', '', '100g', 0, 'Active', 3),
(9, 'Orange Cream', 'CMB5444', '', '', '400g', 0, 'Active', 2),
(10, 'Vanila Wafers', 'CMW5047', '', '', '500g', 0, 'delete', 4),
(11, 'Milk short cake2', '11111', '', '', '44kg', 0, 'Active', 3),
(12, 'Milk short cake2', '11111', '', '', '44kg', 0, 'Active', 3),
(13, 'Milk short cake2', '11111', '', '', '44kg', 0, 'Active', 3),
(14, 'Lite marie small', '33333', '', '', '12kg', 0, 'Active', 2),
(15, 'Lite marie small', '33333', '', '', '12kg', 0, 'Active', 2),
(16, 'Lite marie small', '33333', '', '', '12kg', 0, 'Active', 2),
(17, 'Lite marie small', '33333', '', '', '12kg', 0, 'Active', 2),
(18, 'Lite marie small', '33333', '', '', '12kg', 0, 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `procat_id` int(11) NOT NULL,
  `procat_name` varchar(20) NOT NULL,
  `procat_descrip` varchar(200) NOT NULL,
  `procat_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`procat_id`, `procat_name`, `procat_descrip`, `procat_stt`) VALUES
(1, 'Sweet', 'They can come in various shapes and sizes, or sandwich-style, and are often decorated with frosting, sprinkles, or other toppings.', 'Active'),
(2, 'Cream biscuits', 'Cream biscuits are a type of biscuit that consists of two layers of biscuit with a creamy filling in the center.', 'Active'),
(3, 'Crackers', 'Crackers are a type of baked snack that are thin and crispy in texture', 'Active'),
(4, 'Wafers', ' ', 'Active'),
(5, 'Marie', ' ', 'delete'),
(6, 'Kid cookies', ' light flavours', 'Active');

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
(1, '2023-05-02', '', 'Active', 1),
(2, '2023-05-03', '', 'Active', 1),
(3, '2023-05-02', '', 'Active', 1),
(4, '2023-05-03', '', 'Active', 2),
(5, '2023-05-10', '', 'Active', 1),
(6, '2023-05-17', 'Loded', 'Active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_load_list`
--

CREATE TABLE `product_load_list` (
  `pro_loadlt_id` int(15) NOT NULL,
  `fk_pro_id` int(20) NOT NULL,
  `pro_loadlt_qty` int(11) NOT NULL,
  `pro_loadlt_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_load_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_load_list`
--

INSERT INTO `product_load_list` (`pro_loadlt_id`, `fk_pro_id`, `pro_loadlt_qty`, `pro_loadlt_stt`, `fk_load_id`) VALUES
(1, 0, 10, 'Active', 2),
(2, 1, 10, 'Active', 3),
(3, 4, 30, 'Active', 4),
(4, 1, 5, 'Active', 5),
(5, 1, 200, 'Active', 6);

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
(1, '2023-05-02', '', 'Active', 1),
(2, '2023-05-03', 'Expired', 'Active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_unload_list`
--

CREATE TABLE `product_unload_list` (
  `unloadlt_id` int(20) NOT NULL,
  `fk_pro_id` varchar(20) NOT NULL,
  `unloadlt_qty` int(11) NOT NULL,
  `unloadlt_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_unload_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_unload_list`
--

INSERT INTO `product_unload_list` (`unloadlt_id`, `fk_pro_id`, `unloadlt_qty`, `unloadlt_stt`, `fk_unload_id`) VALUES
(1, '2', 15, 'Active', 2);

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
-- Table structure for table `return old`
--

CREATE TABLE `return old` (
  `cus_returns_id` int(11) NOT NULL,
  `cus_returns_date` date NOT NULL,
  `cus_returns_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returns_list(old)`
--

CREATE TABLE `returns_list(old)` (
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
  `root_code` varchar(20) NOT NULL,
  `root_name` varchar(30) NOT NULL,
  `root_stt` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `root`
--

INSERT INTO `root` (`root_id`, `root_code`, `root_name`, `root_stt`) VALUES
(1, 'Ratt-01', 'Rattota', 'Active'),
(2, 'Pall-02', 'Pallepola', 'Active'),
(3, 'Pall-02', 'Madawala', 'Active'),
(4, 'Mat-01', 'Elwala', 'Active');

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
(1, '2023-06-18 12:47:38', 0, '', 1110, 'Active', 1),
(2, '2023-06-18 12:47:42', 0, '', 2000, 'Active', 1),
(3, '2023-06-17 18:30:00', 0, '', 15800, 'Active', 4),
(4, '2023-05-27 18:30:00', 0, '', 10880, 'Active', 1),
(5, '2023-05-28 10:02:47', 0, '', 40680, 'Active', 2),
(7, '2023-05-28 18:30:00', 0, '', 17300, 'Active', 5),
(8, '2023-07-05 18:30:00', 0, '', 7000, 'Active', 1),
(9, '2023-07-06 18:30:00', 0, '', 1152, 'Active', 1);

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
(1, '1', '10', 100, 0, '0', '1000', 'Active', 1),
(2, '1', '10', 200, 0, '0', '2000', 'Active', 2),
(3, '1', '100', 120, 2, '5', '11400', 'Active', 3),
(4, '2', '50', 60, 2, '0', '3000', 'Active', 3),
(5, '3', '20', 70, 0, '0', '1400', 'Active', 3),
(6, '2', '10', 380, 2, '0', '3800', 'Active', 4),
(7, '1', '20', 240, 0, '0', '4800', 'Active', 4),
(8, '8', '2', 1200, 0, '5', '2280', 'Active', 4),
(9, '1', '20', 240, 0, '0', '4800', 'Active', 5),
(10, '2', '10', 300, 0, '0', '3000', 'Active', 5),
(11, '3', '12', 340, 0, '0', '4080', 'Active', 5),
(12, '9', '120', 240, 0, '0', '28800', 'Active', 5),
(13, '9', '20', 440, 0, '0', '8800', 'Active', 7),
(14, '3', '25', 340, 0, '0', '8500', 'Active', 7),
(15, '2', '10', 100, 2, '0', '1000', 'Active', 8),
(16, '5', '20', 300, 4, '0', '6000', 'Active', 8),
(17, '1', '10', 120, 5, '4', '1152', 'Active', 1);

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
(1, '2023-06-28', 'CO1', 'Month end order', 'Active', 3),
(2, '0000-00-00', '', '', 'Active', 1),
(3, '0000-00-00', '', '', 'Active', 2),
(4, '0000-00-00', '', '', 'Active', 1),
(5, '2023-07-04', '44', '', 'Active', 2);

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
(1, 3, '5', 1, 'Active', 1),
(2, 8, '34', 4, 'Active', 4),
(3, 8, '34', 4, 'Active', 4),
(4, 5, '10', 5, 'Active', 5),
(5, 5, '10', 5, 'Active', 5),
(6, 5, '10', 5, 'Active', 5);

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
  `st_user_psswd` varchar(220) NOT NULL,
  `st_stt` varchar(8) NOT NULL,
  `st_user_stt` varchar(10) NOT NULL DEFAULT 'Active',
  `fk_role_id` int(11) NOT NULL,
  `fk_veh_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`st_id`, `st_name`, `st_gender`, `st_dob`, `st_nic`, `st_address`, `st_phone`, `st_email`, `st_user_name`, `st_user_psswd`, `st_stt`, `st_user_stt`, `fk_role_id`, `fk_veh_id`) VALUES
(46, 'S.Kumar', 'Male', '2023-01-02', '111214422', 'roroeoeo', '78855', 'annkumar@gmail.com', 'raj', '202cb962ac59075b964b07152d234b70', 'Active', 'Active', 1, 0),
(49, 'Kanishka Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754125', 'dk123@gmail.com', 'damindu', '67993cf8bd1dfb99e526eb734416dfb9', 'Active', 'Active', 1, 0),
(50, 'Damindu Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754125', 'dk123@gmail.com', 'damindu', 'dami@123', 'delete', 'Active', 2, 0),
(51, 'Damindu Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754125', 'dk123@gmail.com', 'kanishka', 'dami@123', 'Active', 'Active', 2, 0),
(52, 'Damindu Amarasena', 'Male', '2001-09-04', '200178451', 'Kaludawela,Matale.', '0768754126', 'dk123@gmail.com', 'kanishka', 'dami@123', 'delete', 'Active', 2, 0),
(53, 'S.Kumar', 'Male', '0000-00-00', '478596712V', '', '0775874350', 'bbbb@gmail.com', 'damindu', '789', 'delete', 'Active', 2, 0),
(54, 'S.Kumar', 'Male', '0000-00-00', '789654123V', '', '047', '444', 'yyy', '14', 'delete', 'Active', 3, 0),
(55, 'Nimal karunarathna', 'Male', '0000-00-00', '478596774V', '', '0714784512', 'nimalgmail.com', 'nimal', 'nimal123', 'delete', 'Active', 5, 3),
(56, 'Roshan karunarathna update', 'Male', '0000-00-00', '478596774V', '', '0714784512', 'karu_na@gmail.com', 'roshan', 'd41d8cd98f00b204e9800998ecf8427e', 'Active', 'Active', 5, 2),
(57, 'S.viraj', 'Male', '0000-00-00', '789452145V', '', '0747895412', 'wes@gmail.com', 'viraj', '123vi', 'delete', 'Active', 5, 0),
(58, 'M.Viraj', 'Male', '0000-00-00', '987485412V', '', '0745784514', 'viraj@gmail.com', 'viraj', 'viraj123', 'Active', 'Active', 5, 1),
(59, 'kamal.gunawardhana', 'Male', '0000-00-00', '987485412V', '', '0718593478', 'nim2@gmail.com', 'kamal', 'kamal123', 'Active', 'Active', 5, 4),
(60, 'S.Kumar', 'Male', '0000-00-00', 'ddddd', '', 'ddddd', 'ssss', 'sss', '122', 'delete', 'Active', 1, 1),
(61, 'S.Kumar', 'Male', '0000-00-00', 'llllllll', '', 'ppppppppppp', 'ppppppp', 'ppppp', 'ppppp', 'delete', 'Active', 2, 0),
(62, 'Kanishka Amarasena', 'Male', '0000-00-00', '874578146V', '', '0747878787', 'bblc@gmail.com', 'viraj', '44444', 'delete', 'Active', 1, 0),
(63, 'D.k.Wijekon', 'Male', '0000-00-00', '857415478V', '', '0714457924', 'mari@gmail.com', 'wijekon', 'a9de34359ed6dfaf0777fa8e546a9113', 'Active', 'Active', 2, 0),
(64, 'nishka Amarasena', 'Female', '0000-00-00', '874578145V', '', '0745879854', 'OLI@GMAIL.COM', 'OLI', '827ccb0eea8a706c4c34a16891f84e7b', 'Active', 'Active', 3, 0);

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
  `fk_pro_id` int(20) NOT NULL,
  `stock_stt` varchar(8) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_in`, `stock_out`, `sdate`, `fk_veh_id`, `store`, `fk_grn_id`, `fk_pro_id`, `stock_stt`) VALUES
(1, 150, 0, '2023-05-02 05:11:06.980183', 0, 1, 1, 1, 'Active'),
(2, 200, 0, '2023-05-02 05:17:18.414805', 0, 1, 1, 3, 'Active'),
(3, 250, 0, '2023-05-02 05:17:25.529787', 0, 1, 1, 5, 'Active'),
(4, 150, 0, '2023-05-02 05:17:03.533674', 0, 1, 2, 2, 'Active'),
(5, 120, 0, '2023-05-02 05:17:03.721169', 0, 1, 2, 8, 'Active'),
(6, 200, 0, '2023-05-02 05:17:03.865148', 0, 1, 2, 9, 'Active'),
(7, 250, 0, '2023-05-02 05:17:04.050381', 0, 1, 2, 6, 'Active'),
(8, 20, 0, '2023-05-02 05:27:05.207762', 0, 1, 3, 0, 'Active'),
(9, 200, 0, '2023-05-02 05:27:05.496195', 0, 1, 3, 3, 'Active'),
(10, 10, 0, '2023-05-02 06:16:24.357183', 1, 1, 3, 1, 'Active'),
(11, 0, 10, '2023-05-02 06:16:24.392653', 0, 1, 3, 1, 'Active'),
(12, 30, 0, '2023-05-02 06:24:12.085662', 2, 1, 4, 4, 'Active'),
(13, 0, 30, '2023-05-02 06:24:12.156586', 0, 1, 4, 4, 'Active'),
(14, 15, 0, '2023-05-02 06:29:23.907395', 3, 1, 2, 2, 'Active'),
(15, 0, 15, '2023-05-02 06:29:24.177351', 3, 1, 2, 2, 'Active'),
(16, 0, 10, '2023-05-02 10:22:43.451533', 1, 1, 0, 1, 'Active'),
(17, 5, 0, '2023-05-02 11:03:30.152131', 1, 1, 5, 1, 'Active'),
(18, 0, 5, '2023-05-02 11:03:30.232287', 0, 1, 5, 1, 'Active'),
(19, 100, 0, '2023-05-09 14:32:03.219465', 0, 1, 4, 1, 'Active'),
(20, 10, 0, '2023-05-09 14:32:03.446205', 0, 1, 4, 1, 'Active'),
(21, 80, 0, '2023-05-10 05:56:28.896299', 0, 1, 5, 1, 'Active'),
(22, 150, 0, '2023-05-10 05:56:29.012266', 0, 1, 5, 2, 'Active'),
(23, 150, 0, '2023-05-10 05:56:29.128263', 0, 1, 5, 4, 'Active'),
(24, 180, 0, '2023-05-10 05:56:29.324230', 0, 1, 5, 8, 'Active'),
(25, 150, 0, '2023-05-10 09:19:24.118654', 0, 1, 6, 3, 'Active'),
(26, 200, 0, '2023-05-10 09:19:27.698767', 0, 1, 6, 4, 'Active'),
(27, 250, 0, '2023-05-10 09:19:28.004307', 0, 1, 6, 6, 'Active'),
(28, 150, 0, '2023-05-10 09:45:25.455373', 0, 1, 7, 3, 'Active'),
(29, 200, 0, '2023-05-10 09:51:56.490820', 0, 1, 8, 2, 'Active'),
(30, 200, 0, '2023-05-17 06:49:48.586414', 3, 1, 6, 1, 'Active'),
(31, 0, 200, '2023-05-17 06:49:48.618703', 0, 1, 6, 1, 'Active'),
(32, 0, 100, '2023-05-17 13:41:57.112091', 0, 1, 0, 1, 'Active'),
(33, 0, 50, '2023-05-17 13:41:57.272721', 0, 1, 0, 2, 'Active'),
(34, 0, 20, '2023-05-17 13:41:57.420084', 0, 1, 0, 3, 'Active'),
(35, 0, 10, '2023-05-28 08:04:29.701977', 0, 1, 0, 2, 'Active'),
(36, 0, 20, '2023-05-28 08:04:29.893737', 0, 1, 0, 1, 'Active'),
(37, 0, 2, '2023-05-28 08:04:30.101724', 0, 1, 0, 8, 'Active'),
(38, 0, 20, '2023-05-28 10:00:37.541688', 0, 1, 0, 1, 'Active'),
(39, 0, 10, '2023-05-28 10:00:37.821575', 0, 1, 0, 2, 'Active'),
(40, 0, 12, '2023-05-28 10:00:37.989577', 0, 1, 0, 3, 'Active'),
(41, 0, 120, '2023-05-28 10:00:38.181854', 0, 1, 0, 9, 'Active'),
(42, 0, 20, '2023-05-28 10:06:34.137057', 0, 1, 0, 9, 'Active'),
(43, 0, 25, '2023-05-28 10:06:34.353059', 0, 1, 0, 3, 'Active'),
(44, 200, 0, '2023-06-29 05:06:27.697864', 0, 1, 9, 1, 'Active'),
(45, 100, 0, '2023-06-29 05:06:27.841876', 0, 1, 9, 7, 'Active'),
(46, 150, 0, '2023-06-29 05:06:27.985861', 0, 1, 9, 8, 'Active'),
(47, 300, 0, '2023-06-29 05:06:28.114130', 0, 1, 9, 6, 'Active'),
(48, 200, 0, '2023-06-29 05:06:28.378033', 0, 1, 9, 5, 'Active'),
(49, 250, 0, '2023-06-29 05:06:28.546115', 0, 1, 9, 3, 'Active'),
(50, 500, 0, '2023-06-29 07:38:57.825209', 0, 1, 10, 2, 'Active'),
(51, 500, 0, '2023-06-29 10:03:22.373892', 0, 1, 11, 2, 'Active'),
(52, 500, 0, '2023-06-29 10:05:18.324645', 0, 1, 12, 2, 'Active'),
(53, 500, 0, '2023-06-29 10:06:15.388544', 0, 1, 13, 2, 'Active'),
(54, 500, 0, '2023-06-29 10:07:46.790173', 0, 1, 14, 2, 'Active'),
(55, 500, 0, '2023-06-29 10:15:02.224768', 0, 1, 15, 2, 'Active'),
(56, 500, 0, '2023-06-29 10:17:10.553257', 0, 1, 16, 2, 'Active'),
(57, 500, 0, '2023-06-29 10:30:27.596093', 0, 1, 17, 2, 'Active'),
(58, 500, 0, '2023-06-29 10:33:56.283062', 0, 1, 18, 2, 'Active'),
(59, 500, 0, '2023-06-29 10:37:39.960151', 0, 1, 19, 2, 'Active'),
(60, 500, 0, '2023-06-29 11:17:32.696833', 0, 1, 20, 2, 'Active'),
(61, 0, 10, '2023-07-06 03:18:51.375012', 0, 1, 0, 2, 'Active'),
(62, 0, 20, '2023-07-06 03:18:51.537917', 0, 1, 0, 5, 'Active'),
(63, 0, 10, '2023-07-07 04:50:33.855216', 0, 1, 0, 1, 'Active');

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
(1, 'Jayanthi Super', 'No.20.Rattota road.Rattota                                  ', 662220751, 'jaysuper@gmail.com', 1, 'Active', 1),
(2, 'Bandara store', 'No.35.Rattota road.Kaikawala                                ', 764410130, 'bandarast@gmIail.con', 1, 'Active', 3),
(3, 'G.K Supper', 'No.65,Dambulla road.Pallepola                               ', 712034577, '', 2, 'Active', 4),
(4, 'Star Grocery', '1,D Kanangamuwa,Pallepola rd.Akurambada.                    ', 754879541, 'starba@gmIail.con', 2, 'Active', 2),
(5, 'Wijerathna stores', '75/4,Madawala road.Madawala                                 ', 742598741, 'wijerathna@gmail.com', 3, 'Active', 5);

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
  `sup_paid_amount` decimal(20,0) NOT NULL,
  `sup_pay_stt` varchar(8) NOT NULL DEFAULT 'Active',
  `fk_grn_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_payment`
--

INSERT INTO `supplier_payment` (`sup_pay_id`, `sup_cash`, `sup_cheque_amount`, `sup_cheque_no`, `sup_cheque_date`, `sup_cheque_bank`, `sup_paid_amount`, `sup_pay_stt`, `fk_grn_id`) VALUES
(1, '0', '0', '', '0000-00-00', '', '0', 'Active', '3'),
(2, '0', '0', '', '0000-00-00', '', '0', 'Active', '7'),
(3, '0', '0', '', '0000-00-00', '', '0', 'Active', '9'),
(4, '500', '0', '', '0000-00-00', '', '500', 'Active', '3'),
(5, '100', '200', '4', '2023-05-03', 'BOC', '300', 'Active', '3'),
(6, '0', '0', '', '0000-00-00', '', '0', 'Active', '11'),
(7, '5000', '5000', '8', '2023-05-10', 'BOC', '10000', 'Active', '5'),
(9, '5000', '10000', '60', '2023-05-12', 'HSBC', '15000', 'Active', '18'),
(10, '1000', '10000', '50', '2023-05-18', 'NSB', '11000', 'Active', '19'),
(11, '10000', '0', '', '2023-05-22', 'HSBC', '10000', 'Active', '20'),
(12, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(13, '5000', '10000', '33', '2023-06-29', 'HSBC', '15000', 'Active', '9'),
(14, '2000', '5000', '61', '2023-06-29', 'HSBC', '7000', 'Active', '10'),
(15, '5000', '0', '', '2023-06-29', 'NSB', '5000', 'Active', '1'),
(16, '3000', '0', '', '2023-06-29', 'BOC', '3000', 'Active', '10'),
(17, '2000', '5000', '61', '2023-06-29', 'HSBC', '7000', 'Active', ''),
(26, '2000', '5000', '61', '2023-06-29', 'HSBC', '7000', 'Active', ''),
(27, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(28, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(29, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(30, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(31, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(32, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(33, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(34, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(35, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(36, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(37, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(38, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(39, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(40, '0', '0', '', '0000-00-00', '', '0', 'Active', ''),
(41, '12000', '0', '', '2023-07-04', 'NSB', '12000', 'Active', '2');

-- --------------------------------------------------------

--
-- Table structure for table `sup_returns`
--

CREATE TABLE `sup_returns` (
  `sup_returns_id` int(30) NOT NULL,
  `sup_returns_date` date NOT NULL,
  `sup_returns_note` varchar(200) NOT NULL,
  `sup_returns_total_bill` int(40) NOT NULL,
  `sup_returns_stt` varchar(40) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `veh_capacity` varchar(20) NOT NULL,
  `veh_fuel` decimal(10,0) NOT NULL,
  `veh_brand` varchar(20) NOT NULL,
  `fk_vehtype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`veh_id`, `veh_model`, `veh_stt`, `veh_number`, `veh_capacity`, `veh_fuel`, `veh_brand`, `fk_vehtype_id`) VALUES
(1, 'Cabstar', 'Active', 'CP-AA-9387', '2.5 t', '10', 'Nissan', 1),
(2, 'NT400', 'Active', 'CP-QA-2210', '3.5 t', '12', 'Nissan', 1),
(3, ' NV200', 'Active', 'CP-QA-2213', '728 kg', '12', 'Toyota', 2),
(4, 'Cabstar', 'Active', 'CP-QA-2215', '2.5 t', '10', 'Nissan', 1),
(5, 'MT400', 'Active', 'CP-AA-5973', '3.5 t', '8', 'Mazda', 1);

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
-- Indexes for table `cus_invoice`
--
ALTER TABLE `cus_invoice`
  ADD PRIMARY KEY (`cus_invoice_id`);

--
-- Indexes for table `cus_retrurns_payment`
--
ALTER TABLE `cus_retrurns_payment`
  ADD PRIMARY KEY (`creturns_pay_id`);

--
-- Indexes for table `cus_returns`
--
ALTER TABLE `cus_returns`
  ADD PRIMARY KEY (`cus_returns_id`);

--
-- Indexes for table `cus_returns_list`
--
ALTER TABLE `cus_returns_list`
  ADD PRIMARY KEY (`cus_retunslt_id`);

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
  ADD KEY `fk_Order list_Order1_idx` (`fk_order_id`);

--
-- Indexes for table `ordr`
--
ALTER TABLE `ordr`
  ADD PRIMARY KEY (`order_id`,`fk_mac_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

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
-- Indexes for table `return old`
--
ALTER TABLE `return old`
  ADD PRIMARY KEY (`cus_returns_id`);

--
-- Indexes for table `returns_list(old)`
--
ALTER TABLE `returns_list(old)`
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
-- Indexes for table `sup_returns`
--
ALTER TABLE `sup_returns`
  ADD PRIMARY KEY (`sup_returns_id`);

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
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cus_invoice`
--
ALTER TABLE `cus_invoice`
  MODIFY `cus_invoice_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cus_retrurns_payment`
--
ALTER TABLE `cus_retrurns_payment`
  MODIFY `creturns_pay_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cus_returns`
--
ALTER TABLE `cus_returns`
  MODIFY `cus_returns_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cus_returns_list`
--
ALTER TABLE `cus_returns_list`
  MODIFY `cus_retunslt_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `damage`
--
ALTER TABLE `damage`
  MODIFY `damage_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_list`
--
ALTER TABLE `damage_list`
  MODIFY `damagelt_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grn`
--
ALTER TABLE `grn`
  MODIFY `grn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `grn_list`
--
ALTER TABLE `grn_list`
  MODIFY `grnls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `mac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `orderlt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ordr`
--
ALTER TABLE `ordr`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `procat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_load`
--
ALTER TABLE `product_load`
  MODIFY `load_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_load_list`
--
ALTER TABLE `product_load_list`
  MODIFY `pro_loadlt_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_unload`
--
ALTER TABLE `product_unload`
  MODIFY `unload_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `return old`
--
ALTER TABLE `return old`
  MODIFY `cus_returns_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `root`
--
ALTER TABLE `root`
  MODIFY `root_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales return`
--
ALTER TABLE `sales return`
  MODIFY `salesreturn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `saleslt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `sporder_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_order_list`
--
ALTER TABLE `shop_order_list`
  MODIFY `shop_orderlt_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `staff_role`
--
ALTER TABLE `staff_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  MODIFY `sup_pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sup_returns`
--
ALTER TABLE `sup_returns`
  MODIFY `sup_returns_id` int(30) NOT NULL AUTO_INCREMENT;

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
  MODIFY `veh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehtype`
--
ALTER TABLE `vehtype`
  MODIFY `vehtype_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
