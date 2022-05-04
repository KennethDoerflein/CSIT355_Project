-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2022 at 01:24 AM
-- Server version: 5.7.38
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doerflk1_OfficeSupplyEmporium`
--

-- --------------------------------------------------------

--
-- Table structure for table `CART`
--

CREATE TABLE `CART` (
  `cartID` char(8) NOT NULL,
  `accountNumber` char(8) NOT NULL,
  `productID` char(6) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateAdded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `accountNumber` char(8) NOT NULL,
  `email` varchar(128) NOT NULL,
  `Fname` varchar(128) DEFAULT NULL,
  `Lname` varchar(128) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phoneNumber` varchar(128) DEFAULT NULL,
  `dateOpened` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`accountNumber`, `email`, `Fname`, `Lname`, `password`, `address`, `phoneNumber`, `dateOpened`) VALUES
('10457796', 'test@test.com', 'test', 'test', '$2y$10$q3fiwUlGWH1QsUFuFCYqbuIm3bUZ3bjexDfPz0RLyn9i/l4xEssTa', '1 Normal Ave, Montclair NJ 07028', '9999999999', '2022-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `employeeID` char(8) NOT NULL,
  `email` varchar(128) NOT NULL,
  `Fname` varchar(128) DEFAULT NULL,
  `Lname` varchar(128) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `phoneNumber` varchar(128) DEFAULT NULL,
  `salary` double NOT NULL,
  `startDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`employeeID`, `email`, `Fname`, `Lname`, `password`, `address`, `phoneNumber`, `salary`, `startDate`) VALUES
('35933854', 'test@test.com', 'John', 'Doe', '$2y$10$w9PNVXBBpdDAi.HXoWd.5etOD7yCsScSehWygvEHRJ5kBYoglN1LK', '1 Normal Ave, Montclair NJ 07028', '9999999999', 38848, '2022-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `id` char(6) NOT NULL,
  `accountNumber` char(8) NOT NULL,
  `orderNumber` char(6) NOT NULL,
  `productID` char(6) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORDERS`
--

INSERT INTO `ORDERS` (`id`, `accountNumber`, `orderNumber`, `productID`, `price`, `quantity`, `purchaseDate`) VALUES
('426890', '10457796', '710664', '83728', 1.69, 1, '2022-05-04 01:12:21'),
('478470', '10457796', '720088', '32195', 10.29, 5, '2022-05-04 01:01:33'),
('121480', '10457796', '753164', '32195', 10.29, 2, '2022-05-04 00:29:40'),
('172403', '10457796', '753164', '24079', 5.59, 1, '2022-05-04 00:29:40'),
('396492', '10457796', '753164', '89308', 71.99, 1, '2022-05-04 00:29:40'),
('495466', '10457796', '753164', '70930', 0.5, 65, '2022-05-04 00:29:40'),
('453976', '10457796', '753164', '78268', 22.99, 1, '2022-05-04 00:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `productID` char(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `price` double NOT NULL,
  `manufacturer` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PRODUCT`
--

INSERT INTO `PRODUCT` (`productID`, `name`, `category`, `price`, `manufacturer`, `description`, `quantity`, `image`) VALUES
('32195', 'BIC Mechanical Pencils', 'Writing Implements', 10.29, 'BIC', '40 Pack, smoother, darker writing pencils', 13, 'https://target.scene7.com/is/image/Target/GUEST_2cedf797-2707-4df1-b60e-e36c293a8ade?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('43709', 'Crayola Crayons', 'Writing Implements', 1.58, 'Crayola', '24ct Classic Crayons', 65, 'https://target.scene7.com/is/image/Target/GUEST_70331375-a3d8-4009-87a0-5ee1e0f3e62e?wid=800&hei=800&qlt=80&fmt=pjpeg'),
('83728', 'Paper Mate Erasers', 'Writing Implements', 1.69, 'Paper Mate', '3 pack pink pearl erasers, smudge resistant', 29, 'https://target.scene7.com/is/image/Target/GUEST_c0fe8f3a-ef03-4b61-b258-e724fa24316c?wid=1569&hei=1569&fmt=pjpeg'),
('24079', 'Sharpie S-Gel Pen', 'Writing Implements', 5.59, 'Sharpie', 'Black Ink Gel Pen 0.7mm Gray Metal Barrel', 39, 'https://target.scene7.com/is/image/Target/GUEST_2365ab2d-fe58-449b-8045-8222f0c005fc?wid=1569&hei=1569&fmt=pjpeg'),
('70584', 'Pilot G2 Black Gel Pen', 'Writing Implements', 4.49, 'Pilot G2', 'Black gel ink pen with ultra fine point 0.38mm 3 pack', 50, 'https://target.scene7.com/is/image/Target/GUEST_cc790848-9ca2-4dfd-be72-d61c6a0d3255?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('10642', 'Ticonderoga #2 Pencils', 'Writing Implements', 4.39, 'Ticonderoga', 'Pre-Sharpened Pencils, 18ct', 100, 'https://target.scene7.com/is/image/Target/GUEST_45cd5680-2d8c-406a-babd-af02cb83f0a0?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('89308', 'Hammermill Copy Plus Paper', 'Paper', 71.99, 'Hammermill', '8.5\" x 11\", 20 lbs., White, 500 Sheets/Ream, 10 Reams/Carton', 24, 'https://www.staples-3p.com/s7/is/image/Staples/sp167072075_sc7?wid=700&hei=700'),
('77844', 'Mead Wide Ruled Lined Paper', 'Paper', 5.89, 'Mead', 'Wide Ruled Filler Paper, 8\" x 10.5\", White, 200 Sheets/Pack', 84, 'https://www.staples-3p.com/s7/is/image/Staples/sp117519076_sc7?wid=700&hei=700'),
('84232', 'Oxford Ruled Index Cards', 'Paper', 2.99, 'Oxford', '3 x 5, Green/Yellow, Orange/Pink, 100/Pack', 25, 'https://www.staples-3p.com/s7/is/image/Staples/s0867050_sc7?wid=700&hei=700'),
('41751', 'Five Star College Ruled Paper', 'Paper', 8.29, 'Five Star', '11\" x 8.5\", White, 100/Pack', 74, 'https://www.staples-3p.com/s7/is/image/Staples/sp46038428_sc7?wid=700&hei=700'),
('78268', 'Post-it Notes', 'Paper', 22.99, 'Post-it', '3\" x 3\", 70 Sheets/Pad, 24 Pads/Pack', 21, 'https://www.staples-3p.com/s7/is/image/Staples/sp161314531_sc7?wid=700&hei=700'),
('16822', 'Graph Paper', 'Paper', 7.49, 'Five Star', 'Reinforced Graph Ruled Filler Paper, 11 x 8 1/2\", 100 Sheets', 15, 'https://www.staples-3p.com/s7/is/image/Staples/s1027976_sc7?wid=700&hei=700'),
('32753', '1 Subject Spiral Notebook', 'Notebooks', 3.39, 'Five Star', '100 double-sided, college ruled sheets, which fight ink bleed.', 22, 'https://target.scene7.com/is/image/Target/GUEST_6c3d1e71-841d-4000-b760-2dc355c47ec7?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('71733', '3 Subject Spiral Notebook', 'Notebooks', 4.79, 'Five Star', '150 double-sided, college ruled sheets, which fight ink bleed. Two 2-pocket dividers hold 8 1/2\" x 11\" sheets', 48, 'https://target.scene7.com/is/image/Target/GUEST_ad5d0716-e008-4a0c-aafe-91895133921c?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('70930', 'Composition Notebook', 'Notebooks', 0.5, 'Unison', '80 pages, college ruled', 80, 'https://target.scene7.com/is/image/Target/GUEST_9bc7ceb2-3b65-4ee8-9d8d-a98999843d37?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('10808', 'Fabric Journal', 'Notebooks', 14.99, 'Gartner Studios', '120 sheets lined', 19, 'https://target.scene7.com/is/image/Target/GUEST_50437c34-19ee-48e2-b3a0-b42022d878b1?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('68863', 'Blank Sketchbook', 'Notebooks', 11.99, 'Piccadilly', '8\"x 11.41\", 240 Blank Sketch Pages', 37, 'https://target.scene7.com/is/image/Target/GUEST_f465293e-7666-44d0-85e6-086da74875cd?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('48433', 'Composition Notebook', 'Notebooks', 3.29, 'Five Star', 'College Ruled, 100pgs, 7.5\" x 9.75\"', 46, 'https://target.scene7.com/is/image/Target/GUEST_64124c8d-e546-4385-b4d9-806d4200ab69?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('27538', 'Swivel Chair with Arms', 'Furniture', 196.99, 'Flash Furniture', 'Black LeatherSoft Material, with tilt and swivel', 2, 'https://target.scene7.com/is/image/Target/GUEST_ea355985-5fd2-49e9-aacd-c87071d49a0f?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('69049', 'Writing Desk', 'Furniture', 516.24, 'Coaster', '4 Drawer Home Office Writing Desk, Antique Nutmeg', 5, 'https://target.scene7.com/is/image/Target/GUEST_f48ecaf5-2da3-40d6-a45e-8fb54f1c6324?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('28436', 'Trash Can', 'Furniture', 20, 'Brightroom', '12L Round Step Trash Can', 4, 'https://target.scene7.com/is/image/Target/GUEST_1a92ce52-acbf-4594-ac35-40d310e80628?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('70427', 'Computer Desk', 'Furniture', 269.99, 'Costway', 'PC Laptop Table Study Workstation', 6, 'https://target.scene7.com/is/image/Target/GUEST_8cdde2cb-de69-475a-b934-233a9c51531d?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('53223', 'Desk Lamp', 'Furniture', 43.49, 'V-Light', 'Incandescent Desk Lamp, 16\", Oil Rubbed Bronze', 8, 'https://www.staples-3p.com/s7/is/image/Staples/sp48967436_sc7?wid=700&hei=700'),
('61887', 'Wall Clock', 'Furniture', 15.79, 'Tempus', 'Wall Clock, Plastic, 13\"', 5, 'https://www.staples-3p.com/s7/is/image/Staples/sp48967657_sc7?wid=700&hei=700'),
('55899', '1\" 3 Ring Binder', 'Binders', 2.19, 'Avery', 'Round Ring Binder 175 Sheet Capacity', 25, 'https://target.scene7.com/is/image/Target/GUEST_fa79cf3b-52ff-4d5b-807d-12787449cb04?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('19600', '2\" 3 Ring Binder', 'Binders', 8.79, 'Avery', 'One Touch EZD Rings 540 Sheet Capacity Heavy Duty', 14, 'https://target.scene7.com/is/image/Target/GUEST_a9f51275-37bc-42e8-afaa-79b2e8da2547?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('46556', '3\" 3 Ring Binder', 'Binders', 11.39, 'Avery', '600 Sheet 3\" Heavy Duty Non Stick', 22, 'https://target.scene7.com/is/image/Target/GUEST_5b06755f-8696-4440-8f6b-0f0b5b9b5e6f?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('68532', '4\" 3 Ring Binder', 'Binders', 14.89, 'Avery', '700 Sheet Heavy Duty Ring Binder White', 66, 'https://target.scene7.com/is/image/Target/GUEST_d7da8276-a40a-4337-8ba8-f8c394a89c1c?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('27398', '1.5\" 3 Ring Binder', 'Binders', 7.69, 'Avery', '400 Sheet 1.5\" One Touch EZD Heavy-Duty', 47, 'https://target.scene7.com/is/image/Target/GUEST_a73b6339-9c6e-4c40-a410-5a3865975dff?wid=626&hei=626&qlt=80&fmt=pjpeg'),
('46878', '1.5\" Ring Three-Hold Binder', 'Binders', 8.99, 'Five Star', 'built-in puncher, holds up to 225 sheets', 8, 'https://target.scene7.com/is/image/Target/GUEST_2d21fa58-93f9-44a6-adc8-a743943b89fa?wid=626&hei=626&qlt=80&fmt=pjpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CART`
--
ALTER TABLE `CART`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `accountNumber` (`accountNumber`);

--
-- Indexes for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`accountNumber`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `email` (`email`,`phoneNumber`);

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountNumber` (`accountNumber`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `image` (`image`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
