DROP DATABASE IF EXISTS BottomshelfDB;
CREATE DATABASE BottomshelfDB;
USE BottomshelfDB;

CREATE TABLE Country (
    CountryCode varchar(3) NOT NULL PRIMARY KEY,
    CountryName varchar(25)
);
CREATE TABLE `Role` (
    RoleId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    RoleName varchar(10)
);
CREATE TABLE Badge (
    BadgeId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BadgeName varchar(10)
);
CREATE TABLE Tag (
    TagId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TagName varchar(128)
);
CREATE TABLE `User` (
    UserId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Email varchar(128) NOT NULL,
    UserPassword varchar(128) NOT NULL,
    Username varchar(24),
    DateOfBirth date NOT NULL,
    ProfileImgUrl varchar(128),
    BioDescription varchar(256),
    CountryCode varchar(3) NOT NULL,
    RoleId int NOT NULL,
    FOREIGN KEY (CountryCode) REFERENCES Country (CountryCode),
    FOREIGN KEY (RoleId) REFERENCES Role (RoleId)
);
CREATE TABLE Media (
    ImageId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ImageUrl varchar(128),
    UserId int NOT NULL,
    FOREIGN KEY (UserId) REFERENCES User (UserId)
);
CREATE TABLE Post (
    PostId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Title varchar(128),
    PostDescription varchar(1024),
    IsPublic boolean,
    IsSticky boolean,
    CreatedAt timestamp,
    UserId int NOT NULL,
    ChildPostId int,
    FOREIGN KEY (UserId) REFERENCES User (UserId), 
    -- NOT SURE IF WILL WORK    
    FOREIGN KEY (ChildPostId) REFERENCES Post (PostId)   
);
CREATE TABLE Reaction (
    ReactionId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ReactionType varchar(32),
    UserId int NOT NULL,
    PostId int NOT NULL,
    CreatedAt timestamp,
    FOREIGN KEY (UserId) REFERENCES User (UserId),
    FOREIGN KEY (PostId) REFERENCES Post (PostId)
);
CREATE TABLE Comment (
    CommentId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Content varchar(1024),
    UserId int NOT NULL,
    PostId int NOT NULL,
    CreatedAt timestamp,
    FOREIGN KEY (UserId) REFERENCES User (UserId),
    FOREIGN KEY (PostId) REFERENCES Post (PostId)
);
CREATE TABLE UserHasBadge (
    BadgeId int NOT NULL,
    UserId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_UserHasBadge PRIMARY KEY (BadgeId, UserId)
);
CREATE TABLE UserSavedPost (
    PostId int NOT NULL,
    UserId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_UserSavedPost PRIMARY KEY (PostId, UserId)
);
CREATE TABLE CommentHasImage (
    CommentId int NOT NULL,
    ImageId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_CommentHasImage PRIMARY KEY (CommentId, ImageId)
);
CREATE TABLE PostHasImage (
    PostId int NOT NULL,
    ImageId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_PostHasImage PRIMARY KEY (PostId, ImageId)
);
CREATE TABLE PostHasTag (
    PostId int NOT NULL,
    TagId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_PostHasTag PRIMARY KEY (PostId, TagId)
);
