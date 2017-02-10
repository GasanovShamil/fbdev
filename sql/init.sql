DROP DATABASE IF EXISTS `fbdev`;
CREATE DATABASE `fbdev`;
USE `fbdev`;

CREATE TABLE `Users` (
	facebookId varchar(250) NOT NULL,
	firstName varchar(250) NOT NULL,
	lastName varchar(250) NOT NULL,
	email varchar(250) NOT NULL,
	birth DATETIME,
	gender varchar(250),
	token varchar(250),
	PRIMARY KEY (facebookId)
);

CREATE TABLE `Prizes` (
	prizeId int NOT NULL AUTO_INCREMENT,
	description varchar(250),
	image varchar(250),
	createdAt DATETIME NOT NULL,
	createdBy varchar(250) NOT NULL,
	PRIMARY KEY (prizeId)
);

CREATE TABLE `Contests` (
	contestId int NOT NULL AUTO_INCREMENT,
	startDate DATETIME NOT NULL,
	endDate DATETIME NOT NULL,
	prize int,
	status BOOLEAN NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(250) NOT NULL,
	PRIMARY KEY (contestId),
	FOREIGN KEY (prize) REFERENCES Prizes(prizeId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Photos` (
	photoId int NOT NULL AUTO_INCREMENT,
	contest int NOT NULL,
	facebookUrl varchar(250) NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(250) NOT NULL,
	PRIMARY KEY (photoId),
	FOREIGN KEY (contest) REFERENCES Contests(contestId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Votes` (
	user varchar(250) NOT NULL,
	photo int NOT NULL,
	createdAt DATETIME NOT NULL,
	FOREIGN KEY (photo) REFERENCES Photos(photoId),
	FOREIGN KEY (user) REFERENCES Users(facebookId)
);