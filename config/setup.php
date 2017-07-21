<?php
include('database.php');

try {
	$db = new PDO($DB_DSN_G, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//DB creation or recreation
	$db->exec("DROP DATABASE IF EXISTS camagru");
	$sql = "CREATE DATABASE camagru";
	$db->exec($sql);

	//Table users
	$sql = "USE camagru;
		CREATE TABLE `Users`
			(Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Name VARCHAR(30) NOT NULL,
			Email VARCHAR(50),
			Password varchar (255) NOT NULL,
			Active INT(1) DEFAULT '0',
			RegistrationDate TIMESTAMP) ENGINE=InnoDB;
		CREATE TABLE `Images`
			(Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			UserID INT(6) UNSIGNED NOT NULL,
			ImagePath VARCHAR(80) NOT NULL,
			Likes INT(6) DEFAULT '0',
			ImageDate TIMESTAMP,
			FOREIGN KEY (UserID) REFERENCES Users (Id)
				ON DELETE CASCADE
       			ON UPDATE CASCADE
			) ENGINE=InnoDB;
		CREATE TABLE `Comments`
			(Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			UserID INT(6) UNSIGNED NOT NULL,
			ImageId INT(6) UNSIGNED NOT NULL,
			Comment LONGTEXT NOT NULL,
			CommentDate TIMESTAMP,
			FOREIGN KEY (UserID) REFERENCES Users (Id)
				ON DELETE CASCADE
       			ON UPDATE CASCADE,
       		FOREIGN KEY (ImageId) REFERENCES Images (Id)
				ON DELETE CASCADE
       			ON UPDATE CASCADE
			) ENGINE=InnoDB;
			";
	$db->exec($sql);
	} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
	}
$db = null;
?>