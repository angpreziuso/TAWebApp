-- Database DDL for CLEF Schema

DROP DATABASE IF EXISTS CLEF; 
CREATE DATABASE CLEF CHARACTER SET UTF8 COLLATE utf8_general_ci; 
USE CLEF;

-- Base tables, no foreign keys

CREATE TABLE CLEF_USER (
    UserID INTEGER(10) NOT NULL AUTO_INCREMENT,
    UserEmail varchar(50) NOT NULL,
    Password varchar(255) NOT NULL,
    FirstName varchar(255) NOT NULL, 
    LastName varchar(255) NOT NULL,
    UNIQUE (UserEmail),
    PRIMARY KEY (UserID)
);

CREATE TABLE COURSE (
    CourseID INTEGER(10) NOT NULL, 
    PRIMARY KEY (CourseID)
);

CREATE TABLE ROLE (
    RoleID INTEGER(10) NOT NULL AUTO_INCREMENT, 
    RoleName varchar(25) NOT NULL,
    RoleDesc varchar(255),
    PRIMARY KEY (RoleID)
);

CREATE TABLE SHIFT (
    ShiftID INTEGER(10) NOT NULL AUTO_INCREMENT, 
    ShiftDate DATE NOT NULL,
    PRIMARY KEY (ShiftID)
);

-- Tables with parents and children

CREATE TABLE SECTION (
    SectionID INTEGER(10) NOT NULL AUTO_INCREMENT, 
    CourseID INTEGER(10) NOT NULL,
    FOREIGN KEY (CourseID) REFERENCES COURSE (CourseID),
    PRIMARY KEY (SectionID, CourseID)
);

CREATE TABLE TOPIC (
    TopicID INTEGER(10) NOT NULL AUTO_INCREMENT, 
    CourseID INTEGER(10) NOT NULL,
    TopicDesc varchar(255),
    FOREIGN KEY (CourseID) REFERENCES COURSE (CourseID),
    PRIMARY KEY (TopicID)
);

CREATE TABLE USER_ROLE (
    UserID INTEGER(10) NOT NULL,
    RoleID INTEGER(10) NOT NULL, 
    StartDate DATE NOT NULL, 
    EndDate DATE,
    FOREIGN KEY (UserID) REFERENCES CLEF_USER (UserID),
    FOREIGN KEY (RoleID) REFERENCES ROLE (RoleID),
    PRIMARY KEY (UserID, RoleID)
);

-- Child tables

CREATE TABLE ENROLLMENT (
    UserID INTEGER(10) NOT NULL,
    CourseID INTEGER(10) NOT NULL,
    SectionID INTEGER(10) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES CLEF_USER (UserID),
    FOREIGN KEY (CourseID) REFERENCES SECTION (CourseID),
    FOREIGN KEY (SectionID) REFERENCES SECTION (SectionID),    
    PRIMARY KEY (UserID, CourseID, SectionID)
);

CREATE TABLE SHIFT_DUTY (
    UserID INTEGER(10) NOT NULL,
    ShiftID INTEGER(10) NOT NULL,
    RoleID INTEGER(10) NOT NULL,
    BEGIN_TIME TIME(6),
    END_TIME TIME(6),
    FOREIGN KEY (ShiftID) REFERENCES SHIFT (ShiftID),
    FOREIGN KEY (RoleID) REFERENCES USER_ROLE (RoleID),
    FOREIGN KEY (UserID) REFERENCES USER_ROLE (UserID),    
    PRIMARY KEY (UserID, ShiftID)
);

-- Absolute Unit.

CREATE TABLE SERV_REQ (
    ServReqID INTEGER(10) NOT NULL AUTO_INCREMENT,
    CourseID INTEGER(10) NOT NULL, 
    FilingUserID INTEGER(10) NOT NULL,
    FilingUserRole INTEGER(10) NOT NULL, 
    AddrUserID INTEGER(10),
    AddrUserRole INTEGER(10), 
    TopicID INTEGER(10) NOT NULL,
    TimeFiled TIMESTAMP NOT NULL,
    TimeOpened TIMESTAMP,
    TimeClosed TIMESTAMP,
    Status INTEGER(4) NOT NULL,
    ServReqDesc VARCHAR(255) NOT NULL,
    FOREIGN KEY (CourseID) REFERENCES COURSE (CourseID),
    FOREIGN KEY (FilingUserID) REFERENCES USER_ROLE (UserID),
    FOREIGN KEY (FilingUserRole) REFERENCES USER_ROLE (RoleID),
    FOREIGN KEY (AddrUserID) REFERENCES USER_ROLE (UserID),
    FOREIGN KEY (AddrUserRole) REFERENCES USER_ROLE (RoleID),
    FOREIGN KEY (TopicID) REFERENCES TOPIC (TopicID),
    PRIMARY KEY (ServReqID)
);

-- Seed the database. Add information to the database to help the DB get live ASAP

INSERT INTO ROLE (RoleName, RoleDesc) VALUES ("Student", "Students using the CLEF System can submit questions to the whiteboard to get help from the TA's, as well as participate in a Piazza-like forum.");
INSERT INTO ROLE (RoleName, RoleDesc) VALUES ("Teaching Assistant", "TA's using the CLEF System can view the queue of students waiting to be helped, as well as manage their availabilityand shift assignments");
INSERT INTO ROLE (RoleName, RoleDesc) VALUES ("Professor", "Professors using the CLEF System are can view metadata on the questions asked to better arm themselves to teach any given section, and seed their courses with given topics to aid in that tracking.");
INSERT INTO ROLE (RoleName, RoleDesc) VALUES ("Administrator", "CLEF System superusers");

