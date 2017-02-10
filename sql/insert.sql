USE `fbdev`;

INSERT INTO `Users` (`facebookId`, `firstName`, `lastName`, `email`) VALUES 
('admin', 'admin', 'admin', 'admin@mail.com'),
('test-un', 'un', 'test', 'un@mail.com'),
('test-deux', 'deux', 'test', 'deux@mail.com'),
('test-trois', 'trois', 'test', 'trois@mail.com');

INSERT INTO `Prizes` (`description`, `createdAt`, `createdBy`) VALUES 
('Description du prix', '2017-02-10 15:50:00.000', 'admin');

INSERT INTO `Contests` (`startDate`, `endDate`, `prize`, `status`, `createdAt`, `createdBy`) VALUES 
('2017-02-01 15:50:00.000', '2017-02-27 15:50:00.000', 1, 1, '2017-02-10 15:50:00.000', 'admin');

INSERT INTO `Photos` (`contest`, `facebookUrl`, `createdAt`, `createdBy`) VALUES 
(1, 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/16602588_615885281936972_8509153474097716860_n.jpg?oh=6bc8067ac729309f45c3c9f513947ac0&oe=593CF5F6', '2017-02-10 15:50:00.000', 'test-un'),
(1, 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/16641093_10211860358775207_3708443820249674489_n.jpg?oh=e9fd6ed37ee43aa57bb81f978fdb6b4d&oe=5939105B', '2017-02-10 15:50:00.000', 'test-deux'),
(1, 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-0/s480x480/16387300_995669103911333_2027950331764620754_n.jpg?oh=782da38efebbc509b0991d1ed7dbbb94&oe=594BEF56', '2017-02-10 15:50:00.000', 'test-trois');