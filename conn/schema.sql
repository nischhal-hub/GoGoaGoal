-- Create database if not exists
CREATE DATABASE IF NOT EXISTS golazo;

-- Use the created database
USE golazo;

-- Create the staff table
CREATE TABLE IF NOT EXISTS staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    staff_name VARCHAR(255) NOT NULL,
    staff_avatar MEDIUMBLOB NOT NULL,
    staff_contact VARCHAR(20) NOT NULL,
    staff_email VARCHAR(255),
    staff_join_date DATE NOT NULL
);

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role ENUM('ADMIN', 'STAFF'),
    staff_id INT,
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
INSERT INTO users (user_name, user_password, user_role) VALUES ('admin', '$2y$10$WSpH0G1io8qBKimw6JBF..qpY8sH/UhTf5mg5.rxXjVTbloQ8Cb6.', 'ADMIN');
INSERT INTO users (user_name, user_password, user_role) VALUES ('staff', '$2y$10$LHVULzOqbZCLmeU6KIHDLuPsz1Y/5Z5zCtasmmUkNmGtkutuIHyba', 'STAFF');


-- Create the bookings table
CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    initiator VARCHAR(255) NOT NULL,
    initiator_contact VARCHAR(15) NOT NULL,
    booking_date DATE NOT NULL,
    booking_slot ENUM('6-7 AM', '7-8 AM', '8-9 AM', '9-10 AM', '10-11 AM', '11-12 PM', 
                      '12-1 PM', '1-2 PM', '2-3 PM', '3-4 PM', '4-5 PM', '5-6 PM', 
                      '6-7 PM') NOT NULL,
    payment_status ENUM('paid', 'pending') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the checkout table
CREATE TABLE IF NOT EXISTS checkout (
    checkout_id INT AUTO_INCREMENT PRIMARY KEY,
    bottles_used INT NOT NULL,
    per_bottle_cost DECIMAL(10, 2) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    checkout_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    booking_id INT, 
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) 
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- Create the expenditure table
CREATE TABLE IF NOT EXISTS expenditure (
    exp_id INT AUTO_INCREMENT PRIMARY KEY,
    exp_name VARCHAR(255) NOT NULL,
    exp_item_num INT NOT NULL,
    exp_amount DECIMAL(10, 2) NOT NULL,
    exp_date DATE NOT NULL
);
