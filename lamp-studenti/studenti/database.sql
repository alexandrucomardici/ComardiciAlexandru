-- CREARE BAZĂ DE DATE
CREATE DATABASE IF NOT EXISTS moto_shop;
USE moto_shop;

-- TABEL UTILIZATORI
CREATE TABLE users (
user_id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) UNIQUE NOT NULL,
email VARCHAR(150) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
role ENUM('admin', 'user') DEFAULT 'user',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABEL ADRESE UTILIZATOR
CREATE TABLE user_addresses (
address_id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
full_name VARCHAR(150),
phone VARCHAR(20),
country VARCHAR(100),
city VARCHAR(100),
street VARCHAR(255),
postal_code VARCHAR(20),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- TABEL CATEGORII PRODUSE
CREATE TABLE categories (
category_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) UNIQUE NOT NULL
);

INSERT INTO categories (name) VALUES
('Ulei și filtre'),
('Accesorii'),
('Anvelope'),
('BFriday'),
('Carene'),
('Frâne'),
('Motoare');

-- TABEL PRODUSE
CREATE TABLE products (
product_id INT AUTO_INCREMENT PRIMARY KEY,
category_id INT NOT NULL,
name VARCHAR(200) NOT NULL,
description TEXT,
price DECIMAL(10,2) NOT NULL,
stock INT DEFAULT 0,
image_url VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

-- TABEL COȘ DE CUMPĂRĂTURI
CREATE TABLE cart (
cart_id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
product_id INT NOT NULL,
quantity INT DEFAULT 1,
added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- TABEL COMENZI
CREATE TABLE orders (
order_id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
address_id INT NOT NULL,
total DECIMAL(10,2) NOT NULL,
status ENUM('pending','processing','shipped','completed','cancelled') DEFAULT 'pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
FOREIGN KEY (address_id) REFERENCES user_addresses(address_id)
);

-- DETALII PENTRU PRODUSELE DINTR-O COMANDĂ
CREATE TABLE order_items (
order_item_id INT AUTO_INCREMENT PRIMARY KEY,
order_id INT NOT NULL,
product_id INT NOT NULL,
quantity INT NOT NULL,
price DECIMAL(10,2) NOT NULL,
FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- WISHLIST UTILIZATORI
CREATE TABLE wishlist (
wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
product_id INT NOT NULL,
added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- ISTORIC STOC
CREATE TABLE stock_history (
history_id INT AUTO_INCREMENT PRIMARY KEY,
product_id INT NOT NULL,
quantity_change INT NOT NULL,
action ENUM('add','remove','order') NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- CREARE UTILIZATOR ADMIN EXEMPLU
INSERT INTO users (username, email, password, role)
VALUES ('admin', '[admin@example.com](mailto:admin@example.com)', 'admin123', 'admin');
