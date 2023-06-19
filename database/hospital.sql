-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 02:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_opdpatients`
--

CREATE TABLE `add_opdpatients` (
  `id` int(11) NOT NULL,
  `a_fname` varchar(255) NOT NULL,
  `a_gender` varchar(255) NOT NULL,
  `a_age` int(11) NOT NULL,
  `a_complaint` text NOT NULL,
  `a_historypresentillness` text NOT NULL,
  `a_bp` varchar(255) NOT NULL,
  `a_rr` varchar(255) NOT NULL,
  `a_cr` varchar(255) NOT NULL,
  `a_temp` varchar(255) NOT NULL,
  `a_wt` varchar(255) NOT NULL,
  `a_pr` varchar(255) NOT NULL,
  `a_physicalexam` text NOT NULL,
  `a_diagnosis` text NOT NULL,
  `a_medication` text NOT NULL,
  `a_physician_id` int(11) NOT NULL,
  `a_date` date NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `adminname` varchar(25) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `loginid`, `password`, `status`, `usertype`) VALUES
(1, 'ITSC', 'admin', '123456789', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentid` int(10) NOT NULL,
  `appointmenttype` varchar(25) NOT NULL,
  `patientid` int(10) NOT NULL,
  `roomid` int(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `appointmentdate` date NOT NULL,
  `appointmenttime` time NOT NULL,
  `doctorid` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `app_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentid`, `appointmenttype`, `patientid`, `roomid`, `departmentid`, `appointmentdate`, `appointmenttime`, `doctorid`, `status`, `app_reason`) VALUES
(1, '', 1, 0, 1, '2022-11-15', '21:50:00', 1, 'Approved', 'fever'),
(2, '', 2, 0, 1, '2022-11-16', '12:51:00', 1, 'Approved', 'fever');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billingid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `billingdate` date NOT NULL,
  `billingtime` time NOT NULL,
  `discount` float(10,2) NOT NULL,
  `taxamount` float(10,2) NOT NULL,
  `discountreason` text NOT NULL,
  `discharge_time` time NOT NULL,
  `discharge_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billingid`, `patientid`, `appointmentid`, `billingdate`, `billingtime`, `discount`, `taxamount`, `discountreason`, `discharge_time`, `discharge_date`) VALUES
