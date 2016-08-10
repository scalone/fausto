
CREATE DATABASE news;
USE news; 

CREATE TABLE news (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(250) NOT NULL,
	created_at TIMESTAMP NOT NULL,
	body TEXT NOT NULL,
	user_id INT NOT NULL
)

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) NOT NULL,
	name VARCHAR(250) NOT NULL,
	password_hash CHAR(32) NOT NULL
)

--Criar foreign key