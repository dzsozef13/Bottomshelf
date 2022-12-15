DROP DATABASE IF EXISTS BottomshelfDB;
CREATE DATABASE BottomshelfDB;
USE BottomshelfDB;

CREATE TABLE ColorScheme (
    ColorSchemeId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ColorSchemeName varchar(256) NOT NULL,
    HighlightColor varchar(24) NOT NULL,
    BackgroundPrimary varchar(24) NOT NULL,
    BackgroundSecondary varchar(24) NOT NULL,
    BackgroundTernary varchar(24) NOT NULL,
    Light varchar(24) NOT NULL
);

CREATE TABLE `System` (
    Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ServiceDescription varchar(10000),
    Rules varchar(10000),
    PhoneNumber varchar(32) NOT NULL,
    SystemEmail varchar(128) NOT NULL,
    `Address` varchar(512) NOT NULL,
    ColorSchemeId int,
    FOREIGN KEY (ColorSchemeId) REFERENCES ColorScheme (ColorSchemeId)
);

CREATE TABLE Country (
    CountryCode varchar(3) NOT NULL PRIMARY KEY,
    CountryName varchar(64)
);
CREATE TABLE `Role` (
    RoleId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    RoleName varchar(10)
);
CREATE TABLE Badge (
    BadgeId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BadgeName varchar(64)
);
CREATE TABLE Tag (
    TagId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TagName varchar(128)
);
CREATE TABLE EntityStatus (
    StatusId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    StatusName varchar(128)
);
CREATE TABLE `User` (
    UserId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Email varchar(128) NOT NULL,
    UserPassword varchar(128) NOT NULL,
    Username varchar(64) NOT NULL,
    DateOfBirth date NOT NULL,
    ProfileImgBlob longblob,
    BioDescription varchar(256),
    PostCount int,
    CountryCode varchar(3) NOT NULL,
    RoleId int NOT NULL,
    StatusId int NOT NULL,
    FOREIGN KEY (CountryCode) REFERENCES Country (CountryCode),
    FOREIGN KEY (RoleId) REFERENCES Role (RoleId),
    FOREIGN KEY (StatusId) REFERENCES EntityStatus (StatusId)
);
CREATE TABLE Media (
    ImageId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Image` longblob NOT NULL,
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
    ReactionCount int,
    CommentCount int,
    LatestCommentId int,
    UserId int NOT NULL,
    ChildPostId int,
    StatusId int NOT NULL,
    FOREIGN KEY (UserId) REFERENCES `User` (UserId), 
    FOREIGN KEY (ChildPostId) REFERENCES Post (PostId),  
    FOREIGN KEY (StatusId) REFERENCES EntityStatus (StatusId)
);
CREATE TABLE Reaction (
    ReactionId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
    CONSTRAINT PK_UserHasBadge PRIMARY KEY (BadgeId, UserId),
    FOREIGN KEY (UserId) REFERENCES User (UserId),
    FOREIGN KEY (BadgeId) REFERENCES Badge (BadgeId)
);
CREATE TABLE UserSavedPost (
    PostId int NOT NULL,
    UserId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_UserSavedPost PRIMARY KEY (PostId, UserId),
    FOREIGN KEY (UserId) REFERENCES User (UserId),
    FOREIGN KEY (PostId) REFERENCES Post (PostId)
);
CREATE TABLE CommentHasImage (
    CommentId int NOT NULL,
    ImageId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_CommentHasImage PRIMARY KEY (CommentId, ImageId),
    FOREIGN KEY (CommentId) REFERENCES Comment (CommentId),
    FOREIGN KEY (ImageId) REFERENCES Media (ImageId)
);
CREATE TABLE PostHasImage (
    PostId int NOT NULL,
    ImageId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_PostHasImage PRIMARY KEY (PostId, ImageId),
    FOREIGN KEY (PostId) REFERENCES Post (PostId),
    FOREIGN KEY (ImageId) REFERENCES Media (ImageId)
);
CREATE TABLE PostHasTag (
    PostId int NOT NULL,
    TagId int NOT NULL,
    CreatedAt timestamp,
    CONSTRAINT PK_PostHasTag PRIMARY KEY (PostId, TagId),
    FOREIGN KEY (PostId) REFERENCES Post (PostId),
    FOREIGN KEY (TagId) REFERENCES Tag (TagId)
);

CREATE VIEW StickyPost AS
SELECT Post.*, User.Username, Comment.Content
FROM Post
LEFT JOIN User ON User.UserId=Post.UserId
LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
LEFT JOIN PostHasTag ON PostHasTag.PostId=Post.PostId
WHERE Post.IsSticky = 1;

CREATE VIEW DanishUser AS
SELECT *
FROM User
WHERE User.CountryCode = 'DNK'

DELIMITER //
Create Trigger AfterInsertOnPost AFTER INSERT ON Post FOR EACH ROW
BEGIN
UPDATE `User`
SET `User`.PostCount = `User`.PostCount + 1
WHERE `User`.UserId = NEW.UserId;
END //

DELIMITER ;

DELIMITER //
Create Trigger AfterInsertOnComment AFTER INSERT ON Comment FOR EACH ROW
BEGIN
UPDATE Post
SET Post.CommentCount = Post.CommentCount + 1, Post.LatestCommentId = NEW.CommentId
WHERE Post.PostId = NEW.PostId;
END //

DELIMITER ;

DELIMITER //
Create Trigger AfterDeleteOnComment AFTER DELETE ON Comment FOR EACH ROW
BEGIN
UPDATE Post
SET Post.CommentCount = Post.CommentCount - 1
WHERE Post.PostId = OLD.PostId;
END //

DELIMITER ;

DELIMITER //
Create Trigger AfterInsertOnReaction AFTER INSERT ON Reaction FOR EACH ROW
BEGIN
UPDATE Post
SET Post.ReactionCount = Post.ReactionCount + 1
WHERE Post.PostId = NEW.PostId;
END //

DELIMITER ;

DELIMITER //
Create Trigger AfterDeleteOnReaction AFTER DELETE ON Reaction FOR EACH ROW
BEGIN
UPDATE Post
SET Post.ReactionCount = Post.ReactionCount - 1
WHERE Post.PostId = OLD.PostId;
END //

DELIMITER ;

DELIMITER //
Create Trigger AfterUpdateOnUser AFTER UPDATE ON User FOR EACH ROW
BEGIN
 IF NEW.PostCount = 5 AND NOT EXISTS (SELECT * FROM UserHasBadge WHERE UserHasBadge.BadgeId = 1 AND UserHasBadge.UserId = NEW.UserId)
  THEN
    INSERT INTO UserHasBadge(BadgeId, UserId) VALUES (1, NEW.UserId);
  END IF;
  IF NEW.PostCount = 10  AND NOT EXISTS (SELECT * FROM UserHasBadge WHERE UserHasBadge.BadgeId = 3 AND UserHasBadge.UserId = NEW.UserId)
  THEN
    INSERT INTO UserHasBadge(BadgeId, UserId) VALUES (3, NEW.UserId);
  END IF;
END //

DELIMITER ;


