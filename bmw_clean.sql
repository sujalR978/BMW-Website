-- ============================================
-- BMW Website Database - Clean Setup
-- For InfinityFree phpMyAdmin Import
-- ============================================
-- 
-- INSTRUCTIONS:
-- 1. Create a MySQL database in InfinityFree control panel
-- 2. Open phpMyAdmin from your control panel
-- 3. Select your database
-- 4. Go to "Import" tab
-- 5. Upload this file and click "Go"
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table: register_page (Users)
-- --------------------------------------------------------

CREATE TABLE `register_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: cars
-- --------------------------------------------------------

CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_name` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `fuel_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `car_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Car data (essential for the website to work)
INSERT INTO `cars` (`id`, `car_name`, `model`, `year`, `price`, `category`, `fuel_type`, `description`, `car_image`) VALUES
(10, 'BMW 1 Series', '118i', 2021, 3500000.00, 'hatchback', 'petrol', 'Compact premium hatchback', 'bmw1.jpg'),
(11, 'BMW 2 Series', '220d', 2022, 4200000.00, 'coupe', 'diesel', 'Sporty coupe with great mileage', 'bmw2.jpg'),
(12, 'BMW 3 Series', '320d', 2022, 5500000.00, 'sedan', 'diesel', 'Luxury sedan with performance', 'bmw3.jpg'),
(13, 'BMW 3 Series', '330i', 2023, 6000000.00, 'sedan', 'petrol', 'Sporty and fast sedan', 'bmw3_2.jpg'),
(14, 'BMW 4 Series', '430i', 2022, 7000000.00, 'coupe', 'petrol', 'Stylish coupe with bold design', 'bmw4.jpg'),
(15, 'BMW 5 Series', '520d', 2021, 6500000.00, 'sedan', 'diesel', 'Executive sedan with comfort', 'bmw5.jpg'),
(16, 'BMW 5 Series', '530i', 2023, 7200000.00, 'sedan', 'petrol', 'Luxury and tech loaded sedan', 'bmw5_2.jpg'),
(17, 'BMW 6 Series', '630i', 2022, 8000000.00, 'sedan', 'petrol', 'Grand touring luxury car', 'bmw6.jpg'),
(18, 'BMW 7 Series', '740Li', 2023, 13000000.00, 'sedan', 'petrol', 'Flagship luxury model', 'bmw7.jpg'),
(19, 'BMW 8 Series', '840i', 2022, 15000000.00, 'coupe', 'petrol', 'High-end sports luxury', 'bmw8.jpg'),
(20, 'BMW X1', 'sDrive20i', 2021, 4500000.00, 'suv', 'petrol', 'Compact luxury SUV', 'x1.jpg'),
(21, 'BMW X1', 'xDrive20d', 2022, 4800000.00, 'suv', 'diesel', 'All-wheel drive compact SUV', 'x1_2.jpg'),
(22, 'BMW X2', 'sDrive20i', 2022, 4600000.00, 'suv', 'petrol', 'Sporty compact SUV', 'x2.jpg'),
(23, 'BMW X3', 'xDrive30i', 2022, 6800000.00, 'suv', 'petrol', 'Mid-size powerful SUV', 'x3.jpg'),
(24, 'BMW X3', 'xDrive20d', 2021, 6200000.00, 'suv', 'diesel', 'Efficient SUV', 'x3_2.jpg'),
(25, 'BMW X4', 'xDrive30i', 2022, 7000000.00, 'suv', 'petrol', 'Coupe style SUV', 'x4.jpg'),
(26, 'BMW X5', 'xDrive40i', 2023, 9500000.00, 'suv', 'petrol', 'Premium SUV with luxury', 'x5.jpg'),
(27, 'BMW X5', 'xDrive30d', 2022, 9000000.00, 'suv', 'diesel', 'Powerful diesel SUV', 'x5_2.jpg'),
(28, 'BMW X6', 'xDrive40i', 2023, 10500000.00, 'suv', 'petrol', 'Sporty luxury SUV', 'x6.jpg'),
(29, 'BMW X7', 'xDrive40i', 2023, 12000000.00, 'suv', 'petrol', 'Full-size luxury SUV', 'x7.jpg'),
(30, 'BMW Z4', 'sDrive20i', 2021, 8000000.00, 'sports', 'petrol', 'Convertible sports car', 'z4.jpg'),
(31, 'BMW Z4', 'M40i', 2022, 8900000.00, 'sports', 'petrol', 'High performance roadster', 'z4_2.jpg'),
(32, 'BMW i3', 'Base', 2020, 3500000.00, 'hatchback', 'electric', 'Electric compact car', 'i3.jpg'),
(33, 'BMW i4', 'eDrive40', 2023, 7500000.00, 'sedan', 'electric', 'Electric luxury sedan', 'i4.jpg'),
(34, 'BMW iX1', 'xDrive30', 2023, 6600000.00, 'suv', 'electric', 'Electric compact SUV', 'ix1.jpg'),
(35, 'BMW iX3', 'M Sport', 2022, 7500000.00, 'suv', 'electric', 'Electric mid-size SUV', 'ix3.jpg'),
(36, 'BMW iX', 'xDrive50', 2023, 11000000.00, 'suv', 'electric', 'Flagship electric SUV', 'ix.jpg'),
(37, 'BMW i7', 'xDrive60', 2023, 14000000.00, 'sedan', 'electric', 'Luxury electric sedan', 'i7.jpg'),
(38, 'BMW M2', 'Competition', 2022, 8500000.00, 'sports', 'petrol', 'High-performance coupe', 'm2.jpg'),
(39, 'BMW M3', 'Competition', 2023, 10000000.00, 'sedan', 'petrol', 'Performance sedan', 'm3.jpg'),
(40, 'BMW M4', 'Competition', 2023, 11000000.00, 'coupe', 'petrol', 'Sporty aggressive coupe', 'm4.jpg'),
(41, 'BMW M5', 'Competition', 2023, 15000000.00, 'sedan', 'petrol', 'Super fast sedan', 'm5.jpg'),
(42, 'BMW M8', 'Competition', 2022, 18000000.00, 'coupe', 'petrol', 'Top performance coupe', 'm8.jpg'),
(43, 'BMW X3 M', 'Competition', 2022, 9500000.00, 'suv', 'petrol', 'Performance SUV', 'x3m.jpg'),
(44, 'BMW X5 M', 'Competition', 2023, 13000000.00, 'suv', 'petrol', 'High-performance SUV', 'x5m.jpg'),
(45, 'BMW X6 M', 'Competition', 2023, 14000000.00, 'suv', 'petrol', 'Sporty performance SUV', 'x6m.jpg'),
(46, 'BMW 2 Series Gran Coupe', '220i', 2022, 4300000.00, 'sedan', 'petrol', 'Entry luxury sedan', '2gc.jpg'),
(47, 'BMW 3 Series Gran Turismo', '320d GT', 2021, 5800000.00, 'sedan', 'diesel', 'Spacious sporty sedan', '3gt.jpg'),
(48, 'BMW 6 Series GT', '630d GT', 2022, 7800000.00, 'sedan', 'diesel', 'Luxury long drive car', '6gt.jpg'),
(49, 'BMW X1', 'sDrive18i', 2020, 4000000.00, 'suv', 'petrol', 'Entry SUV', 'x1_3.jpg'),
(50, 'BMW X3', 'xDrive20i', 2020, 6000000.00, 'suv', 'petrol', 'Reliable SUV', 'x3_3.jpg'),
(51, 'BMW X5', 'xDrive35i', 2021, 8500000.00, 'suv', 'petrol', 'Comfort SUV', 'x5_3.jpg'),
(52, 'BMW iX1', 'Standard', 2023, 6200000.00, 'suv', 'electric', 'Affordable electric SUV', 'ix1_2.jpg'),
(53, 'BMW i4', 'M50', 2023, 9000000.00, 'sedan', 'electric', 'Performance EV sedan', 'i4_2.jpg'),
(54, 'BMW M340i', 'xDrive', 2023, 7000000.00, 'sedan', 'petrol', 'Sport tuned sedan', 'm340i.jpg'),
(55, 'BMW M550i', 'xDrive', 2022, 9500000.00, 'sedan', 'petrol', 'Powerful luxury sedan', 'm550i.jpg'),
(56, 'BMW Alpina B7', 'Exclusive', 2022, 20000000.00, 'sedan', 'petrol', 'Ultra luxury performance sedan', 'alpina.jpg');

