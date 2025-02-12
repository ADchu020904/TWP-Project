-- Vik.sql

-- 1) Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `userlogin`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- 2) Switch to the new database
USE `userlogin`;

-- 3) Create the 'users' table first (so 'addresses' FK references it)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) DEFAULT NULL,
  `lastName` VARCHAR(50) DEFAULT NULL,
  `email` VARCHAR(50) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

-- 4) Create the 'staff' table
CREATE TABLE IF NOT EXISTS `staff` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) DEFAULT NULL,
  `phone_number` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `position` VARCHAR(255) DEFAULT NULL,
  `department` VARCHAR(255) DEFAULT NULL,
  `bio` TEXT,
  `password` VARCHAR(255) DEFAULT NULL,
  `photo` LONGBLOB,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

-- 5) Create the 'addresses' table (with FK to users.id)
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `full_name` VARCHAR(255) DEFAULT NULL,
  `country_code` VARCHAR(10) DEFAULT NULL,
  `phone_number` VARCHAR(20) DEFAULT NULL,
  `address` TEXT,
  `postal_code` VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_addresses_user`
    FOREIGN KEY (`user_id`) 
    REFERENCES `users`(`id`) 
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

-- 6) Insert a row for "Goh Jia He" in 'staff'
INSERT INTO `staff`(
  `name`,
  `phone_number`,
  `email`,
  `position`,
  `department`,
  `bio`,
  `password`
) VALUES (
  'Goh Jia He',
  '0123456789',
  'goh@gmail.com',
  'Warehouse Manager',
  'Operations',
  'Hi',
  '$2y$10$Ve1yVN2nmyPRyoCuHu2UuuwKxRVZGEM0JvWAzEWYNnnRwb/GR2P1e'
);

-- End of Vik.sql
