-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Jun-2018 às 12:36
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accountstatustype`
--

DROP TABLE IF EXISTS `accountstatustype`;
CREATE TABLE IF NOT EXISTS `accountstatustype` (
  `accountStatusID` int(11) NOT NULL AUTO_INCREMENT,
  `accountStatusType` varchar(45) NOT NULL,
  PRIMARY KEY (`accountStatusID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `accountstatustype`
--

INSERT INTO `accountstatustype` (`accountStatusID`, `accountStatusType`) VALUES
(1, 'Awaiting Activation'),
(2, 'Active'),
(3, 'Inactive'),
(4, 'Blocked');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(256) NOT NULL,
  `adminPrivilege` tinyint(1) NOT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`adminID`, `firstName`, `lastName`, `email`, `password`, `adminPrivilege`, `lastLogin`) VALUES
(1, 'Alexandru', 'Cheltuitor', 'acheltuitor@gmail.com', '98c0bfd77f71b57b87db20b3e2e6ad9b854fd6ce96f0ef82c93ca49ce5f43001', 1, '2018-05-25 11:50:03'),
(14, 'Jesper', 'Daniealsson', 'jd@gmail.com', '98c0bfd77f71b57b87db20b3e2e6ad9b854fd6ce96f0ef82c93ca49ce5f43001', 1, '2018-05-27 17:03:48'),
(17, 'Henrietta', 'Ap', 'ha@gmail.com', '98c0bfd77f71b57b87db20b3e2e6ad9b854fd6ce96f0ef82c93ca49ce5f43001', 1, '2018-05-29 06:31:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `city`
--

INSERT INTO `city` (`cityID`, `name`) VALUES
(22, 'Lisboa'),
(25, 'Stockholm'),
(26, 'Uppsala'),
(27, 'Marrocco'),
(28, 'Moskva'),
(29, 'LinkÃ¶ping'),
(30, 'Denver'),
(31, 'Los Angeles'),
(32, 'Ã…bo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hashtaglist`
--

DROP TABLE IF EXISTS `hashtaglist`;
CREATE TABLE IF NOT EXISTS `hashtaglist` (
  `hashtagListID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`hashtagListID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `hashtaglist`
--

INSERT INTO `hashtaglist` (`hashtagListID`, `name`) VALUES
(2, 'cardio'),
(4, 'crossfit'),
(6, 'styrka'),
(7, 'zumba'),
(8, 'legday'),
(9, 'biceps'),
(10, 'tricep');

-- --------------------------------------------------------

--
-- Estrutura da tabela `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `activityID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` longtext,
  `address` varchar(60) NOT NULL,
  `isGym` tinyint(1) NOT NULL,
  `cityID` int(11) NOT NULL,
  PRIMARY KEY (`activityID`),
  KEY `cityID` (`cityID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `location`
--

INSERT INTO `location` (`activityID`, `name`, `description`, `address`, `isGym`, `cityID`) VALUES
(3, '24/7', 'Billigt Gym', 'SÃ¶dra', 1, 25),
(4, 'Wellness', 'Bra gym', 'VÃ¤st', 0, 22),
(5, '24/7 Moskva', 'Billigt gym i Moskva', 'Moskva21', 1, 28),
(6, 'Awesome Gym ', 'This is a great gym that woks for all ages', 'Awesome way 55. str', 1, 30),
(7, 'Crossfitting Your Day', 'This is a gym intended for crossfitters', 'Crossfit street 9', 1, 31),
(8, 'Utomhus Gym 1', 'Bra utomhus gym', 'Bra address', 0, 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `messagesID` int(11) NOT NULL AUTO_INCREMENT,
  `relatingUser` int(11) NOT NULL,
  `relatedUser` int(11) NOT NULL,
  `message` text NOT NULL,
  `dateSent` timestamp NOT NULL,
  PRIMARY KEY (`messagesID`),
  KEY `relatingUser` (`relatingUser`),
  KEY `relatedUser` (`relatedUser`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`messagesID`, `relatingUser`, `relatedUser`, `message`, `dateSent`) VALUES
(1, 2, 4, 'Hej', '2018-05-29 06:19:22'),
(2, 4, 2, 'Hur mÃ¥r du ?!', '2018-05-29 06:19:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ratingtype`
--

DROP TABLE IF EXISTS `ratingtype`;
CREATE TABLE IF NOT EXISTS `ratingtype` (
  `ratingID` tinyint(1) NOT NULL AUTO_INCREMENT,
  `ratingType` varchar(15) NOT NULL,
  PRIMARY KEY (`ratingID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relationshiptype`
--

DROP TABLE IF EXISTS `relationshiptype`;
CREATE TABLE IF NOT EXISTS `relationshiptype` (
  `relationshipID` int(11) NOT NULL AUTO_INCREMENT,
  `relationshipType` varchar(30) NOT NULL,
  PRIMARY KEY (`relationshipID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `relationshiptype`
--

INSERT INTO `relationshiptype` (`relationshipID`, `relationshipType`) VALUES
(1, 'Buddies'),
(2, 'Sent Invite'),
(3, 'Blocked');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` text NOT NULL,
  `profilePicURL` longblob,
  `dob` varchar(10) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `publicID` bigint(15) NOT NULL,
  `accountStatusID` int(11) NOT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `genderPreference` tinyint(4) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `accountStatusID` (`accountStatusID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`

-- --------------------------------------------------------

--
-- Estrutura da tabela `userhashtag`
--

DROP TABLE IF EXISTS `userhashtag`;
CREATE TABLE IF NOT EXISTS `userhashtag` (
  `hashtagUserID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `hasthagListID` int(11) NOT NULL,
  PRIMARY KEY (`hashtagUserID`),
  KEY `userID` (`userID`),
  KEY `hasthagListID` (`hasthagListID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userhashtag`
--

INSERT INTO `userhashtag` (`hashtagUserID`, `userID`, `hasthagListID`) VALUES
(2, 3, 4),
(6, 4, 2),
(7, 4, 4),
(8, 2, 4),
(9, 2, 2),
(10, 2, 6),
(11, 2, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `userlocation`
--

DROP TABLE IF EXISTS `userlocation`;
CREATE TABLE IF NOT EXISTS `userlocation` (
  `userLocationID` int(11) NOT NULL AUTO_INCREMENT,
  `locationID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`userLocationID`),
  KEY `activityID` (`locationID`),
  KEY `userID` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userlocation`
--

INSERT INTO `userlocation` (`userLocationID`, `locationID`, `userID`) VALUES
(1, 3, 2),
(2, 3, 3),
(3, 4, 4),
(4, 5, 4),
(5, 3, 2),
(6, 3, 2),
(8, 3, 2),
(9, 3, 2),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `userlocationstatus`
--

DROP TABLE IF EXISTS `userlocationstatus`;
CREATE TABLE IF NOT EXISTS `userlocationstatus` (
  `userLocationActivityID` int(11) NOT NULL AUTO_INCREMENT,
  `startingTime` varchar(45) DEFAULT NULL,
  `userLocationID` int(11) DEFAULT NULL,
  PRIMARY KEY (`userLocationActivityID`),
  KEY `userLocationID` (`userLocationID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userlocationstatus`
--

INSERT INTO `userlocationstatus` (`userLocationActivityID`, `startingTime`, `userLocationID`) VALUES
(1, '2018-05-29 08:33:13', 1),
(2, '2018-05-29 17:40:10', 1),
(3, '2018-05-29 17:40:42', 1),
(4, '2018-05-29 18:18:50', 1),
(5, '2018-05-29 18:19:05', 1),
(6, '2018-05-29 23:32:04', 1),
(7, '2018-05-30 17:29:19', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `userrating`
--

DROP TABLE IF EXISTS `userrating`;
CREATE TABLE IF NOT EXISTS `userrating` (
  `userRatingID` int(11) NOT NULL AUTO_INCREMENT,
  `userRatedBy` int(11) NOT NULL,
  `userRated` int(11) NOT NULL,
  `ratingID` tinyint(1) NOT NULL,
  PRIMARY KEY (`userRatingID`),
  KEY `userRatedBy` (`userRatedBy`),
  KEY `userRated` (`userRated`),
  KEY `ratingID` (`ratingID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `userrelationship`
--

DROP TABLE IF EXISTS `userrelationship`;
CREATE TABLE IF NOT EXISTS `userrelationship` (
  `userRelationshipID` int(11) NOT NULL AUTO_INCREMENT,
  `relatingUser` int(11) NOT NULL,
  `relatedUser` int(11) NOT NULL,
  `relationshipID` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`userRelationshipID`),
  KEY `relatingUser` (`relatingUser`),
  KEY `relatedUser` (`relatedUser`),
  KEY `relationshipID` (`relationshipID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `userrelationship`
--

INSERT INTO `userrelationship` (`userRelationshipID`, `relatingUser`, `relatedUser`, `relationshipID`, `accepted`) VALUES
(7, 2, 4, 1, 1),
(8, 4, 2, 1, 1),
(9, 3, 4, 1, 1),
(10, 4, 3, 1, 1),
(11, 2, 3, 1, 1),
(12, 3, 2, 1, 1),
(13, 5, 3, 1, 1),
(14, 3, 5, 1, 1),
(15, 5, 2, 1, 1),
(16, 2, 5, 1, 1),
(17, 5, 4, 1, 1),
(18, 4, 5, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `city` (`cityID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`relatingUser`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`relatedUser`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`accountStatusID`) REFERENCES `accountstatustype` (`accountStatusID`);

--
-- Limitadores para a tabela `userhashtag`
--
ALTER TABLE `userhashtag`
  ADD CONSTRAINT `userhashtag_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `userhashtag_ibfk_2` FOREIGN KEY (`hasthagListID`) REFERENCES `hashtaglist` (`hashtagListID`);

--
-- Limitadores para a tabela `userlocation`
--
ALTER TABLE `userlocation`
  ADD CONSTRAINT `userlocation_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `location` (`activityID`),
  ADD CONSTRAINT `userlocation_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Limitadores para a tabela `userlocationstatus`
--
ALTER TABLE `userlocationstatus`
  ADD CONSTRAINT `userlocationstatus_ibfk_1` FOREIGN KEY (`userLocationID`) REFERENCES `userlocation` (`userLocationID`);

--
-- Limitadores para a tabela `userrating`
--
ALTER TABLE `userrating`
  ADD CONSTRAINT `userrating_ibfk_1` FOREIGN KEY (`userRatedBy`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `userrating_ibfk_2` FOREIGN KEY (`userRated`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `userrating_ibfk_3` FOREIGN KEY (`ratingID`) REFERENCES `ratingtype` (`ratingID`);

--
-- Limitadores para a tabela `userrelationship`
--
ALTER TABLE `userrelationship`
  ADD CONSTRAINT `userrelationship_ibfk_1` FOREIGN KEY (`relatingUser`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `userrelationship_ibfk_2` FOREIGN KEY (`relatedUser`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `userrelationship_ibfk_3` FOREIGN KEY (`relationshipID`) REFERENCES `relationshiptype` (`relationshipID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
