-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2018 at 01:20 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumber`
--

CREATE TABLE IF NOT EXISTS `tblautonumber` (
  `AutoID` int(11) NOT NULL AUTO_INCREMENT,
  `AutoStart` varchar(30) NOT NULL,
  `AutoEnd` int(11) NOT NULL,
  `AutoInc` int(11) NOT NULL,
  `AutoType` varchar(30) NOT NULL,
  PRIMARY KEY (`AutoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblautonumber`
--

INSERT INTO `tblautonumber` (`AutoID`, `AutoStart`, `AutoEnd`, `AutoInc`, `AutoType`) VALUES
(1, '2017', 56, 1, 'AuthPrint');

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE IF NOT EXISTS `tblposition` (
  `PositionID` int(11) NOT NULL AUTO_INCREMENT,
  `PositionCode` varchar(30) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  PRIMARY KEY (`PositionID`),
  KEY `DepartmentID` (`DepartmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`PositionID`, `PositionCode`, `Description`, `DepartmentID`) VALUES
(1, 'RN-1', 'NURSE 1', 1),
(2, 'NA-1', 'NURSING ATTENDANT / NURSING ASSISTANT / NURSING AIDE', 2),
(3, 'AIDE', 'ADMINISTRATIVE ASSISTANT / ADMINISTRATIVE AIDE', 3),
(4, 'UW', 'UTILITY WORKER', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE IF NOT EXISTS `tbldepartment` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `Department` varchar(30) NOT NULL,
  `Description` varchar(99) NOT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`DepartmentID`, `Department`, `Description`) VALUES
(1, 'MEDICINE', 'INTERNAL MEDICINE'),
(2, 'PHARMACY', 'REVIEWING MEDICATIONS'),
(3, 'LABORATORY', 'TECHNOLOGICAL RESEARCH'),
(4, 'RADIOLOGY', 'DIAGNOSTIC RADIOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE IF NOT EXISTS `tbllogs` (
  `LOGID` int(11) NOT NULL AUTO_INCREMENT,
  `USERID` int(11) NOT NULL,
  `LOGDATETIME` datetime NOT NULL,
  `LOGROLE` varchar(30) NOT NULL,
  `LOGMODE` varchar(30) NOT NULL,
  PRIMARY KEY (`LOGID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`LOGID`, `USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) VALUES
(1, 1, '2022-01-24 01:53:37', 'Administrator', 'Logged out'),
(2, 1, '2022-01-24 02:48:48', 'Administrator', 'Logged in');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE IF NOT EXISTS `tblemployee` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(30) NOT NULL,
  `Firstname` varchar(99) NOT NULL,
  `Lastname` varchar(99) NOT NULL,
  `Middlename` varchar(99) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `BirthDate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `ContactNo` varchar(30) NOT NULL,
  `PositionLevel` varchar(11) NOT NULL,
  `PositionID` int(11) NOT NULL,
  `EmPhoto` varchar(255) NOT NULL,
  `Cand_Status` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `EmployeeID` (`EmployeeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`ID`, `EmployeeID`, `Firstname`, `Lastname`, `Middlename`, `Address`, `Gender`, `BirthDate`, `Age`, `ContactNo`, `PositionLevel`, `PositionID`, `EmPhoto`, `Cand_Status`) VALUES
(1, '023256469', 'KENJIE', 'PALACIOS', 'ECHALAR', 'KABANKALAN CITY', 'Male', '1992-11-20', 24, '0232546886', 'Fourth', 3, 'photo/login.png', 'Employee'),
(2, '12312312', 'JAKE', 'PALMA', 'ECHALAR', 'KABANKALAN CITY', 'Male', '1990-11-11', 26, '12312312312', 'Second', 4, 'photo/import1.png', 'Employee'),
(3, '8583362', 'JANRY', 'TAN', 'MELMOM', 'KABANKALAN CITY', 'Male', '1991-08-16', 25, '12312312312', 'First', 3, '', 'Employee'),
(4, '0010266936', 'JASON', 'BATUTU', 'RERE', 'KABANKALAN CITY', 'Male', '1994-02-14', 23, '21312312312321', 'First', 3, 'photo/Koala.jpg', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable`
--

CREATE TABLE IF NOT EXISTS `tbltimetable` (
  `TimeTableID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(90) NOT NULL,
  `TimeInAM` varchar(30) NOT NULL,
  `TimeOutAM` varchar(30) NOT NULL,
  `TimeInPM` varchar(30) NOT NULL,
  `TimeOutPM` varchar(30) NOT NULL,
  `AttendDate` date NOT NULL,
  PRIMARY KEY (`TimeTableID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbltimetable`
--

INSERT INTO `tbltimetable` (`TimeTableID`, `EmployeeID`, `TimeInAM`, `TimeOutAM`, `TimeInPM`, `TimeOutPM`, `AttendDate`) VALUES
(1, '0010266936', '04:39 AM', '04:39 AM', '', '', '2018-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `tblverifytimeintimeout`
--

CREATE TABLE IF NOT EXISTS `tblverifytimeintimeout` (
  `VerifyID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(90) NOT NULL,
  `TimeIn` varchar(30) NOT NULL,
  `TimeOut` varchar(30) NOT NULL,
  `Verification` varchar(90) NOT NULL,
  `DateValidation` date NOT NULL,
  PRIMARY KEY (`VerifyID`),
  UNIQUE KEY `EmployeeID` (`EmployeeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblverifytimeintimeout`
--

INSERT INTO `tblverifytimeintimeout` (`VerifyID`, `EmployeeID`, `TimeIn`, `TimeOut`, `Verification`, `DateValidation`) VALUES
(1, '0010266936', '04:39 AM', '', 'TimeIn', '2018-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE IF NOT EXISTS `useraccounts` (
  `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_NAME` varchar(255) NOT NULL,
  `ACCOUNT_USERNAME` varchar(255) NOT NULL,
  `ACCOUNT_PASSWORD` text NOT NULL,
  `ACCOUNT_TYPE` varchar(30) NOT NULL,
  `EMPID` int(11) NOT NULL,
  `USERIMAGE` varchar(255) NOT NULL,
  PRIMARY KEY (`ACCOUNT_ID`),
  UNIQUE KEY `ACCOUNT_USERNAME` (`ACCOUNT_USERNAME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`, `EMPID`, `USERIMAGE`) VALUES
(1, 'Janno Palacios', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1234, 'photos/import2.png'),
(5, 'James Yap', 'james', '474ba67bdb289c6263b36dfd8a7bed6c85b04943', 'Administrator', 0, ''),
(6, 'LLOYD', 'lloyd', '12dea96fec20593566ab75692c9949596833adc9', 'Registrar', 0, ''),
(7, 'SSG1', 'ssg', '24ce6d489183f0ce4bd322ec5f59b45f9177288d', 'Registrar', 0, ''),
(8, 'SSG2', 'ssg2', '5e0b5b0eae521294ac33b471d64dcee6acff3799', 'Registrar', 0, '');
