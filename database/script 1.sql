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

create table cats(
catId INT,
name VARCHAR(45) NOT NULL,
age INT,
gender VARCHAR(45),
breed VARCHAR(45),
color VARCHAR(45),
weight DOUBLE NOT NULL,
description VARCHAR(10000),
inboundDate DATE NOT NULL,
primary key(catId)
);

create table bookings(
bookingId INT,
catId INT NOT NULL,
userId INT NOT NULL,
time DATETIME,
primary key(bookingId),
FOREIGN KEY (catId) REFERENCES cats(catId),
FOREIGN KEY (userId) REFERENCES users(userId)
);

create table rescues(
rescueId INT,
userId INT NOT NULL,
location VARCHAR(100),
date DATE NOT NULL,
desCatName VARCHAR(45),
descriptionOfCat VARCHAR(10000) NOT NULL,
descriptionOfEvent VARCHAR(1000),
primary key(rescueId),
FOREIGN KEY (userId) REFERENCES users(userId)
);

insert into users values(0,"terminator@gmail.com","qwerty","Bob","0874783321","3828 Piermont Dr, Albuquerque, NM");
INSERT INTO cats VALUES (0, "Lala", 2, "Female", "Maine Coon", "Silver Tabby", 4.75, 
"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec scelerisque velit, vel aliquet tortor. 
Vestibulum et euismod ante, maximus tincidunt odio. Suspendisse sodales scelerisque lacinia. Praesent mi 
libero, molestie sed orci nec, luctus auctor mi. Maecenas in nisi eget enim vulputate convallis id quis purus. 
Nam tempus iaculis elementum.", "2025-02-10");
INSERT INTO bookings VALUES (0,0,0,'2025-02-15 17:30:00');


CREATE USER 'illia'@'localhost' IDENTIFIED BY 'toforget';

GRANT ALL PRIVILEGES ON webdevfinalproject.* TO 'illia'@'localhost';

FLUSH privileges;