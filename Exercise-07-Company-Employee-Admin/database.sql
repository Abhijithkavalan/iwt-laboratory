-- ============================================================
-- IWT Exercise 07: Company Employee & Admin Portal
-- Database: iwt_exercise7
-- Role-Based Authentication Schema
-- ============================================================

CREATE DATABASE IF NOT EXISTS `iwt_exercise7` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `iwt_exercise7`;

DROP TABLE IF EXISTS `employee_profiles`;
DROP TABLE IF EXISTS `admin_profiles`;
DROP TABLE IF EXISTS `users`;

-- 1. Main Authentication Table
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'employee') NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(15) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Admin Details Table (Viewed by Employees when logged in)
CREATE TABLE `admin_profiles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `admin_code` VARCHAR(20) NOT NULL UNIQUE,
    `office_room` VARCHAR(50) NOT NULL,
    `department` VARCHAR(100) NOT NULL,
    `designation` VARCHAR(100) NOT NULL,
    `responsibilities` TEXT NOT NULL,
    `emergency_contact` VARCHAR(15) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Employee Details Table (Viewed by Admins when logged in)
CREATE TABLE `employee_profiles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `emp_code` VARCHAR(20) NOT NULL UNIQUE,
    `department` VARCHAR(100) NOT NULL,
    `designation` VARCHAR(100) NOT NULL,
    `salary` DECIMAL(10,2) NOT NULL,
    `joining_date` DATE NOT NULL,
    `performance_rating` VARCHAR(10) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Seed Sample Demonstration Accounts
-- ============================================================

-- Admin 1: username=admin1, password=admin123
INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `phone`) VALUES
(1, 'admin1', '$2y$12$n..6dEwouJcVY7ikUtcKgeWzmJ9FzTK5pFS7qN7c6CyiLnjtcjHEW', 'admin', 'Dr. Rajeshwari Murthy', 'rajeshwari.m@apextech.com', '9811223344'),
(2, 'admin2', '$2y$12$n..6dEwouJcVY7ikUtcKgeWzmJ9FzTK5pFS7qN7c6CyiLnjtcjHEW', 'admin', 'Suresh Chandra', 'suresh.c@apextech.com', '9811223355');

INSERT INTO `admin_profiles` (`user_id`, `admin_code`, `office_room`, `department`, `designation`, `responsibilities`, `emergency_contact`) VALUES
(1, 'ADM-001', 'Executive Suite 401', 'Corporate Management', 'Chief Executive Director', 'Oversees organizational policy, corporate strategy, executive audits, and financial governance.', '080-23456789'),
(2, 'ADM-002', 'Admin Block Room 204', 'Human Capital & Operations', 'VP Human Resources & Ops', 'Oversees company-wide talent acquisition, payroll management, regulatory compliance, and employee disputes.', '080-23456790');

-- Employees: password=emp123
INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `phone`) VALUES
(3, 'emp1', '$2y$12$9539EBw9NTDdNODI2sOfHOcBmT21eG3w0QUmZJ63Lo/cZiCSpFqVa', 'employee', 'Kavita Menon', 'kavita.menon@apextech.com', '9876500111'),
(4, 'emp2', '$2y$12$9539EBw9NTDdNODI2sOfHOcBmT21eG3w0QUmZJ63Lo/cZiCSpFqVa', 'employee', 'Manoj Kumar', 'manoj.kumar@apextech.com', '9876500222'),
(5, 'emp3', '$2y$12$9539EBw9NTDdNODI2sOfHOcBmT21eG3w0QUmZJ63Lo/cZiCSpFqVa', 'employee', 'Divya Nair', 'divya.nair@apextech.com', '9876500333');

INSERT INTO `employee_profiles` (`user_id`, `emp_code`, `department`, `designation`, `salary`, `joining_date`, `performance_rating`) VALUES
(3, 'EMP-101', 'Engineering', 'Lead Full-Stack Developer', 85000.00, '2022-03-15', '4.9 / 5.0'),
(4, 'EMP-102', 'Quality Assurance', 'Senior QA Automation Engineer', 68000.00, '2023-01-10', '4.7 / 5.0'),
(5, 'EMP-103', 'DevOps & Cloud', 'Cloud Infrastructure Engineer', 74000.00, '2023-08-01', '4.8 / 5.0');
