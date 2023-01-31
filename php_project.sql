-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2021 at 03:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'alfin', 'alfin@gmail.com', '5d93ceb70e2bf5daa84ec3d0cd2c731a');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(16, '53.00', 'paid', 1, 2147483647, 'bogor', 'cina', '2021-11-03 18:33:09'),
(17, '103.00', 'not paid', 1, 2147483647, 'bogor', 'cina', '2021-11-03 18:33:49'),
(18, '50.00', 'paid', 1, 2147483647, 'bogor', 'cina', '2021-11-03 18:38:02'),
(19, '50.00', 'not paid', 1, 2147483647, 'bogor', 'cina', '2021-11-04 06:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `user_id`, `order_date`) VALUES
(21, 16, '4', 'Java Programming', 'java.jpg', '53.00', 1, '2021-11-03'),
(22, 17, '4', 'Java Programming', 'java.jpg', '53.00', 1, '2021-11-03'),
(23, 17, '1', 'HTML CSS', 'html-css.jpg', '50.00', 1, '2021-11-03'),
(24, 18, '3', 'Basic C#', 'c.jpg', '50.00', 1, '2021-11-03'),
(25, 19, '1', 'HTML CSS', 'html-css.jpg', '50.00', 1, '2021-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
(6, 18, 1, '5FX2328307409712M', '2021-11-03 18:38:47'),
(7, 16, 1, '8VW32542HN948841J', '2021-11-03 18:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`) VALUES
(1, 'HTML CSS', 'Basic Programming', 'Learn modern HTML5, CSS3 and web design by building a stunning website for your portfolio! Includes flexbox and CSS Grid.', 'html-css.jpg', '50.00'),
(2, 'Python Programming', 'Basic Programming', 'Welcome to the world of Python Programming Basics for Beginners. Learn programming skills of Python.', 'python1.jpg', '55.00'),
(3, 'Basic C#', 'Basic Programming', 'Take your first step into the world of programming with this beginner course on C#. Become a programmer today!', 'c.jpg', '50.00'),
(4, 'Java Programming', 'Basic Programming', 'Learn JAVA Programming Language.', 'java.jpg', '53.00'),
(6, 'C Programming', 'Basic Programming', 'Latest 2020 C Programming Course, Basic to Advance C, Covers Academic Syllabus of Computer Science for C.', 'c1.jpg', '53.00'),
(7, 'Visual Basic .NET', 'Basic Programming', 'Want to learn how to program with VB.NET? This beginners guide to programming in Visual Basic.NET will show you how.', 'vb.jpg', '53.00'),
(8, 'MEVN stack', 'Web Development', 'Build (PWA & Machine Learning) Shopping Cart APP Using Vue Vuex Node Express MongoDB Brain.js (unit & integration) test.', 'mevn.jpg', '20.00'),
(9, 'Python and Django', 'Web Development', 'Learn to build websites with HTML , CSS , Bootstrap , Javascript , jQuery , Python 3 , and Django!', 'django.jpg', '55.00'),
(10, 'MERN Fullstack', 'Web Development', 'Build fullstack React.js applications with Node.js, Express.js & MongoDB (MERN) with this project-focused course.', 'mern.jpg', '53.00'),
(11, 'Practical MEAN', 'Web Development', 'Learn to build a complete project end to end using MongoDB, Angular, Express, NodeJS and Bootstrap.', 'mean.jpg', '55.00'),
(12, 'Flutter & Dart', 'Mobile Development', 'A Complete Guide to the Flutter SDK & Flutter Framework for building native iOS and Android apps.', 'flutter.jpg', '54.00'),
(13, 'React Native + Hooks', 'Mobile Development', 'Understand React Native with Hooks, Context, and React Navigation.', 'react-native.jpg', '54.00'),
(14, 'Ionic and Angular', 'Mobile Development', 'Build Native iOS & Android as well as Progressive Web Apps with Angular, Capacitor and the Ionic Framework (Ionic 4+).', 'ionic.jpg', '80.00'),
(15, 'IOS 10 & Swift 3', 'Mobile Development', 'The most comprehensive course on iOS development - become a master of app development.', 'swift.jpg', '54.00'),
(16, 'Learn Kotlin', 'Mobile Development', 'Learn Kotlin Android App Development And Become an Android Developer. Incl. Kotlin Tutorial and Android Tutorial Videos.', 'kotlin.jpg', '54.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`) VALUES
(1, 'Rama', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 'rama@gmail.com'),
(2, 'alfin', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 'alfin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
