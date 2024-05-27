CREATE TABLE `users` (
  `user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL
)

CREATE TABLE `admins` (
  `admin_id` INT PRIMARY KEY AUTO_INCREMENT,
  `a_uname` VARCHAR(255) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL
);

CREATE TABLE room (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_no INT UNIQUE KEY,
    room_type VARCHAR(50) NOT NULL,
    bed_type VARCHAR(50) NOT NULL,
    rate DECIMAL(10, 2) NOT NULL,
    status ENUM('Available', 'Booked') DEFAULT 'Available'
);

CREATE TABLE booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    user_id INT NOT NULL,
    checkin_date DATE NOT NULL,
    checkout_date DATE NOT NULL,
    status ENUM('Confirmed', 'Cancelled') DEFAULT 'Confirmed',
    total_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (room_id) REFERENCES room(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
