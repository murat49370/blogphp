<?php
include 'config.php';

// CONNECT MYSQL
$pdo = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASSWORD);

$requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

$pdo->prepare($requete)->execute();

// CONNECT DB
$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

if($connexion){
    $requete = "
CREATE TABLE IF NOT EXISTS `blog`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_email` VARCHAR(70) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_first_name` VARCHAR(45) NOT NULL,
  `user_last_name` VARCHAR(45) NOT NULL,
  `user_pseudo` VARCHAR(45) NOT NULL,
  `user_registered` DATETIME NOT NULL,
  `user_role` VARCHAR(45) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `blog`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_create` DATETIME NOT NULL,
  `post_modified` DATETIME NOT NULL,
  `post_title` VARCHAR(255) NOT NULL,
  `post_slug` VARCHAR(255) NOT NULL,
  `post_short_content` LONGTEXT NOT NULL,
  `post_content` LONGTEXT NOT NULL,
  `post_status` VARCHAR(45) NOT NULL,
  `post_main_image` VARCHAR(70) NOT NULL,
  `post_small_image` VARCHAR(70) NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_post_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `blog`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `blog`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment_author_name` TINYTEXT NOT NULL,
  `comment_author_email` VARCHAR(100) NOT NULL,
  `comment_content` TEXT(255) NOT NULL,
  `comment_create` DATETIME NOT NULL,
  `comment_status` VARCHAR(45) NOT NULL DEFAULT 'under validation',
  `post_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_comment_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `blog`.`post` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `blog`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_title` VARCHAR(255) NOT NULL,
  `category_slug` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `blog`.`post_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`post_category` (
  `post_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`post_id`, `category_id`),
  CONSTRAINT `fk_post_has_category_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `blog`.`post` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_post_has_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `blog`.`category` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
";

    $connexion->prepare($requete)->execute();
}