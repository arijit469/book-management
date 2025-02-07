-- Create database
CREATE DATABASE IF NOT EXISTS book_db;
USE book_db;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    date_added DATE DEFAULT CURRENT_DATE
);

-- Create borrow records table
CREATE TABLE borrow_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date DATE DEFAULT CURRENT_DATE,
    return_date DATE NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Insert admin user (default login: admin / password: admin123)
INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$eN0H5mlybDd6dqx8OBm.cuFqGGnF1sG2yx.4fXKvLPpdycLLh9pVi', 'admin');

-- Sample books
INSERT INTO books (title, author) VALUES 
('The Great Gatsby', 'F. Scott Fitzgerald'),
('To Kill a Mockingbird', 'Harper Lee'),
('1984', 'George Orwell'),
('Moby-Dick', 'Herman Melville'),
('Pride and Prejudice', 'Jane Austen');
