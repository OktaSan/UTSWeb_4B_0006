-- Database script untuk aplikasi UTSWeb
CREATE DATABASE IF NOT EXISTS utsweb DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE utsweb;

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price INT DEFAULT 0
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123')
ON DUPLICATE KEY UPDATE password = VALUES(password);
