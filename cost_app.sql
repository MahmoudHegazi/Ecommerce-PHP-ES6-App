-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2021 at 07:07 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cost_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocate_resources`
--

CREATE TABLE `allocate_resources` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL,
  `resource_name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocate_resources`
--

INSERT INTO `allocate_resources` (`id`, `task_name`, `duration`, `start`, `finish`, `resource_name`) VALUES
(23, 'first task', '5', '2021-04-09 00:00:00', '2021-04-14 00:00:00', 'resource test'),
(24, 'x', '5', '2021-04-09 00:00:00', '2021-04-14 00:00:00', 'resource test'),
(25, 'x', '5', '2021-04-09 00:00:00', '2021-04-14 00:00:00', 'resource test'),
(26, 'x', '5', '2021-04-09 00:00:00', '2021-04-14 00:00:00', 'resource test'),
(27, 'Python king', '10', '2021-04-23 00:00:00', '2021-05-03 00:00:00', 'new resource'),
(28, 'New awesome task', '6', '2021-04-10 00:00:00', '2021-04-16 00:00:00', 'nice resource'),
(29, 'nice1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(30, 'nice1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(31, 'nice1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(32, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(33, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(34, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(35, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(36, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(37, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(38, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(39, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(40, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(41, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(42, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(43, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(44, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(45, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(46, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(47, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(48, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(49, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(50, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(51, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(52, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(53, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(54, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(55, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(56, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(57, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(58, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(59, 'x', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(60, 'New task1', '20', '2021-04-17 00:00:00', '2021-05-07 00:00:00', 'another resource'),
(61, 'New task1', '20', '2021-04-17 00:00:00', '2021-05-07 00:00:00', 'resource test'),
(62, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(63, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(64, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(65, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(66, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(67, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(68, 'New task1', '5', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 'resource test'),
(69, 'project_task1', '7', '2021-04-10 00:00:00', '2021-04-17 00:00:00', 'project_task1_items'),
(70, 'project_task2', '6', '2021-04-23 00:00:00', '2021-04-29 00:00:00', 'project_task2_items'),
(71, 'project_task3', '3', '2021-04-28 00:00:00', '2021-05-01 00:00:00', 'project_task3_items'),
(72, 'project_task4', '2', '2021-04-30 00:00:00', '2021-05-02 00:00:00', 'project_task4_items'),
(73, 'Task Zero', '7', '2021-04-28 00:00:00', '2021-05-05 00:00:00', 'Task Zero Resource');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `resource_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` enum('work','cost','material') CHARACTER SET utf8 NOT NULL,
  `material_max` int(11) DEFAULT NULL,
  `st_rate` varchar(100) NOT NULL,
  `ovt` int(50) DEFAULT NULL,
  `cost` int(50) DEFAULT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `resource_name`, `type`, `material_max`, `st_rate`, `ovt`, `cost`, `task_id`) VALUES
(46, 'resource test', 'work', 100, '15$/hr', 0, 120, 62),
(47, 'resource test', 'work', 100, '15$/hr', 0, 120, 63),
(48, 'resource test', 'work', 100, '15$/hr', 0, 120, 65),
(49, 'resource test', 'work', 100, '15$/hr', 0, 120, 65),
(50, 'new resource', 'work', 65, '15$/hr', 0, 78, 66),
(51, 'nice resource', 'work', 100, '15$/hr', 0, 720, 67),
(52, 'resource test', 'work', 100, '15$/hr', 0, 600, 68),
(53, 'resource test', 'work', 100, '15$/hr', 0, 600, 69),
(54, 'resource test', 'work', 100, '15$/hr', 0, 600, 70),
(55, 'resource test', 'work', 100, '15$/hr', 0, 600, 71),
(56, 'resource test', 'work', 100, '15$/hr', 0, 600, 72),
(57, 'resource test', 'work', 100, '15$/hr', 0, 600, 73),
(58, 'resource test', 'work', 100, '15$/hr', 0, 600, 88),
(59, 'resource test', 'work', 100, '15$/hr', 0, 600, 88),
(60, 'resource test', 'work', 100, '15$/hr', 0, 600, 89),
(61, 'resource test', 'work', 100, '15$/hr', 0, 600, 89),
(62, 'resource test', 'work', 100, '15$/hr', 0, 600, 89),
(63, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(64, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(65, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(66, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(67, 'resource test', 'work', 100, '12$/hr', 0, 480, 95),
(68, 'resource test', 'work', 100, '12$/hr', 0, 480, 95),
(69, 'resource test', 'work', 100, '12$/hr', 0, 480, 95),
(70, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(71, 'resource test', 'work', 12, '15$/hr', 0, 72, 95),
(72, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(73, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(74, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(75, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(76, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(77, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(78, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(79, 'resource test', 'work', 100, '15$/hr', 0, 600, 95),
(80, 'resource test', 'work', 100, '15$/hr', 0, 600, 96),
(81, 'resource test', 'work', 100, '15$/hr', 0, 600, 97),
(82, 'resource test', 'work', 100, '15$/hr', 0, 600, 101),
(83, 'another resource', 'work', 100, '25$/hr', 0, 4000, 102),
(84, 'resource test', 'work', 80, '12$/hr', 0, 1536, 102),
(85, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(86, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(87, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(88, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(89, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(90, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(91, 'resource test', 'work', 80, '12$/hr', 0, 384, 107),
(92, 'project_task1_items', 'cost', 100, '500$', 0, 100, 108),
(93, 'project_task2_items', 'cost', 100, '500$', 0, 100, 109),
(94, 'project_task3_items', 'cost', 100, '600$', 0, 600, 110),
(95, 'project_task4_items', 'work', 100, '15$/hr', 0, 240, 111),
(96, 'Task Zero Resource', 'work', 100, '15$/hr', 0, 840, 112);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `taskname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `duration` int(25) NOT NULL,
  `start` datetime NOT NULL,
  `finish` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `taskname`, `duration`, `start`, `finish`) VALUES
