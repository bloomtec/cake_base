SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `bloomweb_fpt` DEFAULT CHARACTER SET utf8 ;
USE `bloomweb_fpt` ;

-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

CREATE  TABLE IF NOT EXISTS `roles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `roles` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `role_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id` )
    REFERENCES `roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `users` (`email` ASC) ;

CREATE INDEX `fk_users_roles_INDEX` ON `users` (`role_id` ASC) ;


-- -----------------------------------------------------
-- Table `team_styles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `team_styles` ;

CREATE  TABLE IF NOT EXISTS `team_styles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teams` ;

CREATE  TABLE IF NOT EXISTS `teams` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `team_style_id` INT NOT NULL ,
  `name` VARCHAR(145) NOT NULL ,
  `image` VARCHAR(100) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_teams_team_styles`
    FOREIGN KEY (`team_style_id` )
    REFERENCES `team_styles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_teams_team_styles_INDEX` ON `teams` (`team_style_id` ASC) ;

CREATE UNIQUE INDEX `nombre_UNIQUE` ON `teams` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `leagues`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `leagues` ;

CREATE  TABLE IF NOT EXISTS `leagues` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `image` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `clubs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clubs` ;

CREATE  TABLE IF NOT EXISTS `clubs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `league_id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `image` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_clubs_leagues`
    FOREIGN KEY (`league_id` )
    REFERENCES `leagues` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_clubs_leagues_INDEX` ON `clubs` (`league_id` ASC) ;


-- -----------------------------------------------------
-- Table `country_squads`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `country_squads` ;

CREATE  TABLE IF NOT EXISTS `country_squads` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `image` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ads`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ads` ;

CREATE  TABLE IF NOT EXISTS `ads` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `challenge_statuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `challenge_statuses` ;

CREATE  TABLE IF NOT EXISTS `challenge_statuses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `challenges`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `challenges` ;

