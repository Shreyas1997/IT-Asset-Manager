-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 31, 2019 at 12:09 PM
-- Server version: 5.7.21
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
-- Database: `assetmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetail`
--

DROP TABLE IF EXISTS `admindetail`;
CREATE TABLE IF NOT EXISTS `admindetail` (
  `adminName` varchar(300) NOT NULL,
  `adminPassword` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindetail`
--

INSERT INTO `admindetail` (`adminName`, `adminPassword`) VALUES
('admin', 'adminpass');

-- --------------------------------------------------------

--
-- Table structure for table `assetmanagement`
--

DROP TABLE IF EXISTS `assetmanagement`;
CREATE TABLE IF NOT EXISTS `assetmanagement` (
  `sl.no` int(255) NOT NULL AUTO_INCREMENT,
  `assetName` varchar(300) NOT NULL,
  `assetType` varchar(300) NOT NULL,
  `manfDate` varchar(300) NOT NULL,
  `quantity` int(255) NOT NULL,
  `vendor` varchar(500) NOT NULL,
  `version` varchar(300) DEFAULT NULL,
  `productKey` varchar(300) DEFAULT NULL,
  `purchDate` varchar(300) NOT NULL,
  `assetCondition` varchar(300) DEFAULT NULL,
  `maintenence` varchar(300) DEFAULT NULL,
  `perPrice` varchar(300) NOT NULL,
  `totalPrice` varchar(300) NOT NULL,
  `availability` varchar(300) NOT NULL,
  PRIMARY KEY (`sl.no`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assetmanagement`
--

INSERT INTO `assetmanagement` (`sl.no`, `assetName`, `assetType`, `manfDate`, `quantity`, `vendor`, `version`, `productKey`, `purchDate`, `assetCondition`, `maintenence`, `perPrice`, `totalPrice`, `availability`) VALUES
(48, 'linux', 'Software', '2019-10-14', 24, 'nikkil', 'Â 3.0.0', 'Â fa506-hyjop-ghtji', '2019-10-23', '', 'Not Need', '14925', '358200', 'Not Available'),
(41, 'ups', 'Hardware', '2019-10-01', 300, 'sahil', 'Â ', 'Â ', '2019-10-22', 'Good', '', '2000', '600000', 'Available'),
(39, 'computer', 'Hardware', '2019-10-08', 200, 'Nihal', 'Â ', 'Â ', '2019-10-15', 'Good', 'Not Need', '20000', '4000000', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `assetrequest`
--

DROP TABLE IF EXISTS `assetrequest`;
CREATE TABLE IF NOT EXISTS `assetrequest` (
  `requestID` int(200) NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(300) NOT NULL,
  `employeeName` varchar(300) NOT NULL,
  `employeeMail` varchar(300) NOT NULL,
  `requestAsset` varchar(300) NOT NULL,
  `employeeReason` varchar(500) NOT NULL,
  `status` varchar(30) DEFAULT '0',
  PRIMARY KEY (`requestID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assetrequest`
--

INSERT INTO `assetrequest` (`requestID`, `employeeID`, `employeeName`, `employeeMail`, `requestAsset`, `employeeReason`, `status`) VALUES
(13, '101', 'Jhon Doe', 'jhon@gmail.com', 'linux', 'It\'s Crashing', 'Approved'),
(14, '102', 'Jack', 'jack@gmail.com', 'linux', 'It\'s Crashing.', 'Approved'),
(15, '105', 'Shreyas', 'shreyas@gmail.com', 'macos', 'Crashing..', 'Rejected');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
