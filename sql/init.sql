CREATE TABLE `Users` (
	facebookId varchar(150) NOT NULL,
	firstName varchar(150) NOT NULL,
	lastName varchar(150) NOT NULL,
	email varchar(150) NOT NULL,
	age int,
	gender int,
	PRIMARY KEY (facebookId)
);

CREATE TABLE `Prizes` (
	prizeId int NOT NULL AUTO_INCREMENT,
	description varchar(150),
	image varchar(150),
	createdAt DATETIME NOT NULL,
	createdBy varchar(150) NOT NULL,
	updatedAt DATETIME NOT NULL,
	updatedBy varchar(150) NOT NULL,
	PRIMARY KEY (prizeId)
);

CREATE TABLE `Competitions` (
	competitionId int NOT NULL AUTO_INCREMENT,
	startDate DATETIME NOT NULL,
	endDate DATETIME NOT NULL,
	prize int,
	status BOOLEAN NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(150) NOT NULL,
	PRIMARY KEY (competitionId),
	FOREIGN KEY (prize) REFERENCES Prizes(prizeId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Photos` (
	photoId int NOT NULL AUTO_INCREMENT,
	competition int NOT NULL,
	facebookUrl varchar(150) NOT NULL,
	createdAt DATETIME NOT NULL,
	createdBy varchar(150) NOT NULL,
	PRIMARY KEY (photoId),
	FOREIGN KEY (competition) REFERENCES Competitions(competitionId),
	FOREIGN KEY (createdBy) REFERENCES Users(facebookId)
);

CREATE TABLE `Votes` (
	user varchar(150) NOT NULL,
	photo int NOT NULL,
	createdAt DATETIME NOT NULL,
	FOREIGN KEY (photo) REFERENCES Photos(photoId),
	FOREIGN KEY (user) REFERENCES Users(facebookId)
);