CREATE DATABASE hyperledger;
USE hyperledger;
CREATE TABLE `hyperledger`.`surface_crawl` ( `id` INT NOT NULL AUTO_INCREMENT , `site_head` TEXT NOT NULL , `link` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `keywords` TEXT NOT NULL , `description` TEXT NOT NULL , `visual_file` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL , `file_type` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `hyperledger`.`content_list` ( `id` INT NOT NULL AUTO_INCREMENT , `usrname` VARCHAR(20) NOT NULL , `content_name` VARCHAR(500) NOT NULL , `type` VARCHAR(20) NOT NULL , `keywords` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `hyperledger`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `hyperledger`.`pid` ( `id` INT NOT NULL AUTO_INCREMENT , `surface` INT NOT NULL , `deep` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `hyperledger`.`s3config` ( `id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(50) NOT NULL , `access_key_id` VARCHAR(50) NOT NULL , `secret_key` VARCHAR(50) NOT NULL , `bucket_name` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
