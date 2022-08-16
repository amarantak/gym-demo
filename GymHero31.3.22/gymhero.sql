-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 03:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymhero`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `classname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `classname`) VALUES
(1, 'Yoga'),
(2, 'Pilates'),
(3, 'Hiit'),
(4, 'Crossfit'),
(5, 'MMA');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `etype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `description`, `etype`) VALUES
(1, 'Stationary bike', 'Lorem Ipsum', 'cardio'),
(2, 'Treadmill', 'Lorem ipsum', 'cardio'),
(3, 'Elliptical Cross Trainer', 'Lorem ipsum', 'cardio'),
(4, 'Rowing Machine', 'Lorem ipsum', 'cardio'),
(5, 'Ski Trainer', 'Lorem ipsum', 'cardio'),
(6, '2Kg Dumbell Bar', 'Lorem ipsum', 'weights & bars'),
(7, '5Kg Dumbell Bar', 'Lorem ipsum', 'weights & bars'),
(8, 'Bench', 'Lorem ipsum', 'strength machines'),
(9, 'Bar', 'Lorem ipsum', 'strength machines'),
(10, 'Rack', 'Lorem ipsum', 'strength machines'),
(11, 'Skipping Rope', 'Lorem ipsum', 'conditioning');

-- --------------------------------------------------------

--
-- Table structure for table `equipmentotype`
--

CREATE TABLE `equipmentotype` (
  `id` int(100) NOT NULL,
  `equipmentid` int(100) NOT NULL,
  `equipmenttypeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `equipmenttype`
--

CREATE TABLE `equipmenttype` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipmenttype`
--

INSERT INTO `equipmenttype` (`id`, `name`) VALUES
(1, 'cardio'),
(2, 'weights & bars'),
(3, 'conditioning'),
(4, 'strength machines');

-- --------------------------------------------------------

--
-- Table structure for table `membertoclass`
--

CREATE TABLE `membertoclass` (
  `id` int(100) NOT NULL,
  `memberid` int(100) NOT NULL,
  `classid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membertoclass`
--

INSERT INTO `membertoclass` (`id`, `memberid`, `classid`) VALUES
(1, 4, 1),
(2, 5, 1),
(3, 4, 4),
(4, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `membertoroutine`
--

CREATE TABLE `membertoroutine` (
  `id` int(100) NOT NULL,
  `memberid` int(100) NOT NULL,
  `staffid` int(100) NOT NULL,
  `routineid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membertoroutine`
--

INSERT INTO `membertoroutine` (`id`, `memberid`, `staffid`, `routineid`) VALUES
(1, 4, 3, 1),
(2, 5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `routinename`
--

CREATE TABLE `routinename` (
  `id` int(11) NOT NULL,
  `trainerid` int(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routinename`
--

INSERT INTO `routinename` (`id`, `trainerid`, `name`) VALUES
(1, 3, 'Routine001'),
(2, 3, 'Full Body');

-- --------------------------------------------------------

--
-- Table structure for table `routineworkouts`
--

CREATE TABLE `routineworkouts` (
  `id` int(11) NOT NULL,
  `routineid` int(100) NOT NULL,
  `workoutid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routineworkouts`
--

INSERT INTO `routineworkouts` (`id`, `routineid`, `workoutid`) VALUES
(3, 1, 3),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `stafftoclass`
--

CREATE TABLE `stafftoclass` (
  `id` int(100) NOT NULL,
  `staffid` int(100) NOT NULL,
  `classid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stafftoclass`
--

INSERT INTO `stafftoclass` (`id`, `staffid`, `classid`) VALUES
(1, 3, 1),
(2, 3, 4),
(3, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(100) NOT NULL,
  `time` varchar(50) NOT NULL,
  `dayofweek` varchar(10) NOT NULL,
  `classname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `time`, `dayofweek`, `classname`) VALUES
(1, '7am – 8am', 'monday', 'Yoga'),
(2, '7am – 8am', 'tuesday', 'Pilates'),
(3, '7am – 8am', 'wednesday', 'Yoga'),
(4, '10am – 11am', 'wednesday', 'Hiit'),
(5, '2pm – 3pm', 'thursday', 'crossfit'),
(6, '7am – 8am', 'friday', 'Pilates');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `atype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `atype`) VALUES
(2, 'admin', 'adpexzg3FUZAk', 'admin', 'admin', 'admin@gymhero.com', 'admin'),
(3, 'trainer1', 'trx/yefC/R9ug', 'trainer1', 'trainer1', 'trainer1@gymhero.com', 'staff'),
(4, 'member1', 'meXdfDneHmAts', 'member1', 'member1', 'member1@gymhero.com', 'member'),
(5, 'member2', 'meLUXZHpT1L0o', 'member2', 'member2', 'member2@gymhero.com', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `id` int(11) NOT NULL,
  `workouts` varchar(100) NOT NULL,
  `equipment` varchar(100) NOT NULL,
  `sets` int(100) NOT NULL,
  `reps` varchar(100) NOT NULL,
  `min` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workout`
--

INSERT INTO `workout` (`id`, `workouts`, `equipment`, `sets`, `reps`, `min`) VALUES
(1, 'Dumbbell bench press', 'Bench, dumbbells', 3, '8,10,12', 0),
(2, 'Leg Press', 'Leg Press', 3, '20', 0),
(3, 'bicycle', 'stationary bike', 0, 'n/a', 30),
(4, 'bicycle', 'stationary bike', 0, 'n/a', 30),
(5, 'Dumbbell bench press', 'Bench, dumbbells', 3, '8 ,10,12', 0),
(6, 'Lat pulldown', 'Adjustable cable machine, lat pulldown bar', 3, '8,10,12', 0),
(7, 'Overhead dumbbell pres', 'Dumbbells', 3, '8,10,12', 0),
(8, 'Leg press', 'leg press', 3, '8,10,12', 0),
(9, 'Lying leg curl', 'Lying leg curl', 3, '8,10,12', 0),
(10, 'Rope press down', 'Adjustable cable machine, rope attachment', 3, '8,10,12', 0),
(11, 'Barbell biceps curl', 'barbell', 3, '8,10,12', 0),
(12, 'Standing calf raise', 'box', 3, '8,10,12', 0),
(13, 'Crunch', 'no equipment', 0, '15', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmentotype`
--
ALTER TABLE `equipmentotype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmenttype`
--
ALTER TABLE `equipmenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membertoclass`
--
ALTER TABLE `membertoclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membertoroutine`
--
ALTER TABLE `membertoroutine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routinename`
--
ALTER TABLE `routinename`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routineworkouts`
--
ALTER TABLE `routineworkouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stafftoclass`
--
ALTER TABLE `stafftoclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `equipmentotype`
--
ALTER TABLE `equipmentotype`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipmenttype`
--
ALTER TABLE `equipmenttype`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membertoclass`
--
ALTER TABLE `membertoclass`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membertoroutine`
--
ALTER TABLE `membertoroutine`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routinename`
--
ALTER TABLE `routinename`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routineworkouts`
--
ALTER TABLE `routineworkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stafftoclass`
--
ALTER TABLE `stafftoclass`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
