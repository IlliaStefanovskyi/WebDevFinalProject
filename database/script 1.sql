create database webDevFinalProject;

use webdevfinalproject;
create table users(
userId INT,
email VARCHAR(45) NOT NULL,
password VARCHAR(45) NOT NULL,
name VARCHAR(45) NOT NULL,
phoneNum VARCHAR(10) NOT NULL,
address VARCHAR(100) NOT NULL,
primary key(userId)
);

insert into users values(0,"terminator@gmail.com","qwerty","Bob","0874783321","3828 Piermont Dr, Albuquerque, NM");

CREATE USER 'illia'@'localhost' IDENTIFIED BY 'toforget';

GRANT ALL PRIVILEGES ON webdevfinalproject.* TO 'illia'@'localhost';

FLUSH privileges;