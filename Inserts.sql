INSERT INTO Country (CountryCode, CountryName) VALUES
('AFG','Afghanistan'),
('ALB','Albania'),
('DZA','Algeria'),
('ASM','American Samoa'),
('AND','Andorra'),
('AGO','Angola'),
('ARG','Argentina'),
('ARM','Armenia'),
('ABW','Aruba' ),
('AUS','Australia'),
('AUT','Austria'),
('AZE','Azerbaijan'),
('BHS','Bahamas'),
('BHR','Bahrain'),
('BGD','Bangladesh'),
('BLR','Belarus'),
('BEL','Belgium'),
('BLZ','Belize'),
('BEN','Benin'),
('BMU','Bermuda'),
('BTN','Bhutan'),
('BOL','Bolivia'),
('BIH','Bosnia and Herzegovina'),
('BWA','Botswana'),
('BRA','Brazil'),
('BGR','Bulgaria'),
('BFA','Burkina Faso'),
('BDI','Burundi'),
('KHM','Cambodia'),
('CMR','Cameroon'),
('CAN','Canada'),
('CAF','Central African Republic'),
('TCD','Chad'),
('CHL','Chile'),
('CHN','China'),
('COL','Colombia'),
('COM','Comoros'),
('COG','Congo'),
('COD','Congo'),
('CRI','Costa Rica'),
('HRV','Croatia'),
('CUB','Cuba'),
('CYP','Cyprus'),
('CZE','Czech Republic'),
('DNK','Denmark'),
('DJI','Djibouti'),
('DMA','Dominica'),
('DOM','Dominican Republic'),
('ECU','Ecuador'),
('EGY','Egypt'),
('SLV','El Salvador'),
('ERI','Eritrea'),
('EST','Estonia'),
('ETH','Ethiopia'),
('FRO','Faroe Islands'),
('FJI','Republic of Fij'),
('FIN','Finland'),
('FRA','France'),
('GUF','French Guiana'),
('PYF','French Polynesia'),
('GAB','Gabon'),
('GMB','Gambia'),
('GEO','Georgia'),
('DEU','Germany'),
('GHA','Ghana'),
('GRC','Greece'),
('GRL','Greenland'),
('GLP','Guadeloupe'),
('GTM','Guatemala'),
('GIN','Guinea'),
('GNB','Guinea-Bissau'),
('GUY','Guyana'),
('HTI','Haiti'),
('VAT','Holy See (Vatican City State)'),
('HND','Honduras'),
('HKG','Hong Kong'),
('HUN','Hungary'),
('ISL','Iceland'),
('IND','India'),
('IDN','Indonesia'),
('IRN','Iran'),
('IRQ','Iraq'),
('IRL','Ireland'),
('ISR','Israel'),
('ITA','Italy'),
('JAM','Jamaica'),
('JPN','Japan'),
('JOR','Jordan'),
('KAZ','Kazakhstan'),
('KEN','Kenya'),
('KIR','Kiribati'),
('KWT','Kuwait'),
('KGZ','Kyrgyzstan'),
('LVA','Latvia'),
('LBN','Lebanon'),
('LSO','Lesotho'),
('LBR','Liberia'),
('LBY','Libyan Arab Jamahiriya'),
('LIE','Liechtenstein'),
('LTU','Lithuania'),
('LUX','Luxembourg'),
('MAC','Macao'),
('MDG','Madagascar'),
('MWI','Malawi'),
('MYS','Malaysia'),
('MDV','Maldives'),
('MLI','Mali'),
('MLT','Malta'),
('MRT','Mauritania'),
('MUS','Mauritius'),
('MEX','Mexico'),
('MCO','Monaco'),
('MNG','Mongolia'),
('MSR','Montserrat'),
('MAR','Morocco'),
('MOZ','Mozambique'),
('MMR','Myanmar'),
('NAM','Namibia'),
('NPL','Nepal'),
('NLD','Netherlands'),
('ANT','Netherlands Antilles'),
('NCL','New Caledonia'),
('NZL','New Zealand'),
('NIC','Nicaragua'),
('NOR','Norway'),
('OMN','Oman'),
('PAK','Pakistan'),
('PLW','Palau'),
('PAN','Panama'),
('PNG','Papua New Guinea'),
('PRY','Paraguay'),
('PER','Peru'),
('PHL','Philippines'),
('POL','Poland'),
('PRT','Portugal'),
('PRI','Puerto Rico'),
('QAT','Qatar'),
('ROM','Romania'),
('RUS','Russian Federation'),
('RWA','Rwanda'),
('WSM','Samoa'),
('SMR','San Marino'),
('SAU','Saudi Arabia'),
('SEN','Senegal'),
('SYC','Seychelles'),
('SLE','Sierra Leone'),
('SGP','Singapore'),
('SVK','Slovakia'),
('SVN','Slovenia'),
('SOM','Somalia'),
('ZAF','South Africa'),
('ESP','Spain'),
('LKA','Sri Lanka'),
('SDN','Sudan'),
('SWE','Sweden'),
('CHE','Switzerland'),
('SYR','Syrian Arab Republic'),
('TJK','Tajikistan'),
('TZA','Tanzania'),
('THA','Thailand'),
('TON','Tonga'),
('TUN','Tunisia'),
('TUR','Turkey'),
('TKM','Turkmenistan'),
('UGA','Uganda'),
('UKR','Ukraine'),
('ARE','United Arab Emirates'),
('GBR','United Kingdom'),
('USA','United States'),
('URY','Uruguay'),
('UZB','Uzbekistan'),
('VEN','Venezuela'),
('VNM','Viet Nam'),
('YEM','Yemen'),
('ZMB','Zambia'),
('ZWE','Zimbabwe');

