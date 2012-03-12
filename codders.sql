CREATE DATABASE IF NOT EXISTS codders;

USE codders;

CREATE TABLE IF NOT EXIST users
(
	user_id INT(10) AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(40) NOT NULL,
	password VARCHAR(40) NOT NULL,
	date_registered DATETIME NOT NULL
);