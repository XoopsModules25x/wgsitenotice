# SQL Dump for wgsitenotice module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Fri Feb 20, 2015 to 12:43
# Server version: 5.6.16
# PHP Version: 5.5.9

#
# Structure table for `wgsitenotice_versions` 7
#
		
CREATE TABLE `wgsitenotice_versions` (
  `version_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version_name` VARCHAR(100) NOT NULL DEFAULT '',
  `version_lang` VARCHAR(50) NULL DEFAULT '',
  `version_descr` VARCHAR(200) NULL DEFAULT '',
  `version_author` VARCHAR(100) NOT NULL DEFAULT '',
  `version_weight` INT(8) NOT NULL DEFAULT '0',
  `version_current` INT(1) NOT NULL DEFAULT '0',
  `version_online` INT(1) NOT NULL DEFAULT '0',
  `version_date` INT(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version_id`)
) ENGINE=MyISAM;

#
# Structure table for `wgsitenotice_contents` 6
#
		
CREATE TABLE `wgsitenotice_contents` (
  `cont_id` INT(8)   AUTO_INCREMENT,
  `cont_version_id` INT(8) NOT NULL DEFAULT '0',
  `cont_header` VARCHAR(200) NULL DEFAULT '',
  `cont_text` TEXT NOT NULL ,
  `cont_weight` INT(8) NOT NULL DEFAULT '0',
  `cont_date` INT(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cont_id`)
) ENGINE=MyISAM;
