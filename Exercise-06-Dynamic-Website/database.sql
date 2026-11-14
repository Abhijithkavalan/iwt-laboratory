-- ============================================================
-- IWT Exercise 06: Department Dynamic Website Database
-- Database: iwt_exercise6
-- Table: users
-- ============================================================

CREATE DATABASE IF NOT EXISTS `iwt_exercise6` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `iwt_exercise6`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(15) NOT NULL,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed sample demo account
-- Username: student1
-- Password: password123
INSERT INTO `users` (`name`, `email`, `phone`, `username`, `password`) VALUES
('Vikas Sharma', 'vikas.sharma@dept.edu', '9876501234', 'student1', '$2y$12$ffr3DxiikbAIUPIvF.4ouOrH4YrkFyUHsQ8xGuUEQVufyEMeRlBCC'),
('Sneha Patel', 'sneha.patel@dept.edu', '9876505678', 'sneha_p', '$2y$12$ffr3DxiikbAIUPIvF.4ouOrH4YrkFyUHsQ8xGuUEQVufyEMeRlBCC');
