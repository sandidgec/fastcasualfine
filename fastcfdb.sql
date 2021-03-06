DROP DATABASE IF EXISTS fastcf;
CREATE DATABASE fastcf;
USE fastcf;

DROP TABLE IF EXISTS business;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS reviews;

CREATE TABLE business(
  businessId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  address VARCHAR(32),
  email VARCHAR(64),
  images VARCHAR(64),
  name VARCHAR(32) NOT NULL,
  phone VARCHAR(12),
  speed VARCHAR(15),
  website VARCHAR(64),
  zip INT(8),
  PRIMARY KEY (businessId)
);

CREATE TABLE user(
  userID INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(32) NOT NULL,
  email VARCHAR(64),
  phone INT (16),
  zip INT(8),
  salt VARCHAR (64) NOT NULL,
  hash VARCHAR (128) NOT NULL,
  PRIMARY KEY (userID)

);

CREATE TABLE review(
  reviewID INT UNSIGNED AUTO_INCREMENT NOT NULL,
  businessID INT UNSIGNED NOT NULL,
  userID INT UNSIGNED NOT NULL,
  date DATETIME NOT NULL ,
  rating VARCHAR(16),
  INDEX(userID),
  INDEX(businessID),
  FOREIGN KEY (userID) REFERENCES user (userID),
  FOREIGN KEY (businessID) REFERENCES business (businessID),
  PRIMARY KEY(reviewID)
);
