SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `document_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `document_types` ;

CREATE  TABLE IF NOT EXISTS `document_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

CREATE  TABLE IF NOT EXISTS `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NOT NULL ,
  `username` VARCHAR(100) NOT NULL ,
  `password` CHAR(40) NOT NULL ,
  `role_id` INT(11) NOT NULL ,
  `active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  INDEX `fk_users_roles_INDEX` (`role_id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `user_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_fields` ;

CREATE  TABLE IF NOT EXISTS `user_fields` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `document_type_id` INT(11) NOT NULL ,
  `document` VARCHAR(20) NOT NULL ,
  `name` VARCHAR(50) NULL DEFAULT NULL ,
  `surname` VARCHAR(50) NULL DEFAULT NULL ,
  `phone` VARCHAR(20) NULL DEFAULT NULL ,
  `address` VARCHAR(100) NULL DEFAULT NULL ,
  `birthday` DATE NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `document_UNIQUE` (`document` ASC) ,
  INDEX `fk_user_fields_users_INDEX` (`user_id` ASC) ,
  INDEX `fk_user_fields_document_types_INDEX` (`document_type_id` ASC) ,
  CONSTRAINT `fk_user_fields_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_fields_document_types`
    FOREIGN KEY (`document_type_id` )
    REFERENCES `document_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `menus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menus` ;

CREATE  TABLE IF NOT EXISTS `menus` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `menu_items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menu_items` ;

CREATE  TABLE IF NOT EXISTS `menu_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `menu_id` INT(11) NOT NULL ,
  `parent_id` INT(11) NULL DEFAULT NULL ,
  `lft` INT(11) NULL DEFAULT NULL ,
  `rght` INT(11) NULL DEFAULT NULL ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `link` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_menu_items_menus_INDEX` (`menu_id` ASC) ,
  CONSTRAINT `fk_menu_items_menus`
    FOREIGN KEY (`menu_id` )
    REFERENCES `menus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `acos` ;

CREATE  TABLE IF NOT EXISTS `acos` (
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
-- Table `aros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `aros` ;

CREATE  TABLE IF NOT EXISTS `aros` (
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
-- Table `aros_acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `aros_acos` ;

CREATE  TABLE IF NOT EXISTS `aros_acos` (
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
    REFERENCES `acos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aros_acos_aros`
    FOREIGN KEY (`aro_id` )
    REFERENCES `aros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pages` ;

CREATE  TABLE IF NOT EXISTS `pages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  `keywords` TEXT NULL ,
  `active` TINYINT(1)  NULL ,
  `content` LONGTEXT NULL ,
  `slug` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) ,
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `document_types`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO document_types (`id`, `name`) VALUES (1, 'Cedula');
INSERT INTO document_types (`id`, `name`) VALUES (2, 'Tarjeta De Identidad');

COMMIT;

-- -----------------------------------------------------
-- Data for table `roles`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO roles (`id`, `name`) VALUES (1, 'admin');
INSERT INTO roles (`id`, `name`) VALUES (2, 'manager');
INSERT INTO roles (`id`, `name`) VALUES (3, 'user');

COMMIT;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO users (`id`, `email`, `username`, `password`, `role_id`, `active`, `created`, `updated`) VALUES (1, 'admin@bloomweb.co', 'admin', '3d66fec9c10dbc7be728b94116fdbad76c134090', 1, 1, NULL, NULL);

COMMIT;
