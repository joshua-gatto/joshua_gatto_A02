CREATE DATABASE IF NOT EXISTS joshua_gatto_syscbook;

CREATE TABLE IF NOT EXISTS users_info (
    student_ID INT(10) PRIMARY KEY AUTO_INCREMENT=100100,
    student_email VARCHAR(150),
    first_name VARCHAR(150),
    last_name VARCHAR(150),
    DOB DATE
);

CREATE TABLE IF NOT EXISTS users_program (
    student_ID INT(10) PRIMARY KEY,
    Program VARCHAR(50),
    FOREIGN KEY (student_ID) REFERENCES users_info(student_ID)
);

CREATE TABLE IF NOT EXISTS users_avatar (
    student_ID INT PRIMARY KEY,
    avatar CHAR(1),
    FOREIGN KEY (student_ID) REFERENCES users_info(student_ID)
);

CREATE TABLE IF NOT EXISTS users_address (
    student_ID INT(10) PRIMARY KEY,
    street_number INT(5),
    street_name VARCHAR(150),
    city VARCHAR(30),
    provence CHAR(2),
    postal_code CHAR(7),
    FOREIGN KEY (student_ID) REFERENCES users_info(student_ID)
);

CREATE TABLE IF NOT EXISTS users_posts (
    post_ID INT(10) AUTO_INCREMENT PRIMARY KEY,
    student_ID INT(10),
    new_post TEXT(1000),
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_ID) REFERENCES users_info(student_ID)
);

--delete all script
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE users_program;
TRUNCATE TABLE users_avatar;
TRUNCATE TABLE users_address;
TRUNCATE TABLE users_posts;
TRUNCATE TABLE users_info;

SET FOREIGN_KEY_CHECKS = 1;
ALTER TABLE users_info AUTO_INCREMENT=100100;