CREATE  TABLE IF NOT EXISTS `challenges` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `challenge_status_id` INT NOT NULL ,
  `team_challenger_id` INT NOT NULL ,
  `team_challenged_id` INT NOT NULL ,
  `user_challenger_id` INT NOT NULL ,
  `user_decided_id` INT NULL ,
  `date` DATETIME NOT NULL ,
  `place` VARCHAR(100) NOT NULL ,
  `bet` VARCHAR(45) NULL ,
  `title` VARCHAR(45) NOT NULL ,
  `message` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_challenges_challenges_status`
    FOREIGN KEY (`challenge_status_id` )
    REFERENCES `challenge_statuses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_challenges_teams_1`
    FOREIGN KEY (`team_challenger_id` )
    REFERENCES `teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_challenges_teams_2`
    FOREIGN KEY (`team_challenged_id` )
    REFERENCES `leagues` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_challenges_users_1`
    FOREIGN KEY (`user_challenger_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_challenges_users_2`
    FOREIGN KEY (`user_decided_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_challenges_challenges_status_INDEX` ON `challenges` (`challenge_status_id` ASC) ;

CREATE INDEX `fk_challenges_teams_1_INDEX` ON `challenges` (`team_challenger_id` ASC) ;

CREATE INDEX `fk_challenges_teams_2_INDEX` ON `challenges` (`team_challenged_id` ASC) ;

CREATE INDEX `fk_challenges_users_1_INDEX` ON `challenges` (`user_challenger_id` ASC) ;

CREATE INDEX `fk_challenges_users_2_INDEX` ON `challenges` (`user_decided_id` ASC) ;


-- -----------------------------------------------------
-- Table `public_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `public_messages` ;

CREATE  TABLE IF NOT EXISTS `public_messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `to_user_id` INT NOT NULL ,
  `from_user_id` INT NOT NULL ,
  `subject` VARCHAR(145) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_public_messages_users_1`
    FOREIGN KEY (`to_user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_public_messages_users_2`
    FOREIGN KEY (`from_user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_public_messages_users_1_INDEX` ON `public_messages` (`to_user_id` ASC) ;

CREATE INDEX `fk_public_messages_users_2_INDEX` ON `public_messages` (`from_user_id` ASC) ;


-- -----------------------------------------------------
-- Table `private_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `private_messages` ;

CREATE  TABLE IF NOT EXISTS `private_messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `to_user_id` INT NOT NULL ,
  `from_user_id` INT NOT NULL ,
  `subject` VARCHAR(145) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_private_messages_users_1`
    FOREIGN KEY (`to_user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_private_messages_users_2`
    FOREIGN KEY (`from_user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_private_messages_users_1_INDEX` ON `private_messages` (`to_user_id` ASC) ;

CREATE INDEX `fk_private_messages_users_2_INDEX` ON `private_messages` (`from_user_id` ASC) ;


-- -----------------------------------------------------
-- Table `friendships`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `friendships` ;

CREATE  TABLE IF NOT EXISTS `friendships` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_a_id` INT NOT NULL ,
  `user_b_id` INT NOT NULL ,
  `is_accepted` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `is_blocked` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_friendships_users_1`
    FOREIGN KEY (`user_a_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_friendships_users_2`
    FOREIGN KEY (`user_b_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'user_a invita, user_b acepta' ;

CREATE INDEX `fk_friendships_users_1_INDEX` ON `friendships` (`user_a_id` ASC) ;

CREATE INDEX `fk_friendships_users_2_INDEX` ON `friendships` (`user_b_id` ASC) ;


-- -----------------------------------------------------
-- Table `match_statuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_statuses` ;

CREATE  TABLE IF NOT EXISTS `match_statuses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `matches`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `matches` ;

CREATE  TABLE IF NOT EXISTS `matches` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `match_status_id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `place` VARCHAR(100) NOT NULL ,
  `bet` VARCHAR(45) NULL ,
  `message` TEXT NULL ,
  `user_creator_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_matches_match_status1`
    FOREIGN KEY (`match_status_id` )
    REFERENCES `match_statuses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_matches_match_status_INDEX` ON `matches` (`match_status_id` ASC) ;


-- -----------------------------------------------------
-- Table `user_match_statuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_match_statuses` ;

CREATE  TABLE IF NOT EXISTS `user_match_statuses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_matches`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_matches` ;

CREATE  TABLE IF NOT EXISTS `users_matches` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `match_id` INT NOT NULL ,
  `user_match_status_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_matches_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_matches_matches`
    FOREIGN KEY (`match_id` )
    REFERENCES `matches` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_matches_user_match_statuses`
    FOREIGN KEY (`user_match_status_id` )
    REFERENCES `user_match_statuses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_users_matches_matches_INDEX` ON `users_matches` (`match_id` ASC) ;

CREATE INDEX `fk_users_matches_users_INDEX` ON `users_matches` (`user_id` ASC) ;

CREATE INDEX `fk_users_matches_user_match_statuses_INDEX` ON `users_matches` (`user_match_status_id` ASC) ;


-- -----------------------------------------------------
-- Table `user_team_statuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_team_statuses` ;

CREATE  TABLE IF NOT EXISTS `user_team_statuses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `description` TEXT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_teams` ;

CREATE  TABLE IF NOT EXISTS `users_teams` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `team_id` INT NOT NULL ,
  `user_team_status_id` INT NOT NULL ,
  `caller_user_id` INT NULL COMMENT 'si es nul el user_id solicito, sino es invitado por coller user' ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_teams_users_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_teams_teams`
    FOREIGN KEY (`team_id` )
    REFERENCES `teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_teams_user_team_statuses`
    FOREIGN KEY (`user_team_status_id` )
    REFERENCES `user_team_statuses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_teams_users_2`
    FOREIGN KEY (`caller_user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_users_teams_teams_INDEX` ON `users_teams` (`team_id` ASC) ;

CREATE INDEX `fk_users_teams_users_1_INDEX` ON `users_teams` (`user_id` ASC) ;

CREATE INDEX `fk_users_teams_user_team_status_INDEX` ON `users_teams` (`user_team_status_id` ASC) ;

CREATE INDEX `fk_users_teams_users_2_INDEX` ON `users_teams` (`caller_user_id` ASC) ;


-- -----------------------------------------------------
-- Table `team_notifications`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `team_notifications` ;

CREATE  TABLE IF NOT EXISTS `team_notifications` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `team_id` INT NOT NULL ,
  `subject` VARCHAR(145) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_team_notifications_teams`
    FOREIGN KEY (`team_id` )
    REFERENCES `teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_team_notifications_teams_INDEX` ON `team_notifications` (`team_id` ASC) ;


-- -----------------------------------------------------
-- Table `country_squads_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `country_squads_users` ;

CREATE  TABLE IF NOT EXISTS `country_squads_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `country_squad_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_country_squads_users_country_squads`
    FOREIGN KEY (`country_squad_id` )
    REFERENCES `country_squads` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_country_squads_users_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_country_squads_users_users_INDEX` ON `country_squads_users` (`user_id` ASC) ;

CREATE INDEX `fk_country_squads_users_country_squads_INDEX` ON `country_squads_users` (`country_squad_id` ASC) ;


-- -----------------------------------------------------
-- Table `clubs_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `clubs_users` ;

CREATE  TABLE IF NOT EXISTS `clubs_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `club_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_clubs_has_users_clubs1`
    FOREIGN KEY (`club_id` )
    REFERENCES `clubs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clubs_has_users_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_clubs_users_users_INDEX` ON `clubs_users` (`user_id` ASC) ;

CREATE INDEX `fk_clubs_users_clubs_INDEX` ON `clubs_users` (`club_id` ASC) ;


-- -----------------------------------------------------
-- Table `feet`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feet` ;

CREATE  TABLE IF NOT EXISTS `feet` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `image` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `positions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `positions` ;

CREATE  TABLE IF NOT EXISTS `positions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `positions` VARCHAR(45) NULL ,
  `image` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_fields` ;

CREATE  TABLE IF NOT EXISTS `user_fields` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `surname` VARCHAR(50) NOT NULL ,
  `birthday` DATE NOT NULL ,
  `gender` VARCHAR(50) NOT NULL ,
  `image` VARCHAR(50) NOT NULL ,
  `position_id` INT NOT NULL ,
  `foot_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_user_fields_feet`
    FOREIGN KEY (`foot_id` )
    REFERENCES `feet` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_fields_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_fields_positions`
    FOREIGN KEY (`position_id` )
    REFERENCES `positions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_user_fields_feet_INDEX` ON `user_fields` (`foot_id` ASC) ;

CREATE INDEX `fk_user_fields_users_INDEX` ON `user_fields` (`user_id` ASC) ;

CREATE INDEX `fk_users_fields_positions_INDEX` ON `user_fields` (`position_id` ASC) ;


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
  CONSTRAINT `fk_aros_acos_aros`
    FOREIGN KEY (`aro_id` )
    REFERENCES `aros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aros_acos_acos`
    FOREIGN KEY (`aco_id` )
    REFERENCES `acos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `ARO_ACO_KEY` ON `aros_acos` (`aro_id` ASC, `aco_id` ASC) ;

CREATE INDEX `fk_aros_acos_aros_INDEX` ON `aros_acos` (`aro_id` ASC) ;

CREATE INDEX `fk_aros_acos_acos_INDEX` ON `aros_acos` (`aco_id` ASC) ;


-- -----------------------------------------------------
-- Table `pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pages` ;

CREATE  TABLE IF NOT EXISTS `pages` (
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

CREATE UNIQUE INDEX `title_UNIQUE` ON `pages` (`title` ASC) ;

CREATE UNIQUE INDEX `slug_UNIQUE` ON `pages` (`slug` ASC) ;


-- -----------------------------------------------------
-- Table `user_notifications`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_notifications` ;

CREATE  TABLE IF NOT EXISTS `user_notifications` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `subject` VARCHAR(145) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_user_notifications_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_user_notifications_users_INDEX` ON `user_notifications` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `menus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menus` ;

CREATE  TABLE IF NOT EXISTS `menus` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `menu_items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menu_items` ;

CREATE  TABLE IF NOT EXISTS `menu_items` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `menu_id` INT NOT NULL ,
  `parent_id` INT NULL ,
  `lft` INT NULL ,
  `rght` INT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `link` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_menu_items_menu`
    FOREIGN KEY (`menu_id` )
    REFERENCES `menus` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_menu_items_menu_INDEX` ON `menu_items` (`menu_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `roles` (`id`, `name`) VALUES (1, 'Admin');
INSERT INTO `roles` (`id`, `name`) VALUES (2, 'Usuario');

COMMIT;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (1, 'juliodominguez@gmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 1, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (2, 'ricardopandales@gmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (3, 'juansebas07126@hotmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (4, 'antonio@gesta.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (5, 'andres@gesta.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (6, 'martin@futbolparatodos.co', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (7, 'jair@futbolparatodos.co', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (8, 'raul@gmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);
INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES (9, 'lina@gesta.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `team_styles`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `team_styles` (`id`, `name`) VALUES (1, 'Futbol 11');
INSERT INTO `team_styles` (`id`, `name`) VALUES (2, 'Futbol 6');

COMMIT;

-- -----------------------------------------------------
-- Data for table `teams`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `teams` (`id`, `team_style_id`, `name`, `image`, `created`, `updated`) VALUES (1, 1, 'FPT', NULL, NULL, NULL);
INSERT INTO `teams` (`id`, `team_style_id`, `name`, `image`, `created`, `updated`) VALUES (2, 2, 'Bloom', NULL, NULL, NULL);
INSERT INTO `teams` (`id`, `team_style_id`, `name`, `image`, `created`, `updated`) VALUES (3, 2, 'Gesta', NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `leagues`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `leagues` (`id`, `name`, `image`) VALUES (1, 'Liga Postobon', NULL);
INSERT INTO `leagues` (`id`, `name`, `image`) VALUES (2, 'Liga BBVA', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `clubs`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (1, 1, 'Atletico Nacional', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (2, 1, 'Deportivo Cali', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (3, 1, 'America de Cali', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (4, 1, 'Independiente Medellin', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (5, 1, 'Millonarios', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (6, 2, 'Barcelona FC', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (7, 2, 'Real Madrid', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (8, 2, 'Atletico de Madrid', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (9, 2, 'Villareal', NULL);
INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES (10, 2, 'Valencia', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `country_squads`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `country_squads` (`id`, `name`, `image`) VALUES (1, 'Colombia', NULL);
INSERT INTO `country_squads` (`id`, `name`, `image`) VALUES (2, 'Brasil', NULL);
INSERT INTO `country_squads` (`id`, `name`, `image`) VALUES (3, 'Argentina', NULL);
INSERT INTO `country_squads` (`id`, `name`, `image`) VALUES (4, 'Holanda', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `challenge_statuses`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `challenge_statuses` (`id`, `name`, `description`) VALUES (1, 'aceptado', NULL);
INSERT INTO `challenge_statuses` (`id`, `name`, `description`) VALUES (2, 'rechazado', NULL);
INSERT INTO `challenge_statuses` (`id`, `name`, `description`) VALUES (3, 'en_espera', NULL);
INSERT INTO `challenge_statuses` (`id`, `name`, `description`) VALUES (4, 'concluido', NULL);
INSERT INTO `challenge_statuses` (`id`, `name`, `description`) VALUES (NULL, 'cancelado', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `public_messages`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `public_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (1, 1, 2, 'Hola', 'asfda', '1982-06-09');
INSERT INTO `public_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (2, 2, 1, 'Que tal?', 'asfa', '1983-06-09');
INSERT INTO `public_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (3, 3, 1, 'bn o no?', 'asdfas', '1984-06-09');
INSERT INTO `public_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (4, 1, 5, 'estas?', 'dfa', '1985-06-09');
INSERT INTO `public_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (5, 3, 4, 'saludos', 'dfasdfa', '1986-06-09');

COMMIT;

-- -----------------------------------------------------
-- Data for table `private_messages`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `private_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (1, 1, 2, 'a', 'asdf', '1982-06-09');
INSERT INTO `private_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (2, 2, 1, 'b', 'asdfa', '1983-06-09');
INSERT INTO `private_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (3, 3, 1, 'c', 'asf', '1984-06-09');
INSERT INTO `private_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (4, 1, 5, 'd', 'asdf', '1985-06-09');
INSERT INTO `private_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES (5, 3, 4, 'e', 'asdf', '1986-06-09');

COMMIT;

-- -----------------------------------------------------
-- Data for table `user_match_statuses`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `user_match_statuses` (`id`, `name`, `description`) VALUES (1, 'En Espera', NULL);
INSERT INTO `user_match_statuses` (`id`, `name`, `description`) VALUES (2, 'Aceptado', NULL);
INSERT INTO `user_match_statuses` (`id`, `name`, `description`) VALUES (3, 'Rechazado', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `user_team_statuses`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `user_team_statuses` (`id`, `name`, `description`, `created`, `updated`) VALUES (1, 'En Espera', NULL, NULL, NULL);
INSERT INTO `user_team_statuses` (`id`, `name`, `description`, `created`, `updated`) VALUES (2, 'Aceptada', NULL, NULL, NULL);
INSERT INTO `user_team_statuses` (`id`, `name`, `description`, `created`, `updated`) VALUES (3, 'Rechazada', NULL, NULL, NULL);
INSERT INTO `user_team_statuses` (`id`, `name`, `description`, `created`, `updated`) VALUES (NULL, '', NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `users_teams`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (1, 1, 2, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (2, 2, 2, 2, 1, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (3, 3, 2, 3, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (4, 4, 3, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (5, 5, 3, 4, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (6, 6, 1, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (7, 7, 1, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (8, 8, 1, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (9, 9, 3, 2, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (10, 1, 1, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (11, 2, 1, 1, NULL, NULL, NULL);
INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES (12, 3, 1, 1, NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `team_notifications`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `team_notifications` (`id`, `team_id`, `subject`, `content`, `created`) VALUES (1, 1, 'tnoti', 'noti equipo', '1982-06-09');
INSERT INTO `team_notifications` (`id`, `team_id`, `subject`, `content`, `created`) VALUES (2, 2, 'tnoti', 'noti equipo', '1982-06-09');
INSERT INTO `team_notifications` (`id`, `team_id`, `subject`, `content`, `created`) VALUES (3, 3, 'tnoti', 'noti equipo', '1982-06-09');
INSERT INTO `team_notifications` (`id`, `team_id`, `subject`, `content`, `created`) VALUES (4, 1, 'tnoti2', 'noti equipo', '1983-06-09');
INSERT INTO `team_notifications` (`id`, `team_id`, `subject`, `content`, `created`) VALUES (5, 2, 'tnoti2', 'noti equipo', '1983-06-09');
INSERT INTO `team_notifications` (`id`, `team_id`, `subject`, `content`, `created`) VALUES (6, 3, 'tnoti2', 'noti equipo', '1983-06-09');

COMMIT;

-- -----------------------------------------------------
-- Data for table `feet`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `feet` (`id`, `name`, `image`) VALUES (1, 'Izquierdo', NULL);
INSERT INTO `feet` (`id`, `name`, `image`) VALUES (2, 'Derecho', NULL);
INSERT INTO `feet` (`id`, `name`, `image`) VALUES (3, 'Ambidiestro', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `positions`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `positions` (`id`, `positions`, `image`) VALUES (1, 'Arquero', 'arquero.png');
INSERT INTO `positions` (`id`, `positions`, `image`) VALUES (2, 'Defensa', 'defensa.png');
INSERT INTO `positions` (`id`, `positions`, `image`) VALUES (3, 'Volante', 'volante.png');
INSERT INTO `positions` (`id`, `positions`, `image`) VALUES (4, 'Delantero', 'delantero.png');

COMMIT;

-- -----------------------------------------------------
-- Data for table `user_fields`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (1, 1, 'Julio', 'Dominguez', '1982-06-09', 'm', 'arquero.png', 1, 2, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (2, 2, 'Ricardo', 'Pandales', '1987-06-09', 'm', 'defensa.png', 2, 2, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (3, 3, 'Juan', 'Aparicio', '1988-06-09', 'm', 'volante.png', 3, 1, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (4, 4, 'Antonio', 'Ramirez', '1984-06-09', 'm', 'delantero.png', 4, 2, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (5, 5, 'Andres', 'Hurtado', '1978-06-09', 'm', 'arquero.png', 1, 1, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (6, 6, 'Martin', 'Duran', '1990-06-09', 'm', 'defensa.png', 2, 3, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (7, 7, 'Jair', 'Lenis', '1991-06-09', 'm', 'volante.png', 3, 2, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (8, 9, 'Lina', 'Patiño', '1992-06-09', 'f', 'delantero.png', 4, 2, NULL, NULL);
INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `position_id`, `foot_id`, `created`, `updated`) VALUES (9, 8, 'Raul', 'Quintero', '1980-06-09', 'm', 'arquero.png', 1, 2, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `user_notifications`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `user_notifications` (`id`, `user_id`, `subject`, `content`, `created`) VALUES (1, 1, 'noti1', 'la noti1', '1982-06-09');
INSERT INTO `user_notifications` (`id`, `user_id`, `subject`, `content`, `created`) VALUES (2, 2, 'noti2', 'la noti2', '1982-06-09');
INSERT INTO `user_notifications` (`id`, `user_id`, `subject`, `content`, `created`) VALUES (3, 3, 'noti3', 'la noti3', '1982-06-09');
INSERT INTO `user_notifications` (`id`, `user_id`, `subject`, `content`, `created`) VALUES (4, 1, 'noti4', 'la noti4', '1983-06-09');
INSERT INTO `user_notifications` (`id`, `user_id`, `subject`, `content`, `created`) VALUES (5, 2, 'noti5', 'la noti5', '1983-06-09');
INSERT INTO `user_notifications` (`id`, `user_id`, `subject`, `content`, `created`) VALUES (6, 3, 'noti6', 'la noti6', '1983-06-09');

COMMIT;

-- -----------------------------------------------------
-- Data for table `menus`
-- -----------------------------------------------------
START TRANSACTION;
USE `bloomweb_fpt`;
INSERT INTO `menus` (`id`, `name`, `created`, `updated`) VALUES (1, 'ez_cms', NULL, NULL);

COMMIT;