-- --------------------------------------------------------
-- Table: car_learn_more
-- --------------------------------------------------------

CREATE TABLE `car_learn_more` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `performance` varchar(255) DEFAULT NULL,
  `efficiency` varchar(255) DEFAULT NULL,
  `safety` varchar(255) DEFAULT NULL,
  `engine` varchar(255) DEFAULT NULL,
  `horsepower` varchar(100) DEFAULT NULL,
  `torque` varchar(100) DEFAULT NULL,
  `transmission` varchar(100) DEFAULT NULL,
  `drivetrain` varchar(100) DEFAULT NULL,
  `seating` varchar(50) DEFAULT NULL,
  `cargo_space` varchar(100) DEFAULT NULL,
  `fuel_economy` varchar(100) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `gallery` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `car_learn_more` (`id`, `performance`, `efficiency`, `safety`, `engine`, `horsepower`, `torque`, `transmission`, `drivetrain`, `seating`, `cargo_space`, `fuel_economy`, `features`, `gallery`, `created_at`) VALUES
(10, 'Sporty acceleration', 'High', '5 Airbags', '2.0L Petrol', '180 HP', '300 Nm', 'Automatic', 'RWD', '5', '480L', '15 km/l', 'iDrive, ABS, Airbags', 'bmw1.jpg', '2026-03-27 18:08:06'),
(11, 'Quick pickup', 'Medium', '6 Airbags', '2.0L Diesel', '190 HP', '400 Nm', 'Automatic', 'RWD', '5', '450L', '18 km/l', 'Cruise Control, ABS', 'bmw2.jpg', '2026-03-27 18:08:06'),
(12, 'Smooth drive', 'High', '5 Star NCAP', '2.0L Diesel', '187 HP', '400 Nm', 'Automatic', 'RWD', '5', '480L', '20 km/l', 'iDrive, Navigation', 'bmw3.jpg', '2026-03-27 18:08:06'),
(13, 'High performance', 'Medium', '6 Airbags', '2.0L Petrol', '255 HP', '350 Nm', 'Automatic', 'RWD', '5', '480L', '14 km/l', 'Sport Mode, HUD', 'bmw3_2.jpg', '2026-03-27 18:08:06'),
(14, 'Aggressive speed', 'Medium', '6 Airbags', '2.0L Petrol', '250 HP', '350 Nm', 'Automatic', 'RWD', '4', '440L', '13 km/l', 'Launch Control', 'bmw4.jpg', '2026-03-27 18:08:06'),
(15, 'Comfort drive', 'High', '5 Airbags', '2.0L Diesel', '190 HP', '400 Nm', 'Automatic', 'RWD', '5', '530L', '19 km/l', 'Luxury seats', 'bmw5.jpg', '2026-03-27 18:08:06'),
(16, 'Premium feel', 'Medium', '6 Airbags', '2.0L Petrol', '252 HP', '350 Nm', 'Automatic', 'RWD', '5', '530L', '14 km/l', 'Sunroof, HUD', 'bmw5_2.jpg', '2026-03-27 18:08:06'),
(17, 'Luxury touring', 'Medium', '6 Airbags', '2.0L Petrol', '260 HP', '400 Nm', 'Automatic', 'RWD', '5', '550L', '14 km/l', 'Ambient lights', 'bmw6.jpg', '2026-03-27 18:08:06'),
(18, 'Top comfort', 'Medium', '7 Airbags', '3.0L Petrol', '335 HP', '450 Nm', 'Automatic', 'RWD', '5', '500L', '12 km/l', 'Massage seats', 'bmw7.jpg', '2026-03-27 18:08:06'),
(19, 'Extreme power', 'Low', '7 Airbags', '3.0L Petrol', '380 HP', '500 Nm', 'Automatic', 'AWD', '4', '420L', '10 km/l', 'Sport exhaust', 'bmw8.jpg', '2026-03-27 18:08:06'),
(20, 'Compact SUV', 'High', '5 Airbags', '1.5L Petrol', '140 HP', '220 Nm', 'Automatic', 'FWD', '5', '505L', '17 km/l', 'Parking assist', 'x1.jpg', '2026-03-27 18:08:06'),
(21, 'Balanced SUV', 'High', '6 Airbags', '2.0L Diesel', '190 HP', '400 Nm', 'Automatic', 'AWD', '5', '505L', '18 km/l', 'Traction control', 'x1_2.jpg', '2026-03-27 18:08:06'),
(22, 'Sport SUV', 'Medium', '6 Airbags', '2.0L Petrol', '190 HP', '280 Nm', 'Automatic', 'FWD', '5', '470L', '15 km/l', 'Drive modes', 'x2.jpg', '2026-03-27 18:08:06'),
(23, 'Power SUV', 'Medium', '6 Airbags', '2.0L Petrol', '250 HP', '350 Nm', 'Automatic', 'AWD', '5', '550L', '14 km/l', 'AWD system', 'x3.jpg', '2026-03-27 18:08:06'),
(24, 'Efficient SUV', 'High', '6 Airbags', '2.0L Diesel', '190 HP', '400 Nm', 'Automatic', 'AWD', '5', '550L', '18 km/l', 'Hill assist', 'x3_2.jpg', '2026-03-27 18:08:06'),
(25, 'Coupe SUV', 'Medium', '6 Airbags', '2.0L Petrol', '250 HP', '350 Nm', 'Automatic', 'AWD', '5', '525L', '14 km/l', 'Sport suspension', 'x4.jpg', '2026-03-27 18:08:06'),
(26, 'Premium SUV', 'Low', '7 Airbags', '3.0L Petrol', '340 HP', '450 Nm', 'Automatic', 'AWD', '5', '650L', '12 km/l', 'Air suspension', 'x5.jpg', '2026-03-27 18:08:06'),
(27, 'Diesel SUV', 'High', '7 Airbags', '3.0L Diesel', '265 HP', '620 Nm', 'Automatic', 'AWD', '5', '650L', '16 km/l', 'Adaptive cruise', 'x5_2.jpg', '2026-03-27 18:08:06'),
(28, 'Luxury SUV', 'Low', '7 Airbags', '3.0L Petrol', '340 HP', '450 Nm', 'Automatic', 'AWD', '5', '580L', '12 km/l', 'Panoramic roof', 'x6.jpg', '2026-03-27 18:08:06'),
(29, 'Big SUV', 'Low', '7 Airbags', '3.0L Petrol', '335 HP', '450 Nm', 'Automatic', 'AWD', '7', '750L', '11 km/l', '3rd row seating', 'x7.jpg', '2026-03-27 18:08:06'),
(30, 'Convertible', 'Low', '4 Airbags', '2.0L Petrol', '197 HP', '320 Nm', 'Automatic', 'RWD', '2', '300L', '13 km/l', 'Soft top', 'z4.jpg', '2026-03-27 18:08:06'),
(31, 'Sports power', 'Low', '4 Airbags', '3.0L Petrol', '382 HP', '500 Nm', 'Automatic', 'RWD', '2', '300L', '11 km/l', 'Launch control', 'z4_2.jpg', '2026-03-27 18:08:06'),
(32, 'Electric city', 'Very High', '4 Airbags', 'Electric', '170 HP', '250 Nm', 'Automatic', 'RWD', '4', '260L', '250 km/charge', 'Eco mode', 'i3.jpg', '2026-03-27 18:08:06'),
(33, 'EV sedan', 'Very High', '6 Airbags', 'Electric', '335 HP', '430 Nm', 'Automatic', 'RWD', '5', '470L', '300 km/charge', 'Fast charging', 'i4.jpg', '2026-03-27 18:08:06'),
(34, 'EV SUV', 'Very High', '6 Airbags', 'Electric', '310 HP', '500 Nm', 'Automatic', 'AWD', '5', '500L', '320 km/charge', 'Regenerative braking', 'ix1.jpg', '2026-03-27 18:08:06'),
(35, 'Electric SUV', 'Very High', '6 Airbags', 'Electric', '286 HP', '400 Nm', 'Automatic', 'RWD', '5', '510L', '300 km/charge', 'Silent drive', 'ix3.jpg', '2026-03-27 18:08:06'),
(36, 'Flagship EV', 'Very High', '8 Airbags', 'Electric', '516 HP', '765 Nm', 'Automatic', 'AWD', '5', '600L', '400 km/charge', 'Luxury EV', 'ix.jpg', '2026-03-27 18:08:06'),
(37, 'Luxury EV', 'Very High', '8 Airbags', 'Electric', '536 HP', '745 Nm', 'Automatic', 'AWD', '5', '500L', '420 km/charge', 'Autonomous tech', 'i7.jpg', '2026-03-27 18:08:06'),
(38, 'Track ready', 'Low', '6 Airbags', '3.0L Petrol', '405 HP', '550 Nm', 'Manual', 'RWD', '4', '390L', '10 km/l', 'Track mode', 'm2.jpg', '2026-03-27 18:08:06'),
(39, 'Performance', 'Low', '6 Airbags', '3.0L Petrol', '473 HP', '550 Nm', 'Automatic', 'RWD', '5', '480L', '10 km/l', 'M sport', 'm3.jpg', '2026-03-27 18:08:06'),
(40, 'Aggressive coupe', 'Low', '6 Airbags', '3.0L Petrol', '503 HP', '650 Nm', 'Automatic', 'RWD', '4', '440L', '9 km/l', 'Carbon roof', 'm4.jpg', '2026-03-27 18:08:06'),
(41, 'Super sedan', 'Low', '7 Airbags', '4.4L Petrol', '617 HP', '750 Nm', 'Automatic', 'AWD', '5', '530L', '8 km/l', 'Launch control', 'm5.jpg', '2026-03-27 18:08:06'),
(42, 'Top coupe', 'Low', '7 Airbags', '4.4L Petrol', '617 HP', '750 Nm', 'Automatic', 'AWD', '4', '420L', '8 km/l', 'Ultimate drive', 'm8.jpg', '2026-03-27 18:08:06'),
(43, 'SUV M', 'Low', '7 Airbags', '3.0L Petrol', '503 HP', '650 Nm', 'Automatic', 'AWD', '5', '550L', '9 km/l', 'Sport AWD', 'x3m.jpg', '2026-03-27 18:08:06'),
(44, 'SUV beast', 'Low', '7 Airbags', '4.4L Petrol', '617 HP', '750 Nm', 'Automatic', 'AWD', '5', '650L', '8 km/l', 'M suspension', 'x5m.jpg', '2026-03-27 18:08:06'),
(45, 'SUV coupe M', 'Low', '7 Airbags', '4.4L Petrol', '617 HP', '750 Nm', 'Automatic', 'AWD', '5', '580L', '8 km/l', 'Performance SUV', 'x6m.jpg', '2026-03-27 18:08:06'),
(46, 'Entry sedan', 'High', '5 Airbags', '2.0L Petrol', '178 HP', '280 Nm', 'Automatic', 'FWD', '5', '430L', '16 km/l', 'Comfort seats', '2gc.jpg', '2026-03-27 18:08:06'),
(47, 'Spacious sedan', 'High', '5 Airbags', '2.0L Diesel', '190 HP', '400 Nm', 'Automatic', 'RWD', '5', '520L', '18 km/l', 'Big cabin', '3gt.jpg', '2026-03-27 18:08:06'),
(48, 'Touring', 'Medium', '6 Airbags', '3.0L Diesel', '265 HP', '620 Nm', 'Automatic', 'RWD', '5', '610L', '15 km/l', 'Long drive comfort', '6gt.jpg', '2026-03-27 18:08:06'),
(49, 'Entry SUV', 'High', '5 Airbags', '1.5L Petrol', '140 HP', '220 Nm', 'Automatic', 'FWD', '5', '500L', '17 km/l', 'Basic features', 'x1_3.jpg', '2026-03-27 18:08:06'),
(50, 'Reliable SUV', 'Medium', '6 Airbags', '2.0L Petrol', '245 HP', '350 Nm', 'Automatic', 'AWD', '5', '550L', '14 km/l', 'Stable drive', 'x3_3.jpg', '2026-03-27 18:08:06'),
(51, 'Comfort SUV', 'Medium', '7 Airbags', '3.0L Petrol', '306 HP', '400 Nm', 'Automatic', 'AWD', '5', '650L', '12 km/l', 'Luxury cabin', 'x5_3.jpg', '2026-03-27 18:08:06'),
(52, 'Affordable EV', 'Very High', '6 Airbags', 'Electric', '313 HP', '494 Nm', 'Automatic', 'AWD', '5', '490L', '320 km/charge', 'Eco EV', 'ix1_2.jpg', '2026-03-27 18:08:06'),
(53, 'Performance EV', 'Very High', '6 Airbags', 'Electric', '536 HP', '795 Nm', 'Automatic', 'AWD', '5', '470L', '350 km/charge', 'Fast EV', 'i4_2.jpg', '2026-03-27 18:08:06'),
(54, 'Sport sedan', 'Medium', '6 Airbags', '3.0L Petrol', '382 HP', '500 Nm', 'Automatic', 'AWD', '5', '480L', '12 km/l', 'Sport tuned', 'm340i.jpg', '2026-03-27 18:08:06'),
(55, 'Luxury power', 'Medium', '6 Airbags', '4.4L Petrol', '523 HP', '750 Nm', 'Automatic', 'AWD', '5', '530L', '10 km/l', 'Premium drive', 'm550i.jpg', '2026-03-27 18:08:06'),
(56, 'Ultra luxury', 'Low', '8 Airbags', '4.4L Petrol', '600 HP', '800 Nm', 'Automatic', 'AWD', '5', '500L', '9 km/l', 'Alpina tuning', 'alpina.jpg', '2026-03-27 18:08:06'),
(57, 'Hybrid SUV', 'Medium', '8 Airbags', '4.4L Hybrid', '644 HP', '800 Nm', 'Automatic', 'AWD', '5', '550L', '20 km/l', 'Hybrid tech', 'xm.jpg', '2026-03-27 18:08:06');

-- --------------------------------------------------------
-- Table: bmw_contacts
-- --------------------------------------------------------

CREATE TABLE `bmw_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `inquiry_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: bmw_contact_replies
-- --------------------------------------------------------

CREATE TABLE `bmw_contact_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `reply_message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_by_user` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: bmw_feedback
-- --------------------------------------------------------

CREATE TABLE `bmw_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT 5,
  `feedback_type` varchar(50) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_negative` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: bmw_inquiries
-- --------------------------------------------------------

CREATE TABLE `bmw_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reply_sent` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: bmw_replies
-- --------------------------------------------------------

CREATE TABLE `bmw_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inquiry_id` int(11) NOT NULL,
  `reply_message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_by_user` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `inquiry_id` (`inquiry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: cart
-- --------------------------------------------------------

CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: orders
-- --------------------------------------------------------

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: order_items
-- --------------------------------------------------------

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: test_drive
-- --------------------------------------------------------

CREATE TABLE `test_drive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` varchar(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `comments` text DEFAULT NULL,
  `booking_status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table: wishlist
-- --------------------------------------------------------

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
