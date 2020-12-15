-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 08:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `19112421`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `AdminID` int(2) NOT NULL,
  `Name` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`AdminID`, `Name`, `Password`) VALUES
(1, 'admin1', '9dfc8dce7280fd49fc6e7bf0436ed325'),
(2, 'admin2', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'admin3', '9dfc8dce7280fd49fc6e7bf0436ed325'),
(4, 'Mihai', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `BasketID` int(5) NOT NULL,
  `UserID` int(5) NOT NULL,
  `ProductID` int(5) NOT NULL,
  `Amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`BasketID`, `UserID`, `ProductID`, `Amount`) VALUES
(1, 12, 1, 14),
(22, 24, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `UserID` int(5) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `City` varchar(20) DEFAULT NULL,
  `AddressFirstLine` text DEFAULT NULL,
  `AddressSecondLine` text DEFAULT NULL,
  `CardNumber` varchar(16) DEFAULT NULL,
  `ExpiryDate` date DEFAULT current_timestamp(),
  `CVS` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`UserID`, `Email`, `FirstName`, `LastName`, `Password`, `City`, `AddressFirstLine`, `AddressSecondLine`, `CardNumber`, `ExpiryDate`, `CVS`) VALUES
(9, 'test.user@mail.com', 'test', 'user', '9dfc8dce7280fd49fc6e7bf0436ed325', 'test city', '', 'test street', '1111111111111111', '2020-12-12', 111),
(10, 'test2.user@mail.com', 'test2', 'user', '9dfc8dce7280fd49fc6e7bf0436ed325', 'Birmingham', '6 Heron Court', 'High Str.', '1111111111111111', '2020-12-30', 123),
(11, 'sad@mail.com', 'sad', 'sad', '49f0bad299687c62334182178bfd75d8', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'mihai@email.com', 'Mihai', 'Nastase', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'test3.user@mail.com', 'test3', 'user', '9dfc8dce7280fd49fc6e7bf0436ed325', 'ssa', 'ssa', 'saa', '1111111111111111', '2020-12-20', 333),
(21, 'phill.swift@mail.com', 'Phill', 'Swift', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'test5.user@mail.com', 'test5', 'user', '9dfc8dce7280fd49fc6e7bf0436ed325', 'city', 'add1', 'add2', '1111111111111111', '2020-12-30', 11),
(23, 'mihai.nastase@mail.com', 'Mihai', 'Nastase', '9dfc8dce7280fd49fc6e7bf0436ed325', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(5) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `ProductType` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `AvailableStock` int(4) NOT NULL,
  `Image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Price`, `ProductType`, `Description`, `AvailableStock`, `Image`) VALUES
(1, 'Computer', '1599.99', 'Desktop PC', 'A desktop computer is a personal computer designed for regular use at a single location on or near a desk or table due to its size and power requirements. The most common configuration has a case that houses the power supply, motherboard (a printed circuit board with a microprocessor as the central processing unit (CPU), memory, bus, and other electronic components, disk storage (usually one or more hard disk drives, solid state drives, optical disc drives, and in early models a floppy disk drive); a keyboard and mouse for input; and a computer monitor, speakers, and, often, a printer for output. The case may be oriented horizontally or vertically and placed either underneath, beside, or on top of a desk.', 40, 'old_computer.jpg'),
(4, 'testProduct', '99.99', 'Audio', 'Audio', 5, 'qrcode.59793503.png'),
(5, 'Nintendo DS Lite', '52.45', 'Game Console', 'With Nintendo DSi Portable Gaming Console you can have fun with sight, sound, and downloadable software. All in the newest version of the world\'s best-selling portable game system. Capture the world around you with two built-in cameras. Then, play with eleven unique lenses to make each photo your own.', 18, '1200px-Nintendo-DS-Lite-Black-Open.jpg'),
(6, 'Commodore 64', '109.99', 'Game Console', 'The world\'s best-selling home computer - reborn, again The C64 is back, this time full-sized with a working keyboard for the dedicated retro home-computer fan. Featuring three switchable modes - C64, VIC 20, and Games Carousel. Connect to any modern TV via HDMI for crisp 720p visuals, at 60 Hz or 50 Hz. An updated joystick, now featuring micro switches, companions the hardware making the included games even more fun than ever.', 17, '1973466_R_Z003A.png'),
(7, 'Apple Macintosh M0001A', '40.09', 'Desktop PC', 'The Apple Macintosh Plus features an 8 MHz 68000 processor, 1 MB of RAM, and an 800k disk drive in a beige or platinum all-in-one case with a 9\" monochrome display.\r\n\r\nThe Macintosh Plus was the first Macintosh to have a double-density 800k disk drive, a SCSI port to allow external expansion, and RAM slots to allow the RAM to be expanded beyond the pre-installed limit.', 28, 's-l1600.jpg'),
(8, 'Moog Mother 32 Three Tier Rack Kit', '76.32', 'Audio', 'Mount 3 Mother-32 synthesizers together vertically for maximum modularity and synthesis capabilities. Also accommodates 60HP Moog Eurorack cases.\r\n\r\n*Mother-32 units not included*', 8, 'IS590215-01-01-BIG.jpg'),
(9, 'GPO Soho Black Turntable (hmv Exclusive)', '49.99', 'Audio', 'Stylish, lightweight and available in a range of colours, the hmv exclusive GPO Soho stand alone record player makes it easy and straight forward for you to play your favourite vinyl records whenever and wherever you like.\r\n\r\nThis briefcase-styled turntable is a perfect combo of trendy elements and retro style, with built-in speakers and a compact lightweight retro design, this free standing vinyl player is all you will need to listen to your favourite old records - simply just plug it in and play!\r\n\r\nFeatures:\r\n\r\nBuilt-in high quality twin stereo speakers allow you to listen directly without needing external speakers \r\nAvailable in Black, Cream and Turquoise\r\nRCA jacks let you connect additional speakers \r\n3 record speeds: 33/45/78 RPM\r\nBriefcase-style turntable for lightweight, easy storage and transport\r\nAuto Stop\r\n3.5 mm Headphone Jack\r\nDimensions - W 35.5x D 27.5 x H 13.5 cm\r\nWeight - 2.5 kg\r\nInstruction manual and power supply \r\nGPO are specialists in bespoke manufacturing projects to meet specific needs to classic, yet contemporary retro inspired consumer goods.', 35, '0750226f-2cc7-4650-9c38-7bc25c29bca0.png'),
(10, 'Game Cube VIOLET', '50.52', 'Game Console', 'Compact design\r\nSmall, cute, and desirable – that\'s Nintendo GameCube. Released in purple, black, and special edition colours, Nintendo GameCube\'s unique design and compact shape (11.4 x 15 x 16 cm) is symbolic of Nintendo\'s commitment to keeping originality and innovation alive in video games.\r\n\r\nAmazing audio and visuals\r\nWith a main processor co-developed by IBM and a graphics chip designed in conjunction with ATI, Nintendo GameCube is stuffed to the gills with games-playing punch, giving its titles dazzling visuals to light up your whole living room. Throw in CD-quality music and sounds, and Nintendo GameCube has the audio-visual power to send chills down your spine.\r\n\r\nConnectivity with Game Boy Advance\r\nNintendo GameCube and Game Boy Advance aren\'t just world-beating systems in their own right; by hooking them together with the Game Boy Advance Cable, you\'ll open the door to a breathtaking world of new video game experiences. Depending on the game, you\'ll be able to swap data, unlock new game levels, or use the Game Boy Advance as an input device.\r\n\r\nHuge game library\r\nNintendo GameCube has been designed purely to play games. Game series like Mario, Zelda, Donkey Kong and Metroidare made only by Nintendo for Nintendo systems, and with a huge complement of third-party developers contributing to a long list of tip-top titles, Nintendo GameCube is the system of choice for gamers wanting maximum merriment for their money.', 57, 'gamecube.jpg'),
(11, 'Sony Official PlayStation 2 DualShock 2 Controller (PS2)', '21.59', 'Accessories', 'The layout of PlayStation 2\'s Duals Shock 2 controller is nearly identical to that of the original PlayStation\'s Dual Shock controller, which is good news for most gamers. The main new feature is that, when the buttons are pushed, the controller can register how much pressure is being exerted. This adds a completely new dimension to sports, racing, fighting, and other games. Aside from the Start and Select buttons, all of the functions are analogue for greater control, a wider variety of operations, and a more compelling interactive experience. Two convex analogue thumb pads and two force-feedback solenoid rumblers round out the features. This controller is also compatible with all software that supports the original Dual Shock controller.', 70, '417E1D11PBL._AC_.jpg'),
(13, 'safe', '1000.00', 'Accessories', 'asdsad', 25, '1973466_R_Z003A.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`BasketID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `AdminID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `BasketID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `UserID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
