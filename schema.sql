CREATE TABLE `Users` (
  `Id` int unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `PasswordHash` varchar(60) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Users_Email` (`Email`),
  UNIQUE KEY `Users_Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Posts` (
  `Id` int unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Content` varchar(2000) NOT NULL,
  `TitleImage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default.png',
  `OwnerId` int unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Posts_Users_FK` (`OwnerId`),
  CONSTRAINT `Posts_Users_FK` FOREIGN KEY (`OwnerId`) REFERENCES `Users` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
