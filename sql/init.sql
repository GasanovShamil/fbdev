DROP DATABASE IF EXISTS `fbdev`;
CREATE DATABASE `fbdev`;
USE `fbdev`;

-- INIT

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

CREATE TABLE `Contests` (
	contestId int NOT NULL AUTO_INCREMENT,
	name varchar(250),
	startDate DATETIME NOT NULL,
	endDate DATETIME NOT NULL,
	prize varchar(250),
	status BOOLEAN NOT NULL,
	multipleParticipation BOOLEAN NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(250) NOT NULL,
	PRIMARY KEY (contestId),
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
	PRIMARY KEY (user, photo),
	FOREIGN KEY (photo) REFERENCES Photos(photoId),
	FOREIGN KEY (user) REFERENCES Users(facebookId)
);

-- INSERT

INSERT INTO `Users` (`facebookId`, `firstName`, `lastName`, `email`) VALUES 
('admin', 'admin', 'admin', 'admin@mail.com'),
('test-un', 'un', 'test', 'un@mail.com'),
('test-deux', 'deux', 'test', 'deux@mail.com'),
('test-trois', 'trois', 'test', 'trois@mail.com');

INSERT INTO `Contests` (`name`,`startDate`, `endDate`, `prize`, `status`, `multipleParticipation`, `createdAt`, `createdBy`) VALUES 
('Concours Test', '2017-02-01', '2017-02-27', 'prix à gagner', 1, 1, '2017-02-10', 'admin');

INSERT INTO `Photos` (`contest`, `facebookUrl`, `createdAt`, `createdBy`) VALUES 
(1, 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/16602588_615885281936972_8509153474097716860_n.jpg?oh=6bc8067ac729309f45c3c9f513947ac0&oe=593CF5F6', '2017-02-10', 'test-un'),
(1, 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/16641093_10211860358775207_3708443820249674489_n.jpg?oh=e9fd6ed37ee43aa57bb81f978fdb6b4d&oe=5939105B', '2017-02-10', 'test-deux'),
(1, 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-0/s480x480/16387300_995669103911333_2027950331764620754_n.jpg?oh=782da38efebbc509b0991d1ed7dbbb94&oe=594BEF56', '2017-02-10', 'test-trois');