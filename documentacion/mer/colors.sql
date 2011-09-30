SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `bloomweb_colors` ;
CREATE SCHEMA IF NOT EXISTS `bloomweb_colors` DEFAULT CHARACTER SET utf8 ;
USE `bloomweb_colors` ;

-- -----------------------------------------------------
-- Table `bloomweb_colors`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`categories` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `image` VARCHAR(255) NULL ,
  `sort` INT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`brands`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`brands` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`brands` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `image` VARCHAR(255) NULL ,
  `sort` INT NULL ,
  `category_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_brands_categories`
    FOREIGN KEY (`category_id` )
    REFERENCES `bloomweb_colors`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_brands_categories_INDEX` ON `bloomweb_colors`.`brands` (`category_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`subcategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`subcategories` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`subcategories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `image` VARCHAR(255) NULL ,
  `sort` INT NULL ,
  `brand_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_subcategories_brands`
    FOREIGN KEY (`brand_id` )
    REFERENCES `bloomweb_colors`.`brands` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_subcategories_brands_INDEX` ON `bloomweb_colors`.`subcategories` (`brand_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`collections`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`collections` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`collections` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `brand_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_collections_brands`
    FOREIGN KEY (`brand_id` )
    REFERENCES `bloomweb_colors`.`brands` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_collections_brands_INDEX` ON `bloomweb_colors`.`collections` (`brand_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`products` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `image` VARCHAR(255) NOT NULL ,
  `clasification` VARCHAR(100) NULL ,
  `collection_id` INT NOT NULL ,
  `subcategory_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_products_subcategories`
    FOREIGN KEY (`subcategory_id` )
    REFERENCES `bloomweb_colors`.`subcategories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_collections`
    FOREIGN KEY (`collection_id` )
    REFERENCES `bloomweb_colors`.`collections` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_products_subcategories_INDEX` ON `bloomweb_colors`.`products` (`subcategory_id` ASC) ;

CREATE INDEX `fk_products_collections_INDEX` ON `bloomweb_colors`.`products` (`collection_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`sizes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`sizes` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`sizes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `size` VARCHAR(50) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`inventories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`inventories` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`inventories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT NOT NULL ,
  `size_id` INT NOT NULL ,
  `quantity` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_inventories_products`
    FOREIGN KEY (`product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventories_sizes`
    FOREIGN KEY (`size_id` )
    REFERENCES `bloomweb_colors`.`sizes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_inventories_products_INDEX` ON `bloomweb_colors`.`inventories` (`product_id` ASC) ;

CREATE INDEX `fk_inventories_sizes_INDEX` ON `bloomweb_colors`.`inventories` (`size_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`size_references`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`size_references` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`size_references` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `size` VARCHAR(50) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`pictures`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`pictures` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `image` VARCHAR(255) NOT NULL ,
  `product_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_pictures_products`
    FOREIGN KEY (`product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_pictures_products_INDEX` ON `bloomweb_colors`.`pictures` (`product_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`acos` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`acos` (
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
-- Table `bloomweb_colors`.`aros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`aros` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`aros` (
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
-- Table `bloomweb_colors`.`aros_acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`aros_acos` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`aros_acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `aro_id` INT(10) NOT NULL ,
  `aco_id` INT(10) NOT NULL ,
  `_create` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_read` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_update` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_delete` VARCHAR(2) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_aros_acos_acos`
    FOREIGN KEY (`aco_id` )
    REFERENCES `bloomweb_colors`.`acos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aros_acos_aros`
    FOREIGN KEY (`aro_id` )
    REFERENCES `bloomweb_colors`.`aros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `ARO_ACO_KEY_UNIQUE` ON `bloomweb_colors`.`aros_acos` (`aro_id` ASC, `aco_id` ASC) ;

CREATE INDEX `fk_aros_acos_acos_INDEX` ON `bloomweb_colors`.`aros_acos` (`aco_id` ASC) ;

CREATE INDEX `fk_aros_acos_aros_INDEX` ON `bloomweb_colors`.`aros_acos` (`aro_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`document_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`document_types` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`document_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `name_UNIQUE` ON `bloomweb_colors`.`document_types` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`i18n`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`i18n` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`i18n` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `locale` VARCHAR(6) NOT NULL ,
  `model` VARCHAR(255) NOT NULL ,
  `foreign_key` INT(10) NOT NULL ,
  `field` VARCHAR(255) NOT NULL ,
  `content` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `locale` ON `bloomweb_colors`.`i18n` (`locale` ASC) ;

CREATE INDEX `model` ON `bloomweb_colors`.`i18n` (`model` ASC) ;

CREATE INDEX `row_id` ON `bloomweb_colors`.`i18n` (`foreign_key` ASC) ;

CREATE INDEX `field` ON `bloomweb_colors`.`i18n` (`field` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`pages` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `keywords` TEXT NULL DEFAULT NULL ,
  `active` TINYINT(1) NULL DEFAULT NULL ,
  `wysiwyg_content` LONGTEXT NULL DEFAULT NULL ,
  `slug` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `title_UNIQUE` ON `bloomweb_colors`.`pages` (`title` ASC) ;

CREATE UNIQUE INDEX `slug_UNIQUE` ON `bloomweb_colors`.`pages` (`slug` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`roles` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `name_UNIQUE` ON `bloomweb_colors`.`roles` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`users` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NOT NULL ,
  `username` VARCHAR(100) NOT NULL ,
  `password` CHAR(40) NOT NULL ,
  `role_id` INT(11) NOT NULL ,
  `active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' ,
  `created` DATETIME NULL DEFAULT NULL ,
  `updated` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `bloomweb_colors`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `username_UNIQUE` ON `bloomweb_colors`.`users` (`username` ASC) ;

CREATE UNIQUE INDEX `email_UNIQUE` ON `bloomweb_colors`.`users` (`email` ASC) ;

CREATE INDEX `fk_users_roles_INDEX` ON `bloomweb_colors`.`users` (`role_id` ASC) ;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`user_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bloomweb_colors`.`user_fields` ;

CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`user_fields` (
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
  CONSTRAINT `fk_user_fields_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `bloomweb_colors`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_fields_document_types`
    FOREIGN KEY (`document_type_id` )
    REFERENCES `bloomweb_colors`.`document_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `document_UNIQUE` ON `bloomweb_colors`.`user_fields` (`document` ASC) ;

CREATE INDEX `fk_user_fields_users_INDEX` ON `bloomweb_colors`.`user_fields` (`user_id` ASC) ;

CREATE INDEX `fk_user_fields_document_types_INDEX` ON `bloomweb_colors`.`user_fields` (`document_type_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`roles`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`roles` (`id`, `name`) VALUES (1, 'Admin');
INSERT INTO `bloomweb_colors`.`roles` (`id`, `name`) VALUES (2, 'Users');

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`users`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`users` (`id`, `email`, `username`, `password`, `role_id`, `active`, `created`, `updated`) VALUES (1, 'admin@bloomweb.co', 'admin', '3d66fec9c10dbc7be728b94116fdbad76c134090', 1, 1, NULL, NULL);

COMMIT;
