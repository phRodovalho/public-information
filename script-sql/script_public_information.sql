create database public_information;
use public_information;

CREATE TABLE `access_point` (
  `idaccess_point` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `internet_access` varchar(1) DEFAULT NULL,
  `types_idtypes` int NOT NULL,
  `location_idlocation` int NOT NULL,
  PRIMARY KEY (`idaccess_point`)
);

CREATE TABLE `category` (
  `idcategory` int NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategory`)
);

CREATE TABLE `comment` (
  `idcomment` int NOT NULL AUTO_INCREMENT,
  `description` longtext NOT NULL,
  `like` int DEFAULT NULL,
  `date` datetime NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  `user_idUser` int NOT NULL,
  `post_idpost` int NOT NULL,
  PRIMARY KEY (`idcomment`)
);

CREATE TABLE `location` (
  `idlocation` int NOT NULL AUTO_INCREMENT,
  `state` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `adress` varchar(45) NOT NULL,
  `district` varchar(45) NOT NULL,
  `latitude` point DEFAULT NULL,
  `longitude` point DEFAULT NULL,
  PRIMARY KEY (`idlocation`)
);

CREATE TABLE `post` (
  `idpost` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `date` datetime NOT NULL,
  `likes` int DEFAULT NULL,
  `category_idcategory` int NOT NULL,
  `user_idUser` int NOT NULL,
  PRIMARY KEY (`idpost`)
); 

CREATE TABLE `suggestion` (
  ` idsuggestion` int NOT NULL AUTO_INCREMENT,
  `description` longtext NOT NULL,
  `date` datetime NOT NULL,
  `user_idUser` int NOT NULL,
  `location_idlocation` int DEFAULT NULL,
  PRIMARY KEY (` idsuggestion`)
);

CREATE TABLE `types` (
  `idtypes` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idtypes`)
);

CREATE TABLE `user` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(1) NOT NULL,
  `birth_date` date NOT NULL,
  `last_acess` datetime DEFAULT NULL,
  `location_idlocation` int NOT NULL,
  PRIMARY KEY (`idUser`)
);

ALTER TABLE access_point
ADD CONSTRAINT FK_location
FOREIGN KEY (`location_idlocation`) REFERENCES `location` (`idlocation`); 

ALTER TABLE access_point
ADD CONSTRAINT FK_types
FOREIGN KEY (`types_idtypes`) REFERENCES `types` (`idtypes`); 

ALTER TABLE `comment`
ADD CONSTRAINT FK_post
FOREIGN KEY (`post_idpost`) REFERENCES `post` (`idpost`); 

ALTER TABLE `comment`
ADD CONSTRAINT FK_user
FOREIGN KEY (`user_idUser`) REFERENCES `user` (`idUser`); 

ALTER TABLE `post`
ADD CONSTRAINT FK_category
FOREIGN KEY (`category_idcategory`) REFERENCES `category` (`idcategory`); 

ALTER TABLE `post`
ADD CONSTRAINT FK_user_post
FOREIGN KEY (`user_idUser`) REFERENCES `user` (`idUser`); 

ALTER TABLE `suggestion`
ADD CONSTRAINT FK_user_suggestion
FOREIGN KEY (`user_idUser`) REFERENCES `user` (`idUser`); 

ALTER TABLE `suggestion`
ADD CONSTRAINT FK_location_suggestion
FOREIGN KEY (`location_idlocation`) REFERENCES `location` (`idlocation`); 

ALTER TABLE `user`
ADD CONSTRAINT FK_location_user
FOREIGN KEY (`location_idlocation`) REFERENCES `location` (`idlocation`); 

#--- iNSERT ---
#---TYPES---
insert into types (type) values ("PUBLIC LABORATORY");
insert into types (type) values ("PRIVATE LABORATORY");
insert into types (type) values ("PUBLIC LIBRARY");
insert into types (type) values ("PRIVATE LIBRARY");

#--CATEGORY--
insert into category (category) values ("FREE COURSES");
insert into category (category) values ("RIGHTS AND DUTIES");

#--LOCATION--
insert into location (state, country, city, adress, district) values ("MG", "BRASIL", "UBERLÂNDIA", "Praça Prof. Jacy de Assis", "CENTRO");
insert into location (state, country, city, adress, district) values ("MG", "BRASIL", "UBERLÂNDIA", "R. Ernesto Vicentini, 231", "ROOSEVELT");













