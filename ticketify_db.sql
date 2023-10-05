-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 04:58 PM
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
-- Database: `ticketify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `ID` int(11) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `SPR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`ID`, `Type`, `Capacity`, `SPR`) VALUES
(1, 'Standard', 36, 4),
(2, 'VIP', 23, 3);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`ID`, `Name`) VALUES
(1, 'Yangon'),
(2, 'Mandalay'),
(3, 'Lashio');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `Name`, `Phone`, `Email`, `Password`) VALUES
(1, 'Thura Win', '+959441045925', 'thurawin.404@gmail.com', 'Thura'),
(2, 'Phyo', '+37483748738', 't@gmail.com', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Father` varchar(30) NOT NULL,
  `Mother` varchar(30) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Marital` varchar(30) NOT NULL,
  `Position` varchar(30) NOT NULL,
  `Ph` varchar(30) NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `NRC` varchar(30) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Reg_Date` date NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `Name`, `Father`, `Mother`, `Gender`, `Marital`, `Position`, `Ph`, `Birthday`, `Email`, `Password`, `NRC`, `Address`, `Reg_Date`, `Photo`) VALUES
(1, 'Thura Win', 'Mg Mg Win', 'Moe Moe Lwin', 'Male', 'Single', 'Manager', '+959441045925', '2002-10-28', 'thurawin.404@gmail.com', 'Thura', '9/AhMaZa(N)076141', 'Bet 20 and 21 Street, 81 Street, Mandalay.', '2023-03-17', 'StaffPhotos/1_Thura Win.png'),
(2, 'Phyu Phyu', 'U Kyaw', 'Daw Pu', 'Female', 'Single', 'Front Desk', '+95991045925', '2002-10-28', 'phyu@email.com', 'Phyu', '9/AhMaZa(N)076141', 'Yangon', '2023-03-17', 'StaffPhotos/2_Phyu Phyu.png');

-- --------------------------------------------------------

--
-- Table structure for table `nrc`
--

CREATE TABLE `nrc` (
  `No` int(11) NOT NULL,
  `Code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nrc`
--

INSERT INTO `nrc` (`No`, `Code`) VALUES
(1, 'AhGaYa'),
(1, 'AhTaNa'),
(1, 'BhaMaNa'),
(1, 'DaPhaYa'),
(1, 'HaPaNa'),
(1, 'KaMaNa'),
(1, 'KaMaTa'),
(1, 'KaPaTa'),
(1, 'KhaLaPha'),
(1, 'KhaPhaNa'),
(1, 'LaGaNa'),
(1, 'MaGaDa'),
(1, 'MaKaNa'),
(1, 'MaKaTa'),
(1, 'MaKaTha'),
(1, 'MaKhaBa'),
(1, 'MaLaNa'),
(1, 'MaMaNa'),
(1, 'MaNyaNa'),
(1, 'MaSaNa'),
(1, 'MaTaNa'),
(1, 'NaMaNa'),
(1, 'PaMaNa'),
(1, 'PaNaDa'),
(1, 'PaTaAh'),
(1, 'PaWaNa'),
(1, 'PhaKaNa'),
(1, 'SaBaNa'),
(1, 'SaBaTa'),
(1, 'SaDaNa'),
(1, 'SaKaNa'),
(1, 'SaLaNa'),
(1, 'SaPaBa'),
(1, 'TaNaNa'),
(1, 'WaMaNa'),
(1, 'YaBaYa'),
(1, 'YaKaNa'),
(2, 'BaLaKha'),
(2, 'DaMaSa'),
(2, 'HtaTaPa'),
(2, 'KhaSana'),
(2, 'LaKaNa'),
(2, 'MaSaNa'),
(2, 'MaYaMa'),
(2, 'PhaLaSa'),
(2, 'PhaSaNa'),
(2, 'PhaYaSa'),
(2, 'SaSaNa'),
(2, 'YaTaNa'),
(2, 'YaThaNa'),
(3, 'BaAhNa'),
(3, 'BaGaLa'),
(3, 'BaKaLa'),
(3, 'BaThaSa'),
(3, 'KaDaNa'),
(3, 'KaKaYa'),
(3, 'KaMaMa'),
(3, 'KaSaKa'),
(3, 'KaTaKha'),
(3, 'LaBaNa'),
(3, 'LaThaNa'),
(3, 'MaSaLa'),
(3, 'MaWaTa'),
(3, 'PaKaNa'),
(3, 'PhaAhNa'),
(3, 'PhaPaNa'),
(3, 'SaKaLa'),
(3, 'ThaTaKa'),
(3, 'ThaTaNa'),
(3, 'WaLaMa'),
(3, 'YaYaTha'),
(4, 'HaKhaNa'),
(4, 'HtaTaLa'),
(4, 'KaKhaNa'),
(4, 'KaPaLa'),
(4, 'MaTaNa'),
(4, 'MaTaPa'),
(4, 'PaLaWa'),
(4, 'PhaLaNa'),
(4, 'SaMaNa'),
(4, 'TaTaNa'),
(4, 'TaZaNa'),
(4, 'YaKhaDa'),
(4, 'YaZaNa'),
(5, 'AhHtaNa'),
(5, 'AhMaZa'),
(5, 'AhTaNa'),
(5, 'AhYaTa'),
(5, 'BaTaLa'),
(5, 'BhaMaNa'),
(5, 'DaHaNa'),
(5, 'DaKaNa'),
(5, 'DaPaYa'),
(5, 'HaMaLa'),
(5, 'HtaKhaNa'),
(5, 'HtaPaKha'),
(5, 'KaBaLa'),
(5, 'KaLaHta'),
(5, 'KaLaNa'),
(5, 'KaLaTa'),
(5, 'KaLaTha'),
(5, 'KaLaWa'),
(5, 'KaMaNa'),
(5, 'KaNaWah'),
(5, 'KaSaLa'),
(5, 'KaThaNa'),
(5, 'KhaAuNa'),
(5, 'KhaAuTa'),
(5, 'KhaPaNa'),
(5, 'KhaTaNa'),
(5, 'LaHaNa'),
(5, 'LaYaNa'),
(5, 'MaKaNa'),
(5, 'MaLaNa'),
(5, 'MaMaNa'),
(5, 'MaMaTa'),
(5, 'MaPaLa'),
(5, 'MaThaNa'),
(5, 'MaYaNa'),
(5, 'NaYaNa'),
(5, 'NgaSaNa'),
(5, 'PaLaBa'),
(5, 'PaSaNa'),
(5, 'PhaPaNa'),
(5, 'SaKaNa'),
(5, 'SaLaKa'),
(5, 'SaMaYa'),
(5, 'TaAuNa'),
(5, 'TaMaNa'),
(5, 'TaSaNa'),
(5, 'WaLaNa'),
(5, 'WaThaNa'),
(5, 'YaAuNa'),
(5, 'YaBaNa'),
(5, 'YaMaPa'),
(6, 'AhMaYa'),
(6, 'BaPaNa'),
(6, 'HaThaTa'),
(6, 'HtaWaNa'),
(6, 'KaLaAh'),
(6, 'KaPaNa'),
(6, 'KaSaNa'),
(6, 'KaThaMa'),
(6, 'KaThaNa'),
(6, 'KaYaYa'),
(6, 'KhaMaKa'),
(6, 'LaLaNa'),
(6, 'MaAaNa'),
(6, 'MaAhYa'),
(6, 'MaMaLa'),
(6, 'MaMaNa'),
(6, 'MaTaNa'),
(6, 'PaKaMa'),
(6, 'PaLaNa'),
(6, 'PaLaTa'),
(6, 'TaNaTha'),
(6, 'ThaTaYa'),
(6, 'ThaYaKha'),
(6, 'YaPhaNa'),
(7, 'AhPhaNa'),
(7, 'AuTaNa'),
(7, 'DaAuNa'),
(7, 'HtaTaPa'),
(7, 'KaKaNa'),
(7, 'KaPaKa'),
(7, 'KaTaKha'),
(7, 'KaTaNa'),
(7, 'KaTaTa'),
(7, 'KaWaNa'),
(7, 'LaPaTa'),
(7, 'MaDaNa'),
(7, 'MaLaNa'),
(7, 'MaNyaNa'),
(7, 'MaWaTa'),
(7, 'NaTaLa'),
(7, 'NyaLaPa'),
(7, 'PaKhaNa'),
(7, 'PaKhaTa'),
(7, 'PaMaNa'),
(7, 'PaNaKa'),
(7, 'PaSaTa'),
(7, 'PaTaLa'),
(7, 'PaTaNa'),
(7, 'PaTaSa'),
(7, 'PaTaTa'),
(7, 'PhaMaNa'),
(7, 'TaNgaNa'),
(7, 'ThaKaNa'),
(7, 'ThaNaPa'),
(7, 'ThaNaSa'),
(7, 'ThaWaTa'),
(7, 'WaMaNa'),
(7, 'YaKaNa'),
(7, 'YaTaNa'),
(7, 'YaTaYa'),
(7, 'ZaKaNa'),
(8, 'AhLaNa'),
(8, 'BaKaLa'),
(8, 'GaGaNa'),
(8, 'HtaLaNa'),
(8, 'KaHtaNa'),
(8, 'KaMaNa'),
(8, 'KhaMaNa'),
(8, 'MaBaNa'),
(8, 'MaGaDa'),
(8, 'MaHtaLa'),
(8, 'MaHtaNa'),
(8, 'MaKaNa'),
(8, 'MaLaNa'),
(8, 'MaMaNa'),
(8, 'MaTaNa'),
(8, 'MaThaNa'),
(8, 'MaYaSa'),
(8, 'NaMaNa'),
(8, 'NgaPhaNa'),
(8, 'PaKhaKa'),
(8, 'PaMaNa'),
(8, 'PaPhaNa'),
(8, 'SaKaNa'),
(8, 'SaLaNa'),
(8, 'SaMaNa'),
(8, 'SaPaWa'),
(8, 'SaPhaNa'),
(8, 'SaTaYa'),
(8, 'TaTaKa'),
(8, 'ThaYaNa'),
(8, 'YaNaKa'),
(8, 'YaNaKha'),
(8, 'YaSaKa'),
(9, 'AhKhaNa'),
(9, 'AhMaBa'),
(9, 'AhMaYa'),
(9, 'AhMaZa'),
(9, 'AhSaNa'),
(9, 'AhYaTa'),
(9, 'AuTaTha'),
(9, 'DaKhaTha'),
(9, 'KaMaNa'),
(9, 'KaPaTa'),
(9, 'KaSaNa'),
(9, 'KhaAhZa'),
(9, 'KhaMaKha'),
(9, 'KhaMaMa'),
(9, 'KhaMaNa'),
(9, 'KhaMaSa'),
(9, 'KhaMaTha'),
(9, 'KhaMaZa'),
(9, 'LaKaNa'),
(9, 'LaWaNa'),
(9, 'MaHaMa'),
(9, 'MaHtaLa'),
(9, 'MaKaKha'),
(9, 'MaKaNa'),
(9, 'MaKhaNa'),
(9, 'MaLaNa'),
(9, 'MaMaNa'),
(9, 'MaNaMa'),
(9, 'MaNaTa'),
(9, 'MaSaNa'),
(9, 'MaTaLa'),
(9, 'MaTaNa'),
(9, 'MaTaYa'),
(9, 'MaThaNa'),
(9, 'MaYaMa'),
(9, 'MaYaTa'),
(9, 'NaHtaKa'),
(9, 'NaMaNa'),
(9, 'NaNaMa'),
(9, 'NaTaKa'),
(9, 'NgaThaYa'),
(9, 'NgaZaNa'),
(9, 'NyaAuNa'),
(9, 'PaAuLa'),
(9, 'PaBaNa'),
(9, 'PaBaTha'),
(9, 'PaKaKha'),
(9, 'PaKhaKa'),
(9, 'PaKhaMa'),
(9, 'PaMaNa'),
(9, 'PaThaKa'),
(9, 'SaKaNa'),
(9, 'SaKaTa'),
(9, 'TaKaNa'),
(9, 'TaKaTa'),
(9, 'TaTaAu'),
(9, 'TaThaNa'),
(9, 'ThaPaKa'),
(9, 'ThaSaNa'),
(9, 'ThaTaYa'),
(9, 'ThaWaNa'),
(9, 'WaTaNa'),
(9, 'YaAuNa'),
(9, 'YaMaTha'),
(9, 'ZaBaTha'),
(9, 'ZaYaTha'),
(10, 'BaAhNa'),
(10, 'BaLaNa'),
(10, 'HtaHtaNa'),
(10, 'KaHtaNa'),
(10, 'KaKhaMa'),
(10, 'KaMaLa'),
(10, 'KaMaYa'),
(10, 'KhaSaNa'),
(10, 'KhaZaNa'),
(10, 'LaMaNa'),
(10, 'MaDaNa'),
(10, 'MaLaMa'),
(10, 'MaSaNa'),
(10, 'PaMaNa'),
(10, 'PhaPaNa'),
(10, 'ThaHtaNa'),
(10, 'ThaPhaYa'),
(10, 'YaMaNa'),
(11, 'AhMaNa'),
(11, 'BaThaTa'),
(11, 'GaMaNa'),
(11, 'KaPhaNa'),
(11, 'KaTaLa'),
(11, 'KaTaNa'),
(11, 'LaMaTa'),
(11, 'MaAhNa'),
(11, 'MaAhTa'),
(11, 'MaAuNa'),
(11, 'MaMaNa'),
(11, 'MaPaNa'),
(11, 'MaPaTa'),
(11, 'MaTaNa'),
(11, 'PaNaKa'),
(11, 'PaNaTa'),
(11, 'PaTaNa'),
(11, 'SaTaNa'),
(11, 'TaKaNa'),
(11, 'TaPaWa'),
(11, 'ThaTaNa'),
(11, 'YaBhaNa'),
(11, 'YaTaNa'),
(11, 'YaTaTha'),
(11, 'YaThaTa'),
(12, 'AhLaNa'),
(12, 'AhSaNa'),
(12, 'AuKaMa'),
(12, 'AuKaTa'),
(12, 'BhaHaNa'),
(12, 'BhaTaHta'),
(12, 'DaGaMa'),
(12, 'DaGaNa'),
(12, 'DaGaSa'),
(12, 'DaGaTa'),
(12, 'DaGaYa'),
(12, 'DaLaNa'),
(12, 'DaPaNa'),
(12, 'HtaTaPa'),
(12, 'KaKaKa'),
(12, 'KaKhaKa'),
(12, 'KaMaNa'),
(12, 'KaMaTa'),
(12, 'KaMaYa'),
(12, 'KaTaNa'),
(12, 'KaTaTa'),
(12, 'KhaYaNa'),
(12, 'LaKaNa'),
(12, 'LaMaNa'),
(12, 'LaMaTa'),
(12, 'LaThaNa'),
(12, 'LaThaYa'),
(12, 'MaAuKa'),
(12, 'MaBaNa'),
(12, 'MaGaDa'),
(12, 'MaGaTa'),
(12, 'MaYaKa'),
(12, 'PaBaTa'),
(12, 'PaZaTa'),
(12, 'SaKaKha'),
(12, 'SaKaNa'),
(12, 'SaKhaNa'),
(12, 'TaAuKa'),
(12, 'TaKaNa'),
(12, 'TaMaNa'),
(12, 'TaTaHta'),
(12, 'TaTaNa'),
(12, 'ThaGaKa'),
(12, 'ThaKaTa'),
(12, 'ThaKhaNa'),
(12, 'ThaLaNa'),
(12, 'YaKaNa'),
(12, 'YaPaTha'),
(13, 'HaMaNa'),
(13, 'HaPaNa'),
(13, 'KaHaNa'),
(13, 'KaKaNa'),
(13, 'KaKhaNa'),
(13, 'KaLaNa'),
(13, 'KaMaNa'),
(13, 'KaTaLa'),
(13, 'KaTaNa'),
(13, 'KaThaNa'),
(13, 'KhaLaNa'),
(13, 'KhaYaHa'),
(13, 'LaKaNa'),
(13, 'LaKhaNa'),
(13, 'LaLaNa'),
(13, 'LaYaNa'),
(13, 'MaBaNa'),
(13, 'MaHaYa'),
(13, 'MaHtaTa'),
(13, 'MaKaNa'),
(13, 'MaKhaNa'),
(13, 'MaKhaTa'),
(13, 'MaLaNa'),
(13, 'MaMaNa'),
(13, 'MaNaNa'),
(13, 'MaNgaNa'),
(13, 'MaPaNa'),
(13, 'MaPhaNa'),
(13, 'MaPhaTa'),
(13, 'MaSaNa'),
(13, 'MaSaTa'),
(13, 'MaTaNa'),
(13, 'MaYaNa'),
(13, 'MaYaTa'),
(13, 'NaKhaNa'),
(13, 'NaKhaTa'),
(13, 'NaMaTa'),
(13, 'NaPhaNa'),
(13, 'NaSaNa'),
(13, 'NaTaNa'),
(13, 'NyaYaNa'),
(13, 'PaLaNa'),
(13, 'PaPaKa'),
(13, 'PaSaNa'),
(13, 'PaTaYa'),
(13, 'PaWaNa'),
(13, 'PhaKhaNa'),
(13, 'SaSaNa'),
(13, 'TaKaNa'),
(13, 'TaMaNya'),
(13, 'TaTaNa'),
(13, 'TaYaNa'),
(13, 'ThaKhaLa'),
(13, 'ThaNaNa'),
(13, 'ThaPaNa'),
(13, 'WaKaNa'),
(13, 'YaNgaNa'),
(13, 'YaNyaNa'),
(13, 'YaSaNa'),
(14, 'AhGaPa'),
(14, 'AhMaNa'),
(14, 'AhMaTa'),
(14, 'AhPaNa'),
(14, 'AhSaNa'),
(14, 'BaKaLa'),
(14, 'DaDaYa'),
(14, 'DaNaPha'),
(14, 'HaKaKa'),
(14, 'HaThaTa'),
(14, 'KaKaHta'),
(14, 'KaKaNa'),
(14, 'KaKhaNa'),
(14, 'KaLaNa'),
(14, 'KaMaNa'),
(14, 'KaMaTha'),
(14, 'KaPaNa'),
(14, 'LaMaNa'),
(14, 'LaPaTa'),
(14, 'MaAhBa'),
(14, 'MaAhNa'),
(14, 'MaMaKa'),
(14, 'MaMaNa'),
(14, 'MaYaKa'),
(14, 'NgaPaTa'),
(14, 'NgaSaNa'),
(14, 'NgaThaKha'),
(14, 'NgaYaKa'),
(14, 'NyaTaNa'),
(14, 'PaKaKha'),
(14, 'PaSaLa'),
(14, 'PaTaNa'),
(14, 'PaThaNa'),
(14, 'PaThaYa'),
(14, 'PhaPaNa'),
(14, 'TaMaNa'),
(14, 'ThaPaNa'),
(14, 'WaKhaMa'),
(14, 'YaKaNa'),
(14, 'YaThaYa'),
(14, 'ZaLaNa');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `ID` int(11) NOT NULL,
  `Photo` varchar(300) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`ID`, `Photo`, `Name`) VALUES
(1, 'OperatorPhotos/1_Shwe Mandalar.png', 'Shwe Mandalar'),
(2, 'OperatorPhotos/2_Myat Mandalar Htun.png', 'Myat Mandalar Htun'),
(3, 'OperatorPhotos/3_GI Group.png', 'GI Group');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `ID` int(11) NOT NULL,
  `TicketID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Customer` varchar(50) NOT NULL,
  `Ph` varchar(30) NOT NULL,
  `NRC` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`ID`, `TicketID`, `Date`, `Customer`, `Ph`, `NRC`) VALUES
(1, 1, '2023-04-19', 'Thura Win', '+959441045925', NULL),
(2, 6, '2023-04-19', 'Thura Win', '+959441045925', NULL),
(3, 6, '2023-04-22', 'Thura Win', '+959441045925', '9/MaYaMa(N)076141'),
(4, 5, '2023-04-22', 'Thura Win', '+959441045925', '13/LaYaNa(E)000397'),
(5, 1, '2023-04-23', 'Thura Win', '+959441045925', '9/AhMaZa(N)076141'),
(6, 2, '2023-04-29', 'Phyo Si Thu', '+9876238746', '9/NgaThaYa(N)973497'),
(7, 1, '2023-04-29', 'Thura Win', '+959441045925', '9/AhMaZa(N)076141'),
(8, 1, '2023-04-29', 'Thura Win', '+959441045925', '9/AhMaZa(N)076141'),
(9, 1, '2023-04-29', 'Thura Win', '+959441045925', '9/AhMaZa(N)076141'),
(10, 1, '2023-05-03', 'Thura Win', '+959441045925', '9/AhMaZa(N)076141');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `ID` int(11) NOT NULL,
  `Seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`ID`, `Seat`) VALUES
