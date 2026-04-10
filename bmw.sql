-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2026 at 07:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmw`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmw_contacts`
--

CREATE TABLE `bmw_contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `inquiry_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bmw_contact_replies`
--

CREATE TABLE `bmw_contact_replies` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `reply_message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_by_user` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bmw_feedback`
--

CREATE TABLE `bmw_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT 5,
  `feedback_type` varchar(50) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_negative` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmw_feedback`
--

INSERT INTO `bmw_feedback` (`id`, `user_id`, `name`, `email`, `rating`, `feedback_type`, `message`, `image_url`, `is_negative`, `created_at`) VALUES
(1, 1, 'Sujal Rashiya', 'sujalrashiya001@gmail.com', 1, '0', 'cxgvdfgfdgds', '1773768895_performance icon.jpg', 1, '2026-03-17 17:34:55'),
(2, 1, 'ertyetryer', 'sujalrashiya001@gmail.com', 5, '0', 'yretyert', '1773768958_performance icon.jpg', 0, '2026-03-17 17:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `bmw_inquiries`
--

CREATE TABLE `bmw_inquiries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reply_sent` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmw_inquiries`
--

INSERT INTO `bmw_inquiries` (`id`, `user_id`, `name`, `email`, `phone`, `subject`, `message`, `image`, `created_at`, `reply_sent`) VALUES
(3, 1, 'Sujal', 'sujalrashiya001@gmail.com', '1234567890', 'service', 'dfgdsgdsfg', 'uploads/00f31f9222197957f1f8a206b47d5718.jpg', '2026-03-17 13:46:38', 0),
(4, 1, 'Sujal', 'sujalrashiya001@gmail.com', '4456643535', 'service', 'ertsredtersg', 'uploads/4773e040e728b3061e7a212fd109c5e5.jpg', '2026-03-17 13:48:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bmw_replies`
--

CREATE TABLE `bmw_replies` (
  `id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `reply_message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_by_user` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmw_replies`
--

INSERT INTO `bmw_replies` (`id`, `inquiry_id`, `reply_message`, `created_at`, `read_by_user`) VALUES
(1, 4, 'how are uyou', '2026-03-17 14:11:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_name` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `fuel_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `car_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `model`, `year`, `price`, `category`, `fuel_type`, `description`, `car_image`) VALUES
(1, 'first', 'BMW i', 1999, 5234.00, 'sedan', 'diesel', 'fasdg34t34tfdvdfwersdgdfg', 'profile1.jpg'),
(2, 'dasf', '7', 1999, 5234.00, 'sedan', 'diesel', 'fasdg34t34tfdvdfwersdgdfg', 'profile1.jpg'),
(3, 'dasf', 'X', 2000, 4365435.00, 'sedan', 'petrol', 'sggfdfdsg', 'profile1.jpg'),
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

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(9, 28, 0, 1),
(10, 28, 3, 1),
(18, 1, 0, 1),
(27, 0, 56, 1),
(28, 1, 56, 1),
(29, 1, 55, 1),
(31, 29, 0, 1),
(32, 29, 55, 1),
(33, 1, 42, 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_learn_more`
--

CREATE TABLE `car_learn_more` (
  `id` int(11) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_learn_more`
--

INSERT INTO `car_learn_more` (`id`, `performance`, `efficiency`, `safety`, `engine`, `horsepower`, `torque`, `transmission`, `drivetrain`, `seating`, `cargo_space`, `fuel_economy`, `features`, `gallery`, `created_at`) VALUES
(1, 'first', 'fdgs', 'sdfgsd    ', 'first', 'gdfsgdf', 'gdfg', 'dsfg  ', 'fdsg', 'sdfg', 'sdfg', 'sdfg', 'iDrive System, Adaptive Suspension, Head-Up Display', 'profile1.jpg', '2026-03-07 04:40:18'),
(2, 's', 's', 's      ', 'fds', 'fds', 's', 's   ', 'asdf', 'sd', 's', 's', 'Head-Up Display', '1772862444_performance icon.jpg,1772862444_profile1.jpg', '2026-03-07 04:41:51'),
(3, 's', 's', 's  ', 'fds', 'fds', 's', 's ', 'asdf', 'sd', 's', 's', 'Head-Up Display', '', '2026-03-07 04:50:27'),
(4, 'dxcvv', 'zxv', 'zcv  ', 'vxcvcxv', 'zxvczx', 'zxcv', 'cv ', 'cvxcvcv', 'vcv', 'cvcv', 'c', 'iDrive System, Head-Up Display', '', '2026-03-07 04:51:12'),
(5, 'sujal', 'zxv', 'zcv  ', 'vxcvcxv', 'zxvczx', 'zxcv', 'cv ', 'cvxcvcv', 'vcv', 'cvcv', 'c', 'iDrive System, Adaptive Suspension, Head-Up Display', '', '2026-03-07 04:54:07'),
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

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_address` longtext DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `payment_method`, `shipping_address`, `phone`, `order_status`, `created_at`) VALUES
(1, 1, 4721317.52, 'credit_card', 'dsfasf', '1234567890', 'shipped', '2026-03-17 17:54:49'),
(2, 1, 6647.72, 'debit_card', 'sdfgsdfgwdfg', '1234567890', 'pending', '2026-03-17 18:01:00'),
(3, 29, 12300.44, 'credit_card', 'sdgdsgds', '1234567890', 'pending', '2026-03-20 05:45:27'),
(4, 29, 4721317.52, 'credit_card', 'dfgsdgdsf', '1234567890', 'pending', '2026-03-27 17:47:38'),
(5, 29, 21606647.72, 'credit_card', 'hgfhsdgsegf', '1234567890', 'shipped', '2026-04-01 07:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `car_id`, `price`, `created_at`) VALUES
(1, 1, 3, 4365435.00, '2026-03-17 17:54:49'),
(2, 1, 1, 5234.00, '2026-03-17 17:54:49'),
(3, 2, 2, 5234.00, '2026-03-17 18:01:00'),
(4, 3, 1, 5234.00, '2026-03-20 05:45:27'),
(5, 3, 2, 5234.00, '2026-03-20 05:45:27'),
(6, 4, 3, 4365435.00, '2026-03-27 17:47:38'),
(7, 4, 2, 5234.00, '2026-03-27 17:47:38'),
(8, 5, 2, 5234.00, '2026-04-01 07:39:02'),
(9, 5, 56, 20000000.00, '2026-04-01 07:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `register_page`
--

CREATE TABLE `register_page` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_page`
--

INSERT INTO `register_page` (`id`, `name`, `email`, `phone_number`, `password`, `time`) VALUES
(1, 'Sujal', 'sujalrashiya001@gmail.com', '1234567890', 'Ss1234567', '2026-03-02 07:37:40'),
(29, 'zenitsr', 'zenitsr978@rku.ac.in', '1234567890', 'Ss1234567', '2026-03-14 16:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `test_drive`
--

CREATE TABLE `test_drive` (
  `id` int(11) NOT NULL,
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
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_drive`
--

INSERT INTO `test_drive` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `model`, `preferred_date`, `preferred_time`, `location`, `comments`, `booking_status`, `created_at`, `updated_at`, `note`) VALUES
(1, 29, 'sujal', 'rashiya', 'sujalrashiya501@gmail.com', '1234567890', '5series', '2026-03-12', '10:00', 'berlin', 'sgddfhbdsfhsdfh', 'approved', '2026-03-16 13:26:58', '2026-03-16 17:42:36', ''),
(9, 29, 'Sujal', 'Rashiya', 'sujalrashiya501@gmail.com', '0987654321', '3series', '2026-03-13', '11:00', 'berlin', '', 'rejected', '2026-03-16 17:41:27', '2026-03-16 17:42:59', 'kmlkm'),
(10, 29, '', '', '', '', '', '0000-00-00', '10:00', '', '', 'pending', '2026-03-16 17:48:00', '2026-03-16 17:48:00', ''),
(11, 29, 'rewr', 'wewr', 'sujalrashiya501@gmail.com', '4456643535', '3series', '2026-03-13', '12:00', 'hamburg', 'ewrwqr', 'pending', '2026-03-16 18:02:37', '2026-03-16 18:02:37', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(6, 1, 0, '2026-03-07 12:23:26'),
(9, 1, 2, '2026-03-07 13:30:50'),
(12, 28, 3, '2026-03-09 05:53:19'),
(13, 28, 0, '2026-03-09 05:53:37'),
(14, 0, 1, '2026-03-13 05:06:23'),
(15, 29, 0, '2026-03-14 16:56:45'),
(20, 0, 0, '2026-03-14 17:07:59'),
(26, 29, 2, '2026-03-14 17:13:16'),
(27, 29, 5, '2026-03-14 17:13:21'),
(28, 0, 3, '2026-03-16 13:07:01'),
(29, 29, 1, '2026-03-27 17:47:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmw_contacts`
--
ALTER TABLE `bmw_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bmw_contact_replies`
--
ALTER TABLE `bmw_contact_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `bmw_feedback`
--
ALTER TABLE `bmw_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bmw_inquiries`
--
ALTER TABLE `bmw_inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bmw_replies`
--
ALTER TABLE `bmw_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inquiry_id` (`inquiry_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_learn_more`
--
ALTER TABLE `car_learn_more`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `register_page`
--
ALTER TABLE `register_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_drive`
--
ALTER TABLE `test_drive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmw_contacts`
--
ALTER TABLE `bmw_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bmw_contact_replies`
--
ALTER TABLE `bmw_contact_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bmw_feedback`
--
ALTER TABLE `bmw_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bmw_inquiries`
--
ALTER TABLE `bmw_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bmw_replies`
--
ALTER TABLE `bmw_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `car_learn_more`
--
ALTER TABLE `car_learn_more`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `register_page`
--
ALTER TABLE `register_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `test_drive`
--
ALTER TABLE `test_drive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bmw_contacts`
--
ALTER TABLE `bmw_contacts`
  ADD CONSTRAINT `bmw_contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register_page` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bmw_contact_replies`
--
ALTER TABLE `bmw_contact_replies`
  ADD CONSTRAINT `bmw_contact_replies_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `bmw_contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bmw_feedback`
--
ALTER TABLE `bmw_feedback`
  ADD CONSTRAINT `bmw_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register_page` (`id`);

--
-- Constraints for table `bmw_inquiries`
--
ALTER TABLE `bmw_inquiries`
  ADD CONSTRAINT `bmw_inquiries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register_page` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bmw_replies`
--
ALTER TABLE `bmw_replies`
  ADD CONSTRAINT `bmw_replies_ibfk_1` FOREIGN KEY (`inquiry_id`) REFERENCES `bmw_inquiries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register_page` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
