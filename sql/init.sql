DROP DATABASE IF EXISTS `fbdev`;
CREATE DATABASE `fbdev`;
USE `fbdev`;

-- INIT

CREATE TABLE `Users` (
	facebookId varchar(250) NOT NULL,
	firstName varchar(250) NOT NULL,
	lastName varchar(250) NOT NULL,
	email varchar(250) NOT NULL,
	birth DATE,
	gender varchar(250),
	token varchar(250),
	PRIMARY KEY (facebookId)
);

CREATE TABLE `Contests` (
	contestId int NOT NULL AUTO_INCREMENT,
	name varchar(250),
	startDate DATE NOT NULL,
	endDate DATE NOT NULL,
	prize varchar(250),
	status BOOLEAN NOT NULL,
	multipleParticipation BOOLEAN NOT NULL,
	createdAt DATE NOT NULL,
	createdBy varchar(250) NOT NULL,
	PRIMARY KEY (contestId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Photos` (
	photoId int NOT NULL AUTO_INCREMENT,
	contest int NOT NULL,
	facebookUrl varchar(250) NOT NULL,
	createdAt DATE NOT NULL,
	createdBy varchar(250) NOT NULL,
	PRIMARY KEY (photoId),
	FOREIGN KEY (contest) REFERENCES Contests(contestId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Votes` (
	user varchar(250) NOT NULL,
	photo int NOT NULL,
	createdAt DATE NOT NULL,
	PRIMARY KEY (user, photo),
	FOREIGN KEY (photo) REFERENCES Photos(photoId),
	FOREIGN KEY (user) REFERENCES Users(facebookId)
);

-- INSERT

INSERT INTO `Users` (`facebookId`, `firstName`, `lastName`, `email`) VALUES 
('admin', 'admin', 'admin', 'admin@mail.com');

INSERT INTO `Contests` (`name`,`startDate`, `endDate`, `prize`, `status`, `multipleParticipation`, `createdAt`, `createdBy`) VALUES 
('Concours Test', '2017-02-01', '2017-02-27', 'prix à gagner', 1, 1, '2017-02-10', 'admin');