(62, 'first task', 5, '2021-04-09 00:00:00', '2021-04-14 00:00:00'),
(63, 'x', 5, '2021-04-09 00:00:00', '2021-04-14 00:00:00'),
(64, 'x', 5, '2021-04-09 00:00:00', '2021-04-14 00:00:00'),
(65, 'x', 5, '2021-04-09 00:00:00', '2021-04-14 00:00:00'),
(66, 'Python king', 10, '2021-04-23 00:00:00', '2021-05-03 00:00:00'),
(67, 'New awesome task', 6, '2021-04-10 00:00:00', '2021-04-16 00:00:00'),
(68, 'nice1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(69, 'nice1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(70, 'nice1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(71, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(72, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(73, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(74, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(75, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(76, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(77, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(78, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(79, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(80, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(81, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(82, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(83, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(84, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(85, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(86, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(87, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(88, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(89, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(90, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(91, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(92, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(93, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(94, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(95, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(96, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(97, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(98, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(99, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(100, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(101, 'x', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(102, 'New task1', 20, '2021-04-17 00:00:00', '2021-05-07 00:00:00'),
(103, 'New task1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(104, 'New task1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(105, 'New task1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(106, 'New task1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(107, 'New task1', 5, '2021-04-10 00:00:00', '2021-04-15 00:00:00'),
(108, 'project_task1', 7, '2021-04-10 00:00:00', '2021-04-17 00:00:00'),
(109, 'project_task2', 6, '2021-04-23 00:00:00', '2021-04-29 00:00:00'),
(110, 'project_task3', 3, '2021-04-28 00:00:00', '2021-05-01 00:00:00'),
(111, 'project_task4', 2, '2021-04-30 00:00:00', '2021-05-02 00:00:00'),
(112, 'Task Zero', 7, '2021-04-28 00:00:00', '2021-05-05 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocate_resources`
--
ALTER TABLE `allocate_resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_task` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocate_resources`
--
ALTER TABLE `allocate_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_task` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
