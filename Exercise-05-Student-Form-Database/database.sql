-- ============================================================
-- IWT Exercise 05: Employee Database Setup Script
-- Database: iwt_exercise5
-- Table: employees
-- ============================================================

CREATE DATABASE IF NOT EXISTS `iwt_exercise5` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `iwt_exercise5`;

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `emp_id` VARCHAR(20) NOT NULL UNIQUE,
    `full_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(15) NOT NULL,
    `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
    `dob` DATE NOT NULL,
    `department` VARCHAR(50) NOT NULL,
    `designation` VARCHAR(60) NOT NULL,
    `salary` DECIMAL(10, 2) NOT NULL,
    `address` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed initial demonstration records
INSERT INTO `employees` (`emp_id`, `full_name`, `email`, `phone`, `gender`, `dob`, `department`, `designation`, `salary`, `address`) VALUES
('EMP101', 'Arun Kumar', 'arun.kumar@techcorp.com', '9876543210', 'Male', '1996-05-14', 'Computer Science', 'Senior Software Engineer', 75000.00, '42 Palm Grove, Indiranagar, Bengaluru'),
('EMP102', 'Priya Sundaram', 'priya.s@techcorp.com', '9845123456', 'Female', '1998-08-22', 'Information Technology', 'Full Stack Developer', 62000.00, '15 Green Meadows, Whitefield, Bengaluru'),
('EMP103', 'Rohan Verma', 'rohan.verma@techcorp.com', '9711223344', 'Male', '1995-11-03', 'Human Resources', 'HR Operations Lead', 54000.00, '88 Lakeview Residency, Koramangala, Bengaluru');
