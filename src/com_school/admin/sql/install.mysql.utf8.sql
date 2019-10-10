CREATE TABLE IF NOT EXISTS `#__school_students` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`user_id` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`surname` VARCHAR(255)  NOT NULL ,
`education` VARCHAR(255)  NOT NULL ,
`hobbies` TEXT NOT NULL ,
`address` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__school_teachers` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`user_id` INT(11)  NOT NULL ,
`fname` VARCHAR(255)  NOT NULL ,
`lname` VARCHAR(255)  NOT NULL ,
`address` TEXT NOT NULL ,
`mobile` INT NOT NULL ,
`department` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

