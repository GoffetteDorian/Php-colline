-- SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
-- SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema heroku_4a25fe8af1897c7
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `heroku_4a25fe8af1897c7` DEFAULT CHARACTER SET utf8 ;
USE `heroku_4a25fe8af1897c7` ;

-- -----------------------------------------------------
-- Table `heroku_4a25fe8af1897c7`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_4a25fe8af1897c7`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `nickname` NVARCHAR(20) NOT NULL,
  `password` NVARCHAR(255) NOT NULL,
  `email` NVARCHAR(50) NOT NULL,
  `avatar` NVARCHAR(255) NULL,
  `signature` TEXT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_4a25fe8af1897c7`.`boards`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_4a25fe8af1897c7`.`boards` (
  `idboards` INT NOT NULL AUTO_INCREMENT,
  `name` NVARCHAR(64) NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`idboards`),
  UNIQUE INDEX `idboards_UNIQUE` (`idboards` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_4a25fe8af1897c7`.`topics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_4a25fe8af1897c7`.`topics` (
  `idtopics` INT NOT NULL AUTO_INCREMENT,
  `title` NVARCHAR(45) NULL,
  `creation_date` TIMESTAMP NULL,
  `boards_idboards` INT NOT NULL,
  `users_idusers` INT NOT NULL,
  PRIMARY KEY (`idtopics`, `boards_idboards`),
  UNIQUE INDEX `idtopics_UNIQUE` (`idtopics` ASC),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC),
  INDEX `fk_topics_boards1_idx` (`boards_idboards` ASC),
  INDEX `fk_topics_users1_idx` (`users_idusers` ASC),
  CONSTRAINT `fk_topics_boards1`
    FOREIGN KEY (`boards_idboards`)
    REFERENCES `heroku_4a25fe8af1897c7`.`boards` (`idboards`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topics_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `heroku_4a25fe8af1897c7`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_4a25fe8af1897c7`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_4a25fe8af1897c7`.`messages` (
  `idmessages` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NULL,
  `creation_date` TIMESTAMP NULL,
  `edition_date` TIMESTAMP NULL,
  `users_idusers` INT NOT NULL,
  `topics_idtopics` INT NOT NULL,
  `topics_boards_idboards` INT NOT NULL,
  PRIMARY KEY (`idmessages`, `users_idusers`, `topics_idtopics`, `topics_boards_idboards`),
  UNIQUE INDEX `idmessages_UNIQUE` (`idmessages` ASC),
  INDEX `fk_messages_users_idx` (`users_idusers` ASC),
  INDEX `fk_messages_topics1_idx` (`topics_idtopics` ASC, `topics_boards_idboards` ASC),
  CONSTRAINT `fk_messages_users`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `heroku_4a25fe8af1897c7`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_topics1`
    FOREIGN KEY (`topics_idtopics` , `topics_boards_idboards`)
    REFERENCES `heroku_4a25fe8af1897c7`.`topics` (`idtopics` , `boards_idboards`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- SET SQL_MODE=@OLD_SQL_MODE;
-- SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
-- SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
