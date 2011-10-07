SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `bloomweb_colors` DEFAULT CHARACTER SET utf8 ;
USE `bloomweb_colors` ;

-- -----------------------------------------------------
-- Table `bloomweb_colors`.`categories`
-- -----------------------------------------------------
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
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`brands` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `image_brand` VARCHAR(255) NULL ,
  `image_hover` VARCHAR(255) NULL ,
  `sort` INT NULL ,
  `category_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_brands_categories_INDEX` (`category_id` ASC) ,
  CONSTRAINT `fk_brands_categories`
    FOREIGN KEY (`category_id` )
    REFERENCES `bloomweb_colors`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`subcategories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`subcategories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `image` VARCHAR(255) NULL ,
  `sort` INT NULL ,
  `brand_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_subcategories_brands_INDEX` (`brand_id` ASC) ,
  CONSTRAINT `fk_subcategories_brands`
    FOREIGN KEY (`brand_id` )
    REFERENCES `bloomweb_colors`.`brands` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`collections`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`collections` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `brand_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_collections_brands_INDEX` (`brand_id` ASC) ,
  CONSTRAINT `fk_collections_brands`
    FOREIGN KEY (`brand_id` )
    REFERENCES `bloomweb_colors`.`brands` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`products`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` TEXT NOT NULL ,
  `image` VARCHAR(255) NOT NULL ,
  `price` DOUBLE NOT NULL ,
  `clasification` VARCHAR(100) NOT NULL ,
  `collection_id` INT NOT NULL ,
  `subcategory_id` INT NOT NULL ,
  `brand_id` INT NOT NULL ,
  `num_visits` VARCHAR(45) NOT NULL DEFAULT 0 ,
  `num_voted` VARCHAR(45) NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  `recommendations` VARCHAR(255) NULL ,
  `other_recommendations` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_products_subcategories_INDEX` (`subcategory_id` ASC) ,
  INDEX `fk_products_collections_INDEX` (`collection_id` ASC) ,
  UNIQUE INDEX `clasification_UNIQUE` (`clasification` ASC) ,
  INDEX `fk_products_brands_INDEX` (`brand_id` ASC) ,
  CONSTRAINT `fk_products_subcategories`
    FOREIGN KEY (`subcategory_id` )
    REFERENCES `bloomweb_colors`.`subcategories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_collections`
    FOREIGN KEY (`collection_id` )
    REFERENCES `bloomweb_colors`.`collections` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_brands`
    FOREIGN KEY (`brand_id` )
    REFERENCES `bloomweb_colors`.`brands` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`size_references`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`size_references` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `size` VARCHAR(50) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`sizes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`sizes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `size_reference_id` INT NOT NULL ,
  `subcategory_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sizes_subcategories_INDEX` (`subcategory_id` ASC) ,
  INDEX `fk_sizes_size_references_INDEX` (`size_reference_id` ASC) ,
  CONSTRAINT `fk_sizes_subcategories`
    FOREIGN KEY (`subcategory_id` )
    REFERENCES `bloomweb_colors`.`subcategories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sizes_size_references`
    FOREIGN KEY (`size_reference_id` )
    REFERENCES `bloomweb_colors`.`size_references` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`inventories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`inventories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT NOT NULL ,
  `size_id` INT NOT NULL ,
  `quantity` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_inventories_products_INDEX` (`product_id` ASC) ,
  INDEX `fk_inventories_sizes_INDEX` (`size_id` ASC) ,
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


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`product_pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`product_pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `path` VARCHAR(255) NOT NULL ,
  `product_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_product_pictures_products_INDEX` (`product_id` ASC) ,
  CONSTRAINT `fk_product_pictures_products`
    FOREIGN KEY (`product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`acos`
-- -----------------------------------------------------
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
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`aros_acos` (
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


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`document_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`document_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`i18n`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`i18n` (
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


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`pages`
-- -----------------------------------------------------
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
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) ,
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`users`
-- -----------------------------------------------------
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
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `fk_users_roles_INDEX` (`role_id` ASC) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `bloomweb_colors`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`user_fields`
-- -----------------------------------------------------
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
  UNIQUE INDEX `document_UNIQUE` (`document` ASC) ,
  INDEX `fk_user_fields_users_INDEX` (`user_id` ASC) ,
  INDEX `fk_user_fields_document_types_INDEX` (`document_type_id` ASC) ,
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


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`inventory_audits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`inventory_audits` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `inventory_id` INT NOT NULL ,
  `old_value` INT NOT NULL ,
  `new_value` INT NOT NULL ,
  `comment` TEXT NULL ,
  `created` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_inventory_audits_users_INDEX` (`user_id` ASC) ,
  INDEX `fk_inventory_audits_inventories_INDEX` (`inventory_id` ASC) ,
  CONSTRAINT `fk_inventory_audits_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `bloomweb_colors`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventory_audits_inventories`
    FOREIGN KEY (`inventory_id` )
    REFERENCES `bloomweb_colors`.`inventories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`recommendations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`recommendations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT NOT NULL ,
  `recommended_product_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_recommendations_products_1_INDEX` (`product_id` ASC) ,
  INDEX `fk_recommendations_products_2_INDEX` (`recommended_product_id` ASC) ,
  CONSTRAINT `fk_recommendations_products_1`
    FOREIGN KEY (`product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recommendations_products_2`
    FOREIGN KEY (`recommended_product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`other_recommendations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`other_recommendations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `product_id` INT NOT NULL ,
  `recommended_product_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_other_recommendations_products_1_INDEX` (`product_id` ASC) ,
  INDEX `fk_other_recommendations_products_2_INDEX` (`recommended_product_id` ASC) ,
  CONSTRAINT `fk_other_recommendations_products_1`
    FOREIGN KEY (`product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_other_recommendations_products_2`
    FOREIGN KEY (`recommended_product_id` )
    REFERENCES `bloomweb_colors`.`products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`shop_carts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`shop_carts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  `user_agent` VARCHAR(32) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_shop_carts_users_INDEX` (`user_id` ASC) ,
  CONSTRAINT `fk_shop_carts_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `bloomweb_colors`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`shop_cart_items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`shop_cart_items` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `shop_cart_id` INT NOT NULL ,
  `model_name` VARCHAR(50) NOT NULL ,
  `foreign_key` INT NOT NULL ,
  `size_id` INT NOT NULL ,
  `is_gift` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `quantity` INT NOT NULL DEFAULT 1 ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_shop_cart_items_shop_carts_INDEX` (`shop_cart_id` ASC) ,
  INDEX `fk_shop_cart_items_size_references_INDEX` (`size_id` ASC) ,
  CONSTRAINT `fk_shop_cart_items_shop_carts`
    FOREIGN KEY (`shop_cart_id` )
    REFERENCES `bloomweb_colors`.`shop_carts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_shop_cart_items_size_references`
    FOREIGN KEY (`size_id` )
    REFERENCES `bloomweb_colors`.`size_references` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`order_states`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`order_states` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`orders`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  `user_agent` VARCHAR(32) NULL ,
  `order_state_id` INT NULL ,
  `cookie_code` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_orders_users_INDEX` (`user_id` ASC) ,
  INDEX `fk_orders_order_states_INDEX` (`order_state_id` ASC) ,
  CONSTRAINT `fk_orders_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `bloomweb_colors`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_order_states`
    FOREIGN KEY (`order_state_id` )
    REFERENCES `bloomweb_colors`.`order_states` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bloomweb_colors`.`order_items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bloomweb_colors`.`order_items` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `order_id` INT NOT NULL ,
  `model_name` VARCHAR(50) NOT NULL ,
  `foreign_key` INT NOT NULL ,
  `size_id` INT NOT NULL ,
  `is_gift` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `quantity` INT NOT NULL ,
  `price_item` DOUBLE NOT NULL ,
  `price_total` DOUBLE NOT NULL ,
  `name` VARCHAR(50) NULL ,
  `surname` VARCHAR(50) NULL ,
  `address` VARCHAR(100) NULL ,
  `phone` INT NULL ,
  `country` VARCHAR(50) NULL ,
  `state` VARCHAR(50) NULL ,
  `city` VARCHAR(50) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_order_items_orders_INDEX` (`order_id` ASC) ,
  INDEX `fk_order_items_size_references` (`size_id` ASC) ,
  CONSTRAINT `fk_order_items_orders`
    FOREIGN KEY (`order_id` )
    REFERENCES `bloomweb_colors`.`orders` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_items_size_references`
    FOREIGN KEY (`size_id` )
    REFERENCES `bloomweb_colors`.`size_references` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`categories` (`id`, `name`, `image`, `sort`, `created`, `updated`) VALUES (NULL, 'categoria1', NULL, NULL, NULL, NULL);
INSERT INTO `bloomweb_colors`.`categories` (`id`, `name`, `image`, `sort`, `created`, `updated`) VALUES (NULL, 'categoria2', NULL, NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`brands`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`brands` (`id`, `name`, `image_brand`, `image_hover`, `sort`, `category_id`, `created`, `updated`) VALUES (1, 'motoneta', 'motoneta.png', 'motoneta_active.png', 1, 1, NULL, NULL);
INSERT INTO `bloomweb_colors`.`brands` (`id`, `name`, `image_brand`, `image_hover`, `sort`, `category_id`, `created`, `updated`) VALUES (2, 'paez', 'paez.png', 'paez_active.png', 2, 1, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`subcategories`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`subcategories` (`id`, `name`, `image`, `sort`, `brand_id`, `created`, `updated`) VALUES (1, 'ropa', NULL, NULL, 1, NULL, NULL);
INSERT INTO `bloomweb_colors`.`subcategories` (`id`, `name`, `image`, `sort`, `brand_id`, `created`, `updated`) VALUES (2, 'vestidos', NULL, NULL, 1, NULL, NULL);
INSERT INTO `bloomweb_colors`.`subcategories` (`id`, `name`, `image`, `sort`, `brand_id`, `created`, `updated`) VALUES (3, 'zapatos', NULL, NULL, 1, NULL, NULL);
INSERT INTO `bloomweb_colors`.`subcategories` (`id`, `name`, `image`, `sort`, `brand_id`, `created`, `updated`) VALUES (4, 'bolsos', NULL, NULL, 1, NULL, NULL);
INSERT INTO `bloomweb_colors`.`subcategories` (`id`, `name`, `image`, `sort`, `brand_id`, `created`, `updated`) VALUES (5, 'accesorios', NULL, NULL, 1, NULL, NULL);
INSERT INTO `bloomweb_colors`.`subcategories` (`id`, `name`, `image`, `sort`, `brand_id`, `created`, `updated`) VALUES (6, 'cervezas', NULL, NULL, 1, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`collections`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`collections` (`id`, `name`, `brand_id`) VALUES (1, '2011', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`size_references`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`size_references` (`id`, `size`, `created`, `updated`) VALUES (1, '34', NULL, NULL);
INSERT INTO `bloomweb_colors`.`size_references` (`id`, `size`, `created`, `updated`) VALUES (2, '38', NULL, NULL);
INSERT INTO `bloomweb_colors`.`size_references` (`id`, `size`, `created`, `updated`) VALUES (3, '42', NULL, NULL);
INSERT INTO `bloomweb_colors`.`size_references` (`id`, `size`, `created`, `updated`) VALUES (4, 'XS', NULL, NULL);
INSERT INTO `bloomweb_colors`.`size_references` (`id`, `size`, `created`, `updated`) VALUES (5, 'XL', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`document_types`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`document_types` (`id`, `name`) VALUES (1, 'CC');
INSERT INTO `bloomweb_colors`.`document_types` (`id`, `name`) VALUES (2, 'TI');

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`roles` (`id`, `name`) VALUES (1, 'Admin');
INSERT INTO `bloomweb_colors`.`roles` (`id`, `name`) VALUES (2, 'Users');

COMMIT;

-- -----------------------------------------------------
-- Data for table `bloomweb_colors`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_colors`;
INSERT INTO `bloomweb_colors`.`users` (`id`, `email`, `username`, `password`, `role_id`, `active`, `created`, `updated`) VALUES (1, 'admin@bloomweb.co', 'admin', '3d66fec9c10dbc7be728b94116fdbad76c134090', 1, 1, NULL, NULL);

COMMIT;
