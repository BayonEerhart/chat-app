CREATE DATABASE chatapp;

USE `chatapp`;

CREATE TABLE users (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),	
    password varchar(100),
    friends JSON NOT NULL
);

CREATE TABLE messages (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    recipient_id INT,
    content TEXT
);

