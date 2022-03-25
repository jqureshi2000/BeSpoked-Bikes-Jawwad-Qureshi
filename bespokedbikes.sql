-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 08:43 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bespokedbikes`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `StartDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `LastName`, `Address`, `Phone`, `StartDate`) VALUES
(1, 'Vicki', 'Alexander', '3382 B Street', '6516292326', '2022-03-24'),
(2, 'Luisa', 'Wyatt', '1255 Longview Avenue', '7185856206', '2022-01-03'),
(3, 'Edward', 'Painter', '1978 Butternut lane', '6185313228', '2020-09-16'),
(4, 'Mina ', 'Wehr', '521 Prospect Street', '8567129696', '2016-05-25'),
(5, 'Antonio', 'Stevens', '3513 Fidler Drive', '2105996332', '2015-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `DiscountID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `BeginDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `DiscountPercentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Manufacturer` varchar(45) NOT NULL,
  `Style` varchar(45) NOT NULL,
  `PurchasePrice` decimal(10,2) NOT NULL,
  `SalePrice` decimal(10,2) NOT NULL,
  `QtyOnHand` int(11) NOT NULL,
  `CommissionPercentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Manufacturer`, `Style`, `PurchasePrice`, `SalePrice`, `QtyOnHand`, `CommissionPercentage`) VALUES
(1, 'Speedster Gravel 30', 'Scott', 'Speedster', '2199.99', '3499.99', 5, '0.04'),
(2, 'Slash 7', 'Trek', 'Mountain', '3829.99', '4999.99', 2, '0.05'),
(3, 'Confessa 16', 'Scott', 'BMX', '269.99', '349.99', 10, '0.01'),
(4, 'Townie Original 7D EQ', 'Electra', 'Cruiser', '729.99', '999.99', 5, '0.02'),
(5, 'Addict RC 10', 'Scott', 'Mountain', '7999.99', '10999.99', 5, '0.07'),
(6, 'Test Product', 'Test Manu', 'New', '0.00', '0.00', 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SaleID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `SalespersonID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `SalesDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SaleID`, `ProductID`, `SalespersonID`, `CustomerID`, `SalesDate`) VALUES
(18, 1, 1, 1, '2022-03-24'),
(19, 2, 4, 5, '2022-03-22'),
(20, 4, 3, 3, '2022-03-10'),
(21, 5, 5, 4, '2020-03-19'),
(22, 3, 6, 2, '2022-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `salesperson`
--

CREATE TABLE `salesperson` (
  `SalespersonID` int(11) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Address` varchar(45) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `TerminationDate` date DEFAULT NULL,
  `Manager` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesperson`
--

INSERT INTO `salesperson` (`SalespersonID`, `FirstName`, `LastName`, `Address`, `Phone`, `StartDate`, `TerminationDate`, `Manager`) VALUES
(1, 'Jawwad', 'Qureshi', '123 Test Address City State', '1234567890', '2022-03-15', NULL, 'Manager1'),
(3, 'James', 'Melvin', '2836 Hawks Nest Lane', '3146848253', '2019-01-16', '2022-03-31', 'Manager1'),
(4, 'Carol', 'Milstead', '3553 GoldCliff Circle', '2025645166', '2022-01-12', NULL, 'Manager2'),
(5, 'Kerry', 'Meade', '1707 Woodhill Avenue', '4107426054', '2022-03-24', NULL, 'Manager2'),
(6, 'Kelly', 'Meraz', '1514 Passaic Street', '2022739157', '2016-07-13', NULL, 'Manager1'),
(7, 'Jawwad', 'Qureshi', ' ', '123-123-12', NULL, NULL, 'Mister');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`DiscountID`),
  ADD KEY `ProductID_idx` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SaleID`),
  ADD KEY `ProductID_idx` (`ProductID`),
  ADD KEY `SalespersonID_idx` (`SalespersonID`),
  ADD KEY `CustomerID_idx` (`CustomerID`);

--
-- Indexes for table `salesperson`
--
ALTER TABLE `salesperson`
  ADD PRIMARY KEY (`SalespersonID`),
  ADD UNIQUE KEY `Phone_UNIQUE` (`Phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `DiscountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `salesperson`
--
ALTER TABLE `salesperson`
  MODIFY `SalespersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `ProductID_FK_Disc` FOREIGN KEY (`ProductID`) REFERENCES `mydb`.`products` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `CustomerID_FK_Sales` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ProductID_FK_Sales` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `SalespersonID_FK_Sales` FOREIGN KEY (`SalespersonID`) REFERENCES `salesperson` (`SalespersonID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
