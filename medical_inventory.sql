-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2018 at 11:50 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `medical_inventory`
--
CREATE DATABASE IF NOT EXISTS `medical_inventory` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `medical_inventory`;

-- --------------------------------------------------------

--
-- Table structure for table `create_stock`
--

CREATE TABLE IF NOT EXISTS `create_stock` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `stock_date` varchar(100) NOT NULL,
  `stock_time` varchar(100) NOT NULL,
  `stock_vendor` varchar(100) NOT NULL,
  `sales_person` varchar(100) NOT NULL,
  `ven_pay` varchar(100) NOT NULL,
  `pay_mode` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `descrip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `create_stock`
--

INSERT INTO `create_stock` (`id`, `stock_date`, `stock_time`, `stock_vendor`, `sales_person`, `ven_pay`, `pay_mode`, `remark`, `descrip`) VALUES
(1, '2016-04-02', '10:16:54am', '5', 'daljeet barar', '500,000', 'online transaction', 'all clear', '  no-dues'),
(2, '2016-04-09', '10:24:10am', '2', 'kartik singh', '100000', 'cheque', 'all completed', '  new dealer'),
(3, '2016-04-01', '10:27:09am', '4', 'julian fernadez', '10,00000', 'online transaction', 'full payment', '  no-dues'),
(4, '2016-04-01', '10:28:57am', '3', 'kripal khare', '2000', 'cash', 'full payment', '  no-dues'),
(5, '2016-04-01', '10:30:48am', '1', 'vishal nayak', '50,000', 'cheque', 'full payment', '  no-dues'),
(6, '2018-04-28', '05:11:11am', '6', 'siraaj', '10000', 'cash', 'half payment after few days', ' new stock after gst');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE IF NOT EXISTS `medicine_category` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `cat_name`) VALUES
(1, 'ointment'),
(2, 'syrup'),
(3, 'drops'),
(4, 'liquid solution'),
(5, 'soap'),
(6, 'powder'),
(7, 'oil'),
(8, 'shampoo'),
(9, 'tablet'),
(10, 'capsules'),
(11, 'cream');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_details`
--

CREATE TABLE IF NOT EXISTS `medicine_details` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(100) NOT NULL,
  `iupac` varchar(100) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_id` varchar(100) NOT NULL,
  `med_purpose` varchar(100) NOT NULL,
  `purpose_id` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `power` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `medicine_details`
--

INSERT INTO `medicine_details` (`id`, `med_name`, `iupac`, `cat_name`, `cat_id`, `med_purpose`, `purpose_id`, `manufacturer`, `power`) VALUES
(1, 'dettol', 'decla infactant', 'liquid solution', '4', 'germs infactant', '5', 'decathol industries', 'n/a'),
(2, 'cipladyne', 'ciplachoric ointment', 'ointment', '1', 'wounds repair', '6', 'cipla industries', 'n/a'),
(3, 'glucose', 'glucadyne', 'powder', '6', 'weakness', '11', 'phantom medical industries', 'n/a'),
(4, 'sumo cold', 'cholerozol iupac 55mgs', 'tablet', '9', 'cold&flu', '1', 'branden medicose pvt ltd.', '5mg'),
(5, 'disprin', 'dithol cilamine', 'tablet', '9', 'headache', '7', 'lupin pharma', '2mg'),
(6, 'ibrufen 500', 'ibrufen antamine', 'capsules', '10', 'cold&flu', '1', 'larsens medical industries pvt ltd.', '10mg'),
(7, 'sofromycin', 'soframyctylin', 'ointment', '1', 'skin burn', '12', 'gaylocin medi manufacturer', 'n/a'),
(8, 'antamyne', 'antaacids', 'tablet', '9', 'digestion clear', '14', 'ultramedicare pvt ltd.', '1mg'),
(9, 'dabur gulabri', 'flormin solutions', 'liquid solution', '4', 'skin infection', '4', 'dabur industries', 'n/a'),
(10, 'viks action 500', 'hydochlorides tablets', 'capsules', '10', 'cold&flu', '1', 'burgonhain industries pvt ltd.', '2mg'),
(11, 'Fair and smart', 'fair', 'cream', '11', 'Skin', '15', 'cipla', '50 gm');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_purpose`
--

