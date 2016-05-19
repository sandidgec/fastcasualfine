DROP DATABASE IF EXISTS fastcf;
CREATE DATABASE fastcf;
USE fastcf;

DROP TABLE IF EXISTS business;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS reviews;

CREATE TABLE business(
  businessID INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(32) NOT NULL,
  email VARCHAR(64),
  website VARCHAR(64),
  address VARCHAR(32),
  zip INT(8),
  phone INT(16),
  PRIMARY KEY (businessID)
);

CREATE TABLE user(
  userID INT UNSIGNED AUTO_INCREMENT NOT NULL,
  name VARCHAR(32) NOT NULL,
  email VARCHAR(64),
  address VARCHAR (32),
  zip INT(8),
  PRIMARY KEY (userID)

);

CREATE TABLE reviews(
  reviewID INT UNSIGNED AUTO_INCREMENT NOT NULL,
  businessID INT UNSIGNED NOT NULL,
  userID INT UNSIGNED NOT NULL,
  time DATETIME,
  review TEXT,
  foodType VARCHAR (2),
  INDEX(userID),
  INDEX(businessID),
  FOREIGN KEY (userID) REFERENCES user (userID),
  FOREIGN KEY (businessID) REFERENCES business (businessID),
  PRIMARY KEY(reviewID)
);
