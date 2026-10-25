-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2026 at 11:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipeID` int(11) NOT NULL,
  `recipeName` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `mainIngredient` varchar(100) NOT NULL,
  `cookingTime` int(11) NOT NULL,
  `recipeImage` varchar(255) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipeID`, `recipeName`, `category`, `mainIngredient`, `cookingTime`, `recipeImage`, `userID`) VALUES
(1, 'Chicken Adobo', 'Main Dish', 'Chicken', 55, 'recipe_6acd1697406c76.75311686_100.png', 1),
(2, 'Beef Caldereta', 'Main Dish', 'Beef', 90, 'recipe_6acd16be6aecd7.59142416_100.png', 1),
(4, 'Pork Sinigang', 'Main Dish', 'Pork', 60, 'recipe_6acd16d8945e89.35872938_100.png', 1),
(5, 'Pork Dinuguan', 'Main Dish', 'Pork', 60, 'recipe_6acd142266c0f7.03585653_100.png', 1),
(9, 'Chicken Tinola', 'Main Dish', 'Chicken', 50, 'recipe_6acd14f765d270.39604281_100.png', 1),
(10, 'Bicol Express', 'Main Dish', 'Pork', 60, 'Bicol Express_100.png', 1),
(11, 'Chicken Afritada', 'Main Dish', 'Chicken', 50, 'placeholder_100.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `userID` int(4) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `failedAttempts` int(4) DEFAULT NULL,
  `lastFailedLogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipeID`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
