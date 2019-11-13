
-- Database DDL for CLEF Schema

DROP DATABASE IF EXISTS clefDB; 
CREATE DATABASE clefDB 
    CHARACTER SET UTF8 COLLATE utf8_general_ci; 
USE clefDB;

-- Primary tables

CREATE TABLE ClefUser (
    userID INTEGER(10) NOT NULL, 
    email varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    UNIQUE (email),
    PRIMARY KEY (userID)
);

CREATE TABLE UserRole (
    roleID INTEGER(10) NOT NULL, 
    name VARCHAR(255) NOT NULL, 
    roleDesc VARCHAR(255), 
    UNIQUE (roleID), 
    PRIMARY KEY (roleID)
);

CREATE TABLE Course (
    courseID INTEGER(10) NOT NULL, 
    secID INTEGER(10) NOT NULL, 
    name VARCHAR(255),
    courseDesc VARCHAR(255),
    UNIQUE(courseID, secID),
    
    PRIMARY KEY (courseID, secID)
);

CREATE INDEX si ON Course (secID);

CREATE TABLE Topic (
    topicID INTEGER(10) NOT NULL,
    title VARCHAR(255),
    topicDesc VARCHAR(255), 
    courseID INTEGER(10), -- Left nullable so that a topic need not be attributed to a course
    FOREIGN KEY (courseID) REFERENCES Course (courseID),
    PRIMARY KEY (topicID)
);

-- Junction tables

CREATE TABLE UserPermissions (
    userID INTEGER(10) NOT NULL, 
    roleID INTEGER(10) NOT NULL,
    courseID INTEGER(10), 
    FOREIGN KEY (userID) REFERENCES ClefUser (userID), 
    FOREIGN KEY (roleID) REFERENCES UserRole (roleID), 
    FOREIGN KEY (courseID) REFERENCES Course (courseID),
    PRIMARY KEY (userID, roleID)
);

CREATE TABLE UserClass (
    courseID INTEGER(10) NOT NULL,
    secID INTEGER(10) NOT NULL,
    userID INTEGER(10) NOT NULL, 
    FOREIGN KEY (courseID) REFERENCES Course (courseID), 
    FOREIGN KEY (secID) REFERENCES Course (secID), 
    FOREIGN KEY (userID) REFERENCES ClefUser (userID),
    PRIMARY KEY (courseID, secID, userID)
);

CREATE TABLE Question (
    timeAsked TIME(6) NOT NULL, 
    topicID INTEGER(10) NOT NULL, 
    userID INTEGER(10) NOT NULL,
    FOREIGN KEY (userID) REFERENCES ClefUser (userID),
    FOREIGN KEY (topicID) REFERENCES Topic (topicID),
    PRIMARY KEY (timeAsked, topicID, userID)
);