(1, 1, 1, '2022-11-15', '14:56:31', 0.00, 0.00, '', '00:00:00', '0000-00-00'),
(2, 2, 2, '2022-11-16', '05:53:07', 0.00, 0.00, '', '00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `billing_records`
--

CREATE TABLE `billing_records` (
  `billingservice_id` int(10) NOT NULL,
  `billingid` int(10) NOT NULL,
  `bill_type_id` int(10) NOT NULL COMMENT 'id of service charge or treatment charge',
  `bill_type` varchar(250) NOT NULL,
  `bill_amount` float(10,2) NOT NULL,
  `bill_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_records`
--

INSERT INTO `billing_records` (`billingservice_id`, `billingid`, `bill_type_id`, `bill_type`, `bill_amount`, `bill_date`, `status`) VALUES
(4, 2, 1, 'Consultancy Charge', 800.00, '2022-11-16', 'Active'),
(5, 2, 20, 'Treatment', 300.00, '2022-11-16', 'Active'),
(6, 2, 2, 'Prescription Charge', 15.00, '2022-11-16', 'Active'),
(7, 2, 3, 'Prescription Charge', 3.00, '2022-11-16', 'Active'),
(8, 2, 4, 'Prescription Charge', 0.00, '2022-11-17', 'Active'),
(9, 2, 5, 'Prescription Charge', 0.00, '2022-12-05', 'Active'),
(10, 2, 6, 'Prescription Charge', 3.00, '2022-12-09', 'Active'),
(11, 2, 7, 'Prescription Charge', 5.00, '2022-12-09', 'Active'),
(12, 2, 8, 'Prescription Charge', 0.00, '2023-01-16', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentid` int(10) NOT NULL,
  `departmentname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentid`, `departmentname`, `description`, `status`) VALUES
(1, 'Internal Medicine', 'Internal Medicine', 'Active'),
(2, 'Pharmacy', 'Reviewing Medications', 'Active'),
(3, 'Radiology', 'Diagnostic Radiology', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int(10) NOT NULL,
  `doctorname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `education` varchar(25) NOT NULL,
  `experience` float(11,1) NOT NULL,
  `consultancy_charge` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `doctorname`, `mobileno`, `departmentid`, `loginid`, `password`, `status`, `education`, `experience`, `consultancy_charge`) VALUES
(1, 'Jeffrey De Tomas', '2125798361', 1, 'tomas', '123456789', 'Active', 'MBBS', 7.0, 800.00),
(2, 'Aikee Marvin Lacdao', '09101159346', 2, 'lacdao', '123456789', 'Active', 'BSME', 7.0, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_timings`
--

CREATE TABLE `doctor_timings` (
  `doctor_timings_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `available_day` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineid` int(10) NOT NULL,
  `medicinename` varchar(25) NOT NULL,
  `medicinecost` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineid`, `medicinename`, `medicinecost`, `description`, `status`) VALUES
(1, 'Paracetamol', 3.00, 'For fever per day 1 pc', 'Active'),
(2, 'Mefenamic Acid', 5.00, 'Treat mild to moderate pain', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `prescriptionid` int(10) NOT NULL,
  `orderdate` date NOT NULL,
  `deliverydate` date NOT NULL,
  `address` text NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `card_no` varchar(20) NOT NULL,
  `cvv_no` varchar(5) NOT NULL,
  `expdate` date NOT NULL,
  `card_holder` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `admissiontime` time NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `patientname`, `admissiondate`, `admissiontime`, `address`, `mobileno`, `city`, `pincode`, `loginid`, `password`, `bloodgroup`, `gender`, `dob`, `status`) VALUES
(2, 'Marianne Joyce Alejaga', '2022-11-16', '05:51:47', 'Bgry. Balucuan Dao, Capiz', '09101159346', 'capiz', '', '3', '123456789', '', 'Female', '2009-01-06', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `paiddate` date NOT NULL,
  `paidtime` time NOT NULL,
  `paidamount` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `cardholder` varchar(50) NOT NULL,
  `cardnumber` int(25) NOT NULL,
  `cvvno` int(5) NOT NULL,
  `expdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionid` int(10) NOT NULL,
  `treatment_records_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `delivery_type` varchar(10) NOT NULL COMMENT 'Delivered through appointment or online order',
  `delivery_id` int(10) NOT NULL COMMENT 'appointmentid or orderid',
  `prescriptiondate` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `appointmentid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionid`, `treatment_records_id`, `doctorid`, `patientid`, `delivery_type`, `delivery_id`, `prescriptiondate`, `status`, `appointmentid`) VALUES
(1, 0, 1, 1, '', 0, '2022-11-15', 'Active', 1),
(2, 0, 1, 2, '', 0, '2022-11-16', 'Active', 2),
(3, 0, 1, 2, '', 0, '2022-11-16', 'Active', 2),
(4, 0, 1, 2, '', 0, '2022-11-17', 'Active', 2),
(5, 0, 1, 2, '', 0, '2022-12-05', 'Active', 2),
(6, 0, 1, 2, '', 0, '0000-00-00', 'Active', 2),
(7, 0, 1, 2, '', 0, '0000-00-00', 'Active', 2),
(8, 0, 1, 2, '', 0, '0000-00-00', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_records`
--

CREATE TABLE `prescription_records` (
  `prescription_record_id` int(10) NOT NULL,
  `prescription_id` int(10) NOT NULL,
  `medicine_name` varchar(25) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `unit` int(10) NOT NULL,
  `dosage` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_records`
--

INSERT INTO `prescription_records` (`prescription_record_id`, `prescription_id`, `medicine_name`, `cost`, `unit`, `dosage`, `status`) VALUES
(1, 1, '1', 3.00, 2, '0-1-1', 'Active'),
(2, 2, '2', 5.00, 3, '0-1-1', 'Active'),
(3, 3, '1', 3.00, 1, '1-1-1', 'Active'),
(4, 6, '1', 3.00, 1, '0-1-1 (Take a pill in the', 'Active'),
(5, 7, '2', 5.00, 1, '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(10) NOT NULL,
  `roomtype` varchar(25) NOT NULL,
  `roomno` int(10) NOT NULL,
  `noofbeds` int(10) NOT NULL,
  `room_tariff` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomtype`, `roomno`, `noofbeds`, `room_tariff`, `status`) VALUES
(15, 'GENERAL WARD', 1, 20, 500.00, 'Active'),
(16, 'SPECIAL WARD', 2, 10, 100.00, 'Active'),
(17, 'GENERAL WARD', 2, 10, 500.00, 'Active'),
(18, 'GENERAL WARD', 121, 13, 150.00, 'Active'),
(19, 'GENERAL WARD', 850, 11, 500.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `service_type_id` int(10) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `servicecharge` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`service_type_id`, `service_type`, `servicecharge`, `description`, `status`) VALUES
(10, 'X-ray', 250.00, 'To take fractured photo copy', 'Active'),
(11, 'Scanning', 450.00, 'To scan body from injury', 'Active'),
(12, 'MRI', 300.00, 'Regarding body scan', 'Active'),
(13, 'Blood Testing', 150.00, 'To detect the type of disease', 'Active'),
(14, 'Diagnosis', 210.00, 'To analyse the diagnosis', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumber`
--

CREATE TABLE `tblautonumber` (
  `AutoID` int(11) NOT NULL,
  `AutoStart` varchar(30) NOT NULL,
  `AutoEnd` int(11) NOT NULL,
  `AutoInc` int(11) NOT NULL,
  `AutoType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblautonumber`
--

INSERT INTO `tblautonumber` (`AutoID`, `AutoStart`, `AutoEnd`, `AutoInc`, `AutoType`) VALUES
(1, '2017', 56, 1, 'AuthPrint');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `DepartmentID` int(11) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Description` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `ID` int(11) NOT NULL,
  `EmployeeID` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Firstname` varchar(99) CHARACTER SET latin1 NOT NULL,
  `Lastname` varchar(99) CHARACTER SET latin1 NOT NULL,
  `Middlename` varchar(99) CHARACTER SET latin1 NOT NULL,
  `Address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Gender` varchar(30) CHARACTER SET latin1 NOT NULL,
  `BirthDate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `ContactNo` varchar(30) CHARACTER SET latin1 NOT NULL,
  `EmployeeStatus` varchar(30) CHARACTER SET latin1 NOT NULL,
  `PositionID` int(11) NOT NULL,
  `EmPhoto` varchar(250) CHARACTER SET latin1 NOT NULL,
  `Cand_Status` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`ID`, `EmployeeID`, `Firstname`, `Lastname`, `Middlename`, `Address`, `Gender`, `BirthDate`, `Age`, `ContactNo`, `EmployeeStatus`, `PositionID`, `EmPhoto`, `Cand_Status`) VALUES
(1, '0692453478', 'JOANNA', 'ALEJAGA', 'J.', 'BRGY. BALUCUAN DAO, CAPIZ', 'Female', '1983-06-30', 39, '09300748152', 'Casual', 2, 'photo/joanna.jpg', 'Employee'),
(2, '0689248870', 'KEITH JULENE', 'BOLAÑO', 'B.', 'POB. ILAYA DAO, CAPIZ', 'Female', '1998-10-07', 23, '09998086982', 'Casual', 1, 'photo/kitting.jpg', 'Employee'),
(3, '0692214614', 'YOLANDA', 'FERREN', 'F.', 'SAN JOSE DUMALAG, CAPIZ', 'Female', '1987-01-16', 35, '09469132087', 'Casual', 2, 'photo/dangdang.jpg', 'Employee'),
(4, '0686025460', 'ALDIE', 'MAGBANUA', 'F.', 'BRGY. DUYOC DAO, CAPIZ', 'Male', '1977-01-23', 45, '09484269410', 'Casual', 4, 'photo/aldie.jpg', 'Employee'),
(5, '0692043622', 'DINNAH', 'ARBIS', 'P.', 'BRGY. MANHOY DAO, CAPIZ', 'Female', '1980-08-13', 42, '09284727153', 'Casual', 1, 'photo/dynz.jpg', 'Employee'),
(6, '0690975846', 'MARY GRACE ', 'BUIZON', 'B.', 'POBLACION ILAWOD DAO, CAPIZ', 'Female', '1966-12-11', 55, '09496150953', 'Regular', 1, 'photo/buizon.jpg', ''),
(7, '0693928822', 'JOCYRIE', 'DEOCAMPO', 'D.', 'LACARON DAO, CAPIZ', 'Female', '1999-11-19', 22, '09267045440', 'Casual', 1, 'photo/jocyrie.jpg', ''),
(8, '0691936358', 'ERIKA JOY', 'MARCELINO', 'F. ', 'BRGY. MANGOSO SIGMA, CAPIZ', 'Female', '1995-01-28', 27, '09303532150', 'Casual', 2, 'photo/erika.jpg', ''),
(9, '0698423142', 'CAREN JANE', 'BEDIONES', 'J.', 'POBLACION NORTE SIGMA, CAPIZ', 'Female', '1991-10-21', 31, '09106213750', 'Casual', 1, '', ''),
(10, '0696768102', 'FRANCISCA', 'BIACO', 'F.', 'BGRY. CONSOLACION DUMALAG, CAPIZ', 'Female', '1986-10-03', 36, '09302828100', 'Casual', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `LOGID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `LOGDATETIME` datetime NOT NULL,
  `LOGROLE` varchar(30) NOT NULL,
  `LOGMODE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`LOGID`, `USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) VALUES
(1, 1, '2022-01-24 01:53:37', 'Administrator', 'Logged out'),
(2, 1, '2022-01-24 02:48:48', 'Administrator', 'Logged in'),
(161, 1, '2022-11-08 09:33:28', 'Administrator', 'Logged in'),
(162, 1, '2022-11-08 09:33:47', 'Administrator', 'Logged out'),
(163, 1, '2022-11-08 09:33:52', 'Administrator', 'Logged in'),
(164, 1, '2022-11-08 10:19:29', 'Administrator', 'Logged out'),
(165, 8, '2022-11-08 10:19:40', 'Doctor', 'Logged in'),
(166, 1, '2022-11-08 12:45:32', 'Administrator', 'Logged in'),
(167, 1, '2022-11-08 15:19:29', 'Administrator', 'Logged in'),
(168, 1, '2022-11-09 12:18:28', 'Administrator', 'Logged in'),
(169, 1, '2022-11-09 13:01:11', 'Administrator', 'Logged out'),
(170, 1, '2022-11-09 13:01:15', 'Administrator', 'Logged in'),
(171, 1, '2022-11-09 15:31:29', 'Administrator', 'Logged in'),
(172, 1, '2022-11-10 02:08:19', 'Administrator', 'Logged in'),
(173, 1, '2022-11-12 05:59:20', 'Administrator', 'Logged in'),
(174, 1, '2022-11-14 10:58:44', 'Administrator', 'Logged in'),
(175, 1, '2022-11-15 04:26:30', 'Administrator', 'Logged in'),
(176, 1, '2022-11-15 08:02:54', 'Administrator', 'Logged in'),
(177, 1, '2022-11-15 08:03:05', 'Administrator', 'Logged out'),
(178, 1, '2022-11-15 08:03:12', 'Administrator', 'Logged in'),
(179, 1, '2022-11-15 08:04:20', 'Administrator', 'Logged out'),
(180, 1, '2022-11-15 11:23:36', 'Administrator', 'Logged in'),
(181, 1, '2022-11-15 11:32:16', 'Administrator', 'Logged in'),
(182, 1, '2022-11-15 11:38:54', 'Administrator', 'Logged out'),
(183, 1, '2022-11-15 11:41:07', 'Administrator', 'Logged in'),
(184, 1, '2022-11-15 11:41:35', 'Administrator', 'Logged out'),
(185, 1, '2022-11-15 11:43:45', 'Administrator', 'Logged in'),
(186, 1, '2022-11-15 15:55:49', 'Administrator', 'Logged in'),
(187, 1, '2022-11-16 06:00:09', 'Administrator', 'Logged in'),
(188, 1, '2022-11-16 06:38:38', 'Administrator', 'Logged in'),
(189, 1, '2022-11-19 14:25:12', 'Administrator', 'Logged in'),
(190, 1, '2022-11-22 14:30:58', 'Administrator', 'Logged in'),
(191, 1, '2022-11-29 03:44:15', 'Administrator', 'Logged in'),
(192, 1, '2022-12-07 02:47:21', 'Administrator', 'Logged in'),
(193, 1, '2022-12-07 03:09:06', 'Administrator', 'Logged out'),
(194, 1, '2022-12-09 15:37:42', 'Administrator', 'Logged in'),
(195, 1, '2023-01-15 14:59:53', 'Administrator', 'Logged in');

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE `tblposition` (
  `PositionID` int(11) NOT NULL,
  `PositionCode` varchar(30) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `DepartmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`PositionID`, `PositionCode`, `Description`, `DepartmentID`) VALUES
(1, 'RN', 'NURSE', 1),
(2, 'NA', 'NURSING ATTENDANT / NURSING ASSISTANT / NURSING AIDE', 2),
(3, 'AIDE', 'ADMINISTRATIVE ASSISTANT / ADMINISTRATIVE AIDE', 3),
(4, 'UW', 'UTILITY WORKER', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable`
--

CREATE TABLE `tbltimetable` (
  `TimeTableID` int(11) NOT NULL,
  `EmployeeID` varchar(90) CHARACTER SET latin1 NOT NULL,
  `TimeInAM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `TimeOutAM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `TimeInPM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `TimeOutPM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `AttendDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltimetable`
--

INSERT INTO `tbltimetable` (`TimeTableID`, `EmployeeID`, `TimeInAM`, `TimeOutAM`, `TimeInPM`, `TimeOutPM`, `AttendDate`) VALUES
(1, '0692453478', '', '', '12:39 PM', '12:39 PM', '2022-09-09'),
(2, '0692453478', '', '', '12:49 PM', '12:49 PM', '2022-09-15'),
(3, '0692214614', '', '', '12:57 PM', '12:57 PM', '2022-09-15'),
(4, '0689248870', '', '', '01:44 PM', '01:53 PM', '2022-09-15'),
(5, '0692453478', '', '', '01:43 PM', '01:43 PM', '2022-09-26'),
(6, '0692453478', '', '', '01:19 PM', '01:19 PM', '2022-09-27'),
(7, '0692214614', '', '', '01:21 PM', '01:21 PM', '2022-09-27'),
(8, '0689248870', '', '', '01:24 PM', '01:25 PM', '2022-09-27'),
(9, '0010266936', '', '', '01:26 PM', '01:27 PM', '2022-09-27'),
(10, '0692453478', '', '', '08:40 PM', '08:40 PM', '2022-09-28'),
(11, '0689248870', '', '', '08:41 PM', '08:41 PM', '2022-09-28'),
(12, '0692214614', '', '', '08:59 PM', '', '2022-09-28'),
(13, '0010266936', '', '', '09:03 PM', '', '2022-09-28'),
(14, '0692453478', '', '', '10:49 PM', '10:53 PM', '2022-10-01'),
(15, '0689248870', '', '', '10:55 PM', '10:56 PM', '2022-10-01'),
(16, '0692214614', '', '', '10:59 PM', '11:00 PM', '2022-10-01'),
(17, '0689248870', '', '', '09:23 PM', '09:24 PM', '2022-10-10'),
(18, '0692214614', '', '', '09:28 PM', '09:29 PM', '2022-10-10'),
(19, '0692453478', '', '', '09:34 PM', '09:34 PM', '2022-10-10'),
(20, '0010266936', '', '', '09:37 PM', '09:37 PM', '2022-10-10'),
(21, '0689248870', '', '', '10:07 PM', '10:08 PM', '2022-10-11'),
(22, '0692453478', '', '', '10:09 PM', '10:09 PM', '2022-10-11'),
(23, '0692214614', '', '', '10:14 PM', '10:14 PM', '2022-10-11'),
(24, '0010266936', '', '', '11:13 PM', '11:13 PM', '2022-10-11'),
(25, '0692453478', '', '', '10:09 PM', '10:10 PM', '2022-10-12'),
(26, '0692453478', '', '', '04:08 PM', '04:08 PM', '2022-11-03'),
(27, '0692453478', '', '', '10:31 PM', '10:44 PM', '2022-11-09'),
(28, '0686025460', '', '', '10:47 PM', '10:48 PM', '2022-11-09'),
(29, '0686025460', '', '', '10:47 PM', '10:48 PM', '2022-11-09'),
(30, '0686025460', '', '', '10:47 PM', '10:48 PM', '2022-11-09'),
(31, '0686025460', '', '', '10:47 PM', '10:48 PM', '2022-11-09'),
(32, '0686025460', '', '', '10:48 PM', '10:48 PM', '2022-11-09'),
(33, '0692043622', '', '', '10:49 PM', '10:49 PM', '2022-11-09'),
(34, '0692214614', '', '', '10:50 PM', '10:51 PM', '2022-11-09'),
(35, '0689248870', '', '', '10:52 PM', '10:53 PM', '2022-11-09'),
(36, '0692453478', '09:10 AM', '09:11 AM', '', '', '2022-11-10'),
(37, '0692453478', '09:11 AM', '09:11 AM', '', '', '2022-11-10'),
(38, '0689248870', '09:18 AM', '09:18 AM', '', '', '2022-11-10'),
(39, '0689248870', '09:18 AM', '09:18 AM', '', '', '2022-11-10'),
(40, '0692214614', '09:20 AM', '09:20 AM', '', '', '2022-11-10'),
(41, '0692214614', '09:20 AM', '09:20 AM', '', '', '2022-11-10'),
(42, '0686025460', '09:21 AM', '09:21 AM', '', '', '2022-11-10'),
(43, '0686025460', '09:21 AM', '09:21 AM', '', '', '2022-11-10'),
(44, '0692043622', '09:27 AM', '09:27 AM', '', '', '2022-11-10'),
(45, '0692043622', '09:27 AM', '09:27 AM', '', '', '2022-11-10'),
(46, '0689248870', '10:00 AM', '', '', '', '2022-11-10'),
(47, '0692453478', '10:05 AM', '', '', '', '2022-11-10'),
(48, '0692043622', '10:32 AM', '', '', '', '2022-11-10'),
(49, '0692453478', '11:26 AM', '11:27 AM', '06:35 PM', '06:33 PM', '2022-11-15'),
(50, '0692214614', '', '', '03:03 PM', '03:03 PM', '2022-11-15'),
(51, '0689248870', '', '', '06:33 PM', '06:37 PM', '2022-11-15'),
(52, '0686025460', '', '', '06:33 PM', '06:33 PM', '2022-11-15'),
(53, '0692043622', '', '', '06:33 PM', '06:33 PM', '2022-11-15'),
(54, '0690975846', '', '', '06:33 PM', '06:33 PM', '2022-11-15'),
(55, '0693928822', '', '', '06:33 PM', '06:34 PM', '2022-11-15'),
(56, '0691936358', '', '', '06:34 PM', '06:34 PM', '2022-11-15'),
(57, '0698423142', '', '', '06:34 PM', '06:34 PM', '2022-11-15'),
(58, '0696768102', '', '', '06:34 PM', '06:34 PM', '2022-11-15'),
(59, '0692453478', '', '', '01:01 PM', '01:01 PM', '2022-11-16'),
(60, '0692214614', '', '', '01:01 PM', '01:01 PM', '2022-11-16'),
(61, '0689248870', '', '', '01:01 PM', '01:01 PM', '2022-11-16'),
(62, '0686025460', '', '', '01:01 PM', '', '2022-11-16'),
(63, '0692043622', '', '', '01:01 PM', '', '2022-11-16'),
(64, '0690975846', '', '', '01:01 PM', '01:02 PM', '2022-11-16'),
(65, '0693928822', '', '', '01:02 PM', '01:02 PM', '2022-11-16'),
(66, '0691936358', '', '', '01:02 PM', '01:02 PM', '2022-11-16'),
(67, '0698423142', '', '', '01:02 PM', '01:02 PM', '2022-11-16'),
(68, '0696768102', '', '', '01:02 PM', '', '2022-11-16'),
(69, '0689248870', '10:44 AM', '10:44 AM', '', '', '2022-11-29'),
(70, '0689248870', '10:44 AM', '10:44 AM', '', '', '2022-11-29'),
(71, '0692453478', '', '', '10:40 PM', '10:40 PM', '2022-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `tblverifytimeintimeout`
--

CREATE TABLE `tblverifytimeintimeout` (
  `VerifyID` int(11) NOT NULL,
  `EmployeeID` varchar(90) CHARACTER SET latin1 NOT NULL,
  `TimeIn` varchar(30) CHARACTER SET latin1 NOT NULL,
  `TimeOut` varchar(30) CHARACTER SET latin1 NOT NULL,
  `Verification` varchar(30) CHARACTER SET latin1 NOT NULL,
  `DateValidation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblverifytimeintimeout`
--

INSERT INTO `tblverifytimeintimeout` (`VerifyID`, `EmployeeID`, `TimeIn`, `TimeOut`, `Verification`, `DateValidation`) VALUES
(1, '0010266936', '11:13 PM', '11:13 PM', 'TimeIn', '2022-10-11'),
(2, '0689248870', '10:44 AM', '10:44 AM', 'TimeIn', '2022-11-29'),
(3, '0692453478', '10:40 PM', '10:40 PM', 'TimeIn', '2022-12-09'),
(4, '0692214614', '01:39 PM', '01:39 PM', 'TimeIn', '2022-11-16'),
(5, '0686025460', '01:01 PM', '01:01 PM', 'TimeIn', '2022-11-16'),
(6, '0692043622', '01:01 PM', '01:01 PM', 'TimeIn', '2022-11-16'),
(7, '0690975846', '01:01 PM', '01:01 PM', 'TimeIn', '2022-11-16'),
(8, '0693928822', '01:02 PM', '01:02 PM', 'TimeIn', '2022-11-16'),
(9, '0691936358', '01:02 PM', '01:02 PM', 'TimeIn', '2022-11-16'),
(10, '0698423142', '01:02 PM', '01:02 PM', 'TimeIn', '2022-11-16'),
(11, '0696768102', '01:02 PM', '01:02 PM', 'TimeIn', '2022-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatmentid` int(10) NOT NULL,
  `treatmenttype` varchar(25) NOT NULL,
  `treatment_cost` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatmentid`, `treatmenttype`, `treatment_cost`, `note`, `status`) VALUES
(20, 'Blood test', '300.00', 'total IgE', 'Active'),
(21, 'X Ray', '200.00', 'X Ray @200', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_records`
--

CREATE TABLE `treatment_records` (
  `treatment_records_id` int(10) NOT NULL,
  `treatmentid` int(10) NOT NULL,
  `appointmentid` int(10) NOT NULL,
  `patientid` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `treatment_description` text NOT NULL,
  `uploads` varchar(100) NOT NULL,
  `treatment_date` date NOT NULL,
  `treatment_time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_records`
--

INSERT INTO `treatment_records` (`treatment_records_id`, `treatmentid`, `appointmentid`, `patientid`, `doctorid`, `treatment_description`, `uploads`, `treatment_date`, `treatment_time`, `status`) VALUES
(1, 20, 1, 1, 1, 'Test your Blood', '1015614602', '2022-11-15', '22:03:00', 'Active'),
(2, 20, 2, 2, 1, 'test your blood', '387889831', '2022-11-16', '12:54:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `loginname` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createddateandtime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `loginname`, `password`, `patientname`, `mobileno`, `email`, `createddateandtime`) VALUES
(1, 'user', 'admin', 'Nezuko', '', '', '2022-02-09 11:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `ACCOUNT_ID` int(11) NOT NULL,
  `ACCOUNT_NAME` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ACCOUNT_USERNAME` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ACCOUNT_PASSWORD` text CHARACTER SET latin1 NOT NULL,
  `ACCOUNT_TYPE` varchar(30) CHARACTER SET latin1 NOT NULL,
  `EMPID` int(11) NOT NULL,
  `USERIMAGE` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`, `EMPID`, `USERIMAGE`) VALUES
(1, 'Marianne Joyce Alejaga', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1234, 'photos/import2.png'),
(2, 'Dr. Aura Bree Dayo - Lacdao', 'dayo', '241aa33f629fbd977e478ce7b884a29814d06e11', 'Doctor', 0, ''),
(3, 'Dr. Aikee Marvin Lacdao', 'lacdao', 'ffb222bdffc875fb24eee3cf19f35c892b580422', 'Doctor', 0, ''),
(4, 'Dr. Mark Christian Agase', 'agase', '574676bc37bf08f74e15ff61f0e9b781215f5f9b', 'Doctor', 0, ''),
(5, 'Dr. Jerry Mae Blasurca', 'blasurca', '792bd51503a251804d7394131aaa7e62ae1f878b', 'Doctor', 0, ''),
(6, 'Dr. Jefrrey De Tomas', 'tomas', '2bc6038c3dfca09b2da23c8b6da8ba884dc2dcc2', 'Doctor', 0, ''),
(7, 'Dr. Gessele S. Cabilitasan', 'cabilitasan', 'ac7bdd94d25ff7c0eeac1ca4085973ef8ee2d530', 'Doctor', 0, ''),
(8, 'Dr. Eric D. Aguro', 'aguro', 'd83981141fd82f21dec5f836c563ea81f61be657', 'Doctor', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `adminname` (`adminname`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentid`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billingid`);

--
-- Indexes for table `billing_records`
--
ALTER TABLE `billing_records`
  ADD PRIMARY KEY (`billingservice_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`);

--
-- Indexes for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  ADD PRIMARY KEY (`doctor_timings_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`),
  ADD KEY `loginid` (`loginid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionid`);

--
-- Indexes for table `prescription_records`
--
ALTER TABLE `prescription_records`
  ADD PRIMARY KEY (`prescription_record_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`service_type_id`);

--
-- Indexes for table `tblautonumber`
--
ALTER TABLE `tblautonumber`
  ADD PRIMARY KEY (`AutoID`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`LOGID`);

--
-- Indexes for table `tblposition`
--
ALTER TABLE `tblposition`
  ADD PRIMARY KEY (`PositionID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `tbltimetable`
--
ALTER TABLE `tbltimetable`
  ADD PRIMARY KEY (`TimeTableID`);

--
-- Indexes for table `tblverifytimeintimeout`
--
ALTER TABLE `tblverifytimeintimeout`
  ADD PRIMARY KEY (`VerifyID`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatmentid`);

--
-- Indexes for table `treatment_records`
--
ALTER TABLE `treatment_records`
  ADD PRIMARY KEY (`treatment_records_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billingid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing_records`
--
ALTER TABLE `billing_records`
  MODIFY `billingservice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  MODIFY `doctor_timings_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prescription_records`
--
ALTER TABLE `prescription_records`
  MODIFY `prescription_record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `service_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `AutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `LOGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `tblposition`
--
ALTER TABLE `tblposition`
  MODIFY `PositionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbltimetable`
--
ALTER TABLE `tbltimetable`
  MODIFY `TimeTableID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tblverifytimeintimeout`
--
ALTER TABLE `tblverifytimeintimeout`
  MODIFY `VerifyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `treatment_records`
--
ALTER TABLE `treatment_records`
  MODIFY `treatment_records_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