INSERT INTO ColorScheme (ColorSchemeName, HighlightColor, BackgroundPrimary, BackgroundSecondary, BackgroundTernary, Light) VALUES ("Green", '144,202,156', '21,22,23', '30,32,33', '47,50,51', '216,216,216' );
INSERT INTO ColorScheme (ColorSchemeName, HighlightColor, BackgroundPrimary, BackgroundSecondary, BackgroundTernary, Light) VALUES ("Red", '201,143,146', '23,23,21', '33,33,30', '50,51,47', '217,217,217' );
INSERT INTO ColorScheme (ColorSchemeName, HighlightColor, BackgroundPrimary, BackgroundSecondary, BackgroundTernary, Light) VALUES ("Blue", '143,164,201', '23,21,23', '32,30,33', '50,47,51', '217,217,217' );

INSERT INTO `System` (ServiceDescription, Rules, PhoneNumber, SystemEmail, `Address`, ColorSchemeId) VALUES ('Welcome to Bottom Shelf! Explore new recipe ideas by browsing the communitys submissions. Through tags and our search system, you can find exactly the drink you had in mind. If you dont feel inspired, go to Explore page… ', '1.Dont lie, dont steal, 2.be a good neighbor, 3.live laugh live', '00 00 00 00', 'bottomshelf@dummyEmail.com', 'Denmark Esbjerh 6700', 1);

INSERT INTO `Role` (RoleId, RoleName) VALUES (NULL,'User');
INSERT INTO `Role` (RoleId, RoleName) VALUES (NULL,'Admin');

INSERT INTO Badge (BadgeId, BadgeName) VALUES (NULL,'Recipe Enthusiast');
INSERT INTO Badge (BadgeId, BadgeName) VALUES (NULL,'Beloved By The People');
INSERT INTO Badge (BadgeId, BadgeName) VALUES (NULL,'Recipe Specialist');

INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Easy');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Intermediate');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Hard');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Gin');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Rum');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Vodka');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Whiskey');
INSERT INTO Tag (TagId, TagName) VALUES (NULL,'Beer');

INSERT INTO EntityStatus (StatusId, StatusName) VALUES (NULL,'Active');
INSERT INTO EntityStatus (StatusId, StatusName) VALUES (NULL,'Banned');
INSERT INTO EntityStatus (StatusId, StatusName) VALUES (NULL,'Reported');
INSERT INTO EntityStatus (StatusId, StatusName) VALUES (NULL,'Deleted');

INSERT INTO `User` (UserId, Email,UserPassword, Username, DateOfBirth, ProfileImgBlob, BioDescription, PostCount, CountryCode, RoleId, StatusId) 
VALUES (NULL,'test@mockEmail.com', '$2y$10$IZN1AyZ3kp.h1S2.qTppbu32zJzCiG4B/vihQ/z9IZm7xvUy0HsuW', 'ProudTester', '1999-11-11', NULL,'I existed only to test',  0,  'DNK', 1, 1);

INSERT INTO `User` (UserId, Email,UserPassword, Username, DateOfBirth, ProfileImgBlob, BioDescription, PostCount, CountryCode, RoleId, StatusId) 
VALUES (NULL,'dummy@email.com', '$2y$10$O7h0vJd4jBXDCzteObBd2eUHyIuAsoG259R8lMKWOEqceOUCfyN4m', 'RecipeMaster', '2000-01-12', NULL,'Test Or Not To Test',  0,  'DNK', 1, 1);

INSERT INTO `User` (UserId, Email,UserPassword, Username, DateOfBirth, ProfileImgBlob, BioDescription, PostCount, CountryCode, RoleId, StatusId) 
VALUES (NULL,'admin@email.com', '$2y$10$Aza1BXoCDbPnFnqK8S8gAeqtVukqTzRY4IES10N/0NSgMzBxw3r0m', 'MightyAdmin', '1998-02-16', NULL,'I manage content',  0,  'DNK', 2, 1);


INSERT INTO Post (PostId, Title, PostDescription, IsPublic, IsSticky, ReactionCount, CommentCount, LatestCommentId, UserId, ChildPostId, StatusId)
VALUES (NULL,'Mojito', 'Fresh mint, White rum, Fresh lime juice, simple syrup, Club soda or sparkling water', TRUE, FALSE, 0, 0, NULL, 1, NULL, 1);
INSERT INTO Post (PostId, Title, PostDescription, IsPublic, IsSticky, ReactionCount, CommentCount, LatestCommentId, UserId, ChildPostId, StatusId)
VALUES (NULL,'Gin Hass', 'Cut the lime over and cut a few thin slices of one half. Put gin, mango syrup and the juice from half a lime in a glass and stir well. Add ice cubes and top with lemon soda and garnish with lime slices and possibly a sprig of mint leaves. Non-alcoholic version, Just do not add gin.', TRUE, FALSE, 0, 0, NULL, 1, NULL, 1);
