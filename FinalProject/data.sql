CREATE DATABASE IF NOT EXISTS cs_350;

CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(120),
    password VARCHAR(120)
);

CREATE TABLE IF NOT EXISTS motorcycles (
    motorcycle_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    manufacturer VARCHAR(120),
    model VARCHAR(120),
    year INT,
    engine int,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