CREATE TABLE IF NOT EXISTS `medicine_purpose` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pur_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `medicine_purpose`
--

INSERT INTO `medicine_purpose` (`id`, `pur_name`) VALUES
(1, 'cold&flu'),
(2, 'cough&cold'),
(3, 'dry cough'),
(4, 'skin infection'),
(5, 'germs infactant'),
(6, 'wounds repair'),
(7, 'headache'),
(8, 'joint pain'),
(9, 'musle pain'),
(10, 'strains'),
(11, 'weakness'),
(12, 'skin burn'),
(13, 'heart desease'),
(14, 'digestion clear'),
(15, 'Skin');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_stock`
--

CREATE TABLE IF NOT EXISTS `medicine_stock` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `stock_id` int(100) NOT NULL,
  `stock_date` varchar(100) NOT NULL,
  `stock_vendor` varchar(100) NOT NULL,
  `sales_person` varchar(100) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `iupac` varchar(100) NOT NULL,
  `power` varchar(100) NOT NULL,
  `manufacture_date` varchar(100) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `block_no` varchar(100) NOT NULL,
  `rack_no` varchar(100) NOT NULL,
  `medicine_unit` varchar(100) NOT NULL,
  `unit_cost` varchar(100) NOT NULL,
  `total_cost` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `medicine_stock`
--

INSERT INTO `medicine_stock` (`id`, `stock_id`, `stock_date`, `stock_vendor`, `sales_person`, `medicine_name`, `iupac`, `power`, `manufacture_date`, `expiry_date`, `block_no`, `rack_no`, `medicine_unit`, `unit_cost`, `total_cost`) VALUES
(1, 1, '2016-04-02', 'sunanda medical pvt ltd.', 'daljeet barar', 'dettol', 'decla', 'n/a', '2016-03-01', '2016-04-15', 't-1', '55', '5000', '10', '50000'),
(2, 1, '2016-04-02', 'sunanda medical pvt ltd.', 'daljeet barar', 'ibrufen 500', 'ibrufen', '5mg', '2016-04-01', '2016-04-30', 't-1', '52', '6000', '2', '12000'),
(3, 2, '2016-04-09', 'vaishvik medicose industries', 'kartik singh', 'ibrufen 500', 'ibrufen', '5mgs', '2016-04-01', '2016-04-30', 't-1', '22', '6000', '2', '12000'),
(4, 2, '2016-04-09', 'vaishvik medicose industries', 'kartik singh', 'dabur gulabri', 'flormin', 'n/a', '2016-04-01', '2016-04-28', 't-2', '20', '4992', '20', '100000'),
(5, 3, '2016-04-01', 'karlpearssen medhub pvt ltd', 'julian fernadez', 'sofromycin', 'soframyctylin', 'n/a', '2016-04-01', '2018-05-19', 't-2', '22', '3998', '50', '200000'),
(6, 4, '2016-04-01', 'mayur medicose pvt ltd', 'kripal khare', 'sumo cold', 'cholerozol', '2mg', '2016-04-19', '2020-04-18', 't-5', '20', '8000', '3', '24000'),
(7, 5, '2016-04-01', 'lupin pharma industries', 'vishal nayak', 'glucose', 'glucadyne', 'n/a', '2016-06-16', '2018-09-15', 't-6', '50', '4670', '60', '300000');

-- --------------------------------------------------------

--
-- Table structure for table `sale_record`
--

CREATE TABLE IF NOT EXISTS `sale_record` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `id_medicine` varchar(100) NOT NULL,
  `units_sale` varchar(100) NOT NULL,
  `stock_date` varchar(100) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `medicine` varchar(100) NOT NULL,
  `med_power` varchar(100) NOT NULL,
  `block_no` varchar(100) NOT NULL,
  `rack_no` varchar(100) NOT NULL,
  `unit_cost` varchar(100) NOT NULL,
  `medicine_cost` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sale_record`
--

