DROP DATABASE IF EXISTS `fbdev`;
CREATE DATABASE `fbdev`;
USE `fbdev`;

CREATE TABLE `Users` (
	facebookId varchar(150) NOT NULL,
	firstName varchar(150) NOT NULL,
	lastName varchar(150) NOT NULL,
	email varchar(150) NOT NULL,
	birth DATETIME,
	gender varchar(150),
	PRIMARY KEY (facebookId)
);

CREATE TABLE `Prizes` (
	prizeId int NOT NULL AUTO_INCREMENT,
	description varchar(150),
	image varchar(150),
	createdAt DATETIME NOT NULL,
	createdBy varchar(150) NOT NULL,
	PRIMARY KEY (prizeId)
);

CREATE TABLE `Contest` (
	contestId int NOT NULL AUTO_INCREMENT,
	startDate DATETIME NOT NULL,
	endDate DATETIME NOT NULL,
	prize int,
	status BOOLEAN NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(150) NOT NULL,
	PRIMARY KEY (contestId),
	FOREIGN KEY (prize) REFERENCES Prizes(prizeId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Photos` (
	photoId int NOT NULL AUTO_INCREMENT,
	contest int NOT NULL,
	facebookUrl varchar(150) NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(150) NOT NULL,
	PRIMARY KEY (photoId),
	FOREIGN KEY (contest) REFERENCES Contest(contestId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Votes` (
	user varchar(150) NOT NULL,
	photo int NOT NULL,
	createdAt DATETIME NOT NULL,
	FOREIGN KEY (photo) REFERENCES Photos(photoId),
	FOREIGN KEY (user) REFERENCES Users(facebookId)
);