-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 10:22 PM
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
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogs`
--

CREATE TABLE `adminlogs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventcategories`
--

CREATE TABLE `eventcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventresources`
--

CREATE TABLE `eventresources` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `category` enum('Academic','Cultural','Sports','Social','Technical') NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `venue` varchar(150) DEFAULT NULL,
  `registration_deadline` date DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `status` enum('Draft','Published','Completed','Cancelled') DEFAULT 'Draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `category`, `organizer_id`, `date`, `start_time`, `end_time`, `venue`, `registration_deadline`, `max_participants`, `is_approved`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MD ZUABYER Talukder', 'sdsdas', 'Sports', 1, '2024-12-01', '23:43:00', '21:47:00', 'Dhaka', '2024-12-17', 11, 1, 'Draft', '2024-12-01 15:43:16', '2024-12-01 15:43:16'),
(2, 'user1', 'sdsdasd', 'Cultural', 3, '2024-12-02', '00:00:00', '00:00:00', 'Dhaka', '0000-00-00', 0, 1, 'Draft', '2024-12-01 18:30:24', '2024-12-01 18:30:24'),
(3, 'riya', 'hey', 'Academic', 3, '2024-12-02', '02:04:00', '00:00:00', 'mirpur', '2024-12-18', 0, 1, 'Draft', '2024-12-01 19:04:37', '2024-12-01 19:04:37'),
(4, 'Diu Job', 'Diu Job', 'Sports', 3, '2024-10-02', '01:42:00', '00:00:00', 'DIU', '2024-08-02', 0, 1, 'Draft', '2024-12-01 19:43:00', '2024-12-01 19:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status` enum('Registered','Waitlisted','Cancelled') DEFAULT 'Registered',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `user_id`, `event_id`, `status`, `registration_date`) VALUES
(1, 1, 1, 'Registered', '2024-12-01 15:45:30'),
(2, 6, 1, 'Registered', '2024-12-01 19:32:18'),
(3, 6, 3, 'Registered', '2024-12-01 19:41:27'),
(4, 7, 1, 'Registered', '2024-12-01 20:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Student','Faculty','Admin') NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `university_id` varchar(50) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `department`, `university_id`, `profile_picture`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'MD ZUABYER Talukder', 'mdzubayertalukder@gmail.com', '$2y$10$a2AbVdsmvBPSHA4372bJMuvhPm7ous9ZtCgYyoj09Y8eV7TVdj7sO', 'Faculty', NULL, NULL, NULL, NULL, '2024-12-01 15:40:25', '2024-12-01 15:40:25'),
(2, 'Asif illah', 'user@gmail.com', '$2y$10$YPHLRXC59duCQLnislDYbOSwl9NCOGfy5fCJmGeTQaHpJuFYmkHc2', 'Student', NULL, NULL, NULL, NULL, '2024-12-01 16:13:34', '2024-12-01 16:13:34'),
(3, 'Mariya Akter ', 'admin@gmail.com', '$2y$10$JOEuzHnYrKe1HDGU9Cm.buI4SPQMgpaMSjvAs8HujQEfLIeGGpwnW', 'Faculty', NULL, NULL, NULL, NULL, '2024-12-01 18:20:29', '2024-12-01 18:20:29'),
(5, '', '', '$2y$10$c8tqOfAHMNzxeuHEMpiiRu8pjT7NZ7dt99iPCB/QImE2/4HsZG6CW', '', NULL, NULL, NULL, NULL, '2024-12-01 19:21:53', '2024-12-01 19:21:53'),
(6, 'MD ZUABYER', 'mdzubayertalukder1@gmail.com', '$2y$10$QgjJUinRKxwqFu.zpxRF9esOr9Gb/g.k4brQBmlDyF7Oq8HuyVuqW', 'Student', NULL, NULL, NULL, NULL, '2024-12-01 19:23:26', '2024-12-01 19:23:26'),
(7, 'Robin Das', 'robin@gmail.com', '$2y$10$HRZXqsQRGXQoUZN1WZuLO.fpbO3IS6MUVxyo8iAnwFHYmMLnCRk5y', 'Student', NULL, NULL, NULL, NULL, '2024-12-01 20:01:43', '2024-12-01 20:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogs`
--
ALTER TABLE `adminlogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `eventcategories`
--
ALTER TABLE `eventcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `eventresources`
--
ALTER TABLE `eventresources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogs`
--
ALTER TABLE `adminlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventcategories`
--
ALTER TABLE `eventcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventresources`
--
ALTER TABLE `eventresources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminlogs`
--
ALTER TABLE `adminlogs`
  ADD CONSTRAINT `adminlogs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `eventresources`
--
ALTER TABLE `eventresources`
  ADD CONSTRAINT `eventresources_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
