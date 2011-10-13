SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `bloomweb_ez` DEFAULT CHARACTER SET utf8 ;
USE `bloomweb_ez` ;

-- -----------------------------------------------------
-- Table `bloomweb_ez`.`roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NOT NULL ,
  `password` CHAR(40) NOT NULL ,
  `role_id` INT(11) NOT NULL DEFAULT 2 ,
  `active` TINYINT(1) NOT NULL DEFAULT 1 ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_roles_INDEX` (`role_id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `bloomweb_ez`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`menus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`menus` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`menu_items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`menu_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `menu_id` INT(11) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `link` VARCHAR(255) NOT NULL ,
  `parent_id` INT(11) NULL ,
  `lft` INT(11) NULL ,
  `rght` INT(11) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_menu_items_menus_INDEX` (`menu_id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `link_UNIQUE` (`link` ASC) ,
  CONSTRAINT `fk_menu_items_menus`
    FOREIGN KEY (`menu_id` )
    REFERENCES `bloomweb_ez`.`menus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`acos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`aros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`aros` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`aros_acos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`aros_acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `aro_id` INT(10) NOT NULL ,
  `aco_id` INT(10) NOT NULL ,
  `_create` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_read` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_update` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_delete` VARCHAR(2) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `ARO_ACO_KEY_UNIQUE` (`aro_id` ASC, `aco_id` ASC) ,
  INDEX `fk_aros_acos_acos_INDEX` (`aco_id` ASC) ,
  INDEX `fk_aros_acos_aros_INDEX` (`aro_id` ASC) ,
  CONSTRAINT `fk_aros_acos_acos`
    FOREIGN KEY (`aco_id` )
    REFERENCES `bloomweb_ez`.`acos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aros_acos_aros`
    FOREIGN KEY (`aro_id` )
    REFERENCES `bloomweb_ez`.`aros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`pages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`pages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `description` TEXT NULL ,
  `keywords` TEXT NULL ,
  `active` TINYINT(1)  NULL ,
  `wysiwyg_content` LONGTEXT NULL ,
  `slug` VARCHAR(100) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `title_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`products`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `description` TEXT NULL ,
  `ref` VARCHAR(100) NULL ,
  `image` VARCHAR(100) NULL ,
  `slug` VARCHAR(100) NOT NULL ,
  `keywords` TEXT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`product_pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`product_pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `path` VARCHAR(255) NOT NULL ,
  `alt` VARCHAR(100) NULL ,
  `sort` INT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_product_pictures_products1_INDEX` (`product_id` ASC) ,
  CONSTRAINT `fk_product_pictures_products1`
    FOREIGN KEY (`product_id` )
    REFERENCES `bloomweb_ez`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_ez`.`i18n`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_ez`.`i18n` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `locale` VARCHAR(6) NOT NULL ,
  `model` VARCHAR(255) NOT NULL ,
  `foreign_key` INT(10) NOT NULL ,
  `field` VARCHAR(255) NOT NULL ,
  `content` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `locale` (`locale` ASC) ,
  INDEX `model` (`model` ASC) ,
  INDEX `row_id` (`foreign_key` ASC) ,
  INDEX `field` (`field` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