(1, 1),
(1, 5),
(1, 9),
(2, 16),
(2, 20),
(2, 24),
(3, 17),
(4, 1),
(4, 5),
(4, 9),
(5, 1),
(5, 5),
(5, 9),
(6, 4),
(6, 5),
(6, 6),
(7, 1),
(7, 5),
(8, 2),
(8, 6),
(9, 4),
(9, 7),
(10, 4),
(10, 5),
(10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ID` int(11) NOT NULL,
  `TripID` int(11) NOT NULL,
  `BusID` int(11) NOT NULL,
  `OperatorID` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ID`, `TripID`, `BusID`, `OperatorID`, `Price`) VALUES
(1, 1, 1, 1, 25000),
(2, 2, 1, 1, 25000),
(3, 3, 2, 1, 40000),
(4, 4, 2, 1, 40000),
(5, 5, 2, 2, 40000),
(6, 6, 1, 3, 25000),
(7, 7, 2, 2, 33000),
(8, 10, 2, 1, 35000),
(9, 1, 1, 2, 25000),
(10, 1, 2, 2, 35000),
(11, 1, 1, 3, 25000),
(12, 1, 2, 3, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `ID` int(11) NOT NULL,
  `DCity` int(11) NOT NULL,
  `ACity` int(11) NOT NULL,
  `DTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`ID`, `DCity`, `ACity`, `DTime`) VALUES
(1, 1, 2, '08:00:00'),
(2, 1, 2, '09:00:00'),
(3, 1, 2, '18:00:00'),
(4, 1, 2, '19:00:00'),
(5, 3, 2, '18:00:00'),
(6, 3, 1, '21:00:00'),
(7, 2, 1, '07:00:00'),
(8, 2, 1, '08:00:00'),
(9, 2, 1, '19:00:00'),
(10, 2, 1, '18:00:00'),
(11, 1, 3, '08:00:00'),
(12, 2, 3, '09:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nrc`
--
ALTER TABLE `nrc`
  ADD PRIMARY KEY (`No`,`Code`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TicketID` (`TicketID`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`ID`,`Seat`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TripID` (`TripID`),
  ADD KEY `BusID` (`BusID`),
  ADD KEY `OperatorID` (`OperatorID`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DCity` (`DCity`),
  ADD KEY `ACity` (`ACity`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`TicketID`) REFERENCES `ticket` (`ID`);

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `purchase` (`ID`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`TripID`) REFERENCES `trip` (`ID`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`BusID`) REFERENCES `bus` (`ID`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`OperatorID`) REFERENCES `operator` (`ID`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`DCity`) REFERENCES `city` (`ID`),
  ADD CONSTRAINT `trip_ibfk_2` FOREIGN KEY (`ACity`) REFERENCES `city` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
