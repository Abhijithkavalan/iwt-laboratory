-- ============================================================
-- IWT Exercise 08: Contact Management System
-- Database: iwt_exercise8
-- Table: contacts
-- ============================================================

CREATE DATABASE IF NOT EXISTS `iwt_exercise8` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `iwt_exercise8`;

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `contact_id` VARCHAR(20) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(15) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `address` TEXT NOT NULL,
    `category` ENUM('Work', 'Family', 'Friends', 'Academic', 'Emergency') NOT NULL DEFAULT 'Work',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed demonstration contacts
INSERT INTO `contacts` (`contact_id`, `name`, `phone`, `email`, `address`, `category`) VALUES
('CNT-001', 'Prof. Arvind Swaminathan', '9845112233', 'arvind.s@univ.edu', 'Department of Computer Applications, University Campus', 'Academic'),
('CNT-002', 'Aditi Kulkarni', '9876543210', 'aditi.k@techcorp.com', 'Flat 402, Skyline Towers, Outer Ring Road, Bengaluru', 'Work'),
('CNT-003', 'Ramesh Sharma', '9448123456', 'ramesh.sharma@family.net', '32 Gandhi Nagar, 2nd Cross, Mysuru', 'Family'),
('CNT-004', 'Karthik Raja', '9900112233', 'karthik.raja@coder.org', '18 Tech Park Residency, Whitefield, Bengaluru', 'Friends');
