drop database webDevFinalProject;

create database webDevFinalProject;

use webdevfinalproject;
create table clients(
clientId INT auto_increment,
email VARCHAR(45) NOT NULL,
password VARCHAR(45) NOT NULL,
name VARCHAR(45) NOT NULL,
phoneNum VARCHAR(10) NOT NULL,
address VARCHAR(100) NOT NULL,
primary key(clientId)
);

create table cats(
catId INT auto_increment,
image VARCHAR(200),
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

create table managers(
managerId INT auto_increment,
email VARCHAR(45) NOT NULL,
password VARCHAR(45) NOT NULL,
name VARCHAR(45) NOT NULL,
phoneNumber VARCHAR(10) NOT NULL,
primary key(managerId) 
);

create table employees(
employeeId INT auto_increment,
email VARCHAR(45) NOT NULL,
password VARCHAR(45) NOT NULL,
name VARCHAR(45) NOT NULL,
jobTitle VARCHAR(45) NOT NULL,
phoneNumber VARCHAR(10) NOT NULL,
managerId INT NOT NULL,
primary key(employeeId),
FOREIGN KEY (managerId) references managers(managerId)
);

create table bookings(
bookingId INT auto_increment,
catId INT NOT NULL,
clientId INT NOT NULL,
employeeId INT NOT NULL,
time DATETIME,
primary key(bookingId),
FOREIGN KEY (catId) REFERENCES cats(catId),
FOREIGN KEY (clientId) REFERENCES clients(clientId),
FOREIGN KEY (employeeId) REFERENCES employees(employeeId)
);

create table rescues(
rescueId INT auto_increment,
clientId INT NOT NULL,
location VARCHAR(100),
date DATE NOT NULL,
desCatName VARCHAR(45),
descriptionOfCat VARCHAR(10000) NOT NULL,
descriptionOfEvent VARCHAR(1000),
status VARCHAR(50),
primary key(rescueId),
FOREIGN KEY (clientId) REFERENCES clients(clientId)
);

insert into clients values(null,"terminator@gmail.com","qwerty","Bob","0874783321","3828 Piermont Dr, Albuquerque, NM");
INSERT INTO cats values(null, "D:\A TUD university\3 Web Dev\WebDevFinalProject\src\images\img1.jpg", "Lala", 2, "Female", "Maine Coon", "Silver Tabby", 4.75, 
"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec scelerisque velit, vel aliquet tortor. 
Vestibulum et euismod ante, maximus tincidunt odio. Suspendisse sodales scelerisque lacinia. Praesent mi 
libero, molestie sed orci nec, luctus auctor mi. Maecenas in nisi eget enim vulputate convallis id quis purus. 
Nam tempus iaculis elementum.", "2025-02-10");
INSERT INTO managers values (null,"Luke Kscheshov", "0874300435");
INSERT INTO employees VALUES (null,"John Dobs","Assistant","0874653528",1);
insert into rescues values (null,1,"St. Josephs Street", "2025-02-03", "Tuko", "Rescued cat description from database received", "description of rescue event from database received","pending");
INSERT INTO bookings VALUES (null,1,1,1,'2025-02-15 17:30:00');

/*
CREATE USER 'illia'@'localhost' IDENTIFIED BY 'toforget';

GRANT ALL PRIVILEGES ON webdevfinalproject.* TO 'illia'@'localhost';

FLUSH privileges;
*/