INSERT INTO `sale_record` (`id`, `date`, `time`, `id_medicine`, `units_sale`, `stock_date`, `vendor_name`, `medicine`, `med_power`, `block_no`, `rack_no`, `unit_cost`, `medicine_cost`) VALUES
(1, '14-04-16', '10:2339:am', '4', '5', '2016-04-09', 'vaishvik medicose industries', 'dabur gulabri', 'n/a', 't-2', '20', '20', '100'),
(2, '14-04-16', '10:2339:am', '5', '2', '2016-04-01', 'karlpearssen medhub pvt ltd', 'sofromycin', 'n/a', 't-2', '22', '50', '100'),
(3, '14-04-16', '10:4947:am', '7', '5', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '300'),
(4, '14-04-16', '10:5948:am', '4', '2', '2016-04-09', 'vaishvik medicose industries', 'dabur gulabri', 'n/a', 't-2', '20', '20', '40'),
(5, '14-04-16', '10:0051:am', '4', '1', '2016-04-09', 'vaishvik medicose industries', 'dabur gulabri', 'n/a', 't-2', '20', '20', '20'),
(6, '28-04-18', '05:1617:am', '7', '5', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '300'),
(7, '28-04-18', '05:2517:am', '7', '5', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '300'),
(8, '28-04-18', '05:5618:am', '7', '5', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '300'),
(9, '28-04-18', '05:5618:am', '7', '100', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '6000'),
(10, '28-04-18', '05:0719:am', '7', '5', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '300'),
(11, '28-04-18', '05:0819:am', '7', '100', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '6000'),
(12, '28-04-18', '05:1419:am', '7', '5', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '300'),
(13, '28-04-18', '05:1419:am', '7', '100', '2016-04-01', 'lupin pharma industries', 'glucose', 'n/a', 't-6', '50', '60', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `email` varchar(100) NOT NULL,
  `psw` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`email`, `psw`) VALUES
('asiya@gmail.com', 'asiya');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_details`
--

CREATE TABLE IF NOT EXISTS `vendor_details` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_address` varchar(100) NOT NULL,
  `vendor_contact` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vendor_details`
--

INSERT INTO `vendor_details` (`id`, `vendor_name`, `vendor_address`, `vendor_contact`) VALUES
(1, 'lupin pharma industries', 'mandideep,bhopal', '9524789630'),
(2, 'vaishvik medicose industries', 'nagpur,mumbai', '09632589632'),
(3, 'mayur medicose pvt ltd', 'noida,uttar pradesh', '09966325452'),
(4, 'karlpearssen medhub pvt ltd', 'mumbai,maharashtra', '09852639652'),
(5, 'sunanda medical pvt ltd.', 'shimla,himachal pradesh', '09862365986'),
(6, 'alpha medico', 'dawa bzaaar', '9876543258');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_sales_person`
--

CREATE TABLE IF NOT EXISTS `vendor_sales_person` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vendor_id` varchar(100) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `sales_person` varchar(100) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vendor_sales_person`
--

INSERT INTO `vendor_sales_person` (`id`, `vendor_id`, `vendor_name`, `sales_person`, `mobile_no`) VALUES
(1, '1', 'lupin pharma industries', 'prakash tiwari', '9963025639'),
(2, '1', 'lupin pharma industries', 'vishal nayak', '9730256987'),
(3, '2', 'vaishvik medicose industries', 'kartik singh', '8856923654'),
(4, '2', 'vaishvik medicose industries', 'mohit patel', '8896542399'),
(5, '3', 'mayur medicose pvt ltd', 'faraaz waqar', '9986352147'),
(6, '4', 'karlpearssen medhub pvt ltd', 'julian fernadez', '8874596321'),
(8, '4', 'karlpearssen medhub pvt ltd', 'prateek tyagi', '8895475632'),
(9, '5', 'sunanda medical pvt ltd.', 'ankit singh', '8856932147'),
(10, '5', 'sunanda medical pvt ltd.', 'daljeet barar', '9963258947'),
(11, '6', 'alpha medico', 'siraaj', '98798654534534');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
